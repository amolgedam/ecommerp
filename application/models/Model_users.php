<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function create($data = array())
	{
        if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_users', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthAllDataforSuperadmin()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('wo_users.id, wo_users.username, wo_users.email, wo_users.phone, wo_users.fname, wo_users.lname, wo_role.role_name')
								->from('wo_users')
								->where('wo_role.id', 8)
								// ->where(['wo_users.company_id' => $this->session->userdata['wo_company'], 'wo_users.store_id' => $this->session->userdata['wo_store']])
								->join('wo_role', 'wo_role.id = wo_users.role_id', 'left')
								->get();
			return $query->result();
		}else{

			$query = $this->db->select('wo_users.id, wo_users.username, wo_users.email, wo_users.phone, wo_users.fname, wo_users.lname, wo_role.role_name')
								->from('wo_users')
								->where('wo_role.id', 8)
								->where(['wo_users.company_id' => $this->session->userdata['wo_company'], 'wo_users.store_id' => $this->session->userdata['wo_store']])
								->join('wo_role', 'wo_role.id = wo_users.role_id', 'left')
								->get();
			return $query->result();
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('wo_users.id, wo_users.username, wo_users.email, wo_users.phone, wo_users.fname, wo_users.lname, wo_role.role_name')
								->from('wo_users')
								->where('wo_users.id !=', 1)
								// ->where(['wo_users.company_id' => $this->session->userdata['wo_company'], 'wo_users.store_id' => $this->session->userdata['wo_store'])
								->join('wo_role', 'wo_role.id = wo_users.role_id', 'left')
								->get();
			return $query->result();
		}else{

		    $query = $this->db->select('wo_users.id, wo_users.username, wo_users.email, wo_users.phone, wo_users.fname, wo_users.lname, wo_role.role_name')
							->from('wo_users')
							->where('wo_users.id !=', 1)
							->where(['wo_users.company_id' => $this->session->userdata['wo_company'], 'wo_users.store_id' => $this->session->userdata['wo_store']])
							->join('wo_role', 'wo_role.id = wo_users.role_id', 'left')
							->get();
			return $query->result();
		}
	}

	public function fecthUserData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_users')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->where('id', $id)
								->get();
			return $query->row_array();
		}else{

		    $query = $this->db->select('*')
							->from('wo_users')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('id', $id)
							->get();
			return $query->row_array();
		}
	}
	
	public function fecthUserDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_users')
								->where('id', $id)
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->row_array();
		}else{
		    $query = $this->db->select('*')
							->from('wo_users')
							->where('id', $id)
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->row_array();
		}
	}
	
	public function fecthUserDataByIDPass($id='', $pass)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_users')
								->where('id', $id)
								->where('password', $pass)
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->row_array();
		}else{

		    $query = $this->db->select('*')
							->from('wo_users')
							->where('id', $id)
							->where('password', $pass)
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
			$update = $this->db->update('wo_users', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_users');
	}

	public function deleteByLedgerId($id='')
	{
		$this->db->where('ledger_id', $id);
		return $result=$this->db->delete('wo_users');
	}
	
}