

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Stock Entry
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Opening Stock</li>
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding: 5px;">
            <div class="box-body">
            <form action="<?php echo base_url() ?>opening_stock/create" method="POST">
               <div class="row">
                
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Opening Stock No.</label>
                      <input type="text" name="opening_stock" value="<?php echo $opening_no; ?>" required class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Invoice Date</label>
                      <input type="date" name="invoice_date" required class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Entry Date</label>
                      <input type="date" name="entry_date" required class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Shiping Type</label>
                      <!-- <div class="row"> -->
                        <input type="text" name="stype" class="form-control">

                        <!--<div class="col-md-2">-->
                        <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addShipingType" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                        <!-- <div class="col-md-12">
                            <select name="stype" id="stype" class="form-control">
                              <option value="0">---Select One---</option>
                              <  ?php foreach($shiptype as $rows): ?>
                                <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->shipping_name; ?></option>
                              < ?php endforeach; ?>
                            </select>
                        </div> -->
                      <!-- </div> -->
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Shipping Tracking No.</label>
                      <input type="text" name="stracking_no" class="form-control">
                    </div>
                  </div> 
                 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Division</label>
                      <select name="division" id="division" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($division as $rows): ?>
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->division_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Branch</label>
                      <select name="branch" id="branch" class="form-control">
                        <option value="0">---Select One---</option>
                        < ?php foreach($branch as $rows): ?>
                              <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->branch_name; ?></option>
                          < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Location</label>
                      <select name="location" id="location" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($location as $rows): ?>
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->location_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Adjustment(+/-)</label>
                      <input type="text" name="adjustment" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Invoice Value</label>
                      <input type="text" name="total_invoice" class="form-control" readonly="">
                    </div>
                  </div>             
              </div>

              <hr>
              <div align="right">
               
                <input type="submit" name="save" value="Save" class="btn btn-success">

              </div>
            </form>
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


<!-- FOR SHIPPING MODAL OPEN -->
<?php
  $this->load->view('admin_view/templates/modals/shippingType');
  // $this->load->view('admin_view/templates/modals/createLedger');
?>