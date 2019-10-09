<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Unit';
		
		$this->load->model('model_unit');
        $this->load->model('model_company');
        
	}
    
    public function fecthAllData()
    {
        $data = $this->model_unit->fecthAllData();
        echo json_encode($data);
    }
    
    public function fecthUnitDataByID()
    {
        // $id = '10';
        $id = $_POST['unit_id'];
        $data = $this->model_unit->fecthUnitDataByID($id);
        echo json_encode($data);
    }
    
    public function fecthAllCategoryData()
    {
        $data = $this->model_unit->fecthAllCategoryData();
        echo json_encode($data);
    }
    
	public function index()
	{
	    $this->data['unit_cat'] = $this->model_unit->fecthAllCategoryData();
	    $this->data['unitDetails'] = $this->model_unit->fecthAllData();
	    
		$this->render_template('admin_view/productMaster/unit/index', $this->data);
	}
    
    public function createUnitCat()
    {
        $this->form_validation->set_rules('unitcat', 'Unit Category', 'trim|required');
        // $this->form_validation->set_rules('unitcat', 'Unit Category', 'trim|required|is_unique[wo_unitcategory.unit_cat_name]');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'unit_cat_name' => $this->input->post('unitcat'),
        					'sale_partial' => $this->input->post('sale'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_unit->createUnitCat($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('unit');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('unit');
        	}
        }
        else
        {
            $this->data['unit_cat'] = $this->model_unit->fecthAllCategoryData();
            $this->data['unitDetails'] = $this->model_unit->fecthAllData();
            
            $this->render_template('admin_view/productMaster/unit/index', $this->data);
        }
    }
    
    public function createUnit()
    {
        $this->form_validation->set_rules('unitcat', 'Unit Category', 'trim|required');
        $this->form_validation->set_rules('conversion', 'Unit Conversion', 'trim|required');
        $this->form_validation->set_rules('unit', 'Unit Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'unit_cat_id' => $this->input->post('unitcat'),
        					'conversion' => $this->input->post('conversion'),
        					'unit' => $this->input->post('unit'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_unit->createUnit($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('unit');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('unit');
        	}
        }
        else
        {
            $this->data['unit_cat'] = $this->model_unit->fecthAllCategoryData();
            $this->data['unitDetails'] = $this->model_unit->fecthAllData();
            
            $this->render_template('admin_view/productMaster/unit/index', $this->data);
        }
    }
    
    public function updateUnit()
    {
        $this->form_validation->set_rules('editunitcat', 'Unit Category', 'trim|required');
        $this->form_validation->set_rules('editconversion', 'Unit Conversion', 'trim|required');
        $this->form_validation->set_rules('editunit', 'Unit Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('id_edit'),
        					'unit_cat_id' => $this->input->post('editunitcat'),
        					'conversion' => $this->input->post('editconversion'),
        					'unit' => $this->input->post('editunit'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_unit->updateUnit($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('unit');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('unit');
        	}
        }
        else
        {
            $this->data['unit_cat'] = $this->model_unit->fecthAllCategoryData();
            $this->data['unitDetails'] = $this->model_unit->fecthAllData();
            
            $this->render_template('admin_view/productMaster/unit/index', $this->data);
        }
    }
    
    public function deleteUnit()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_unit->deleteUnit($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('unit');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('unit');
    	}
	}
}