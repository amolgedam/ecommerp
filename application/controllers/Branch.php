<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Branch extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Branch';
		
		$this->load->model('model_division');
		$this->load->model('model_branch');
        $this->load->model('model_company');
        
	}

	public function index()
	{
	    $this->data['division'] = $this->model_division->fecthAllData();
		$this->data['branch'] = $this->model_branch->fecthDataWithDivision();
		
		$this->render_template('admin_view/settings/companyDetails/branch/index', $this->data);
	}
	
	public function create()
	{
        $this->form_validation->set_rules('branch', 'Branch Name', 'trim|required');
		// $this->form_validation->set_rules('branch', 'Branch Name', 'trim|required|is_unique[wo_branch.branch_name]');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'branch_name' => $this->input->post('branch'),
        					'division_id' => $this->input->post('division'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_branch->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('branch');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('branch');
        	}
        }
        else
        {
            $this->data['division'] = $this->model_division->fecthAllData();
    		$this->data['branch'] = $this->model_branch->fecthDataWithDivision();
    		
    		$this->render_template('admin_view/settings/companyDetails/branch/index', $this->data);
        }
	}
	
	public function update()
	{
		$this->form_validation->set_rules('edit_branchname', 'Branch Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        	                'id' => $this->input->post('edit_id'),
        					'branch_name' => $this->input->post('edit_branchname'),
        					'division_id' => $this->input->post('edit_division'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_branch->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('branch');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('branch');
        	}
        }
        else
        {
            $this->data['division'] = $this->model_division->fecthAllData();
    		$this->data['branch'] = $this->model_branch->fecthDataWithDivision();
    		
    		$this->render_template('admin_view/settings/companyDetails/branch/index', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		
		$delete = $this->model_branch->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('branch');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('branch');
    	}
	}
}