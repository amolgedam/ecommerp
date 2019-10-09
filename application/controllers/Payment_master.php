<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Payment_master extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Paymnet Master';
		
		$this->load->model('model_ledger');
		$this->load->model('model_paymentmaster');
		$this->load->model('model_company');
		
	}

	public function index()
	{
	    $this->data['ledger'] = $this->model_ledger->fecthLedger();
	    $this->data['allData'] = $this->model_paymentmaster->fecthAllData();
	    
		$this->render_template('admin_view/settings/paymentMaster/index', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('paymentType', 'Payment Type', 'trim|required|is_unique[wo_payment.payment_name]');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'payment_name' => $this->input->post('paymentType'),
        					'ledger_id' => $this->input->post('ledger'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_paymentmaster->create($data);

        	if($create == true) { 
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('payment_master');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('payment_master');
        	}
	    }
	    else
	    {
	        $this->data['ledger'] = $this->model_ledger->fecthLedger();
	        $this->data['allData'] = $this->model_paymentmaster->fecthAllData();
	    
		    $this->render_template('admin_view/settings/paymentMaster/index', $this->data);
	    }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('paymentType', 'Payment Type', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
	       	$data = array(
        					'id' => $this->input->post('edit_id'),
        					'payment_name' => $this->input->post('paymentType'),
        					'ledger_id' => $this->input->post('ledger'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_paymentmaster->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('payment_master');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('payment_master');
        	}
	    }
	    else
	    {
	        $this->data['ledger'] = $this->model_ledger->fecthLedger();
	        $this->data['allData'] = $this->model_paymentmaster->fecthAllData();
	    
		    $this->render_template('admin_view/settings/paymentMaster/index', $this->data);
	    }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_paymentmaster->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('payment_master');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('payment_master');
    	}
	}
}