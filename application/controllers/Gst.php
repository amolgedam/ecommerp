<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Gst extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'GST';
		
		$this->load->model('model_gst');
		$this->load->model('model_company');
		
	}
	
	public function fecthAllData()
	{
	    $data = $this->model_gst->fecthAllData();
	    echo json_encode($data);
	}
    
    public function fetchAllDataByID()
    {
        // $id = '1';
        $id = $_POST['gst_id'];
        $data = $this->model_gst->fetchAllDataByID($id);
        echo json_encode($data);
    }
    
	public function index()
	{
	    $this->data['allData'] = $this->model_gst->fecthAllData();
	    
		$this->render_template('admin_view/master/gst/index', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('name', 'Designation Type', 'trim|required');
	    // $this->form_validation->set_rules('name', 'Designation Type', 'trim|required|is_unique[wo_gst.gst_name]');
	    $this->form_validation->set_rules('sgst', 'SGST', 'trim|required');
	    $this->form_validation->set_rules('cgst', 'CGST', 'trim|required');
	    $this->form_validation->set_rules('igst', 'IGST', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'gst_name' => $this->input->post('name'),
        					'sgst' => $this->input->post('sgst'),
        					'cgst' => $this->input->post('cgst'),
        					'igst' => $this->input->post('igst'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_gst->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('gst');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('gst');
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_gst->fecthAllData();
	    
		    $this->render_template('admin_view/master/gst/index', $this->data);
	    }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('edit_name', 'Designation Type', 'trim|required');
	    $this->form_validation->set_rules('edit_sgst', 'SGST', 'trim|required');
	    $this->form_validation->set_rules('edit_cgst', 'CGST', 'trim|required');
	    $this->form_validation->set_rules('edit_igst', 'IGST', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'id' => $this->input->post('edit_id'),
        					'gst_name' => $this->input->post('edit_name'),
        					'sgst' => $this->input->post('edit_sgst'),
        					'cgst' => $this->input->post('edit_cgst'),
        					'igst' => $this->input->post('edit_igst'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_gst->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('gst');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('gst');
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_gst->fecthAllData();
	    
		    $this->render_template('admin_view/master/gst/index', $this->data);
	    }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_gst->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('gst');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('gst');
    	}
	}
}