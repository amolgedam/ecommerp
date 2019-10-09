
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Sales
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Sales</li>
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
              <select name="sales" id="sales">
                <option value="invoice">Sales Invoice</option>
                <option value="pos">POS</option>
                <option value="voucher">Sales Voucher</option>
              </select>
              <a href="<?php echo base_url() ?>sales_invoice/create/invoice" id="btninvoice" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Sales Invoice</a>

              <a href="<?php echo base_url() ?>sales_invoice/create/pos" id="btnpos" class="btn btn-sm btn-info" style="display: none;"><i class="fa fa-plus"></i> Add POS</a>
              <a href="<?php echo base_url() ?>sales_invoice/create/voucher" id="btnvoucher" class="btn btn-sm btn-info" style="display: none;"><i class="fa fa-plus"></i> Add Sales Voucher</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Invoice No.</th>
                      <th>Invoice Date</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Sales Type</th>
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
                    url : base_url + "sales_invoice/fetchAllData",
                    'order': []
                },
                
            });

            $('#sales').on('click', function(){

              var name = $(this).val();

              if(name == 'invoice')
              {
                $('#btninvoice').show();
                $('#btnpos').hide();
                $('#btnvoucher').hide();
              }
              else if(name == 'pos')
              {
                $('#btnpos').show();
                $('#btnvoucher').hide();
                $('#btninvoice').hide();
              }
              else if(name == 'voucher')
              {
                $('#btnvoucher').show();
                $('#btninvoice').hide();
                $('#btnpos').hide();
              }
            });
    });
</script>
