<!-- < ?php echo print_r($groups_data); exit(); ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Groups</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">groups</li>
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

         
            <a href="<?php echo base_url('group/create') ?>" class="btn btn-primary pull-right">Add Group</a>
            <br /> <br />

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Groups</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="groupTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="9%">Sr. No.</th>
                  <th width="75%">Group Name</th>
                  <!--< ?php if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>-->
                    <th>Action</th>
                  <!--< ?php endif; ?>-->
                  
                </tr>
                </thead>
                <tbody>
                  <!--< ?php if($groups_data): ?>                  -->
                    <!--< ?php $no = 1; foreach ($groups_data as $k => $v): ?>-->
                      <tr>
                        <td><?php echo 1; ?></td>
                        <td><?php echo "Group1"; ?></td>

                        <!--< ?php if(in_array('updateGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>-->

                        <td>
                        <!--< ?php if(in_array('updateGroup', $user_permission)): ?>-->
                          <a href="<?php echo base_url('group/update/') ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                        <!--< ?php endif; ?>-->

                          
                        <!--< ?php if(in_array('deleteGroup', $user_permission)): ?>-->
                          <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        <!--< ?php endif; ?>-->

                         
                        </td>

                  <!--< ?php endif; ?>-->

                       
                      </tr>
                    <!--< ?php $no++; endforeach ?>-->
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

  <script type="text/javascript">
    $(document).ready(function() {
      $('#groupTable').DataTable({
        'order': []
      });
      $('#groupMainNav').addClass('active');
      $('#manageGroupSubMenu').addClass('active');
    });
  </script>
