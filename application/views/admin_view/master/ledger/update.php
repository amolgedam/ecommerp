<!-- < ?php echo "<pre>"; print_r($data); exit; ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Account
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          
          <form role="form" action="<?php echo base_url('ledger_master/update') ?>" enctype="multipart/form-data" method="post">

        <div class="col-xs-12">
          <div class="box" style="padding: 5px;">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" value="<?= set_value('name', $data['ledger_name']) ?>" required>
                        <input type="hidden" name="id" class="form-control" value="<?= set_value('id', $data['id']) ?>">
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Acount Category</label>
                      <select name="category" id="category" class="form-control">
                        <option>---Select One---</option>
                        <?php foreach($accountCat as $rows): ?>
                            <option value="<?php echo $rows->id ?>" <?php echo $data['acate_id'] == $rows->id ? "selected" : "";  ?> ><?php echo ucwords($rows->acategories_name); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Acount Sub-Category</label>
                      <select name="sub_category" id="sub_category" class="form-control">
                        <option>---Select One---</option>
                        <?php foreach($accountSubcat as $rows): ?>
                            <option value="<?php echo $rows->id ?>" <?php echo $data['asubcate_id'] == $rows->id ? "selected" : "";  ?> ><?php echo ucwords($rows->asubcat_name); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Opening Balance</label>
                      <input type="text" name="opening_balance" class="form-control" value="<?= set_value('opening_balance', $data['opening_balance'] ) ?>"  required>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Closing Balance</label>
                      <input type="text" name="closing_balance" class="form-control" value="<?= set_value('closing_balance', $data['closing_balance']) ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Entry Date</label>
                      <input type="date" name="entry_date" class="form-control" value="<?= set_value('entry_date', $data['entry_date']) ?>" >
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>CR / DR</label>
                      <select name="cr_dr" class="form-control">
                         <option value="CR" <?php echo $data['crdr'] == "CR" ? "selected" : "" ?>>CR</option>
                            <option value="DR" <?php echo $data['crdr'] == "DR" ? "selected" : "" ?> >DR</option>
                      </select>
                    </div>
                  </div>  

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Wallete Balance</label>
                      <input type="text" name="wallete" class="form-control" value="<?= set_value('wallete', $data['wallete_balance']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Address1</label>
                      <input type="text" name="address1" class="form-control" value="<?= set_value('address1', $data['address_1']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Address2</label>
                      <input type="text" name="address2" class="form-control" value="<?= set_value('address2', $data['address_2']) ?>">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Country</label>
                      <input type="text" name="country" class="form-control" value="<?= set_value('country', $data['country']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>State</label>
                      <input type="text" name="state" class="form-control" value="<?= set_value('state', $data['state']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>City</label>
                      <input type="text" name="city" class="form-control" value="<?= set_value('city', $data['city']) ?>">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Mobile</label>
                      <input type="text" name="mobile" class="form-control" value="<?= set_value('mobile', $data['mobile']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Phone</label>
                      <input type="text" name="phone" class="form-control" value="<?= set_value('phone', $data['phone']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Email</label>
                      <input type="text" name="email" class="form-control" value="<?= set_value('email', $data['email']) ?>">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>PAN card number</label>
                      <input type="text" name="pan" class="form-control" value="<?= set_value('pan', $data['pan']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>GST No</label>
                      <input type="text" name="gst" class="form-control" value="<?= set_value('gst', $data['gst']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Ledger Type</label>
                      <select name="ledger" class="form-control" required>
                            <?php foreach($legerCat as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $data['ledgettype_id'] == $rows->id ? "selected" : "";  ?> ><?php echo ucwords($rows->ledgertype_name); ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Social ID</label>
                      <input type="text" name="social_id" class="form-control" value="<?= set_value('social_id', $data['social_id']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <br><br>
                      <input type="checkbox" name="create_bank" id="createbank"  value="yes" <?php echo $data['create_bank'] == "yes" ? "checked" : "";  ?> >&nbsp; Create Bank
                    </div>
                  </div>


                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails"  style="display: none;">
                    <div>
                      <label>Account No</label>
                      <input type="text" name="accountno" class="form-control" value="<?= set_value('accountno', $data['accountno']) ?>" >
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails"  style="display: none;">
                    <div>
                      <label>Bank Address</label>
                      <input type="text" name="bankaddress" class="form-control" value="<?= set_value('bankaddress', $data['bankaddress']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails"  style="display: none;">
                    <div>
                      <label>IFSC Code</label>
                      <input type="text" name="ifsc" class="form-control" value="<?= set_value('ifsc', $data['ifsccode']) ?>">
                    </div>
                  </div>  
                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails" style="display: none;">
                    <div>
                      <label>Swift Code</label>
                      <input type="text" name="swift" class="form-control" value="<?= set_value('swift', $data['swiftcode']) ?>">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 bankDetails"  style="display: none;">
                    <div>
                      <br>
                      <input type="checkbox" name="login" id="login" value="yes" <?php echo $data['login'] == "yes" ? "checked" : "";  ?>>&nbsp; Provide Login
                    </div>
                  </div>


              </div>
            </div>
            <!-- /.box-body -->
            <hr>
            <div align="right">
              <input type="submit" name="save" value="Save"   class="btn btn-success">
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
                        html += '<option>---Select One---</option>';
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
       
        // if ($(this).prop('checked')) {
        //     $('.bankDetails').fadeIn();
        // } else {
        //     $('.bankDetails').hide();
        // }
      
      findChecked();

    });


    findChecked();

    function findChecked()
    {
        if ($('#createbank').prop('checked')) {
            $('.bankDetails').fadeIn();
        } else {
            $('.bankDetails').hide();
        }
    }

    // $('#login').on('click', function () {
       
    //     if ($(this).prop('checked')) {
    //         $('.loginDetails').fadeIn();
    //     } else {
    //         $('.loginDetails').hide();
    //     }
    // });

</script>






