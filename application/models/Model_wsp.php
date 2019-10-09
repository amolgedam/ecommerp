<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_wsp extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_wsp')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_wsp', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['invoice_type' => 'wsp'])
								->order_by('created_date', 'DESC')
								->get();
			return $query->result_array();
		}else{
		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['invoice_type' => 'wsp'])
								->order_by('created_date', 'DESC')
								->get();
			return $query->result_array();
		}
	}

	public function fecthAllDataBetweenDate($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['invoice_type' => 'wsp'])
								->where('date >=', $data['from'])
								->where('date <=', $data['to'])
								->order_by('created_date', 'DESC')
								->get();
			return $query->result_array();
		}else{
		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['invoice_type' => 'wsp'])
								->where('date >=', $data['from'])
								->where('date <=', $data['to'])
								->order_by('created_date', 'DESC')
								->get();
			return $query->result_array();
		}
	}

	public function fecthAllDatabyID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
								->from('wo_wsp')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('id', $id)
								->get();
			return $query->row_array();
		}else{
			$query = $this->db->select('*')
							->from('wo_wsp')
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
			$update = $this->db->update('wo_wsp', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_wsp');
	}
	
	public function fecthItemDataByIdType($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
								->from('wo_inventorydata')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('inventory_id', $data['inventory_id'])
								->where('inventory_type', $data['inventory_type'])
								->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
								->from('wo_inventorydata')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('inventory_id', $data['inventory_id'])
								->where('inventory_type', $data['inventory_type'])
								->get();
			return $query->result_array();
		}
	}
	
	public function updateWspMaterial($data=array())
	{
		$this->db->set('modified_date','NOW()', FALSE);
		$this->db->where('id', $data['id']);
		$update = $this->db->update('wo_inventorydata', $data);
		return ($update == true) ? true : false;
	}

	public function getSalesInvoiceData($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
								->from('wo_inventorydata')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('inventory_id', $data['inventory_id'])
								->where('inventory_type', $data['inventory_type'])
								->where('pno', $data['pno'])
								->get();
			return $query->row_array();
		}else{

			$query = $this->db->select('*')
								->from('wo_inventorydata')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('inventory_id', $data['inventory_id'])
								->where('inventory_type', $data['inventory_type'])
								->where('pno', $data['pno'])
								->get();
			return $query->row_array();
		}
	}

	public function getWSPData($purchase_id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('wo_purchaseorderitem.order_id, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type')
									->from('wo_purchaseorderitem')
									// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
									->where('wo_purchaseorderitem.order_id', $purchase_id)
									->join('wo_items', 'wo_items.purchase_id = wo_purchaseorderitem.order_id')
									->get();
			return $query->row_array();
		}else{

			$query = $this->db->select('wo_purchaseorderitem.order_id, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type')
									->from('wo_purchaseorderitem')
									// ->where(['wo_purchaseorderitem.company_id' => $this->session->userdata['wo_company'], 'wo_purchaseorderitem.store_id' => $this->session->userdata['wo_store']])
									->where('wo_purchaseorderitem.order_id', $purchase_id)
									->join('wo_items', 'wo_items.purchase_id = wo_purchaseorderitem.order_id')
									->get();
			return $query->row_array();
		}
	}
}