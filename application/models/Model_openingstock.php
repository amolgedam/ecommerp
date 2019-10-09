<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_openingstock extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_inventoryopening')
	                        ->order_by('id', 'desc')
	                        ->limit(1)
	                        ->get();
	   return $query->row_array();
	}
	
	public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_inventoryopening', $data);
// 			return ($create == true) ? true : false;
            return $this->db->insert_id();
		}
	}
	
    public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventoryopening')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('created_date', 'desc')
    							->get();
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_inventoryopening')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->order_by('created_date', 'desc')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fecthAllDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_inventoryopening')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_inventoryopening')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_inventoryopening', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_inventoryopening');
	}
    
    public function fetchStckoItemDataByOrderId($id)
    {
        $query = $this->db->select('*')
							->from('wo_inventoryopeningitem')
        					->where('order_id', $id)
        					->get();
        return $query->result();
    }

    public function fetchStckoItemByOrderIdType($data=array())
    {
        $query = $this->db->select('*')
							->from('wo_inventoryopeningitem')
        					->where('order_id', $data['order_id'])
        					->where('inventory_type', $data['order_name'])
        					->get();
        return $query->result_array();
    }

    public function fetchStckoItemDataByOrderIdTypeCode($data=array())
    {
    	$query = $this->db->select('*')
							->from('wo_inventoryopeningitem')
        					->where('order_id', $data['order_id'])
        					->where('inventory_type', $data['order_name'])
        					->where('order_code', $data['order_code'])
        					->get();
        return $query->row_array();	
    }

    public function fetchStckoItemDataByOrderIdType($data=array())
    {
        $query = $this->db->select('*')
							->from('wo_inventoryopeningitem')
        					->where('order_id', $data['order_id'])
        					->where('inventory_type', $data['order_name'])
        					->get();
        return $query->row_array();
    }


    public function fetchStckoItemDataById($id)
    {
//         $query = $this->db->select('*')
// 							->from('wo_purchaseorderitem')
// 							->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
// 							->where('order_id', $id)
// 							->where('order_name', 'opening_stock')
// 							->get();
// 		return $query->result_array();
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('wo_inventoryopeningitem.id, wo_inventoryopeningitem.order_id, wo_inventoryopeningitem.quality as quantity, wo_inventoryopeningitem.base_price, wo_inventoryopeningitem.mrp, wo_inventoryopeningitem.wspp, wo_product.product_code  ')
    							->from('wo_inventoryopeningitem')
    							// ->where(['wo_inventoryopeningitem.company_id' => $this->session->userdata['wo_company']])
    							->where('wo_inventoryopeningitem.order_id', $id)
    							->where('wo_purchaseorderitem.order_name', 'opening_stock')
    							->join('wo_product', 'wo_product.id = wo_inventoryopeningitem.sku')
    							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.order_code = wo_inventoryopeningitem.order_code')
    							->get();
    		return $query->result();
        }else
        {
            $query = $this->db->select('wo_inventoryopeningitem.id, wo_inventoryopeningitem.order_id, wo_inventoryopeningitem.quality as quantity, wo_inventoryopeningitem.base_price, wo_inventoryopeningitem.mrp, wo_inventoryopeningitem.wspp, wo_product.product_code  ')
    							->from('wo_inventoryopeningitem')
    							->where(['wo_inventoryopeningitem.company_id' => $this->session->userdata['wo_company']])
    							->where('wo_inventoryopeningitem.order_id', $id)
    							->where('wo_purchaseorderitem.order_name', 'opening_stock')
    							->join('wo_product', 'wo_product.id = wo_inventoryopeningitem.sku')
    							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.order_code = wo_inventoryopeningitem.order_code')
    							->get();
    		return $query->result();
        }
    }

  //   public function opening_stockDataByID($id='')
  //   {
  //   	 $query = $this->db->select('wo_inventoryopeningitem.id, wo_inventoryopeningitem.order_id, wo_inventoryopeningitem.quality as quantity, wo_inventoryopeningitem.base_price, wo_inventoryopeningitem.mrp, wo_inventoryopeningitem.wspp, wo_product.product_code  ')
		// 					->from('wo_inventoryopeningitem')
		// 					->where(['wo_inventoryopeningitem.company_id' => $this->session->userdata['wo_company'], 'wo_inventoryopeningitem.city_id' => $this->session->userdata['wo_city'], 'wo_inventoryopeningitem.store_id' => $this->session->userdata['wo_store'] ])
		// 					->where('wo_inventoryopeningitem.order_id', $id)
		// 					->where('wo_purchaseorderitem.order_name', 'opening_stock')
		// 					->join('wo_product', 'wo_product.id = wo_inventoryopeningitem.sku')
		// 					->join('wo_purchaseorderitem', 'wo_purchaseorderitem.order_code = wo_inventoryopeningitem.order_code')
		// 					->get();
		// return $query->row_array();
  //   }

}