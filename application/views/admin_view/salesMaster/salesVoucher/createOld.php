
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Sales Voucher
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Sales Voucher</li>
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

    <form method="post" action="<?php echo base_url() ?>sales_voucher/create">
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
                    <label>Invoice Date</label>
                      <input type="hidden" name="salesinvoicetype" value="<?php echo $salesinvoicetype ?>" >
                      <input type="hidden" name="order_no" value="<?php echo $opening_no; ?>" class="form-control">
                    <input type="date" name="date" class="form-control" required>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Account</label>
                    <select name="saccount" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerPurAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Account</label>
                    <select name="account" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Salesman</label>
                    <select name="salesman" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerSalesmanAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div> 

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Shipping Details</label>
                    <input type="text" name="shipping_details" class="form-control">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Shipping Type</label>
                    <input type="text" name="shipping_type" class="form-control">
                  </div>
                </div> 
               
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Division</label>
                    <select name="division" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($division as $rows): ?>
                       <option value="<?php echo $rows->id; ?>"><?php echo $rows->division_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Branch</label>
                    <select name="branch" class="form-control">
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
                    <select name="location" class="form-control">
                      <option value="0">---Select One---</option>
                        <?php foreach($location as $rows): ?>
                          <option value="<?php echo $rows->id; ?>"><?php echo $rows->location_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Delivery Memo</label>
                     <select name="delivery_memo" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($deliveryMemo as $rows): ?>
                        <option value="<?php echo $rows['id']; ?>"><?php echo $rows['delivery_no']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sale Type</label>
                    <select name="sale_type" class="form-control">
                      <option value="0">---select one---</option>
                      <?php foreach($ledgerPurType as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->ledger_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Product Count</label>
                    <input type="text" name="no_product" id="no" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Base Total</label>
                    <input type="text" name="base_total" id="bp" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Discount</label>
                    <input type="text" name="total_discount" id="dis" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Gross Total</label>
                    <input type="text" name="gross_total" id="gp" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Tax</label>
                    <input type="text" name="total_tax" id="tx" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Amount</label>
                    <input type="text" name="total_amt" id="amt" class="form-control" id="amt" readonly>
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
                    <input type="text" name="total_invoice" id="invoice_value" class="form-control" readonly>
                  </div>
                </div>                
            </div>

              <hr>
              <div align="right">

                <a href="<?php echo base_url() ?>sales_voucher/create" class="btn btn-info">New Invoice</a>
              
               <a href="<?php echo base_url(); ?>ledger_master/create" class="btn btn-primary">Create Ledger</a>

              <a href="#" class="btn btn-info">Hold</a>
              <a href="#" class="btn btn-info">Make Payment</a>
              
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
                      <!-- <input list="searchProduct" class="form-control" id="product" name="product" autocomplete="off">
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

                  <div class="col-md-1 col-sm-1 col-xs-12">
                    <div>
                      <label>Gross Price</label>
                      <input type="text" name="gprice" id="gprice" class="form-control" readonly>

                      <input type="hidden" name="hgprice" id="hgprice" class="form-control" readonly>
                      

                      <input type="hidden" name="bprice" id="bprice" class="form-control" readonly>
                      <input type="hidden" name="hbprice" id="hbprice" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-md-1 col-sm-1 col-xs-6">
                    <div>
                      <label>Unit</label>
                      <select name="unit" id="unit" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($unit as $rows): ?>
                          <option value="<?php echo $rows->id; ?>"><?php echo $rows->unit; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                   <div class="col-md-1 col-sm-1 col-xs-12">
                    <div>
                      <label>Discount</label>
                      <input type="text" name="discount" onkeyup="getGrossPrice();" value="0" id="discount" class="form-control">
                      <input type="hidden" name="discountValue" value="0" id="discountValue" class="form-control">
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
                      <input type="hidden" name="htotal_tax" id="htotal_tax" value="0" class="form-control" readonly="">
                    </div>
                  </div>
                  <div class="col-md-1 col-sm-1 col-xs-6">
                    <div>
                      <label>Total</label>
                      <input type="text" name="total" id="total" class="form-control" readonly="">
                      <input type="hidden" name="htotal" id="htotal" class="form-control" readonly="">
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
                        <th>MRP</th>
                        <th>Gross Price</th>
                        <!-- <th>Unit</th> -->
                        <th>Discount</th>
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
  // $this->load->view('admin_view/includes/modals/shippingType');
  // $this->load->view('admin_view/includes/modals/createLedger');
?>


<script type="text/javascript">
  var base_url = '<?php echo base_url(); ?>';

  function getGrossPrice()
  {
    var qty = parseFloat($('#qty').val());
    var rate = parseFloat($('#rate').val());

    var gprice = qty * rate;
    // alert(gprice);
    $('#gprice').val(gprice);
    $('#hgprice').val(gprice);

    $('#total').val(gprice);
    $('#htotal').val(gprice);

    getTotal();
  }

  function getGstCal()
  {
    var gst = $('#gst').val();
    
    $.ajax({

        url : base_url + 'gst/fetchAllDataByID',
        method : "POST",
        data : {gst_id:gst},
        dataType: 'json',
        success:function(response){

          $('#gstvalue').val(response.gst_name);

          // var gst = parseFloat(response.sgst) + parseFloat(response.cgst) + parseFloat(response.igst);
          var sgst = parseInt(response.sgst);
          var cgst = parseInt(response.cgst);
          var igst = parseInt(response.igst);
          var totgst = sgst + cgst + igst;

          // var total = parseFloat($('#total').val());
          // var gstvalue = (total * gst) / 100 ;
          // $('#total_tax').val(gstvalue);

          var mrp = parseFloat($('#hgprice').val());

          var mytot = (mrp * totgst);
          var tot = 100 + totgst;
          var gstvalue = mytot / tot;

          var gst = (gstvalue).toFixed(3); 

          $('#total_tax').val(gst);
          $('#htotal_tax').val(gst);

          var gprice = mrp - gst;

          $('#gprice').val(gprice);
          $('#hgprice').val(gprice);

          getTotal();
          loadCount();

        }

    });
  }

  function getTotal()
  {
    var gprice = parseFloat($('#hgprice').val());
    var discount = parseFloat($('#discount').val());
    var total_tax = parseFloat($('#total_tax').val());

    var discountValue = (gprice * discount) / 100;

    $('#discountValue').val(discountValue);

    var newpricevalue =  gprice - discountValue;
    var newprice = (newpricevalue).toFixed(3);
    $('#gprice').val(newprice);

    var oldGst = parseFloat($('#htotal_tax').val());
    var newGst = (oldGst * discount) / 100;
    var gstvalue = oldGst - newGst;
    var gstamount = (gstvalue).toFixed(3);
    // console.log(gstamount);
    $('#total_tax').val(gstamount);


    var oldFprice = parseFloat($('#htotal').val());
    var newFprice = (oldFprice * discount) /100;
    var fprice = oldFprice - newFprice;

    $('#total').val(fprice);
  }
</script>

<script type="text/javascript">
  var base_url = '<?php echo base_url(); ?>';
  
  function addProduct()
  {
      var product = $('#product').val();
      var qty = $('#qty').val();
      var rate = $('#rate').val();
      var unit = $('#unit').val();
      var discount = $('#discount').val();
      var discountValue = $('#discountValue').val();

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
          html += '<td>';
            html += '<input type="text" name="grossplist[]" class="gpClass" value="'+rate+'" readonly>';
          html += '</td>';
          // html += '<td>';
            html += '<input type="hidden" name="unitdemo[]" value="'+unit+'" readonly>';
          // html += '</td>';
          html += '<td>';
            html += '<input type="text" name="discountlist[]" class="discountClass" value="'+discount+'" readonly>';
            html += '<input type="hidden" name="discountVlist[]" value="'+discountValue+'" readonly>';
          html += '</td>';
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

          loadCount();

          $('#product').val('');
          $('#qty').val('0');
          $('#rate').val('0');
          $('#gprice').val('0');
          $('#unit').val('0');
          $('#discount').val('0');
          $('#gst').val('0');
          $('#gstvalue').val('0');
          $('#total_tax').val('');
          $('#total').val('');
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
        var pno=0; var bprice=0; var discount=0; var gp=0; var tx=0; var amt=0;
        
        $('.countQuantity').each(function() {
            
            pno += parseInt($('.countQuantity').val(), 10);
        });
        $('#no').val(pno);
        $('#cpno').val(pno);
        
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
        var totTax = (tx).toFixed(3);
        $('#tx').val(totTax);
        
        
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