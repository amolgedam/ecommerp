
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Loyalty Program
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Loyalty Program</li>
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
            <!--<br>-->
            <!--<div style="float: left">-->
            <!--  <div class="col-md-10 col-sm-10">-->
            <!--      <select name="search" class="form-control">-->
            <!--        <option>---select one---</option>-->
            <!--      </select>-->
            <!--  </div>-->
            <!--</div>-->
            <div style="float:right">
              <a href="<?php echo base_url() ?>loyalty/loyaltyPoint" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Points</a>
            </div>
            <br><br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Invoice No.</th>   <!--    Sales Invoice Number    -->
                      <th>Customer Name</th>    <!--    from ledger    -->
                      <th>Sale Price (Base Price)</th>
                      <th>Total Amount</th>     <!--    Cr To Customer Account    -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--<tr>-->
                    <!--  <td>Oshiya NX</td>-->
                    <!--  <td>1234567890</td>-->
                    <!--  <td>pending</td>-->
                    <!--  <td>1000</td>-->
                    <!--  <td width="170px">-->
                    <!--    <a href="< ?php echo base_url() ?>leads/update" class="btn btn-sm btn-info">-->
                    <!--      <i style="color: white" class="fa fa-edit"></i> Edit-->
                    <!--    </a>-->
                    <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_delete" class="btn btn-sm btn-danger">-->
                    <!--      <i style="color: white" class="fa fa-trash"></i> Delete-->
                    <!--    </a>-->
                    <!--  </td>-->
                    <!--</tr>-->
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


<!--<script>-->
<!--    $(document).ready(function(){-->
        
<!--        var base_url = '< ?php echo base_url(); ?>';-->
<!--        $('#data').DataTable({-->
<!--            "ajax": {-->
<!--                'processing':true,-->
<!--                'serverSide':true,-->
<!--                "searching": true,-->
<!--                url : base_url + "leads/fecthAllData",-->
<!--                'order': []-->
<!--            },-->
<!--        });-->
<!--    });-->
<!--</script>-->
