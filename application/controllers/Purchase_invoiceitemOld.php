<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_invoiceitem extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

        error_reporting(0);

		$this->data['page_title'] = 'Purchase';
		
		$this->load->model('model_category');
		$this->load->model('model_discount');
		$this->load->model('model_sku');
		$this->load->model('model_brand');
		$this->load->model('model_unit');
		$this->load->model('model_hsn');
		$this->load->model('model_gst');
		$this->load->model('model_location');
        $this->load->model('model_attribute');
		$this->load->model('model_store'); 
		
		$this->load->model('Model_purchaseitem');
		$this->load->model('Model_purchaseorder');
        $this->load->model('Model_purchaseinvoice');
		$this->load->model('model_ledger');
        $this->load->model('model_journalentry');
        $this->load->model('model_purchaseledger');
        $this->load->model('model_paymentmaster');

        $this->load->model('model_company');
        
        $this->load->model('model_barcode');
        
	}

	public function create()
	{
	    $id = $this->uri->segment(3);
	   // echo $id; exit;
	    
	    $this->form_validation->set_rules('sku', 'SKU ', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {

            // echo "Post Data<pre>"; print_r($_POST);  exit();
            
            $qty='';

            if($_POST['quality'] == '')
            {
                $qty = $_POST['quantitypieces'];   
            }
            else
            {
                $qty = $_POST['quality'];
            }
            
            $orderData = $this->Model_purchaseinvoice->fecthAllDatabyID($this->input->post('order_id'));
            // echo "Order Data<pre>"; print_r($orderData); 


            $gstData = $this->model_gst->fetchAllDataByID($this->input->post('gst'));
            // echo "<pre>"; print_r($gstData); exit();
            $totgst = $gstData['sgst'] + $gstData['cgst'] + $gstData['igst'];
            
            $gst = ($this->input->post('base_price') * $totgst) / 100;
            $price = $this->input->post('base_price') + $gst;
            $mrp = $price * $this->input->post('quality');

            // echo "<pre>"; print_r($gst); exit();
           

            $gamount = $qty * $_POST['base_price'];
            $total_tax = $gamount * $totgst / 100;

            $invoice_value = $orderData['total_invoice'] + $gamount + $total_tax;
            $pur_price = $orderData['gamt'] + $gamount;
            $newgst = $orderData['total_tax'] + $total_tax;
            

        	$order_data = array(
        	                        'id' => $orderData['id'],
        	                        'total_tax' => $newgst,
        	                        'total_invoice' => $invoice_value,
        	                        'gamt' => $pur_price
        	                    );
        	// echo "<pre>"; print_r($total_tax); echo "<pre>"; print_r($gamount); echo "<pre>"; print_r($mrp); //exit();
         //    echo "<pre>"; print_r($order_data); exit;
	        
	        
	        
	        $data = array(
        	                'order_id' => $orderData['id'],
        	                'order_code' => $this->input->post('order_code'),
        	               // 'pcategories_id' => $this->input->post('product_category'),
        	               // 'psubcat_id' => $this->input->post('product_subcategory'),
        					'sku_id' => $this->input->post('sku'),
        				    'brand_id' => $this->input->post('brand'),
        					'unit_id' => $this->input->post('unitid'),
        					'hsn_id' => $this->input->post('hsn'),
        					'quantity' => $qty,
        					'base_price' => $this->input->post('base_price'),
        					'gst_id' => $this->input->post('gst'),
                            'pnetprice' => $this->input->post('pur_price'),
        				    'wsp' => $this->input->post('wsp'),
        				    'wsp_price' => $this->input->post('wspp'),
        					'location_id' => $this->input->post('location'),
        					'mrp_price' => $this->input->post('mrp'),
        					'discount_id' => $this->input->post('discount_code'),
        					'salesman_commision' => $this->input->post('comm'),
                            'remark' => $this->input->post('remark'),
        					'ordertype' => 'pinvoice',
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

            // 	echo "<pre>"; print_r($data); exit();
            // $create = true;
        	$create = $this->Model_purchaseitem->create($data);

        	if($create == true) {
        		
        		$this->Model_purchaseinvoice->update($order_data);
        		
        // 		if($_POST['formSave'])
        // 		{
    				// $this->session->set_flashdata('feedback','Data Saved Successfully');
    				// $this->session->set_flashdata('feedback_class','alert alert-success');
    				// return redirect('purchase_order/update/'.$this->input->post('order_id'));  
        // 		}
        // 		else
        // 		{
    				return redirect('purchase_invoiceitem/createItem/'.$orderData['id']."/".$this->input->post('order_code')."/".$qty);         		    
        // 		}
        		
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('purchase_invoiceitem');
        	}
	    }
	    else
	    {
	        $this->data['id'] = $id;
	        
	        $randomCode =  mt_rand(11111111,99999999);
            $this->data['randomCode'] = $randomCode;
        
	        $this->data['category'] = $this->model_category->fecthAllData();
    		$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
    		$this->data['discount'] = $this->model_discount->fecthAllData();
    		$this->data['sku'] = $this->model_sku->fecthSkuAllData();
    		$this->data['brand'] = $this->model_brand->fecthAllData();
    // 		$this->data['unit'] = $this->model_unit->fecthAllCategoryData();
            $this->data['unit'] = $this->model_unit->fecthAllData();
    		$this->data['hsn'] = $this->model_hsn->fecthAllData();
    		$this->data['gst'] = $this->model_gst->fecthAllData();
    		$this->data['location'] = $this->model_location->fecthAllData();
            $this->data['store'] = $this->model_store->fecthAllData();

    		$this->render_template('admin_view/purchase/purchaseInvoice/invevoiceAddItem', $this->data);   
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);
	    $invoice_no = $this->uri->segment(4);
	    //exit;
	    
	    $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
           
            // echo "<pre>"; print_r($_POST); //exit;
        	$newinvoice = $this->input->post('oldwspp') - $this->input->post('wspp'); 
            $orderData = $this->Model_purchaseinvoice->fecthAllDatabyID($this->input->post('invoice_id'));

            $gstData = $this->model_gst->fetchAllDataByID($this->input->post('gst'));
            // echo "<pre>"; print_r($gstData); exit();
            $totgst = $gstData['sgst'] + $gstData['cgst'] + $gstData['igst'];
            
            $gst = ($this->input->post('base_price') * $totgst) / 100;
            $price = $this->input->post('base_price') + $gst;
            $mrp = $price * $this->input->post('quality');

            // echo "<pre>"; print_r($orderData); exit();
            $invoice_value = $orderData['total_invoice'] + $mrp;
            
            
            
            // calculation to delete order Data to update
            $oldQty = $_POST['oldQuality'];
            $oldgamout = $oldQty * $_POST['base_price'];
            
            $oldgstData = $this->model_gst->fetchAllDataByID($this->input->post('gstOld'));
            // echo "<pre>"; print_r($gstData); exit();
            $oldtotgst = $oldgstData['sgst'] + $oldgstData['cgst'] + $oldgstData['igst'];
            $oldtotal_tax = $oldgamout * $oldtotgst / 100;
            
            $oldinvoice_value = $orderData['total_invoice'] - $oldgamout - $oldtotal_tax;
            
            $oldpur_price = $orderData['gamt'] - $oldgamout;
            
            $oldgst = $orderData['total_tax'] - $oldtotal_tax;
            
            // 	$Oldorder_data = array(
        	   //                     'id' => $orderData['id'],
        	   //                     'total_tax' => $oldgst,
        	   //                     'gamt' => $oldpur_price,
        	   //                     'total_invoice' => $oldinvoice_value,
        	                        
        	   //                 );
 
        	                    
            // 	 ==========================================
            $gamount = $_POST['quality'] * $_POST['base_price'];
            $total_tax = $gamount * $totgst / 100;

            $invoice_value = $oldinvoice_value + $gamount + $total_tax;
            $pur_price = $oldpur_price + $gamount;
            $newgst = $oldgst + $total_tax;
            

        	$order_data = array(
        	                        'id' => $orderData['id'],
        	                        'total_tax' => $newgst,
        	                        'gamt' => $pur_price,
        	                        'total_invoice' => $invoice_value,
        	                        
        	                    );
        // 	  echo "<pre>"; print_r($orderData);
        // 	  echo "<pre>"; print_r($Oldorder_data);
            // echo "<pre>"; print_r($order_data); exit();
	        
	       // echo "<pre>"; print_r($orderData); print_r($order_data); exit;
	        $data = array(
        	                'id' => $this->input->post('id'),
        	                'order_id' => $this->input->post('invoice_id'),   //invoice_id
        	                'order_code' => $this->input->post('order_code'),
        	                'pcategories_id' => $this->input->post('product_category'),
        	                'psubcat_id' => $this->input->post('product_subcategory'),
        					'sku_id' => $this->input->post('sku'),
        				    'brand_id' => $this->input->post('brand'),
        					'unit_id' => $this->input->post('unit'),
        					'hsn_id' => $this->input->post('hsn'),
        					'quantity' => $this->input->post('quality'),
        					'base_price' => $this->input->post('base_price'),
        					'gst_id' => $this->input->post('gst'),
                            'pnetprice' => $this->input->post('pur_price'),
        				    'wsp' => $this->input->post('wsp'),
        				    'wsp_price' => $this->input->post('wspp'),
        					'location_id' => $this->input->post('location'),
        					'mrp_price' => $this->input->post('mrp'),
        					'discount_id' => $this->input->post('discount_code'),
        					'salesman_commision' => $this->input->post('comm'),
        					'remark' => $this->input->post('remark'),
                            'ordertype' => 'pinvoice',
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	echo "<pre>"; print_r($data); exit();
        	$create = $this->Model_purchaseitem->update($data);

        	if($create == true) {
        		
        		$this->Model_purchaseinvoice->update($order_data);

                // $itemData = $this->Model_purchaseitem->fetchDataByOrderIDCode($this->input->post('invoice_id'), $this->input->post('order_code'));
                // // echo "<pre>"; print_r($itemData); 
                // $data = array(
                //                 'id' => $itemData['id'],
                //                 'order_id' => $this->input->post('invoice_id'),
                //                 'order_code' => $this->input->post('order_code'),
                //                 'quantity' => $this->input->post('quality'),
                //                 'modified_by' => $this->session->userdata('wo_id')
                //             );

                // $this->Model_purchaseitem->updateItem($data);

        // 		if($_POST['formSave'])
        // 		{
    				// $this->session->set_flashdata('feedback','Data Saved Successfully');
    				// $this->session->set_flashdata('feedback_class','alert alert-success');
    				// return redirect('purchase_order/update/'.$this->input->post('order_id'));  
        // 		}
        // 		else
        // 		{
                    // return redirect('purchase_invoice/update/'.$this->input->post('invoice_id'));                    
    				return redirect('purchase_invoiceitem/createItem/'.$this->input->post('invoice_id')."/".$this->input->post('order_code')."/".$this->input->post('quality'));         		    
        // 		}
        		
        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('Purchase_item');
        	}
	    }
	    else
	    {
	        $this->data['category'] = $this->model_category->fecthAllData();
    		$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
    		$this->data['discount'] = $this->model_discount->fecthAllData();
    		$this->data['sku'] = $this->model_sku->fecthSkuAllData();
    		$this->data['brand'] = $this->model_brand->fecthAllData();
    // 		$this->data['unit'] = $this->model_unit->fecthAllCategoryData();
            $this->data['unit'] = $this->model_unit->fecthAllData();
    		$this->data['hsn'] = $this->model_hsn->fecthAllData();
    		$this->data['gst'] = $this->model_gst->fecthAllData();
    		$this->data['location'] = $this->model_location->fecthAllData();
    		
    		$allData = $this->Model_purchaseitem->fecthAllDataByID($id);
    		
    		$this->data['allData'] = $allData;
	        $this->data['invoice_id'] = $invoice_no;
	        
	        $data = array(
	                        'orderid' => $allData['order_id'],
	                        'order_code' => $allData['order_code']
	                    );
	            
	        $this->data['itemData'] = $this->model_attribute->fetchDataByOrderIDAndOrdercode($data);
	       // echo "<pre>"; print_r($itemData); exit;
	        
	        $this->render_template('admin_view/purchase/purchaseInvoice/invoiceEditItem', $this->data);   
	    }	
	}
	
	
	public function createItem()
	{
	    $this->form_validation->set_rules('orderQuantity', 'Quality', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	           
            // echo "<pre>"; print_r($_POST); //exit;
            
            $oData = array(
                            'order_id' => $_POST['order_id'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => 'pinvoice'
                        );
                        
                        // print_r($oData);
        
            $orderData = $this->Model_purchaseitem->fecthOrderData($oData);
            // echo "<pre>"; print_r($orderData); 
            
            // for PIECES
            if($orderData['unit_id'] == '18')
            {
                // echo $count_qty = count($_POST['qtyList']);
                
                for($i=0; $i<$count_qty; $i++)
                {
                    $data = array(
                                'order_id' => $this->input->post('order_id'),
                                'order_code' => $this->input->post('order_code'),
                                'color' => $this->input->post('colorList')[$i],
                                'size' => $this->input->post('sizeList')[$i],
                                'pattern' => $this->input->post('patternList')[$i],
                                'style1' => $this->input->post('style1List')[$i],
                                'style2' => $this->input->post('style2List')[$i],
                                'type' => $this->input->post('typeList')[$i],
                                'quantity' => '1',
                                'order_name' => 'pinvoice',
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                    // echo "<pre>"; print_r($data);
                    // $create = true;
                    $create = $this->Model_purchaseitem->createItem($data);
                }
                
                $balQty = $_POST['matchQty'] - $count_qty;
                
                if($balQty > 0)
                {
                    for($i=0; $i<$balQty; $i++)
                    {
                        $data = array(
                                    'order_id' => $this->input->post('order_id'),
                                    'order_code' => $this->input->post('order_code'),
                                    'color' => 'none',
                                    'size' => 'none',
                                    'pattern' => 'none',
                                    'style1' => 'none',
                                    'style2' => 'none',
                                    'type' => 'none',
                                    'quantity' => '1',
                                    'order_name' => 'pinvoice',
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                        // echo "<pre>"; print_r($data);
                        // $create = true;
                        $create = $this->Model_purchaseitem->createItem($data);
                    }    
                }
                
            }
            else
            {
                // echo "Not Pieces"; exit;
            
                $count_qty = count($_POST['qtyList']);
            
                for($i=0; $i<$count_qty; $i++)
                {
                    $data = array(
                                'order_id' => $this->input->post('order_id'),
                                'order_code' => $this->input->post('order_code'),
                                'color' => $this->input->post('colorList')[$i],
                                'size' => $this->input->post('sizeList')[$i],
                                'pattern' => $this->input->post('patternList')[$i],
                                'style1' => $this->input->post('style1List')[$i],
                                'style2' => $this->input->post('style2List')[$i],
                                'type' => $this->input->post('typeList')[$i],
                                'quantity' => '1',
                                // 'quantity' => $this->input->post('qtyList')[$i],
                                'order_name' => 'pinvoice',
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                    // echo "<pre>"; print_r($data);
                    // $create = true;
                    $create = $this->Model_purchaseitem->createItem($data);
                }
                
                if($this->input->post('orderQuantity') > 0)
                {
                    $data = array(
                                'order_id' => $this->input->post('order_id'),
                                'order_code' => $this->input->post('order_code'),
                                'color' => 'none',
                                'size' => 'none',
                                'pattern' => 'none',
                                'style1' => 'none',
                                'style2' => 'none',
                                'type' => 'none',
                                'quantity' => '1',
                                'order_name' => 'pinvoice',
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                    // echo "<pre>"; print_r($data);
                    $create = $this->Model_purchaseitem->createItem($data);
                }
                
                // if($create == true) {
                    
                    
                // }
            }
            
            // exit;
            if($create == true) {
                
                $this->session->set_flashdata('feedback','Data Saved Successfully');
    			$this->session->set_flashdata('feedback_class','alert alert-success');
    			return redirect('purchase_invoice/update/'.$this->input->post('order_id'));  
            }
            else
            {
                $this->session->set_flashdata('feedback','Unale to Saved Data');
    			$this->session->set_flashdata('feedback_class','alert alert-danger');
    			
    			return redirect('purchase_invoice/update/'.$this->input->post('order_id'));    
            }
            

            

    //         $count_qty = count($_POST['qtyList']);
            
    //         // exit();

    //         for($i=0; $i<$count_qty; $i++)
    //         {
    //             $data = array(
    //                         'order_id' => $this->input->post('order_id'),
    //                         'order_code' => $this->input->post('order_code'),
    //                         'color' => $this->input->post('colorList')[$i],
    //                         'size' => $this->input->post('sizeList')[$i],
    //                         'pattern' => $this->input->post('patternList')[$i],
    //                         'style1' => $this->input->post('style1List')[$i],
    //                         'style2' => $this->input->post('style2List')[$i],
    //                         'type' => $this->input->post('typeList')[$i],
    //                         'quantity' => $this->input->post('qtyList')[$i],
    //                         'order_name' => 'pinvoice',
    //                         'company_id' => $this->session->userdata('wo_company'),
    //                         // 'city_id' => $this->session->userdata('wo_city'),
    //                         // 'store_id' => $this->session->userdata('wo_store'),
    //                         'created_by' => $this->session->userdata('wo_id')
    //                     );
    //             echo "<pre>"; print_r($data);
    //             $create = true;
    //             // $create = $this->Model_purchaseitem->createItem($data);
    //         }
	   //     // exit();
	   //     if($create == true) {

    //             if($this->input->post('orderQuantity') > 0)
    //             {
    //                 $data = array(
    //                             'order_id' => $this->input->post('order_id'),
    //                             'order_code' => $this->input->post('order_code'),
    //                             'color' => 0,
    //                             'size' => 0,
    //                             'pattern' => 0,
    //                             'style1' => 0,
    //                             'style2' => 0,
    //                             'type' => 0,
    //                             'quantity' => $this->input->post('orderQuantity'),
    //                             'order_name' => 'pinvoice',
    //                             'company_id' => $this->session->userdata('wo_company'),
    //                             // 'city_id' => $this->session->userdata('wo_city'),
    //                             // 'store_id' => $this->session->userdata('wo_store'),
    //                             'created_by' => $this->session->userdata('wo_id')
    //                         );
    //                 echo "<pre>"; print_r($data);
    //                 // $this->Model_purchaseitem->createItem($data);
    //             }
    //             exit;
        		
    // 			$this->session->set_flashdata('feedback','Data Saved Successfully');
    // 			$this->session->set_flashdata('feedback_class','alert alert-success');
    // 			return redirect('purchase_invoice/update/'.$this->input->post('order_id'));  
    // 		}
    //     	else
    //     	{
    //     	    $this->session->set_flashdata('feedback','Unale to Saved Data');
    // 			$this->session->set_flashdata('feedback_class','alert alert-danger');
    			
    // 			return redirect('purchase_invoice/update/'.$this->input->post('order_id'));  
    //     	}
	        
	    }
	    else
	    {
	        $order_id = $this->uri->segment(3);
    	    $order_code = $this->uri->segment(4);
    	    $quantity = $this->uri->segment(5);
    	   // $invoice_id = $this->uri->segment(6);
    	   // exit;
    	    $this->data['order_id'] = $order_id;
    	    $this->data['order_code'] = $order_code;
    	    $this->data['quantity'] = $quantity;
    	   // $this->data['invoice_no'] = $invoice_id;
    	    
    	    $this->render_template('admin_view/purchase/purchaseInvoice/invoiceItem', $this->data);
	    } 
	}

    public function updateItem()
    {
        // echo "hi"; exit;
        
        $this->form_validation->set_rules('orderQuantity', 'Quality', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	     
	        // echo "<pre>"; print_r($_POST); exit;
            $count_qty = count($_POST['qtyList']);

            $data = array(
                            'order_id' => $this->input->post('order_id'),
                            'order_name' => 'pinvoice'
                        );
            // echo "<pre>"; print_r($data);
            $this->Model_purchaseitem->deleteItemByOrderIdName($data);
                
            $sumQty = 0;

            for($i=0; $i<$count_qty; $i++)
            {
                $sumQty = $sumQty + $this->input->post('qtyList')[$i];
            }

            for($i=0; $i<$count_qty; $i++)
            {
                $data = array(
                            'order_id' => $this->input->post('order_id'),
                            'order_code' => $this->input->post('order_code'),
                            'color' => $this->input->post('colorList')[$i],
                            'size' => $this->input->post('sizeList')[$i],
                            'pattern' => $this->input->post('patternList')[$i],
                            'style1' => $this->input->post('style1List')[$i],
                            'style2' => $this->input->post('style2List')[$i],
                            'type' => $this->input->post('typeList')[$i],
                            'quantity' => $this->input->post('qtyList')[$i],
                            'order_name' => 'pinvoice',
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'modified_by' => $this->session->userdata('wo_id')
                        );
                // echo "<pre>"; print_r($data);
                $create = $this->Model_purchaseitem->createItem($data);
            }

            if($this->input->post('orderQuantity') > $sumQty)
            {
                $balQty = $this->input->post('orderQuantity') - $sumQty;
                $data = array(
                                'order_id' => $this->input->post('order_id'),
                                'order_code' => $this->input->post('order_code'),
                                'color' => 0,
                                'size' => 0,
                                'pattern' => 0,
                                'style1' => 0,
                                'style2' => 0,
                                'type' => 0,
                                'quantity' => $balQty,
                                'order_name' => 'opening_stock',
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                // echo "<pre>"; print_r($data);
                $this->Model_purchaseitem->createItem($data);
            }
	        
	        if($create == true) {
        		
    			$this->session->set_flashdata('feedback','Record Update Successfully');
    			$this->session->set_flashdata('feedback_class','alert alert-success');
    			return redirect('purchase_invoice/update/'.$this->input->post('order_id'));  
    		}
        	else
        	{
        	    $this->session->set_flashdata('feedback','Unale to Update Record');
    			$this->session->set_flashdata('feedback_class','alert alert-danger');
    			
    			return redirect('purchase_invoice/update/'.$this->input->post('order_id'));  
        	}
	        
	    }
	    else
	    {
	        $order_id = $this->uri->segment(3);
            $order_code = $this->uri->segment(4);
    	    $quantity = $this->uri->segment(5);
    	    
    	   // $invoice_id = $this->uri->segment(5);
    	   // echo "Hi"; exit;
    	    $this->data['order_id'] = $order_id;
            $this->data['order_code'] = $order_code;
    	    $this->data['quantity'] = $quantity;
    	   // $this->data['invoice_id'] = $invoice_id;

            $data = array(
                            'order_id' => $order_id,
                            'order_code' => $order_code,
                            'order_name' => 'pinvoice'
                        );
    	     
    	    $this->data['allData'] = $this->Model_purchaseitem->fetchStckoItemByOrderIdTypeCodeResult($data);
    	    // echo "<pre>"; print_r($allData); exit();


    	    // for color
    	    $this->data['color'] = $this->model_attribute->fetchDataById('4');
    	    // for Size
    	    $this->data['size'] = $this->model_attribute->fetchDataById('5');
    	    // for pattern
    	    $this->data['pattern'] = $this->model_attribute->fetchDataById('6');
    	    // for style1
    	    $this->data['style1'] = $this->model_attribute->fetchDataById('7');
    	    // for style2
    	    $this->data['style2'] = $this->model_attribute->fetchDataById('8');
    	    // for type
    	    $this->data['type'] = $this->model_attribute->fetchDataById('9');
    	   
    	   // echo "Hi"; exit;
    	    $this->render_template('admin_view/purchase/purchaseInvoice/invoiceEditQtyItem', $this->data);   
	    }
    }
    
    public function viewBarcode1()
	{
	    $id = $this->uri->segment(3);
	    
	    $data = array(
	                    'product_id' => $id,
	                    'purchase_type' => 'pinvoice'
	                );
	    
	    $this->data['allData'] = $this->model_barcode->getBarcodeDataByProductId($data);
	    
	    $this->render_template('admin_view/productMaster/product/detailsfromInvoice', $this->data);   
	}
    
    public function deleteItem()
    {
        $id = $this->uri->segment(3);
        
        $orderData = $this->Model_purchaseitem->fecthAllDataByID($id);
        
        $orderItem = $this->Model_purchaseitem->fetchDataByOrderIDCode($orderData['order_id'], $orderData['order_code']);
        
        $order = $this->Model_purchaseinvoice->fecthAllDatabyID($orderData['order_id']);
        
        $invoice_value = $order['total_invoice'] - $orderData['wsp_price'];
        $gamt = $order['gamt'] - $orderData['wsp_price'];
        
        // $order = $this->Model_purchaseinvoice->fecthAllDatabyID($orderData['order_id']);
        
        // $invoice_value = $order['invoice_value'] - $orderData['wsp_price'];
        
        // Update order data
        $data = array(
                        'id' => $orderData['order_id'],
                        'total_invoice' => $invoice_value,
                        'gamt' => $gamt
                    );
                    
        // echo "<pre>"; print_r($orderData);
        //     echo "<pre>"; print_r($orderItem);
        //     echo "<pre>"; print_r($order);
        //     echo "<pre>"; print_r($data);
        //     exit;
        
        $delete = $this->Model_purchaseitem->delete($id);
        
        if($delete == true) {
            
            $this->Model_purchaseinvoice->update($data);
            
            $this->Model_purchaseitem->deleteItem($orderItem['id']);
            
                        
            // echo "<pre>"; print_r($orderData);
            // echo "<pre>"; print_r($orderItem);
            // echo "<pre>"; print_r($order);
            // echo "<pre>"; print_r($data);
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			
			return redirect('purchase_invoice/update/'.$orderData['order_id']);
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			
			return redirect('purchase_invoice/update/'.$orderData['order_id']);
    	}
    }

    public function uploadImagesData()
    {
       // echo "<pre>"; print_r($_POST);
       // echo "<pre>"; print_r($_FILES);
       //  exit();
        $this->load->library('upload');
        
        $imagePath = './uploads/'; //this is your real path APPPATH means you are at the application folder
        
        $count_uploaded_files = count($_FILES['files']['name'] );
        
        if ($count_uploaded_files > 25){ // checking how many images your user/client can upload
        
            $productImages['return'] = false;
            $productImages['message'] = "You can upload 25 Images";
            
            echo json_encode($productImages);
        }
        else
        { 
            // echo "success";
            $data = array(
                            'order_id' => $_POST['orderid'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => $_POST['ordertype']
                        );
            
            $orderItem = $this->Model_purchaseitem->fecthOrderData($data);
            
            $names = '';
            $skuData = $this->model_sku->fecthSkuDataByID($orderItem['sku_id']);
            
            // echo "<pre>"; print_r($orderItem); exit();

            if(!empty($_FILES['files']))
            {
                // $names = "Not Empty";
                
                for ($i = 0; $i <  $count_uploaded_files; $i++) {
                
                    $_FILES['userfile']['name']     = $_FILES['files']['name'][$i];
                    $_FILES['userfile']['type']     = $_FILES['files']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $_FILES['files']['error'][$i];
                    $_FILES['userfile']['size']     = $_FILES['files']['size'][$i];
                    //configuration for upload your images
                    
                    $imgname = $skuData['product_code']."_".$_POST['color'];
                    
                    $config = array(
                                        'file_name'     => $imgname,
                                        'allowed_types' => 'jpg|jpeg|png|gif',
                                        'max_size'      => 10000,
                                        'overwrite'     => FALSE,
                                        'upload_path'   => $imagePath
                                    );
                    $this->upload->initialize($config);
                    
                    
                    $errCount = 0;//counting errrs
                    
                    if (!$this->upload->do_upload())
                    {
                        $error = array('error' => $this->upload->display_errors());
                        $productImages[] = array(
                                                'errors'=> $error
                                            );//saving arrors in the array
                    }
                    else
                    {
                        $data = $this->upload->data();
                        $name_array[] = $data['file_name'];
                    
                        // $filename = $this->upload->data();
                        // $productImages[] = array(
                        //                         'fileName'=>$filename['file_name'],
                        //                         'watermark'=> $this->createWatermark($filename['file_name'])
                        
                        //                     );
                    }//if file uploaded
                    
                }//for loop ends here
                
                // implode Image Name
                $names= implode(', ', $name_array);
        
                // print_r($this->input->post('qty'));
                // exit();

                $data = array(
                            'order_id' => $_POST['orderid'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => $_POST['ordertype']
                        );
            
                $orderItem = $this->Model_purchaseitem->fecthOrderData($data);


                $qty = 0;
                if($orderItem['unit_id'] == '18')
                {
                    
                    $qty = 1;

                    for ($i=0; $i < $this->input->post('qty'); $i++) { 
                        
                        $data = array(
                                    'order_id' => $this->input->post('orderid'),
                                    'order_code' => $this->input->post('order_code'),
                                    'sku' => $orderItem['sku_id'],
                                    'gst_id' => $orderItem['gst_id'],
                                    'unit_id' => $orderItem['unit_id'],
                                    'hsn' => $orderItem['hsn_id'],
                                    'salesmancomm' => $orderItem['salesman_commision'],
                                    'discountcode' => $orderItem['discount_id'],
                                    'color' => $this->input->post('color'),
                                    'size' => $this->input->post('size'),
                                    'pattern' => $this->input->post('pattern'),
                                    'style1' => $this->input->post('style1'),
                                    'style2' => $this->input->post('style2'),
                                    'type' => $this->input->post('type'),
                                    'quantity' => $qty,
                                    // 'sku' => $skuData['product_code'],
                                    'img' => $names,
                                    'img_path' => $imagePath,
                                    // 'display' => $this->input->post('show'),
                                    'order_name' => $this->input->post('ordertype'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                        // echo "IMg Availbale";
                        // print_r($data); //exit();

                        $result = $this->model_attribute->createAttr($data);
                    }
                    // exit();
                }
                else
                {
                    $qty = $this->input->post('qty');

                    $data = array(
                                'order_id' => $this->input->post('orderid'),
                                'order_code' => $this->input->post('order_code'),
                                'sku' => $orderItem['sku_id'],
                                'gst_id' => $orderItem['gst_id'],
                                'unit_id' => $orderItem['unit_id'],
                                'hsn' => $orderItem['hsn_id'],
                                'salesmancomm' => $orderItem['salesman_commision'],
                                'discountcode' => $orderItem['discount_id'],
                                'color' => $this->input->post('color'),
                                'size' => $this->input->post('size'),
                                'pattern' => $this->input->post('pattern'),
                                'style1' => $this->input->post('style1'),
                                'style2' => $this->input->post('style2'),
                                'type' => $this->input->post('type'),
                                'quantity' => $qty,
                                // 'sku' => $skuData['product_code'],
                                'img' => $names,
                                'img_path' => $imagePath,
                                // 'display' => $this->input->post('show'),
                                'order_name' => $this->input->post('ordertype'),
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                    // echo "IMg Availbale";
                    // print_r($data); exit();

                    $result = $this->model_attribute->createAttr($data);
                }

                
                if($result)
                {
                    $msg['msg'] = "Data Insert Successfully";
                    $msg['code'] = "success";
                    echo json_encode($msg);
                    // echo json_encode("Data Insert Successfully");
                }
            }
            else
            {
                // $names = "empty";
                // fetch img data by sku and color

                $itemData = $this->Model_purchaseitem->fecthOrderData($data);
                
                $skuData = $this->model_sku->fecthSkuDataByID($itemData['sku_id']);


                $imgArray = array(
                                    'sku' => $skuData['id'],
                                    'color' => $this->input->post('color')
                                );

                $imgData = $this->model_attribute->fetchDataBySKUAndColor($imgArray);

                if(empty($imgData))
                {
                    $msg['msg'] = "Previous SKU Image Not Find";
                    $msg['code'] = "error";
                    echo json_encode($msg);
                    // echo json_encode("Previous SKU Image Not Find");
                }
                else
                {
                    $data = array(
                            'order_id' => $_POST['orderid'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => $_POST['ordertype']
                        );
            
                    $orderItem = $this->Model_purchaseitem->fecthOrderData($data);


                    $qty = 0;
                    
                    if($orderItem['unit_id'] == '18')
                    {
                        $qty = 1;

                        
                        for ($i=0; $i < $this->input->post('qty'); $i++) { 

                            $data = array(
                                    'order_id' => $this->input->post('orderid'),
                                    'order_code' => $this->input->post('order_code'),
                                    'sku' => $orderItem['sku_id'],
                                    'unit_id' => $orderItem['unit_id'],
                                    'hsn' => $orderItem['hsn_id'],
                                    'salesmancomm' => $orderItem['salesman_commision'],
                                    'discountcode' => $orderItem['discount_id'],
                                    'gst_id' => $orderItem['gst_id'],
                                    'color' => $this->input->post('color'),
                                    'size' => $this->input->post('size'),
                                    'pattern' => $this->input->post('pattern'),
                                    'style1' => $this->input->post('style1'),
                                    'style2' => $this->input->post('style2'),
                                    'type' => $this->input->post('type'),
                                    'quantity' => $qty,
                                    // 'sku' => $skuData['product_code'],
                                    'img' => $imgData['img'],
                                    'img_path' => $imgData['img_path'],
                                    // 'display' => $this->input->post('show'),
                                    'order_name' => $this->input->post('ordertype'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                                
                            // print_r($data);
                            $result = $this->model_attribute->createAttr($data);
                        }
                    }
                    else
                    {
                        $qty = $this->input->post('qty');

                        $data = array(
                                'order_id' => $this->input->post('orderid'),
                                'order_code' => $this->input->post('order_code'),
                                'sku' => $orderItem['sku_id'],
                                'unit_id' => $orderItem['unit_id'],
                                'gst_id' => $orderItem['gst_id'],
                                'hsn' => $orderItem['hsn_id'],
                                'salesmancomm' => $orderItem['salesman_commision'],
                                'discountcode' => $orderItem['discount_id'],
                                'color' => $this->input->post('color'),
                                'size' => $this->input->post('size'),
                                'pattern' => $this->input->post('pattern'),
                                'style1' => $this->input->post('style1'),
                                'style2' => $this->input->post('style2'),
                                'type' => $this->input->post('type'),
                                'quantity' => $qty,
                                'sku' => $skuData['product_code'],
                                'img' => $imgData['img'],
                                'img_path' => $imgData['img_path'],
                                // 'display' => $this->input->post('show'),
                                'order_name' => $this->input->post('ordertype'),
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                            
                        // print_r($data);
                        $result = $this->model_attribute->createAttr($data);

                    }

                    if($result)
                    {
                        $msg['msg'] = "Data Insert Successfully";
                        $msg['code'] = "success";
                        echo json_encode($msg);
                        // echo json_encode("Data Insert Successfully");
                    }
                }
            }
        }//else
    }
}



