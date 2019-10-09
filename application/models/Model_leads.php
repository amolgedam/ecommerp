<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_leads extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_leads', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_leads')
    							->order_by('created_date', 'desc')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_leads')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('created_date', 'desc')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function getDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_leads')
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_leads')
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
			$update = $this->db->update('wo_leads', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_leads');
	}
	
// 	==============      Item Data        ==================
    public function createItem($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_leadItems', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function getItemDataByID($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_leadItems')
							->where('leads_id', $id)
							->get();
		return $query->result_array();
	}
	
	public function itemDelete($id = "")
	{
		$this->db->where('leads_id', $id);
		return $result=$this->db->delete('wo_leadItems');
	}

}