
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Purchase Voucher
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Purchase Voucher</li>
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

    <form method="post" action="<?php echo base_url(); ?>purchase_voucher/create">

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Voucher No</label>
                      <input type="text" name="pinvoice_no" class="form-control" required>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Invoice Date</label> 
                      <input type="text" name="date" class="form-control" required id="mydate" />
                      <!--<input type="date" name="date" class="form-control" required>-->
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
                      <!--<div class="row">-->
                        <!--<div class="col-md-2">-->
                        <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addShipingType" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                      <!--  <div class="col-md-12">-->
                      <!--      <select name="stype" id="stype" class="form-control">-->
                      <!--        <option value="0">---Select One---</option>-->
                      <!--        < ?php foreach($shiptype as $rows): ?>-->
                      <!--          <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->shipping_name; ?></option>-->
                      <!--        < ?php endforeach; ?>-->
                      <!--      </select>-->
                      <!--  </div>-->
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
                      <label>Gross Total</label>
                      <input type="text" name="gross_total" id="bp" class="form-control" readonly>
                    </div>
                  </div>
                  
                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Gross Total</label>
                      <input type="text" name="gross_total" id="gp" class="form-control" readonly>
                    </div>
                  </div> -->
                  <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Tax</label>
                    <input type="text" name="total_tax1" id="tx" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Amount</label>
                    <input type="text" name="total_amt" class="form-control" id="amt" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Adjustment(+/-)</label>
                    <input type="text" name="adjustment" id="adj" value="0" class="form-control">
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Invoice Value</label>
                    <input type="text" name="total_invoice" id="invoice_value" class="form-control" readonly="">
                  </div>
                </div>             
              </div>

              <hr>
              <div align="right">
                <a href="<?php echo base_url() ?>purchase_voucher/create" class="btn btn-default">New Invoice</a>

                <a href="<?php echo base_url(); ?>ledger_master/create" class="btn btn-primary">Create Ledger</a>
                
                <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_createLedger" class="btn btn-primary">Create Ledger</a>-->
                <input type="submit" name="save" value="Save" class="btn btn-success">
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

                <div class="row">

                  <div class="col-md-2 col-sm-2 col-xs-6">
                    <div>
                      <label>Product Name</label>
                      <input type="text" name="product" id="product" class="form-control" autocomplete="off">
                     <!--  <input list="searchProduct" class="form-control" id="product" name="product" autocomplete="off">
                      <datalist id="searchProduct">
                        < ?php foreach($productData as $rows): ?>
                          <option value="< ?php echo $rows->product_name; ?>">
                        < ?php endforeach; ?>
                      </datalist> -->
                    </div>
                  </div>
                
                  <!-- <div class="col-md-2 col-sm-2 col-xs-6">
                    <div>
                      <label>Product Name</label>
                      <input type="text" name="product_name" class="form-control">
                    </div>
                  </div> -->
                  
                  <div class="col-md-1 col-sm-1 col-xs-12">
                    <div>
                      <label>Quantity</label>
                      <input type="text" name="qty" id="qty" onkeyup="getGrossPrice();" class="form-control" value="0">
                    </div>
                  </div>

                  <div class="col-md-1 col-sm-1 col-xs-12">
                    <div>
                      <label>Rate</label>
                      <input type="text" name="rate" id="rate" onkeyup="getGrossPrice();" value="0" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Gross Price</label>
                      <input type="text" name="gprice" id="gprice" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-2 col-xs-6">
                    <div>
                      <label>GST</label>
                      <input type="hidden" name="gstvalue" id="gstvalue">

                      <select name="gst" id="gst" class="form-control" onchange="getGstCal();">
                        <option value="0">---Select One---</option>
                        <?php foreach($gst as $rows): ?>
                          <option value="<?php echo $rows->id; ?>"><?php echo $rows->gst_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-1 col-sm-1 col-xs-6">
                    <div>
                      <label>Total Tax</label>
                      <input type="text" name="total_tax" id="total_tax" value="0" class="form-control" readonly="">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-6">
                    <div>
                      <label>Total</label>
                      <input type="text" name="total" id="total" class="form-control" readonly="">
                    </div>
                  </div>
                
                  <div class="col-md-1 col-sm-1 col-xs-6">
                    <div>
                      <br>
                      <a href="javascript:void(0);" onclick="addProduct();" class="btn btn-sm btn-success">Add</a>
                    </div>
                  </div>
                 
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <div class="row">

                <div class="table-responsive">
                  <table class="table" id="productDataTable">
                    <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <!-- <th>Gross Price</th> -->
                        <!-- <th>Unit</th> -->
                        <!-- <th>Discount</th> -->
                        <th>GST</th>
                        <th>Total Tax</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="productTable">
                      
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

    </form>

    <!-- /.content -->
  </div>
  <div class="control-sidebar-bg"></div>

</div>

<!-- FOR SHIPPING MODAL OPEN -->

<?php
  $this->load->view('admin_view/templates/modals/shippingType');
  $this->load->view('admin_view/templates/modals/createLedger');
?>

<link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

<script>
    
    $("#mydate").datepicker().datepicker("setDate", new Date());
    $("#mydate1").datepicker().datepicker("setDate", new Date());
    
    var base_url = '<?php echo base_url(); ?>';
    
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
          
    });
</script>

