<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_invoice extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

        error_reporting(0);

		$this->data['page_title'] = 'Sales Invoice';

        $this->load->library('number_to_word');
		
		$this->load->model('model_ledger');
        $this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
		$this->load->model('model_salesorder');
		$this->load->model('model_deliverymemo');
		
		$this->load->model('model_salesinvoice');

        $this->load->model('model_barcode');
        $this->load->model('model_sku');
        $this->load->model('model_hsn');
        $this->load->model('model_gst');
        $this->load->model('model_unit');
        $this->load->model('model_wsp');

        $this->load->model('model_category');
        $this->load->model('model_company');
        $this->load->model('model_state');
        $this->load->model('model_discount');
        
        $this->load->model('model_comm');
        
        $this->load->model('model_paymentmaster');
        
        $this->load->model('model_ledgerentry');
        
        $this->load->model('model_journalentry');
        $this->load->model('model_purchaseledger');
        $this->load->model('model_salesledger');

        $this->load->model('model_receiptnotes');

        
	}
	
	public function getOrderDataByID()
	{
	    $order_id = $_POST['orderno'];
	    
	    $data = $this->model_salesorder->fecthAllDatabyID($order_id);
	    
	    echo json_encode($data);
	}

    public function getDataByBarcode()
    {
        $barcode = $_POST['barcode'];
        $invoice_id = $_POST['invoice_id'];

        // $barcode = '0000000082';
        // $invoice_id = '141';

        $barcodeData = $this->model_barcode->fetchAllDataByBarcode($barcode);
        // echo "<pre>"; print_r($barcodeData); exit();

        $skuData = $this->model_sku->fecthSkuDataByID($barcodeData['sku_code']);

        $invoiceData = $this->model_salesinvoice->fecthAllDataByID($invoice_id);
        // echo "<pre>"; print_r($invoiceData); exit();

        if($invoiceData == '')
        {
            $result = '';
        }
        else
        {
            if($invoiceData['invoice_type'] == 'voucher')
            {
                echo "Sales Voucher Not allowed";
            }
            else if($invoiceData['invoice_type'] == 'wsp')
            {
                // echo "WSP";
                $data = array(
                                'inventory_id' => $invoiceData['id'],
                                'inventory_type' => $invoiceData['invoice_type'],
                                'pno' => $barcodeData['id']
                            );
                $invoice_data = $this->model_wsp->getSalesInvoiceData($data);
                // echo "<pre>"; print_r($invoice_data);
                $qty = $invoice_data['qty'];
            }
            else
            {
                // echo "POS And Sales Invoice";
                $data = array(
                                'inventory_id' => $invoiceData['id'],
                                'inventory_type' => $invoiceData['invoice_type'],
                                'pno' => $barcodeData['id']
                            );
                $invoice_data = $this->model_salesinvoice->getSalesInvoiceData($data);
                // echo "<pre>"; print_r($invoice_data);
                $qty = $invoice_data['quantity'];
            }
            // exit();
            $gstData = $this->model_gst->fetchAllDataByID($invoice_data['gst']);        

            $result = array(
                            'inventory_id' => $invoice_data['id'],
                            'invoice_type' => $invoice_data['inventory_type'],
                            'pnoid' => $invoice_data['pno'],
                            'pno' => $barcodeData['barcode'],
                            'qty' => $qty,
                            'baseprice' => $invoice_data['baseprice'],
                            'disvalue' => $invoice_data['disvalue'],
                            'grossprice' => $invoice_data['grossprice'],
                            'gst' => $gstData['gst_name'],
                            'gst_amt' => $invoice_data['gstamt'],
                            'salesmancomm' => $invoice_data['salesmancomm'],
                            'finalprice' => $invoice_data['finalprice'],
                            'sku' => $skuData['product_code']
                        );    
        }

        
     
        // echo "<pre>"; print_r($result);
        echo json_encode($result);

        exit();
        // $data = $this->model_salesinvoice->getDataByBarcode($barcode, $invoice_id);
        // echo json_encode($data);
    }

	public function index()
	{
		$this->render_template('admin_view/salesMaster/salesInvoice/index', $this->data);
	}

    public function wsi()
    {
        $this->render_template('admin_view/salesMaster/wsi', $this->data);
    }
	
	public function fetchAllData()
	{
	    $data = $this->model_salesinvoice->fecthAllData();
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
                
                if($value['invoice_type'] == 'voucher')
                {
                    $buttons .= '&nbsp; <a href="'.base_url().'sales_voucher/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                    $buttons .= '&nbsp; <a href="'.base_url().'sales_voucher/delete/'.$value['id'].'/voucher" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';

                    $buttons .= '&nbsp; <a href="'.base_url().'sales_voucher/report/'.$value['id'].'" class="btn btn-sm btn-warning"><i class="fa fa-file-text"></i> Print Invoice</a>';

                    // $buttons .= '&nbsp; <a href="'.base_url().'sales_voucher/reportPOS/'.$value['id'].'" class="btn btn-sm btn-warning"><i class="fa fa-file-text"></i> Print POS</a>';
                
                    $type = 'voucher';
                }
                else
                {
                    $buttons .= '&nbsp; <a href="'.base_url().'sales_invoice/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';

                    $buttons .= '&nbsp; <a href="'.base_url().'sales_invoice/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';

                    $buttons .= '&nbsp; <a href="'.base_url().'sales_invoice/report/'.$value['id'].'" class="btn btn-sm btn-warning"><i class="fa fa-file-text"></i> Print Invoice</a>';

                    $buttons .= '&nbsp; <a href="'.base_url().'sales_invoice/reportPOS/'.$value['id'].'" class="btn btn-sm btn-warning"><i class="fa fa-file-text"></i> Print POS</a>';
                
                    $type = 'invoice';
                }

                
                
                $result['data'][$key] = array(
                                                $no,
                                                $value['inventory_no'],
                                                $value['date'],
                                                $value['total_invoice'],
                                                $value['invoice_status'],
                                                ucwords($type),
                                                $buttons
                                            );
                                            
                $no++;
            }
        }
        // print_r($result);
        echo json_encode($result);
        exit;
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
	    $this->form_validation->set_rules('inventory_no', 'Invoice Number', 'trim|required');
	    
        $this->form_validation->set_rules('saccount','Sales Account','required|callback_check_defaultsaccount');
        $this->form_validation->set_message('check_defaultsaccount', 'Select Sales Account');

        $this->form_validation->set_rules('account','Sales Account','required|callback_check_defaultaccount');
        $this->form_validation->set_message('check_defaultaccount', 'Select Account');

        $this->form_validation->set_rules('sales_type','GST Type','required|callback_check_defaultgst');
        $this->form_validation->set_message('check_defaultgst', 'Select Account');

	    if ($this->form_validation->run() == TRUE) {
	       
            // echo "<pre>"; print_r($_POST); //exit();
            
            $invoiceDate = date("Y-m-d", strtotime($this->input->post('date')));

            $data = array(
    					'inventory_no' => $this->input->post('inventory_no'),
    					'date' => $invoiceDate,
    					'sales_account' => $this->input->post('saccount'),
    					'account' => $this->input->post('account'),
    					'salesman' => $this->input->post('salesman'),
    					'shipping_details' => $this->input->post('shiping_details'),
    					'shipping_type' => $this->input->post('shiping_type'),
    					'division' => $this->input->post('division'),
    					// 'branch' => $this->input->post('branch'),
    					'location' => $this->input->post('location'),
    					'delivery_memo' => $this->input->post('delivery_memo'),
    					'sale_type' => $this->input->post('sales_type'),
    					'no_ofproducts' => $this->input->post('no_ofproduct'),
    					'base_total' => $this->input->post('base_total'),
    					'total_discount' => $this->input->post('total_discount'),
    					'gross_total' => $this->input->post('gross_total'),
    					'total_tax' => $this->input->post('total_tax'),
    					'total_amt' => $this->input->post('total_amt'),
    					'adjustment' => $this->input->post('adjustment'),
    					'total_invoice' => $this->input->post('total_invoice'),
    					'invoice_type' => $this->input->post('salesinvoicetype'),
    					'invoice_status' => "Credit Sale",
    					'salesorder_id' => $this->input->post('orderno'),
    					'company_id' => $this->session->userdata('wo_company'),
    					// 'city_id' => $this->session->userdata('wo_city'),
    					'store_id' => $this->session->userdata('wo_store'),
    					'created_by' => $this->session->userdata('wo_id')
    				); 
	        
	        
	        // echo "<pre>"; print_r($data); exit();
            $created_id = $this->model_salesinvoice->create($data);
            // $created_id = 1;

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
                                        'invoice_date' => $invoiceDate,
                                        'entry_date' => $invoiceDate,
                                        'purchase_type' => $_POST['salesinvoicetype'],
                                        'dr_cr' => 'CR',
                                        'amt' => $_POST['total_invoice'],
                                        'opening_bal' => $salesLedgerData['closing_balance'],
                                        'closing_bal' => $updateSalesLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // echo "Sales Account <pre>"; print_r($salesLedgerDataUpdate);
                // echo "<pre>"; print_r($salesLedger); exit();

                // // // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($salesLedger);
                // // update purchase ledger data
                $this->model_ledger->update($salesLedgerDataUpdate);


                if($_POST['account'] != 61 && $_POST['account'] != 2625)
                {
                    // ACCOUNT LEDGER
                    $accountLedgerData = $this->model_ledger->fecthDataByID($_POST['account']);
                    $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] - $_POST['total_invoice'];
                    // $updateAccountLedgerAmt = abs($updateAccountLedger);
                    // update account Ledger
                    $accountLedgerDataUpdate = array(
                                                        'id' => $accountLedgerData['id'],
                                                        'opening_balance' => $accountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateAccountLedgerAmt
                                                    );
    
                    // Add Data to Sales Ledger Table
                    $accountLedger = array(
                                                'purchase_id' => $created_id,
                                                'ledger_id' => $accountLedgerData['id'],
                                                'invoice_date' => $invoiceDate,
                                                'entry_date' => $invoiceDate,
                                                'purchase_type' => $_POST['salesinvoicetype'],
                                                'dr_cr' => 'DR',
                                                'amt' => $_POST['total_invoice'],
                                                'opening_bal' => $accountLedgerData['closing_balance'],
                                                'closing_bal' => $updateAccountLedgerAmt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                            );
                    // echo "Party Account <pre>"; print_r($accountLedgerDataUpdate);
                    // echo "<pre>"; print_r($accountLedger); //exit();
                    // exit();
                    $this->model_purchaseledger->create($accountLedger);
                    $this->model_ledger->update($accountLedgerDataUpdate);    
                }
                

                // GST LEDGER
                // echo "gts"; print_r($gst);
                $gstLedgerData = $this->model_ledger->fecthDataByID($_POST['sales_type']);
                $updateGstLedgerAmt = $gstLedgerData['closing_balance'] + $_POST['total_tax'];
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
                                        'invoice_date' => $invoiceDate,
                                        'entry_date' => $invoiceDate,
                                        'purchase_type' => $_POST['salesinvoicetype'],
                                        'dr_cr' => 'CR',
                                        'amt' => abs($_POST['total_tax']),
                                        'opening_bal' => $gstLedgerData['closing_balance'],
                                        'closing_bal' => $updateGstLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                // echo "GST <pre>"; print_r($gstLedgerDataUpdate);
                // echo "<pre>"; print_r($gstLedger); exit();

                $this->model_purchaseledger->create($gstLedger);
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
                                    'invoice_date' => $invoiceDate,
                                    'entry_date' => $invoiceDate,
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
            
        	    $comm = 0;
        	    
        	    $count_product = count($_POST['pno']);
        	    
        	    for($i=0; $i<$count_product; $i++)
    	        {
    	            $comm = $comm + $this->input->post('comm')[$i];
    	            $data = array(
    	                            'ledgerid' => $this->input->post('salesman'),
    	                            'barcode' => $this->input->post('pno')[$i],
    	                            'price' => $this->input->post('finalprice')[$i],
    	                            'percentage' => $this->input->post('salesmancomm')[$i],
    	                            'comm' => $this->input->post('comm')[$i],
    	                            'company_id' => $this->session->userdata('wo_company'),
                					// 'city_id' => $this->session->userdata('wo_city'),
                					'store_id' => $this->session->userdata('wo_store'),
                					'created_by' => $this->session->userdata('wo_id')
    	                        );
    	            // echo "<pre>"; print_r($data);
    	           
    	            $this->model_comm->createSalesmanComm($data);
    	           
    	            //// echo $i;
    	            $invoiceData = array(
    	                            'inventory_id' => $created_id,
    	                            'inventory_type' => $this->input->post('salesinvoicetype'),
                					'pno' => $this->input->post('pno')[$i],
                					'quantity' => $this->input->post('quantity')[$i],
                					'conversion' => $this->input->post('conversion')[$i],
                					'conversionvalue' => $this->input->post('conversionvalue')[$i],
                					'baseprice' => $this->input->post('oldbaseprice')[$i],
                					'discount' => $this->input->post('discount')[$i],
                					'disvalue' => $this->input->post('disvalue')[$i],
                					'grossprice' => $this->input->post('grossprice')[$i],
                					'gst' => $this->input->post('gst')[$i],
                					'gstamt' => $this->input->post('gstamt')[$i],
                					'salesmancomm' => $this->input->post('salesmancomm')[$i],
                					'finalprice' => $this->input->post('finalprice')[$i],
                					'sku' => $this->input->post('sku')[$i],
                					'company_id' => $this->session->userdata('wo_company'),
                					// 'city_id' => $this->session->userdata('wo_city'),
                					'store_id' => $this->session->userdata('wo_store'),
                					'created_by' => $this->session->userdata('wo_id')
                	            );
                	
                	$this->model_salesinvoice->createInvoiceData($invoiceData);

                    $itemData = $this->model_barcode->fetchAllDataByBarcode($this->input->post('pnoname')[$i]);

                    // $barcodeData = $this->model_barcode->fetchBarcodeData($this->input->post('pno')[$i]);

                    $newQty = $itemData['balQty'] - $this->input->post('quantity')[$i];

                    $barcodeStatus = '';

                    if($newQty <= 0)
                    {
                        $barcodeStatus = 'soldout';
                        $newQty = 0;
                    }
                    else
                    {
                        $barcodeStatus = 'available';
                    }

                    $newBarcodeData = array(
                                                'id' => $itemData['id'],
                                                'item_status' => $barcodeStatus,
                                                'balQty' => $newQty,
                                                'modified_by' => $this->session->userdata('wo_id')
                                            );

                    $this->model_barcode->update($newBarcodeData);
                    // $itemUpdateData = array(
                    //                         'id' => $itemData['id'],
                    //                         'item_status' => 'soldout',
                    //                         'modified_by' => $this->session->userdata('wo_id')
                    //                         );

                    // $this->model_barcode->update($itemUpdateData);

                    // $itemStockData = $this->model_barcode->fetchDataByid($itemData['itemstock_id']);

                    // $updateQty = $itemStockData['available_qty'] - $this->input->post('quantity')[$i];

                    // $itemStockUpdateData = array(
                    //                                 'id' => $itemStockData['id'],
                    //                                 'available_qty' => $updateQty,
                    //                                 'modified_by' => $this->session->userdata('wo_id')
                    //                             );

                    // $this->model_barcode->updateStock($itemStockUpdateData);

                    // $item_statusData = array(
                    //                             'itemstock_id' => $itemStockData['id'],
                    //                             'item_id' => $itemData['id'],
                    //                             'status' => $this->input->post('salesinvoicetype'),
                    //                             'company_id' => $this->session->userdata('wo_company'),
                    //                             // 'city_id' => $this->session->userdata('wo_city'),
                    //                             'store_id' => $this->session->userdata('wo_store'),
                    //                             'created_by' => $this->session->userdata('wo_id')
                    //                         );

                    // $this->model_barcode->createStatus($item_statusData);
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
                                                        'invoice_date' => $invoiceDate,
                                                        'entry_date' =>$invoiceDate,
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
        	    
        	    
        	   // exit;
        	   
        	    
        	   // FOR INVOICE STATUS -> HOLD
        	    
        	    if($_POST['save'] == 'Hold')
    	        {
    	            $data = array(
    	                            'id' => $created_id,
    	                            'invoice_status' => "Hold",
    	                        );
    	                        
    	            $this->model_salesinvoice->update($data);
    	            
    	            $this->session->set_flashdata('feedback','Data Saved Successfully');
            		$this->session->set_flashdata('feedback_class','alert alert-success');
            				
            		return redirect('sales_invoice');
    	        }
    	        else if($_POST['save'] == 'Make Payment')
    	        {
    	            //   $this->session->set_flashdata('feedback','Data Saved Successfully');
        		    //  $this->session->set_flashdata('feedback_class','alert alert-success');
        		
    	            // echo "Redirect to Make Payment Page"; exit;
    	            
    	            return redirect('sales_invoice/makePayment/'.$created_id);
    	           
    	        }
    	        else
    	        {
    	            $this->session->set_flashdata('feedback','Data Saved Successfully');
            		$this->session->set_flashdata('feedback_class','alert alert-success');
            				
            		return redirect('sales_invoice');    
    	        }
        	    
        	}else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('sales_invoice/create');
        	}
	    }
	    else
	    {
	        $orderNo = $this->model_salesinvoice->lastrecord();
        	
    	    if($orderNo == '')
    	    {
    	        $this->data['opening_no']  = '0000001';
    	       // $code = '0000001';
    	    }
    	    else
    	    {
    	        $np = $orderNo['inventory_no'];
    	        $code = substr($np, 1); 
    	        
    	        $code = $code + 1;
    	        $code = sprintf('%07d',$code);
    	        
    	        $this->data['opening_no'] = $code;
    	    }

            $this->data['salesinvoicetype'] = $this->uri->segment(3);


            if($this->uri->segment(3) == 'voucher')
            {
                $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
                $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();


                $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();


                $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData();
                // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();


                $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();
                $this->data['division'] = $this->model_division->fecthAllData();
                $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
                $this->data['branch'] = $this->model_branch->fecthAllData();
                $this->data['location'] = $this->model_location->fecthAllData();
                $this->data['deliveryMemo'] = $this->model_deliverymemo->fecthAllData();
                $this->data['productData'] = $this->model_sku->fecthSkuAllData();
                $this->data['unit'] = $this->model_unit->fecthAllData();
                $this->data['gst'] = $this->model_gst->fecthAllData();
                
                $this->data['lastData'] = $this->model_salesinvoice->lastData();
    	    

                $this->render_template('admin_view/salesMaster/salesVoucher/create', $this->data);
            }
            else
            {
                $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
                $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();
 
                $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();


                // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
                $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();
                

                $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();
                $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
                $this->data['division'] = $this->model_division->fecthAllData();
                $this->data['branch'] = $this->model_branch->fecthAllData();
                $this->data['location'] = $this->model_location->fecthAllData();
                
                $this->data['sorder'] = $this->model_salesorder->fecthSalesOrderOpenData();
                $this->data['deliveryMemo'] = $this->model_deliverymemo->fecthAllData();
                
                $this->data['lastData'] = $this->model_salesinvoice->lastData();
    	    

                $this->render_template('admin_view/salesMaster/salesInvoice/create', $this->data);
            }
    	    
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	   // echo $id; exit;
	   
	   $this->form_validation->set_rules('id', 'Invoice Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE)
	    {
	        
	        // echo "<pre>"; print_r($_POST); //exit;
            $data = array(
    					'id' => $this->input->post('id'),
    					'inventory_no' => $this->input->post('inventory_no'),
    					'date' => $this->input->post('date'),
    					'sales_account' => $this->input->post('saccount'),
    					'account' => $this->input->post('account'),
    					'salesman' => $this->input->post('salesman'),
    					'shipping_details' => $this->input->post('shiping_details'),
    					'shipping_type' => $this->input->post('shiping_type'),
    					'division' => $this->input->post('division'),
    					// 'branch' => $this->input->post('branch'),
    					'location' => $this->input->post('location'),
    					'delivery_memo' => $this->input->post('delivery_memo'),
    					'sale_type' => $this->input->post('sales_type'),
    					'no_ofproducts' => $this->input->post('no_product'),
    					'base_total' => $this->input->post('base_total'),
    					'total_discount' => $this->input->post('total_discount'),
    					'gross_total' => $this->input->post('gross_total'),
    					'total_tax' => $this->input->post('total_tax'),
    					'total_amt' => $this->input->post('total_amt'),
    					'adjustment' => $this->input->post('adjustment'),
    					'total_invoice' => $this->input->post('total_invoice'),
    					'invoice_status' => "Credit Sale",
    					'salesorder_id' => $this->input->post('orderno'),
    					'company_id' => $this->session->userdata('wo_company'),
    					// 'city_id' => $this->session->userdata('wo_city'),
    					'store_id' => $this->session->userdata('wo_store'),
    					'modified_by' => $this->session->userdata('wo_id')
    				);
	        
        	// echo "<pre>"; print_r($data); exit();
            $create = $this->model_salesinvoice->update($data);

        	if($create == true) {
        	    
        	    $type = "salesinvoice";
    		    $this->model_purchaseledger->deletePurchaseID($this->input->post('id'), $type);
    		    
    		    $type = "invoice";
    		    $this->model_purchaseledger->deletePurchaseID($this->input->post('id'), $type);
    		    
    		    
    		    
    // 		    // SALES LEDGER
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
                                        'purchase_type' => 'salesinvoice',
                                        'dr_cr' => 'CR',
                                        'amt' => $this->input->post('total_invoice'),
                                        'opening_bal' => $salesLedgerData['closing_balance'],
                                        'closing_bal' => $updateSalesLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // // // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($salesLedger);
                // // update purchase ledger data
                $this->model_ledger->update($salesLedgerDataUpdate);


                    // ACCOUNT LEDGER
                    $accountLedgerData = $this->model_ledger->fecthDataByID($_POST['account']);
                    $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] - $this->input->post('total_invoice');
                    // $updateAccountLedgerAmt = abs($updateAccountLedger);
                    // update account Ledger
                    $accountLedgerDataUpdate = array(
                                                        'id' => $accountLedgerData['id'],
                                                        'opening_balance' => $accountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateAccountLedgerAmt
                                                    );
    
                    // Add Data to Sales Ledger Table
                    $accountLedger = array(
                                                'purchase_id' => $this->input->post('id'),
                                                'ledger_id' => $accountLedgerData['id'],
                                                'invoice_date' => $this->input->post('date'),
                                                'entry_date' => $this->input->post('date'),
                                                'purchase_type' => 'salesinvoice',
                                                'dr_cr' => 'DR',
                                                'amt' => $this->input->post('total_invoice'),
                                                'opening_bal' => $accountLedgerData['closing_balance'],
                                                'closing_bal' => $updateAccountLedgerAmt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                            );
                    // echo "Party Account <pre>"; print_r($accountLedgerDataUpdate);
                    // echo "<pre>"; print_r($accountLedger); //exit();
                    // exit();
                    $this->model_purchaseledger->create($accountLedger);
                    $this->model_ledger->update($accountLedgerDataUpdate);    
                
                

                // GST LEDGER
                // echo "gts"; print_r($gst);
                $gstLedgerData = $this->model_ledger->fecthDataByID($this->input->post('sales_type'));
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
                                        'purchase_type' => 'salesinvoice',
                                        'dr_cr' => 'CR',
                                        'amt' => abs($this->input->post('total_tax')),
                                        'opening_bal' => $gstLedgerData['closing_balance'],
                                        'closing_bal' => $updateGstLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                // echo "GST <pre>"; print_r($gstLedgerDataUpdate);
                // echo "<pre>"; print_r($gstLedger); exit();

                $this->model_purchaseledger->create($gstLedger);
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
                                    'purchase_type' => 'salesinvoice',
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
        	        
        	        // echo "<pre>"; print_r($_POST); //exit;
                    $data = array(
            					'id' => $this->input->post('id'),
            					'invoice_status' => "payment",
            					'modified_by' => $this->session->userdata('wo_id')
            				);
        	        
                	// echo "<pre>"; print_r($data); exit();
                    $create = $this->model_salesinvoice->update($data);
            
            
        	       // echo "redirect to Make PAyment Page";
        	       return redirect('sales_invoice/makePayment/'.$this->input->post('id'));
        	    }
        	    else
        	    {
        	        $this->session->set_flashdata('feedback','Record Update Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				return redirect('sales_invoice');    
        	    }
        		
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('sales_invoice/update/'.$this->input->post('id'));
        	}
	    }
	    else
	    {
            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();



            $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();


            $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData();
    	    // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();

            $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();

    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    	    $this->data['sorder'] = $this->model_salesorder->fecthSalesOrderOpenData();
    	    $this->data['deliveryMemo'] = $this->model_deliverymemo->fecthAllData();
    	    
            $this->data['allData'] = $this->model_salesinvoice->fecthAllDataByID($id);
    	    $orderData = $this->model_salesinvoice->fecthAllDataByID($id);
            // echo "<pre>"; print_r($orderData); exit();

            $data = array(
                            'inventory_id' => $orderData['id'],
                            'inventory_type' => $orderData['invoice_type']
                        );

            $this->data['itemData'] = $this->model_salesinvoice->fecthItemDataByIdType($data);
            // $itemData = $this->model_salesinvoice->fecthItemDataByIdType($data);
            // echo "<pre>"; print_r($itemData); exit();
            
    		$this->render_template('admin_view/salesMaster/salesInvoice/update', $this->data);   
	    }
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);
		
		$data = $this->model_salesinvoice->fecthItemDataByInvoiceID($id);
        
        // echo $id; echo "<pre>"; print_r($data); exit;
		$delete = $this->model_salesinvoice->delete($id);

		if($delete == true) {
		    
		    $type = "salesinvoice";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);
		    
		    $type = "invoice";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);
            
            foreach($data as $rows)
            {
                // echo $rows['id'];
                $this->model_salesinvoice->deleteItemData($rows['id']);
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
	
	public function makePayment()
	{
	    $id = $this->uri->segment(3);
	    // echo $id;
	    
	    $this->form_validation->set_rules('paid', 'Paid Amount', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {

            $salesinvoice = $this->model_salesinvoice->fecthAllDataByID($this->input->post('id'));

	        $data = array(
        					'salesorder_id' => $this->input->post('id'),
        					'type' => $salesinvoice['invoice_type'],
        					'estimate' => $this->input->post('totvalue'),
        					'paid' => $this->input->post('paid'),
        					'balance' => $this->input->post('remainingpaid'),
        					'date' => $this->input->post('entrydate'),
        					'check_num' => $this->input->post('number'),
        					'paymenttype_id' => $this->input->post('payment_type'),
        					'company_id' => $this->session->userdata('wo_company'),
        	    			// 	'city_id' => $this->session->userdata('wo_city'),
        		    		'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
        				       				
        // 	echo "<pre>"; print_r($data); exit;

            // $created = 1;
            $created = $this->model_salesorder->makepayment($data);
	        
	        if($created) {

                    $status = 'Credit Sales';
                
                    if($salesinvoice['account'] != 61 && $salesinvoice['account'] != 2625)
                    {
                        // account data to CR
                        $accountLedgerData = $this->model_ledger->fecthDataByID($salesinvoice['account']);
                        $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] + $_POST['totvalue'];
    
                        // update account Ledger
                        $accountLedgerDataUpdate = array(
                                                            'id' => $accountLedgerData['id'],
                                                            'opening_balance' => $accountLedgerData['closing_balance'],
                                                            'closing_balance' => $updateAccountLedgerAmt
                                                        );
    
                        // Add Data to Sales Ledger Table
                        $accountLedger = array(
                                                    'purchase_id' => $salesinvoice['id'],
                                                    'ledger_id' => $accountLedgerData['id'],
                                                    'invoice_date' => $_POST['entrydate'],
                                                    'entry_date' => $_POST['entrydate'],
                                                    'purchase_type' => "salesinvoice",
                                                    'dr_cr' => 'CR',
                                                    'amt' => abs($_POST['totvalue']),
                                                    'opening_bal' => $accountLedgerData['closing_balance'],
                                                    'closing_bal' => $updateAccountLedgerAmt,
                                                    'company_id' => $this->session->userdata('wo_company'),
                                                    // 'city_id' => $this->session->userdata('wo_city'),
                                                    'store_id' => $this->session->userdata('wo_store'),
                                                    'created_by' => $this->session->userdata('wo_id')
                                                );
    
                        // echo "<pre>"; print_r($accountLedgerDataUpdate);
                        // echo "<pre>"; print_r($accountLedger);
                        $this->model_purchaseledger->create($accountLedger);
                        $this->model_ledger->update($accountLedgerDataUpdate);
                    }
                    
                    if($this->input->post('payment_type') != 7)
                    {
                        $status = 'Payment Done';
                                            
                        $paymentType = $this->model_paymentmaster->fecthDataByID($this->input->post('payment_type'));
                        $paymentTypeLedgerData = $this->model_ledger->fecthDataByID($paymentType['ledger_id']);
    
                        $paymentTypeLedgerAmt = $paymentTypeLedgerData['closing_balance'] - $_POST['totvalue'];
    
                        // update account Ledger
                        $paymentLedgerDataUpdate = array(
                                                            'id' => $paymentTypeLedgerData['id'],
                                                            'opening_balance' => $paymentTypeLedgerData['closing_balance'],
                                                            'closing_balance' => $paymentTypeLedgerAmt
                                                        );
                        $paymentLedger = array(
                                                'purchase_id' => $salesinvoice['id'],
                                                'ledger_id' => $paymentTypeLedgerData['id'],
                                                'invoice_date' => $_POST['entrydate'],
                                                'entry_date' => $_POST['entrydate'],
                                                'purchase_type' => "salesinvoice",
                                                'dr_cr' => 'DR',
                                                'amt' => $_POST['totvalue'],
                                                'opening_bal' => $paymentTypeLedgerData['closing_balance'],
                                                'closing_bal' => $paymentTypeLedgerAmt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                        );
    
                        // echo "<pre>"; print_r($paymentLedgerDataUpdate);
                        // echo "<pre>"; print_r($paymentLedger);
                        $this->model_ledger->update($paymentLedgerDataUpdate);
                        $this->model_purchaseledger->create($paymentLedger);
                    }

                // }
                
                 // echo "<pre>"; print_r($_POST); //exit;
                    $data = array(
            					'id' => $this->input->post('id'),
            					'invoice_status' => $status,
            					'modified_by' => $this->session->userdata('wo_id')
            				);
        	        
                // 	echo "<pre>"; print_r($data); exit();
                    $create = $this->model_salesinvoice->update($data);
                    
                    

        	    if(!empty($_POST['print']))
    	        {
    	            
    	            if($salesinvoice['invoice_type'] == 'salesinvoice' OR $salesinvoice['invoice_type'] == 'invoice')
    	            {
        	            return redirect('sales_invoice/report/'.$this->input->post('id'));
    	            }
    	            else if($salesinvoice['invoice_type'] == 'voucher')
    	            {
    	                return redirect('sales_voucher/report/'.$this->input->post('id'));
    	            }
    	            else if($salesinvoice['invoice_type'] == 'wsp')
    	            {
    	                return redirect('wsp/report/'.$this->input->post('id'));
    	            }
    	        }
    	        else
    	        {
    	            $this->session->set_flashdata('feedback','Payment Succesfull Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				
    				return redirect('sales_invoice');
    	        }
	        }
	        else
	        {
	            $this->session->set_flashdata('feedback','Unable to Make Payment');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('sales_invoice');
	        }
	    }
	    else
	    {
	        $this->data['id'] = $id;
	    
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['allData'] = $this->model_salesinvoice->fecthAllDataByID($id);
    	    
    	    $this->render_template('admin_view/salesMaster/salesInvoice/makePayment', $this->data); 
	    }
	}
 
    public function report()
    {
        $id = $this->uri->segment(3);

        $company_id = $this->session->userdata['wo_company'];
        $companyDetails = $this->model_company->fecthDataByID($company_id);

        $cityData = $this->model_state->fecthCityByID($companyDetails['city']);

        $invoiceData = $this->model_salesinvoice->fecthAllDataByID($id);

        if($invoiceData['invoice_type'] == 'pos')
        {
            $itemData = $this->model_salesinvoice->fecthItemDataByPOSID($id);
        }
        else
        {
            $itemData = $this->model_salesinvoice->fecthItemDataByInvoiceID($id);
        }
        // echo "Hi<pre>"; print_r($invoiceData); exit();
        // echo "<pre>"; print_r($itemData); exit();

        $salesType = $this->model_ledger->fecthAllDatabyID($invoiceData['sale_type']);
        $deliverymemo = $this->model_deliverymemo->fecthAllDataByID($invoiceData['delivery_memo']);

        $customerData = $this->model_ledger->fecthAllDatabyID($invoiceData['account']);
        // echo "<pre>"; print_r($customerData);
        // $this->render_template('admin_view/salesMaster/salesInvoice/report', $this->data);

        $orderData = $this->model_salesorder->fecthAllDatabyID($invoiceData['salesorder_id']);

        // echo "<pre>"; print_r($orderData);

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
                                                                <b>Name :-</b>:
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
                                                            <td>-</td>
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
                                                            <td>'.$invoiceData['shipping_details'].'</td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <b>Sale Order No :-</b>
                                                            </td>
                                                            <td>'.$orderData['order_no'].'</td>
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
                                                            <th class="myBorder">&nbsp; SKU</th>
                                                            <th class="myBorder">&nbsp; HSN</th>
                                                            <td class="myBorder">&nbsp; QTY</td>
                                                            <th class="myBorder">&nbsp; MRP</th>
                                                            <th class="myBorder">&nbsp; DISC.</th>
                                                            <th class="myBorder">&nbsp; SGST</th>
                                                            <th class="myBorder">&nbsp; CGST</th>
                                                            <th class="myBorder">&nbsp; IGST</th>
                                                            <th class="myBorder">&nbsp; GST Amt.</th>
                                                            <th class="myBorder">&nbsp; Gross Amt.</th>
                                                        </tr>';

                                                        $qty=$subtotal=$discount=$tsgst=$tcgst=$tigst=0; $no=1;

                                                        foreach($itemData as $rows)
                                                        {
                                                            $productData = $this->model_sku->fecthSkuDataByID($rows['sku']);
                                                            // echo "<pre>"; print_r($productData);

                                                            $barcodeData = $this->model_barcode->fetchDataBySkuCode1($rows['sku']);

                                                            $hsnData = $this->model_hsn->fecthAllDataById($barcodeData['hsn']);

                                                            $discountData = $this->model_discount->fecthDataByID($rows['discount']);

                                                            $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);
                                                            
                                                            $per = 100;
                                                            
                                                            $perSGST = $per + $gstData['sgst'];
                                                            $perCGST = $per + $gstData['cgst'];
                                                            $perIGST = $per + $gstData['igst'];
                                                            
                                                            $bsgst = ($rows['baseprice'] * $gstData['sgst']) / $perSGST;
                                                            $bcgst = ($rows['baseprice'] * $gstData['cgst']) / $perCGST;
                                                            $bigst = ($rows['baseprice'] * $gstData['igst']) / $perIGST;
                                                            
                                                            $gpsgst = $rows['baseprice'] - $bsgst;
                                                            $gpcgst = $rows['baseprice'] - $bcgst;
                                                            $gpigst = $rows['baseprice'] - $bigst;
                                                            
                                                            

                                                            $sgst = ($gpsgst * $gstData['sgst']) / $perSGST;
                                                            $cgst = ($gpcgst * $gstData['cgst']) / $perCGST;
                                                            $igst = ($gpigst * $gstData['igst']) / $perIGST;
                                                            
                                                            
                                                            $gstAmt = $sgst + $cgst + $igst;

                                                            $qty = $qty + $rows['quantity'];
                                                            $subtotal = $subtotal + $rows['grossprice'];

                                                            $discount = $discount + $rows['disvalue'];
                                                            $tsgst = $tsgst + $sgst;
                                                            $tcgst = $tcgst + $cgst;
                                                            $tigst = $tigst + $igst;
                                                            
                                                            // $cash = $subtotal + $tsgst + $cgst + $igst;
                                                            
                                                            if($invoiceData['adjustment'] < 0)
                                                            {
                                                                $adj = $invoiceData['adjustment'];
                                                            }
                                                            else
                                                            {
                                                                $adj = $invoiceData['adjustment'];
                                                            }

                                                            $html.='<tr>
                                                                        <td class="myBorder">&nbsp; '.$no.'</td>
                                                                        <td class="myBorder">&nbsp; '.$productData['product_code']."<br>&nbsp;".$barcodeData['barcode'].'</td>
                                                                        <td class="myBorder">&nbsp; '.$hsnData['hsn_code'].'</td>
                                                                        <td class="myBorder">&nbsp; '.$rows['quantity'].'</td>
                                                                        <td class="myBorder">&nbsp; '.$rows['baseprice'].'</td>
                                                                        <td class="myBorder">&nbsp; '.number_format(($rows['disvalue'] != '' ? $rows['disvalue']." ".($discountData['discount']) : "0"), 3).'</td>

                                                                        <td class="myBorder">&nbsp; '.number_format($bcgst, 3).'</td>
                                                                        <td class="myBorder">&nbsp; '.number_format($bsgst, 3).'</td>
                                                                        
                                                                        <td class="myBorder">&nbsp; '.number_format($bigst, 3).'</td>
                                                                        
                                                                        <td class="myBorder">&nbsp; '.number_format($rows['gstamt'], 3).'</td>

                                                                        <td class="myBorder">&nbsp; '.(number_format($rows['grossprice'], 3)).'</td>
                                                                    </tr>';
                                                            $no++;
                                                        }

                                                $html.='<tr>
                                                            <td class="myBorder" colspan="2">&nbsp;</td>
                                                            <td class="myBorder">&nbsp; Total</td>
                                                            <td class="myBorder">&nbsp; '.$qty.'</td>
                                                            <td class="myBorder" colspan="5">&nbsp;</td>
                                                            <td class="myBorder"><b>&nbsp; Subtotal:-</b></td>
                                                            <td class="myBorder"><b>&nbsp; '.number_format($subtotal, 3).'</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="myBorder" colspan="9">
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
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($discount, 3).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($tsgst, 3).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($tcgst, 3).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($tigst, 3).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format(abs($invoiceData['adjustment']), 3).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.(number_format($invoiceData['total_amt'] - $adj, 3)).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">0</td>
                                                                  </tr>
                                                                  
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                          <td class="myBorder" colspan="9">
                                                            <div class="pl15">
                                                              <p><b>IN WORDS : '.$this->number_to_word->convert_number($invoiceData['total_amt'] - $adj, 3).'</b></p>
                                                            </div>
                                                          </td>
                                                          <td class="myBorder">
                                                            <div class="pl15"><b>Grand Total</b></div>
                                                          </td>
                                                          <td class="myBorder" style="text-align: right; padding-right: 5px">'.(number_format($invoiceData['total_amt'] - $adj, 3)).'</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr style="border:none;">
                                                <td>
                                                    <div class="pl15">
                                                        <h5>
                                                          <b><u>Declaration</u></b>
                                                        </h5>
                                                        <p>Certified that the particulars given above are true & correct and the amount indicated represents the price actually charged and there is no flow of additional consideration directly or indirectly from the buyers. </p>

                                                        <h5>
                                                          <b><u>Term And Condition</u></b>
                                                        </h5>
                                                        <p>1. Subject To Nagpur Jurisdiction</p>
                                                        <p>2. No Cancellation/ Exchange or Return of Made to Ordered or Altered Items.</p>
                                                        <p>3. All Applicable Taxes/GST/Levies if/any apart from mentioned above would be Charged Extra at the time of Billing.</p>
                                                        <p>4. Payment to be made on or before due date mentioned here, in favour of M/s. PARAMOUNT TRADING VENTURES ,bank details are given here-in.</p>
                                                        <p>5. Cash Payment Without Original Reciept would be invalid.</p>
                                                        <p>6. Payment against Made to Order or to be Altered product is Non-Refundable.</p>
                                                        <p>7. No Gurantee/Warranty on designs/patterns and color fastness.</p>
                                                        <p>8. Any Manufacturing/Fitting Defect would be resolved by means of Alteration/Repairs.</p>
                                                        <p>9. Committed Delivery date can change,depending upon the prevailing conditions and supplies.</p>
                                                        <p>10. We reserve the right to demand settlement of this invoice bill at any time before due date.</p>
                                                    </div>
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

        if($invoiceData['invoice_type'] == 'pos')
        {
            $itemData = $this->model_salesinvoice->fecthItemDataByPOSID($id);
        }
        else
        {
            $itemData = $this->model_salesinvoice->fecthItemDataByInvoiceID($id);
        }

        
        $customerData = $this->model_ledger->fecthAllDatabyID($invoiceData['account']);

        // echo "<pre>"; print_r($customerData); exit();
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
                                                            <td>'.$customerData['ledger_name'].'</td>
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
                                                    // echo "<pre>"; print_r($itemData);
                                                    foreach($itemData as $rows)
                                                    {
                                                        // for order description
                                                        $orderData = $this->model_barcode->fetchAllDataByBarcodeid($rows['pno']);
                                                        $skuData = $this->model_sku->fecthDataBySKUID($orderData['sku_code']);

                                                        // echo "<pre>"; print_r($orderData);

                                                        $category = $this->model_category->fecthCatDataByID($skuData['category_id']);

                                                        $subcategory = $this->model_category->fecthSubCatDataByID($skuData['subcategory_id']);

                                                        // echo "<pre>"; print_r($subcategory);

                                                        $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);

                                                        $gst = $gstData['sgst'] + $gstData['cgst'] + $gstData['igst'];
                                                        
                                                        $per = 100;
                                                        
                                                        $perSGST = $per + $gstData['sgst'];
                                                        $perCGST = $per + $gstData['cgst'];
                                                        $perIGST = $per + $gstData['igst'];
                                                        
                                                        $bsgst = ($rows['baseprice'] * $gstData['sgst']) / $perSGST;
                                                        $bcgst = ($rows['baseprice'] * $gstData['cgst']) / $perCGST;
                                                        $bigst = ($rows['baseprice'] * $gstData['igst']) / $perIGST;
                                                        
                                                        $gpsgst = $rows['baseprice'] - $bsgst;
                                                        $gpcgst = $rows['baseprice'] - $bcgst;
                                                        $gpigst = $rows['baseprice'] - $bigst;
                                                        
                                                        

                                                        $sgst = ($gpsgst * $gstData['sgst']) / $perSGST;
                                                        $cgst = ($gpcgst * $gstData['cgst']) / $perCGST;
                                                        $igst = ($gpigst * $gstData['igst']) / $perIGST;
                                                        
                                                        
                                                        $gstAmt = $sgst + $cgst + $igst;

                                                        $countQty = $countQty + $rows['quantity'];

                                                        $subtotal = $subtotal + $rows['baseprice'] - $rows['disvalue'];
                                                        $totgst = $totgst + $rows['gstamt'];

                                                        $dis = $dis + $rows['disvalue'];

                                                        $html .= '<tr>
                                                                    <td class="myBorder">&nbsp;'.$no.'</td>
                                                                    <td class="myBorder"><center>'.$category['catgory_name'].', '.$subcategory['subcategory_name'].', <br>'.$skuData['product_code'].', <br>'.$orderData['barcode'].'</center></td>
                                                                    <td class="myBorder">&nbsp;'.$rows['quantity'].'<br>&nbsp;'.$gst.' % GST</td>
                                                                    <td class="myBorder">&nbsp;'.$rows['baseprice'].'<br>&nbsp;GST Amt '.$rows['gstamt'].'</td>
                                                                    <td class="myBorder">&nbsp;'.number_format($rows['disvalue'], 3).'</td>
                                                                    <td class="myBorder">&nbsp;'.($rows['baseprice'] - $rows['disvalue']).'</td>
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
                                                            <td>&nbsp; '.($subtotal).'</td>
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
                                                            <td>&nbsp; '.($famt = $subtotal + $totgst - $invoiceData['adjustment']).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Trending Charge:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; 0</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Total Net Due:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; 0</td>
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
                                                                // $totGrossprice=$sgst=$cgst=$igst=$totAmt=$totsgst=$totcgst=$totigst=0;
                                                            
                                                            $totGrossprice=$totsgst=$totcgst=$totigst=$totAmt=$totsgst=$totcgst=$totigst=0;

                                                            $sgst=$cgst=$igst=0;

                                                            foreach ($gstAllData as $key => $value)
                                                            {
                                                                $data = array(
                                                                                'voucher_id' => $id,
                                                                                'voucher_type' => 'voucher',
                                                                                'gst_id' => $value->id
                                                                            );

                                                                if($invoiceData['invoice_type'] == 'pos')
                                                                {
                                                                    $data = array(
                                                                                    'id' => $id,
                                                                                    'gst_id' => $value->id
                                                                                );
                                                                    $itemDataForGST = $this->model_salesinvoice->fecthItemDataByPOSIDGST($data);
                                                                }
                                                                else
                                                                {
                                                                    $data = array(
                                                                                    'id' => $id,
                                                                                    'gst_id' => $value->id
                                                                                );
                                                                    $itemDataForGST = $this->model_salesinvoice->fecthItemDataByInvoiceIDGST($data);
                                                                }

                                                                // $itemDataForGST = $this->model_vouchers->fecthAllDatabyVoucherIDTypeGST($data);
                                                                // echo "<pre>"; print_r($itemDataForGST);

                                                                $amt=0;
                                                                foreach ($itemDataForGST as $rows)
                                                                {
                                                                    $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);

                                                                    $amt = $amt + $rows['baseprice'];
                                                                }

                                                                $sgstPer = $value->sgst + 100;
                                                                $cgstPer = $value->cgst + 100;
                                                                $igstPer = $value->igst + 100;

                                                                $sgst = ($amt * $value->sgst) / $sgstPer;
                                                                $cgst = ($amt * $value->cgst) / $cgstPer;
                                                                $igst = ($amt * $value->igst) / $igstPer;

                                                                $html .= '<tr>
                                                                            <td>'.($amt != 0 ? $value->sgst + $value->cgst + $value->igst : "").'</td>
                                                                            <td>'.($amt != 0 ? $amt : "").'</td>
                                                                            <td>'.($amt != 0 ? number_format($sgst, 3) : "").'</td>
                                                                            <td>'.($amt != 0 ? number_format($cgst, 3) : "").'</td>
                                                                            <td>'.($amt != 0 ? number_format($igst, 3) : "").'</td>
                                                                        </tr>';

                                                                $totAmt = $totAmt + $amt;
                                                                $totsgst = $totsgst + $sgst;
                                                                $totcgst = $totcgst + $cgst;
                                                                $totigst = $totigst + $igst;
                                                            }
                                                                
                                                            $html .= '<tr>
                                                                        <td>&nbsp;Total :- </td>
                                                                        <td>'.$famt.'</td>
                                                                        <td>'.number_format($totsgst, 3).'</td>
                                                                        <td>'.number_format($totcgst, 3).'</td>
                                                                        <td>'.number_format($totigst, 3).'</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">
                                                                <center>Total Include of GST Rs. <b> '.($famt).' </b> <br>
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