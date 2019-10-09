<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		error_reporting(0);

		$this->data['page_title'] = 'Production';
		
		$this->load->model('model_ledger');
		$this->load->model('model_category');
		$this->load->model('model_sku');
		$this->load->model('model_salesorder');
		$this->load->model('model_servicetype');
		$this->load->model('model_gst');
		
		$this->load->model('model_production');
		$this->load->model('model_furtherprocess');
		
		$this->load->model('model_discount');
		$this->load->model('model_brand');
		$this->load->model('model_unit');
		$this->load->model('model_hsn');
		$this->load->model('model_location');
		$this->load->model('model_division');
		$this->load->model('model_store');
		
		$this->load->model('model_barcode');
		$this->load->model('model_alternate');
		$this->load->model('model_salesinvoice');
		
		$this->load->model('model_openingitem');
		$this->load->model('model_purchaseledger');
		$this->load->model('model_attribute');

		$this->load->model('model_company');
		$this->load->model('model_attribute');
		
	}
	
	public function insertServices()
	{
        $data = $this->model_production->insertServices();
    	echo json_encode($data);
	}
	
	public function fecthServicesByJobId()
	{
	    $jobno = $_POST['jobno'];
	    $data=$this->model_production->fecthServicesByJobId($jobno);
		echo json_encode($data);
	}
	
	public function deleteServices()
	{
	   $data=$this->model_production->deleteServices();
		echo json_encode($data);
	}
    
	public function index()
	{
		$this->render_template('admin_view/productionMaster/production/index', $this->data);
	}
	
	public function fetchAllData()
	{
	    $dataProduction = $this->model_production->fecthAllData();
	    $dataAlteration = $this->model_alternate->fecthAllData();
	    
	    $data = array_merge($dataProduction, $dataAlteration);
	    
	   // echo "<pre>"; print_r($data); //exit;

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
	            
	            if($value['type'] == 'production')
	            {
                    $sku = $this->model_sku->fecthSkuDataByID($value['sku']);
    	            $salesorder = $this->model_salesorder->fecthAllDatabyID($value['salesorder_id']);
    	            $subcat = $this->model_category->fecthSubCatDataByID($value['p_scate']);
    	            $service = $this->model_production->fecthServicesByProductIdAssignWork($value['id']);
    	            
    	            $customerData = $this->model_ledger->fecthDataByID($value['customer']);
    
    	            $workerData = $this->model_production->fecthServicesByPId($value['id']);
    	            
    	            $worker = $this->model_ledger->fecthDataByID($workerData['assign_work']);
    
    	           // echo "<pre>"; print_r($workerData);

    	            if($value['status'] == 'Complete')
    	            {
	    	            $buttons .= '&nbsp; <a href="'.base_url().'production/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>';
	    	        }
	    	        else
	    	        {
	    	            $buttons .= '&nbsp; <a href="'.base_url().'production/updateAll/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>';
	    	        }

    	            
    	            $buttons .= '&nbsp; <a href="'.base_url().'production/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                    
                    $buttons .= '&nbsp; <a href="'.base_url().'production/printjoboption/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a>';
    	            
    	            if($value['status'] == 'Complete')
    	            {
    	                $buttons .= '&nbsp; <a href="'.base_url().'production/viewBarcode1/'.$value['id'].'" class="btn btn-sm btn-info">Details</a>';
    	            }
    	            
    	            
    	            $job_no = $value['jobsheet_no'];
    	            $sku = $sku['product_code'];
    	            $date = date("d-m-Y", strtotime($value['delivery_date']));
    	            $orderno = $salesorder['order_no'] == '' ? "-" : $salesorder['order_no'];
    	            $customer = $customerData['ledger_name'];
    	            $worker = $worker['ledger_name'] == '' ? "-" : $worker['ledger_name'];
    	            $qty = $value['quantity'];
    	            $status = $value['status'];
	            }
	            else
	            {
	                $salesinvoice = $this->model_salesinvoice->fecthAllDataByID($value['salesinvoice_id']);
	                
	                $workerData = $this->model_alternate->fecthServicesByPId($value['id']);
	                
	               // echo "<pre>"; print_r($workerData);
    	            
    	            $worker = $this->model_ledger->fecthDataByID($workerData['assign_work']);
                    
                    $buttons .= '&nbsp; <a href="'.base_url().'alternate/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>';
    	           // $buttons .= '&nbsp; <a href="'.base_url().'production/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';
                    
                    $buttons .= '&nbsp; <a href="'.base_url().'alternate/printAlt/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-print"></i></a>';
    	            
	                
	                $job_no = $value['alternate_no'];
    	            $sku = '-';
    	            $date = date("d-m-Y", strtotime($value['delivery_date']));
    	            $orderno = $salesinvoice['inventory_no'];
    	            $customer = '';
    	            $worker = $worker['ledger_name'] == '' ? "-" : $worker['ledger_name'];
    	            $qty = '';
    	            $status = $value['status'];
	            }
	            

	            
	            $result['data'][$key] = array(  
	                                            '<b>'.ucwords($value['type']).'</b>',
	                                            $job_no,
	                                            $sku,
	                                            $date,
	                                            $orderno,
	                                           // $subcat['subcategory_name'],
	                                            $customer,
	                                            $worker,
	                                            $qty,
	                                            $status,
	                                            $buttons
	                                        );
	            $no++;
	        }
	    }
	   // exit();
        // echo "<pre>"; print_r($result);
        echo json_encode($result);
        exit;
	}
	
	public function viewBarcode1()
	{
	    $id = $this->uri->segment(3);
	   
	    $data = array(
	                   'order_id' => $id,
	                   'ordertype' => 'production'
	                );
	                
	    $data = $this->model_openingitem->fecthOrderDataByIdType($data);
	    
	    $data1 = array(
	                    'product_id' => $data['id'],
	                    'purchase_type' => $data['inventory_type']
	                );
	                
	    
	    $this->data['allData'] = $this->model_barcode->getBarcodeDataByProductId($data1);
	    
	    $this->render_template('admin_view/productMaster/product/detailsfromInvoice', $this->data);   
	}
	
	public function delete()
	{
	    $id = $this->uri->segment(3);
        // echo $id; exit;

		$barcodeData = $this->model_barcode->getProductionData($id);

	    $productionData = $this->model_production->fecthAllDatabyID($id);
	    // echo "<pre>"; print_r($barcodeData); exit();

		$delete = $this->model_production->delete($id);	

		if($delete == true) {

			$ptype = 'production';

			foreach($barcodeData as $rows)
		    {
		        $this->model_barcode->delete($rows['id']);
		    } 
            
            $this->model_production->deleteMaterialByPID($id, $ptype);
            $this->model_production->deleteMeasurement($id, $ptype);
            $this->model_production->deleteMeasurementReadymade($id, $ptype);

            $this->model_production->deleteServicesByPID($id, $ptype);
            $this->model_production->deleteDescription($id, $ptype);

			$ftype = 'furtherprocess';

            $this->model_furtherprocess->delete($productionData['furtherprocess_id']);
            $this->model_production->deleteMaterialByPID($productionData['furtherprocess_id'], $ftype);
            $this->model_production->deleteMeasurement($productionData['furtherprocess_id'], $ftype);
            $this->model_production->deleteMeasurementReadymade($productionData['furtherprocess_id'], $ftype);

            $this->model_production->deleteServicesByPID($productionData['furtherprocess_id'], $ftype);
            $this->model_production->deleteDescription($productionData['furtherprocess_id'], $ftype);
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('production');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('production');
    	}
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	       // echo "<pre>"; print_r($_POST); exit();
	       
	        $productData = array(
	                        'jobsheet_no' => $this->input->post('jobno'),
	                       // 'p_category' => $this->input->post('product_category'),
	                       // 'p_scate' => $this->input->post('product_subcategory'),
	                        'sku' => $this->input->post('sku'),
	                        'jobsheetdate' => $this->input->post('jobsheet_date'),
	                        'delivery_date' => $this->input->post('delivery_date'),
	                        'completion_date' => $this->input->post('jobcompletion_date'),
	                        'customer' => $this->input->post('customer_list'),
	                        'salesorder_id' => $this->input->post('sales_order'),
	                        'status' => $this->input->post('status'),
	                        'quantity' => $this->input->post('quantity'),
	                        'total_pcost' => $this->input->post('production_cost'),
	                        'pcost_unit' => $this->input->post('production_unit'),
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	       
	        $created_id = $this->model_production->create($productData);
	       //echo "<pre>"; print_r($productData); exit;
	       // $created_id = 1;
        	
        	if($created_id) {
        	    
        	   // update sales order QtyJobid
        	   
        	   if(isset($_POST['orderjob']) != '')
        	   {
        	        $salesOrder = array(
        	                            'id' => $this->input->post('orderjob'),
        	                            'jobsheet_status' => 'create',
        	                            'jobsheet_id' => $created_id
        	                       );
        	       
        	       //echo "<pre>"; print_r($salesOrder);
        	        $this->model_salesorder->updateQty($salesOrder);
        	   }
        	   
        	    
        	   // Cr To worker ledger
        	    // $countLedger = count($this->input->post('assign_worker'));
        	    
        	    // for ($i=0; $i < $countLedger; $i++) { 
        	    
        	    //     $ledgerData = $this->model_ledger->fecthDataByID($this->input->post('assign_worker')[$i]);
        	    //    // echo "<pre>"; print_r($ledgerData);
        	        
        	    //     $amt = $ledgerData['wallete_balance'] + $this->input->post('total')[$i]; 
        	       
        	    //     $data = array(
        	    //                     'id' => $ledgerData['id'],
        	    //                     'wallete_balance' => $amt
        	    //                 );
        	                    
        	    //    // echo "<pre>"; print_r($data);
        	    //    $this->model_ledger->update($data);
        	    // }
        	    
        		$countMaterial = count($this->input->post('pno'));

        		for ($i=0; $i < $countMaterial; $i++) { 
        			
        			$materialData = array(
        					'production_id' => $created_id,
	                    	'product_no' => $this->input->post('pno')[$i],
	                    	'quantity' => $this->input->post('quantityMaterial')[$i],
	                    	'conversion' => $this->input->post('conversion')[$i],
	                    	'conversion_value' => $this->input->post('conversionvalue')[$i],
	                    	'netprice' => $this->input->post('baseprice')[$i],
	                    	'subtotal' => $this->input->post('subtotal')[$i],
	                    	'production_type' => 'production',
	                    	'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                   	);
                        
                        // echo "<pre>"; print_r($materialData);
	        			$this->model_production->createMaterial($materialData);
	        			
	        			$barcodeData = $this->model_barcode->fetchBarcodeData($this->input->post('pno')[$i]);

	        			$newQty = $barcodeData['balQty'] - $this->input->post('quantity')[$i];

	        			$barcodeStatus = '';

	        			if($newQty <= 0)
			            {
			                $barcodeStatus = 'soldout';
			            }
			            else
			            {
			                $barcodeStatus = 'available';
			            }

			            $newBarcodeData = array(
			                                        'id' => $barcodeData['id'],
			                                        'item_status' => $barcodeStatus,
			                                        'balQty' => $newQty
			                                    );
			            $this->model_barcode->update($newBarcodeData);
	        			
	        			// // echo "<pre>"; print_r($barcodeData);
	        			
	        			// $barcode = array(
	        			//                     'id' => $barcodeData['id'],
	        			//                     'item_status' => 'soldout'
	        			//                 );
	        			                
	        			// // echo "<pre>"; print_r($barcode);
	        			// $this->model_barcode->update($barcode);
        			}
        		
			        //$production_id = '1';
			        $measurementData = array(
	                        'production_id' => $created_id,
	                        'measurement' => $this->input->post('measuremnt'),
	                        
	                        'kshoulder' => $this->input->post('kshoulder'),
	                        'kchest' => $this->input->post('kchest'),
	                        'kpants' => $this->input->post('kpants'),
	                        'khand' => $this->input->post('khand'),
	                        'khip' => $this->input->post('khip'),
	                        'klength' => $this->input->post('klength'),
	                        'kthroat' => $this->input->post('kthroat'),
	                        
	                        'waist' => $this->input->post('waist'),
	                        'seat' => $this->input->post('seat'),
	                        'hanging' => $this->input->post('hanging'),
	                        'thigh' => $this->input->post('thigh'),
	                        'length' => $this->input->post('length'),
	                        'bottom' => $this->input->post('bottom'),
	                        
	                        'sshoulder' => $this->input->post('sshoulder'),
	                        'schest' => $this->input->post('schest'),
	                        'spants' => $this->input->post('spants'),
	                        'shand' => $this->input->post('shand'),
	                        'ship' => $this->input->post('ship'),
	                        'slength' => $this->input->post('slength'),
	                        'sthroat' => $this->input->post('sthroat'),

	                    	'production_type' => 'production',
	                        
	                        // 'size' => $this->input->post('size'),
	                        // 'quantity' => $this->input->post('mquantity'),
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                );
	                
	               // echo "<pre>"; print_r($measurementData);
	        		$this->model_production->createMeasurement($measurementData);

	        		$countReadymad = count($this->input->post('readymadesizeList'));

    				for ($i=0; $i < $countReadymad; $i++) { 
    			
	    				$readymadData = array(
                    	    					'production_id' => $created_id,
                    	                    	'size' => $this->input->post('readymadesizeList')[$i],
                    	                    	'quantity' => $this->input->post('readymadequantityList')[$i],
                    		                   	'production_type' => 'production',
                    	                    	'company_id' => $this->session->userdata('wo_company'),
                    	    					// 'city_id' => $this->session->userdata('wo_city'),
                    	    					'store_id' => $this->session->userdata('wo_store'),
                    	    					'created_by' => $this->session->userdata('wo_id')
                                    	);
                    
    	        		$this->model_production->createMeasurementReadymade($readymadData);
        				// echo "<pre>"; print_r($readymadData);
        			}
	       // 	exit(); 
	       
	            $countService = count($this->input->post('service'));

        		for ($i=0; $i < $countService; $i++) {
        		    
        		    $serviceData = array(
                	                        'production_id' => $created_id,
                	                        'job_no' => $this->input->post('jobno'),
                	                        'service_type' => $this->input->post('service')[$i],
                	                        'assign_work' => $this->input->post('assign_worker')[$i],
                	                        'quantity' => $this->input->post('quality')[$i],
                	                        'rate' => $this->input->post('rate')[$i],
                	                        'gst' => $this->input->post('gst')[$i],
                	                        'gst_amount' => $this->input->post('total')[$i],
                	                        'production_type' => "production",
                	                        'company_id' => $this->session->userdata('wo_company'),
                	    					// 'city_id' => $this->session->userdata('wo_city'),
                	    					'store_id' => $this->session->userdata('wo_store'),
                	    					'created_by' => $this->session->userdata('wo_id')
                	                    );
                	        
    	           $this->model_production->createServices($serviceData);
        		  //  echo "<pre>"; print_r($serviceData);
        		}
        		
        // 		exit;
	        
	        	$descriptionData = array(
	                        'production_id' => $created_id,
	                        'description' => $this->input->post('description'),
	                        'company_id' => $this->session->userdata('wo_company'),
	                    	'production_type' => 'production',
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	                    
	           //echo "<pre>"; print_r($descriptionData);
	           // exit;
	            
	       		$this->model_production->createDescription($descriptionData);
	       		
	       		if(isset($_POST['print']))
	       		{
	       		  //  echo "Print Production Report";
	       		    return redirect('production/printjoboption/'.$created_id);
	       		}
	       		else if(isset($_POST['product']))
	       		{
	       		    return redirect('production/createProduct/'.$created_id);
	       		}
	       		else if(!empty($_POST['sales_order']))
	       		{
	       		    return redirect('sales_order/addQty/'.$_POST['sales_order']);
	       		}
	       		else
	       		{
	       		    $this->session->set_flashdata('feedback','Data Saved Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				
    				return redirect('production');
	       		}
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('production');
        	}
	    }
	    else
	    {
	        $orderNo = $this->model_production->lastrecord();
        	    
    	    if($orderNo == '')
    	    {
    	        $this->data['jobno']  = '0000001';
    	    }
    	    else
    	    {
    	        $np = $orderNo['jobsheet_no'];
    	        $code = substr($np, 1); 
    	        
    	        $code = $code + 1;
    	        $code = sprintf('%07d',$code);
    	        
    	        $this->data['jobno'] = $code;
    	    }
        	    
        	$this->data['employee'] = $this->model_ledger->fetchEmployee();
        	$this->data['category'] = $this->model_category->fecthAllData();
        	$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
        	$this->data['sku'] = $this->model_sku->fecthAllData();
        	$this->data['sales_order'] = $this->model_salesorder->fecthAllDataByMTO();
        	$this->data['servicetype'] = $this->model_servicetype->fecthAllData();
        	$this->data['gst'] = $this->model_gst->fecthAllData();
        	$this->data['ledgerAccount'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
        	
        	$this->data['type'] = $this->uri->segment(3); // for redirect to sales order
        	$this->data['sorderid'] = $this->uri->segment(4); // sales order id
        	$this->data['orderjob'] = $this->uri->segment(5); // sales order Jobsheet
            // 	echo $type; echo "<br>".$sorderid; echo "<br>".$orderjob; exit;
            
    		$this->render_template('admin_view/productionMaster/production/create', $this->data);   
	    }
	}

	public function updateAll()
	{
		$id = $this->uri->segment(3);
		

		$this->form_validation->set_rules('sku', 'SKU', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	       echo "<pre>"; print_r($_POST); //exit();

	    	$productData = array(
	    					'id' => $this->input->post('id'),
	                        'jobsheet_no' => $this->input->post('jobno'),
	                       // 'p_category' => $this->input->post('product_category'),
	                       // 'p_scate' => $this->input->post('product_subcategory'),
	                        'sku' => $this->input->post('sku'),
	                        'jobsheetdate' => $this->input->post('jobsheet_date'),
	                        'delivery_date' => $this->input->post('delivery_date'),
	                        'completion_date' => $this->input->post('jobcompletion_date'),
	                        'customer' => $this->input->post('customer_list'),
	                        'salesorder_id' => $this->input->post('sales_order'),
	                        'status' => $this->input->post('status'),
	                        'quantity' => $this->input->post('quantity'),
	                        'total_pcost' => $this->input->post('production_cost'),
	                        'pcost_unit' => $this->input->post('production_unit'),
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	       
	        $create = $this->model_production->update($productData);
	        // echo "Data<br>";
	       // echo "<pre>"; print_r($productData); 
	        if($create == true)
	        {
	        	if($this->input->post('status') == 'Complete')
        	   	{
            	   // Cr To worker ledger
            	    $countLedger = count($this->input->post('assign_worker'));
            	    
            	    for ($i=0; $i < $countLedger; $i++) { 
            	    
            	        $ledgerData = $this->model_ledger->fecthDataByID($this->input->post('assign_worker')[$i]);
            	       // echo "<pre>"; print_r($ledgerData);
            	        
            	        $amt = $ledgerData['closing_balance'] + $this->input->post('total')[$i]; 
            	       
            	        $accountLedgerDataUpdate = array(
            	                        'id' => $ledgerData['id'],
                                        'opening_balance' => $ledgerData['closing_balance'],
                                        'closing_balance' => $amt
            	                    );

            	        $accountLedger = array(
                                                'purchase_id' => $this->input->post('id'),
                                                'ledger_id' => $ledgerData['id'],
                                                'invoice_date' => $this->input->post('jobsheet_date'),
                                                'entry_date' => $this->input->post('jobcompletion_date'),
                                                'purchase_type' => "production",
                                                'dr_cr' => 'CR',
                                                'amt' => abs($this->input->post('total')[$i]),
                                                'opening_bal' => $ledgerData['closing_balance'],
                                                'closing_bal' => $amt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                            );

            	                    
            	        // echo "<pre>"; print_r($accountLedgerDataUpdate);
            	        // echo "<pre>"; print_r($accountLedger);
            	       	$this->model_ledger->update($accountLedgerDataUpdate);
	                    $this->model_purchaseledger->create($accountLedger);
            	    }
        	    }

        	    $this->model_production->deleteMaterialByPID($this->input->post('id'), 'production');

        	    $countMaterial = count($this->input->post('pno'));

        		for ($i=0; $i < $countMaterial; $i++) { 

        			$materialData = array(
			        					'production_id' => $this->input->post('id'),
				                    	'product_no' => $this->input->post('pno')[$i],
				                    	'quantity' => $this->input->post('quantityMaterial')[$i],
				                    	'conversion' => $this->input->post('conversion')[$i],
				                    	'conversion_value' => $this->input->post('conversionvalue')[$i],
				                    	'netprice' => $this->input->post('baseprice')[$i],
				                    	'subtotal' => $this->input->post('subtotal')[$i],
				                    	'production_type' => 'production',
				                    	'company_id' => $this->session->userdata('wo_company'),
			        					// 'city_id' => $this->session->userdata('wo_city'),
			        					'store_id' => $this->session->userdata('wo_store'),
			        					'created_by' => $this->session->userdata('wo_id')
				                   	);
                        
                        // echo "<pre>"; print_r($materialData);
	        			$this->model_production->createMaterial($materialData);
	        			
	        			$barcodeData = $this->model_barcode->fetchBarcodeData($this->input->post('pno')[$i]);

	        			$updateQty = $barcodeData['balQty'] + $this->input->post('quantity')[$i];

	        			$barcodeStatus = '';

	        			if($newQty <= 0)
			            {
			                $barcodeStatus = 'soldout';
			            }
			            else
			            {
			                $barcodeStatus = 'available';
			            }

			            $newBarcodeData = array(
			                                        'id' => $barcodeData['id'],
			                                        'item_status' => $barcodeStatus,
			                                        'balQty' => $updateQty
			                                    );
			            
			            $this->model_barcode->update($newBarcodeData);	


	        			$newQty = $barcodeData['balQty'] - $this->input->post('quantity')[$i];

	        			$barcodeStatus = '';

	        			if($newQty <= 0)
			            {
			                $barcodeStatus = 'soldout';
			            }
			            else
			            {
			                $barcodeStatus = 'available';
			            }

			            $newBarcodeData = array(
			                                        'id' => $barcodeData['id'],
			                                        'item_status' => $barcodeStatus,
			                                        'balQty' => $newQty
			                                    );
			            
			            $this->model_barcode->update($newBarcodeData);	
        			}

        	    $measurementData = array(
				                            'production_id' => $this->input->post('id'),
				                            'measurement' => $this->input->post('measuremnt'),
				                            
				                            'kshoulder' => $this->input->post('kshoulder'),
				                            'kchest' => $this->input->post('kchest'),
				                            'kpants' => $this->input->post('kpants'),
				                            'khand' => $this->input->post('khand'),
				                            'khip' => $this->input->post('khip'),
				                            'klength' => $this->input->post('klength'),
				                            'kthroat' => $this->input->post('kthroat'),
				                            
				                            'waist' => $this->input->post('waist'),
				                            'seat' => $this->input->post('seat'),
				                            'hanging' => $this->input->post('hanging'),
				                            'thigh' => $this->input->post('thigh'),
				                            'length' => $this->input->post('length'),
				                            'bottom' => $this->input->post('bottom'),
				                            
				                            'sshoulder' => $this->input->post('sshoulder'),
				                            'schest' => $this->input->post('schest'),
				                            'spants' => $this->input->post('spants'),
				                            'shand' => $this->input->post('shand'),
				                            'ship' => $this->input->post('ship'),
				                            'slength' => $this->input->post('slength'),
				                            'sthroat' => $this->input->post('sthroat'),
				                            
				                            // 'size' => $this->input->post('size'),
				                            // 'quantity' => $this->input->post('mquantity'),

					                    	'production_type' => 'production',

				                            'company_id' => $this->session->userdata('wo_company'),
				        					// 'city_id' => $this->session->userdata('wo_city'),
				        					'store_id' => $this->session->userdata('wo_store'),
				        					'created_by' => $this->session->userdata('wo_id')
				                        );

                // echo "<pre>"; print_r($measurementData);
    	        $this->model_production->updateMeasurement($measurementData);

        	$this->model_production->deleteMeasurementReadymade($this->input->post('id'), 'production');

    	    $countReadymad = count($this->input->post('readymadesizeList'));

			for ($i=0; $i < $countReadymad; $i++) { 
		
				$readymadData = array(
            	    					'production_id' => $this->input->post('id'),
            	                    	'size' => $this->input->post('readymadesizeList')[$i],
            	                    	'quantity' => $this->input->post('readymadequantityList')[$i],
            		                   	'production_type' => 'production',
            	                    	'company_id' => $this->session->userdata('wo_company'),
            	    					// 'city_id' => $this->session->userdata('wo_city'),
            	    					'store_id' => $this->session->userdata('wo_store'),
            	    					'created_by' => $this->session->userdata('wo_id')
                            	);
            
        		$this->model_production->createMeasurementReadymade($readymadData);
				// echo "<pre>"; print_r($readymadData);
			}

        	$this->model_production->deleteServicesByPID($this->input->post('id'), 'production');


			$countService = count($this->input->post('service'));

    		for ($i=0; $i < $countService; $i++) {
    		    
    		    $serviceData = array(
            	                        'production_id' => $this->input->post('id'),
            	                        'job_no' => $this->input->post('jobno'),
            	                        'service_type' => $this->input->post('service')[$i],
            	                        'assign_work' => $this->input->post('assign_worker')[$i],
            	                        'quantity' => $this->input->post('quality')[$i],
            	                        'rate' => $this->input->post('rate')[$i],
            	                        'gst' => $this->input->post('gst')[$i],
            	                        'gst_amount' => $this->input->post('total')[$i],
            	                        'production_type' => "production",
            	                        'company_id' => $this->session->userdata('wo_company'),
            	    					// 'city_id' => $this->session->userdata('wo_city'),
            	    					'store_id' => $this->session->userdata('wo_store'),
            	    					'created_by' => $this->session->userdata('wo_id')
            	                    );
            	        
	           $this->model_production->createServices($serviceData);
    		   // echo "<pre>"; print_r($serviceData);
        	}

        	$descriptionData = array(
                	            'production_id' => $this->input->post('id'),
    	                        'description' => $this->input->post('description'),
	                    		
	                    		'production_type' => 'production',

    	                        'company_id' => $this->session->userdata('wo_company'),
            					// 'city_id' => $this->session->userdata('wo_city'),
            					'store_id' => $this->session->userdata('wo_store'),
            					'created_by' => $this->session->userdata('wo_id')
    	                    );
    	             echo "<pre>"; print_r($descriptionData);
    	       
    	        $this->model_production->updatedescriptionData($descriptionData);

    	        $this->session->set_flashdata('feedback','Record Update Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				return redirect('production');
	    	
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('feedback','Unable to Update Record');
    				$this->session->set_flashdata('feedback_class','alert alert-danger');
    				return redirect('production');
	    	}
	   	}
	   	else
	   	{
        	$this->data['employee'] = $this->model_ledger->fetchEmployee();

	   		$this->data['category'] = $this->model_category->fecthAllData();
        	$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
        	$this->data['sku'] = $this->model_sku->fecthAllData();
        	$this->data['sales_order'] = $this->model_salesorder->fecthAllDataByMTO();
        	$this->data['servicetype'] = $this->model_servicetype->fecthAllData();
        	$this->data['gst'] = $this->model_gst->fecthAllData();
            
            $this->data['production'] = $this->model_production->fecthAllDatabyID($id);
        	$this->data['material'] = $this->model_production->fecthAllMaterialData($id);
        	$this->data['measurement'] = $this->model_production->fecthAllMeasurementData($id);
        	$this->data['readymadeMeasurement'] = $this->model_production->fecthAllReadymadeMeasurementData($id);
        	$this->data['service'] = $this->model_production->fecthServicesByProductId($id);
        	$this->data['description'] = $this->model_production->fecthAllDescriptionData($id);
        	$this->data['ledgerAccount'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
        	
    		$this->render_template('admin_view/productionMaster/production/production_updateAll', $this->data);  
	   	}
	}
	
	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	       // echo "<pre>"; print_r($_POST); //exit();
	    
	        $productData = array(
			                        'id' => $this->input->post('id'),
			                        'jobsheet_no' => $this->input->post('jobno'),
			                        'p_category' => $this->input->post('product_category'),
			                        'p_scate' => $this->input->post('product_subcategory'),
			                        'sku' => $this->input->post('sku'),
			                        'jobsheetdate' => $this->input->post('jobsheet_date'),
			                        'delivery_date' => $this->input->post('delivery_date'),
			                        'completion_date' => $this->input->post('jobcompletion_date'),
			                        'customer' => $this->input->post('customer_list'),
			                        'salesorder_id' => $this->input->post('sales_order'),
			                        'status' => $this->input->post('status'),
			                        'quantity' => $this->input->post('quantity'),
			                        'total_pcost' => $this->input->post('production_cost'),
			                        'pcost_unit' => $this->input->post('production_unit'),
			                        'company_id' => $this->session->userdata('wo_company'),
		        					// 'city_id' => $this->session->userdata('wo_city'),
		        					'store_id' => $this->session->userdata('wo_store'),
		        					'created_by' => $this->session->userdata('wo_id')
			                    );
	        // echo "<pre>"; print_r($productData); exit();
	        // $create = true;
	        $create = $this->model_production->update($productData);
	        
        	if($create == true) {

        		if($this->input->post('status') == 'Complete')
        	   	{
            	   // Cr To worker ledger
            	    $countLedger = count($this->input->post('assign_worker'));
            	    
            	    for ($i=0; $i < $countLedger; $i++) { 
            	    
            	        $ledgerData = $this->model_ledger->fecthDataByID($this->input->post('assign_worker')[$i]);
            	       // echo "<pre>"; print_r($ledgerData);
            	        
            	        $amt = $ledgerData['closing_balance'] + $this->input->post('total')[$i]; 
            	       
            	        $accountLedgerDataUpdate = array(
            	                        'id' => $ledgerData['id'],
                                        'opening_balance' => $ledgerData['closing_balance'],
                                        'closing_balance' => $amt
            	                    );

            	        $accountLedger = array(
                                                'purchase_id' => $this->input->post('id'),
                                                'ledger_id' => $ledgerData['id'],
                                                'invoice_date' => $this->input->post('jobsheet_date'),
                                                'entry_date' => $this->input->post('jobcompletion_date'),
                                                'purchase_type' => "production",
                                                'dr_cr' => 'CR',
                                                'amt' => abs($this->input->post('total')[$i]),
                                                'opening_bal' => $ledgerData['closing_balance'],
                                                'closing_bal' => $amt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                            );

            	                    
            	        // echo "<pre>"; print_r($accountLedgerDataUpdate);
            	        // echo "<pre>"; print_r($accountLedger);
            	       	$this->model_ledger->update($accountLedgerDataUpdate);
	                    $this->model_purchaseledger->create($accountLedger);
            	    }
        	    }

        		// exit();
        	    
                $measurementData = array(
				                            'production_id' => $this->input->post('id'),
				                            'measurement' => $this->input->post('measuremnt'),
				                            
				                            'kshoulder' => $this->input->post('kshoulder'),
				                            'kchest' => $this->input->post('kchest'),
				                            'kpants' => $this->input->post('kpants'),
				                            'khand' => $this->input->post('khand'),
				                            'khip' => $this->input->post('khip'),
				                            'klength' => $this->input->post('klength'),
				                            'kthroat' => $this->input->post('kthroat'),
				                            
				                            'waist' => $this->input->post('waist'),
				                            'seat' => $this->input->post('seat'),
				                            'hanging' => $this->input->post('hanging'),
				                            'thigh' => $this->input->post('thigh'),
				                            'length' => $this->input->post('length'),
				                            'bottom' => $this->input->post('bottom'),
				                            
				                            'sshoulder' => $this->input->post('sshoulder'),
				                            'schest' => $this->input->post('schest'),
				                            'spants' => $this->input->post('spants'),
				                            'shand' => $this->input->post('shand'),
				                            'ship' => $this->input->post('ship'),
				                            'slength' => $this->input->post('slength'),
				                            'sthroat' => $this->input->post('sthroat'),
				                            
				                            // 'size' => $this->input->post('size'),
				                            // 'quantity' => $this->input->post('mquantity'),

					                    	'production_type' => 'production',

				                            'company_id' => $this->session->userdata('wo_company'),
				        					// 'city_id' => $this->session->userdata('wo_city'),
				        					'store_id' => $this->session->userdata('wo_store'),
				        					'created_by' => $this->session->userdata('wo_id')
				                        );

                // echo "<pre>"; print_r($measurementData);
    	        $this->model_production->updateMeasurement($measurementData);
                
    	       //  $serviceData = array(
    	       //                 'production_id' => $this->input->post('id'),
    	       //                 'job_no' => $this->input->post('jobno'),        //where condition
    	       //             );
    	       
    	       // echo "<pre>"; print_r($serviceData);
    	        
    	        $descriptionData = array(
                	            'production_id' => $this->input->post('id'),
    	                        'description' => $this->input->post('description'),
	                    		
	                    		'production_type' => 'production',

    	                        'company_id' => $this->session->userdata('wo_company'),
            					// 'city_id' => $this->session->userdata('wo_city'),
            					'store_id' => $this->session->userdata('wo_store'),
            					'created_by' => $this->session->userdata('wo_id')
    	                    );
    	           //   echo "<pre>"; print_r($descriptionData);
    	       
    	        $this->model_production->updatedescriptionData($descriptionData);
        	    
        	    if(isset($_POST['print']))
	       		{
	       		    return redirect('production/printjoboption/'.$this->input->post('id'));
	       		}
	       		else if(isset($_POST['product']))
	       		{
	       		    return redirect('production/createProduct/'.$this->input->post('id'));
	       		}
	       		else
	       		{
	       	        // exit;	
            		$this->session->set_flashdata('feedback','Record Update Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				return redirect('production');	    
	       		}
        	   
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('production');
        	}

	    }
	    else
	    {
	        $this->data['category'] = $this->model_category->fecthAllData();
        	$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
        	$this->data['sku'] = $this->model_sku->fecthAllData();
        	$this->data['sales_order'] = $this->model_salesorder->fecthAllDataByMTO();
        	$this->data['servicetype'] = $this->model_servicetype->fecthAllData();
        	$this->data['gst'] = $this->model_gst->fecthAllData();
            
            $this->data['production'] = $this->model_production->fecthAllDatabyID($id);
        	$this->data['material'] = $this->model_production->fecthAllMaterialData($id);
        	$this->data['measurement'] = $this->model_production->fecthAllMeasurementData($id);
        	$this->data['readymadeMeasurement'] = $this->model_production->fecthAllReadymadeMeasurementData($id);
        	$this->data['service'] = $this->model_production->fecthServicesByProductId($id);
        	$this->data['description'] = $this->model_production->fecthAllDescriptionData($id);
        	$this->data['ledgerAccount'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
        	
    		$this->render_template('admin_view/productionMaster/production/update', $this->data);    
	    }
	}
	
	public function createProduct()
	{
	   // echo "createProduct";
	    $id = $this->uri->segment(3);
	        
	    $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	        // echo "<pre>"; print_r($_POST); exit();

	        $data = array(
	                        'order_id' => $this->input->post('productionid'),
	                        'inventory_type' => 'production',
	                       // 'product_category' => $this->input->post('product_category'),
	                       // 'product_subcategory' => $this->input->post('product_subcategory'),
	                        'sku' => $this->input->post('sku'),
	                        'brand' => $this->input->post('brand'),
	                        'unit' => $this->input->post('unitid'),
	                        'hsn' => $this->input->post('hsn'),
	                        'quality' => $this->input->post('quality'),
	                        'base_price' => $this->input->post('base_price'),
	                        'gst' => $this->input->post('gst'),
	                        'pnetprice' => $this->input->post('pur_price'),
	                        'wsp' => $this->input->post('wsp'),
	                        'wspp' => $this->input->post('wspp'),
	                        'location' => $this->input->post('location'),
	                        'mrp' => $this->input->post('mrp'),
	                        'discount_code' => $this->input->post('discount_code'),
	                        'comm' => $this->input->post('comm'),
	                        'remark' => $this->input->post('remark'),
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	                    
	        // echo "<pre>"; print_r($data); exit();
	        $create = $this->model_openingitem->create($data);

        	if($create == true) {
        	    
	            return redirect('production/createProductionItem/'.$this->input->post('productionid')."/".$this->input->post('quality'));  
        	}
        	else
        	{
        	    $this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('production/createProduct/'.$this->input->post('productionid'));
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_production->fecthAllDatabyID($id);
	        
    	    $this->data['category'] = $this->model_category->fecthAllData();
    		$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
    		$this->data['discount'] = $this->model_discount->fecthAllData();
    		$this->data['sku'] = $this->model_sku->fecthSkuAllData();
    		$this->data['brand'] = $this->model_brand->fecthAllData();
    		$this->data['unit'] = $this->model_unit->fecthAllData();
    		$this->data['hsn'] = $this->model_hsn->fecthAllData();
    		$this->data['gst'] = $this->model_gst->fecthAllData();
    		$this->data['division'] = $this->model_division->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
    		$this->data['store'] = $this->model_store->fecthAllStores();
    		
            $this->render_template('admin_view/productionMaster/production/createProduct', $this->data); 
	    }
	} 
	
	public function createProductionItem()
	{
	    $productionid = $this->uri->segment(3);
	    $productionQty = $this->uri->segment(4);
	    
	    $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	        echo "<pre>"; print_r($_POST); exit;
	    }
	    else
	    {   
    	    $this->data['productionid'] = $productionid;
    	    $this->data['productionQty'] = $productionQty;
    	    
    	    $this->render_template('admin_view/productionMaster/production/createProductionItem', $this->data);   
	    }
	}
	
	public function printjoboption()
	{
	   // echo "print job";
	    $id = $this->uri->segment(3);
	    $this->data['allData'] = $this->model_production->fecthAllDatabyID($id);
	    $this->data['tailor'] = $this->model_ledger->fetchLedgerDataByLedgertype(6);
	    $this->data['info'] = '';
	    $this->data['product'] = '';
	    
	    $this->form_validation->set_rules('emplyee', 'Print For', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	       // echo "<pre>"; print_r($_POST); exit;
	        
	        if($this->input->post('emplyee') != '0')
	        {
	           // echo "emp slip";
	           $this->data['info'] = $this->model_ledger->fecthDataByID($_POST['emplyee']);
	        }
	        else
	        {
	           // echo "customer slip";
	            $this->data['info'] = $this->model_ledger->fecthDataByID($_POST['customerid']);
	        }
	       // exit;
	        
	        $this->data['productionid'] = $_POST['productionid'];
	        $this->data['customerid'] = $_POST['customerid'];
	        
	        $this->data['workerid'] = $_POST['ledgerid'];
	        $this->data['product'] = $this->model_production->fecthAllDatabyID($_POST['productionid']);
	        
	       // if(isset($_POST['emplyee']) != '0')
	       // {
	       //     echo "emp slip";
           //         $data = $this->model_ledger->fecthDataByID($_POST['emplyee']);
	       // }
	       // else
	       // {
	       //     echo "customer slip";
                // $data = $this->model_ledger->fecthDataByID($_POST['customerid']);
	       // }
	       // echo "<pre>"; print_r($into);
	        
	        $this->render_template('admin_view/productionMaster/production/printjob', $this->data);
	    }
	    else
	    {
    	    $this->render_template('admin_view/productionMaster/production/printjoboption', $this->data);    
	    }
	}

	// public function altsearchResult()
	// {
	// 	$this->render_template('admin_view/productionMaster/production/alterationSearchResult', $this->data);
	// }

	public function uploadImagesData()
	{ 
	    $this->load->library('upload');
	    
	    $imagePath = './uploads/'; //this is your real path APPPATH means you are at the application folder
        
        $count_uploaded_files = count($_FILES['files']['name'] );
        
        if ($count_uploaded_files > 25){ // checking how many images your user/client can upload
        
            $productImages['return'] = false;
            $productImages['message'] = "You can upload 25 Images";
            
            echo json_encode($productImages);
        }
        else
        {
            // echo "success";
            $data = array(
                            'order_id' => $_POST['orderid'],
                            'ordertype' => $_POST['ordertype']
                        );
            
            $orderItem = $this->model_production->fecthOrderData($data);
            
            $names = '';
            $skuData = $this->model_sku->fecthSkuDataByID($orderItem['sku']);
            

            if(!empty($_FILES['files']))
            {
                // $names = "Not Empty";
                
                for ($i = 0; $i <  $count_uploaded_files; $i++) {
                
                    $_FILES['userfile']['name']     = $_FILES['files']['name'][$i];
                    $_FILES['userfile']['type']     = $_FILES['files']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $_FILES['files']['error'][$i];
                    $_FILES['userfile']['size']     = $_FILES['files']['size'][$i];
                    //configuration for upload your images
                    
                    $imgname = $skuData['product_code']."_".$_POST['color'];
                    
                    $config = array(
                                        'file_name'     => $imgname,
                                        'allowed_types' => 'jpg|jpeg|png|gif',
                                        'max_size'      => 10000,
                                        'overwrite'     => FALSE,
                                        'upload_path'   => $imagePath
                                    );
                    $this->upload->initialize($config);
                    
                    
                    $errCount = 0;//counting errrs
                    
                    if (!$this->upload->do_upload())
                    {
                        $error = array('error' => $this->upload->display_errors());
                        $productImages[] = array(
                                                'errors'=> $error
                                            );//saving arrors in the array
                    }
                    else
                    {
                        $data = $this->upload->data();
                        $name_array[] = $data['file_name'];
                    
                        // $filename = $this->upload->data();
                        // $productImages[] = array(
                        //                         'fileName'=>$filename['file_name'],
                        //                         'watermark'=> $this->createWatermark($filename['file_name'])
                        
                        //                     );
                    }//if file uploaded
                    
                }//for loop ends here
                
                // implode Image Name
                $names= implode(', ', $name_array);
        
                // print_r($this->input->post('qty'));
                // exit();

                $data = array(
                            'order_id' => $_POST['orderid'],
                            'ordertype' => $_POST['ordertype']
                        );
            
            	$orderItem = $this->model_production->fecthOrderData($data);

                $qty = 0;
                if($orderItem['unit'] == '18')
                {
                	$data = array(
                            'order_id' => $_POST['orderid'],
                            'ordertype' => $_POST['ordertype']
                        );
            
            		$orderItem = $this->model_production->fecthOrderData($data);

                    $qty = 1;

                    for ($i=0; $i < $this->input->post('qty'); $i++) { 
                        
                        $data = array(
                                    'order_id' => $this->input->post('orderid'),
                                    'sku' => $orderItem['sku'],
                                    'gst_id' => $orderItem['gst'],
                                    'color' => $this->input->post('color'),
                                    'size' => $this->input->post('size'),
                                    'unit_id' => $orderItem['unit'],
                                    'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
                                    'pattern' => $this->input->post('pattern'),
                                    'style1' => $this->input->post('style1'),
                                    'style2' => $this->input->post('style2'),
                                    'type' => $this->input->post('type'),
                                    'quantity' => $qty,
                                    // 'sku' => $skuData['product_code'],
                                    'img' => $names,
                                    'img_path' => $imagePath,
                                    // 'display' => $this->input->post('show'),
                                    'order_name' => $this->input->post('ordertype'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                        // echo "IMg Availbale";
                        // print_r($data); //exit();

                        $result = $this->model_attribute->createAttr($data);
                    }
                }
                else
                {
                    $qty = $this->input->post('qty');

                    $data = array(
                                'order_id' => $this->input->post('orderid'),
                                'sku' => $orderItem['sku'],
                                'gst_id' => $orderItem['gst'],
                                'unit_id' => $orderItem['unit'],
                                'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
                                'color' => $this->input->post('color'),
                                'size' => $this->input->post('size'),
                                'pattern' => $this->input->post('pattern'),
                                'style1' => $this->input->post('style1'),
                                'style2' => $this->input->post('style2'),
                                'type' => $this->input->post('type'),
                                'quantity' => $qty,
                                // 'sku' => $skuData['product_code'],
                                'img' => $names,
                                'img_path' => $imagePath,
                                // 'display' => $this->input->post('show'),
                                'order_name' => $this->input->post('ordertype'),
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                    // echo "IMg Availbale";
                    // print_r($data); exit();

                    $result = $this->model_attribute->createAttr($data);
                }

                if($result)
                {
                    $msg['msg'] = "Data Insert Successfully";
                    $msg['code'] = "success";
                    echo json_encode($msg);
                }
            }
            else
            {
                $itemData = $this->model_production->fecthOrderData($data);
                
                $skuData = $this->model_sku->fecthSkuDataByID($itemData['sku']);


                 $imgArray = array(
                                    'sku' => $skuData['id'],
                                    'color' => $this->input->post('color')
                                );

                $imgData = $this->model_attribute->fetchDataBySKUAndColor($imgArray);

                if(empty($imgData))
                {
                    $msg['msg'] = "Previous SKU Image Not Find";
                    $msg['code'] = "error";
                    echo json_encode($msg);
                }
                else
                {
                    $qty = 0;
                    
                    $data = array(
                            'order_id' => $_POST['orderid'],
                            'ordertype' => $_POST['ordertype']
                        );
            
            		$orderItem = $this->model_production->fecthOrderData($data);

                    if($orderItem['unit'] == '18')
                    {
                        $qty = 1;

                        for ($i=0; $i < $this->input->post('qty'); $i++) { 

                            $data = array(
                                    'order_id' => $this->input->post('orderid'),
                                    'sku' => $orderItem['sku'],
                                    'gst_id' => $orderItem['gst'],
                                	'unit_id' => $orderItem['unit'],
                                	'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
                                    'color' => $this->input->post('color'),
                                    'size' => $this->input->post('size'),
                                    'pattern' => $this->input->post('pattern'),
                                    'style1' => $this->input->post('style1'),
                                    'style2' => $this->input->post('style2'),
                                    'type' => $this->input->post('type'),
                                    'quantity' => $qty,
                                    // 'sku' => $skuData['product_code'],
                                    'img' => $imgData['img'],
                                    'img_path' => $imgData['img_path'],
                                    // 'display' => $this->input->post('show'),
                                    'order_name' => $this->input->post('ordertype'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                                
                            // print_r($data);
                            $result = $this->model_attribute->createAttr($data);
                        }
                    }
                    else
                    {
                        $qty = $this->input->post('qty');

                        $data = array(
                                'order_id' => $this->input->post('orderid'),
                                'sku' => $orderItem['sku'],
                                'unit_id' => $orderItem['unit'],
								'hsn' => $orderItem['hsn'],
                                'salesmancomm' => $orderItem['comm'],
                                'discountcode' => $orderItem['discount_code'],
                                'gst_id' => $orderItem['gst'],
                                'color' => $this->input->post('color'),
                                'size' => $this->input->post('size'),
                                'pattern' => $this->input->post('pattern'),
                                'style1' => $this->input->post('style1'),
                                'style2' => $this->input->post('style2'),
                                'type' => $this->input->post('type'),
                                'quantity' => $qty,
                                // 'sku' => $skuData['product_code'],
                                'img' => $imgData['img'],
                                'img_path' => $imgData['img_path'],
                                // 'display' => $this->input->post('show'),
                                'order_name' => $this->input->post('ordertype'),
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                            
                        // print_r($data);
                        $result = $this->model_attribute->createAttr($data);

                    }

                    if($result)
                    {
                        $msg['msg'] = "Data Insert Successfully";
                        $msg['code'] = "success";
                        echo json_encode($msg);
                    }
                }
            }
        }//else
	}

	public function uploadImagesDataUpdate()
	{
		$this->load->library('upload');
	    
	    $imagePath = './uploads/'; //this is your real path APPPATH means you are at the application folder
        
        $count_uploaded_files = count($_FILES['files']['name'] );
        
        if ($count_uploaded_files > 25){ // checking how many images your user/client can upload
        
            $productImages['return'] = false;
            $productImages['message'] = "You can upload 25 Images";
            
            echo json_encode($productImages);
        }
        else
        {
            // echo "success";
            $data = array(
                            'order_id' => $_POST['orderid'],
                            'ordertype' => $_POST['ordertype']
                        );
            
            $orderItem = $this->model_production->fecthOrderData($data);
            
            $names = '';
            $skuData = $this->model_sku->fecthSkuDataByID($orderItem['sku']);
            

            if(!empty($_FILES['files']))
            {
                // $names = "Not Empty";
                
                for ($i = 0; $i <  $count_uploaded_files; $i++) {
                
                    $_FILES['userfile']['name']     = $_FILES['files']['name'][$i];
                    $_FILES['userfile']['type']     = $_FILES['files']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $_FILES['files']['error'][$i];
                    $_FILES['userfile']['size']     = $_FILES['files']['size'][$i];
                    //configuration for upload your images
                    
                    $imgname = $skuData['product_code']."_".$_POST['color'];
                    
                    $config = array(
                                        'file_name'     => $imgname,
                                        'allowed_types' => 'jpg|jpeg|png|gif',
                                        'max_size'      => 10000,
                                        'overwrite'     => FALSE,
                                        'upload_path'   => $imagePath
                                    );
                    $this->upload->initialize($config);
                    
                    
                    $errCount = 0;//counting errrs
                    
                    if (!$this->upload->do_upload())
                    {
                        $error = array('error' => $this->upload->display_errors());
                        $productImages[] = array(
                                                'errors'=> $error
                                            );//saving arrors in the array
                    }
                    else
                    {
                        $data = $this->upload->data();
                        $name_array[] = $data['file_name'];
                    
                        // $filename = $this->upload->data();
                        // $productImages[] = array(
                        //                         'fileName'=>$filename['file_name'],
                        //                         'watermark'=> $this->createWatermark($filename['file_name'])
                        
                        //                     );
                    }//if file uploaded
                    
                }//for loop ends here
                
                // implode Image Name
                $names= implode(', ', $name_array);
        
                // print_r($this->input->post('qty'));
                // exit();

                $data = array(
                            'order_id' => $_POST['orderid'],
                            'ordertype' => $_POST['ordertype']
                        );
            
            	$orderItem = $this->model_production->fecthOrderData($data);

                $qty = 0;
                if($orderItem['unit'] == '18')
                {
                	$data = array(
                            'order_id' => $_POST['orderid'],
                            'ordertype' => $_POST['ordertype']
                        );
            
            		$orderItem = $this->model_production->fecthOrderData($data);

                    $qty = 1;

                    for ($i=0; $i < $this->input->post('qty'); $i++) { 
                        
                        $data = array(
                                    'id' => $this->input->post('id'),
                                    'order_id' => $this->input->post('orderid'),
                                    'sku' => $orderItem['sku'],
                                    'gst_id' => $orderItem['gst'],
                                    'color' => $this->input->post('color'),
                                    'size' => $this->input->post('size'),
                                    'unit_id' => $orderItem['unit'],
                                    'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
                                    'pattern' => $this->input->post('pattern'),
                                    'style1' => $this->input->post('style1'),
                                    'style2' => $this->input->post('style2'),
                                    'type' => $this->input->post('type'),
                                    'quantity' => $qty,
                                    // 'sku' => $skuData['product_code'],
                                    'img' => $names,
                                    'img_path' => $imagePath,
                                    // 'display' => $this->input->post('show'),
                                    'order_name' => $this->input->post('ordertype'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                        // echo "IMg Availbale";
                        // print_r($data); //exit();

                        $result = $this->model_attribute->updateAttr($data);
                    }
                }
                else
                {
                    $qty = $this->input->post('qty');

                    $data = array(
                                'id' => $this->input->post('id'),
                                'order_id' => $this->input->post('orderid'),
                                'sku' => $orderItem['sku'],
                                'gst_id' => $orderItem['gst'],
                                'unit_id' => $orderItem['unit'],
                                'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
                                'color' => $this->input->post('color'),
                                'size' => $this->input->post('size'),
                                'pattern' => $this->input->post('pattern'),
                                'style1' => $this->input->post('style1'),
                                'style2' => $this->input->post('style2'),
                                'type' => $this->input->post('type'),
                                'quantity' => $qty,
                                // 'sku' => $skuData['product_code'],
                                'img' => $names,
                                'img_path' => $imagePath,
                                // 'display' => $this->input->post('show'),
                                'order_name' => $this->input->post('ordertype'),
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                    // echo "IMg Availbale";
                    // print_r($data); exit();

                    $result = $this->model_attribute->updateAttr($data);
                }

                if($result)
                {
                    $msg['msg'] = "Data Insert Successfully";
                    $msg['code'] = "success";
                    echo json_encode($msg);
                }
            }
            else
            {
                $itemData = $this->model_production->fecthOrderData($data);
                
                $skuData = $this->model_sku->fecthSkuDataByID($itemData['sku']);


                 $imgArray = array(
                                    'sku' => $skuData['id'],
                                    'color' => $this->input->post('color')
                                );

                $imgData = $this->model_attribute->fetchDataBySKUAndColor($imgArray);

                if(empty($imgData))
                {
                    $msg['msg'] = "Previous SKU Image Not Find";
                    $msg['code'] = "error";
                    echo json_encode($msg);
                }
                else
                {
                    $qty = 0;
                    
                    $data = array(
                            'order_id' => $_POST['orderid'],
                            'ordertype' => $_POST['ordertype']
                        );
            
            		$orderItem = $this->model_production->fecthOrderData($data);

                    if($orderItem['unit'] == '18')
                    {
                        $qty = 1;

                        for ($i=0; $i < $this->input->post('qty'); $i++) { 

                            $data = array(
                                    'id' => $this->input->post('id'),
                                    'order_id' => $this->input->post('orderid'),
                                    'sku' => $orderItem['sku'],
                                    'gst_id' => $orderItem['gst'],
                                	'unit_id' => $orderItem['unit'],
                                	'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
                                    'color' => $this->input->post('color'),
                                    'size' => $this->input->post('size'),
                                    'pattern' => $this->input->post('pattern'),
                                    'style1' => $this->input->post('style1'),
                                    'style2' => $this->input->post('style2'),
                                    'type' => $this->input->post('type'),
                                    'quantity' => $qty,
                                    // 'sku' => $skuData['product_code'],
                                    'img' => $imgData['img'],
                                    'img_path' => $imgData['img_path'],
                                    // 'display' => $this->input->post('show'),
                                    'order_name' => $this->input->post('ordertype'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                                
                            // print_r($data);
                            $result = $this->model_attribute->updateAttr($data);
                        }
                    }
                    else
                    {
                        $qty = $this->input->post('qty');

                        $data = array(
                                'id' => $this->input->post('id'),
                                'order_id' => $this->input->post('orderid'),
                                'sku' => $orderItem['sku'],
                                'unit_id' => $orderItem['unit'],
								'hsn' => $orderItem['hsn'],
                                'salesmancomm' => $orderItem['comm'],
                                'discountcode' => $orderItem['discount_code'],
                                'gst_id' => $orderItem['gst'],
                                'color' => $this->input->post('color'),
                                'size' => $this->input->post('size'),
                                'pattern' => $this->input->post('pattern'),
                                'style1' => $this->input->post('style1'),
                                'style2' => $this->input->post('style2'),
                                'type' => $this->input->post('type'),
                                'quantity' => $qty,
                                // 'sku' => $skuData['product_code'],
                                'img' => $imgData['img'],
                                'img_path' => $imgData['img_path'],
                                // 'display' => $this->input->post('show'),
                                'order_name' => $this->input->post('ordertype'),
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                            
                        // print_r($data);
                        $result = $this->model_attribute->createAttr($data);

                    }

                    if($result)
                    {
                        $msg['msg'] = "Data Insert Successfully";
                        $msg['code'] = "success";
                        echo json_encode($msg);
                    }
                }
            }
        }//else
	}

	public function getAttrData()
    {
        $orderid = $this->input->post('orderid');
        $order_name = $this->input->post('order_name');
        
        $data = array(
                        'orderid' => $orderid,
                        'order_name' => $order_name
                    );

        $attrData = $this->model_attribute->fetchDataByOrderIDAndOrderName($data);

        // echo "<pre>"; print_r($attrData);
        echo json_encode($attrData);
    }

	
}