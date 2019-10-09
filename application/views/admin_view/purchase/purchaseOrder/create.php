<!--< ?php print_r($paytype); exit; ?>-->
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
            
            <form method="post" action="<?php echo base_url('purchase_order/create'); ?>">
            <div class="box-body">
              
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Order No</label>
                      <input type="text" name="porder_no" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Account</label>
                      <select name="purchase_account" class="form-control">
                          <?php foreach($ledgerPurAccount as $rows): ?>
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Account</label>
                      <select name="account" class="form-control">
                          <?php foreach($ledgerAccount as $rows): ?>
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
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
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->payment_name; ?></option>
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
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->division_name; ?></option>
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
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->branch_name; ?></option>
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
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->location_name; ?></option>
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
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Invoice Value</label>
                      <input type="text" name="total_invoice_value" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Order Status</label>
                      <select name="status" class="form-control">
                        <option value="0">---select one---</option>
                        <option selected>Open</option>
                        <option>Force Close</option>
                        <option>Delivered</option>
                        <option>In Process</option>
                        <option>Partialy Process</option>
                      </select>
                    </div>
                  </div>
                  
              </div>

              <hr>
              <div align="right">
                <input type="submit" name="save" value="Save Order" class="btn btn-success">
              </div>

            </div>
            </form>
            <!-- /.box-body -->
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

