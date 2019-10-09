

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol> 
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>
          
          <!--< ?php if(in_array('createUser', $user_permission)): ?>-->
            <a href="<?php echo base_url('users/create') ?>" class="btn btn-primary pull-right">Add User</a>
            <br/><br/>
          <!--< ?php endif; ?>-->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="9%">Sr. No.</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Group</th>
                  <!--< ?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>-->
                    <th width="15%">Action</th>
                  <!--< ?php endif; ?>-->

                </tr>
                </thead>
                <tbody>
                  <!--< ?php if($user_data): ?>                  -->
                    <?php $no = 1; foreach ($allData as $rows): ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $rows->username; ?></td>
                        <td><?php echo $rows->email; ?></td>
                        <td><?php echo $rows->fname; echo " "; echo $rows->lname; ?></td>
                        <td><?php echo $rows->phone; ?></td>
                        <td><?php echo $rows->role_name; ?></td>

                        <!--< ?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>-->
                          <td>
                              <a href="<?php echo base_url() ?>users/edit/<?php echo $rows->id ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>

                              <!--<a href="< ?php echo base_url() ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>-->
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteData" data-id="<?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>
                          </td>
                        <!--< ?php endif; ?>-->
                     
                      </tr>
                    <?php $no++; endforeach ?>
                  <!--< ?php endif; ?>-->
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
  
  <!-- MODAL Edit-->
  <form role="form" action="<?php echo base_url('users/delete') ?>" method="post" id="deleteForm">
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Payment-Term</h5>
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
    $(document).ready(function() {
      $('#userTable').DataTable({
        'order' : [],
        });

      $("#userMainNav").addClass('active');
      $("#manageUserSubNav").addClass('active');
      
      
    $('.deleteData').on('click', function(){

        var id = $(this).data('id');
        // alert(id);
        $('#deleteModal').modal('show');
        $('[name="id_edit"]').val(id);
    });
    });
  </script>
