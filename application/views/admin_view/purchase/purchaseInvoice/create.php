
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Purchase Invoice
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Purchase Invoice</li>
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
            <div class="box-body">
                <form method="post" action="<?php echo base_url(); ?>purchase_invoice/create">
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Invoice No</label>
                      <input type="text" name="pinvoice_no" class="form-control" required>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Invoice Date</label>
                      <input type="text" name="invoice_date" class="form-control" required id="mydate" />
                      <!--<input type="text" name="invoice_date" class="form-control" required value="< ?php echo date("m/d/Y"); ?>">-->
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Entry Date</label>
                        <input type="text" name="entry_date" class="form-control" required id="mydate1" />
                      <!--<input type="date" name="entry_date" class="form-control" required>-->
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Order No.</label>
                      <input type="hidden" name="order_id" id="order_id"/>
                      
                      <select name="porder_no" id="porder_no" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($purchaseorderData as $rows): ?>
                            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['order_no'];  ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div> 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Account</label>
                      <select name="paccount" id="paccount" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($ledgerPurSalesAccount as $rows): ?>
                              
                              <?php if($this->session->userdata['wo_company'] == $rows->company_id){ ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $lastData['paccount'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                              <?php } ?>

                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Account</label>
                      <select name="account" id="account" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($ledgerAccount as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $lastData['account'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Payment Type</label>
                      <select name="ptype" id="ptype" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($paytype as $rows): ?>
                          <option value="<?php echo $rows->id; ?>" <?php echo $lastData['ptype'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->payment_name; ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Due Day</label>
                      <input type="text" name="due_day" id="dueDay" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Due Date</label>
                      <input type="text" name="due_date" id="dueDate" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Shiping Type</label>
                      <input type="text" name="stype" class="form-control">
                        <!-- <div class="col-md-2">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addShipingType" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                        </div> -->
                        <!--<div class="col-md-12">-->
                        <!--    <select name="stype" id="stype" class="form-control">-->
                              <!-- <option value="0">---Select One---</option>
                              < ?php foreach($shiptype as $rows): ?>
                                <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->shipping_name; ?></option>
                              < ?php endforeach; ?> -->
                        <!--    </select>-->
                        <!--</div>-->
                    </div>
                  </div>  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Shiping Tracking No.</label>
                      <input type="text" name="stracking_no" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Division</label>
                      <select name="division" id="division" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($division as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $lastData['division'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->division_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  
                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Branch</label>
                      <select name="branch" id="branch" class="form-control">
                        <option value="0">---Select One---</option>
                        < ?php foreach($branch as $rows): ?>
                              <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->branch_name; ?></option>
                          < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Location</label>
                      <select name="location" id="location" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($location as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $lastData['location'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->location_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Type</label>
                      <select name="purchase_type" id="purchase_type" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($taxAndDuties as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $lastData['purchase_type'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Gross Amount</label>
                      <input type="text" name="gamt" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Tax</label>
                      <input type="text" name="total_tax" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Adjustment(+/-)</label>
                      <input type="text" name="adjustment" value="0" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Invoice</label>
                      <input type="text" name="total_invoice" class="form-control" readonly="">
                    </div>
                  </div>             
              </div>

              <hr>
              <div align="right">
                <a href="<?php echo base_url() ?>purchase_invoice/create" class="btn btn-default">New Invoice</a>
                <a href="<?php echo base_url(); ?>ledger_master/create" class="btn btn-primary">Create Ledger</a>
                
                <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_createLedger" class="btn btn-primary">Create Ledger</a> -->
                <input type="submit" name="save" value="Save" class="btn btn-success">
              </div>
                </form>
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

<!-- FOR SHIPPING MODAL OPEN -->

<?php
  $this->load->view('admin_view/templates/modals/shippingType');
  // $this->load->view('admin_view/templates/modals/createLedger');
?>
<link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


<script>
    var base_url = '<?php echo base_url(); ?>';
    // alert(base_url);
    
    $("#mydate").datepicker().datepicker("setDate", new Date());
    $("#mydate1").datepicker().datepicker("setDate", new Date());
    
    $('#porder_no').on('change', function(){
        
       var porder_id = $(this).val();
        //   alert(porder_no);
        $.ajax({
            
           url: base_url + 'purchase_order/fetchAllDataByIDStatus',
           type: "POST",
           data: {porder_id:porder_id},
           dataType: 'json',
           success:function(response){
               
            //   console.log(response);
            $('#order_id').val(response.id);
               $('#paccount').val(response.purac_id);
               $('#account').val(response.ledger_id);
               $('#ptype').val(response.purtype_id);
            //   $('#stype').val(response.);
               $('#division').val(response.division_id);
               $('#branch').val(response.branch_id);
               $('#location').val(response.location_id);
               $('#purchase_type').val(response.purtype_id);
            }
        });
    
    });
    
    currentDate();
    
    function currentDate()
    {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        
        var yyyy = today.getFullYear();
        if (dd < 10) {
          dd = '0' + dd;
        } 
        if (mm < 10) {
          mm = '0' + mm;
        } 
        var today = yyyy + '/' + mm + '/' + dd;
        document.getElementById('dueDate').value = today;
    }
    
    
    
    // function for adding 0 prefix when date or month
    // is a single digit
    function addPrefix(str) {
      return ('0' + str).slice(-2)
    }
    
    $('#dueDay').on('change', function(){
        
        $('#dueDate').val('');
        
        var d = new Date();
        var newDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
        // alert(newDate);
        
        
        // var val = $(this).val();
        if (newDate) {
            // parse the date string
            var set = new Date(newDate);
        
            // update the date value, for adding days
            set.setDate(set.getDate() + Number($(this).val()));
        
            // generate the result format and set value
            $("#dueDate").val([addPrefix(set.getDate()), addPrefix(set.getMonth() + 1), set.getFullYear()].join('/'));
        }
          
          
        // var dd = today.getDate() + parseInt($(this).val());
        // var mm = today.getMonth() + 1; //January is 0!
        
        // var yyyy = today.getFullYear();
        // if (dd < 10) {
        //   dd = '0' + dd;
        // } 
        // if (mm < 10) {
        //   mm = '0' + mm;
        // } 
        // var today = yyyy + '/' + mm + '/' + dd;
        // document.getElementById('dueDate').value = today;
        
        
        
        
        // var someDate = new Date();
        // var numberOfDaysToAdd = $(this).val();
        
        
        // someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
        
        // var dd = someDate.getDate();
        // var mm = someDate.getMonth();
        // var y = someDate.getFullYear();
        
        // var someFormattedDate = dd + '/'+ mm + '/'+ y;
        
        // $('#dueDate').val(someFormattedDate);
    });
</script>


<script type="text/javascript">

    var base_url = '<?php echo base_url(); ?>';

    shippingType();
  
    function shippingType()
    {
      // alert('hi');
        var html = '';
        $('#stype').html('');
        $.ajax({
              
              url: base_url + 'shipping_master/fetchData/',
              type: 'post',
              dataType: 'json',
              success:function(response){

                    html += '<option value="0">---Select One---</option>';

                  
                  // console.log(response);
                  $.each(response, function(index, value) {
                    
                    html += '<option value="'+value.id+'">'+value.shipping_name+'</option>';
                  });
                  
                  $('#stype').append(html);
              }
        });
    }




</script>


