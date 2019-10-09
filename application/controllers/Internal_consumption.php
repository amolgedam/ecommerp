<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Internal_consumption extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Internal Consumption';
		
		$this->load->model('model_ledger');
		$this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
		
		$this->load->model('model_internalconsumption');
		$this->load->model('model_sku');
		$this->load->model('model_category');

        $this->load->model('model_barcode');

        $this->load->model('model_openingstock');
        $this->load->model('model_openingitem');

        $this->load->model('model_purchaseinvoice');
		$this->load->model('model_purchaseitem');
        $this->load->model('model_company');
        
	}
	
	public function fetchAllData()
	{
	    $data = $this->model_internalconsumption->fecthAllData();
	   // echo "<pre>"; print_r($data);
	   // exit;

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
                
                $buttons .= '&nbsp; <a href="'.base_url().'internal_consumption/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'internal_consumption/delete/'.$value['id'].'/inventoty_consumption" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                
                $result['data'][$key] = array(
                                                
                                                $no,
                                                $value['inventory_no'],
                                                $value['date'],
                                                $value['tot_amt'],
                                                $buttons
                                            );
                $no++;
            }
        }
        // print_r($result);
        echo json_encode($result);
        exit;
	}
	
	public function fetchDataByBarcodeId()
	{
	   // $barcode = '0000006276';
	    $barcode = $_POST['barcode_code'];
	    
	    $data = $this->model_barcode->fetchAllDataByBarcode($barcode);
        // echo "<pre>"; print_r($data); exit();
	   // $orderData = $this->model_internalconsumption->fetchPurchaseData($data['purchase_id']);
	    // $purchaseData = $this->model_internalconsumption->fetchPurchaseData($data['purchase_id']);
	    
	    
        if($data['purchase_type'] == 'opening_stock')
        {
            $orderData = $this->model_openingitem->fecthAllDataByID($data['product_id']);
            $base_price = $orderData['base_price'];
            $wsp_price = $orderData['wspp'];
            $sku = $orderData['sku'];
            $cate_id = $orderData['product_category'];
            $subcat_id = $orderData['product_subcategory'];
        }
        else if($data['purchase_type'] == 'pinvoice')
        {
            $orderData = $this->model_purchaseitem->fecthAllDataByID($data['product_id']);
            $base_price = $orderData['base_price'];
            $wsp_price = $orderData['wsp_price'];
            $sku = $orderData['sku_id'];
            $cate_id = $orderData['pcategories_id'];
            $subcat_id = $orderData['psubcat_id'];
        }

        $skuData = $this->model_sku->fecthSkuDataByID($sku);

        $catData = $this->model_category->fecthCatDataByID($cate_id);
        $subcatData = $this->model_category->fecthSubCatDataByID($subcat_id);
        
        // echo "<pre>"; print_r($data);
        // echo "<pre>"; print_r($purchaseData);
        // echo "<pre>"; print_r($orderData);
        // echo "<pre>"; print_r($skuData);
        // echo "<pre>"; print_r($catData);
        // echo "<pre>"; print_r($subcatData);

	   $result = array(
                        'pnoid' => $data['id'],
                        'pno' => $data['barcode'],
                        'baseprice' => $base_price,
                        'mrp' => $data['mrp'],
                        'netprice' => $data['pur_netprice'],
                        'grossprice' => $wsp_price,
                        'skuid' => $skuData['id'],
                        'sku' => $skuData['product_code'],
                        'cat' => $catData['catgory_name'],
                        'subcat' => $subcatData['subcategory_name'],
                        'status' => $data['item_status'],
                    );
                         
        // echo "<pre>"; print_r($result); exit();
	    echo json_encode($result);
	}

	public function index()
	{
		$this->render_template('admin_view/inventory/internalConsumssion/index', $this->data);
	}

	public function create()
	{
	    $this->form_validation->set_rules('no_ofproduct', 'Purchase Code', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) 
	    {
    	    // echo "<pre>"; print_r($_POST); exit();
	        $data = array(
        					'inventory_no' => $this->input->post('inventory_no'),
        					'date' => $this->input->post('date'),
        					'account' => $this->input->post('account'),
        					'division' => $this->input->post('division'),
        					// 'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'shipping_type' => $this->input->post('shipping_type'),
        					'no_products' => $this->input->post('no_ofproduct'),
        					'base_total' => $this->input->post('base_total'),
        					'total_discount' => $this->input->post('total_discount'),
        					'gross_total' => $this->input->post('gross_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'adjustment' => $this->input->post('adjustment'),
        					'tot_amt' => $this->input->post('total_amt'),
        					'totinvoice_value' => $this->input->post('total_invoice'),
        					'inventory_type' => "inventoty_consumption",
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);
            // 	echo "<pre>"; print_r($data); exit;

            // $count_product = count($_POST['pno']);
                
            //     for($i=0; $i<$count_product; $i++)
            //     {
            //         $itemData = $this->model_barcode->fetchAllDataByBarcode($this->input->post('pno')[$i]);

            //         $itemUpdateData = array(
            //                                     'id' => $itemData['id'],
            //                                     'item_status' => 'soldout',
            //                                     'modified_by' => $this->session->userdata('wo_id')
            //                                 );

            //         $itemStockData = $this->model_barcode->fetchDataByid($itemData['itemstock_id']);

            //     }
            //     echo "<pre>"; print_r($itemData);
            //     echo "<pre>"; print_r($itemUpdateData);
            //     echo "<pre>"; print_r($itemStockData);
            // exit();
        	$created_id = $this->model_internalconsumption->create($data);
        	
        	if($created_id == true) {
        	       
        	    $count_product = count($_POST['pno']);
        	    
        	    for($i=0; $i<$count_product; $i++)
    	        {
    	           // echo $i;
    	            $inventoryData = array(
    	                            'inventory_id' => $created_id,
    	                            'inventory_type' => "inventoty_consumption",
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
 
                    $itemData = $this->model_barcode->fetchAllDataByBarcode($this->input->post('pnoname')[$i]);

                    $newQty = $itemData['balQty'] - $this->input->post('quantity')[$i];

                    $barcodeStatus = '';

                    if($newQty <= 0)
                    {
                        $barcodeStatus = 'soldout';
                        $newQty = 0;
                    }
                    else
                    {
                        $barcodeStatus = 'available';
                    }

                    $newBarcodeData = array(
                                                'id' => $itemData['id'],
                                                'item_status' => $barcodeStatus,
                                                'balQty' => $newQty,
                                                'modified_by' => $this->session->userdata('wo_id')
                                            );

                    $this->model_barcode->update($newBarcodeData);

                    // $itemUpdateData = array(
                    //                             'id' => $itemData['id'],
                    //                             'item_status' => 'soldout',
                    //                             'modified_by' => $this->session->userdata('wo_id')
                    //                         );

                    // $this->model_barcode->update($itemUpdateData);

                    // $itemStockData = $this->model_barcode->fetchDataByid($itemData['itemstock_id']);

                    // $updateQty = $itemStockData['available_qty'] - $this->input->post('quantity')[$i];

                    // $itemStockUpdateData = array(
                    //                                 'id' => $itemStockData['id'],
                    //                                 'available_qty' => $updateQty,
                    //                                 'modified_by' => $this->session->userdata('wo_id')
                    //                             );

                    // $this->model_barcode->updateStock($itemStockUpdateData);

                    // $item_statusData = array(
                    //                             'itemstock_id' => $itemStockData['id'],
                    //                             'item_id' => $itemData['id'],
                    //                             'status' => 'inventoty_consumption',
                    //                             'company_id' => $this->session->userdata('wo_company'),
                    //                             // 'city_id' => $this->session->userdata('wo_city'),
                    //                             'store_id' => $this->session->userdata('wo_store'),
                    //                             'created_by' => $this->session->userdata('wo_id')
                    //                         );

                    // $this->model_barcode->createStatus($item_statusData);
        	    }
    	        
        		
        		$this->session->set_flashdata('feedback','Data Saved Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('internal_consumption');
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('internal_consumption/create');
        	}
	    }
	    else
	    {
	        $orderNo = $this->model_internalconsumption->lastrecord();
        	
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
    	   // echo $code;
    	   // exit;
    	   
    	   
	        $this->data['ledger'] = $this->model_ledger->fecthAllData1();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    		$this->render_template('admin_view/inventory/internalConsumssion/create', $this->data);    
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    
	    $this->form_validation->set_rules('inventory_no', 'Inventory Code', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) 
	    {
	       // echo "<pre>"; print_r($_POST); exit();
	        
	        $data = array(
        					'id' => $this->input->post('id'),
        					'inventory_no' => $this->input->post('inventory_no'),
        					'date' => $this->input->post('date'),
        					'account' => $this->input->post('account'),
        					'division' => $this->input->post('division'),
        					// 'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'shipping_type' => $this->input->post('shipping_type'),
        					'no_products' => $this->input->post('no_of_product'),
        					'base_total' => $this->input->post('base_total'),
        					'total_discount' => $this->input->post('total_discount'),
        					'gross_total' => $this->input->post('gross_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'adjustment' => $this->input->post('adjustment'),
        					'tot_amt' => $this->input->post('total_amt'),
        					'totinvoice_value' => $this->input->post('total_invoice'),
        					'inventory_type' => "inventoty_consumption",
        					'company_id' => $this->session->userdata('wo_company'),
        				// 	'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
            	// echo "<pre>"; print_r($data); exit;
	        
	        $update = $this->model_internalconsumption->update($data);
        	
	        if($update)
	        {
	            $this->session->set_flashdata('feedback','Record Update Successfully');
				$this->session->set_flashdata('feedback_class','alert alert-success');
				
				return redirect('internal_consumption');
	        }
	        else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('internal_consumption/update/'.$this->input->post('id'));
        	}
	    }
	    else
	    {
	        $this->data['allData'] = $this->model_internalconsumption->fecthAllDataByID($id);
	        
	        $data = array(
	                        'id' => $id,
	                        'inventory_type' => 'inventoty_consumption'
	                    );
	                    
	        $this->data['itemData'] = $this->model_internalconsumption->fecthItemDataByInventoryID($data); 
    	   // exit;
    	    $this->data['ledger'] = $this->model_ledger->fecthLedgerAccountData();
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['branch'] = $this->model_branch->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    
    		$this->render_template('admin_view/inventory/internalConsumssion/update', $this->data);   
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
		$delete = $this->model_internalconsumption->delete($id);	

		if($delete == true) {
            
            $this->model_internalconsumption->deleteItemData($data);	
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('internal_consumption');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('internal_consumption');
    	}
	}

	
}