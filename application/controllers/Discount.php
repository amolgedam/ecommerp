<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Discount';
		
		$this->load->model('model_discount');
        $this->load->model('model_company');
        
	}

    public function fecthAllData()
	{
	    $data = $this->model_discount->fecthAllData();
	    
		echo json_encode($data);
	}
	
	public function index()
	{
	    $this->data['discount'] = $this->model_discount->fecthAllData();
	    
		$this->render_template('admin_view/master/discount/index', $this->data);
	}
	
	public function create()
	{
        $this->form_validation->set_rules('discount_code', 'Discount Code', 'trim|required');
	    // $this->form_validation->set_rules('discount_code', 'Discount Code', 'trim|required|is_unique[wo_discount.discount_code]');
	    $this->form_validation->set_rules('discount', 'Discount Number', 'trim|required');
	    $this->form_validation->set_rules('max_discount', 'Max Discount', 'trim|required');
	    $this->form_validation->set_rules('promo_code', 'Promo Code', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'discount_code' => $this->input->post('discount_code'),
        					'discount' => $this->input->post('discount'),
        					'max_discount' => $this->input->post('max_discount'),
        					'promo_code' => $this->input->post('promo_code'),
        					'remark' => $this->input->post('remark'),
        					'status' => $this->input->post('status'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_discount->create($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('discount');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('discount');
        	}
        }
        else
        {
            $this->data['discount'] = $this->model_discount->fecthAllData();
            
    		$this->render_template('admin_view/master/discount/index', $this->data);
        }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('editdiscount_code', 'Discount Code', 'trim|required');
	    $this->form_validation->set_rules('editdiscount', 'Discount Number', 'trim|required');
	    $this->form_validation->set_rules('editmax_discount', 'Max Discount', 'trim|required');
	    $this->form_validation->set_rules('editpromo_code', 'Promo Code', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	$data = array(
        					'id' => $this->input->post('edit_id'),
        					'discount_code' => $this->input->post('editdiscount_code'),
        					'discount' => $this->input->post('editdiscount'),
        					'max_discount' => $this->input->post('editmax_discount'),
        					'promo_code' => $this->input->post('editpromo_code'),
        					'remark' => $this->input->post('editremark'),
        					'status' => $this->input->post('editstatus'),
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	print_r($data); exit();
        	$create = $this->model_discount->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('discount');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('discount');
        	}
        }
        else
        {
            $this->data['discount'] = $this->model_discount->fecthAllData();
    
    		$this->render_template('admin_view/master/discount/index', $this->data);
        }
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_discount->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('discount');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('discount');
    	}
	}

}