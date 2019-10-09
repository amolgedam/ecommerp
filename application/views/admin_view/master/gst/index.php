

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        GST Details
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gst Detais</li>
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
                 <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addGst" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add GST</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Name</th>
                    <th>SGST</th>
                    <th>CGST</th>
                    <th>IGST</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach($allData as $rows): ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $rows->gst_name ?></td>
                              <td><?php echo $rows->sgst ?></td>
                              <td><?php echo $rows->cgst ?></td>
                              <td><?php echo $rows->igst ?></td>
                              <td width="200px">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-id="<?php echo $rows->id ?>" data-name="<?php echo $rows->gst_name ?>" data-sgst="<?php echo $rows->sgst ?>" data-cgst="<?php echo $rows->cgst ?>" data-igst="<?php echo $rows->igst ?>" ><i class="fa fa-pencil"></i>Edit</a>
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

<!--  Modals -->

 <!-- Add Modal -->
      <form method="POST" action="<?php echo base_url('gst/create') ?>" enctype="multipart/form-data">
        <div class="modal fade" id="Modal_addGst" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Add GST
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="col-lg-12 col-md-12">
                     
                      <div>
                          <div>
                            <label>Name</label>
                          </div>
                          <div>
                            <input type="text" name="name" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>SGST</label>
                          </div>
                          <div>
                            <input type="text" name="sgst" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>CGST</label>
                          </div>
                          <div>
                            <input type="text" name="cgst" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>IGST</label>
                          </div>
                          <div>
                            <input type="text" name="igst" class="form-control">
                          </div>
                      </div>
                      <hr>
                      
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

      <!-- Edit Modal -->
      <form method="POST" action="<?php echo base_url('gst/update') ?>" enctype="multipart/form-data">
          <div class="modal fade" id="Modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit GST</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <div class="col-lg-12 col-md-12">
                     
                      <div>
                          <div>
                            <label>Name</label>
                          </div>
                          <div>
                            <input type="text" name="edit_name" class="form-control">
                            <input type="hidden" name="edit_id" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>SGST</label>
                          </div>
                          <div>
                            <input type="text" name="edit_sgst" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>CGST</label>
                          </div>
                          <div>
                            <input type="text" name="edit_cgst" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>IGST</label>
                          </div>
                          <div>
                            <input type="text" name="edit_igst" class="form-control">
                          </div>
                      </div>
                      <hr>
                      
                  </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_adsUpdate" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
      </form>
      <!--END MODAL EDIT-->
      
 
<form role="form" action="<?php echo base_url('gst/delete') ?>" method="post" id="deleteForm">
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
      // alert('hi');
     $('.editData').on('click', function(){

        // alert('hi');
        var id = $(this).data('id');
        var name = $(this).data('name');
        var sgst = $(this).data('sgst');
        var cgst = $(this).data('cgst');
        var igst = $(this).data('igst');
        
        // alert(waiter_id);
        $('#Modal_edit').modal('show');
        
        $('[name="edit_id"]').val(id);
        $('[name="edit_name"]').val(name);
        $('[name="edit_sgst"]').val(sgst);
        $('[name="edit_cgst"]').val(cgst);
        $('[name="edit_igst"]').val(igst);
    });

    $('.deleteData').on('click', function(){

      var id = $(this).data('id');
      $('#deleteModal').modal('show');
      $('[name="id_edit"]').val(id);
    });
    
</script>