

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Receipt Voucher
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Receipt Voucher</li>
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

    <?php echo form_open('receiptnote/create'); ?>
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
                        <input type="text" name="voucher_no" value="<?php echo $voucherno; ?>" class="form-control" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Entry Date</label>
                              <input type="date" name="entry_date" class="form-control">
                            </div>
                          </div>
                           <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Method Of Adjustment</label>
                              <select name="adjustment" class="form-control">
                                <option value="0">---Select One---</option>
                                <option value="advance">Advance</option>
                                <option value="against referece">Against Reference</option>
                                <option value="on account">On Account</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>From Ledger</label>
                              <select name="ledger" class="form-control">
                                <option value="0">---Select One---</option>
                                <?php foreach($ledger as $rows): ?>
                                  <option value="<?php echo $rows['id']; ?>"><?php echo $rows['ledger_name']; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>To Payment Type</label>
                              <select name="payment_type" class="form-control">
                                <option value="0">---Select One---</option>
                                <?php foreach($paymenttype as $rows): ?>
                                  <option value="<?php echo $rows->id; ?>"><?php echo $rows->payment_name; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Amount</label>
                              <input type="text" name="amount" class="form-control">
                            </div>
                          </div> 
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Check/Reference No.</label>
                              <input type="text" name="reference" class="form-control">
                            </div>
                          </div> 
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Remark</label>
                              <textarea name="remark" class="form-control"></textarea>
                            </div>
                          </div> 
                      </div>
                  </div>
           
              </div>

            </div>
            <!-- /.box-body -->
            <hr>
            <div align="right">
              <input type="reset" name="reset" value="Reset" class="btn btn-warning">
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

