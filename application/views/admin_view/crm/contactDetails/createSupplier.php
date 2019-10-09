

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Contact
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New Contact</li>
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
    <form method="post" action="<?php echo base_url() ?>contact/createSupplier">
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
                
                <div class="row">
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Title</label>
                      <select name="title" class="form-control">
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
                      <input type="text" name="fname" value="<?php echo set_value('fname'); ?>" required class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Middle Name</label>
                      <input type="text" name="mname" value="<?php echo set_value('mname'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Last Name</label>
                      <input type="text" name="lname" value="<?php echo set_value('lname'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Address 1</label>
                      <input type="text" name="address_one" value="<?php echo set_value('address_one'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Address 2</label>
                      <input type="text" name="address_two" value="<?php echo set_value('address_two'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Country</label>
                      <input type="text" name="country" value="<?php echo set_value('country'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>State</label>
                      <input type="text" name="state" value="<?php echo set_value('state'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>City</label>
                      <input type="text" name="city" value="<?php echo set_value('city'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Mobile</label>
                      <input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Phone</label>
                      <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Email ID</label>
                      <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>PAN No.</label>
                      <input type="text" name="pan" value="<?php echo set_value('pan'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>GST No.</label>
                      <input type="text" name="gst" value="<?php echo set_value('gst'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Social ID</label>
                      <input type="text" name="social" value="<?php echo set_value('social'); ?>" class="form-control">
                    </div>
                  </div>

                </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                          <div >
                            <h3>Create Bank</h3>
                            <input type="checkbox" name="createBank" id="createBank" checked value="yes"> Create Bank

                          </div>

                          <div class="row" id="createBankDetails">
                            <br>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Account Number</label>
                                    <input type="text" name="acnumber" value="<?php echo set_value('acnumber'); ?>" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Bank Address</label>
                                    <input type="text" name="bank_address" value="<?php echo set_value('bank_address'); ?>" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>IFSC Code</label>
                                    <input type="text" name="ifsccode" value="<?php echo set_value('ifsccode'); ?>" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Swift Code</label>
                                    <input type="text" name="swift" value="<?php echo set_value('swift'); ?>" class="form-control">
                                  </div>
                              </div>
                          </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                          <div >
                            <h3>Create Ledger</h3>
                            <input type="checkbox" name="createLedger" id="createLedger" checked value="yes"> Create Ledger

                          </div>

                          <div class="row" id="createLedgerDetails">
                            <br>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Ledger Name</label>
                                    <input type="text" name="ledger_name" value="<?php echo set_value('ledger_name'); ?>" class="form-control" >
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Category</label>
                                    <select name="category" id="category" class="form-control" >
                                    <option value="0">---Select One---</option>
                                    <?php foreach($accountCat as $rows): ?>
                                        <option value="<?php echo $rows->id ?>"><?php echo ucwords($rows->acategories_name); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Sub-Category</label>
                                   <select name="sub_category" id="sub_category" class="form-control">
                                    <!--<option>---Select One---</option>-->
                                  </select>
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Opening Balance</label>
                                    <input type="text" name="openingBalance" value="<?php echo set_value('openingBalance'); ?>" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-1 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Dr/Cr</label>
                                    <select name="drCr" class="form-control">
                                      <option value="dr">Dr</option>
                                      <option value="cr">Cr</option>
                                    </select>
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Entry Date</label>
                                    <input type="date" name="entryDate" value="<?php echo set_value('entryDate'); ?>" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Wallete Balance</label>
                                    <input type="text" name="walleteBalance" value="<?php echo set_value('walleteBalance'); ?>" class="form-control">
                                  </div>
                              </div>

                          </div>

                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="tile">
                      <div class="row">
                          <div style="padding-left: 20px;">
                            <input type="submit" name="save" value="Save" class="btn btn-sm- btn-primary">
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    </form>
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


<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url() ?>';
        // alert(base_url);
        $('#category').on('change', function(){
            
            $('#sub_category').html('');
            
            var accountcat_id = $(this).val();
            // alert(accountcat_id);
             var html = '';
              $.ajax({
                    
                    url: base_url + 'account_category/fetchSubcatBycateID/',
                    type: 'post',
                    dataType: 'json',
                    data : {accountcat_id:accountcat_id},
                    success:function(response){
                        
                        // console.log(response);
                        html += '<option>---Select One---</option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.asubcat_name+'</option>';             
                        });
                        
                        $('#sub_category').append(html);
                    }
              });
        });

        $('#createBank').on('click', function () {
           
            if ($(this).prop('checked')) {
                $('#createBankDetails').fadeIn();
            } else {
                $('#createBankDetails').fadeOut();
            }
        });

    });
</script>

