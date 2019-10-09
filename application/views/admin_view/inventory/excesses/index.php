
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Excesses
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Excesses</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <br>
            <div style="float:right">
              <a href="<?php echo base_url() ?>excesses/create" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Excesses</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                    <tr>
                        <th>Sr No.</th>
                      <th>Excesses No.</th>
                      <th>Date</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <!--<tbody>-->
                  <!--  <tr>-->
                  <!--    <td>00000178</td>-->
                  <!--    <td>23/01/2019</td>-->
                  <!--    <td>1635.11</td>-->
                  <!--    <td width="240px">-->
                  <!--      <a href="< ?php echo base_url() ?>excesses/update" class="btn btn-sm btn-info">-->
                  <!--        <i style="color: white" class="fa fa-edit"></i> Edit-->
                  <!--      </a>-->
                  <!--      <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_deleteSKU" class="btn btn-sm btn-danger">-->
                  <!--        <i style="color: white" class="fa fa-trash"></i> Delete-->
                  <!--      </a>-->
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
                    url : base_url + "excesses/fetchAllData",
                    'order': []
                },
                
            });
        
        
    });
</script>

