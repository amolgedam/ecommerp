<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Model_accountcat extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
		    
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_accountcat', $data);
			return ($create == true) ? true : false;
			
		}
	}
	
	public function fecthCatByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		        
    	    $query = $this->db->select('*')
    							->from('wo_accountcat')
    							->where('id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_accountcat')
    							->where('id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	    
	}
	
	public function fecthAllCatData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
	        
    	    $query = $this->db->select('*')
    							->from('wo_accountcat')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('acategories_name', 'asc')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_accountcat')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('acategories_name', 'asc')
    							->get();
    		return $query->result();
	    }
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_accountcat', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		if($id)
		{
		    $this->db->where('id', $id);
		    return $result=$this->db->delete('wo_accountcat');
		}
	}
	
	public function createSubCat($data = array())
	{
	    if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_accountsubcat', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthAllSubCatData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    
    	    $query = $this->db->select('wo_accountsubcat.id, wo_accountsubcat.accountcat_id, wo_accountsubcat.asubcat_name, wo_accountcat.acategories_name')
    							->from('wo_accountsubcat')
    							// ->where(['wo_accountsubcat.company_id' => $this->session->userdata['wo_company']])
    							->join('wo_accountcat', 'wo_accountcat.id = wo_accountsubcat.accountcat_id', 'left')
    							->order_by('wo_accountsubcat.asubcat_name', 'asc')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('wo_accountsubcat.id, wo_accountsubcat.accountcat_id, wo_accountsubcat.asubcat_name, wo_accountcat.acategories_name')
    							->from('wo_accountsubcat')
    							// ->where(['wo_accountsubcat.company_id' => $this->session->userdata['wo_company'], 'wo_accountsubcat.store_id' => $this->session->userdata['wo_store']])
    							->join('wo_accountcat', 'wo_accountcat.id = wo_accountsubcat.accountcat_id', 'left')
    							->order_by('wo_accountsubcat.asubcat_name', 'asc')
    							->get();
    		return $query->result();
	    }
	}
	
	public function fetchSubcatBycateID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('wo_accountsubcat.id, wo_accountsubcat.accountcat_id, wo_accountsubcat.asubcat_name, wo_accountcat.acategories_name')
    							->from('wo_accountsubcat')
    							->where('wo_accountcat.id', $id)
    							// ->where(['wo_accountsubcat.company_id' => $this->session->userdata['wo_company']])
    							->join('wo_accountcat', 'wo_accountcat.id = wo_accountsubcat.accountcat_id', 'left')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('wo_accountsubcat.id, wo_accountsubcat.accountcat_id, wo_accountsubcat.asubcat_name, wo_accountcat.acategories_name')
    							->from('wo_accountsubcat')
    							->where('wo_accountcat.id', $id)
    							// ->where(['wo_accountsubcat.company_id' => $this->session->userdata['wo_company'], 'wo_accountsubcat.store_id' => $this->session->userdata['wo_store']])
    							->join('wo_accountcat', 'wo_accountcat.id = wo_accountsubcat.accountcat_id', 'left')
    							->get();
    		return $query->result();
	    }
	}
	
	public function fecthsubCatByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_accountsubcat')
    							->where('id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_accountsubcat')
    							->where('id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function updateSubCat($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_accountsubcat', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function deleteSubCat($id='')
	{
	    if($id)
		{
		    $this->db->where('id', $id);
		    return $result=$this->db->delete('wo_accountsubcat');
		}
	}

}