<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Customer extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Customer';
		
		$this->load->model('model_customer');
		$this->load->model('model_supplier');
		$this->load->model('model_ledger');
		$this->load->model('model_company');
		
	}
	
	public function getDataByID()
	{
	    $id = $_POST['id'];
	    $data = $this->model_customer->getDataByID($id);
	    echo json_encode($data);
	}

	public function getDataByLedgerID()
	{
	    $id = $_POST['id'];
	    $data = $this->model_ledger->fecthDataByID($id);
	    echo json_encode($data);
	}

	public function fecthAllData()
	{
	    $data = $this->model_customer->fecthAllData();
	   // echo "<pre>"; print_r($data);
	   // exit;

	    if(empty($data))
        {
            $result['data'] = '';
        }
        else
        {
		    $no=1;
	        foreach($data as $key => $value)
	        {
	            $buttons = '';
	            $buttons .= '&nbsp; <a href="'.base_url().'customer/view/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View</a>';
	            $buttons .= '&nbsp; <a href="'.base_url().'customer/update/'.$value['id'].'" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>';
	            $buttons .= '&nbsp; <a href="'.base_url().'customer/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>';

	            $result['data'][$key] = array(
	                                            
	                                            $no,
	                                            $value['fname']." ".$value['mname']." ".$value['lname'],
	                                            $value['comapny'],
	                                            $value['gst'],
	                                            $value['address1']." ".$value['address2'],
	                                            $buttons
	                                        );              
	            $no++;
	        }
	    }
        // print_r($result);
        echo json_encode($result);
        exit;
	}
	
	public function index()
	{
		$this->render_template('admin_view/crm/customerInformation/index', $this->data);
	}
	
	public function create()
	{
	    $this->form_validation->set_rules('fname', 'First Name', 'trim|required');

	    if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST);
            
        	$data = array(
                'title' => $this->input->post('title'),
				'fname' => $this->input->post('fname'),
				'mname' => $this->input->post('mname'),
				'lname' => $this->input->post('lname'),
				'comapny' => $this->input->post('comapny_name'),
				'address1' => $this->input->post('address_one'),
				'address2' => $this->input->post('address_two'),
				'country' => $this->input->post('country'),
				'state' => $this->input->post('state'),
				'city' => $this->input->post('city'),
				'mobile' => $this->input->post('mobile'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'pan' => $this->input->post('pan'),
				'gst' => $this->input->post('gst'),
				'social' => $this->input->post('social'),
				'company_id' => $this->session->userdata('wo_company'),
				// 'city_id' => $this->session->userdata('wo_city'),
				'store_id' => $this->session->userdata('wo_store'),
				'created_by' => $this->session->userdata('wo_id')
			);

        // 	 echo "<pre>"; print_r($data); exit();
        	$create = $this->model_customer->create($data);
            
            if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('customer');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('customer/create');
        	}
        }
        else
        {
    		$this->render_template('admin_view/crm/customerInformation/create', $this->data);
        
        }
	}
	
	public function update()
	{
	    $this->form_validation->set_rules('fname', 'First Name', 'trim|required');

	    if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST);
            // exit;
        	$data = array(
                'id' => $this->input->post('id'),
                'title' => $this->input->post('title'),
				'fname' => $this->input->post('fname'),
				'mname' => $this->input->post('mname'),
				'lname' => $this->input->post('lname'),
				'comapny' => $this->input->post('comapny_name'),
				'address1' => $this->input->post('address_one'),
				'address2' => $this->input->post('address_two'),
				'country' => $this->input->post('country'),
				'state' => $this->input->post('state'),
				'city' => $this->input->post('city'),
				'mobile' => $this->input->post('mobile'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'pan' => $this->input->post('pan'),
				'gst' => $this->input->post('gst'),
				'social' => $this->input->post('social'),
				'company_id' => $this->session->userdata('wo_company'),
				// 'city_id' => $this->session->userdata('wo_city'),
				'store_id' => $this->session->userdata('wo_store'),
				'created_by' => $this->session->userdata('wo_id')
			);

        // 	 echo "<pre>"; print_r($data); exit();
        	$create = $this->model_customer->update($data);
            
            if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('customer');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('customer/update'.$this->input->post('id'));
        	}
        }
        else
        {
             $id = $this->uri->segment(3);
        	 // echo $id; exit;
        	 $this->data['allData'] = $this->model_customer->getDataByID($id);
        	    
    		$this->render_template('admin_view/crm/customerInformation/update', $this->data);
        
        }
	}
	
	public function delete()
	{
	    $id = $this->uri->segment(3);
	    // echo $id; exit; 
	    
	    $delete = $this->model_customer->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('customer');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('customer');
    	}
	}
	
	public function view()
	{
	    $id = $this->uri->segment(3);
	   // echo $id; exit;
	    $this->data['allData'] = $this->model_customer->getDataByID($id);
		$this->render_template('admin_view/crm/customerInformation/view', $this->data);
	}

	
}