
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Sales Invoice
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Sales Invoice</li>
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

    <form method="post" action="<?php echo base_url() ?>sales_invoice/update">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
              <div class="row">
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Invoice No</label>
                    <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control" readonly>
                    <input type="text" name="inventory_no" value="<?php echo $allData['inventory_no']; ?>" class="form-control" readonly>
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
                    <label>Sales Account</label>
                    <select name="saccount" class="form-control">
                      <option value="0">---Select One---</option>
                            <?php foreach($ledgerPurSalesAccount as $rows): ?>

                              <?php if($this->session->userdata['wo_company'] == $rows->company_id){ ?>

                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['sales_account'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->ledger_name; ?></option>
                            <?php } ?>
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
                              <option value="<?php echo $rows['id']; ?>" <?php echo $allData['account'] == $rows['id'] ? "selected" : "" ; ?> ><?php echo $rows['ledger_name']; ?></option>
                          <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Salesman</label>
                    <select name="salesman" class="form-control">
                      <option value="0">---Select One---</option>
                        <?php foreach($ledgerSalesmanAccount as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['salesman'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->ledger_name; ?></option>
                          <?php endforeach; ?>
                    </select>
                  </div>
                </div>  
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Shipping Details</label>
                    <input type="text" name="shipping_details" value="<?php echo $allData['shipping_details']; ?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Shipping Type</label>
                    <input type="text" name="shipping_type"  value="<?php echo $allData['shipping_type']; ?>" class="form-control">
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
                              <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['branch'] == $rows->id ? "selected" : "" ; ?> >< ?php echo $rows->branch_name; ?></option>
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
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['location'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->location_name; ?></option>
                          <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Delivery Memo</label>
                    <select name="delivery_memo" class="form-control">
                          <option value="0">---Select One---</option>
                            <?php foreach($deliveryMemo as $rows): ?>
                              <option value="<?php echo $rows['id']; ?>" <?php echo $allData['delivery_memo'] == $rows['id'] ? "selected" : "" ; ?> ><?php echo $rows['delivery_no']; ?></option>
                          <?php endforeach; ?>
                        </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sale Type</label>
                    <select name="sales_type" class="form-control">
                            <option value="0">---select one---</option>
                          <?php foreach($taxAndDuties as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['sale_type'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->ledger_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>No. of Products</label>
                    <input type="text" name="no_product" value="<?php echo $allData['no_ofproducts']; ?>" class="form-control" readonly>
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
                    <input type="text" name="gross_total" value="<?php echo $allData['gross_total']; ?>" class="form-control" readonly>
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
                    <input type="text" name="total_amt" id="amt" value="<?php echo $allData['total_amt']; ?>" class="form-control" readonly>
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
                    <input type="text" name="total_invoice" id="invoice_value" value="<?php echo $allData['total_invoice']; ?>" class="form-control" readonly>
                    
                    <input type="hidden" name="orderid" value="<?php echo $allData['salesorder_id']; ?>" class="form-control" readonly>
                    
                  </div>
                </div>             
            </div>
            
            

              <hr>
                <div align="right">
                    
                    <a href="<?php echo base_url() ?>sales_invoice/create" class="btn btn-info">New Invoice</a>
        
                    <a href="<?php echo base_url() ?>ledger_master/create" class="btn btn-info">Create Ledger</a>
                    
                    <!--<a href="#" class="btn btn-info">Make Payment</a>-->
                    <input type="submit" name="payment" value="Make Payment" class="btn btn-success">
                
                    <!--<input type="submit" name="save" value="Make Payment" class="btn btn-success">-->

                    <input type="submit" name="save" value="Save" class="btn btn-success">
                
                </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>
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
                            <th>MRP</th>
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
                                <td><?php echo $rows['quantity'] ?></td>
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
    </form>
    <!-- /.content -->
  </div>
 
  <div class="control-sidebar-bg"></div>

</div>



<!-- FOR SHIPPING MODAL OPEN -->
<?php
  // $this->load->view('admin_view/includes/modals/shippingType');
//   $this->load->view('admin_view/includes/modals/createLedger');
?>


<script>
    $('#adj').on('keyup', function(){
        
       var adj = parseFloat($(this).val());
       var amt = parseFloat($('#amt').val());
       
       // alert(adj); alert(amt);
       var invoice_value = amt - adj;
       
       $('#invoice_value').val(invoice_value);
    });
</script>
