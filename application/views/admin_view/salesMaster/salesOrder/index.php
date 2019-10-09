
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Order
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales Order</li>
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
              <a href="<?php echo base_url() ?>sales_order/create" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Sales Order</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Sales Order No.</th>
                      <th>Order Date</th>
                      <th>Expected Completion Date</th>
                      <th>Commited Date</th>
                      <th>Customer Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--<tr>-->
                    <!--  <td>00000178</td>-->
                    <!--  <td>30/01/2019</td>-->
                    <!--  <td>02/02/2019</td>-->
                    <!--  <td>02/02/2019</td>-->
                    <!--  <td>Rahemaan Khan</td>-->
                    <!--  <td>Open</td>-->
                    <!--  <td width="170px">-->
                    <!--    <a href="< ?php echo base_url() ?>sales_order/update" class="btn btn-sm btn-info">-->
                    <!--      <i style="color: white" class="fa fa-edit"></i> Edit-->
                    <!--    </a>-->
                    <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_deleteSKU" class="btn btn-sm btn-danger">-->
                    <!--      <i style="color: white" class="fa fa-trash"></i> Delete-->
                    <!--    </a>-->
                    <!--  </td>-->
                    <!--</tr>-->
                  </tbody>
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
                    url : base_url + "sales_order/fetchAllData",
                    'order': []
                },
                
            });
        
        
    });
</script>
