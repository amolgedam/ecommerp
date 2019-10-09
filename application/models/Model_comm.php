<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_comm extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function createSalesmanComm($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_salesmancomm', $data);
			return ($create == true) ? true : false;
		}
	}
	
	
}
?>