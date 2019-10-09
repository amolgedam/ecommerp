<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_salesexchange extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
    public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('sales_exchange')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('sales_exchange', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fecthAllData()
	{
	    $query = $this->db->select('*')
							->from('sales_exchange')
							->order_by('created_date', 'desc')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->result_array();
	}

	public function fecthAllDataByDate($data=array())
	{
	    $query = $this->db->select('*')
							->from('sales_exchange')
							->order_by('created_date', 'desc')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('date >=', $data['from'])
							->where('date <=', $data['to'])
							->get();
		return $query->result_array();
	}
	
	public function fecthAllDataBetweenDate($data=array())
	{
	    $query = $this->db->select('*')
							->from('sales_exchange')
							->order_by('created_date', 'desc')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('date >=', $data['from'])
							->where('date <=', $data['to'])
							->get();
		return $query->result_array();
	}
	
	public function fecthAllDataByID($id='')
	{
	    $query = $this->db->select('*')
							->from('sales_exchange')
							->where('id', $id)
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->row_array();
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('sales_exchange', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('sales_exchange');
	} 

	// Item Data
	public function fecthAllItemData($data=array())
	{
		$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $data['inventory_id'])
							->where('inventory_type', $data['inventory_type'])
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							// ->where('sales_exchange', $data['sales_exchange'])
							->get();
		return $query->result_array();
	}
 
	public function fecthAllItemDataByIdTypeGST($data=array())
	{
		$query = $this->db->select('*')
							->from('wo_salesinvoicedata')
							->where('inventory_id', $data['inventory_id'])
							->where('inventory_type', $data['inventory_type'])
							->where('gst', $data['gst_id'])
							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->result_array();
	}

}