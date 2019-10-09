<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_master extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Shipping';
		
		$this->load->model('model_shipping');
        $this->load->model('model_company');
        
	}

    public function fetchData()
    {
        $data = $this->model_shipping->fecthAllData();
        echo json_encode($data);
    }

    public function saveModalData(){

        $data = array(
                        'shipping_name' => $this->input->post('shippingName'),
                        'company_id' => $this->session->userdata('wo_company'),
                        // 'city_id' => $this->session->userdata('wo_city'),
                        'store_id' => $this->session->userdata('wo_store'),
                        'created_by' => $this->session->userdata('wo_id')
                    );
        // echo "<pre>"; print_r($data);
        $data=$this->model_shipping->create($data);
        echo json_encode($data);
    }

	public function index()
	{
	    $this->data['allData'] = $this->model_shipping->fecthAllData();
	    
		$this->render_template('admin_view/settings/shippingMaster/index', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('shippingName', 'Shipping Name', 'trim|required|is_unique[wo_shippingtype.shipping_name]');
	    
	    if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'shipping_name' => $this->input->post('shippingName'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_shipping->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('shipping_master');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('shipping_master');
        	}
        }
        else
        {
            $this->data['allData'] = $this->model_shipping->fecthAllData();
            
		    $this->render_template('admin_view/settings/shippingMaster/index', $this->data);
        }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('editshippingName', 'Shipping Name', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('edit_id'),
        					'shipping_name' => $this->input->post('editshippingName'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_shipping->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('shipping_master');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('shipping_master');
        	}
        }
        else
        {
            $this->data['allData'] = $this->model_shipping->fecthAllData();
            
		    $this->render_template('admin_view/settings/shippingMaster/index', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_shipping->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('shipping_master');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('shipping_master');
    	}
	}

}