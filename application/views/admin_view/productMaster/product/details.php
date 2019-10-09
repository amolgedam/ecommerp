
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product</li>
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
<!--             <div style="float:right">
              <a href="< ?php echo base_url() ?>purchase_invoice/create" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Purchase Invoice</a>
            </div> -->
            <input type="hidden" name="item_id" id="item_id" value="<?php echo $sku_code; ?>">
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                    <tr>
                      <th>Barcode Code.</th>
                      <th>SKU Product Name</th>
                      <th>Opening/Purchase Invoice No.</th>
                      <th>Purchase Net Price</th>
                      <th>MRP</th>
                      <th>Quantity</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

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

<script>
    $(document).ready(function(){
        
        var sku_code = $('#item_id').val();
        // alert(sku_code);

        var base_url = '<?php echo base_url(); ?>';
        
            $('#data').DataTable({
                "ajax": {
                    'processing':true,
                    'serverSide':true,
                    "searching": true,
                    data : {sku_code:sku_code},
                    method : "post",
                    url : base_url + "barcode/fetchProductDetails",
                    'order': []
                }, 
            });
    });
</script>

