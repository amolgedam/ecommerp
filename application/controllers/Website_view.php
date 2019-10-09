<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Website_view extends CI_Controller
	{
		function __construct()
		{
			parent :: __construct();
		}

		public function index()
		{
			$this->load->view('ecommerce_website/includes/head');
			$this->load->view('ecommerce_website/home');
			$this->load->view('ecommerce_website/includes/script');
		}

	}
?>