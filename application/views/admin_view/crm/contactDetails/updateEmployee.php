<!--< ?php echo "<pre>"; print_r($allData); exit; ?>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Contact
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Contact</li>
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
    
    <form method="post" action="<?php echo base_url() ?>contact/updateEmployee">
    <!-- Main content -->
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
                        <option value="0" <?php echo $allData['title'] == "0" ? "selected" : ""; ?> >---select one---</option>
                            <option value="mr" <?php echo $allData['title'] == "mr" ? "selected" : ""; ?> >Mr</option>
                            <option value="mrs" <?php echo $allData['title'] == "mrs" ? "selected" : ""; ?> >Mrs</option>
                            <option value="miss" <?php echo $allData['title'] == "miss" ? "selected" : ""; ?> >Miss</option>
                            <option value="ms" <?php echo $allData['title'] == "ms" ? "selected" : ""; ?> >M/s</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>First Name</label>
                      <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control">
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
                      <label>Aadhar Card No.</label>
                      <input type="text" name="aadhar" value="<?php echo $ledgerData['aadhar']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Other ID Type</label>
                      <select name="other_type" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="drivinglicence" <?php echo $ledgerData['idtype'] == 'drivinglicence' ? "selected" : ""; ?> >Driving Licence</option>
                        <option value="votingcard" <?php echo $ledgerData['idtype'] == 'votingcard' ? "selected" : ""; ?> >Voting Card</option>
                        <option value="passport" <?php echo $ledgerData['idtype'] == 'passport' ? "selected" : ""; ?> >Passport</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Id Number</label>
                      <input type="text" name="id_no" value="<?php echo $ledgerData['idno']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>PAN No.</label>
                      <input type="text" name="pan" value="<?php echo $allData['pan']; ?>" class="form-control">
                    </div>
                  </div>

                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>GST No.</label>
                      <input type="text" name="gst" value="< ?php echo $allData['gst']; ?>" class="form-control">
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Social ID</label>
                      <input type="text" name="social" value="<?php echo $allData['social']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Designation</label>
                      <select name="designation" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="tailor-trouser" <?php echo $ledgerData['designation'] == 'tailor-trouser' ? "selected" : ""; ?>>Tailor-Trouser</option>
                        <option value="tailor-suit/sherwani" <?php echo $ledgerData['designation'] == 'tailor-suit/sherwani' ? "selected" : ""; ?>>Tailor-Suitwani</option>
                        <option value="manager" <?php echo $ledgerData['designation'] == 'manager' ? "selected" : ""; ?>>Manager</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Division</label>
                      <select name="division" class="form-control">
                        <option value="0">---select one---</option>
                        <?php foreach($division as $rows): ?>
                          <option value="<?php echo $rows->id; ?>" <?php echo $ledgerData['division_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->division_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Fix Salary Per Month</label>
                      <input type="text" name="salary" value="<?php echo $ledgerData['salary']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Daily Wage</label>
                      <input type="text" name="wages" value="<?php echo $ledgerData['wages']; ?>" readonly class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Net Annual Package</label>
                      <input type="text" name="annualpackage" value="<?php echo $ledgerData['annualpackage']; ?>" readonly class="form-control">
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
                            <h3>Create Ledger</h3>
                            <input type="checkbox" name="createLedger" id="createLedger" <?php echo $allData['createLedger'] == "yes" ? "checked" : "" ?> value="yes"> Create Ledger

                          </div>
                          
                          <?php
                                $this->load->model('model_ledger');
                                
                                $data = $this->model_ledger->fecthAllDatabyID($allData['ledger_id']);
                                
                          ?>

                          <div class="row" id="createLedgerDetails">
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Ledger Name</label>
                                    <input type="hidden" name="ledger_id" value="<?php echo $allData['ledger_id']; ?>" class="form-control">
                                    <input type="text" name="ledger_name" value="<?php echo $data['ledger_name']; ?>" class="form-control" required>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Category</label>
                                    <select name="category" id="category" class="form-control" required>
                                    <option value="0">---Select One---</option>
                                    <?php foreach($accountCat as $rows): ?>
                                        <option value="<?php echo $rows->id ?>" <?php echo $data['acate_id'] == $rows->id ? "selected" : ""; ?> ><?php echo ucwords($rows->acategories_name); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Sub-Category</label>
                                   <select name="sub_category" id="sub_category" class="form-control">
                                    <?php foreach($accountSCat as $rows): ?>
                                        <option value="<?php echo $rows->id ?>" <?php echo $data['asubcate_id'] == $rows->id ? "selected" : ""; ?> ><?php echo ucwords($rows->asubcat_name); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Opening Balance</label>
                                    <input type="text" name="openingBalance" value="<?php echo $data['opening_balance']; ?>" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Dr/Cr</label>
                                    <select name="drCr" class="form-control">
                                      <option value="dr" <?php echo $data['asubcate_id'] == "dr" ? "selected" : ""; ?> >Dr</option>
                                      <option value="cr" <?php echo $data['asubcate_id'] == "cr" ? "selected" : ""; ?> >Cr</option>
                                    </select>
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Entry Date</label>
                                    <input type="date" value="<?php echo $data['entry_date']; ?>"  name="entryDate" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Wallete Balance</label>
                                    <input type="text" value="<?php echo $data['wallete_balance']; ?>"  name="walleteBalance" class="form-control">
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
                                    <input type="hidden" name="loginid" class="form-control" value="<?php echo $loginData['id'] ?>">
                                    <input type="text" name="username" readonly class="form-control" value="<?php echo $loginData['username'] ?>">
                                  </div>
                              </div>
                              
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Confirm Password</label>
                                    <input type="password" name="cpassword" id="cpassword" onchange="validate_password()" class="form-control">
                                    <div id="ecpassword" style="background-color: red; color: white; font-size: 15px; display: none">Password and Confirm Password Do Not Match.</div>
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                      <option value="0">---Select Option---</option>
                                      <?php foreach($role as $rows): ?>
                                        <option value="<?php echo $rows->id; ?>" <?php echo $loginData['role_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->role_name; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Active Status</label><br>
                                    <!-- <input type="checkbox" name="status"> -->
                                    <select name="activeStatus" class="form-control">
                                      <option value="1" <?php echo $loginData['active'] == "1" ? "selected" : ""; ?> >Active</option>
                                      <option value="0" <?php echo $loginData['active'] == "0" ? "selected" : ""; ?> >Inactive</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Store</label><br>
                                    <!-- <input type="checkbox" name="status"> -->
                                    <select name="store" class="form-control">
                                      <?php foreach($store as $rows){ ?>
                                      <option value="<?php echo $rows['id'] ?>" <?php echo $loginData['store_id'] == $rows['id'] ? "selected" : ""; ?> ><?php echo $rows['store_name']; ?></option>
                                      <?php } ?>
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