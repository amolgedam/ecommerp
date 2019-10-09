<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_purchaseitem extends CI_Model
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
			$create = $this->db->insert('wo_purchaseorderdata', $data);
			// return ($create == true) ? true : false;
            return $this->db->insert_id();
			
		}
	} 
	
    public function fecthAllDataByOrderID($id)
	{
        if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('wo_purchaseorderdata.id, wo_purchaseorderdata.order_id, wo_purchaseorderdata.quantity, wo_purchaseorderdata.base_price, wo_purchaseorderdata.mrp_price, wo_purchaseorderdata.wsp_price, wo_product.product_code  ')
    							->from('wo_purchaseorderdata')
    							// ->where(['wo_purchaseorderdata.company_id' => $this->session->userdata['wo_company']])
    							->where('wo_purchaseorderdata.order_id', $id)
    							->where('wo_purchaseorderitem.order_name', 'porder')
    							->join('wo_product', 'wo_product.id = wo_purchaseorderdata.sku_id')
    							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.order_code = wo_purchaseorderdata.order_code')
    							->get();
    		return $query->result();
        }else{
            $query = $this->db->select('wo_purchaseorderdata.id, wo_purchaseorderdata.order_id, wo_purchaseorderdata.quantity, wo_purchaseorderdata.base_price, wo_purchaseorderdata.mrp_price, wo_purchaseorderdata.wsp_price, wo_product.product_code  ')
    							->from('wo_purchaseorderdata')
    							->where(['wo_purchaseorderdata.company_id' => $this->session->userdata['wo_company'], 'wo_purchaseorderdata.store_id' => $this->session->userdata['wo_store']])
    							->where('wo_purchaseorderdata.order_id', $id)
    							->where('wo_purchaseorderitem.order_name', 'porder')
    							->join('wo_product', 'wo_product.id = wo_purchaseorderdata.sku_id')
    							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.order_code = wo_purchaseorderdata.order_code')
    							->get();
    		return $query->result();
        }
	}
	
	public function fecthOrderByInvoiceIDType($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
        						// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['order_id' => $data['order_id'], 'ordertype' => $data['ordertype']])
    							->get();
    		return $query->result_array();	
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
        						// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['order_id' => $data['order_id'], 'ordertype' => $data['ordertype']])
    							->get();
    		return $query->result_array();	
	    }
	}
	
	
	public function fecthOrderData($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'ordertype' => $data['ordertype']])
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'ordertype' => $data['ordertype']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	
	public function fecthAllDataByInvoiceID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('wo_purchaseorderdata.id, wo_purchaseorderdata.order_id, wo_purchaseorderdata.quantity, wo_purchaseorderdata.base_price, wo_purchaseorderdata.mrp_price, wo_purchaseorderdata.wsp_price, wo_product.product_code')
    							->from('wo_purchaseorderinvoice')
    							// ->where(['wo_purchaseorderinvoice.company_id' => $this->session->userdata['wo_company']])
    							->where('wo_purchaseorderinvoice.id', $id)
    							->where('wo_purchaseorderitem.order_name', 'pinvoice')
    							->join('wo_purchaseorderdata', 'wo_purchaseorderdata.order_id = wo_purchaseorderinvoice.id')
    							->join('wo_product', 'wo_product.id = wo_purchaseorderdata.sku_id')    							
    							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.order_code = wo_purchaseorderdata.order_code')
    							->get();
    		return $query->result();
	    }else{
	        $query = $this->db->select('wo_purchaseorderdata.id, wo_purchaseorderdata.order_id, wo_purchaseorderdata.quantity, wo_purchaseorderdata.base_price, wo_purchaseorderdata.mrp_price, wo_purchaseorderdata.wsp_price, wo_product.product_code')
    							->from('wo_purchaseorderinvoice')
    							->where(['wo_purchaseorderinvoice.company_id' => $this->session->userdata['wo_company'], 'wo_purchaseorderinvoice.store_id' => $this->session->userdata['wo_store']])
    							->where('wo_purchaseorderinvoice.id', $id)
    							->where('wo_purchaseorderitem.order_name', 'pinvoice')
    							->join('wo_purchaseorderdata', 'wo_purchaseorderdata.order_id = wo_purchaseorderinvoice.id')
    							->join('wo_product', 'wo_product.id = wo_purchaseorderdata.sku_id')    							
    							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.order_code = wo_purchaseorderdata.order_code')
    							->get();
    		return $query->result();
	    }
	}
	
	
	public function fecthItemDataById($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}
	

	
	public function fecthAllDataByID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	   }else{
	       $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	   }
	}

	public function fecthAllDataByOrder_ID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('order_id', $id)
    							->get();
    		return $query->row_array();
	    }else{
	        	$query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('order_id', $id)
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fetchOrderDataBySKUid($skuid='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['sku_id' => $skuid])
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['sku_id' => $skuid])
    							->get();
    		return $query->row_array();
	    }
	}

	public function fetchOrderDataByInvoiceSKUid($invoiceid = '', $skuid='')
	{
	    $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['order_id' => $invoiceid,'sku_id' => $skuid])
    							->get();
    		return $query->row_array();
	    
	}

	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result();
	    }
	}
	
	public function fetchDataByOrderIDCode($order_id, $order_code)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['order_id' => $order_id, 'order_code' => $order_code])
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['order_id' => $order_id, 'order_code' => $order_code])
    							->get();
    		return $query->row_array();
	    }
	}
	
	

	public function fetchStckoItemByOrderIdTypeCode($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'order_name' => $data['order_name']])
    							->get();
    		return $query->row_array();	
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'order_name' => $data['order_name']])
    							->get();
    		return $query->row_array();	
	    }
	}
	
	

	public function fetchStckoItemByOrderIdTypeCodeResult($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'order_name' => $data['order_name']])
    							->get();
    		return $query->result_array();	
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'order_name' => $data['order_name']])
    							->get();
    		return $query->result_array();	
	    }
	}

	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_purchaseorderdata', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function deleteOrderDataByOrderId($order_id = "")
	{
		$this->db->where('order_id', $order_id);
		return $result=$this->db->delete('wo_purchaseorderdata');
	}

	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_purchaseorderdata');
	}
	
	public function createItem($data = array())
	{
		if($data) {
// 			print_r($data);exit();
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_purchaseorderitem', $data);
			// return ($create == true) ? true : false;
            return $this->db->insert_id();
			
		}
	}
	
	public function updateItem($data=array())
	{
	    if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_purchaseorderitem', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function fetchItemDataByID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fetchItemDataByOrderID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('order_id', $id)
    							->get();
    		return $query->result();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('order_id', $id)
    							->get();
    		return $query->result();
	    }
	}

	public function fetchItemByOrderIdName($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('order_id', $data['order_id'])
    							->where('order_name', $data['order_name'])
    							->get();
    		return $query->result_array();
	    }else{
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('order_id', $data['order_id'])
    							->where('order_name', $data['order_name'])
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function deleteItem($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_purchaseorderitem');
	}
	
	public function deleteItemByOrderId($order_id='')
	{
	    $this->db->where('order_id', $order_id);
		return $result=$this->db->delete('wo_purchaseorderitem');
	}

	public function deleteItemByOrderIdName($data=array())
	{
		$this->db->where('order_id', $data['order_id']);
		$this->db->where('order_name', $data['order_name']);
		return $result=$this->db->delete('wo_purchaseorderitem');
	}


	public function fetchStckoItemDataByOrderIdTypeCode($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    								->from('wo_purchaseorderdata')
    								->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'ordertype' => $data['ordertype']])
    								// ->where(['company_id' => $this->session->userdata['wo_company']])
    								->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('*')
    								->from('wo_purchaseorderdata')
    								->where(['order_id' => $data['order_id'], 'order_code' => $data['order_code'], 'ordertype' => $data['ordertype']])
    								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}

	public function sumQty($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('order_id, SUM(quantity) as qty')
    								->from('wo_purchaseorderdata')
    								->where(['order_id' => $data['order_id'], 'ordertype' => $data['ordertype']])
    								// ->where(['company_id' => $this->session->userdata['wo_company']])
    								->get();
    		return $query->row_array();
	    }else{
	        $query = $this->db->select('order_id, SUM(quantity) as qty')
    								->from('wo_purchaseorderdata')
    								->where(['order_id' => $data['order_id'], 'ordertype' => $data['ordertype']])
    								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    								->get();
    		return $query->row_array();
	    }
	}
	
}