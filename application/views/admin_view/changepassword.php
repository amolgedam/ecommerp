
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
      
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
    
    <section class="content">
      
      <div class="col-md-6">
            <!--<div class="row">-->
                
                
                <div class="box box-info">
                    <form method="post" action="<?php echo base_url() ?>auth/changepassword">
                        <div class="col-lg-12 col-md-12">
                            <div>
                                <div>
                                    <label>Old Password</label>
                                </div>
                                <div>
                                    <input type="password" name="old" class="form-control">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label>New Password</label>
                                </div>
                                <div>
                                    <input type="password" name="newpassword" class="form-control">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label>Confirm Password</label>
                                </div>
                                <div>
                                    <input type="password" name="cpassword" class="form-control">
                                </div>
                            </div>
                            
                            <div class="pull-right">
                                <br>
                                <input type="submit" name="save" value="Change Password" class="btn btn-success">
                            </div>
                        </div>
                        
                        
                        
                    </form>
                </div>
                
            <!--</div>-->
      </div>

          
      </div>
    
    </section>
    <!-- /.content -->
  </div>
  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
