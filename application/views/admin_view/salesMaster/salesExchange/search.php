
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Exchange Item
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Exchange Item</li>
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
                <!-- <form action="< ?php echo base_url() ?>sales_exchange/create"> -->
                 <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="tile">

                        <form method="post" action="<?php echo base_url() ?>sales_exchange/search">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Search Sale Invoice / Product Serial Number</label>
                                <input type="text" name="number" class="form-control" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <br>
                                <input type="submit" name="search" class="btn btn-info" value="Search">
                            </div>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <!-- </form> -->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <div class="control-sidebar-bg"></div>

</div>

