<!--< ?php print_r($allData); exit; ?>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payment Master
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payment Master</li>
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
                 <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addPaymentType" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Payment</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Payment Type</th>
                    <th>Ledger</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php $no=1; foreach($allData as $rows): ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $rows->payment_name; ?></td>
                          <td><?php echo $rows->ledger_name; ?></td>
                          <td width="200px">
                             <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-id="<?php echo $rows->id ?>" data-name="<?php echo $rows->payment_name ?>" data-lid="<?php echo $rows->ledger_id ?>" ><i class="fa fa-pencil"></i>Edit</a>
                             <?php if($rows->permission != 0): ?>
                               <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteData" data-id="<?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>
                            <?php endif; ?>
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
      <form method="POST" action="<?php echo base_url('payment_master/create') ?>"  enctype="multipart/form-data">
        <div class="modal fade" id="Modal_addPaymentType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Add Payment type
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="col-lg-12 col-md-12">
                      <div>
                          <div>
                            <label>Payment Type</label>
                          </div>
                          <div>
                            <input type="text" name="paymentType" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                      <div>
                          <div>
                            <label>Ledger</label>
                          </div>
                          <div>
                            <select name="ledger" class="form-control">
                                <option value="0">Select Ledger</option>
                                <?php foreach($ledger as $rows): ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                                <?php endforeach; ?>
                            </select>
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
      <form method="POST" action="<?php echo base_url('payment_master/update') ?>" enctype="multipart/form-data">
          <div class="modal fade" id="Modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Store</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      
                      <div class="col-lg-12 col-md-12">
                      <div>
                          <div>
                            <label>Payment Type</label>
                          </div>
                          <div>
                            <input type="text" name="paymentType" class="form-control">
                            <input type="hidden" name="edit_id" class="form-control">
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                      <div>
                          <div>
                            <label>Ledger</label>
                          </div>
                          <div>
                            <select name="ledger" class="form-control">
                                <option value="0">Select Ledger</option>
                              <?php foreach($ledger as $rows): ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                                <?php endforeach; ?>
                            </select>
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
      
     
<form role="form" action="<?php echo base_url('payment_master/delete') ?>" method="post" id="deleteForm">
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
        var lid = $(this).data('lid');
        
        // alert(waiter_id);
        $('#Modal_edit').modal('show');
        $('[name="edit_id"]').val(id);
        $('[name="paymentType"]').val(name);
        $('[name="ledger"]').val(lid);
    });

    $('.deleteData').on('click', function(){

      var id = $(this).data('id');
      $('#deleteModal').modal('show');
      $('[name="id_edit"]').val(id);
    });
    
</script>