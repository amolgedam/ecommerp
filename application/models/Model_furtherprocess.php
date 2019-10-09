<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_furtherprocess extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// further process
	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_furtherprocess')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}

	public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_furtherprocess', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fecthAllDatabyProductionID($productionid='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_furtherprocess')
    							->where('production_id', $productionid)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_furtherprocess')
    							->where('production_id', $productionid)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}

	public function fecthAllDatabyID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_furtherprocess')
    							->where('id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_furtherprocess')
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
			$update = $this->db->update('wo_furtherprocess', $data);
			return ($update == true) ? true : false;
		}
	}

	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_furtherprocess');
	}




	// material
	public function fecthAllMaterialData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_productionmaterial')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'furtherprocess')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionmaterial')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'furtherprocess')
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
    							->where('production_type', 'furtherprocess')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionmeasurement')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'furtherprocess')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }
	}

	// measurement ready made
	public function fecthAllReadymadeMeasurementData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_productionmeasurementreadymade')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'furtherprocess')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionmeasurementreadymade')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'furtherprocess')
    							->get();
    		return $query->result_array();
	    }
	}



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
	                'production_type' => 'furtherprocess',
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
	    $query = $this->db->select('wo_productionservices.id, wo_productionservices.service_type, wo_productionservices.assign_work, wo_productionservices.quantity, wo_productionservices.rate, wo_productionservices.gst_amount, wo_servicetype.service_name, wo_gst.gst_name')
							->from('wo_productionservices')
							->where('job_no', $jobno)
							->where('production_type', 'furtherprocess')
							->where(['wo_productionservices.company_id' => $this->session->userdata['wo_company']])
							->join('wo_servicetype', 'wo_servicetype.id = wo_productionservices.service_type', 'left')
							->join('wo_gst', 'wo_gst.id = wo_productionservices.gst', 'left')
							->get();
		return $query->result();
	}

	public function updateService($data=array())
	{
	    if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('job_no', $data['job_no']);
			$this->db->where('production_type', 'furtherprocess');
			$update = $this->db->update('wo_productionservices', $data);
			return ($update == true) ? true : false;
		}   
	}

	public function deleteServicesByPID($id = "")
	{
		$this->db->where('production_id', $id);
		$this->db->where('production_type', 'furtherprocess');

		return $result=$this->db->delete('wo_productionservices');
	}

	public function deleteServices($id='')
	{
	    $id=$this->input->post('id');
		$this->db->where('id', $id);
		$this->db->where('production_type', 'furtherprocess');
		$result=$this->db->delete('wo_productionservices');
		return $result;
	}

	public function fecthServicesByProductId($pid='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'furtherprocess')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productionservices')
    							->where('production_id', $pid)
    							->where('production_type', 'furtherprocess')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}
    


	// description
	public function fecthAllDescriptionData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_productiondescription')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('production_id', $id)
    							->where('production_type', 'furtherprocess')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_productiondescription')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('production_id', $id)
    							->where('production_type', 'furtherprocess')
    							->order_by('created_date', 'DESC')
    							->get();
    		return $query->row_array();
	    }
	}

}