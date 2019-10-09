<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mdi_form extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
		
		$this->not_logged_in();

        error_reporting(0);

		$this->data['page_title'] = 'MDI Form';
		
		$this->load->model('model_company');
        // $this->load->model('model_state');
		$this->load->model('model_division');
        $this->load->model('model_store');
		$this->load->model('model_location');
		$this->load->model('model_users');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function index()
	{
	    $this->data['companyDetails'] = $this->model_company->fecthCompanyData();
        // $this->data['city'] = $this->model_state->fecthAllCityData();
	   // $this->data['department'] = $this->model_division->fecthAllData();
        $this->data['store'] = $this->model_store->fecthAllStoresData();
	   // $this->data['location'] = $this->model_location->fecthAllData();
	    
	    $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        // $this->form_validation->set_rules('department', 'Department', 'trim|required');
        // $this->form_validation->set_rules('location', 'Location', 'trim|required');
        
        if ($this->form_validation->run() == TRUE)
        {
            if(empty($_POST['company_name']))
            {
                $this->session->set_flashdata('feedback','Please Select Required Fields');
    			$this->session->set_flashdata('feedback_class','alert alert-danger');
    			return redirect('mdi_form');
            }
            else
            {
                $store = '';
                if(isset($_POST['store']))
                {
                    $store = $_POST['store'];
                }
                else
                {
                    $store = '';
                }
                
                // echo "<pre>"; print_r($_POST);  echo "<pre>"; // print_r($_SESSION); exit();
                $data = array(
                                'wo_company' => $_POST['company_name'],
                                // 'wo_city' => '',
                                'wo_store' => $_POST['store'],
                                // 'wo_city' => $_POST['city'],
                                // 'wo_store' => $_POST['store'],
                                // 'wo_division' => $_POST['department'],
                                // 'wo_location' => $_POST['location']
                            );
                
                $this->session->set_userdata($data);
                
                // echo "<pre>"; print_r($_SESSION); echo "</pre>"; exit;
                
                return redirect('dashboard');
            }
        }
        else
        {
            // print_r($_SESSION); exit();

            $this->load->view('admin_view/mdaForm', $this->data);   
        }
	}
	
	public function changecompany()
	{
	   //echo "<pre>";  print_r($_SESSION); //exit;
	   unset($_SESSION['wo_company']);
	   unset($_SESSION['wo_store']);
	   
	   //$data = $this->model_users->fecthUserDataByID($_SESSION['wo_id']);
	   
	   //$data = array(
    //                             'wo_company' => $data['company_id'],
    //                             // 'wo_city' => '',
    //                             // 'wo_store' => $store,
    //                             // 'wo_city' => $_POST['city'],
    //                             // 'wo_store' => $_POST['store'],
    //                             // 'wo_division' => $_POST['department'],
    //                             // 'wo_location' => $_POST['location']
    //                         );
	   
   	//   echo "<pre>";  print_r($data); exit();
   	   
   	//   echo "<pre>";  print_r($_SESSION); exit();
   	   
   	   return redirect('mdi_form');
	}
	
} 
