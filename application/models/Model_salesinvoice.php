<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_salesinvoice extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
    public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_salesinvoice')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_salesinvoice', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function lastData()
	{
	    $query = $this->db->select('*')
    						->from('wo_salesinvoice')
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->order_by('created_date', 'DESC')
    						->get();
    	return $query->row_array();
	    
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['invoice_type !=' => 'wsp'])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}else{
			$query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['invoice_type !=' => 'wsp'])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}
	}

	public function fecthAllSalesData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}else{
			$query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}
	}

	public function fecthAllSalesDataByDate($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
								->where('date >=', $data['from'])
								->where('date <=', $data['to'])
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}else{
			$query = $this->db->select('*')
								->from('wo_salesinvoice')
								->where('date >=', $data['from'])
								->where('date <=', $data['to'])
			    				->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->order_by('created_date', 'desc')
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
								->where(['invoice_type !=' => 'wsp'])
								->where('date >=', $data['from'])
								->where('date <=', $data['to'])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['invoice_type !=' => 'wsp'])
								->where('date >=', $data['from'])
								->where('date <=', $data['to'])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}
	}

	public function fecthSalesInvoiceData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['invoice_type !=' => 'voucher'])
								->where(['invoice_type !=' => 'wsp'])
								->where(['invoice_type !=' => 'pos'])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['invoice_type !=' => 'voucher'])
								->where(['invoice_type !=' => 'wsp'])
								->where(['invoice_type !=' => 'pos'])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}
	}
	
	public function fecthSalesInvoiceDataForAltration()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])	
								->where(['invoice_type !=' => 'voucher'])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])	
								->where(['invoice_type !=' => 'voucher'])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}
	}
	
	public function fecthAllDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
								->where('id', $id)
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->row_array();
		}else{
			
			$query = $this->db->select('*')
							->from('wo_salesinvoice')
							->where('id', $id)
		    				->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->row_array();
		}
	}

	public function fecthAllDataByInvoiceID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoice')
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('inventory_no', $id)
								->get();
			return $query->row_array();
		}else{
			
			$query = $this->db->select('*')
							->from('wo_salesinvoice')
		    				->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('inventory_no', $id)
							->get();
			return $query->row_array();
		}
	}

	public function getDataByBarcode($borcode='',$invoice_id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
								->from('wo_salesinvoicedata')
								->where('pno', $borcode)
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('inventory_id', $invoice_id)
								->get();
			return $query->row_array();
		}else{
		
			$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('pno', $borcode)
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('inventory_id', $invoice_id)
							->get();
			return $query->row_array();
		}
	}
	
	public function getBarcodeOutWardData($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
								->from('wo_salesinvoicedata')
								->where('pno', $data['pno'])
								->where('inventory_type', $data['inventory_type'])
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->row_array();
		}else{

			$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('pno', $data['pno'])
							->where('inventory_type', $data['inventory_type'])
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->row_array();
		}
	}

	public function fecthItemDataByIdType($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

				$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $data['inventory_id'])
							->where('inventory_type', $data['inventory_type'])
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $data['inventory_id'])
							->where('inventory_type', $data['inventory_type'])
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_salesinvoice', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_salesinvoice');
	}
	
	public function createInvoiceData($data=array())
	{
	    if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_salesinvoicedata', $data);
			return ($create == true) ? true : false;
		}
	}

	public function getSalesInvoiceData($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
								->from('wo_salesinvoicedata')
								->where('inventory_id', $data['inventory_id'])
								->where('inventory_type', $data['inventory_type'])
								->where('pno', $data['pno'])
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->row_array();
		}else{
		
			$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $data['inventory_id'])
							->where('inventory_type', $data['inventory_type'])
							->where('pno', $data['pno'])
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->row_array();
		}
	}
	
	public function fecthItemDataByInvoiceID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $id)
							->where('inventory_type', 'invoice')
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}else{

		    $query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $id)
							->where('inventory_type', 'invoice')
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}
	}
	
	public function fecthSalesInvoiceDataByIdType($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesinvoicedata')
								->where('inventory_id', $data['inventory_id'])
								->where('inventory_type', $data['inventory_type'])
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->result_array();
		}else{

			    $query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $data['inventory_id'])
							->where('inventory_type', $data['inventory_type'])
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}
	}

	public function fecthItemDataByInvoiceIDGST($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $data['id'])
							->where('inventory_type', 'salesinvoice')
							->where('gst', $data['gst_id'])
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $data['id'])
							->where('inventory_type', 'salesinvoice')
							->where('gst', $data['gst_id'])
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}

	}

	public function fecthItemDataByPOSID($id ='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $id)
							->where('inventory_type', 'pos')
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
								->from('wo_salesinvoicedata')
								->where('inventory_id', $id)
								->where('inventory_type', 'pos')
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->result_array();
		}
	}

	public function fecthItemDataByPOSIDGST($data =array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
		
			$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $data['id'])
							->where('inventory_type', 'pos')
							->where('gst', $data['gst_id'])
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
								->from('wo_salesinvoicedata')
								->where('inventory_id', $data['id'])
								->where('inventory_type', 'pos')
								->where('gst', $data['gst_id'])
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->result_array();
		}
	}

	// public function fecthExchangeData($id)
	// {
	//     $query = $this->db->select('*')
	// 						->from('wo_salesinvoicedata')
	// 						->where('inventory_id', $id)
	// 						->where('inventory_type', 'salesexchange')
	// 						->get();
	// 	return $query->result_array();
	// }
	
	public function deleteItemData($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_salesinvoicedata');
	}

	public function deleteInvoiceData($data=array())
	{
		$this->db->where('inventory_id', $data['inventory_id']);
		$this->db->where('inventory_type', $data['inventory_type']);
		return $result=$this->db->delete('wo_salesinvoicedata');
	}

	public function fecthExchangeData($data=array())
	{
		$this->db->where('inventory_id', $data['inventory_id']);
		$this->db->where('inventory_type', $data['inventory_type']);
		// $this->db->where('sales_exchange', $data['sales_exchange']);
		// return $result=$this->db->delete('wo_salesinvoicedata');
	}

	public function updateInvoiceData($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_salesinvoicedata', $data);
			return ($update == true) ? true : false;
		}
	}

}