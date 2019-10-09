<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Company extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Company Details';
		
		$this->load->model('model_company');
		$this->load->model('model_state');
	}

	public function index()
	{
	    $this->data['companyDetails'] = $this->model_company->fecthAllCompanyData();
	    
		$this->render_template('admin_view/settings/companyDetails/companyDetails/index', $this->data);
	}

	public function create()
	{
	    $this->form_validation->set_rules('c_name', 'Company name', 'trim|required|is_unique[wo_company.company_name]');
	    $this->form_validation->set_rules('address_one', 'Company Address', 'trim|required');
	    $this->form_validation->set_rules('gst', 'GST Number', 'trim|required');
	    $this->form_validation->set_rules('pin', 'PIN Number', 'trim|required');
	    $this->form_validation->set_rules('state', 'State', 'trim|required');
	    $this->form_validation->set_rules('city', 'City', 'trim|required');
	    $this->form_validation->set_rules('phone', 'phone', 'trim|max_length[10]|min_length[10]');
	    $this->form_validation->set_rules('mobile', 'mobile', 'trim|max_length[10]|min_length[10]');
	    $this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email');
	    $this->form_validation->set_rules('pan', 'PAN', 'trim|required');
	    $this->form_validation->set_rules('finance_year', 'Finance Year', 'trim|required');
	    $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE){     	
    
            $data = array(
        					'company_name' => $this->input->post('c_name'),
        					'address1' => $this->input->post('address_one'),
        					'address2' => $this->input->post('address_two'),
        					'gst' => $this->input->post('gst'),
        					'pincode' => $this->input->post('pin'),
        					'state' => $this->input->post('state'),
        					'city' => $this->input->post('city'),
        					'phone_no' => $this->input->post('phone'),
        					'mobile_no' => $this->input->post('mobile'),
        					'email' => $this->input->post('email'),
        					'pan' => $this->input->post('pan'),
        					'fstart' => $this->input->post('finance_year'),
        					'company_bank' => $this->input->post('company_name'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        
            $create = $this->model_company->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('company');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('company');
        	}
	    }
	    else
	    {
	        $this->data['state'] = $this->model_state->fecthAllData();
		    $this->data['city'] = $this->model_state->fecthAllCityData();
		
    		$this->render_template('admin_view/settings/companyDetails/companyDetails/create', $this->data);
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment('3');
	    
	    $this->data['allDetails'] = $this->model_company->fecthDataByID($id);
	    
	    $this->form_validation->set_rules('c_name', 'Company name', 'trim|required');
	    $this->form_validation->set_rules('address_one', 'Company Address', 'trim|required');
	    $this->form_validation->set_rules('gst', 'GST Number', 'trim|required');
	    $this->form_validation->set_rules('pin', 'PIN Number', 'trim|required');
	    $this->form_validation->set_rules('state', 'State', 'trim|required');
	    $this->form_validation->set_rules('city', 'City', 'trim|required');
	    $this->form_validation->set_rules('phone', 'phone', 'trim|max_length[10]|min_length[10]');
	    $this->form_validation->set_rules('mobile', 'mobile', 'trim|max_length[10]|min_length[10]');
	    $this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email');
	    $this->form_validation->set_rules('pan', 'PAN', 'trim|required');
	    $this->form_validation->set_rules('finance_year', 'Finance Year', 'trim|required');
	    $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE){
	        
	        $data = array(
        					'id' => $this->input->post('id'),
        					'company_name' => $this->input->post('c_name'),
        					'address1' => $this->input->post('address_one'),
        					'address2' => $this->input->post('address_two'),
        					'gst' => $this->input->post('gst'),
        					'pincode' => $this->input->post('pin'),
        					'state' => $this->input->post('state'),
        					'city' => $this->input->post('city'),
        					'phone_no' => $this->input->post('phone'),
        					'mobile_no' => $this->input->post('mobile'),
        					'email' => $this->input->post('email'),
        					'pan' => $this->input->post('pan'),
        					'fstart' => $this->input->post('finance_year'),
        					'company_bank' => $this->input->post('company_name'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
            
            $create = $this->model_company->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('company');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('company');
        	}
	    }
	    else
	    {
	        $this->data['state'] = $this->model_state->fecthAllData();
		    $this->data['city'] = $this->model_state->fecthAllCityData();
		    
	        $this->render_template('admin_view/settings/companyDetails/companyDetails/update', $this->data);
	    }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_company->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('company');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('company');
    	}
	}
}