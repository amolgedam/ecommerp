<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_exchange extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

        error_reporting(0);

        $this->load->library('number_to_word');

		$this->data['page_title'] = 'Sales Exchange';

		$this->load->model('model_salesorder');
		$this->load->model('model_ledger');
		$this->load->model('model_paymentmaster');
		$this->load->model('model_division');
		$this->load->model('model_branch');
		$this->load->model('model_location');
		
		$this->load->model('model_salesinvoice');
		$this->load->model('model_barcode');

        $this->load->model('model_salesexchange');
        $this->load->model('model_company');
        $this->load->model('model_state');
        $this->load->model('model_sku');
        $this->load->model('model_hsn');
        $this->load->model('model_discount');
        $this->load->model('model_gst');
		$this->load->model('model_category');
		
		$this->load->model('model_journalentry');
        $this->load->model('model_ledgerentry');

        $this->load->model('model_purchaseledger');
		$this->load->model('model_receiptnotes');
        $this->load->model('model_paymentnote');

	}

	public function fetchAllData()
	{
	    $data = $this->model_salesexchange->fecthAllData();
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
                
                $buttons .= '&nbsp; <a href="'.base_url().'sales_exchange/update/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'sales_exchange/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';

                $buttons .= '&nbsp; <a href="'.base_url().'sales_exchange/report/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-file-text"></i>Print Invoice</a>';

                $buttons .= '&nbsp; <a href="'.base_url().'sales_exchange/reportPOS/'.$value['id'].'" class="btn btn-sm btn-info"><i class="fa fa-file-text"></i>Print POS</a>';
                
                $result['data'][$key] = array(
                                                $no,
                                                $value['exchange_no'],
                                                $value['date'],
                                                $value['total_invoicevalue'],
                                                $value['invoice_status'],
                                                'Sales Exchange',
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
		$this->render_template('admin_view/salesMaster/salesExchange/index', $this->data);
	}

	public function create()
	{
		$this->form_validation->set_rules('exchange_no', 'Sales Exchange Number / Product Serial Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); //exit();

			$data = array( 
        					'exchange_no' => $this->input->post('exchange_no'),
        					'invoice_no' => $this->input->post('number'),
        					'invoice_id' => $this->input->post('invoice_id'),
        					'sales_orderno' => $this->input->post('sales_order_no'),
        					'saccount_id' => $this->input->post('saccount'),
        					'account_id' => $this->input->post('account'),
        					'date' => $this->input->post('date'),
        					'salesman_id' => $this->input->post('salesman'),
        					'division' => $this->input->post('division'),
        					// 'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'sales_memo' => $this->input->post('sales_memo'),
        					'salestype' => $this->input->post('sale_type'),
        					'shippingtype' => $this->input->post('shipping_type'),
        					'base_total' => $this->input->post('base_total'),
        					'total_discount' => $this->input->post('total_discount'),
        					'gross_total' => $this->input->post('gross_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'total_amt' => $this->input->post('total_amt'),
        					'adjustment' => $this->input->post('adjustment'),
        					'total_invoicevalue' => $this->input->post('total_invoice'),
        					'invcentory_type' => "salesexchange",
        					'invoice_status' => "Credit Sale",
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'created_by' => $this->session->userdata('wo_id')
        				);
			// echo "<pre>"; print_r($data); exit();

	        $created_id = $this->model_salesexchange->create($data);
	       // $created_id = "1";

	        if($created_id) {


                // // #####################################################
                // // Create Ledger start


                // SALES LEDGER
                $salesLedgerData = $this->model_ledger->fecthDataByID($_POST['saccount']);
                $updateSalesLedgerAmt = $salesLedgerData['closing_balance'] + $_POST['total_invoice'];
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
                                        'invoice_date' => $_POST['date'],
                                        'entry_date' => $_POST['date'],

                                        'purchase_type' => "salesexchange",
                                        'dr_cr' => 'CR',
                                        'amt' => abs($_POST['total_invoice']),
                                        'opening_bal' => $salesLedgerData['closing_balance'],
                                        'closing_bal' => $updateSalesLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                
               
                $this->model_purchaseledger->create($salesLedger);
                $this->model_ledger->update($salesLedgerDataUpdate);
                
                if($salesinvoice['account'] != 61 && $salesinvoice['account'] != 2625)
                {

                    // // ACCOUNT LEDGER
                    $accountLedgerData = $this->model_ledger->fecthDataByID($_POST['account']);
                    $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] + $_POST['total_invoice'];
                    // $updateAccountLedgerAmt = abs($updateAccountLedger);
    
                    // update account Ledger
                    $accountLedgerDataUpdate = array(
                                                        'id' => $accountLedgerData['id'],
                                                        'opening_balance' => $accountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateAccountLedgerAmt
                                                    );
                    // Add Data to Sales Ledger Table
                    $accountLedger = array(
                                            'purchase_id' => $created_id,
                                            'ledger_id' => $accountLedgerData['id'],
                                            'invoice_date' => $_POST['date'],
                                            'entry_date' => $_POST['date'],
    
                                            'purchase_type' => "salesexchange",
                                            'dr_cr' => 'CR',
                                            'amt' => abs($_POST['total_invoice']),
                                            'opening_bal' => $accountLedgerData['closing_balance'],
                                            'closing_bal' => $updateAccountLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                        );
                    
                    $this->model_purchaseledger->create($accountLedger);
                    $this->model_ledger->update($accountLedgerDataUpdate);
                }
                
                // GST LEDGER
                // // echo "gts"; print_r($gst);
                $gstLedgerData = $this->model_ledger->fecthDataByID($_POST['sale_type']);
                $updateGstLedgerAmt = $gstLedgerData['closing_balance'] - $_POST['total_tax'];
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
                                        'invoice_date' => $_POST['date'],
                                        'entry_date' => $_POST['date'],

                                        'purchase_type' => "salesexchange",
                                        'dr_cr' => 'DR',
                                        'amt' => abs($_POST['total_tax']),
                                        'opening_bal' => $gstLedgerData['closing_balance'],
                                        'closing_bal' => $updateGstLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
               
                $this->model_purchaseledger->create($gstLedger);
                $this->model_ledger->update($gstLedgerDataUpdate);

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedgerAmt = $discountLedgerData['closing_balance'] - $_POST['adjustment'];

                    // update purchase Ledger
                    $discountLedgerDataUpdate = array(
                                                        'id' => $discountLedgerData['id'],
                                                        'opening_balance' => $discountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateDiscountLedgerAmt
                                                    );
                    $discountLedger = array(
                                            'purchase_id' => $created_id,
                                            'ledger_id' => $discountLedgerData['id'],
                                            'invoice_date' => $_POST['date'],
                                            'entry_date' => $_POST['date'],

                                            'purchase_type' => "salesexchange",
                                            'dr_cr' => 'DR',
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
                
                // echo "<pre>"; print_r($_POST);
                
                if($this->input->post('salesman') != 0)
                {
                    $ledgerData = $this->model_ledger->fecthDataByID($this->input->post('salesman'));
                
                    $salesmanClosingBal = $ledgerData['closing_balance'] != '' ? $ledgerData['closing_balance'] : 0;
                    
                    $removeSalesmanComm = 0;
                }
                
                // remove
                $count_barcodelist = count($_POST['barcodelist']);
                
                for($i=0; $i<$count_barcodelist; $i++)
                {
                    if($this->input->post('salesman') != 0)
                    {
                        $removeSalesmanComm = $removeSalesmanComm + $this->input->post('commExchange')[$i];
                    }
                    
                    $invoiceData = $this->model_salesinvoice->getDataByBarcode($this->input->post('barcodelistid')[$i], $this->input->post('invoice_id'));
                    
                    $exchangeData = array(
                                            'inventory_id' => $created_id,
                                            'inventory_type' => 'salesexchange',
                                            'sales_exchange' => 'return item',
                                            'pno' => $invoiceData['pno'],
                                            'quantity' => $invoiceData['quantity'],
                                            'baseprice' => $invoiceData['baseprice'],
                                            'disvalue' => $invoiceData['disvalue'],
                                            'discount' => $invoiceData['discount'],
                                            'grossprice' => $invoiceData['grossprice'],
                                            'gst' => $invoiceData['gst'],
                                            'gstamt' => $invoiceData['gstamt'],
                                            'salesmancomm' => $invoiceData['salesmancomm'],
                                            'finalprice' => $invoiceData['finalprice'],
                                            'sku' => $invoiceData['sku'],
                                            'alterationprocess' => $invoiceData['alterationprocess'],
                                            'company_id' => $invoiceData['company_id'],
                                            'division_id' => $invoiceData['division_id'],
                                            'location_id' => $invoiceData['location_id'],
                                            'city_id' => $invoiceData['city_id'],
                                            'store_id' => $invoiceData['store_id'],
                                            'created_by' => $invoiceData['created_by'],
                                            'modified_by' => $invoiceData['modified_by'],
                                        ); 
                    // echo "<pre>"; print_r($exchangeData); 
                    $this->model_salesinvoice->createInvoiceData($exchangeData);

                    // // ############################################################


                    $itemData = $this->model_barcode->fetchAllDataByBarcode($this->input->post('barcodelist')[$i]);

                    $newQty = $itemData['balQty'] + $this->input->post('quantitylist')[$i];

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

                if($this->input->post('salesman') != 0)
                {
                    if($removeSalesmanComm > 0)
                    {
                        $returnAmt = $ledgerData['closing_balance'] - $removeSalesmanComm; 
    
                        $salesmanReturnLedger = array(
                                                    'id' => $ledgerData['id'],
                                                    'opening_balance' => $salesmanClosingBal,
                                                    'closing_balance' => $returnAmt
                                                );
    
                        // Add Data to Purchase Ledger Table
                        $salesmanCommReturnLedger = array(
                                                        'purchase_id' => $created_id,
                                                        'ledger_id' => $ledgerData['id'],
                                                        'purchase_type' => "salesexchange",
                                                        'invoice_date' => $_POST['date'],
                                                        // 'entry_date' => $_POST['entry_date'],
                                                        'dr_cr' => 'DR',
                                                        'amt' => $removeSalesmanComm,
                                                        'opening_bal' => $salesmanClosingBal,
                                                        'closing_bal' => $returnAmt,
                                                        'company_id' => $this->session->userdata('wo_company'),
                                                        // 'city_id' => $this->session->userdata('wo_city'),
                                                        'store_id' => $this->session->userdata('wo_store'),
                                                        'created_by' => $this->session->userdata('wo_id')
                                                    );
    
                        $this->model_purchaseledger->create($salesmanCommReturnLedger);
                        // update purchase ledger data
                        $this->model_ledger->update($salesmanReturnLedger);
                    }
                }


        		
        	    if($this->input->post('salesman') != 0)
                {
                    $newledgerData = $this->model_ledger->fecthDataByID($this->input->post('salesman'));
                    // echo "<pre>"; print_r($ledgerData);
                    $salesmanClosingBal = $newledgerData['closing_balance'] != '' ? $newledgerData['closing_balance'] : 0;
                }
                
                // Add sales invoice Data
        	    $count_product = count($_POST['pno']);
        	    
        	    for($i=0; $i<$count_product; $i++)
    	        {
    	            if($this->input->post('salesman') != 0)
                    {
                        $addSalesmanComm = $addSalesmanComm + $this->input->post('comm')[$i];
                    }
                    
    	        	$addData = array(
    	                            'inventory_id' => $created_id,
    	                            'inventory_type' => "salesexchange",
    	                            'sales_exchange' => "new item",
                					'pno' => $this->input->post('pno')[$i],
                					'quantity' => $this->input->post('quantity')[$i],
                					'conversion' => $this->input->post('conversion')[$i],
                					'conversionvalue' => $this->input->post('conversionvalue')[$i],
                					'baseprice' => $this->input->post('basepriceNew')[$i],
                					'discount' => $this->input->post('discountIDNew')[$i],
                					'disvalue' => $this->input->post('disvalueNew')[$i],
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
                	            
                	$this->model_salesinvoice->createInvoiceData($addData);
    	        }


                // exit();

                if($count_product > 0)
                {   
                    if($this->input->post('salesman') != 0)
                    {
                        $addAmt = $newledgerData['closing_balance'] + $addSalesmanComm; 
    
                        $salesmanAddLedger = array(
                                                    'id' => $newledgerData['id'],
                                                    'opening_balance' => $salesmanClosingBal,
                                                    'closing_balance' => $addAmt
                                                );
    
                        // Add Data to Purchase Ledger Table
                        $salesmanCommAddLedger = array(
                                                        'purchase_id' => $created_id,
                                                        'ledger_id' => $newledgerData['id'],
                                                        'purchase_type' => "salesexchange",
                                                        'invoice_date' => $_POST['date'],
                                                        // 'entry_date' => $_POST['entry_date'],
                                                        'dr_cr' => 'CR',
                                                        'amt' => $addSalesmanComm,
                                                        'opening_bal' => $salesmanClosingBal,
                                                        'closing_bal' => $addAmt,
                                                        'company_id' => $this->session->userdata('wo_company'),
                                                        // 'city_id' => $this->session->userdata('wo_city'),
                                                        'store_id' => $this->session->userdata('wo_store'),
                                                        'created_by' => $this->session->userdata('wo_id')
                                                    );
    
                        $this->model_purchaseledger->create($salesmanCommAddLedger);
                        // update purchase ledger data
                        $this->model_ledger->update($salesmanAddLedger);
                    }        
                }

    	        if(isset($_POST['payment']))
    	        {
    	           // echo "Redirect to Make Payment Page";
    	           return redirect('sales_exchange/makePayment/'.$created_id);
    	        }
    	        else
    	        {
    	            $this->session->set_flashdata('feedback','Data Saved Successfully');
            		$this->session->set_flashdata('feedback_class','alert alert-success');
            				
            		return redirect('sales_exchange');
    	        }
    	        
        	}else {
        		
        		$this->session->set_flashdata('feedback','Unable to Saved Data');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('sales_exchange/search');
        	}
	    }
	    else
	    {
	    	$this->session->set_flashdata('feedback','Unable to Exchange Record!');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			return redirect('sales_exchange/search');
	    }
	}

	public function search()
	{
		$this->form_validation->set_rules('number', 'Sales Invoice Number / Product Serial Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {

	    	// echo "<pre>"; print_r($_POST);exit();
	    	$number = $_POST['number'];

	    	$data = $this->model_salesinvoice->fecthAllDataByInvoiceID($number);

	    	// echo "<pre>"; print_r($data);

	    	if(empty($data))
	    	{
	    		// echo "empty";
	    		// $data = $this->model_barcode->fetchAllDataByBarcode($number);

	    		// if($data['item_status'] != 'soldout')
	    		// {
	    			$this->session->set_flashdata('feedback','Data not Found!');
					$this->session->set_flashdata('feedback_class','alert alert-danger');
					return redirect('sales_exchange/search');
	    		// }
	    		
	    		// $this->data['number'] = $data['barcode'];
	    		// $this->data['order_no'] = '';
	    		// $this->data['sales_account'] = '';
	    		// $this->data['account'] = '';
	    		// $this->data['date'] = '';
	    		// $this->data['salesman'] = '';
	    		// $this->data['division1'] = '';
	    		// $this->data['branch1'] = '';
	    		// $this->data['location1'] = '';
	    		// $this->data['sale_type'] = '';
	    	}
	    	else
	    	{
	    		$this->data['id'] = $data['id'];
	    		$this->data['number'] = $data['inventory_no'];
	    		$this->data['order_no'] = '';
	    		$this->data['sales_account'] = $data['sales_account'];
	    		$this->data['account'] = $data['account'];
	    		$this->data['date'] = $data['date'];
	    		$this->data['salesman'] = $data['salesman'];
	    		$this->data['division1'] = $data['division'];
	    		$this->data['branch1'] = $data['branch'];
	    		$this->data['location1'] = $data['location'];
	    		$this->data['sale_type'] = $data['sale_type'];
	    	}

	    	$orderNo = $this->model_salesexchange->lastrecord();
    	    
    	    if($orderNo == '')
    	    {
    	        $this->data['orderNo']  = '00001';
    	       // $orderNo = sprintf('%05d',$no);
    	    }
    	    else
    	    {
    	        $np = $orderNo['exchange_no'];
    	        $code = substr($np, 1); 
    	        
    	        $code = $code + 1;
    	        $code = sprintf('%05d',$code);
    	        
    	        $this->data['orderNo'] = $code;
    	    }
	    	// echo "<pre>"; print_r($data); exit();

	    	$this->data['salesorder'] = $this->model_salesorder->fecthAllData();

            // $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccountData();
			$this->data['ledgerAccount'] = $this->model_ledger->fecthAllData();

		    $this->data['ledgerPurAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
		    $this->data['ledgerPurType'] = $this->model_ledger->fecthTaxeAndDutiesData();
		    // $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();

                $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fecthLedgerAccountData();
                
		    $this->data['division'] = $this->model_division->fecthAllData();
		    $this->data['branch'] = $this->model_branch->fecthAllData();
		    $this->data['location'] = $this->model_location->fecthAllData();

			$this->render_template('admin_view/salesMaster/salesExchange/create', $this->data);
	    }
	    else
	    {
			$this->render_template('admin_view/salesMaster/salesExchange/search', $this->data);
	    }
	}

	public function update()
	{
		$id = $this->uri->segment(3);

		$this->form_validation->set_rules('id', 'Sales Exchange ID', 'trim|required');
		$this->form_validation->set_rules('exchange_no', 'Sales Exchange Number', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {

	    	// echo "<pre>"; print_r($_POST);

	    	$data = array(
        					'id' => $this->input->post('id'),
        					'exchange_no' => $this->input->post('exchange_no'),
        					'invoice_no' => $this->input->post('original_invoice_no'),
        					'sales_orderno' => $this->input->post('sales_order_no'),
        					'saccount_id' => $this->input->post('saccount'),
        					'account_id' => $this->input->post('account'),
        					'date' => $this->input->post('date'),
        					'salesman_id' => $this->input->post('salesman'),
        					'division' => $this->input->post('division'),
        					// 'branch' => $this->input->post('branch'),
        					'location' => $this->input->post('location'),
        					'sales_memo' => $this->input->post('sales_memo'),
        					'salestype' => $this->input->post('sale_type'),
        					'shippingtype' => $this->input->post('shipping_type'),
        					'base_total' => $this->input->post('base_total'),
        					'total_discount' => $this->input->post('total_discount'),
        					'gross_total' => $this->input->post('gross_total'),
        					'total_tax' => $this->input->post('total_tax'),
        					'total_amt' => $this->input->post('total_amt'),
        					'adjustment' => $this->input->post('adjustment'),
        					'total_invoicevalue' => $this->input->post('total_invoice'),
        					'invcentory_type' => "salesexchange",
        				// 	'invoice_status' => "Credit Sale",
        					'company_id' => $this->session->userdata('wo_company'),
        					// 'city_id' => $this->session->userdata('wo_city'),
        					'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
			// echo "<pre>"; print_r($data); exit();

			$update = $this->model_salesexchange->update($data);

			if($update)
			{
			    $type = "salesexchange";
		    
		        $this->model_purchaseledger->deletePurchaseID($this->input->post('id'), $type);
			    
			    // SALES LEDGER
                $salesLedgerData = $this->model_ledger->fecthDataByID($this->input->post('saccount'));
                $updateSalesLedgerAmt = $salesLedgerData['closing_balance'] + $this->input->post('total_invoice');
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
                                        'purchase_type' => "salesexchange",
                                        'dr_cr' => 'CR',
                                        'amt' => abs($this->input->post('total_invoice')),
                                        'opening_bal' => $salesLedgerData['closing_balance'],
                                        'closing_bal' => $updateSalesLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
                
               
                $this->model_purchaseledger->create($salesLedger);
                $this->model_ledger->update($salesLedgerDataUpdate);
                
                
                 if($salesinvoice['account'] != 61 && $salesinvoice['account'] != 2625)
                {
			        $drcr_status = 'DR';
                }
                else
                {
                    $drcr_status = 'CR';
                }
                    // // ACCOUNT LEDGER
                    $accountLedgerData = $this->model_ledger->fecthDataByID($this->input->post('account'));
                    $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] + $this->input->post('total_invoice');
                    // $updateAccountLedgerAmt = abs($updateAccountLedger);
    
                    // update account Ledger
                    $accountLedgerDataUpdate = array(
                                                        'id' => $accountLedgerData['id'],
                                                        'opening_balance' => $accountLedgerData['closing_balance'],
                                                        'closing_balance' => $updateAccountLedgerAmt
                                                    );
                    // Add Data to Sales Ledger Table
                    $accountLedger = array(
                                            'purchase_id' => $this->input->post('id'),
                                            'ledger_id' => $accountLedgerData['id'],
                                            'invoice_date' => $this->input->post('date'),
                                            'entry_date' => $this->input->post('date'),
                                            'purchase_type' => "salesexchange",
                                            'dr_cr' => $drcr_status,
                                            'amt' => abs($this->input->post('total_invoice')),
                                            'opening_bal' => $accountLedgerData['closing_balance'],
                                            'closing_bal' => $updateAccountLedgerAmt,
                                            'company_id' => $this->session->userdata('wo_company'),
                                            // 'city_id' => $this->session->userdata('wo_city'),
                                            'store_id' => $this->session->userdata('wo_store'),
                                            'created_by' => $this->session->userdata('wo_id')
                                        );
                    
                    $this->model_purchaseledger->create($accountLedger);
                    $this->model_ledger->update($accountLedgerDataUpdate);
                
			    
			        // GST LEDGER
                // // echo "gts"; print_r($gst);
                $gstLedgerData = $this->model_ledger->fecthDataByID($this->input->post('sale_type'));
                $updateGstLedgerAmt = $gstLedgerData['closing_balance'] - $this->input->post('total_tax');
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
                                        'purchase_type' => "salesexchange",
                                        'dr_cr' => 'DR',
                                        'amt' => abs($this->input->post('total_tax')),
                                        'opening_bal' => $gstLedgerData['closing_balance'],
                                        'closing_bal' => $updateGstLedgerAmt,
                                        'company_id' => $this->session->userdata('wo_company'),
                                        // 'city_id' => $this->session->userdata('wo_city'),
                                        'store_id' => $this->session->userdata('wo_store'),
                                        'created_by' => $this->session->userdata('wo_id')
                                    );
               
                $this->model_purchaseledger->create($gstLedger);
                $this->model_ledger->update($gstLedgerDataUpdate);

                if($_POST['adjustment'] != 0)
                {
                    $discountLedgerID = 82;
                    $discountLedgerData = $this->model_ledger->fecthDataByID1($discountLedgerID);
                    $updateDiscountLedgerAmt = $discountLedgerData['closing_balance'] - $this->input->post('adjustment');

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
                                            'purchase_type' => "salesexchange",
                                            'dr_cr' => 'DR',
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
    	            // echo "Redirect to Make Payment Page";
    	            return redirect('sales_exchange/makePayment/'.$this->input->post('id'));
    	        }
    	        else
    	        {
    	            $this->session->set_flashdata('feedback','Data Update Successfully!');
    				$this->session->set_flashdata('feedback_class','alert alert-success');
    			
    				return redirect('sales_exchange');    
    	        }
			}
			else
			{
				$this->session->set_flashdata('feedback','Unable to Update Data!');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
			
				return redirect('sales_exchange');
			}
	    }
	    else
	    {
	    	$this->data['allData'] = $this->model_salesexchange->fecthAllDataByID($id);

			$exchangeData = $this->model_salesexchange->fecthAllDataByID($id);
            // echo "<pre>"; print_r($exchangeData); exit();
			$data = array(
							'inventory_id' => $exchangeData['id'],
							'inventory_type' => 'salesexchange',
							// 'sales_exchange' => 'addproduct'
						);
            // echo "<pre>"; print_r($data); exit();
			$this->data['itemData'] = $this->model_salesexchange->fecthAllItemData($data);

			$this->data['salesorder'] = $this->model_salesorder->fecthAllData();

            $this->data['ledgerAccount'] = $this->model_ledger->fecthAllData1();
			// $this->data['ledgerAccount'] = $this->model_ledger->fecthLedgerAccount();
            

		    $this->data['ledgerPurAccount'] = $this->model_ledger->fetchPurchaseSalesAccount();
		    $this->data['ledgerPurType'] = $this->model_ledger->fecthTaxeAndDutiesData();
		    // $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();

            $this->data['ledgerSalesmanAccount'] = $this->model_ledger->fetchLedgerDataByLedgertype(6);

		    $this->data['division'] = $this->model_division->fecthAllData();
		    $this->data['branch'] = $this->model_branch->fecthAllData();
		    $this->data['location'] = $this->model_location->fecthAllData();

			$this->render_template('admin_view/salesMaster/salesExchange/update', $this->data);
	    }
	}

	public function delete()
	{
		$id = $this->uri->segment(3);

		$delete = $this->model_salesexchange->delete($id);	

		if($delete) {
		    
		    $type = "salesexchange";
		    
		    $this->model_purchaseledger->deletePurchaseID($id, $type);

            $data = array(
                'inventory_id' => $id,
                'inventory_type' => 'salesexchange',
                // 'sales_exchange' => 'addproduct'
            );

            $exchangeData = $this->model_salesinvoice->fecthExchangeData($data);
            
		    
    		$this->session->set_flashdata('feedback','Record Deleted Successfully');
			$this->session->set_flashdata('feedback_class','alert alert-success');

			return redirect('sales_exchange');
    	}
    	else{

    		$this->session->set_flashdata('feedback','Unable to Delete Record');
			$this->session->set_flashdata('feedback_class','alert alert-danger');
			
			return redirect('sales_exchange');
    	}
	}
	
	public function makePayment()
	{
	    $id = $this->uri->segment(3);
	    // echo $id;
	    
	    $this->form_validation->set_rules('paid', 'Paid Amount', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
            $salesinvoice = $this->model_salesexchange->fecthAllDataByID($this->input->post('id'));
            // echo "<pre>"; print_r($salesinvoice);
	        
            $data = array(
        					'salesorder_id' => $this->input->post('id'),
        					'type' => $salesinvoice['invcentory_type'],
        					'estimate' => $this->input->post('totvalue'),
        					'paid' => $this->input->post('paid'),
        					'balance' => $this->input->post('remainingpaid'),
        					'date' => $this->input->post('entrydate'),
        					'check_num' => $this->input->post('number'),
        					'paymenttype_id' => $this->input->post('payment_type'),
        					'company_id' => $this->session->userdata('wo_company'),
        	    			// 	'city_id' => $this->session->userdata('wo_city'),
        		    		'store_id' => $this->session->userdata('wo_store'),
        					'modified_by' => $this->session->userdata('wo_id')
        				);
        
	       // $created = $this->model_salesorder->makepayment($data);
            $created = 1;
	        
            if($created) {
	            
                if($this->input->post('totvalue') < 0)
                {
                    $status = 'Credit Sales';
                    
                    if($salesinvoice['account'] != 61 && $salesinvoice['account'] != 2625)
                    {
                        $accountLedgerData = $this->model_ledger->fecthDataByID($salesinvoice['account_id']);
                        $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] - $_POST['totvalue'];

                        // update account Ledger
                        $accountLedgerDataUpdate = array(
                                                            'id' => $accountLedgerData['id'],
                                                            'opening_balance' => $accountLedgerData['closing_balance'],
                                                            'closing_balance' => $updateAccountLedgerAmt
                                                        );
                        $accountLedger = array(
                                                'purchase_id' => $this->input->post('id'),
                                                'ledger_id' => $accountLedgerData['id'],
                                                'invoice_date' => $_POST['entrydate'],
                                                'entry_date' => $_POST['entrydate'],
                                                'purchase_type' => "salesexchange",
                                                'dr_cr' => 'DR',
                                                'amt' => abs($_POST['totvalue']),
                                                'opening_bal' => $accountLedgerData['closing_balance'],
                                                'closing_bal' => $updateAccountLedgerAmt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                            );

                        // echo "Hi <pre>"; print_r($accountLedgerDataUpdate);
                        // echo "<pre>"; print_r($accountLedger); //exit();
                        $this->model_purchaseledger->create($accountLedger);
                        $this->model_ledger->update($accountLedgerDataUpdate);
                    }
                        
                        if($this->input->post('payment_type') != 7)
                        {
                            
                            $status = 'Payment Done';
                            
                            $paymentType = $this->model_paymentmaster->fecthDataByID($this->input->post('payment_type'));
    
                            $paymentTypeLedgerData = $this->model_ledger->fecthDataByID($paymentType['ledger_id']);
    
                            $paymentTypeLedgerAmt = $paymentTypeLedgerData['closing_balance'] - $_POST['paid'];
    
                            // update account Ledger
                            $paymentLedgerDataUpdate = array(
                                                                'id' => $paymentTypeLedgerData['id'],
                                                                'opening_balance' => $paymentTypeLedgerData['closing_balance'],
                                                                'closing_balance' => $paymentTypeLedgerAmt
                                                            );
                            $paymentLedger = array(
                                                    'purchase_id' => $this->input->post('id'),
                                                    'ledger_id' => $paymentTypeLedgerData['id'],
                                                    'invoice_date' => $_POST['entrydate'],
                                                    'entry_date' => $_POST['entrydate'],
    
                                                    'purchase_type' => "salesexchange",
                                                    'dr_cr' => 'CR',
                                                    'amt' => abs($_POST['paid']),
                                                    'opening_bal' => $paymentTypeLedgerData['closing_balance'],
                                                    'closing_bal' => $paymentTypeLedgerAmt,
                                                    'company_id' => $this->session->userdata('wo_company'),
                                                    // 'city_id' => $this->session->userdata('wo_city'),
                                                    'store_id' => $this->session->userdata('wo_store'),
                                                    'created_by' => $this->session->userdata('wo_id')
                                                );
                                                
                            // echo "<pre>"; print_r($paymentLedgerDataUpdate);
                            // echo "<pre>"; print_r($paymentLedger); //exit();
    
                            $this->model_ledger->update($paymentLedgerDataUpdate);
                            $this->model_purchaseledger->create($paymentLedger);
                        }
                        
                        $data = array(
        					'id' => $this->input->post('id'),
        					'invoice_status' => $status,
        					'modified_by' => $this->session->userdata('wo_id')
        				);
    	        
                    // 	echo "Hi<pre>"; print_r($data); exit();
                        $create = $this->model_salesexchange->update($data);
                        
        
        
                	    if(!empty($_POST['print']))
            	        {
            	            return redirect('sales_exchange/report/'.$salesinvoice['id']);
            	            
            	        }
            	        else
            	        {
            	            $this->session->set_flashdata('feedback','Payment Succesfull Successfully');
            				$this->session->set_flashdata('feedback_class','alert alert-success');
            				
            				return redirect('sales_exchange');
            	        }
                }
                else
                {
                    
                    $status = 'Credit Sales';
                    
                    if($salesinvoice['account'] != 61 && $salesinvoice['account'] != 2625)
                    {
                        // account data to CR
                        $accountLedgerData = $this->model_ledger->fecthDataByID($salesinvoice['account_id']);
                        $updateAccountLedgerAmt = $accountLedgerData['closing_balance'] - $_POST['paid'];

                        // update account Ledger
                        $accountLedgerDataUpdate = array(
                                                            'id' => $accountLedgerData['id'],
                                                            'opening_balance' => $accountLedgerData['closing_balance'],
                                                            'closing_balance' => $updateAccountLedgerAmt
                                                        );
                        $accountLedger = array(
                                                'purchase_id' => $this->input->post('id'),
                                                'ledger_id' => $accountLedgerData['id'],
                                                'invoice_date' => $_POST['entrydate'],
                                                'entry_date' => $_POST['entrydate'],

                                                'purchase_type' => "salesexchange",
                                                'dr_cr' => 'DR',
                                                'amt' => $_POST['paid'],
                                                'opening_bal' => $accountLedgerData['closing_balance'],
                                                'closing_bal' => $updateAccountLedgerAmt,
                                                'company_id' => $this->session->userdata('wo_company'),
                                                // 'city_id' => $this->session->userdata('wo_city'),
                                                'store_id' => $this->session->userdata('wo_store'),
                                                'created_by' => $this->session->userdata('wo_id')
                                            );

                        // echo "Hi<pre>"; print_r($accountLedgerDataUpdate);
                        // echo "<pre>"; print_r($accountLedger);//exit();
                        $this->model_purchaseledger->create($accountLedger);
                        $this->model_ledger->update($accountLedgerDataUpdate);
                    }
                        
                        if($this->input->post('payment_type') != 7)
                        {
                            $status = 'Payment Done';
                            
                            $paymentType = $this->model_paymentmaster->fecthDataByID($this->input->post('payment_type'));
    
                            $paymentTypeLedgerData = $this->model_ledger->fecthDataByID($paymentType['ledger_id']);
    
                            $paymentTypeLedgerAmt = $paymentTypeLedgerData['closing_balance'] - $_POST['paid'];
    
    
                            // update account Ledger
                            $paymentLedgerDataUpdate = array(
                                                                'id' => $paymentTypeLedgerData['id'],
                                                                'opening_balance' => $paymentTypeLedgerData['closing_balance'],
                                                                'closing_balance' => $paymentTypeLedgerAmt
                                                            );
                            $paymentLedger = array(
                                                    'purchase_id' => $this->input->post('id'),
                                                    'ledger_id' => $paymentTypeLedgerData['id'],
                                                    'invoice_date' => $_POST['entrydate'],
                                                    'entry_date' => $_POST['entrydate'],
    
                                                    'purchase_type' => "salesexchange",
                                                    'dr_cr' => 'DR',
                                                    'amt' => $_POST['paid'],
                                                    'opening_bal' => $paymentTypeLedgerData['closing_balance'],
                                                    'closing_bal' => $paymentTypeLedgerAmt,
                                                    'company_id' => $this->session->userdata('wo_company'),
                                                    // 'city_id' => $this->session->userdata('wo_city'),
                                                    'store_id' => $this->session->userdata('wo_store'),
                                                    'created_by' => $this->session->userdata('wo_id')
                                                );
    
                            // echo "<pre>"; print_r($paymentLedgerDataUpdate);
                            // echo "<pre>"; print_r($paymentLedger); //exit();
                            $this->model_ledger->update($paymentLedgerDataUpdate);
                            $this->model_purchaseledger->create($paymentLedger);
                        }
                        
                    $data = array(
        					'id' => $this->input->post('id'),
        					'invoice_status' => $status,
        					'modified_by' => $this->session->userdata('wo_id')
        				);
    	        
                // 	echo "<pre>"; print_r($data); exit();
                    $create = $this->model_salesexchange->update($data);
                    
    
    
            	    if(!empty($_POST['print']))
        	        {
        	            return redirect('sales_exchange/report/'.$salesinvoice['id']);
        	            
        	        }
        	        else
        	        {
        	            $this->session->set_flashdata('feedback','Payment Succesfull Successfully');
        				$this->session->set_flashdata('feedback_class','alert alert-success');
        				
        				return redirect('sales_exchange');
        	        }
                }

	        }
	        else
	        {
	            $this->session->set_flashdata('feedback','Unable to Make Payment');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('sales_exchange');
	        }
	    }
	    else
	    {
	        $this->data['id'] = $id;
	    
    	    $this->data['paytype'] = $this->model_paymentmaster->fecthAllData();
    	    $this->data['allData'] = $this->model_salesexchange->fecthAllDataByID($id);
    	    
    	    $this->render_template('admin_view/salesMaster/salesExchange/makePayment', $this->data); 
	    }
	}
	

    public function report()
    {
        $id = $this->uri->segment(3);

        $company_id = $this->session->userdata['wo_company'];
        $companyDetails = $this->model_company->fecthDataByID($company_id);

        $cityData = $this->model_state->fecthCityByID($companyDetails['city']);

        $invoiceData = $this->model_salesexchange->fecthAllDataByID($id);

        $customerData = $this->model_ledger->fecthAllDatabyID($invoiceData['account_id']);

        $data = array(
                        'inventory_id' => $id,
                        'inventory_type' => 'salesexchange',
                    );
        $itemData = $this->model_salesexchange->fecthAllItemData($data);
        
        // echo "<pre>"; print_r($invoiceData); exit();
        // echo "<pre>"; print_r($invoiceData); exit();
        // echo "<pre>"; print_r($itemData); exit();

        $salesType = $this->model_ledger->fecthAllDatabyID($invoiceData['salestype']);


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
                                                            <td>'.$invoiceData['exchange_no'].'</td>
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
                                                            <td>'.$invoiceData['shippingtype'].'</td>
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
                                                            <th class="myBorder" style="width: 130px;">&nbsp; GST Amt.</th>
                                                            <th class="myBorder">&nbsp; Gross Amt.</th>
                                                        </tr>';

                                                        $qty=$subtotal=$discount=$tsgst=$tcgst=$tigst=0; $no=1;

                                                        foreach($itemData as $rows)
                                                        {

                                                            $productData = $this->model_sku->fecthSkuDataByID($rows['sku']);

                                                            $barcodeData = $this->model_barcode->fetchDataBySkuCode1($rows['sku']);
                                                            // echo "<pre>"; print_r($barcodeData);
                                                            $hsnData = $this->model_hsn->fecthAllDataById($barcodeData['hsn']);

                                                            $discountData = $this->model_discount->fecthDataByID($rows['discount']);

                                                            $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);

                                                            // $per = 100;
                                                            
                                                            

                                                            $bsgst = ($rows['baseprice'] * $gstData['sgst']) / 100;
                                                            $bcgst = ($rows['baseprice'] * $gstData['cgst']) / 100;
                                                            $bigst = ($rows['baseprice'] * $gstData['igst']) / 100;

                                                            // echo "SGST".$bsgst; 
                                                            // echo "CGST".$bcgst; 
                                                            // echo "IGST".$bigst; 

                                                            // $sgst = ($rows['baseprice'] * $gstData['sgst']) / 100;
                                                            // $cgst = ($rows['baseprice'] * $gstData['cgst']) / 100;

                                                            // $igst = ($rows['baseprice'] * $gstData['igst']) / 100;

                                                            $qty = $qty + $rows['quantity'];

                                                            $baseprice = $rows['sales_exchange'] == 'return item' ? (- $rows['finalprice']) : $rows['finalprice'];

                                                            $subtotal = $subtotal + $baseprice;
                                                            
                                                            $discount = $discount + $rows['disvalue'];

                                                            $ftsgst = $rows['sales_exchange'] == 'return item' ? (- $bsgst) : $bsgst;
                                                            $ftcgst = $rows['sales_exchange'] == 'return item' ? (- $bcgst) : $bcgst;
                                                            $ftigst = $rows['sales_exchange'] == 'return item' ? (- $bigst) : $bigst;

                                                            $tsgst = $tsgst + $ftsgst;
                                                            $tcgst = $tcgst + $ftcgst;
                                                            $tigst = $tigst + $ftigst;

                                                            $html.='<tr>
                                                                        <td class="myBorder">&nbsp; '.$no.'</td>
                                                                        <td class="myBorder">&nbsp; '.$productData['product_code'].'</td>
                                                                        <td class="myBorder">&nbsp; '.$hsnData['hsn_code'].'</td>

                                                                        <td class="myBorder">&nbsp; '.($rows['sales_exchange'] == "return item" ? (- $rows['quantity']) : $rows['quantity']).'</td>

                                                                        <td class="myBorder">&nbsp; '.$rows['baseprice'].'</td>

                                                                        <td class="myBorder">&nbsp; '.'('.($rows['disvalue'] != 0 ? $rows['disvalue']." ".($discountData['discount']) : "0").')'.$rows['disvalue'].'</td>

                                                                        <td class="myBorder">&nbsp; '.($rows['sales_exchange'] == "return item" ? " -".number_format($bsgst, 3)." (".$gstData['sgst']."%)" : number_format($bsgst, 3)." (".$gstData['sgst']."%) " ).'</td>

                                                                        <td class="myBorder">&nbsp; '.($rows['sales_exchange'] == "return item" ? " -".number_format($bcgst, 3)." (".$gstData['cgst']."%)" : number_format($bcgst, 3)." (".$gstData['cgst']."%) " ).'</td>

                                                                        <td class="myBorder">&nbsp; '.($rows['sales_exchange'] == "return item" ? " -".number_format($bigst, 3)." (".$gstData['igst']."%)" : number_format($bigst, 3)." (".$gstData['igst']."%) " ).'</td>

                                                                        <td class="myBorder">&nbsp; '.($rows['sales_exchange'] == "return item" ? "- " : "").$rows['gstamt'].'</td>

                                                                        <td class="myBorder">&nbsp; '.($rows['sales_exchange'] == "return item" ? "- " : "").($rows['finalprice']).'</td>
                                                                    </tr>';
                                                            $no++;
                                                        }

                                                $html.='<tr>
                                                            <td class="myBorder" colspan="9">&nbsp;</td>
                                                            <td class="myBorder"><b>&nbsp; Subtotal:-</b></td>
                                                            <td class="myBorder"><b>&nbsp; '.$subtotal.'</b></td>
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
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td class="bottomBorder">&nbsp;Discount</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bottomBorder">&nbsp;SGST</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bottomBorder">&nbsp;CGST</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td class="bottomBorder">&nbsp;IGST</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td class="bottomBorder">&nbsp;Adjustment</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td>&nbsp;</td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td>&nbsp;</td>
                                                                      </tr>
                                                                </table>
                                                            </td>
                                                            <td class="myBorder" width="100px">
                                                                <table width="100%">
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px" class="bottomBorder">'.($discount != 0 ? $discount : 0).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px" class="bottomBorder">'.$tsgst.'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px" class="bottomBorder">'.$tcgst.'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px" class="bottomBorder">'.$tigst.'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px" class="bottomBorder">'.$invoiceData['adjustment'].'</td>
                                                                  </tr>
                                                                   <tr>
                                                                      <td>&nbsp;</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td>&nbsp;</td>
                                                                  </tr>

                                                                  
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                          <td class="myBorder" colspan="9">
                                                            <div class="pl15">
                                                              <p><b>IN WORDS : </b></p>
                                                            </div>
                                                          </td>
                                                          <td class="myBorder">
                                                            <div class="pl15"><b>Grand Total</b></div>
                                                          </td>
                                                          <td class="myBorder" style="text-align: right; padding-right: 5px">'.$subtotal.'</td>
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

// $this->number_to_word->convert_number(number_format($subtotal))
              echo $html;

        // $this->render_template('admin_view/salesMaster/salesExchange/report', $this->data);
    }

    public function reportPOS()
    {
        $id = $this->uri->segment(3);


        $company_id = $this->session->userdata['wo_company'];
        $companyDetails = $this->model_company->fecthDataByID($company_id);

        $cityData = $this->model_state->fecthCityByID($companyDetails['city']);

        $invoiceData = $this->model_salesexchange->fecthAllDataByID($id);

        $data = array(
                        'inventory_id' => $id,
                        'inventory_type' => 'salesexchange',
                    );
        $itemData = $this->model_salesexchange->fecthAllItemData($data);
        
        $customerData = $this->model_ledger->fecthAllDatabyID($invoiceData['account_id']);

        // echo "<pre>"; print_r($customerData); exit();
        // echo "<pre>"; print_r($invoiceData); exit();
        // echo "<pre>"; print_r($itemData); exit();

        $salesType = $this->model_ledger->fecthAllDatabyID($invoiceData['salestype']);

        $gstAllData = $this->model_gst->fecthAllData();

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
                                                            <td>'.$invoiceData['exchange_no'].'</td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Bill Date :-</b></td>
                                                            <td>'.date("d-m-Y", strtotime($invoiceData['date'])).'</td>
                                                          </tr>
                                                          <tr>
                                                            <td><b>Customer :-</b></td>
                                                            <td>'.$customerData['ledger_name'].'</td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table width="100%">
                                                          <tr>
                                                            <td><b>Cashier :-</b></td>
                                                            <td>-</td>
                                                          </tr>
                                                          <tr>
                                                            <td>
                                                              <b>Salesman Code :-</b>
                                                            </td>
                                                            <td>&nbsp;</td>
                                                          </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <th class="myBorder" style="width: 100px">&nbsp; Sr no.</th>
                                                            <th class="myBorder">&nbsp; Description</th>
                                                            <th class="myBorder" style="width: 150px">&nbsp; Qty</th>
                                                            <th class="myBorder" style="width: 200px">&nbsp; Rate</th>
                                                            <th class="myBorder" style="width: 150px">&nbsp; DISC. (%)</th>
                                                            <th class="myBorder" style="width: 200px">&nbsp; GROSS AMOUNT</th>
                                                        </tr>';
                                                    $no=1; 
                                                    $countQty=$subtotal=$dis=$totgst=$fsubtotal=$ftotgst=0;
                                                    foreach($itemData as $rows)
                                                    {
                                                        // for order description
                                                        $orderData = $this->model_barcode->fetchAllDataByBarcodeid($rows['pno']);

                                                        $skuData = $this->model_sku->fecthDataBySKUID($orderData['sku_code']);

                                                        $category = $this->model_category->fecthCatDataByID($skuData['category_id']);

                                                        $subcategory = $this->model_category->fecthSubCatDataByID($skuData['subcategory_id']);

                                                        // echo "<pre>"; print_r($subcategory);

                                                        $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);

                                                        $gst = $gstData['sgst'] + $gstData['cgst'] + $gstData['igst'];

                                                        $countQty = $countQty + $rows['quantity'];

                                                        $baseprice = $rows['sales_exchange'] == 'return item' ? (- $rows['baseprice']) : $rows['baseprice'];

                                                        $dis = $dis + $rows['disvalue'];
                                                        
                                                        $totgst = $totgst + $rows['gstamt'];

                                                        $gprice = ($rows['baseprice']) - ($rows['disvalue']) - $rows['gstamt'];

                                                        $subtotal = $subtotal + $gprice;


                                                        $html .= '<tr>
                                                                    <td class="myBorder">&nbsp;'.$no.'</td>
                                                                    <td class="myBorder"><center>'.$category['catgory_name'].', '.$subcategory['subcategory_name'].', <br>'.$orderData['sku_code'].', <br>'.$orderData['barcode'].'</center></td>

                                                                    <td class="myBorder">&nbsp;'.($rows['sales_exchange'] == 'return item' ? "- ".$rows['quantity'] : $rows['quantity']).'<br>&nbsp;'.$gst.' % GST</td>
                                                                    <td class="myBorder">&nbsp;'.($rows['sales_exchange'] == 'return item' ? "- ".$rows['baseprice'] : $rows['baseprice']).'<br>&nbsp;GST Amt '.($rows['sales_exchange'] == 'return item' ? "- ".$rows['gstamt'] : $rows['gstamt']).'</td>
                                                                    <td class="myBorder">&nbsp;'.($rows['disvalue'] != 0 ? $rows['disvalue'] : '0').'</td>
                                                                    <td class="myBorder">&nbsp;'.($rows['sales_exchange'] == 'return item' ? (- $rows['finalprice']) : $rows['finalprice'] ).'</td>
                                                                </tr>';

                                                        $fsubtotal = $fsubtotal + ($rows['sales_exchange'] == 'return item' ? (- $rows['finalprice']) : $rows['finalprice'] );
                                                        $ftotgst = $ftotgst + ($rows['sales_exchange'] == 'return item' ? (- $rows['gstamt']) : $rows['gstamt']);
                                                    }

                                                $html .= '<tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Subtotal:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.($fsubtotal).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Discount:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.$dis.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Total GST:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.$ftotgst.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Round Off Amount:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.$invoiceData['adjustment'].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Cash:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.($fsubtotal).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Trending Charge:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; 0</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">&nbsp;Total Net Due:- </td>
                                                            <td colspan="3">&nbsp;</td>
                                                            <td>&nbsp; '.($fsubtotal).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">
                                                                <table align="center" width="80%">
                                                                    <tr>
                                                                        <td>&nbsp;TAX Description</td>
                                                                        <td>&nbsp;Amount</td>
                                                                        <td>&nbsp;SGST</td>
                                                                        <td>&nbsp;CGST</td>
                                                                        <td>&nbsp;IGST</td>
                                                                    </tr>';
                                                                // $totGrossprice=$sgst=$cgst=$igst=$totAmt=$totsgst=$totcgst=$totigst=0;
                                                            
                                                            $totGrossprice=$totsgst=$totcgst=$totigst=$totAmt=$totsgst=$totcgst=$totigst=0;

                                                            $sgst=$cgst=$igst=0;

                                                            foreach ($gstAllData as $key => $value)
                                                            {
                                                                $data = array(
                                                                                'inventory_id' => $invoiceData['invoice_id'],
                                                                                'inventory_type' => 'salesexchange',
                                                                                'gst_id' => $value->id 
                                                                            );
                                                                $itemDataForGST = $this->model_salesexchange->fecthAllItemDataByIdTypeGST($data);

                                                                // $itemDataForGST = $this->model_vouchers->fecthAllDatabyVoucherIDTypeGST($data);
                                                                // echo "<pre>"; print_r($itemDataForGST);

                                                                $amt=0;
                                                                foreach ($itemDataForGST as $rows)
                                                                {
                                                                    $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);


                                                                    $baseprice = $rows['sales_exchange'] == 'return item' ? (- $rows['baseprice']) : $rows['baseprice'];


                                                                    $amt = $amt + $baseprice;
                                                                }

                                                                $sgst = ($amt * $value->sgst) / 100;
                                                                $cgst = ($amt * $value->cgst) / 100;
                                                                $igst = ($amt * $value->igst) / 100;
                                                                $html .= '<tr>
                                                                            <td>'.($amt != 0 ? $value->sgst + $value->cgst + $value->igst : "").'</td>
                                                                            <td>'.($amt != 0 ? $amt : "").'</td>
                                                                            <td>'.($amt != 0 ? $sgst : "").'</td>
                                                                            <td>'.($amt != 0 ? $cgst : "").'</td>
                                                                            <td>'.($amt != 0 ? $igst : "").'</td>
                                                                        </tr>';

                                                                $totAmt = $totAmt + $amt;
                                                                $totsgst = $totsgst + $sgst;
                                                                $totcgst = $totcgst + $cgst;
                                                                $totigst = $totigst + $igst;
                                                            }
                                                                
                                                            $html .= '<tr>
                                                                        <td>&nbsp;Total :- </td>
                                                                        <td>'.$totAmt.'</td>
                                                                        <td>'.$totsgst.'</td>
                                                                        <td>'.$totcgst.'</td>
                                                                        <td>'.$totigst.'</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">
                                                                <center>Total Include of GST Rs. <b> '.($totAmt).' </b> <br>
                                                                    Payment Type : CASH
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 15px;">
                                                  <span>
                                                    <b>
                                                      <u>Declaration :</u>
                                                    </b>
                                                    <p>Certified that the particulars given above are true & correct and the amount indicated represents the price actually charged and there is no flow of additional consideration directly or indirectly from the buyers. </p>
                                                  </span>

                                                  <div>
                                                    <b>
                                                      <u>Terms & Conditions :</u>
                                                    </b><br>
                                                    <span>1. Subject To Nagpur Jurisdiction </span> <br>
                                                    <span>2. No Cancellation/ Exchange or Return of Made to Ordered or Altered Items. </span> <br>
                                                    <span>3. All Applicable Taxes/GST/Levies if/any apart from mentioned above would be Charged Extra at the time of Billing. </span> <br>
                                                    <span>4. Payment to be made on or before due date mentioned here, in favour of M/s. PARAMOUNT TRADING VENTURES ,bank details are given here-in. </span> <br>
                                                    <span>5. Cash Payment Without Original Reciept would be invalid. </span> <br>
                                                    <span>6. Payment against Made to Order or to be Altered product is Non-Refundable. </span> <br>
                                                    <span>7. No Gurantee/Warranty on designs/patterns and color fastness. </span> <br>
                                                    <span>8. Any Manufacturing/Fitting Defect would be resolved by means of Alteration/Repairs. </span> <br>
                                                    <span>9. Committed Delivery date can change,depending upon the prevailing conditions and supplies. </span> <br>
                                                    <span>10. We reserve the right to demand settlement of this invoice bill at any time before due date. </span>
                                                  </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <br>
                                                    &nbsp;
                                                    <span><b>* This is a Computer Generated Document hence no Signature is Required</b></span>
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

        // $this->render_template('admin_view/salesMaster/salesExchange/reportPOS', $this->data);
    }
}