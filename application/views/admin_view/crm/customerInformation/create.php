
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Customer Information
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer Information</li>
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
          <div class="box">
            <div class="box-body">
              
                <form method="post" action="<?php echo base_url() ?>customer/create">
                    <div class="row">
                      
                      <div>
                          <h4 style="padding-left: 15px; font-weight: bold;">User Details</h4>
                          <hr>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Title</label>
                          <select name="title" class="form-control" required>
                            <option value="0">---select one---</option>
                            <option value="mr">Mr</option>
                            <option value="mrs">Mrs</option>
                            <option value="miss">Miss</option>
                            <option value="ms">M/s</option>
                          </select>
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>First Name</label>
                          <input type="text" name="fname" required class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Middle Name</label>
                          <input type="text" name="mname" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Company Name</label>
                          <input type="text" name="comapny_name" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Address 1</label>
                          <input type="text" name="address_one" required class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Address 2</label>
                          <input type="text" name="address_two" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Country</label>
                          <input type="text" name="country" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>State</label>
                          <input type="text" name="state" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>City</label>
                          <input type="text" name="city" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Mobile</label>
                          <input type="text" name="mobile" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Phone</label>
                          <input type="text" name="phone" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Email ID</label>
                          <input type="email" name="email" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>PAN No.</label>
                          <input type="text" name="pan" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>GST No.</label>
                          <input type="text" name="gst" required class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Social ID</label>
                          <input type="text" name="social" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                          <hr>
                          <div class="pull-right">
                              <input type="submit" name="save" value="Save" class="btn btn-sm btn-success">
                              <input type="reset" name="reset" value="Reset" class="btn btn-sm btn-danger">
                          </div>
                      </div>
    
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
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
