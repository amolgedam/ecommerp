<?php
  // echo "<pre>"; print_r($itemData); exit();
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Internal Transfer
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Internal Consumssion</li>
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

    <form method="post" action="<?php echo base_url() ?>internal_transfer/update">
        

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
               <div class="row">
                
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Transfer Date</label>
                      <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control" required>
                      <input type="hidden" name="inventory_no" value="<?php echo $allData['inventory_no']; ?>" class="form-control" required>
                      <input type="date" name="date" value="<?php echo $allData['date']; ?>"  class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>From Division</label>
                      <select name="from_division" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($division as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['fromdivision'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->division_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>From Branch</label>
                      <select name="from_branch" class="form-control">
                        <option value="0">---Select One---</option>
                            < ?php foreach($branch as $rows): ?>
                                <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['frombranch'] == $rows->id ? "selected" : ""; ?> >< ?php echo $rows->branch_name; ?></option>
                            < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>From Location</label>
                      <select name="from_location" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($location as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['fromlocation'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->location_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>From Store</label>
                      <select name="from_store" id="from_store" class="form-control" disabled="" >
                        <option value="0">---Select One---</option>
                            <?php foreach($store as $rows): ?>
                                <option value="<?php echo $rows['id']; ?>" <?php echo $allData['fromstore'] == $rows['id'] ? "selected" : ""; ?>><?php echo $rows['store_name']; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>To Division</label>
                      <select name="to_division" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($division as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['todivision'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->division_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>To Branch</label>
                      <select name="to_branch" class="form-control">
                        <option value="0">---Select One---</option>
                            < ?php foreach($branch as $rows): ?>
                                <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['tobranch'] == $rows->id ? "selected" : ""; ?> >< ?php echo $rows->branch_name; ?></option>
                            < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>To Location</label>
                      <select name="to_location" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($location as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['tolcation'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->location_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>To Store</label>
                      <select name="to_store" id="to_store" class="form-control" disabled="">
                        <option value="0">---Select One---</option>
                            <?php foreach($store as $rows): ?>
                                <option value="<?php echo $rows['id']; ?>" <?php echo $allData['tostore'] == $rows['id'] ? "selected" : ""; ?>><?php echo $rows['store_name']; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sub Total</label>
                      <input type="text" name="sub_total" value="<?php echo $allData['subtotal']; ?>" class="form-control" id="bp" readonly>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Tax</label>
                      <input type="text" name="total_tax" value="<?php echo $allData['total_tax']; ?>" class="form-control" id="tx" readonly>
                    </div>
                  </div>

                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Discount</label>
                      <input type="text" name="total_discount" value="<?php echo $allData['total_discount']; ?>" class="form-control" id="dis" readonly>
                    </div>
                  </div>

                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Grand Total</label>
                      <input type="text" name="grand_total" value="<?php echo $allData['grand_total']; ?>" class="form-control" id="amt" readonly>
                    </div>
                  </div>
        
              </div>

              <hr>
              <div align="right">
                <a href="#" class="btn btn-sm btn-info">Save and Print</a>
                <input type="submit" name="save" value="Save" class="btn btn-sm btn-success">
              </div>

            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


       <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding: 5px;">
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
                        <th>GST %</th>
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
                                $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);

                                $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($rows['pno']);

                                $skuData = $this->model_sku->fecthDataBySKUID($rows['sku']);
                                // echo "SKU<pre>"; print_r($skuData); exit();
                              ?>

                              <tr>
                                <td><?php echo $barcodeData['barcode'] ?></td>
                                <td><?php echo $rows['qty'] ?></td>
                                <!--<td>< ?php echo $rows['conversion'] ?></td>-->
                                <!-- <td>< ?php echo $rows['conversionvalue'] ?></td> -->
                                <td><?php echo $rows['baseprice'] ?></td>
                                <td><?php echo $rows['disvalue'] ?></td>
                                <td><?php echo $rows['grossprice'] ?></td>
                                <td><?php echo $gstData['gst_name'] ?></td>
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
        <!-- ./col -->
      </div>
      <!-- /.row -->

    </section>
    
    </form>
    <!-- /.content -->
  </div>
 
  <div class="control-sidebar-bg"></div>

</div>

