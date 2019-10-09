<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Model_production extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_productionproduct')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}
	
    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_productionproduct', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('id', 'DESC')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('id', 'DESC')
    							->get();
    		return $query->result_array();
	    }
	}


	public function fecthDateByJobsheetDate($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where(['wo_productionproduct.company_id' => $this->session->userdata['wo_company'], 'wo_productionproduct.store_id' => $this->session->userdata['wo_store']])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->order_by('jobsheet_no')
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthDateByJobsheetDateSubcat($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('p_scate', $data['subcategory_id'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->order_by('jobsheet_no')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where(['wo_productionproduct.company_id' => $this->session->userdata['wo_company'], 'wo_productionproduct.store_id' => $this->session->userdata['wo_store']])
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('p_scate', $data['subcategory_id'])
    							->where(['wo_productionproduct.company_id' => $this->session->userdata['wo_company'], 'wo_productionproduct.store_id' => $this->session->userdata['wo_store']])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->order_by('jobsheet_no')
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthDateByJobsheetData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->order_by('jobsheet_no')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where(['wo_productionproduct.company_id' => $this->session->userdata['wo_company'], 'wo_productionproduct.store_id' => $this->session->userdata['wo_store']])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthDateByJobsheetDateEmp($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('wo_productionservices.assign_work', $data['ledger_id'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->order_by('jobsheet_no')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where(['wo_productionproduct.company_id' => $this->session->userdata['wo_company'], 'wo_productionproduct.store_id' => $this->session->userdata['wo_store']])
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('wo_productionservices.assign_work', $data['ledger_id'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthDateByJobsheetDateStatus($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('status', $data['status'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->order_by('jobsheet_no')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where(['wo_productionproduct.company_id' => $this->session->userdata['wo_company'], 'wo_productionproduct.store_id' => $this->session->userdata['wo_store']])
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('status', $data['status'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthDateByJobsheetDateSubEmp($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('p_scate', $data['subcategory_id'])
    							->where('wo_productionservices.assign_work', $data['ledger_id'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->order_by('jobsheet_no')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where(['wo_productionproduct.company_id' => $this->session->userdata['wo_company'], 'wo_productionproduct.store_id' => $this->session->userdata['wo_store']])
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('p_scate', $data['subcategory_id'])
    							->where('wo_productionservices.assign_work', $data['ledger_id'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthDateByJobsheetDateEmpStatus($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('wo_productionservices.assign_work', $data['ledger_id'])
    							->where('status', $data['status'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->order_by('jobsheet_no')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where(['wo_productionproduct.company_id' => $this->session->userdata['wo_company'], 'wo_productionproduct.store_id' => $this->session->userdata['wo_store']])
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('wo_productionservices.assign_work', $data['ledger_id'])
    							->where('status', $data['status'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthDateByJobsheetDateSubStatus($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('p_scate', $data['subcategory_id'])

    							->where('status', $data['status'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->order_by('jobsheet_no')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where(['wo_productionproduct.company_id' => $this->session->userdata['wo_company'], 'wo_productionproduct.store_id' => $this->session->userdata['wo_store']])
    							->where('jobsheetdate >=', $data['from'])
    							->where('jobsheetdate <=', $data['to'])
    							->where('p_scate', $data['subcategory_id'])

    							->where('status', $data['status'])
    							->join('wo_productionservices' , 'wo_productionservices.production_id = wo_productionproduct.id')
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthOpenJobsData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_productionproduct')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('status', 'Open')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('status', 'Open')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fecthAllDatabyID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_productionproduct')
    							->where('id', $id)
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
			$update = $this->db->update('wo_productionproduct', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_productionproduct');
	}

	public function createMaterial($data=array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_productionmaterial', $data);
           return $this->db->insert_id();
		}
	}

	public function fecthAllMaterialData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_productionmaterial')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->get();
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_productionmaterial')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->get();
    		return $query->result_array();
	    }
	}

    public function fecthMaterial($data=array())
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_productionmaterial')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                ->get();
            return $query->result_array();
        }else{
            $query = $this->db->select('*')
                                ->from('wo_productionmaterial')
                                // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                ->get();
            return $query->result_array();
        }
    }
	
	public function fecthMaterialDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_productionmaterial')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_productionmaterial')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->get();
    		return $query->row_array();
	    }
	}

    public function fecthMaterialByID($id='')
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_productionmaterial')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('production_id', $id)
                                // ->where('production_type', 'production')
                                ->get();
            return $query->row_array();
        }else{
            $query = $this->db->select('*')
                                ->from('wo_productionmaterial')
                                // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('production_id', $id)
                                // ->where('production_type', 'production')
                                ->get();
            return $query->row_array();
        }
    }

	public function fecthAllReadymadeMeasurementData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_productionmeasurementreadymade')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->get();
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_productionmeasurementreadymade')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->get();
    		return $query->result_array();
	    }
	}

    public function fecthAllReadymadeData($data=array())
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_productionmeasurementreadymade')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                ->get();
            return $query->result_array();
        }else{
            $query = $this->db->select('*')
                                ->from('wo_productionmeasurementreadymade')
                                // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                ->get();
            return $query->result_array();
        }
    }

	public function deleteMaterialByPID($id='', $ptype='')
	{
		$this->db->where('production_id', $id);
		$this->db->where('production_type', $ptype);
		return $result=$this->db->delete('wo_productionmaterial');
	}

	public function createMeasurementReadymade($data=array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_productionmeasurementreadymade', $data);
           return $this->db->insert_id();
		}
	}
	
	
	public function createMeasurement($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_productionmeasurement', $data);
           return $this->db->insert_id();
		}
	}

	public function deleteMeasurementReadymade($id='', $ptype='')
	{
		$this->db->where('production_id', $id);
		$this->db->where('production_type', $ptype);
		return $result=$this->db->delete('wo_productionmeasurementreadymade');
	}
	
	public function deleteMeasurement($id = "", $ptype='')
	{
		$this->db->where('production_id', $id);
		$this->db->where('production_type', $ptype);

		return $result=$this->db->delete('wo_productionmeasurement');
	}
    
    public function updateMeasurement($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('production_id', $data['production_id']);
			$this->db->where('production_type', $data['production_type']);
			$update = $this->db->update('wo_productionmeasurement', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function fecthAllMeasurementData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionmeasurement')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_productionmeasurement')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }
	}

    public function fecthMeasurementData($data=array())
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_productionmeasurement')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                ->order_by('created_date', 'DESC')
                                ->get();
            return $query->row_array();
        }else{
            $query = $this->db->select('*')
                                ->from('wo_productionmeasurement')
                                // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                ->order_by('created_date', 'DESC')
                                ->get();
            return $query->row_array();
        }
    }
	
	public function createDescription($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_productiondescription', $data);
           return $this->db->insert_id();
		}
	}
	
	public function deleteDescription($id = "", $ptype='')
	{
		$this->db->where('production_id', $id);
		$this->db->where('production_type', $ptype);
		return $result=$this->db->delete('wo_productiondescription');
	}
	
    public function updatedescriptionData($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('production_id', $data['production_id']);
			$this->db->where('production_type', $data['production_type']);
			$update = $this->db->update('wo_productiondescription', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function fecthAllDescriptionData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productiondescription')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_productiondescription')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'production')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }
	}

    public function fecthDescription($data=array())
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_productiondescription')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                ->order_by('created_date', 'DESC')
                                ->get();
            return $query->row_array();
        }else{
            $query = $this->db->select('*')
                                ->from('wo_productiondescription')
                                // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                ->order_by('created_date', 'DESC')
                                ->get();
            return $query->row_array();
        }
    }
	


	// services
	public function createServices($data=array())
	{
	    if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_productionservices', $data);
           return $this->db->insert_id();
		}
	}
	
	
	
	public function insertServices()
	{
	    // print_r($_POST);
	   $gst = $this->model_gst->fetchAllDataByID($_POST['gst_type']);
	   
	   $price = $_POST['unit'] *$_POST['quality'];
	   
	   $tgst = ($gst['sgst'] + $gst['cgst'] + $gst['igst']) / 100;
	   $amount = ($price * $tgst);
	   $gst_amount = $price + $amount;
	  
	   $data = array(
	                'job_no'  => $_POST['jobno'],
	                'service_type' => $_POST['service_type'],
	                'assign_work' => $_POST['assign_work'],
	                'quantity' => $_POST['quality'],
	                'rate' => $_POST['unit'],
	                'gst' => $_POST['gst_type'],
	                'gst_amount' => $gst_amount,
	                'production_type' => 'production',
	                'company_id' => $this->session->userdata('wo_company'),
					// 'city_id' => $this->session->userdata('wo_city'),
					'store_id' => $this->session->userdata('wo_store'),
					'created_by' => $this->session->userdata('wo_id')
	       );
        
        // print_r($data); exit;
		$this->db->set('created_date','NOW()', FALSE);
			
	    $result=$this->db->insert('wo_productionservices',$data);	
		return $result;
	}

	public function fecthServicesByJobId($jobno='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('wo_productionservices.id, wo_productionservices.service_type, wo_productionservices.assign_work, wo_productionservices.quantity, wo_productionservices.rate, wo_productionservices.gst_amount, wo_ledger.id, wo_ledger.ledger_name, wo_servicetype.id as sid, wo_servicetype.service_name, wo_gst.gst_name')
    							->from('wo_productionservices')
    							->where('job_no', $jobno)
    							->where('production_type', 'production')
    							// ->where(['wo_productionservices.company_id' => $this->session->userdata['wo_company']])
    							->join('wo_servicetype', 'wo_servicetype.id = wo_productionservices.service_type', 'left')
    							->join('wo_gst', 'wo_gst.id = wo_productionservices.gst', 'left')
    							->join('wo_ledger', 'wo_ledger.id = wo_productionservices.assign_work', 'left')
    							->get();
    		return $query->result();
	    }else{
	        $query = $this->db->select('wo_productionservices.id, wo_productionservices.service_type, wo_productionservices.assign_work, wo_productionservices.quantity, wo_productionservices.rate, wo_productionservices.gst_amount, wo_ledger.id, wo_ledger.ledger_name, wo_servicetype.id as sid, wo_servicetype.service_name, wo_gst.gst_name')
    							->from('wo_productionservices')
    							->where('job_no', $jobno)
    							->where('production_type', 'production')
    							// ->where(['wo_productionservices.company_id' => $this->session->userdata['wo_company'], 'wo_productionservices.store_id' => $this->session->userdata['wo_store']])
    							->join('wo_servicetype', 'wo_servicetype.id = wo_productionservices.service_type', 'left')
    							->join('wo_gst', 'wo_gst.id = wo_productionservices.gst', 'left')
    							->join('wo_ledger', 'wo_ledger.id = wo_productionservices.assign_work', 'left')
    							->get();
    		return $query->result();
	    }
	}
	
	public function fecthServicesByProductId($pid='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'production')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'production')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}

    public function fecthServices($data=array())
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_productionservices')
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->get();
            return $query->result();
        }else{
            $query = $this->db->select('*')
                                ->from('wo_productionservices')
                                ->where('production_id', $data['id'])
                                ->where('production_type', $data['type'])
                                // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->get();
            return $query->result();
        }
    }

	public function fecthServicesByPId($pid='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'production')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else{
	         $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'production')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fecthServicesByProductIdAssignWork($pid='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'production')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->group_by('assign_work')
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'production')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->group_by('assign_work')
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function updateService($data=array())
	{
	    if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('job_no', $data['job_no']);
			$this->db->where('production_type', 'production');
			$update = $this->db->update('wo_productionservices', $data);
			return ($update == true) ? true : false;
		}   
	}
	
	public function deleteServicesByPID($id = "", $ptype='')
	{
		$this->db->where('production_id', $id);
		$this->db->where('production_type', $ptype);

		return $result=$this->db->delete('wo_productionservices');
	}
	
	public function deleteServices($id='')
	{
	    $id=$this->input->post('id');
		$this->db->where('id', $id);
		$this->db->where('production_type', 'production');
		$result=$this->db->delete('wo_productionservices');
		return $result;
	}

    public function fecthOrderData($data=array())
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_inventoryopeningitem')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where(['order_id' => $data['order_id'], 'inventory_type' => $data['ordertype']])
                                ->get();
            return $query->row_array(); 
        }else{
            $query = $this->db->select('*')
                                ->from('wo_inventoryopeningitem')
                                // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where(['order_id' => $data['order_id'], 'inventory_type' => $data['ordertype']])
                                ->get();
            return $query->row_array(); 
        }
    }


}