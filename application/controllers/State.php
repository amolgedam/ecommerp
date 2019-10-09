<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class State extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Sate and City';

		$this->load->model('model_state');
        $this->load->model('model_company');
        
	}
	
	public function fetchStateByID()
	{
	    $id = $_POST['state_id'];
	    
	    $data = $this->model_state->fetchStateByID($id);
	    
	    echo json_encode($data);
	}

	public function index()
	{
		$this->data['state'] = $this->model_state->fecthAllData();
		$this->data['city'] = $this->model_state->fecthAllCityData();
    
		$this->render_template('admin_view/settings/companyDetails/state/index', $this->data);
	}

	public function create()
	{
		$this->form_validation->set_rules('name', 'State Name', 'trim|required|is_unique[wo_country.country_name]');
// 		$this->form_validation->set_rules('state_id', 'State ID', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'country_name' => $this->input->post('name'),
        					'country_id' => $this->input->post('state_id'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id'),
        				);

        // 	print_r($data); exit();
        	$create = $this->model_state->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('state');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('state');
        	}
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
    		$this->data['city'] = $this->model_state->fecthAllCityData();
    
    		$this->render_template('admin_view/settings/companyDetails/state/index', $this->data);
        }
	}

	public function update()
	{
		$this->form_validation->set_rules('edit_name', 'Branch Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('edit_id'),
        					'country_name' => $this->input->post('edit_name'),
        					'country_id' => $this->input->post('state_id'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id'),
        				);

        // 	print_r($data); exit();
        	$update = $this->model_state->update($data);

        	if($update == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('state');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('state');
        	}
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
    		$this->data['city'] = $this->model_state->fecthAllCityData();
    
    		$this->render_template('admin_view/settings/companyDetails/state/index', $this->data);
        }
	}

	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_state->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('state');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('state');
    	}
	}
	
	public function createCity()
	{
	    $this->form_validation->set_rules('state', 'State Name', 'trim|required|is_unique[wo_city.city_name]');
	    $this->form_validation->set_rules('name', 'City Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'country_id' => $this->input->post('state'),
        					'city_name' => $this->input->post('name'),
        					'company_id' => $this->session->userdata('wo_company'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_state->createCity($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('state');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('state');
        	}
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
    		$this->data['city'] = $this->model_state->fecthAllCityData();
    
    		$this->render_template('admin_view/settings/companyDetails/state/index', $this->data);
        }
	}
	
	public function updateCity()
	{
	    $this->form_validation->set_rules('edit_name', 'City Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('edit_id'),
        					'city_name' => $this->input->post('edit_name'),
        					'country_id' => $this->input->post('edit_state'),
        					'company_id' => $this->session->userdata('wo_company'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$update = $this->model_state->updateCity($data);

        	if($update == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('state');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('state');
        	}
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
    		$this->data['city'] = $this->model_state->fecthAllCityData();
    
    		$this->render_template('admin_view/settings/companyDetails/state/index', $this->data);
        }
	}
	
	public function fetchCityByCompanyID()
	{
	    $id = $_POST['company_id'];
	   
	    $data = $this->model_state->fetchCityByCompanyID($id);
	    
	    echo json_encode($data);
	}
	
	public function deleteCity()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_state->deleteCity($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('state');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('state');
    	}
	}
}