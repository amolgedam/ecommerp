<!--< ?php print_r($legerCat); exit; ?>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Account
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New Account</li>
      </ol>
    </section>

    <div style="padding: 10px;">
        <?php
            if($feedback = $this->session->flashdata('feedback'))
            {
                $feedback_class = $this->session->flashdata('feedback_class');
        ?>
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

        <?php if(isset($errorName)){ echo $errorName; } ?>  


    </div>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            <form role="form" action="<?php echo base_url('ledger_master/create') ?>" enctype="multipart/form-data" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>" required autocomplete="off" >
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Acount Category</label>
                      <select name="category" id="category" class="form-control" value="<?= set_value('category') ?>" >
                        <option value="0">---Select One---</option>
                        <?php foreach($accountCat as $rows): ?>
                            <option value="<?php echo $rows->id ?>" ><?php echo ucwords($rows->acategories_name); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Acount Sub-Category</label>
                        
                      <select name="sub_category" id="sub_category" class="form-control" value="<?= set_value('sub_category') ?>">
                        <option value="0">---Select One---</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Opening Balance</label>
                      <input type="text" name="opening_balance" class="form-control" value="<?= set_value('opening_balance', '0') ?>"  autocomplete="off" >
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Entry Date</label>
                      <input type="date" name="entry_date" class="form-control" value="<?= set_value('entry_date') ?>" >
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>CR / DR</label>
                      <select name="cr_dr" class="form-control">
                        <option>CR</option>
                        <option>DR</option>
                      </select>
                    </div>
                  </div>  

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Wallete Balance</label>
                      <input type="text" name="wallete" class="form-control" value="<?= set_value('wallete') ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Address1</label>
                      <input type="text" name="address1" class="form-control" value="<?= set_value('address1', '0') ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Address2</label>
                      <input type="text" name="address2" class="form-control" value="<?= set_value('address2') ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Country</label>
                      <input type="text" name="country" class="form-control" value="<?= set_value('country') ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>State</label>
                      <input type="text" name="state" class="form-control" value="<?= set_value('state') ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>City</label>
                      <input type="text" name="city" class="form-control" value="<?= set_value('city') ?>"  autocomplete="off">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Mobile</label>
                      <input type="text" name="mobile" class="form-control" value="<?= set_value('mobile') ?>" min="10" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Phone</label>
                      <input type="text" name="phone" class="form-control" value="<?= set_value('phone') ?>" autocomplete="off" >
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Email</label>
                      <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>" autocomplete="off" >
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>PAN card number</label>
                      <input type="text" name="pan" class="form-control" value="<?= set_value('pan') ?>" autocomplete="off" >
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>GST No</label>
                      <input type="text" name="gst" class="form-control" value="<?= set_value('gst') ?>"  pattern="[a-zA-Z0-9\s]+" max="15">
                    </div>
                  </div> 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div> 
                      <label>Ledger Type</label>
                      <select name="ledger" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($legerCat as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo ucwords($rows->ledgertype_name); ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Social ID</label>
                      <input type="text" name="social_id" class="form-control" value="<?= set_value('social_id') ?>" >
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <br>
                      <input type="checkbox" name="create_bank" id="createbank" value="yes" >&nbsp; Create Bank
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails"  style="display: none;">
                    <div>
                      <label>Account No</label>
                      <input type="text" name="accountno" class="form-control" value="<?= set_value('accountno') ?>" >
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails"  style="display: none;">
                    <div>
                      <label>Bank Address</label>
                      <input type="text" name="bankaddress" class="form-control" value="<?= set_value('bankaddress') ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails"  style="display: none;">
                    <div>
                      <label>IFSC Code</label>
                      <input type="text" name="ifsc" class="form-control" value="<?= set_value('ifsc') ?>">
                    </div>
                  </div>  
                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails" style="display: none;">
                    <div>
                      <label>Swift Code</label>
                      <input type="text" name="swift" class="form-control" value="<?= set_value('accountno') ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails"  style="display: none;">
                    <div>
                      <br>
                      <input type="checkbox" name="login" id="login" value="yes">&nbsp; Provide Login
                    </div>
                  </div>
                  <!-- <div class="col-md-4 col-sm-4 col-xs-12 loginDetails"  style="display: none;">
                    <div>
                      <label>Username</label>
                      <input type="text" name="username" class="form-control" value="< ?= set_value('username') ?>">
                    </div>
                  </div>  -->
              </div>
            </div>
            <!-- /.box-body -->
            <hr>
            <div align="right">
              <input type="submit" name="save" value="Save" class="btn btn-success">
            </div>
          </div>

        </form>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
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
                        html += '<option value="0">---Select One---</option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.asubcat_name+'</option>';             
                        });
                        
                        $('#sub_category').append(html);
                    }
              });
        });
    });
</script>

<script type="text/javascript">
    
    $('#createbank').on('click', function () {
       
        if ($(this).prop('checked')) {
            $('.bankDetails').fadeIn();
        } else {
            $('.bankDetails').hide();
        }
    });

    // $('#login').on('click', function () {
       
    //     if ($(this).prop('checked')) {
    //         $('.loginDetails').fadeIn();
    //     } else {
    //         $('.loginDetails').hide();
    //     }
    // });

</script>




