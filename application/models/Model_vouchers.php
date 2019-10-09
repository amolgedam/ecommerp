<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_vouchers extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_voucherdata', $data);
			return ($create == true) ? true : false;
            // return $this->db->insert_id();
		}
	}
	
// 	public function fecthAllData()
// 	{
// 	    $query = $this->db->select('*')
// 							->from('wo_purchaseorderinvoice')
// 							->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
// 							->order_by('created_date', 'DESC')
// 							->get();
							
// 		return $query->result_array();
// 	}
	
	public function fecthAllDatabyVoucherID($data=array())
	{
		// print_r($data); exit();
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_voucherdata')
								->where('voucher_id', $data['voucher_id'])
								->where('voucher_type', $data['voucher_type'])
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
								->from('wo_voucherdata')
								->where('voucher_id', $data['voucher_id'])
								->where('voucher_type', $data['voucher_type'])
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->result_array();
		}
	}

	public function fecthAllDatabyVoucherIDTypeGST($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
								->from('wo_voucherdata')
								->where('voucher_id', $data['voucher_id'])
								->where('voucher_type', $data['voucher_type'])
								->where('gst_id', $data['gst_id'])
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->result_array();
		}else{

			$query = $this->db->select('*')
							->from('wo_voucherdata')
							->where('voucher_id', $data['voucher_id'])
							->where('voucher_type', $data['voucher_type'])
							->where('gst_id', $data['gst_id'])
							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result_array();
		}
	}
	
// 	public function fecthAllDatabyOrderNo($id)
// 	{
// 	    $query = $this->db->select('*')
// 							->from('wo_purchaseorderinvoice')
// 							->where('porder_no', $id)
// 							->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
// 							->get();
// 		return $query->row_array();
// 	}
	
	
// 	public function update($data = array())
// 	{
// 		if($data) {
// 		    $this->db->set('modified_date','NOW()', FALSE);
// 			$this->db->where('id', $data['id']);
// 			$update = $this->db->update('wo_purchaseorderinvoice', $data);
// 			return ($update == true) ? true : false;
// 		}
// 	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_voucherdata');
	}

}