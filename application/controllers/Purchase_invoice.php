<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_invoice extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Purchase Invoice';
		
		$this->load->model('model_purchaseorder');
		$this->load->model('model_ledger');
		$this->load->model('model_paymentmaster');
		$this->load->model('model_shipping');
		$this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
		$this->load->model('model_purchaseitem');
		
        $this->load->model('model_barcode');
		$this->load->model('model_sku');
		
        $this->load->model('model_purchaseinvoice');
		$this->load->model('model_purchaseledger');

        $this->load->model('model_company');
        
	}

	public function index()
	{
		$this->render_template('admin_view/purchase/purchaseInvoice/index', $this->data);
	}
	
	public function fetchAllData()
	{
	    $data = $this->model_purchaseinvoice->fecthAllData();
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

                // if($value['product_status'] == 'not')
                // {
                    $buttons .= '&nbsp; <a href="'.base_url().'purchase_invoice/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                    $buttons .= '&nbsp; <a href="'.base_url().'purchase_invoice/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                // }
                
                $result['data'][$key] = array(
                                                
                                                $no,
                                                $value['invoice_no'],
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
	    $this->form_validation->set_rules('pinvoice_no', 'Invoice Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) { 
	        
	        $invoiceDate = date("Y-m-d", strtotime($this->input->post('invoice_date')));
	        $entryDate = date("Y-m-d", strtotime($this->input->post('entry_date')));

	        $data = array(
        					'invoice_no' => $this->input->post('pinvoice_no'),
        					'invoice_date' => $invoiceDate,
        					'entry_date' => $entryDate,
        					'porder_no' => $this->input->post('porder_no'),
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
        					'gamt' => $this->input->post('gamt'),
        					'total_tax' => $this->input->post('total_tax'),
        					'adjustment' => $this->input->post('adjustment'),
        					'total_invoice' => $this->input->post('total_invoice'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);
        				
        	$orderData = array(
        	                        'id' => $this->input->post('order_id'),
        	                        'order_status' => 'Close'
        	                    );

        // 	echo "<pre>"; print_r($data); exit();
        	$created_id = $this->model_purchaseinvoice->create($data);
        	
        	if($created_id == true) {
        	    
        		$this->model_purchaseorder->update($orderData);
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('purchase_invoice/update/'.$created_id);
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('purchase_invoice');
        	}
	    }
	    else
	    { 
	        $this->data['purchaseorderData'] = $this->model_purchaseorder->fecthAllDataStatus();
            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();

    	    $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();

            // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
    	    $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();
    	    
            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['shiptype'] = $this->model_shipping->fecthAllData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    	    
    	    $this->data['lastData'] = $this->model_purchaseinvoice->lastData();
    	    
    		$this->render_template('admin_view/purchase/purchaseInvoice/create', $this->data);   
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	   // echo $id; exit;
	   
	   $this->form_validation->set_rules('pinvoice_no', 'Invoice Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
            // echo "<pre>"; print_r($_POST); //exit;
	        $data = array(
        					'id' => $this->input->post('id'),
        					'invoice_no' => $this->input->post('pinvoice_no'),
        					'invoice_date' => $this->input->post('invoice_date'),
        					'entry_date' => $this->input->post('entry_date'),
        					'porder_no' => $this->input->post('porder_no'),
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
        					'gamt' => $this->input->post('gamt'),
        					'total_tax' => $this->input->post('total_tax'),
        					'adjustment' => $this->input->post('adjustment'),
        					'total_invoice' => $this->input->post('total_invoice'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);
        	                                      
            $create = $this->model_purchaseinvoice->update($data);
            // $create=1;
            	if($create) {
            	    
            	    $type = "pinvoice";
		    
        		    $this->model_purchaseledger->deletePurchaseID($this->input->post('id'), $type);

                    // PURCHASE LEDGER
                    $purchaseLedgerData = $this->model_ledger->fecthDataByID($this->input->post('paccount'));
                    $updatePurchaseLedgerAmt = $purchaseLedgerData['closing_balance'] - $this->input->post('total_invoice');
                    // update purchase Ledger
                    $purchaseLedgerDataUpdate = array(
                                                        'id' => $purchaseLedgerData['id'],
                                                        'opening_balance' => $purchaseLedgerData['closing_balance'],
                                                        'closing_balance' => $updatePurchaseLedgerAmt
                                                    );

                    // Add Data to Purchase Ledger Table
                    $purchaseLedger = array(
                                                'purchase_id' => $this->input->post('id'),
                                                'item_id' => $create,
                                                'ledger_id' => $purchaseLedgerData['id'],
                                                'invoice_date' => $this->input->post('invoice_date'),
                                                'entry_date' => $this->input->post('entry_date'),
                                                'purchase_type' => 'pinvoice',
                                                'dr_cr' => 'DR',
                                                'amt' => $this->input->post('total_invoice'),
                                                'opening_bal' => $purchaseLedgerData['closing_balance'],
                                                'closing_bal' => $updatePurchaseLedgerAmt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                            );
                    
                    $this->model_purchaseledger->create($purchaseLedger);
                    // // update purchase ledger data
                    $this->model_ledger->update($purchaseLedgerDataUpdate);
                    
                    if($this->input->post('account') != 61 && $this->input->post('account') != 2625)
                    {
                        // // ACCOUNT LEDGER
                        $accountLedgerData = $this->model_ledger->fecthDataByID($this->input->post('account'));
                        $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] + $this->input->post('total_invoice');
                        // $updateAccountLedgerAmt = abs($accountLedger);
                        // update account Ledger
                        $accountLedgerDataUpdate = array(
                                                            'id' => $accountLedgerData['id'],
                                                            'opening_balance' => $accountLedgerData['closing_balance'],
                                                            'closing_balance' => $updateAccountLedgerAmt
                                                        );
    
                        // Add Data to Account Ledger Table
                        $accountLedger = array(
                                                    'purchase_id' => $this->input->post('id'),
                                                    'item_id' => $create,
                                                    'ledger_id' => $accountLedgerData['id'],
                                                    'invoice_date' => $this->input->post('invoice_date'),
                                                    'entry_date' => $this->input->post('entry_date'),
                                                    'purchase_type' => 'pinvoice',
                                                    'dr_cr' => 'CR',
                                                    'amt' => $this->input->post('total_invoice'),
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
                    
                	// // PAYMENT TYPE LEDGER
                    $paymentTypeData = $this->model_paymentmaster->fecthDataByID($this->input->post('ptype'));
                    // echo "<pre>"; print_r($paymentTypeData); exit();

                    if($this->input->post('ptype') != '7')
                    {
                        $paymentLedgerData = $this->model_ledger->fecthDataByID($paymentTypeData['ledger_id']);
                        $updatePaymentTypeLedgerAmt = $paymentLedgerData['closing_balance'] + $this->input->post('total_invoice');
                        // $updatePaymentTypeLedgerAmt = abs($paymentTypeLedger);

                        // update purchase Ledger
                        $paymentLedgerDataUpdate = array(
                                                            'id' => $paymentLedgerData['id'],
                                                            'opening_balance' => $paymentLedgerData['closing_balance'],
                                                            'closing_balance' => $updatePaymentTypeLedgerAmt
                                                        );

                        // Add Data to Purchase Ledger Table
                        $paymentLedger = array(
                                                    'purchase_id' => $this->input->post('id'),
                                                    'item_id' => $create,
                                                    'ledger_id' => $paymentLedgerData['id'],
                                                    'invoice_date' => $this->input->post('invoice_date'),
                                                    'entry_date' => $this->input->post('entry_date'),
                                                    'purchase_type' => 'pinvoice',
                                                    'dr_cr' => 'CR',
                                                    'amt' => $this->input->post('total_invoice'),
                                                    'opening_bal' => $paymentLedgerData['closing_balance'],
                                                    'closing_bal' => $updatePaymentTypeLedgerAmt,
                                                    'company_id' => $this->session->userdata('wo_company'),
                                                    // 'city_id' => $this->session->userdata('wo_city'),
                                                    'store_id' => $this->session->userdata('wo_store'),
                                                    'created_by' => $this->session->userdata('wo_id')
                                            );

                        // echo "<pre>"; print_r($paymentLedger);
                        // echo "<pre>"; print_r($purchaseLedgerDataUpdate);

                        $this->model_ledger->update($paymentLedgerDataUpdate);
                        $this->model_purchaseledger->create($paymentLedger);
                    }

                    // GST Data
                    $gstLedgerData = $this->model_ledger->fecthDataByID($this->input->post('purchase_type'));
                    $gstLedger = $gstLedgerData['closing_balance'] - $this->input->post('gamt');
                    $updateGstLedgerAmt = abs($gstLedger);
                    // update account Ledger
                    $gstLedgerDataUpdate = array(
                                                    'id' => $gstLedgerData['id'],
                                                    'opening_balance' => $gstLedgerData['closing_balance'],
                                                    'closing_balance' => $updateGstLedgerAmt
                                                );

                    // Add Data to Account Ledger Table
                    $gstLedger = array(
                                            'purchase_id' => $this->input->post('id'),
                                            'item_id' => $create,
                                            'ledger_id' => $gstLedgerData['id'],
                                            'invoice_date' => $this->input->post('invoice_date'),
                                            'entry_date' => $this->input->post('entry_date'),
                                            'purchase_type' => 'pinvoice',
                                            'dr_cr' => 'DR',
                                            'amt' => $this->input->post('total_tax'),
                                            'opening_bal' => $gstLedgerData['closing_balance'],
                                            'closing_bal' => $updateGstLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                    );
                    $this->model_ledger->update($gstLedgerDataUpdate);
                    $this->model_purchaseledger->create($gstLedger);
    
                    if($_POST['adjustment'] != 0)
                    {
                        //  echo "<pre>"; print_r($data); exit();
                        $discountLedgerID = 82;
                        $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                        $discountLedger = $discountLedgerData['closing_balance'] - $_POST['adjustment'];
                        $updateDiscountLedgerAmt = abs($discountLedger);
                        // update purchase Ledger
                        $discountLedgerDataUpdate = array(
                                                            'id' => $discountLedgerData['id'],
                                                            'opening_balance' => $discountLedgerData['closing_balance'],
                                                            'closing_balance' => $updateDiscountLedgerAmt
                                                        );
                        // Add Data to Purchase Ledger Table
                        $discountLedger = array(
                                                    'purchase_id' => $this->input->post('id'),
                                                    'ledger_id' => $discountLedgerData['id'],
                                                    'invoice_date' => $this->input->post('invoice_date'),
                                                    'entry_date' => $this->input->post('entry_date'),
                                                    'purchase_type' => "pinvoice",
                                                    'dr_cr' => 'DR',
                                                    'amt' => abs($_POST['adjustment']),
                                                    'opening_bal' => $discountLedgerData['closing_balance'],
                                                    'closing_bal' => $updateDiscountLedgerAmt,
                                                    'company_id' => $this->session->userdata('wo_company'),
                                                    // 'city_id' => $this->session->userdata('wo_city'),
                                                    'store_id' => $this->session->userdata('wo_store'),
                                                    'created_by' => $this->session->userdata('wo_id')
                                            );

                        // Add Data to Purchase Ledger
                        $this->model_purchaseledger->create($discountLedger);
                        // update purchase ledger data
                        $this->model_ledger->update($discountLedgerDataUpdate);
                        // echo "<pre>"; print_r($discountLedgerData);
                        // echo "<pre>"; print_r($discountLedgerDataUpdate);
                	}

            		$this->session->set_flashdata('feedback','Record Update Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				return redirect('purchase_invoice');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('purchase_invoice/update/'.$this->input->post('id'));
        	}
	    }
	    else
	    {
	        $this->data['purchaseorderData'] = $this->model_purchaseorder->fecthAllDataStatus();
            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();

            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();

 
    	    // $this->data['ledgerPurAccount'] = $this->model_ledger->fecthLedgerPurAccount();
    
    

            // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccount();
    	    $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();

    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();

    	    $this->data['shiptype'] = $this->model_shipping->fecthAllData();
    	    
            $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    	    $this->data['invoice_id'] = $id;
    	    
    	    $this->data['allData'] = $this->model_purchaseinvoice->fecthAllDatabyID($id);

            $data = array(
                            'order_id' => $id,
                            'ordertype' => 'pinvoice'
                        ); 
    	    // echo "<pre>"; print_r($data);
    	    $this->data['itemData'] = $this->model_purchaseitem->fecthOrderByInvoiceIDType($data);
    	    // echo "<pre>"; print_r($itemData); exit();
    		$this->render_template('admin_view/purchase/purchaseInvoice/update', $this->data);   
	    }
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);
        
        $barcodeData = $this->model_barcode->getPInvoiceData($id);

		$delete = $this->model_purchaseinvoice->delete($id);	

		if($delete == true) {
		    
		    $type = "pinvoice";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);
		    
		    foreach($barcodeData as $rows)
		    {
		        $this->model_barcode->delete($rows['id']);
		    } 
            
            $this->model_purchaseitem->deleteOrderDataByOrderId($id);
            
            $this->model_purchaseitem->deleteItemByOrderId($id);
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('purchase_invoice');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('purchase_invoice');
    	}
	}
}

