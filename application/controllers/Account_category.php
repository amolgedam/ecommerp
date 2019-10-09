<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_category extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Account Category';
		
// 		$this->load->model('model_state');
// 		$this->load->model('model_store');
        $this->load->model('model_accountcat');
		$this->load->model('model_company');
	}
	
	public function fetchSubcatBycateID()
	{
	   // $id = '1';
	    $id = $_POST['accountcat_id'];

	    $data = $this->model_accountcat->fetchSubcatBycateID($id);
	    
	    echo json_encode($data);
	}

	public function index()
	{
		$this->data['category'] = $this->model_accountcat->fecthAllCatData();
		$this->data['subcategory'] = $this->model_accountcat->fecthAllSubCatData();
		
		$this->render_template('admin_view/settings/accountManagement/index', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('category', 'Account Category Name', 'trim|required|is_unique[wo_accountcat.acategories_name]');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'acategories_name' => $this->input->post('category'),
        				    'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_accountcat->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('account_category');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('account_category');
        	}
        }
        else
        {
            $this->data['category'] = $this->model_accountcat->fecthAllCatData();
    		$this->data['subcategory'] = $this->model_accountcat->fecthAllSubCatData();
    		
    		$this->render_template('admin_view/settings/accountManagement/index', $this->data);
        }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('editcategory', 'Category Name', 'trim|required');
	   // $this->form_validation->set_rules('editcountry', 'State', 'trim|required');
	   // $this->form_validation->set_rules('editcity', 'City', 'trim|required');
	   // $this->form_validation->set_rules('editstore', 'Store', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        	                'id' => $this->input->post('edit_id'),
        					'acategories_name' => $this->input->post('editcategory'),
        				    'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_accountcat->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('account_category');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('account_category');
        	}
        }
        else
        {
            $this->data['category'] = $this->model_accountcat->fecthAllCatData();
    		$this->data['subcategory'] = $this->model_accountcat->fecthAllSubCatData();
    		
    		$this->render_template('admin_view/settings/accountManagement/index', $this->data);
        }
	}
	
	public function delete()
	{
	    
            $id = $this->input->post('id_edit');
        
        	$delete = $this->model_accountcat->delete($id);

        	if($delete == true) {
        		
        		$this->session->set_flashdata('feedback','Record Delete Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('account_category');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Delete Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('account_category');
        	}
	}
	
	public function createSubCat()
	{
	    $this->form_validation->set_rules('subcategory', 'Sub-Category Name', 'trim|required|is_unique[wo_accountsubcat.asubcat_name]');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        	                'accountcat_id' => $this->input->post('category'),
        					'asubcat_name' => $this->input->post('subcategory'),
        				    'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

            // 	print_r($data); exit();
        	$create = $this->model_accountcat->createSubCat($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('account_category');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('account_category');
        	}
        }
        else
        {
            $this->data['category'] = $this->model_accountcat->fecthAllCatData();
    		$this->data['subcategory'] = $this->model_accountcat->fecthAllSubCatData();
    		
    		$this->render_template('admin_view/settings/accountManagement/index', $this->data);
        }
	}
	
	public function updateSubCat()
	{
	    $this->form_validation->set_rules('edit_category', 'Sub-Category Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        	                'id' => $this->input->post('editsubcat_id'),
        	                'accountcat_id' => $this->input->post('edit_category'),
        					'asubcat_name' => $this->input->post('editsubcategory'),
        				    'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

            // 	print_r($data); exit();
        	$create = $this->model_accountcat->updateSubCat($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('account_category');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('account_category');
        	}
        }
        else
        {
            $this->data['category'] = $this->model_accountcat->fecthAllCatData();
    		$this->data['subcategory'] = $this->model_accountcat->fecthAllSubCatData();
    		
    		$this->render_template('admin_view/settings/accountManagement/index', $this->data);  
        }
	}
	
	public function deleteSubCat()
	{
	    $id = $this->input->post('editsubcat_id');
        
    	$delete = $this->model_accountcat->deleteSubCat($id);

    	if($delete == true) {
    		
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('account_category');
    	}
    	else {
    		
    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('account_category');
    	}
	}
	
}