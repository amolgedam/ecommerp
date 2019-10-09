

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attribute Master
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attribute Master</li>
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
          <div class="box" style="padding: 5px;">
            <br>
            <div style="float:right">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addAttribute" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Attribute</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                    <tr>
                      <th>Sr no.</th>
                      <th>Name</th>
                      <th>Is Active</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach($allData as $rows): ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $rows->attr_name; ?></td>
                              <td>
                                    <label class="label <?php echo ($rows->status == "active") ? "label-success" : "label-danger"; ?> " ><?php echo $rows->status; ?></label>
                              </td>
                              <td width="200px">
                                <a href="<?php echo base_url() ?>attribute/attributDetails/<?php echo $rows->id;  ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Details</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-id="<?php echo $rows->id ?>" data-name="<?php echo $rows->attr_name ?>" data-avalues="<?php echo $rows->attr_values ?>" data-status="<?php echo $rows->status ?>" ><i class="fa fa-pencil"></i>Edit</a>
                                <!--<a href="javascript:void(0);" class="btn btn-sm btn-danger deleteData" data-id="< ?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>-->
                              </td>
                            </tr>
                        <?php $no++; endforeach; ?>
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
    <form method="POST" action="<?php echo base_url('attribute/create') ?>"  enctype="multipart/form-data">
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
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div>
                            <div>
                              <label>Attribute Name</label>
                            </div>
                            <div>
                              <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div>
                            <div>
                              <label>Attribute Values</label>
                            </div>
                            <div>
                              <textarea name="values" class="form-control"></textarea>
                            </div>
                            <span style="color: red">Enter values, with each value separated by a Quamma and space</span>
                        </div>
                        <div>
                            <br>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
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
    <form method="POST" action="<?php echo base_url('attribute/update') ?>" enctype="multipart/form-data">
      <div class="modal fade" id="Modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  Add Attribute
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div>
                            <div>
                              <label>Attribute Name</label>
                            </div>
                            <div>
                              <input type="text" name="edit_attribute" class="form-control">
                              <input type="hidden" name="id_edit" class="form-control">
                            </div>
                        </div>
                        <div>
                            <div>
                              <label>Attribute Values</label>
                            </div>
                            <div>
                              <textarea name="edit_values" class="form-control"></textarea>
                            </div>
                            <span style="color: red">Enter values, with each value separated by a Quamma and space</span>
                        </div>
                        <div>
                            <br>
                            <select name="edit_status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
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
    
    
<form role="form" action="<?php echo base_url('attribute/delete') ?>" method="post" id="deleteForm">
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
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
                var name = $(this).data('name');
                var avalues = $(this).data('avalues');
                var status = $(this).data('status');
                
                // alert(waiter_id);
                $('#Modal_edit').modal('show');
                
                $('[name="id_edit"]').val(id);
                $('[name="edit_attribute"]').val(name);
                $('[name="edit_values"]').val(avalues);
                $('[name="edit_status"]').val(status);
            });
        
            $('.deleteData').on('click', function(){
        
              var id = $(this).data('id');
              $('#deleteModal').modal('show');
              $('[name="id_edit"]').val(id);
            });
    </script>