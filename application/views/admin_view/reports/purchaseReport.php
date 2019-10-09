<!-- < ?php echo "<pre>"; print_r($allData); exit(); ?> -->
<?php
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
        Purchase Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            <form role="form" action="<?php echo base_url('reports/purchaseReport'); ?>" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                  
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <?php $date = date('m/d/Y'); ?>
                      <label>Date From</label>
                      <input type="date" name="from" value="<?php echo set_value('from', $date) ?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Date To</label>
                      <input type="date" name="to" value="<?= set_value('to', $date) ?>" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Ledger Type</label>
                      <select name="purchase" class="form-control">
                          <option value="0">Select Category</option>
                          <option value="purchaseInvoice">Purchase Invoice</option>
                          <option value="purchaseVoucher">Purchase Voucher</option>
                          <option value="purchaseReturn">Purchase Return</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Type</label>
                      <select name="type" class="form-control">
                          <option value="0">Select Category</option>
                          <?php foreach ($ledgertype as $key => $value) { ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['ledger_name']; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Party Ledger</label>
                      <select name="ledger" class="form-control">
                          <option value="0">Select Category</option>
                          <?php foreach ($supplier as $key => $value) { ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['ledger_name']; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                        <br>
                        <input type="submit" name="search" value="Search" class="btn btn-info">
                        <!-- <a href="#" class=" btn btn-info">Search</a> -->
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" name="print" value="Print" class="btn btn-success">
                        <!-- <a href="#" class=" btn btn-success">Print</a> -->
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <!--<button class="btn btn-sm btn-success" onclick="$('#exportToExcel').tblToExcel();">Download to Excel</p>-->
                        <!--<input type="submit" name="excel" value="Download to Excel" class="btn btn-success">-->
                         <a href="#" class=" btn btn-info" onclick="$('#exportToExcel').tblToExcel();">Download to Excel</a> 
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
                                    <h5><b>Purchase Report</b></h5>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="1" width="100%" id="exportToExcel">
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
                                    </tr>
                                    
                                    <?php 
                                      $no=1; $type = $link = $duedate = '';
                                      $gprice = $tottax = $adj = $total = $fgprice = $ftax = $fadj = $ftot = $qty = $pinvoiceTotAmt = $supplier = $balance = 0;
                                      foreach ($result as $key => $value) { 
                                    ?>
                                      <?php
                                          if($value['type'] == 'pinvoice')
                                          {
                                              $type = "Purchase Invoice";
                                              $gprice = $value['gross_amt'] != '' ? $value['gross_amt'] : "-";
                                              $tottax = $value['tot_tax'] != '' ? $value['tot_tax'] : "-";
                                              $adj = $value['adj'] != '' ? $value['adj'] : "-";
                                              $total = $value['tot_invoice'] != '' ? $value['tot_invoice'] : "-";

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
                                              $gprice = $value['gross_amt'] != '' ? $value['gross_amt'] : "-";
                                              $tottax = $value['tot_tax'] != '' ? $value['tot_tax'] : "-";
                                              $adj = $value['adj'] != '' ? $value['adj'] : "-";
                                              $total = $value['tot_invoice'] != '' ? $value['tot_invoice'] : "-";

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
                                              $gprice = $value['gross_amt'] != '' ? (- $value['gross_amt']) : "-";
                                              $tottax = $value['tot_tax'] != '' ? (- $value['tot_tax']) : "-";

                                              $adj = $value['adj'] != '' ? $value['adj'] : "-";
                                              $total = $value['tot_invoice'] != '' ? $value['tot_invoice'] : "-";

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
                                          $balance = $balance + $pinvoiceTotAmt;
                                      ?>

                                      <tr>
                                          <td>&nbsp; <?php echo date('d-m-Y', strtotime($value['date'])); ?></td>
                                          
                                          <td>&nbsp; <a href="<?php echo base_url().$link.$value['pid'] ?>"><?php echo $value['invoiceno']; ?></a></td>
                                          
                                          <td>&nbsp;<?php echo $type; ?></td>

                                          <td>&nbsp;<?php echo $supplier['ledger_name']; ?></td>

                                          <td><div style="text-align: right; padding-right: 10px;">&nbsp;<?php echo number_format($gprice, 3); ?></div></td>
                                          
                                          <td><div style="text-align: right; padding-right: 10px;">&nbsp; <?php echo number_format($tottax, 3); ?></div> </td>
                                          <td><div style="text-align: right; padding-right: 10px;">&nbsp; <?php echo number_format($pinvoiceTotAmt != '' ? $pinvoiceTotAmt : '0' , 3); ?> </td>
                                          <td>&nbsp; <?php echo $duedate; ?> </td>
                                          
                                          <td><div style="text-align: right; padding-right: 10px;">&nbsp; <?php echo number_format($balance != '' ? $balance : '0' , 3); ?> </td>

                                      </tr>
                                    <?php $no++; } ?>
                                    
                                    <tr>
                                        <td colspan="3">&nbsp; </td>
                                        <td>&nbsp; Total:</td>
                                        <td>&nbsp; <div style="text-align: right; padding-right: 10px; font-weight: bold;"><?php echo number_format($fgprice, 3); ?></div> </td>
                                        <td>&nbsp; <div style="text-align: right; padding-right: 10px; font-weight: bold;"><?php echo number_format($ftax, 3); ?></div> </td>
                                        
                                        <td>&nbsp; 
                                          <!-- <div style="text-align: right; padding-right: 10px; font-weight: bold;">< ?php echo number_format($fgprice + $ftax, 3); ?></div>  -->
                                        </td>

                                        <td>&nbsp; <div style="text-align: right; padding-right: 10px; font-weight: bold;">Closing Balance:- </div></td>

                                        <td>&nbsp; <div style="text-align: right; padding-right: 10px; font-weight: bold;"><?php echo number_format($balance, 3); ?></div></td>
                                    </tr>
                                    <!-- <tr>
                                        <td colspan="9">
                                          <div style="text-align: right;">
                                            <span>Closing Balance:- </span>
                                          </div>
                                        </td>
                                    </tr> -->
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
  <!-- /.content-wrapper -->
 <!--  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer> -->

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>

