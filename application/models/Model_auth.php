<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the email exists in the database
	*/
	public function check_username($username) 
	{
		if($username) {
			$sql = 'SELECT * FROM wo_users WHERE username = ?';
			$query = $this->db->query($sql, array($username));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}

		return false;
	}

	public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_users', $data);
			return ($create == true) ? true : false;
		}
	}

	public function getDataByLedgerID($id='')
	{
		$query = $this->db->select('*')
								->from('wo_users')
								->where('ledger_id', $id)
								->get();
		return $query->row_array();
	}

	public function update($data=array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_users', $data);
			return ($update == true) ? true : false;
		}
	}

	public function deleteByLedgerID($ledger_id='')
	{
		$this->db->where('ledger_id', $ledger_id);
		return $result=$this->db->delete('wo_users');	
	}
	
	/* 
		This function checks if the email and password matches with the database
	*/
	public function login($username, $password) {
	    
		if($username && $password) {
		    
		    $query	= $this->db->select('wo_users.id, wo_users.username, wo_users.fname, wo_users.lname, wo_users.email, wo_users.phone, wo_users.gender, wo_users.active, wo_users.mode, wo_role.id as role_id, wo_role.role_name, wo_users.company_id, wo_users.store_id, wo_users.store_id')
							->from('wo_users')
							->where(['username' => $username, 'password' => md5($password)])
							->join('wo_role', 'wo_role.id = wo_users.role_id', 'left')
							->get();
			return $query->row_array();
			
// 			$sql = "SELECT * FROM users WHERE username = ?";
// 			$query = $this->db->query($sql, array($username));

// 			if($query->num_rows() == 1) {
			    
// 				$result = $query->row_array();

// 				$hash_password = password_verify($password, $result['password']);
				
// 				if($hash_password === true) {
// 					return $result;	
// 				}
// 				else {
// 					return false;
// 				}

// 			}
// 			else {
// 				return false;
// 			}
		}
	}
}