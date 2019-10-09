
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Customer Information
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
              
                <form method="post" action="<?php echo base_url() ?>customer/update">
                    <div class="row">
                      
                      <div>
                          <h4 style="padding-left: 15px; font-weight: bold;">User Details</h4>
                          <hr>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Title</label>
                          <select name="title" class="form-control">
                            <option value="0" <?php echo $allData['title'] == "0" ? "selected" : ""; ?> >---select one---</option>
                            <option value="mr" <?php echo $allData['title'] == "mr" ? "selected" : ""; ?>>Mr</option>
                            <option value="mrs" <?php echo $allData['title'] == "mrs" ? "selected" : ""; ?>>Mrs</option>
                            <option value="miss" <?php echo $allData['title'] == "miss" ? "selected" : ""; ?>>Miss</option>
                            <option value="ms" <?php echo $allData['title'] == "ms" ? "selected" : ""; ?>>M/s</option>
                          </select>
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>First Name</label>
                          <input type="hidden" name="id" value="<?php echo $allData['id']; ?>">
                          <input type="text" name="fname" value="<?php echo $allData['fname']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Middle Name</label>
                          <input type="text" name="mname" value="<?php echo $allData['mname']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Last Name</label>
                          <input type="text" name="lname" value="<?php echo $allData['lname']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Company Name</label>
                          <input type="text" name="comapny_name" value="<?php echo $allData['comapny']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Address 1</label>
                          <input type="text" name="address_one" value="<?php echo $allData['address1']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Address 2</label>
                          <input type="text" name="address_two" value="<?php echo $allData['address2']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Country</label>
                          <input type="text" name="country" value="<?php echo $allData['country']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>State</label>
                          <input type="text" name="state" value="<?php echo $allData['state']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>City</label>
                          <input type="text" name="city" value="<?php echo $allData['city']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Mobile</label>
                          <input type="text" name="mobile" value="<?php echo $allData['mobile']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Phone</label>
                          <input type="text" name="phone" value="<?php echo $allData['phone']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Email ID</label>
                          <input type="text" name="email" value="<?php echo $allData['email']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>PAN No.</label>
                          <input type="text" name="pan" value="<?php echo $allData['pan']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>GST No.</label>
                          <input type="text" name="gst" value="<?php echo $allData['gst']; ?>" class="form-control">
                        </div>
                      </div>
    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Social ID</label>
                          <input type="text" name="social" value="<?php echo $allData['social']; ?>" class="form-control">
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
