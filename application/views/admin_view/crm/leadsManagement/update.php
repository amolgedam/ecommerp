<!--< ?php echo "<pre>"; print_r($itemData); exit; ?>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Lead
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Lead</li>
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

    <form method="post" action="<?php echo base_url() ?>leads/update">
        
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
                        <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control">
                      <label>Existing Customer </label>
                      <select name="existingCustomer" class="form-control">
                        <option value="0">---select one---</option>
                        <?php foreach($customerData as $rows): ?>
                            <option value="<?php echo $rows['id'] ?>" <?php echo $allData['customer_id'] == $rows['id'] ? "selected" : ""; ?> ><?php echo $rows['ledger_name']?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>First Name</label>
                      <input type="text" name="fname"  value="<?php echo $allData['fname']; ?>"  class="form-control">
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
                      <input type="text" name="company_name" value="<?php echo $allData['company']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Number of Employee</label>
                      <input type="text" name="no_employee" value="<?php echo $allData['no_employee']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Website</label>
                      <input type="text" name="website" value="<?php echo $allData['website']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Lead Owner</label>
                      <input type="text" name="lead_owner" value="<?php echo $allData['lead_owner']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Lead Source</label>
                      <select name="lead_source" class="form-control">
                        <option value="0" <?php echo $allData['lead_source'] == "0" ? "selected" : "" ?> >---select one---</option>
                        <option value="source1" <?php echo $allData['lead_source'] == "source1" ? "selected" : "" ?> >Source1</option>
                        <option value="source2" <?php echo $allData['lead_source'] == "source2" ? "selected" : "" ?> >Source2</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Lead Status</label>
                      <select name="lead_status" class="form-control">
                        <option value="0" <?php echo $allData['lead_status'] == "0" ? "selected" : "" ?> >---select one---</option>
                        <option value="cold call" <?php echo $allData['lead_status'] == "cold call" ? "selected" : "" ?> >Cold Call</option>
                        <option value="detailed discussion level" <?php echo $allData['lead_status'] == "detailed discussion level" ? "selected" : "" ?> >Detailed Discussion Level</option>
                        <option value="negotiation level" <?php echo $allData['lead_status'] == "negotiation level" ? "selected" : "" ?> >Negotiation Level</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Industry</label>
                      <select name="industry" class="form-control">
                        <option value="0" <?php echo $allData['industry'] == "0" ? "selected" : "" ?>>---select one---</option>
                        <option value="industry1" <?php echo $allData['industry'] == "industry1" ? "selected" : "" ?>>Industry1</option>
                        <option value="industry2" <?php echo $allData['industry'] == "industry2" ? "selected" : "" ?>>Industry2</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Rating</label>
                      <select name="rating" class="form-control">
                        <option value="0" <?php echo $allData['rating'] == "0" ? "selected" : "" ?>>---select one---</option>
                        <option value="rating1" <?php echo $allData['rating'] == "rating1" ? "selected" : "" ?>>Rating1</option>
                        <option value="rating2" <?php echo $allData['rating'] == "rating2" ? "selected" : "" ?>>Rating2</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Annual Revenue</label>
                      <input type="text" name="annual_revenue" value="<?php echo $allData['annual_revenue'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Mobile Number</label>
                      <input type="text" name="mobile" value="<?php echo $allData['mobile'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Phone</label>
                      <input type="text" name="phone" value="<?php echo $allData['phone'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Email ID</label>
                      <input type="text" name="email" value="<?php echo $allData['email'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Street</label>
                      <input type="text" name="street" value="<?php echo $allData['street'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Country</label>
                      <input type="text" name="country" value="<?php echo $allData['country'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>State</label>
                      <input type="text" name="state" value="<?php echo $allData['state'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>City</label>
                      <input type="text" name="city" value="<?php echo $allData['city'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Zip/Postal Code</label>
                      <input type="text" name="zip" value="<?php echo $allData['zip'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Product Interest</label>
                      <select name="product_interented" class="form-control">
                        <option value="0" <?php echo $allData['product_interented'] == "0" ? "selected" : ""; ?> >---select one---</option>
                        <option value="productInt1" <?php echo $allData['product_interented'] == "productInt1" ? "selected" : ""; ?> >ProductInt1</option>
                        <option value="productInt2" <?php echo $allData['product_interented'] == "productInt2" ? "selected" : ""; ?> >ProductInt2</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Current Generators</label>
                      <input type="text" name="generator" value="<?php echo $allData['generator'] ?>" class="form-control">
                    </div>
                  </div>

                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>SIC CODE</label>
                      <input type="text" name="sic" value="<?php echo $allData['sic'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Primary</label>
                      <select name="primary" class="form-control">
                        <option value="0" <?php echo $allData['primarysec'] == "0" ? "selected" : ""; ?> >---select one---</option>
                        <option value="primary1" <?php echo $allData['primarysec'] == "primary1" ? "selected" : ""; ?> >Primary1</option>
                        <option value="primary2" <?php echo $allData['primarysec'] == "primary2" ? "selected" : ""; ?> >Primary2</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>No. of Location</label>
                      <input type="number" name="location" value="<?php echo $allData['location'] ?>"  class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Desciption</label>
                      <input type="text" name="description" value="<?php echo $allData['description'] ?>"  class="form-control">
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

                          <div class="row">
                            <br>
                              
                            <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Product Name</th>
                                          <th>Quantity</th>
                                          <th>Rate</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach($itemData as $rows): ?>
                                        <tr>
                                            <td><?php echo $rows['item_pname']; ?></td>
                                            <td><?php echo $rows['item_qty']; ?></td>
                                            <td><?php echo $rows['item_rate']; ?></td>
                                            <td><?php echo $rows['status']; ?></td>
                                        </tr>
                                      <?php endforeach; ?>
                                  </tbody>
                              </table>
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
