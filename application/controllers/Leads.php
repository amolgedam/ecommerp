<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Leads extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Lead Management';
		
        $this->load->model('model_customer');
		$this->load->model('model_ledger');
		
		$this->load->model('model_leads');
        $this->load->model('model_company');
        
	}
	
	public function fecthAllData()
	{
	    $data = $this->model_leads->fecthAllData();
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
                $buttons .= '&nbsp; <a href="'.base_url().'leads/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>';
                $buttons .= '&nbsp; <a href="'.base_url().'leads/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>';

                $result['data'][$key] = array(
                                                $no,
                                                $value['fname']." ".$value['mname']." ".$value['lname'],
                                                $value['company'],
                                                $value['mobile'],
                                                $value['annual_revenue'],
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
		$this->render_template('admin_view/crm/leadsManagement/index', $this->data);
	}

	public function create()
	{
	    $this->form_validation->set_rules('fname', 'First Name', 'trim|required');

	    if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); //exit;
        
            $data = array(
                        'customer_id' => $this->input->post('existingCustomer'),
                        'fname' => $this->input->post('fname'),
                        'mname' => $this->input->post('mname'),
                        'lname' => $this->input->post('lname'),
                        'company' => $this->input->post('company_name'),
                        'no_employee' => $this->input->post('no_employee'),
                        'website' => $this->input->post('website'),
                        'lead_owner' => $this->input->post('lead_owner'),
		                'lead_source' => $this->input->post('lead_source'),
		                'lead_status' => $this->input->post('lead_status'),
		                
		                'lead_status' => $this->input->post('industry'),
		                
        				'rating' => $this->input->post('rating'),
        				'annual_revenue' => $this->input->post('annual_revenue'),
        				'mobile' => $this->input->post('mobile'),
        				'phone' => $this->input->post('phone'),
        				'email' => $this->input->post('email'),
        				'street' => $this->input->post('street'),
        				'country' => $this->input->post('country'),
        				'state' => $this->input->post('state'),
        				'city' => $this->input->post('city'),
        				'zip' => $this->input->post('zip'),
        				'product_interented' => $this->input->post('product_interented'),
        				'generator' => $this->input->post('generator'),
        				'sic' => $this->input->post('sic'),
        				'primarysec' => $this->input->post('primary'),
        				'location' => $this->input->post('location'),
        				'description' => $this->input->post('description'),
                        'company_id' => $this->session->userdata('wo_company'),
        				// 'city_id' => $this->session->userdata('wo_city'),
        				'store_id' => $this->session->userdata('wo_store'),
        				'created_by' => $this->session->userdata('wo_id')
                    );
            // echo "<pre>"; print_r($data); exit();
            $created_id = $this->model_leads->create($data);
        
        	if($created_id == true) {
        	    
        	    $count_item_pname = count($_POST['item_pname']);
                
                for($i=0; $i<$count_item_pname; $i++)
    	        {
                    $itemData = array(
                                'leads_id' => $created_id,
                                'item_pname' => $this->input->post('item_pname')[$i],
                                'item_qty' => $this->input->post('item_qty')[$i],
                                'item_rate' => $this->input->post('item_rate')[$i],
                                'status' => $this->input->post('status')[$i],
                                'company_id' => $this->session->userdata('wo_company'),
                				// 'city_id' => $this->session->userdata('wo_city'),
                				'store_id' => $this->session->userdata('wo_store'),
                				'created_by' => $this->session->userdata('wo_id')
                            );
                    $this->model_leads->createItem($itemData);
    	        }
    	        
	        	$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('leads');
        	}
        	else
        	{
        	    $this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('leads/create');
        	}
            
	    }
	    else
	    {
            $this->data['customerData'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
	       
    		$this->render_template('admin_view/crm/leadsManagement/create', $this->data);	        
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('id', 'ID', 'trim|required');
	    $this->form_validation->set_rules('fname', 'First Name', 'trim|required');

	    if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); //exit;
            
            $data = array(
                        'id' => $this->input->post('id'),
                        'customer_id' => $this->input->post('existingCustomer'),
                        'fname' => $this->input->post('fname'),
                        'mname' => $this->input->post('mname'),
                        'lname' => $this->input->post('lname'),
                        'company' => $this->input->post('company_name'),
                        'no_employee' => $this->input->post('no_employee'),
                        'website' => $this->input->post('website'),
                        'lead_owner' => $this->input->post('lead_owner'),
		                'lead_source' => $this->input->post('lead_source'),
		                'lead_status' => $this->input->post('lead_status'),
		                
		                'lead_status' => $this->input->post('industry'),
		                
        				'rating' => $this->input->post('rating'),
        				'annual_revenue' => $this->input->post('annual_revenue'),
        				'mobile' => $this->input->post('mobile'),
        				'phone' => $this->input->post('phone'),
        				'email' => $this->input->post('email'),
        				'street' => $this->input->post('street'),
        				'country' => $this->input->post('country'),
        				'state' => $this->input->post('state'),
        				'city' => $this->input->post('city'),
        				'zip' => $this->input->post('zip'),
        				'product_interented' => $this->input->post('product_interented'),
        				'generator' => $this->input->post('generator'),
        				'sic' => $this->input->post('sic'),
        				'primarysec' => $this->input->post('primary'),
        				'location' => $this->input->post('location'),
        				'description' => $this->input->post('description'),
                        'company_id' => $this->session->userdata('wo_company'),
        				// 'city_id' => $this->session->userdata('wo_city'),
        				'store_id' => $this->session->userdata('wo_store'),
        				'modified_by' => $this->session->userdata('wo_id')
                    );
            // echo "<pre>"; print_r($data); exit;
            $created = $this->model_leads->update($data);
            
            if($created)
            {
                $this->session->set_flashdata('feedback','Data Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('leads');   
            }
            else
            {
                $this->session->set_flashdata('feedback','Unable to Update Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('leads/update'.$this->input->post('id'));
            }
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_leads->getDataByID($id);
    	    $this->data['itemData'] = $this->model_leads->getItemDataByID($id);
    	    
    	    $this->data['customerData'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
    	    
    		$this->render_template('admin_view/crm/leadsManagement/update', $this->data);   
	    }
	}
	
	public function delete()
	{
	    $id = $this->uri->segment(3);
	    // echo $id; exit; 
	    
	    $delete = $this->model_leads->delete($id);	

		if($delete == true) {
            
            $this->model_leads->itemDelete($id);
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('leads');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('leads');
    	}
	}

}