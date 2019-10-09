<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_purchaseinvoice extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_purchaseorderinvoice', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function lastData()
	{
	    $query = $this->db->select('*')
    						->from('wo_purchaseorderinvoice')
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->order_by('created_date', 'DESC')
    						->get();
    	return $query->row_array();
	    
	}
	
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorderinvoice')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderinvoice')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fecthAllDatabyID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorderinvoice')
    							->where('id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderinvoice')
    							->where('id', $id)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fecthAllDatabyOrderNo($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorderinvoice')
    							->where('porder_no', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderinvoice')
    							->where('porder_no', $id)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function pinvoiceReport()
	{
		$query = $this->db->select('id as pid, invoice_no as invoiceno, invoice_date as date, gamt as gross_amt, total_tax as tot_tax, account, adjustment as adj, total_invoice as tot_invoice, inventory_type as type, dueDate')
							->from('wo_purchaseorderinvoice')
							->where(['company_id' => $this->session->userdata['wo_company']])
							->order_by('created_date', 'DESC')
							->get();		
		return $query->result_array();
	}

	public function pinvoiceReportDateWise($data=array())
	{
		$query = $this->db->select('id as pid, invoice_no as invoiceno, invoice_date as date, gamt as gross_amt, total_tax as tot_tax, account, adjustment as adj, total_invoice as tot_invoice, inventory_type as type, dueDate')
							->from('wo_purchaseorderinvoice')
							->where(['company_id' => $this->session->userdata['wo_company']])
							->where('invoice_date >=', $data['from'])
							->where('invoice_date <=', $data['to'])
							->order_by('created_date', 'DESC')
							->get();		
		return $query->result_array();
	}

	public function pinvoiceReportDateWisePAccount($data=array())
	{
		$query = $this->db->select('id as pid, invoice_no as invoiceno, invoice_date as date, gamt as gross_amt, total_tax as tot_tax, account, adjustment as adj, total_invoice as tot_invoice, inventory_type as type, dueDate')
							->from('wo_purchaseorderinvoice')
							->where(['company_id' => $this->session->userdata['wo_company']])
							->where('invoice_date >=', $data['from'])
							->where('invoice_date <=', $data['to'])
							->where('paccount', $data['paccount'])
							->order_by('created_date', 'DESC')
							->get();		
		return $query->result_array();
	}

	public function pinvoiceReportDateWiseLedger($data=array())
	{
		$query = $this->db->select('id as pid, invoice_no as invoiceno, invoice_date as date, gamt as gross_amt, total_tax as tot_tax, account, adjustment as adj, total_invoice as tot_invoice, inventory_type as type, dueDate')
							->from('wo_purchaseorderinvoice')
							->where(['company_id' => $this->session->userdata['wo_company']])
							->where('invoice_date >=', $data['from'])
							->where('invoice_date <=', $data['to'])
							->where('account', $data['ledgerid'])
							->order_by('created_date', 'DESC')
							->get();		
		return $query->result_array();
	}

	public function pinvoiceReportDateWisePAccountLedger($data=array())
	{
		$query = $this->db->select('id as pid, invoice_no as invoiceno, invoice_date as date, account, gamt as gross_amt, account, total_tax as tot_tax, adjustment as adj, total_invoice as tot_invoice, inventory_type as type, dueDate')
							->from('wo_purchaseorderinvoice')
							->where(['company_id' => $this->session->userdata['wo_company']])
							->where('invoice_date >=', $data['from'])
							->where('invoice_date <=', $data['to'])
							->where('paccount', $data['paccount'])
							->where('account', $data['ledgerid'])
							->order_by('created_date', 'DESC')
							->get();		
		return $query->result_array();
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_purchaseorderinvoice', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_purchaseorderinvoice');
	}

}