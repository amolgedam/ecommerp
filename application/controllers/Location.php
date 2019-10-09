<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Branch';
		
        $this->load->model('model_branch');
		$this->load->model('model_division');
		$this->load->model('model_location');
        $this->load->model('model_company');
        
	}

    public function fetchLocationByDivision()
    {
        $id = $_POST['department_id'];
        $company_id = $_POST['company_id'];
        $data = $this->model_location->fetchLocationByDivision($id, $company_id);
        
        echo json_encode($data);
    } 

	public function index()
	{
        // $this->data['branch'] = $this->model_branch->fecthAllData();
	    $this->data['division'] = $this->model_division->fecthAllData();
		$this->data['location'] = $this->model_location->fecthDataWithBranch();
		
		$this->render_template('admin_view/settings/companyDetails/location/index', $this->data);
	}
	
	public function create()
	{
		$this->form_validation->set_rules('division', 'Division Name', 'trim|required');
		$this->form_validation->set_rules('location', 'location Name', 'trim|required|is_unique[wo_location.location_name]');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'location_name' => $this->input->post('location'),
        					// 'branch_id' => $this->input->post('branch'),
                            'division_id' => $this->input->post('division'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        	// print_r($data); exit();
        	$create = $this->model_location->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('location');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('location');
        	}
        }
        else
        {
            $this->data['branch'] = $this->model_branch->fecthAllData();
    		$this->data['location'] = $this->model_location->fecthDataWithBranch();
    		
    		$this->render_template('admin_view/settings/companyDetails/location/index', $this->data);
        }
	}
	
	public function update()
	{
		$this->form_validation->set_rules('edit_branch', 'Branch Name', 'trim|required');
		$this->form_validation->set_rules('edit_name', 'location Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        	                'id' => $this->input->post('edit_id'),
        					'location_name' => $this->input->post('edit_name'),
                            'division_id' => $this->input->post('edit_branch'),
        					// 'branch_id' => $this->input->post('edit_branch'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        	// print_r($data); exit();
        	$create = $this->model_location->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('location');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('location');
        	}
        }
        else
        {
            $this->data['branch'] = $this->model_branch->fecthAllData();
    		$this->data['location'] = $this->model_location->fecthDataWithBranch();
    		
    		$this->render_template('admin_view/settings/companyDetails/location/index', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_location->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('location');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('location');
    	}
	}
}