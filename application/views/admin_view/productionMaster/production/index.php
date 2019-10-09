

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Production
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Production</li>
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
            <br>
            <div style="float:right">
                  <a href="<?php echo base_url() ?>production/create" class="btn btn-sm btn-info">
                    <i class="fa fa-plus-square"></i>&nbsp;New
                  </a>
                  <a href="<?php echo base_url() ?>furtherprocess" class="btn btn-sm btn-info"></i>&nbsp;Further Process
                  </a>
                  <a href="<?php echo base_url() ?>alternate" class="btn btn-sm btn-info"></i>&nbsp;Alteration
                  </a> 
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                  <tr>
                      <th>Type</th>
                    <th>Job No</th>
                    <th>SKU</th>
                    <th>Delivery Date</th>
                    <th>Order No</th>
                    <!--<th>Sub Category</th>-->
                    <th>Customer</th>
                    <th>Assigned Worker</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <!--<tbody>-->
                  <!--  <tr>-->
                  <!--    <td>0000535</td>-->
                  <!--    <td>SD2303-Custom-Trouser</td>-->
                  <!--    <td>01/02/2019</td>-->
                  <!--    <td>00000190</td>-->
                  <!--    <td>Trouser</td>-->
                  <!--    <td>Firoj Khan</td>-->
                  <!--    <td>Ramesh </td>-->
                  <!--    <td>01</td>-->
                  <!--    <td>Open</td>-->
                  <!--    <td width="130px">-->
                          <!-- <a href="#" class="btn btn-info">Details</a> -->
                  <!--        <a href="< ?php echo base_url() ?>production/update" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>&nbsp;Edit</a>-->
                  <!--        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</a>-->
                  <!--    </td>-->
                  <!--  </tr>-->
                  <!--</tbody>-->
                </table>
              </div>
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
        
        var base_url = '<?php echo base_url(); ?>';
        
            $('#data').DataTable({
                "ajax": {
                    'processing':true,
                    'serverSide':true,
                    "searching": true,
                    url : base_url + "production/fetchAllData",
                    'order': []
                },
                
            });
        
        
    });
</script>