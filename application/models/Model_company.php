<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_company extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function create($data = array())
	{
		if($data) {
			// print_r($data);exit();
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_company', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthAllCompanyData()
	{
		$query = $this->db->select('*')
							->from('wo_company')
				// 			->where(['company_id' => $this->session->userdata['wo_company']])
							->get();
		return $query->result();
	}

	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_company')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_company')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}
	
	public function fecthCompanyData()
	{
		$query = $this->db->select('*')
							->from('wo_company')
							->get();
		return $query->result();
	}

	public function fecthAllDataInLoginPage()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_company')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_company')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}
	
	public function fecthDataByID($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_company')
							->where('id', $id)
							->get();
		return $query->row_array();
	}

	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_company', $data);
			return ($update == true) ? true : false;
		}
	}

	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_company');
	}

}