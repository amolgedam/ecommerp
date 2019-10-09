
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contact Details
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contact Details</li>
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
              <select name="contactType" id="contactType">
                <option value="7">Supplier</option>
                <option value="6">Employee</option>
                <option value="5">Customer</option>
              </select>
              <a href="<?php echo base_url() ?>contact/createSupplier" id="btnSupplier" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Supplier</a>
              
              <a href="<?php echo base_url() ?>contact/createCustomer" id="btnCustomer" class="btn btn-sm btn-info" style="display: none;"><i class="fa fa-plus"></i> Add Customer</a>

              <a href="<?php echo base_url() ?>contact/createEmployee" id="btnEmployee" class="btn btn-sm btn-info" style="display: none;"><i class="fa fa-plus"></i> Add Employee</a>
              
            </div>
            <!-- <div style="float:right">
              <a href="< ?php echo base_url() ?>contact/create" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Supplier</a>
            </div> -->
            <br><br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                    <tr>
                      <th>Sr No</th>
                      <th>Name</th>
                      <th>City</th>
                      <th>Contact No.</th>
                      <th>GST No.</th>
                      <th>Email Id</th>
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

      loadData();

      function loadData()
      {
        // var ledger_type = $('#contactType').val();
        
        $('#data').DataTable({
            "ajax": {
                'processing':true,
                'serverSide':true,
                "searching": true,
                url : base_url + "contact/fecthAllData",
                // method: "POST",
                // data: {ledger_type:ledger_type},
                'order': []
            },
        });
      }
        
        


      $('#contactType').on('click', function(){

          var name = $(this).val();

          if(name == '7')
          {
            $('#btnSupplier').show();
            $('#btnCustomer').hide();
            $('#btnEmployee').hide();
          }
          else if(name == '6')
          {
            $('#btnEmployee').show();
            $('#btnCustomer').hide();
            $('#btnSupplier').hide();
          }
          else if(name == '5')
          {
            $('#btnCustomer').show();
            $('#btnEmployee').hide();
            $('#btnSupplier').hide();
          }
      });

    });
</script>



