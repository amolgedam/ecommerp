<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_unit extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function fecthAllCategoryData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_unitcategory')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
								->get();
			return $query->result();
		}else{

			$query = $this->db->select('*')
								->from('wo_unitcategory')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
								->get();
			return $query->result();
		}
	}

    public function createUnitCat($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_unitcategory', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function createUnit($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_unit', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthUnitDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_unit')
								// ->where(['wo_unit.company_id' => $this->session->userdata['wo_company'], 'wo_unit.store_id' => $this->session->userdata['wo_store']])
								->where('id', $id)
								->get();
			return $query->row_array();
		}else{
			$query = $this->db->select('*')
								->from('wo_unit')
								// ->where(['wo_unit.company_id' => $this->session->userdata['wo_company'], 'wo_unit.store_id' => $this->session->userdata['wo_store']])
								->where('id', $id)
								->get();
			return $query->row_array();
		}
	}
	
    public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('wo_unit.id, wo_unit.unit_cat_id as cat_id, wo_unit.conversion, wo_unit.unit, wo_unitcategory.unit_cat_name as cat_name')
								->from('wo_unit')
								// ->where(['wo_unit.company_id' => $this->session->userdata['wo_company'], 'wo_unit.store_id' => $this->session->userdata['wo_store']])
								->join('wo_unitcategory', 'wo_unitcategory.id = wo_unit.unit_cat_id', 'left')
								->get();
			return $query->result();
		}else{
			$query = $this->db->select('wo_unit.id, wo_unit.unit_cat_id as cat_id, wo_unit.conversion, wo_unit.unit, wo_unitcategory.unit_cat_name as cat_name')
							->from('wo_unit')
							// ->where(['wo_unit.company_id' => $this->session->userdata['wo_company'], 'wo_unit.store_id' => $this->session->userdata['wo_store']])
							->join('wo_unitcategory', 'wo_unitcategory.id = wo_unit.unit_cat_id', 'left')
							->get();
			return $query->result();
		}
	}
	
	public function updateUnit($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_unit', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function deleteUnit($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_unit');
	}

	public function fetchByUnitCatID($id='')
	{
		$query = $this->db->select('*')
							->from('wo_unit')
							->where('unit_cat_id', $id)
							->get();
		return $query->row_array();
	}

}