<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Opening_stock extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Opening Stock';

		error_reporting(0);
		
		$this->load->model('model_shipping');
		$this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
		$this->load->model('model_sku');
		
		$this->load->model('model_barcode');
		
		$this->load->model('model_openingstock');
		$this->load->model('model_stock');
		$this->load->model('model_openingitem');
		
		$this->load->model('model_purchaseitem');
		$this->load->model('model_company');
		
	}

	public function index()
	{
		$this->render_template('admin_view/inventory/stock/index', $this->data);
	}
	
	public function fetchAllData()
	{
	    $data = $this->model_openingstock->fecthAllData();
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

	            // if($value['product_status'] == 'not')
	            // {
	            
		            $buttons .= '&nbsp; <a href="'.base_url().'opening_stock/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
		            
		            $buttons .= '&nbsp; <a href="'.base_url().'opening_stock/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
	            // }
	            
	            $result['data'][$key] = array(
	                                            
	                                            $no,
	                                            $value['opening_no'],
	                                            $value['entry_date'],
	                                            $value['tot_invoicevalue'],
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
	    $this->form_validation->set_rules('opening_stock', 'Stock Number', 'trim|required|is_unique[wo_inventoryopening.opening_no]');
	    
	    if ($this->form_validation->run() == TRUE)
	    {
	        $data = array(
        					'opening_no' => $this->input->post('opening_stock'),
        					'invoice_date' => $this->input->post('invoice_date'),
        					'entry_date' => $this->input->post('entry_date'),
        					'shipping_type' => $this->input->post('stype'),
        					'tracking_no' => $this->input->post('stracking_no'),
        					'division' => $this->input->post('division'),
        					// 'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'adjustment' => $this->input->post('adjustment'),
        					'tot_invoicevalue' => $this->input->post('total_invoice'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);
        				
	       // echo "<pre>"; print_r($data); exit;
	       $created_id = $this->model_openingstock->create($data);
	       
	       if($created_id == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('opening_stock/update/'.$created_id);
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('opening_stock/create');
        	}
	    
	    }
	    else
	    {
	        $orderNo = $this->model_openingstock->lastrecord();
        	
    	    if($orderNo == '')
    	    {
    	        $this->data['opening_no']  = '0000001';
    	       // echo $code = '0000001';
    	    }
    	    else
    	    {
    	        $np = $orderNo['opening_no'];
    	        $code = substr($np, 1); 
    	        
    	        $code = $code + 1;
    	        $code = sprintf('%07d',$code);
    	        
    	        $this->data['opening_no'] = $code;
    	    }
    	   // exit;
    	    
	        $this->data['shiptype'] = $this->model_shipping->fecthAllData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    		$this->render_template('admin_view/inventory/stock/create', $this->data);   
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('opening_stock', 'Stock Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE)
	    {
	         $data = array(
        					'id' => $this->input->post('id'),
        					'opening_no' => $this->input->post('opening_stock'),
        					'invoice_date' => $this->input->post('invoice_date'),
        					'entry_date' => $this->input->post('entry_date'),
        					'shipping_type' => $this->input->post('stype'),
        					'tracking_no' => $this->input->post('stracking_no'),
        					'division' => $this->input->post('division'),
        					'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'adjustment' => $this->input->post('adjustment'),
        					'tot_invoicevalue' => $this->input->post('total_invoice'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
        				
	       // echo "<pre>"; print_r($data); exit;
	       $update = $this->model_openingstock->update($data); 
	       
	       if($update == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('opening_stock');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('opening_stock/update/'.$this->input->post('id'));
        	}
	    }
	    else
	    {
    	    $this->data['shiptype'] = $this->model_shipping->fecthAllData();
            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
        
            $this->data['allData'] = $this->model_openingstock->fecthAllDataByID($id);
	        
	        $this->data['itemData'] = $this->model_openingstock->fetchStckoItemDataByOrderId($id);
	        // echo "<pre>"; print_r($itemData);exit();
	        // $this->data['itemData'] = $this->model_openingstock->fetchStckoItemDataById($id);
	        
        	$this->render_template('admin_view/inventory/stock/update', $this->data);   
	    }
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);
		
		$barcodeData = $this->model_barcode->getOpeningStockData($id);
        
        // echo $id; exit;
		$delete = $this->model_openingstock->delete($id);	

		if($delete == true) {
		    
		    foreach($barcodeData as $rows)
		    {
		        $this->model_barcode->delete($rows['id']);
		    } 
            
            $this->model_openingitem->deleteStockitemByOrderId($id);
            
            $this->model_purchaseitem->deleteItemByOrderId($id);
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('opening_stock');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('opening_stock');
    	}
	}

	
}