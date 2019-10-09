<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sku extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = array())
	{
		if($data) {
			$this->db->set('created_date','NOW()', FALSE);
			$create = $this->db->insert('wo_product', $data);
			return ($create == true) ? true : false;
		}
	}
	
	public function fecthAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('wo_product.id, wo_product.product_name, wo_product.product_code, wo_category.catgory_name, wo_subcategory.subcategory_name, wo_gst.gst_name')
								->from('wo_product')
								// ->where(['wo_product.company_id' => $this->session->userdata['wo_company', 'wo_product.store_id' => $this->session->userdata['wo_store'])
								->join('wo_category', 'wo_category.id = wo_product.category_id', 'left')
								->join('wo_subcategory', 'wo_subcategory.id = wo_product.subcategory_id', 'left')
								->join('wo_gst', 'wo_gst.id = wo_product.gst', 'left')
								->get();
			return $query->result_array();
		}else{

		    $query = $this->db->select('wo_product.id, wo_product.product_name, wo_product.product_code, wo_category.catgory_name, wo_subcategory.subcategory_name, wo_gst.gst_name')
							->from('wo_product')
							->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
							->join('wo_category', 'wo_category.id = wo_product.category_id', 'left')
							->join('wo_subcategory', 'wo_subcategory.id = wo_product.subcategory_id', 'left')
							->join('wo_gst', 'wo_gst.id = wo_product.gst', 'left')
							->get();
			return $query->result_array();
		}
	}
	
	public function fecthAllData1()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('wo_product.id, wo_product.product_name, wo_product.product_code, wo_category.id as cid, wo_category.catgory_name, wo_subcategory.id as sid, wo_subcategory.subcategory_name, wo_gst.gst_name, unit_id')
								->from('wo_product')
								// ->where(['wo_product.company_id' => $this->session->userdata['wo_company', 'wo_product.store_id' => $this->session->userdata['wo_store'])
								->join('wo_category', 'wo_category.id = wo_product.category_id', 'left')
								->join('wo_subcategory', 'wo_subcategory.id = wo_product.subcategory_id', 'left')
								->join('wo_gst', 'wo_gst.id = wo_product.gst', 'left')
								->order_by('id', 'desc')
								->get();
			return $query->result_array();
		}else{

		    $query = $this->db->select('wo_product.id, wo_product.product_name, wo_product.product_code, wo_category.id as cid, wo_category.catgory_name, wo_subcategory.id as sid, wo_subcategory.subcategory_name, wo_gst.gst_name, unit_id')
							->from('wo_product')
							->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
							->join('wo_category', 'wo_category.id = wo_product.category_id', 'left')
							->join('wo_subcategory', 'wo_subcategory.id = wo_product.subcategory_id', 'left')
							->join('wo_gst', 'wo_gst.id = wo_product.gst', 'left')
							->order_by('id', 'desc')
							->get();
			return $query->result_array();
		}
	}
	
	public function fecthSkuAllData()
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select()
								->from('wo_product')
								// ->where(['wo_product.company_id' => $this->session->userdata['wo_company', 'wo_product.store_id' => $this->session->userdata['wo_store'])
								->get();
			return $query->result();
		}else{

		    $query = $this->db->select()
							->from('wo_product')
							->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
							->get();
			return $query->result();
		}
	}
	
	public function fecthSkuByCatID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select()
							->from('wo_product')
							// ->where(['wo_product.company_id' => $this->session->userdata['wo_company', 'wo_product.store_id' => $this->session->userdata['wo_store'])
							->where('category_id', $id)
							->get();
			return $query->result();
		}else{

		    $query = $this->db->select()
								->from('wo_product')
								->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
								->where('category_id', $id)
								->get();
			return $query->result();
		}
	}

	public function fecthSkuByCatSubcatID($catid='', $subcatid='')
	{
	    $query = $this->db->select()
								->from('wo_product')
								->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
								->where('category_id', $catid)
								->where('subcategory_id', $subcatid)
								->get();
			return $query->result();
	}
	
	public function fecthSkuDataByCatID($id)
	{	
		if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select()
							->from('wo_product')
							// ->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store'])
							->where('category_id', $id)
							->group_by('product_code')
							->get();
			return $query->result();
		}else{

		    $query = $this->db->select()
								->from('wo_product')
								->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
								->where('category_id', $id)
								->group_by('product_code')
								->get();
			return $query->result();
		}
	}

	public function fecthSkuDataBySubCatID($id)
	{	
		if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select()
							->from('wo_product')
							// ->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store'])
							->where('subcategory_id', $id)
							->group_by('product_code')
							->get();
			return $query->result();
		}else{

		    $query = $this->db->select()
								->from('wo_product')
								->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
								->where('subcategory_id', $id)
								->group_by('product_code')
								->get();
			return $query->result();
		}
	}
	
	public function fecthSkuDataByBrandID($id)
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select()
								->from('wo_product')
								// ->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store'])
								->where('brand_id', $id)
								->group_by('product_code')
								->get();
			return $query->result();
		}else{

		    $query = $this->db->select()
								->from('wo_product')
								->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
								->where('brand_id', $id)
								->group_by('product_code')
								->get();
			return $query->result();
		}
	}
	
	
	public function fecthSkuDataByID($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_product')
								// ->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store'])
								->where('id', $id)
								->get();
			return $query->row_array();
		}else{

		    $query = $this->db->select('*')
							->from('wo_product')
							// ->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
							->where('id', $id)
							->get();
			return $query->row_array();
		}
	}

	//  for internal transfer therefor company id and store id not define
	public function fecthDataBySKUID($id='')
	{
	    $query = $this->db->select('*')
							->from('wo_product')
							->where('id', $id)
							->get();
		return $query->row_array();
	}

	//  for internal transfer therefor company id and store id not define
	public function fecthSkuDataBySkuAndStore($skucode='', $store='')
	{
	    $query = $this->db->select('*')
							->from('wo_product')
							->where(['product_code' => $skucode, 'store_id' => $store])
							->get();
		return $query->row_array();
	}

	public function fecthSkuDataBySKU($sku='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_product')
								// ->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store'])
								->where('product_code', $sku)
								->get();
			return $query->row_array();
		}else{

		    $query = $this->db->select('*')
								->from('wo_product')
								// ->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
								->where('product_code', $sku)
								->get();
			return $query->row_array();
		}
	}

	public function fecthDataBySKU($sku='')
	{
		$query = $this->db->select('*')
								->from('wo_product')
								->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
								->where('product_code', $sku)
								->get();
		return $query->row_array();
	}

	public function fecthInwardsDataBySKU($sku='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

		    $query = $this->db->select('*')
								->from('wo_product')
								// ->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store'])
								->where('product_code', $sku)
								->get();
			return $query->result_array();
		}else{

		    $query = $this->db->select('*')
								->from('wo_product')
								->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
								->where('product_code', $sku)
								->get();
			return $query->result_array();
		}
	}
	
	public function fecthDataByIDCatidSubcatId($cat='', $subcat='', $id='')
	{
	    $query = $this->db->select('*')
							->from('wo_product')
							->where(['wo_product.company_id' => $this->session->userdata['wo_company'], 'wo_product.store_id' => $this->session->userdata['wo_store']])
							->where('category_id', $cat)
							->where('subcategory_id', $subcat)
							->where('id', $id)
							->get();
		return $query->row_array();
	}
	
	public function update($data = array())
	{
		if($data) {
		    $this->db->set('modified_date','NOW()', FALSE);
			$this->db->where('id', $data['id']);
			$update = $this->db->update('wo_product', $data);
			return ($update == true) ? true : false;
		}
	}
	
	public function delete($id = "")
	{
		$this->db->where('id', $id);
		return $result=$this->db->delete('wo_product');
	}



	// SKu Images
	public function fetchImgDataBySkuId($skuId='')
	{
		$query = $this->db->select('*')
								->from('wo_purchaseorderitem')
								->where('sku', $skuId)
								->get();
		return $query->result_array();
	}

}