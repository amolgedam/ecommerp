 <!--< ?php echo "<pre>"; print_r($itemData); exit(); ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Sales Exchange
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Sales Exchange</li>
      </ol>
    </section>

    <div style="padding: 10px">

         <?php
              if($feedback = $this->session->flashdata('feedback'))
              {
                  $feedback_class = $this->session->flashdata('feedback_class');
          ?>
          <br>
          <div class="form-group col-12">
              <div class="">
                  <div class="alert <?= $feedback_class?>">
                      <?= $feedback ?>
                  </div>
              </div>
          </div>
          <?php }?>

          <?php echo validation_errors(); ?>  

              <?php if(!empty($errors)) {
                echo $errors;
              } 
          ?>
    </div>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <form method="post" action="<?php echo base_url() ?>sales_exchange/update">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
              <div class="row">
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Exchange No</label>
                    <input type="hidden" name="id" value="<?php echo $allData['id'] ?>" class="form-control" readonly>
                    <input type="text" name="exchange_no" value="<?php echo $allData['exchange_no'] ?>" class="form-control" readonly>
                  </div>
                </div>
                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Original Invoice No</label>
                    <input type="text" name="original_invoice_no" value="<?php echo $allData['invoice_no'] ?>" class="form-control" readonly>
                  </div>
                </div>

                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Order No</label>
                    <select name="sales_order_no" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($salesorder as $rows): ?>
                        <option value="<?php echo $rows['id']; ?>" <?php echo $allData['sales_orderno'] == $rows['id'] ? "selected" : ""; ?> ><?php echo $rows['order_no']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sale Account</label>
                    <select name="saccount" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerPurAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $allData['saccount_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Account</label>
                    <select name="account" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $allData['account_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Invoice Date</label>
                    <input type="date" name="date" value="<?php echo $allData['date']; ?>" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Salesman</label>
                    <select name="salesman" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerSalesmanAccount as $rows): ?>
                       <!--  <option value="< ?php echo $rows['id']; ?>" < ?php echo $allData['salesman_id'] == $rows['id'] ? "selected" : ""; ?> >< ?php echo $rows['ledger_name']; ?></option> -->

                        <option value="<?php echo $rows['id']; ?>" <?php echo $allData['salesman_id'] == $rows['id'] ? "selected" : "" ; ?> ><?php echo $rows['ledger_name']; ?></option>

                      <?php endforeach; ?>
                    </select>
                  </div>
                </div> 
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Division</label>
                    <select name="division" class="form-control">
                      <option value="0">Select Division</option>
                      <?php foreach($division as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $allData['division'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->division_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Branch</label>
                    <select name="branch" class="form-control">
                      <option value="0">---Select One---</option>
                      < ?php foreach($branch as $rows): ?>
                        <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['branch'] == $rows->id ? "selected" : ""; ?> >< ?php echo $rows->branch_name; ?></option>
                      < ?php endforeach; ?>
                    </select>
                  </div>
                </div> -->

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Location</label>
                    <select name="location" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($location as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $allData['location'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->location_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Memo</label>
                    <select name="sales_memo" class="form-control">
                      <option value="0" <?php echo $allData['sales_memo'] == "0" ? "selected" : ""; ?>>---Select One---</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sale Type</label>
                    <select name="sale_type" class="form-control">
                      <option value="0">---select one---</option>
                      <?php foreach($ledgerPurType as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $allData['salestype'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Shipping Type</label>
                    <input type="text" name="shipping_type" value="<?php echo $allData['shippingtype']; ?>" class="form-control">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Base Total</label>
                    <input type="text" name="base_total" id="bp" value="<?php echo $allData['base_total']; ?>" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Discount</label>
                    <input type="text" name="total_discount" value="<?php echo $allData['total_discount']; ?>" id="dis" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Gross Total</label>
                    <input type="text" name="gross_total" value="<?php echo $allData['gross_total']; ?>" id="gp" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Tax</label>
                    <input type="text" name="total_tax" value="<?php echo $allData['total_tax']; ?>" id="tx" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Amount</label>
                      <input type="text" name="total_amt" value="<?php echo $allData['total_amt']; ?>" class="form-control" id="amt" readonly>
                    </div>
                  </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Adjustment(+/-)</label>
                    <input type="text" name="adjustment" value="<?php echo $allData['adjustment']; ?>" id="adj" class="form-control">
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Invoice Value</label>
                    <input type="text" name="total_invoice" value="<?php echo $allData['total_invoicevalue']; ?>" id="invoice_value" class="form-control" readonly="">
                  </div>
                </div>            
            </div>

              <hr>
              <div align="right">
                <input type="submit" name="save" value="Save" class="btn btn-success">

                <?php if($allData['total_invoicevalue'] != 0){ ?>
                  <!-- <input type="submit" name="payment" value="Make Payment" class="btn btn-success"> -->
                  <a href="<?php echo base_url() ?>sales_exchange/makePayment/<?php echo $allData['id'] ?>" class="btn btn-info">Make Payment</a>
                <?php } ?>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      </form>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

                <div class="table-responsive">
                  <table class="table table-bordered table-striped mydatatable">
                    <thead>
                      <tr>
                        <th>Exchange Type</th>
                        <th>Product No</th>
                        <th>Qty</th>
                        <!-- <th>Conversion</th>
                        <th>Conversion</th> -->
                        <th>MRP</th>
                        <th>Discount</th>
                        <th>Gross Price</th>
                        <!-- <th>GST %</th> -->
                        <th>GST Amt</th>
                        <th>Salesman Comm.</th>
                        <th>Final Price</th>
                        <!-- <th>Status</th> -->
                      </tr>
                    </thead>
                    <tbody> 

                      <!-- < ?php echo "<pre>"; print_r($itemData);  ?> -->
                      <?php foreach($itemData as $rows): ?>

                        <?php
                          $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($rows['pno']);

                          // echo "<pre>"; print_r($barcodeData);
                          $skuData = $this->model_sku->fecthSkuDataByID($rows['sku'])
                        ?>
                        <tr>
                          <td><?php echo $rows['sales_exchange']; ?></td>
                          <td><?php echo $barcodeData['barcode'] ?></td>
                          <td><?php echo $rows['quantity']; ?></td>
                          <!-- <td>< ?php echo $rows['conversion']; ?></td>
                          <td>< ?php echo $rows['conversionvalue']; ?></td> -->
                          <td><?php echo $rows['baseprice']; ?></td>
                          <td><?php echo $rows['disvalue']; ?></td>
                          <td><?php echo $rows['grossprice']; ?></td>
                          <!-- <td>< ?php echo $rows['gst']; ?></td> -->
                          <td><?php echo $rows['gstamt']; ?></td>
                          <td><?php echo $rows['salesmancomm']; ?></td>
                          <td><?php echo $rows['finalprice']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>

            </div>
          </div>
        </div>
      </div>

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

<script type="text/javascript">
  $('#adj').on('keyup', function(){
        
       var adj = parseFloat($(this).val());
       var amt = parseFloat($('#amt').val());
       
       var invoice_value = amt - adj;
       
       $('#invoice_value').val(invoice_value);
    });
</script>