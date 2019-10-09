

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Discount Master
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Discount Master</li>
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
                 <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addDiscount" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Discount</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                    <tr>
                      <th>Sr No</th>
                      <th>Discount Code</th>
                      <th>Discount(%)</th>
                      <th>Max Discount Allowed</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no=1; foreach($discount as $rows): ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $rows->discount_code; ?></td>
                          <td><?php echo $rows->discount; ?></td>
                          <td><?php echo $rows->max_discount; ?></td>
                          <td> <label class="label <?php echo ($rows->status == 'active') ? "label-success" : "label-danger" ?>"><?php echo $rows->status ?></label></td>
                          <td width="170px">
                                <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-id="<?php echo $rows->id ?>" data-code="<?php echo $rows->discount_code ?>" data-dis="<?php echo $rows->discount ?>" data-maxdis="<?php echo $rows->max_discount ?>" data-promo="<?php echo $rows->promo_code ?>" data-remark="<?php echo $rows->remark ?>" data-status="<?php echo $rows->status ?>" ><i class="fa fa-pencil"></i>Edit</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteData" data-id="<?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>
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
      <form method="POST" action="<?php echo base_url('discount/create') ?>" enctype="multipart/form-data">
        <div class="modal fade" id="Modal_addDiscount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Add Discount
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-lg-12 col-md-12">
                     
                      <div>
                          <div>
                            <label>Discount Code</label>
                          </div>
                          <div>
                            <input type="text" name="discount_code" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Discount(%)</label>
                          </div>
                          <div>
                            <input type="text" name="discount" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Max Discount Allowed</label>
                          </div>
                          <div>
                            <input type="text" name="max_discount" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Promo Code</label>
                          </div>
                          <div>
                            <input type="text" name="promo_code" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Remark</label>
                          </div>
                          <div>
                            <input type="text" name="remark" class="form-control">
                          </div>
                      </div>
                      <div>
                        
                          <div>
                            <label>Status</label>
                          </div>
                          <div>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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
      
      
      
<form role="form" action="<?php echo base_url('discount/delete') ?>" method="post" id="deleteForm">
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
      <form method="POST" action="<?php echo base_url('discount/update') ?>"  enctype="multipart/form-data">
          <div class="modal fade" id="Modal_editDiscount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Discount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="row">
                    <div class="col-lg-12 col-md-12">
                     
                      <div>
                          <div>
                            <label>Discount Code</label>
                          </div>
                          <div>
                              <input type="hidden" name="edit_id" class="form-control">
                            <input type="text" name="editdiscount_code" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Discount(%)</label>
                          </div>
                          <div>
                            <input type="text" name="editdiscount" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Max Discount Allowed</label>
                          </div>
                          <div>
                            <input type="text" name="editmax_discount" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Promo Code</label>
                          </div>
                          <div>
                            <input type="text" name="editpromo_code" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Remark</label>
                          </div>
                          <div>
                            <input type="text" name="editremark" class="form-control">
                          </div>
                      </div>
                      <div>
                        
                          <div>
                            <label>Status</label>
                          </div>
                          <div>
                            <select name="editstatus" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                          </div>
                      </div>
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
      
      
      
      <script type="text/javascript">
          var base_url = "<?php echo base_url(); ?>";

            $('.editData').on('click', function(){

                // alert('hi');
                var id = $(this).data('id');
                var code = $(this).data('code');
                var dis = $(this).data('dis');
                var maxdis = $(this).data('maxdis');
                var promo = $(this).data('promo');
                var remark = $(this).data('remark');
                var status = $(this).data('status');
                
                // alert(waiter_id);
                $('#Modal_editDiscount').modal('show');
                
                $('[name="edit_id"]').val(id);
                $('[name="editdiscount_code"]').val(code);
                $('[name="editdiscount"]').val(dis);
                $('[name="editmax_discount"]').val(maxdis);
                $('[name="editpromo_code"]').val(promo);
                $('[name="editremark"]').val(remark);
                $('[name="editstatus"]').val(status);
            });
        
            $('.deleteData').on('click', function(){
        
              var id = $(this).data('id');
              $('#deleteModal').modal('show');
              $('[name="id_edit"]').val(id);
            });
    </script>