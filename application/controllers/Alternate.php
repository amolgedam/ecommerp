<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Alternate extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		error_reporting(0);

		$this->data['page_title'] = 'production Alternate';
		
		$this->load->model('model_ledger');
        $this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
		$this->load->model('model_salesorder');
		$this->load->model('model_deliverymemo');

		$this->load->model('model_servicetype');
		$this->load->model('model_gst');
		
		$this->load->model('model_salesinvoice');
		$this->load->model('model_alternate');
		$this->load->model('model_production');
		$this->load->model('model_wsp');
		
        $this->load->model('model_barcode');
		$this->load->model('model_purchaseledger');
        $this->load->model('model_company');
        
	}

	public function insertServices()
	{
		$data = $this->model_alternate->insertServices();
    	echo json_encode($data);
	}

	public function fecthServicesByJobId()
	{
		$jobno = $_POST['jobno'];
	    $data=$this->model_alternate->fecthServicesByJobId($jobno);
		echo json_encode($data);
	}
    
    public function deleteServices()
    {
    	$data=$this->model_alternate->deleteServices();
		echo json_encode($data);
    }
 
	public function index()
	{
		$this->data['salesinvoice'] = $this->model_salesinvoice->fecthSalesInvoiceDataForAltration();
		// echo "<pre>"; print_r($salesinvoice);exit();
		$this->render_template('admin_view/productionMaster/production/altsearch', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('jobsheet_date', 'Job Sheet Date', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	   // 	echo "<pre>"; print_r($_POST); exit();
	        $alterationData = array(
	                        'alternate_no' => $this->input->post('jobno'),
	                        'date' => $this->input->post('jobsheet_date'),
	                        'delivery_date' => $this->input->post('delivery_date'),
	                        'status' => $this->input->post('status'),
	                        'total_pcost' => $this->input->post('production_cost'),
	                        'salesinvoice_id' => $this->input->post('salesinvoice_id'),
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	       // echo "<pre>"; print_r($alterationData); exit();
	        $created_id = $this->model_alternate->create($alterationData);
	       // $created_id = 1;
        	
        	if($created_id) {

        		$invoiceUpdate = array(
        								'id' => $this->input->post('salesinvoice_id'),
        								'altration_id' => $created_id
        							);
                // echo "<pre>"; print_r($invoiceUpdate); exit;
        		$this->model_salesinvoice->update($invoiceUpdate);

        		$invoiceDataCount = count($this->input->post('invoiceDataId'));

        		for ($i=0; $i < $invoiceDataCount; $i++) { 
        			
        			$data = array(
        							'id' => $this->input->post('invoiceDataId')[$i],
        							'alterationprocess' => 'yes'
        						);
        			
                    // 	echo "<pre>"; print_r($data); //exit;
        
                    if($_POST['invoice_type'] != 'wsp')
                    {
                        // echo "invoice";
            			$this->model_salesinvoice->updateInvoiceData($data);
                    }
                    else
                    {
                        // echo "wsp";
                        $this->model_wsp->updateWspMaterial($data);
                    }
        		}
                // 	exit;

        		// $productionData = array(
        		// 						'id' => $this->input->post('product_id'),
        		// 						'status' => 'Further Process'
        		// 					);
        		
        		// $this->model_production->update($productionData);
        		
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
        	   // exit;

        		$countMaterial = count($this->input->post('pno'));

        		for ($i=0; $i < $countMaterial; $i++) { 
        			
    				$materialData = array(
                	    					'production_id' => $created_id,
                	                    	'product_no' => $this->input->post('pno')[$i],
                	                    	'quantity' => $this->input->post('quantityMaterial')[$i],
                	                   // 	'conversion' => $this->input->post('conversion')[$i],
                	                   // 	'conversion_value' => $this->input->post('conversionvalue')[$i],
                	                    	'netprice' => $this->input->post('baseprice')[$i],
                	                    	'subtotal' => $this->input->post('subtotal')[$i],
                	                    	'production_type' => 'alterate',
                	                    	'company_id' => $this->session->userdata('wo_company'),
                	    					// 'city_id' => $this->session->userdata('wo_city'),
                	    					'store_id' => $this->session->userdata('wo_store'),
                	    					'created_by' => $this->session->userdata('wo_id')
                	                   	);
    				// echo "<pre>"; print_r($materialData);
        			$this->model_production->createMaterial($materialData);
    			}
    		  //  exit;
        			
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
                	                    	'production_type' => 'alterate',
                	                        
                	                        // 'size' => $this->input->post('size'),
                	                        // 'quantity' => $this->input->post('mquantity'),
                	                        'company_id' => $this->session->userdata('wo_company'),
                        					// 'city_id' => $this->session->userdata('wo_city'),
                        					'store_id' => $this->session->userdata('wo_store'),
                        					'created_by' => $this->session->userdata('wo_id')
                	                    );
	               // echo "<pre>"; print_r($measurementData); exit();
	        		$this->model_production->createMeasurement($measurementData);

	        		$countReadymad = count($this->input->post('readymadesizeList'));

    				for ($i=0; $i < $countReadymad; $i++) { 
    			
	    				$readymadData = array(
	    					'production_id' => $created_id,
	                    	'size' => $this->input->post('readymadesizeList')[$i],
	                    	'quantity' => $this->input->post('readymadequantityList')[$i],
		                   	'production_type' => 'alterate',
	                    	'company_id' => $this->session->userdata('wo_company'),
	    					// 'city_id' => $this->session->userdata('wo_city'),
	    					'store_id' => $this->session->userdata('wo_store'),
	    					'created_by' => $this->session->userdata('wo_id')
                		);

	        			$this->model_production->createMeasurementReadymade($readymadData);
    				// 	echo "<pre>"; print_r($readymadData);
    				}
	               // exit();
		      //  	$serviceData = array(
		      //                  'production_id' => $created_id,
		      //                  'job_no' => $this->input->post('jobno'),        //where condition
		      //              );
	       // 		$this->model_alternate->updateService($serviceData);
	                
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
                    	                        'production_type' => "alterate",
                    	                        'company_id' => $this->session->userdata('wo_company'),
                    	    					// 'city_id' => $this->session->userdata('wo_city'),
                    	    					'store_id' => $this->session->userdata('wo_store'),
                    	    					'created_by' => $this->session->userdata('wo_id')
                    	                    );
                    	        
    	           $this->model_production->createServices($serviceData);
        		  //  echo "<pre>"; print_r($serviceData);
        		    }
                // exit;
        		
        		$descriptionData = array(
                                            'production_id' => $created_id,
                                            'description' => $this->input->post('description'),
                                            'company_id' => $this->session->userdata('wo_company'),
                                        	'production_type' => 'alterate',
                        					// 'city_id' => $this->session->userdata('wo_city'),
                        					'store_id' => $this->session->userdata('wo_store'),
                        					'created_by' => $this->session->userdata('wo_id')
                                        );
                    	            
	       //     echo "<pre>"; print_r($descriptionData);
	       // 	exit();

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

	    	$this->data['salesinvoiceData'] = $this->model_salesinvoice->fecthAllDataByID($id);
	    	$salesinvoiceData = $this->model_salesinvoice->fecthAllDataByID($id);
	    	// echo "<pre>"; print_r($salesinvoiceData); exit();

	    	
	        $orderNo = $this->model_alternate->lastrecord();
        	// echo "<pre>"; print_r($orderNo); exit();

    	    if($orderNo == '')
    	    {
    	        $this->data['alternate_no']  = '0000001';
    	    }
    	    else
    	    {
    	        $np = $orderNo['alternate_no'];
    	        $code = substr($np, 1); 
    	        
    	        $code = $code + 1;
    	        $code = sprintf('%07d',$code);
    	        
    	        $this->data['alternate_no'] = $code;
    	    }
        	    
	    	$this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();
    	    $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
    	    $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerSalesmanData();
    	    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    	    $this->data['sorder'] = $this->model_salesorder->fecthSalesOrderOpenData();
    	    $this->data['deliveryMemo'] = $this->model_deliverymemo->fecthAllData();

        	$this->data['employee'] = $this->model_ledger->fetchEmployee();
    	    $this->data['servicetype'] = $this->model_servicetype->fecthAllData();
        	$this->data['gst'] = $this->model_gst->fecthAllData();
        	
			$this->render_template('admin_view/productionMaster/production/alterationSearchResult', $this->data);   
	    }
	}



    public function update()
    {
        $id = $this->uri->segment(3);
        
        $this->form_validation->set_rules('alternate_no', 'Alternation Number', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            
            // echo "<pre>"; print_r($_POST); //exit();
        
            $alterationData = array(
                                        'id' => $this->input->post('alternate_no'),
                                        'alternate_no' => $this->input->post('alternate_no'),
                                        'date' => $this->input->post('jobsheet_date'),
                                        'delivery_date' => $this->input->post('delivery_date'),
                                        'status' => $this->input->post('status'),
                                        'total_pcost' => $this->input->post('production_cost'),
                                        'salesinvoice_id' => $this->input->post('salesinvoice_id'),
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'modified_by' => $this->session->userdata('wo_id')
                                    );

            // echo "<pre>"; print_r($alterationData); exit();
            // $create = true;
            $create = $this->model_alternate->update($alterationData);
            
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
                                                'entry_date' => $_POST['delivery_date'],
                                                'purchase_type' => "alteration",
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

                $this->session->set_flashdata('feedback','Record Update Successfully');
                $this->session->set_flashdata('feedback_class','alert alert-success');
                return redirect('production');      
            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Update Record');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                return redirect('production');
            }
        }
        else
        {
            $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerSalesmanData();
            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            
            $this->data['sorder'] = $this->model_salesorder->fecthSalesOrderOpenData();
            $this->data['deliveryMemo'] = $this->model_deliverymemo->fecthAllData();

            $this->data['employee'] = $this->model_ledger->fetchEmployee();
            $this->data['servicetype'] = $this->model_servicetype->fecthAllData();
            $this->data['gst'] = $this->model_gst->fecthAllData();

            $data = array(
                            'id' => $id,
                            'type' => 'alterate',
                        );
            $this->data['alterate'] = $this->model_alternate->fecthAllDataByID($id);
            $this->data['material'] = $this->model_production->fecthMaterial($data);
            $this->data['measurement'] = $this->model_production->fecthMeasurementData($data);
            $this->data['readymadeMeasurement'] = $this->model_production->fecthAllReadymadeData($data);

            $this->data['service'] = $this->model_production->fecthServices($data);
            $this->data['description'] = $this->model_production->fecthDescription($data);
            
            // echo "<pre>"; print_r($alterate); exit();
            $this->render_template('admin_view/productionMaster/production/showAltration', $this->data);    
        }
        
    }
	
	public function printAlt()
	{
	    // echo "print job";
	    $id = $this->uri->segment(3);
	    $this->data['allData'] = $this->model_alternate->fecthAllDataByID($id);
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
	       // else
	       // {
	       //    // echo "customer slip";
	       //     $this->data['info'] = $this->model_ledger->fecthDataByID($_POST['customerid']);
	       // }
	       // exit;
	        
	        $this->data['productionid'] = $_POST['productionid'];
	       // $this->data['customerid'] = $_POST['customerid'];
	        
	        $this->data['workerid'] = $_POST['ledgerid'];
	        $this->data['product'] = $this->model_alternate->fecthAllDataByID($_POST['productionid']);
	        
	        $this->render_template('admin_view/productionMaster/production/printAlt1', $this->data);
	    }
	    else
	    {
    	    $this->render_template('admin_view/productionMaster/production/printAlt', $this->data);    
	    }
	}
	
	
	
	
}