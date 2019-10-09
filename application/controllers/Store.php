<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Store';
		
		$this->load->model('model_state');
        $this->load->model('model_store');
        $this->load->model('model_company');
	}

	public function index()
	{
	    $this->data['state'] = $this->model_state->fecthAllData();
	    $this->data['city'] = $this->model_state->fecthAllCityData();
	    $this->data['company'] = $this->model_company->fecthAllCompanyData();
	    
	    $this->data['storeData'] = $this->model_store->fecthAllData();

		$this->render_template('admin_view/settings/storeMaster/index', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('storeName', 'Store Name', 'trim|required|is_unique[wo_store.store_name]');
	    $this->form_validation->set_rules('landline_no', 'Landline Number', 'trim|required');
	    $this->form_validation->set_rules('address', 'Addres', 'trim|required');
	   // $this->form_validation->set_rules('state', 'State', 'trim|required');
	   // $this->form_validation->set_rules('city', 'City', 'trim|required');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); exit();

        	$data = array(
        	   //             'country_id' => $this->input->post('state'),
        				// 	'city_id' => $this->input->post('city'),
        					'store_id' => $this->input->post('storeID'),
        					'store_name' => $this->input->post('storeName'),
        					'landline_no' => $this->input->post('landline_no'),
        					'address' => $this->input->post('address'),
        					'email' => $this->input->post('email'),
        					'company_id' => $this->input->post('company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        	// print_r($data); exit();
        	$create = $this->model_store->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('store');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('store');
        	}
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
    	    $this->data['city'] = $this->model_state->fecthAllCityData();
    	    
    	    $this->data['storeData'] = $this->model_store->fecthAllData();
    
    		$this->render_template('admin_view/settings/storeMaster/index', $this->data);
        }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('editstoreName', 'State Name', 'trim|required');
	    $this->form_validation->set_rules('editlandline_no', 'Landline Number', 'trim|required');
	    $this->form_validation->set_rules('editaddress', 'Addres', 'trim|required');
	   // $this->form_validation->set_rules('editstate', 'State', 'trim|required');
	   // $this->form_validation->set_rules('editcity', 'City', 'trim|required');
	    $this->form_validation->set_rules('editemail', 'Email', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('edit_id'),
        				// 	'country_id' => $this->input->post('editstate'),
        				// 	'city_id' => $this->input->post('editcity'),
        					'store_id' => $this->input->post('editstoreID'),
        					'store_name' => $this->input->post('editstoreName'),
        					'landline_no' => $this->input->post('editlandline_no'),
        					'address' => $this->input->post('editaddress'),
        					'email' => $this->input->post('editemail'),
        					'company_id' => $this->input->post('editcompany'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$update = $this->model_store->update($data);

        	if($update == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('store');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('store');
        	}
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
    	    $this->data['city'] = $this->model_state->fecthAllCityData();
    	    
    	    $this->data['storeData'] = $this->model_store->fecthAllData();
    
    		$this->render_template('admin_view/settings/storeMaster/index', $this->data);
        }
	}
	
	public function fetchStoreByCityID()
	{
	    $id = $_POST['city_id'];
	   // $id = 2;
	   
	    $data = $this->model_store->fetchStoreByCityID($id);
	    
	    echo json_encode($data);
	}
	
	public function fetchStoreByCompanyID()
	{
	   // $id = '4';
	    $id = $_POST['company_id'];
	    $data = $this->model_store->fetchStoreByCompanyID($id);
	    echo json_encode($data);
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_store->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('store');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('store');
    	}
	}

}