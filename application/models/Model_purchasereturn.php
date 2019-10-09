<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_purchasereturn extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_purchasereturn')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_purchasereturn', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}

	public function purchaseReturnData($invoice_id='')
	{
		$query = $this->db->select('wo_purchaseorderdata.id, wo_purchaseorderdata.order_id, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type')
								->from('wo_purchaseorderdata')
								->where('wo_purchaseorderdata.order_id', $invoice_id)
								->where('order_name', 'pinvoice')
								->join('wo_purchaseorderitem', 'wo_purchaseorderitem.order_code = wo_purchaseorderdata.order_code')
								->get();
		return $query->row_array();
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchasereturn')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchasereturn')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();   
	    }
	}

	public function preturnReport()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }
	}

	public function preturnReportDateWise($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('date >=', $data['from'])
    							->where('date <=', $data['to'])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('date >=', $data['from'])
    							->where('date <=', $data['to'])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }
	}

	public function preturnReportDateWisePAccount($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, account_id, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('date >=', $data['from'])
    							->where('date <=', $data['to'])
								->where('purchase_acid', $data['paccount'])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, account_id, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('date >=', $data['from'])
    							->where('date <=', $data['to'])
								->where('purchase_acid', $data['paccount'])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }
	}

	public function preturnReportDateWiseLedger($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('date >=', $data['from'])
    							->where('date <=', $data['to'])
								->where('account_id', $data['ledgerid'])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('date >=', $data['from'])
    							->where('date <=', $data['to'])
								->where('account_id', $data['ledgerid'])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }
	}

	public function preturnReportDateWisePAccountLedger($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('date >=', $data['from'])
    							->where('date <=', $data['to'])
								->where('purchase_acid', $data['paccount'])
								->where('account_id', $data['ledgerid'])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('id as pid, order_no as invoiceno, date as date, gross_total as gross_amt, account_id, total_tax as tot_tax, adjustment as adj, total_invoicevalue as tot_invoice, inventory_type as type')
    							->from('wo_purchasereturn')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('date >=', $data['from'])
    							->where('date <=', $data['to'])
								->where('purchase_acid', $data['paccount'])
								->where('account_id', $data['ledgerid'])
    							->order_by('created_date', 'DESC')
    							->get();		
    		return $query->result_array();
	    }	
	}

	public function fecthAllDatabyID($id='')
	{
		$query = $this->db->select('*')
							->from('wo_purchasereturn')
							->where('id', $id)
							->get();
		return $query->row_array();
	}
	
	// public function fecthAllDatabyID($id='')
	// {
	//     $query = $this->db->select('*')
	// 						->from('wo_purchasereturn')
	// 						->where('id', $id)
	// 						->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
	// 						->get();
	// 	return $query->row_array();
	// }
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_purchasereturn', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_purchasereturn');
	}

	public function fecthItemDatabyID($data=array())
	{
		$query = $this->db->select('*')
								->from('wo_inventorydata')
								->where('inventory_id', $data['inventory_id'])
								->where('inventory_type', $data['inventory_type'])
								->get();
		return $query->result_array();
	}

	public function sumQty($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('inventory_id, SUM(qty) as qty')
    								->from('wo_inventorydata')
    								->where(['inventory_id' => $data['inventory_id'], 'inventory_type' => $data['inventory_type']])
    								// ->where(['company_id' => $this->session->userdata['wo_company']])
    								->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('inventory_id, SUM(qty) as qty')
    								->from('wo_inventorydata')
    								->where(['inventory_id' => $data['inventory_id'], 'inventory_type' => $data['inventory_type']])
    								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							    ->get();
    		return $query->row_array();
	    }
	}

}