<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_barcode extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// for item stock
	public function createStock($data=array())
	{
		if($data) {
			// print_r($data);exit();
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_itemsstock', $data);
			// return ($create == true) ? true : false;
			return $this->db->insert_id();
		}
	} 

	public function fetchAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_itemsstock')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_itemsstock')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}

	public function sum_purchaseQty($sku='')
	{
        if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select()
    							->from('wo_items')
    							->where('sku_code', $sku)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
        }else
        {
            $query = $this->db->select()
    							->from('wo_items')
    							->where('sku_code', $sku)
    							->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
        }
	}

	public function sum_availableQty($sku='')
	{
        if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select()
    							->from('wo_items')
    							->where('sku_code', $sku)
    							->where('item_status', 'available')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
        }
        else
        {
            $query = $this->db->select()
    							->from('wo_items')
    							->where('sku_code', $sku)
    							->where('item_status', 'available')
    							->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
        }
	}

	public function findQty($sku='')
	{
		$query = $this->db->select('purchase_qty, available_qty')
							->from('wo_itemsstock')
							->where('sku_code', $sku)
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->row_array();
	}

	public function fetchDataByid($id='')
	{
		$query = $this->db->select('*')
							->from('wo_itemsstock')
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('id', $id)
							->get();
		return $query->row_array();
	}

	public function fetchDataByPurchase_id($id='')
	{
		$query = $this->db->select('*')
							->from('wo_itemsstock')
							->where('purchase_id', $id)
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->row_array();
	}
	
	public function fetchAllDataByPurchaseID($id)
	{
		$query = $this->db->select('*')
							->from('wo_itemsstock')
							->where('purchase_id', $id)
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->result_array();	
	}

	public function updateStock($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_itemsstock', $data);
			return ($update == true) ? true : false;
		}
	}




	// for item 
	public function fetchSKUGroupData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('sku_code')
    							->from('wo_items')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->group_by('sku_code')
    							->order_by('created_date', 'asc')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('sku_code')
    							->from('wo_items')
    							->where(['company_id' => $this->session->userdata['wo_company']])
    							->order_by('created_date', 'asc')
    							->group_by('sku_code')
    							->get();
    		return $query->result_array();	
	    }
	}


	public function getBarcodeOutWardData($data=array())
	{
		$query = $this->db->select('*')
							->from('wo_items')
							->where('product_id', $data['product_id'])
							->where('purchase_type', $data['purchase_type'])
							->where('item_status', $data['item_status'])
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])

							->get();
		return $query->result_array();
	}

	public function getBarcodeOutWardDataByBarcode($data=array())
	{
		$query = $this->db->select('*')
							->from('wo_items')
							->where('product_id', $data['product_id'])
							->where('purchase_type', $data['purchase_type'])
							->where('barcode', $data['barcode'])
							->where('item_status', $data['item_status'])
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])

							->get();
		return $query->row_array();
	}

	public function lastrecord()
	{
	    $query = $this->db->select('*')
	                        ->from('wo_items')
	                        ->order_by('barcode', 'desc')
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
	                        ->limit(1)
	                        ->get();
	    return $query->row_array();
	}

	public function fetchAllDataByBarcode($barcode)
	{
		$query = $this->db->select('*')
							->from('wo_items')
							->where('barcode', $barcode)
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							// ->where('item_status', 'available')
							->get();
		return $query->row_array();	
	}

	public function fetchBarcodeData($barcode='')
	{
		$query = $this->db->select('*')
							->from('wo_items')
							->where('barcode', $barcode)
							->where('item_status', 'available')
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->row_array();
	}

	public function fetchAllDataByBarcodeid($barcode_id)
	{
		$query = $this->db->select('*')
							->from('wo_items')
							->where('id', $barcode_id)
							// ->where('item_status', 'available')
    						->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->row_array();	
	}

	public function fetchDataBySkuCode($sku_code='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function getBarcodeDataByProductId($data = array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_items')
    							->where(['product_id'=> $data['product_id'], 'purchase_type' => $data['purchase_type']])
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_items')
    							->where(['product_id'=> $data['product_id'], 'purchase_type' => $data['purchase_type']])
    				// 			->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function getBarcodeDataByPurchaseId($data = array())
	{
	   // echo "<pre>"; print_r($data); exit;
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_items')
    							->where(['purchase_id'=> $data['purchase_id'], 'purchase_type' => $data['purchase_type']])
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_items')
    							->where(['purchase_id'=> $data['purchase_id'], 'purchase_type' => $data['purchase_type']])
    				// 			->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}

	public function fetchDataBySkuCode1($sku_code='')
	{
	    $query = $this->db->select('*')
							->from('wo_items')
							->where('sku_code', $sku_code)
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->row_array();
	}

	// for barcode display
	public function fetchBarcodeDataBySkuCode($sku_code='')
	{
	        $query = $this->db->select('*')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	}
	
	public function fetchInwardItemQtyBySku($sku_code='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('SUM(qty) as qty')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('SUM(qty) as qty')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fetchInwardItemQtyBySkuBetweenDate($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('SUM(qty) as qty')
    							->from('wo_items')
    							->where('sku_code', $data['sku'])
    							->where(['created_date >=' => $data['from'], 'created_date <=' => $data['to']])
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('SUM(qty) as qty')
    							->from('wo_items')
    							->where('sku_code', $data['sku'])
    							->where(['created_date >=' => $data['from'], 'created_date <=' => $data['to']])
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fetchInwardItemQtyBySkuCustomerReport($data=array())
	{
	   // echo "<pre>"; print_r($data);
	   	if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.id, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    				// 			->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id', 'left')
    							->get();
    		return $query->row_array();
	   	}else
	   	{
	   	    $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.id, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    				// 			->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id', 'left')
    							->get();
    		return $query->row_array();
	   	}
	}
	
// 	public function fetchInwardAttrDataBySkuCustomerReport($data=array())
// 	{
// 	    echo "<pre>"; print_r($data);
// // 	    $query = $this->db->select('wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
// // 							->from('wo_items')
// // 							->where('wo_items.sku_code', $data['sku'])
// // 							->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
// // 							->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
// // 							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
// // 				// 			->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
// // 							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.id = wo_items.attr_id', 'left')
// // 							->get();
// // 		return $query->row_array();	
// 	}
	
	public function fetchInwardItemQtyBySkuCustomerReport1($data=array())
	{
	   // echo "<pre>"; print_r($data);
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.id, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id')
    							->get();
    		return $query->row_array();	
	    }else
	    {
	        $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.id, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id')
    							->get();
    		return $query->row_array();	
	    }
	}
	
