<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Sales';
		
		$this->load->model('model_purchaseorder');
		$this->load->model('model_ledger');
		$this->load->model('model_paymentmaster');
		$this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
		$this->load->model('model_purchaseorder');
		$this->load->model('model_sku');
		
		$this->load->model('model_category');
		
        $this->load->model('model_salesorder');
        $this->load->model('model_barcode');
        $this->load->model('model_openingitem');
        $this->load->model('model_salesinvoice');
		$this->load->model('model_gst');
		
		$this->load->model('model_discount');
		$this->load->model('model_production');
		
		$this->load->model('model_journalentry');
		$this->load->model('model_ledgerentry');

        $this->load->model('model_purchaseledger');
        

        $this->load->model('model_company');
        $this->load->model('model_state');
        
		
	}

    public function fetchDataByBarcodeId()
    {
        $barcode = $_POST['barcode_code'];
        // $barcode = '0000000001';
        
        $data = $this->model_barcode->fetchBarcodeData($barcode);
        // echo "<pre>"; print_r($data); exit();
       // $orderData = $this->model_internalconsumption->fetchPurchaseData($data['purchase_id']);
        // $purchaseData = $this->model_internalconsumption->fetchPurchaseData($data['purchase_id']);
        
        if($data['purchase_type'] == 'popeningstock')
        {
            $orderData = $this->model_openingitem->fecthAllDataByID($data['product_id']);
            $base_price = $orderData['base_price'];
            $wsp_price = $orderData['wspp'];
            $sku = $orderData['sku'];
            $cate_id = $orderData['product_category'];
            $subcat_id = $orderData['product_subcategory'];
        }
        else if($data['purchase_type'] == 'pinvoice')
        {
            $orderData = $this->model_purchaseitem->fecthAllDataByID($data['product_id']);
            $base_price = $orderData['base_price'];
            $wsp_price = $orderData['wsp_price'];
            $sku = $orderData['sku_id'];
            $cate_id = $orderData['pcategories_id'];
            $subcat_id = $orderData['psubcat_id'];
        }

        $skuData = $this->model_sku->fecthSkuDataByID($sku);

        $catData = $this->model_category->fecthCatDataByID($cate_id);
        $subcatData = $this->model_category->fecthSubCatDataByID($subcat_id);
        
        // echo "<pre>"; print_r($data);
        // echo "<pre>"; print_r($purchaseData);
        // echo "<pre>"; print_r($orderData);
        // echo "<pre>"; print_r($skuData);
        // echo "<pre>"; print_r($catData);
        // echo "<pre>"; print_r($subcatData);

       $result = array(
                        'pno' => $data['barcode'],
                        'baseprice' => $base_price,
                        'grossprice' => $wsp_price,
                        'sku' => $skuData['product_code'],
                        'cat' => $catData['catgory_name'],
                        'subcat' => $subcatData['subcategory_name'],
                        'status' => $data['item_status'],
                    );
                         
        // print_r($result);
        echo json_encode($result);
    }
    
    public function fetchAllData()
	{
		$data = $this->model_salesorder->fecthAllData();
	   // echo "<pre>"; print_r($data);exit;
	    
        if(empty($data))
        {
            $result['data'] = '';
        }
        else
        {
    	    $no=1;
    	   // $result = array();
            foreach($data as $key => $value)
            {
                $customer = $this->model_ledger->fecthAllDatabyID($value['account_id']);
                
                // print_r($customer);
                $buttons = '';
                
                $buttons .= '&nbsp; <a href="'.base_url().'sales_order/addQty/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'sales_order/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'sales_order/salesOrderReport/'.$value['id'].'" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i>Print</a>';
                
                $newDate = date("d-m-Y", strtotime($value['completed_date']));

                if($value['order_status'] != 'Delivered')
                {
                    $status = '<span style="color: red">'.$value['order_status'].'</span>';
                }
                else
                {
                    $status = '<span style="color: green">Complete</span>';
                }
                
                $result['data'][$key] = array(
                                                $no,
                                                $value['order_no'],
                                                $value['order_date'],
                                                $value['expected_date'],
                                                $newDate,
                                                $customer['ledger_name'],
                                                $status,
                                                $buttons
                                            );
                $no++;
            }
        }
        
        // print_r($newDate);
        echo json_encode($result);
        exit;
	}
	
	public function getSalesOrderDataByID()
	{
	   // $id = 21;
	    $id = $_POST['sorder_id'];
	    $data = $this->model_salesorder->fecthAllDatabyID($id);
	   // echo "<pre>"; print_r($data);
	   echo json_encode($data);
	}
	
	public function index()
	{
		$this->render_template('admin_view/salesMaster/salesOrder/index', $this->data);
	}

	public function create()
	{
	    $this->form_validation->set_rules('order_no', 'Order Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       // echo "<pre>"; print_r($_POST); exit;
	        $data = array(
        					'order_no' => $this->input->post('order_no'),
        					'order_date' => $this->input->post('order_date'),
        					'sales_account_id' => $this->input->post('sales_account'),
        					'account_id' => $this->input->post('account'),
        					'division_id' => $this->input->post('division'),
        					// 'branch_id' => $this->input->post('branch'),
        				    // 'location_id' => $this->input->post('location'),
        					// 'packet_by' => $this->input->post('packet_by'),
        					'order_status' => $this->input->post('status'),
        					'expected_date' => $this->input->post('completion_date'),
        					'completed_date' => $this->input->post('commited_date'),
        					'estimated_total' => $this->input->post('estimate_total'),
        					'order_type' => $this->input->post('order_type'),
        					'purchaseorder_id' => $this->input->post('purchase_order'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	echo "<pre>"; print_r($data); exit();
        	$created_id = $this->model_salesorder->create($data);
        	
        	if($created_id == true) {

                // ACCOUNT LEDGER
                // $accountLedgerData = $this->model_ledger->fecthDataByID($_POST['sales_account']);
                // $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] + $_POST['estimate_total'];
                // // $updateAccountLedgerAmt = abs($updateAccountLedger);
                // // update account Ledger
                // $accountLedgerDataUpdate = array(
                //                                     'id' => $accountLedgerData['id'],
                //                                     'opening_balance' => $accountLedgerData['closing_balance'],
                //                                     'closing_balance' => $updateAccountLedgerAmt
                //                                 );

                // // Add Data to Sales Ledger Table
                // $accountLedger = array(
                //                             'purchase_id' => $created_id,
                //                             'ledger_id' => $accountLedgerData['id'],
                //                             'invoice_date' => $_POST['order_date'],
                //                             'entry_date' => $_POST['order_date'],
                //                             'purchase_type' => 'salesorder',
                //                             'dr_cr' => 'CR',
                //                             'amt' => $_POST['estimate_total'],
                //                             'opening_bal' => $accountLedgerData['closing_balance'],
                //                             'closing_bal' => $updateAccountLedgerAmt,
                //                             'company_id' => $this->session->userdata('wo_company'),
                //                             // 'city_id' => $this->session->userdata('wo_city'),
                //                             'store_id' => $this->session->userdata('wo_store'),
                //                             'created_by' => $this->session->userdata('wo_id')
                //                         );
                // // echo "Party Account <pre>"; print_r($accountLedgerDataUpdate);
                // // echo "<pre>"; print_r($accountLedger); //exit();
                // // exit();
                // $this->model_purchaseledger->create($accountLedger);
                // $this->model_ledger->update($accountLedgerDataUpdate);

        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				if(isset($_POST['jobsheet']))
				{
				    return redirect('production/create/'.$created_id);    
				}
				else
				{
					return redirect('sales_order/addQty/'.$created_id);
				}
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('sales_order');
        	}
	    }
	    else
	    {
	        $orderNo = $this->model_salesorder->lastrecord();
    	    
    	    if($orderNo == '')
    	    {
    	        $this->data['orderNo']  = '00000001';
    	       // $orderNo = sprintf('%05d',$no);
    	    }
    	    else
    	    {
    	        $np = $orderNo['order_no'];
    	        $code = substr($np, 1); 
    	        
    	        $code = $code + 1;
    	        $code = sprintf('%08d',$code);
    	        
    	        $this->data['orderNo'] = $code;
    	    }
    	    
    	   // print_r($orderNo); 
    	   // exit;
            $this->data['ledgerPurAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
    	    $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();

    	    $this->data['purchaseorder'] = $this->model_purchaseorder->fecthAllData();
                
    		$this->render_template('admin_view/salesMaster/salesOrder/create', $this->data);   
	    }
	}
	
	public function delete()
	{
	    $id = $this->uri->segment(3);

        // echo $id; exit();
	    $delete = $this->model_salesorder->delete($id);	

		if($delete == true) {
		    
		    $this->model_salesorder->deleteQtyByOrderiD($id);

            $data = array(
                        'inventory_id' => $id,
                        'inventory_type' => 'salesorder'
                    );
            // echo "<pre>"; print_r($data); exit();
            $this->model_salesinvoice->deleteInvoiceData($data);
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			
			return redirect('sales_order');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
		    
		    return redirect('sales_order');
    	}
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('order_no', 'Order Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	           // print_r($_POST); //exit;
	        $data = array(
        					'id' => $this->input->post('id'),
        					'order_no' => $this->input->post('order_no'),
        					'order_date' => $this->input->post('order_date'),
        					'sales_account_id' => $this->input->post('sales_account'),
        					'account_id' => $this->input->post('account'),
        					'division_id' => $this->input->post('division'),
        					// 'branch_id' => $this->input->post('branch'),
        				// 	'location_id' => $this->input->post('location'),
        					// 'packet_by' => $this->input->post('packet_by'),
        					'order_status' => $this->input->post('status'),
        					'expected_date' => $this->input->post('completion_date'),
        					'completed_date' => $this->input->post('commited_date'),
        					'estimated_total' => $this->input->post('estimate_total'),
        					'order_type' => $this->input->post('order_type'),
        					'purchaseorder_id' => $this->input->post('purchase_order'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	echo "<pre>"; print_r($data); exit();
        	$created_id = $this->model_salesorder->update($data);
        	
        	if($created_id == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('sales_order');
	            // 	return redirect('sales_order/updateAddQty/'.$this->input->post('id'));
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('sales_order');
        	}
	    }
	    else
	    { 
	        $this->data['ledgerPurAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
    	    $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
    	    
	       // $this->data['ledgerPurAccount'] = $this->model_ledger->fecthLedgerPurAccount();
    	   // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccount();
    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    	    $this->data['purchaseorder'] = $this->model_purchaseorder->fecthAllData();
    	    
    	    $this->data['allData'] = $this->model_salesorder->fecthAllDatabyID($id);

            $orderValue = $this->model_salesorder->fecthQtyData($id);

            $data = array(
                            'inventory_id' => $id,
                            'inventory_type' => 'salesorder'
                        );
            $conversionValue = $this->model_salesorder->fecthConversionData($data);
            // echo "<pre>"; print_r($conversionValue); exit();

            $sum = 0;
            foreach ($orderValue as $rows) {
                
                $sum = $sum + $rows->price;
            }
            // echo $sum; echo "<br>";

            foreach ($orderValue as $rows) {
                
                $sum = $sum + $rows->price;
            }
            // echo $sum; echo "<br>";

            $this->data['sum'] = $sum;
            // exit();
    	    
    		$this->render_template('admin_view/salesMaster/salesOrder/update', $this->data);   
	    }
	}
	
	public function getSalesOrderQtyDataByID()
	{
	    $id = $_POST['sorderQty_id'];
	   // $id = 1367;
	    $qtyData = $this->model_salesorder->fetchQtyDataById($id);
	    
	    $data[] = $qtyData;
	    $data[] = $this->model_sku->fecthDataBySKUID($qtyData['sku']);
	   // echo "<pre>"; print_r($data1); exit();
	   echo json_encode($data);
	}

    public function deleteSalesOrderSku()
    {
        $data = $this->model_salesorder->deleteQty($_POST['id']);
        echo json_encode($data);
    }
	
	public function addQty()
	{
	    $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	       
	        $data = array(
        					'salesorder_id' => $this->input->post('id'),  // order_id
        					'sku' => $this->input->post('sku'),
        					'quantity' => $this->input->post('quality'),
        					'price' => $this->input->post('estimate_price'),
        					'remark' => $this->input->post('remark'),
        					'jobsheet_status' => 'not',
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);
            $orderdata = $this->model_salesorder->fecthAllDatabyID($this->input->post('id'));
            
            $total = $orderdata['estimated_total'] + $this->input->post('estimate_price');
            
            $updateOrderData = array(
                                        'id' => $this->input->post('id'),
                                        'estimated_total' => $total
                                    );
            // 	echo "<pre>"; print_r($updateOrderData); echo "<pre>"; print_r($data); exit();
        	$created_id = $this->model_salesorder->createQty($data);
        	
        	if($created_id == true) {

                // $salesOrderData = $this->model_salesorder->fecthAllDatabyID($this->input->post('id'));

                // $accountLedgerData = $this->model_ledger->fecthDataByID($salesOrderData['account_id']);

                // $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] - $_POST['paid'];

                // // update account Ledger
                // $accountLedgerDataUpdate = array(
                //                                     'id' => $accountLedgerData['id'],
                //                                     'opening_balance' => $accountLedgerData['closing_balance'],
                //                                     'closing_balance' => $updateAccountLedgerAmt
                //                                 );

                // // Add Data to Sales Ledger Table
                // $accountLedger = array(
                //                             'purchase_id' => $salesOrderData['id'],
                //                             'ledger_id' => $accountLedgerData['id'],
                //                             'invoice_date' => $_POST['entrydate'],
                //                             'entry_date' => $_POST['entrydate'],
                //                             'purchase_type' => "salesorder",
                //                             'dr_cr' => 'DR',
                //                             'amt' => "- ".$_POST['paid'],
                //                             'opening_bal' => $accountLedgerData['closing_balance'],
                //                             'closing_bal' => $updateAccountLedgerAmt,
                //                             'company_id' => $this->session->userdata('wo_company'),
                //                             // 'city_id' => $this->session->userdata('wo_city'),
                //                             'store_id' => $this->session->userdata('wo_store'),
                //                             'created_by' => $this->session->userdata('wo_id')
                //                         );

                // // echo "<pre>"; print_r($accountLedgerDataUpdate);
                // // echo "<pre>"; print_r($accountLedger);
                // $this->model_purchaseledger->create($accountLedger);
                // $this->model_ledger->update($accountLedgerDataUpdate);
        	    
        	    $orderData = array(
        	                        'id' => $this->input->post('id'),
        	                        'paymentstatus' => 'no'
        	                    );
        	                    
        	   $this->model_salesorder->update($orderData);
        	    
        	    $this->model_salesorder->update($updateOrderData);
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('sales_order/addQty/'.$this->input->post('id'));
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('sales_order/addQty/'.$this->input->post('id'));
        	}
	    }
	    else
	    {
	        $id = $this->uri->segment(3);
    	    $this->data['id'] = $id;
    	    
    	    $this->data['ledgerPurAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
    	    $this->data['ledgerAccount'] = $this->model_ledger->fetchLedgerDataNotOther(4);
    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    $this->data['purchaseorder'] = $this->model_purchaseorder->fecthAllData();
    	    
    	    $this->data['allData'] = $this->model_salesorder->fecthAllDatabyID($id);
    	    
    	    $this->data['sku'] = $this->model_sku->fecthAllData();
    	    $this->data['allQty'] = $this->model_salesorder->fecthQtyData($id);
    	    $this->data['salesorderData'] = $this->model_salesorder->fecthAllDatabyID($id);
    	    
    	    $fetchData = array(
    	                        'inventory_id' => $id,
    	                        'inventory_type' => 'salesorder'
    	                    );
    	                    
    	    $this->data['barcodeData'] = $this->model_salesinvoice->fecthSalesInvoiceDataByIdType($fetchData);
    	    
    	    $this->data['discount'] = $this->model_discount->fecthAllData();
    	    $this->data['gst'] = $this->model_gst->fecthAllData();
    	   // echo "<pre>"; print_r($data); exit;
    	    
    	    $this->render_template('admin_view/salesMaster/salesOrder/addQty', $this->data);  
	    }
	}

    public function addSalesOrderSKU()
    {
        // echo "<pre>"; print_r($_POST); //exit();

        $skuData = $this->model_sku->fecthSkuDataBySKU($this->input->post('skucode'));

        $data = array(
                            'salesorder_id' => $this->input->post('id'),  // order_id
                            'sku' => $skuData['id'],
                            'quantity' => $this->input->post('sku_qty'),
                            'price' => $this->input->post('sku_price'),
                            'remark' => $this->input->post('sku_remark'),
                            'jobsheet_status' => 'not',
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
                        );
            $orderdata = $this->model_salesorder->fecthAllDatabyID($this->input->post('id'));
            
            $total = $orderdata['estimated_total'] + $this->input->post('sku_price');
            
            $updateOrderData = array(
                                        'id' => $this->input->post('id'),
                                        'estimated_total' => $total
                                    );
             // echo "<pre>"; print_r($updateOrderData); echo "<pre>"; print_r($data); exit();
            $created_id = $this->model_salesorder->createQty($data);

            if($created_id) {
                
                $orderData = array(
                                    'id' => $this->input->post('id'),
                                    'paymentstatus' => 'no'
                                );
                                
                $this->model_salesorder->update($orderData);
                
                $this->model_salesorder->update($updateOrderData);

                $msg['msg'] = "Data Insert Successfully";
                $msg['code'] = "success";
                echo json_encode($msg);
            }
            else
            {
                $msg['msg'] = "Unable to Insert Data";
                $msg['code'] = "error";
                echo json_encode($msg);
            }
    }

    public function showSalesorderSkuData()
    {
        $id = $_POST['orderid'];
        $data = $this->model_salesorder->fecthQtyDataForSalesOrder($id);
        echo json_encode($data);
        exit();
    }

    public function addQtyUpdate()
    {
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
               
           // echo "<pre>"; print_r($_POST);exit;
           
           $data = array(
                            'salesorder_id' => $this->input->post('id'),  // order_id
                            'sku' => $this->input->post('sku'),
                            'quantity' => $this->input->post('quality'),
                            'price' => $this->input->post('estimate_price'),
                            'remark' => $this->input->post('remark'),
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
                        );
            $orderdata = $this->model_salesorder->fecthAllDatabyID($this->input->post('id'));
            
            $total = $orderdata['estimated_total'] + $this->input->post('estimate_price');
            
            $updateOrderData = array(
                                        'id' => $this->input->post('id'),
                                        'estimated_total' => $total
                                    );
        //  echo "<pre>"; print_r($updateOrderData); echo "<pre>"; print_r($data); exit();
            $created_id = $this->model_salesorder->createQty($data);
            
            if($created_id == true) {
                
                $orderData = array(
                                    'id' => $this->input->post('id'),
                                    'paymentstatus' => 'no'
                                );
                                
               $this->model_salesorder->update($orderData);
                
                $this->model_salesorder->update($updateOrderData);
                
                $this->session->set_flashdata('feedback','Data Saved Successfully');
                $this->session->set_flashdata('feedback_class','alert alert-success');
                
                return redirect('sales_order/updateAddQty/'.$this->input->post('id'));
            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                return redirect('sales_order/updateAddQty/'.$this->input->post('id'));
            }
        }
        else
        {
            $id = $this->uri->segment(3);
            $this->data['id'] = $id;
            
            $this->data['sku'] = $this->model_sku->fecthAllData();
            $this->data['allQty'] = $this->model_salesorder->fecthQtyData($id);
            $this->data['salesorderData'] = $this->model_salesorder->fecthAllDatabyID($id);

            $data = array(
                            'inventory_id' => $id,
                            'inventory_type' => 'salesorder'
                        );

            $this->data['conversionData'] = $this->model_salesorder->fecthConversionData($data);
            
            $this->render_template('admin_view/salesMaster/salesOrder/updateAddQty', $this->data);    
        }
    }

    public function updateAddQty()
    {
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
               
           // echo "<pre>"; print_r($_POST);exit;
           
           $data = array(
                            'salesorder_id' => $this->input->post('id'),  // order_id
                            'sku' => $this->input->post('sku'),
                            'quantity' => $this->input->post('quality'),
                            'price' => $this->input->post('estimate_price'),
                            'remark' => $this->input->post('remark'),
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
                        );
            $orderdata = $this->model_salesorder->fecthAllDatabyID($this->input->post('id'));
            
            $total = $orderdata['estimated_total'] + $this->input->post('estimate_price');
            
            $updateOrderData = array(
                                        'id' => $this->input->post('id'),
                                        'estimated_total' => $total
                                    );
        //  echo "<pre>"; print_r($updateOrderData); echo "<pre>"; print_r($data); exit();
            $created_id = $this->model_salesorder->createQty($data);
            
            if($created_id == true) {
                
                $orderData = array(
                                    'id' => $this->input->post('id'),
                                    'paymentstatus' => 'no'
                                );
                                
               $this->model_salesorder->update($orderData);
                
                $this->model_salesorder->update($updateOrderData);
                
                $this->session->set_flashdata('feedback','Data Saved Successfully');
                $this->session->set_flashdata('feedback_class','alert alert-success');
                
                return redirect('sales_order/addQty/'.$this->input->post('id'));
            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                return redirect('sales_order/addQty/'.$this->input->post('id'));
            }
        }
        else
        {
            $id = $this->uri->segment(3);
            $this->data['id'] = $id;
            
            $this->data['sku'] = $this->model_sku->fecthAllData();
            $this->data['allQty'] = $this->model_salesorder->fecthQtyData($id);
            $this->data['salesorderData'] = $this->model_salesorder->fecthAllDatabyID($id);

            $data = array(
                            'inventory_id' => $id,
                            'inventory_type' => 'salesorder'
                        );

            $this->data['conversionData'] = $this->model_salesorder->fecthConversionData($data);
            
            $this->render_template('admin_view/salesMaster/salesOrder/updateAddQty', $this->data);
        }
    }


    public function addOrderByBarcode()
    {
        // echo "<pre>"; print_r($_POST); exit();
        
        $fetchData = array(
    	                        'inventory_id' => $this->input->post('id'),
    	                        'inventory_type' => 'salesorder'
    	                    );
    	                    
    	$barcodeData = $this->model_salesinvoice->fecthSalesInvoiceDataByIdType($fetchData);
    	
    	if(!empty($barcodeData))
    	{
    	    $this->model_salesinvoice->deleteInvoiceData($fetchData);
    	}
    	    
        // echo "<pre>"; print_r($barcodeData); exit;
        
        $count_product = count($_POST['pno']);

        $sum = 0;
        for($i=0; $i<$count_product; $i++)
        {
            $sum = $sum + $this->input->post('finalprice')[$i];
        }
        // echo $sum; //exit();
        
        for($i=0; $i<$count_product; $i++)
        {
            $orderData = array(
                            'inventory_id' => $this->input->post('id'),
                            'inventory_type' => "salesorder",
                            'pno' => $this->input->post('pno')[$i],
                            'quantity' => $this->input->post('quantity')[$i],
                            'conversion' => $this->input->post('conversion')[$i],
                            'conversionvalue' => $this->input->post('conversionvalue')[$i],
                            'baseprice' => $this->input->post('baseprice')[$i],
                            // 'discount' => $this->input->post('discount')[$i],
                            // 'disvalue' => $this->input->post('disvalue')[$i],
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
            // echo "<pre>"; print_r($orderData);
            $created =  $this->model_salesinvoice->createInvoiceData($orderData);
            // $created = 1;

            // $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($this->input->post('pno')[$i]);

            // $newQty = $barcodeData['qty'] - $this->input->post('quantity')[$i];

            // // echo "BarcodeData<pre>"; print_r($barcodeData);
            // // echo "BarcodeData<pre>"; print_r($newQty);

            // $barcodeStatus = '';

            // if($newQty <= 0)
            // {
            //     $barcodeStatus = 'soldout';
            // }
            // else
            // {
            //     $barcodeStatus = 'available';
            // }

            // $newBarcodeData = array(
            //                             'id' => $barcodeData['id'],
            //                             'item_status' => $barcodeStatus,
            //                             'balQty' => $newQty
            //                         );
            // $this->model_barcode->update($newBarcodeData);

        }
        // exit;
        
        
        $updateData = array(
                            'id' => $this->input->post('id'),
                            'order_no' => $this->input->post('order_no'),
        					'order_date' => $this->input->post('order_date'),
        					'sales_account_id' => $this->input->post('sales_account'),
        					'account_id' => $this->input->post('account'),
        					'division_id' => $this->input->post('division'),
        					// 'branch_id' => $this->input->post('branch'),
        				// 	'location_id' => $this->input->post('location'),
        					// 'packet_by' => $this->input->post('packet_by'),
        					'order_status' => $this->input->post('status'),
        					'expected_date' => $this->input->post('completion_date'),
        					'completed_date' => $this->input->post('commited_date'),
        					'estimated_total' => $this->input->post('estimate_total'),
        					'order_type' => $this->input->post('order_type'),
        					'purchaseorder_id' => $this->input->post('purchase_order'),
                            'estimated_total' => $this->input->post('estimate_total')
                        );

            // echo "<pre>"; print_r($updateData);
            // exit;
        $update = $this->model_salesorder->update($updateData);

        if($update)
        {
            // $data = $this->model_salesorder->fecthAllDatabyID($this->input->post('id'));
            
            // $updateSum = $sum + $data['estimated_total'];
            
            
            if(isset($_POST['barcodesave']))
            {
                $this->session->set_flashdata('feedback','Data Saved Successfully');
                $this->session->set_flashdata('feedback_class','alert alert-success');
                // return redirect('sales_order/addQty/'.$this->input->post('id'));
                return redirect('sales_order');
            }
            else if(isset($_POST['jobsheet']))
            {
                 return redirect('production/create/salesorder/'.$this->input->post('id'));
            }
        }
        else
        {
            $this->session->set_flashdata('feedback','Unable to Saved Data');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            return redirect('sales_order/addQty/'.$this->input->post('id'));
            
        }
    }

    public function updateOrderByBarcode()
    {
        // echo "<pre>"; print_r($_POST); exit();
        $data = array(
                        'inventory_id' => $this->input->post('id'),
                        'inventory_type' => 'salesorder'
                    );

        $delete = $this->model_salesinvoice->deleteInvoiceData($data);

        $count_product = count($_POST['pno']);

        $sum = 0;
        for($i=0; $i<$count_product; $i++)
        {
            $sum = $sum + $this->input->post('finalprice')[$i];
        }

        // echo $sum; exit();
        for($i=0; $i<$count_product; $i++)
        {
            $orderData = array(
                            'inventory_id' => $this->input->post('id'),
                            'inventory_type' => "salesorder",
                            'pno' => $this->input->post('pno')[$i],
                            'quantity' => $this->input->post('quantity')[$i],
                            'conversion' => $this->input->post('conversion')[$i],
                            'conversionvalue' => $this->input->post('conversionvalue')[$i],
                            'baseprice' => $this->input->post('baseprice')[$i],
                            // 'discount' => $this->input->post('discount')[$i],
                            // 'disvalue' => $this->input->post('disvalue')[$i],
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
            // echo "<pre>"; print_r($orderData);
            $created =  $this->model_salesinvoice->createInvoiceData($orderData);
            // $created = 1;
        }

        if($created)
        {
            $data = array(
                            'id' => $this->input->post('id'),
                            'estimated_total' => $sum
                        );

            // echo "<pre>"; print_r($data);
            $this->model_salesorder->update($data);

            $this->session->set_flashdata('feedback','Data Saved Successfully');
            $this->session->set_flashdata('feedback_class','alert alert-success');
            return redirect('sales_order');
        }
        else
        {
            $this->session->set_flashdata('feedback','Unable to Saved Data');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            return redirect('sales_order');
        }
    }
	
	public function updateQty()
	{
	    $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       //print_r($_POST);exit;
	       
	       $data = array(
        					'id' => $this->input->post('id'),
        					'salesorder_id' => $this->input->post('salesorder_id'),
        					'sku' => $this->input->post('sku'),
        					'quantity' => $this->input->post('quality'),
        					'price' => $this->input->post('estimate_price'),
        					'remark' => $this->input->post('remark'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
        				
            $orderData = $this->model_salesorder->fecthAllDatabyID($this->input->post('salesorder_id'));
            
            $updatePrice = $orderData['estimated_total'] - $this->input->post('oldestimate_price');
            
            $newPrice = $updatePrice + $this->input->post('estimate_price');
            
            $updateOrder = array(
                                    'id' => $orderData['id'],
                                    'estimated_total' => $newPrice
                                );

        //     echo "<pre>"; print_r($updateOrder); //exit();
        // 	echo "<pre>"; print_r($data); exit();
        	$created = $this->model_salesorder->updateQty($data);
        	
        	if($created == true) {
        	    
        	    $orderData = array(
        	                        'id' => $orderData['id'],
        	                        'paymentstatus' => 'yes'
        	                    );
        	                    
        	   $this->model_salesorder->update($orderData);
        	    
        	    $this->model_salesorder->update($updateOrder);
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('sales_order/addQty/'.$this->input->post('salesorder_id'));
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('sales_order/addQty/'.$this->input->post('salesorder_id'));
        	}
	    }
	    else
	    {
	        $id = $this->uri->segment(3);
    	    $this->data['id'] = $id;
    	    
    	    $this->data['sku'] = $this->model_sku->fecthAllData();
    	    
    	    $this->data['qtyitem'] = $this->model_salesorder->fetchQtyDataById($id);
    	    
    	    $this->render_template('admin_view/salesMaster/salesOrder/updateQty', $this->data);    
	    }
	}
	
	public function updateModalQty()
	{
	    $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	       // echo "<pre>"; print_r($_POST);
	        
	        $data = $this->model_salesorder->fecthAllDatabyID($_POST['editorderid']);
	    
	        $qtyData = $this->model_salesorder->fetchQtyDataById($_POST['editid']);
	        
	       // echo "<pre>"; print_r($qtyData);
    	                
    	    $delete = $this->model_salesorder->deleteQty($_POST['editid']);	
            // $delete = 1;
		    if($delete) {
		        
		        $updateQtyData = array(
	                                    'id' => $_POST['editid'],
            	                      	'salesorder_id' => $_POST['editorderid'],  // order_id
                    					'sku' => $this->input->post('sku'),
                    					'quantity' => $this->input->post('editqty'),
                    					'price' => $this->input->post('editprice'),
                    					'remark' => $this->input->post('editremark'),
                    					'company_id' => $this->session->userdata('wo_company'),
                    					// 'city_id' => $this->session->userdata('wo_city'),
                    					'store_id' => $this->session->userdata('wo_store'),
                    					'modified_by' => $this->session->userdata('wo_id')
	                           );
	                           
	            $this->model_salesorder->createQty($updateQtyData);
    	        
    	        $estimated_total = $data['estimated_total'] - $qtyData['price'];
	    
        	    $newOrderData = array(
        	                    'id' => $data['id'],
        	                    'estimated_total' => $estimated_total
        	                );
        	   
        	   $this->model_salesorder->update($newOrderData);
        	    
        	    $total = $estimated_total + $_POST['editprice'];
            
                $updateOrderData = array(
                	                    'id' => $data['id'],
                	                    'estimated_total' => $total
                	                );
                
                $this->model_salesorder->update($updateOrderData);
		    
		      //  echo "<pre>"; print_r($updateQtyData); echo "<pre>"; print_r($newOrderData); echo "<pre>"; print_r($updateOrderData);
		      
		        $this->session->set_flashdata('feedback','Data Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('sales_order/addQty/'.$_POST['editorderid']);
		    }
		    else
		    {
		        $this->session->set_flashdata('feedback','Unable to Update record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('sales_order/addQty/'.$_POST['editorderid']);
		    }
	        
	    }
	    else
	    {
	        $id = $this->uri->segment(3);
    	    $this->data['id'] = $id;
    	    
    	    
    	    $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();
    	    $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    $this->data['purchaseorder'] = $this->model_purchaseorder->fecthAllData();
    	    
    	    $this->data['allData'] = $this->model_salesorder->fecthAllDatabyID($id);
    	    
    	    $this->data['sku'] = $this->model_sku->fecthAllData();
    	    $this->data['allQty'] = $this->model_salesorder->fecthQtyData($id);
    	    $this->data['salesorderData'] = $this->model_salesorder->fecthAllDatabyID($id);
    	    
    	    $this->render_template('admin_view/salesMaster/salesOrder/addQty', $this->data);     
	    }
	    
	}
	
	public function deleteQty()
	{
	    $id = $this->uri->segment(3);
	    $order_id = $this->uri->segment(4);
	    
	    $data = $this->model_salesorder->fecthAllDatabyID($order_id);
	    
	    $qtyData = $this->model_salesorder->fetchQtyDataById($id);
	   // echo "<pre>"; print_r($data); echo "<pre>"; print_r($qtyData); exit;
	    
	    $estimated_total = $data['estimated_total'] - $qtyData['price'];
	    
	    $data = array(
	                    'id' => $data['id'],
	                    'estimated_total' => $estimated_total
	                );
	                
	   //echo "<pre>"; print_r($data); exit;
	    
	    $delete = $this->model_salesorder->deleteQty($id);	

		if($delete) {
		    
		    $this->model_salesorder->update($data);
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			
			return redirect('sales_order/addQty/'.$order_id);
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
		    
		    return redirect('sales_order/addQty/'.$order_id);
    	}
	}
	
	public function salesOrderReport()
	{
	    $id = $this->uri->segment(3);

        $company_id = $this->session->userdata['wo_company'];
        $companyDetails = $this->model_company->fecthDataByID($company_id);

        $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
	    
	    $orderData = $this->model_salesorder->fecthAllDatabyID($id);
	    
	    $customerData = $this->model_ledger->fecthAllDatabyID($orderData['account_id']);
	    
        $qtyData = $this->model_salesorder->fecthQtyData($id);
        
	    $qtyData = $this->model_salesorder->fecthQtyData($id);
	    
	    $estiData = $this->model_salesorder->fetchPaymentDataById($id);
	    
	    $balance = $orderData['estimated_total'] - $estiData['paid'];
	    
        $data = array(
                        'inventory_id' => $id,
                        'inventory_type' => 'salesorder'
                    );

        $barcodeData = $this->model_salesinvoice->fecthItemDataByIdType($data);
       // echo "<pre>"; print_r($orderData);

       // $paymentData = array(
       //                      'inventory_id' => $id,
       //                      'inventory_type' => 'salesorder'
       //                  );

       // $makePaymentData = $this->model_salesorder->fecthConversionData($paymentData);

       // $paymentType = $this->model_payment->fecthDataByID($makePaymentData['paymenttype_id']);
	   // echo "<pre>"; print_r($barcodeData);
	   // echo $balance;
	   // exit;
	    
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
						
						<style>
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
					<body onload="window.print();" style="padding:7px;">
					    <div class="content-wrapper">
						    <section class="content">
						        <table width="100%" class="myBorder">
						            <tr>
						                <td>
						                    <h5><center><b>Order Form</b></center></h5>
						                </td>
						            </tr>
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
                                        <td class="topBorder">
                                            <div align="left">
                                                <div><b>&nbsp; Order No:</b> '.$orderData['order_no'].' </div>
                                                <div><b>&nbsp; Order Date:</b> '.$orderData['order_date'].' </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="topBorder">
                                            <div align="left">
                                                <div>&nbsp; Name, Address & GSTIN Number of Receipient</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="topBorder">
                                            <b>&nbsp; From:</b>
                                            <table width="95%" align="center">
                                                <tr>
                                                    <td width="50%">
                                                        <div>Name: '.$customerData['ledger_name'].'</div>
                                                        <div>Contact: '.$customerData['mobile'].' '.$customerData['phone'].'</div>
                                                        <div>Address: '.$customerData['address_1'].',<br><span style="padding-left: 60px;">'.$customerData['city'].' '.$customerData['state'].'</span></div>
                                                    </td>
                                                    <td> 
                                                        <div>GST No: '.$customerData['gst'].'</div>
                                                        <div>Payment Type: </div>
                                                        <div>Committed delivery: '.date('d-m-Y', strtotime($orderData['completed_date'])).'</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" border="1">
                                                <tr>
                                                    <th>&nbsp; Sr No.</th>
                                                    <th>&nbsp; SKU</th>
                                                    <th>&nbsp; Category</th>
                                                    <th>&nbsp; Sub-category</th>
                                                    <th>&nbsp; Quantity</th>
                                                    <th>&nbsp; Estimated Price</th>
                                                    <th>&nbsp; Remark</th>
                                                </tr>';
                                                $no=1;
                                                foreach($qtyData as $rows)
                                                {
                                                    $productData = $this->model_purchaseorder->fecthAllDatabyPCode($rows->sku);
                                                    
                                                    $skuData = $this->model_sku->fecthSkuDataByID($rows->sku);

                                                    // echo "<pre>"; print_r($skuData); 
                                                    $catData = $this->model_category->fecthCatDataByID($skuData['category_id']);
                                                    
                                                    $subCatData = $this->model_category->fecthSubCatDataByID($skuData['subcategory_id']);
                                                    
                                                    // print_r($productData['category_id']);print_r($productData['subcategory_id']);
                                                    $html .= '<tr>
                                                                <td>&nbsp; '.$no.'</td>
                                                                <td>&nbsp; '.$skuData['product_code'].'</td>
                                                                <td>&nbsp; '.$catData['catgory_name'].'</td>
                                                                <td>&nbsp; '.$subCatData['subcategory_name'].'</td>
                                                                <td>&nbsp; '.$rows->quantity.'</td>
                                                                <td>&nbsp; '.$rows->price.'</td>
                                                                <td>&nbsp; '.$rows->remark.'</td>
                                                            </tr>';
                                                    $no++;
                                                }

                                                foreach ($barcodeData as $key => $value) {

                                                    $skuData = $this->model_sku->fecthSkuDataByID($value['sku']);

                                                    // echo "<pre>"; print_r($skuData); 
                                                    $catData = $this->model_category->fecthCatDataByID($skuData['category_id']);
                                                    
                                                    $subCatData = $this->model_category->fecthSubCatDataByID($skuData['subcategory_id']);
                                                    
                                                    // print_r($productData['category_id']);print_r($productData['subcategory_id']);
                                                    $html .= '<tr>
                                                                <td>&nbsp; '.$no.'</td>
                                                                <td>&nbsp; '.$skuData['product_code'].'</td>
                                                                <td>&nbsp; '.$catData['catgory_name'].'</td>
                                                                <td>&nbsp; '.$subCatData['subcategory_name'].'</td>
                                                                <td>&nbsp; '.$value['quantity'].'</td>
                                                                <td>&nbsp; '.$value['finalprice'].'</td>
                                                                <td>&nbsp;</td>
                                                            </tr>';
                                                    $no++;
                                                }
                                                
                                        $html .= '</table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <table width="20%" align="right">
                                                <tr>
                                                    <td>&nbsp; Estimated Total</td>
                                                    <td>&nbsp; '.$orderData['estimated_total'].'</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp; Amount Paid</td>
                                                    <td>&nbsp; '.$estiData['paid'].'</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp; Amount Remaining</td>
                                                    <td>&nbsp; '.$balance.'</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 5px;">
                                            <h6><b style="border-bottom: 2px solid black;">Terms & Conditions:</b></h6>
                                            
                                            &nbsp; 1) No Cancellation/ Exchange or Return of Made to Ordered or Altered Items.<br>
                                            &nbsp; 2) Above mentioned prices are estimated, Actual Prices & All Applicable Taxes/GST would be Charged Extra at the time of Billing.<br>
                                            &nbsp; 3) Designs/Patterns of catalogues and/or photos are Only for Reference,No Gurantee of Exact actual final product,customer discretion before placing order is advised.<br>
                                            &nbsp; 4) 100% Advance payment of estimated amount is required while placing order.<br>
                                            &nbsp; 5) Payment against Made to Order or to be Altered product is Non-Refundable.<br>
                                            &nbsp; 6) No Gurantee/Warranty on designs/patterns and color fastness.<br>
                                            &nbsp; 7) Any Manufacturing/Fitting Defect would be resolved by means of Alteration/Repairs.<br>
                                            &nbsp; 8) Committed Delivery date can change,depending upon the prevailing conditions and supplies.<br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <div align="left">
                                                <span>&nbsp; I have read, understood and agree the above mentioned terms and conditions of order.<span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div align="right" style="padding-right: 55px;">
                                                <span>Customer Signature <span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br>
                                            &nbsp;
                                            <span><b>* This is a Computer Generated Document hence no Signature is Required</b></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
						    </section>
			
				        </div>
					</body>
				</html>';

			echo $html;
	}
	
	public function makepayment()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('paid', 'Paid Amount', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); //exit();

            $salesOrderData = $this->model_salesorder->fecthAllDatabyID($this->input->post('id'));

            // echo "<pre>"; print_r($salesOrderData); //exit();
	       
	        $data = array(
        					'salesorder_id' => $this->input->post('id'),
        					'type' => 'salesorder',
        					'estimate' => $this->input->post('estimated'),
        					'paid' => $this->input->post('paid'),
        					'balance' => $this->input->post('remainingpaid'),
        					'date' => $this->input->post('entrydate'),
        					'check_num' => $this->input->post('number'),
        					'paymenttype_id' => $this->input->post('payment_type'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        				// 	'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
        				
            // 	echo "<pre>"; print_r($data); exit();
        	
            $created = $this->model_salesorder->makepayment($data);
        	// $created = true;
        	
        	if($created == true) {
        	    
        	    $status = 'Credit Sales';
        	                    
                $accountLedgerData = $this->model_ledger->fecthDataByID($salesOrderData['account_id']);

                $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] + $this->input->post('paid');

                // update account Ledger
                $accountLedgerDataUpdate = array(
                                                    'id' => $accountLedgerData['id'],
                                                    'opening_balance' => $accountLedgerData['closing_balance'],
                                                    'closing_balance' => $updateAccountLedgerAmt
                                                );

                // Add Data to Sales Ledger Table
                $accountLedger = array(
                                            'purchase_id' => $salesOrderData['id'],
                                            'ledger_id' => $accountLedgerData['id'],
                                            'invoice_date' => $_POST['entrydate'],
                                            'entry_date' => $_POST['entrydate'],
                                            'purchase_type' => "salesorder",
                                            'dr_cr' => 'CR',
                                            'amt' => abs($this->input->post('paid')),
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
                
                
                if($this->input->post('payment_type') != 7)
                {
                    $status = 'Payment Done';
                    
                    $paymentType = $this->model_paymentmaster->fecthDataByID($this->input->post('payment_type'));
                    $paymentTypeLedgerData = $this->model_ledger->fecthDataByID($paymentType['ledger_id']);
    
                    $paymentTypeLedgerAmt = $paymentTypeLedgerData['closing_balance'] - $this->input->post('paid');
    
                    // update account Ledger
                    $paymentLedgerDataUpdate = array(
                                                        'id' => $paymentTypeLedgerData['id'],
                                                        'opening_balance' => $paymentTypeLedgerData['closing_balance'],
                                                        'closing_balance' => $paymentTypeLedgerAmt
                                                    );
                    $paymentLedger = array(
                                            'purchase_id' => $salesOrderData['id'],
                                            'ledger_id' => $paymentTypeLedgerData['id'],
                                            'invoice_date' => $_POST['entrydate'],
                                            'entry_date' => $_POST['entrydate'],
                                            'purchase_type' => "salesorder",
                                            'dr_cr' => 'DR',
                                            'amt' => $this->input->post('paid'),
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
                
                 $data = array(
        					'id' => $this->input->post('id'),
        					'invoice_status' => $status,
        					'modified_by' => $this->session->userdata('wo_id')
        				);
    	        
            	// echo "<pre>"; print_r($data); exit();
                $create = $this->model_salesinvoice->update($data);


        	   //  //   create journal entry
        	   //  $salesorderData = $this->model_salesorder->fecthAllDatabyID($this->input->post('id'));
        	
            // 	$accountLedgerFrom = $this->model_ledger->fecthDataByID($salesorderData['account_id']);
            // 	$cashbookLedgerTo = $this->model_ledger->fecthDataByID(18);
            	
            // // 	echo "<pre>"; print_r($salesorderData); echo "<pre>"; print_r($accountLedgerFrom); echo "<pre>"; print_r($cashbookLedgerTo); 
            	
            // 	$toclosing_balance = $cashbookLedgerTo['closing_balance'] + $this->input->post('paid');
            // 	$fromclosing_balance = $accountLedgerFrom['closing_balance'] - $this->input->post('paid');
            	
            	
            // 	$orderNo = $this->model_journalentry->lastrecord();
                
            //     if($orderNo == '')
            //     {
            //         // $this->data['voucherno']  = '1';
            //         $voucherno = '1';
            //     }
            //     else
            //     {
            //         $np = $orderNo['voucherno'];
            //         // $code = substr($np, 1); 
                    
            //         $np = $np + 1;
            //         // $code = sprintf('%05d',$code);
            //         $voucherno = $np;
            //         // $this->data['voucherno'] = $np;
            //     }
            //     // 	echo "<br>";
            //     // 	echo $voucherno;
            	
            // 	$data = array(
            // 					'voucherno' => $voucherno,
            //                     'date' => $this->input->post('entrydate'),
            //                     'cr_ledgerid' => $cashbookLedgerTo['id'],
            //                     'dr_ledgerid' => $accountLedgerFrom['id'],
            //                     'amount' => $this->input->post('paid'),
            //                     // 'referernceno' => $this->input->post('reference'),
            //                     // 'remark' => $this->input->post('remark'),
            //                     'fromopeningstock' => $cashbookLedgerTo['closing_balance'],
            //                     'fromclosingstock' => $toclosing_balance,
            //                     'toopeningstock' => $accountLedgerFrom['closing_balance'],
            //                     'toclosingstock' => $fromclosing_balance,
            //                     'company_id' => $this->session->userdata('wo_company'),
            //                     // 'city_id' => $this->session->userdata('wo_city'),
            //                     // 'store_id' => $this->session->userdata('wo_store'),
            //                     'created_by' => $this->session->userdata('wo_id')
            // 				);
            //     // 	echo "<pre>"; print_r($data);
                
            //     $created_id = $this->model_journalentry->create($data);
                
            //     if($created_id == true) {

            //         $journalEntries = array(
            //                                     'entry_type' => 'salesorder payment',
            //                                     'entry_id' => $created_id,
            //                                     'fomledger_id' => $cashbookLedgerTo['id'],
            //                                     'toledger_id' => $accountLedgerFrom['id'],
            //                                     'company_id' => $this->session->userdata('wo_company'),
            //                                     // 'city_id' => $this->session->userdata('wo_city'),
            //                                     // 'store_id' => $this->session->userdata('wo_store'),
            //                                     'created_by' => $this->session->userdata('wo_id')
            //                                 );
                                            
            //         $this->model_ledgerentry->create($journalEntries);
                    
            //         $fromLedgerUpdateData = array(
            //                                         'id' => $accountLedgerFrom['id'],
            //                                         'opening_balance' => $accountLedgerFrom['closing_balance'],
            //                                         'closing_balance' => $fromclosing_balance
            //                                     );
            //         // echo "<pre>"; print_r($fromLedgerUpdateData);
                    	
            //     	$toLedgerUpdateData = array(
            //                                         'id' => $cashbookLedgerTo['id'],
            //                                         'opening_balance' => $cashbookLedgerTo['closing_balance'],
            //                                         'closing_balance' => $toclosing_balance
            //                                     );
            //         // 	echo "<pre>"; print_r($toLedgerUpdateData);

            //         $this->model_ledger->update($fromLedgerUpdateData);
            //         $this->model_ledger->update($toLedgerUpdateData);
            //     }
                
            //     // 	exit();
                
            //     $estimated_total = $salesorderData['estimated_total'] - $this->input->post('paid');
                
            //     $orderData = array(
        	   //                      'id' => $this->input->post('id'),
        	   //                      'estimated_total' => $estimated_total,
        	   //                     // 'paymentstatus' => 'yes'
        	   //                  );
            	
        	   //  $this->model_salesorder->update($orderData);

                // exit();
        	    
                if(!empty($_POST['print']))
    	        {
    	            return redirect('sales_order/salesOrderReport/'.$this->input->post('id'));
    	        }
    	        else
    	        {
    	            $this->session->set_flashdata('feedback','Payment Succesfull Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				
    				return redirect('sales_order');
    	        }
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Make Payment');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('sales_order');
        	}
	    }
	    
	    $this->data['id'] = $id;
	    
	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
	    $this->data['allData'] = $this->model_salesorder->fecthAllDatabyID($id);
	    
	    $this->render_template('admin_view/salesMaster/salesOrder/makePayment', $this->data); 
	}
	
}