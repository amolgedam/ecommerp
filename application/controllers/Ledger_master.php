<?php
include_once (dirname(__FILE__) . "/Auth.php");
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger_master extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Ledger Master';
		
		$this->load->model('model_accountcat');
        $this->load->model('model_ledgertype');
        $this->load->model('model_ledger');

        $this->load->model('model_users');

        $this->load->model('model_company');
        
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function index()
	{
	    $this->data['ledgertype'] = $this->model_ledgertype->fecthAllData();

		$this->render_template('admin_view/master/ledger/index', $this->data);
	}
	
	public function fecthLedgerDataByID()
	{
	    $id = $_POST['ledger_id'];
   	    // $id = 7;
	    $ledgerData = $this->model_ledger->fecthDataByID($id);
	   // echo "<pre>"; print_r($ledgerData);
	   echo json_encode($ledgerData);
	}
	
	public function fecthLedgerDataByLedgerType()
	{
	    $id = $_POST['ledgertypeid'];
   	    // $id = 7;
	    $ledgerData = $this->model_ledger->fetchLedgerDataByLedgertype($id);
	   // echo "<pre>"; print_r($ledgerData);
	   echo json_encode($ledgerData);
	}
	
	public function fetchLedgerDataByLedgertype()
	{
	   // $id = '1';
	    $id = $_POST['legertype'];
	   // $id = $this->uri->segment(3);
	    
	    $data = $this->model_ledger->fetchLedgerDataByLedgertype($id);
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
                $catData = $this->model_accountcat->fecthCatByID($value['acate_id']);
                $subcatData = $this->model_accountcat->fecthsubCatByID($value['acate_id']);
                
                // echo "<pre>"; print_r($subcatData);exit;
                
                // $buttons = '';
                
                $buttons .= '&nbsp; <a href="'.base_url().'ledger_master/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'/ledger_master/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                
                // $buttons .= '&nbsp; <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Report</a>';
                
                // $result['data'][$key] = array(
                $result[] = array(
                                                
                                                $no,
                                                $value['ledger_name'],
                                                $catData['acategories_name'],
                                                $subcatData['asubcat_name'],
                                                $buttons
                                            );
                $no++;
            }
        }
        // print_r($result);
        echo json_encode($result);
        exit;
	}
    
    public function fetchLedgerData()
    {
        // $buttons = '';
        
        $data = $this->model_ledger->fecthAllData();

        if(empty($data))
        {
            $result['data'] = '';
        }
        else
        {
        
            // echo "<pre>"; print_r($data);exit;
            $no=1;
            foreach($data as $key => $value)
            {
                $catData = $this->model_accountcat->fecthCatByID($value['acate_id']);
                $subcatData = $this->model_accountcat->fecthsubCatByID($value['asubcate_id']);
                $ledgerType = $this->model_ledgertype->fecthDataByID($value['ledgettype_id']);
                // echo "<pre>"; print_r($ledgerType);
                // echo "<pre>"; print_r($catData);
                // echo "<pre>"; print_r($subcatData);exit;
                
                $buttons = '';
                
                // if($catData['permission'] == 1)
                // {
                    $buttons .= '&nbsp; <a href="'.base_url().'ledger_master/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                // }
                
                $buttons .= '&nbsp; <a href="'.base_url().'ledger_master/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'reports/ledgerReport/'.$value['id'].'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Report</a>';
                
                
                $result['data'][$key] = array(
                                                
                                                $no,
                                                $value['ledger_name'],
                                                $catData['acategories_name'],
                                                $value['asubcate_id'] != '0' ? $subcatData['asubcat_name'] : '-' ,
                                                $ledgerType['ledgertype_name'],
                                                $buttons
                                            );
                                            
                $no++;
            }
        }
        // echo "<pre>"; print_r($result);
        echo json_encode($result);
        exit;
    }
    
	public function create()
	{
        // unique data app. wise
        $this->form_validation->set_rules('name', 'Account Name', 'trim|required');
     //    $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim');
     //    $this->form_validation->set_rules('phone', 'Phone Number', 'trim|is_unique[wo_ledger.phone]');
     //    $this->form_validation->set_rules('email', 'Email ID', 'trim|is_unique[wo_ledger.email]');
     //    $this->form_validation->set_rules('pan', 'PAN Number', 'trim|is_unique[wo_ledger.pan]');
	    // $this->form_validation->set_rules('gst', 'GST Number', 'trim|is_unique[wo_ledger.gst]');
	    
	    if ($this->form_validation->run() == TRUE) {

            // get unique name from company wise
            $this->load->helper('user_data_helper');

            $name = '';
            $error = '';

            if(!empty($this->input->post('name'))){

                $name = checkLedgerNameIsUnique('ledger_name' , $this->input->post('name'));

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



            if(!empty($error))
            {
                $this->data['errors'] = $error;
                $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
                $this->data['legerCat'] = $this->model_ledgertype->fecthAllData();
               // print_r($legerCat);exit;
            
                $this->render_template('admin_view/master/ledger/create', $this->data);
            }
            else
            {
                $username = random_string('alnum',8);
                $password = random_string('alnum',20);

                $data = array(
                                'ledger_name' => $this->input->post('name'),
                                'acate_id' => $this->input->post('category'),
                                'asubcate_id' => $this->input->post('sub_category'),
                                'opening_balance' => $this->input->post('opening_balance'),
                                'closing_balance' => $this->input->post('opening_balance'),
                                'entry_date' => $this->input->post('entry_date'),
                                'crdr' => $this->input->post('cr_dr'),
                                'wallete_balance' => $this->input->post('wallete'),
                                'address_1' => $this->input->post('address1'),
                                'address_2' => $this->input->post('address2'),
                                'country' => $this->input->post('country'),
                                'state' => $this->input->post('state'),
                                'city' => $this->input->post('city'),
                                'mobile' => $this->input->post('mobile'),
                                'phone' => $this->input->post('phone'),
                                'email' => $this->input->post('email'),
                                'pan' => $this->input->post('pan'),
                                'gst' => $this->input->post('gst'),
                                'ledgettype_id' => $this->input->post('ledger'),
                                'social_id' => $this->input->post('social_id'),
                                'create_bank' => $this->input->post('create_bank'),
                                'accountno' => $this->input->post('accountno'),
                                'bankaddress' => $this->input->post('bankaddress'),
                                'ifsccode' => $this->input->post('ifsc'),
                                'swiftcode' => $this->input->post('swift'),
                                'login' => $this->input->post('login'),
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id'),
                            );
            // echo "<pre>"; print_r($data);exit();
            // $create = 1;
            $created_id = $this->model_ledger->createLedger($data);

            // echo "<pre>"; print_r($loginData); exit();

            if($created_id) {

                if($this->input->post('login') == 'yes')
                {
                    $loginData = array(
                                        'role_id' => 4,
                                        'ledger_id' => $created_id,
                                        'username' => $username,
                                        'password' => md5($password),
                                        'email' => $this->input->post('email'),
                                        'fname' => $this->input->post('name'),
                                        'phone' => $this->input->post('mobile'),
                                        'active' => 1,
                                        'mode' => 3,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'created_by' => $this->session->userdata('wo_id'),
                                    );

                    $this->model_users->create($loginData);
                }
                                        
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    return redirect('ledger_master');
                }
                else {
                                            
                    $this->session->set_flashdata('feedback','Unable to Saved Data');
                    $this->session->set_flashdata('feedback_class','alert alert-danger');
                    return redirect('ledger_master');
                }
    
            }
	   }
	   else
	   { 
	        $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
	        $this->data['legerCat'] = $this->model_ledgertype->fecthAllData();
	       // print_r($legerCat);exit;
	    
		    $this->render_template('admin_view/master/ledger/create', $this->data);   
	   }

	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('name', 'Account Name', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
        
            $data = array(
        		
        		'ledger_name' => $this->input->post('name'),
        		'acate_id' => $this->input->post('category'),
        		'asubcate_id' => $this->input->post('sub_category'),
        		'opening_balance' => $this->input->post('opening_balance'),
        		
        		'closing_balance' => $this->input->post('closing_balance'),
        		
        		'entry_date' => $this->input->post('entry_date'),
        		'crdr' => $this->input->post('cr_dr'),
        		'wallete_balance' => $this->input->post('wallete'),
        		'address_1' => $this->input->post('address1'),
        		'address_2' => $this->input->post('address2'),
        		'country' => $this->input->post('country'),
        		'state' => $this->input->post('state'),
        		'city' => $this->input->post('city'),
        		'mobile' => $this->input->post('mobile'),
        		'phone' => $this->input->post('phone'),
        		'email' => $this->input->post('email'),
        		'pan' => $this->input->post('pan'),
        		'gst' => $this->input->post('gst'),
        		'ledgettype_id' => $this->input->post('ledger'),
        		'social_id' => $this->input->post('social_id'),
        		'create_bank' => $this->input->post('create_bank'),

                'accountno' => $this->input->post('accountno'),
                'bankaddress' => $this->input->post('bankaddress'),
                'ifsccode' => $this->input->post('ifsc'),
                'swiftcode' => $this->input->post('swift'),
                'login' => $this->input->post('login'),

        		'company_id' => $this->session->userdata('wo_company'),
				// 'city_id' => $this->session->userdata('wo_city'),
				'store_id' => $this->session->userdata('wo_store'),
				'modified_by' => $this->session->userdata('wo_id'),
        	);
        	
        	// echo "<pre>"; print_r($data); exit();
        	$create = $this->model_ledger->update($data);

        	if($create == true) {
        		
        		$this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				return redirect('ledger_master');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('ledger_master');
        	}
	   }
	   else
	   {
    	    $this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
    	    $this->data['accountSubcat'] = $this->model_accountcat->fecthAllSubCatData();
    	    $this->data['legerCat'] = $this->model_ledgertype->fecthAllData();
    	    
    	    $this->data['data'] = $this->model_ledger->fecthAllDatabyID($id);
    	        
    		$this->render_template('admin_view/master/ledger/update', $this->data);
	   }
	}
	
	public function delete()
	{
		$id = $this->uri->segment(3);
		$delete = $this->model_ledger->delete($id);	

		if($delete == true) {

            $this->model_users->deleteByLedgerId($id);

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('ledger_master');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('ledger_master');
    	}
	}
}
