<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Compose extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Compose Email SMS';
		$this->load->model('model_company');
		
	}

	public function index()
	{
		$this->render_template('admin_view/compose/composeEmailSms/index', $this->data);
	}

	public function configEmail()
	{
		$this->render_template('admin_view/compose/configEmail/index', $this->data);
	}

	public function configSms()
	{
		$this->render_template('admin_view/compose/configSms/index', $this->data);
	}



}