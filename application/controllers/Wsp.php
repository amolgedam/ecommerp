<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Wsp extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'WSP';

        $this->load->library('number_to_word');

		$this->load->model('model_ledger');
        $this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
        $this->load->model('model_paymentmaster');
        $this->load->model('model_deliverymemo');

        $this->load->model('model_sku');
        $this->load->model('model_attribute');
        $this->load->model('model_barcode');
        $this->load->model('model_purchaseinvoice');
        $this->load->model('model_purchaseitem');
		
        $this->load->model('model_wsp');
        $this->load->model('model_barcode');
        $this->load->model('model_internalconsumption');

        $this->load->model('model_salesinvoice');

        $this->load->model('model_company');
        $this->load->model('model_state');
        $this->load->model('model_hsn');
        $this->load->model('model_discount');
        $this->load->model('model_gst');
        $this->load->model('model_purchasereturn');
        
        $this->load->model('model_comm');

        $this->load->model('model_purchaseledger');
        $this->load->model('model_salesledger');

	}

    public function fetchAllData()
    {
        $data = $this->model_wsp->fecthAllData();
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
                
                $buttons .= '&nbsp; <a href="'.base_url().'wsp/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'wsp/delete/'.$value['id'].'/wsp" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';

                $buttons .= '&nbsp; <a href="'.base_url().'wsp/report/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-file-text"></i>Report</a>';

                
                $result['data'][$key] = array(
                                                $no,
                                                $value['inventory_no'],
                                                $value['date'],
                                                $value['total_invoice'],
                                                $value['invoice_status'],
                                                $buttons
                                            ); 
                $no++;
            }
        }
        
        // print_r($result);
        echo json_encode($result);
        exit;
    }

    public function getWSPData()
    {
        // $productSku = 'sku-test-01';
        $productSku = $_POST['sku'];
        // $productName = 'product1';
        // $productSku = '0001';

        $skuData = $this->model_sku->fecthSkuDataBySKU($productSku);

        // echo "<pre>"; print_r($skuData); exit();

        $data = $this->model_barcode->getWSPData($skuData['id']);
        // echo "<pre>"; print_r($data); exit();

        // $data = $this->model_barcode->fetchDataBySkuCode($productSku);
        // echo "<pre>"; print_r($data); exit();
        foreach ($data as $key => $value) {
            
            $productData = $this->model_wsp->getWSPData($value['purchase_id']);
            // echo "<pre>"; print_r($productData);
            $result['data'][$key] = array(
                                        'order_id' => $productData['order_id'],
                                        'barcode' => $value['barcode'],
                                        'sku' => $value['sku_code'],
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

	public function index()
	{
		$this->render_template('admin_view/salesMaster/wsp/index', $this->data);
	} 

	public function create()
	{
	    $this->form_validation->set_rules('orderno', 'Order Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	    
	       // echo "<pre>"; print_r($_POST); echo "<br>"; exit();
	       
	       $invoiceDate = date("Y-m-d", strtotime($this->input->post('date')));

	       $data = array(
                        'inventory_no' => $this->input->post('orderno'),
                        'date' => $invoiceDate,
                        'sales_account' => $this->input->post('saccount'),
                        'account' => $this->input->post('account'),
                        'salesman' => $this->input->post('salesman'),
                        'shipping_details' => $this->input->post('shipping_details'),
                        'shipping_type' => $this->input->post('shipping_type'),
                        'division' => $this->input->post('division'),
                        // 'branch' => $this->input->post('branch'),
                        'location' => $this->input->post('location'),
                        'delivery_memo' => $this->input->post('delivery_memo'),
                        'sale_type' => $this->input->post('sale_type'),
                        'duedate' => $this->input->post('due_date'),
                        'no_ofproducts' => $this->input->post('no_product'),
                        'base_total' => $this->input->post('base_total'),
                        'total_discount' => $this->input->post('total_discount'),
                        'gross_total' => $this->input->post('gross_total'),
                        'total_tax' => $this->input->post('total_tax'),
                        'total_amt' => $this->input->post('total_amt'),
                        'adjustment' => $this->input->post('adjustment'),
                        'total_invoice' => $this->input->post('total_invoice'),
                        'invoice_type' => "wsp",
                        'invoice_status' => "Credit Sale",
                        'company_id' => $this->session->userdata('wo_company'),
                        // 'city_id' => $this->session->userdata('wo_city'),
                        'store_id' => $this->session->userdata('wo_store'),
                        'created_by' => $this->session->userdata('wo_id')
                        );
            // echo "<pre>"; print_r($data); exit();
            $created_id = $this->model_salesinvoice->create($data);
            // $created_id = '1';

            if($created_id) {
                    
                // #####################################################
                // Create Ledger start

                // SALES LEDGER
                $salesLedgerData = $this->model_ledger->fecthDataByID($_POST['saccount']);
                $updateSalesLedgerAmt = $salesLedgerData['closing_balance'] - $_POST['total_invoice'];
                // $updateSalesLedgerAmt = abs($updateSalesLedger);
                // update sales Ledger
                $salesLedgerDataUpdate = array(
                                                'id' => $salesLedgerData['id'],
                                                'opening_balance' => $salesLedgerData['closing_balance'],
                                                'closing_balance' => $updateSalesLedgerAmt
                                            );

                // Add Data to Sales Ledger Table
                $salesLedger = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $salesLedgerData['id'],
                                        'invoice_date' => $invoiceDate,
                                        'entry_date' => $invoiceDate,
                                        'purchase_type' => "wsp",
                                        'dr_cr' => 'DR',
                                        'amt' => abs($this->input->post('total_invoice')),
                                        'opening_bal' => $salesLedgerData['closing_balance'],
                                        'closing_bal' => $updateSalesLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($salesLedger);
                // // update purchase ledger data
                $this->model_ledger->update($salesLedgerDataUpdate);

                // // ACCOUNT LEDGER
                $accountLedgerData = $this->model_ledger->fecthDataByID($_POST['account']);
                $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] - $_POST['total_invoice'];
                // $updateAccountLedgerAmt = abs($updateAccountLedger);
                // update account Ledger
                $accountLedgerDataUpdate = array(
                                                    'id' => $accountLedgerData['id'],
                                                    'opening_balance' => $accountLedgerData['closing_balance'],
                                                    'closing_balance' => $updateAccountLedgerAmt,
                                                    'company_id' => $this->session->userdata('wo_company'),
                                                    // 'city_id' => $this->session->userdata('wo_city'),
                                                    'store_id' => $this->session->userdata('wo_store'),
                                                    'created_by' => $this->session->userdata('wo_id')
                                                );

                // Add Data to Sales Ledger Table
                $accountLedger = array(
                                        'purchase_id' => $created_id,
                                        'ledger_id' => $accountLedgerData['id'],
                                        'invoice_date' => $invoiceDate,
                                        'entry_date' => $invoiceDate,

                                        'purchase_type' => "wsp",
                                        'dr_cr' => 'DR',
                                        'amt' => abs($_POST['total_invoice']),
                                        'opening_bal' => $accountLedgerData['closing_balance'],
                                        'closing_bal' => $updateAccountLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                $this->model_purchaseledger->create($accountLedger);
                // // update account ledger data
                $this->model_ledger->update($accountLedgerDataUpdate);

                // GST LEDGER
                // echo "gts"; print_r($gst);
                $gstLedgerData = $this->model_ledger->fecthDataByID($_POST['sale_type']);
                $updateGstLedgerAmt = $gstLedgerData['closing_balance'] + $_POST['total_tax'];
                // $updateGstLedgerAmt = abs($updateGstLedger);
                // update account Ledger
                $gstLedgerDataUpdate = array(
                                                'id' => $gstLedgerData['id'],
                                                'opening_balance' => $gstLedgerData['closing_balance'],
                                                'closing_balance' => $updateGstLedgerAmt
                                            );
                // Add Data to Sales Ledger Table
                $gstLedger = array(
                                    'purchase_id' => $created_id,
                                    'ledger_id' => $gstLedgerData['id'],
                                    'invoice_date' => $invoiceDate,
                                    'entry_date' => $invoiceDate,

                                    'purchase_type' => "wsp",
                                    'dr_cr' => 'CR',
                                    'amt' => abs($_POST['total_tax']),
                                    'opening_bal' => $gstLedgerData['closing_balance'],
                                    'closing_bal' => $updateGstLedgerAmt,
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );

                $this->model_purchaseledger->create($gstLedger);
                // // update account ledger data
                $this->model_ledger->update($gstLedgerDataUpdate);

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedgerAmt = $discountLedgerData['closing_balance'] + $_POST['adjustment'];

                    // update purchase Ledger
                    $discountLedgerDataUpdate = array(
                                                        'id' => $discountLedgerData['id'],
                                                        'opening_balance' => $discountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateDiscountLedgerAmt
                                                    );
                    $discountLedger = array(
                                    'purchase_id' => $created_id,
                                    'ledger_id' => $discountLedgerData['id'],
                                    'invoice_date' => $invoiceDate,
                                    'entry_date' => $invoiceDate,

                                    'purchase_type' => "wsp",
                                    'dr_cr' => 'CR',
                                    'amt' => abs($_POST['adjustment']),
                                    'opening_bal' => $discountLedgerData['closing_balance'],
                                    'closing_bal' => $updateDiscountLedgerAmt,
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );

                    $this->model_purchaseledger->create($discountLedger);
                    // update purchase ledger data
                    $this->model_ledger->update($discountLedgerDataUpdate);
                }

                // exit;
                // Create Ledger end
                // #####################################################


                $count_product = count($_POST['pno']);
                
                $comm = 0;
                
                for($i=0; $i<$count_product; $i++)
                {
                    $comm = $comm + $this->input->post('comm')[$i];
    	            $data = array(
    	                            'ledgerid' => $this->input->post('salesman'),
    	                            'barcode' => $this->input->post('pno')[$i],
    	                            'price' => $this->input->post('finalprice')[$i],
    	                            'percentage' => $this->input->post('salesmancomm')[$i],
    	                            'comm' => $this->input->post('comm')[$i],
    	                            'company_id' => $this->session->userdata('wo_company'),
                					// 'city_id' => $this->session->userdata('wo_city'),
                					'store_id' => $this->session->userdata('wo_store'),
                					'created_by' => $this->session->userdata('wo_id')
    	                        );
    	           // echo "<pre>"; print_r($data);
    	           
    	           $this->model_comm->createSalesmanComm($data);
                    
                    
                  // echo $i;
                    $wspData = array(
                                    'inventory_id' => $created_id,
                                    'inventory_type' => "wsp",
                                    'pno' => $this->input->post('pno')[$i],
                                    'qty' => $this->input->post('quantity')[$i],
                                    'conversion' => $this->input->post('conversion')[$i],
                                    'conversionvalue' => $this->input->post('conversionvalue')[$i],
                                    'baseprice' => $this->input->post('oldbaseprice')[$i],
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

                    // echo "<pre>"; print_r($wspData);
                     
                    $this->model_internalconsumption->createInventotyData($wspData);

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
                    //                             'status' => 'wsp',
                    //                             'company_id' => $this->session->userdata('wo_company'),
                    //                             // 'city_id' => $this->session->userdata('wo_city'),
                    //                             'store_id' => $this->session->userdata('wo_store'),
                    //                             'created_by' => $this->session->userdata('wo_id')
                    //                         );

                    // $this->model_barcode->createStatus($item_statusData);
                }

                if($comm > 0)
                {
                    $ledgerData = $this->model_ledger->fecthDataByID($this->input->post('salesman'));
                    // echo "<pre>"; print_r($ledgerData);

                    $salesmanClosingBal = $ledgerData['closing_balance'] != '' ? $ledgerData['closing_balance'] : 0;
                    $amt = $ledgerData['closing_balance'] + $comm; 

                    $salesmanLedger = array(
                                                'id' => $ledgerData['id'],
                                                'opening_balance' => $salesmanClosingBal,
                                                'closing_balance' => $amt
                                            );
                    // Add Data to Purchase Ledger Table
                    $salesmanCommLedger = array(
                                                    'purchase_id' => $created_id,
                                                    'ledger_id' => $ledgerData['id'],
                                                    'purchase_type' => "wsp",
                                                    'invoice_date' => $invoiceDate,
                                                    // 'entry_date' => $_POST['entry_date'],
                                                    'dr_cr' => 'cr',
                                                    'amt' => $comm,
                                                    'opening_bal' => $salesmanClosingBal,
                                                    'closing_bal' => $amt,
                                                    'company_id' => $this->session->userdata('wo_company'),
                                                    // 'city_id' => $this->session->userdata('wo_city'),
                                                    'store_id' => $this->session->userdata('wo_store'),
                                                    'created_by' => $this->session->userdata('wo_id')
                                                );
                                
                    $this->model_purchaseledger->create($salesmanCommLedger);
                    // update purchase ledger data
                    $this->model_ledger->update($salesmanLedger);
                }

                
                if(isset($_POST['payment']))
                {
                    // echo "Redirect to Make Payment";
                    return redirect('sales_invoice/makePayment/'.$created_id);
                }
                else if(isset($_POST['hold']))
                {
                    $data = array(
                                    'id' => $created_id,
                                    'invoice_status' => "Hold",
                                );
                                
                    $this->model_salesinvoice->update($data);
                    
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('wsp');
                }
                else
                {
                    $this->session->set_flashdata('feedback','Data Saved Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('wsp');    
                }
                
            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Saved Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                
                return redirect('wps/create');
            }
	    }
	    else
	    {
	        $wsp = $this->model_salesinvoice->lastrecord();
            // echo "<pre>"; print_r($wsp);// exit();

            if($wsp == '')
            {
                $code  = '00000001';
                $this->data['orderno'] = $code;
            }
            else
            {
                $np = $wsp['inventory_no'];
                $code = substr($np, 1); 
                
                $code = $code + 1;
                $order_no = sprintf('%07d',$code);
                
                $this->data['orderno'] = $order_no;
            }
            // exit();

            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();

            $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();


            // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();


            $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();

            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['deliveryMemo'] = $this->model_deliverymemo->fecthAllData();

            $this->data['sku'] = $this->model_barcode->fetchSKUGroupData();
            // echo "<pre>"; print_r($sku);

            $this->data['productData'] = $this->model_sku->fecthSkuAllData();
            $this->data['color'] = $this->model_attribute->fetchDataById(1);
            $this->data['size'] = $this->model_attribute->fetchDataById(2);
            $this->data['pattern'] = $this->model_attribute->fetchDataById(3);
            $this->data['style1'] = $this->model_attribute->fetchDataById(4);
            $this->data['style2'] = $this->model_attribute->fetchDataById(5);
            $this->data['type'] = $this->model_attribute->fetchDataById(6);
            
            $this->data['lastData'] = $this->model_salesinvoice->lastData();
    	    
    	    
    		$this->render_template('admin_view/salesMaster/wsp/create', $this->data);   
	    }
	}

    public function update()
    {
        $this->form_validation->set_rules('id', 'Order id', 'trim|required');
        $this->form_validation->set_rules('order_no', 'Order Number', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
        
            // echo "<pre>"; print_r($_POST); echo "<br>"; exit();

            $data = array(
                        'id' => $this->input->post('id'),
                        'inventory_no' => $this->input->post('order_no'),
                        'date' => $this->input->post('date'),
                        'sales_account' => $this->input->post('saccount'),
                        'account' => $this->input->post('account'),
                        'salesman' => $this->input->post('salesman'),
                        'shipping_details' => $this->input->post('shipping_details'),
                        'shipping_type' => $this->input->post('shipping_type'),
                        'division' => $this->input->post('division'),
                        // 'branch' => $this->input->post('branch'),
                        'location' => $this->input->post('location'),
                        'delivery_memo' => $this->input->post('delivery_memo'),
                        'sale_type' => $this->input->post('sale_type'),
                        'duedate' => $this->input->post('due_date'),
                        'no_ofproducts' => $this->input->post('no_product'),
                        'base_total' => $this->input->post('base_total'),
                        'total_discount' => $this->input->post('total_discount'),
                        'gross_total' => $this->input->post('gross_total'),
                        'total_tax' => $this->input->post('total_tax'),
                        'total_amt' => $this->input->post('total_amt'),
                        'adjustment' => $this->input->post('adjustment'),
                        'total_invoice' => $this->input->post('total_invoice'),
                        'invoice_status' => "Credit Sale",
                        // 'salesorder_id' => $this->input->post('orderno'),
                        'company_id' => $this->session->userdata('wo_company'),
                        // 'city_id' => $this->session->userdata('wo_city'),
                        'store_id' => $this->session->userdata('wo_store'),
                        'modified_by' => $this->session->userdata('wo_id')
                    );
        
            // echo "<pre>"; print_r($data); exit();
            $update = $this->model_salesinvoice->update($data);
            // $created_id = '1';

            if($update) {
                
                $type = "wsp";
		        $this->model_purchaseledger->deletePurchaseID($this->input->post('id'), $type);
                
                
                // SALES LEDGER
                $salesLedgerData = $this->model_ledger->fecthDataByID($this->input->post('saccount'));
                $updateSalesLedgerAmt = $salesLedgerData['closing_balance'] - $this->input->post('total_invoice');
                // $updateSalesLedgerAmt = abs($updateSalesLedger);
                // update sales Ledger
                $salesLedgerDataUpdate = array(
                                                'id' => $salesLedgerData['id'],
                                                'opening_balance' => $salesLedgerData['closing_balance'],
                                                'closing_balance' => $updateSalesLedgerAmt
                                            );

                // Add Data to Sales Ledger Table
                $salesLedger = array(
                                        'purchase_id' => $this->input->post('id'),
                                        'ledger_id' => $salesLedgerData['id'],
                                        'invoice_date' => $this->input->post('date'),
                                        'entry_date' => $this->input->post('date'),
                                        'purchase_type' => "wsp",
                                        'dr_cr' => 'DR',
                                        'amt' => abs($this->input->post('total_invoice')),
                                        'opening_bal' => $salesLedgerData['closing_balance'],
                                        'closing_bal' => $updateSalesLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );

                // // Add Data to Purchase Ledger
                $this->model_purchaseledger->create($salesLedger);
                // // update purchase ledger data
                $this->model_ledger->update($salesLedgerDataUpdate);

                // // ACCOUNT LEDGER
                $accountLedgerData = $this->model_ledger->fecthDataByID($this->input->post('account'));
                $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] - $this->input->post('total_invoice');
                // $updateAccountLedgerAmt = abs($updateAccountLedger);
                // update account Ledger
                $accountLedgerDataUpdate = array(
                                                    'id' => $accountLedgerData['id'],
                                                    'opening_balance' => $accountLedgerData['closing_balance'],
                                                    'closing_balance' => $updateAccountLedgerAmt,
                                                    'company_id' => $this->session->userdata('wo_company'),
                                                    // 'city_id' => $this->session->userdata('wo_city'),
                                                    'store_id' => $this->session->userdata('wo_store'),
                                                    'created_by' => $this->session->userdata('wo_id')
                                                );

                // Add Data to Sales Ledger Table
                $accountLedger = array(
                                        'purchase_id' => $this->input->post('id'),
                                        'ledger_id' => $accountLedgerData['id'],
                                        'invoice_date' => $this->input->post('date'),
                                        'entry_date' => $this->input->post('date'),
                                        'purchase_type' => "wsp",
                                        'dr_cr' => 'DR',
                                        'amt' => abs($this->input->post('total_invoice')),
                                        'opening_bal' => $accountLedgerData['closing_balance'],
                                        'closing_bal' => $updateAccountLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                $this->model_purchaseledger->create($accountLedger);
                // // update account ledger data
                $this->model_ledger->update($accountLedgerDataUpdate);

                // GST LEDGER
                // echo "gts"; print_r($gst);
                $gstLedgerData = $this->model_ledger->fecthDataByID($this->input->post('sale_type'));
                $updateGstLedgerAmt = $gstLedgerData['closing_balance'] + $this->input->post('total_tax');
                // $updateGstLedgerAmt = abs($updateGstLedger);
                // update account Ledger
                $gstLedgerDataUpdate = array(
                                                'id' => $gstLedgerData['id'],
                                                'opening_balance' => $gstLedgerData['closing_balance'],
                                                'closing_balance' => $updateGstLedgerAmt
                                            );
                // Add Data to Sales Ledger Table
                $gstLedger = array(
                                    'purchase_id' => $this->input->post('id'),
                                    'ledger_id' => $gstLedgerData['id'],
                                    'invoice_date' => $this->input->post('date'),
                                    'entry_date' => $this->input->post('date'),
                                    'purchase_type' => "wsp",
                                    'dr_cr' => 'CR',
                                    'amt' => abs($this->input->post('total_tax')),
                                    'opening_bal' => $gstLedgerData['closing_balance'],
                                    'closing_bal' => $updateGstLedgerAmt,
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );

                $this->model_purchaseledger->create($gstLedger);
                // // update account ledger data
                $this->model_ledger->update($gstLedgerDataUpdate);

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedgerAmt = $discountLedgerData['closing_balance'] + $this->input->post('adjustment');

                    // update purchase Ledger
                    $discountLedgerDataUpdate = array(
                                                        'id' => $discountLedgerData['id'],
                                                        'opening_balance' => $discountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateDiscountLedgerAmt
                                                    );
                    $discountLedger = array(
                                    'purchase_id' => $this->input->post('id'),
                                    'ledger_id' => $discountLedgerData['id'],
                                    'invoice_date' => $this->input->post('date'),
                                    'entry_date' => $this->input->post('date'),
                                    'purchase_type' => "wsp",
                                    'dr_cr' => 'CR',
                                    'amt' => abs($this->input->post('adjustment')),
                                    'opening_bal' => $discountLedgerData['closing_balance'],
                                    'closing_bal' => $updateDiscountLedgerAmt,
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $this->session->userdata('wo_store'),
                                    'created_by' => $this->session->userdata('wo_id')
                                );

                    $this->model_purchaseledger->create($discountLedger);
                    // update purchase ledger data
                    $this->model_ledger->update($discountLedgerDataUpdate);
                }
                
                
                
                
                if(isset($_POST['payment']))
                {
                    // echo "Redirect to Make Payment";
                    return redirect('sales_invoice/makePayment/'.$this->input->post('id'));
                }
                else
                {
                    $this->session->set_flashdata('feedback','Data Update Successfully');
                    $this->session->set_flashdata('feedback_class','alert alert-success');
                    
                    return redirect('wsp');                    
                }

            }
            else {
                
                $this->session->set_flashdata('feedback','Unable to Update Data');
                $this->session->set_flashdata('feedback_class','alert alert-danger');
                
                return redirect('wps/update/'.$this->input->post('id'));
            }
        }
        else
        {
            $id = $this->uri->segment(3);

            $this->data['allData'] = $this->model_salesinvoice->fecthAllDataByID($id);

            $data = array(
                                'id' => $id,
                                'inventory_type' => 'wsp'
                            );

            $this->data['ledgerPurSalesAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();

                            
            $this->data['itemData'] = $this->model_internalconsumption->fecthItemDataByInventoryID($data);

            $this->data['ledgerPurAccount'] = $this->model_ledger->ledgerPurType();


            // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
            $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();

            $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();

            $this->data['division'] = $this->model_division->fecthAllData();
            $this->data['ledgerPurType'] = $this->model_ledger->ledgerPurType();
            $this->data['branch'] = $this->model_branch->fecthAllData();
            $this->data['location'] = $this->model_location->fecthAllData();
            $this->data['deliveryMemo'] = $this->model_deliverymemo->fecthAllData();
            
            $this->render_template('admin_view/salesMaster/wsp/update', $this->data);   
        }
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        
        $data = array(
                        'id' => $this->uri->segment(3),
                        'inventory_type' => $this->uri->segment(4)
                    );
        // echo $id; echo "<pre>"; print_r($data); exit;
        $delete = $this->model_salesinvoice->deleteInvoiceData($data); 
 
        if($delete == true) {
            
            $type = "wsp";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);
            
            $this->model_internalconsumption->deleteItemData($data);    
            
            $this->session->set_flashdata('feedback','Record Deleted Successfully');
            $this->session->set_flashdata('feedback_class','alert alert-success');

            return redirect('wsp');
        }
        else{

            $this->session->set_flashdata('feedback','Unable to Delete Record');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            
            return redirect('wsp');
        }
    }

    public function report()
    {
        $id = $this->uri->segment(3);
        // $this->render_template('admin_view/salesMaster/wsp/report', $this->data);

        $company_id = $this->session->userdata['wo_company'];
        $companyDetails = $this->model_company->fecthDataByID($company_id);

        $invoiceData = $this->model_salesinvoice->fecthAllDataByID($id);
        // echo "<pre>"; print_r($invoiceData); exit();
        $data = array(
                        'id' => $invoiceData['id'],
                        'inventory_type' => $invoiceData['invoice_type']
                    );

        $itemData = $this->model_internalconsumption->fecthItemDataByInventoryID($data);
        // echo "<pre>"; print_r($itemData); exit();

        $customerData = $this->model_ledger->fecthAllDatabyID($invoiceData['account']);
        

        $salesType = $this->model_ledger->fecthAllDatabyID($invoiceData['sale_type']);
        $deliverymemo = $this->model_deliverymemo->fecthAllDataByID($invoiceData['delivery_memo']);

        $cityData = $this->model_state->fecthCityByID($companyDetails['city']);

        $html = '<!-- Main content -->
                <!DOCTYPE html>
                <html>
                <head>
                  <meta charset="utf-8">
                  <meta http-equiv="X-UA-Compatible" content="IE=edge">
                  <title>Invoice</title>
                  <!-- Tell the browser to be responsive to screen width -->
                  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                  <!-- Bootstrap 3.3.7 -->
                  <link rel="stylesheet" href="'.base_url('assets/admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
                  <!-- Font Awesome -->
                  <link rel="stylesheet" href="'.base_url('assets/admin_assets/bower_components/font-awesome/css/font-awesome.min.css').'">
                  <link rel="stylesheet" href="'.base_url('assets/admin_assets/dist/css/AdminLTE.min.css').'">

                    <style>
                        .pl15
                        {
                          padding-left: 15px;
                        }
                        .myBorder
                        {
                            border : 1px solid #000;
                        }
                        .topBorder
                        {
                            border-top : 1px solid #000;
                        }
                        .bottomBorder
                        {
                            border-bottom : 1px solid #000;
                        }
                        .leftBorder
                        {
                            border-left : 1px solid #000;
                        }
                        .rightBorder
                        {
                            border-right : 1px solid #000;
                        }                       
                    </style>

                </head>
                <body onload="window.print();">
                <div>
                    <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table border="1" width="100%">
                                                <tr>
                                                    <td>
                                                        <center>
                                                            <h4><b>'.strtoupper($companyDetails['company_name']).'</b></h4>
                                                            <h5>Nagpur-Main</h5>
                                                            <h6>'.ucwords($companyDetails['address1']).' '.ucwords($cityData['city_name']).' '.ucwords($companyDetails['pincode']).' '.ucwords($companyDetails['mobile_no']).'</h6>
                                                            <h6>GST No : '.ucwords($companyDetails['gst']).' &  PAN No : '.ucwords($companyDetails['pan']).'</h6>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            <h5><b> Tax Invoice </b></h5>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="col-md-6">
                                                            <table width="100%">
                                                              <tr>
                                                                <td width="100px">
                                                                  <b>Bill No :-</b>
                                                                </td>
                                                                <td>'.$invoiceData['inventory_no'].'</td>
                                                              </tr>
                                                              <tr>
                                                                <td><b>Bill Date :-</b></td>
                                                                <td>'.date("d-m-Y", strtotime($invoiceData['date'])).'</td>
                                                              </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <table width="100%">
                                                              <tr>
                                                                <td><b>Sales Type :-</b></td>
                                                                <td>'.$salesType['ledger_name'].'</td>
                                                              </tr>
                                                              <tr>
                                                                <td>
                                                                  <b>Salesman Code :-</b>
                                                                </td>
                                                                <td>&nbsp;</td>
                                                              </tr>
                                                              <tr>
                                                                <td>
                                                                  <b>Shipping Type :-</b>
                                                                </td>
                                                                <td>'.$invoiceData['shipping_type'].'</td>
                                                              </tr>
                                                              <tr>
                                                                <td>
                                                                  <b>Courier No :-</b>
                                                                </td>
                                                                <td>&nbsp;</td>
                                                              </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="pl15">Name , Address & GSTIN of the Recipient</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="col-md-6">
                                                            <table width="100%">
                                                              <tr>
                                                                <td width="100px">
                                                                  <b>Name :-</b>
                                                                </td>
                                                                <td>'.$customerData['ledger_name'].'</td>
                                                              </tr>
                                                              <tr>
                                                                <td><b>Address :-</b></td>
                                                                <td>'.$customerData['address_1'].',<br><span style="padding-left: 60px;">'.$customerData['city'].' '.$customerData['state'].'</span></td>
                                                              </tr>
                                                              <tr>
                                                                <td width="100px">
                                                                  <b>GST No :-</b>
                                                                </td>
                                                                <td>'.$customerData['gst'].'</td>
                                                              </tr>
                                                              <tr>
                                                                <td><b>Sale Memo :-</b></td>
                                                                <td>'.$deliverymemo['delivery_no'].'</td>
                                                              </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <table width="100%">
                                                              <tr>
                                                                <td><b>Payment Type :-</b></td>
                                                                <td>-</td>
                                                              </tr>
                                                              <tr>
                                                                <td>
                                                                  <b>Payment Details :-</b>
                                                                </td>
                                                                <td></td>
                                                              </tr>
                                                              <tr>
                                                                <td>
                                                                  <b>Shipping Address :-</b>
                                                                </td>
                                                                <td>'.$invoiceData['shipping_details'].'</td>
                                                              </tr>
                                                              <tr>
                                                                <td>
                                                                  <b>Sale Order No :-</b>
                                                                </td>
                                                                <td></td>
                                                              </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%" align="center">
                                                            <tr>
                                                                <th class="myBorder" width="70px">&nbsp; Sr No.</th>
                                                                <th class="myBorder">&nbsp; SKU</th>
                                                                <th class="myBorder">&nbsp; HSN</th>
                                                                <td class="myBorder">&nbsp; QTY</td>
                                                                <th class="myBorder">&nbsp; MRP</th>
                                                                <th class="myBorder">&nbsp; DISC.</th>
                                                                <th class="myBorder">&nbsp; SGST</th>
                                                                <th class="myBorder">&nbsp; CGST</th>
                                                                <th class="myBorder">&nbsp; IGST</th>
                                                                <th class="myBorder">&nbsp; GST Amt.</th>
                                                                <th class="myBorder">&nbsp; Gross Amt.</th>
                                                            </tr>';

                                                            $qty=$subtotal=$discount=$tsgst=$tcgst=$tigst=0; $no=1;

                                                            foreach($itemData as $rows)
                                                            {
                                                                $productData = $this->model_sku->fecthSkuDataByID($rows['sku']);

                                                                $barcodeData = $this->model_barcode->fetchDataBySkuCode1($rows['sku']);

                                                                $hsnData = $this->model_hsn->fecthAllDataById($barcodeData['hsn']);

                                                                $discountData = $this->model_discount->fecthDataByID($rows['discount']);

                                                                $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);

                                                                $sgst = ($rows['baseprice'] * $gstData['sgst']) / 100;
                                                                $cgst = ($rows['baseprice'] * $gstData['cgst']) / 100;

                                                                $igst = ($rows['baseprice'] * $gstData['igst']) / 100;

                                                                $qty = $qty + $rows['qty'];
                                                                $subtotal = $subtotal + $rows['grossprice'];

                                                                $discount = $discount + $discount;
                                                                $tsgst = $tsgst + $sgst;
                                                                $tcgst = $tcgst + $cgst;
                                                                $tigst = $tigst + $igst;

                                                                $html.='<tr>
                                                                            <td class="myBorder">&nbsp; '.$no.'</td>
                                                                            <td class="myBorder">&nbsp; '.$productData['product_code'].'</td>
                                                                            <td class="myBorder">&nbsp; '.$hsnData['hsn_code'].'</td>
                                                                            <td class="myBorder">&nbsp; '.$rows['qty'].'</td>
                                                                            <td class="myBorder">&nbsp; '.($rows['baseprice']).'</td>
                                                                            <td class="myBorder">&nbsp; '.($rows['disvalue'] != '' ? ($rows['disvalue']) ." ".($discountData['discount']) : "0").'</td>

                                                                            <td class="myBorder">&nbsp; '.($rows['gst'] != '' ? ($sgst)  : "0").'</td>

                                                                            <td class="myBorder">&nbsp; '.($rows['gst'] != '' ? ($cgst)  : "0").'</td>

                                                                            <td class="myBorder">&nbsp; '.($rows['gst'] != '' ? ($igst) : "0").'</td>

                                                                            <td class="myBorder">&nbsp; '.($rows['gstamt']).'</td>

                                                                            <td class="myBorder">&nbsp; '.($rows['grossprice']).'</td>
                                                                        </tr>';
                                                                $no++;
                                                            }

                                                    $html.='<tr>
                                                                <td class="myBorder" colspan="2">&nbsp;</td>
                                                                <td class="myBorder">&nbsp; Total</td>
                                                                <td class="myBorder">&nbsp; '.$qty.'</td>
                                                                <td class="myBorder" colspan="5">&nbsp;</td>
                                                                <td class="myBorder"><b>&nbsp; Subtotal:-</b></td>
                                                                <td class="myBorder"><b>&nbsp; '.number_format($subtotal, 3).'</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="myBorder" colspan="9">
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="pl15">
                                                                                <h5>
                                                                                    <b><u>Bank Details</u> :-</b>
                                                                                </h5>
                                                                                <p>
                                                                                    <span><b>Name :- </b></span> Bank of Maharashtra AC No 60263398967 <br>
                                                                                    <span><b>IFSC :- </b></span>MAHB000061 <br>
                                                                                    <span><b>Swift Code :- </b></span> 000000 <br>
                                                                                    <span><b>Address :- </b></span> Shreeji Krupa,Central Avenue,Gandhibagh
                                                                                </p>
                                                                          </div>
                                                                        </td>
                                                                      </tr>
                                                                  </table>
                                                                </td>
                                                                <td class="myBorder" width="110px">
                                                                    <table width="100%" border="1">
                                                                        <tr>
                                                                            <td>Discount</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>SGST</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>CGST</td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td>IGST</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>Adjustment</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>Cash</td>
                                                                          </tr>
                                                                          <tr>
                                                                              <td>Tender Change</td>
                                                                          </tr>
                                                                    </table>
                                                                </td>
                                                                <td class="myBorder" width="100px">
                                                                    <table width="100%" border="1">
                                                                      <tr>
                                                                          <td style="text-align: right; padding-right: 5px">'.number_format($discount, 3).'</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td style="text-align: right; padding-right: 5px">'.number_format($tsgst, 3).'</td>
                                                                        </tr>
                                                                      <tr>
                                                                          <td style="text-align: right; padding-right: 5px">'.number_format($tcgst, 3).'</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td style="text-align: right; padding-right: 5px">'.number_format($tigst, 3).'</td>
                                                                      </tr>
                                                                      
                                                                      <tr>
                                                                          <td style="text-align: right; padding-right: 5px">&nbsp;'.($invoiceData['adjustment'] != 0 ? $invoiceData['adjustment'] : '0' ).'</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td style="text-align: right; padding-right: 5px">'.number_format($subtotal, 3).'</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td style="text-align: right; padding-right: 5px">0</td>
                                                                      </tr>
                                                                      
                                                                      
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                              <td class="myBorder" colspan="9">
                                                                <div class="pl15">
                                                                  <p><b>IN WORDS : '.$this->number_to_word->convert_number($invoiceData['total_invoice'], 3).'</b></p>
                                                                </div>
                                                              </td>
                                                              <td class="myBorder">
                                                                <div class="pl15"><b>Grand Total</b></div>
                                                              </td>
                                                              <td class="myBorder" style="text-align: right; padding-right: 5px">'.(number_format($invoiceData['total_invoice'], 3)).'</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr style="border:none;">
                                                    <td>
                                                        <div class="pl15">
                                                            <h5>
                                                              <b><u>Declaration</u></b>
                                                            </h5>
                                                            <p>Certified that the particulars given above are true & correct and the amount indicated represents the price actually charged and there is no flow of additional consideration directly or indirectly from the buyers. </p>

                                                            <h5>
                                                              <b><u>Term And Condition</u></b>
                                                            </h5>
                                                            <p>1. Subject To Nagpur Jurisdiction</p>
                                                            <p>2. No Cancellation/ Exchange or Return of Made to Ordered or Altered Items.</p>
                                                            <p>3. All Applicable Taxes/GST/Levies if/any apart from mentioned above would be Charged Extra at the time of Billing.</p>
                                                            <p>4. Payment to be made on or before due date mentioned here, in favour of M/s. PARAMOUNT TRADING VENTURES ,bank details are given here-in.</p>
                                                            <p>5. Cash Payment Without Original Reciept would be invalid.</p>
                                                            <p>6. Payment against Made to Order or to be Altered product is Non-Refundable.</p>
                                                            <p>7. No Gurantee/Warranty on designs/patterns and color fastness.</p>
                                                            <p>8. Any Manufacturing/Fitting Defect would be resolved by means of Alteration/Repairs.</p>
                                                            <p>9. Committed Delivery date can change,depending upon the prevailing conditions and supplies.</p>
                                                            <p>10. We reserve the right to demand settlement of this invoice bill at any time before due date.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </body>
        </html>';

              echo $html;    
    }
	
}