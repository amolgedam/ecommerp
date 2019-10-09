<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ledger extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_ledger', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function createLedger($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_ledger', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result_array();
	    }
	}

    public function fecthAllData1()
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->order_by('ledger_name', 'asc')
                                ->get();
            return $query->result();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->order_by('ledger_name', 'asc')
                                ->get();
            return $query->result();
        }
    }


	// for Customer, Employee and Supplier Data By Type id
	public function fecthDataByType()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('ledgettype_id', '5')
    							->or_where('ledgettype_id', '6')
    							->or_where('ledgettype_id', '7')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('ledgettype_id', '5')
    							->or_where('ledgettype_id', '6')
    							->or_where('ledgettype_id', '7')
    							->get();
    		return $query->result_array();
	    }
	}

    public function fecthContactLedgerDataByType()
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('ledgettype_id !=', '8')
                                ->get();
            return $query->result_array();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('ledgettype_id !=', '8')
                                ->get();
            return $query->result_array();
        }
    }
	
	public function fecthLedger()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}

	public function getLedgerGroupReport($data=array())
	{
		$query = $this->db->select('*')
							->from('wo_ledger')
							->where('acate_id', $data['acate_id'])
							->where('asubcate_id', $data['asubcate_id'])
							->get();
		return $query->result_array();
	}

	public function fecthDataByID($id='')
	{
        // echo $id; exit();
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else
	    {
            // echo $id; exit();
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fecthDataByID1($id='')
	{
        
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    
	}

    public function fecthDataByName($column_name='', $data='')
    {
        // echo "<pre>"; print_r($column_name); print_r($data); exit();
        // check unique data
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where($column_name, $data)
                                ->get();
            return $query->row_array();
        
    }


    public function fetchPurchaseSalesAccount()
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('acate_id', '42')
                                ->or_where('acate_id', '44')
                                ->order_by('ledger_name', 'asc')
                                ->get();
            return $query->result();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where(['acate_id' => '42'])
                                ->or_where(['acate_id' => '44'])
                                ->order_by('ledger_name', 'asc')
                                ->get();
            return $query->result();
        }
    }
	
    //  Ledger Data for purchasr order
    // only category is puchase and sales
	public function fecthLedgerPurAccount()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('acate_id', '2')
    							->or_where('acate_id', '3')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('acate_id', '2')
    							->or_where('acate_id', '3')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
	    }
	}
	
	//  Ledger Data for purchasr order
    // only category is puchase and sales
	public function fecthLedgerAccount()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('ledgettype_id !=', '8')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('ledgettype_id !=', '8')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
	    }
	}
	
    // Fetch not other data 	
	public function fecthLedgerAccountData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('ledgettype_id !=', '8')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('ledgettype_id !=', '8')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
	    }
	}
	
// 	fetch salesman data
    public function fecthLedgerSalesmanData()
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('ledgettype_id =', '7')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
        }else
        {
            $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('ledgettype_id =', '7')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
        }
    }

    public function ledgerCatType($id)
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('acate_id', $id)
                                ->get();
            return $query->result_array();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('acate_id', $id)
                                ->get();
            return $query->result_array();
        }
    }

    public function fecthTaxeAndDutiesData()
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('acate_id =', '43')
                                ->order_by('ledger_name', 'asc')
                                ->get();
            return $query->result();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_ledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('acate_id =', '43')
                                ->order_by('ledger_name', 'asc')
                                ->get();
            return $query->result();
        }
    }
	
	//  Ledger Data for purchasr order
    // only category is puchase, sales and vat
	public function ledgerPurType()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('acate_id', '4')
    							->or_where('acate_id', '5')
    							->or_where('acate_id', '6')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('acate_id', '4')
    							->or_where('acate_id', '5')
    							->or_where('acate_id', '6')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
	    }
	}

	// only category is puchase, sales and vat
	public function fetchEmployee()
	{
        if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('ledgettype_id', '6')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
        }else
        {
            $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('ledgettype_id', '6')
    							->order_by('ledger_name', 'asc')
    							->get();
    		return $query->result();
        }
	}
	
// 	public function ledgerPurType()
// 	{
// 	    $query = $this->db->select('*')
// 							->from('wo_ledger')
// 							->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
// 							->where('acate_id', '19')
// 							->order_by('ledger_name', 'asc')
// 							->get();
// 		return $query->result();
// 	}
	
	public function fecthAllDatabyID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where('id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where('id', $id)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}

	public function fecthAllDatabyName($ledger_name)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where('ledger_name', $ledger_name)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where('ledger_name', $ledger_name)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	 
	public function fetchLedgerDataByLedgertype($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where('ledgettype_id', $id)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }else
	    {
	         $query = $this->db->select('*')
    							->from('wo_ledger')
    							->where('ledgettype_id', $id)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fetchLedgerDataNotOther($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_ledger')
							->where('ledgettype_id !=', $id)
							->get();
		return $query->result_array();
	}

	public function fetchGroupLedgerReport($data=array())
	{
		$query = $this->db->select('*')
							->from('wo_ledgerentries')
							->where('fomledger_id', $data['ledger_id'])
							->or_where('toledger_id', $data['ledger_id'])
							// ->where('created_date BETWEEN "'. date('Y-m-d', strtotime($data['from'])). '" and "'. date('Y-m-d', strtotime($data['to'])).'"')
							->order_by('created_date', 'asc')
							->get();
		return $query->row_array();
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_ledger', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_ledger');
	}

}