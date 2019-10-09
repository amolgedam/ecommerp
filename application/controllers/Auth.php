<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
		
		$this->data['page_title'] = 'Auth';
		
	    $this->load->model('model_auth');
	    $this->load->model('model_users');
      $this->load->model('model_company');
      
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{
	    $this->logged_in();
	    
	    $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == TRUE) {

            
            $username_exists = $this->model_auth->check_username($this->input->post('username'));
            
            if($username_exists == TRUE) {
       	        
       	        // echo "Username exit";
       	        
          		$login = $this->model_auth->login($this->input->post('username'), $this->input->post('password'));
           	  // echo "<pre>"; print_r($login); exit();
              // $company = array();
              // $company = implode(", ", $login['company_id']);
              // print_r($login['company_id']); exit();
              

          		if($login) {
                    
                    if($login['active'] != 1)
                    {
                      $this->data['errors'] = 'Account Not Active';
          			      $this->load->view('admin_view/login', $this->data);
                    }
                    else
                    {
                        if($login['role_name'] == 'admin')
                        {
                          // Admin
                            $logged_in_sess = array(
                                          				'wo_id' => $login['id'],
                                    			        'wo_username'  => $login['username'],
                                    			        'wo_active' => $login['active'],
                                    			        'wo_email' => $login['email'],
                                    			        'wo_role' => $login['role_name'],
                                                        'wo_role_id' => $login['role_id'],
                                    			        'wo_company' => $login['company_id'],
                                    			        'wo_mode' => $login['mode'],
                                    			        'wo_store' => $login['store_id'],
                                    			        'wo_logged_in' => TRUE
                                        			);
                			
                			       $this->session->set_userdata($logged_in_sess);
                				   	  // print_r($_SESSION); exit();
                      		    redirect('mdi_form', 'refresh');
                        }
                        else if($login['role_name'] == 'System1')
                        {
                            // Superadmin
                            $logged_in_sess = array(
              			    
                                          			    'wo_id' => $login['id'],
                                                        'wo_username'  => $login['username'],
                                                        'wo_active' => $login['active'],
                                                        'wo_email' => $login['email'],
                                                        'wo_role' => $login['role_name'],
                                                        'wo_role_id' => $login['role_id'],
                                                        'wo_company' => $login['company_id'],
                                                        'wo_mode' => $login['mode'],
                                                        'wo_store' => $login['store_id'],
                                                        'wo_logged_in' => TRUE
                                      				  );
            			
            			   	$this->session->set_userdata($logged_in_sess);
            					    // print_r($_SESSION); exit();
                  			redirect('dashboard', 'refresh');
                        }
                        else if($login['role_name'] == 'user')
                        {
                            
                            // users / employee
                            $logged_in_sess = array(
                  			    
                                          				'wo_id' => $login['id'],
                                                        'wo_username'  => $login['username'],
                                                        'wo_active' => $login['active'],
                                                        'wo_email' => $login['email'],
                                                        'wo_role' => $login['role_name'],
                                                        'wo_role_id' => $login['role_id'],
                                                        'wo_company' => $login['company_id'],
                                                        'wo_mode' => $login['mode'],
                                                        'wo_store' => $login['store_id'],
                                                        'wo_logged_in' => TRUE
                                				    );
                                			 
                  				$this->session->set_userdata($logged_in_sess);
                  				  //	print_r($_SESSION); exit();
                    			redirect('dashboard', 'refresh');
                        }
                        
                    }
          		}
          		else {
          			$this->data['errors'] = 'Incorrect username/password combination';
          			$this->load->view('admin_view/login', $this->data);
          		}
           	}
           	else
           	{
           		$this->data['errors'] = 'Username does not exists';
    
           		$this->load->view('admin_view/login', $this->data);
           	}	
        }
        else
        {
            $this->load->view('admin_view/login');
        }
	}

	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		unset($_SESSION);
		redirect('auth/login');
	}
	
	public function changepassword()
    {
        // echo "change password"; exit;
        $this->form_validation->set_rules('old', 'Old Password', 'trim|required');
        $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[newpassword]');

        if ($this->form_validation->run() == TRUE) {
            
            $pass = md5($_POST['old']);
            // echo $pass; //exit;
            
            $data =  $this->model_users->fecthUserDataByIDPass($_SESSION['wo_id'], $pass);
            // echo "<pre>"; print_r($data);
            
            if(!empty($data))
            {
                $oldpass = md5($_POST['newpassword']);
                
                $data = array(
                                'id' => $_SESSION['wo_id'],
                                'password' => $oldpass
                            );
                            
                $update = $this->model_users->update($data);
                
                if($update)
                {
                    $this->session->set_flashdata('feedback','Password Change Successfully');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    				
    				return redirect('auth/changepassword');
                }
                else
                {
                    $this->session->set_flashdata('feedback','Unable to Change Password!');
    				$this->session->set_flashdata('feedback_class','alert alert-danger');
    				
    				return redirect('auth/changepassword');
                }
            }
            else
            {
                $this->session->set_flashdata('feedback','Old Password Not Match!');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('auth/changepassword');
            }
            
        }
        else
        {
            //  $this->data['brand'] = $this->model_brand->fecthAllData();
            
    		$this->render_template('admin_view/changepassword', $this->data);
        }
    }

  // function random_password() 
  // {
  //     $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  //     $password = array(); 
  //     $alpha_length = strlen($alphabet) - 1; 
  //     for ($i = 0; $i < 8; $i++) 
  //     {
  //         $n = rand(0, $alpha_length);
  //         $password[] = $alphabet[$n];
  //     }
  //     return implode($password); 
  // }
  // echo random_password();
}
