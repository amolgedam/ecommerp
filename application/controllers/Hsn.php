<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Hsn extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'HSN';
		
		$this->load->model('model_hsn');
		$this->load->model('model_company');
		
	}

    public function fecthAllData()
    {
        $data = $this->model_hsn->fecthAllData();
        echo json_encode($data);
    }
    
    public function saveHSN()
	{
	    $name = $_POST['name'];
	    $code = $_POST['code'];
	   // $name = 'hsn1';
	   // $code = 'hsn';
	   
	    $data = $this->model_hsn->fetchDataByNameCode($name, $code);
	   // echo "<pre>"; print_r($data);exit;
	   
	   $count = count($data);
	   
	    if($count == 0)
	    {
	        $data = array(
	                        'hsn_name' => $_POST['name'],
	                        'hsn_code' => $_POST['code'],
	                        'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
	                    );
	                    
            $data=$this->model_hsn->create($data);
		    echo json_encode($data);        
	    }
	    else
	    {
	        $status = "0";
	        echo json_encode($status);
	    }
	}

	public function index()
	{
	    $this->data['hsn'] = $this->model_hsn->fecthAllData();
	    
		$this->render_template('admin_view/productMaster/hsn/index', $this->data);
	}
	
	public function create()
	{
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
	    // $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|is_unique[wo_hsn.hsn_name]');
	    $this->form_validation->set_rules('hsn_code', 'HSN Code', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'hsn_name' => $this->input->post('product_name'),
        					'hsn_code' => $this->input->post('hsn_code'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_hsn->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('hsn');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('hsn');
        	}
        }
        else
        {
            $this->data['hsn'] = $this->model_hsn->fecthAllData($data);
            
    		$this->render_template('admin_view/productMaster/hsn/index', $this->data);
        }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('editproduct_name', 'Product Name', 'trim|required');
	    $this->form_validation->set_rules('edithsn_code', 'HSN Code', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('id_edit'),
        					'hsn_name' => $this->input->post('editproduct_name'),
        					'hsn_code' => $this->input->post('edithsn_code'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_hsn->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('hsn');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('hsn');
        	}
        }
        else
        {
            $this->data['hsn'] = $this->model_hsn->fecthAllData();
            
    		$this->render_template('admin_view/productMaster/hsn/index', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_hsn->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('hsn');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('hsn');
    	}
	}

}