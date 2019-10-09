<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Opening_stockitem extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Purchase';

        error_reporting(0);
        
        $this->load->model('model_category');
        $this->load->model('model_discount');
        $this->load->model('model_sku');
        $this->load->model('model_brand');
        $this->load->model('model_unit');
        $this->load->model('model_hsn');
        $this->load->model('model_gst');
        $this->load->model('model_location');
        $this->load->model('model_attribute');
        
        $this->load->model('model_openingstock');
        $this->load->model('model_openingitem');
        $this->load->model('model_inventorystocks');
        
        $this->load->model('Model_purchaseitem');
        $this->load->model('Model_store');
        
        $this->load->model('model_company');
        
        $this->load->model('model_barcode');
        
    }

    public function create()
    {
        $id = $this->uri->segment(3);//exit;
        
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); //exit();
                                
            if($_POST['quality'] == '')
            {
                $qty = $_POST['quantitypieces'];   
            }
            else
            {
                $qty = $_POST['quality'];
            }
            
            
            $orderData = $this->model_openingstock->fecthAllDatabyID($this->input->post('order_id'));

            // echo "<pre>"; print_r($orderData); //exit();


            $gstData = $this->model_gst->fetchAllDataByID($this->input->post('gst'));

            $totgst = $gstData['sgst'] + $gstData['cgst'] + $gstData['igst'];

            $gst = ($this->input->post('base_price') * $totgst) / 100;
            $price = $this->input->post('base_price') + $gst;
            
            $mrp = $price * $qty;

            $value = $qty * $price;

            $invoice_value = $orderData['tot_invoicevalue'] + $mrp;

            $order_data = array(
                                    'id' => $orderData['id'],
                                    'tot_invoicevalue' => $invoice_value,
                                    'product_status' => 'not'
                                );
                                
            
            // echo "<pre>"; print_r($order_data); exit();
            
            $data = array(
                            'order_id' => $this->input->post('order_id'),
                            'order_code' => $this->input->post('order_code'),
                            'inventory_type' => 'opening_stock',
                           // 'product_category' => $this->input->post('product_category'),
                           // 'product_subcategory' => $this->input->post('product_subcategory'),
                            'sku' => $this->input->post('sku'),
                            'brand' => $this->input->post('brand'),
                            'unit' => $this->input->post('unitid'),
                            'hsn' => $this->input->post('hsn'),
                            'quality' => $qty,
                            'base_price' => $this->input->post('base_price'),
                            'gst' => $this->input->post('gst'),
                            'pnetprice' => $this->input->post('pur_price'),
                            'wsp' => $this->input->post('wsp'),
                            'wspp' => $this->input->post('wspp'),
                            'location' => $this->input->post('location'),
                            'mrp' => $this->input->post('mrp'),
                            'discount_code' => $this->input->post('discount_code'),
                            'comm' => $this->input->post('comm'),
                            'remark' => $this->input->post('remark'),
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
                        );

        //  echo "<pre>"; print_r($data); exit();
            $create = $this->model_openingitem->create($data);

            if($create == true) {
                
               // Update opening stock data
                $this->model_openingstock->update($order_data);
                
               // $stockitem = $this->model_inventorystocks->fecthAllDataByOrderID($create);
                
               // $qty = $stockitem['quantity'] + $this->input->post('quality');
                
                $itemData = array(
                                    'order_id' => $create,
                                    'quantity' => $this->input->post('quality'),
                                    'inventory_type' => 'opening_stock',
                                    'order_code' => $this->input->post('order_code'),
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );
                
                $this->model_inventorystocks->create($itemData);
                
                return redirect('opening_stockitem/createItem/'.$this->input->post('order_id')."/".$this->input->post('order_code')."/".$qty);                  
                
            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                return redirect('opening_stockitem/update/'.$this->input->post('order_id'));
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
            $this->data['unit'] = $this->model_unit->fecthAllData();
            $this->data['hsn'] = $this->model_hsn->fecthAllData();
            $this->data['gst'] = $this->model_gst->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['store'] = $this->Model_store->fecthAllStores();
            // echo "<pre>"; print_r($store); exit();
            $this->render_template('admin_view/inventory/stock/addStockItem', $this->data);   
        }
    }

    public function update()
    {
        $id = $this->uri->segment(3);//exit;
        
        $this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            
            $orderData = $this->model_openingstock->fecthAllDatabyID($this->input->post('order_id'));

            $gstData = $this->model_gst->fetchAllDataByID($this->input->post('gst'));
            // echo "<pre>"; print_r($gstData); exit();
            $totgst = $gstData['sgst'] + $gstData['cgst'] + $gstData['igst'];
            
            $gst = ($this->input->post('base_price') * $totgst) / 100;
            $price = $this->input->post('base_price') + $gst;
            $mrp = $price * $this->input->post('quality');

            $invoice_value = $orderData['total_invoice'] + $mrp;

            // calculation to delete order Data to update

            $oldQty = $this->input->post('qualityOld');
            $oldgamout = $oldQty * $_POST['base_priceOld'];

            $oldgstData = $this->model_gst->fetchAllDataByID($this->input->post('gstOld'));
            $oldtotgst = $oldgstData['sgst'] + $oldgstData['cgst'] + $oldgstData['igst'];
            $oldtotal_tax = $oldgamout * $oldtotgst / 100;
            
            $oldinvoice_value = $orderData['tot_invoicevalue'] - $oldgamout - $oldtotal_tax;

            $qty = $this->input->post('quality');
            $gamout = $oldQty * $_POST['base_price'];

            $gstData = $this->model_gst->fetchAllDataByID($this->input->post('gst'));
            $totgst = $gstData['sgst'] + $gstData['cgst'] + $gstData['igst'];
            $total_tax = $_POST['base_price'] * $totgst / 100;


            $pnetprice = $_POST['base_price'] + $total_tax;
            $ivalue = $price * $_POST['quality'];

            $order_data = array(
                                'id' => $this->input->post('order_id'),
                                'tot_invoicevalue' => $ivalue,
                            );

            // echo "<pre>"; print_r($_POST); 
            // echo "<pre>"; print_r($order_data); //exit();
            // exit;
            $data = array(
                            'id' => $this->input->post('id'),
                            'order_id' => $this->input->post('order_id'),
                            'order_code' => $this->input->post('order_code'),
                            'inventory_type' => 'opening_stock',
                            'product_category' => $this->input->post('product_category'),
                            'product_subcategory' => $this->input->post('product_subcategory'),
                            'sku' => $this->input->post('sku'),
                            'brand' => $this->input->post('brand'),
                            'unit' => $this->input->post('unit'),
                            'hsn' => $this->input->post('hsn'),
                            'quality' => $this->input->post('quality'),
                            'base_price' => $this->input->post('base_price'),
                            'gst' => $this->input->post('gst'),
                            'pnetprice' => $pnetprice,
                            'wsp' => $this->input->post('wsp'),
                            'wspp' => $this->input->post('wspp'),
                            'location' => $this->input->post('location'),
                            'mrp' => $this->input->post('mrp'),
                            'discount_code' => $this->input->post('discount_code'),
                            'comm' => $this->input->post('comm'),
                            'remark' => $this->input->post('remark'),
                            'company_id' => $this->session->userdata('wo_company'),
                            // 'city_id' => $this->session->userdata('wo_city'),
                            'store_id' => $this->session->userdata('wo_store'),
                            'created_by' => $this->session->userdata('wo_id')
                        );

            // echo "<pre>"; print_r($data); exit();
            $create = $this->model_openingitem->update($data);

            if($create) {

                $this->model_openingstock->update($order_data);

                // $itemData = $this->Model_purchaseitem->fetchDataByOrderIDCode($this->input->post('order_id'), $this->input->post('order_code'));

                // $data = array(
                //                     'id' => $itemData['id'],
                //                     'order_id' => $this->input->post('order_id'),
                //                     'order_code' => $this->input->post('order_code'),
                //                     'quantity' => $this->input->post('quality'),
                //                     'modified_by' => $this->session->userdata('wo_id')
                //                 );
                // $this->Model_purchaseitem->updateItem($data);
                
                // echo "<pre>"; print_r($data);
                
        //      if($_POST['formSave'])
        //      {
                    // $this->session->set_flashdata('feedback','Data Saved Successfully');
                    // $this->session->set_flashdata('feedback_class','alert alert-success');
                    // return redirect('purchase_order/update/'.$this->input->post('order_id'));  
        //      }
        //      else
        //      {
                    // return redirect('opening_stock/update/'.$this->input->post('order_id'));                     
                    return redirect('opening_stockitem/createItem/'.$this->input->post('order_id')."/".$this->input->post('order_code')."/".$this->input->post('quality'));                     
        //      }
                
            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                return redirect('opening_stock/update/'.$this->input->post('order_id'));
            }
        }
        else
        {
            $this->data['category'] = $this->model_category->fecthAllData();
            $this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
            $this->data['discount'] = $this->model_discount->fecthAllData();
            $this->data['sku'] = $this->model_sku->fecthSkuAllData();
            $this->data['brand'] = $this->model_brand->fecthAllData();
            $this->data['unit'] = $this->model_unit->fecthAllData();
            $this->data['hsn'] = $this->model_hsn->fecthAllData();
            $this->data['gst'] = $this->model_gst->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['store'] = $this->Model_store->fecthAllStores();
            
            $this->data['allData'] = $this->model_openingitem->fecthAllDataByID($id);
            
            $this->render_template('admin_view/inventory/stock/editStockItem', $this->data);    
        }
    }
    
    public function createItem() 
    {
        $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            
           // echo "<pre>"; print_r($_POST); //exit;
            
            $oData = array(
                            'order_id' => $_POST['order_id'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => 'opening_stock'
                        );
                        
            // print_r($oData); exit;
                        
            $orderData = $this->model_openingitem->fecthOrderData($oData);
            
           // echo "<pre>"; print_r($orderData); exit;
            if($orderData['unit'] == '18')
            {
                echo $count_qty = count($_POST['qtyList']);
                
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
                                        'order_name' => 'opening_stock',
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
                                    'order_name' => 'opening_stock',
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
            // exit;
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
                                'order_name' => 'opening_stock',
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
                                'order_name' => 'opening_stock',
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                    // echo "<pre>"; print_r($data);
                    $create = $this->Model_purchaseitem->createItem($data);
                }
            }
            
            // exit;
            if($create == true) {
            
                $this->session->set_flashdata('feedback','Data Saved Successfully');
                $this->session->set_flashdata('feedback_class','alert alert-success');
                return redirect('opening_stock/update/'.$this->input->post('order_id')); 
            }
            else
            {
                $this->session->set_flashdata('feedback','Unale to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                
                return redirect('opening_stock/update/'.$this->input->post('order_id')); 
            }
            
            
            // exit;
    //         $count_qty = count($_POST['qtyList']);
            
    //         for($i=0; $i<$count_qty; $i++)
    //         {
    //             $data = array(
                            // 'order_id' => $this->input->post('order_id'),
                            // 'order_code' => $this->input->post('order_code'),
                            // 'color' => $this->input->post('colorList')[$i],
                            // 'size' => $this->input->post('sizeList')[$i],
                            // 'pattern' => $this->input->post('patternList')[$i],
                            // 'style1' => $this->input->post('style1List')[$i],
                            // 'style2' => $this->input->post('style2List')[$i],
                            // 'type' => $this->input->post('typeList')[$i],
                            // 'quantity' => $this->input->post('qtyList')[$i],
                            // 'order_name' => 'opening_stock',
                            // 'company_id' => $this->session->userdata('wo_company'),
                            // // 'city_id' => $this->session->userdata('wo_city'),
                            // // 'store_id' => $this->session->userdata('wo_store'),
                            // 'created_by' => $this->session->userdata('wo_id')
    //                     );
    //             // echo "<pre>"; print_r($data);
    //             $create = $this->Model_purchaseitem->createItem($data);
    //             // $create = 1;
    //         }

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
    //                             'order_name' => 'opening_stock',
    //                             'company_id' => $this->session->userdata('wo_company'),
    //                             // 'city_id' => $this->session->userdata('wo_city'),
    //                             // 'store_id' => $this->session->userdata('wo_store'),
    //                             'created_by' => $this->session->userdata('wo_id')
    //                         );
                    
    //                 $this->Model_purchaseitem->createItem($data);
    //             }
    //             // exit();
                
    //          $this->session->set_flashdata('feedback','Data Saved Successfully');
    //          $this->session->set_flashdata('feedback_class','alert alert-success');
    //          return redirect('opening_stock/update/'.$this->input->post('order_id'));  
    //      }
    //      else
    //      {
    //          $this->session->set_flashdata('feedback','Unale to Saved Data');
    //          $this->session->set_flashdata('feedback_class','alert alert-danger');
                
    //          return redirect('opening_stock/update/'.$this->input->post('order_id'));  
    //      }
            
        }
        else
        {
            $order_id = $this->uri->segment(3);
            $order_code = $this->uri->segment(4);
            $quantity = $this->uri->segment(5);
            
            $this->data['order_id'] = $order_id;
            $this->data['order_code'] = $order_code;
            $this->data['quantity'] = $quantity;
            
            $this->render_template('admin_view/inventory/stock/addItem', $this->data);   
        }
    }
    
    public function uploadImagesData()
    {
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
            
            $orderItem = $this->model_openingitem->fecthOrderData($data);
            
            $names = '';
            $skuData = $this->model_sku->fecthSkuDataByID($orderItem['sku']);
            
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
            
                $orderItem = $this->model_openingitem->fecthOrderData($data);

                $qty = 0;
                if($orderItem['unit'] == '18')
                {
                    $data = array(
                            'order_id' => $_POST['orderid'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => $_POST['ordertype']
                        );
            
                    $orderItem = $this->model_openingitem->fecthOrderData($data);
                    
                    $qty = 1;

                    for ($i=0; $i < $this->input->post('qty'); $i++) { 
                        
                        $data = array(
                                    'order_id' => $this->input->post('orderid'),
                                    'order_code' => $this->input->post('order_code'),
                                    'sku' => $orderItem['sku'],
                                    'gst_id' => $orderItem['gst'],
                                    'unit_id' => $orderItem['unit'],
                                    'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
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
                }
                else
                {
                    $qty = $this->input->post('qty');

                    $data = array(
                                'order_id' => $this->input->post('orderid'),
                                'order_code' => $this->input->post('order_code'),
                                'sku' => $orderItem['sku'],
                                'gst_id' => $orderItem['gst'],
                                'unit_id' => $orderItem['unit'],
                                'hsn' => $orderItem['hsn'],
                                'salesmancomm' => $orderItem['comm'],
                                'discountcode' => $orderItem['discount_code'],
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

                // $data = array(
                //                 'order_id' => $this->input->post('orderid'),
                //                 'order_code' => $this->input->post('order_code'),
                //                 'color' => $this->input->post('color'),
                //                 'size' => $this->input->post('size'),
                //                 'pattern' => $this->input->post('pattern'),
                //                 'style1' => $this->input->post('style1'),
                //                 'style2' => $this->input->post('style2'),
                //                 'type' => $this->input->post('type'),
                //                 'quantity' => $qty,
                //                 'sku' => $skuData['product_code'],
                //                 'img' => $names,
                //                 'img_path' => $imagePath,
                //                 'display' => $this->input->post('show'),
                //                 'order_name' => 'opening_stock',
                //                 'company_id' => $this->session->userdata('wo_company'),
                //                 // 'city_id' => $this->session->userdata('wo_city'),
                //                 'store_id' => $this->session->userdata('wo_store'),
                //                 'created_by' => $this->session->userdata('wo_id')
                //             );
                // // echo "IMg Availbale";
                // // print_r($data); exit();

                // $result = $this->model_attribute->createAttr($data);

                if($result)
                {
                    $msg['msg'] = "Data Insert Successfully";
                    $msg['code'] = "success";
                    echo json_encode($msg);
                }
            }
            else
            {
                // $names = "empty";
                // fetch img data by sku and color

                // $itemData = $this->model_openingitem->fecthOrderData($data);
            
                // $skuData = $this->model_sku->fecthSkuDataByID($itemData['sku']);


                // $imgArray = array(
                //                     'sku' => $skuData['id'],
                //                     'color' => $this->input->post('color')
                //                 );

                // $imgData = $this->model_attribute->fetchDataBySKUAndColor($imgArray);

                // if(empty($imgData))
                // {
                //     $msg['msg'] = "Previous SKU Image Not Find";
                //     $msg['code'] = "error";
                //     echo json_encode($msg);
                // }
                // else
                // {
                    $qty = 0;

                    $data = array(
                            'order_id' => $_POST['orderid'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => $_POST['ordertype']
                        );
            
                    $orderItem = $this->model_openingitem->fecthOrderData($data);
                    
                    if($orderItem['unit'] == '18')
                    {
                        $qty = 1;

                        
                        for ($i=0; $i < $this->input->post('qty'); $i++) { 

                            $data = array(
                                    'order_id' => $this->input->post('orderid'),
                                    'order_code' => $this->input->post('order_code'),
                                    'sku' => $orderItem['sku'],
                                    'gst_id' => $orderItem['gst'],
                                    'unit_id' => $orderItem['unit'],
                                    'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
                                    'color' => $this->input->post('color'),
                                    'size' => $this->input->post('size'),
                                    'pattern' => $this->input->post('pattern'),
                                    'style1' => $this->input->post('style1'),
                                    'style2' => $this->input->post('style2'),
                                    'type' => $this->input->post('type'),
                                    'quantity' => $qty,
                                    // 'sku' => $skuData['product_code'],
                                    // 'img' => $imgData['img'],
                                    // 'img_path' => $imgData['img_path'],
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
                                'sku' => $orderItem['sku'],
                                'gst_id' => $orderItem['gst'],
                                'unit_id' => $orderItem['unit'],
                                'hsn' => $orderItem['hsn'],
                                'salesmancomm' => $orderItem['comm'],
                                'discountcode' => $orderItem['discount_code'],
                                'color' => $this->input->post('color'),
                                'size' => $this->input->post('size'),
                                'pattern' => $this->input->post('pattern'),
                                'style1' => $this->input->post('style1'),
                                'style2' => $this->input->post('style2'),
                                'type' => $this->input->post('type'),
                                'quantity' => $qty,
                                // 'sku' => $skuData['product_code'],
                                // 'img' => $imgData['img'],
                                // 'img_path' => $imgData['img_path'],
                                // 'display' => $this->input->post('show'),
                                'order_name' => $this->input->post('ordertype'),
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                            
                        // print_r($data); exit();
                        $result = $this->model_attribute->createAttr($data);
                    }

                    if($result)
                    {
                        $msg['msg'] = "Data Insert Successfully";
                        $msg['code'] = "success";
                        echo json_encode($msg);
                    }
                // }
            }
        }//else
    }

    public function uploadImagesDataUpdate()
    {
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
            
            $orderItem = $this->model_openingitem->fecthOrderData($data);
            
            $names = '';
            $skuData = $this->model_sku->fecthSkuDataByID($orderItem['sku']);
            
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
            
                $orderItem = $this->model_openingitem->fecthOrderData($data);

                $qty = 0;
                if($orderItem['unit'] == '18')
                {
                    $data = array(
                            'order_id' => $_POST['orderid'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => $_POST['ordertype']
                        );
            
                    $orderItem = $this->model_openingitem->fecthOrderData($data);
                    
                    $qty = 1;

                    for ($i=0; $i < $this->input->post('qty'); $i++) { 
                        
                        $data = array(
                                    'id' => $this->input->post('id'),
                                    'order_id' => $this->input->post('orderid'),
                                    'order_code' => $this->input->post('order_code'),
                                    'sku' => $orderItem['sku'],
                                    'gst_id' => $orderItem['gst'],
                                    'unit_id' => $orderItem['unit'],
                                    'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
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
                                    'modified_by' => $this->session->userdata('wo_id')
                                );
                        // echo "IMg Availbale";
                        // print_r($data); //exit();

                        $result = $this->model_attribute->updateAttr($data);
                    }
                }
                else
                {
                    $qty = $this->input->post('qty');

                    $data = array(
                                'id' => $this->input->post('id'),
                                'order_id' => $this->input->post('orderid'),
                                'order_code' => $this->input->post('order_code'),
                                'sku' => $orderItem['sku'],
                                'gst_id' => $orderItem['gst'],
                                'unit_id' => $orderItem['unit'],
                                'hsn' => $orderItem['hsn'],
                                'salesmancomm' => $orderItem['comm'],
                                'discountcode' => $orderItem['discount_code'],
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
                                'modified_by' => $this->session->userdata('wo_id')
                            );

                    $result = $this->model_attribute->updateAttr($data);
                }

                if($result)
                {
                    $msg['msg'] = "Data Insert Successfully";
                    $msg['code'] = "success";
                    echo json_encode($msg);
                }
            }
            else
            {
                // $names = "empty";
                // fetch img data by sku and color

                $itemData = $this->model_openingitem->fecthOrderData($data);
                
                $skuData = $this->model_sku->fecthSkuDataByID($itemData['sku']);


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
                }
                else
                {
                    $qty = 0;

                    $data = array(
                            'order_id' => $_POST['orderid'],
                            'order_code' => $_POST['order_code'],
                            'ordertype' => $_POST['ordertype']
                        );
            
                    $orderItem = $this->model_openingitem->fecthOrderData($data);
                    
                    if($orderItem['unit'] == '18')
                    {
                        $qty = 1;

                        
                        for ($i=0; $i < $this->input->post('qty'); $i++) { 

                            $data = array(
                                    'id' => $this->input->post('id'),
                                    'order_id' => $this->input->post('orderid'),
                                    'order_code' => $this->input->post('order_code'),
                                    'sku' => $orderItem['sku'],
                                    'gst_id' => $orderItem['gst'],
                                    'unit_id' => $orderItem['unit'],
                                    'hsn' => $orderItem['hsn'],
                                    'salesmancomm' => $orderItem['comm'],
                                    'discountcode' => $orderItem['discount_code'],
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
                                    'modified_by' => $this->session->userdata('wo_id')
                                );
                                
                            // print_r($data); exit();
                            $result = $this->model_attribute->updateAttr($data);
                        }
                    }
                    else
                    {
                        $qty = $this->input->post('qty');

                        $data = array(
                                'id' => $this->input->post('id'),
                                'order_id' => $this->input->post('orderid'),
                                'order_code' => $this->input->post('order_code'),
                                'sku' => $orderItem['sku'],
                                'gst_id' => $orderItem['gst'],
                                'unit_id' => $orderItem['unit'],
                                'hsn' => $orderItem['hsn'],
                                'salesmancomm' => $orderItem['comm'],
                                'discountcode' => $orderItem['discount_code'],
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
                                'modified_by' => $this->session->userdata('wo_id')
                            );
                            
                        // print_r($data); exit();
                        $result = $this->model_attribute->updateAttr($data);
                    }

                    if($result)
                    {
                        $msg['msg'] = "Data Insert Successfully";
                        $msg['code'] = "success";
                        echo json_encode($msg);
                    }
                }
            }
        }//else

    }
    
    public function getAttrData()
    {
        $orderid = $this->input->post('orderid');
        $order_code = $this->input->post('order_code');
        
        $data = array(
                        'orderid' => $orderid,
                        'order_code' => $order_code
                    );

        $attrData = $this->model_attribute->fetchDataByOrderIDAndOrdercode($data);

        // echo "<pre>"; print_r($attrData);
        echo json_encode($attrData);
    }   

    public function deleteAttrDataByID()
    {
        $id = $_POST['id'];
        $delete = $this->model_attribute->deleteAttrData($id);

        if($delete)
        {
            echo json_encode("Record Deleted");
        }
        else
        {
            echo json_encode("Unable to Delete Data");
        }
    }
    
    public function createItemUploadFile()
    {
        $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            
            echo "<pre>"; print_r($_POST);
            
        }
        else
        {
            $order_id = $this->uri->segment(3);
            $order_code = $this->uri->segment(4);
            $quantity = $this->uri->segment(5);
            
            $this->data['order_id'] = $order_id;
            $this->data['order_code'] = $order_code;
            $this->data['quantity'] = $quantity;
            
            $this->render_template('admin_view/inventory/stock/addItem', $this->data);   
        }
    }

    public function updateItem()
    {
        // echo "hi"; exit;
        
        // $this->form_validation->set_rules('quality', 'Quality', 'trim|required');
        $this->form_validation->set_rules('order_id', 'Order Id', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            
            // echo "<pre>"; print_r($_POST); //exit;

            $count_qty = count($_POST['qtyList']);

            $data = array(
                            'order_id' => $this->input->post('order_id'),
                            'order_name' => 'opening_stock'
                        );
            // echo "<pre>"; print_r($data);
            $this->Model_purchaseitem->deleteItemByOrderIdName($data);
                
            $sumQty = 0;

            for($i=0; $i<$count_qty; $i++)
            {
                $sumQty = $sumQty + $this->input->post('qtyList')[$i];
            }
            // echo $sumQty;

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
                            'order_name' => 'opening_stock',
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
                                'order_name' => 'opening_stock',
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $this->session->userdata('wo_store'),
                                'created_by' => $this->session->userdata('wo_id')
                            );
                // echo "<pre>"; print_r($data);
                $this->Model_purchaseitem->createItem($data);
            }
            // exit();
            
            if($create == true) {
                
                $this->session->set_flashdata('feedback','Record Update Successfully');
                $this->session->set_flashdata('feedback_class','alert alert-success');
                return redirect('opening_stock/update/'.$this->input->post('order_id'));  
            }
            else
            {
                $this->session->set_flashdata('feedback','Unale to Update Record');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                
                return redirect('opening_stock/update/'.$this->input->post('order_id'));  
            }
            
        }
        else
        {
            $order_id = $this->uri->segment(3);
            $order_code = $this->uri->segment(4);
            $quantity = $this->uri->segment(5);

            $data = array(
                    'order_id' => $order_id,
                    'order_name' => 'opening_stock',
                    'order_code' => $order_code
                );
            
            $this->data['order_id'] = $order_id;
            $this->data['order_code'] = $order_code;
            $this->data['quantity'] = $quantity;
             
            // $this->data['allData'] = $this->Model_purchaseitem->fetchDataByOrderIDCode($order_id, $order_code);
            $this->data['itemData'] = $this->Model_purchaseitem->fetchStckoItemByOrderIdTypeCodeResult($data);
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

            // $data = array(
            //                 'id' => $order_id,
            //                 'order_name' => 'opening_stock'
            //             );
            
            // $allData = $this->model_openingitem->fecthAllDataByOrderData($data);
            // echo "<pre>"; print_r($allData); exit();
            
            $this->render_template('admin_view/inventory/stock/editItem', $this->data);   
        }
    }
    
    public function viewBarcode1()
    {
        $id = $this->uri->segment(3);
        
        $data = array(
                        'product_id' => $id,
                        'purchase_type' => 'opening_stock'
                    );
        
        $this->data['allData'] = $this->model_barcode->getBarcodeDataByProductId($data);
        
        $this->render_template('admin_view/productMaster/product/detailsfromInvoice', $this->data);   
    }
    
    public function deleteItem()
    {
        $id = $this->uri->segment(3);
        
        $orderData = $this->model_openingitem->fecthAllDataByID($id);
        
        $orderItem = $this->Model_purchaseitem->fetchDataByOrderIDCode($orderData['order_id'], $orderData['order_code']);
        
        $order = $this->model_openingstock->fecthAllDatabyID($orderData['order_id']);
        
        $price = $orderData['pnetprice'] * $orderData['quality'];
        $invoice_value = $order['tot_invoicevalue'] - $price;
        
        // // Update order data
        $data = array(
                        'id' => $orderData['order_id'],
                        'tot_invoicevalue' => $invoice_value
                    );
                    
        // echo "<pre>"; print_r($orderData);
            // echo "<pre>"; print_r($orderItem);
        //     echo "<pre>"; print_r($order);
            // echo "<pre>"; print_r($data); 
            // exit;
        
        $delete = $this->model_openingitem->delete($id);
        
        if($delete == true) {
            
            $this->model_openingstock->update($data);
            
            $this->Model_purchaseitem->deleteItem($orderItem['id']);
            
                        
            // echo "<pre>"; print_r($orderData);
            // echo "<pre>"; print_r($orderItem);
            // echo "<pre>"; print_r($order);
            // echo "<pre>"; print_r($data);
            $this->session->set_flashdata('feedback','Record Deleted Successfully');
            $this->session->set_flashdata('feedback_class','alert alert-success');
            
            return redirect('opening_stock/update/'.$orderData['order_id']);
        }
        else{

            $this->session->set_flashdata('feedback','Unable to Delete Record');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            
            return redirect('opening_stock/update/'.$orderData['order_id']);
        }
        
    }
    
}