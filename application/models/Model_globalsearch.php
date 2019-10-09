<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Model_globalsearch extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
 
	public function fecthOStockInWardsItemData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}

	public function fecthOStockInWardsItemData1($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_inventoryopeningitem')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}
	
	public function fecthPInvoiceInWardsData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
			$query = $this->db->select('wo_ledger.id as ledger_id, wo_ledger.ledger_name')
								->from('wo_purchaseorderinvoice')
								->where(['wo_purchaseorderinvoice.company_id' => $this->session->userdata['wo_company']])
								->where('wo_purchaseorderinvoice.id', $id)
								->join('wo_ledger', 'wo_ledger.id = wo_purchaseorderinvoice.account', 'left')
								->get();
			return $query->row_array();
		}else
		{
			$query = $this->db->select('wo_ledger.id as ledger_id, wo_ledger.ledger_name')
								->from('wo_purchaseorderinvoice')
								->where(['wo_purchaseorderinvoice.company_id' => $this->session->userdata['wo_company']])
								->where('wo_purchaseorderinvoice.id', $id)
								->join('wo_ledger', 'wo_ledger.id = wo_purchaseorderinvoice.account', 'left')
								->get();
			return $query->row_array();
		}
	}

	public function fecthPInvoiceInWardsItemData($id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){
    		$query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							// ->where(['company_id' => $this->session->userdata['wo_company']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }else
	    {
	        $query = $this->db->select('*')
    							->from('wo_purchaseorderdata')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    							->where('id', $id)
    							->get();
    		return $query->row_array();
	    }
	}

	public function fetchLedgerEntries($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			// echo "<pre>"; print_r($data); exit();
			$query = $this->db->select('*')
								->from('wo_purchaseledger')
								->where('ledger_id', $data['ledger_id'])
								->order_by('id', 'asc')
								->get();
			return $query->result_array();
		}else
		{
			// echo "<pre>"; print_r($data); exit();
			$query = $this->db->select('*')
								->from('wo_purchaseledger')
								->where('ledger_id', $data['ledger_id'])
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->order_by('id', 'asc')
								->get();
			return $query->result_array();
		}
	}

	public function fetchLedgerEntriesBetweenDate($data=array())
	{
		if($_SESSION['wo_role'] == 'superadmin'){

			// echo "<pre>"; print_r($data); exit();
			$query = $this->db->select('*')
								->from('wo_purchaseledger')
								->where('ledger_id', $data['ledger_id'])
								->where('invoice_date >=', $data['from'])
								->where('invoice_date <=', $data['to'])
								->order_by('entry_date', 'asc')
								->get();
			return $query->result_array();
		}else
		{
			// echo "<pre>"; print_r($data); exit();
			$query = $this->db->select('*')
								->from('wo_purchaseledger')
								->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->order_by('id', 'asc')
								->where('ledger_id', $data['ledger_id'])
								->where('invoice_date >=', $data['from'])
								->where('invoice_date <=', $data['to'])
								->order_by('entry_date', 'asc')
								->get();
			return $query->result_array();
		}
	}


	public function fetchledgerEntriesByLedgerID($ledger_id='')
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			$query = $this->db->select('*')
								->from('wo_ledgerentries')
								->where('fomledger_id', $ledger_id)
								->or_where('toledger_id', $ledger_id)
								->order_by('entry_date', 'asc')
								->get();
			return $query->result_array();
		}else
		{
			$query = $this->db->select('*')
								->from('wo_ledgerentries')
								->where('fomledger_id', $ledger_id)
								->or_where('toledger_id', $ledger_id)
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
								->order_by('entry_date', 'asc')
								->get();
			return $query->result_array();
		}
	}

	public function fetchledgerBetweenTwoDate($data=array())
	{
	    if($_SESSION['wo_role'] == 'superadmin'){

			// echo "<pre>"; print_r($data); //exit();
			$query = $this->db->select('*')
								->from('wo_ledgerentries')
								->where('fomledger_id', $data['ledger_id'])
								->or_where('toledger_id', $data['ledger_id'])
								->or_where('created_date >=', $data['from'])
								->or_where('created_date <=', $data['to'])
								// ->where('created_date BETWEEN "'. date('Y-m-d', strtotime($data['from'])). '" and "'. date('Y-m-d', strtotime($data['to'])).'"')
								->order_by('created_date', 'asc')
								->get();
			return $query->result_array();	
		}else{
			$query = $this->db->select('*')
								->from('wo_ledgerentries')
								->where('fomledger_id', $data['ledger_id'])
								->or_where('toledger_id', $data['ledger_id'])
								->or_where('created_date >=', $data['from'])
								->or_where('created_date <=', $data['to'])
								// ->where('created_date BETWEEN "'. date('Y-m-d', strtotime($data['from'])). '" and "'. date('Y-m-d', strtotime($data['to'])).'"')
    							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])

								->order_by('created_date', 'asc')
								->get();
			return $query->result_array();	
		}
	}

	public function getLastDataByLedgerID($data=array())
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('ledger_id', $data['ledger_id'])
                                ->order_by('ledger_id',"desc")
                                ->limit(1)
                                ->get();
            return $query->row_array();
        }else
        {
            // echo $id; exit();
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('ledger_id', $data['ledger_id'])
                                ->order_by('ledger_id',"desc")
                                ->limit(1)
                                ->get();
            return $query->row_array();
        }
    }

    public function getLastDataByLedgerIDBetweenDate($data=array())
    {
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where('entry_date >=', $data['from'])
                                ->where('entry_date <=', $data['to'])
                                ->where('ledger_id', $data['ledger_id'])
                                ->order_by('ledger_id',"desc")
                                ->limit(1)
                                ->get();
            return $query->row_array();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where('entry_date >=', $data['from'])
                                ->where('entry_date <=', $data['to'])
                                ->where('ledger_id', $data['ledger_id'])
                                ->order_by('ledger_id',"desc")
                                ->limit(1)
                                ->get();
            return $query->row_array();
        }   
    }

    public function getBudgetLedgerDataDr($data=array())
    {
    	// echo "<pre>"; print_r($data); 
        if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where(['dr_cr' => 'dr'])
                                ->where(['ledger_id' => $data['ledger_id']])
                                ->where('MONTH(invoice_date)', $data['month'])
                                ->get();
            return $query->result_array();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where(['dr_cr' => 'dr'])
                                ->where(['ledger_id' => $data['ledger_id']])
                                ->where('MONTH(invoice_date)', $data['month'])
                                ->get();
            return $query->result_array();
        }   
    }

    public function getBudgetLedgerDataDrQuarterly($data=array())
    {
    	if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where(['dr_cr' => 'dr'])
                                ->where(['ledger_id' => $data['ledger_id']])
                                ->where('MONTH(invoice_date) >=', $data['from'])
                                ->where('MONTH(invoice_date) <=', $data['to'])
                                ->get();
            return $query->result_array();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where(['dr_cr' => 'dr'])
                                ->where(['ledger_id' => $data['ledger_id']])
                                ->where('MONTH(invoice_date) >=', $data['from'])
                                ->where('MONTH(invoice_date) <=', $data['to'])
                                ->get();
            return $query->result_array();
        } 
    }

    public function getBudgetLedgerDataDrYearly($data=array())
    {
    	// echo "<pre>"; print_r($data); 
    	if($_SESSION['wo_role'] == 'superadmin'){
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                // ->where(['company_id' => $this->session->userdata['wo_company']])
                                ->where(['dr_cr' => 'dr'])
                                ->where(['ledger_id' => $data['ledger_id']])
                                ->where('YEAR(invoice_date)', $data['year'])
                                ->get();
            return $query->result_array();
        }else
        {
            $query = $this->db->select('*')
                                ->from('wo_purchaseledger')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                ->where(['dr_cr' => 'dr'])
                                ->where(['ledger_id' => $data['ledger_id']])
                                ->where('YEAR(invoice_date)', $data['year'])
                                ->get();
            return $query->result_array();
        } 
    }


	// public function fetchLedgerJournalData($ledger_id='')
	// {
	// 	$query = $this->db->select('*')
	// 						->from('wo_journal')
	// 						->or_where('wo_journal.cr_ledgerid', $ledger_id)
	// 						->or_where('wo_journal.dr_ledgerid', $ledger_id)
	// 						->order_by('created_date', 'asc')
	// 						// ->join('wo_vouchers', 'wo_vouchers.ledger_id = wo.id', 'left')
	// 						// ->join('wo_receiptvouchers', 'wo_receiptvouchers.ledger_id = wo_ledger.id', 'left')
	// 						// ->join('wo_journal', 'wo_journal.ledger_id = wo_ledger.id', 'left')
	// 						->get();
	// 	return $query->result_array();
	// }

	// public function fetchLedgerData($ledger_id='')
	// {
	// 	$query = $this->db->select('wo_ledger.id as lid, wo_ledger.opening_balance as lopbal, wo_ledger.closing_balance as lclbal, wo_vouchers.id as vid, wo_vouchers.voucherno as vno, wo_vouchers.date as vdate, wo_vouchers.adjustment as vadj, wo_vouchers.paymenttype_id as vpmethod, wo_vouchers.amount as vamt, wo_vouchers.referernceno as vref, wo_vouchers.remark as vremark, wo_vouchers.opening_stock as vopbal, wo_vouchers.closing_stock as vclbal, wo_receiptvouchers.id as rid, wo_receiptvouchers.voucherno as rno, wo_receiptvouchers.date as rdate, wo_receiptvouchers.adjustment as rads, wo_receiptvouchers.paymenttype_id as rpmethod, wo_receiptvouchers.amount as ramt, wo_receiptvouchers.referernceno as rref, wo_receiptvouchers.remark as rremark, wo_receiptvouchers.opening_stock as ropbal, wo_receiptvouchers.closing_stock as rclbal,')
	// 						->from('wo_ledger')
	// 						->where('wo_ledger.id', $ledger_id)
	// 						->order_by('wo_vouchers.created_date', 'asc')
	// 						->join('wo_vouchers', 'wo_vouchers.ledger_id = wo_ledger.id', 'left')
	// 						->join('wo_receiptvouchers', 'wo_receiptvouchers.ledger_id = wo_ledger.id', 'left')
	// 						// ->join('wo_journal', 'wo_journal.ledger_id = wo_ledger.id', 'left')
	// 						->get();
	// 	return $query->result_array();
	// }

	

	// sales invoice, sales exchange
    public function outWardsDataBySKU($skuId='')
    {
    	// echo "<pre>"; print_r($skuId);
    	$query = $this->db->select('*')
    						->from('wo_salesinvoicedata')
    						->where('sku', $skuId)
    						->where(['inventory_type !=' => 'salesorder', 'sales_exchange !=' => 'return item'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->result_array();
    }
    
    public function outWardsDataBySKU2($skuId='')
    {
    	// echo "<pre>"; print_r($skuId);
    	$query = $this->db->select('SUM(quantity) as qty, wo_salesinvoicedata.*')
    						->from('wo_salesinvoicedata')
    						->where('sku', $skuId)
    						->where(['inventory_type !=' => 'salesorder', 'sales_exchange !=' => 'return item'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->row_array();
    }

    public function outWardsDataBySKU3($data=array())
    {
        // echo "<pre>"; print_r($skuId);
        $query = $this->db->select('SUM(quantity) as qty, wo_salesinvoicedata.*')
                            ->from('wo_salesinvoicedata')
                            ->where(['sku' => $data['sku'] ])
                            ->where(['inventory_type !=' => 'salesorder', 'sales_exchange !=' => 'return item'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function outWardsDataBySKU4($data=array())
    {
        $query = $this->db->query('select SUM(quantity) as qty, wo_salesinvoicedata.* FROM wo_salesinvoicedata WHERE  sku = '.$data['sku'].' AND baseprice >= '.$data['mrpfrom'].' AND baseprice <= '.$data['mrpto'].'  AND inventory_type != "salesorder" AND sales_exchange != "return item" ');

        return $query->row_array();
    }

    public function outWardsDataBySKU5($data=array())
    {
        $query = $this->db->query('select SUM(quantity) as qty, wo_salesinvoicedata.* FROM wo_salesinvoicedata WHERE  sku = '.$data['sku'].' AND created_date >= '.$data['fromDate'].' AND created_date <= '.$data['toDate'].'  AND inventory_type != "salesorder" AND sales_exchange != "return item" ');

        return $query->row_array();
    }

    public function outWardsDataBySKU6($data=array())
    {
        // echo "<pre>"; print_r($data);
        $query = $this->db->query('select SUM(quantity) as qty, wo_salesinvoicedata.* FROM wo_salesinvoicedata WHERE  sku = '.$data['sku'].' AND baseprice >= '.$data['mrpfrom'].' AND baseprice <= '.$data['mrpto'].' AND created_date >= '.$data['fromDate'].' AND created_date <= '.$data['toDate'].'  AND inventory_type != "salesorder" AND sales_exchange != "return item" ');

        return $query->row_array();
    }

	// wsp, internal consumption,
    public function outWardsDataBySKU1($skuId='')
    {
    	// echo "<pre>"; print_r($skuId);
    	$query = $this->db->select('SUM(qty) as qty2, wo_inventorydata.*')
    						->from('wo_inventorydata')
    						->where('sku', $skuId)
    						->where(['inventory_type !=' => 'inventoty_excesses'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->row_array();
    }

    // production
    public function outWardsProductionDataBySKU1($skuId='')
    {
    	// echo "<pre>"; print_r($skuId);
    	$query = $this->db->select('*')
    						->from('wo_productionproduct')
    						->where('sku', $skuId)
    						->where(['type =' => 'production'])
                            ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->result_array();
    }

    public function fecthMaterial($data=array())
    {
        $query = $this->db->select('*')
                                ->from('wo_productionmaterial')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                // ->where('production_id', $data['id'])
                                // ->where('production_type', $data['type'])
                                ->get();
            return $query->result_array();
    }
    
    public function fecthAllMaterialDataByBarcode($id='')
	{
        $query = $this->db->select('SUM(quantity) as qty, wo_productionmaterial.*')
							->from('wo_productionmaterial')
							->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
							->where('product_no', $id)
							->where('production_type', 'production')
							->get();
		return $query->row_array();
	}
	
	public function fecthAllMaterialDataBySku($skuId='')
	{
        $query = $this->db->select('SUM(wo_productionmaterial.quantity) as qty, wo_productionmaterial.*')
							->from('wo_productionmaterial')
							->where(['wo_items.company_id' => $this->session->userdata['wo_company'], 'wo_items.store_id' => $this->session->userdata['wo_store']])
							->where('wo_product.id', $skuId)
				// 			->where('production_type', 'production')
				            ->join('wo_items', 'wo_items.id = wo_productionmaterial.product_no', 'left')
				            ->join('wo_product', 'wo_product.id = wo_items.sku_code', 'left')
							->get();
		return $query->row_array();
	}

    // Inwards Purchase Invoice Data
    public function fetchPurchaseInvoiceGroupByID($skuId='')
    {
    	$query = $this->db->select('*')
    						->from('wo_purchaseorderdata')
    						->where('sku_id', $skuId)
    						->where(['ordertype !=' => 'porder'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->group_by('order_id')
    						->get();
    	return $query->result_array();
    }
    
    public function fetchPurchaseInvoiceGroupByID1($skuId='')
    {
    	$query = $this->db->select('SUM(quantity) as qty, wo_purchaseorderdata.*')
    						->from('wo_purchaseorderdata')
    						->where('sku_id', $skuId)
    						->where(['ordertype !=' => 'porder'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->row_array();
    }

    public function fetchPurchaseInvoiceGroupByID2($data=array())
    {
        $query = $this->db->select('SUM(quantity) as qty, wo_purchaseorderdata.*')
                            ->from('wo_purchaseorderdata')
                            ->where(['sku_id' => $data['sku'], 'location_id' => $data['loc']])
                            ->where(['ordertype !=' => 'porder'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function fetchPurchaseInvoiceGroupByID3($data=array())
    {
        // echo "<pre>"; print_r($data);

        // SELECT * FROM `wo_purchaseorderdata` WHERE mrp_price >= 650 AND mrp_price <= 1500 
        // $query = $this->db->select('SUM(quantity) as qty, wo_purchaseorderdata.*')
        $query = $this->db->query('select SUM(quantity) as qty, wo_purchaseorderdata.* FROM `wo_purchaseorderdata` WHERE mrp_price >= '.$data['mrpfrom'].' AND mrp_price <= '.$data['mrpto'].' AND sku_id = '.$data['sku'].' AND location_id = '.$data['loc'].' AND ordertype != "porder" ');
                            // ->from('wo_purchaseorderdata')
                            // ->where(['sku_id' => $data['sku'], 'location_id' => $data['loc']])
                            // ->where(['mrp_price' >=  $data['mrpfrom'], 'mrp_price' <= $data['mrpto']])
                            // ->where(['ordertype !=' => 'porder'])
                            // // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            // ->get();
        return $query->row_array();
    }

    public function fetchPurchaseInvoiceGroupByID4($data=array())
    {
        // SELECT * FROM `wo_purchaseorderdata` WHERE mrp_price >= 650 AND mrp_price <= 1500 
        // $query = $this->db->select('SUM(quantity) as qty, wo_purchaseorderdata.*')
        $query = $this->db->query('select SUM(quantity) as qty, wo_purchaseorderdata.* FROM `wo_purchaseorderdata` WHERE created_date >= "'.$data['fromDate'].'" AND created_date <= "'.$data['toDate'].'" AND sku_id = '.$data['sku'].' AND location_id = '.$data['loc'].' AND ordertype != "porder" ');
                            // ->from('wo_purchaseorderdata')
                            // ->where(['sku_id' => $data['sku'], 'location_id' => $data['loc']])
                            // ->where(['mrp_price' >=  $data['mrpfrom'], 'mrp_price' <= $data['mrpto']])
                            // ->where(['ordertype !=' => 'porder'])
                            // // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            // ->get();
        // echo "<pre>"; print_r($query); exit();
        return $query->row_array();
    }

    public function fetchPurchaseInvoiceGroupByID5($data=array())
    {
        // SELECT * FROM `wo_purchaseorderdata` WHERE mrp_price >= 650 AND mrp_price <= 1500 
        // $query = $this->db->select('SUM(quantity) as qty, wo_purchaseorderdata.*')
        $query = $this->db->query('select SUM(quantity) as qty, wo_purchaseorderdata.* FROM `wo_purchaseorderdata` WHERE  mrp_price >= '.$data['mrpfrom'].' AND mrp_price <= '.$data['mrpto'].'  AND created_date >= '.$data['fromDate'].' AND created_date <= '.$data['toDate'].' AND sku_id = '.$data['sku'].' AND location_id = '.$data['loc'].' AND ordertype != "porder" ');
                            // ->from('wo_purchaseorderdata')
                            // ->where(['sku_id' => $data['sku'], 'location_id' => $data['loc']])
                            // ->where(['mrp_price' >=  $data['mrpfrom'], 'mrp_price' <= $data['mrpto']])
                            // ->where(['ordertype !=' => 'porder'])
                            // // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            // ->get();
        // echo "<pre>"; print_r($query); exit();
        return $query->row_array();
    }

    // Inwards Opening Stock and Production Data
    public function fetchOStockGroupByID($skuId='')
    {
    	// echo $skuId;
    	$query = $this->db->select('*')
    						->from('wo_inventoryopeningitem')
    						->where('sku', $skuId)
                            ->group_by('order_id')
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->result_array();
    }

    // Inwards excesses Data
    public function fetchExcessesGroupByID($skuId='')
    {
    	$query = $this->db->select('*')
    						->from('wo_inventorydata')
    						->where('sku', $skuId)
    						->where('inventory_type', 'inventoty_excesses')
                            ->group_by('inventory_id')
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->result_array();
    }
    
    public function fetchExcessesGroupByID1($skuId='')
    {
        // echo "<pre>"; print_r($skuId);
    	$query = $this->db->select('SUM(qty) as qty1,wo_inventorydata.*')
    						->from('wo_inventorydata')
    						->where('sku', $skuId)
    						->where('inventory_type', 'inventoty_excesses')
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->row_array();
    }

    public function fetchExcessesGroupByID2($data=array())
    {
        $query = $this->db->query('select SUM(qty) as qty1, wo_inventorydata.* FROM `wo_inventorydata` WHERE  finalprice >= '.$data['mrpfrom'].' AND finalprice <= '.$data['mrpto'].' AND sku => '.$data['sku'].'  AND inventory_type = "inventoty_excesses" ');
        return $query->row_array();
    }

    public function fetchExcessesGroupByID3($data=array())
    {
        $query = $this->db->query('select SUM(qty) as qty1, wo_inventorydata.* FROM `wo_inventorydata` WHERE  created_date >= "'.$data['fromDate'].'" AND created_date <= "'.$data['toDate'].'" AND sku => '.$data['sku'].'  AND inventory_type = "inventoty_excesses" ');
        return $query->row_array();
    }

    public function fetchExcessesGroupByID4($data=array())
    {
        $query = $this->db->query('select SUM(qty) as qty1, wo_inventorydata.* FROM `wo_inventorydata` WHERE finalprice >= '.$data['mrpfrom'].' AND finalprice <= '.$data['mrpto'].' created_date >= "'.$data['fromDate'].'" AND created_date <= "'.$data['toDate'].'" AND sku => '.$data['sku'].'  AND inventory_type = "inventoty_excesses" ');
        return $query->row_array();
    }

    
    // Inwards sales exchange Data
    public function fetchSExchangeGroupByID($skuId='')
    {
    	$query = $this->db->select('*')
    						->from('wo_salesinvoicedata')
    						->where('sku', $skuId)
    						->where(['inventory_type' => 'salesexchange', 'sales_exchange' => 'return item'])
                            ->group_by('inventory_id')
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->result_array();
    }
    
    public function fetchSExchangeGroupByID1($skuId='')
    {
    	$query = $this->db->select('SUM(quantity) as qty ,wo_salesinvoicedata.*')
    						->from('wo_salesinvoicedata')
    						->where('sku', $skuId)
    						->where(['inventory_type' => 'salesexchange', 'sales_exchange' => 'return item'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->row_array();
    }

    public function fetchSExchangeGroupByID2($data=array())
    {
        $query = $this->db->select('SUM(quantity) as qty ,wo_salesinvoicedata.*')
                            ->from('wo_salesinvoicedata')
                            ->where('sku', $data['sku'])
                            ->where(['inventory_type' => 'salesexchange', 'sales_exchange' => 'return item'])
                            ->where(['finalprice >=' => $data['mrpfrom'], 'finalprice <=' => $data['mrpfrom']])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

     public function fetchSExchangeGroupByID3($data=array())
    {
        $query = $this->db->select('SUM(quantity) as qty ,wo_salesinvoicedata.*')
                            ->from('wo_salesinvoicedata')
                            ->where('sku', $data['sku'])
                            ->where(['inventory_type' => 'salesexchange', 'sales_exchange' => 'return item'])
                            ->where(['created_date >=' => $data['fromDate'], 'created_date <=' => $data['toDate']])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function fetchSExchangeGroupByID4($data=array())
    {
        $query = $this->db->query('select SUM(quantity) as qty, wo_salesinvoicedata.* FROM wo_salesinvoicedata WHERE baseprice >= '.$data['mrpfrom'].' AND baseprice <= '.$data['mrpto'].' AND created_date >= "'.$data['fromDate'].'" AND created_date <= "'.$data['toDate'].'" AND sku >= '.$data['sku'].'  AND inventory_type = "salesexchange" AND sales_exchange = "return item" ');
        return $query->row_array();
    }

    public function fetchInwardsDataByPurchaseID($purchaseid='', $skuId)
    {
    	$query = $this->db->select('*')
    						->from('wo_items')
    						->where(['purchase_id' => $purchaseid, 'sku_code' => $skuId])
                            ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->result_array();
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
    	return $query->result_array();
    }

	// wsp, internal consumption,
    public function outWardsDataByBarcode1($pno='')
    {
    	$query = $this->db->select('*')
    						->from('wo_inventorydata')
    						->where('pno', $pno)
    						->where(['inventory_type !=' => 'inventoty_excesses'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->result_array();
    }

    // production
    public function outWardsProductionDataByBarcode1($pno='')
    {
    	// echo "<pre>"; print_r($skuId);
    	$query = $this->db->select('*')
    						->from('wo_productionmaterial')
    						->where('product_no', $pno)
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
    						->get();
    	return $query->result_array();
    }



    // Custome Report
    public function fetchPurchaseInvoiceGroupByIDCR($skuId='')
    {
        $query = $this->db->select('*')
                            ->from('wo_purchaseorderdata')
                            ->where('sku_id', $skuId)
                            ->where(['ordertype !=' => 'porder'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->group_by('order_id')
                            ->get();
        return $query->row_array();
    }

    public function fetchOStockGroupByIDCR($skuId='')
    {
        // echo $skuId;
        $query = $this->db->select('*')
                            ->from('wo_inventoryopeningitem')
                            ->where('sku', $skuId)
                            ->group_by('order_id')
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }
    
    public function fetchOStockGroupByIDCR1($skuId='')
    {
        // echo $skuId;
        $query = $this->db->select('SUM(quality) as qty , wo_inventoryopeningitem.*')
                            ->from('wo_inventoryopeningitem')
                            ->where('sku', $skuId)
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function fetchOStockGroupByIDCR2($data=array())
    {
        // echo $skuId;
        $query = $this->db->select('SUM(quality) as qty , wo_inventoryopeningitem.*')
                            ->from('wo_inventoryopeningitem')
                            ->where(['sku' => $data['sku'], 'location' => $data['loc']])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function fetchOStockGroupByIDCR3($data=array())
    {
        $query = $this->db->query('select SUM(quality) as qty, wo_inventoryopeningitem.* FROM `wo_inventoryopeningitem` WHERE mrp >= '.$data['mrpfrom'].' AND mrp <= '.$data['mrpto'].' AND sku = '.$data['sku'].' AND location = '.$data['loc'].'');

        return $query->row_array();
    }

    public function fetchOStockGroupByIDCR4($data=array())
    {
        // echo "<pre>"; print_r($data);
        $query = $this->db->query('select SUM(quality) as qty, wo_inventoryopeningitem.* FROM `wo_inventoryopeningitem` WHERE sku = '.$data['sku'].' AND location = '.$data['loc'].' AND created_date >= "'.$data['fromDate'].'" AND created_date <= "'.$data['toDate'].'" ');

// SELECT SUM(quality) as qty FROM `wo_inventoryopeningitem` WHERE sku = '105' AND location = '1' AND created_date >= '2016-09-01' AND created_date <= '2019-09-12' 

        return $query->row_array();
    }

    public function fetchOStockGroupByIDCR5($data=array())
    {
        $query = $this->db->query('select SUM(quality) as qty, wo_inventoryopeningitem.* FROM `wo_inventoryopeningitem` WHERE mrp >= '.$data['mrpfrom'].' AND mrp <= '.$data['mrpto'].' AND created_date >= "'.$data['fromDate'].'" AND created_date <= "'.$data['toDate'].'" AND sku = '.$data['sku'].' AND location = '.$data['loc'].'');

        return $query->row_array();
    }

    public function fetchExcessesGroupByIDCR($skuId='')
    {
        $query = $this->db->select('*')
                            ->from('wo_inventorydata')
                            ->where('sku', $skuId)
                            ->where('inventory_type', 'inventoty_excesses')
                            ->group_by('inventory_id')
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function fetchSExchangeGroupByIDCR($skuId='')
    {
        $query = $this->db->select('*')
                            ->from('wo_salesinvoicedata')
                            ->where('sku', $skuId)
                            ->where(['inventory_type' => 'salesexchange', 'sales_exchange' => 'return item'])
                            ->group_by('inventory_id')
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function outWardsDataBySKUCR($skuId='')
    {
        // echo "<pre>"; print_r($skuId);
        $query = $this->db->select('*')
                            ->from('wo_salesinvoicedata')
                            ->where('sku', $skuId)
                            ->where(['inventory_type !=' => 'salesorder', 'sales_exchange !=' => 'return item'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function outWardsDataBySKU1CR($skuId='')
    {
        // echo "<pre>"; print_r($skuId);
        $query = $this->db->select('*')
                            ->from('wo_inventorydata')
                            ->where('sku', $skuId)
                            ->where(['inventory_type !=' => 'inventoty_excesses'])
                            // ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function outWardsProductionDataBySKU1CR($skuId='')
    {
        // echo "<pre>"; print_r($skuId);
        $query = $this->db->select('*')
                            ->from('wo_productionproduct')
                            ->where('sku', $skuId)
                            ->where(['type =' => 'production'])
                            ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }

    public function fecthMaterialCR($data=array())
    {
        $query = $this->db->select('*')
                                ->from('wo_productionmaterial')
                                ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                                // ->where('production_id', $data['id'])
                                // ->where('production_type', $data['type'])
                                ->get();
        return $query->row_array();
    }

    public function fetchDataBySkuCode1($sku_code='')
    {
        $query = $this->db->select('SUM(qty) as sumQty, SUM(balQty) as sumbalqty, qty, balQty, basic_rate, mrp, unit_id, item_status')
                            ->from('wo_items')
                            ->where('sku_code', $sku_code)
                            ->where(['company_id' => $this->session->userdata['wo_company'], 'store_id' => $this->session->userdata['wo_store']])
                            ->get();
        return $query->row_array();
    }


}