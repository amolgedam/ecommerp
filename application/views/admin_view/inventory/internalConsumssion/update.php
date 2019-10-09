<!--< ?php  echo "<pre>"; print_r($itemData); exit; ?>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Internal Consumssion
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Internal Consumssion</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <form action="<?php echo base_url() ?>internal_consumption/update" method="post">
          
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
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
              <div class="row">
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Internal Consumssion No</label>
                    <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control" readonly>
                    <input type="text" name="inventory_no" value="<?php echo $allData['inventory_no']; ?>" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" value="<?php echo $allData['date']; ?>">
                  </div>
                </div>

                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Account</label>
                    <select name="account" class="form-control">
                      <option value="0">---Selec One---</option>
                            <?php foreach($ledger as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['account'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->ledger_name; ?></option>
                            <?php endforeach; ?>
                    </select>
                  </div>
                </div>
               
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Division</label>
                    <select name="division" class="form-control">
                      <option value="0">---Select One---</option>
                            <?php foreach($division as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['division'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->division_name; ?></option>
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
                                <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['branch'] == $rows->id ? "selected" : "" ; ?>>< ?php echo $rows->branch_name; ?></option>
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
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['location'] == $rows->id ? "selected" : "" ; ?>><?php echo $rows->location_name; ?></option>
                            <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Shipping Type</label>
                    <input type="text" name="shipping_type" value="<?php echo $allData['shipping_type']; ?>" class="form-control">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>No of Product</label>
                    <input type="text" name="no_of_product" value="<?php echo $allData['no_products']; ?>" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Base Total</label>
                    <input type="text" name="base_total" value="<?php echo $allData['base_total']; ?>" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Discount</label>
                    <input type="text" name="total_discount" value="<?php echo $allData['total_discount']; ?>" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Gross Total</label>
                    <input type="text" name="gross_total" class="form-control" value="<?php echo $allData['gross_total']; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Tax</label>
                    <input type="text" name="total_tax" value="<?php echo $allData['total_tax']; ?>" class="form-control" readonly>
                  </div>
                </div>
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Amount</label>
                      <input type="text" name="total_amt" id="amt" class="form-control" value="<?php echo $allData['tot_amt']; ?>"  readonly>
                    </div>
                  </div>
                      
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Adjustment(+/-)</label>
                    <input type="text" name="adjustment" id="adj" value="<?php echo $allData['adjustment']; ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Invoice Value</label>
                    <input type="text" name="total_invoice" id="invoice_value" class="form-control" value="<?php echo $allData['totinvoice_value']; ?>"  readonly>
                  </div>
                </div>             
            </div>

              <hr>
              <div align="right">
                
                <a href="<?php echo base_url() ?>ledger_master/create" class="btn btn-sm btn-info">Create Ledger</a>

                <input type="submit" name="save" value="Save" class="btn btn-success">
                <a href="<?php echo base_url() ?>" class="btn btn-success">Save and Print</a>
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
                        <th>Product No</th>
                        <th>Qty</th>
                        <!--<th>Conversion</th>-->
                        <!-- <th>Conversion Value</th> -->
                        <th>Base Price</th>
                        <th>Discount</th>
                        <th>Gross Price</th>
                        <!--<th>GST %</th>-->
                        <th>GST Amt</th>
                        <th>Salesman Comm.</th>
                        <th>Final Price</th>
                        <th>SKU</th>
                        <!--<th>Category</th>-->
                        <!--<th>Sub-Category</th>-->
                        <!--<th>Status</th>-->
                      </tr>
                    </thead>
                    <tbody> 
                            <?php foreach($itemData as $rows): ?>

                              <?php
                                  $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($rows['pno']);
                                  $skuData = $this->model_sku->fecthSkuDataByID($rows['sku'])
                                ?>

                              <tr>
                                <td><?php echo $barcodeData['barcode'] ?></td>
                                <td><?php echo $rows['qty'] ?></td>
                                <!--<td>< ?php echo $rows['conversion'] ?></td>-->
                                <!-- <td>< ?php echo $rows['conversionvalue'] ?></td> -->
                                <td><?php echo $rows['baseprice'] ?></td>
                                <td><?php echo $rows['disvalue'] ?></td>
                                <td><?php echo $rows['grossprice'] ?></td>
                                <!--<td>< ?php echo $rows['gst'] ?></td>-->
                                <td><?php echo $rows['gstamt'] ?></td>
                                <td><?php echo $rows['salesmancomm'] ?></td>
                                <td><?php echo $rows['finalprice'] ?></td>
                                <td><?php echo $skuData['product_code'] ?></td>
                                <!--<td>Mens</td>-->
                                <!--<td>T-Shirt</td>-->
                                <!--<td>< ?php echo $rows['pno'] ?></td>-->
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



<!-- FOR SHIPPING MODAL OPEN -->
<?php
  // $this->load->view('admin_view/templates/modals/shippingType');
  $this->load->view('admin_view/templates/modals/createLedger');
?>


<script>
    $('#adj').on('keyup', function(){
        
       var adj = parseFloat($(this).val());
       var amt = parseFloat($('#amt').val());
       
       var invoice_value = amt - adj;
       
       $('#invoice_value').val(invoice_value);
    });
</script>
