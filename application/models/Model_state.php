<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_state extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function create($data = array())
	{
		if($data) {
// 			print_r($data);exit();
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_country', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fetchStateByID($id='')
	{
	    if($id)
	    {
	        $query = $this->db->select('*')
							->from('wo_city')
							->where('country_id', $id)
							->get();
		return $query->result();
	    }
	}

	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
								->from('wo_country')
								// ->where(['company_id' => $this->session->userdata['wo_company'], '.store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->result();
		}
		else{
			$query = $this->db->select('*')
								->from('wo_country')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->get();
			return $query->result();
		}
	}

	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_country', $data);
			return ($update == true) ? true : false;
		}
	}

	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_country');
	}
	
	public function createCity($data = array())
	{
	    if($data) {
			
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_city', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthAllCityData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('wo_city.id, wo_city.city_name, wo_country.id as state_id, wo_country.country_name')
								->from('wo_city')
					// 			->where(['wo_city.company_id' => $this->session->userdata['wo_company'], 'wo_city.store_id' => $this->session->userdata['wo_store'] ])
								->join('wo_country', 'wo_country.id = wo_city.country_id', 'left')
								->get();
			return $query->result();
		}else{
			$query = $this->db->select('wo_city.id, wo_city.city_name, wo_country.id as state_id, wo_country.country_name')
								->from('wo_city')
								// ->where(['wo_city.company_id' => $this->session->userdata['wo_company'], 'wo_city.store_id' => $this->session->userdata['wo_store'] ])
								->join('wo_country', 'wo_country.id = wo_city.country_id', 'left')
								->get();
			return $query->result();
		}
	}

	public function fecthCityByID($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_city')
							->where('id', $id)
							->get();
		return $query->row_array();
	}
	
	public function updateCity($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_city', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function deleteCity($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_city');
	}
	
	public function fetchCityByCompanyID($id='')
	{
	    if($id)
	    {
	        $query = $this->db->select('wo_city.id, wo_city.city_name')
							->from('wo_city')
							->where('wo_company.id', $id)
							->join('wo_company', 'wo_company.city = wo_city.id', 'left')
							->get();
		    return $query->result();
	    }
	}

}