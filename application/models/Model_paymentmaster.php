<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_paymentmaster extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_payment', $data);
			// return ($create == true) ? true : false;
			return $this->db->insert_id();
		}
	}
	
    public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('wo_payment.id, wo_payment.payment_name, wo_payment.permission, wo_ledger.ledger_name, wo_ledger.id as ledger_id')
    							->from('wo_payment')
    							// ->where(['wo_payment.company_id' => $this->session->userdata['wo_company']])
    							->join('wo_ledger', 'wo_ledger.id = wo_payment.ledger_id', 'left')
    							->get();
    		return $query->result();
	    }else{
	        $query = $this->db->select('wo_payment.id, wo_payment.payment_name, wo_payment.permission, wo_ledger.ledger_name, wo_ledger.id as ledger_id')
    							->from('wo_payment')
    							->where(['wo_payment.company_id' => $this->session->userdata['wo_company'], 'wo_payment.store_id' => $this->session->userdata['wo_store']])
    							->or_where(['wo_payment.company_id' => 0, 'wo_payment.store_id' => 0])
    							->join('wo_ledger', 'wo_ledger.id = wo_payment.ledger_id', 'left')
    							->get();
    		return $query->result();
	    }
	}

	public function fecthDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    	    					->from('wo_payment')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    	    					->from('wo_payment')
    							// ->where(['wo_payment.company_id' => $this->session->userdata['wo_company'], 'wo_payment.store_id' => $this->session->userdata['wo_store']])
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
			$update = $this->db->update('wo_payment', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_payment');
	}

}