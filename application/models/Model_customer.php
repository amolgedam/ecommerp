<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_customer extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_customer', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthAllData()
	{
	    $query = $this->db->select('*')
							->from('wo_customer')
							->order_by('created_date', 'desc')
							->get();
		return $query->result_array();
	}
	
	public function getDataByID($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_customer')
							->where('id', $id)
							->get();
		return $query->row_array();
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_customer', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_customer');
	}
	
	
	public function createEmail($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('mails', $data);
			return ($create == true) ? true : false;
		}
	}
	

}