<?php
    // echo "<pre>"; print_r($result); exit();
  $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
?>
	<style>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Trading Account Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Trading Account Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            <form role="form" action="<?php echo base_url(); ?>reports/tradingAc"  method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                  
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Date From</label>
                      <input type="hidden" name="test" value="1" class="form-control" >
                      <input type="date" name="from" value="<?= set_value('from') ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Date To</label>
                      <input type="date" name="to" value="<?= set_value('to') ?>" class="form-control">
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                        <br>
                        <!-- <a href="#" class=" btn btn-info">Search</a> -->
                        <input type="submit" name="search" value="Search" class="btn btn-info">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <!-- <a href="#" class=" btn btn-success">Print</a> -->
                        <input type="submit" name="print" value="Print" class="btn btn-success">

                    </div>
                  </div>
                              
              </div>
            </div>
          </div>

        </form>
        
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    
                    <table border="1" width="100%">
                        <tr>
                            <td>
                                <center>
                                    <h4><b><?php echo strtoupper($companyDetails['company_name']); ?></b></h4>
                                    <!-- <h5>Nagpur-Main</h5> -->
                                    <h6><?php echo ucwords($companyDetails['address1']).' '.ucwords($cityData['city_name']).' '.ucwords($companyDetails['pincode']).' '.ucwords($companyDetails['mobile_no']); ?></h6>
                                    <h6>GST No : <?php echo ucwords($companyDetails['gst']); ?>  &  PAN No : <?php echo ucwords($companyDetails['pan']); ?></h6>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    <h5><b>Trading Account Report</b></h5>
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
                                    </tr>

                                    <?php 
                                      if(isset($result)){

                                        $invoiceno = $amt = $link = $type = '';
                                        $totsale = $totpurchase = $totDiff = 0;
                                        
                                        foreach ($result as $key => $value) {
                                    ?>
                                        <?php
                                            $salesprice = $pur_netprice = $diff = 0;
                                            if(isset($value['invoice_type']))
                                            {
                                                if($value['invoice_type'] == 'salesinvoice')
                                                {
                                                    $invoiceno = $value['inventory_no'];
                                                    $amt = $value['total_invoice'];
                                                    $link = 'sales_invoice/update/';

                                                    $type = "Sales Invoice ";

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

                                                    $type = "Sales Invoice - POS ";


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

                                                    $type = "Sales Voucher ";

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

                                                    $type = "Sales WSP ";

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

                                                $type = "Sales Exchange ";


                                                $exchangeData = $this->model_salesexchange->fecthAllDataByID($value['id']);
                                                
                                                $data = array(
                                                              'inventory_id' => $exchangeData['invoice_id'],
                                                              'inventory_type' => $value['invcentory_type']
                                                            );

                                                // echo "<pre>"; print_r($data);
                                                $barcodeData = $this->model_salesexchange->fecthAllItemData($data);

                                                // echo "Sales Exchange<pre>"; 
                                                // echo "Sales Exchange<pre>"; print_r($barcodeData);

                                                $netprice = 0;

                                                foreach ($barcodeData as $key => $barcodevalue) {
                                                        
                                                    $barcode = $this->model_barcode->fetchAllDataByBarcode($barcodevalue['pno']);

                                                    // echo "<pre>"; print_r($barcode);
                                                    $netprice = $pur_netprice + $barcode['pur_netprice'];
                                                    // echo $pur_netprice."<br>";
                                                }

                                                $pur_netprice = $amt < 0 ? (- $netprice) : $netprice;
                                            }
                                            
                                            $diff = $amt - $pur_netprice;

                                            $totsale = $totsale + $amt;
                                            $totpurchase = $totpurchase + $pur_netprice;

                                            $totDiff = $totDiff + $diff;
                                        ?>
                                          <tr>
                                              <td>&nbsp; <?php echo date('d-m-Y', strtotime($value['date'])); ?></td>
                                              <td>&nbsp; <?php echo $type; ?> <a href="<?php echo base_url().$link.$value['id'] ?>"><?php echo $invoiceno; ?></a> </td>
                                              <td>&nbsp; <?php echo $amt; ?></td>
                                              <td>&nbsp; <?php echo $pur_netprice; ?></td>
                                              <td>&nbsp; <?php echo $diff; ?></td>
                                          </tr>
                                    <?php
                                        }
                                      }
                                    ?>

                                    <tr>
                                        <td>&nbsp; </td>
                                        <td>&nbsp; <b>Total:</b></td>
                                        <td>&nbsp; <b><?php echo $totsale; ?></b></td>
                                        <td>&nbsp; <b><?php echo $totpurchase; ?></b> </td>
                                        <td>&nbsp; <b><?php echo $totDiff; ?></b> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
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
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <div class="control-sidebar-bg"></div>

</div>

