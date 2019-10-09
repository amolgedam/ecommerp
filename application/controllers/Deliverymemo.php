<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Deliverymemo extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Delivery Memo';
		
		$this->load->model('model_ledger');
		$this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
		
		$this->load->model('model_deliverymemo');
		$this->load->model('model_sku');
        $this->load->model('model_category');
		$this->load->model('model_barcode');
        $this->load->model('model_company');
        
	}
	
	public function fetchAllData()
	{
	    $data = $this->model_deliverymemo->fecthAllData();
	   // echo "<pre>"; print_r($data);
	   // exit;

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
                
                $buttons .= '&nbsp; <a href="'.base_url().'deliverymemo/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'deliverymemo/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                
                $buttons .= '&nbsp; <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i>Print Invoice</a>';
                
                
                $result['data'][$key] = array(
                                                
                                                $no,
                                                $value['delivery_no'],
                                                $value['date'],
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

	public function index()
	{
		$this->render_template('admin_view/entriesMaster/deliveryMemo/index', $this->data);
	}
	   
	public function create()
	{
	    $this->form_validation->set_rules('date', 'Invoice Date', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            // echo "<pre>"; print_r($_POST); exit;
            
            $data = array(
        					'delivery_no' => $this->input->post('inventory_no'),
        					'date' => $this->input->post('date'),
        					'sales_account' => $this->input->post('sales_ac'),
        					'account' => $this->input->post('account'),
        					'salesman' => $this->input->post('salesman'),
        					'shipping_details' => $this->input->post('shiping_details'),
        					'shipping_type' => $this->input->post('shiping_type'),
        					'division' => $this->input->post('division'),
        					// 'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'sales_type' => $this->input->post('sales_type'),
        					'no_product' => $this->input->post('no_product'),
        					'base_total' => $this->input->post('base_total'),
        					'total_discount' => $this->input->post('total_discount'),
        					'gross_total' => $this->input->post('gross_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'tot_amt' => $this->input->post('total_amt'),
        					'adjustment' => $this->input->post('adjustment'),
        					'total_invoice' => $this->input->post('total_invoice'),
        					'entry_type' => "delivery_memo",
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);
        // 	echo "<pre>"; print_r($data);
        
            $created_id = $this->model_deliverymemo->create($data);
            // $created_id = 1;
            if($created_id == true) {
        	
        	    $count_product = count($_POST['pno']);
        	    
        	    for($i=0; $i<$count_product; $i++)
    	        {
    	            $deliveryData = array(
    	                            'memo_id' => $created_id,
    	                            'entry_type' => "delivery_memo",
                					'pno' => $this->input->post('pno')[$i],
                					'qty' => $this->input->post('quantity')[$i],
                					'conversion' => $this->input->post('conversion')[$i],
                					'conversionvalue' => $this->input->post('conversionvalue')[$i],
                					'baseprice' => $this->input->post('baseprice')[$i],
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
                	            
    	            $this->model_deliverymemo->createMemoItem($deliveryData);
    	        }
    	       // echo "<pre>"; print_r($deliveryData); exit;
    	        $this->session->set_flashdata('feedback','Data Saved Successfully');
    			$this->session->set_flashdata('feedback_class','alert alert-success');
    				
    		     return redirect('deliverymemo');
            }
            else
            {
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('deliverymemo/create');
            }
        	
        }
        else
        {
            $orderNo = $this->model_deliverymemo->lastrecord();
        	
    	    if($orderNo == '')
    	    {
    	        $this->data['opening_no']  = '0000001';
    	       // $code = '0000001';
    	    }
    	    else
    	    {
    	        $np = $orderNo['delivery_no'];
    	        $code = substr($np, 1); 
    	        
    	        $code = $code + 1;
    	        $code = sprintf('%07d',$code);
    	        
    	        $this->data['opening_no'] = $code;
    	    }
    	    
    	    $this->data['otherData'] = $this->model_ledger->ledgerPurType();
            $this->data['ledger'] = $this->model_ledger->fetchLedgerDataNotOther(4);

                $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
                $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();
            
            $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();

            // $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerSalesmanData();
            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
            
            
            $this->render_template('admin_view/entriesMaster/deliveryMemo/create', $this->data);
        }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('id', 'Delivery memo', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            // echo "<pre>"; print_r($_POST); //exit;
            
             $data = array(
                            'id' => $this->input->post('id'),
        					'delivery_no' => $this->input->post('delivery_no'),
        					'date' => $this->input->post('date'),
        					'sales_account' => $this->input->post('sale_ac'),
        					'account' => $this->input->post('account'),
        					'salesman' => $this->input->post('salesman'),
        					'shipping_details' => $this->input->post('shiping_details'),
        					'shipping_type' => $this->input->post('shiping_type'),
        					'division' => $this->input->post('division'),
        					// 'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'sales_type' => $this->input->post('sales_type'),
        					'no_product' => $this->input->post('no_product'),
        					'base_total' => $this->input->post('base_total'),
        					'total_discount' => $this->input->post('total_discount'),
        					'gross_total' => $this->input->post('gross_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'tot_amt' => $this->input->post('total_amt'),
        					'adjustment' => $this->input->post('adjustment'),
        					'total_invoice' => $this->input->post('total_invoice'),
        					'entry_type' => "delivery_memo",
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
               
        // 	print_r($data); exit();
        	
        	$update = $this->model_deliverymemo->update($data);

        	if($update == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('deliverymemo');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('deliverymemo/update/'.$this->input->post('id'));
        	}
        }
        else
        {
            $this->data['allData'] = $this->model_deliverymemo->fecthAllDataByID($id);
            
            $data = array(
                            'id' => $id,
                            'entry_type' => 'delivery_memo'
                        );
                        
            $this->data['itemData'] = $this->model_deliverymemo->fecthItemData($data);
            
           $this->data['otherData'] = $this->model_ledger->ledgerPurType();
            $this->data['ledger'] = $this->model_ledger->fetchLedgerDataNotOther(4);

                $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
                $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();
            
            $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();

            // $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerSalesmanData();
            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
            
            
            $this->render_template('admin_view/entriesMaster/deliveryMemo/update', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);
		
		$data = array(
		                'id' => $id,
		                'entry_type' => 'delivery_memo'
		            );
		            
		$itemData = $this->model_deliverymemo->fecthItemData($data);
		
		$delete = $this->model_deliverymemo->delete($id);	

		if($delete == true) {
		    
    		foreach($itemData as $rows)
		    {
                $this->model_deliverymemo->deleteItem($rows['id']);
		    }		    
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('deliverymemo');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('deliverymemo');
    	}
	}
	
}