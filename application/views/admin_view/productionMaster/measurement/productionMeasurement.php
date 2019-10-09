

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Measurement
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Measurement</li>
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
                  <a href="<?php echo base_url() ?>add-measurement" class="btn btn-sm btn-info">
                    <i class="fa fa-plus-square"></i>&nbsp;Add Measurement
                  </a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="col-md-9">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped mydatatable">
                      <thead>
                      <tr>
                        <th>Measurement</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>शर्ट</td>
                          <td width="220px">
                              <!-- <a href="#" class="btn btn-info">Details</a> -->
                              <a href="<?php echo base_url() ?>edit-measurement" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                              <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                              <a href="<?php echo base_url() ?>measurement-details" class="btn btn-sm btn-info"><i class="fa fa-eye"></i>&nbsp;Display</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
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

