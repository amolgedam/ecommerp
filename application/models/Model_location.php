<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_location extends CI_Model
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
			$create = $this->db->insert('wo_location', $data);
			return ($create == true) ? true : false;
		}
	}

	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_location')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_location')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}

	public function fetchLocationByDivision($id='', $company_id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_location')
    							// ->where(['company_id' => $company_id, 'division' => $id])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_location')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();   
	    }
	}

	public function fecthAllDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_location')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_location')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}

    public function fecthDataWithBranch()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('wo_division.id as bid, wo_division.division_name as bname, wo_location.id as lid, wo_location.location_name as lname')
    							->from('wo_location')
    							// ->where(['wo_location.company_id' => $this->session->userdata['wo_company']])
    							->order_by('location_name', 'desc')
    							->join('wo_division', 'wo_division.id = wo_location.division_id', 'left')
    							// ->join('wo_branch', 'wo_branch.id = wo_location.branch_id', 'left')
    							->get();
    		return $query->result();
	    }else{
	        $query = $this->db->select('wo_division.id as bid, wo_division.division_name as bname, wo_location.id as lid, wo_location.location_name as lname')
    							->from('wo_location')
    							->where(['wo_location.company_id' => $this->session->userdata['wo_company'], 'wo_location.store_id' => $this->session->userdata['wo_store']])
    							->order_by('location_name', 'desc')
    							->join('wo_division', 'wo_division.id = wo_location.division_id', 'left')
    							// ->join('wo_branch', 'wo_branch.id = wo_location.branch_id', 'left')
    							->get();
    		return $query->result();
	    }
	}

	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_location', $data);
			return ($update == true) ? true : false;
		}
	}

	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_location');
	}

}