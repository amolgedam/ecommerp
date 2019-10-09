<!-- < ?php echo "<pre>"; print_r($allData); exit(); ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payment Voucher
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment Voucher</li>
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

    <?php echo form_open('paymentnote/update'); ?>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div>
                        <label>Voucher No.</label>
                        <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control" readonly>
                        <input type="text" name="voucher_no" value="<?php echo $allData['voucherno']; ?>" class="form-control" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Entry Date</label>
                              <input type="date" name="entry_date" value="<?php echo $allData['date']; ?>" class="form-control">
                            </div>
                          </div>
                           <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Method Of Adjustment</label>
                              <select name="adjustment" class="form-control">
                                <option value="0">---Select One---</option>
                                <option value="advance" <?php echo $allData['adjustment'] == 'advance' ? "selected" : ""; ?>>Advance</option>
                                <option value="against referece" <?php echo $allData['adjustment'] == 'against referece' ? "selected" : ""; ?>>Against Reference</option>
                                <option value="on account" <?php echo $allData['adjustment'] == 'on account' ? "selected" : ""; ?>>On Account</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>From Payment Type</label>
                              <select name="payment_type" class="form-control">
                                <option value="0">---Select One---</option>
                                <?php foreach($paymenttype as $rows): ?>
                                  <option value="<?php echo $rows->id; ?>" <?php echo $allData['paymenttype_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->payment_name; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>To Ledger</label>
                              <select name="ledger" class="form-control">
                                <option value="0">---Select One---</option>
                                <?php foreach($ledger as $rows): ?>
                                  <option value="<?php echo $rows['id']; ?>" <?php echo $allData['ledger_id'] == $rows['id'] ? "selected" : ""; ?> ><?php echo $rows['ledger_name']; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div> 
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Amount</label>
                              <input type="text" name="amount" value="<?php echo $allData['amount']; ?>" class="form-control">
                              <input type="hidden" name="oldamount" value="<?php echo $allData['amount']; ?>" class="form-control">
                            </div>
                          </div> 
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Check/Reference No.</label>
                              <input type="text" name="reference" value="<?php echo $allData['referernceno']; ?>" class="form-control">
                            </div>
                          </div> 
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Remark</label>
                              <textarea name="remark" class="form-control"><?php echo $allData['remark']; ?></textarea>
                            </div>
                          </div> 
                      </div>
                  </div>
           
              </div>

            </div>
            <!-- /.box-body -->
            <hr>
            <div align="right">
              
              <a href="<?php echo base_url() ?>paymentNote/delete/<?php echo $allData['id']; ?>" onclick="return confirm(\' you want to delete?\');" class="btn btn-danger">Delete</a>
              <input type="submit" name="save" value="Save" class="btn btn-success">
              <input type="submit" name="print" value="Save and Print" class="btn btn-success">
              <!-- <a href="< ?php echo base_url() ?>" class="btn btn-info">Save and Print</a> -->
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <?php echo form_close(); ?>

  </div>

  <div class="control-sidebar-bg"></div>

</div>

