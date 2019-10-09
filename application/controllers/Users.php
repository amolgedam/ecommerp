<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Users';

		$this->load->model('model_users');
		$this->load->model('model_role');
        $this->load->model('model_company');
        
	}

	public function index()
	{
// 		if(!in_array('viewUser', $this->permission)){
//             redirect('dashboard', 'refresh');
//         }
        $this->data['allData'] = $this->model_users->fecthAllDataforSuperadmin();
        
		$this->render_template('admin_view/settings/userManagement/manageUser/index', $this->data);
	}

	public function create()
	{
// 		if(!in_array('createUser', $this->permission)){
//             redirect('dashboard', 'refresh');
//         }

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|is_unique[wo_users.username]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[wo_users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required');
		

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $password = md5($this->input->post('password'));
            $mode='';
            if($this->input->post('role') == 2)
            {
                $mode = 2;
            }
            else
            {
                $mode = 3;
            }
            
            $status='';
            if($this->input->post('status') != 'active')
            {
                $status = '0';
            }
            else
            {
                $status = '1';
            }
            
        	$data = array(
        	    
        		'role_id' => $this->input->post('role'),
        		'username' => $this->input->post('username'),
        		'password' => $password,
        		'email' => $this->input->post('email'),
        		'fname' => $this->input->post('fname'),
        		'lname' => $this->input->post('lname'),
        		'phone' => $this->input->post('phone'),
        		'gender' => $this->input->post('gender'),
        		'active' => $status,
        		'mode' => $mode,
        		'company_id' => $this->session->userdata('wo_company'),
        		// 'city_id' => $this->session->userdata('wo_city'),
				'store_id' => $this->session->userdata('wo_store'),
				'created_by' => $this->session->userdata('wo_id')
        	);
        	
        // 	print_r($data); exit;

        	$create = $this->model_users->create($data);
        	
        	if($create == true) {
        	    
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('users');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('users/create');
        	}
        }
        else {
            // false case
        
            $this->data['roleData'] = $this->model_role->fecthAllData();
        
            // $this->render_template('users/create', $this->data);
            $this->render_template('admin_view/settings/userManagement/manageUser/create', $this->data);
        }	
	}

	public function edit()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->data['userData'] = $this->model_users->fecthUserData($id);
	    
	    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required');
	    
		if($this->form_validation->run() == TRUE)
		{
			if(!empty($_POST['password']))
			{
			    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
		        
		        if($this->form_validation->run() == TRUE)
		        {
		            $password = md5($this->input->post('password'));
		            
		            $data = array(
        	    
                		'id' => $this->input->post('id'),
                		'role_id' => $this->input->post('role'),
                		'username' => $this->input->post('username'),
                		'password' => $password,
                		'email' => $this->input->post('email'),
                		'fname' => $this->input->post('fname'),
                		'lname' => $this->input->post('lname'),
                		'phone' => $this->input->post('phone'),
                		'gender' => $this->input->post('gender'),
                		'active' => $this->input->post('status'),
                		'company_id' => $this->session->userdata('wo_company'),
            //     		'city_id' => $this->session->userdata('wo_city'),
        				'store_id' => $this->session->userdata('wo_store'),
        				'modified_by' => $this->session->userdata('wo_id')
                	);
                	
                // 	print_r($data); exit;
        
                	$create = $this->model_users->update($data);
                	
                	if($create == true) {
                	    
                		$this->session->set_flashdata('success', 'Successfully created');
                		redirect('users');
                	}
                	else {
                		$this->session->set_flashdata('errors', 'Error occurred!!');
                		redirect('users/create');
                	}
		        }
		        else
        	    {
        	        $this->data['roleData'] = $this->model_role->fecthAllData();
        	        
        			$this->render_template('admin_view/settings/userManagement/manageUser/edit', $this->data);
        		}
			}
			else
			{
			    $data = array(
        	    
            		'id' => $this->input->post('id'),
            		'role_id' => $this->input->post('role'),
            		'username' => $this->input->post('username'),
            		'email' => $this->input->post('email'),
            		'fname' => $this->input->post('fname'),
            		'lname' => $this->input->post('lname'),
            		'phone' => $this->input->post('phone'),
            		'gender' => $this->input->post('gender'),
            		'active' => $this->input->post('status'),
            		'company_id' => $this->session->userdata('wo_company'),
                //  'city_id' => $this->session->userdata('wo_city'),
        			'store_id' => $this->session->userdata('wo_store'),
        			'modified_by' => $this->session->userdata('wo_id')
            	);
            	
            // 	print_r($data); exit;
    
            	$create = $this->model_users->update($data);
            	
            	if($create == true) {
            	    
            		$this->session->set_flashdata('success', 'Successfully created');
            		redirect('users');
            	}
            	else {
            		$this->session->set_flashdata('errors', 'Error occurred!!');
            		redirect('users/create');
            	}
			}
	    }
	    else
	    {
	        $this->data['roleData'] = $this->model_role->fecthAllData();
	        
			$this->render_template('admin_view/settings/userManagement/manageUser/edit', $this->data);
		}	
	}
	
	public function delete()
	{
		$id = $this->input->post('id_edit');
		$delete = $this->model_users->delete($id);	

		if($delete == true) {

    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('users');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('users');
    	}
	}
	
}