// 	public function fetchInwardAttrDataBySkuCustomerReport1($data=array())
// 	{
// 	   // echo "<pre>"; print_r($data);
// 	    $query = $this->db->select('wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
// 							->from('wo_items')
// 							->where('wo_items.sku_code', $data['sku'])
// 							->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
// 							->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
// 							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
// 							->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
// 							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.id = wo_items.attr_id', 'left')
// 							->get();
// 		return $query->row_array();	
// 	}
	
	public function fetchOutwardItemQtyBySkuCustomerReport($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							->where('wo_items.item_status', 'soldout')
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    				// 			->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id', 'left')
    							->get();
    		return $query->row_array();	
	    }else{
	        $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							->where('wo_items.item_status', 'soldout')
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    				// 			->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id', 'left')
    							->get();
    		return $query->row_array();	
	    }
	}
	
	public function fetchOutwardItemQtyBySkuCustomerReport1($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							->where('wo_items.item_status', 'soldout')
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id', 'left')
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.barcode, wo_items.sku_code, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.purchase_type, wo_items.item_status, wo_purchaseorderitem.color, wo_purchaseorderitem.size, wo_purchaseorderitem.pattern, wo_purchaseorderitem.style1, wo_purchaseorderitem.style2, wo_purchaseorderitem.type, wo_purchaseorderitem.quantity ')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							->where('wo_items.item_status', 'soldout')
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id', 'left')
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function getAttrData($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('color as acolor, size as asize, pattern as apattern, style1 as astyle1, style2 as astyle2, type as atype, quantity, wo_items.barcode, wo_items.mrp, wo_items.item_status, wo_items.purchase_id, wo_items.product_id, wo_items.purchase_type')
    							->from('wo_items')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    				// 			->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.id = wo_items.attr_id')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('color as acolor, size as asize, pattern as apattern, style1 as astyle1, style2 as astyle2, type as atype, quantity, wo_items.barcode, wo_items.mrp, wo_items.item_status, wo_items.purchase_id, wo_items.product_id, wo_items.purchase_type')
    							->from('wo_items')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							// ->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    				// 			->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.id = wo_items.attr_id')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function getAttrData1($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('color as acolor, size as asize, pattern as apattern, style1 as astyle1, style2 as astyle2, type as atype, quantity, wo_items.barcode, wo_items.mrp, wo_items.item_status, wo_items.purchase_id, wo_items.product_id, wo_items.purchase_type')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    							// ->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							// ->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id')
    							->get();
    		return $query->result_array();	
	    }else
	    {
	        $query = $this->db->select('color as acolor, size as asize, pattern as apattern, style1 as astyle1, style2 as astyle2, type as atype, quantity, wo_items.barcode, wo_items.mrp, wo_items.item_status, wo_items.purchase_id, wo_items.product_id, wo_items.purchase_type')
    							->from('wo_items')
    							->where('wo_items.sku_code', $data['sku'])
    							->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_purchaseorderitem', 'wo_purchaseorderitem.id = wo_items.attr_id')
    							->get();
    		return $query->result_array();	
	    }
	}

	public function getAttrDataResult($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('color as acolor, size as asize, pattern as apattern, style1 as astyle1, style2 as astyle2, type as atype, quantity, wo_items.barcode, wo_items.mrp, wo_items.item_status, wo_items.purchase_id, wo_items.product_id, wo_items.purchase_type')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    				// 			->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('color as acolor, size as asize, pattern as apattern, style1 as astyle1, style2 as astyle2, type as atype, quantity, wo_items.barcode, wo_items.mrp, wo_items.item_status, wo_items.purchase_id, wo_items.product_id, wo_items.purchase_type')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    				// 			->where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id')
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function getAttrDataResult1($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('color as acolor, size as asize, pattern as apattern, style1 as astyle1, style2 as astyle2, type as atype, quantity, wo_items.barcode, wo_items.mrp, wo_items.item_status, wo_items.purchase_id, wo_items.product_id, wo_items.purchase_type')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							->or_where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id')
    							->get();
    		return $query->result_array();	
	    }else
	    {
	        $query = $this->db->select('color as acolor, size as asize, pattern as apattern, style1 as astyle1, style2 as astyle2, type as atype, quantity, wo_items.barcode, wo_items.mrp, wo_items.item_status, wo_items.purchase_id, wo_items.product_id, wo_items.purchase_type')
    							->from('wo_purchaseorderitem')
    							->where('wo_items.sku_code', $data['sku'])
    							// ->where(['color' => $data['attrcolor'], 'size' => $data['attrsize'], 'pattern' => $data['attrpattern'], 'style1' => $data['attrstyle1'], 'style2' => $data['attrstyle2'], 'type' => $data['attrtype']])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							->or_where(['wo_items.mrp >=' => $data['frommrp'], 'wo_items.mrp <=' => $data['tomrp']])
    							->join('wo_items', 'wo_items.attr_id = wo_purchaseorderitem.id')
    							->get();
    		return $query->result_array();	
	    }
	}
	
	
	
	
    
    public function fetchSoldItemQtyBySku($sku_code='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('SUM(qty) as qty')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							->where('item_status', 'soldout')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('SUM(qty) as qty')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							->where('item_status', 'soldout')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fetchSoldItemQtyBySkuBetweenDate($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('SUM(qty) as qty')
    							->from('wo_items')
    							->where('sku_code', $data['sku'])
    							->where('item_status', 'soldout')
    							->where(['created_date >=' => $data['from'], 'created_date <=' => $data['to']])
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();	
	    }else
	    {
	        $query = $this->db->select('SUM(qty) as qty')
    							->from('wo_items')
    							->where('sku_code', $data['sku'])
    							->where('item_status', 'soldout')
    							->where(['created_date >=' => $data['from'], 'created_date <=' => $data['to']])
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();	
	    }
	}
	
	public function fetchSoldItemQtyBySkuCustomerReport($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    	    $query = $this->db->select('SUM(qty) as qty, wo_items.mrp')
    							->from('wo_items')
    							->where('sku_code', $data['sku'])
    							->where('item_status', 'soldout')
    							->where(['created_date >=' => $data['from'], 'created_date <=' => $data['to']])
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->row_array();	
	    }else
	    {
	        $query = $this->db->select('SUM(qty) as qty, wo_items.mrp')
    							->from('wo_items')
    							->where('sku_code', $data['sku'])
    							->where('item_status', 'soldout')
    							->where(['created_date >=' => $data['from'], 'created_date <=' => $data['to']])
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();	
	    }
	}

	public function fetchProductByBarcode($barcode='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    								->from('wo_items')
    								->where('wo_items.barcode', $barcode)
    								->where('wo_items.purchase_type', 'pinvoice')
    								->where('wo_items.item_status', 'available')
    								// ->where(['company_id' => $this->session->userdata['wo_company']])
    								->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    								->from('wo_items')
    								->where('wo_items.barcode', $barcode)
    								->where('wo_items.purchase_type', 'pinvoice')
    								->where('wo_items.item_status', 'available')
    								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    								->get();
    		return $query->row_array();
	    }
	}

	public function fetchItemBySkuCode($sku_code='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							->where('item_status', 'available')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();	
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							->where('item_status', 'available')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->result_array();
	    }
	}
	
	public function fetchItemDataBySkuCode($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('sku_code, barcode, item_status, attr_id, wo_items.mrp, wo_items.created_date')
    							->from('wo_items')
    							// ->where(['color' => $data['color'], 'size' => $data['size'], 'pattern' => $data['pattern'], 'style1' => $data['style1'], 'style2' => $data['style2'], 'type' => $data['type']])
    							->where('wo_items.created_date >=', $data['toDay'])
    							->where('wo_items.created_date <=', $data['fromDay'])
    							->where('sku_code', $data['sku'])
    							->where('item_status', 'available')
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    				// 			->or_where(['mrp >=' => $data['frommrp'], 'mrp <=' => $data['tommrp']])
    							// ->join('wo_purchaseorderitem', 'wo_purchaseorderitem.id = wo_items.attr_id')
    				// 			->group_by('barcode')
    							->get();
    		return $query->result_array();	
	    }else
	    {
	        $query = $this->db->select('sku_code, barcode, item_status, attr_id, wo_items.mrp, wo_items.created_date')
    							->from('wo_items')
    							// ->where(['color' => $data['color'], 'size' => $data['size'], 'pattern' => $data['pattern'], 'style1' => $data['style1'], 'style2' => $data['style2'], 'type' => $data['type']])
    							->where('wo_items.created_date >=', $data['toDay'])
    							->where('wo_items.created_date <=', $data['fromDay'])
    							->where('sku_code', $data['sku'])
    							->where('item_status', 'available')
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    				// 			->or_where(['mrp >=' => $data['frommrp'], 'mrp <=' => $data['tommrp']])
    							// ->join('wo_purchaseorderitem', 'wo_purchaseorderitem.id = wo_items.attr_id')
    				// 			->group_by('barcode')
    							->get();
    		return $query->result_array();
	    }
        
        // $query = $this->db->query("SELECT * FROM wo_purchaseorderitem JOIN wo_items ON wo_items.attr_id = wo_purchaseorderitem.id WHERE `color` = '".$data['color']."' && `size` = '".$data['size']."' && `pattern` = '".$data['pattern']."' && `style1` = '".$data['style1']."' && `style2` = '".$data['style2']."' && `type` = '".$data['type']."' && wo_items.created_date BETWEEN '".$data['toDay']."' AND '".$data['fromDay']."' OR wo_items.mrp BETWEEN '".$data['frommrp']."' AND '".$data['tommrp']."' AND wo_items.item_status = 'available' AND wo_items.sku_code = '".$data['sku']."' ");
        // return $query->result_array();
	}
	
	public function fetchItemDataBySkuCode1($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('sku_code, barcode, item_status, attr_id, wo_items.mrp, wo_items.created_date')
    							->from('wo_items')
    							// ->where(['color' => $data['color'], 'size' => $data['size'], 'pattern' => $data['pattern'], 'style1' => $data['style1'], 'style2' => $data['style2'], 'type' => $data['type']])
    							->where('wo_items.created_date >=', $data['toDay'])
    							->where('wo_items.created_date <=', $data['fromDay'])
    							->where('sku_code', $data['sku'])
    							->where('item_status', 'available')
    							// ->where(['wo_items.company_id' => $this->session->userdata['wo_company']])
    							->where(['mrp >=' => $data['frommrp'], 'mrp <=' => $data['tommrp']])
    							// ->join('wo_purchaseorderitem', 'wo_purchaseorderitem.id = wo_items.attr_id')
    				// 			->group_by('barcode')
    							->get();
    		return $query->result_array();
	    }else
	    {
	        $query = $this->db->select('sku_code, barcode, item_status, attr_id, wo_items.mrp, wo_items.created_date')
    							->from('wo_items')
    							// ->where(['color' => $data['color'], 'size' => $data['size'], 'pattern' => $data['pattern'], 'style1' => $data['style1'], 'style2' => $data['style2'], 'type' => $data['type']])
    							->where('wo_items.created_date >=', $data['toDay'])
    							->where('wo_items.created_date <=', $data['fromDay'])
    							->where('sku_code', $data['sku'])
    							->where('item_status', 'available')
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['mrp >=' => $data['frommrp'], 'mrp <=' => $data['tommrp']])
    							// ->join('wo_purchaseorderitem', 'wo_purchaseorderitem.id = wo_items.attr_id')
    				// 			->group_by('barcode')
    							->get();
    		return $query->result_array();
	    }
	}

	// for Internal Transfer
	public function fetchItemBySkuCodeStore($sku_code='', $store='')
	{
	     if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							->where('item_status', 'available')
    							->where('store_id', $store)
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();	
	     }else
	     {
	         $query = $this->db->select('*')
    							->from('wo_items')
    							->where('sku_code', $sku_code)
    							->where('item_status', 'available')
    							->where('store_id', $store)
    							->where(['company_id' => $this->session->userdata['wo_company']])
    							->get();
    		return $query->result_array();	
	     }
	}

	public function fetchItemBySkuCodeLocation($sku_code='', $from_location)
	{
		$query = $this->db->select('wo_items.id, wo_items.itemstock_id, wo_items.sku_code, wo_items.barcode, wo_items.purchase_id, wo_items.product_id, wo_items.pur_netprice, wo_items.mrp, wo_items.qty, wo_items.purchase_type, wo_items.item_status')
							->from('wo_items')
							->where('wo_items.item_status', 'available')
							->where('wo_items.sku_code', $sku_code)
							->where('wo_inventoryopening.location', $from_location)
							->or_where('wo_purchaseorderinvoice.location', $from_location)
							// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])

							// for opening Stock
							->join('wo_inventoryopening', 'wo_inventoryopening.id = wo_items.purchase_id', 'left')
							->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_items.purchase_id', 'left')
							->get();
		return $query->result_array();	
	} 

	public function fetchAllDataByItemStock($itemstock_id)
	{
		$query = $this->db->select('*')
							->from('wo_items')
							->where('itemstock_id', $itemstock_id)
							->get();
		return $query->result_array();	
	}

	public function fetchItemStockByPur_id($purchase_id)
	{
		$query = $this->db->select('*')
							->from('wo_items')
							->where('purchase_id', $purchase_id)
							->get();
		return $query->result_array();	
	}

	public function create($data = array())
	{
		if($data) {
			// print_r($data);exit();
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_items', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_items', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id)
	{
	    $this->db->where('id', $id);
		return $result=$this->db->delete('wo_items');
	}
	
	public function getPInvoiceData($id='')
	{
	    $query = $this->db->select('wo_items.id, wo_items.barcode, wo_items.purchase_id, wo_items.product_id')
	                        ->from('wo_items')
	                        ->where('purchase_id', $id)
	                        ->where('wo_items.purchase_type', 'pinvoice')
	                        ->join('wo_purchaseorderdata', 'wo_purchaseorderdata.id = wo_items.product_id', 'left')
	                        ->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_purchaseorderdata.order_id', 'left')
	                        ->get();
	   return $query->result_array();
	}
	
	public function getOpeningStockData($id='')
	{
	    $query = $this->db->select('wo_items.id, wo_items.barcode, wo_items.purchase_id, wo_items.product_id')
	                        ->from('wo_items')
	                        ->where('purchase_id', $id)
	                        ->where('wo_items.purchase_type', 'popeningstock')
	                        ->join('wo_purchaseorderdata', 'wo_purchaseorderdata.id = wo_items.product_id', 'left')
	                        ->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_purchaseorderdata.order_id', 'left')
	                        ->get();
	   return $query->result_array();
	}

	public function getProductionData($id='')
	{
	    $query = $this->db->select('wo_items.id, wo_items.barcode, wo_items.purchase_id, wo_items.product_id')
	                        ->from('wo_items')
	                        ->where('purchase_id', $id)
	                        ->where('wo_items.purchase_type', 'production')
	                        ->join('wo_purchaseorderdata', 'wo_purchaseorderdata.id = wo_items.product_id', 'left')
	                        ->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_purchaseorderdata.order_id', 'left')
	                        ->get();
	   return $query->result_array();
	}

	public function getWSPProductBySKU($sku_code='')
	{
		$query = $this->db->select('wo_items.id, wo_items.sku_code, wo_items.barcode, wo_items.purchase_id, wo_items.product_id, wo_items.mrp, wo_purchaseorderinvoice.id as invoice_id, wo_purchaseorderinvoice.invoice_no')
								->from('wo_items')
								->where('wo_items.sku_code', $sku_code)
								->where('wo_items.purchase_type', 'pinvoice')
								->or_where('wo_items.purchase_type', 'popeningstock')
								->where('wo_items.item_status', 'available')
								->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_items.purchase_id', 'left')
								->get();
		return $query->result_array();
	}

	public function getProductData($productSku='')
	{
		$query = $this->db->select('wo_items.id, wo_items.sku_code, wo_items.barcode, wo_items.purchase_id, wo_items.product_id, wo_items.mrp, wo_items.wsp, wo_purchaseorderinvoice.id as invoice_id, wo_purchaseorderinvoice.invoice_no')
								->from('wo_items')
								->where('wo_items.sku_code', $productSku)
								->where('wo_items.purchase_type', 'pinvoice')
								->where('wo_items.item_status', 'available')
								->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_items.purchase_id', 'left')
								->get();
		return $query->result_array();
	}

	public function getProductDataBySkuID($productSkuid='')
	{
		$query = $this->db->select('wo_items.id, wo_items.sku_code, wo_items.barcode, wo_items.purchase_id, wo_items.product_id, wo_items.mrp, wo_items.wsp, wo_purchaseorderinvoice.id as invoice_id, wo_purchaseorderinvoice.invoice_no')
								->from('wo_items')
								->where('wo_items.sku_code', $productSkuid)
								->where('wo_items.purchase_type', 'pinvoice')
								->where('wo_items.item_status', 'available')
								->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_items.purchase_id', 'left')
								->get();
		return $query->result_array();
	}

	public function getWSPData($productSku='')
	{
		$query = $this->db->select('wo_items.id, wo_items.sku_code, wo_items.barcode, wo_items.purchase_id, wo_items.product_id, wo_items.mrp, wo_items.wsp, wo_items.item_status, wo_items.purchase_type, wo_purchaseorderinvoice.id as invoice_id, wo_purchaseorderinvoice.invoice_no')
								->from('wo_items')
								->where('wo_items.sku_code', $productSku)
								->where('wo_items.item_status', 'available')
								->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_items.purchase_id', 'left')
								->get();
		return $query->result_array();
	}

	public function getGlobalSearchData($productSku='')
	{
		$query = $this->db->select('wo_items.id, wo_items.attr_id, wo_items.sku_code, wo_items.barcode, wo_items.purchase_id, wo_items.product_id, wo_items.qty, wo_items.purchase_type, wo_items.mrp, wo_items.wsp, wo_items.item_status, wo_items.purchase_type, wo_purchaseorderinvoice.id as invoice_id, wo_purchaseorderinvoice.invoice_no')
								->from('wo_items')
								->where('wo_items.sku_code', $productSku)
								// ->where('wo_items.item_status', 'available')
								->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_items.purchase_id', 'left')
								// ->where(['company_id' => $this->session->userdata['wo_company'], 'city_id' => $this->session->userdata['wo_city'], 'store_id' => $this->session->userdata['wo_store']  ])
								->order_by('barcode', 'asc')
								->get();
		return $query->result_array();
	}

	public function getGlobalSearchData1($productSku='')
	{
		$query = $this->db->select('*')
								->from('wo_items')
								->where('wo_items.sku_code', $productSku)
								// ->where('wo_items.item_status', 'available')
								// ->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_items.purchase_id', 'left')
								->where(['company_id' => $this->session->userdata['wo_company'],'store_id' => $this->session->userdata['wo_store']  ])
								->order_by('barcode', 'asc')
								->get();
		return $query->result_array();
	}

	public function getGlobalSearchData1InvoiceGroup($productSku='')
	{
		$query = $this->db->select()
								->from('wo_items')
								->where('wo_items.sku_code', $productSku)
								// ->where('wo_items.item_status', 'available')
								// ->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_items.purchase_id', 'left')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']  ])
								->group_by('purchase_id')
								->get();
		return $query->result_array();
	}

	public function getSKUByBarcode($barcode='')
	{
		$query = $this->db->select('wo_items.id, wo_items.attr_id, wo_items.sku_code, wo_items.barcode, wo_items.purchase_id, wo_items.product_id, wo_items.qty, wo_items.purchase_type, wo_items.pur_netprice, wo_items.mrp, wo_items.wsp, wo_items.item_status, wo_items.purchase_type, wo_purchaseorderinvoice.id as invoice_id, wo_purchaseorderinvoice.invoice_no')
								->from('wo_items')
								->where('wo_items.barcode', $barcode)
								->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']  ])

								// ->where('wo_items.item_status', 'available')
								->join('wo_purchaseorderinvoice', 'wo_purchaseorderinvoice.id = wo_items.purchase_id', 'left')
								->order_by('barcode', 'asc')
								->get();
		return $query->row_array();
	}

	// for item status
	public function createStatus($data=array())
	{
		if($data) {
			// print_r($data);exit();
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_itemstatus', $data);
			return ($create == true) ? true : false;
			// return $this->db->insert_id();
		}
	}
 
	public function getItemStatusData($data=array())
	{
		$query = $this->db->select('*')
							->from('wo_itemstatus')
							->where('itemstock_id', $data['itemstock_id'])
							->where('item_id', $data['item_id'])
							->get();
		return $query->row_array();
	}

	public function deleteItemStatus($id='')
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_itemstatus');
	}
	
	public function fecthOpStockAttributes($data=array())
	{
	    $query = $this->db->select('*')
							->from('wo_purchaseorderitem')
							->where('order_id', $data['order_id'])
							->where('order_code', $data['order_code'])
        					->where('order_name', $data['inventory_type'])
							->get();
		return $query->row_array();
	}
	
	public function fecthPurInvoiceAttributes($data=array())
	{
	    $query = $this->db->select('*')
							->from('wo_purchaseorderitem')
							->where('order_id', $data['order_id'])
							->where('order_code', $data['order_code'])
        					->where('order_name', $data['inventory_type'])
							->get();
		return $query->row_array();
	}


	public function getAttributeDataByID($id='')
	{
		$query = $this->db->select()
							->from('wo_purchaseorderitem')
							// ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('id', $id)
							->get();
		return $query->row_array();	
	}


	public function inwardsCustomerReportData($data = array())
	{
		$query = $this->db->select('SUM(wo_items.qty) as qtySum, wo_items.*')
							->from('wo_items')
							->where(['sku_code' => $data['sku_code']])
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->result_array();

	}

	public function outwardsCustomerReportData($data = array())
	{
		$query = $this->db->select()
							->from('wo_items')
							->where(['sku_code' => $data['sku_code'], 'item_status' => 'soldout'])
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->get();
		return $query->result_array();

	}

	// For Product Wise
	public function inwardCustomerReport($data=array())
	{
		$query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.*')
    							->from('wo_items')
    							->where('wo_items.sku_code', $data['sku'])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();
	}

	public function inwardCustomerReport1($data=array())
	{
		$query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.*')
    							->from('wo_items')
    							->where('wo_items.sku_code', $data['sku'])
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							->get();
    		return $query->row_array();
	}


	// for Product Wise
	public function outwardCustomerReport($data=array())
	{
	        $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.*')
    							->from('wo_items')
    							->where('wo_items.sku_code', $data['sku'])
    							->where('wo_items.item_status', 'soldout')
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->get();
    		return $query->row_array();	   
	}

	public function outwardCustomerReport1($data=array())
	{
	        $query = $this->db->select('SUM(wo_items.qty) as qty, wo_items.*')
    							->from('wo_items')
    							->where('wo_items.sku_code', $data['sku'])
    							->where('wo_items.item_status', 'soldout')
    							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    							->where(['wo_items.created_date >=' => $data['from'], 'wo_items.created_date <=' => $data['to']])
    							->get();
    		return $query->row_array();	   
	}

	public function fetchDataByBrand($barndid='')
	{
		$query = $this->db->select()
							->from('wo_items')
							->where('brand_id', $barndid)
    						->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    						->group_by('brand_id')
    						->get();
    	return $query->result_array();
	}

	public function fetchDataByBrand1($barndid='')
	{
		$query = $this->db->select()
							->from('wo_items')
							->where('brand_id', $barndid)
    						->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->result_array();
	}

	public function fetchDataByBrandid($barndid='')
	{
		$query = $this->db->select()
							->from('wo_items')
							->where('brand_id', $barndid)
    						->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
    						->group_by('sku_code')
    						->get();
    	return $query->row_array();
	}

	// sales invoice, sales exchange
    public function outWardsDataByBarcode($pno='')
    {
    	// echo "<pre>"; print_r($pno);
    	$query = $this->db->select('*')
    						->from('wo_salesinvoicedata')
    						->where('pno', $pno)
    						->where(['inventory_type !=' => 'salesorder', 'sales_exchange !=' => 'return item'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->row_array();
    }

    public function outWardsDataByBarcode1($pno='')
    {
    	$query = $this->db->select('*')
    						->from('wo_inventorydata')
    						->where('pno', $pno)
    						->where(['inventory_type !=' => 'inventoty_excesses'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->row_array();
    }
}

