<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_journalentry extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_journal')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}

	public function create($data = array())
	{
		if($data) {
			// print_r($data);exit();
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_journal', $data);
			// return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}

	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_journal')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_journal')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fecthAllDataBetweenDate($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_journal')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->or_where('created_date >=', $data['from'])
    							->or_where('created_date <=', $data['to'])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_journal')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->or_where('created_date >=', $data['from'])
    							->or_where('created_date <=', $data['to'])
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_journal')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_journal')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}

	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_journal', $data);
			return ($update == true) ? true : false;
		}
	}

	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_journal');
	}

	// public function deleteByLEntryId($data = array())
	// {
	// 	$this->db->where('entry_id', $data['id']);
	// 	$this->db->where('entry_type', $data['entry_type']);
	// 	return $result=$this->db->delete('wo_ledgerentries');
	// }

}