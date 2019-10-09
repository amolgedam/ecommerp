<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Division extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Division';
		
		$this->load->model('model_division');
		$this->load->model('model_store');
		$this->load->model('model_category');
        $this->load->model('model_company');
        
	}

    public function fetchDivisionByCompany()
    {
        $id = $_POST['company_id'];
        
        $data = $this->model_division->fetchDivisionByCompany($id);
        
        echo json_encode($data);
    }
    
    public function fetchProductCatByDivision()
    {
        $id = $_POST['division'];
        
        $data = $this->model_category->fecthAllDataByDivision($id);
        
        echo json_encode($data);
    }

	public function index()
	{
	    if($_SESSION['wo_role'] == 'superadmin')
	    {
	        $this->data['divisionDetails'] = $this->model_division->fecthAllDivision();
	        
	        $this->data['store'] = $this->model_store->fecthAllStoresData();
	    }
	    else
	    {
    	    $this->data['divisionDetails'] = $this->model_division->fecthAllData();
	        $this->data['store'] = $this->model_store->fecthAllStores();
	    }
	    
	    
	    
		$this->render_template('admin_view/settings/companyDetails/division/index', $this->data);
	}
	   
	public function create()
	{
        $this->form_validation->set_rules('division_name', 'Division Name', 'trim|required');
	    // $this->form_validation->set_rules('division_name', 'Division Name', 'trim|required|is_unique[wo_division.division_name]');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'division_name' => $this->input->post('division_name'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_division->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('division');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('division');
        	}
        }
        else
        {
            $this->data['divisionDetails'] = $this->model_division->fecthAllData();
            
            $this->render_template('admin_view/settings/companyDetails/division/index', $this->data);
        }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('editdivision_name', 'Division Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        	                'id' => $this->input->post('edit_id'),
        					'division_name' => $this->input->post('editdivision_name'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	
        	$update = $this->model_division->update($data);

        	if($update == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('division');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('division');
        	}
        }
        else
        {
            $this->data['divisionDetails'] = $this->model_division->fecthAllData();
            
            $this->render_template('admin_view/settings/companyDetails/division/index', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_division->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('division');
    	}
    	else{
    	}
	}
	
}