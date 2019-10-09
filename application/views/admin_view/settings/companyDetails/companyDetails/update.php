
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Company Details
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Compay Details</li>
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
              <form role="form" action="<?php echo base_url('company/update') ?>" method="post" id="createForm">
                <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Company Name</label>
                    <input type="hidden" name="id"  value="<?= set_value('id', $allDetails['id']); ?>">
                    <input type="text" name="c_name" class="form-control"  value="<?= set_value('c_name', $allDetails['company_name']); ?>">
                  </div>
                </div>
                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Address 1</label>
                    <input type="text" name="address_one" class="form-control" value="<?= set_value('address_one', $allDetails['address1']); ?>">
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Address 2</label>
                    <input type="text" name="address_two" class="form-control" value="<?= set_value('address_two', $allDetails['address2']); ?>">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>GST</label>
                    <input type="text" name="gst" class="form-control" value="<?= set_value('gst', $allDetails['gst']); ?>">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>PIN Code</label>
                    <input type="number" name="pin" class="form-control" value="<?= set_value('pin', $allDetails['pincode']); ?>">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>State</label>
                    <!--<input type="text" name="state" class="form-control" value="< ?= set_value('state', $allDetails['state']); ?>">-->
                    <select name="state" class="form-control">
                        <?php foreach($state as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo ($rows->id == $allDetails['state']) ? "selected" : ""; ?> ><?php echo ucwords($rows->country_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>City</label>
                    <!--<input type="text" name="city" class="form-control" value="< ?= set_value('city', $allDetails['city']); ?>">-->
                    <select name="city" class="form-control">
                        <?php foreach($city as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo ($rows->id == $allDetails['city']) ? "selected" : ""; ?> ><?php echo ucwords($rows->city_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Phone No.</label>
                    <input type="text" name="phone" class="form-control" value="<?= set_value('phone', $allDetails['phone_no']); ?>">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" value="<?= set_value('mobile', $allDetails['mobile_no']); ?>">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= set_value('email', $allDetails['email']); ?>">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>PAN Number</label>
                    <input type="text" name="pan" class="form-control" value="<?= set_value('pan', $allDetails['pan']); ?>">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Finacial Year Starting</label>
                    <input type="date" name="finance_year" class="form-control" value="<?= set_value('finance_year', $allDetails['fstart']); ?>">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Company Bank </label>
                    <select name="company_name" class="form-control">
                      <option value="0">---Select Company Bank---</option>
                      <option value="mh" <?php echo $allDetails['company_bank'] == 'mh' ? "selected" : '' ; ?> >Bank of Maharastra</option>
                      <option value="idbi" <?php echo $allDetails['company_bank'] == 'idbi' ? "selected" : '' ; ?> >IDBI Bank</option>
                      <option value="ppb" <?php echo $allDetails['company_bank'] == 'ppb' ? "selected" : '' ; ?> >Paytm Payment Bank</option>
                      <option value="boi" <?php echo $allDetails['company_bank'] == 'boi' ? "selected" : '' ; ?> >Bank of India</option>
                      <option value="an" <?php echo $allDetails['company_bank'] == 'an' ? "selected" : '' ; ?> >Aslam Nayyar</option>
                    </select>
                  </div>
                </div>
            </div>
            <!-- /.box-body -->

            <hr>

            <div align="right">
              <input type="submit" name="save" value="Save" class="btn btn-sm btn-primary">
            </div>
            </div>
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
