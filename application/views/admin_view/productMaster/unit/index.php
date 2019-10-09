<!-- < ?php echo "<pre>"; print_r($unit_cat); exit(); ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Unit Master
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Unit Master</li>
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
        <div class="col-md-5 col-sm-5 col-xs-12">
          <div class="box" style="padding: 5px;">
            
            <div class="box-body">
                <form method="POST" action="<?php echo base_url('unit/createUnitCat') ?>">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <label>Unit Name</label>
                          <input type="text" name="unitcat" class="form-control">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <br><br>
                          <input type="checkbox" name="sale" value="true">&nbsp;Sale in Partial
                        </div>
                    </div>
                    <hr>
                    <div align="right">
                      <input type="submit" name="save" value="Save" class="btn btn-success">
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-7 col-sm-7 col-xs-12">
          <div class="box" style="padding: 5px;">
            <div class="box-body">
                <form method="POST" action="<?php echo base_url('unit/createUnit') ?>">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                      <br><br>
                      <label>1</label>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-9">
                      <label>Unit Category</label>
                      <select name="unitcat" class="form-control">
                         <?php foreach($unit_cat as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->unit_cat_name; ?></option>
                         <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                      <br>
                      <label>=</label>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <label>Conversion</label>
                      <input type="text" name="conversion" class="form-control">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                      <label>New Unit</label>
                      <input type="text" name="unit" class="form-control">
                    </div>
                </div>
                <hr>
                <div align="right">
                  <input type="submit" name="save" value="Save" class="btn btn-success">
                </div>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box" style="padding: 5px;">
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Unit Category</th>
                      <th></th>
                      <th></th>
                      <th>Unit</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php  foreach($unitDetails as $rows): ?>
                        <tr>
                          <td>1</td>
                          <td><?php echo $rows->cat_name; ?></td>
                          <td>=</td>
                          <td><?php echo $rows->conversion; ?></td>
                          <td><?php echo $rows->unit; ?></td>
                          <td width="170px">
                                <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-id="<?php echo $rows->id ?>" data-cat_id="<?php echo $rows->cat_id ?>" data-conv="<?php echo $rows->conversion ?>" data-unit="<?php echo $rows->unit ?>"  ><i class="fa fa-pencil"></i>Edit</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteData" data-id="<?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
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


 <!-- Edit Units -->
    <!-- Edit SKU Modal -->
    <form method="POST" action="<?php echo base_url('unit/updateUnit') ?>">
      <div class="modal fade" id="Modal_editUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  Edit Unit
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                      <div class="col-md-1 col-sm-1 col-xs-1">
                        <br><br>
                        <label>1</label>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-9">
                        <label>Unit Category</label>
                        <input type="hidden" id="id_edit" name="id_edit" >
                        <select name="editunitcat" class="form-control">
                         <?php foreach($unit_cat as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->unit_cat_name; ?></option>
                         <?php endforeach; ?>
                      </select>
                      </div>
                      <div class="col-md-1 col-sm-1 col-xs-1">
                        <br>
                        <label>=</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-6">
                        <label>Conversion</label>
                        <input type="text" name="editconversion" class="form-control">
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-6">
                        <label>New Unit</label>
                        <input type="text" name="editunit" class="form-control">
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
    
       
<form role="form" action="<?php echo base_url('unit/deleteUnit') ?>" method="post" id="deleteForm">
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Unit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
                <input type="hidden" id="id_edit" name="id_edit" >
                <strong>Are you sure to delete this record?</strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Delete</button>
              </div>
          </div>
        </div>
      </div>
  </form>
    
     <script type="text/javascript">
          var base_url = "<?php echo base_url(); ?>";

            $('.editData').on('click', function(){

                // alert('hi');
                var id = $(this).data('id');
                var cat_id = $(this).data('cat_id');
                var conv = $(this).data('conv');
                var unit = $(this).data('unit');
                
                // alert(waiter_id);
                $('#Modal_editUnit').modal('show');
                
                $('[name="id_edit"]').val(id);
                $('[name="editunitcat"]').val(cat_id);
                $('[name="editconversion"]').val(conv);
                $('[name="editunit"]').val(unit);
            });
        
            $('.deleteData').on('click', function(){
        
              var id = $(this).data('id');
              $('#deleteModal').modal('show');
              $('[name="id_edit"]').val(id);
            });
    </script>