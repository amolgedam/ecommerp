<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_category', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthCatDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_category')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
					            ->where('id', $id)
								->get();
			return $query->row_array();
		}
		else
		{
			$query = $this->db->select('*')
								->from('wo_category')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
					            ->where('id', $id)
								->get();
			return $query->row_array();	
		}
	}

	public function fecthCatDataByID1($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_category')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
					            ->where('id', $id)
					            ->group_by('catgory_name')
								->get();
			return $query->row_array();
		}
		else
		{
			$query = $this->db->select('*')
								->from('wo_category')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
					            ->where('id', $id)
					            ->group_by('catgory_name')
								->get();
			return $query->row_array();	
		}
	}

	public function fecthCatDataByName($name='')
	{
	    // check unique data
		    $query = $this->db->select('*')
								->from('wo_category')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
					            ->where('catgory_name', $name)
								->get();
			return $query->row_array();
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_category')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    				// 			->join('wo_country', 'wo_country.id = wo_category.country_id', 'left')
    				// 			->join('wo_city', 'wo_city.id = wo_category.city_id', 'left')
    				// 			->join('wo_store', 'wo_store.id = wo_category.store_id', 'left')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_category')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    				// 			->join('wo_country', 'wo_country.id = wo_category.country_id', 'left')
    				// 			->join('wo_city', 'wo_city.id = wo_category.city_id', 'left')
    				// 			->join('wo_store', 'wo_store.id = wo_category.store_id', 'left')
    							->get();
    		return $query->result();
	    }
	}
	
	public function fecthAllDataByDivision($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_category')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['division_id' => $id])
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_category')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['division_id' => $id])
    							->get();
    		return $query->result();
	    }
	}
	
	public function fecthAllDataByCatDivId($id='', $div='')
	{
	   // echo $div; exit;
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_category')
    							->where(['id' => $id])
    							->where(['division_id' => $div])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_category')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['id' => $id])
    							->where(['division_id' => $div])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_category', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		if($id)
		{
		    $this->db->where('id', $id);
		    return $result=$this->db->delete('wo_category');
		}
	}
	
	public function createSubCat($data = array())
	{
	    if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_subcategory', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthAllSubCatData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('wo_subcategory.id, wo_subcategory.category_id, wo_subcategory.subcatgory_id, wo_subcategory.subcategory_name, wo_subcategory.status, wo_subcategory.country_id, wo_subcategory.city_id, wo_subcategory.store_id, wo_category.catgory_name')
    							->from('wo_subcategory')
    							// ->where(['wo_subcategory.company_id' => $this->session->userdata['wo_company']])
    							->join('wo_category', 'wo_category.id = wo_subcategory.category_id', 'left')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('wo_subcategory.id, wo_subcategory.category_id, wo_subcategory.subcatgory_id, wo_subcategory.subcategory_name, wo_subcategory.status, wo_subcategory.country_id, wo_subcategory.city_id, wo_subcategory.store_id, wo_category.catgory_name')
    							->from('wo_subcategory')
    							->where(['wo_subcategory.company_id' => $this->session->userdata['wo_company'], 'wo_subcategory.store_id' => $this->session->userdata['wo_store']])
    							->join('wo_category', 'wo_category.id = wo_subcategory.category_id', 'left')
    							->get();
    		return $query->result();
	    }
	}
	
	public function fecthSubCatDataByID($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_subcategory')
							// ->where(['wo_subcategory.company_id' => $this->session->userdata['wo_company'], 'wo_subcategory.city_id' => $this->session->userdata['wo_city'], 'wo_subcategory.store_id' => $this->session->userdata['wo_store']  ])
							->where('id', $id)
							->get();
		return $query->row_array();
	}
	
	public function fecthSubCatByCatID($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_subcategory')
							->where('category_id', $id)
							->get();
		return $query->row_array();
	}
	
	public function fecthSubCatByCatID2($catid='', $subcatid='')
	{
	    $query = $this->db->select('*')
							->from('wo_subcategory')
							->where('category_id', $catid)
							->where('id', $subcatid)
							->get();
		return $query->row_array();
	}

	public function fecthSubCatByCatID1($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_subcategory')
							->where('category_id', $id)
							->get();
		return $query->result_array();
	}

	public function fecthSCatDataByName($name='')
	{
	    // check unique data
		$query = $this->db->select('*')
							->from('wo_subcategory')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
					        ->where('subcategory_name', $name)
							->get();
		return $query->row_array();
	}
	
	public function fecthAllSubCatDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('wo_subcategory.id, wo_subcategory.category_id, wo_subcategory.subcatgory_id, wo_subcategory.subcategory_name, wo_subcategory.country_id, wo_subcategory.city_id, wo_subcategory.store_id, wo_category.catgory_name')
    							->from('wo_subcategory')
    							// ->where(['wo_subcategory.company_id' => $this->session->userdata['wo_company']])
    							->where('wo_category.id', $id)
    							->join('wo_category', 'wo_category.id = wo_subcategory.category_id', 'left')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('wo_subcategory.id, wo_subcategory.category_id, wo_subcategory.subcatgory_id, wo_subcategory.subcategory_name, wo_subcategory.country_id, wo_subcategory.city_id, wo_subcategory.store_id, wo_category.catgory_name')
    							->from('wo_subcategory')
    							// ->where(['wo_subcategory.company_id' => $this->session->userdata['wo_company'], 'wo_subcategory.store_id' => $this->session->userdata['wo_store']])
    							->where('wo_category.id', $id)
    							->join('wo_category', 'wo_category.id = wo_subcategory.category_id', 'left')
    							->get();
    		return $query->result();
	    }
	}
	
	public function updateSubCat($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_subcategory', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function deleteSubCat($id='')
	{
	    if($id)
		{
		    $this->db->where('id', $id);
		    return $result=$this->db->delete('wo_subcategory');
		}
	}

}



