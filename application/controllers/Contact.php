<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Contact extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Contact';
		
		$this->load->model('model_accountcat');
		$this->load->model('model_ledger');
		
        $this->load->model('model_supplier');
        $this->load->model('model_role');
		$this->load->model('model_auth');

        $this->load->model('model_division');
        $this->load->model('model_store');
        $this->load->model('model_company');
        
	}

	public function fecthAllData()
	{
        // $ledger_type = $_POST['ledger_type'];
        // $data = $this->model_ledger->fetchLedgerDataByLedgertype($ledger_type);
	    $data = $this->model_ledger->fecthContactLedgerDataByType();
	    // echo "<pre>"; print_r($data); exit;

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

                if($value['ledgettype_id'] == 7)
                {
                    $buttons .= '&nbsp; <a href="'.base_url().'contact/updateSupplier/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>';
                    
                    $buttons .= '&nbsp; <a href="'.base_url().'contact/deleteSupplier/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>';
                }

                if($value['ledgettype_id'] == 6)
                {
                    $buttons .= '&nbsp; <a href="'.base_url().'contact/updateEmployee/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>';
                    
                    $buttons .= '&nbsp; <a href="'.base_url().'contact/deleteEmployee/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>';
                }

                if($value['ledgettype_id'] == 5)
                {
                    $buttons .= '&nbsp; <a href="'.base_url().'contact/updateCustomer/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>';
                    
                    $buttons .= '&nbsp; <a href="'.base_url().'contact/deleteCustomer/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>';
                }

                $result['data'][$key] = array(
                                                
                                                $no,
                                                $value['ledger_name'],
                                                $value['city'],
                                                $value['mobile'].", ".$value['phone'],
                                                $value['gst'],
                                                $value['email'],
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
		$this->render_template('admin_view/crm/contactDetails/index', $this->data);
	}


    // ####################################
    // ##           SUPPLIER           #### 
    // ####################################
	 
	public function createSupplier()
	{
	    $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|is_unique[wo_ledger.mobile]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|is_unique[wo_ledger.phone]');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|is_unique[wo_ledger.email]');
        $this->form_validation->set_rules('pan', 'PAN Number', 'trim|is_unique[wo_ledger.pan]');
        $this->form_validation->set_rules('gst', 'GST Number', 'trim|is_unique[wo_ledger.gst]');
        
        // $this->form_validation->set_rules('ledger_name', 'Ledger Name', 'trim|required|is_unique[wo_ledger.ledger_name]');


	    if ($this->form_validation->run() == TRUE) {

            // get unique name from company wise
            $this->load->helper('user_data_helper');

            $name = '';
            $error = '';

            if(!empty($this->input->post('ledger_name'))){

                $name = checkLedgerNameIsUnique('ledger_name' , $this->input->post('ledger_name'));

                if($name){
                    $error = ucwords($this->input->post('name'))." Ledger Available in Store or Company Ledger Account";
                }
            }

            if(!empty($this->input->post('mobile'))){

                $name = checkLedgerNameIsUnique('mobile' , $this->input->post('mobile'));

                if($name){
                    $error = " Mobile Number Available in Store or Company";
                }
            }

            if(!empty($this->input->post('phone'))){

                $name = checkLedgerNameIsUnique('phone' , $this->input->post('phone'));

                if($name){
                    $error = " Phone Number Available in Store or Company";
                }
            } 

            if(!empty($this->input->post('email'))){

                $name = checkLedgerNameIsUnique('email' , $this->input->post('email'));

                if($name){
                    $error = " Email ID Available in Store or Company";
                }
            } 

            if(!empty($this->input->post('pan'))){

                $name = checkLedgerNameIsUnique('pan' , $this->input->post('pan'));

                if($name){
                    $error = " PAN Number Available in Store or Company";
                }
            }

            if(!empty($this->input->post('gst'))){

                $name = checkLedgerNameIsUnique('gst' , $this->input->post('gst'));

                if($name){
                    $error = " GST Number Available in Store or Company";
                }
            }

            // echo "<pre>"; print_r($error); exit();

            if(!empty($error))
            {
                $this->data['errors'] = $error;
                
                $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
            
                $this->render_template('admin_view/crm/contactDetails/createSupplier', $this->data);
            }
            else
            {

                if(isset($_POST['createLedger']) == 'yes')
                {
                    $ledger = 'yes';
                }
                else
                {
                    $ledger = 'no';
                }
                // echo $ledger;
                // echo "<pre>"; print_r($_POST); exit;
                $ledgerData = array(
                                        'ledger_name' => $this->input->post('ledger_name'),
                                        'acate_id' => $this->input->post('category'),
                                        'asubcate_id' => $this->input->post('sub_category'),
                                        'opening_balance' => $this->input->post('openingBalance'),
                                        'closing_balance' => $this->input->post('openingBalance'),
                                        'crdr' => $this->input->post('drCr'),
                                        'entry_date' => $this->input->post('entryDate'),
                                        'wallete_balance' => $this->input->post('walleteBalance'),
                                        'address_1' => $this->input->post('address_one'),
        				                'address_2' => $this->input->post('address_two'),
        				                'country' => $this->input->post('country'),
                        				'state' => $this->input->post('state'),
                        				'city' => $this->input->post('city'),
                        				'mobile' => $this->input->post('mobile'),
                        				'phone' => $this->input->post('phone'),
                        				'email' => $this->input->post('email'),
                        				'pan' => $this->input->post('pan'),
                        				'gst' => $this->input->post('gst'),
                                        'social_id' => $this->input->post('social'),
                        				
                                        'create_ledger' => $ledger,
                                        'create_bank' => $this->input->post('createBank'),
                                        'accountno' => $this->input->post('acnumber'),
                                        'bankaddress' => $this->input->post('bank_address'),
                                        'ifsccode' => $this->input->post('ifsccode'),
                                        'swiftcode' => $this->input->post('swift'),

                                        'ledgettype_id' => 7,
                                        'company_id' => $this->session->userdata('wo_company'),
                        				// 'city_id' => $this->session->userdata('wo_city'),
                        				'store_id' => $this->session->userdata('wo_store'),
                        				'created_by' => $this->session->userdata('wo_id')
                                    );
                // echo "<pre>"; print_r($ledgerData); exit();
                $created_id = $this->model_ledger->createLedger($ledgerData);
                // $created_id = 1;

                if($created_id)
                {
                	$data = array(
                                    'ledger_id' => $created_id,
                                    'createLedger' => $this->input->post('createLedger'),
                                    'title' => $this->input->post('title'),
                    				'fname' => $this->input->post('fname'), 
                    				'mname' => $this->input->post('mname'),
                    				'lname' => $this->input->post('lname'),
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
        			
                    // echo "<pre>"; print_r($data);
        			$create = $this->model_supplier->create($data);
                    // exit();

        			if($create)
        			{
        			    $this->session->set_flashdata('feedback','Date Saved Successfully');
        				$this->session->set_flashdata('feedback_class','alert alert-success');
        				return redirect('contact');
        			}
        			else
        			{
        			    $this->model_ledger->delete($create_id);
        			    
        			    $this->session->set_flashdata('feedback','Unable to Saved Data');
            			$this->session->set_flashdata('feedback_class','alert alert-danger');
            			return redirect('contact/createSupplier');
        			}
                }
                else
                {
                    $this->session->set_flashdata('feedback','Unable to Saved Data');
    				$this->session->set_flashdata('feedback_class','alert alert-danger');
    				return redirect('contact/createSupplier');
                }
            }
        }
        else
        {
            $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
            
    		$this->render_template('admin_view/crm/contactDetails/createSupplier', $this->data);
        }
	}
	
	public function updateSupplier()
	{
	    $this->form_validation->set_rules('fname', 'First Name', 'trim|required');

	    if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST);
            // exit;

        	$data = array(
                    	    'id' => $this->input->post('id'),
                    	    'ledger_id' => $this->input->post('ledger_id'),
                            'createLedger' => $this->input->post('createLedger'),
                            'title' => $this->input->post('title'),
            				'fname' => $this->input->post('fname'),
            				'mname' => $this->input->post('mname'),
            				'lname' => $this->input->post('lname'),
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
            				'modified_by' => $this->session->userdata('wo_id')
            			);
			
			$create = $this->model_supplier->update($data);
            
            if($create == true) {
        		
                $ledgerData = array(
                                    'id' => $this->input->post('ledger_id'),
                                    'ledger_name' => $this->input->post('ledger_name'),
                                    'acate_id' => $this->input->post('category'),
                                    'asubcate_id' => $this->input->post('sub_category'),
                                    'opening_balance' => $this->input->post('openingBalance'),
                                    'closing_balance' => $this->input->post('openingBalance'),
                                    'crdr' => $this->input->post('drCr'),
                                    'entry_date' => $this->input->post('entryDate'),
                                    'wallete_balance' => $this->input->post('walleteBalance'),
                                    'address_1' => $this->input->post('address_one'),
                                    'address_2' => $this->input->post('address_two'),
                                    'country' => $this->input->post('country'),
                                    'state' => $this->input->post('state'),
                                    'city' => $this->input->post('city'),
                                    'mobile' => $this->input->post('mobile'),
                                    'phone' => $this->input->post('phone'),
                                    'email' => $this->input->post('email'),
                                    'pan' => $this->input->post('pan'),
                                    'gst' => $this->input->post('gst'),
                                    'social_id' => $this->input->post('social'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'modified_by' => $this->session->userdata('wo_id')
                                );

        		$this->model_ledger->update($ledgerData);
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('contact');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('contact/updateSupplier'.$this->input->post('id'));
        	}
        }
        else
        {
             $id = $this->uri->segment(3);
        	 // echo $id; exit;

        	 $this->data['allData'] = $this->model_supplier->getDataByLedgerID($id);
        	 
        	 $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
        	 $this->data['accountSCat'] = $this->model_accountcat->fecthAllSubCatData();
        	 
    		$this->render_template('admin_view/crm/contactDetails/updateSupplier', $this->data);
        
        }
	}
	
	public function deleteSupplier()
	{
	    $id = $this->uri->segment(3);
	
	    $delete = $this->model_ledger->delete($id);

		if($delete == true) {
            
            $this->model_supplier->deleteByLedgerID($id);
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('contact');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('contact');
    	}
	}

    // ####################################
    // ##           CUSTOMER           #### 
    // ####################################

    public function createCustomer()
    {
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        // $this->form_validation->set_rules('ledger_name', 'Ledger Name', 'trim|required|is_unique[wo_ledger.ledger_name]');


        if ($this->form_validation->run() == TRUE) {

                        // get unique name from company wise
            $this->load->helper('user_data_helper');

            $name = '';
            $error = '';

            if(!empty($this->input->post('ledger_name'))){

                $name = checkLedgerNameIsUnique('ledger_name' , $this->input->post('ledger_name'));

                if($name){
                    $error = ucwords($this->input->post('name'))." Ledger Available in Store or Company Ledger Account";
                }
            }

            if(!empty($this->input->post('mobile'))){

                $name = checkLedgerNameIsUnique('mobile' , $this->input->post('mobile'));

                if($name){
                    $error = " Mobile Number Available in Store or Company";
                }
            }

            if(!empty($this->input->post('phone'))){

                $name = checkLedgerNameIsUnique('phone' , $this->input->post('phone'));

                if($name){
                    $error = " Phone Number Available in Store or Company";
                }
            } 

            if(!empty($this->input->post('email'))){

                $name = checkLedgerNameIsUnique('email' , $this->input->post('email'));

                if($name){
                    $error = " Email ID Available in Store or Company";
                }
            } 

            if(!empty($this->input->post('pan'))){

                $name = checkLedgerNameIsUnique('pan' , $this->input->post('pan'));

                if($name){
                    $error = " PAN Number Available in Store or Company";
                }
            }

            if(!empty($this->input->post('gst'))){

                $name = checkLedgerNameIsUnique('gst' , $this->input->post('gst'));

                if($name){
                    $error = " GST Number Available in Store or Company";
                }
            }

            // echo "<pre>"; print_r($error); exit();

            if(!empty($error))
            {
                $this->data['errors'] = $error;
                
                $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
                $this->data['role'] = $this->model_role->fecthAllOverData();
                
                $this->render_template('admin_view/crm/contactDetails/createCustomer', $this->data);
            }
            else
            {
                // echo "<pre>"; print_r($_POST); //exit;
                if(isset($_POST['createLedger']) == 'yes')
                {
                    $ledger = 'yes';
                }
                else
                {
                    $ledger = 'no';
                }

                $ledgerData = array(
                                        'ledger_name' => $this->input->post('ledger_name'),
                                        'acate_id' => $this->input->post('category'),
                                        'asubcate_id' => $this->input->post('sub_category'),
                                        'opening_balance' => $this->input->post('openingBalance'),
                                        'closing_balance' => $this->input->post('openingBalance'),
                                        'crdr' => $this->input->post('drCr'),
                                        'entry_date' => $this->input->post('entryDate'),
                                        'wallete_balance' => $this->input->post('walleteBalance'),
                                        'address_1' => $this->input->post('address_one'),
                                        'address_2' => $this->input->post('address_two'),
                                        'country' => $this->input->post('country'),
                                        'state' => $this->input->post('state'),
                                        'city' => $this->input->post('city'),
                                        'mobile' => $this->input->post('mobile'),
                                        'phone' => $this->input->post('phone'),
                                        'email' => $this->input->post('email'),
                                        'pan' => $this->input->post('pan'),
                                        'gst' => $this->input->post('gst'),
                                        'social_id' => $this->input->post('social'),
                                        'ledgettype_id' => 5,
                                        'create_ledger' => $ledger,

                                        'login' => $this->input->post('createLogin'),
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                // echo "<pre>"; print_r($ledgerData); //exit();
                $created_id = $this->model_ledger->createLedger($ledgerData);
                // $created_id = 1;

                if($created_id)
                {
                    $data = array(
                                    'ledger_id' => $created_id,
                                    'createLedger' => $this->input->post('createLedger'),
                                    'title' => $this->input->post('title'),
                                    'fname' => $this->input->post('fname'),
                                    'mname' => $this->input->post('mname'),
                                    'lname' => $this->input->post('lname'),
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

                    $create = $this->model_supplier->create($data);

                    $loginData = array(
                                            'role_id' => $this->input->post('role'),
                                            'ledger_id' => $created_id,
                                            'username' => $this->input->post('username'),
                                            'password' => md5($this->input->post('password')),
                                            'email' => $this->input->post('email'),
                                            'fname' => $this->input->post('fname'),
                                            'mname' => $this->input->post('mname'),
                                            'lname' => $this->input->post('lname'),
                                            'phone' => $this->input->post('phone'),
                                            'active' => $this->input->post('activeStatus'),
                                            'mode' => 4,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            'created_by' => $this->session->userdata('wo_id')
                                    );
                    
                    if($create)
                    {
                        if(isset($_POST['createLogin']) == 'yes')
                        {
                            // $ledger = 'yes';
                            $this->model_auth->create($loginData);

                        }

                        $this->session->set_flashdata('feedback','Date Saved Successfully');
                        $this->session->set_flashdata('feedback_class','alert alert-success');
                        return redirect('contact');
                    }
                    else
                    {
                        $this->model_ledger->delete($create_id);
                        
                        $this->session->set_flashdata('feedback','Unable to Saved Data');
                        $this->session->set_flashdata('feedback_class','alert alert-danger');
                        return redirect('contact/createCustomer');
                    }
                }
                else
                {
                    $this->session->set_flashdata('feedback','Unable to Saved Data');
                    $this->session->set_flashdata('feedback_class','alert alert-danger');
                    return redirect('contact/createCustomer');
                }
            }
        }
        else
        {
            $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
            $this->data['role'] = $this->model_role->fecthAllOverData();
            
            $this->render_template('admin_view/crm/contactDetails/createCustomer', $this->data);
        }
    }


    public function updateCustomer()
    {
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); //exit;
            $data = array(
                'id' => $this->input->post('id'),
                'ledger_id' => $this->input->post('ledger_id'),
                'createLedger' => $this->input->post('createLedger'),
                'title' => $this->input->post('title'),
                'fname' => $this->input->post('fname'),
                'mname' => $this->input->post('mname'),
                'lname' => $this->input->post('lname'),
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
                'modified_by' => $this->session->userdata('wo_id')
            );
            // echo "<pre>"; print_r($data); //exit();
            $create = $this->model_supplier->update($data);
            
            if($create == true) {
                
                $ledgerData = array(
                                    'id' => $this->input->post('ledger_id'),
                                    'ledger_name' => $this->input->post('ledger_name'),
                                    'acate_id' => $this->input->post('category'),
                                    'asubcate_id' => $this->input->post('sub_category'),
                                    'opening_balance' => $this->input->post('openingBalance'),
                                    'crdr' => $this->input->post('drCr'),
                                    'entry_date' => $this->input->post('entryDate'),
                                    'wallete_balance' => $this->input->post('walleteBalance'),
                                    'address_1' => $this->input->post('address_one'),
                                    'address_2' => $this->input->post('address_two'),
                                    'country' => $this->input->post('country'),
                                    'state' => $this->input->post('state'),
                                    'city' => $this->input->post('city'),
                                    'mobile' => $this->input->post('mobile'),
                                    'phone' => $this->input->post('phone'),
                                    'email' => $this->input->post('email'),
                                    'pan' => $this->input->post('pan'),
                                    'gst' => $this->input->post('gst'),
                                    'social_id' => $this->input->post('social'),
                                    'login' => $this->input->post('createLogin'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'modified_by' => $this->session->userdata('wo_id')
                                );
                // echo "<pre>"; print_r($ledgerData); //exit();
                $this->model_ledger->update($ledgerData);
                
                if(empty($this->input->post('password')))
                {
                    $loginData = array(
                                'id' => $this->input->post('loginid'),
                                'role_id' => $this->input->post('role'),
                                'active' => $this->input->post('activeStatus'),
                            );    
                }
                else
                {
                    $loginData = array(
                                'id' => $this->input->post('loginid'),
                                'role_id' => $this->input->post('role'),
                                'password' => md5($this->input->post('password')),
                                'active' => $this->input->post('activeStatus'),
                            );
                }
                // echo "<pre>"; print_r($loginData); exit();
                $this->model_auth->update($loginData);

                $this->session->set_flashdata('feedback','Data Saved Successfully');
                $this->session->set_flashdata('feedback_class','alert alert-success');
                return redirect('contact');
            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                return redirect('contact/updateCustomer'.$this->input->post('id'));
            }
        }
        else
        {
             $id = $this->uri->segment(3);
             // echo $id; exit;
             $this->data['allData'] = $this->model_supplier->getDataByLedgerID($id);
             $this->data['loginData'] = $this->model_auth->getDataByLedgerID($id);
             
             $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
             $this->data['accountSCat'] = $this->model_accountcat->fecthAllSubCatData();
             $this->data['role'] = $this->model_role->fecthAllOverData();
             
            $this->render_template('admin_view/crm/contactDetails/updateCustomer', $this->data);
        }
    }

    public function deleteCustomer()
    {
        $id = $this->uri->segment(3);
    
        $delete = $this->model_ledger->delete($id);

        if($delete == true) {
            
            $this->model_supplier->deleteByLedgerID($id);
            $this->model_auth->deleteByLedgerID($id);
            
            $this->session->set_flashdata('feedback','Record Deleted Successfully');
            $this->session->set_flashdata('feedback_class','alert alert-success');
            return redirect('contact');
        }
        else{

            $this->session->set_flashdata('feedback','Unable to Delete Record');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            return redirect('contact');
        }
    }

    // ####################################
    // ##           EMPLOYEE           #### 
    // ####################################

    public function createEmployee()
    {
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        // $this->form_validation->set_rules('ledger_name', 'Ledger Name', 'trim|required|is_unique[wo_ledger.ledger_name]');
        

        if ($this->form_validation->run() == TRUE) {

            // get unique name from company wise
            $this->load->helper('user_data_helper');

            $name = '';
            $error = '';

            if(!empty($this->input->post('ledger_name'))){

                $name = checkLedgerNameIsUnique('ledger_name' , $this->input->post('ledger_name'));

                if($name){
                    $error = ucwords($this->input->post('name'))." Ledger Available in Store or Company Ledger Account";
                }
            }

            if(!empty($this->input->post('mobile'))){

                $name = checkLedgerNameIsUnique('mobile' , $this->input->post('mobile'));

                if($name){
                    $error = " Mobile Number Available in Store or Company";
                }
            }

            if(!empty($this->input->post('phone'))){

                $name = checkLedgerNameIsUnique('phone' , $this->input->post('phone'));

                if($name){
                    $error = " Phone Number Available in Store or Company";
                }
            } 

            if(!empty($this->input->post('email'))){

                $name = checkLedgerNameIsUnique('email' , $this->input->post('email'));

                if($name){
                    $error = " Email ID Available in Store or Company";
                }
            } 

            if(!empty($this->input->post('pan'))){

                $name = checkLedgerNameIsUnique('pan' , $this->input->post('pan'));

                if($name){
                    $error = " PAN Number Available in Store or Company";
                }
            }

            if(!empty($this->input->post('gst'))){

                $name = checkLedgerNameIsUnique('gst' , $this->input->post('gst'));

                if($name){
                    $error = " GST Number Available in Store or Company";
                }
            }

            // echo "<pre>"; print_r($error); exit();

            if(!empty($error))
            {
                $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
                $this->data['role'] = $this->model_role->fecthAllOverData();
                $this->data['store'] = $this->model_store->fecthAllStores();
                $this->data['division'] = $this->model_division->fecthAllData();
                
                $this->render_template('admin_view/crm/contactDetails/createEmployee', $this->data);
            }
            else
            {
                if(isset($_POST['createLedger']) == 'yes')
                {
                    $ledger = 'yes';
                }
                else
                {
                    $ledger = 'no';
                }

                $ledgerData = array(
                                        'ledger_name' => $this->input->post('ledger_name'),
                                        'acate_id' => $this->input->post('category'),
                                        'asubcate_id' => $this->input->post('sub_category'),
                                        'opening_balance' => $this->input->post('openingBalance'),
                                        // 'closing_balance' => $this->input->post('openingBalance'),
                                        'crdr' => $this->input->post('drCr'),
                                        'entry_date' => $this->input->post('entryDate'),
                                        'wallete_balance' => $this->input->post('walleteBalance'),
                                        'address_1' => $this->input->post('address_one'),
                                        'address_2' => $this->input->post('address_two'),
                                        'country' => $this->input->post('country'),
                                        'state' => $this->input->post('state'),
                                        'city' => $this->input->post('city'),
                                        'mobile' => $this->input->post('mobile'),
                                        'phone' => $this->input->post('phone'),
                                        'email' => $this->input->post('email'),
                                        'aadhar' => $this->input->post('aadhar'),
                                        'idtype' => $this->input->post('other_type'),
                                        'idno' => $this->input->post('id_no'),
                                        'pan' => $this->input->post('pan'),
                                        // 'gst' => $this->input->post('gst'),
                                        'ledgettype_id' => 6,
                                        'social_id' => $this->input->post('social'),

                                        'create_ledger' => $ledger,
                                        'create_bank' => $this->input->post('createBank'),
                                        'accountno' => $this->input->post('acnumber'),
                                        'bankaddress' => $this->input->post('bank_address'),
                                        'ifsccode' => $this->input->post('ifsccode'),
                                        'swiftcode' => $this->input->post('swift'),
                                        
                                        'designation' => $this->input->post('designation'),
                                        'division_id' => $this->input->post('division'),
                                        'salary' => $this->input->post('salary'),
                                        'wages' => $this->input->post('wages'),
                                        'annualpackage' => $this->input->post('annualpackage'),
                                        'login' => $this->input->post('createLogin'),
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                // echo "<pre>"; print_r($ledgerData); //exit();
                $created_id = $this->model_ledger->createLedger($ledgerData);
                // $created_id = 1;

                if($created_id)
                {
                    $data = array(
                                    'ledger_id' => $created_id,
                                    'createLedger' => $this->input->post('createLedger'),
                                    'title' => $this->input->post('title'),
                                    'fname' => $this->input->post('fname'),
                                    'mname' => $this->input->post('mname'),
                                    'lname' => $this->input->post('lname'),
                                    'address1' => $this->input->post('address_one'),
                                    'address2' => $this->input->post('address_two'),
                                    'country' => $this->input->post('country'),
                                    'state' => $this->input->post('state'),
                                    'city' => $this->input->post('city'),
                                    'mobile' => $this->input->post('mobile'),
                                    'phone' => $this->input->post('phone'),
                                    'email' => $this->input->post('email'),
                                    'pan' => $this->input->post('pan'),
                                    // 'gst' => $this->input->post('gst'),
                                    'social' => $this->input->post('social'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                    // echo "<pre>"; print_r($data); //exit();
                    $create = $this->model_supplier->create($data);

                    $loginData = array(
                                            'role_id' => $this->input->post('role'),
                                            'ledger_id' => $created_id,
                                            'username' => $this->input->post('username'),
                                            'password' => md5($this->input->post('password')),
                                            'email' => $this->input->post('email'),
                                            'fname' => $this->input->post('fname'),
                                            'mname' => $this->input->post('mname'),
                                            'lname' => $this->input->post('lname'),
                                            'phone' => $this->input->post('phone'),
                                            'active' => $this->input->post('activeStatus'),
                                            'mode' => 3,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            'store_id' => $this->input->post('store'),
                                            'division_id' => $this->input->post('division'),
                                            'created_by' => $this->session->userdata('wo_id')
                                    );
                    // echo "<pre>"; print_r($loginData); exit();
                    
                    if($create)
                    {

                        if(isset($_POST['createLogin']) == 'yes')
                        {
                            // $ledger = 'yes';
                            $this->model_auth->create($loginData);

                        }

                        $this->session->set_flashdata('feedback','Date Saved Successfully');
                        $this->session->set_flashdata('feedback_class','alert alert-success');
                        return redirect('contact');
                    }
                    else
                    {
                        $this->model_ledger->delete($create_id);
                        
                        $this->session->set_flashdata('feedback','Unable to Saved Data');
                        $this->session->set_flashdata('feedback_class','alert alert-danger');
                        return redirect('contact/createEmployee');
                    }
                }
                else
                {
                    $this->session->set_flashdata('feedback','Unable to Saved Data');
                    $this->session->set_flashdata('feedback_class','alert alert-danger');
                    return redirect('contact/createEmployee');
                }
            }
        }
        else
        {
            $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
            $this->data['role'] = $this->model_role->fecthAllOverData();
            $this->data['store'] = $this->model_store->fecthAllStores();
            $this->data['division'] = $this->model_division->fecthAllData();
            
            $this->render_template('admin_view/crm/contactDetails/createEmployee', $this->data);
        }
    }

    public function updateEmployee()
    {
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); //exit;
            $data = array(
                        'id' => $this->input->post('id'),
                        'ledger_id' => $this->input->post('ledger_id'),
                        'createLedger' => $this->input->post('createLedger'),
                        'title' => $this->input->post('title'),
                        'fname' => $this->input->post('fname'),
                        'mname' => $this->input->post('mname'),
                        'lname' => $this->input->post('lname'),
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
                        'modified_by' => $this->session->userdata('wo_id')
                    );
            // echo "<pre>"; print_r($data); //exit();
            $create = $this->model_supplier->update($data);
            // $create = true;
            if($create == true) {
                
                $ledgerData = array(
                                    'id' => $this->input->post('ledger_id'),
                                    'ledger_name' => $this->input->post('ledger_name'),
                                    'acate_id' => $this->input->post('category'),
                                    'asubcate_id' => $this->input->post('sub_category'),
                                    'opening_balance' => $this->input->post('openingBalance'),
                                    'crdr' => $this->input->post('drCr'),
                                    'entry_date' => $this->input->post('entryDate'),
                                    'wallete_balance' => $this->input->post('walleteBalance'),
                                    'address_1' => $this->input->post('address_one'),
                                    'address_2' => $this->input->post('address_two'),
                                    'country' => $this->input->post('country'),
                                    'state' => $this->input->post('state'),
                                    'city' => $this->input->post('city'),
                                    'mobile' => $this->input->post('mobile'),
                                    'phone' => $this->input->post('phone'),
                                    'email' => $this->input->post('email'),
                                    'aadhar' => $this->input->post('aadhar'),
                                    'idtype' => $this->input->post('other_type'),
                                    'idno' => $this->input->post('id_no'),
                                    'pan' => $this->input->post('pan'),
                                    // 'gst' => $this->input->post('gst'),
                                    'ledgettype_id' => 6,
                                    'social_id' => $this->input->post('social'),
                                    'designation' => $this->input->post('designation'),
                                    'division_id' => $this->input->post('division'),
                                    'salary' => $this->input->post('salary'),
                                    'wages' => $this->input->post('wages'),
                                    'annualpackage' => $this->input->post('annualpackage'),
                                    'login' => $this->input->post('createLogin'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'modified_by' => $this->session->userdata('wo_id')
                                );
                // echo "<pre>"; print_r($ledgerData); //exit();
                $this->model_ledger->update($ledgerData);
                
                if(empty($this->input->post('password')))
                {
                    $loginData = array(
                                'id' => $this->input->post('loginid'),
                                'role_id' => $this->input->post('role'),
                                'active' => $this->input->post('activeStatus'),
                                'division_id' => $this->input->post('division'),
                                'store_id' => $this->input->post('store'),
                            );    
                }
                else
                {
                    $loginData = array(
                                'id' => $this->input->post('loginid'),
                                'role_id' => $this->input->post('role'),
                                'password' => md5($this->input->post('password')),
                                'active' => $this->input->post('activeStatus'),
                                'division_id' => $this->input->post('division'),
                                'store_id' => $this->input->post('store'),
                            );
                }
                // echo "<pre>"; print_r($loginData); exit();
                $this->model_auth->update($loginData);

                $this->session->set_flashdata('feedback','Data Saved Successfully');
                $this->session->set_flashdata('feedback_class','alert alert-success');
                return redirect('contact');
            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                return redirect('contact/updateEmployee'.$this->input->post('id'));
            }
        }
        else
        {
             $id = $this->uri->segment(3);
             // echo $id; exit;
             $this->data['allData'] = $this->model_supplier->getDataByLedgerID($id);
             $this->data['ledgerData'] = $this->model_ledger->fecthDataByID($id);
             $this->data['loginData'] = $this->model_auth->getDataByLedgerID($id);
             
             $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
             $this->data['accountSCat'] = $this->model_accountcat->fecthAllSubCatData();
             $this->data['role'] = $this->model_role->fecthAllOverData();
             $this->data['store'] = $this->model_store->fecthAllStores();
             $this->data['division'] = $this->model_division->fecthAllData();
             
            $this->render_template('admin_view/crm/contactDetails/updateEmployee', $this->data);
        }
    }
	

}