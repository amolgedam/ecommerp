<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		$this->load->model('model_company');
		
	}

	public function index()
	{
	   // echo "<pre>"; print_r($_SESSION); echo "</pre>"; exit;
	    
		$this->render_template('admin_view/dashboard', $this->data);
	}
}