<script type="text/javascript">
  var base_url = '<?php echo base_url(); ?>';
  function addProduct()
  {
      var product = $('#product').val();
      var qty = $('#qty').val();
      var rate = $('#rate').val();
      var gst = $('#gst').val();
      var gstvalue = $('#gstvalue').val();

      if(product == '' || qty == '' || rate == '')
      {
        alert('Please Fill Required Data');
      }
  }

  function getGrossPrice()
  {
      var qty = parseFloat($('#qty').val());
      var rate = parseFloat($('#rate').val());

      var gprice = qty * rate;
      // alert(gprice);
      $('#gprice').val(gprice);

      getTotal();
  }

  function getTotal()
  {
    var gprice = parseFloat($('#gprice').val());
    // var discount = parseFloat($('#discount').val());
    var total_tax = parseFloat($('#total_tax').val());

    $('#total').val( gprice + total_tax);
  }

  function getGstCal()
  {
    var gst = $('#gst').val();
    
    if(gst == '0')
    {
        $('#total_tax').val('0');

        getTotal();
    }
    else
    {
        $.ajax({

            url : base_url + 'gst/fetchAllDataByID',
            method : "POST",
            data : {gst_id:gst},
            dataType: 'json',
            success:function(response){

              $('#gstvalue').val(response.gst_name);

              // console.log(response);
              
                  var gst = parseFloat(response.sgst) + parseFloat(response.cgst) + parseFloat(response.igst);

                  var total = parseFloat($('#gprice').val());

                  var gstvalue = (total * gst) / 100 ;

                  $('#total_tax').val(gstvalue);

                  getTotal();
              
            }

        });
    }
  }
</script>


<script type="text/javascript">
  var base_url = '<?php echo base_url(); ?>';
  
  function addProduct()
  {
      var product = $('#product').val();
      var qty = $('#qty').val();
      var rate = $('#rate').val();
      var gst = $('#gst').val();
      var gstvalue = $('#gstvalue').val();

      var total_tax = $('#total_tax').val();
      var total = $('#total').val();

      if(product != '' && qty != '0' && total !='0')
      {
        var table = $("#productTable");
        var count_table_tbody_tr = $("#productTable tr").length;
        var row_id = count_table_tbody_tr + 1;

        // alert(table);
        // alert(count_table_tbody_tr);
        // alert(row_id);
        // console.log(row_id);
        
        var html = '';

        html += '<tr id="row_'+row_id+'">';
          html += '<td>';
            html += '<input type="text" name="productlist[]" value="'+product+'" readonly>';
            html += '<input type="hidden" name="plist[]" value="1" class="countQuantity" readonly>';
          html += '</td>';
          html += '<td>';
            html += '<input type="text" name="qtylist[]" value="'+qty+'" readonly >';
          html += '</td>'; 
          html += '<td>';
            html += '<input type="text" name="mrplist[]" value="'+rate+'" class="bpclass">';
          html += '</td>';
          // html += '<td>';
          //   html += '<input type="text" name="grossplist[]" class="gpClass" value="'+rate+'" readonly>';
          // html += '</td>';
      
          html += '<td>';
            html += '<input type="hidden" name="gstid[]" value="'+gst+'" readonly>';
            html += '<input type="text" name="gstname[]" value="'+gstvalue+'" readonly>';
          html += '</td>';
          html += '<td>';
            html += '<input type="text" name="taxlist[]" class="txClass" value="'+total_tax+'" readonly>';
          html += '</td>';
          html += '<td>';
            html += '<input type="text" name="totlist[]" class="finalClass" value="'+total+'" readonly>';
          html += '</td>';
          html += '<td>';
            html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
          html += '</td>';
        html += '</tr>';

          $('#productTable').append(html);

        $('#product').val('');
        $('#qty').val('');
        $('#rate').val('');
        $('#gst').val('0');
        $('#gstvalue').val();

        $('#total_tax').val('0');
        $('#total').val('');

          loadCount();
      }
      else
      {
        alert('Please Fill Required Data');
      }

  }

  $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
          loadCount();
    });
</script>


<script>
    var sum = 1;
    var baseprice = 0;
    function loadCount()
    {
        var bprice=0; var discount=0; var gp=0; var tx=0; var amt=0;
        // var pno=0; 
        // $('.countQuantity').each(function() {
            
        //     pno += parseInt($('.countQuantity').val(), 10);
        // });
        // $('#no').val(pno);
        // $('#cpno').val(pno);
        
        $('.bpclass').each(function() {
            
            // console.log($(this).val());
            bprice += parseFloat($(this).val(), 10);
        });
        $('#bp').val(bprice);

        // console.log(bprice);

        
        $('.discountClass').each(function() {
            
            discount += parseFloat($(this).val(), 10);
        });
        $('#dis').val(discount);
        
        $('.gpClass').each(function() {
            
            gp += parseFloat($(this).val(), 10);
        });
        $('#gp').val(gp);
        

        $('.txClass').each(function() {
            
            tx += parseFloat($(this).val(), 10);
        });
        $('#tx').val(tx);
        
        
        $('.finalClass').each(function() {
            
            amt += parseFloat($(this).val(), 10);
        });
        $('#amt').val(amt);
        $('#invoice_value').val(amt);
    }
    
    $('#adj').on('keyup', function(){
        
       var adj = parseFloat($(this).val());
       var amt = parseFloat($('#amt').val());
       
       var invoice_value = amt - adj;
       
       $('#invoice_value').val(invoice_value);
    });
</script>



