<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Internal_transfer extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Internal Transfer';
		
		$this->load->model('model_ledger');
		$this->load->model('model_division');
		$this->load->model('model_branch');
        $this->load->model('model_location');
		$this->load->model('model_store');

        $this->load->model('model_gst');

		
		$this->load->model('model_internaltransfer');
		$this->load->model('model_internalconsumption');
		$this->load->model('model_sku');
		$this->load->model('model_category');

        $this->load->model('model_barcode');
        $this->load->model('model_openingstock');
        $this->load->model('model_openingitem');

        $this->load->model('model_purchaseitem');
        $this->load->model('model_company');
        
	}

    public function getBarcodeData()
    {
        $barcode_id = $_POST['barcode_id'];
        // $barcode_id = '529';
        $data = $this->model_barcode->fetchAllDataByBarcodeid($barcode_id);

        // if($data)
        // {            
            // echo "<pre>"; print_r($data); //exit();
            // $sku='';$cate_id='';$subcat_id='';

            // $data = $this->model_barcode->fetchAllDataByBarcode($barcode);
            
            // $orderData = $this->model_internalconsumption->fetchPurchaseData($data['purchase_id']);
            
            // $purchaseData = $this->model_internalconsumption->fetchPurchaseData($data['purchase_id']);
            
            if($data['purchase_type'] == 'popeningstock')
            {
                // echo "Opening Stock";
                // echo $data['product_id'];

                // fecthAllDataByID
                $orderData = $this->model_internaltransfer->fecthAllDataByIDOpeningStock($data['product_id']);
                // echo "<pre>"; print_r($orderData);

                $base_price = $orderData['base_price'];
                $wsp_price = $orderData['wspp'];
                $sku = $orderData['sku'];
                $cate_id = $orderData['product_category'];
                $subcat_id = $orderData['product_subcategory'];
                $gst_id = $orderData['gst'];
            }
            else if($data['purchase_type'] == 'pinvoice')
            {
                // echo "Purchase Invoice";

                $orderData = $this->model_internaltransfer->fecthPurchaseInvoiceDataByID($data['product_id']);
                $base_price = $orderData['base_price'];
                $wsp_price = $orderData['wsp_price'];
                $sku = $orderData['sku_id'];
                $cate_id = $orderData['pcategories_id'];
                $subcat_id = $orderData['psubcat_id'];
                $gst_id = $orderData['gst_id'];

            }
            else if($data['purchase_type'] == 'production')
            {
                $orderData = $this->model_internaltransfer->fecthAllDataByIDOpeningStock($data['product_id']);
                // echo "<pre>"; print_r($orderData);

                $base_price = $orderData['base_price'];
                $wsp_price = $orderData['wspp'];
                $sku = $orderData['sku'];
                $cate_id = $orderData['product_category'];
                $subcat_id = $orderData['product_subcategory'];
                $gst_id = $orderData['gst'];

            }


            $skuData = $this->model_internaltransfer->fecthSkuDataByID($sku);

            $catData = $this->model_category->fecthCatDataByID($cate_id);
            $subcatData = $this->model_category->fecthSubCatDataByID($subcat_id);
            
            // echo "<pre>"; print_r($data);
            // echo "<pre>"; print_r($purchaseData);
            // echo "<pre>"; print_r($orderData);
            // echo "<pre>"; print_r($skuData);
            // echo "<pre>"; print_r($catData);
            // echo "<pre>"; print_r($subcatData);

           $result = array(
                            'barcode_id' => $data['id'],
                            'pno' => $data['barcode'],
                            'baseprice' => $base_price,
                            'gst_id' => $gst_id,
                            'grossprice' => $wsp_price,
                            'sku_id' => $skuData['id'],
                            'sku' => $skuData['product_code'],
                            'cat' => $catData['catgory_name'],
                            'subcat' => $subcatData['subcategory_name'],
                            'status' => $data['item_status'],
                        );
        // }
        // else
        // {
        //     $result = '';
        // }
                             
            // print_r($result);
            echo json_encode($result);
        // echo json_encode($data);
    }

    public function getBarcodesBySKUStore()
    {
        $sku = $_POST['sku'];  // sku_code
        $from_store = $_POST['from_store'];
        // echo $sku = "sku-test-01";
        // $from_store = '10';

        $skuData = $this->model_sku->fecthSkuDataBySkuAndStore($sku, $from_store);
        // echo "<pre>"; print_r($skuData); exit();

        $data = $this->model_barcode->fetchItemBySkuCodeStore($skuData['id'], $from_store);
        // echo "<pre>"; print_r($data); exit();
        echo json_encode($data);
    }
	
	public function fetchAllData()
	{
	    $data = $this->model_internaltransfer->fecthAllData();
	    // echo "<pre>"; print_r($data); exit;

        if(empty($data))
        {
            $result['data'] = '';
        }
        else
        {
	    
    	    $no=1;
            foreach($data as $key => $value)
            {
                $buttons = '';
                
                $buttons .= '&nbsp; <a href="'.base_url().'internal_transfer/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'internal_transfer/delete/'.$value['id'].'/internaltransfer" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                
                if($_SESSION['wo_role'] == 'admin'){

                    if($value['status'] == 'not')
                    {
                        $buttons .= '&nbsp; <a href="'.base_url().'internal_transfer/apply/'.$value['id'].'" onclick="return confirm(\'You are sure?\');" class="btn btn-sm btn-primary"><i class="fa fa-check"></i>Apply</a>';
                    }
                }

                $result['data'][$key] = array(
                                                
                                                $no,
                                                $value['inventory_no'],
                                                $value['date'],
                                                $value['grand_total'],
                                                $buttons
                                            );
                $no++;  
            }
        }
        
        // print_r($result);
        echo json_encode($result);
        exit;
	}

	public function index()
	{
		$this->render_template('admin_view/inventory/internalTransfer/index', $this->data);
	}

	public function create()
	{
	    $this->form_validation->set_rules('date', 'Transfer Date', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE)
	    {
	        // echo "<pre>"; print_r($_POST);exit();
	        $data = array(
        					'inventory_no' => $this->input->post('inventory_no'),
        					'date' => $this->input->post('date'),
        					'fromdivision' => $this->input->post('from_division'),
                            // 'frombranch' => $this->input->post('from_branch'),
        					'fromstore' => $this->input->post('from_store'),
        					'fromlocation' => $this->input->post('from_location'),
        					'todivision' => $this->input->post('to_division'),
        					// 'tobranch' => $this->input->post('to_branch'),
                            'tolcation' => $this->input->post('to_location'),
        					'tostore' => $this->input->post('to_store'),
        					'subtotal' => $this->input->post('sub_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'total_discount' => $this->input->post('total_discount'),
        					'grand_total' => $this->input->post('grand_total'),
        					'inventory_type' => "internaltransfer",
                            'status' => 'not',
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);
        	// echo "Data <pre>"; print_r($data); //exit;
        	
        	$created_id = $this->model_internaltransfer->create($data);
        	// $created_id = "1";
        	
        	if($created_id) {
        
                $count_product = count($_POST['pno']);

                for($i=0; $i<$count_product; $i++)
    	        {
    	           // echo $i;
    	            $inventoryData = array(
            	                            'inventory_id' => $created_id,
            	                            'inventory_type' => "internaltransfer",
                                            'barcode_id' => $this->input->post('barcode_id')[$i],
                        					'pno' => $this->input->post('pno')[$i],
                        					'qty' => $this->input->post('quantity')[$i],
                        					'conversion' => $this->input->post('conversion')[$i],
                        					'conversionvalue' => $this->input->post('conversionvalue')[$i],
                        					'baseprice' => $this->input->post('baseprice')[$i],
                        					'discount' => $this->input->post('discount')[$i],
                        					'disvalue' => $this->input->post('disvalue')[$i],
                        					'grossprice' => $this->input->post('grossprice')[$i],
                        					'gst' => $this->input->post('gst')[$i],
                        					'gstamt' => $this->input->post('gstamt')[$i],
                        					'salesmancomm' => $this->input->post('salesmancomm')[$i],
                        					'finalprice' => $this->input->post('finalprice')[$i],
                        					'sku' => $this->input->post('sku')[$i],
                        					'company_id' => $this->session->userdata('wo_company'),
                        					// 'city_id' => $this->session->userdata('wo_city'),
                        					'store_id' => $this->session->userdata('wo_store'),
                        					'created_by' => $this->session->userdata('wo_id')
                        	            );
                    $this->model_internalconsumption->createInventotyData($inventoryData);

                	// echo "Item Data <pre>"; print_r($inventoryData);

                 //    $itemData = $this->model_barcode->fetchAllDataByBarcode($this->input->post('pno')[$i]);

                 //    $locationData = $this->model_location->fecthAllDataByID($this->input->post('to_location'));

                 //    $itemUpdateData = array(
                 //                                'id' => $itemData['id'],
                 //                                'company_id' => $locationData['company_id'],
                 //                                'city_id' => $locationData['city_id'],
                 //                                'store_id' => $locationData['store_id'],
                 //                                'modified_by' => $this->session->userdata('wo_id')
                 //                            );

                 //    $this->model_barcode->update($itemUpdateData);

                 //    $itemStockData = $this->model_barcode->fetchDataByid($itemData['itemstock_id']);

                 //    $updateQty = $itemStockData['available_qty'] - $this->input->post('quantity')[$i];

                 //    $itemStockUpdateData = array(
                 //                                    'id' => $itemStockData['id'],
                 //                                    'available_qty' => $updateQty,
                 //                                    'modified_by' => $this->session->userdata('wo_id')
                 //                                );

                 //    $this->model_barcode->updateStock($itemStockUpdateData);

                 //    $item_statusData = array(
                 //                                'itemstock_id' => $itemStockData['id'],
                 //                                'item_id' => $itemData['id'],
                 //                                'status' => 'internaltransfer',
                 //                                'company_id' => $this->session->userdata('wo_company'),
                 //                                'city_id' => $this->session->userdata('wo_city'),
                 //                                'store_id' => $this->session->userdata('wo_store'),
                 //                                'created_by' => $this->session->userdata('wo_id')
                 //                            );

                 //    $this->model_barcode->createStatus($item_statusData);
        	    }
                
                // exit();
                
                $this->session->set_flashdata('feedback','Data Saved Successfully');
    			$this->session->set_flashdata('feedback_class','alert alert-success');
    				
    		    return redirect('internal_transfer');
        	}
        	else
        	{
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('internal_transfer/create');
        	}
	    }
	    else
	    {
    	        
    	    $orderNo = $this->model_internaltransfer->lastrecord();
        	
    	    if($orderNo == '')
    	    {
    	        $this->data['opening_no']  = '0000001';
    	       // $code = '0000001';
    	    }
    	    else
    	    {
    	        $np = $orderNo['inventory_no'];
    	        $code = substr($np, 1); 
    	        
    	        $code = $code + 1;
    	        $code = sprintf('%07d',$code);
    	        
    	        $this->data['opening_no'] = $code;
    	    }
    	   
	        $this->data['ledger'] = $this->model_ledger->fetchLedgerDataNotOther(4);
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();

            $company_id = $_SESSION['wo_company'];

    	    $this->data['store'] = $this->model_store->fetchStoreByCompanyID($company_id);
    	    
		    $this->render_template('admin_view/inventory/internalTransfer/create', $this->data);
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('inventory_no', 'Inventory Code', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) 
	    {
	       // echo "<pre>"; print_r($_POST); //exit();
	       
   	        $data = array(
        					'id' => $this->input->post('id'),
                            'inventory_no' => $this->input->post('inventory_no'),
        					'date' => $this->input->post('date'),
        					'fromdivision' => $this->input->post('from_division'),
        					// 'frombranch' => $this->input->post('from_branch'),
        					'fromlocation' => $this->input->post('from_location'),
        					'todivision' => $this->input->post('to_division'),
        					// 'tobranch' => $this->input->post('to_branch'),
        					'tolcation' => $this->input->post('to_location'),
        					'subtotal' => $this->input->post('sub_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'total_discount' => $this->input->post('total_discount'),
        					'grand_total' => $this->input->post('grand_total'),
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),                                
        					'modified_by' => $this->session->userdata('wo_id')
        				);
        	// echo "<pre>"; print_r($data); exit;
        
        	$created_id = $this->model_internaltransfer->update($data);
        	
        	if($created_id)
            {
                $this->session->set_flashdata('feedback','Record Update Successfully');
    			$this->session->set_flashdata('feedback_class','alert alert-success');
    				
    		    return redirect('internal_transfer');
        	}
        	else
        	{
        		$this->session->set_flashdata('feedback','Unable Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('internal_transfer/update/'.$this->input->post('id'));
        	}
	    }
	    else
	    {
    	    $this->data['allData'] = $this->model_internaltransfer->fecthAllDataByID($id);
    	        
            $data = array(
                            'id' => $id,
                            'inventory_type' => 'internaltransfer'
                        );
                        
            $this->data['itemData'] = $this->model_internalconsumption->fecthItemDataByInventoryID($data);
    	    
    	    $this->data['ledger'] = $this->model_ledger->fetchLedgerDataNotOther(4);
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['store'] = $this->model_store->fecthAllStores();

    		$this->render_template('admin_view/inventory/internalTransfer/update', $this->data);    
	    }
	}
    
    public function delete()
	{
	    $id = $this->uri->segment(3);
	    
        $data = array(
                        'id' => $this->uri->segment(3),
                        'inventory_type' => $this->uri->segment(4)
                    );
        // echo $id; exit;
		$delete = $this->model_internaltransfer->delete($id);	

		if($delete == true) {
            
            $this->model_internalconsumption->deleteItemData($data);	
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('internal_transfer');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('internal_transfer');
    	}
	}

    public function apply()
    {
        $id = $this->uri->segment(3);

        $internalTransferData = $this->model_internaltransfer->fecthAllDataByID($id);
        // echo "Internal Transfer Data <pre>"; print_r($internalTransferData); //exit();

        $data = array(
                        'id' => $internalTransferData['id'],
                        'inventory_type' => $internalTransferData['inventory_type']
                    );
        $internalTransferItem  = $this->model_internalconsumption->fecthItemDataByInventoryID($data);
        // echo "Internal Transfer Item Data<pre>"; print_r($internalTransferItem); //exit();

        foreach ($internalTransferItem as $key => $value) {
            
            $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($value['pno']);
            // echo "Barcode Data<pre>"; print_r($barcodeData);

            $data = array(
                            'id' => $value['barcode_id'],
                            'item_status' => 'soldout'
                        );

            $this->model_barcode->update($data);
            // echo "Update Old Barcode <pre>"; print_r($data);

            $newItemsstock = array(
                                    'purchase_id' => $internalTransferData['id'],
                                    'sku_code' => $barcodeData['sku_code'],
                                    'purchase_type' => $internalTransferData['inventory_type'],
                                    'purchase_qty' => $barcodeData['qty'],
                                    'available_qty' => $barcodeData['qty'],
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $internalTransferData['tostore'],
                                    'created_by' => $this->session->userdata('wo_id')
                                );

            $created_id = $this->model_barcode->createStock($newItemsstock);
            // $created_id = 1;
            // echo "New Barcode StockData <pre>"; print_r($newItemsstock);
 
            $item = array(
                            'itemstock_id' => $created_id,
                            'attr_id' => $barcodeData['attr_id'],
                            'sku_code' => $barcodeData['sku_code'],
                            'barcode' => $barcodeData['barcode'],
                            'purchase_id' => $internalTransferData['id'],
                            'product_id' => $value['id'],
                            'pur_netprice' => $barcodeData['pur_netprice'],
                            'mrp' => $barcodeData['mrp'],
                            'wsp' => $barcodeData['wsp'],
                            'qty' => $barcodeData['qty'],
                            'gst_id' => $barcodeData['gst_id'],
                            'purchase_type' => $internalTransferData['inventory_type'],
                            'item_status' => 'available',
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $internalTransferData['tostore'],
                            'created_by' => $this->session->userdata('wo_id')    
                        );

            $success = $this->model_barcode->create($item);
            // echo "New Stock Barcode <pre>"; print_r($item);
        }
// exit();
        if($success)
        {
            $changeStatus = array(
                                    'id' => $internalTransferData['id'],
                                    'status' => 'yes' 
                                );

            $this->model_internaltransfer->update($changeStatus);
            
            $this->session->set_flashdata('feedback','Record Deleted Successfully');
            $this->session->set_flashdata('feedback_class','alert alert-success');
            return redirect('internal_transfer');
        }
        else
        {
            $this->session->set_flashdata('feedback','Unable to Apply Internal Transfer');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            return redirect('internal_transfer');
        }
    }
}