<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_attribute extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_attribute', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fetchDataById($id)
	{
	    $query = $this->db->select('*')
							->from('wo_attribute')
							// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
							->where('id', $id)
							->get();
		return $query->row_array();
	}
	
	public function fecthAllData()
	{
	    $query = $this->db->select('*')
							->from('wo_attribute')
							// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
							->get();
		return $query->result();
	}
	
	public function fecthAllDataByID($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_attribute')
							// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
							->where('id', $id)
							->get();
		return $query->row_array();
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_attribute', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_attribute');
	}
	
	public function fetchBarcodeAttributeData($id)
	{
	    $query = $this->db->select('*')
							->from('wo_purchaseorderitem')
							// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
							->where('id', $id)
							->get();
		return $query->row_array();
	}

	public function fetchDataBySKUAndColor($data)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_purchaseorderitem')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store'] ])
								->where('sku', $data['sku'])
								->where('color', $data['color'])
								->get();
			return $query->row_array();
		}
		else
		{
			$query = $this->db->select('*')
								->from('wo_purchaseorderitem')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store'] ])
								->where('sku', $data['sku'])
								->where('color', $data['color'])
								->get();
			return $query->row_array();
		}
	}

	public function fetchDataByOrderIDAndOrdercode($data)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_purchaseorderitem')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store'] ])
								->where('order_id', $data['orderid'])
								->where('order_code', $data['order_code'])
								->order_by('created_date', 'asc')
								->get();
			return $query->result_array();
		}
		else
		{
			$query = $this->db->select('*')
								->from('wo_purchaseorderitem')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store'] ])
								->where('order_id', $data['orderid'])
								->where('order_code', $data['order_code'])
								->order_by('created_date', 'asc')
								->get();
			return $query->result_array();
		}
	}

	public function fetchDataByOrderIDAndOrderName($data)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_purchaseorderitem')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store'] ])
								->where('order_id', $data['orderid'])
								->where('order_name', $data['order_name'])
								->order_by('created_date', 'asc')
								->get();
			return $query->result_array();
		}
		else
		{
			$query = $this->db->select('*')
								->from('wo_purchaseorderitem')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store'] ])
								->where('order_id', $data['orderid'])
								->where('order_name', $data['order_name'])
								->order_by('created_date', 'asc')
								->get();
			return $query->result_array();
		}
	}
	
	public function updateAttr($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_purchaseorderitem', $data);
			return ($update == true) ? true : false;
		}
	}

	public function createAttr($data=array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_purchaseorderitem', $data);
			return ($create == true) ? true : false;
		}
	}

	public function deleteAttrData($id='')
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_purchaseorderitem');
	}


}