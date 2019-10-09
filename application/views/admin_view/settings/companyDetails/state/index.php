

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sate and City
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">State and City</li>
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
            <br>
            <div style="float:right">
                 <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addCategory" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add State</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th>Sr. No</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($state as $rows): ?>
                      <tr>
                        <td width="9%"><?php echo $no; ?></td>
                        <td><?php echo ucwords($rows->country_name); ?></td>
                        <td width="200px">
                          <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-id="<?php echo $rows->id ?>" data-name="<?php echo $rows->country_name ?>" data-name_id="<?php echo $rows->country_id ?>"><i class="fa fa-pencil"></i>Edit</a>
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

        <div class="col-md-7 col-sm-7 col-xs-12">
          <div class="box" style="padding: 5px;">
            <br>
            <div style="float:right">
                 <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSubCategory" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add City</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="18%">Sr. No</th>
                      <th>City</th>
                      <th>State</th>
                      <th width="140px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach($city as $rows): ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo ucwords($rows->country_name); ?></td>
                              <td><?php echo ucwords($rows->city_name); ?></td>
                              <td width="170px">
                                <a href="javascript:void(0);" class="btn btn-sm btn-info editCityData" data-id="<?php echo $rows->id ?>" data-name="<?php echo $rows->city_name ?>" data-state_id="<?php echo $rows->state_id ?>"><i class="fa fa-pencil"></i>Edit</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteCityData" data-id="<?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>
                              </td>
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
  <div class="control-sidebar-bg"></div>
</div>


<script type="text/javascript">
      // alert('hi');
     $('.editData').on('click', function(){

        // alert('hi');
        var id = $(this).data('id');
        var name = $(this).data('name');
        var name_id = $(this).data('name_id');
        // alert(waiter_id);
        $('#editModal').modal('show');
        $('[name="edit_id"]').val(id);
        $('[name="edit_name"]').val(name);
        $('[name="state_id"]').val(name_id);
    });

    $('.deleteData').on('click', function(){

      var id = $(this).data('id');
      $('#deleteModal').modal('show');
      $('[name="id_edit"]').val(id);
    });
    
     $('.editCityData').on('click', function(){

        // alert('hi');
        var id = $(this).data('id');
        var name = $(this).data('name');
        var state_id = $(this).data('state_id');
        // alert(state_id);
        $('#Modal_editSubategory').modal('show');
        $('[name="edit_id"]').val(id);
        $('[name="edit_name"]').val(name);
        $('[name="edit_state"]').val(state_id);
    });
    
    $('.deleteCityData').on('click', function(){

      var id = $(this).data('id');
      $('#deleteCityModal').modal('show');
      $('[name="id_edit"]').val(id);
    });
</script>


<form role="form" action="<?php echo base_url('state/create') ?>" method="post" id="createForm">
  <div class="modal fade" id="Modal_addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
            Add State
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12">
                <div>
                  <label>State Name</label>
                </div>
                <div>
                  <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div>
                  <label>State ID</label>
                </div>
                <div>
                  <input type="text" name="state_id" class="form-control">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <input type="submit" name="save" value="Submit" class="btn btn-success">
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Edit Category Modal -->
<form role="form" action="<?php echo base_url('state/update') ?>" method="post" id="createForm">
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
            Edit State
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div>
                <label>State Name</label>
              </div>
              <div>
                <input type="hidden" name="edit_id" class="form-control">
                <input type="text" name="edit_name" class="form-control">
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div>
                  <label>State ID</label>
                </div>
                <div>
                  <input type="text" name="state_id" class="form-control">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <input type="submit" name="save" value="Submit" class="btn btn-success">
        </div>
      </div>
    </div>
  </div>
</form>

<form role="form" action="<?php echo base_url('state/delete') ?>" method="post" id="deleteForm">
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

      <!-- edit Sub Category Modal -->
      <form method="POST" action="<?php echo base_url('state/createCity') ?>" enctype="multipart/form-data">
        <div class="modal fade" id="Modal_addSubCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Add City
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                      <div class="col-md-5 col-sm-5 col-xs-12">
                          <div>
                            <label>State Name</label>
                          </div>
                          <div>
                            <select name="state" class="form-control">
                              <?php foreach($state as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo ucwords($rows->country_name); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                          <div>
                            <label>City Name</label>
                          </div>
                          <div>
                            <input type="text" name="name" class="form-control">
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="submit" name="save" value="Submit" class="btn btn-success">
                </div>
              </div>
            </div>
          </div>
      </form>


      <!-- edit Sub Category Modal -->
      <form method="POST" action="<?php echo base_url('state/updateCity') ?>"  enctype="multipart/form-data">
        <div class="modal fade" id="Modal_editSubategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Edit City
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                          <div>
                            <label>State Name</label>
                          </div>
                          <div>
                            <select name="edit_state" class="form-control">
                              <?php foreach($state as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo ucwords($rows->country_name); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                          <div>
                            <label>City Name</label>
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
                    <input type="submit" name="save" value="Submit" class="btn btn-success">
                </div>
              </div>
            </div>
          </div>
      </form>
      
      <form role="form" action="<?php echo base_url('state/deleteCity') ?>" method="post" id="deleteForm">
      <div class="modal fade" id="deleteCityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

