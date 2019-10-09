<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Loyalty extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Loyalty Program';
		
        // $this->load->helper('loyaltypoint_helper');
		
		$this->load->model('model_loyalty');
        $this->load->model('model_company');
        
	}
	
	public function index()
	{
	    // $baseprice = 1000000.20;
	    // echo $this->loyaltypoint_helper->getPointValue($baseprice);
	    // exit;
	    
	    $this->render_template('admin_view/crm/loyalty/index', $this->data);
	}
	
	
	
	
	
	
	// 	ROYALTY POINTS
	
	public function loyaltyPoint()
	{
	    $this->data['value'] = $this->model_loyalty->fetchLoyaltyValue();
	    $this->data['allData'] = $this->model_loyalty->fetchAllPoints();
	    
	    $this->render_template('admin_view/crm/loyalty/loyaltyPoint', $this->data);
	}
	
	public function createValue()
	{
	    $this->form_validation->set_rules('point', 'Point', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            // echo "<pre>"; print_r($_POST);
            
            $data = array(
                            'value' => $this->input->post('point'),
                            'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
                        );
                        
            $create = $this->model_loyalty->createValue($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Insert Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('loyalty/loyaltyPoint');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Insert Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('loyalty/loyaltyPoint');
        	}
        }
        else
        {
            $this->data['value'] = $this->model_loyalty->fetchLoyaltyValue();
            $this->data['allData'] = $this->model_loyalty->fetchAllPoints();
	        
    	    $this->render_template('admin_view/crm/loyalty/loyaltyPoint', $this->data);            
        }
	}
	
	public function createPoint()
	{
	    $this->form_validation->set_rules('point', 'Point', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            // echo "<pre>"; print_r($_POST);
            
            $data = array(
                            'loyaltyvalueid' => $this->input->post('value'),
                            'percentage' => $this->input->post('percentage'),
                            'point' => $this->input->post('point'),
                            'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
                        );
                        
            $create = $this->model_loyalty->createPoint($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Insert Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('loyalty/loyaltyPoint');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Insert Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('loyalty/loyaltyPoint');
        	}
        }
        else
        {
            $this->data['value'] = $this->model_loyalty->fetchLoyaltyValue();
            $this->data['allData'] = $this->model_loyalty->fetchAllPoints();
	        
            $this->render_template('admin_view/crm/loyalty/loyaltyPoint', $this->data); 
        }
	}
	
	public function updatePoint()
	{
	    $this->form_validation->set_rules('id_edit', 'Point', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            // echo "<pre>"; print_r($_POST); //exit;
            
            $data = array(
                            'id' => $this->input->post('id_edit'),
                            'loyaltyvalueid' => $this->input->post('editvalueid'),
                            'percentage' => $this->input->post('editper'),
                            'point' => $this->input->post('editpoint'),
                            'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
                        );
            
            // echo "<pre>"; print_r($data); exit;
                        
            $create = $this->model_loyalty->updatePoint($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Insert Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('loyalty/loyaltyPoint');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Insert Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('loyalty/loyaltyPoint');
        	}
        }
        else
        {
            $this->data['value'] = $this->model_loyalty->fetchLoyaltyValue();
            $this->data['allData'] = $this->model_loyalty->fetchAllPoints();
	        
            $this->render_template('admin_view/crm/loyalty/loyaltyPoint', $this->data); 
        }
	}
	
	public function deletePoint()
	{
	    $this->form_validation->set_rules('id_edit', 'Point', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            $id = $this->input->post('id_edit');
            
            $delete = $this->model_loyalty->deletePoint($id);

        	if($delete) {
        		
        		$this->session->set_flashdata('feedback','Record Delete Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('loyalty/loyaltyPoint');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Delete Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('loyalty/loyaltyPoint');
        	}
        }
        else
        {
            $this->data['value'] = $this->model_loyalty->fetchLoyaltyValue();
            $this->data['allData'] = $this->model_loyalty->fetchAllPoints();
	        
            $this->render_template('admin_view/crm/loyalty/loyaltyPoint', $this->data); 
        }
	}
	

}

?>