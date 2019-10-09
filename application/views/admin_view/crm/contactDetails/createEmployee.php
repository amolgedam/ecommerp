  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Contact
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
    <form method="post" action="<?php echo base_url() ?>contact/createEmployee">
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
                      <label>Aadhar Card No.</label>
                      <input type="text" name="aadhar" value="<?php echo set_value('aadhar'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Other ID Type</label>
                      <select name="other_type" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="drivinglicence">Driving Licence</option>
                        <option value="votingcard">Voting Card</option>
                        <option value="passport">Passport</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Id Number</label>
                      <input type="text" name="id_no" value="<?php echo set_value('id_no'); ?>" class="form-control">
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
                      <label>Social ID</label>
                      <input type="text" name="social" value="<?php echo set_value('social'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Designation</label>
                      <select name="designation" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="tailor-trouser">Tailor-Trouser</option>
                        <option value="tailor-suit/sherwani">Tailor-Suitwani</option>
                        <option value="manager">Manager</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Division</label>
                      <select name="division" class="form-control">
                        <option value="0">---select one---</option>
                        <?php foreach($division as $rows): ?>
                          <option value="<?php echo $rows->id; ?>"><?php echo $rows->division_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Fix Salary Per Month</label>
                      <input type="text" name="salary" id="salay" value="<?php echo set_value('salary'); ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Daily Wage</label>
                      <input type="text" name="wages" id="wages" value="<?php echo set_value('wages'); ?>" readonly class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Net Annual Package</label>
                      <input type="text" name="annualpackage" id="annualpackage" value="<?php echo set_value('annualpackage'); ?>" readonly class="form-control">
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
                                <input type="text" name="ledger_name" value="<?php echo set_value('ledger_name'); ?>" class="form-control">
                              </div>
                          </div>
                          <div class="col-md-2 col-sm-4 col-xs-12">
                              <div>
                                <label>Category</label>
                                <select name="category" id="category" class="form-control">
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

                          <div class="col-md-2 col-sm-4 col-xs-12">
                              <div>
                                <label>Entry Date</label>
                                <input type="date" name="entryDate" value="<?php echo set_value('entryDate'); ?>" class="form-control">
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
                          <div >
                            <h3>Login Details</h3>
                            <input type="checkbox" name="createLogin" id="createLogin" checked value="yes"> Create Login

                          </div>

                          <div class="row" id="createLoginDetails">
                            <br>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label> Username</label>
                                    <input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control">
                                  </div>
                              </div>
                              
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Password</label>
                                    <input type="password" name="password" value="<?php echo set_value('password'); ?>" id="password" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Confirm Password</label>
                                    <input type="password" name="cpassword" id="cpassword" onchange="validate_password()" value="<?php echo set_value('cpassword'); ?>" class="form-control">
                                    <div id="ecpassword" style="background-color: red; color: white; font-size: 15px; display: none">Password and Confirm Password Do Not Match.</div>
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                      <option value="0">---Select Option---</option>
                                      <?php foreach($role as $rows): ?>
                                        <option value="<?php echo $rows->id; ?>"><?php echo $rows->role_name; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Active Status</label><br>
                                    <!-- <input type="checkbox" name="status"> -->
                                    <select name="activeStatus" class="form-control">
                                      <option value="1">Active</option>
                                      <option value="0">Inactive</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-2 col-xs-12">
                                <div>
                                  <label>Store</label>
                                  <select name="store" class="form-control">
                                    <option value="0">---select one---</option>
                                    <?php foreach($store as $rows): ?>
                                      <option value="<?php echo $rows['id']; ?>"><?php echo $rows['store_name']; ?></option>
                                    <?php endforeach; ?>
                                  </select>
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


        $('#createLogin').on('click', function () {
           
            if ($(this).prop('checked')) {
                $('#createLoginDetails').fadeIn();
            } else {
                $('#createLoginDetails').fadeOut();
            }
        });

        $('#createBank').on('click', function () {
           
            if ($(this).prop('checked')) {
                $('#createBankDetails').fadeIn();
            } else {
                $('#createBankDetails').fadeOut();
            }
        });
    });


    function validate_password()
    {
      var password = $('#password').val();
      var cpassword = $('#cpassword').val();
      if(password != cpassword)
      {
        $('#ecpassword').show();
        $('#cpassword').val('');
      }
      else
      {
        $('#ecpassword').hide(); 
      }
    }
</script>

<script type="text/javascript">
  $(document).ready(function(){

      $('#salay').on('keyup', function(){

          var salay = $(this).val();
          
          var wages = salay / 30;
          wages = (wages).toFixed(3);
          $('#wages').val(wages);

          var annualIncome = salay * 12;
          annualIncome = (annualIncome).toFixed(3);
          $('#annualpackage').val(annualIncome);
      });

  });
</script>


