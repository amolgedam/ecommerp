<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ledgerentry extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_ledgerentries', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledgerentries')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledgerentries')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_ledgerentries', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_ledgerentries');
	}

	public function deleteByLEntryId($data = array())
	{
		$this->db->where('entry_id', $data['id']);
		$this->db->where('entry_type', $data['entry_type']);
		return $result=$this->db->delete('wo_ledgerentries');
	}
}