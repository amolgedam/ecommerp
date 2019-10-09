<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Service_master extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Service Type';
		
		$this->load->model('model_servicetype');
		$this->load->model('model_company');
		
	}
	
	public function fetchAllDataByID()
    {
        // $id = '1';
        $id = $_POST['service_id'];
        $data = $this->model_servicetype->fecthDataById($id);
        echo json_encode($data);
    }

	public function index()
	{
	    $this->data['allData'] = $this->model_servicetype->fecthAllData();
	    
		$this->render_template('admin_view/settings/serviceMaster/index', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('serviceType', 'Service Type', 'trim|required|is_unique[wo_servicetype.service_name]');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'service_name' => $this->input->post('serviceType'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_servicetype->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('service_master');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('service_master');
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_servicetype->fecthAllData();
	        
	        $this->render_template('admin_view/settings/serviceMaster/index', $this->data);
	    }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('editserviceType', 'Service Type', 'trim|required|is_unique[wo_designation.designation_name]');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'id' => $this->input->post('edit_id'),
        					'service_name' => $this->input->post('editserviceType'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_servicetype->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('service_master');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('service_master');
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_servicetype->fecthAllData();
	        
	        $this->render_template('admin_view/settings/serviceMaster/index', $this->data);
	    }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_servicetype->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('service_master');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('service_master');
    	}
	}
	
	
}