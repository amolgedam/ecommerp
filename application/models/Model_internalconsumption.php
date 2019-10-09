<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_internalconsumption extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function createInventotyData($data=array())
	{
	    $this->db->set('created_date','NOW()', FALSE);
		$this->db->insert('wo_inventorydata', $data);
	}
	
	public function deleteItemData($data=array())
	{
		$this->db->where('inventory_id',  $data['id']);
		$this->db->where('inventory_type', $data['inventory_type']);
		return $result=$this->db->delete('wo_inventorydata');
	}
	
	public function fecthItemDataByInventoryID($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventorydata')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('inventory_id', $data['id'])
    							->where('inventory_type', $data['inventory_type'])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_inventorydata')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('inventory_id', $data['id'])
    							->where('inventory_type', $data['inventory_type'])
    							->get();
    		return $query->result_array();
	    }
	}

    public function fecthDataByID($id='')
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_inventorydata')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('id', $id)
                                ->get();
            return $query->row_array();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_inventorydata')
                                // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('id', $id)
                                ->get();
            return $query->row_array();
        }
    }
	
	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_inventoryconsumption')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}

    public function fetchPurchaseData($purchaseID='')
    {
        $query = $this->db->select('*')
                            ->from('wo_purchaseorderdata')
                            ->where('order_id', $purchaseID)
                            ->get();
        return $query->row_array();
    }

    public function fetchDataByBarcodeId($barcode='')
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_items')
                                // ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
                                ->where('barcode', $barcode)
                                ->where('item_status', 'available')
                                ->get();
            return $query->row_array();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_items')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
                                ->where('barcode', $barcode)
                                ->where('item_status', 'available')
                                ->get();
            return $query->row_array();
        }
    }
	
	public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_inventoryconsumption', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
    public function fecthAllData()
	{
        if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventoryconsumption')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
        }else
        {
            $query = $this->db->select('*')
    							->from('wo_inventoryconsumption')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
        }
	}
	
	public function fecthAllDataByID($id='')
	{
        if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventoryconsumption')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
        }else
        {
            $query = $this->db->select('*')
    							->from('wo_inventoryconsumption')
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
			$update = $this->db->update('wo_inventoryconsumption', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_inventoryconsumption');
	}
}