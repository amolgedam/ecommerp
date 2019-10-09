<!-- < ?php echo $sales_account; exit(); ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Exchange
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales Exchange</li>
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

    <form method="post" action="<?php echo base_url() ?>sales_exchange/create">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
              <div class="row">
                
                <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Exchange No</label> -->
                    <input type="hidden" name="exchange_no" value="<?php echo $orderNo; ?>" class="form-control" readonly>
                  <!-- </div>
                </div> -->
                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Original Invoice No</label>
                    <!-- Sales invoice or barcode number -->
                    <input type="text" name="number" value="<?php echo $number; ?>" class="form-control" readonly>
                    <input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo $id; ?>" class="form-control" readonly>
                  </div>
                </div>

                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Order No</label>
                    <select name="sales_order_no" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($salesorder as $rows): ?>
                        <option value="<?php echo $rows['id']; ?>"><?php echo $rows['order_no']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Account</label>
                    <select name="saccount" class="form-control">
                      <option value="0">---Select One---</option>

                      <?php foreach($ledgerPurAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $sales_account == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
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
                        <option value="<?php echo $rows->id; ?>" <?php echo $account == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Invoice Date</label>
                    <input type="date" name="date" value="<?php echo $date ?>" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Salesman</label>
                    <select name="salesman" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerSalesmanAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $salesman == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div> 
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Division</label>
                    <select name="division" class="form-control">
                      <option value="0">Select Division</option>
                      <?php foreach($division as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $division1 == $rows->id ? "selected" : ""; ?> ><?php echo $rows->division_name; ?></option>
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
                        <option value="< ?php echo $rows->id; ?>" < ?php echo $branch1 == $rows->id ? "selected" : ""; ?>>< ?php echo $rows->branch_name; ?></option>
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
                        <option value="<?php echo $rows->id; ?>" <?php echo $location1 == $rows->id ? "selected" : ""; ?> ><?php echo $rows->location_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Memo</label>
                    <select name="sales_memo" class="form-control">
                      <option value="0">---Select One---</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sale Type</label>
                    <select name="sale_type" class="form-control">
                      <option value="0">---select one---</option>
                      <?php foreach($ledgerPurType as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $sale_type == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
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
                          <input type="text" name="total_amt" class="form-control" id="amt" readonly>
                        </div>
                      </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Adjustment(+/-)</label>
                    <input type="text" name="adjustment" value="0" id="adj" class="form-control">
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
                <input type="submit" name="save" value="Save" class="btn btn-success">
                <a href="#" class="btn btn-info">Make Payment</a>
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
                
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="col-md-4">
                            <div>
                              <label>Return Product</label>
                              <input type="text" name="returnproduct" id="returnproduct" class="form-control" placeholder="Enter Product Code">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <br>
                              <input type="button" name="search" onclick="getReturnProduct();" class="btn btn-sm btn-primary" value="Search">
                            </div>
                        </div>
                      </div>
                        
                        
                        <div class="col-md-4 col-sm-4 col-xs-12">
                             <div class="col-md-8">
                                <label>Add Product</label>
                                <input type="text" name="addproduct" id="addproduct" class="form-control" placeholder="Enter Product Code">
                                
                              </div>
                              
                            <div class="col-md-4">
                                <br>
                                <a href="#" class="btn btn-sm btn-info" onclick="setAddProduct();">Add</a>
                              </div>
                        </div>
                </div>
                
                <br><br>

                 <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Type</th>
                                <th>Product Number</th>
                                <th>Quantity</th>
                                <th>Conversion</th>
                                <th>Conversion</th>
                                <th>MRP</th>  <!-- Base Price -->
                                <th>Discount</th>
                                <th>Gross Price</th>
                                <th>Gst</th>
                                <th>GST Amount</th>
                                <th>Salesman Commission(%)</th>
                                <th>Final Price</th>
                                <th>SKU</th>
                                <!--<th>Category</th>-->
                                <!--<th>Subcategory</th>-->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id='consumptionData'> 
                            
                        </tbody>

                        <tfoot id="addProductData">
                          
                        </tfoot>
                    </table>
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

<script type="text/javascript">

  var base_url = '<?php echo base_url(); ?>';

  function getReturnProduct()
  {
    var barcode = $('#returnproduct').val();
    var invoice_id = $('#invoice_id').val();
    // alert(barcode); alert(invoice_id);
 
    var table = $("#consumptionData");
    var count_table_tbody_tr = $("#consumptionData tr").length;
    var row_id = count_table_tbody_tr + 1;

    $.ajax({
            url: base_url + 'sales_invoice/getDataByBarcode/',
            type: 'post',
            dataType: 'json',
            data : {barcode:barcode, invoice_id:invoice_id},
            success:function(response){

              // console.log(response);

              if(response.pno == null)
              {
                  alert('Barcode Not Found!');
              }
              else
              {
                  var html = '';

                    html += '<tr id="row_'+row_id+'">'
                      html += '<td>';
                        html += '<span>Return Item</span>';
                        html += '<input type="hidden" name="returnType[]" value="salesReturn" readonly>';
                        // html += '<input type="hidden" name="inventory_id[]" value="'+response.inventory_id+'" readonly>';
                        // html += '<input type="hidden" name="invoice_type[]" value="'+response.invoice_type+'" readonly>';
                      html += '</td>';

                      html += '<td>';
                        html += '<input type="text" name="barcodelist[]" value="'+response.pno+'" readonly>';
                      html += '</td>';

                      html += '<td>';

                        html += '<input type="text" name="quantitylist[]" readonly value="'+response.qty+'" >';
                      html += '</td>';

                      html += '<td>';
                        html += '&nbsp';
                      html += '</td>';

                      html += '<td>';
                        html += '&nbsp;';
                      html += '</td>';

                      html += '<td>';
                        html += '<input type="text" name="basepricelist[]" readonly value="'+response.baseprice+'" class="pbasepricelist">';
                      html += '</td>';

                      html += '<td>';
                        html += '<input type="text" name="disvaluelist[]" class="pdisvaluelist" readonly value="'+response.disvalue+'" >';
                      html += '</td>';

                      html += '<td>';
                        html += '<input type="text" name="grosspricelist[]" class="pgrosspricelist" readonly value="'+response.grossprice+'" >';
                      html += '</td>';

                      html += '<td>';
                        html += '&nbsp';
                      html += '</td>';

                      html += '<td>';
                        html += '<input type="text" name="gstlist[]" class="pgstlist" readonly value="'+response.gst_amt+'" >';
                      html += '</td>';

                      html += '<td>';
                        html += '<input type="text" name="salesmancommlist[]" readonly value="'+response.salesmancomm+'" >';
                      html += '</td>';

                      html += '<td>';
                        html += '<input type="text" name="finalpricelist[]" class="pfinalpricelist" readonly value="'+response.finalprice+'" >';
                      html += '</td>';

                      html += '<td>';
                        html += '&nbsp';
                      html += '</td>';

                      html += '<td>';
                        html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
                      html += '</td>';
                    html += '</tr>';

                    $('#consumptionData').append(html);
                    loadCount();
              }

              $('#returnproduct').val('');
            }
    });
      
  }

  function setAddProduct()
  {
      var barcode = $('#addproduct').val();

        $.ajax({
            
            url: base_url + 'unit/fecthAllData/',
            type: 'post',
            dataType: 'json',
            success:function(unitResponse){
                
                $.ajax({
            
                    url: base_url + 'gst/fecthAllData/',
                    type: 'post',
                    dataType: 'json',
                    success:function(gstResponse){
                        
                        
                        $.ajax({
            
                            url: base_url + 'discount/fecthAllData/',
                            type: 'post',
                            dataType: 'json',
                            success:function(discountResponse){
                                
                                var table = $("#consumptionData");
                                var count_table_tbody_tr = $("#consumptionData tr").length;
                                var row_id = count_table_tbody_tr + 1;
                
                
                                $.ajax({  
                                    
                                    url: base_url + 'barcode/getAttrubuteDataByBarcode/',
                                    type: 'post',
                                    dataType: 'json',
                                    data : {barcode:barcode},
                                    success:function(response){
                                        
                                        console.log(response);
                                         
                                        // conversion();
                                        // discount();
                                        // gst();
                                        
                                        if(response[0].item_status != 'available')
                                        {
                                            alert('Data Not Available');
                                        }
                                        else
                                        {
                                            // console.log(unitResponse);
                                            var mrp = parseFloat(response[0].mrp);
                                            
                                            var cgst = parseFloat(response[1].cgst);
                                            var sgst = parseFloat(response[1].sgst);
                                            var igst = parseFloat(response[1].igst);
                                            var totgst = cgst + sgst + igst;

                                            var mytot = (mrp * totgst);
                                            var tot = 100 + totgst;
                                            var gstvalue = mytot / tot;

                                            var gst = (gstvalue).toFixed(3); 

                                            var gprice = mrp - gst; 

                                            // var mytax = (100 + totgst) / 100;
                                            // var tax = 100 / mytax;
                                            // var gst = tax * mrp;
                                            // console.log(gst);
                                            // var gstprice = (mrp * totgst);
                                            // // console.log(gstprice);
                                            // var tot = gstprice / 100 + totgst;
                                            // console.log(tot);

                                            // var gprice = mrp - gstprice;

                                            // var fprice = mrp + gstprice;


                                            
                                            var html = '';
                                        
                                            html += '<tr id="row_'+row_id+'">';
                                                    
                                                    $('#quantity_'+row_id).val("1");
                                                    $('#conversionvalue_'+row_id).val("0");
                                                
                                                html += '<td>';
                                                  html += '<span>New Item</span>';
                                                  html += '<input type="hidden" name="addType[]" value="salesAdd" readonly>';
                                                html += '</td>';
                                                html += '<td>';
                                                    html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                                    html += '<input type="text" name="pno[]" value="'+response[0].barcode+'" id="pno_'+row_id+'" required readonly>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" class="countQuantity" value="1">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '&nbsp;';
                                                    // html += '<select name="conversion[]" id="conversion_'+row_id+'" onchange="getConversionData('+row_id+')" >';
                                                    //         html += '<option value="0">---Select One---</option>';
                                                                
                                                    //             $.each(unitResponse, function(index, value) {
                                                                    
                                                    //                html += '<option value="'+value.id+'">'+value.unit+'</option>';
                                                    //             });
                                                                    
                                                    // html += '</select>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '&nbsp;';
                                                    // html += '<input type="text" name="conversionvalue[]" id="conversionvalue_'+row_id+'" readonly>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="baseprice[]" value="'+response[0].mrp+'" id="baseprice_'+row_id+'" class="bpclass">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="disvalue[]" id="disvalue_'+row_id+'" class="discountClass">';
                                                    
                                                    html += '<select name="discount[]" id="discoount_'+row_id+'" onchange="getDiscount('+row_id+')">';
                                                            html += '<option value="0">---Select One---</option>';
                                                                
                                                                $.each(discountResponse, function(index, value) {
                                                                    
                                                                   html += '<option value="'+value.discount+'">'+value.discount+'</option>';
                                                                });
                                                                
                                                    html += '</select>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="grossprice[]" id="grossprice_'+row_id+'" value="'+gprice+'" readonly class="gpClass">';

                                                  html += '<input type="hidden" name="hgrossprice[]" id="hgrossprice_'+row_id+'" value="'+gprice+'" readonly>';

                                                html += '</td>';
                                                
                                                
                                                html += '<td>';
                                                    html += '<select name="gst[]" id="gst_'+row_id+'"  onchange="getGstData('+row_id+')">';
                                                                html += '<option value="0">---Select One---</option>';
                                                                    
                                                                    $.each(gstResponse, function(index, value) {
                                                                        
                                                                       html += '<option value="'+value.id+'">'+value.gst_name+'</option>';
                                                                    });
                                                    html += '</select>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="gstamt[]" id="gstamt_'+row_id+'" readonly class="txClass" value="'+gst+'">';
                                                    html += '<input type="hidden" name="hgstamt[]" id="hgstamt_'+row_id+'" readonly value="'+gst+'">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" value="0">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" class="finalClass" value="'+response[0].mrp+'" readonly>';

                                                    html += '<input type="hidden" name="hfinalprice[]" id="hfinalprice_'+row_id+'" value="'+response[0].mrp+'" readonly>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="sku[]" value="'+response[0].sku_code+'" id="sku_'+row_id+'" readonly>';
                                                html += '</td>';
                                                
                                                // html += '<td>';
                                                //     html += response.cat;
                                                // html += '</td>';
                                                
                                                // html += '<td>';
                                                //     html += response.subcat;
                                                // html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
                                                html += '</td>';
                                                
                                                
                                                html += '</tr>';
                                                
                                                $('#addProductData').append(html);


                                                $('#gst_'+row_id).val(response[1].id);

                                                $('#addproduct').val('');
                                                // $('#bp').val(response.baseprice);
                                                
                                                loadCount();
                                        }
                                    } 
                                });
                            }
                        });
                    }
                });
            }
        });

  }

  $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
        
        loadCount();
    });
</script>

<script>
    var base_url = "<?php echo base_url(); ?>";

    function getConversionData(row_id)
    {  
        var qty = $('#quantity_'+row_id).val();
        var con = $('#conversion_'+row_id).val();
        // alert(qty); alert(conversion);
        $.ajax({
                    
            url: base_url + 'unit/fecthUnitDataByID/',
            type: 'post',
            dataType: 'json',
            data : {unit_id:con},
            success:function(response){
            
                result = parseFloat(qty, 10) / parseFloat(response.conversion, 10);
                
                $('#conversionvalue_'+row_id).val(result);
                
                cal(row_id);
            }
        });

        loadCount();
    }
    
    function getDiscount(row_id)
    {
        var discount = parseFloat($('#discoount_'+row_id).val());
        var grossprice = parseFloat($('#hgrossprice_'+row_id).val());
        
        var discountValue = (grossprice * discount) / 100;
        
        $('#disvalue_'+row_id).val(discountValue);

        var newpricevalue =  grossprice - discountValue;

        var newprice = (newpricevalue).toFixed(3);
        
        $('#grossprice_'+row_id).val(newprice);
        // $('#finalprice_'+row_id).val(newprice);

        var oldGst = parseFloat($('#hgstamt_'+row_id).val());
        
        var newGst = (oldGst * discount) / 100;
        var gstvalue = oldGst - newGst;
        // console.log(gstamount);
        var gstamount = (gstvalue).toFixed(3);
        
        $('#gstamt_'+row_id).val(gstamount);

        // var oldFprice = parseFloat($('#hfinalprice_'+row_id).val());
        // var newFprice = (oldFprice * discount) /100;
        // var fprice = oldFprice - newFprice;

        var price = Number(gstamount) + Number(newprice);
        var fprice = (price).toFixed(3);
        $('#finalprice_'+row_id).val(fprice);

        // $('#finalprice_'+row_id).val(fprice);
        
        loadCount();
    }
    
    function getGstData(row_id)
    {
        var gst_id = $('#gst_'+row_id).val();
        // alert(gst_id);
        
        $.ajax({
                    
            url: base_url + 'gst/fetchAllDataByID/',
            type: 'post',
            dataType: 'json',
            data : {gst_id:gst_id},
            success:function(response){
            
                // console.log(response);
                var sgst = parseInt(response.sgst);
                var cgst = parseInt(response.cgst);
                var igst = parseInt(response.igst);
                var totgst = sgst + cgst + igst;
                // console.log(totgst);
                
                var mrp = parseFloat($('#baseprice_'+row_id).val());


                var mytot = (mrp * totgst);
                var tot = 100 + totgst;
                var gstvalue = mytot / tot;

                var gst = (gstvalue).toFixed(3); 

                var gprice = mrp - gst; 

                $('#gstamt_'+row_id).val(gst);
                
                // cal(row_id);
                $('#grossprice_'+row_id).val(gprice);
                $('#hgrossprice_'+row_id).val(gprice);

                
                var grossprice = parseFloat($('#grossprice_'+row_id).val());
                var gstamt = parseFloat($('#gstamt_'+row_id).val());
                
                var finalamt = gstamt + grossprice;
        
                $('#finalprice_'+row_id).val(finalamt);

                loadCount();
            }
        });        
    }
    
    function cal(row_id)
    {
        var result = $('#conversionvalue_'+row_id).val();
        
        var baseprice = $('#baseprice_'+row_id).val();
        
        var grossprice = (result * baseprice);
        
        $('#grossprice_'+row_id).val(grossprice);
        
        var gstamt = $('#gstamt_'+row_id).val();
        
        var finalamt = gstamt + grossprice;
        
        $('#finalprice_'+row_id).val(finalamt);
        
        
        loadCount();
        // console.log(result); console.log(baseprice);
    }
</script>

<script>
    var sum = 1;
    var baseprice = 0;
    function loadCount()
    {
        var pno=0; var bprice=0; var discount=0; var gp=0; var tx=0; var amt=0;
        var bpricelist = 0; var disvaluelist = 0; var grosspricelist = 0; var gstlist = 0;
        var finalpricelist = 0;
        $('.countQuantity').each(function() {
            
            pno += parseFloat($('.countQuantity').val(), 10);
        });
        $('#no').val(pno);
        $('#cpno').val(pno);
        

        // Base Price
        $('.pbasepricelist').each(function() {
            
            bpricelist += parseFloat($(this).val(), 10);
        });

        $('.bpclass').each(function() {
            
            bprice += parseFloat($(this).val(), 10);
        });
        $('#bp').val(bprice - bpricelist);


        // Discount
        $('.pdisvaluelist').each(function(){

            disvaluelist += parseFloat($(this).val(), 10);
            console.log(disvaluelist);
        });

        $('.discountClass').each(function() {
            
            discount += parseFloat($(this).val(), 10);
            console.log(discount);

        });

        $('#dis').val(discount - disvaluelist);


        // Gross Price
        $('.pgrosspricelist').each(function() {
            
            grosspricelist += parseFloat($(this).val(), 10);
        });

        $('.gpClass').each(function() {
            
            gp += parseFloat($(this).val(), 10);
        });
        $('#gp').val(gp - grosspricelist);
        

        // total Tax
        $('.pgstlist').each(function() {
            
            gstlist += parseFloat($(this).val(), 10);
        });

        $('.txClass').each(function() {
            
            tx += parseFloat($('.txClass').val(), 10);
        });
        $('#tx').val(tx - gstlist);
        
        // Final Amount
        $('.pfinalpricelist').each(function() {
            
            finalpricelist += parseFloat($(this).val(), 10);
        });

        $('.finalClass').each(function() {
            
            amt += parseFloat($('.finalClass').val(), 10);
        });
        $('#amt').val(amt - finalpricelist);
        $('#invoice_value').val(amt - finalpricelist);
    }
    
    $('#adj').on('keyup', function(){
        
       var adj = parseFloat($(this).val());
       var amt = parseFloat($('#amt').val());
       
       var invoice_value = amt - adj;
       
       $('#invoice_value').val(invoice_value);
    });
</script>






