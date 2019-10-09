<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_loyalty extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_role')
    							->where('id !=', 1)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_role')
    							->where('id !=', 1)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}

	public function fecthAllOverData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_role')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_role')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_role', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_role');
	}
	
    // 	ROYALTY VALUE
	
	public function createValue($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('loyaltyvalue', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fetchLoyaltyValue()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('loyaltyvalue')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('value', 'asc')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('loyaltyvalue')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('value', 'asc')
    							->get();
    		return $query->result_array();
	    }
	}
	
	
	// 	ROYALTY POINTS
	
	public function createPoint($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('loyaltypoints', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fetchAllPoints()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('loyaltypoints')
    							// ->where(['loyaltypoints.company_id' => $this->session->userdata['wo_company']])
    							->order_by('loyaltyvalueid', 'asc')
    							->get();
    		return $query->result_array();
	    }else{
	         $query = $this->db->select('*')
    							->from('loyaltypoints')
    							->where(['loyaltypoints.company_id' => $this->session->userdata['wo_company'], 'loyaltypoints.store_id' => $this->session->userdata['wo_store']])
    							->order_by('loyaltyvalueid', 'asc')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function updatePoint($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('loyaltypoints', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function deletePoint($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('loyaltypoints');
	}
	
	
	
	
	
}