

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Weight Master
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Weight Master</li>
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
        <div class="col-md-12 col-xs-12">
          <div class="box" style="padding: 5px;">
            <br>
            <div style="float:right">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addBrand" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Weight</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                    <tr>
                        <th>Sr No.</th>
                      <th>Weight Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach($allData as $rows): ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $rows->weight_name; ?></td>
                              <td width="170px">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-id="<?php echo $rows->id ?>" data-name="<?php echo $rows->weight_name ?>"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteData" data-id="<?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>
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


<form role="form" action="<?php echo base_url('weight/delete') ?>" method="post" id="deleteForm">
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Weight</h5>
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


 <!-- add Brand Modal -->
      <form method="POST" action="<?php echo base_url('weight/create') ?>" enctype="multipart/form-data">
        <div class="modal fade" id="Modal_addBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Add Weight
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-12 col-md-12">
                          <div>
                            <label>Weight Name</label>
                          </div>
                          <div>
                            <input type="text" name="name" class="form-control">
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

       <!-- Edit Brand Modal -->
      <form method="POST"  action="<?php echo base_url('weight/update') ?>" enctype="multipart/form-data">
        <div class="modal fade" id="Modal_editBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Edit Weight
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-12 col-md-12">
                          <div>
                            <label>Weight Name</label>
                          </div>
                          <div>
                              <input type="hidden" id="id_edit" name="id_edit" >
                            <input type="text" name="editweight" class="form-control">
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
      
      <script type="text/javascript">
          var base_url = "<?php echo base_url(); ?>";

            $('.editData').on('click', function(){

                // alert('hi');
                var id = $(this).data('id');
                var name = $(this).data('name');
                
                // alert(waiter_id);
                $('#Modal_editBrand').modal('show');
                
                $('[name="id_edit"]').val(id);
                $('[name="editweight"]').val(name);
            });
        
            $('.deleteData').on('click', function(){
        
              var id = $(this).data('id');
              $('#deleteModal').modal('show');
              $('[name="id_edit"]').val(id);
            });
    </script>
