<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_alternate extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// further process
	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_alternate')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}
	
	public function fecthServicesByPId($pid='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'alterate')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'alterate')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_alternate')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_alternate')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fecthAllDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_alternate')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_alternate')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}

	public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_alternate', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}

	public function update($data=array())
	{
	    if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_alternate', $data);
			return ($update == true) ? true : false;
		}   
	}





	// material
    public function fecthAllMaterialData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_productionmaterial')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'alterate')
    							->get();
    		return $query->result_array();
	    }else
	    {
        	$query = $this->db->select('*')
    							->from('wo_productionmaterial')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'alterate')
    							->get();
    		return $query->result_array();
	    }
	}


	// measurement
	
	public function fecthAllMeasurementData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionmeasurement')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'alterate')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionmeasurement')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'alterate')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }
	}



	// measurement ready made




	// services
	public function insertServices()
	{
	    // print_r($_POST);

	   $gst = $this->model_gst->fetchAllDataByID($_POST['gst_type']);
	   
	   $price = $_POST['unit'] * $_POST['quality'];
	   
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
	                'production_type' => 'alternate',
	                'company_id' => $this->session->userdata('wo_company'),
					// 'city_id' => $this->session->userdata('wo_city'),
					// 'store_id' => $this->session->userdata('wo_store'),
					'created_by' => $this->session->userdata('wo_id')
	       );

		$this->db->set('created_date','NOW()', FALSE);		
	    $result=$this->db->insert('wo_productionservices',$data);	
		return $result;
	}

	public function fecthServicesByJobId($jobno='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('wo_productionservices.id, wo_productionservices.service_type, wo_productionservices.assign_work, wo_productionservices.quantity, wo_productionservices.rate, wo_productionservices.gst_amount, wo_servicetype.service_name, wo_gst.gst_name')
    							->from('wo_productionservices')
    							->where('job_no', $jobno)
    							->where('production_type', 'alternate')
    							// ->where(['wo_productionservices.company_id' => $this->session->userdata['wo_company']])
    							->join('wo_servicetype', 'wo_servicetype.id = wo_productionservices.service_type', 'left')
    							->join('wo_gst', 'wo_gst.id = wo_productionservices.gst', 'left')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('wo_productionservices.id, wo_productionservices.service_type, wo_productionservices.assign_work, wo_productionservices.quantity, wo_productionservices.rate, wo_productionservices.gst_amount, wo_servicetype.service_name, wo_gst.gst_name')
    							->from('wo_productionservices')
    							->where('job_no', $jobno)
    							->where('production_type', 'alternate')
    							->where(['wo_productionservices.company_id' => $this->session->userdata['wo_company'], 'wo_productionservices.store_id' => $this->session->userdata['wo_store']])
    							->join('wo_servicetype', 'wo_servicetype.id = wo_productionservices.service_type', 'left')
    							->join('wo_gst', 'wo_gst.id = wo_productionservices.gst', 'left')
    							->get();
    		return $query->result();
	    }
	}

	

	public function deleteServicesByPID($id = "")
	{
		$this->db->where('production_id', $id);
		$this->db->where('production_type', 'alternate');
		return $result=$this->db->delete('wo_productionservices');
	}

	public function deleteServices($id='')
	{
	    $id=$this->input->post('id');
		$this->db->where('id', $id);
		$this->db->where('production_type', 'alternate');
		$result=$this->db->delete('wo_productionservices');
		return $result;
	}
public function updateService($data=array())
	{
	    if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('job_no', $data['job_no']);
			$this->db->where('production_type', 'alternate');
			$update = $this->db->update('wo_productionservices', $data);
			return ($update == true) ? true : false;
		}   
	}    


	// description

}