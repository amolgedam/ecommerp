<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_supplier extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_supplier', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_supplier')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
								->order_by('created_date', 'desc')
								->get();
			return $query->result_array();
		}else{

		    $query = $this->db->select('*')
							->from('wo_supplier')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
							->order_by('created_date', 'desc')
							->get();
			return $query->result_array();
		}
	}
	
	public function getDataByID($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_supplier')
							->where('id', $id)
							->get();
		return $query->row_array();
	}

	public function getDataByLedgerID($ledger_id='')
	{
	    $query = $this->db->select('*')
							->from('wo_supplier')
							->where('ledger_id', $ledger_id)
							->get();
		return $query->row_array();
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_supplier', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_supplier');
	}

	public function deleteByLedgerID($ledger_id='')
	{
		$this->db->where('ledger_id', $ledger_id);
		return $result=$this->db->delete('wo_supplier');	
	}

}