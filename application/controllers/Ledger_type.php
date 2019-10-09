<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Ledger_type extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Leder Type';
		
		$this->load->model('model_ledgertype');
		$this->load->model('model_company');
		
	}

	public function index()
	{
	    $this->data['allData'] = $this->model_ledgertype->fecthAllData();
	    
		$this->render_template('admin_view/settings/accountManagement/ledgerType', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('ledgertype', 'Ledger Type', 'trim|required|is_unique[wo_ledgertype.ledgertype_name]');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'ledgertype_name' => $this->input->post('ledgertype'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_ledgertype->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('ledger_type');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('ledger_type');
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_ledgertype->fecthAllData();
	    
	    	$this->render_template('admin_view/settings/accountManagement/ledgerType', $this->data);
	    }
	}
	
	
	public function update()
	{
	    $this->form_validation->set_rules('editdesignationType', 'Ledger Type', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'id' => $this->input->post('edit_id'),
        					'ledgertype_name' => $this->input->post('editdesignationType'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_ledgertype->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('ledger_type');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('ledger_type');
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_ledgertype->fecthAllData();
	    
	    	$this->render_template('admin_view/settings/accountManagement/ledgerType', $this->data);
	    }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_ledgertype->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('ledger_type');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('ledger_type');
    	}
	}
	
}