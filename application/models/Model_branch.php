<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_branch extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function create($data = array())
	{
		if($data) {
			// print_r($data);exit();
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_branch', $data);
			return ($create == true) ? true : false;
		}
	}

	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_branch')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_branch')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}

	public function fecthAllDataByID($id='')
	{
	    $query = $this->db->select('*')
    							->from('wo_branch')
    							->where('id', $id)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    
	}

	public function fecthDataWithDivision()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('wo_division.id as did, wo_division.division_name as dname, wo_branch.id as bid, wo_branch.branch_name as bname')
    							->from('wo_branch')
    							// ->where(['wo_branch.company_id' => $this->session->userdata['wo_company']])
    							->join('wo_division', 'wo_division.id = wo_branch.division_id', 'left')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('wo_division.id as did, wo_division.division_name as dname, wo_branch.id as bid, wo_branch.branch_name as bname')
    							->from('wo_branch')
    							->where(['wo_branch.company_id' => $this->session->userdata['wo_company'], 'wo_branch.store_id' => $this->session->userdata['wo_store']])
    							->join('wo_division', 'wo_division.id = wo_branch.division_id', 'left')
    							->get();
    		return $query->result();
	    }
	}

	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_branch', $data);
			return ($update == true) ? true : false;
		}
	}

	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_branch');
	}

}