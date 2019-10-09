<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_openingitem extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_inventoryopeningitem', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
    public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}

	public function fecthAllDataByOrderData($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['order_id' => $data['id'], 'order_name' => $data['order_name']])
    							->get();
    		return $query->result_array();	
	    }else
	    {
	    	$query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['order_id' => $data['id'], 'order_name' => $data['order_name']])
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fecthOrderData($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'inventory_type' => $data['ordertype']])
    							->get();
    		return $query->row_array();	
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'inventory_type' => $data['ordertype']])
    							->get();
    		return $query->row_array();	
	    }
	}

	public function fecthOrderDataByIdType($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['order_id' => $data['order_id'], 'inventory_type' => $data['ordertype']])
    							->get();
    		return $query->row_array();	
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['order_id' => $data['order_id'], 'inventory_type' => $data['ordertype']])
    							->get();
    		return $query->row_array();	
	    }
	}
	
	public function fecthAllDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fecthDataBySKUid($skuid='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
    							->where('sku', $skuid)
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
    							->where('sku', $skuid)
    							->get();
    		return $query->row_array();
	    }
	}

	public function fecthAllDataByOrderID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('order_id', $id)
    							->get();
    		return $query->row_array();
	    }else{
	         $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('order_id', $id)
    							->get();
    		return $query->row_array();
	    }
	}

	public function fecthAllDataByOrderSKUID($order_id='', $skuid='')
	{
	    $query = $this->db->select('*')
							->from('wo_inventoryopeningitem')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where(['order_id' => $order_id, 'sku' => $skuid])
							->get();
    	return $query->row_array();
	    
	}


	public function fecthAllDataByPurID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('purchase_id', $id)
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('purchase_id', $id)
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_inventoryopeningitem', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_inventoryopeningitem');
	}
	
	public function deleteStockitemByOrderId($id = "")
	{
		$this->db->where('order_id', $id);
		return $result=$this->db->delete('wo_inventoryopeningitem');
	}

}