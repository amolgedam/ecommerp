
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
            <div class="box-body">
                <?php echo form_open('sales_order/create'); ?>
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sales Order No</label>
                      <input type="text" name="order_no" value="<?php echo $orderNo ?>" class="form-control" required readonly>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Order Date</label>
                      <input type="date" name="order_date" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sales Account</label>
                      <select name="sales_account" class="form-control" required>
                        <option value="0">Select Option</option>
                          <?php foreach($ledgerPurAccount as $rows): ?>
                                
                                <?php if($this->session->userdata['wo_company'] == $rows->company_id){ ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                                <?php } ?>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Account</label>
                      <select name="account" class="form-control"  required>
                        <option value="0">Select Option</option>

                          <?php foreach($ledgerAccount as $rows): ?>
                              <?php if($this->session->userdata['wo_company'] == $rows->company_id){ ?>
                                  <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                              <?php } ?>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div> 
                 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Division</label>
                      <select name="division" class="form-control">
                        <option value="0">Select Option</option>
                        <?php foreach($division as $rows): ?>
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->division_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Branch</label>
                      <select name="branch" class="form-control">
                            < ?php foreach($branch as $rows): ?>
                              <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->branch_name; ?></option>
                          < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <!--<div class="col-md-4 col-sm-4 col-xs-12">-->
                  <!--  <div>-->
                  <!--    <label>Location</label>-->
                  <!--    <select name="location" class="form-control">-->
                  <!--      <option value="0">Select Option</option>-->
                  <!--           < ?php foreach($location as $rows): ?>-->
                  <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->location_name; ?></option>-->
                  <!--        < ?php endforeach; ?>-->
                  <!--    </select>-->
                  <!--  </div>-->
                  <!--</div>-->

<!--                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Packet By</label>
                      <input type="text" name="packet_by" class="form-control">
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Order Status</label>
                        <select name="status" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="Open" selected>Open</option>
                        <option value="Force Close">Force Close</option>
                        <option value="Delivered">Delivered</option>
                        <option value="In Process">In Process</option>
                        <option value="Partialy Process">Partialy Process</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Expected Completion Date</label>
                      <input type="date" name="completion_date" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Commited Date</label>
                      <input type="date" name="commited_date" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Estimated Total</label>
                      <input type="text" name="estimate_total" class="form-control" required readonly>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <br>
                      <input type="radio" name="order_type" value="mto" checked class="show_purchase_orderCheck"> MTO
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <br>
                      <input type="radio" name="order_type" value="tp" class="show_purchase_orderCheck"> Traded Product
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12" id="purchase_orderCheck">
                    <div>
                      <label>Purchase Order</label>
                      <select name="purchase_order" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($purchaseorder as $rows): ?>
                            <option value="<?php echo $rows['id'] ?>"><?php echo $rows['order_no'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

              </div>

              <hr>
              <div align="right">
        
                <a href="<?php echo base_url(); ?>ledger_master/create" class="btn btn-sm btn-info">Create Ledger</a>
                <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_createLedger" class="btn btn-sm btn-info">Create Ledger</a>-->

                <!--<a href="#" class="btn btn-sm btn-info">Save and Print Order</a>-->
                <!--<button type="submit" name="print"  class="btn btn-sm btn-info">Save and Print Order</button>-->
                
                <!--<a href="#" class="btn btn-sm btn-info">Save and Make Payment</a>-->
                <!--<button type="submit" name="payment" class="btn btn-sm btn-info">Save and Make Payment</button>-->
                
                <!--<input type="submit" name="save" value="Save Order" class="btn btn-success">-->
                
                <!--<input type="submit" name="jobsheet"  class="btn btn-sm btn-success" id="purchase_orderMTO" value="Save and Create Jobsheet">-->
                
                <input type="submit" name="save"  class="btn btn-sm btn-success" value="Create Order">
                
                <!--<button type="submit" name="jobsheet"  class="btn btn-sm btn-success" id="purchase_orderMTO">Save and Create Jobsheet</button>-->
                
                <!--<button type="submit" name="save"  class="btn btn-sm btn-success">Create Order</button>-->
                
                
              </div>
                <?php echo form_close(); ?>
            </div>
            <!-- /.box-body -->
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

<!-- Modals -->
<?php
  $this->load->view('admin_view/templates/modals/addSKU');
  $this->load->view('admin_view/templates/modals/createLedger');
?>