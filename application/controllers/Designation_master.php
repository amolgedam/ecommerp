<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Designation_master extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Designation Master';
		
		$this->load->model('model_designation');
		$this->load->model('model_company');
		
	}

	public function index()
	{
	    $this->data['allData'] = $this->model_designation->fecthAllData();
	    
		$this->render_template('admin_view/settings/designationMaster/index', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('designationType', 'Designation Type', 'trim|required|is_unique[wo_designation.designation_name]');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'designation_name' => $this->input->post('designationType'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_designation->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('designation_master');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('designation_master');
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_designation->fecthAllData();
	        
	        $this->render_template('admin_view/settings/designationMaster/index', $this->data);
	    }
	}
	
	
	public function update()
	{
	    $this->form_validation->set_rules('editdesignationType', 'Designation Type', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'id' => $this->input->post('edit_id'),
        					'designation_name' => $this->input->post('editdesignationType'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_designation->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('designation_master');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('designation_master');
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_designation->fecthAllData();
	        
	        $this->render_template('admin_view/settings/designationMaster/index', $this->data);
	    }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_designation->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('designation_master');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('designation_master');
    	}
	}
	
}