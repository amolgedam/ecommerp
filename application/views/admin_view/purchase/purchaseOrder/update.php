
<!--< ?php echo "<pre>"; print_r($allData); exit; ?>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <form method="post" action="<?php echo base_url('purchase_order/update'); ?>">
            <div class="box-body">
              
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Order No</label>
                      <input type="text" name="porder_no" value="<?php echo $allData['order_no']; ?>" class="form-control">
                      <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Account</label>
                      <select name="purchase_account" class="form-control">
                          <?php foreach($ledgerPurAccount as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['purac_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Account</label>
                      <select name="account" class="form-control">
                          <?php foreach($ledgerAccount as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['ledger_id'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Payment Type</label>
                      <select name="paytype" class="form-control">
                          <option value="0">Select Payment Type</option>
                        <?php foreach($paytype as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['payment_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->payment_name; ?></option>
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
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['division_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->division_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Branch</label>
                      <select name="branch" class="form-control">
                          <option value="0">Select Branch</option>
                        <?php foreach($branch as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['branch_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->branch_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Location</label>
                      <select name="location" class="form-control">
                          <option value="0">Select Location</option>
                        <?php foreach($location as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['location_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->location_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Type</label>
                      <select name="purchase_type" class="form-control">
                          <option value="0">Select Purchase Type</option>
                            <?php foreach($ledgerPurType as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['purtype_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Invoice Value</label>
                      <input type="text" name="total_invoice_value" value="<?php echo $allData['invoice_value']; ?>" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Order Status</label>
                      <select name="status" class="form-control">
                        <option value="0" <?php echo $allData['order_status'] == $rows->id ? "selected" : ""; ?> >---select one---</option>
                        <option <?php echo $allData['order_status'] == "Open" ? "selected" : ""; ?> >Open</option>
                        <option <?php echo $allData['order_status'] == "Force Close" ? "selected" : ""; ?> >Force Close</option>
                        <option <?php echo $allData['order_status'] == "Delivered" ? "selected" : ""; ?> >Delivered</option>
                        <option <?php echo $allData['order_status'] == "In Process" ? "selected" : ""; ?> >In Process</option>
                        <option <?php echo $allData['order_status'] == "Partialy Process" ? "selected" : ""; ?> >Partialy Process</option>
                      </select>
                    </div>
                  </div>

              </div>

              <hr>
              <div align="right">
               
                <input type="submit" name="save" value="Update Order" class="btn btn-success">
              </div>

            </div>
            </form>
            
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
              
                <div class="row" style="padding: 5px;">

                  <div align="right">
                      <a href="<?php echo base_url() ?>purchase_item/create/<?php echo $allData['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Item</a>
                  </div>
                  
                  <div class="table-responsive">
                      <table class="table">
                          <tr>
                              <th>Sr No.</th>
                              <th>SKU</th>
                              <th>Quantity</th>
                              <th>Rate</th>
                              <th>MRP</th>
                              <th>Net Amount</th>
                              <th>Action</th>
                          </tr>
                          <?php $no=1; foreach($pitemData as $rows): ?>
                          <?php 
                            $skuData = $this->model_sku->fecthSkuDataByID($rows['sku_id']);
                            // echo "<pre>"; print_r($skuData); exit();
                          ?>

                              <tr>
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $skuData['product_code']; ?></td>
                                  <td><?php echo $rows['quantity']; ?></td>
                                  <td><?php echo $rows['base_price']; ?></td>
                                  <td><?php echo $rows['mrp_price']; ?></td>
                                  <td><?php echo $rows['wsp_price']; ?></td>
                                  <td>
                                    <a href="<?php echo base_url(); ?>purchase_item/update/<?php echo $rows['id']; ?>" class="btn btn-info" >Edit</a>
                                    <a href="<?php echo base_url(); ?>purchase_item/deleteItem/<?php echo $rows['id']; ?>" onclick="return confirm('you want to delete?')" class="btn btn-danger" >Delete</a>
                                  </td>
                              </tr>
                          <?php $no++; endforeach; ?>
                      </table>
                  </div>
                  
                </div>
                

              </div>
            </div>
          </div>
        </div>


    </section>
    <!-- /.content -->
  </div>
  
  <div class="control-sidebar-bg"></div>

</div>