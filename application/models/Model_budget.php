<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_budget extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('budget', $data);
			// return ($create == true) ? true : false;
			return $this->db->insert_id();
			
		}
	}

	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('budget')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('budget')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();   
	    }
	}

	public function fecthDataById($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('budget')
    							->where('id', $id)

    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('budget')
    							->where('id', $id)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();   
	    }
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('budget', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('budget');
	}

	// ##########################################################################

	public function createItem($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('budget_item', $data);
			return ($create == true) ? true : false;
		}
	}

	public function fecthDatayBudgerItem()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('budget_item')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }
	    else{
	        
	        $query = $this->db->select('*')
    							->from('budget_item')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();   
	    }
	}

	public function fecthDatayBudgerID($budget_id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('budget_item')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['budget_id' => $budget_id])
    							->get();
    		return $query->row_array();
	    }
	    else{
	        
	        $query = $this->db->select('*')
    							->from('budget_item')
    							->where(['budget_id' => $budget_id])
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();   
	    }
	}

	public function fecthAllDatayBudgerID($budget_id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('budget_item')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['budget_id' => $budget_id])
    							->get();
    		return $query->result_array();
	    }
	    else{
	        
	        $query = $this->db->select('*')
    							->from('budget_item')
    							->where(['budget_id' => $budget_id])
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();   
	    }
	}

	public function deleteBudgetItem($budget_id='')
	{
		$this->db->where('budget_id', $budget_id);
		return $result=$this->db->delete('budget_item');
	}

}