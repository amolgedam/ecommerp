<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_store extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_store', $data);
			return ($create == true) ? true : false;
		}
	}

	public function fecthAllStores()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_store')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
								->get();
			return $query->result_array();
		}else{
			$query = $this->db->select('*')
								->from('wo_store')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
								->get();
			return $query->result_array();
		}
	}
	
	public function fecthAllStoresData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_store')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
								->get();
			return $query->result_array();
		}else{
			$query = $this->db->select('*')
							->from('wo_store')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
							->get();
			return $query->result_array();
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('wo_store.company_id , wo_store.id, wo_store.store_id, wo_store.country_id, wo_store.city_id, wo_store.store_id, wo_store.store_name, wo_store.landline_no, wo_store.address, wo_store.email, wo_store.country_id, wo_store.city_id, wo_country.country_name, wo_city.city_name')
								->from('wo_store')
									// ->where(['wo_store.company_id' => $this->session->userdata['wo_company'], 'wo_store.store_id' => $this->session->userdata['wo_store']  ])
								->join('wo_country', 'wo_country.id = wo_store.country_id', 'left')
					            ->join('wo_city', 'wo_city.id = wo_store.city_id', 'left')
					            ->order_by('store_name')
								->get();
			return $query->result();
		}else{
			$query = $this->db->select('wo_store.company_id , wo_store.id, wo_store.store_id, wo_store.country_id, wo_store.city_id, wo_store.store_id, wo_store.store_name, wo_store.landline_no, wo_store.address, wo_store.email, wo_store.country_id, wo_store.city_id, wo_country.country_name, wo_city.city_name')
							->from('wo_store')
								->where(['wo_store.company_id' => $this->session->userdata['wo_company'], 'wo_store.store_id' => $this->session->userdata['wo_store']  ])
							->join('wo_country', 'wo_country.id = wo_store.country_id', 'left')
				            ->join('wo_city', 'wo_city.id = wo_store.city_id', 'left')
					            ->order_by('store_name')
				            
							->get();
			return $query->result();
		}
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_store', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_store');
	}
	
	public function fetchStoreByCityID($id='')
	{
	    if($id)
	    {
	        $query = $this->db->select('wo_store.id, wo_store.store_name')
							->from('wo_store')
							->where('wo_city.id', $id)
							->join('wo_city', 'wo_city.id = wo_store.city_id', 'left')
							->get();
		    return $query->result();
	    }
	}
	
	public function fetchStoreByCompanyID($company_id='')
	{
	    if($company_id)
	    {
	        $query = $this->db->select('*')
							->from('wo_store')
							->where('company_id', $company_id)
							->get();
		    return $query->result();
	    }
	}

}