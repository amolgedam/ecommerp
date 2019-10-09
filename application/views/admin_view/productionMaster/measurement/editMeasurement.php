

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Measurement
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
            
            <div class="box-body">
              <div class="col-md-6">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped mydatatable">
                      <tbody>
                        <tr>
                          <td>
                            <label>Name</label>
                          </td>
                          <td>
                            <input type="text" name="name" class="form-control">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label>Value</label>
                          </td>
                          <td>
                            <textarea name="value" class="form-control"></textarea>
                            <span style="color: red">Each value separated by Comma [ , ]</span>
                          </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>
                            <input type="reset" name="reset" value="Reset" class="btn btn-sm btn-primary">
                            <input type="submit" name="save" value="Update" class="btn btn-sm btn-success">
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

