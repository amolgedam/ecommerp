<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_item extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

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
		
		$this->load->model('Model_purchaseitem');
		$this->load->model('Model_purchaseorder');

        $this->load->model('model_company');
        
	}

	public function create()
	{
	    $id = $this->uri->segment(3);//exit;
	    
	    $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	        
        	$orderData = $this->Model_purchaseorder->fecthAllDatabyID($this->input->post('order_id'));
        	$invoice_value = $orderData['invoice_value'] + $this->input->post('wspp');
        	
        	$order_data = array(
        	                        'id' => $orderData['id'],
        	                        'invoice_value' => $invoice_value
        	                    );
        	
	        
	       // print_r($order_data); exit;
	        $data = array(
        	                'order_id' => $this->input->post('order_id'),
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
        				    'wsp' => $this->input->post('wsp'),
        				    'wsp_price' => $this->input->post('wspp'),
        					'location_id' => $this->input->post('location'),
        					'mrp_price' => $this->input->post('mrp'),
        					'discount_id' => $this->input->post('discount_code'),
        					'salesman_commision' => $this->input->post('comm'),
                            'remark' => $this->input->post('remark'),
        					'ordertype' => 'porder',
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);

        // 	echo "<pre>"; print_r($data); exit();
        	$create = $this->Model_purchaseitem->create($data);

        	if($create == true) {
        		
        		$this->Model_purchaseorder->update($order_data);
        		
        // 		if($_POST['formSave'])
        // 		{
    				// $this->session->set_flashdata('feedback','Data Saved Successfully');
    				// $this->session->set_flashdata('feedback_class','alert alert-success');
    				// return redirect('purchase_order/update/'.$this->input->post('order_id'));  
        // 		}
        // 		else
        // 		{
    				return redirect('purchase_item/createItem/'.$this->input->post('order_id')."/".$this->input->post('order_code')."/".$this->input->post('quality'));         		    
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
	        $this->data['id'] = $id;
	        
	        $randomCode =  mt_rand(11111111,99999999);
            $this->data['randomCode'] = $randomCode;
        
	        $this->data['category'] = $this->model_category->fecthAllData();
    		$this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
    		$this->data['discount'] = $this->model_discount->fecthAllData();
    		$this->data['sku'] = $this->model_sku->fecthSkuAllData();
    		$this->data['brand'] = $this->model_brand->fecthAllData();
    		$this->data['unit'] = $this->model_unit->fecthAllCategoryData();
    		$this->data['hsn'] = $this->model_hsn->fecthAllData();
    		$this->data['gst'] = $this->model_gst->fecthAllData();
    		$this->data['location'] = $this->model_location->fecthAllData();
    		
    		$this->render_template('admin_view/purchase/purchaseInvoice/addInvoiceItem', $this->data);   
	    }
	}

	public function update()
	{
	    $id = $this->uri->segment(3);//exit;
	    
	    $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
	        
        	$orderData = $this->Model_purchaseorder->fecthAllDatabyID($this->input->post('order_id'));
        	$balancevalue = $orderData['invoice_value'] - $this->input->post('oldwspp');
        	$invoice_value = $balancevalue + $this->input->post('wspp');
        	
        	$order_data = array(
        	                        'id' => $orderData['id'],
        	                        'invoice_value' => $invoice_value
        	                    );
        	
	        
	       // print_r($order_data); exit;
	        $data = array(
        	                'id' => $this->input->post('id'),
        	                'order_id' => $this->input->post('order_id'),
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
        				    'wsp' => $this->input->post('wsp'),
        				    'wsp_price' => $this->input->post('wspp'),
        					'location_id' => $this->input->post('location'),
        					'mrp_price' => $this->input->post('mrp'),
        					'discount_id' => $this->input->post('discount_code'),
        					'salesman_commision' => $this->input->post('comm'),
        					'remark' => $this->input->post('remark'),
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);

        // 	echo "<pre>"; print_r($data); exit();
        	$create = $this->Model_purchaseitem->update($data);

        	if($create == true) {
        		
        		$this->Model_purchaseorder->update($order_data);
        		
        // 		if($_POST['formSave'])
        // 		{
    				// $this->session->set_flashdata('feedback','Data Saved Successfully');
    				// $this->session->set_flashdata('feedback_class','alert alert-success');
    				// return redirect('purchase_order/update/'.$this->input->post('order_id'));  
        // 		}
        // 		else
        // 		{
    				return redirect('purchase_item/updateItem/'.$this->input->post('order_id')."/".$this->input->post('order_code')."/".$this->input->post('quality'));         		    
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
    		$this->data['unit'] = $this->model_unit->fecthAllCategoryData();
    		$this->data['hsn'] = $this->model_hsn->fecthAllData();
    		$this->data['gst'] = $this->model_gst->fecthAllData();
    		$this->data['location'] = $this->model_location->fecthAllData();
    		
    		$this->data['allData'] = $this->Model_purchaseitem->fecthAllDataByID($id);
	        
	        $this->render_template('admin_view/purchase/purchaseInvoice/editInvoiceItem', $this->data);    
	    }
		
	}
	
	public function createItem()
	{
	    $this->form_validation->set_rules('quality', 'Quality', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {

            // echo "success";
            $data = array(
                            'order_id' => $_POST['order_id'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => 'porder'
                        );
            
            $orderItem = $this->Model_purchaseitem->fecthOrderData($data);
           
            // echo "<pre>"; print_r($orderItem); exit;

            $count_qty = count($_POST['qtyList']);
                
            for($i=0; $i<$count_qty; $i++)
            {
                $data = array(
                            'order_id' => $this->input->post('order_id'),
                            'order_code' => $this->input->post('order_code'),
                            'sku' => $orderItem['sku_id'],
                            'gst_id' => $orderItem['gst_id'],
                            'color' => $this->input->post('colorList')[$i],
                            'size' => $this->input->post('sizeList')[$i],
                            'pattern' => $this->input->post('patternList')[$i],
                            'style1' => $this->input->post('style1List')[$i],
                            'style2' => $this->input->post('style2List')[$i],
                            'type' => $this->input->post('typeList')[$i],
                            'quantity' => $this->input->post('qtyList')[$i],
                            'order_name' => 'porder',
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
                        );
                // echo "<pre>"; print_r($data);
                $create = $this->Model_purchaseitem->createItem($data);
            }
            // exit();
	        
	        if($create == true) {

                if($this->input->post('orderQuantity') > 0)
                {
                    $data = array(
                                'order_id' => $this->input->post('order_id'),
                                'order_code' => $this->input->post('order_code'),
                                'sku' => $orderItem['sku_id'],
                                'gst_id' => $orderItem['gst_id'],
                                'color' => 'none',
                                'size' => 'none',
                                'pattern' => 'none',
                                'style1' => 'none',
                                'style2' => 'none',
                                'type' => 'none',
                                'quantity' => $this->input->post('orderQuantity'),
                                'order_name' => 'porder',
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );

                    $this->Model_purchaseitem->createItem($data);
                }

        		
    			$this->session->set_flashdata('feedback','Data Saved Successfully');
    			$this->session->set_flashdata('feedback_class','alert alert-success');
    			return redirect('purchase_order/update/'.$this->input->post('order_id'));  
    		}
        	else
        	{
        	    $this->session->set_flashdata('feedback','Unale to Saved Data');
    			$this->session->set_flashdata('feedback_class','alert alert-danger');
    			
    			return redirect('purchase_order/update/'.$this->input->post('order_id'));  
        	}
	        
	    }
	    else
	    {
	        $order_id = $this->uri->segment(3);
    	    $order_code = $this->uri->segment(4);
    	    $quantity = $this->uri->segment(5);
    	    
    	    $this->data['order_id'] = $order_id; 
    	    $this->data['order_code'] = $order_code;
    	    $this->data['quantity'] = $quantity;
    	    
    	    $this->render_template('admin_view/purchase/purchaseInvoice/addItem', $this->data);
	    }
	}
 
    public function updateItem()
    {
        // echo "hi"; exit;
        
        $this->form_validation->set_rules('order_id', 'Order ID', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	     
	        // echo "<pre>"; print_r($_POST); exit;
            $count_qty = count($_POST['qtyList']);

            $data = array(
                            'order_id' => $this->input->post('order_id'),
                            'order_name' => 'porder'
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
                            'order_name' => 'porder',
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'modified_by' => $this->session->userdata('wo_id')
                        );
                // echo "<pre>"; print_r($data);
                $create = $this->Model_purchaseitem->createItem($data);
                // $create = 1;
            }

            if($this->input->post('orderQuantity') > $sumQty)
            {
                $balQty = $this->input->post('orderQuantity') - $sumQty;
                $data = array(
                                'order_id' => $this->input->post('order_id'),
                                'order_code' => $this->input->post('order_code'),
                                'color' => 'none',
                                'size' => 'none',
                                'pattern' => 'none',
                                'style1' => 'none',
                                'style2' => 'none',
                                'type' => 'none',
                                'quantity' => $balQty,
                                'order_name' => 'porder',
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
    			return redirect('purchase_order/update/'.$this->input->post('order_id'));  
    		}
        	else
        	{
        	    $this->session->set_flashdata('feedback','Unale to Update Record');
    			$this->session->set_flashdata('feedback_class','alert alert-danger');
    			
    			return redirect('purchase_order/update/'.$this->input->post('order_id'));  
        	}
	        
	    }
	    else
	    {
	        $order_id = $this->uri->segment(3);
            $order_code = $this->uri->segment(4);
    	    $quantity = $this->uri->segment(5);
    	    
    	    $this->data['order_id'] = $order_id;
            $this->data['order_code'] = $order_code;
    	    $this->data['quantity'] = $quantity;

            $data = array(
                            'order_id' => $order_id,
                            'order_code' => $order_code,
                            'order_name' => 'porder'
                        );
    	     
    	    $this->data['allData'] = $this->Model_purchaseitem->fetchStckoItemByOrderIdTypeCodeResult($data);
    	    
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
    	    
    	    $this->render_template('admin_view/purchase/purchaseInvoice/updateItem', $this->data);   
	    }
    }
    
    public function deleteItem()
    {
        $id = $this->uri->segment(3);
        
        $orderData = $this->Model_purchaseitem->fecthAllDataByID($id);
        
        $orderItem = $this->Model_purchaseitem->fetchDataByOrderIDCode($orderData['order_id'], $orderData['order_code']);
        
        $order = $this->Model_purchaseorder->fecthAllDatabyID($orderData['order_id']);
        
        $invoice_value = $order['invoice_value'] - $orderData['wsp_price'];
        
        // Update order data
        $data = array(
                        'id' => $orderData['order_id'],
                        'invoice_value' => $invoice_value
                    );
                    
        // echo "<pre>"; print_r($orderData);
        //     echo "<pre>"; print_r($orderItem);
        //     echo "<pre>"; print_r($order);
            // echo "<pre>"; print_r($data); exit;
        
        $delete = $this->Model_purchaseitem->delete($id);
        
        if($delete == true) {
            
            $this->Model_purchaseorder->update($data);
            
            $this->Model_purchaseitem->deleteItem($orderItem['id']);
            
                        
            // echo "<pre>"; print_r($orderData);
            // echo "<pre>"; print_r($orderItem);
            // echo "<pre>"; print_r($order);
            // echo "<pre>"; print_r($data);
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			
			return redirect('purchase_order');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			
			return redirect('purchase_order');
    	}
        
    }
	
}