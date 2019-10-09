<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Attribut';
		
		$this->load->model('model_attribute');
		$this->load->model('model_company');
		
	}

	public function index()
	{
	    $this->data['allData'] = $this->model_attribute->fecthAllData();
	    
		$this->render_template('admin_view/productMaster/attribute/index', $this->data);
	}
	
	public function fetchDataByID()
	{
	    $id= $_POST['id'];
	   // $id= '4';
	    $data = $this->model_attribute->fetchDataById($id);
	   // print_r($data); //exit;
	    
	    $attrValue = array();
	    $attrValue = explode(', ', $data['attr_values']);
	    
	   // $mydata = array(
	   //                     'id' => $data['id'],
	   //                     'values' => $attrValue
	   //                 );
	    
	    
	   // print_r($mydata); exit;
	    echo json_encode($attrValue);
	}
	
	public function saveAttribute()
	{
	    $id = $_POST['id'];
	    $attr = $_POST['name'];
	   // $id = '4';
	   // $attr = 'green, yellow';
	    
	    $newattrValue = explode(', ', $attr);
	    
	    $data = $this->model_attribute->fetchDataById($id);
	   // echo "<pre>"; print_r($data);
	    
	    $attrValue = array();
	    $attrValue = explode(', ', $data['attr_values']);
	   // echo "<pre>"; print_r($attrValue);
	    
	    $result = array_merge($attrValue, $newattrValue);
	    
	    $updateAttr = implode(", ", $result);

        // echo "<pre>"; print_r($result);
        //         echo "<pre>"; print_r($updateAttr);
        
        $data = array(
        					'id' => $id,
        					'attr_values' => $updateAttr,
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
        // echo "<pre>"; print_r($data);

        $success = $this->model_attribute->update($data);
        echo json_encode($success);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('name', 'Attribute Name', 'trim|required|is_unique[wo_attribute.attr_name]');
	    $this->form_validation->set_rules('values', 'Attribute values', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'attr_name' => $this->input->post('name'),
        					'attr_values' => $this->input->post('values'),
        					'status' => $this->input->post('status'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_attribute->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('attribute');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('attribute');
        	}
        }
        else
        {
            $this->data['allData'] = $this->model_attribute->fecthAllData();
	    
		    $this->render_template('admin_view/productMaster/attribute/index', $this->data);
        }
	}
	
	public function updateAttrValue()
	{
	    $data = $this->model_attribute->fetchDataById($_POST['id']);
	    
	    $arrayData = array();
	    $arrayData = explode(', ', $data['attr_values']);
	    
	    $arrayData1 = array();
	    $arrayData1 = explode(', ', $_POST['color']);
	    
	    $result =  array_merge($arrayData, $arrayData1);

        $data = array(
        					'id' => $this->input->post('id_edit'),
        					'attr_values' => $this->input->post('edit_values'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        $this->model_attribute->update($data);
	    
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('edit_attribute', 'Attribute Name', 'trim|required');
	    $this->form_validation->set_rules('edit_values', 'Attribute values', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('id_edit'),
        					'attr_name' => $this->input->post('edit_attribute'),
        					'attr_values' => $this->input->post('edit_values'),
        					'status' => $this->input->post('edit_status'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_attribute->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('attribute');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('attribute');
        	}
        }
        else
        {
            $this->data['allData'] = $this->model_attribute->fecthAllData();
	    
		    $this->render_template('admin_view/productMaster/attribute/index', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_attribute->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('attribute');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('attribute');
    	}
	}
	
	public function attributDetails()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->data['allData'] = $this->model_attribute->fecthAllDataByID($id);
	    
		$this->render_template('admin_view/productMaster/attribute/attributeList', $this->data);
	}

}