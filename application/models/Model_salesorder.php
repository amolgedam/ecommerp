<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_salesorder extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_salesorder')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	} 

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_salesorder', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fecthAllDataByMTO()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesorder')
				    			// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['order_status' => 'Open', 'order_type' => 'mto'])
								->order_by('created_date', 'DESC')
								->get();
			return $query->result();
		}else{
			$query = $this->db->select('*')
								->from('wo_salesorder')
				    			->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['order_status' => 'Open', 'order_type' => 'mto'])
								->order_by('created_date', 'DESC')
								->get();
			return $query->result();
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesorder')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}else{
			$query = $this->db->select('*')
							->from('wo_salesorder')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->order_by('created_date', 'desc')
							->get();
			return $query->result_array();
		}
	}
	
	public function fecthSalesOrderOpenData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

	    	$query = $this->db->select('*')
							->from('wo_salesorder')
			    			// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('order_status', 'Open')
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}else{
			
			$query = $this->db->select('*')
							->from('wo_salesorder')
			    			->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('order_status', 'Open')
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}
	}

	public function fecthDateByCommitedDate($data=array())
	{
		// print_r($data); exit();
		if($_SESSION['wo_role'] == 'superadmin'){

	    	$query = $this->db->select('*')
							->from('wo_salesorder')
			    			->where('completed_date >=', $data['from'])
			    			->where('completed_date <=', $data['to'])
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}else{
			
			$query = $this->db->select('*')
							->from('wo_salesorder')
			    			->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
			    			->where('completed_date >=', $data['from'])
			    			->where('completed_date <=', $data['to'])
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}
	}

	public function fecthDateByCommitedDateCustomer($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){

	    	$query = $this->db->select('*')
							->from('wo_salesorder')
			    			->where('completed_date >=', $data['from'])
			    			->where('completed_date <=', $data['to'])
			    			->where('account_id', $data['ledger_id'])
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}else{
			
			$query = $this->db->select('*')
							->from('wo_salesorder')
			    			->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
			    			->where('completed_date >=', $data['from'])
			    			->where('completed_date <=', $data['to'])
			    			->where('account_id', $data['ledger_id'])
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}
	}

	public function fecthDateByCommitedDateStatus($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){

	    	$query = $this->db->select('*')
							->from('wo_salesorder')
			    			->where('completed_date >=', $data['from'])
			    			->where('completed_date <=', $data['to'])
			    			->where('order_status', $data['status'])
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}else{
			
			$query = $this->db->select('*')
							->from('wo_salesorder')
			    			->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
			    			->where('completed_date >=', $data['from'])
			    			->where('completed_date <=', $data['to'])
			    			->where('order_status', $data['status'])
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}	
	}

	public function fecthDateByCommitedDateCustStatus($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){

	    	$query = $this->db->select('*')
							->from('wo_salesorder')
			    			->where('completed_date >=', $data['from'])
			    			->where('completed_date <=', $data['to'])
			    			->where('order_status', $data['status'])
			    			->where('account_id', $data['ledger_id'])
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}else{
			
			$query = $this->db->select('*')
							->from('wo_salesorder')
			    			->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
			    			->where('completed_date >=', $data['from'])
			    			->where('completed_date <=', $data['to'])
			    			->where('order_status', $data['status'])
			    			->where('account_id', $data['ledger_id'])
							->order_by('created_date', 'DESC')
							->get();
			return $query->result_array();
		}	
	}
	
	public function fecthAllDatabyID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesorder')
								->where('id', $id)
				    			// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])	
								->get();
			return $query->row_array();
		}else{

		    $query = $this->db->select('*')
							->from('wo_salesorder')
							->where('id', $id)
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
			$update = $this->db->update('wo_salesorder', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_salesorder');
	}
	
	public function createQty($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_salesorderqty', $data);
			return ($create == true) ? true : false;
		}
	}

	public function fecthQtyDataForSalesOrder($id='')
	{
		$query = $this->db->select('wo_salesorderqty.*, wo_product.product_code, wo_productionproduct.jobsheet_no, wo_productionproduct.status')
							->from('wo_salesorderqty')
		    				// ->where(['wo_salesorderqty.company_id' => $this->session->userdata['wo_company'], 'wo_salesorderqty.store_id' => $this->session->userdata['wo_store']])
							->where('wo_salesorderqty.salesorder_id', $id)
							->join('wo_product', 'wo_product.id = wo_salesorderqty.sku', 'left')
							->join('wo_productionproduct', 'wo_productionproduct.id = wo_salesorderqty.jobsheet_id', 'left')
							->get();
		return $query->result();
	}
	
// 	by order id
	public function fecthQtyData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesorderqty')
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('salesorder_id', $id)
								->get();
			return $query->result();
		}else{
			
			$query = $this->db->select('*')
							->from('wo_salesorderqty')
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('salesorder_id', $id)
							->get();
			return $query->result();
		}
	}
	
	public function fetchQtyDataById($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesorderqty')
			    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('id', $id)
								->get();
			return $query->row_array();
		}else{

		    $query = $this->db->select('*')
							->from('wo_salesorderqty')
		    				// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('id', $id)
							->get();
			return $query->row_array();
		}
	}
	
	public function fetchQtyDataByJobId($jobid='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_salesorderqty')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('jobsheet_id', $jobid)
								->get();
			return $query->row_array();
			
		}else{

		    $query = $this->db->select('*')
							->from('wo_salesorderqty')
							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('jobsheet_id', $jobid)
							->get();
			return $query->row_array();
		}
	}
	
	public function updateQty($data=array())
	{
	    if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_salesorderqty', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function deleteQtyByOrderiD($order_id='')
	{
	    $this->db->where('salesorder_id', $order_id);
		return $result=$this->db->delete('wo_salesorderqty');    
	}
	
	public function deleteQty($id='')
	{
	    $this->db->where('id', $id);
		return $result=$this->db->delete('wo_salesorderqty');   
	}
	
	public function makepayment($data=array())
	{
	   	if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_salesorderpayment', $data);
			// return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fetchPaymentDataById($order_id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		   	$query = $this->db->select('*')
								->from('wo_salesorderpayment')
				    			// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('salesorder_id', $order_id)
								->get();
			return $query->row_array();
		}else{

		   	$query = $this->db->select('*')
							->from('wo_salesorderpayment')
			    			// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('salesorder_id', $order_id)
							->get();
			return $query->row_array();
		}
	}

	public function fecthConversionData($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
									->from('wo_salesinvoicedata')
									// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
									->where(['inventory_id' => $data['inventory_id'], 'inventory_type' => $data['inventory_type'] ])
									->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
								->from('wo_salesinvoicedata')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where(['inventory_id' => $data['inventory_id'], 'inventory_type' => $data['inventory_type'] ])
								->get();
			return $query->result_array();
		}
	}
	

}