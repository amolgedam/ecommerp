<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Furtherprocess extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		error_reporting(0);

		$this->data['page_title'] = 'Furcther Process';
		
		$this->load->model('model_ledger');
		$this->load->model('model_category');
		$this->load->model('model_sku');
		$this->load->model('model_salesorder');
		$this->load->model('model_servicetype');
		$this->load->model('model_gst');
		
		$this->load->model('model_production');
		$this->load->model('model_gst');
		$this->load->model('model_furtherprocess');
		$this->load->model('model_barcode');
		$this->load->model('model_purchaseledger');
		$this->load->model('model_company');
		
	}

	public function insertServices()
	{
        $data = $this->model_furtherprocess->insertServices();
    	echo json_encode($data);
	}

	public function fecthServicesByJobId()
	{
	    // $jobno = '0000001';
	    $jobno = $_POST['jobno'];
	    $data=$this->model_furtherprocess->fecthServicesByJobId($jobno);
		echo json_encode($data);
	}

	public function deleteServices()
	{
		$data=$this->model_furtherprocess->deleteServices();
		echo json_encode($data);
	}
    
	public function index()
	{
		$this->data['jobno'] = $this->model_production->fecthOpenJobsData();
		$this->render_template('admin_view/productionMaster/production/search', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	       // echo "<pre>"; print_r($_POST); //exit();
	        $processData = array(
	                        'process_no' => $this->input->post('process_no'),
	                        'production_id' => $this->input->post('product_id'),
	                        'p_category' => $this->input->post('product_category'),
	                        'p_scate' => $this->input->post('product_subcategory'),
	                        'sku' => $this->input->post('sku'),
	                        'jobsheetdate' => $this->input->post('jobsheet_date'),
	                        'delivery_date' => $this->input->post('delivery_date'),
	                        'status' => $this->input->post('status'),
	                        'quantity' => $this->input->post('quantity'),
	                        'total_cost' => $this->input->post('production_unit'),
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	       // echo "<pre>"; print_r($processData); exit();
	        $created_id = $this->model_furtherprocess->create($processData);
	       // $created_id = 1;
        	
        	if($created_id == true) {
        	    
        	    // if($this->input->post('status') == 'Complete')
        	    // {
            	//    	// Cr To worker ledger
            	//     $countLedger = count($this->input->post('assign_worker'));
            	    
            	//     for ($i=0; $i < $countLedger; $i++) { 
            	    
            	//         $ledgerData = $this->model_ledger->fecthDataByID($this->input->post('assign_worker')[$i]);
            	//        // echo "<pre>"; print_r($ledgerData);
            	        
            	//         $amt = $ledgerData['wallete_balance'] + $this->input->post('total')[$i]; 
            	       
            	//         $data = array(
            	//                         'id' => $ledgerData['id'],
            	//                         'wallete_balance' => $amt
            	//                     );
            	                    
            	//        // echo "<pre>"; print_r($data);
            	//        $this->model_ledger->update($data);
            	//     }
        	    // }
        	    
        		$productionData = array(
        								'id' => $this->input->post('product_id'),
        								'status' => 'Further Process',
        								// 'furtherprocess_id' => $created_id
        							);

        		$this->model_production->update($productionData);

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
	                    	'production_type' => 'furtherprocess',
	                    	'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                   	);

        				// echo "<pre>"; print_r($materialData);
	        			$this->model_production->createMaterial($materialData);
	        			
	        			$barcodeData = $this->model_barcode->fetchBarcodeData($this->input->post('pno')[$i]);
	        			
	        			// echo "<pre>"; print_r($barcodeData);
	        			
	        			$barcode = array(
	        			                    'id' => $barcodeData['id'],
	        			                    'item_status' => 'soldout'
	        			                );
	        			                
	        			// echo "<pre>"; print_r($barcode);
	        			$this->model_barcode->update($barcode);
        			}
        			
        			// 	exit();
			        //	$production_id = '1';
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

						                    	'production_type' => 'furtherprocess',
						                        
						                        // 'size' => $this->input->post('size'),
						                        // 'quantity' => $this->input->post('mquantity'),
						                        'company_id' => $this->session->userdata('wo_company'),
					        					// 'city_id' => $this->session->userdata('wo_city'),
					        					'store_id' => $this->session->userdata('wo_store'),
					        					'created_by' => $this->session->userdata('wo_id')
						                	);
	        		$this->model_production->createMeasurement($measurementData);

	        		$countReadymad = count($this->input->post('readymadesizeList'));

    				for ($i=0; $i < $countReadymad; $i++) { 
    			
		    				$readymadData = array(
					    					'production_id' => $created_id,
					                    	'size' => $this->input->post('readymadesizeList')[$i],
					                    	'quantity' => $this->input->post('readymadequantityList')[$i],
						                   	'production_type' => 'furtherprocess',
					                    	'company_id' => $this->session->userdata('wo_company'),
					    					// 'city_id' => $this->session->userdata('wo_city'),
					    					'store_id' => $this->session->userdata('wo_store'),
					    					'created_by' => $this->session->userdata('wo_id')
				                		);

		        		$this->model_production->createMeasurementReadymade($readymadData);
	    				// echo "<pre>"; print_r($readymadData);
	    			}
	            
	            
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
                	                        'production_type' => "furtherprocess",
                	                        'company_id' => $this->session->userdata('wo_company'),
                	    					// 'city_id' => $this->session->userdata('wo_city'),
                	    					'store_id' => $this->session->userdata('wo_store'),
                	    					'created_by' => $this->session->userdata('wo_id')
                	                    );
                	        
    	           $this->model_production->createServices($serviceData);
        		  //  echo "<pre>"; print_r($serviceData);
        		}
        		
	                    
		       	// 	$serviceData = array(
		       	//                 'production_id' => $created_id,
		       	//                 'job_no' => $this->input->post('jobno'),        //where condition
		       	//             );
		        
		       	// 	$this->model_furtherprocess->updateService($serviceData);
		        
	        	$descriptionData = array(
					                        'production_id' => $created_id,
					                        'description' => $this->input->post('description'),
					                        'company_id' => $this->session->userdata('wo_company'),
					                    	'production_type' => 'furtherprocess',
				        					// 'city_id' => $this->session->userdata('wo_city'),
				        					'store_id' => $this->session->userdata('wo_store'),
				        					'created_by' => $this->session->userdata('wo_id')
					                    );
	            
	            // echo "<pre>"; print_r($descriptionData);
	        	// exit();

	       		$this->model_production->createDescription($descriptionData);
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('production');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('production');
        	}
	    }
	    else
	    {
	    	$id = $this->uri->segment(3);

	    	$this->data['productionData'] = $this->model_production->fecthAllDatabyID($id);
	    	// echo "<pre>"; print_r($productionData); exit();
	        $orderNo = $this->model_furtherprocess->lastrecord();
        	    
    	    if($orderNo == '')
    	    {
    	        $this->data['process_no']  = '0000001';
    	    }
    	    else
    	    {
    	        $np = $orderNo['process_no'];
    	        $code = substr($np, 1); 
    	        
    	        $code = $code + 1;
    	        $code = sprintf('%07d',$code);
    	        
    	        $this->data['process_no'] = $code;
    	    }
        	    
        	$this->data['employee'] = $this->model_ledger->fetchEmployee();
        	$this->data['category'] = $this->model_category->fecthAllData();
        	$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
        	$this->data['sku'] = $this->model_sku->fecthAllData();
        	$this->data['sales_order'] = $this->model_salesorder->fecthAllDataByMTO();
        	$this->data['servicetype'] = $this->model_servicetype->fecthAllData();
        	$this->data['gst'] = $this->model_gst->fecthAllData();
        	
			$this->render_template('admin_view/productionMaster/production/further_process', $this->data);   
	    }
	}
	
	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	   // 	echo "<pre>"; print_r($_POST); //exit();
	        
	        $processData = array(
	                        'id' => $this->input->post('id'),
	                        'p_category' => $this->input->post('product_category'),
	                        'p_scate' => $this->input->post('product_subcategory'),
	                        'sku' => $this->input->post('sku'),
	                        'jobsheetdate' => $this->input->post('jobsheet_date'),
	                        'delivery_date' => $this->input->post('delivery_date'),
	                        'status' => $this->input->post('status'),
	                        'quantity' => $this->input->post('quantity'),
	                        'total_cost' => $this->input->post('production_unit'),
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	        // echo "<pre>"; print_r($processData); //exit();
	       
	       $update = $this->model_furtherprocess->update($processData);
	       // $update = 1;
	       if($update)
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
                                                'entry_date' => $_POST['delivery_date'],
                                                'purchase_type' => "furtherprocess",
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
        	    
        	    // exit;
        	    
	            $this->session->set_flashdata('feedback','Data Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('production');
	       }
	       else
	       {
	            $this->session->set_flashdata('feedback','Unable to Update Data');
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

        	$this->data['furtherprocess'] = $this->model_furtherprocess->fecthAllDatabyID($id);
        	$this->data['material'] = $this->model_furtherprocess->fecthAllMaterialData($id);
        	$this->data['measurement'] = $this->model_furtherprocess->fecthAllMeasurementData($id);
        	$this->data['readymadeMeasurement'] = $this->model_furtherprocess->fecthAllReadymadeMeasurementData($id);
        	$this->data['service'] = $this->model_furtherprocess->fecthServicesByProductId($id);
        	$this->data['description'] = $this->model_furtherprocess->fecthAllDescriptionData($id);

    		$this->render_template('admin_view/productionMaster/production/showFurtherProcess', $this->data);    
	    }   
	}


}