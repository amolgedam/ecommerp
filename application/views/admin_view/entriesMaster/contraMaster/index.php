

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contra Entries
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contra Entries</li>
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
                  <a href="<?php echo base_url() ?>contraentry/create" class="btn btn-primary">
                    <i class="fa fa-plus-square"></i>&nbsp;Add Contra Entry
                  </a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Date</th>
                      <th>From Payment Type</th>
                      <th>To Payment Type</th>
                      <th>Particular</th>
                      <th>Contra Entry No.</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      <td>23/01/2019</td>
                      <td>23/01/2019</td>
                      <td>00000178</td>
                      <td>23/01/2019</td>
                      <td>1635.11</td>
                      <td>Hold</td>
                      <td width="240px">
                        <a href="< ?php echo base_url() ?>contraentry/update" class="btn btn-sm btn-info">
                          <i style="color: white" class="fa fa-edit"></i> Edit
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_deleteSKU" class="btn btn-sm btn-danger">
                          <i style="color: white" class="fa fa-trash"></i> Delete
                        </a>
                        <a href="javascript:void(0);" class="btn btn-sm btn-info">
                          <i style="color: white" class="fa fa-trash"></i> Print
                        </a>
                      </td>
                    </tr> -->
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


<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url(); ?>';
        
            $('#data').DataTable({
                "ajax": {
                    'processing':true,
                    'serverSide':true,
                    "searching": true,
                    url : base_url + "contraentry/fetchAllData",
                    'order': []
                }, 
            });
    });
</script>
