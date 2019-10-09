<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_return extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Purchase Return';

		$this->load->model('model_ledger');
		$this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
		$this->load->model('model_paymentmaster');

		$this->load->model('model_sku');
		$this->load->model('model_attribute');
		$this->load->model('model_barcode');
		$this->load->model('model_purchaseinvoice');
		$this->load->model('model_purchaseitem');

		$this->load->model('model_purchasereturn');
		$this->load->model('model_internalconsumption');
		$this->load->model('model_barcode');

        $this->load->model('model_category');
        $this->load->model('model_purchaseledger');

        $this->load->model('model_company');
        

	}

	public function fetchAllData()
	{
	    $data = $this->model_purchasereturn->fecthAllData();
	    // echo "<pre>"; print_r($data);exit;
	    
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
                
                $buttons .= '&nbsp; <a href="'.base_url().'purchase_return/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'purchase_return/delete/'.$value['id'].'/preturn" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'reports/purchaseReturn/'.$value['id'].'/preturn" class="btn btn-sm btn-primary"><i class="fa fa-file-text"></i> Report</a>';
                
                $result['data'][$key] = array(
                                                $no,
                                                $value['order_no'],
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

	public function index()
	{
		$this->render_template('admin_view/purchase/purchaseReturn/index', $this->data);
	}

    public function fetchDataByBarcodeId()
    {
        // $barcode = '0000006276';
        $barcode = $_POST['barcode_code'];
        
        $data = $this->model_barcode->fetchProductByBarcode($barcode);
        // echo "<pre>"; print_r($data); exit();
       // $orderData = $this->model_internalconsumption->fetchPurchaseData($data['purchase_id']);
        // $purchaseData = $this->model_internalconsumption->fetchPurchaseData($data['purchase_id']);
        
        if($data['purchase_type'] == 'popeningstock')
        {
            $orderData = $this->model_openingitem->fecthAllDataByID($data['product_id']);
            $base_price = $orderData['base_price'];
            $wsp_price = $orderData['wspp'];
            $sku = $orderData['sku'];
            $cate_id = $orderData['product_category'];
            $subcat_id = $orderData['product_subcategory'];
            $gst = $data['gst_id'];
        }
        else if($data['purchase_type'] == 'pinvoice')
        {
            $orderData = $this->model_purchaseitem->fecthAllDataByID($data['product_id']);
            $base_price = $orderData['base_price'];
            $wsp_price = $orderData['wsp_price'];
            $sku = $orderData['sku_id'];
            $cate_id = $orderData['pcategories_id'];
            $subcat_id = $orderData['psubcat_id'];
            $gst = $data['gst_id'];
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
                        'grossprice' => $wsp_price,
                        'sku' => $skuData['product_code'],
                        'sku_id' => $skuData['id'],
                        'cat' => $catData['catgory_name'],
                        'subcat' => $subcatData['subcategory_name'],
                        'status' => $data['item_status'],
                        'gst' => $gst
                    );
                         
        // print_r($result);
        echo json_encode($result);
    }

	public function returnProductData()
	{
		// $productName = $_POST['product'];
		// $productSku = $_POST['sku'];
		// $productName = 'product1';
		$productSku = 'sku-test-01';

        $skuData = $this->model_sku->fecthSkuDataBySKU($productSku);

		$data = $this->model_barcode->getProductDataBySkuID($skuData['id']);
        // echo "<pre>"; print_r($data); exit();

        // $data = $this->model_barcode->fetchDataBySkuCode($productSku);
        foreach ($data as $key => $value) {
        	
            $skuData = $this->model_sku->fecthSkuDataByID($value['sku_code']);

        	$productData = $this->model_purchasereturn->purchaseReturnData($value['invoice_id']);
        	
            // echo "<pre>"; print_r($productData);
	        $result['data'][$key] = array(
                                        'barcode_id' => $value['id'],
										'barcode' => $value['barcode'],
                                        'sku_id' => $skuData['id'],
	                                    'sku' => $skuData['product_code'],
                                        'mrp' => $value['mrp'],
	                                    'wsp' => $value['wsp'],
	                                    'color' => $productData['color'],
	                                    'size' => $productData['size'],
	                                    'pattern' => $productData['pattern'],
	                                    'style1' => $productData['style1'],
	                                    'style2' => $productData['style2'],
	                                    'type' => $productData['type']
	                               );                      
        }

        // exit();
        // echo "<pre>"; print_r($result);
        echo json_encode($result);
	}

	public function create()
	{
	    $this->form_validation->set_rules('preturn_date', 'Purchase Return Date', 'trim|required');

		if ($this->form_validation->run() == TRUE)
	    {
	        
	    	$invoiceDate = date("Y-m-d", strtotime($this->input->post('preturn_date')));

	    	$data = array(
        					'order_no' => $this->input->post('orderno'),
        					'date' => $invoiceDate,
        					'purchase_acid' => $this->input->post('paccount'),
        					'account_id' => $this->input->post('account'),
        					'salestype_id' => $this->input->post('saletype'),
        					'division' => $this->input->post('division'),
        					// 'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'shipping_type' => $this->input->post('shipping_type'),
        					'paymenttype_id' => $this->input->post('payment_type'),
        					'base_total' => $this->input->post('base_total'),
        					'total_discount' => $this->input->post('total_discount'),
        					'gross_total' => $this->input->post('gross_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'adjustment' => $this->input->post('adjustment'),
        					'tot_amt' => $this->input->post('total_amt'),
        					'total_invoicevalue' => $this->input->post('total_invoice'),
        					'inventory_type' => "preturn",
                            'paymentstatus' => 'pay',
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);
            // echo "<pre>"; print_r($data); exit();
        	$created_id = $this->model_purchasereturn->create($data);
            // 	$created_id = '1';

        	if($created_id) {
        	    
        		$count_product = count($_POST['pno']);
        	    
        	    for($i=0; $i<$count_product; $i++)
    	        {
    	           // echo $i;
    	            $preturnData = array(
    	                            'inventory_id' => $created_id,
    	                            'inventory_type' => "preturn",
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

    	            // echo "<pre>"; print_r($preturnData);
                	 
                	$this->model_internalconsumption->createInventotyData($preturnData);

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
                    
        	    }

                // exit();

                // #####################################################
                // Create Ledger start
                // PURCHASE LEDGER
                $purchaseLedgerData = $this->model_ledger->fecthDataByID($_POST['paccount']);
                $updatePurchaseLedger = $purchaseLedgerData['closing_balance'] - $_POST['total_invoice'];
                $updatePurchaseLedgerAmt = abs($updatePurchaseLedger);
                // update purchase Ledger
                $purchaseLedgerDataUpdate = array(
                                                    'id' => $purchaseLedgerData['id'],
                                                    'opening_balance' => $purchaseLedgerData['closing_balance'],
                                                    'closing_balance' => $updatePurchaseLedgerAmt
                                              );
                // Add Data to Purchase Ledger Table
                $purchaseLedger = array(
                                        'purchase_id' => $created_id,
                                        'purchase_type' => 'purchase_return',
                                        'ledger_id' => $purchaseLedgerData['id'],
                                        'invoice_date' => $invoiceDate,
                                        'entry_date' => $invoiceDate,
                                        'dr_cr' => 'CR',
                                        'amt' => abs($_POST['total_invoice']),
                                        'opening_bal' => $purchaseLedgerData['closing_balance'],
                                        'closing_bal' => $updatePurchaseLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($purchaseLedger);
                // update purchase ledger data
                $this->model_ledger->update($purchaseLedgerDataUpdate);


                // ACCOUNT LEDGER
                $accountLedgerData = $this->model_ledger->fecthDataByID($_POST['account']);
                $updateAccountLedger = $accountLedgerData['closing_balance'] - $_POST['total_invoice'];
                $updateAccountLedgerAmt = abs($updateAccountLedger);
                // update account Ledger
                $accountLedgerDataUpdate = array(
                                                    'id' => $accountLedgerData['id'],
                                                    'opening_balance' => $accountLedgerData['closing_balance'],
                                                    'closing_balance' => $updateAccountLedgerAmt
                                                );
                $accountLedger = array(
                                        'purchase_id' => $created_id,
                                        'purchase_type' => 'purchase_return',
                                        'ledger_id' => $accountLedgerData['id'],
                                        'invoice_date' => $invoiceDate,
                                        'entry_date' => $invoiceDate,
                                        'dr_cr' => 'DR',
                                        'amt' => abs($_POST['total_invoice']),
                                        'opening_bal' => $accountLedgerData['closing_balance'],
                                        'closing_bal' => $updateAccountLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // echo "Account Ledger<pre>"; print_r($accountLedgerData);
                // echo "Account Ledger<pre>"; print_r($accountLedgerDataUpdate);
                // echo "Account Ledger<pre>"; print_r($accountLedger);
                // exit();
                // update account ledger data
                $this->model_purchaseledger->create($accountLedger);
                $this->model_ledger->update($accountLedgerDataUpdate);

                // Payment Type Ledger
                // echo "<pre>"; print_r($_POST); exit();

                $paymentTypeData = $this->model_paymentmaster->fecthDataByID($this->input->post('payment_type'));

                $paymentTypeLedgerData = $this->model_ledger->fecthDataByID($paymentTypeData['ledger_id']);
                $updatePTypeLedger = $paymentTypeLedgerData['closing_balance'] - $_POST['total_invoice'];
                $updatePTypeLedgerAmt = abs($updatePTypeLedger);
                // update account Ledger
                $pTypeLedgerDataUpdate = array(
                                                'id' => $paymentTypeLedgerData['id'],
                                                'opening_balance' => $paymentTypeLedgerData['closing_balance'],
                                                'closing_balance' => $updatePTypeLedgerAmt
                                            );

                $pTypeLedger = array(
                                        'purchase_id' => $created_id,
                                        'purchase_type' => 'purchase_return',
                                        'ledger_id' => $paymentTypeLedgerData['id'],
                                        'invoice_date' => $invoiceDate,
                                        'dr_cr' => 'DR',
                                        'amt' => abs($_POST['total_invoice']),
                                        'entry_date' => $invoiceDate,
                                        'opening_bal' => $paymentTypeLedgerData['closing_balance'],
                                        'closing_bal' => $updatePTypeLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                // echo "Payment Ledger<pre>"; print_r($paymentTypeLedgerData);
                // echo "payment Ledger<pre>"; print_r($pTypeLedgerDataUpdate);
                // echo "payment Ledger<pre>"; print_r($pTypeLedger);
                // exit();
                // update account ledger data
                $this->model_ledger->update($pTypeLedgerDataUpdate);
                $this->model_purchaseledger->create($pTypeLedger);


                // GST Ledger
                $gstLedgerData = $this->model_ledger->fecthDataByID($_POST['saletype']);
                $updateGstLedger = $gstLedgerData['closing_balance'] - $_POST['total_tax'];
                $updateGstLedgerAmt = abs($updateGstLedger);
                // update account Ledger
                $gstLedgerDataUpdate = array(
                                                'id' => $gstLedgerData['id'],
                                                'opening_balance' => $gstLedgerData['closing_balance'],
                                                'closing_balance' => $updateGstLedgerAmt
                                            );
                $gstLedger = array(
                                        'purchase_id' => $created_id,
                                        'purchase_type' => 'purchase_return',
                                        'ledger_id' => $gstLedgerData['id'],
                                        'invoice_date' => $invoiceDate,
                                        'entry_date' => $invoiceDate,
                                        'dr_cr' => 'CR',
                                        'amt' => abs($_POST['total_tax']),
                                        'opening_bal' => $gstLedgerData['closing_balance'],
                                        'closing_bal' => $updateGstLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // echo "Gst Ledger<pre>"; print_r($gstLedgerData);
                // echo "Gst Ledger<pre>"; print_r($gstLedger);
                // echo "Gst Ledger<pre>"; print_r($gstLedgerDataUpdate);
                // exit();
                // update account ledger data
                $this->model_purchaseledger->create($gstLedger);
                $this->model_ledger->update($gstLedgerDataUpdate);

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedger = $discountLedgerData['closing_balance'] - $_POST['adjustment'];
                    $updateDiscountLedgerAmt = abs($updateDiscountLedger);
                    // update account Ledger
                    $discountLedgerDataUpdate = array(
                                                    'id' => $discountLedgerData['id'],
                                                    'opening_balance' => $discountLedgerData['closing_balance'],
                                                    'closing_balance' => $updateDiscountLedgerAmt
                                                );
                    $discoutLedger = array(
                                            'purchase_id' => $created_id,
                                            'purchase_type' => 'purchase_return',
                                            'ledger_id' => $discountLedgerData['id'],
                                            'invoice_date' => $invoiceDate,
                                            'entry_date' => $invoiceDate,
                                            'dr_cr' => 'DR',
                                            'amt' => abs($_POST['adjustment']),
                                            'opening_bal' => $discountLedgerData['closing_balance'],
                                            'closing_bal' => $updateDiscountLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                        );
                    $this->model_purchaseledger->create($discoutLedger);
                    // update purchase ledger data
                    $this->model_ledger->update($discountLedgerDataUpdate);
                }


                // Create Ledger end
                // #####################################################

                // exit();

                if($_POST['save'])
                {
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('purchase_return');
                }

                if($_POST['hold'])
                {
                    $data = array(
                                    'id' => $created_id,
                                    'paymentstatus' => 'hold'
                                );

                    $this->model_purchasereturn->update($data);

                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('purchase_return');
                }

                if($_POST['print'])
                {
                    return redirect('reports/purchaseReturn/'.$created_id.'/preturn');
                }

        	}
        	else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('purchase_return/create');
        	}
	    }
	    else
	    {
	    	$preturn = $this->model_purchasereturn->lastrecord();
// echo "<pre>"; print_r($preturn); exit();
	        if($preturn == '')
	        {
	            $code  = '00000001';
	            $this->data['orderno'] = $code;
	        }
	        else
	        {
	            $code = $preturn['order_no'];
	            // $code = substr($np, 1); 
	            
	            $code = $code + 1;
	            $preturn = sprintf('%08d',$code);
	            
	            $this->data['orderno'] = $preturn;
	        }

            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();

	        $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();


	        // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();


		    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
		    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
	    	$this->data['division'] = $this->model_division->fecthAllData();
		    $this->data['branch'] = $this->model_branch->fecthAllData();
		    $this->data['location'] = $this->model_location->fecthAllData();


	        $this->data['productData'] = $this->model_sku->fecthSkuAllData();
	        $this->data['color'] = $this->model_attribute->fetchDataById(1);
	        $this->data['size'] = $this->model_attribute->fetchDataById(2);
	        $this->data['pattern'] = $this->model_attribute->fetchDataById(3);
	        $this->data['style1'] = $this->model_attribute->fetchDataById(4);
	        $this->data['style2'] = $this->model_attribute->fetchDataById(5);
	        $this->data['type'] = $this->model_attribute->fetchDataById(6);
	        
	       $this->data['lastData'] = $this->model_purchaseinvoice->lastData();

			$this->render_template('admin_view/purchase/purchaseReturn/create', $this->data);
	    }
	}

	public function update()
	{
		$this->form_validation->set_rules('id', 'Order id', 'trim|required');
		$this->form_validation->set_rules('order_no', 'Order Number', 'trim|required');

		if ($this->form_validation->run() == TRUE)
	    {
	    	$data = array(
        					'id' => $this->input->post('id'),
        					'order_no' => $this->input->post('order_no'),
        					'date' => $this->input->post('preturn_date'),
        					'purchase_acid' => $this->input->post('paccount'),
        					'account_id' => $this->input->post('account'),
        					'salestype_id' => $this->input->post('saletype'),
        					'division' => $this->input->post('division'),
        					'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'shipping_type' => $this->input->post('shipping_type'),
        					'paymenttype_id' => $this->input->post('payment_type'),
        					'base_total' => $this->input->post('base_total'),
        					'total_discount' => $this->input->post('total_discount'),
        					'gross_total' => $this->input->post('gross_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'adjustment' => $this->input->post('adjustment'),
        					'tot_amt' => $this->input->post('total_amt'),
        					'total_invoicevalue' => $this->input->post('total_invoice'),
        					'inventory_type' => "preturn",
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
            // echo "<pre>"; print_r($data); exit();
	    	$update = $this->model_purchasereturn->update($data);
        	
	        if($update)
	        {
	            $type = "purchase_return";
		    
		        $this->model_purchaseledger->deletePurchaseID($this->input->post('id'), $type);
		        
		        // #####################################################
                // Create Ledger start
                // PURCHASE LEDGER
                $purchaseLedgerData = $this->model_ledger->fecthDataByID($this->input->post('paccount'));
                $updatePurchaseLedger = $purchaseLedgerData['closing_balance'] - $this->input->post('total_invoice');
                $updatePurchaseLedgerAmt = abs($updatePurchaseLedger);
                // update purchase Ledger
                $purchaseLedgerDataUpdate = array(
                                                    'id' => $purchaseLedgerData['id'],
                                                    'opening_balance' => $purchaseLedgerData['closing_balance'],
                                                    'closing_balance' => $updatePurchaseLedgerAmt
                                              );
                // Add Data to Purchase Ledger Table
                $purchaseLedger = array(
                                        'purchase_id' => $this->input->post('id'),
                                        'purchase_type' => 'purchase_return',
                                        'ledger_id' => $purchaseLedgerData['id'],
                                        'invoice_date' => $this->input->post('preturn_date'),
                                        'entry_date' => $this->input->post('preturn_date'),
                                        'dr_cr' => 'CR',
                                        'amt' => abs($this->input->post('total_invoice')),
                                        'opening_bal' => $purchaseLedgerData['closing_balance'],
                                        'closing_bal' => $updatePurchaseLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($purchaseLedger);
                // update purchase ledger data
                $this->model_ledger->update($purchaseLedgerDataUpdate);

                if($_POST['account'] != 61 && $_POST['account'] != 2625)
                {
                    // ACCOUNT LEDGER
                    $accountLedgerData = $this->model_ledger->fecthDataByID($this->input->post('account'));
                    $updateAccountLedger = $accountLedgerData['closing_balance'] - $this->input->post('total_invoice');
                    $updateAccountLedgerAmt = abs($updateAccountLedger);
                    // update account Ledger
                    $accountLedgerDataUpdate = array(
                                                        'id' => $accountLedgerData['id'],
                                                        'opening_balance' => $accountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateAccountLedgerAmt
                                                    );
                    $accountLedger = array(
                                            'purchase_id' => $this->input->post('id'),
                                            'purchase_type' => 'purchase_return',
                                            'ledger_id' => $accountLedgerData['id'],
                                            'invoice_date' => $this->input->post('preturn_date'),
                                            'entry_date' => $this->input->post('preturn_date'),
                                            'dr_cr' => 'DR',
                                            'amt' => abs($this->input->post('total_invoice')),
                                            'opening_bal' => $accountLedgerData['closing_balance'],
                                            'closing_bal' => $updateAccountLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                        );
    
                    
                    // update account ledger data
                    $this->model_purchaseledger->create($accountLedger);
                    $this->model_ledger->update($accountLedgerDataUpdate);
                }
                
                // Payment Type Ledger
                // echo "<pre>"; print_r($_POST); exit();
                
                if($this->input->post('payment_type') != 7)
                {

                    $paymentTypeData = $this->model_paymentmaster->fecthDataByID($this->input->post('payment_type'));
    
                    $paymentTypeLedgerData = $this->model_ledger->fecthDataByID($paymentTypeData['ledger_id']);
                    $updatePTypeLedger = $paymentTypeLedgerData['closing_balance'] - $this->input->post('total_invoice');
                    $updatePTypeLedgerAmt = abs($updatePTypeLedger);
                    // update account Ledger
                    $pTypeLedgerDataUpdate = array(
                                                    'id' => $paymentTypeLedgerData['id'],
                                                    'opening_balance' => $paymentTypeLedgerData['closing_balance'],
                                                    'closing_balance' => $updatePTypeLedgerAmt
                                                );
    
                    $pTypeLedger = array(
                                            'purchase_id' => $this->input->post('id'),
                                            'purchase_type' => 'purchase_return',
                                            'ledger_id' => $paymentTypeLedgerData['id'],
                                            'invoice_date' => $this->input->post('preturn_date'),
                                            'dr_cr' => 'DR',
                                            'amt' => abs($this->input->post('total_invoice')),
                                            'entry_date' => $this->input->post('preturn_date'),
                                            'opening_bal' => $paymentTypeLedgerData['closing_balance'],
                                            'closing_bal' => $updatePTypeLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                        );
                    
                    // update account ledger data
                    $this->model_ledger->update($pTypeLedgerDataUpdate);
                    $this->model_purchaseledger->create($pTypeLedger);
                }

                // GST Ledger
                $gstLedgerData = $this->model_ledger->fecthDataByID($this->input->post('saletype'));
                $updateGstLedger = $gstLedgerData['closing_balance'] - $this->input->post('total_tax');
                $updateGstLedgerAmt = abs($updateGstLedger);
                // update account Ledger
                $gstLedgerDataUpdate = array(
                                                'id' => $gstLedgerData['id'],
                                                'opening_balance' => $gstLedgerData['closing_balance'],
                                                'closing_balance' => $updateGstLedgerAmt
                                            );
                $gstLedger = array(
                                        'purchase_id' => $this->input->post('id'),
                                        'purchase_type' => 'purchase_return',
                                        'ledger_id' => $gstLedgerData['id'],
                                        'invoice_date' => $this->input->post('preturn_date'),
                                        'entry_date' => $this->input->post('preturn_date'),
                                        'dr_cr' => 'CR',
                                        'amt' => abs($_POST['total_tax']),
                                        'opening_bal' => $gstLedgerData['closing_balance'],
                                        'closing_bal' => $updateGstLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // update account ledger data
                $this->model_purchaseledger->create($gstLedger);
                $this->model_ledger->update($gstLedgerDataUpdate);

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedger = $discountLedgerData['closing_balance'] - $this->input->post('adjustment');
                    $updateDiscountLedgerAmt = abs($updateDiscountLedger);
                    // update account Ledger
                    $discountLedgerDataUpdate = array(
                                                    'id' => $discountLedgerData['id'],
                                                    'opening_balance' => $discountLedgerData['closing_balance'],
                                                    'closing_balance' => $updateDiscountLedgerAmt
                                                );
                    $discoutLedger = array(
                                            'purchase_id' => $this->input->post('id'),
                                            'purchase_type' => 'purchase_return',
                                            'ledger_id' => $discountLedgerData['id'],
                                            'invoice_date' => $this->input->post('preturn_date'),
                                            'entry_date' => $this->input->post('preturn_date'),
                                            'dr_cr' => 'DR',
                                            'amt' => abs($this->input->post('adjustment')),
                                            'opening_bal' => $discountLedgerData['closing_balance'],
                                            'closing_bal' => $updateDiscountLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                        );
                    $this->model_purchaseledger->create($discoutLedger);
                    // update purchase ledger data
                    $this->model_ledger->update($discountLedgerDataUpdate);
                }

		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
                if($_POST['save'])
                {
                    $this->session->set_flashdata('feedback','Record Update Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('purchase_return');
                }

                if($_POST['hold'])
                {
                    $data = array(
                                    'id' => $created_id,
                                    'paymentstatus' => 'hold'
                                );

                    $this->model_purchasereturn->update($data);

                    $this->session->set_flashdata('feedback','Record Update Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('purchase_return');
                }

                if($_POST['print'])
                {
                    return redirect('reports/purchaseReturn/'.$this->input->post('id').'/preturn');
                }
	        }
	        else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				return redirect('purchase_return/update/'.$this->input->post('id'));
        	}
	    }
	    else
	    {
			$id = $this->uri->segment(3);

			$this->data['allData'] = $this->model_purchasereturn->fecthAllDatabyID($id);
		    // echo "<pre>"; print_r($allData); exit();

			$data = array(
		                        'id' => $id,
		                        'inventory_type' => 'preturn'
		                    );
		                    
		    $this->data['itemData'] = $this->model_internalconsumption->fecthItemDataByInventoryID($data);

            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();


			$this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();

            // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();
	        

		    $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
		    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
	    	$this->data['division'] = $this->model_division->fecthAllData();
		    $this->data['branch'] = $this->model_branch->fecthAllData();
		    $this->data['location'] = $this->model_location->fecthAllData();

			$this->render_template('admin_view/purchase/purchaseReturn/update', $this->data);
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
		$delete = $this->model_purchasereturn->delete($id);	

		if($delete == true) {
            
            $type = "purchase_return";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);
		    
		    
            $this->model_internalconsumption->deleteItemData($data);	
            
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');
			return redirect('purchase_return');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('purchase_return');
    	}
	}
}