 <!--< ?php echo "<pre>"; print_r($productData); exit(); ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Invoice Return
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Invoice Reurn</li>
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

    <form method="post"  action="<?php echo base_url() ?>purchase_return/create">
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
                        <label>Purchase Return Date</label>
                        <input type="text" name="orderno" readonly value="<?php echo $orderno; ?>" class="form-control">
                      </div>
                    </div>
                
                 <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Purchase Return Date</label>
                    <!--<input type="hidden" name="orderno" value="< ?php echo $orderno; ?>" class="form-control">-->
                    <input type="text" name="preturn_date" class="form-control" id="mydate">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Purchase Account</label>
                    <select name="paccount" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerPurSalesAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $lastData['paccount'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
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
                          <option value="<?php echo $rows->id; ?>" <?php echo $lastData['account'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sale Type</label>
                    <select name="saletype" class="form-control">
                      <option value="0">---select one---</option>
                      <?php foreach($taxAndDuties as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $lastData['ptype'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>  
               
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Division</label>
                    <select name="division" class="form-control">
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
                        <option value="<?php echo $rows->id; ?>" <?php echo $lastData['location'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->location_name; ?></option>
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
                    <label>Payment Type</label>
                    <select name="payment_type" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($paytype as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $lastData['purchase_type'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Base Total</label>
                    <input type="text" name="base_total" class="form-control" id="bp" readonly>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Discount</label>
                    <input type="text" name="total_discount" class="form-control" id="dis" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Gross Total</label>
                    <input type="text" name="gross_total" class="form-control" id="gp" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Total Tax</label>
                    <input type="text" name="total_tax" class="form-control" id="tx" readonly>
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
                    <input type="text" name="total_invoice" id="invoice_value"  class="form-control" readonly="">
                  </div>
                </div>             
            </div>

              <hr>
               <div align="right">

                <a href="<?php echo base_url(); ?>ledger_master/create" class="btn btn-primary">Create Ledger</a>
                
                <!-- <a href="#" class="btn btn-info">Hold</a> -->
                <input type="submit" name="hold" value="Hold" class="btn btn-info">
                <input type="submit" name="save" value="Save" class="btn btn-success">
                <input type="submit" name="print" value="Save and Print" class="btn btn-success">

                <!-- <a href="#" class="btn btn-success">Save and Print</a> -->
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          <div class="box" style="padding: 5px">
              
              <div class="row">
                
                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Search Product</label>
                    <input type="text" class="form-control" id="product" name="product" autocomplete="off" >
                    <!--<input list="searchProduct" class="form-control" id="product" name="product" autocomplete="off">-->
                    <!--<datalist id="searchProduct">-->
                    <!--  < ?php foreach($productData as $rows): ?>-->
                    <!--    <option value="< ?php echo $rows->id; ?>">-->
                    <!--  < ?php endforeach; ?>-->
                    <!--</datalist>-->
                  </div>
                </div>
                
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <div>
                    <label>SKU</label>
                    <input list="searchSku" class="form-control" id="sku" name="sku" autocomplete="off">
                    <datalist id="searchSku">
                      <?php foreach($productData as $rows): ?>
                        <option value="<?php echo $rows->product_code; ?>">
                      <?php endforeach; ?>
                    </datalist>
                  </div>
                </div>

                <?php $myColor = array(); $myColor = explode(", ", $color['attr_values']); ?>
                <div class="col-md-1 col-sm-1 col-xs-12">
                  <div>
                    <label>Color</label>
                    <select name="color" id="color" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($myColor as $rows): ?>
                        <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <?php $mySize = array(); $mySize = explode(", ", $size['attr_values']); ?>
                <div class="col-md-1 col-sm-1 col-xs-6">
                  <div>
                    <label>Size</label>
                    <select name="size" id="size" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($mySize as $rows): ?>
                        <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <?php $myPattern = array(); $myPattern = explode(", ", $pattern['attr_values']); ?>
                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Texture/Pattern</label>
                    <select name="pattern" id="pattern" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($myPattern as $rows): ?>
                        <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <?php $myStyle1 = array(); $myStyle1 = explode(", ", $style1['attr_values']); ?>
                <div class="col-md-1 col-sm-1 col-xs-6">
                  <div>
                    <label>Style 1</label>
                    <select name="style1" id="style1" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($myStyle1 as $rows): ?>
                        <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <?php $myStyle2 = array(); $myStyle2 = explode(", ", $style2['attr_values']); ?>
                <div class="col-md-1 col-sm-1 col-xs-6">
                  <div>
                    <label>Style 2</label>
                    <select name="style2" id="style2" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($myStyle2 as $rows): ?>
                        <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <?php $myType = array(); $myType = explode(", ", $type['attr_values']); ?>
                <div class="col-md-1 col-sm-1 col-xs-6">
                  <div>
                    <label>Type</label>
                    <select name="type" id="type" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($myType as $rows): ?>
                        <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <br>
                    <a href="javascript:void(0)" onclick="getProductDetails()" class="btn btn-sm btn-success">Search</a>
                    <a href="javascript:void(0)" id="clear" class="btn btn-sm btn-danger">Clear</a>
                  </div>
                </div>
               
               <div id="showProductTable"></div>
               <div class="col-md-12">
                    <div class="table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <!--<th>Conversion</th>-->
                                            <!--<th>Conversion</th>-->
                                            <th>Base Price</th>
                                            <!-- <th>Discount</th> -->
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
                                </table>
                            </div>
                 <!-- <div id="showProConversionTable"></div> -->
                </div>

            </div>
          </div>

        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
  </form>
    <!-- /.content -->
  </div>
 
  <div class="control-sidebar-bg"></div>

</div>


<!-- FOR SHIPPING MODAL OPEN -->
<?php
  // $this->load->view('admin_view/templates/modals/shippingType');
  $this->load->view('admin_view/templates/modals/createLedger');
?>

<link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

<script type="text/javascript">
    
    $("#mydate").datepicker().datepicker("setDate", new Date());
    
  var base_url = '<?php echo base_url(); ?>';


  $('#product').on('keyup', function(){

      var barcode = $(this).val().length;

      // barcode.length;
      // $.trim(barcode);
      if(barcode > 9)
      {
        var barcode_code = $(this).val(); 
        // console.log(barcode_code);
        //   $.ajax({
 
        //     url : base_url + 'purchase_return/fetchDataByBarcodeId',
        //     method : "POST",
        //     data : {barcode_code:barcode_code},
        //     dataType: 'json',
        //     success:function(response){

        //         // console.log(response);

        //     }
        //   });



        //  data fetch
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
                                        
                              url: base_url + 'purchase_return/fetchDataByBarcodeId',
                              type: 'post',
                              dataType: 'json',
                              data : {barcode_code:barcode_code},
                              success:function(response){

                            //   console.log(response);

                                  if(response.status != 'available')
                                  {
                                      alert('Data Not Available');
                                  }
                                  else
                                  {
                                    $(this).val('');
                                      var html = '';
                                            
                                      html += '<tr id="row_'+row_id+'">';
                                              
                                              $('#quantity_'+row_id).val("1");
                                              $('#conversionvalue_'+row_id).val("0");
                                          
                                          html += '<td>';
                                              html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';

                                              html += '<input type="hidden" name="pno[]" value="'+response.pnoid+'" id="pno_'+row_id+'" required readonly>';

                                              html += '<input type="text" name="pnoname[]" value="'+response.pno+'" id="pno_'+row_id+'" required readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" class="countQuantity" value="1">';
                                          html += '</td>';
                                          
                                        //   html += '<td>';
                                        //       html += '&nbsp;';
                                        //   html += '</td>';
                                          
                                        //   html += '<td>';
                                        //       html += '&nbsp;';
                                        //   html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="baseprice[]" value="'+response.baseprice+'" id="baseprice_'+row_id+'" class="bpclass">';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="grossprice[]" id="grossprice_'+row_id+'" value="'+response.grossprice+'" readonly class="gpClass">';
                                          html += '</td>';
                                          
                                          
                                          html += '<td>';
                                              html += '<select name="gst[]" id="gst_'+row_id+'"  onchange="getGstData('+row_id+')">';
                                                          html += '<option value="8">none</option>';
                                                              
                                                              $.each(gstResponse, function(index, value) {
                                                                  
                                                                 html += '<option value="'+value.id+'">'+value.gst_name+'</option>';
                                                              });
                                              html += '</select>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="gstamt[]" id="gstamt_'+row_id+'" readonly class="txgst">';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" value="0">';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" value="'+response.grossprice+'" class="finalClass" readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="hidden" name="sku[]" value="'+response.sku_id+'" id="sku_'+row_id+'" readonly>';
                                              
                                              html += '<input type="text" name="sku_code[]" value="'+response.sku+'" id="sku_'+row_id+'" readonly>';
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
                                          
                                          $('#consumptionData').append(html);
                                          
                                          // $('#bp').val(response.baseprice);
                                            
                                          $('#gst_'+row_id).val(response.gst);
                                          $('#gstamt_'+row_id).val(0);
                                          
                                          getGstData(row_id);
                                          
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
  });

  function getProductDetails()
  {
    // var product = $('#product').val();
    var sku = $('#sku').val();
    // alert(sku);
    // var color = $('#color').val();
    // var size = $('#size').val();
    // var pattern = $('#pattern').val();
    // var style1 = $('#style1').val();
    // var style2 = $('#style2').val();
    // var type = $('#type').val();

    // alert(product);alert(sku);alert(color);alert(size);alert(pattern);alert(style1);alert(style2);alert(type);

    $.ajax({
 
        url : base_url + 'purchase_return/returnProductData',
        method : "POST",
        data : {sku:sku},
        dataType: 'json',
        success:function(response){

          console.log(response);

          var table = '';
          
          table += '<div class="table-responsive col-md-12">';
          table += '<table class="table" id="productDataTable">';
            table += '<thead>';
               table += '<tr>';
                table += '<th>Product Number</th>';
                table += '<th>Color</th>';
                table += '<th>Size</th>';
                table += '<th>Texture/Pattern</th>';
                table += '<th>Style1</th>';
                table += '<th>Style2</th>';
                table += '<th>Type</th>';
                table += '<th>WSP</th>';
                table += '<th>Action</th>';
              table += '</tr>';
              table += '<tbody id="productTable">';

              table += '</tbody>';
            table += '</thead>';
          table += '</table>';
          table += '</div>';

          if(response.data != null || response.data != '')
          {
              $('#showProductTable').html(table);

              var html = '';

              // var obj = jQuery.parseJSON(response.data);
              var row_id = 1;
              $.each(response.data, function(key,value) {

                // alert(value.barcode);
                html += '<tr id="row_'+row_id+'">';
                  html += '<td>';
                    html += '<input type="hidden" value="'+value.barcode+'" id="barcode_'+row_id+'">'
                    html += '<span>'+value.barcode+'</span>';
                  html += '</td>';
                  html += '<td>';
                    html += '<span>'+value.color+'</span>';
                  html += '</td>';
                  html += '<td>';
                    html += '<span>'+value.size+'</span>';
                  html += '</td>';
                  html += '<td>';
                    html += '<span>'+value.pattern+'</span>';
                  html += '</td>';
                  html += '<td>';
                    html += '<span>'+value.style1+'"</span>';
                  html += '</td>';
                  html += '<td>';
                    html += '<span>'+value.style2+'</span>';
                  html += '</td>';
                  html += '<td>';
                    html += '<span>'+value.type+'</span>';
                  html += '</td>';
                  html += '<td>';
                    html += '<span>'+value.mrp+'<span>';
                  html += '</td>';
                  html += '<td>';
                    html += '<a href="javascript:void(0);" onclick="addProduct('+row_id+')" class="btn btn-success remove" >Add</a>';
                    // html += '<button class="btn btn-success" onclick="addProduct('+row_id+')">Add</button>';
                  html += '</td>';
                html += '</tr>';

                row_id++;

              });

              $('#productTable').append(html);

              $('#sku').val('');

              // var contable = '';
                    
              // contable += '<div class="table-responsive col-md-12">';
              // contable += '<table class="table">';
              //   contable += '<thead>';
              //      contable += '<tr>';
              //       contable += '<th>Product Name</th>';
              //       contable += '<th>Quantity</th>';
              //       contable += '<th>Conversion</th>';
              //       contable += '<th>Conversion</th>';
              //       contable += '<th>Base Price</th>';
              //       contable += '<th>Discount</th>';
              //       contable += '<th>Gross Price</th>';
              //       contable += '<th>GST</th>';
              //       contable += '<th>GST Amount</th>';
              //       contable += '<th>Salesman Commission(%)</th>';
              //       contable += '<th>Final Price</th>';
              //       contable += '<th>SKU</th>';
              //       contable += '<th>Action</th>';
              //     contable += '</tr>';
              //     contable += '<tbody id="consumptionData">';

              //     contable += '</tbody>';
              //   contable += '</thead>';
              // contable += '</table>';
              // contable += '</div>';

              // $('#showProConversionTable').html(table);
          }

          

        }
    });
  }

  function addProduct(row_id)
  {
    var barcode = $('#barcode_'+row_id).val();
    // alert(barcode);
    // alert(row_id);


    // get Quantity
    $.ajax({

        url: base_url + 'barcode/getAttrubuteDataByBarcode/',
        type: 'post',
        dataType: 'json',
        data: {barcode:barcode},
        success:function(barcodeResponse){

          // console.log(barcodeResponse);
          // alert(barcodeResponse);
          //  data fetch
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
                                              
                                    url: base_url + 'internal_consumption/fetchDataByBarcodeId/',
                                    type: 'post',
                                    dataType: 'json',
                                    data : {barcode_code:barcode},
                                    success:function(response){

                                    // console.log(response);

                                        if(response.status != 'available')
                                        {
                                            alert('Data Not Available');
                                        }
                                        else
                                        {
                                            var html = '';

                                            var totgst = parseFloat(barcodeResponse[1].cgst) + parseFloat(barcodeResponse[1].sgst) + parseFloat(barcodeResponse[1].igst);

                                            // var tax = (response.grossprice * totgst) / 100;

                                            // var fprice = response.grossprice - tax;
                                            // console.log(tax); 

                                            var tax = (response.baseprice * totgst) / 100;

                                            // var fprice = response.grossprice - tax;

                                                  
                                            html += '<tr id="row_'+row_id+'">';
                                                    
                                                    $('#quantity_'+row_id).val("1");
                                                    $('#conversionvalue_'+row_id).val("0");
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                                    
                                                    html += '<input type="hidden" name="pno[]" value="'+response.pnoid+'" id="pno_'+row_id+'" required readonly>';

                                                    html += '<input type="text" name="pnoname[]" value="'+response.pno+'" id="pno_'+row_id+'" required readonly>';

                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" value="'+barcodeResponse[0].qty+'" class="countQuantity">';
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
                                                    html += '<input type="text" name="baseprice[]" value="'+response.baseprice+'" id="baseprice_'+row_id+'" class="bpclass">';
                                                html += '</td>';
                                                
                                                // html += '<td>';
                                                //     html += '<input type="hidden" name="disvalue[]" id="disvalue_'+row_id+'" class="discountClass">';
                                                    
                                                //     html += '<select name="discount[]" id="discoount_'+row_id+'" onchange="getDiscount('+row_id+')">';
                                                //             html += '<option value="0">---Select One---</option>';
                                                                
                                                //                 $.each(discountResponse, function(index, value) {
                                                                    
                                                //                    html += '<option value="'+value.discount+'">'+value.discount+'</option>';
                                                //                 });
                                                                
                                                //     html += '</select>';
                                                // html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="grossprice[]" id="grossprice_'+row_id+'" value="'+response.grossprice+'" readonly class="gpClass">';
                                                html += '</td>';
                                                
                                                
                                                html += '<td>';
                                                    html += '<select name="gst[]" id="gst_'+row_id+'"  onchange="getGstData('+row_id+')">';
                                                                html += '<option value="'+barcodeResponse[1].gst_id+'">---Select One---</option>';
                                                                    
                                                                    $.each(gstResponse, function(index, value) {
                                                                        
                                                                       html += '<option value="'+value.id+'">'+value.gst_name+'</option>';
                                                                    });
                                                    html += '</select>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="gstamt[]" id="gstamt_'+row_id+'" readonly class="txgst" value="'+tax+'">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" value="0">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" class="finalClass" readonly value="'+response.mrp+'">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="sku[]" value="'+response.skuid+'" id="sku_'+row_id+'" readonly>';
                                                    html += '<input type="text" name="sku_code[]" value="'+response.sku+'" id="sku_'+row_id+'" readonly>';
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
                                                
                                                $('#consumptionData').append(html);
                                                
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

        loadCal(row_id);
        loadCount();
    }
    
    function loadCal(row_id)
    {
        var baseprice = parseFloat($('#baseprice_'+row_id).val());
        var qty = parseFloat($('#quantity_'+row_id).val());
        
        var grossprice = baseprice * qty;
        grossprice = (grossprice).toFixed(3);
        
        $('#grossprice_'+row_id).val(grossprice);
        
        getGstData(row_id);
        
    }
    
    function getDiscount(row_id)
    {
        var discount = parseFloat($('#discoount_'+row_id).val());
        var baseprice = parseFloat($('#baseprice_'+row_id).val());
        
        var discountValue = (baseprice * discount) / 100;
        
        $('#disvalue_'+row_id).val(discountValue);
        
        var newprice = baseprice - discountValue;
        
        $('#grossprice_'+row_id).val(newprice);
        $('#finalprice_'+row_id).val(newprice);
        
        // cal(row_id);
                
        // var grossprice = parseFloat($('#grossprice_'+row_id).val());
        // var gstamt = parseFloat($('#gstamt_'+row_id).val());
        
        // var finalamt = gstamt + grossprice;
    
        // $('#finalprice_'+row_id).val(finalamt);
    
        
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
                
                var sgst = parseFloat(response.sgst);
                var cgst = parseFloat(response.cgst);
                var igst = parseFloat(response.igst);
                var totgst = sgst + cgst + igst;
                
                // console.log(totgst);
                
                var grossprice = parseFloat($('#grossprice_'+row_id).val());
                
                var gstamt = (grossprice * totgst) / 100;
                // console.log(grossprice); console.log(gstamt);
                $('#gstamt_'+row_id).val(gstamt);
                
                // cal(row_id);
                
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
        grossprice = (grossprice).toFixed(3);
        
        $('#grossprice_'+row_id).val(grossprice);
        
        var gstamt = $('#gstamt_'+row_id).val();
        
        var finalamt = gstamt + grossprice;
        
        finalamt = (finalamt).toFixed(3);
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
        var pno=0; var bprice=0; var discount=0; var gp=0; var tx=0; var tx1 = 0; var amt=0;
        
        $('.countQuantity').each(function() {
            
            pno += parseFloat($(this).val(), 10);
        });
        console.log(pno);
        pno = (pno).toFixed(3);
        $('#no').val(pno);
        $('#cpno').val(pno);
        
    
        
        // $('.bpclass').each(function() {
            
        //     bprice += parseFloat($(this).val(), 10);
        // });
        // console.log(bprice);
        // $('#bp').val(bprice);
        
        $('.discountClass').each(function() {
            
            discount += parseFloat($(this).val(), 10);
        });
        console.log(discount);

        discount = (discount).toFixed(3);

        $('#dis').val(discount);
        
        $('.gpClass').each(function() {
            
            gp += parseFloat($(this).val(), 10);
        });
        console.log(gp);
        gp = (gp).toFixed(3);

        $('#bp').val(gp);
        $('#gp').val(gp - discount);
        
        var sum = 0;
        $(".txgst").each(function(){
            sum += +$(this).val();
        });
        console.log(sum);

        sum = (sum).toFixed(3);

        $('#tx').val(sum);
        // alert(sum);
        
        // var sum = 0;
        // $('.txgst').each(function() {
        //     sum += $('.txgst').val();
            
        //     console.log("GST ".sum);
        // });
        
        // console.log(sum);
        

        // $('.txClass').each(function() {
            
        //     tx += parseFloat($(this).val(), 10);
        //     console.log(tx);
        // });
        
        // $('.txClass1').each(function() {
            
        //     tx1 += $('.txClass1').val();
        //     console.log(tx1);
        // });
        
        // var tax = tx + tx1;
        // console.log(tax);
        // $('#tx').val(tax);
        
        $('.finalClass').each(function() {
            
            amt += parseFloat($(this).val(), 10);
        });
        amt = (amt).toFixed(3);

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




