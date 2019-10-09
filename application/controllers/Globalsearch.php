<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Globalsearch extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Global Search';
		
		$this->load->model('model_sku');
		$this->load->model('model_barcode');
		$this->load->model('model_wsp');
        $this->load->model('model_purchasevoucher');
		$this->load->model('model_purchaseitem');
		$this->load->model('model_globalsearch');
		$this->load->model('model_openingitem');
		$this->load->model('model_salesinvoice');
		$this->load->model('model_ledger');
		$this->load->model('model_paymentmaster');
		$this->load->model('model_paymentnote');
		$this->load->model('model_receiptnotes');
		$this->load->model('model_journalentry');
        $this->load->model('model_contraentry');
        $this->load->model('model_salesexchange');
        $this->load->model('model_company');
        $this->load->model('model_openingstock');
        $this->load->model('model_purchaseinvoice');
        $this->load->model('model_internaltransfer');
        $this->load->model('model_production');

        $this->load->model('model_purchasereturn');
        $this->load->model('model_salesorder');

        $this->load->model('model_category');
        $this->load->model('model_attribute');
        $this->load->model('model_shortage');

        
        error_reporting(0);
	}

	public function index()
	{
		$this->data['skuData'] = $this->model_sku->fecthSkuAllData();
		$this->data['ledgerData'] = $this->model_ledger->fecthDataByType();
		
		$this->render_template('admin_view/globalSearch/index', $this->data);
	}
    
    public function getGlobalSearchData()
    {
        // $productSku = '7ST-204-10294';
        // $productSku = 'SY2356-453-K1001';
        // $productSku = 'SD2092-K1001';

        $productSku = $_POST['sku'];

        $skuData = $this->model_sku->fecthDataBySKU($productSku);

        $catData = $this->model_category->fecthCatDataByID($skuData['category_id']);
        $subCatData = $this->model_category->fecthSubCatDataByID($skuData['subcategory_id']);

        // $data = $this->model_barcode->getGlobalSearchData1InvoiceGroup($skuData['id']);

        $pinvoice = $this->model_globalsearch->fetchPurchaseInvoiceGroupByID($skuData['id']);
        $ostock = $this->model_globalsearch->fetchOStockGroupByID($skuData['id']);
        $excesses = $this->model_globalsearch->fetchExcessesGroupByID($skuData['id']);
        $exchange = $this->model_globalsearch->fetchSExchangeGroupByID($skuData['id']);


        $data = array_merge($pinvoice, $ostock, $excesses, $exchange);

        // echo "<pre>"; print_r($ostock); //exit();

        foreach ($data as $key => $value) {

            // if($value['ordertype'])
            // {
            //     echo "Order Type";
            // }
            // else if($value['inventory_type'])
            // {
            //     echo "Inventory Type";
            // }
            //     exit();
            if($value['ordertype'])
            {
                if($value['ordertype'] == 'pinvoice')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($value['order_id']);
                    // $base_price = $orderData['base_price'];
                    // $wsp_price = $orderData['wsp_price'];

                    $ledgerData = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    $name = "Purchase Invoice";
                    $supplier = $ledgerData['ledger_name'];
                    $invoiceno = $invoiceData['invoice_no'];
                    $qty = $value['quantity'];
                    $rate = $value['base_price'];
                    $mrp = $value['mrp_price'];
                    $url = 'purchase_invoice/update/'.$invoiceData['id'];
                }
            }
            else if($value['inventory_type'])
            {
                if($value['inventory_type'] == 'opening_stock')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_openingstock->fecthAllDataByID($value['order_id']);
                    
                    // $base_price = $orderData['base_price'];
                    // $wsp_price = $orderData['wsp_price'];

                    $name = "Opening Stock";
                    $supplier = "-";
                    $qty = $value['quality'];
                    $invoiceno = $invoiceData['opening_no'];
                    $url = 'opening_stock/update/'.$invoiceData['id'];
                    $rate = $value['base_price'];
                    $mrp = $value['mrp'];
                }
                else if($value['inventory_type'] == 'production')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_production->fecthAllDatabyID($value['order_id']);
                    
                    // echo "<pre>"; print_r($invoiceData);

                    // $base_price = $orderData['base_price'];
                    // $wsp_price = $orderData['wsp_price'];

                    $name = "Production";
                    $supplier = "-";
                    $qty = $value['quality'];

                    $invoiceno = $invoiceData['jobsheet_no'];
                    $url = 'production/update/'.$invoiceData['id'];
                    $rate = $value['base_price'];
                    $mrp = $value['mrp'];
                }
                else if($value['inventory_type'] == 'inventoty_excesses')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_excesses->fecthAllDataByID($value['inventory_id']);

                    // $base_price = $orderData['base_price'];
                    // $wsp_price = $orderData['wsp_price'];

                    $supplier = "-";
                    $name = "Excesses";
                    $qty = $value['no_products'];

                    $invoiceno = $invoiceData['inventory_no'];
                    $url = 'excesses/update/'.$invoiceData['id'];
                    $rate = "-";
                    $mrp = "-";
                }
                else if($value['inventory_type'] == 'salesexchange')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_salesexchange->fecthAllDataByID($value['inventory_id']);
                    
                    // $ledgerData = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    $invoiceno = $invoiceData['exchange_no'];
                    $supplier = "-";
                    $qty = $value['quantity'];
                    $name = "Sales Exchange";
                    $url = 'excesses/update/'.$invoiceData['id'];
                    $rate = "-";
                    $mrp = "-";
                }
            }


            // echo "<pre>"; print_r($invoiceData); 

            $result[] = array(
                                'sku' => $skuData['product_code'],
                                'cat' => $catData['catgory_name'],
                                'subcat' => $subCatData['subcategory_name'],
                                'invoice_id' => $invoiceData['id'],
                                'invoice_no' => $invoiceno,
                                'name' => $name,
                                'url' => $url,
                                'qty' => $qty,
                                'rate' => $rate,
                                'mrp' => $mrp,
                                'supplier' => $supplier,
                            );

                        
        }

        // echo "<pre>"; print_r($result);
        echo json_encode($result);
        exit();
    }

	public function getGlobalSearchData1()
    {
        // $productSku = 'SY2356-453-K1001';
        // $productSku = '7ST-204-10294';
        $productSku = $_POST['sku'];

        $skuData = $this->model_sku->fecthDataBySKU($productSku);

        // $data = $this->model_barcode->getGlobalSearchData1InvoiceGroup($skuData['id']);

        $pinvoice = $this->model_globalsearch->fetchPurchaseInvoiceGroupByID($skuData['id']);
        $ostock = $this->model_globalsearch->fetchOStockGroupByID($skuData['id']);
        $excesses = $this->model_globalsearch->fetchExcessesGroupByID($skuData['id']);
        $exchange = $this->model_globalsearch->fetchSExchangeGroupByID($skuData['id']);


        $data = array_merge($pinvoice, $ostock, $excesses, $exchange);

        // echo "<pre>"; print_r($data); exit();

        foreach ($data as $key => $value) {
            

            // if($value['ordertype'])
            // {
            //     echo "Order Type";
            // }
            // else if($value['inventory_type'])
            // {
            //     echo "Inventory Type";
            // }
            //     exit();

            if($value['ordertype'])
            {
                if($value['ordertype'] == 'pinvoice')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($value['order_id']);
                    // $base_price = $orderData['base_price'];
                    // $wsp_price = $orderData['wsp_price'];

                    $name = "Purchase Invoice";

                    $invoiceno = $invoiceData['invoice_no'];
                    $url = 'purchase_invoice/update/'.$invoiceData['id'];
                }
            }
            else if($value['inventory_type'])
            {
                if($value['inventory_type'] == 'opening_stock')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_openingstock->fecthAllDataByID($value['order_id']);
                    
                    // $base_price = $orderData['base_price'];
                    // $wsp_price = $orderData['wsp_price'];

                    $name = "Opening Stock";
                    $invoiceno = $invoiceData['opening_no'];
                    $url = 'opening_stock/update/'.$invoiceData['id'];
                }
                else if($value['inventory_type'] == 'production')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_production->fecthAllDatabyID($value['order_id']);
                    
                    // $base_price = $orderData['base_price'];
                    // $wsp_price = $orderData['wsp_price'];

                    $name = "Production";
                    $invoiceno = $invoiceData['jobsheet_no'];
                    $url = 'production/update/'.$invoiceData['id'];
                }
                else if($value['inventory_type'] == 'inventoty_excesses')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_excesses->fecthAllDataByID($value['inventory_id']);

                    // $base_price = $orderData['base_price'];
                    // $wsp_price = $orderData['wsp_price'];

                    $invoiceno = $invoiceData['inventory_no'];
                    $name = "Excesses";
                    $url = 'excesses/update/'.$invoiceData['id'];
                }
                else if($value['inventory_type'] == 'salesexchange')
                {
                    // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                    $invoiceData = $this->model_salesexchange->fecthAllDataByID($value['inventory_id']);
                    
                    $invoiceno = $invoiceData['exchange_no'];
                    $name = "Sales Exchange";
                    $url = 'excesses/update/'.$invoiceData['id'];
                }
            }

            // echo "<pre>"; print_r($invoiceData); 
            $barcodeData = $this->model_globalsearch->fetchInwardsDataByPurchaseID($invoiceData['id'], $skuData['id']);


            foreach ($barcodeData as $key => $barcodeDataValue) {
               
                $productData = $this->model_barcode->getAttributeDataByID($barcodeDataValue['attr_id']);

                $result[] = array(
                                    'barcode_id' => $barcodeDataValue['id'],
                                    'order_id' => $productData['order_id'],
                                    'barcode' => $barcodeDataValue['barcode'],
                                    'sku' => $skuData['product_code'],
                                    'mrp' => $barcodeDataValue['mrp'],
                                    'wsp' => $barcodeDataValue['wsp'],
                                    'color' => $productData['color'],
                                    'size' => $productData['size'],
                                    'pattern' => $productData['pattern'],
                                    'style1' => $productData['style1'],
                                    'style2' => $productData['style2'],
                                    'type' => $productData['type'],
                                    'purchase_type' => $barcodeDataValue['purchase_type'],
                                    'order_id' => $barcodeDataValue['purchase_id'],
                                    'orderitem_id' => $barcodeDataValue['product_id'],
                                    'qty' => $barcodeDataValue['qty'],
                                    'item_status' => $barcodeDataValue['item_status'],
                                    'invoice_id' => $invoiceData['id'],
                                    'invoice_no' => $invoiceno,
                                    'name' => $name,
                                    'url' => $url
                                );
            } 


            // echo "<pre>"; print_r($result); 

            // if($value['purchase_type'] == 'popeningstock')
            // {
            //     // $orderData = $this->model_openingitem->fecthAllDataByID($value['product_id']);
            //     $invoiceData = $this->model_openingstock->fecthAllDataByID($value['purchase_id']);
            //     // $base_price = $orderData['base_price'];
            //     // $wsp_price = $orderData['wspp'];

            //     $name = "Opening Stock";
            //     $invoiceno = $invoiceData['opening_no'];
            //     $url = 'opening_stock/update/'.$invoiceData['id'];
            // }
            // else if($value['purchase_type'] == 'pinvoice')
            // {
            //     // $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
            //     $invoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($value['purchase_id']);
            //     // $base_price = $orderData['base_price'];
            //     // $wsp_price = $orderData['wsp_price'];

            //     $name = "Purchase Invoice";

            //     $invoiceno = $invoiceData['invoice_no'];
            //     $url = 'purchase_invoice/update/'.$invoiceData['id'];
                

            // }
            // else if($value['purchase_type'] == 'internaltransfer')
            // {
            //     $invoiceData = $this->model_internaltransfer->fecthAllDataByID($value['purchase_id']);
                
            //     $name = "Internal Consumption";

            //     $invoiceno = $invoiceData['inventory_no'];
            //     $url = 'internal_transfer/update/'.$invoiceData['id'];

            // }

            // echo "<pre>"; print_r($invoiceData); //exit();

            // $productData = $this->model_barcode->getAttributeDataByID($value['attr_id']);
            
            // echo "attr_id<pre>"; print_r($productData); exit();

            // $result[] = array(
            //                                 'barcode_id' => $value['id'],
            //                                 'order_id' => $productData['order_id'],
            //                                 'barcode' => $value['barcode'],
            //                                 'sku' => $skuData['product_code'],
            //                                 'mrp' => $value['mrp'],
            //                                 'wsp' => $value['wsp'],
            //                                 'color' => $productData['color'],
            //                                 'size' => $productData['size'],
            //                                 'pattern' => $productData['pattern'],
            //                                 'style1' => $productData['style1'],
            //                                 'style2' => $productData['style2'],
            //                                 'type' => $productData['type'],
            //                                 'purchase_type' => $value['purchase_type'],
            //                                 'order_id' => $value['purchase_id'],
            //                                 'orderitem_id' => $value['product_id'],
            //                                 'qty' => $value['qty'],
            //                                 'item_status' => $value['item_status'],
            //                                 'invoice_id' => $invoiceData['id'],
            //                                 'invoice_no' => $invoiceno,
            //                                 'name' => $name,
            //                                 'url' => $url
            //                             );                      
        }

        // echo "<pre>"; print_r($result);
        echo json_encode($result);
        exit();
    }


    public function outWardsDataBySKU()
    {
        $sku = $_POST['sku'];
        // $sku = 'AN-571-N1125';

        $skuData = $this->model_sku->fecthDataBySKU($sku);

        $salesData = $this->model_globalsearch->outWardsDataBySKU($skuData['id']);
        $salesData1 = $this->model_globalsearch->outWardsDataBySKU1($skuData['id']);
        $production1 = $this->model_globalsearch->outWardsProductionDataBySKU1($skuData['id']);
            
        $barcodeData = $this->model_barcode->fetchDataBySkuCode($skuData['id']);

        $production = $this->model_globalsearch->fecthMaterial();

        $productionResult = array();

        // $result = array_merge($salesData, $salesData1, $production1);
        $result = array_merge($salesData, $salesData1);

        if(empty($result))
        {
            $result1[] = array(
                                    'qty' => '0',
                                    'mrp' => '0',
                                    'finalprice' => '0',
                                    'invoice_no' => '',
                                    'name' => '',
                                    'customer' => '',
                                    'url' => ''
                                );  

        }
        else
        {
            
            foreach ($barcodeData as $key => $bValue) {
                
                foreach ($production as $key => $pValue) {
                    
                    if($bValue['id'] == $pValue['product_no'])
                    {
                        $productionData = $this->model_production->fecthAllDatabyID($pValue['id']);
                        $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($bValue['product_no']);

                        $productionResult[] = array(
                                            'qty' => $pValue['quantity'],
                                            'mrp' => $bValue['basic_rate'],
                                            'finalprice' => $bValue['mrp'],
                                            'invoice_no' => $productionData['jobsheet_no'],
                                            'name' => 'Production',
                                            'customer' => '-',
                                            'url' => 'production/update/'.$pValue['id']

                                    );

                        // echo "<pre>"; print_r($productionResult);
                    }
                }
            }



            foreach ($result as $key => $value) {


                if($value['inventory_type'] == 'invoice')
                {
                    $invoiceData = $this->model_salesinvoice->fecthAllDataByID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    // echo "<pre>"; print_r($customer);

                    $qty = $value['quantity'];
                    $invoiceno = $invoiceData['inventory_no'];
                    $name = "Sales Invoice";
                    $url = 'sales_invoice/update/'.$invoiceData['id'];

                    if(empty($customer))
                    {
                        $customer = "-";
                    }
                    else
                    {
                        $customer = $customer['ledger_name'];
                    }

                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];  
                }
                else if($value['inventory_type'] == 'salesexchange')
                {
                    $invoiceData = $this->model_salesexchange->fecthAllDataByID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account_id']);

                    $qty = $value['quantity'];
                    $invoiceno = $invoiceData['exchange_no'];
                    $name = "Sales Exchange";
                    $url = 'sales_exchange/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];  
                }
                else if($value['inventory_type'] == 'wsp')
                {
                    $invoiceData = $this->model_salesinvoice->fecthAllDataByID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($value['pno']);


                    $qty = $value['qty'];
                    $invoiceno = $invoiceData['inventory_no'];
                    $name = "WSP";
                    $url = 'wsp/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $barcodeData['wsp'];
                    $finalprice = $value['baseprice'];  
                }
                else if($value['inventory_type'] == 'preturn')
                {
                    $invoiceData = $this->model_purchasereturn->fecthAllDatabyID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account_id']);

                    $qty = $value['qty'];
                    $invoiceno = $invoiceData['order_no'];
                    $name = "Purchase Return";
                    $url = 'purchase_return/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];
                }
                // else if($value['inventory_type'] == 'inventoty_excesses')
                // {
                //     $invoiceData = $this->model_excesses->fecthAllDataByID($value['inventory_id']);

                //     $customer = $this->model_ledger->fecthDataByID($invoiceData['account']);

                //     $invoiceno = $invoiceData['inventory_no'];
                //     $name = "Excesses";
                //     $url = 'excesses/update/'.$invoiceData['id'];
                //     $customer = $customer['ledger_name'];
                // }
                else if($value['inventory_type'] == 'inventoty_consumption')
                {
                    $invoiceData = $this->model_internalconsumption->fecthDataByID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    $invoiceno = $invoiceData['inventory_no'];
                    $qty = $value['qty'];
                    $name = "Consuption";
                    $url = 'internal_consumption/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];
                }
                else if($value['inventory_type'] == 'inventoty_shortage')
                {
                    $invoiceData = $this->model_shortage->fecthAllDataByID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    $invoiceno = $invoiceData['inventory_no'];
                    $qty = $value['qty'];
                    $name = "Shortages";
                    $url = 'shortage/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];
                }
                // else if($value['type'] == 'production')
                // {
                //     $materialData = $this->model_production->fecthMaterialByID($value['id']);

                //     $invoiceno = $invoiceData['jobsheet_no'];
                //     $qty = $value['quantity'];
                //     $name = "Jobsheet No";
                //     $url = 'production/update/'.$value['id'];

                //     $mrp = $value['total_pcost'];
                //     $finalprice = $value['total_pcost'];
                // }

                // echo "<pre>"; print_r($invoiceData);

                $result1[] = array(
                                        'qty' => $qty,
                                        'mrp' => $mrp,
                                        'finalprice' => $finalprice,
                                        'invoice_no' => $invoiceno,
                                        'name' => $name,
                                        'customer' => $customer,
                                        'url' => $url
                                    );    

            }   
        }

        $finalData = array_merge($productionResult, $result1);

        // echo "<pre>"; print_r($finalData);
        echo json_encode($finalData);
        exit();
    }

    // for opening stock start
    public function openingStockInWardsData()
    {
    	$purchase_id = $_POST['purchase_id'];
    	$product_id = $_POST['product_id'];
    	
    	// $orderData = $this->model_globalsearch->fecthOStockInWardsData($purchase_id);
    	$itemData = $this->model_globalsearch->fecthOStockInWardsItemData($product_id);
    	
    	$data = array( 
    					'ledger_name' => '-',
    					'qty' => $itemData['quality'],
    					'baseprice' => $itemData['base_price'],
    					'netprice' => $itemData['pnetprice'],
    					'mrp' => $itemData['mrp']
    				);
    	// echo $purchase_id; echo "<br>"; echo $product_id;
    	echo json_encode($data);
    }

    public function openingStockOutWardsData()
    {
    	// $purchase_id = $_POST['purchase_id'];
    	$product_id = $_POST['product_id'];
    	// $product_id = '47';
    	// $purchase_id = '28';
    	// $orderData = $this->model_globalsearch->fecthOStockInWardsData($purchase_id);
    	// $itemData = $this->model_globalsearch->fecthOStockInWardsItemData($product_id);

    	$data = array(
    					'product_id' => $product_id,
    					'purchase_type' => 'popeningstock',
    					'item_status' => 'soldout'
    				);

    	$barcodeData = $this->model_barcode->getBarcodeOutWardData($data);
		$outwardsCount = count($barcodeData);

		foreach ($barcodeData as $key => $value) {
			
			$barcodeArray = array(
									'pno' => $value['barcode'],
									'inventory_type' => 'salesinvoice'
								);

			$orderData = $this->model_salesinvoice->getBarcodeOutWardData($barcodeArray);
			$salesInvoice = $this->model_salesinvoice->fecthAllDataByID($orderData['inventory_id']);
    		$ledgerData = $this->model_ledger->fecthDataByID($salesInvoice['account']);

    		// echo "<pre>"; print_r($orderData);
    		$result['data'][$key] = array(
	                                      'salesinvoiceid' => $salesInvoice['id'],
	                                      'salesinvoiceno' => $salesInvoice['inventory_no'],
	                                      'ledger_name' => $ledgerData['ledger_name'],
	                                      'qty' => $orderData['quantity'],
	                                      'mrp' => $orderData['baseprice'],
	                                      'finalprice' => $orderData['finalprice'],
	                                      'count' => $outwardsCount
	                                   );
		}
		// echo "<pre>"; print_r($result);
		echo json_encode($result);
    }

    public function openingStockOutWardsDataByBarcode()
    {
    	$purchase_id = $_POST['purchase_id'];
    	$product_id = $_POST['product_id'];
    	$barcode = $_POST['barcode'];
    	// $product_id = '47';
    	// $purchase_id = '28';
    	// $barcode = '0000000107';
    	// $orderData = $this->model_globalsearch->fecthOStockInWardsData($purchase_id);
    	// $itemData = $this->model_globalsearch->fecthOStockInWardsItemData($product_id);

    	$data = array(
    					'product_id' => $product_id,
    					'purchase_type' => 'popeningstock',
    					'barcode' => $barcode,
    					'item_status' => 'soldout'
    				);

    	$barcodeData = $this->model_barcode->getBarcodeOutWardDataByBarcode($data);
    	// echo "<pre>"; print_r($barcodeData); exit();
    	$result = '';
    	if(!empty($barcodeData))
    	{
			// echo "<pre>"; print_r($barcodeData); exit();
			$outwardsCount = count($barcodeData);

			$barcodeArray = array(
									'pno' => $barcodeData['barcode'],
									'inventory_type' => 'salesinvoice'
								);

			$orderData = $this->model_salesinvoice->getBarcodeOutWardData($barcodeArray);
			$salesInvoice = $this->model_salesinvoice->fecthAllDataByID($orderData['inventory_id']);
			$ledgerData = $this->model_ledger->fecthDataByID($salesInvoice['account']);

			// echo "<pre>"; print_r($orderData);
			$result = array(
                              'salesinvoiceid' => $salesInvoice['id'],
                              'salesinvoiceno' => $salesInvoice['inventory_no'],
                              'ledger_name' => $ledgerData['ledger_name'],
                              'qty' => $orderData['quantity'],
                              'mrp' => $orderData['baseprice'],
                              'finalprice' => $orderData['finalprice'],
                              'count' => $outwardsCount
                           );    		
    	}
    	else
    	{
    		$result = array(
                              'salesinvoiceid' => '',
                              'salesinvoiceno' => '',
                              'ledger_name' => '',
                              'qty' => '',
                              'mrp' => '',
                              'finalprice' => '',
                              'count' => ''
                           ); 
    	}

		// echo "<pre>"; print_r($result);
		echo json_encode($result);
    }



    // for purchase invoice start
    public function purchaseInvoiceInWardsData()
    {
    	$purchase_id = $_POST['purchase_id'];
    	$product_id = $_POST['product_id'];
    	// $product_id = '57';
    	// $purchase_id = '41';
    	$orderData = $this->model_globalsearch->fecthPInvoiceInWardsData($purchase_id);
    	$itemData = $this->model_globalsearch->fecthPInvoiceInWardsItemData($product_id);
    	
    	$data = array(
    					'ledger_name' => $orderData['ledger_name'],
    					'qty' => $itemData['quantity'],
    					'baseprice' => $itemData['base_price'],
    					'netprice' => $itemData['pnetprice'],
    					'mrp' => $itemData['mrp_price']
    				);
    	// echo $purchase_id; echo "<br>"; echo $product_id;
    	echo json_encode($data);
    }

    public function purchaseInvoiceOutWardsData()
    {
    	// $purchase_id = $_POST['purchase_id'];
    	$product_id = $_POST['product_id'];
    	// $product_id = '57';
    	// $purchase_id = '28';
    	// $orderData = $this->model_globalsearch->fecthOStockInWardsData($purchase_id);
    	// $itemData = $this->model_globalsearch->fecthOStockInWardsItemData($product_id);

    	$data = array(
    					'product_id' => $product_id,
    					'purchase_type' => 'pinvoice',
    					'item_status' => 'soldout'
    				);

    	$barcodeData = $this->model_barcode->getBarcodeOutWardData($data);
		$outwardsCount = count($barcodeData);

		foreach ($barcodeData as $key => $value) {
			
			$barcodeArray = array(
									'pno' => $value['barcode'],
									'inventory_type' => 'salesinvoice'
								);

			$orderData = $this->model_salesinvoice->getBarcodeOutWardData($barcodeArray);
			$salesInvoice = $this->model_salesinvoice->fecthAllDataByID($orderData['inventory_id']);
    		$ledgerData = $this->model_ledger->fecthDataByID($salesInvoice['account']);

    		// echo "<pre>"; print_r($orderData);
    		$result['data'][$key] = array(
	                                      'salesinvoiceid' => $salesInvoice['id'],
	                                      'salesinvoiceno' => $salesInvoice['inventory_no'],
	                                      'ledger_name' => $ledgerData['ledger_name'],
	                                      'qty' => $orderData['quantity'],
	                                      'mrp' => $orderData['baseprice'],
	                                      'finalprice' => $orderData['finalprice'],
	                                      'count' => $outwardsCount
	                                   );
		}
		// echo "<pre>"; print_r($result);
		echo json_encode($result);
    }

    public function purchaseInvoiceOutWardsDataByBarcode($value='')
    {
    	$purchase_id = $_POST['purchase_id'];
    	$product_id = $_POST['product_id'];
    	$barcode = $_POST['barcode'];
    	// $product_id = '57';
    	// $purchase_id = '28';
    	// $barcode = '0000000102';

    	// $orderData = $this->model_globalsearch->fecthOStockInWardsData($purchase_id);
    	// $itemData = $this->model_globalsearch->fecthOStockInWardsItemData($product_id);

    	$data = array(
    					'product_id' => $product_id,
    					'purchase_type' => 'pinvoice',
    					'item_status' => 'soldout',
    					'barcode' => $barcode
    				);

    	$barcodeData = $this->model_barcode->getBarcodeOutWardDataByBarcode($data);
    	// echo "<pre>"; print_r($barcodeData); exit();

    	if(!empty($barcodeData))
    	{
    		$outwardsCount = count($barcodeData);
			// exit();
			$barcodeArray = array(
									'pno' => $barcodeData['barcode'],
									'inventory_type' => 'salesinvoice'
								);

			$orderData = $this->model_salesinvoice->getBarcodeOutWardData($barcodeArray);
			$salesInvoice = $this->model_salesinvoice->fecthAllDataByID($orderData['inventory_id']);
			$ledgerData = $this->model_ledger->fecthDataByID($salesInvoice['account']);

			// echo "<pre>"; print_r($orderData);
			$result = array(
	                          'salesinvoiceid' => $salesInvoice['id'],
	                          'salesinvoiceno' => $salesInvoice['inventory_no'],
	                          'ledger_name' => $ledgerData['ledger_name'],
	                          'qty' => $orderData['quantity'],
	                          'mrp' => $orderData['baseprice'],
	                          'finalprice' => $orderData['finalprice'],
	                          // 'count' => $outwardsCount
	                       );
    	}
    	else
    	{
    		$result = array(
                              'salesinvoiceid' => '',
                              'salesinvoiceno' => '',
                              'ledger_name' => '',
                              'qty' => '',
                              'mrp' => '',
                              'finalprice' => '',
                              // 'count' => ''
                           ); 
    	}

		// echo "<pre>"; print_r($result);
		echo json_encode($result);
    }





    // #################################################
    public function getSKU()
    {
        // $barcode = '0000002366';
        $barcode = $_POST['barcode'];

        $barcodeData = $this->model_barcode->getSKUByBarcode($barcode);
        // echo "<pre>"; print_r($barcodeData); exit();

        $attrData = $this->model_attribute->fetchBarcodeAttributeData($barcodeData['attr_id']);

        $skuData = $this->model_sku->fecthDataBySKUID($barcodeData['sku_code']);

        $catData = $this->model_category->fecthCatDataByID($skuData['category_id']);
        $subCatData = $this->model_category->fecthSubCatDataByID($skuData['subcategory_id']);

        if($barcodeData['purchase_type'] == 'pinvoice')
        {
            $invoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($barcodeData['purchase_id']);
            
            $orderData = $this->model_purchaseitem->fetchOrderDataByInvoiceSKUid($invoiceData['id'],$skuData['id']);
            // echo "<pre>"; print_r($invoiceData);

            // echo "<pre>"; print_r($orderData); 

            $ledgerData = $this->model_ledger->fecthDataByID($invoiceData['account']);

            $qty = $orderData['quantity'];
            // $orderQty = $orderData['quantity'];

            if(empty($qty))
            {
                $qty = $barcodeData['qty'];
            }

            $name = "Purchase Invoice";
            $supplier = $ledgerData['ledger_name'];
            $invoiceno = $invoiceData['invoice_no'];
            $url = 'purchase_invoice/update/'.$invoiceData['id'];
        }
        else if($barcodeData['purchase_type'] == 'opening_stock')
        {
            $invoiceData = $this->model_openingstock->fecthAllDataByID($barcodeData['purchase_id']);
            $orderData = $this->model_openingitem->fecthAllDataByOrderSKUID($invoiceData['id'],$skuData['id']);

            $qty = $orderData['quality'];

            $name = "Opening Stock";
            $supplier = "-";
            $invoiceno = $invoiceData['opening_no'];
            $url = 'opening_stock/update/'.$invoiceData['id'];
        }
        else if($barcodeData['purchase_type'] == 'production')
        {   
            $invoiceData = $this->model_production->fecthAllDatabyID($barcodeData['purchase_id']);
            // echo "<pre>"; print_r($invoiceData); exit();

            $qty = $barcodeData['qty'];

            $name = "Production";
            $supplier = "-";
            $invoiceno = $invoiceData['jobsheet_no'];
            $url = 'production/update/'.$invoiceData['id'];
        }
        else if($barcodeData['purchase_type'] == 'inventoty_excesses')
        {
            $invoiceData = $this->model_excesses->fecthAllDataByID($barcodeData['purchase_id']);

            $qty = $barcodeData['qty'];
            
            $supplier = "-";
            $name = "Excesses";
            $invoiceno = $invoiceData['inventory_no'];
            $url = 'excesses/update/'.$invoiceData['id'];
        }
        else if($barcodeData['purchase_type'] == 'salesexchange')
        {
            $invoiceData = $this->model_salesexchange->fecthAllDataByID($barcodeData['purchase_id']);

            $qty = $barcodeData['qty'];
            $invoiceno = $invoiceData['exchange_no'];
            $supplier = "-";
            $name = "Sales Exchange";
            $url = 'excesses/update/'.$invoiceData['id'];
        }


        $data = array(
                        'barcode' => $barcodeData['barcode'],
                        'sku' => $skuData['product_code'],
                        'cat' => $catData['catgory_name'],
                        'subcat' => $subCatData['subcategory_name'],
                        'mrp' => $barcodeData['mrp'],
                        'wsp' => $barcodeData['wsp'],
                        'color' => $attrData['color'],
                        'size' => $attrData['size'],
                        'pattern' => $attrData['pattern'],
                        'style1' => $attrData['style1'],
                        'style2' => $attrData['style2'],
                        'type' => $attrData['type'],
                        'invoice_no' => $invoiceno,
                        'supplier' => $supplier,
                        'name' => $name,
                        'url' => $url,
                        'qty' => $barcodeData['qty'],
                        'orderQty' => $qty,
                        'rate' => $barcodeData['pur_netprice'],
                        'value' => $barcodeData['pur_netprice'],
                        'wsp' => $barcodeData['wsp'],
                        'mrp' => $barcodeData['mrp'],
                        'item_status' => $barcodeData['item_status']
        			);
        // echo "<pre>"; print_r($data);
        echo json_encode($data);
        exit();
    }

    public function getBarcodeOutWards()
    {
        // $barcode = '0000006276';
        $barcode = $_POST['barcode'];

        $barcodeData = $this->model_barcode->getSKUByBarcode($barcode);

        $salesData = $this->model_globalsearch->outWardsDataByBarcode($barcodeData['id']);
        $salesData1 = $this->model_globalsearch->outWardsDataByBarcode1($barcodeData['id']);
        $production1 = $this->model_globalsearch->outWardsProductionDataByBarcode1($barcodeData['id']);

        $result = array_merge($salesData, $salesData1, $production1);

        // echo "<pre>"; print_r($result); exit();

        if(empty($result))
        {
            $result1[] = array(
                                'qty' => '0',
                                'mrp' => '0',
                                'finalprice' => '0',
                                'invoice_no' => '',
                                'name' => '',
                                'customer' => '',
                                'url' => ''
                            );
        }
        else
        {
            foreach ($result as $key => $value) {

                if($value['inventory_type'] == 'invoice')
                {
                    $invoiceData = $this->model_salesinvoice->fecthAllDataByID($value['inventory_id']);

                    // echo "<pre>"; print_r($invoiceData);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    if(empty($customer))
                    {
                        $customer = "-";
                    }
                    else
                    {
                        $customer = $customer['ledger_name'];
                    }

                    $invoiceno = $invoiceData['inventory_no'];
                    $name = "Sales Invoice";
                    $url = 'sales_invoice/update/'.$invoiceData['id'];



                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];
                    $qty = $value['quantity'];

                }
                else if($value['inventory_type'] == 'salesexchange')
                {
                    $invoiceData = $this->model_salesexchange->fecthAllDataByID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account_id']);

                    $invoiceno = $invoiceData['exchange_no'];
                    $name = "Sales Exchange";
                    $url = 'sales_exchange/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];
                    $qty = $value['quantity'];

                }
                else if($value['inventory_type'] == 'wsp')
                {
                    $invoiceData = $this->model_salesinvoice->fecthAllDataByID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    $invoiceno = $invoiceData['inventory_no'];
                    $name = "WSP";
                    $url = 'wsp/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $barcodeData['wsp'];
                    $finalprice = $barcodeData['wsp'];
                    $qty = $value['qty'];

                }
                else if($value['inventory_type'] == 'preturn')
                {
                    $invoiceData = $this->model_purchasereturn->fecthAllDatabyID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account_id']);

                    $invoiceno = $invoiceData['order_no'];
                    $name = "Purchase Return";
                    $url = 'purchase_return/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];
                    $qty = $value['qty'];
                }
                else if($value['inventory_type'] == 'inventoty_consumption')
                {
                    $invoiceData = $this->model_internalconsumption->fecthDataByID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    $invoiceno = $invoiceData['inventory_no'];
                    $name = "Consuption";
                    $url = 'internal_consumption/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];
                    $qty = $value['quantity'];

                }
                else if($value['inventory_type'] == 'inventoty_shortage')
                {
                    $invoiceData = $this->model_shortage->fecthAllDataByID($value['inventory_id']);

                    $customer = $this->model_ledger->fecthDataByID($invoiceData['account']);

                    $invoiceno = $invoiceData['inventory_no'];
                    $name = "Shortages";
                    $url = 'shortage/update/'.$invoiceData['id'];
                    $customer = $customer['ledger_name'];

                    $mrp = $value['baseprice'];
                    $finalprice = $value['finalprice'];
                    $qty = $value['quantity'];

                }
                else if($value['production_type'] == 'production')
                {
                    // echo $value['production_id'];
                    $productData = $this->model_production->fecthAllDatabyID($value['production_id']);
                    // echo "<pre>"; print_r($productData);
                    $invoiceno = $productData['jobsheet_no'];
                    $name = "Jobsheet No";
                    $url = 'production/update/'.$productData['id'];

                    $customer = "-";
                    $mrp = $barcodeData['pur_netprice'];
                    $finalprice = $value['subtotal'];
                    $qty = $value['quantity'];
                }

                $result1[] = array(
                                        'qty' => $qty,
                                        'mrp' => $mrp,
                                        'finalprice' => $finalprice,
                                        'invoice_no' => $invoiceno,
                                        'name' => $name,
                                        'customer' => $customer,
                                        'url' => $url
                                    );  
            }   
        }

        

        // echo "<pre>"; print_r($result1);
        echo json_encode($result1);
        exit();
    }


    public function ledgerSearch()
    {
        $this->form_validation->set_rules('ledger', 'Ledger Name', 'trim|required');
    	
        if ($this->form_validation->run() == TRUE) {

        	// echo "<pre>"; print_r($_POST);
        	if((empty($_POST['from'])) && (empty($_POST['to'])))
        	{
        		$ledger = $this->model_ledger->fecthAllDatabyName($_POST['ledger']);
        		// $data = $this->model_globalsearch->fetchLedgerData($_POST['ledger']);
        		// echo "<pre>"; print_r($ledgerData);exit();

        		$this->data['ledger'] = $ledger;
        		// $this->data['ledgerEntries'] = $this->model_globalsearch->fetchledgerEntriesByLedgerID($ledger['id']);
        		// echo "<pre>"; print_r($ledgerEntries);

                $data = array(
                                    'ledger_id' => $ledger['id']
                                );
                // echo "<pre>"; print_r($data); exit();

                $this->data['ledgerEntries'] = $this->model_globalsearch->fetchLedgerEntries($data);


	            $this->data['skuData'] = $this->model_sku->fecthSkuAllData();
				$this->data['ledgerData'] = $this->model_ledger->fecthDataByType();

				$this->render_template('admin_view/globalSearch/index', $this->data);
        	}
        	else
        	{ 
        		// echo "Name and DAte beetween";
        		$ledger = $this->model_ledger->fecthAllDatabyName($_POST['ledger']);

        		$this->data['ledger'] = $ledger;

        		$data = array(
	        					'ledger_id' => $ledger['id'],
	        					'from' => $_POST['from'],
	        					'to' => $_POST['to']
        					);

                $this->data['ledgerEntries'] = $this->model_globalsearch->fetchLedgerEntriesBetweenDate($data);

        		// $this->data['ledgerEntries'] = $this->model_globalsearch->fetchledgerBetweenTwoDate($data);

        		// echo "<pre>"; print_r($ledgerEntries); exit();
        		$this->data['skuData'] = $this->model_sku->fecthSkuAllData();
				$this->data['ledgerData'] = $this->model_ledger->fecthDataByType();

				$this->render_template('admin_view/globalSearch/index', $this->data);
        	}
        }
        else
        {	
        	$data = array();
        	$this->data['ledgerEntries'] = $data;
            $this->data['skuData'] = $this->model_sku->fecthSkuAllData();
			$this->data['ledgerData'] = $this->model_ledger->fecthDataByType();
			
			$this->render_template('admin_view/globalSearch/index', $this->data);
        }
    }
    
    
    public function entriesSearch()
    {
        $this->form_validation->set_rules('entry', 'Entry Name', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            
            // echo "<pre>"; print_r($_POST);
            
            $data = array(
                            'from' => $_POST['from'],
                            'to' => $_POST['to']
                        );
                            
            if($_POST['entry'] == 'payment')
            {
                $this->data['result'] = $this->model_paymentnote->fecthAllDataBetweenDate($data);
                $this->data['link'] = 'paymentnote/update/';
                // echo "Payment Note <pre>"; print_r($result);
            }
            else if($_POST['entry'] == 'receipt')
            {
                // echo "receipt";
                $this->data['result'] = $this->model_receiptnotes->fecthAllDataBetweenDate($data);
                $this->data['link'] = 'receiptnote/update/';
            }
            else if($_POST['entry'] == 'journal')
            {
                // echo "Journal";
                $this->data['journal'] = $this->model_journalentry->fecthAllDataBetweenDate($data);
                $this->data['link'] = 'journalentry/update/';
            }
            else if($_POST['entry'] == 'contra')
            {
                // echo "Contra"; exit;
                $this->data['contra'] = $this->model_contraentry->fecthAllDataBetweenDate($data);
                $this->data['link'] = 'contraentry/update/';
            }
            // exit;
            
            $this->data['skuData'] = $this->model_sku->fecthSkuAllData();
    		$this->data['ledgerData'] = $this->model_ledger->fecthDataByType();
    		
            $this->render_template('admin_view/globalSearch/index', $this->data);
        }
        else
        {
            $this->data['skuData'] = $this->model_sku->fecthSkuAllData();
    		$this->data['ledgerData'] = $this->model_ledger->fecthDataByType();
			
			$this->render_template('admin_view/globalSearch/index', $this->data);
        }
    }


}
?>