<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Reports extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

        error_reporting(0);

        ini_set('max_input_vars','0');
        ini_set('max_execution_time', 600);

		$this->load->library('number_to_word');

		$this->load->model('model_attribute');
		$this->load->model('model_accountcat');
		$this->load->model('model_category');
		$this->load->model('model_company');
		$this->load->model('model_state');
		$this->load->model('model_ledger');
		$this->load->model('model_location');
		$this->load->model('model_sku');
		$this->load->model('model_hsn');
		$this->load->model('model_discount');
		$this->load->model('model_gst');
		$this->load->model('model_unit');
		$this->load->model('model_barcode');
		$this->load->model('model_brand');

		$this->load->model('model_purchaseinvoice');
		$this->load->model('model_purchaseitem');
		$this->load->model('model_purchasevoucher');
		$this->load->model('model_purchasereturn');

        $this->load->model('model_internalconsumption');

		
        $this->load->model('model_salesorder');
        $this->load->model('model_salesinvoice');
		$this->load->model('model_vouchers');
        $this->load->model('model_salesexchange');
		$this->load->model('model_wsp');

		$this->load->model('model_journalentry');
		$this->load->model('model_globalsearch');
		$this->load->model('model_paymentnote');
        $this->load->model('model_receiptnotes');
		$this->load->model('model_contraentry');

		$this->load->model('model_openingitem');
		$this->load->model('model_openingstock');

        $this->load->model('model_purchaseledger');

        $this->load->model('model_production');
        $this->load->model('model_brand');
        $this->load->model('model_location');
        $this->load->model('model_division');
        $this->load->model('model_paymentmaster');


		$this->data['page_title'] = 'Reports';
	}
	
	public function ledgerGroupReport()
	{
		$this->data['accountCat'] = $this->model_accountcat->fecthAllCatData();
		$this->data['accountSubCat'] = $this->model_accountcat->fecthAllSubCatData();

        $this->form_validation->set_rules('category', 'Category Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); exit();
            $data = array(
                            'acate_id' => $_POST['category'],
                            'asubcate_id' => $_POST['subcategory'],
                            'from' => $_POST['from'],
                            'to' => $_POST['to']
                        );

            if(isset($_POST['search']))
            {
                if((empty($_POST['from'])) && (empty($_POST['to'])))
    	        {
                    $this->data['postData'] = $data;
    	        	$this->data['ledgerData'] = $this->model_ledger->getLedgerGroupReport($data);
    	        	// echo "<pre>"; print_r($ledgerData);exit();
    				
    				$this->render_template('admin_view/reports/ledgerGroupReport', $this->data);
    	        }
    	        else
    	        {
                    $this->data['postData'] = $data;
    	        	$this->data['ledgerData'] = $this->model_ledger->getLedgerGroupReport($data);
    				
    				$this->render_template('admin_view/reports/ledgerGroupReport', $this->data);
    	        }                
            }
            else if(isset($_POST['print']))
            {
                if((empty($_POST['from'])) && (empty($_POST['to'])))
    	        {
    	        	$ledgerData = $this->model_ledger->getLedgerGroupReport($data);
    	        }
    	        else
    	        {
    
    	        	$ledgerData = $this->model_ledger->getLedgerGroupReport($data);
    	        }
                
    	        
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
                                                        <th>Sr No.</th>
                                                        <th>Ledger Name</th>
                                                        <th>Starting Balance</th>
                                                        <th>Current Balance</th>
                                                    </tr>';
        					                        $no = 1;
                                                    $amtdr = $amtcr = $dr = $cr = $op = $cl = 0;
                                                    $entry = array();
                                                    $particular = $link = $ledgerEntries = '';
                                                    
                                                    foreach ($ledgerData as $key => $value) { 
        					                            
        					                            $data = array(
                                                                           'ledger_id' => 7
                                                                        //   'ledger_id' => $value['id']
                                                                      );
                                                          
                                                        $ledgerEntries = $this->model_ledger->fetchGroupLedgerReport($data);
        					                            
        					                            if($value['closing_balance'] !=''){
        					                                
        					                                $html .='<tr>
                                                                          <td>'.$no.'</td>
                                                                          <td>'.$value['ledger_name'].'</td>
                                                                          <td>'.$value['opening_balance'].'</td>
                                                                          <td>'.$value['closing_balance'].'</td>
                                                                      </tr>';
        					                            }
        					                            
                                                    }
                                                    
        					            	$html .='</table>
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
	    else
	    {
		    $this->data['ledgerData'] = '';

			$this->render_template('admin_view/reports/ledgerGroupReport', $this->data);
	    }
	}
    
    public function ledgerReport()
	{
	    
	       $id = $this->uri->segment(3);
	       // echo "GST"; exit;
	       
	       $this->data['ledgerList'] = $this->model_ledger->fecthDataByType();
	       
	       $company_id = $this->session->userdata['wo_company'];
            $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);
        
    	    if($id)
    	    {
    	    	$this->data['id'] = $id;
    	    	// $this->data['ledgerData'] = $this->model_ledger->fecthDataByID($id);
    	    	// $this->data['journalData'] = $this->model_journalentry->fecthDataByLedgerID($id);
    
            	$ledger = $this->model_ledger->fecthDataByID($id);
    
            	$this->data['ledger'] = $ledger;
            	$this->data['ledgerEntries'] = $this->model_globalsearch->fetchledgerEntriesByLedgerID($ledger['id']);
    	    }
    	    else
    	    {
    	    	if((empty($_POST['from'])) && (empty($_POST['to'])))
            	{
            		$ledger = $this->model_ledger->fecthAllDatabyName($_POST['id']);
            		// $data = $this->model_globalsearch->fetchLedgerData($_POST['ledger']);
            		// echo "<pre>"; print_r($ledgerData);exit();
    
            		$this->data['ledger'] = $ledger;
            		$this->data['ledgerEntries'] = $this->model_globalsearch->fetchledgerEntriesByLedgerID($ledger['id']);
            		// echo "<pre>"; print_r($ledgerEntries);
            	}
            	else
            	{
            		// echo "Name and DAte beetween";
            		$ledger = $this->model_ledger->fecthAllDatabyName($_POST['id']);
    
            		$this->data['ledger'] = $ledger;
    
            		$data = array(
    	        					'ledger_id' => $ledger['id'],
    	        					'from' => $_POST['from'],
    	        					'to' => $_POST['to']
            					);
            		$this->data['ledgerEntries'] = $this->model_globalsearch->fetchledgerBetweenTwoDate($data);
            	}
    	    }
    	    
    		$this->render_template('admin_view/master/ledger/ledgerReport', $this->data);  
	   // }
	    
	   // if(!empty($id))
	   // {
	   //    // exit;
    	      
	   // }
	   // else
	   // {
	   //     $this->data['ledgerList'] = $this->model_ledger->fecthDataByType();
	        
	   //     $this->render_template('admin_view/master/ledger/ledgerReportBlank', $this->data);    
	   // }
	    
	}

    public function ledgerGroupReportSearch()
    {
        $id = $this->uri->segment(3);
        // echo $id;
        $data = array(
                        'ledger_id' => $id
                    );

        $this->data['ledgerList'] = $this->model_ledger->fecthAllData();
        
        $this->data['ledger'] = $this->model_ledger->fecthDataByID($id);

        $this->data['ledgerEntries'] = $this->model_globalsearch->fetchLedgerEntries($data);
        // echo "<pre>"; print_r($ledger); exit();

        $this->render_template('admin_view/master/ledger/ledgerReport', $this->data);                

    }
	
	public function ledgerReportSearch()
	{
	    $this->form_validation->set_rules('id', 'Ledger Name', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
            
            // echo "<pre>"; print_r($_POST); exit;
            
            if(isset($_POST['search']))
            {

                $company_id = $this->session->userdata['wo_company'];
                $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);
                
                $ledger = $this->model_ledger->fecthAllDatabyName($_POST['id']);
                
                // echo "<pre>"; print_r($ledger); exit();
        		$this->data['ledger'] = $ledger;
                $this->data['ledgerList'] = $this->model_ledger->fecthAllData();

                if(!empty($_POST['from']) && !empty($_POST['to']))
                {
                    $data = array(
                                    'ledger_id' => $ledger['id'],
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to']
                                );                    
                    
                    $this->data['ledgerEntries'] = $this->model_globalsearch->fetchLedgerEntriesBetweenDate($data);
                }
                else
                {
                    $data = array(
                                    'ledger_id' => $ledger['id']
                                );
                    // echo "<pre>"; print_r($data); exit();
                    $this->data['ledgerEntries'] = $this->model_globalsearch->fetchLedgerEntries($data);
                }

                // echo "<pre>"; print_r($ledgerEntries); exit;
                $this->render_template('admin_view/master/ledger/ledgerReport', $this->data);                
            }
            else if(isset($_POST['print']))
            {
                $company_id = $this->session->userdata['wo_company'];
                $companyDetails = $this->model_company->fecthDataByID($company_id);
                $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
                
                $ledger = $this->model_ledger->fecthAllDatabyName($_POST['id']);
                
          //       $data = array(
          //   					'ledger_id' => $ledger['id'],
          //   					'from' => $_POST['from'],
          //   					'to' => $_POST['to']
        		// 			);
        		
        		// $ledgerEntries = $this->model_globalsearch->fetchledgerBetweenTwoDate($data);

                if(!empty($_POST['from']) && !empty($_POST['to']))
                {
                    $data = array(
                                    'ledger_id' => $ledger['id'],
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to']
                                );                    
                    
                    $ledgerEntries = $this->model_globalsearch->fetchLedgerEntriesBetweenDate($data);
                }
                else
                {
                    $data = array(
                                    'ledger_id' => $ledger['id']
                                );
                    // echo "<pre>"; print_r($data); exit();
                    $ledgerEntries = $this->model_globalsearch->fetchLedgerEntries($data);
                }
                
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
            					                                    <h5><b> Purchase Return Invoice </b></h5>
            					                                </center>
            					                            </td>
            					                        </tr>
            					                        <tr>
                                                            <td>
                                                                <center>
                                                                    <h5><b> Ledger Report of '.ucwords($ledger['ledger_name']).' </b></h5>
                                                                </center>
                                                            </td>
                                                        </tr>
            					                       <tr> 
                                                            <td>
                                                                <table width="95%" align="center" style="margin-top:20px;">
                                                                    <tr>
                                                                        <th class="myBorder">&nbsp; Date</th>
                                                                        <th class="myBorder">&nbsp; Particulars</th>
                                                                        <td class="myBorder">&nbsp; Debit</td>
                                                                        <th class="myBorder">&nbsp; Credit</th>
                                                                        <th class="myBorder">&nbsp; Balance</th>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td class="myBorder">&nbsp; '.date('d-m-Y', strtotime($ledger['created_date'])).'</td>
                                                                      <td class="myBorder">&nbsp; Opening Balance </td>
                                                                      <td class="myBorder">&nbsp;'."-".'</td>
                                                                      <td class="myBorder">&nbsp; '."-".'</td>
                                                                      <td class="myBorder">&nbsp; '.number_format($ledgerEntries['0']['opening_bal'], 2).'</td>
                                                                    </tr>';
                                                                    
                                                                    

                                                                    $amtdr = $amtcr = $dr = $cr = $opbal = $clbal = $totdr = $totcr = 0; 
                                                                    $particular = '';

                                                                    foreach ($ledgerEntries as $key => $value) { 

                                                                        $particular = $value['purchase_type'];

                                                                        $dr = $value['dr_cr'] == 'DR' ? $value['amt'] : "-";
                                                                        $cr = $value['dr_cr'] == 'CR' ? $value['amt'] : "-";

                                                                        $totdr = $totdr + $dr;
                                                                        $totcr = $totcr + $cr;

                                                                        $opbal = $value['opening_bal'] != '0' ? $value['opening_bal'] : "-";
                                                                        $clbal = $value['closing_bal'] != '0' ? $value['closing_bal'] : "-";

                                                                        $html .= '<tr>
                                                                                    <td class="myBorder">&nbsp; '.date('d-m-Y', strtotime($entry['created_date'])).'</td>
                                                                                    <td class="myBorder">&nbsp; '.$particular.'
                                                                                        <a href="'.base_url().$link.$entry['id'].'">'.$entry['id'].'</a>
                                                                                    </td>
                                                                                  
                                                                                    <td class="myBorder">&nbsp; '.number_format($dr, 2).'</td>
                                                                                    <td class="myBorder">&nbsp; '.number_format($cr, 2).'</td>
                                                                                  <td class="myBorder">&nbsp; '.number_format($clbal, 2).'</td>
                                                                                </tr>';
                                                                    }

                                                                    $html .= '<tr>
                                                                                  <td class="myBorder">&nbsp; <b>Total</b></td>
                                                                                  <td class="myBorder">&nbsp; </td>
                                                                                  <td class="myBorder">&nbsp; '.number_format($totdr, 2).'</td>
                                                                                  <td class="myBorder">&nbsp; '.number_format($totcr, 2).'</td>
                                                                                  <td class="myBorder">&nbsp; </td>
                                                                                </tr>';

                                                                    $html .= '
                                                                </table>
                                                            </td>
                                                        </tr>
            					                     
            					                       
            					            		</table>
                                                    <br>
                                                    <div align="right">
                                                        <span>Opening Balance:- <b>'.number_format($ledgerEntries[0]['opening_bal'], 2).'</b></span><br>
                                                        <span>Closing Balance:- <b>'.number_format($clbal, 2).'</b></span><br>
                                                    </div>
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
        else
        {
            $this->data['ledgerList'] = $this->model_ledger->fecthAllData();

            $this->render_template('admin_view/master/ledger/ledgerReportBlank', $this->data);    
        }
	}

	public function purchaseReturn()
    {
        $id = $this->uri->segment(3);
        $type = $this->uri->segment(4);
        // echo $id; echo " "; echo $type;

        $data = array(
        				'inventory_id' => $id,
        				'inventory_type' => 'preturn'
        			);

        $company_id = $this->session->userdata['wo_company'];
        $companyDetails = $this->model_company->fecthDataByID($company_id);

        $invoiceData = $this->model_purchasereturn->fecthAllDatabyID($id);
        $itemData = $this->model_purchasereturn->fecthItemDatabyID($data);

        $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
		$salesType = $this->model_ledger->fecthDataByID($invoiceData['salestype_id']);
		$accountData = $this->model_ledger->fecthDataByID($invoiceData['account_id']);

        $paymentType = $this->model_paymentmaster->fecthDataByID($invoiceData['paymenttype_id']);
        // echo "<pre>"; print_r($itemData);

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
					                                    <h5><b> Purchase Return Invoice </b></h5>
					                                </center>
					                            </td>
					                        </tr>
					                        <tr>
                            					<td>
                            						<div class="col-md-12">
					                                    <table width="100%">
                                                            <tr>
    					                                        <td width="60%">
    					                                          <b>Bill No :-</b> '.$invoiceData['order_no'].'
    					                                        </td>
                                                                <td>
                                                                    <b>Sales Type :-</b> '.$salesType['ledger_name'].'
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <b>Bill Date :-</b> '.date("d-m-Y", strtotime($invoiceData['date'])).'
                                                                </td>
                                                                <td>
                                                                    <b>Salesman Code :- </b>&nbsp;
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>
                                                                    <b>Shipping Type :-</b> '.$invoiceData['shipping_type'].'
                                                                    <br>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>
                                                                    <b>Courier No :-</b> &nbsp;
                                                                </td>
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
					                                <div class="col-md-12">
					                                    <table width="100%">
					                                      <tr>
					                                        <td width="60%">
					                                          <b>Name :-</b> '.$accountData['ledger_name'].'
					                                        </td>
					                                        <td>
                                                                <b>Payment Type :-</b> '.$paymentType['payment_name'].'
                                                            </td>
					                                      </tr>
					                                      <tr>
					                                        <td><b>Address :-</b> '.$accountData['address_1'].'</td>
					                                        <td>
                                                              <b>Payment Details :-</b>
                                                            </td>
					                                      </tr>
					                                      <tr>
					                                        <td width="100px">
					                                          <b>GST No :-</b> '.$accountData['gst'].'
					                                        </td>
					                                        <td>
                                                              <b>Shipping Address :-</b>
                                                            </td>
					                                      </tr>
					                                      <tr>
					                                        <td><b>Sale Memo :-</b></td>
					                                        <td><b>Sale Order No :-</b></td>
					                                      </tr>
					                                    </table>
					                                </div>
					                            </td>
					                        </tr>
                                        </table>
                                        <table align="center" width="100%">
					                        <tr>
					                            <th style="width: 10px;" class="myBorder">&nbsp; Sr No.</th>
		                                        <th style="width: 150px;" class="myBorder">&nbsp; SKU</th>
		                                        <th style="width: 30px;" class="myBorder">&nbsp; HSN</th>
		                                        <td style="width: 10px;" class="myBorder">&nbsp; QTY</td>
		                                        <th style="width: 80px;" class="myBorder">&nbsp; Base Price</th>
		                                        <th style="width: 20px;" class="myBorder">&nbsp; DISC.(%)</th>
		                                        <th style="width: 60px;" class="myBorder">&nbsp; SGST</th>
		                                        <th style="width: 60px;" class="myBorder">&nbsp; CGST</th>
		                                        <th style="width: 60px;" class="myBorder">&nbsp; IGST</th>
		                                        <th style="width: 80px;"  class="myBorder">&nbsp; GST Amt.</th>
		                                        <th style="width: 100px;"  class="myBorder">&nbsp; Gross Amt.</th>
		                                    </tr>
                                        ';

                                        $qty=$subtotal=$discount=$tsgst=$tcgst=$tigst=0; $no=1;

                                        foreach($itemData as $rows)
                                        {
                                            $productData = $this->model_sku->fecthSkuDataByID($rows['sku']);
                                            // echo "<pre>"; print_r($rows);
                                            $barcodeData = $this->model_barcode->fetchDataBySkuCode1($rows['sku']);

                                            $hsnData = $this->model_hsn->fecthAllDataById($barcodeData['hsn']);

                                            $discountData = $this->model_discount->fecthDataByID($rows['discount']);

                                            $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);
                                            // echo "<pre>"; print_r($rows);
                                            $sgst = ($rows['grossprice'] * $gstData['sgst']) / 100;
                                            $cgst = ($rows['grossprice'] * $gstData['cgst']) / 100;

                                            $igst = ($rows['grossprice'] * $gstData['igst']) / 100;

                                            $qty = $qty + $rows['qty'];
                                            $subtotal = $subtotal + $rows['grossprice'];
                                            $discount = $discount + $rows['disvalue'];
                                            $tsgst = $tsgst + $sgst;
                                            $tcgst = $tcgst + $cgst;
                                            $tigst = $tigst + $igst;


                                            $html.='
                                                        <tr>
                                                            <td class="myBorder">&nbsp; '.$no.'</td>
                                                            <td class="myBorder">&nbsp; '.$productData['product_code'].'</td>
                                                            <td class="myBorder">&nbsp; '.$hsnData['hsn_code'].'</td>
                                                            <td class="myBorder">&nbsp; '.number_format($rows['qty'], 2).'</td>
                                                            <td class="myBorder">&nbsp; '.number_format($rows['grossprice'], 2).'</td>
                                                            <td class="myBorder">&nbsp; '.($rows['disvalue'] != '' ? $rows['disvalue']." ".($discountData['discount']) : "0").'</td>

                                                            <td class="myBorder">&nbsp; '.($rows['gst'] != '' ? number_format($sgst, 2)."<br>&nbsp; (".$gstData['sgst'].")" : "0").'</td>

                                                            <td class="myBorder">&nbsp; '.($rows['gst'] != '' ? number_format($cgst, 2)."<br>&nbsp; (".$gstData['cgst'].")" : "0").'</td>

                                                            <td class="myBorder">&nbsp; '.($rows['gst'] != '' ? number_format($igst, 2)."<br>&nbsp; (".$gstData['cgst'].")" : "0").'</td>

                                                            <td class="myBorder">&nbsp; '.number_format($rows['gstamt'], 2).'</td>

                                                            <td class="myBorder">&nbsp; '.$rows['grossprice'].'</td>
                                                        </tr>';
                                                $no++;
                                        }
					                       
					            		$html .= '<tr>
                                                        <td class="myBorder" colspan="2">&nbsp;</td>
                                                        <td class="myBorder">&nbsp; Total</td>
                                                        <td class="myBorder">&nbsp; '.number_format($qty,2).'</td>
                                                        <td class="myBorder" colspan="5">&nbsp;</td>
                                                        <td class="myBorder"><b>&nbsp; Subtotal:-</b></td>
                                                        <td class="myBorder"><b>&nbsp; '.number_format($subtotal, 2).'</b></td>
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
                                                                          <td>Tender Change<br>&nbsp;</td>
                                                                      </tr>
                                                                </table>
                                                            </td>
                                                            <td class="myBorder" width="100px">
                                                                <table width="100%" border="1">
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($discount, 2).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($tsgst, 2).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($tcgst, 2).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($tigst, 2).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($invoiceData['adjustment'], 2).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">'.number_format($discount, 2).'</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <td style="text-align: right; padding-right: 5px">0 <br>&nbsp;</td>
                                                                  </tr>
                                                                  
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                          <td class="myBorder" colspan="9">
                                                            <div class="pl15">
                                                              <p><b>IN WORDS : '.$this->number_to_word->convert_number($invoiceData['total_invoicevalue']).'</b> </p>
                                                            </div>
                                                          </td>
                                                          <td class="myBorder">
                                                            <div class="pl15"><b>Grand Total</b></div>
                                                          </td>
                                                          <td class="myBorder" style="text-align: right; padding-right: 5px">'.$invoiceData['total_invoicevalue'].'</td>
                                                        </tr>
                                                    </table>
                                                    <tr>
                                                <td class="myBorder">
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

		// $this->render_template('admin_view/purchase/purchaseReturn/report', $this->data);
    }

    public function orderReport()
    {
        $company_id = $this->session->userdata['wo_company'];
        $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);

        $this->form_validation->set_rules('from', 'Ptoduct Sub Category', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); //exit();

            $data = array(
                            'from' => $_POST['from'],
                            'to' => $_POST['to'],
                            'ledger_id' => $_POST['customer'],
                            'status' => $_POST['status']
                        );
            // echo "<pre>"; print_r($data); //exit();

            if($_POST['search'])
            {
                if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['customer'] == '0' && $_POST['status'] == '0')
                {
                    // echo "Committed Date";
                    $this->data['salesOrder'] = $this->model_salesorder->fecthDateByCommitedDate($data);
                    // echo "<pre>"; print_r($salesOrder); exit();

                    $this->data['customer'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
                    $this->render_template('admin_view/reports/orderreport', $this->data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['customer'] != '0' && $_POST['status'] == '0')
                {
                    // echo "Committed Date and Customer";
                    $this->data['salesOrder'] = $this->model_salesorder->fecthDateByCommitedDateCustomer($data);
                    // echo "<pre>"; print_r($salesOrder); exit();
                    
                    $this->data['customer'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
                    $this->render_template('admin_view/reports/orderreport', $this->data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['customer'] == '0' && $_POST['status'] != '0')
                {
                    // echo "Committed Date and Status";
                    $this->data['salesOrder'] = $this->model_salesorder->fecthDateByCommitedDateStatus($data);
                    // echo "<pre>"; print_r($salesOrder); exit();
                        
                    $this->data['customer'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
                    $this->render_template('admin_view/reports/orderreport', $this->data);  
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['customer'] != '0' && $_POST['status'] != '0')
                {
                    // echo "Committed Date, Customer and Status";
                    $this->data['salesOrder'] = $this->model_salesorder->fecthDateByCommitedDateCustStatus($data);
                    // echo "<pre>"; print_r($salesOrder); exit();
                    
                    $this->data['customer'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
                    $this->render_template('admin_view/reports/orderreport', $this->data);
                }                
            }
            else if($_POST['print'])
            {
                if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['customer'] == '0' && $_POST['status'] == '0')
                {
                    // echo "Committed Date";
                    $salesOrder = $this->model_salesorder->fecthDateByCommitedDate($data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['customer'] != '0' && $_POST['status'] == '0')
                {
                    // echo "Committed Date and Customer";
                    $salesOrder = $this->model_salesorder->fecthDateByCommitedDateCustomer($data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['customer'] == '0' && $_POST['status'] != '0')
                {
                    // echo "Committed Date and Status";
                    $salesOrder = $this->model_salesorder->fecthDateByCommitedDateStatus($data);  
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['customer'] != '0' && $_POST['status'] != '0')
                {
                    // echo "Committed Date, Customer and Status";
                    $salesOrder = $this->model_salesorder->fecthDateByCommitedDateCustStatus($data);
                }  


                $company_id = $this->session->userdata['wo_company'];
                $companyDetails = $this->model_company->fecthDataByID($company_id);

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
                                                                        <h5><b> Production Reports </b></h5>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    <table width="100%" align="center">
                                                                        <tr>
                                                                            <th class="myBorder">&nbsp; Order Date</th>
                                                                            <th class="myBorder">&nbsp; Order Number</th>
                                                                            <th class="myBorder">&nbsp; Exp. Completion Date</th>
                                                                            <th class="myBorder">&nbsp; Commited Date</th>
                                                                            <th class="myBorder">&nbsp; Customer Name</th>
                                                                            <th class="myBorder">&nbsp; Amount</th>
                                                                            <th class="myBorder">&nbsp; Status</th>
                                                                            <th class="myBorder">&nbsp; Action</th>
                                                                        </tr>';

                                                                    foreach ($salesOrder as $key => $value)
                                                                    {
                                                                        $customer = $this->model_ledger->fecthAllDatabyID($value['account_id']);

                                                                        $html .= '<tr>
                                                                            <td class="myBorder">&nbsp; '.date('d-m-Y', strtotime($value['created_date'])).'</td>
                                                                            <td class="myBorder">&nbsp; '.$value['order_no'].'</td>
                                                                            <td class="myBorder">&nbsp; '.date('d-m-Y', strtotime($value['expected_date'])).'</td>
                                                                            <td class="myBorder">&nbsp; '.date('d-m-Y', strtotime($value['completed_date'])).'</td>
                                                                            <td class="myBorder">&nbsp; '.$customer['ledger_name'].'</td>
                                                                            <td class="myBorder">&nbsp; '.$value['estimated_total'].'</td>
                                                                            <td class="myBorder">&nbsp; '.$value['order_status'].'</td>
                                                                            <td class="myBorder">&nbsp; 
                                                                                <a href="'.base_url().'sales_order/addQty/'.$value['id'].'"><i class="fa fa-edit"></i>Edit</a>
                                                                                <a href="'.base_url().'sales_order/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');"><i class="fa fa-trash"></i>Delete</a>
                                                                                <a href="'.base_url().'sales_order/salesOrderReport/'.$value['id'].'"><i class="fa fa-eye"></i>Print</a>
                                                                            </td>
                                                                        </tr>';
                                                                    }
                                                                        
                                                                $html.='
                                                                        <tr>
                                                                            <td colspan="10">
                                                                                <br>
                                                                                &nbsp;
                                                                                <span><b>* This is a Computer Generated Document hence no Signature is Required</b></span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
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

        }else
        {
            
            $this->data['customer'] = $this->model_ledger->fetchLedgerDataByLedgertype(5);
            // echo "<pre>"; print_r($customer); exit();
            $this->render_template('admin_view/reports/orderreport', $this->data);
        }
    }

    public function productionReport()
    {
        $company_id = $this->session->userdata['wo_company'];
        $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);

        $this->form_validation->set_rules('from', 'Ptoduct Sub Category', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST); //exit();

            $data = array(
                            'from' => $_POST['from'],
                            'to' => $_POST['to'],
                            'subcategory_id' => $_POST['subcategory'],
                            'ledger_id' => $_POST['employee'],
                            'status' => $_POST['status']
                        );

            if($_POST['search'])
            {
                if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] == '0' && $_POST['employee'] == '0' && $_POST['status'] == '0')
                {
                    $this->data['production'] = $this->model_production->fecthDateByJobsheetDate($data);
                    // $production = $this->model_production->fecthDateByJobsheetDate($data);
                    // echo "<pre>"; print_r($production); exit();
                    $this->data['employee'] = $this->model_ledger->fetchEmployee();
                    $this->data['subcat'] = $this->model_category->fecthAllSubCatData();
                    
                    $this->render_template('admin_view/reports/productionreport', $this->data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] != '0' && $_POST['employee'] == '0' && $_POST['status'] == '0')
                {
                    // echo "Sub Cat wise"; exit();
                    $this->data['production'] = $this->model_production->fecthDateByJobsheetDateSubcat($data);
                    // echo "<pre>"; print_r($production);
                    $this->data['employee'] = $this->model_ledger->fetchEmployee();
                    $this->data['subcat'] = $this->model_category->fecthAllSubCatData();
                    
                    $this->render_template('admin_view/reports/productionreport', $this->data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] == '0' && $_POST['employee'] != '0' && $_POST['status'] == '0')
                {
                    // echo "Employee wise"; exit();
                    $this->data['production'] = $this->model_production->fecthDateByJobsheetDateEmp($data);
                    // echo "<pre>"; print_r($production);
                    $this->data['employee'] = $this->model_ledger->fetchEmployee();
                    $this->data['subcat'] = $this->model_category->fecthAllSubCatData();
                    
                    $this->render_template('admin_view/reports/productionreport', $this->data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] == '0' && $_POST['employee'] == '0' && $_POST['status'] != '0')
                {
                    // echo "status wise";
                    $this->data['production'] = $this->model_production->fecthDateByJobsheetDateStatus($data);
                    // echo "<pre>"; print_r($production);
                    $this->data['employee'] = $this->model_ledger->fetchEmployee();
                    $this->data['subcat'] = $this->model_category->fecthAllSubCatData();
                    
                    $this->render_template('admin_view/reports/productionreport', $this->data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] != '0' && $_POST['employee'] != '0' && $_POST['status'] == '0')
                {
                    // echo "subcategory and employee wise";
                    $this->data['production'] = $this->model_production->fecthDateByJobsheetDateSubEmp($data);
                    // echo "<pre>"; print_r($production); exit();
                    $this->data['employee'] = $this->model_ledger->fetchEmployee();
                    $this->data['subcat'] = $this->model_category->fecthAllSubCatData();
                    
                    $this->render_template('admin_view/reports/productionreport', $this->data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] == '0' && $_POST['employee'] != '0' && $_POST['status'] != '0')
                {
                    // echo "status and employee wise";
                    $this->data['production'] = $this->model_production->fecthDateByJobsheetDateEmpStatus($data);
                    // echo "<pre>"; print_r($production); exit();
                    $this->data['employee'] = $this->model_ledger->fetchEmployee();
                    $this->data['subcat'] = $this->model_category->fecthAllSubCatData();
                    
                    $this->render_template('admin_view/reports/productionreport', $this->data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] != '0' && $_POST['employee'] == '0' && $_POST['status'] != '0')
                {
                    // echo "status and subcategory wise";

                    $this->data['production'] = $this->model_production->fecthDateByJobsheetDateSubStatus($data);
                    // echo "<pre>"; print_r($production); exit();
                    $this->data['employee'] = $this->model_ledger->fetchEmployee();
                    $this->data['subcat'] = $this->model_category->fecthAllSubCatData();
                    
                    $this->render_template('admin_view/reports/productionreport', $this->data);
                }
                // else
                // {
                //     echo "all";
                // }
            }
            else if($_POST['print'])
            {
                if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] == '0' && $_POST['employee'] == '0' && $_POST['status'] == '0')
                {
                    $production = $this->model_production->fecthDateByJobsheetDate($data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] != '0' && $_POST['employee'] == '0' && $_POST['status'] == '0')
                {
                    // echo "Sub Cat wise"; exit();
                    $production = $this->model_production->fecthDateByJobsheetDateSubcat($data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] == '0' && $_POST['employee'] != '0' && $_POST['status'] == '0')
                {
                    // echo "Employee wise"; exit();
                    $production = $this->model_production->fecthDateByJobsheetDateEmp($data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] == '0' && $_POST['employee'] == '0' && $_POST['status'] != '0')
                {
                    // echo "status wise";
                    $production = $this->model_production->fecthDateByJobsheetDateStatus($data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] != '0' && $_POST['employee'] != '0' && $_POST['status'] == '0')
                {
                    // echo "subcategory and employee wise";
                    $production = $this->model_production->fecthDateByJobsheetDateSubEmp($data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] == '0' && $_POST['employee'] != '0' && $_POST['status'] != '0')
                {
                    // echo "status and employee wise";
                    $production = $this->model_production->fecthDateByJobsheetDateEmpStatus($data);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['subcategory'] != '0' && $_POST['employee'] == '0' && $_POST['status'] != '0')
                {
                    // echo "status and subcategory wise";
                    $production = $this->model_production->fecthDateByJobsheetDateSubStatus($data);
                }

                $company_id = $this->session->userdata['wo_company'];
                $companyDetails = $this->model_company->fecthDataByID($company_id);

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
                                                                <h5><b> Production Reports </b></h5>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>
                                                            <table width="100%" align="center">
                                                                <tr>
                                                                    <th class="myBorder">&nbsp; Delivery Date</th>
                                                                    <th class="myBorder">&nbsp; Job No</th>
                                                                    <th class="myBorder">&nbsp; SKU</th>
                                                                    <th class="myBorder">&nbsp; Order Number</th>
                                                                    <th class="myBorder">&nbsp; Sub-Category</th>
                                                                    <th class="myBorder">&nbsp; Customer</th>
                                                                    <th class="myBorder">&nbsp; Assigned Work</th>
                                                                    <th class="myBorder">&nbsp; Quantity</th>
                                                                    <th class="myBorder">&nbsp; Amount</th>
                                                                    <th class="myBorder">&nbsp; Status</th>
                                                                    <th class="myBorder">&nbsp; Action</th>
                                                                </tr>';

                                                            foreach ($production as $key => $value)
                                                            {
                                                                $skuData = $this->model_sku->fecthSkuDataByID($value['sku']);
                                                                // echo $value['salesorder_id'];
                                                                // $salesOrder = $this->model_salesorder->fecthAllDatabyID($value['salesorder_id']);
                                                                $subcat = $this->model_category->fecthSubCatDataByID($value['p_scate']);
                                                                $customer = $this->model_ledger->fecthAllDatabyID($value['customer']);
                                                                $worker = $this->model_ledger->fecthAllDatabyID($value['assign_work']);


                                                                $html .= '<tr>
                                                                    <td class="myBorder">&nbsp; '.$value['delivery_date'].'</td>
                                                                    <td class="myBorder">&nbsp; '.$value['jobsheet_no'].'</td>
                                                                    <td class="myBorder">&nbsp; '.$skuData['product_code'].'</td>
                                                                    <td class="myBorder">&nbsp; '.$value['salesorder_id'].'</td>
                                                                    <td class="myBorder">&nbsp; '.$subcat['subcategory_name'].'</td>
                                                                    <td class="myBorder">&nbsp; '.$customer['ledger_name'].'</td>
                                                                    <td class="myBorder">&nbsp; '.$worker['ledger_name'].'</td>
                                                                    <td class="myBorder">&nbsp; '.$value['quantity'].'</td>
                                                                    <td class="myBorder">&nbsp; '.$value['pcost_unit'].'</td>
                                                                    <td class="myBorder">&nbsp; '.$value['status'].'</td>
                                                                    <td class="myBorder">&nbsp; 
                                                                        <a href="'.base_url().'production/update/'.$value['id'].'"><i class="fa fa-edit"></i></a>
                                                                        <a href="'.base_url().'production/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" ><i class="fa fa-trash"></i></a>
                                                                        <a href="'.base_url().'production/printjoboption/'.$value['id'].'>"><i class="fa fa-print"></i></a>
                                                                    </td>
                                                                </tr>';

                                                            }
                                                                
                                                        $html.='
                                                                <tr>
                                                                    <td colspan="10">
                                                                        <br>
                                                                        &nbsp;
                                                                        <span><b>* This is a Computer Generated Document hence no Signature is Required</b></span>
                                                                    </td>
                                                                </tr>
                                                            </table>
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
        else
        {
            $this->data['production'] = $this->model_production->fecthDateByJobsheetData();

            $this->data['employee'] = $this->model_ledger->fetchEmployee();
            $this->data['subcat'] = $this->model_category->fecthAllSubCatData();
            // echo "<pre>"; print_r($employee); exit();
            $this->render_template('admin_view/reports/productionreport', $this->data);
        }
    }
	
	public function cashAccount()
	{
		$this->render_template('admin_view/reports/cashAccount', $this->data);
	}
	
	public function purchaseReport()
	{
		$company_id = $this->session->userdata['wo_company'];
        $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);

        $this->form_validation->set_rules('purchase', 'Purchase Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

        	if(isset($_POST['search']))
        	{
                // echo "<pre>"; print_r($_POST); exit();

                if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['purchase'] == '0' && $_POST['type'] == 0 && $_POST['ledger'] == 0 )
                {
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to']
                                );
                    $pinvoice = $this->model_purchaseinvoice->pinvoiceReportDateWise($data);
                    $pvoucher = $this->model_purchasevoucher->pvoucherReportDateWise($data);
                    $preturn = $this->model_purchasereturn->preturnReportDateWise($data);

                    $this->data['result'] = array_merge($pinvoice, $pvoucher, $preturn);
                    $this->data['ledgertype'] = $this->model_ledger->ledgerCatType(4);

                    $this->data['supplier'] = $this->model_ledger->fetchLedgerDataByLedgertype(7);

                    $this->render_template('admin_view/reports/purchaseReport', $this->data);
                }
				else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['purchase'] != '0' && $_POST['type'] == 0 && $_POST['ledger'] == 0 ) 
		        {
                    $result = '';
					$data = array(
		        					'from' => $_POST['from'],
		        					'to' => $_POST['to'],
		        				);

                    if($_POST['purchase'] == 'purchaseInvoice')
                    {
                        $this->data['result'] = $this->model_purchaseinvoice->pinvoiceReportDateWise($data);
                    }
                    else if($_POST['purchase'] == 'purchaseVoucher')
                    {
                        $this->data['result'] = $this->model_purchasevoucher->pvoucherReportDateWise($data);
                    }
                    else if($_POST['purchase'] == 'purchaseReturn')
                    {
                        $this->data['result'] = $this->model_purchasereturn->preturnReportDateWise($data);
                    }

                    // echo "<pre>"; print_r($result); exit();

                    $this->data['ledgertype'] = $this->model_ledger->ledgerCatType(4);
                    $this->data['supplier'] = $this->model_ledger->fetchLedgerDataByLedgertype(7);

                    $this->render_template('admin_view/reports/purchaseReport', $this->data);
		        }
		        else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['purchase'] != '0' && $_POST['type'] != 0 && $_POST['ledger'] == 0 ) 
		        {	
		        	$result = '';
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                    'paccount' => $_POST['type']
                                );

                    // echo "<pre>"; print_r($data); exit();

                    if($_POST['purchase'] == 'purchaseInvoice')
                    {
                        $this->data['result'] = $this->model_purchaseinvoice->pinvoiceReportDateWisePAccount($data);
                    }
                    else if($_POST['purchase'] == 'purchaseVoucher')
                    {
                        $this->data['result'] = $this->model_purchasevoucher->pvoucherReportDateWisePAccount($data);
                    }
                    else if($_POST['purchase'] == 'purchaseReturn')
                    {
                        $this->data['result'] = $this->model_purchasereturn->preturnReportDateWisePAccount($data);
                    }

                    $this->data['ledgertype'] = $this->model_ledger->ledgerCatType(4);
                    $this->data['supplier'] = $this->model_ledger->fetchLedgerDataByLedgertype(7);

                    $this->render_template('admin_view/reports/purchaseReport', $this->data);
		        }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['purchase'] != '0' && $_POST['type'] == 0 && $_POST['ledger'] != 0 ) 
                {   
                    $result = '';
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                    'ledgerid' => $_POST['ledger']
                                );

                    // echo "<pre>"; print_r($data); exit();

                    if($_POST['purchase'] == 'purchaseInvoice')
                    {
                        $this->data['result'] = $this->model_purchaseinvoice->pinvoiceReportDateWiseLedger($data);
                    }
                    else if($_POST['purchase'] == 'purchaseVoucher')
                    {
                        $this->data['result'] = $this->model_purchasevoucher->pvoucherReportDateWiseLedger($data);
                    }
                    else if($_POST['purchase'] == 'purchaseReturn')
                    {
                        $this->data['result'] = $this->model_purchasereturn->preturnReportDateWiseLedger($data);
                    }

                    $this->data['ledgertype'] = $this->model_ledger->ledgerCatType(4);
                    $this->data['supplier'] = $this->model_ledger->fetchLedgerDataByLedgertype(7);

                    $this->render_template('admin_view/reports/purchaseReport', $this->data);
                }
                else
                {
                    $result = '';
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                    'paccount' => $_POST['type'],
                                    'ledgerid' => $_POST['ledger']
                                );

                    // echo "<pre>"; print_r($data); exit();

                    if($_POST['purchase'] == 'purchaseInvoice')
                    {
                        $this->data['result'] = $this->model_purchaseinvoice->pinvoiceReportDateWisePAccountLedger($data);
                    }
                    else if($_POST['purchase'] == 'purchaseVoucher')
                    {
                        $this->data['result'] = $this->model_purchasevoucher->pvoucherReportDateWisePAccountLedger($data);
                    }
                    else if($_POST['purchase'] == 'purchaseReturn')
                    {
                        $this->data['result'] = $this->model_purchasereturn->preturnReportDateWisePAccountLedger($data);
                    }

                    $this->data['ledgertype'] = $this->model_ledger->ledgerCatType(4);
                    $this->data['supplier'] = $this->model_ledger->fetchLedgerDataByLedgertype(7);

                    $this->render_template('admin_view/reports/purchaseReport', $this->data);
                }
        	}
        	else if(isset($_POST['print']))
        	{
                if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['purchase'] == '0' && $_POST['type'] == 0 && $_POST['ledger'] == 0 )
                {
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to']
                                );
                    $pinvoice = $this->model_purchaseinvoice->pinvoiceReportDateWise($data);
                    $pvoucher = $this->model_purchasevoucher->pvoucherReportDateWise($data);
                    $preturn = $this->model_purchasereturn->preturnReportDateWise($data);

                    $result = array_merge($pinvoice, $pvoucher, $preturn);
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['purchase'] != '0' && $_POST['type'] == 0 && $_POST['ledger'] == 0 ) 
                {
                    $result = '';
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                );

                    if($_POST['purchase'] == 'purchaseInvoice')
                    {
                        $result = $this->model_purchaseinvoice->pinvoiceReportDateWise($data);
                    }
                    else if($_POST['purchase'] == 'purchaseVoucher')
                    {
                        $result = $this->model_purchasevoucher->pvoucherReportDateWise($data);
                    }
                    else if($_POST['purchase'] == 'purchaseReturn')
                    {
                        $result = $this->model_purchasereturn->preturnReportDateWise($data);
                    }
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['purchase'] != '0' && $_POST['type'] != 0 && $_POST['ledger'] == 0 ) 
                {   
                    $result = '';
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                    'paccount' => $_POST['type']
                                );

                    if($_POST['purchase'] == 'purchaseInvoice')
                    {
                        $result = $this->model_purchaseinvoice->pinvoiceReportDateWisePAccount($data);
                    }
                    else if($_POST['purchase'] == 'purchaseVoucher')
                    {
                        $result = $this->model_purchasevoucher->pvoucherReportDateWisePAccount($data);
                    }
                    else if($_POST['purchase'] == 'purchaseReturn')
                    {
                        $result = $this->model_purchasereturn->preturnReportDateWisePAccount($data);
                    }
                }
                else if(!empty($_POST['from']) && !empty($_POST['to']) && $_POST['purchase'] != '0' && $_POST['type'] == 0 && $_POST['ledger'] != 0 ) 
                {   
                    $result = '';
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                    'ledgerid' => $_POST['ledger']
                                );

                    // echo "<pre>"; print_r($data); exit();

                    if($_POST['purchase'] == 'purchaseInvoice')
                    {
                        $result = $this->model_purchaseinvoice->pinvoiceReportDateWiseLedger($data);
                    }
                    else if($_POST['purchase'] == 'purchaseVoucher')
                    {
                        $result = $this->model_purchasevoucher->pvoucherReportDateWiseLedger($data);
                    }
                    else if($_POST['purchase'] == 'purchaseReturn')
                    {
                        $result = $this->model_purchasereturn->preturnReportDateWiseLedger($data);
                    }
                }
                else
                {
                    $result = '';
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                    'paccount' => $_POST['type'],
                                    'ledgerid' => $_POST['ledger']
                                );

                    if($_POST['purchase'] == 'purchaseInvoice')
                    {
                        $result = $this->model_purchaseinvoice->pinvoiceReportDateWisePAccountLedger($data);
                    }
                    else if($_POST['purchase'] == 'purchaseVoucher')
                    {
                        $result = $this->model_purchasevoucher->pvoucherReportDateWisePAccountLedger($data);
                    }
                    else if($_POST['purchase'] == 'purchaseReturn')
                    {
                        $result = $this->model_purchasereturn->preturnReportDateWisePAccountLedger($data);
                    }
                }


        		$company_id = $this->session->userdata['wo_company'];
		        $companyDetails = $this->model_company->fecthDataByID($company_id);

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
					                                    <h5><b> Purchase Report </b></h5>
					                                </center>
					                            </td>
					                        </tr>
					                        <tr>
					                            <td>
					                                <table border="1" width="100%">
					                                    <tr>
                                                            <th>&nbsp; Date</th>
                                                            <th>&nbsp; Invoice Number</th>
                                                            <th>&nbsp; Type</th>
                                                            <th>&nbsp; Supplier</th>
                                                            <th>&nbsp; Gross Amount</th>
                                                            <th>&nbsp; GST Amount</th>
                                                            <th>&nbsp; Total Amount</th>
                                                            <th>&nbsp; Due Date</th>
					                                    </tr>';

					                                    $no=1; $type = $link = $duedate = '';
                                                        
                                                        $gprice = $tottax = $adj = $total = $fgprice = $ftax = $fadj = $ftot = $qty = $pinvoiceTotAmt = $supplier = 0;
                                                        
					                                    foreach ($result as $key => $value) { 

					                                    	if($value['type'] == 'pinvoice')
				                                          	{
				                                            	$type = "Purchase Invoice";
                                                                $gprice = $value['gross_amt'] != '' ? $value['gross_amt'] : 0;
                                                                
                                                                $tottax = $value['tot_tax'] != '' ? $value['tot_tax'] : 0;
                                                                
                                                                $adj = $value['adj'] != '' ? $value['adj'] : 0;
                                                                
                                                                $total = $value['tot_invoice'] != '' ? $value['tot_invoice'] : 0;

                                                                $fgprice = $fgprice + $gprice;
                                                                $ftax = $ftax + $tottax;
                                                                $fadj = $fadj + $adj;
                                                                $ftot = $ftot + $total;

                                                                $data=array(
                                                                            'order_id' => $value['pid'],
                                                                            'ordertype' => 'pinvoice'
                                                                        );

                                                                $order = $this->model_purchaseitem->sumQty($data);
                                                                  // echo "<pre>"; print_r($qty); //exit();
                                                                $qty = $order['qty'];

                                                                $pinvoiceTotAmt = $gprice + $tottax;

                                                                $duedate = $value['dueDate'];

                                                                $link = 'purchase_invoice/update/';

                                                                $supplier = $value['account'];

					                                        }
					                                        else if($value['type'] == 'purchase_voucher')
					                                        {
				                                             	$type = "Purchase Voucher";
                                                                
                                                                $gprice = $value['gross_amt'] != '' ? $value['gross_amt'] : 0;
                                            
                                                                $tottax = $value['tot_tax'] != '' ? $value['tot_tax'] : 0;
                                            
                                                                $adj = $value['adj'] != '' ? $value['adj'] : 0;
                                                                
                                                                $total = $value['tot_invoice'] != '' ? $value['tot_invoice'] : 0;

                                                                $fgprice = $fgprice + $gprice;
                                                                
                                                                $ftax = $ftax + $tottax;
                                                                
                                                                $fadj = $fadj + $adj;
                                                                
                                                                $ftot = $ftot + $total;

                                                                $data=array(
                                                                            'pvoucher_id' => $value['pid'],
                                                                            'inventory_type' => 'purchase_voucher'
                                                                            );

                                                                $order = $this->model_purchasevoucher->sumQty($data);
                                                                
                                                                // echo "<pre>"; print_r($order); //exit();
                                                                $qty = $order['qty'];

                                                                $pinvoiceTotAmt = $value['tot_invoice'];

                                                                $duedate = $value['dueDate'];

                                                                $link = 'purchase_voucher/update/';

                                                                $supplier = $value['account'];

				                                          	}
				                                          	else if($value['type'] == 'preturn')
				                                          	{
				                                              	$type = "Purchase Return";

                                                                
                                                                $gprice = $value['gross_amt'] != '' ? (- $value['gross_amt']) : 0;
                                                                
                                                                $tottax = $value['tot_tax'] != '' ? (- $value['tot_tax']) : 0;
                                              
                                                                $adj = $value['adj'] != '' ? $value['adj'] : 0;
                                              
                                                                $total = $value['tot_invoice'] != '' ? $value['tot_invoice'] : 0;

                                                                $fgprice = $fgprice + $gprice;
                                                                $ftax = $ftax + $tottax;
                                                                $fadj = $fadj + $adj;
                                                                $ftot = $ftot + $total;

                                                                $data=array(
                                                                            'inventory_id' => $value['pid'],
                                                                            'inventory_type' => 'preturn'
                                                                            );

                                                                $order = $this->model_purchasereturn->sumQty($data);
                                              
                                                                // echo "<pre>"; print_r($order); //exit();
                                                                
                                                                $qty = $order['qty'];

                                                                $pinvoiceTotAmt = (- $value['tot_invoice']);

                                                                $link = 'purchase_return/update/';

                                                                $supplier = $value['account_id'];
				                                          	}

                                                            $supplier = $this->model_ledger->fecthAllDatabyID($supplier);

				                                          	$html .= '<tr>
                                          								<td>&nbsp; '.date('d-m-Y', strtotime($value['date'])).'</td>
                                          								<td>&nbsp; <a href="'.base_url().$link.$value['pid'].'">'.$value['invoiceno'].'</a></td>
                                          								<td>&nbsp;'.$type.'</td>
                                          									<td>&nbsp; '.$supplier['ledger_name'].'</td>
                                          									<td>&nbsp;  <div style="text-align: right; padding-right: 10px;">'.number_format($gprice, 3).'</div></td>
                                          									<td>&nbsp; <div style="text-align: right; padding-right: 10px;">'.number_format($tottax, 3).'</div> </td>
                                          									<td>&nbsp; <div style="text-align: right; padding-right: 10px;">'.number_format($pinvoiceTotAmt != '' ? $pinvoiceTotAmt : '0' , 3).'</div> </td>
                                          									<td>&nbsp; <div style="text-align: right; padding-right: 10px;">'.$duedate.'</div> </td>
                                      									</tr>';

				                                          	$no++;
					                                    }

                                                        $html .= '<tr>
                                                                    <td colspan="3">&nbsp; </td>
                                                                    <td>&nbsp; Total:</td>
                                                                    <td>&nbsp; <div style="text-align: right; padding-right: 10px;">'.number_format($fgprice, 3).'</div> </td>
                                                                    <td>&nbsp; <div style="text-align: right; padding-right: 10px;">'.number_format($ftax, 3).'</div> </td>
                                                                    
                                                                    <td>&nbsp; <div style="text-align: right; padding-right: 10px;">'.number_format($fgprice + $ftax, 3).'</div> </td>
                                                                    
                                                                    <td>&nbsp; </td>
                                                                    
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="9">
                                                                        <br>
                                                                        &nbsp;
                                                                        <span><b>* This is a Computer Generated Document hence no Signature is Required</b></span>
                                                                    </td>
                                                                </tr>';

					                            $html .= '</table>
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
        	else if(isset($_POST['excel']))
        	{
        		echo "excel";
        	}
        }
        else
        {
            $pinvoice = $this->model_purchaseinvoice->pinvoiceReport();
			$pvoucher = $this->model_purchasevoucher->pvoucherReport();
			$preturn = $this->model_purchasereturn->preturnReport();

			$this->data['result'] = array_merge($pinvoice, $pvoucher, $preturn);

			// $result2 = array_merge($twoPurchase, $preturn);

			// echo "Purcher Invoice: <pre>"; print_r($pinvoice);
			// echo "Purchase Voucher: <pre>"; print_r($pvoucher);
			// echo "Purchase Return: <pre>"; print_r($preturn); //exit();
			// echo "Purchase Report: <pre>"; print_r($result0); exit();

            $this->data['ledgertype'] = $this->model_ledger->ledgerCatType(42);

            $this->data['supplier'] = $this->model_ledger->fetchLedgerDataByLedgertype(7);

            // $this->data['result'] = $this->model_purchaseledger->fecthAllData();

            // echo "<pre>"; print_r($type); exit();
			// echo "<pre>"; print_r($result); exit();

            $this->render_template('admin_view/reports/purchaseReport', $this->data);
        }   
	}
	
	public function salesReport()
	{
	    $company_id = $this->session->userdata['wo_company'];
	    $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);
        
	    $company_id = $this->session->userdata['wo_company'];
        $companyDetails = $this->model_company->fecthDataByID($company_id);
        
        $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
        
        $this->form_validation->set_rules('invoice', 'Purchase Name', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            
            if(isset($_POST['search']))
        	{
                // echo "<pre>"; print_r($_POST); exit;
                if($_POST['invoice'] == '0')
                {
                    // echo "<pre>"; print_r($_POST); exit;
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                );
                                
                    $sinvoice = $this->model_salesinvoice->fecthAllDataBetweenDate($data);
        			$sexchange = $this->model_salesexchange->fecthAllDataBetweenDate($data);
        			
                    // echo "Sales Invoice: <pre>"; print_r($sinvoice);
                    // echo "Sales Exchange: <pre>"; print_r($sexchange); exit();
                    
        			$this->data['result'] = array_merge($sinvoice, $sexchange);
        			
        			$this->render_template('admin_view/reports/salesReport', $this->data); 
                }
                else if($_POST['invoice'] == '1')
                {
                    // echo "Invoice Only";
                    
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                );
                                
                    $sinvoice = $this->model_salesinvoice->fecthAllDataBetweenDate($data);
                    // echo "Sales Invoice: <pre>"; print_r($sinvoice); exit;
                    $this->data['result'] = $sinvoice;
                    
                    $this->render_template('admin_view/reports/salesReport', $this->data); 
                }
                else if($_POST['invoice'] == '2')
                {
                    // echo "Exchange Only";
                    
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                );
                                
                    $sexchange = $this->model_salesexchange->fecthAllDataBetweenDate($data);
                    // echo "Sales Invoice: <pre>"; print_r($sinvoice); exit;
                    $this->data['result'] = $sexchange;
                    
                    $this->render_template('admin_view/reports/salesReport', $this->data); 
                }
                else if($_POST['invoice'] == '3')
                {
                    // echo "Exchange Only";
                    
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                );
                                
                    $sexchange = $this->model_wsp->fecthAllDataBetweenDate($data);
                    // echo "Sales Invoice: <pre>"; print_r($sinvoice); exit;
                    $this->data['result'] = $sexchange;
                    
                    $this->render_template('admin_view/reports/salesReport', $this->data); 
                }
        	}
        	else if(isset($_POST['print']))
        	{
        	    $company_id = $this->session->userdata['wo_company'];
                $companyDetails = $this->model_company->fecthDataByID($company_id);
                
                $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
        	    
        	    if($_POST['invoice'] == '0')
                {
                    // echo "<pre>"; print_r($_POST); exit;
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                );
                                
                    $sinvoice = $this->model_salesinvoice->fecthAllDataBetweenDate($data);
        			$sexchange = $this->model_salesexchange->fecthAllDataBetweenDate($data);
                    $wsp = $this->model_wsp->fecthAllDataBetweenDate($data);
        			
                    // echo "Sales Invoice: <pre>"; print_r($sinvoice);
                    // echo "Sales Exchange: <pre>"; print_r($sexchange); exit();
                    
        			$result = array_merge($sinvoice, $sexchange, $wsp);
        			
                    // $this->render_template('admin_view/reports/salesReport', $this->data); 
                }
                else if($_POST['invoice'] == '1')
                {
                    // echo "Invoice Only";
                    
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                );
                                
                    $sinvoice = $this->model_salesinvoice->fecthAllDataBetweenDate($data);
                    // echo "Sales Invoice: <pre>"; print_r($sinvoice); exit;
                    $result = $sinvoice;
                    
                    // $this->render_template('admin_view/reports/salesReport', $this->data); 
                }
                else if($_POST['invoice'] == '2')
                {
                    // echo "Exchange Only";
                    
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                );
                                
                    $sexchange = $this->model_salesexchange->fecthAllDataBetweenDate($data);
                    // echo "Sales Invoice: <pre>"; print_r($sinvoice); exit;
                    $result = $sexchange;
                    
                    // $this->render_template('admin_view/reports/salesReport', $this->data); 
                }
                else if($_POST['invoice'] == '3')
                {
                    // echo "Exchange Only";
                    
                    $data = array(
                                    'from' => $_POST['from'],
                                    'to' => $_POST['to'],
                                );
                                
                    $sexchange = $this->model_wsp->fecthAllDataBetweenDate($data);
                    // echo "Sales Invoice: <pre>"; print_r($sinvoice); exit;
                    $result = $sexchange;
                    
                    // $this->render_template('admin_view/reports/salesReport', $this->data); 
                }
        	    
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
        					                                    <h5><b> Purchase Report </b></h5>
        					                                </center>
        					                            </td>
        					                        </tr>
        					                        <tr>
        					                            <td>
        					                                <table border="1" width="100%">
        					                                    <tr>
                                                                    <th>&nbsp; Date</th>
                                                                    <th>&nbsp; Invoice Number</th>
                                                                    <th>&nbsp; Type</th>
                                                                    <th>&nbsp; Ledger Account</th>
                                                                    <th>&nbsp; Gross Amount</th>
                                                                    <th>&nbsp; GST Amount</th>
                                                                    <th>&nbsp; Total Amount</th>
                                                                    <th>&nbsp; Due Date</th>
                                                                    <th>&nbsp; Balance</th>
                                                                </tr>';
        
        					                                    $gamt = $tax = $adj = $tot = 0; $link=''; $no=1;
                                                                $account = $grossAmt = $balance = 0; 
                                                                    echo "<pre>"; print_r($account);

        					                                    foreach($result as $rows):
        					                                        
        					                                        if(isset($rows['invoice_type']))
                                                                    {
                                                                       if($rows['invoice_type'] == 'salesinvoice')
                                                                        {
                                                                            $invoiceno = $rows['inventory_no'];
                                                                            $noproduct = $rows['no_ofproducts'];
                                                                            $total = $rows['total_invoice'];
                                                                            $type = $rows['invoice_type'];

                                                                            $grossAmt = $rows['gross_total'];

                                                                            $account = $rows['account'];
                                                                            
                                                                            $tot = $tot + $rows['total_invoice'];
                                                                            $link = 'sales_invoice/update/';
                                                                        }
                                                                        else if($rows['invoice_type'] == 'pos')
                                                                        {
                                                                            $invoiceno = $rows['inventory_no'];
                                                                            $noproduct = $rows['no_ofproducts'];
                                                                            $total = $rows['total_invoice'];
                                                                            $type = $rows['invoice_type'];

                                                                            $grossAmt = $rows['gross_total'];

                                                                            $account = $rows['account'];

                                                                            
                                                                            $tot = $tot + $rows['total_invoice'];
                                                                            $link = 'sales_invoice/update/';
                                                                        }
                                                                        else if($rows['invoice_type'] == 'voucher')
                                                                        {
                                                                            $invoiceno = $rows['inventory_no'];
                                                                            $noproduct = $rows['no_ofproducts'];
                                                                            $total = $rows['total_invoice'];
                                                                            $type = $rows['invoice_type'];

                                                                            $account = $rows['account'];

                                                                            $grossAmt = $rows['base_total'];

                                                                            $tot = $tot + $rows['total_invoice'];
                                                                            $link = 'sales_voucher/update/';
                                                                        }
                                                                        else if($rows['invoice_type'] == 'wsp')
                                                                        {
                                                                            $invoiceno = $rows['inventory_no'];
                                                                            $noproduct = $rows['no_ofproducts'];
                                                                            $total = $rows['total_invoice'];
                                                                            $type = $rows['invoice_type'];

                                                                            $account = $rows['account'];

                                                                            $grossAmt = $rows['base_total'];

                                                                            $tot = $tot + $rows['total_invoice'];
                                                                            $link = 'wsp/update/';
                                                                        }
                                                                    }
                                                                    else if(isset($rows['invcentory_type']))
                                                                    {
                                                                        $invoiceno = $rows['exchange_no'];
                                                                        $noproduct = 1;
                                                                        $total = $rows['total_invoicevalue'];
                                                                        $type = $rows['invcentory_type'];

                                                                        $grossAmt = $rows['gross_total'];

                                                                        $account = $rows['account_id'];

                                                                        $tot = $tot + $rows['total_invoicevalue'];
                                                                        $link = 'sales_exchange/update/';
                                                                    }
                                                                    $account = $this->model_ledger->fecthAllDatabyID($account);
                                                                    
                                                                    $gamt = $gamt + $grossAmt;
                                                                    $tax = $tax + $rows['total_tax'];
                                                                    $adj = $adj + $rows['adjustment'];

                                                                    $balance = $balance + $total;
        
        				                                          	$html .= '<tr>
                                                                                <td>&nbsp; '.date('d-m-Y', strtotime($rows['date'])).'</td>
                                                                                <td>&nbsp; <a href="'.base_url().$link.$rows['id'].'">'.$invoiceno.'</a></td>
                                                                                <td>&nbsp; '.$type.'</td>
                                                                                <td>&nbsp; '.$account['ledger_name'].'</td>
                                                                                <td>&nbsp; '.number_format($grossAmt, 3).'</td>
                                                                                <td>&nbsp; '.number_format($rows['total_tax'], 3).'</td>
                                                                                <td>&nbsp; '.number_format($total, 3).'</td>
                                                                                <td>&nbsp; '.($rows['duedate'] != '' ? $rows['duedate'] : "-").'</td>
                                                                                <td>&nbsp; '.number_format($balance, 3).'</td>



                                                                                
                                                                            </tr>';
        				                                            $no++; 
        				                                        endforeach;

                                                                $html .= '<tr>
                                                                            <td colspan="3">&nbsp; </td>
                                                                            <td>&nbsp; Total:</td>
                                                                            <td>&nbsp; <b> '.number_format($gamt, 3).'</b> </td>
                                                                            <td>&nbsp; <b>'. number_format($tax, 3).'</b> </td>
                                                                            <td>&nbsp; <b>'.number_format($tot, 3).'</b> </td>
                                                                            <td>&nbsp; </td>
                                                                            <td>&nbsp; </td>
                                                                        </tr>';
        
                                                            $html .= '</table>
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
        else
        {
            $sinvoice = $this->model_salesinvoice->fecthAllData();

			$sexchange = $this->model_salesexchange->fecthAllData();
            $wsp = $this->model_wsp->fecthAllData();
            
            // $this->data['result'] = array_merge($sinvoice, $sexchange, $wsp);
			$this->data['result'] = array_merge($sinvoice, $sexchange, $wsp);
			
            // echo "<pre>"; print_r($sinvoice); exit();
            // echo "<pre>"; print_r($sexchange);
            // echo "<pre>"; print_r($wsp);
            // echo "<pre>"; print_r($result);
            // exit();
            $this->render_template('admin_view/reports/salesReport', $this->data);   
        }
	}

    public function tradingAc()
    {
        $company_id = $this->session->userdata['wo_company'];
        $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);
        

        $this->form_validation->set_rules('test', 'Trading Account Test', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            $data = array(
                            'from' => $_POST['from'],
                            'to' => $_POST['to']
                        );

            if($_POST['search'])
            {
                if(empty($_POST['from']) && empty($_POST['to']))
                {
                    $salesInvoice = $this->model_salesinvoice->fecthAllSalesData();
                    $salesExchange = $this->model_salesexchange->fecthAllData();

                    $this->data['result'] = array_merge($salesInvoice, $salesExchange);
                    // echo "<pre>"; print_r($result); exit();

                    $this->render_template('admin_view/reports/tradingAc', $this->data);
                }
                else
                {

                    $salesInvoice = $this->model_salesinvoice->fecthAllSalesDataByDate($data);
                    $salesExchange = $this->model_salesexchange->fecthAllDataByDate($data);

                    $this->data['result'] = array_merge($salesInvoice, $salesExchange);

                    $this->render_template('admin_view/reports/tradingAc', $this->data);
                }    
            }
            else if($_POST['print'])
            {
                $company_id = $this->session->userdata['wo_company'];
                $companyDetails = $this->model_company->fecthDataByID($company_id);
                
                $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
                
                if(empty($_POST['from']) && empty($_POST['to']))
                {
                    $salesInvoice = $this->model_salesinvoice->fecthAllSalesData();
                    $salesExchange = $this->model_salesexchange->fecthAllData();

                    $result = array_merge($salesInvoice, $salesExchange);
                    // echo "<pre>"; print_r($result); exit();
                }
                else
                {

                    $salesInvoice = $this->model_salesinvoice->fecthAllSalesDataByDate($data);
                    $salesExchange = $this->model_salesexchange->fecthAllDataByDate($data);

                    $result = array_merge($salesInvoice, $salesExchange);
                }
                
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
                                                                    <h5><b> Purchase Report </b></h5>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table border="1" width="100%">
                                                                    <tr>
                                                                        <th>&nbsp; Invoicing Date</th>
                                                                        <th>&nbsp; Invoicing Number</th>
                                                                        <th>&nbsp; Total Sale Amount</th>
                                                                        <th>&nbsp; Total Purchase Amount</th>
                                                                        <th>&nbsp; Gross Profit/Loss</th>
                                                                    </tr>';
            
                                                                    $invoiceno = $amt = $link = '';
                                                                    $totsale = $totpurchase = $totDiff = 0;

                                                                    foreach ($result as $key => $value) {

                                                                        $salesprice = $pur_netprice = $diff = 0;

                                                                        if(isset($value['invoice_type']))
                                                                        {
                                                                            if($value['invoice_type'] == 'salesinvoice')
                                                                            {
                                                                                $invoiceno = $value['inventory_no'];
                                                                                $amt = $value['total_invoice'];
                                                                                $link = 'sales_invoice/update/';

                                                                                // get purchase price from baecode purchase net price
                                                                                $data = array(
                                                                                            'inventory_id' => $value['id'],
                                                                                            'inventory_type' => $value['invoice_type'],
                                                                                            'sales_exchange' => ''
                                                                                          );

                                                                                $barcodeData = $this->model_salesinvoice->fecthItemDataByIdType($data);

                                                                                // echo "Sales Invoice <pre>"; print_r($barcodeData);

                                                                                foreach ($barcodeData as $key => $barcodevalue) {
                                                                            
                                                                                    $barcode = $this->model_barcode->fetchAllDataByBarcode($barcodevalue['pno']);

                                                                                    $pur_netprice = $pur_netprice + $barcode['pur_netprice'];
                                                                                }

                                                                            }
                                                                            else if($value['invoice_type'] == 'pos')
                                                                            {
                                                                                $invoiceno = $value['inventory_no'];
                                                                                $amt = $value['total_invoice'];
                                                                                $link = 'sales_invoice/update/';

                                                                                // get purchase price from baecode purchase net price
                                                                                $data = array(
                                                                                          'inventory_id' => $value['id'],
                                                                                          'inventory_type' => $value['invoice_type']
                                                                                        );

                                                                                $barcodeData = $this->model_salesinvoice->fecthItemDataByIdType($data);

                                                                                // echo "Sales Invoice/POS <pre>"; print_r($barcodeData);

                                                                                foreach ($barcodeData as $key => $barcodevalue) {
                                                                                    
                                                                                    $barcode = $this->model_barcode->fetchAllDataByBarcode($barcodevalue['pno']);

                                                                                    $pur_netprice = $pur_netprice + $barcode['pur_netprice'];
                                                                                }
                                                                            }
                                                                            else if($value['invoice_type'] == 'voucher')
                                                                            {                                                            
                                                                                $invoiceno = $value['inventory_no'];
                                                                                $amt = $value['total_invoice'];
                                                                                $link = 'sales_voucher/update/';

                                                                                // get purchase price from baecode purchase net price
                                                                                $data = array(
                                                                                          'voucher_id' => $value['id'],
                                                                                          'voucher_type' => $value['invoice_type']
                                                                                        );
                                                                                
                                                                                $barcodeData = $this->model_vouchers->fecthAllDatabyVoucherID($data);

                                                                                // echo "Sales Vouchers <pre>"; print_r($barcodeData);

                                                                                foreach ($barcodeData as $key => $barcodevalue) {
                                                                                    
                                                                                    $pur_netprice = $pur_netprice + $barcodevalue['total'];
                                                                                }

                                                                            }
                                                                            else if($value['invoice_type'] == 'wsp')
                                                                            {
                                                                                $invoiceno = $value['inventory_no'];
                                                                                $amt = $value['total_invoice'];
                                                                                $link = 'wsp/update/';

                                                                                $data = array(
                                                                                          'id' => $value['id'],
                                                                                          'inventory_type' => $value['invoice_type']
                                                                                        );
                                                                                // echo "<pre>"; print_r($data); exit();
                                                                                // get purchase price from baecode purchase net price
                                                                                $barcodeData = $this->model_internalconsumption->fecthItemDataByInventoryID($data);

                                                                                // echo "WSP <pre>"; print_r($barcodeData); 

                                                                                foreach ($barcodeData as $key => $barcodevalue) {
                                                                                    
                                                                                    $barcode = $this->model_barcode->fetchAllDataByBarcode($barcodevalue['pno']);

                                                                                    $pur_netprice = $pur_netprice + $barcode['pur_netprice'];
                                                                                }
                                                                            }
                                                                        }
                                                                        else if(isset($value['invcentory_type']))
                                                                        {
                                                                            $invoiceno = $value['exchange_no'];
                                                                            $amt = $value['total_invoicevalue'];
                                                                            $link = 'sales_exchange/update/';

                                                                            $data = array(
                                                                                          'inventory_id' => $value['id'],
                                                                                          'inventory_type' => $value['invcentory_type']
                                                                                        );

                                                                            $barcodeData = $this->model_salesexchange->fecthAllItemData($data);

                                                                            // echo "Sales Exchange<pre>"; 
                                                                            // echo "Sales Exchange<pre>"; print_r($barcodeData);

                                                                            foreach ($barcodeData as $key => $barcodevalue) {
                                                                                    
                                                                                $barcode = $this->model_barcode->fetchAllDataByBarcode($barcodevalue['pno']);

                                                                                // echo "<pre>"; print_r($barcode);
                                                                                $pur_netprice = $pur_netprice + $barcode['pur_netprice'];
                                                                                // echo $pur_netprice."<br>";
                                                                            }
                                                                        }

                                                                        $diff = $amt - $pur_netprice;

                                                                        $totsale = $totsale + $amt;
                                                                        $totpurchase = $totpurchase + $pur_netprice;

                                                                        $totDiff = $totDiff + $diff;

                                                                        $html .= '<tr>
                                                                                      <td>&nbsp; '.date('d-m-Y', strtotime($value['date'])).'</td>
                                                                                      <td>&nbsp; <a href="'.base_url().$link.$value['id'].'">'.$invoiceno.'</a> </td>
                                                                                      <td>&nbsp;'.$amt.'</td>
                                                                                      <td>&nbsp;'.$pur_netprice.'</td>
                                                                                      <td>&nbsp; '.$diff.'</td>
                                                                                  </tr>';
                                                                    }

                                                                    $html .= '<tr>
                                                                                <td>&nbsp; </td>
                                                                                <td>&nbsp; <b>Total:</b></td>
                                                                                <td>&nbsp; <b>'.$totsale.'</b></td>
                                                                                <td>&nbsp; <b>'.$totpurchase.'</b> </td>
                                                                                <td>&nbsp; <b>'.$totDiff.'</b> </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="9">
                                                                                    <br>
                                                                                    &nbsp;
                                                                                    <span><b>* This is a Computer Generated Document hence no Signature is Required</b></span>
                                                                                </td>
                                                                            </tr>';
            
                                                                $html .= '</table>
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
        else{

            $salesInvoice = $this->model_salesinvoice->fecthAllSalesData();
            $salesExchange = $this->model_salesexchange->fecthAllData();

            $this->data['result'] = array_merge($salesInvoice, $salesExchange);
            // echo "<pre>"; print_r($result); exit();

            $this->render_template('admin_view/reports/tradingAc', $this->data);
        }
    }
	
	public function profileAndLossReport()
	{  
        $company_id = $this->session->userdata['wo_company'];
        $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);
        
		$this->render_template('admin_view/reports/profileAndLossReport', $this->data);
	}
	
	public function consolidatedReport()
	{
	    $company_id = $this->session->userdata['wo_company'];
	    $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);
	    
	    
	    $this->data['location'] = $this->model_location->fecthAllData();
	    $this->data['productCat'] = $this->model_category->fecthAllData();
	    
	    $this->form_validation->set_rules('from', 'From Date', 'trim|required');
	    $this->form_validation->set_rules('to', 'To Date', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            if(isset($_POST['search']))
            {
                // echo "<pre>"; print_r($_POST); exit;
                $this->data['from'] = $_POST['from'];
                $this->data['to'] = $_POST['to'];
                
                $this->render_template('admin_view/reports/inventory/searchConsolidatedReport', $this->data);    
            }
            else
            {
                $company_id = $this->session->userdata['wo_company'];
                $companyDetails = $this->model_company->fecthDataByID($company_id);
                
                $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
                
                $productCat = $this->model_category->fecthAllData();
                
                
                $topTotInwards = $topTotOutwards = $topTotBal = 0;
    
                foreach($productCat as $rows){
                
                    $skuData = $this->model_sku->fecthSkuByCatID($rows->id);
                    
                    
                    $qtytot = $mrptot = $valuetot = $outqtytot = $outmrptot = $outvaluetot = $balqtytot = $balmrptot = $balvaluetot = 0; 
                    
                
                    foreach($skuData as $skurows){  
                        
                        $pinvoiceData = $this->model_purchaseitem->fetchOrderDataBySKUid($skurows->id);
                        // echo "<pre>"; print_r($pinvoiceData);
                        
                        $data = array(
                                        'sku' => $skurows->id,
                                        'from' => $_POST['from'],
                                        'to' => $_POST['to']
                                    );
                        
                        $barcodeInwardData = $this->model_barcode->fetchInwardItemQtyBySkuBetweenDate($data);
                        // echo "<pre>"; print_r($barcodeInwardData);
                        
                        if($pinvoiceData == '')
                        {
                            $opData = $this->model_openingitem->fecthDataBySKUid($skurows->id);
                            $mrp = $opData['mrp'];
                            $value = $barcodeInwardData['qty'] * $mrp;
                            // echo "<pre>"; print_r($opData);    
                        }
                        else
                        {
                            $mrp = $pinvoiceData['mrp_price'];
                            $value = $barcodeInwardData['qty'] * $mrp;
                        }
                        
                        $qtytot = $qtytot + $barcodeInwardData['qty'];
                        $mrptot = $mrptot + $mrp;
                        $valuetot = $valuetot + $value;
                        
                        $topTotInwards = $topTotInwards + $valuetot;
                        
                        // ###########################################
                        // ##             Outward Data              ##
                        // ###########################################
                        
                        $barcodeData = $this->model_barcode->fetchSoldItemQtyBySkuBetweenDate($data);
                        
                        $outQty = $barcodeData['qty'] != '' ? $barcodeData['qty'] : "0";
                        
                        $outvalue = $mrp * $outQty;
                        
                        $outqtytot = $outqtytot + $barcodeData['qty'];
                        $outmrptot = $outmrptot + $mrp;
                        $outvaluetot = $outvaluetot + $outvalue;
                        
                        $topTotOutwards = $topTotOutwards + $outvaluetot;
                        
                        // ###########################################
                        // ##             Closing Balance           ##
                        // ###########################################
                        
                        $balQty = $barcodeInwardData['qty'] - $barcodeData['qty'];
                        
                        if($balQty != '')
                        {
                            $balQty = $balQty;
                        }
                        else
                        {
                            $balQty = 0;
                        }
                        
                        $balvalue = $balQty * $mrp;
                        
                        $balqtytot = $balqtytot + $balQty;
                        $balmrptot = $balmrptot + $mrp;
                        $balvaluetot = $balvaluetot + $balvalue;
                        
                        $topTotBal = $topTotBal + $balvaluetot;   
                    }
                }
	    
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
            					            		<table width="100%" class="topBorder leftBorder bottomBorder rightBorder">
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
            					                            <td class="topBorder">
            					                                <center>
            					                                    <h5><b> Purchase Report </b></h5>
            					                                </center>
            					                            </td>
            					                        </tr>
            					                        <tr>
            					                            <td>
            					                                <table width="100%">
            					                                    <tr>
                                                                        <th class="topBorder rightBorder" style="width: 210px;" rowspan="3">
                                                                            <center>Particular</center>
                                                                        </th>
                                                                        <th class="topBorder rightBorder">
                                                                            <center>InWards</center>
                                                                        </th>
                                                                        <th class="topBorder rightBorder">
                                                                            <center>OutWards</center>
                                                                        </th>
                                                                        <th class="topBorder rightBorder">
                                                                            <center>Closing Balance</center>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="topBorder rightBorder">
                                                                            <center>Total Inwards : '.$topTotInwards.'</center>
                                                                        </td>
                                                                        <td class="topBorder rightBorder">
                                                                            <center>Total OutWards : '.$topTotOutwards.'</center>
                                                                        </td>
                                                                        <td class="topBorder rightBorder">
                                                                            <center>Total Balance : '.$topTotBal.'</center>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <table  width="100%">
                                                                                <tr>
                                                                                    <td class="topBorder rightBorder" style="width: 55px;">
                                                                                        <center>Quantity</center>
                                                                                    </td>
                                                                                    <td class="topBorder rightBorder" style="width: 55px;">
                                                                                        <center>Average Rate</center>
                                                                                    </td>
                                                                                    <td class="topBorder rightBorder" style="width: 55px;">
                                                                                        <center>Value</center>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td>
                                                                            <table width="100%">
                                                                                <tr>
                                                                                    <td class="topBorder rightBorder" style="width: 55px;">
                                                                                        <center>Quantity</center>
                                                                                    </td>
                                                                                    <td class="topBorder rightBorder" style="width: 55px;">
                                                                                        <center>Average Rate</center>
                                                                                    </td>
                                                                                    <td class="topBorder rightBorder" style="width: 55px;">
                                                                                        <center>Value</center>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td>
                                                                            <table width="100%">
                                                                                <tr>
                                                                                    <td class="topBorder rightBorder" style="width: 55px;">
                                                                                        <center>Quantity</center>
                                                                                    </td>
                                                                                    <td class="topBorder rightBorder" style="width: 55px;">
                                                                                        <center>Average Rate</center>
                                                                                    </td>
                                                                                    <td class="topBorder rightBorder" style="width: 55px;">
                                                                                        <center>Value</center>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>';
                                                                    
                                                                    foreach($productCat as $rows){
                                                                        
                                                                        $html .= '<tr style="width: 210px;">
                                                                                        <td class="topBorder rightBorder">
                                                                                            <h5><b><u><center>'.$rows->catgory_name.'</center></u></b></h5>
                                                                                        </td>
                                                                                        <td class="topBorder" colspan="8">&nbsp;</td>
                                                                                    </tr>';
                                                                                    
                                                                                    $subcat = $this->model_category->fecthSubCatByCatID($rows->id);
                                                                                    
                                                                        $html .= '<tr>
                                                                                        <td class="topBorder rightBorder"><h6><b><center>'.$subcat['subcategory_name'].'</center></b></h6></td>
                                                                                        <td class="topBorder" colspan="8">&nbsp;</td>
                                                                                    </tr>';
                                                                                    
                                                                                    $skuData = $this->model_sku->fecthSkuByCatID($rows->id);
                                                                                    
                                                                                    $qtytot = $mrptot = $valuetot = $outqtytot = $outmrptot = $outvaluetot = $balqtytot = $balmrptot = $balvaluetot = 0; 
                                                                                    
                                                                                    foreach($skuData as $skurows){
                                                                                        
                                                                                        $unit = $this->model_unit->fecthUnitDataByID($skurows->unit_id);
                                                                                        
                                                                                        // ###########################################
                                                                                        // ##             Inward Data               ##
                                                                                        // ###########################################                                               
                                                                                        $pinvoiceData = $this->model_purchaseitem->fetchOrderDataBySKUid($skurows->id);
                                                                                        // echo "<pre>"; print_r($pinvoiceData);
                                                                                        
                                                                                        $data = array(
                                                                                                        'sku' => $skurows->id,
                                                                                                        'from' => $_POST['from'],
                                                                                                        'to' => $_POST['to']
                                                                                                    );
                                                                                        
                                                                                        $barcodeInwardData = $this->model_barcode->fetchInwardItemQtyBySkuBetweenDate($data);
                                                                                        // echo "<pre>"; print_r($barcodeInwardData);
                                                                                        
                                                                                        if($pinvoiceData == '')
                                                                                        {
                                                                                            $opData = $this->model_openingitem->fecthDataBySKUid($skurows->id);
                                                                                            $mrp = $opData['mrp'];
                                                                                            $value = $barcodeInwardData['qty'] * $mrp;
                                                                                            // echo "<pre>"; print_r($opData);    
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $mrp = $pinvoiceData['mrp_price'];
                                                                                            $value = $barcodeInwardData['qty'] * $mrp;
                                                                                        }
                                                                                        
                                                                                        $qtytot = $qtytot + $barcodeInwardData['qty'];
                                                                                        $mrptot = $mrptot + $mrp;
                                                                                        $valuetot = $valuetot + $value;
                                                                                        
                                                                                        // ###########################################
                                                                                        // ##             Outward Data              ##
                                                                                        // ###########################################
                                                                                        
                                                                                        $barcodeData = $this->model_barcode->fetchSoldItemQtyBySkuBetweenDate($data);
                                                                                        
                                                                                        $outQty = $barcodeData['qty'] != '' ? $barcodeData['qty'] : "0";
                                                                                        
                                                                                        $outvalue = $mrp * $outQty;
                                                                                        
                                                                                        $outqtytot = $outqtytot + $barcodeData['qty'];
                                                                                        $outmrptot = $outmrptot + $mrp;
                                                                                        $outvaluetot = $outvaluetot + $outvalue;
                                                                                        // echo "<pre>"; print_r($barcodeData['qty']);
                                                                                        
                                                                                        // ###########################################
                                                                                        // ##             Closing Balance           ##
                                                                                        // ###########################################
                                                                                        
                                                                                        $balQty = $barcodeInwardData['qty'] - $barcodeData['qty'];
                                                                                        
                                                                                        if($balQty != '')
                                                                                        {
                                                                                            $balQty = $balQty;
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $balQty = 0;
                                                                                        }
                                                                                        
                                                                                        $balvalue = $balQty * $mrp;
                                                                                        
                                                                                        $balqtytot = $balqtytot + $balQty;
                                                                                        $balmrptot = $balmrptot + $mrp;
                                                                                        $balvaluetot = $balvaluetot + $balvalue;
                                                                                        
                                                                                    
                                                                                        $html .= '<tr>
                                                                                                    <td class="topBorder rightBorder">
                                                                                                        <center>'.$skurows->product_code.'</center>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <table width="100%">
                                                                                                            <tr>
                                                                                                                <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                    <center>'.($barcodeInwardData['qty'] != '' ? $barcodeInwardData['qty']." - ".$unit['unit'] : "-" ).'</center>
                                                                                                                </td>
                                                                                                                <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                    <center>'.($mrp != '' ? $mrp : "0").'</center>
                                                                                                                </td>
                                                                                                                <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                    <center>'.($value != '0' ? $value : "0").'</center>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <table width="100%">
                                                                                                            <tr>
                                                                                                                <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                    <center>'.($outQty != '0' ? $outQty." - ".$unit['unit'] : "-").'</center>
                                                                                                                </td>
                                                                                                                <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                    <center>'.($mrp != '' ? $mrp : "0").'</center>
                                                                                                                </td>
                                                                                                                <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                    <center>'.($outvalue != '0' ? $outvalue : "0").'</center>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <table width="100%">
                                                                                                            <tr>
                                                                                                                <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                    <center>'.($balQty != '0' ? $balQty : "-").'</center>
                                                                                                                </td>
                                                                                                                <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                    <center>'.($mrp != '' ? $mrp : "0").'</center>
                                                                                                                </td>
                                                                                                                <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                    <center>'.($balvalue).'</center>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>';
                                                                                        
                                                                                        
                                                                                        
                                                                                    }
                                                                                    
                                                                                    $html .= '<tr>
                                                                                                <td class="topBorder rightBorder">
                                                                                                    <center><b>Total</b></center>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <table width="100%">
                                                                                                        <tr>
                                                                                                            <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                <center>'.$qtytot.'</center>
                                                                                                            </td>
                                                                                                            <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                <center>'.$mrptot.'</center>
                                                                                                            </td>
                                                                                                            <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                <center>'.$valuetot.'</center>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <table width="100%">
                                                                                                        <tr>
                                                                                                            <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                <center>'.$outqtytot.'</center>
                                                                                                            </td>
                                                                                                            <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                <center>'.$outmrptot.'</center>
                                                                                                            </td>
                                                                                                            <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                <center>'.$outvaluetot.'</center>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <table width="100%">
                                                                                                        <tr>
                                                                                                            <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                <center>'.$balqtytot.'</center>
                                                                                                            </td>
                                                                                                            <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                <center>'.$balmrptot.'</center>
                                                                                                            </td>
                                                                                                            <td class="topBorder rightBorder" style="width: 33%;">
                                                                                                                <center>'.$balvaluetot.'</center>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>';
                                                                        
                                                                    }
            
            					                            $html .= '</table>
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
        else
        {
    	    $this->render_template('admin_view/reports/inventory/consolidatedReport', $this->data);
        }
    }
	
	public function customeReport()
	{
	    $this->form_validation->set_rules('customerreport', 'Custome Report', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
         
            // echo "<pre>"; print_r($_POST);
            $pcat = $psubcat = $sku = $brand = '';
            
            if(isset($_POST['pcat']))
            {
                $pcat = $_POST['pcat'];
            }
            
            if(isset($_POST['pcat1']))
            {
                $pcat1 = $_POST['pcat1'];
            }
            
            if(isset($_POST['psubcat']))
            {
                $psubcat = $_POST['psubcat'];
            }
            
            if(isset($_POST['psubcat1']))
            {
                $psubcat1 = $_POST['psubcat1'];
            }
            
            if(isset($_POST['sku']))
            {
                $sku = $_POST['sku'];
            }
            
            if(isset($_POST['sku1']))
            {
                $sku1 = $_POST['sku1'];
            }

            if(isset($_POST['brand']))
            {
                $brand = $_POST['brand'];
            }
            
            // echo "<pre>"; print_r($pcat); echo "<pre>"; print_r($sku); exit;
            
            if(isset($_POST['search']))
            {
                $company_id = $this->session->userdata['wo_company'];
        	    $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);
        	    
        	    
        	    $this->data['division'] = $this->model_division->fecthAllData();
        	    $this->data['location'] = $this->model_location->fecthAllData();
        	    $this->data['productCat'] = $this->model_category->fecthAllData();
                $this->data['productSubCat'] = $this->model_category->fecthAllSubCatData();
                $this->data['sku'] = $this->model_sku->fecthAllData();
                $this->data['brand'] = $this->model_brand->fecthAllData();
                
                $this->data['color'] = $this->model_attribute->fetchDataById(1);
                $this->data['size'] = $this->model_attribute->fetchDataById(2);
                $this->data['pattern'] = $this->model_attribute->fetchDataById(3);
                $this->data['style1'] = $this->model_attribute->fetchDataById(4);
                $this->data['style2'] = $this->model_attribute->fetchDataById(5);
                $this->data['type'] = $this->model_attribute->fetchDataById(6);
                
                $this->data['report'] = $_POST['customerreport'];
                
                $this->data['div'] = $_POST['division'];
                $this->data['loc'] = $_POST['location'];
                
                $this->data['pcatIds'] = $pcat;
                $this->data['pcatIds1'] = $pcat1;
                
                $this->data['psubcatIds'] = $psubcat;
                $this->data['psubcatIds1'] = $psubcat1;
                
                $this->data['skuIds'] = $sku;
                $this->data['skuIds1'] = $sku1;
                
                $this->data['BrandIds'] = $brand;
                $this->data['frommrp'] = $_POST['frommrp'];
                $this->data['tomrp'] = $_POST['tomrp'];
                $this->data['from'] = $_POST['from'];
                $this->data['to'] = $_POST['to'];
                $this->data['attrcolor'] = $_POST['color'];
                $this->data['attrsize'] = $_POST['size'];
                $this->data['attrpattern'] = $_POST['pattern'];
                $this->data['attrstyle1'] = $_POST['style1'];
                $this->data['attrstyle2'] = $_POST['style2'];
                $this->data['attrtype'] = $_POST['type'];
                
                $this->render_template('admin_view/reports/inventory/customeReport/customeReport_brand', $this->data);
            }
            else
            {
                
            }
        }
        else
        {
            $company_id = $this->session->userdata['wo_company'];
    	    $this->data['companyDetails'] = $this->model_company->fecthDataByID($company_id);
    	    
    	    $this->data['division'] = $this->model_division->fecthAllData();
    	    $this->data['location'] = $this->model_location->fecthAllData();
    	    $this->data['productCat'] = $this->model_category->fecthAllData();
            $this->data['productSubCat'] = $this->model_category->fecthAllSubCatData();
            $this->data['sku'] = $this->model_sku->fecthAllData();
            $this->data['brand'] = $this->model_brand->fecthAllData();
            
                            
            $this->data['color'] = $this->model_attribute->fetchDataById(1);
            $this->data['size'] = $this->model_attribute->fetchDataById(2);
            $this->data['pattern'] = $this->model_attribute->fetchDataById(3);
            $this->data['style1'] = $this->model_attribute->fetchDataById(4);
            $this->data['style2'] = $this->model_attribute->fetchDataById(5);
            $this->data['type'] = $this->model_attribute->fetchDataById(6);
            
    	    $this->render_template('admin_view/reports/inventory/customeReport/customeReport_brand', $this->data);
        }
	}
	
	public function agingReport()
	{
	    $this->data['productCat'] = $this->model_category->fecthAllData();
        $this->data['productSubCat'] = $this->model_category->fecthAllSubCatData();

        $this->data['sku'] = $this->model_sku->fecthAllData();
        $this->data['brand'] = $this->model_brand->fecthAllData();
        $this->data['location'] = $this->model_location->fecthAllData();
 
        $this->data['color'] = $this->model_attribute->fetchDataById(4);
        $this->data['size'] = $this->model_attribute->fetchDataById(5);
        $this->data['pattern'] = $this->model_attribute->fetchDataById(6);
        $this->data['style1'] = $this->model_attribute->fetchDataById(7);
        $this->data['style2'] = $this->model_attribute->fetchDataById(8);
        $this->data['type'] = $this->model_attribute->fetchDataById(9);
        
	    $this->form_validation->set_rules('agingreport', 'Aging Report', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
        
            // echo "<pre>"; print_r($_POST); //exit();
	        
            $from = $_POST['from'];
            $to = $_POST['to'];
            
            $todayDate = date('Y-m-d');
            $fromDay = date("Y-m-d", strtotime("$todayDate -$from day"));
            $toDay = date("Y-m-d", strtotime("$fromDay -$to day"));

            $frommrp = $_POST['frommrp'];
            $tomrp = $_POST['tomrp'];
            
            $color = $_POST['color'];
            $size = $_POST['size'];
            $pattern = $_POST['pattern'];
            $style1 = $_POST['style1'];
            $style2 = $_POST['style2'];
            $type = $_POST['type'];
            
            if(isset($_POST['search']))
            {
                $this->data['newfrom'] = $from;
                $this->data['newto'] = $to;
                $this->data['newfromDay'] = $fromDay;	           
                $this->data['newtoDay'] = $toDay;	           
                $this->data['newfrommrp'] = $frommrp;	           
                $this->data['newtomrp'] = $tomrp;	           
                $this->data['newcolor'] = $color;	           
                $this->data['newsize'] = $size;
                $this->data['newpattern'] = $pattern;	           
                $this->data['newstype1'] = $style1;
                $this->data['newstyle2'] = $style2;	           
                $this->data['newtype'] = $type;

                if(isset($_POST['pcat']) && empty(isset($_POST['psubcat'])) && empty(isset($_POST['sku'])) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by P Category";

                    $countPcat = count($_POST['pcat']);

                    $this->data['newcountPcat'] = $countPcat;
                    $this->data['newPcat'] = $_POST['pcat'];
                   
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
                else if(empty(isset($_POST['pcat'])) && isset($_POST['psubcat']) && empty(isset($_POST['sku'])) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by P SUb Category";

                    $countPScat = count($_POST['psubcat']);

                    $this->data['newcountPScat'] = $countPScat;
                    $this->data['newPScat'] = $_POST['psubcat'];
                   
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
                else if(empty(isset($_POST['pcat'])) && empty(isset($_POST['psubcat'])) && isset($_POST['sku']) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by SKU Category";

                    $countSKU = count($_POST['sku']);
                    
                    $this->data['newsku'] = $_POST['sku'];
                    $this->data['countSKU'] = $countSKU;
                    
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
                else if(empty(isset($_POST['pcat'])) && empty(isset($_POST['psubcat'])) && empty(isset($_POST['sku'])) && isset($_POST['brand']) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by Brand Category";

                    $countBrand = count($_POST['brand']);
                    
                    $this->data['newbrand'] = $_POST['brand'];
                    $this->data['countBrand'] = $countBrand;
                    
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
                // else if(empty(isset($_POST['pcat'])) && empty(isset($_POST['psubcat'])) && empty(isset($_POST['sku'])) && empty(isset($_POST['brand'])) && isset($_POST['location']))
                // {
                //     echo "fetch by location Category";

                //     $countPcat = count($_POST['pcat']);

                //     $this->data['newcountPcat'] = $countPcat;
                //     $this->data['newPcat'] = $_POST['pcat'];

                // }
                else if(isset($_POST['pcat']) && isset($_POST['psubcat']) && empty(isset($_POST['sku'])) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by P Category and Sub Cat";

                    $countPcat = count($_POST['pcat']);

                    $this->data['newcountPandScat'] = $countPcat;
                    $this->data['newPandScat'] = $_POST['pcat'];
                   
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);

                }
                else if(isset($_POST['pcat']) && empty(isset($_POST['psubcat'])) && isset($_POST['sku']) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by P Category sku";

                    $countSKU = count($_POST['sku']);
                    
                    $this->data['newsku'] = $_POST['sku'];
                    $this->data['countSKU'] = $countSKU;
                    
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
                else if(isset($_POST['pcat']) && empty(isset($_POST['psubcat'])) && empty(isset($_POST['sku'])) && isset($_POST['brand']) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by P Category and brand";

                    $countBrand = count($_POST['brand']);
                    
                    $this->data['newbrand'] = $_POST['brand'];
                    $this->data['countBrand'] = $countBrand;
                    
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
                // else if(isset($_POST['pcat']) && empty(isset($_POST['psubcat'])) && empty(isset($_POST['sku'])) && empty(isset($_POST['brand'])) && isset($_POST['location']))
                // {
                //     echo "fetch by P Category and location";
                // }
                else if(empty(isset($_POST['pcat'])) && isset($_POST['psubcat']) && isset($_POST['sku']) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by Sub cat and sku";

                    $countSKU = count($_POST['sku']);
                    
                    $this->data['newsku'] = $_POST['sku'];
                    $this->data['countSKU'] = $countSKU;
                    
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
                else if(empty(isset($_POST['pcat'])) && isset($_POST['psubcat']) && empty(isset($_POST['sku'])) && isset($_POST['brand']) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by subcategory and brand";

                    $countPScat = count($_POST['psubcat']);

                    $this->data['newcountPScat'] = $countPScat;
                    $this->data['newPScat'] = $_POST['psubcat'];
                   
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
                // else if(empty(isset($_POST['pcat'])) && isset($_POST['psubcat']) && empty(isset($_POST['sku'])) && empty(isset($_POST['brand'])) && isset($_POST['location']))
                // {
                //     echo "fetch by subcategory and location";
                // }
                else if(empty(isset($_POST['pcat'])) && empty(isset($_POST['psubcat'])) && isset($_POST['sku']) && isset($_POST['brand']) && empty(isset($_POST['location'])))
                {
                    // echo "fetch by sku and brand";

                    $countSKU = count($_POST['sku']);
                    
                    $this->data['newsku'] = $_POST['sku'];
                    $this->data['countSKU'] = $countSKU;
                    
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
                // else if(empty(isset($_POST['pcat'])) && empty(isset($_POST['psubcat'])) && isset($_POST['sku']) && empty(isset($_POST['brand'])) && isset($_POST['location']))
                // {
                //     echo "fetch by sku and location";
                // }
                // else if(empty(isset($_POST['pcat'])) && empty(isset($_POST['psubcat'])) && empty(isset($_POST['sku'])) && isset($_POST['brand']) && isset($_POST['location']))
                // {
                //     echo "fetch by Brand and location";
                // }
                else
                {
                    $sku = $this->model_sku->fecthSkuAllData();

                    $countSKU = count($sku);

                    $skuId = array();

                    foreach ($sku as $key => $value) {
                        
                        $skuId[] = $value->id;
                    }
                    // echo $skuId;
                    $this->data['newsku'] = $skuId;
                    $this->data['countSKU'] = $countSKU;
                    
                    $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
                }
            }
            else
            {
                if(isset($_POST['pcat']) && empty(isset($_POST['psubcat'])) && empty(isset($_POST['sku'])) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    $countPcat = count($_POST['pcat']);

                    $newcountPcat = $countPcat;
                    $newPcat = $_POST['pcat'];
                }
                else if(empty(isset($_POST['pcat'])) && isset($_POST['psubcat']) && empty(isset($_POST['sku'])) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    $countPScat = count($_POST['psubcat']);

                    $newcountPScat = $countPScat;
                    $newPScat = $_POST['psubcat'];
                }
                else if(empty(isset($_POST['pcat'])) && empty(isset($_POST['psubcat'])) && isset($_POST['sku']) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    $countSKU = count($_POST['sku']);
                    
                    $newsku = $_POST['sku'];
                    $countSKU = $countSKU;
                }
                else if(empty(isset($_POST['pcat'])) && empty(isset($_POST['psubcat'])) && empty(isset($_POST['sku'])) && isset($_POST['brand']) && empty(isset($_POST['location'])))
                {
                    $countBrand = count($_POST['brand']);
                    
                    $newbrand = $_POST['brand'];
                    $countBrand = $countBrand;
                }
                else if(isset($_POST['pcat']) && isset($_POST['psubcat']) && empty(isset($_POST['sku'])) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    $countPcat = count($_POST['pcat']);

                    $newcountPandScat = $countPcat;
                    $newPandScat = $_POST['pcat'];
                }
                else if(isset($_POST['pcat']) && empty(isset($_POST['psubcat'])) && isset($_POST['sku']) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    $countSKU = count($_POST['sku']);
                    
                    $newsku = $_POST['sku'];
                    $countSKU = $countSKU;
                }
                else if(isset($_POST['pcat']) && empty(isset($_POST['psubcat'])) && empty(isset($_POST['sku'])) && isset($_POST['brand']) && empty(isset($_POST['location'])))
                {
                    $countBrand = count($_POST['brand']);
                    
                    $newbrand = $_POST['brand'];
                    $countBrand = $countBrand;
                }
                else if(empty(isset($_POST['pcat'])) && isset($_POST['psubcat']) && isset($_POST['sku']) && empty(isset($_POST['brand'])) && empty(isset($_POST['location'])))
                {
                    $countSKU = count($_POST['sku']);
                    
                    $newsku = $_POST['sku'];
                    $countSKU = $countSKU;
                }
                else if(empty(isset($_POST['pcat'])) && isset($_POST['psubcat']) && empty(isset($_POST['sku'])) && isset($_POST['brand']) && empty(isset($_POST['location'])))
                {
                    $countPScat = count($_POST['psubcat']);

                    $newcountPScat = $countPScat;
                    $newPScat = $_POST['psubcat'];
                }
                else if(empty(isset($_POST['pcat'])) && empty(isset($_POST['psubcat'])) && isset($_POST['sku']) && isset($_POST['brand']) && empty(isset($_POST['location'])))
                {
                    $countSKU = count($_POST['sku']);
                    
                    $newsku = $_POST['sku'];
                    $countSKU = $countSKU;
                }
                else
                {
                    $sku = $this->model_sku->fecthSkuAllData();

                    $countSKU = count($sku);

                    $skuId = array();

                    foreach ($sku as $key => $value) {
                        
                        $skuId[] = $value->id;
                    }
                    // echo $skuId;
                    $newsku = $skuId;
                    $countSKU = $countSKU;
                    
                }




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
            			    <div class="box">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table" width="100%">
                                            <tr>
                                                <th>
                                                    <center>Barcode Number</center>
                                                </th>
                                                <th>
                                                    <center>SKU</center>
                                                </th>
                                                <th>
                                                    <center>Color</center>
                                                </th>
                                                <th>
                                                    <center>Size</center>
                                                </th>
                                                <th>
                                                    <center>Texture/Pattern</center>
                                                </th>
                                                <th>
                                                    <center>Style 1</center>
                                                </th>
                                                <th>
                                                    <center>Style 2</center>
                                                </th>
                                                <th>
                                                    <center>Type</center>
                                                </th>
                                                <th>
                                                    <center>Quantity</center>
                                                </th>
                                                <th>
                                                    <center>MRP</center>
                                                </th>
                                                <th>
                                                    <center>Aging</center>
                                                </th>
                                            </tr>';
                                            
                                            
                                            // #################################################
                                            // for Prooduct Category wise
                                            // #################################################
                                            if(isset($newcountPcat))
                                            {
                                                for($i=0; $i<$newcountPcat; $i++)
                                                {
                                                    $skuData = $this->model_sku->fecthSkuDataByCatID($newPcat[$i]);

                                                    foreach($skuData as $rows){
                                                    
                                                        if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                        {
                                                            $data = array(
                                                                            'sku' => $rows->product_code,
                                                                          
                                                                            'fromDay' => $fromDay,
                                                                            'toDay' => $toDay,
                                                                            'color' => $color,
                                                                            'size' => $size,
                                                                            'pattern' => $pattern,
                                                                            'style1' => $style1,
                                                                            'style2' => $style2,
                                                                            'type' => $type
                                                                        );
                                                                        
                                                            $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                        }
                                                        else
                                                        {
                                                            $data = array(
                                                                            'sku' => $rows->product_code,
                                                                            'frommrp' => $frommrp,
                                                                            'tommrp' => $tommrp,
                                                                            'fromDay' => $fromDay,
                                                                            'toDay' => $toDay,
                                                                            'fromDay' => $fromDay,
                                                                            'toDay' => $toDay,
                                                                            'color' => $color,
                                                                            'size' => $size,
                                                                            'pattern' => $pattern,
                                                                            'style1' => $style1,
                                                                            'style2' => $style2,
                                                                            'type' => $type
                                                                        );
                                                            $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                        }

                                                        $no = 1; 

                                                        foreach($barcodeData as $rows){

                                                            $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                
                                                            $date1 = date_create($createddate);
                                                            $date2 = date_create($fromDay);
                                                            
                                                            $diff = date_diff($date1,$date2);

                                                            //count days
                                                            $aging = $diff->format("%a");

                                                            $html .= '<tr>
                                                                        <td>
                                                                            <center>'.$rows['barcode'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['sku_code'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['color'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['size'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['pattern'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style1'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style2'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['type'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['quantity'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['mrp'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$aging.'</center>
                                                                        </td>
                                                                    </tr>';

                                                                    $no++;

                                                        }
                                                    }
                                                }
                                            }

                                            // ###########################################
                                            // for Prooduct Sub-Category wise
                                            // ###########################################
                                            if(isset($newcountPScat))
                                            {
                                                for($i=0; $i<$newcountPScat; $i++)
                                                {
                                                    $skuData = $this->model_sku->fecthSkuDataBySubCatID($newPScat[$i]);

                                                    foreach($skuData as $rows){
                                                    
                                                        if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                        {
                                                            $data = array(
                                                                          'sku' => $rows->product_code,
                                                                          'fromDay' => $fromDay,
                                                                          'toDay' => $toDay,
                                                                          'color' => $color,
                                                                          'size' => $size,
                                                                          'pattern' => $pattern,
                                                                          'style1' => $style1,
                                                                          'style2' => $style2,
                                                                          'type' => $type
                                                                      );
                                                                      
                                                          $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                        }
                                                        else
                                                        {
                                                            $data = array(
                                                                          'sku' => $rows->product_code,
                                                                          'frommrp' => $frommrp,
                                                                          'tommrp' => $tomrp,
                                                                          'fromDay' => $fromDay,
                                                                          'toDay' => $toDay,
                                                                            'color' => $color,
                                                                          'size' => $size,
                                                                          'pattern' => $pattern,
                                                                          'style1' => $style1,
                                                                          'style2' => $style2,
                                                                          'type' => $type
                                                                      );
                                                          $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                        }

                                                        $no = 1; 

                                                        foreach($barcodeData as $rows){

                                                            $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                
                                                            $date1 = date_create($createddate);
                                                            $date2 = date_create($fromDay);
                                                            
                                                            $diff = date_diff($date1,$date2);

                                                            //count days
                                                            $aging = $diff->format("%a");

                                                            $html .= '<tr>
                                                                        <td>
                                                                            <center>'.$rows['barcode'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['sku_code'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['color'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['size'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['pattern'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style1'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style2'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['type'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['quantity'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['mrp'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$aging.'</center>
                                                                        </td>
                                                                    </tr>';

                                                                    $no++;   
                                                        }
                                                     }
                                                }
                                            }

                                            // ############################################
                                            // for Prooduct Category And Sub Category wise
                                            // ############################################
                                            if(isset($newcountPandScat))
                                            {
                                                for($i=0; $i<$newcountPandScat; $i++)
                                                {
                                                    $subCatData = $this->model_category->fecthSubCatByCatID($newPandScat[$i]);

                                                    $skuData = $this->model_sku->fecthSkuDataBySubCatID($subCatData['id']);

                                                    foreach($skuData as $rows){


                                                        if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                        {
                                                            $data = array(
                                                                          'sku' => $rows->product_code,
                                                                          'fromDay' => $fromDay,
                                                                          'toDay' => $toDay,
                                                                          'color' => $color,
                                                                          'size' => $size,
                                                                          'pattern' => $pattern,
                                                                          'style1' => $style1,
                                                                          'style2' => $style2,
                                                                          'type' => $type
                                                                      );
                                                                      
                                                          $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                        }
                                                        else
                                                        {
                                                            $data = array(
                                                                          'sku' => $rows->product_code,
                                                                          'frommrp' => $frommrp,
                                                                          'tommrp' => $tomrp,
                                                                          'fromDay' => $fromDay,
                                                                          'toDay' => $toDay,
                                                                            'color' => $color,
                                                                          'size' => $size,
                                                                          'pattern' => $pattern,
                                                                          'style1' => $style1,
                                                                          'style2' => $style2,
                                                                          'type' => $type
                                                                      );
                                                          $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                        }

                                                        $no = 1; 

                                                        foreach($barcodeData as $rows){

                                                            $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                
                                                            $date1 = date_create($createddate);
                                                            $date2 = date_create($fromDay);
                                                            
                                                            $diff = date_diff($date1,$date2);

                                                            //count days
                                                            $aging = $diff->format("%a");

                                                            $html .= '<tr>
                                                                        <td>
                                                                            <center>'.$rows['barcode'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['sku_code'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['color'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['size'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['pattern'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style1'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style2'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['type'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['quantity'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['mrp'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$aging.'</center>
                                                                        </td>
                                                                    </tr>';

                                                                    $no++;   
                                                        }


                                                    }
                                                }
                                            }


                                            // ####################################
                                            // SKU Wise
                                            // ####################################
                                            if(isset($countSKU))
                                            {
                                                for($i=0; $i<$countSKU; $i++)
                                                {
                                                    $skuData = $this->model_sku->fecthSkuDataByID($newsku[$i]);
                                                    
                                                    if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                    {
                                                        $data = array(
                                                                        'sku' => $skuData['product_code'],
                                                                       // 'frommrp' => $newfrommrp,
                                                                       // 'tommrp' => $newtomrp,
                                                                        'fromDay' => $fromDay,
                                                                        'toDay' => $toDay,
                                                                        'color' => $color,
                                                                        'size' => $size,
                                                                        'pattern' => $pattern,
                                                                        'style1' => $style1,
                                                                        'style2' => $style2,
                                                                        'type' => $type
                                                                    );
                                                                            
                                                        $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                    }
                                                    else
                                                    {
                                                        $data = array(
                                                                        'sku' => $skuData['product_code'],
                                                                        'frommrp' => $frommrp,
                                                                        'tommrp' => $tommrp,
                                                                        'fromDay' => $fromDay,
                                                                        'toDay' => $toDay,
                                                                        'color' => $color,
                                                                        'size' => $size,
                                                                        'pattern' => $pattern,
                                                                        'style1' => $style1,
                                                                        'style2' => $style2,
                                                                        'type' => $type
                                                                    );
                                                       
                                                        $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                    }


                                                    $no = 1; 

                                                        foreach($barcodeData as $rows){

                                                            $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                
                                                            $date1 = date_create($createddate);
                                                            $date2 = date_create($fromDay);
                                                            
                                                            $diff = date_diff($date1,$date2);

                                                            //count days
                                                            $aging = $diff->format("%a");

                                                            $html .= '<tr>
                                                                        <td>
                                                                            <center>'.$rows['barcode'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['sku_code'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['color'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['size'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['pattern'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style1'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style2'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['type'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['quantity'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['mrp'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$aging.'</center>
                                                                        </td>
                                                                    </tr>';

                                                                    $no++;   
                                                        }


                                                }                                            
                                            }


                                            // ###############################################
                                            // for Brand wise
                                            // ###############################################

                                            if(isset($countBrand))
                                            {
                                                for($i=0; $i<$countBrand; $i++)
                                                {
                                                    $skuData = $this->model_sku->fecthSkuDataByBrandID($newbrand[$i]);

                                                     foreach($skuData as $rows){


                                                        if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                        {
                                                            $data = array(
                                                                          'sku' => $rows->product_code,
                                                                          'fromDay' => $fromDay,
                                                                          'toDay' => $toDay,
                                                                          'color' => $color,
                                                                          'size' => $size,
                                                                          'pattern' => $pattern,
                                                                          'style1' => $style1,
                                                                          'style2' => $style2,
                                                                          'type' => $type
                                                                      );
                                                                      
                                                          $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                        }
                                                        else
                                                        {
                                                            $data = array(
                                                                          'sku' => $rows->product_code,
                                                                          'frommrp' => $frommrp,
                                                                          'tommrp' => $tomrp,
                                                                          'fromDay' => $fromDay,
                                                                          'toDay' => $toDay,
                                                                            'color' => $color,
                                                                          'size' => $size,
                                                                          'pattern' => $pattern,
                                                                          'style1' => $style1,
                                                                          'style2' => $style2,
                                                                          'type' => $type
                                                                      );
                                                          $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                        }

                                                        $no = 1; 

                                                        foreach($barcodeData as $rows){

                                                            $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                
                                                            $date1 = date_create($createddate);
                                                            $date2 = date_create($fromDay);
                                                            
                                                            $diff = date_diff($date1,$date2);

                                                            //count days
                                                            $aging = $diff->format("%a");

                                                            $html .= '<tr>
                                                                        <td>
                                                                            <center>'.$rows['barcode'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['sku_code'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['color'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['size'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['pattern'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style1'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['style2'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['type'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['quantity'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$rows['mrp'].'</center>
                                                                        </td>
                                                                        <td>
                                                                            <center>'.$aging.'</center>
                                                                        </td>
                                                                    </tr>';

                                                                    $no++;   
                                                        }
                                                    }
                                                }
                                            }

                                        $html .= '</table>
                                    </div>
                                </div>
                            </div>
                		</body>
                	</html>';
            
            	    echo $html;
            }
        }
        else
        {
            $this->render_template('admin_view/reports/inventory/agingReport', $this->data);
        }
	}

    public function gstReport()
    {
        $this->form_validation->set_rules('from', 'Date From', 'trim|required');
        $this->form_validation->set_rules('to', 'Date To', 'trim|required');
        // $this->form_validation->set_rules('gst', 'GST Type', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {

            // echo "<pre>"; print_r($_POST);

            $gst = $gstslab = '';

            if(isset($_POST['gst']))
            {
                $gst = $_POST['gst'];
                $gstslab = $_POST['gstslab'];
            }

            $data = array(
                            'from' => $_POST['from'],
                            'to' => $_POST['to'],
                            'gst' => $_POST['gst'],
                            'gstslab' => $_POST['gstslab'],
                        );
            $this->data['postData'] = $data;

            $this->data['gst'] = $this->model_gst->fecthAllData(); 
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();

            $this->render_template('admin_view/reports/gstReport', $this->data);

        }
        else
        {
            $this->data['gst'] = $this->model_gst->fecthAllData();
            $this->data['taxAndDuties'] = $this->model_ledger->fecthTaxeAndDutiesData();

            $this->render_template('admin_view/reports/gstReport', $this->data);
        }
    }
	
	public function order_reports()
	{
		echo "Order Reports";
		// $this->render_template('admin_view/inventory/internalTransfer/index', $this->data);
	}

	public function crmReport()
	{
		echo "CRM Reports";
	}
    
    

	
}