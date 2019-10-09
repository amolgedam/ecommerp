<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Weight extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Weight';
		
		$this->load->model('model_weight');
        $this->load->model('model_company');
        
	}

	public function index()
	{
	    $this->data['allData'] = $this->model_weight->fecthAllData();
	    
		$this->render_template('admin_view/productMaster/weight/index', $this->data);
	}
	
	public function create()
	{
        $this->form_validation->set_rules('name', 'Weight Name', 'trim|required');
	    // $this->form_validation->set_rules('name', 'Weight Name', 'trim|required|is_unique[wo_weight.weight_name]');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'weight_name' => $this->input->post('name'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_weight->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('weight');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('weight');
        	}
        }
        else
        {
            $this->data['allData'] = $this->model_weight->fecthAllData();
	    
		    $this->render_template('admin_view/productMaster/weight/index', $this->data);
        }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('editweight', 'Weight Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('id_edit'),
        					'weight_name' => $this->input->post('editweight'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_weight->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('weight');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('weight');
        	}
        }
        else
        {
            $this->data['allData'] = $this->model_weight->fecthAllData();
	    
		    $this->render_template('admin_view/productMaster/weight/index', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_weight->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('weight');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('weight');
    	}
	}

}