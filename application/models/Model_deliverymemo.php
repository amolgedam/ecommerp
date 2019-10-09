<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_deliverymemo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_deliverymemo')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}

	public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_deliverymemo', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
    public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_deliverymemo')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_deliverymemo')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}
    
    public function fecthAllDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_deliverymemo')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_deliverymemo')
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
			$update = $this->db->update('wo_deliverymemo', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_deliverymemo');
	}
	
	
	
    // 	Memo Item
    public function createMemoItem($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_deliverymemoitem', $data);
			return ($create == true) ? true : false;
    	}
	}
	
	public function deleteItem($id)
	{
	    $this->db->where('id', $id);
		return $result=$this->db->delete('wo_deliverymemoitem');
	}

    public function fecthItemData($data = array())
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_deliverymemoitem')
                                ->where('entry_type', $data['entry_type'])
                                ->where('memo_id', $data['id'])
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->get();
            return $query->result_array();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_deliverymemoitem')
                                ->where('entry_type', $data['entry_type'])
                                ->where('memo_id', $data['id'])
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->get();
            return $query->result_array();
        }
    }

	
	


}

