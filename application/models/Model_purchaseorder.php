<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_purchaseorder extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_purchaseorder', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorder')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorder')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fecthAllDatabyPCode($pcode)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_product')
    							->where('product_code', $pcode)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else{
	         $query = $this->db->select('*')
    							->from('wo_product')
    							->where('product_code', $pcode)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fecthAllDatabyID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorder')
    							->where('id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorder')
    							->where('id', $id)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fecthAllDataStatus()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorder')
    							->where('order_status', 'open')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorder')
    							->where('order_status', 'open')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fetchAllDataByIDStatus($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorder')
    							->where('id', $id)
    							->where('order_status', 'open')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorder')
    							->where('id', $id)
    							->where('order_status', 'open')
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
			$update = $this->db->update('wo_purchaseorder', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_purchaseorder');
	}

	public function fecthOrderDataByOrderID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('order_id', $id)
    							->get();
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('order_id', $id)
    							->get();
    		return $query->result_array();
	    }
	}

}