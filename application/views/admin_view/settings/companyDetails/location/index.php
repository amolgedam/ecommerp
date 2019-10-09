

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Location
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Location</li>
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
                 <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addLocation" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Location</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Location Name</th>
                    <th>Branch Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach($location as $rows): ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo ucwords($rows->lname); ?></td>
                            <td><?php echo ucwords($rows->bname); ?></td>
                            <td width="200px">
                              <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-id="<?php echo $rows->lid ?>" data-name="<?php echo $rows->lname ?>" data-bid="<?php echo $rows->bid ?>"><i class="fa fa-pencil"></i>Edit</a>
                              <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteData" data-id="<?php echo $rows->lid ?>"><i class="fa fa-trash"></i>Delete</a>
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
 
  <div class="control-sidebar-bg"></div>

</div>

<!--  Modals -->

 <!-- Add Modal -->
      <form method="POST" action="<?php echo base_url('location/create') ?>">
        <div class="modal fade" id="Modal_addLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Add Location
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-12 col-md-12">
                          <div>
                              <div>
                                <!-- <label>Branch Name</label> -->
                                <label>Division Name</label>
                              </div>
                              <div>
<!--                                 <select name="branch" class="form-control">
                                    < ?php foreach($branch as $rows): ?>
                                      <option value="< ?php echo $rows->id ?>">< ?php echo ucwords($rows->branch_name); ?></option>
                                    < ?php endforeach; ?>
                                </select> -->
                                <select name="division" class="form-control">
                                    <?php foreach($division as $rows): ?>
                                      <option value="<?php echo $rows->id ?>"><?php echo ucwords($rows->division_name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                              </div>
                          </div>
                           <div>
                              <div>
                                <label>Location Name</label>
                              </div>
                              <div>
                                <input type="text" name="location" class="form-control">
                              </div>
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

      
<form role="form" action="<?php echo base_url('location/delete') ?>" method="post" id="deleteForm">
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

<!-- Edit Modal -->
<form role="form" action="<?php echo base_url('location/update') ?>" method="post" id="createForm">
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div>
                    <label>Division Name</label>
                  </div>
                  <div>
<!--                     <select name="edit_branch" class="form-control">
                      < ?php foreach($branch as $rows): ?>
                        <option value="< ?php echo $rows->id ?>">< ?php echo ucwords($rows->branch_name); ?></option>
                      < ?php endforeach; ?>
                    </select>
 -->
                    <select name="edit_branch" class="form-control">
                        <?php foreach($division as $rows): ?>
                          <option value="<?php echo $rows->id ?>"><?php echo ucwords($rows->division_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div>
                    <label>Location Name</label>
                  </div>
                  <div>
                    <input type="hidden" name="edit_id" class="form-control">
                    <input type="text" name="edit_name" class="form-control">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" type="submit" id="btn_adsUpdate" class="btn btn-success">Update</button>
          </div>
        </div>
      </div>
    </div>
</form>
<!--END MODAL EDIT-->


<script type="text/javascript">
      // alert('hi');
     $('.editData').on('click', function(){

        // alert('hi');
        var id = $(this).data('id');
        var name = $(this).data('name');
        var bid = $(this).data('bid');
        // alert(waiter_id);
        $('#editModal').modal('show');
        $('[name="edit_id"]').val(id);
        $('[name="edit_name"]').val(name);
        $('[name="edit_branch"]').val(bid);
    });

    $('.deleteData').on('click', function(){

      var id = $(this).data('id');
      $('#deleteModal').modal('show');
      $('[name="id_edit"]').val(id);
    });
</script>