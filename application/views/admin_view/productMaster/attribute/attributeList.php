

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attribute List
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attribute List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding: 5px;">
            <br>
            <div>
                <label>Attribute Name:-</label> <input type="text" name="attribute" value="<?php echo ucwords($allData['attr_name']); ?>" disabled readonly>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Attribute Status:-</label> <input type="text" name="attribute" value="<?php echo ucwords($allData['status']); ?>" disabled readonly>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <label>Attribute List:-</label>
                <!--<div>-->
                    <?php $val = $allData['attr_values'];  
                    $data = array(); $data = explode(', ', $val); //print_r($data); ?>
                <!--</div>-->
                <table class="table table-bordered table-striped mydatatable">
                    <tbody>
                        <?php foreach($data as $rows): ?>
                            <tr>
                                <td><?php echo $rows; ?></td>
                            </tr>
                        <?php endforeach; ?>
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

<!-- add Attributs Modal -->
    <form method="POST" enctype="multipart/form-data">
      <div class="modal fade" id="Modal_addAttribute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  Add Attribute
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="col-lg-12 col-md-12">
                    <div>
                        <div>
                          <label>Attribute Name</label>
                        </div>
                        <div>
                          <input type="text" name="attribute" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>Attribute Values</label>
                        </div>
                        <div>
                          <textarea name="values" class="form-control"></textarea>
                        </div>
                        <span style="color: red">Enter values, with each value separated by a new line</span>
                    </div>
                    <div>
                        <br>
                        <input type="checkbox" name="status"> Active
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" name="save" value="Submit" class="btn btn-success">
              </div>
            </div>
          </div>
        </div>
    </form>

    <!-- Edit Attributs Modal -->
    <form method="POST" enctype="multipart/form-data">
      <div class="modal fade" id="Modal_editAttribute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  Add Attribute
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="col-lg-12 col-md-12">
                    <div>
                        <div>
                          <label>Attribute Name</label>
                        </div>
                        <div>
                          <input type="text" name="attribute" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>Attribute Values</label>
                        </div>
                        <div>
                          <textarea name="values" class="form-control"></textarea>
                        </div>
                        <span style="color: red">Enter values, with each value separated by a new line</span>
                    </div>
                    <div>
                        <br>
                        <input type="checkbox" name="status"> Active
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" name="save" value="Update" class="btn btn-success">
              </div>
            </div>
          </div>
        </div>
    </form>