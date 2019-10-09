<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Product Category';
		
		$this->load->model('model_state');
		$this->load->model('model_store');
        $this->load->model('model_category');
		$this->load->model('model_division');
        $this->load->model('model_company');
        
	}
	
	public function fetchCatData()
	{
	    $data = $this->model_category->fecthAllData();
	    echo json_encode($data);
	}
	
	public function fetchCatDataById()
	{
	    $id = $_POST['id'];
	   // $id = 2;
	    $data = $this->model_category->fecthCatDataByID($id);
	    echo json_encode($data);
	}
	
	public function fetchSubCatData()
	{
	    $data = $this->model_category->fecthAllSubCatData();
	    echo json_encode($data);
	}
	
	public function index()
	{
	    $this->data['state'] = $this->model_state->fecthAllData();
		$this->data['city'] = $this->model_state->fecthAllCityData();
        $this->data['store'] = $this->model_store->fecthAllData();
		$this->data['division'] = $this->model_division->fecthAllData();
		
		$this->data['category'] = $this->model_category->fecthAllData();
		$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
		
		$this->render_template('admin_view/productMaster/category/index', $this->data);
	}
	
	public function create()
	{
        $this->form_validation->set_rules('category', 'Category Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // get unique name from company wise
            $this->load->helper('user_data_helper');

            $name = checkProductCatNameIsUnique($this->input->post('category'));
            
            if($name)
            {
                $this->data['errorName'] = ucwords($this->input->post('name'))." Name Available in Store or Company";

                $this->data['state'] = $this->model_state->fecthAllData();
                $this->data['city'] = $this->model_state->fecthAllCityData();
                $this->data['store'] = $this->model_store->fecthAllData();
                $this->data['division'] = $this->model_division->fecthAllData();

                    
                $this->data['category'] = $this->model_category->fecthAllData();
                $this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
                    
                $this->render_template('admin_view/productMaster/category/index', $this->data);
            }
            else
            {
                $data = array(
            	               // 'catgory_id' => $this->input->post('categoryid'),
                                'catgory_name' => $this->input->post('category'),
            					'division_id' => $this->input->post('division'),
                                'status' => $this->input->post('status'),
            				    'company_id' => $this->session->userdata('wo_company'),
            					// 'city_id' => $this->session->userdata('wo_city'),
            					'store_id' => $this->session->userdata('wo_store'),
            					'created_by' => $this->session->userdata('wo_id')
            				); 

            	// print_r($data); exit();
            	$create = $this->model_category->create($data);

            	if($create == true) {
            		
            		$this->session->set_flashdata('feedback','Data Saved Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				return redirect('product_category');
            	}
            	else {
            		
            		$this->session->set_flashdata('feedback','Unable to Saved Data');
    				$this->session->set_flashdata('feedback_class','alert alert-danger');
    				return redirect('product_category');
            	}
            }
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
        	$this->data['city'] = $this->model_state->fecthAllCityData();
            $this->data['store'] = $this->model_store->fecthAllData();
    		$this->data['division'] = $this->model_division->fecthAllData();
        		
        	$this->data['category'] = $this->model_category->fecthAllData();
        	$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
        		
    		$this->render_template('admin_view/productMaster/category/index', $this->data);
        }
	}
	
	public function update()
	{
        $this->form_validation->set_rules('editcategory', 'Category Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        	                'id' => $this->input->post('edit_id'),
                            // 'catgory_id' => $this->input->post('editcategoryid'),
        					'catgory_name' => $this->input->post('editcategory'),
                            'division_id' => $this->input->post('editdivision'),
                            'status' => $this->input->post('editcatstatus'),
        				    'company_id' => $this->session->userdata('wo_company'),
        				    // 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

            // 	print_r($data); exit();
        	$create = $this->model_category->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('product_category');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('product_category');
        	}
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
    		$this->data['city'] = $this->model_state->fecthAllCityData();
    		$this->data['store'] = $this->model_store->fecthAllData();
            $this->data['division'] = $this->model_division->fecthAllData();

    		
    		$this->data['category'] = $this->model_category->fecthAllData();
    		$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
    		
    		$this->render_template('admin_view/productMaster/category/index', $this->data);
        }
	}
	
	public function delete()
	{
	    
        $id = $this->input->post('id_edit');
        
    	$delete = $this->model_category->delete($id);

    	if($delete == true) {

        	$this->session->set_flashdata('feedback','Data Saved Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('product_category');
    	}
        else {
        		
    		$this->session->set_flashdata('feedback','Unable to Saved Data');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('product_category');
        }
	}
	
	public function createSubCat()
	{
	    
        $this->form_validation->set_rules('category', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('subcategory', 'Sub-Category Name', 'trim|required');
	   
        if ($this->form_validation->run() == TRUE) {


            $this->load->helper('user_data_helper');

            $name = checkProductSCatNameIsUnique($this->input->post('subcategory'));
            // echo "<pre>"; print_r($name); exit();
            
            if($name)
            {
                $this->data['errorName'] = ucwords($this->input->post('name'))." Name Available in Store or Company";

                $this->data['state'] = $this->model_state->fecthAllData();
                $this->data['city'] = $this->model_state->fecthAllCityData();
                $this->data['store'] = $this->model_store->fecthAllData();
                $this->data['division'] = $this->model_division->fecthAllData();

                    
                $this->data['category'] = $this->model_category->fecthAllData();
                $this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
                    
                $this->render_template('admin_view/productMaster/category/index', $this->data);
            }
            else
            {
            	$data = array(
            	                'category_id' => $this->input->post('category'),
            	               // 'subcatgory_id' => $this->input->post('subcategoryid'),
            					'subcategory_name' => $this->input->post('subcategory'),
                                'status' => $this->input->post('status'),

            				    'company_id' => $this->session->userdata('wo_company'),
            					// 'city_id' => $this->session->userdata('wo_city'),
            					'store_id' => $this->session->userdata('wo_store'),
            					'created_by' => $this->session->userdata('wo_id')
            				);

            	$create = $this->model_category->createSubCat($data);

            	if($create == true) {
            		
            		$this->session->set_flashdata('feedback','Data Saved Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				return redirect('product_category');
            	}
            	else {
            		
            		$this->session->set_flashdata('feedback','Unable to Saved Data');
    				$this->session->set_flashdata('feedback_class','alert alert-danger');
    				return redirect('product_category');
            	}
            }
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
    		$this->data['city'] = $this->model_state->fecthAllCityData();
    		$this->data['store'] = $this->model_store->fecthAllData();
            $this->data['division'] = $this->model_division->fecthAllData();
    		
    		$this->data['category'] = $this->model_category->fecthAllData();
    		$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
    		
    		$this->render_template('admin_view/productMaster/category/index', $this->data);
        }
	}
	
	public function updateSubCat()
	{
	    $this->form_validation->set_rules('edit_category', 'Category Name', 'trim|required');
	   // $this->form_validation->set_rules('editsubcategoryid', 'Sub-Category ID', 'trim|required');
	    $this->form_validation->set_rules('editsubcategory', 'Sub-Category Name', 'trim|required');
	   // $this->form_validation->set_rules('edit_country', 'State', 'trim|required');
	   // $this->form_validation->set_rules('edit_city', 'City', 'trim|required');
	   // $this->form_validation->set_rules('edit_store', 'Store', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        	                'id' => $this->input->post('editsubcat_id'),
        	                'category_id' => $this->input->post('edit_category'),
        	               // 'subcatgory_id' => $this->input->post('editsubcategoryid'),
        					'subcategory_name' => $this->input->post('editsubcategory'),
                            'status' => $this->input->post('editscatstatus'),
                            
        				    'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        				// 	'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_category->updateSubCat($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('product_category');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('product_category');
        	}
        }
        else
        {
            $this->data['state'] = $this->model_state->fecthAllData();
    		$this->data['city'] = $this->model_state->fecthAllCityData();
    		$this->data['store'] = $this->model_store->fecthAllData();
            $this->data['division'] = $this->model_division->fecthAllData();

    		
    		$this->data['category'] = $this->model_category->fecthAllData();
    		$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
    		
    		$this->render_template('admin_view/productMaster/category/index', $this->data);
        }
	}
	
	public function deleteSubCat()
	{
	    $id = $this->input->post('editsubcat_id');
        
    	$delete = $this->model_category->deleteSubCat($id);

    	if($delete == true) {
    		
    		$this->session->set_flashdata('feedback','Data Saved Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('product_category');
    	}
    	else {
    		
    		$this->session->set_flashdata('feedback','Unable to Saved Data');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('product_category');
    	}
	}
	
	public function fecthAllSubCatDataByID()
	{
	    $id = $_POST['cat_id'];
	    
	    $data = $this->model_category->fecthAllSubCatDataByID($id);
	    
	    echo json_encode($data);
	}
	
}