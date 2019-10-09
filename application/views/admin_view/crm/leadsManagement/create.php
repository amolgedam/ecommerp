<!-- < ?php echo "<pre>"; print_r($customerData); exit(); ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Lead
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New Lead</li>
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
    
    <form method="post" action="<?php echo base_url() ?>leads/create">
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
                      <label>Existing Customer </label>
                      <select name="existingCustomer" id="customer" class="form-control">
                        <option value="0">---select one---</option>
                        <?php foreach($customerData as $rows): ?>
                            <option value="<?php echo $rows['id'] ?>"><?php echo $rows['ledger_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>First Name</label>
                      <input type="text" name="fname" id="fname" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Middle Name</label>
                      <input type="text" name="mname" id="mname" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Last Name</label>
                      <input type="text" name="lname" id="lname" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Company Name</label>
                      <input type="text" name="company_name" id="companyname" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Number of Employee</label>
                      <input type="number" name="no_employee" id="no_employee" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Website</label>
                      <input type="text" name="website" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Lead Owner</label>
                      <input type="text" name="lead_owner" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Lead Source</label>
                      <select name="lead_source" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="source1">Source1</option>
                        <option value="source2">Source2</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Lead Status</label>
                      <select name="lead_status" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="cold call">Cold Call</option>
                        <option value="discussionlevel">Detailed Discussion Level</option>
                        <option value="negotiationlevel">Negotiation Level</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Industry</label>
                      <select name="industry" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="industry1">Industry1</option>
                        <option value="industry2">Industry2</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Rating</label>
                      <select name="rating" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="rating1">Rating1</option>
                        <option value="rating2">Rating2</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Annual Revenue</label>
                      <input type="text" name="annual_revenue" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Mobile Number</label>
                      <input type="text" name="mobile" id="mobile" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Phone</label>
                      <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Email ID</label>
                      <input type="text" name="email" id="email" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Street</label>
                      <input type="text" name="street" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Country</label>
                      <input type="text" name="country" id="country" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>State</label>
                      <input type="text" name="state" id="state" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>City</label>
                      <input type="text" name="city" id="city" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Zip/Postal Code</label>
                      <input type="text" name="zip" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Product Interest</label>
                      <select name="product_interented" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="productInt1">ProductInt1</option>
                        <option value="productInt2">ProductInt2</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Current Generators</label>
                      <input type="text" name="generator" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>SIC CODE</label>
                      <input type="text" name="sic" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Primary</label>
                      <select name="primary" class="form-control">
                        <option value="0">---select one---</option>
                        <option value="primary1">Primary1</option>
                        <option value="primary2">Primary2</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>No. of Location</label>
                      <input type="number" name="location" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Desciption</label>
                      <input type="text" name="description" class="form-control">
                    </div>
                  </div>
                </div>
                <hr>

                <div align="right">
                  <input type="submit" name="save" value="Save" class="btn btn-sm btn-primary">
                  <a href="#" class="btn btn-sm btn-primary">Email</a>
                  <a href="#" class="btn btn-sm btn-primary">SMS</a>
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
                            <h3>Products</h3>
                          </div>

                          <div class="row" id="createLedgerDetails">
                            <br>
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Product Name</label>
                                    <input type="text" name="pname" id="pname" class="form-control">
                                  </div>
                              </div>

                              
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Rate</label>
                                    <input type="text" name="rate" id="rate" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Quality</label>
                                    <input type="text" name="quality" id="quality" class="form-control">
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                      <option value="0">---select one---</option>
                                      <option value="open">Open</option>
                                      <option value="close">Close</option>
                                    </select>
                                  </div>
                              </div>

                              <div class="col-md-2 col-sm-4 col-xs-12">
                                  <div>
                                    <br>
                                    <button type="button" name="add" class="btn btn-success btn-sm addItem"><span class="glyphicon glyphicon-plus"></span></button>
                                    <!--<a href="#" id="addItem" class="btn btn-sm btn-primary">Add</a>-->
                                  </div>
                              </div>

                          </div>
                          
                          <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Product Name</th>
                                          <th>Quantity</th>
                                          <th>Rate</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody id="item_table">
                                      
                                  </tbody>
                              </table>
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
    $('.addItem').on('click', function(){
        
        
            // <input type="text" name="item_status[]" class="form-control item_status" /></td>';
        
        // alert("hi");
        var html = '';
        
        var pname = $('#pname').val();
        var qty = $('#rate').val();
        var rate = $('#quality').val();
        var status = $('#status').val();
        // alert(status);
        var openChecked = ''; var closeChecked = '';
        
        if(status== 'open')
        {
            openChecked = "selected";
        }
        
        if (status == 'close')
        {
            closeChecked = "selected";
        }
        
        // alert(openChecked); alert(closeChecked);
        
        
        html += '<tr>';
            html += '<td><input type="text" name="item_pname[]" value="'+pname+'" class="form-control item_pname" /></td>';
            html += '<td><input type="text" name="item_qty[]" value="'+qty+'" class="form-control item_qty" /></td>';
            html += '<td><input type="text" name="item_rate[]" value="'+rate+'" class="form-control item_rate" /></td>';
            html += '<td><select name="status[]" class="form-control item_status">';
                html += '<option value="0">---select one---</option>';
                html += '<option value="open" '+openChecked+' >Open</option>';
                html += '<option value="close" '+closeChecked+' >Close</option>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
        html += '</tr>';
        
        $('#item_table').append(html);
        
        $('#pname').val(""); $('#rate').val(""); $('#quality').val(""); $('#status').val("0");
    });
    
    $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });
</script>

<script>
    var base_url = "<?php echo base_url(); ?>";
    $('#customer').on('change', function(){
        
        var customer = $(this).val(); 
        alert(customer);
        
        $.ajax({
            
            url: base_url + 'customer/getDataByLedgerID/',
            type: 'post',
            dataType: 'json',
            data : {id:customer},
            success:function(response){
                
                // console.log(response);
                $('#fname').val(response.ledger_name); $('#mobile').val(response.mobile);
                $('#phone').val(response.phone); $('#email').val(response.email);
                $('#state').val(response.state); $('#city').val(response.city);
                $('#country').val(response.country);
            }
        });
    });
</script>

