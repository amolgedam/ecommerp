
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Production Manage
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Manage Production</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <h4>Alteration</h4>
              <hr>
              
              <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Invoice</label>
                    <select name="sales_invoice" id="salesinvoice_id" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($salesinvoice as $rows): ?>
                        <option value="<?php echo $rows['id'] ?>"><?php echo $rows['inventory_no'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <br>
                    <a href="javascript:void(0);" id="search" class="btn btn-sm btn-info">Search</a>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <div class="control-sidebar-bg"></div>

</div>

<script type="text/javascript">
  var base_url = '<?php echo base_url(); ?>';

  $('#search').on('click', function(){

      var salesinvoice_id = $('#salesinvoice_id').val();
      // alert(salesinvoice_id);
      if(salesinvoice_id == '0')
      {
        alert('Select Sales Invoice No');
      }
      else
      {
        $(location).attr('href',base_url+'alternate/create/'+salesinvoice_id);
      }
  });
</script>
