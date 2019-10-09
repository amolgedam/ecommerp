<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_voucher extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Sales Voucher';

        $this->load->library('number_to_word');

		$this->load->model('model_ledger');
        $this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
        $this->load->model('model_paymentmaster');
        $this->load->model('model_deliverymemo');
        $this->load->model('model_sku');
        $this->load->model('model_unit');
        $this->load->model('model_gst');

        $this->load->model('model_salesvoucher');
        $this->load->model('model_vouchers');
        $this->load->model('model_salesinvoice');
        $this->load->model('model_company');
        $this->load->model('model_state');

        $this->load->model('model_comm');
        
        
		$this->load->model('model_salesinvoice');

        $this->load->model('model_purchaseledger');
        $this->load->model('model_salesledger');

	}

	public function fetchAllData()
	{
		$data = $this->model_salesvoucher->fecthAllData();
        // echo "<pre>"; print_r($data);exit;
        
        if(empty($data))
        {
            $result['data'] = '';
        }
        else
        {
            $no=1;
            foreach($data as $key => $value)
            {
                $buttons = '';
                
                $buttons .= '&nbsp; <a href="'.base_url().'sales_voucher/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'sales_voucher/delete/'.$value['id'].'/sales_voucher" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                
                $result['data'][$key] = array(
                                                $no,
                                                $value['order_no'],
                                                $value['date'],
                                                $value['total_invoicevalue'],
                                                $value['sales_status'],
                                                $buttons
                                            ); 
                $no++;
            }
        }
        // print_r($result);
        echo json_encode($result);
        exit;
	}

	public function index()
	{
		$this->render_template('admin_view/salesMaster/salesVoucher/index', $this->data);
	}

    function check_defaultsaccount($post_string)
    {
      return $post_string == '0' ? FALSE : TRUE;
    }

    function check_defaultaccount($post_string)
    {
      return $post_string == '0' ? FALSE : TRUE;
    }

    function check_defaultgst($post_string)
    {
      return $post_string == '0' ? FALSE : TRUE;
    }

	public function create()
	{
	    $this->form_validation->set_rules('order_no', 'Invoice Number', 'trim|required');
	    
        $this->form_validation->set_rules('saccount','Sales Account','required|callback_check_defaultsaccount');
        $this->form_validation->set_message('check_defaultsaccount', 'Select Sales Account');

        $this->form_validation->set_rules('account','Sales Account','required|callback_check_defaultaccount');
        $this->form_validation->set_message('check_defaultaccount', 'Select Account');

        $this->form_validation->set_rules('sale_type','GST Type','required|callback_check_defaultgst');
        $this->form_validation->set_message('check_defaultgst', 'Select Account');

	    if ($this->form_validation->run() == TRUE) { 
	    

            $invoiceDate = date("Y-m-d", strtotime($this->input->post('date')));
            
	        $data = array(
                            'inventory_no' => $this->input->post('order_no'),
                            'date' => $invoiceDate,
                            'sales_account' => $this->input->post('saccount'),
                            'account' => $this->input->post('account'),
                            'salesman' => $this->input->post('salesman'),
                            'shipping_details' => $this->input->post('shipping_details'),
                            'shipping_type' => $this->input->post('shipping_type'),
                            'division' => $this->input->post('division'),
                            // 'branch' => $this->input->post('branch'),
                            'location' => $this->input->post('location'),
                            'delivery_memo' => $this->input->post('delivery_memo'),
                            'sale_type' => $this->input->post('sale_type'),
                            // 'duedate' => $this->input->post('due_date'),
                            'no_ofproducts' => $this->input->post('no_product'),
                            'base_total' => $this->input->post('base_total'),
                            'total_discount' => $this->input->post('total_discount'),
                            'gross_total' => $this->input->post('gross_total'),
                            'total_tax' => $this->input->post('total_taxvalue'),
                            'total_amt' => $this->input->post('total_amt'),
                            'adjustment' => $this->input->post('adjustment'),
                            'total_invoice' => $this->input->post('total_invoice'),
                            'invoice_type' => $this->input->post('salesinvoicetype'),
                            'invoice_status' => "Credit Sales",
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
                        );
            // echo "<pre>"; print_r($data); exit();
	        
            $created_id = $this->model_salesinvoice->create($data);
            // $created_id = '1';
            
            if($created_id) {

                // #####################################################
                // Create Ledger start

                // SALES LEDGER
                $salesLedgerData = $this->model_ledger->fecthDataByID($_POST['saccount']);
                $updateSalesLedgerAmt = $salesLedgerData['closing_balance'] - $_POST['total_invoice'];
                // $updateSalesLedgerAmt = abs($updateSalesLedger);

                // update sales Ledger
                $salesLedgerDataUpdate = array(
                                                'id' => $salesLedgerData['id'],
                                                'opening_balance' => $salesLedgerData['closing_balance'],
                                                'closing_balance' => $updateSalesLedgerAmt
                                            );

                // Add Data to Sales Ledger Table
                $salesLedger = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $salesLedgerData['id'],
                                        'invoice_date' => $_POST['date'],
                                        'entry_date' => $_POST['date'],
                                        'purchase_type' => $_POST['salesinvoicetype'],
                                        'dr_cr' => 'DR',
                                        'amt' => abs($_POST['total_invoice']),
                                        'opening_bal' => $salesLedgerData['closing_balance'],
                                        'closing_bal' => $updateSalesLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                
                // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($salesLedger);
                // update purchase ledger data
                $this->model_ledger->update($salesLedgerDataUpdate);

                if($_POST['account'] != 61 && $_POST['account'] != 2625)
                {
                    // ACCOUNT LEDGER
                    $accountLedgerData = $this->model_ledger->fecthDataByID($_POST['account']);
                    $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] - $_POST['total_invoice'];
                    
                    $accountLedgerDataUpdate = array(
                                                        'id' => $accountLedgerData['id'],
                                                        'opening_balance' => $accountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateAccountLedgerAmt
                                                    );
    
                    $accountLedger = array(
                                            'purchase_id' => $created_id,
                                            'ledger_id' => $accountLedgerData['id'],
                                            'invoice_date' => $_POST['date'],
                                            'entry_date' => $_POST['date'],
                                            'purchase_type' => $_POST['salesinvoicetype'],
                                            'dr_cr' => 'DR',
                                            'amt' => abs($_POST['total_invoice']),
                                            'opening_bal' => $accountLedgerData['closing_balance'],
                                            'closing_bal' => $updateAccountLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                        );
                    
                    $this->model_purchaseledger->create($accountLedger);
                    $this->model_ledger->update($accountLedgerDataUpdate);
                }

                // GST LEDGER
                // echo "gts"; print_r($gst);
                $gstLedgerData = $this->model_ledger->fecthDataByID($_POST['sale_type']);
                $updateGstLedgerAmt = $gstLedgerData['closing_balance'] + $_POST['total_taxvalue'];
                // $updateGstLedgerAmt = abs($updateGstLedger);
                // update account Ledger
                $gstLedgerDataUpdate = array(
                                                'id' => $gstLedgerData['id'],
                                                'opening_balance' => $gstLedgerData['closing_balance'],
                                                'closing_balance' => $updateGstLedgerAmt
                                            );
                // Add Data to Sales Ledger Table
                $gstLedger = array(
                                    'purchase_id' => $created_id,
                                    'ledger_id' => $gstLedgerData['id'],
                                    'invoice_date' => $_POST['date'],
                                    'entry_date' => $_POST['date'],
                                    'purchase_type' => $_POST['salesinvoicetype'],
                                    'dr_cr' => 'CR',
                                    'amt' => abs($_POST['total_taxvalue']),
                                    'opening_bal' => $gstLedgerData['closing_balance'],
                                    'closing_bal' => $updateGstLedgerAmt,
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                $this->model_purchaseledger->create($gstLedger);
                // update account ledger data
                $this->model_ledger->update($gstLedgerDataUpdate);

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedgerAmt = $discountLedgerData['closing_balance'] + $_POST['adjustment'];

                    // update purchase Ledger
                    $discountLedgerDataUpdate = array(
                                                        'id' => $discountLedgerData['id'],
                                                        'opening_balance' => $discountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateDiscountLedgerAmt
                                                    );
                    $discountLedger = array(
                                    'purchase_id' => $created_id,
                                    'ledger_id' => $discountLedgerData['id'],
                                    'invoice_date' => $_POST['date'],
                                    'entry_date' => $_POST['date'],
                                    'purchase_type' => $_POST['salesinvoicetype'],
                                    'dr_cr' => 'CR',
                                    'amt' => abs($_POST['adjustment']),
                                    'opening_bal' => $discountLedgerData['closing_balance'],
                                    'closing_bal' => $updateDiscountLedgerAmt,
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );

                    $this->model_purchaseledger->create($discountLedger);
                    // update purchase ledger data
                    $this->model_ledger->update($discountLedgerDataUpdate);
                }

                // exit;
                // Create Ledger end
                // #####################################################

                $count_product = count($_POST['productlist']);

                for($i=0; $i<$count_product; $i++)
                {
                    $comm = $comm + $this->input->post('comm')[$i];
                    $data = array(
                                    'ledgerid' => $this->input->post('salesman'),
                                    'barcode' => $this->input->post('productlist')[$i],
                                    'price' => $this->input->post('grossplist')[$i],
                                    'percentage' => $this->input->post('salesmancomm')[$i],
                                    'comm' => $this->input->post('comm')[$i],
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                    // echo "<pre>"; print_r($data);
                    $this->model_comm->createSalesmanComm($data);

                	$voucherData = array(
                                    'voucher_id' => $created_id,
                                    'voucher_type' => $this->input->post('salesinvoicetype'),
                                    'product_name' => $this->input->post('productlist')[$i],
                                    'quantity' => $this->input->post('qtylist')[$i],
                                    'mrp' => $this->input->post('mrplist')[$i],
                                    'gross_price' => $this->input->post('grossplist')[$i],
                                    'unit' => $this->input->post('unitdemo')[$i],
                                    'discount' => $this->input->post('discountlist')[$i],
                                    'discountValue' => $this->input->post('discountVlist')[$i],
                                    'gst_id' => $this->input->post('gstid')[$i],
                                    'gstvalue' => $this->input->post('gstname')[$i],
                                    'total_tax' => $this->input->post('taxlist')[$i],
                                    'total' => $this->input->post('totlist')[$i],
		                            'sales_status' => "Credit Sales",
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );

                    // echo "<pre>"; print_r($voucherData);
                    $this->model_vouchers->create($voucherData);
                }

                if($comm > 0)
                {    
                    $ledgerData = $this->model_ledger->fecthDataByID($this->input->post('salesman'));
                    // echo "<pre>"; print_r($ledgerData);
                    
                    $salesmanClosingBal = $ledgerData['closing_balance'] != '' ? $ledgerData['closing_balance'] : 0;
                    $amt = $ledgerData['closing_balance'] + $comm; 
                   
                    $salesmanLedger = array(
                                                'id' => $ledgerData['id'],
                                                'opening_balance' => $salesmanClosingBal,
                                                'closing_balance' => $amt
                                            );
                    // Add Data to Purchase Ledger Table
                    $salesmanCommLedger = array(
                                                    'purchase_id' => $created_id,
                                                    'ledger_id' => $ledgerData['id'],
                                                    'purchase_type' => $_POST['salesinvoicetype'],
                                                    'invoice_date' => $_POST['date'],
                                                    // 'entry_date' => $_POST['entry_date'],
                                                    'dr_cr' => 'CR',
                                                    'amt' => $comm,
                                                    'opening_bal' => $salesmanClosingBal,
                                                    'closing_bal' => $amt,
                                                    'company_id' => $this->session->userdata('wo_company'),
                                                    // 'city_id' => $this->session->userdata('wo_city'),
                                                    'store_id' => $this->session->userdata('wo_store'),
                                                    'created_by' => $this->session->userdata('wo_id')
                                                );
                                
                    $this->model_purchaseledger->create($salesmanCommLedger);
                    // update purchase ledger data
                    $this->model_ledger->update($salesmanLedger);
                }

                
                if(isset($_POST['payment']))
                {
                    // echo "Redirect to Make Payment page";
                    return redirect('sales_invoice/makePayment/'.$created_id);
                }
                else if(isset($_POST['hold']))
                {
                    $data = array(
                                    'id' => $created_id,
                                    'invoice_status' => "Hold"
                                );
                    
                    $this->model_salesinvoice->update($data);
                    
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('sales_invoice');
                }
                else
                {
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('sales_invoice');
                }
            }
            else
            {
            	$this->session->set_flashdata('feedback','Unable to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                
                return redirect('sales_voucher/create');
            }
	    }
	    else
	    {
	    	$orderno = $this->model_salesvoucher->lastrecord();

            if($orderno == '')
            {
                $code  = '00000001';
                $this->data['orderno'] = $code;
            }
            else
            {
                $np = $orderno['order_no'];
                $code = substr($np, 1); 
                
                $code = $code + 1;
                $order_no = sprintf('%08d',$code);
                
                $this->data['orderno'] = $order_no;
            }

	        $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();

            $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['deliveryMemo'] = $this->model_deliverymemo->fecthAllData();
            $this->data['productData'] = $this->model_sku->fecthSkuAllData();
            $this->data['unit'] = $this->model_unit->fecthAllData();
            $this->data['gst'] = $this->model_gst->fecthAllData();

    		$this->render_template('admin_view/salesMaster/salesVoucher/create', $this->data);
	    }
	}


	public function update()
	{
	    $this->form_validation->set_rules('id', 'Invoice Id', 'trim|required');
	    $this->form_validation->set_rules('order_no', 'Invoice Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	    
	        // echo "<pre>"; print_r($_POST); echo "<br>"; exit();

	        $data = array(
                            'id' => $this->input->post('id'),
                            'inventory_no' => $this->input->post('order_no'),
                            'date' => $this->input->post('date'),
                            'sales_account' => $this->input->post('saccount'),
                            'account' => $this->input->post('account'),
                            'salesman' => $this->input->post('salesman'),
                            'shipping_details' => $this->input->post('shipping_details'),
                            'shipping_type' => $this->input->post('shipping_type'),
                            'division' => $this->input->post('division'),
                            // 'branch' => $this->input->post('branch'),
                            'location' => $this->input->post('location'),
                            'delivery_memo' => $this->input->post('delivery_memo'),
                            'sale_type' => $this->input->post('sale_type'),
                            // 'duedate' => $this->input->post('due_date'),
                            'no_ofproducts' => $this->input->post('no_product'),
                            'base_total' => $this->input->post('base_total'),
                            'total_discount' => $this->input->post('total_discount'),
                            'gross_total' => $this->input->post('gross_total'),
                            'total_tax' => $this->input->post('total_tax'),
                            'total_amt' => $this->input->post('total_amt'),
                            'adjustment' => $this->input->post('adjustment'),
                            'total_invoice' => $this->input->post('total_invoice'),
                            'invoice_status' => "Credit Sales",
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'modified_by' => $this->session->userdata('wo_id')
                        );
            // echo "<pre>"; print_r($data); exit();
	        
	         $created_id = $this->model_salesinvoice->update($data);
            // $created_id = '1';

            if($created_id) {
                
                $type = "voucher";
		    
		        $this->model_purchaseledger->deletePurchaseID($this->input->post('id'), $type);
		    
		        // SALES LEDGER
                $salesLedgerData = $this->model_ledger->fecthDataByID($this->input->post('saccount'));
                $updateSalesLedgerAmt = $salesLedgerData['closing_balance'] - $this->input->post('total_invoice');
                // $updateSalesLedgerAmt = abs($updateSalesLedger);

                // update sales Ledger
                $salesLedgerDataUpdate = array(
                                                'id' => $salesLedgerData['id'],
                                                'opening_balance' => $salesLedgerData['closing_balance'],
                                                'closing_balance' => $updateSalesLedgerAmt
                                            );

                // Add Data to Sales Ledger Table
                $salesLedger = array(
                                        'purchase_id' => $this->input->post('id'),
                                        'ledger_id' => $salesLedgerData['id'],
                                        'invoice_date' => $this->input->post('date'),
                                        'entry_date' => $this->input->post('date'),
                                        'purchase_type' => 'voucher',
                                        'dr_cr' => 'DR',
                                        'amt' => abs($this->input->post('total_invoice')),
                                        'opening_bal' => $salesLedgerData['closing_balance'],
                                        'closing_bal' => $updateSalesLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                
                // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($salesLedger);
                // update purchase ledger data
                $this->model_ledger->update($salesLedgerDataUpdate);

                if($_POST['account'] != 61 && $_POST['account'] != 2625)
                {
                    // ACCOUNT LEDGER
                    $accountLedgerData = $this->model_ledger->fecthDataByID($this->input->post('account'));
                    $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] - $this->input->post('total_invoice');
                    
                    $accountLedgerDataUpdate = array(
                                                        'id' => $accountLedgerData['id'],
                                                        'opening_balance' => $accountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateAccountLedgerAmt
                                                    );
    
                    $accountLedger = array(
                                            'purchase_id' => $this->input->post('id'),
                                            'ledger_id' => $accountLedgerData['id'],
                                            'invoice_date' => $this->input->post('date'),
                                            'entry_date' => $this->input->post('date'),
                                            'purchase_type' => 'voucher',
                                            'dr_cr' => 'DR',
                                            'amt' => abs($this->input->post('total_invoice')),
                                            'opening_bal' => $accountLedgerData['closing_balance'],
                                            'closing_bal' => $updateAccountLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                        );
                    
                    $this->model_purchaseledger->create($accountLedger);
                    $this->model_ledger->update($accountLedgerDataUpdate);
                }

                // GST LEDGER
                // echo "gts"; print_r($gst);
                $gstLedgerData = $this->model_ledger->fecthDataByID($this->input->post('sale_type'));
                $updateGstLedgerAmt = $gstLedgerData['closing_balance'] + $this->input->post('total_tax');
                // $updateGstLedgerAmt = abs($updateGstLedger);
                // update account Ledger
                $gstLedgerDataUpdate = array(
                                                'id' => $gstLedgerData['id'],
                                                'opening_balance' => $gstLedgerData['closing_balance'],
                                                'closing_balance' => $updateGstLedgerAmt
                                            );
                // Add Data to Sales Ledger Table
                $gstLedger = array(
                                    'purchase_id' => $this->input->post('id'),
                                    'ledger_id' => $gstLedgerData['id'],
                                    'invoice_date' => $this->input->post('date'),
                                    'entry_date' => $this->input->post('date'),
                                    'purchase_type' => 'voucher',
                                    'dr_cr' => 'CR',
                                    'amt' => abs($this->input->post('total_tax')),
                                    'opening_bal' => $gstLedgerData['closing_balance'],
                                    'closing_bal' => $updateGstLedgerAmt,
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                $this->model_purchaseledger->create($gstLedger);
                // update account ledger data
                $this->model_ledger->update($gstLedgerDataUpdate);

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedgerAmt = $discountLedgerData['closing_balance'] + $this->input->post('adjustment');

                    // update purchase Ledger
                    $discountLedgerDataUpdate = array(
                                                        'id' => $discountLedgerData['id'],
                                                        'opening_balance' => $discountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateDiscountLedgerAmt
                                                    );
                    $discountLedger = array(
                                    'purchase_id' => $this->input->post('id'),
                                    'ledger_id' => $discountLedgerData['id'],
                                    'invoice_date' => $this->input->post('date'),
                                    'entry_date' => $this->input->post('date'),
                                    'purchase_type' => 'voucher',
                                    'dr_cr' => 'CR',
                                    'amt' => abs($this->input->post('adjustment')),
                                    'opening_bal' => $discountLedgerData['closing_balance'],
                                    'closing_bal' => $updateDiscountLedgerAmt,
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );

                    $this->model_purchaseledger->create($discountLedger);
                    // update purchase ledger data
                    $this->model_ledger->update($discountLedgerDataUpdate);
                }
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
                
                if($_POST['payment'])
                {
                    // echo "Redirect to Make Payment Page";
                    return redirect('sales_invoice/makePayment/'.$this->input->post('id'));
                }
                else if($_POST['hold'])
                {
                    $data = array(
                                    'id' => $this->input->post('id'),
                                    'invoice_status' => "Hold"
                                );
                                
                    $this->model_salesinvoice->update($data);
                    
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('sales_invoice');
                }
                else
                {
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('sales_invoice');   
                }
            }
            else
            {
            	$this->session->set_flashdata('feedback','Unable to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                
                return redirect('sales_voucher/update/'.$this->input->post('id'));
            }
	    }
	    else
	    {
	    	$id = $this->uri->segment(3);

	    	$this->data['allData'] = $this->model_salesinvoice->fecthAllDataByID($id);

	    	$data = array(
	    					'voucher_id' => $id,
	    					'voucher_type' => 'voucher'
	    				);

            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();

	    	$this->data['voucherData'] = $this->model_vouchers->fecthAllDatabyVoucherID($data);
 
	        $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();
        

            // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData();


            $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();
        
            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['deliveryMemo'] = $this->model_deliverymemo->fecthAllData();
            $this->data['productData'] = $this->model_sku->fecthSkuAllData();
            $this->data['unit'] = $this->model_unit->fecthAllData();
            $this->data['gst'] = $this->model_gst->fecthAllData();

    		$this->render_template('admin_view/salesMaster/salesVoucher/update', $this->data);
	    }
	}

	public function delete()
    {
        $id = $this->uri->segment(3);
        
        $data = array(
                        'voucher_id' => $this->uri->segment(3),
                        'voucher_type' => $this->uri->segment(4)
                    );

        // echo "<pre>";        print_r($data); exit();
        $delete = $this->model_salesinvoice->delete($id);

        if($delete == true) {
            
            $type = "voucher";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);

        	$voucherData = $this->model_vouchers->fecthAllDatabyVoucherID($data);

	        foreach ($voucherData as $key => $value) {
	          	
	        	// echo "<pre>"; echo $value['id'];
        		$this->model_vouchers->delete($value['id']); 
	        }  

            $this->session->set_flashdata('feedback','Record Deleted Successfully');
            $this->session->set_flashdata('feedback_class','alert alert-success');

            return redirect('sales_invoice');
        }
        else{

            $this->session->set_flashdata('feedback','Unable to Delete Record');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            
            return redirect('sales_invoice');
        }
    }
    
    // public function makePayment()
    // {   
    //     $id = $this->uri->segment(3);
    //     // echo $id;
        
    //     $this->form_validation->set_rules('paid', 'Paid Amount', 'trim|required');
	    
	   // if ($this->form_validation->run() == TRUE) {
	        
	   //     echo "<pre>"; print_r($_POST);
	        
	        
	   // }
	   // else
	   // {
	   //     $this->data['id'] = $id;
	    
    // 	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    // 	    $this->data['allData'] = $this->model_salesinvoice->fecthAllDataByID($id);
    	    
    // 	    $this->render_template('admin_view/salesMaster/salesInvoice/makePayment', $this->data);
	   // }
    // }

    public function report()
    {
        $id = $this->uri->segment(3);

        $company_id = $this->session->userdata['wo_company'];
        $companyDetails = $this->model_company->fecthDataByID($company_id);

        $cityData = $this->model_state->fecthCityByID($companyDetails['city']);

        $invoiceData = $this->model_salesinvoice->fecthAllDataByID($id);

        $data = array(
                        'voucher_id' => $id,
                        'voucher_type' => 'voucher'
                    );

        $itemData = $this->model_vouchers->fecthAllDatabyVoucherID($data);

        $customerData = $this->model_ledger->fecthAllDatabyID($invoiceData['account']);

        $salesType = $this->model_ledger->fecthAllDatabyID($invoiceData['sale_type']);
        $deliverymemo = $this->model_deliverymemo->fecthAllDataByID($invoiceData['delivery_memo']);

        // echo "<pre>"; print_r($itemData); exit();

        $html = '<!-- Main content -->
            <!DOCTYPE html>
            <html>
            <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <title>Invoice</title>
              <!-- Tell the browser to be responsive to screen width -->
              <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
              <!-- Bootstrap 3.3.7 -->
              <link rel="stylesheet" href="'.base_url('assets/admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
              <!-- Font Awesome -->
              <link rel="stylesheet" href="'.base_url('assets/admin_assets/bower_components/font-awesome/css/font-awesome.min.css').'">
              <link rel="stylesheet" href="'.base_url('assets/admin_assets/dist/css/AdminLTE.min.css').'">

                <style>
                    .pl15
                    {
                      padding-left: 15px;
                    }
                    .myBorder
                    {
                        border : 1px solid #000;
                    }
                    .topBorder
                    {
                        border-top : 1px solid #000;
                    }
                    .bottomBorder
                    {
                        border-bottom : 1px solid #000;
                    }
                    .leftBorder
                    {
                        border-left : 1px solid #000;
                    }
                    .rightBorder
                    {
                        border-right : 1px solid #000;
                    }                       
                </style>

            </head>
            <body onload="window.print();">
            <div>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table border="1" width="100%">
                                            <tr>
                                                <td>
                                                    <center>
                                                        <h4><b>'.strtoupper($companyDetails['company_name']).'</b></h4>
                                                        <h5>Nagpur-Main</h5>
                                                        <h6>'.ucwords($companyDetails['address1']).' '.ucwords($cityData['city_name']).' '.ucwords($companyDetails['pincode']).' '.ucwords($companyDetails['mobile_no']).'</h6>
                                                        <h6>GST No : '.ucwords($companyDetails['gst']).' &  PAN No : '.ucwords($companyDetails['pan']).'</h6>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <h5><b> Tax Invoice </b></h5>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="col-md-6">
                                                        <table width="100%">
                                                          <tr>
                                                            <td width="100px">
                                                              <b>Bill No :-</b>
                                                            </td>
                                                            <td>'.$invoiceData['inventory_no'].'</td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Bill Date :-</b></td>
                                                            <td>'.date("d-m-Y", strtotime($invoiceData['date'])).'</td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table width="100%">
                                                          <tr>
                                                            <td><b>Sales Type :-</b></td>
                                                            <td>'.$salesType['ledger_name'].'</td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <b>Salesman Code :-</b>
                                                            </td>
                                                            <td>&nbsp;</td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <b>Shipping Type :-</b>
                                                            </td>
                                                            <td>'.$invoiceData['shipping_type'].'</td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <b>Courier No :-</b>
                                                            </td>
                                                            <td>&nbsp;</td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="pl15">Name , Address & GSTIN of the Recipient</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="col-md-6">
                                                        <table width="100%">
                                                          <tr>
                                                            <td width="100px">
                                                              <b>Name :-</b>
                                                            </td>
                                                            <td>'.$customerData['ledger_name'].'</td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Address :-</b></td>
                                                            <td>'.$customerData['address_1'].',<br><span style="padding-left: 60px;">'.$customerData['city'].' '.$customerData['state'].'</span></td>
                                                          </tr>
                                                          <tr>
                                                            <td width="100px">
                                                              <b>GST No :-</b>
                                                            </td>
                                                            <td>'.$customerData['gst'].'</td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Sale Memo :-</b></td>
                                                            <td>'.$deliverymemo['delivery_no'].'</td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table width="100%">
                                                          <tr>
                                                            <td><b>Payment Type :-</b></td>
                                                            <td>Credit</td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <b>Payment Details :-</b>
                                                            </td>
                                                            <td></td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <b>Shipping Address :-</b>
                                                            </td>
                                                            <td></td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <b>Sale Order No :-</b>
                                                            </td>
                                                            <td></td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" align="center">
                                                        <tr>
                                                            <th class="myBorder" width="70px">&nbsp; Sr No.</th>
                                                            <th class="myBorder">&nbsp; Product Name</th>
                                                            <td class="myBorder">&nbsp; QTY</td>
                                                            <th class="myBorder">&nbsp; MRP</th>
                                                            <th class="myBorder">&nbsp; DISC.</th>
                                                            <th class="myBorder">&nbsp; SGST</th>
                                                            <th class="myBorder">&nbsp; CGST</th>
                                                            <th class="myBorder">&nbsp; IGST</th>
                                                            <th class="myBorder">&nbsp; GST Amt.</th>
                                                            <th class="myBorder">&nbsp; Gross Amt.</th>
                                                        </tr>';

                                                        $qty=$subtotal=$discount=$tsgst=$tcgst=$tigst=$totalValue=0; $no=1;

                                                        foreach($itemData as $rows)
                                                        {
                                                            $gstData = $this->model_gst->fetchAllDataByID($rows['gst_id']);
                                                            
                                                            // $per = 100;
                                                            
                                                            // $perSGST = $per + $gstData['sgst'];
                                                            // $perCGST = $per + $gstData['cgst'];
                                                            // $perIGST = $per + $gstData['igst'];
                                                            
                                                            // $bsgst = ($rows['mrp'] * $gstData['sgst']) / $perSGST;
                                                            // $bcgst = ($rows['mrp'] * $gstData['cgst']) / $perCGST;
                                                            // $bigst = ($rows['mrp'] * $gstData['igst']) / $perIGST;
                                                            
                                                            // $gpsgst = $rows['mrp'] - $bsgst;
                                                            // $gpcgst = $rows['mrp'] - $bcgst;
                                                            // $gpigst = $rows['mrp'] - $bigst;
                                                            
                                                            // $dsgst = ($gpsgst * $gstData['sgst']) / $perSGST;
                                                            // $sgst = number_format($dsgst, 3);
                                                            
                                                            // $dcgst = ($gpcgst * $gstData['cgst']) / $perCGST;
                                                            // $cgst = number_format($dcgst);
                                                            
                                                            // $digst = ($gpigst * $gstData['igst']) / $perIGST;
                                                            // $igst = number_format($digst);

    
    
                                                            $sgst = ($rows['mrp'] * $gstData['sgst']) / 100;
                                                            $cgst = ($rows['mrp'] * $gstData['cgst']) / 100;
                                                            $igst = ($rows['mrp'] * $gstData['igst']) / 100;

                                                            $qty = $qty + $rows['quantity'];
                                                            $subtotal = $subtotal + $rows['total'];

                                                            $tsgst = $tsgst + $sgst;
                                                            $tcgst = $tcgst + $cgst;
                                                            $tigst = $tigst + $igst;

                                                            $html.='<tr>
                                                                        <td class="myBorder">&nbsp; '.$no.'</td>
                                                                        <td class="myBorder">&nbsp; '.$rows['product_name'].'</td>
                                                                        <td class="myBorder">&nbsp; '.$rows['quantity'].'</td>
                                                                        <td class="myBorder">&nbsp; '.$rows['mrp'].'</td>
                                                                        <td class="myBorder">&nbsp; ('.$rows['discount'].' % )'.number_format($rows['discountValue'], 3).'</td>
                                                                        <td class="myBorder">&nbsp; ('.$gstData['sgst'].') '.($rows['gst_id'] != '' ? $sgst : "0").'</td>

                                                                        <td class="myBorder">&nbsp; ('.$gstData['cgst'].') '.($rows['gst_id'] != '' ? $cgst : "0").'</td>

                                                                        <td class="myBorder">&nbsp; ('.$gstData['igst'].') '.($rows['gst_id'] != '' ? $igst : "0").'</td>

                                                                        <td class="myBorder">&nbsp; '.($totgst = $sgst + $cgst + $igst).'</td>

                                                                        <td class="myBorder">&nbsp; '.($rows['total'] - $totgst).'</td>
                                                                    </tr>';
                                                            $no++;

                                                            $totalValue = $totalValue + $rows['total'] - $totgst;
                                                        }

                                                $html.='<tr>
                                                            <td class="myBorder" colspan="1">&nbsp;</td>
                                                            <td class="myBorder">&nbsp; Total</td>
                                                            <td class="myBorder">&nbsp; '.$qty.'</td>
                                                            <td class="myBorder" colspan="5">&nbsp;</td>
                                                            <td class="myBorder"><b>&nbsp; Subtotal:-</b></td>
                                                            <td class="myBorder"><b>&nbsp; '.$totalValue.'</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="myBorder" colspan="8">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td>
                                                                            <div class="pl15">
                                                                            <h5>
                                                                                <b><u>Bank Details</u> :-</b>
                                                                            </h5>
                                                                            <p>
                                                                                <span><b>Name :- </b></span> Bank of Maharashtra AC No 60263398967 <br>
                                                                                <span><b>IFSC :- </b></span>MAHB000061 <br>
                                                                                <span><b>Swift Code :- </b></span> 000000 <br>
                                                                                <span><b>Address :- </b></span> Shreeji Krupa,Central Avenue,Gandhibagh
                                                                            </p>
                                                                      </div>
                                                                    </td>
                                                                  </tr>
                                                              </table>
                                                            </td>
                                                            <td class="myBorder" width="110px">
                                                                <table width="100%" border="1">
                                                                    <tr>
                                                                        <td>Discount</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>SGST</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CGST</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>IGST</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td>Adjustment</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td>Cash</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td>Tender Change</td>
                                                                      </tr>
                                                                </table>
                                                            </td>
                                                            <td class="myBorder" width="100px">
                                                                <table width="100%" border="1">
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.$discount.'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.$tsgst.'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.$tcgst.'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.$tigst.'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.$invoiceData['adjustment'].'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.$discount.'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">0</td>
                                                                  </tr>
                                                                  
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                          <td class="myBorder" colspan="8">
                                                            <div class="pl15">
                                                              <p><b>IN WORDS : '.$this->number_to_word->convert_number(number_format($invoiceData['total_invoice'])).'</b></p>
                                                            </div>
                                                          </td>
                                                          <td class="myBorder">
                                                            <div class="pl15"><b>Grand Total</b></div>
                                                          </td>
                                                          <td class="myBorder" style="text-align: right; padding-right: 5px">'.$invoiceData['total_invoice'].'</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </body>
    </html>';
              echo $html;
    }
	


    public function reportPOS()
    {
        $id = $this->uri->segment(3);

        $company_id = $this->session->userdata['wo_company'];
        $companyDetails = $this->model_company->fecthDataByID($company_id);

        $cityData = $this->model_state->fecthCityByID($companyDetails['city']);

        $invoiceData = $this->model_salesinvoice->fecthAllDataByID($id);

        $data = array(
                        'voucher_id' => $id,
                        'voucher_type' => 'voucher'
                    );

        $itemData = $this->model_vouchers->fecthAllDatabyVoucherID($data);

        // echo "<pre>"; print_r($invoiceData); exit();
        // echo "<pre>"; print_r($itemData); exit();

        $salesType = $this->model_ledger->fecthAllDatabyID($invoiceData['sale_type']);
        $deliverymemo = $this->model_deliverymemo->fecthAllDataByID($invoiceData['delivery_memo']);

        $gstAllData = $this->model_gst->fecthAllData();

        // $this->render_template('admin_view/salesMaster/salesInvoice/reportPOS', $this->data);

        $html = '<!-- Main content -->
            <!DOCTYPE html>
            <html>
            <head>
              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <title>Invoice</title>
              <!-- Tell the browser to be responsive to screen width -->
              <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
              <!-- Bootstrap 3.3.7 -->
              <link rel="stylesheet" href="'.base_url('assets/admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
              <!-- Font Awesome -->
              <link rel="stylesheet" href="'.base_url('assets/admin_assets/bower_components/font-awesome/css/font-awesome.min.css').'">
              <link rel="stylesheet" href="'.base_url('assets/admin_assets/dist/css/AdminLTE.min.css').'">

                <style>
                    .pl15
                    {
                      padding-left: 15px;
                    }
                    .myBorder
                    {
                        border : 1px solid #000;
                    }
                    .topBorder
                    {
                        border-top : 1px solid #000;
                    }
                    .bottomBorder
                    {
                        border-bottom : 1px solid #000;
                    }
                    .leftBorder
                    {
                        border-left : 1px solid #000;
                    }
                    .rightBorder
                    {
                        border-right : 1px solid #000;
                    }                       
                </style>

            </head>
            <body onload="window.print();">
            <div>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table border="1" width="100%">
                                            <tr>
                                                <td>
                                                    <center>
                                                        <h4><b>'.strtoupper($companyDetails['company_name']).'</b></h4>
                                                        <h5>Nagpur-Main</h5>
                                                        <h6>'.ucwords($companyDetails['address1']).' '.ucwords($cityData['city_name']).' '.ucwords($companyDetails['pincode']).' '.ucwords($companyDetails['mobile_no']).'</h6>
                                                        <h6>GST No : '.ucwords($companyDetails['gst']).' &  PAN No : '.ucwords($companyDetails['pan']).'</h6>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <h5><b> Tax Invoice </b></h5>
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="col-md-6">
                                                        <table width="100%">
                                                          <tr>
                                                            <td width="100px">
                                                              <b>Bill No :-</b>
                                                            </td>
                                                            <td>'.$invoiceData['inventory_no'].'</td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Bill Date :-</b></td>
                                                            <td>'.date("d-m-Y", strtotime($invoiceData['date'])).'</td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Customer :-</b></td>
                                                            <td>-</td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table width="100%">
                                                          <tr>
                                                            <td><b>Cashier :-</b></td>
                                                            <td>-</td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <b>Salesman Code :-</b>
                                                            </td>
                                                            <td>&nbsp;</td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <th class="myBorder" style="width: 100px">&nbsp; Sr no.</th>
                                                            <th class="myBorder">&nbsp; Description</th>
                                                            <th class="myBorder" style="width: 150px">&nbsp; Qty</th>
                                                            <th class="myBorder" style="width: 200px">&nbsp; Rate</th>
                                                            <th class="myBorder" style="width: 150px">&nbsp; DISC. (%)</th>
                                                            <th class="myBorder" style="width: 200px">&nbsp; GROSS AMOUNT</th>
                                                        </tr>';
                                                    $no=1; 
                                                    $countQty=$subtotal=$dis=$totgst=0;
                                                    foreach($itemData as $rows)
                                                    {
                                                        // for order description
                                    
                                                        // echo "<pre>"; print_r($subcategory);

                                                        $gstData = $this->model_gst->fetchAllDataByID($rows['gst_id']);

                                                        $gst = $gstData['sgst'] + $gstData['cgst'] + $gstData['igst'];

                                                        $calGST = $rows['mrp'] * $gst /100;

                                                        $countQty = $countQty + $rows['quantity'];

                                                        $dis = $dis + $rows['discountValue'];
                                                        $totgst = $totgst + $calGST;

                                                        $subtotal = $subtotal + $rows['mrp'];
                                                        

                                                        $html .= '<tr>
                                                                    <td class="myBorder">&nbsp;'.$no.'</td>
                                                                    <td class="myBorder"><center>'.$rows['product_name'].'</center></td>
                                                                    <td class="myBorder">&nbsp;'.$rows['quantity'].'<br>&nbsp;'.$gst.' % GST</td>
                                                                    <td class="myBorder">&nbsp;'.$rows['mrp'].'<br>&nbsp;GST Amt '.$calGST.'</td>
                                                                    <td class="myBorder">&nbsp;'.number_format($rows['discountValue'], 3).'('.$rows['discount'].')</td>
                                                                    <td class="myBorder">&nbsp;'.($rows['mrp'] - $rows['discountValue'] - $calGST ).'</td>
                                                                </tr>';
                                                    }

                                                $html .= '<tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;Total :- '.$countQty.'</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Subtotal:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.($subtotal - $dis - $totgst).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Discount:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.$dis.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Total GST:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.$totgst.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Round Off Amount:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.$invoiceData['adjustment'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Cash:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.($subtotal - $dis).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Trending Charge:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; 0</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Total Net Due:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.($subtotal - $dis).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">
                                                                <table align="center" width="80%">
                                                                    <tr>
                                                                        <td>&nbsp;TAX Description</td>
                                                                        <td>&nbsp;Amount</td>
                                                                        <td>&nbsp;SGST</td>
                                                                        <td>&nbsp;CGST</td>
                                                                        <td>&nbsp;IGST</td>
                                                                    </tr>';
                                                            $totGrossprice=$totsgst=$totcgst=$totigst=$totAmt=$totsgst=$totcgst=$totigst=0;

                                                            $sgst=$cgst=$igst=0;

                                                            foreach ($gstAllData as $key => $value)
                                                            {
                                                                $data = array(
                                                                                'voucher_id' => $id,
                                                                                'voucher_type' => 'voucher',
                                                                                'gst_id' => $value->id
                                                                            );

                                                                $itemDataForGST = $this->model_vouchers->fecthAllDatabyVoucherIDTypeGST($data);
                                                                // echo "<pre>"; print_r($itemDataForGST);

                                                                $amt=0;
                                                                foreach ($itemDataForGST as $rows)
                                                                {
                                                                    $gstData = $this->model_gst->fetchAllDataByID($rows['gst_id']);

                                                                    $amt = $amt + $rows['total'];
                                                                }

                                                                $sgst = ($amt * $value->sgst) / 100;
                                                                $cgst = ($amt * $value->cgst) / 100;
                                                                $igst = ($amt * $value->igst) / 100;
                                                                $html .= '<tr>
                                                                            <td>'.($amt != 0 ? $value->sgst + $value->cgst + $value->igst : "").'</td>
                                                                            <td>'.($amt != 0 ? $amt : "").'</td>
                                                                            <td>'.($amt != 0 ? $sgst : "").'</td>
                                                                            <td>'.($amt != 0 ? $cgst : "").'</td>
                                                                            <td>'.($amt != 0 ? $igst : "").'</td>
                                                                        </tr>';

                                                                $totAmt = $totAmt + $amt;
                                                                $totsgst = $totsgst + $sgst;
                                                                $totcgst = $totcgst + $cgst;
                                                                $totigst = $totigst + $igst;
                                                            }
                                                                
                                                            $html .= '<tr>
                                                                        <td>&nbsp;Total :- </td>
                                                                        <td>'.$totAmt.'</td>
                                                                        <td>'.$totsgst.'</td>
                                                                        <td>'.$totcgst.'</td>
                                                                        <td>'.$totigst.'</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">
                                                                <center>Total Include of GST Rs. <b> '.($totAmt).' </b> <br>
                                                                    Payment Type : CASH
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 15px;">
                                                  <span>
                                                    <b>
                                                      <u>Declaration :</u>
                                                    </b>
                                                    <p>Certified that the particulars given above are true & correct and the amount indicated represents the price actually charged and there is no flow of additional consideration directly or indirectly from the buyers. </p>
                                                  </span>

                                                  <div>
                                                    <b>
                                                      <u>Terms & Conditions :</u>
                                                    </b><br>
                                                    <span>1. Subject To Nagpur Jurisdiction </span> <br>
                                                    <span>2. No Cancellation/ Exchange or Return of Made to Ordered or Altered Items. </span> <br>
                                                    <span>3. All Applicable Taxes/GST/Levies if/any apart from mentioned above would be Charged Extra at the time of Billing. </span> <br>
                                                    <span>4. Payment to be made on or before due date mentioned here, in favour of M/s. PARAMOUNT TRADING VENTURES ,bank details are given here-in. </span> <br>
                                                    <span>5. Cash Payment Without Original Reciept would be invalid. </span> <br>
                                                    <span>6. Payment against Made to Order or to be Altered product is Non-Refundable. </span> <br>
                                                    <span>7. No Gurantee/Warranty on designs/patterns and color fastness. </span> <br>
                                                    <span>8. Any Manufacturing/Fitting Defect would be resolved by means of Alteration/Repairs. </span> <br>
                                                    <span>9. Committed Delivery date can change,depending upon the prevailing conditions and supplies. </span> <br>
                                                    <span>10. We reserve the right to demand settlement of this invoice bill at any time before due date. </span>
                                                  </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <br>
                                                    &nbsp;
                                                    <span><b>* This is a Computer Generated Document hence no Signature is Required</b></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </body>
    </html>';

              echo $html;
    }



}