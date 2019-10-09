<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_voucher extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Purchase Voucher';
		
		$this->load->model('model_ledger');
        $this->load->model('model_paymentmaster');
        $this->load->model('model_shipping');
        $this->load->model('model_division');
        $this->load->model('model_branch');
        $this->load->model('model_location');
        $this->load->model('model_sku');
        $this->load->model('model_gst');

        $this->load->model('model_purchasevoucher');
        $this->load->model('model_purchaseledger');

        $this->load->model('model_company');
        
        $this->load->model('model_purchaseinvoice');
        
	}

	public function index()
	{
		$this->render_template('admin_view/purchase/purchaseVoucher/index', $this->data);
	}
	
	public function fetchAllData()
	{
	    $data = $this->model_purchasevoucher->fecthAllData();
	    
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
        
                $buttons .= '&nbsp; <a href="'.base_url().'purchase_voucher/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
            
                $buttons .= '&nbsp; <a href="'.base_url().'purchase_voucher/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
            
                $supplier = $this->model_ledger->fecthAllDatabyID($value['account']);
                
                $result['data'][$key] = array(
                                                
                                                $no,
                                                $value['voucher_no'],
                                                $supplier['ledger_name'],
                                                $value['invoice_date'],
                                                $value['dueDate'],
                                                $value['total_invoice'],
                                                $buttons
                                            );
                $no++;
            }
        }
        
        // print_r($result);
        echo json_encode($result);
        exit;
	}

	public function create()
	{
	    $this->form_validation->set_rules('pinvoice_no', 'Purchase Voucher Number', 'trim|required|is_unique[wo_purchasevoucher.voucher_no]');
	    
	    if ($this->form_validation->run() == TRUE) {
            
            $invoiceDate = date("Y-m-d", strtotime($this->input->post('date')));
	        $entryDate = date("Y-m-d", strtotime($this->input->post('entry_date')));
	    
	        $voucherData = array(
                					'voucher_no' => $this->input->post('pinvoice_no'),
                					'invoice_date' => $invoiceDate,
                					'entry_date' => $entryDate,
                					'paccount' => $this->input->post('paccount'),
                					'account' => $this->input->post('account'),
                					'ptype' => $this->input->post('ptype'),
                					'dueDay' => $this->input->post('due_day'),
                					'dueDate' => $this->input->post('due_date'),
                					'stype' => $this->input->post('stype'),
                					'stracking_no' => $this->input->post('stracking_no'),
                					'division' => $this->input->post('division'),
                					// 'branch' => $this->input->post('branch'),
                					'location' => $this->input->post('location'),
                					'purchase_type' => $this->input->post('purchase_type'),
                					'gamt' => $this->input->post('gross_total'),
                					'total_tax' => $this->input->post('total_tax1'),
                                    'total_amt' => $this->input->post('total_amt'),
                					'adjustment' => $this->input->post('adjustment'),
                					'total_invoice' => $this->input->post('total_invoice'),
                                    'inventory_type' => 'purchase_voucher',
                					'company_id' => $this->session->userdata('wo_company'),
                					// 'city_id' => $this->session->userdata('wo_city'),
                					'store_id' => $this->session->userdata('wo_store'),
                					'created_by' => $this->session->userdata('wo_id')
                				);
        				
        // 	echo "<pre>"; print_r($voucherData); exit();
            $created_id = $this->model_purchasevoucher->create($voucherData);
        	// $created_id = '1';
        	
        	if($created_id) {
        	    
        		
                $count_product = count($_POST['productlist']);

                for($i=0; $i<$count_product; $i++)
                {
                    $voucherItem = array(
                                    'pvoucher_id' => $created_id,
                                    'inventory_type' => "purchase_voucher",
                                    'product_name' => $this->input->post('productlist')[$i],
                                    'quantity' => $this->input->post('qtylist')[$i],
                                    'rate' => $this->input->post('mrplist')[$i],
                                    'gst_id' => $this->input->post('gstid')[$i],
                                    'gstvalue' => $this->input->post('gstname')[$i],
                                    'total_tax' => $this->input->post('taxlist')[$i],
                                    'total' => $this->input->post('totlist')[$i],
                                    // 'sales_status' => "Credit Sales",
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );

                     // echo "<pre>"; print_r($voucherItem);
                    $this->model_purchasevoucher->createItem($voucherItem);
                }

                // #####################################################
                // Create Ledger start
                
                // PURCHASE LEDGER
                $purchaseLedgerData = $this->model_ledger->fecthDataByID($_POST['paccount']);
                $updatePurchaseLedgerAmt = $purchaseLedgerData['closing_balance'] - $_POST['total_invoice'];
                $total_invoice = abs($_POST['total_invoice']);

                // update purchase Ledger
                $purchaseLedgerDataUpdate = array(
                                                    'id' => $purchaseLedgerData['id'],
                                                    'opening_balance' => $purchaseLedgerData['closing_balance'],
                                                    'closing_balance' => $updatePurchaseLedgerAmt
                                                );
                // Add Data to Purchase Ledger Table
                $purchaseLedger = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $purchaseLedgerData['id'],
                                        'purchase_type' => 'purchase_voucher',
                                        'invoice_date' => $entryDate,
                                        'entry_date' => $entryDate,
                                        'dr_cr' => 'DR',
                                        'amt' => $total_invoice,
                                        'opening_bal' => $purchaseLedgerData['closing_balance'],
                                        'closing_bal' => $updatePurchaseLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                
                // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($purchaseLedger);

                // // update purchase ledger data
                $this->model_ledger->update($purchaseLedgerDataUpdate);

                if($this->input->post('account') != 61 && $this->input->post('account') != 2625)
                {
                    // ACCOUNT LEDGER
                    $accountLedgerData = $this->model_ledger->fecthDataByID($_POST['account']);
                    $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] + $_POST['total_invoice'];
                    // $updateAccountLedgerAmt = abs($updateAccountLedger);
                    // update account Ledger
                    $accountLedgerDataUpdate = array(
                                                        'id' => $accountLedgerData['id'],
                                                        'opening_balance' => $accountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateAccountLedgerAmt
                                                    );
    
                    // Add Data to Account Ledger Table
                    $accountLedger = array(
                                                'purchase_id' => $created_id,
                                                'ledger_id' => $accountLedgerData['id'],
                                                'purchase_type' => 'purchase_voucher',
                                                'invoice_date' => $entryDate,
                                                'entry_date' => $entryDate,
                                                'dr_cr' => 'CR',
                                                'amt' => $total_invoice,
                                                'opening_bal' => $accountLedgerData['closing_balance'],
                                                'closing_bal' => $updateAccountLedgerAmt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                        );
    
                    $this->model_ledger->update($accountLedgerDataUpdate);
                    $this->model_purchaseledger->create($accountLedger);
                }
                // Increase Inventory automaticaly after price barcode

                // // PAYMENT TYPE LEDGER
                $paymentTypeData = $this->model_paymentmaster->fecthDataByID($this->input->post('ptype'));

                $paymentLedgerData = $this->model_ledger->fecthDataByID($paymentTypeData['ledger_id']);
                $updatePaymentTypeLedgerAmt = $paymentLedgerData['closing_balance'] + $_POST['total_invoice'];
                // $updatePaymentTypeLedgerAmt = abs($updatePaymentTypeLedger);
                // update purchase Ledger
                $paymentLedgerDataUpdate = array(
                                                    'id' => $paymentLedgerData['id'],
                                                    'opening_balance' => $paymentLedgerData['closing_balance'],
                                                    'closing_balance' => $updatePaymentTypeLedgerAmt
                                                );

                // Add Data to Purchase Ledger Table
                $paymentLedger = array(
                                            'purchase_id' => $created_id,
                                            'ledger_id' => $paymentLedgerData['id'],
                                            'invoice_date' => $entryDate,
                                            'entry_date' => $entryDate,
                                            'purchase_type' => "purchase_voucher",
                                            'dr_cr' => 'CR',
                                            'amt' => $total_invoice,
                                            'opening_bal' => $paymentLedgerData['closing_balance'],
                                            'closing_bal' => $updatePaymentTypeLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                    );

                $this->model_ledger->update($paymentLedgerDataUpdate);
                $this->model_purchaseledger->create($paymentLedger);


                // GST LEDGER
                $gstLedgerData = $this->model_ledger->fecthDataByID($_POST['purchase_type']);
                $updateGstLedgerAmt = $gstLedgerData['closing_balance'] - $_POST['total_tax1'];
                // $updateGstLedgerAmt = abs($updateGstLedger);
                // update account Ledger
                $gstLedgerDataUpdate = array(
                                                'id' => $gstLedgerData['id'],
                                                'opening_balance' => $gstLedgerData['closing_balance'],
                                                'closing_balance' => $updateGstLedgerAmt
                                            );

                // Add Data to Account Ledger Table
                $gstLedger = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $gstLedgerData['id'],
                                        'purchase_type' => 'purchase_voucher',
                                        'invoice_date' => $entryDate,
                                        'entry_date' => $entryDate,
                                        'dr_cr' => 'DR',
                                        'amt' => abs($this->input->post('total_tax1')),
                                        'opening_bal' => $gstLedgerData['closing_balance'],
                                        'closing_bal' => $updateGstLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // update account ledger data
                $this->model_purchaseledger->create($gstLedger);

                $this->model_ledger->update($gstLedgerDataUpdate);
                //  echo "<pre>"; print_r($data); exit();

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedger = $discountLedgerData['closing_balance'] - $_POST['adjustment'];
                    $updateDiscountLedgerAmt = abs($updateDiscountLedger);
                    // update purchase Ledger
                    $discountLedgerDataUpdate = array(
                                                        'id' => $discountLedgerData['id'],
                                                        'opening_balance' => $discountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateDiscountLedgerAmt
                                                    );
                    $discountLedger = array(
                                            'purchase_id' => $created_id,
                                            'ledger_id' => $discountLedgerData['id'],
                                            'purchase_type' => 'purchase_voucher',
                                            'invoice_date' => $entryDate,
                                            'entry_date' => $entryDate,
                                            'dr_cr' => 'DR',
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


                // Create Ledger end
                // #####################################################
        
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('purchase_voucher');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('purchase_voucher/create');
        	}
	    }
	    else
	    {
            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();


    	    $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();


            $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();
            // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();


            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
            $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
            $this->data['shiptype'] = $this->model_shipping->fecthAllData();
            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['productData'] = $this->model_sku->fecthSkuAllData();
            $this->data['gst'] = $this->model_gst->fecthAllData();
            
            $this->data['lastData'] = $this->model_purchaseinvoice->lastData();

    		$this->render_template('admin_view/purchase/purchaseVoucher/create', $this->data);
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    // echo $id; exit;
	   
	    $this->form_validation->set_rules('pinvoice_no', 'Invoice Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	        // echo "<pre>"; print_r($_POST); exit;
	        $voucherData = array(
                            'id' => $this->input->post('voucher_id'),
                            'voucher_no' => $this->input->post('pinvoice_no'),
                            'invoice_date' => $this->input->post('date'),
                            'entry_date' => $this->input->post('entry_date'),
                            'paccount' => $this->input->post('paccount'),
                            'account' => $this->input->post('account'),
                            'ptype' => $this->input->post('ptype'),
                            'dueDay' => $this->input->post('due_day'),
                            'dueDate' => $this->input->post('due_date'),
                            'stype' => $this->input->post('stype'),
                            'stracking_no' => $this->input->post('stracking_no'),
                            'division' => $this->input->post('division'),
                            // 'branch' => $this->input->post('branch'),
                            'location' => $this->input->post('location'),
                            'purchase_type' => $this->input->post('purchase_type'),
                            'gamt' => $this->input->post('gross_total'),
                            'total_tax' => $this->input->post('total_tax'),
                            'total_amt' => $this->input->post('total_amt'),
                            'adjustment' => $this->input->post('adjustment'),
                            'total_invoice' => $this->input->post('total_invoice'),
                            'inventory_type' => 'purchase_voucher',
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'modified_by' => $this->session->userdata('wo_id')
                        );
            // echo "<pre>"; print_r($voucherData); //exit;
            $update = $this->model_purchasevoucher->update($voucherData);
            // $update = '1';

            if($update)
            {
                // $this->model_purchasevoucher->deleteItem($this->input->post('voucher_id'));
                
                $type = "purchase_voucher";
		    
    		    $this->model_purchaseledger->deletePurchaseID($this->input->post('voucher_id'), $type);
    		    
    		    // PURCHASE LEDGER
                $purchaseLedgerData = $this->model_ledger->fecthDataByID($this->input->post('paccount'));
                $updatePurchaseLedgerAmt = $purchaseLedgerData['closing_balance'] - $this->input->post('total_invoice');
                $total_invoice = abs($this->input->post('total_invoice'));

                // update purchase Ledger
                $purchaseLedgerDataUpdate = array(
                                                    'id' => $purchaseLedgerData['id'],
                                                    'opening_balance' => $purchaseLedgerData['closing_balance'],
                                                    'closing_balance' => $updatePurchaseLedgerAmt
                                                );
                // Add Data to Purchase Ledger Table
                $purchaseLedger = array(
                                        'purchase_id' => $this->input->post('voucher_id'),
                                        'ledger_id' => $purchaseLedgerData['id'],
                                        'purchase_type' => 'purchase_voucher',
                                        'invoice_date' => $this->input->post('entry_date'),
                                        'entry_date' => $this->input->post('entry_date'),
                                        'dr_cr' => 'DR',
                                        'amt' => $total_invoice,
                                        'opening_bal' => $purchaseLedgerData['closing_balance'],
                                        'closing_bal' => $updatePurchaseLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($purchaseLedger);

                // // update purchase ledger data
                $this->model_ledger->update($purchaseLedgerDataUpdate);

                if($this->input->post('account') != 61 && $this->input->post('account') != 2625)
                {
                    // ACCOUNT LEDGER
                    $accountLedgerData = $this->model_ledger->fecthDataByID($this->input->post('account'));
                    $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] + $this->input->post('total_invoice');
                    // $updateAccountLedgerAmt = abs($updateAccountLedger);
                    // update account Ledger
                    $accountLedgerDataUpdate = array(
                                                        'id' => $accountLedgerData['id'],
                                                        'opening_balance' => $accountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateAccountLedgerAmt
                                                    );
    
                    // Add Data to Account Ledger Table
                    $accountLedger = array(
                                                'purchase_id' => $this->input->post('voucher_id'),
                                                'ledger_id' => $accountLedgerData['id'],
                                                'purchase_type' => 'purchase_voucher',
                                                'invoice_date' => $this->input->post('entry_date'),
                                                'entry_date' => $this->input->post('entry_date'),
                                                'dr_cr' => 'CR',
                                                'amt' => $total_invoice,
                                                'opening_bal' => $accountLedgerData['closing_balance'],
                                                'closing_bal' => $updateAccountLedgerAmt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                        );
    
                    $this->model_ledger->update($accountLedgerDataUpdate);
                    $this->model_purchaseledger->create($accountLedger);
                }
                
                
                // Increase Inventory automaticaly after price barcode
                // // PAYMENT TYPE LEDGER
                $paymentTypeData = $this->model_paymentmaster->fecthDataByID($this->input->post('ptype'));

                $paymentLedgerData = $this->model_ledger->fecthDataByID($paymentTypeData['ledger_id']);
                $updatePaymentTypeLedgerAmt = $paymentLedgerData['closing_balance'] + $this->input->post('total_invoice');
                // $updatePaymentTypeLedgerAmt = abs($updatePaymentTypeLedger);
                // update purchase Ledger
                $paymentLedgerDataUpdate = array(
                                                    'id' => $paymentLedgerData['id'],
                                                    'opening_balance' => $paymentLedgerData['closing_balance'],
                                                    'closing_balance' => $updatePaymentTypeLedgerAmt
                                                );

                // Add Data to Purchase Ledger Table
                $paymentLedger = array(
                                            'purchase_id' => $this->input->post('voucher_id'),
                                            'ledger_id' => $paymentLedgerData['id'],
                                            'invoice_date' => $this->input->post('entry_date'),
                                            'entry_date' => $this->input->post('entry_date'),
                                            'purchase_type' => "purchase_voucher",
                                            'dr_cr' => 'CR',
                                            'amt' => $total_invoice,
                                            'opening_bal' => $paymentLedgerData['closing_balance'],
                                            'closing_bal' => $updatePaymentTypeLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                    );
                // echo "<pre>"; print_r($paymentLedgerDataUpdate);
                // echo "<pre>"; print_r($paymentLedger);exit();

                $this->model_ledger->update($paymentLedgerDataUpdate);
                $this->model_purchaseledger->create($paymentLedger);


                // GST LEDGER
                // echo "gts"; print_r($gst);

                $gstLedgerData = $this->model_ledger->fecthDataByID($_POST['purchase_type']);
                $updateGstLedgerAmt = $gstLedgerData['closing_balance'] - $this->input->post('total_tax');
                // $updateGstLedgerAmt = abs($updateGstLedger);
                // update account Ledger
                $gstLedgerDataUpdate = array(
                                                'id' => $gstLedgerData['id'],
                                                'opening_balance' => $gstLedgerData['closing_balance'],
                                                'closing_balance' => $updateGstLedgerAmt
                                            );

                // Add Data to Account Ledger Table
                $gstLedger = array(
                                        'purchase_id' => $this->input->post('voucher_id'),
                                        'ledger_id' => $gstLedgerData['id'],
                                        'purchase_type' => 'purchase_voucher',
                                        'invoice_date' => $this->input->post('entry_date'),
                                        'entry_date' => $this->input->post('entry_date'),
                                        'dr_cr' => 'DR',
                                        'amt' => abs($this->input->post('total_tax')),
                                        'opening_bal' => $gstLedgerData['closing_balance'],
                                        'closing_bal' => $updateGstLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

               
                // update account ledger data
                $this->model_purchaseledger->create($gstLedger);

                $this->model_ledger->update($gstLedgerDataUpdate);


                //  echo "<pre>"; print_r($data); exit();

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedger = $discountLedgerData['closing_balance'] - $this->input->post('adjustment');
                    $updateDiscountLedgerAmt = abs($updateDiscountLedger);
                    // update purchase Ledger
                    $discountLedgerDataUpdate = array(
                                                        'id' => $discountLedgerData['id'],
                                                        'opening_balance' => $discountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateDiscountLedgerAmt
                                                    );
                    $discountLedger = array(
                                            'purchase_id' => $this->input->post('voucher_id'),
                                            'ledger_id' => $discountLedgerData['id'],
                                            'purchase_type' => 'purchase_voucher',
                                            'invoice_date' => $entryDate,
                                            'entry_date' => $entryDate,
                                            'dr_cr' => 'DR',
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
    		    
    		    
                $data = array(
                        'pvoucher_id' => $this->input->post('voucher_id'), 
                        'inventory_type' => 'purchase_voucher'
                    );
    
                $itemData = $this->model_purchasevoucher->fetchItemByVoucherID($data); 
                
                foreach($itemData as $rows)
                {
                    $this->model_purchasevoucher->deleteItemBuID($rows['id']);
                } 


                $count_product = count($_POST['productlist']);

                for($i=0; $i<$count_product; $i++)
                {
                    if(empty($this->input->post('id')[$i]))
                    {
                        // echo "Add Item <br>";
                        $voucherItem = array(
                                        'pvoucher_id' => $this->input->post('voucher_id'),
                                        'inventory_type' => "purchase_voucher",
                                        'product_name' => $this->input->post('productlist')[$i],
                                        'quantity' => $this->input->post('qtylist')[$i],
                                        'rate' => $this->input->post('mrplist')[$i],
                                        'gst_id' => $this->input->post('gstid')[$i],
                                        'gstvalue' => $this->input->post('gstname')[$i],
                                        'total_tax' => $this->input->post('taxlist')[$i],
                                        'total' => $this->input->post('totlist')[$i],
                                        // 'sales_status' => "Credit Sales",
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'modified_by' => $this->session->userdata('wo_id')
                                    );

                         // echo "<pre>"; print_r($voucherItem);
                        $this->model_purchasevoucher->createItem($voucherItem);
                    }
                    else
                    {
                        // echo "Edit Item <br>";
                        $voucherItem = array(
                                        'id' => $this->input->post('id')[$i],
                                        'pvoucher_id' => $this->input->post('voucher_id'),
                                        'inventory_type' => "purchase_voucher",
                                        'product_name' => $this->input->post('productlist')[$i],
                                        'quantity' => $this->input->post('qtylist')[$i],
                                        'rate' => $this->input->post('mrplist')[$i],
                                        'gst_id' => $this->input->post('gstid')[$i],
                                        'gstvalue' => $this->input->post('gstname')[$i],
                                        'total_tax' => $this->input->post('taxlist')[$i],
                                        'total' => $this->input->post('totlist')[$i],
                                        // 'sales_status' => "Credit Sales",
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'modified_by' => $this->session->userdata('wo_id')
                                    );

                         // echo "<pre>"; print_r($voucherItem);
                        $this->model_purchasevoucher->createItem($voucherItem);
                    }
                }

                // exit();

                $this->session->set_flashdata('feedback','Data Update Successfully');
                $this->session->set_flashdata('feedback_class','alert alert-success');
                
                return redirect('purchase_voucher');
            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Update Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                return redirect('purchase_voucher/create');
            }
	    }
	    else
	    {
            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();

            $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();

            // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();
            
            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
            $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
            $this->data['shiptype'] = $this->model_shipping->fecthAllData();
            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['productData'] = $this->model_sku->fecthSkuAllData();
            $this->data['gst'] = $this->model_gst->fecthAllData();

            $this->data['allData'] = $this->model_purchasevoucher->fecthAllDatabyID($id);

            $data = array(
                            'pvoucher_id' => $id,
                            'inventory_type' => 'purchase_voucher'
                        );

            $this->data['itemData'] = $this->model_purchasevoucher->fetchItemByVoucherID($data);	        
    		$this->render_template('admin_view/purchase/purchaseVoucher/update', $this->data);
	    }
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);
        // echo $id; exit;

        $delete = $this->model_purchasevoucher->delete($id);	

		if($delete == true) {
            
            $type = "purchase_voucher";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);
		    
            $data = array(
                        'pvoucher_id' => $id, 
                        'inventory_type' => 'purchase_voucher'
                    );
    
            $itemData = $this->model_purchasevoucher->fetchItemByVoucherID($data); 
		    
		    foreach($itemData as $rows)
		    {
		        $this->model_purchasevoucher->deleteItemBuID($rows['id']);
		    } 
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('purchase_voucher');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('purchase_voucher');
    	}
	}

	
}