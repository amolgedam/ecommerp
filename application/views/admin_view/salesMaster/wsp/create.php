
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add WSP
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add WSP</li>
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

    <form method="post"  action="<?php echo base_url() ?>wsp/create">
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
                    <label>Invoice Number</label>
                    <input type="text" name="orderno" value="<?php echo $orderno; ?>" readonly class="form-control">
                  </div>
                </div>
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Invoice Date</label>
                    <!--<input type="date" name="date" class="form-control" required>-->
                    <input type="text" name="date" class="form-control" required id="mydate" />
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Sales Account</label>
                    <select name="saccount" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerPurSalesAccount as $rows): ?>
                  
                        <?php if($this->session->userdata['wo_company'] == $rows->company_id){ ?>
                          <option value="<?php echo $rows->id; ?>" <?php echo $lastData['sales_account'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
                        <?php } ?>
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
                    <label>Salesman</label>
                    <select name="salesman" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach($ledgerSalesmanAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" ><?php echo $rows->ledger_name; ?></option>
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
                      <?php foreach($taxAndDuties as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $lastData['sale_type'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->ledger_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="form-control">
                  </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>No. of Product</label>
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
              <a href="<?php echo base_url() ?>wsp/create" class="btn btn-info">New Invoice</a>
              
               <a href="<?php echo base_url(); ?>ledger_master/create" class="btn btn-primary">Create Ledger</a>

              <!--<a href="#" class="btn btn-info">Hold</a>-->
              <input type="submit" name="hold" value="Hold" class="btn btn-success">
              
              <!--<a href="#" class="btn btn-info">Make Payment</a>-->
              <input type="submit" name="payment" value="Make Payment" class="btn btn-success">
              
              <input type="submit" name="save" value="Save" class="btn btn-success">
            </div>

            </div>
            <!-- /.box-body -->
          </div>

            <div class="box" style="padding: 5px">
              
              <div class="row">
                
                <!-- <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Search Product</label>
                    <input list="searchProduct" class="form-control" id="product" name="product">
                    <datalist id="searchProduct">
                      < ?php foreach($productData as $rows): ?>
                        <option value="< ?php echo $rows->product_name; ?>">
                      < ?php endforeach; ?>
                    </datalist>
                  </div>
                </div> -->
                
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <div>
                    <label>SKU</label>
                   
                    <input list="searchSku" class="form-control" id="sku" name="searchSku" autocomplete="off">
                    <datalist id="searchSku">
                      <?php foreach($productData as $rows): ?>
                        <option value="<?php echo $rows->product_code; ?>">
                      <?php endforeach; ?>
                    </datalist>
                  </div>
                </div>

                <?php $myColor = array(); $myColor = explode(", ", $color['attr_values']); ?>
                <div class="col-md-2 col-sm-2 col-xs-12">
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
                                           <!--  <th>Conversion</th>
                                            <th>Conversion</th> -->
                                            <th>WSP</th>
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
  // $this->load->view('admin_view/includes/modals/shippingType');
  // $this->load->view('admin_view/includes/modals/createLedger');
?>


<link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


<script type="text/javascript">

    
  $("#mydate").datepicker().datepicker("setDate", new Date());
  
  var base_url = '<?php echo base_url(); ?>';

  function getProductDetails()
  {
    // var product = $('#product').val();
    var sku = $('#sku').val();
    // var color = $('#color').val();
    // var size = $('#size').val();
    // var pattern = $('#pattern').val();
    // var style1 = $('#style1').val();
    // var style2 = $('#style2').val();
    // var type = $('#type').val();

    // alert(sku);
    // alert(product);alert(sku);alert(color);alert(size);alert(pattern);alert(style1);alert(style2);alert(type);

    $.ajax({

        url : base_url + 'wsp/getWSPData/',
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
                    html += '<span>'+value.wsp+'<span>';
                  html += '</td>';
                  html += '<td>';
                    html += '<a href="javascript:void(0);" onclick="addProduct('+row_id+')" class="btn btn-success remove" >Add</a>';
                    // html += '<button class="btn btn-success" onclick="addProduct('+row_id+')">Add</button>';
                  html += '</td>';
                html += '</tr>';

                row_id++;

              });

              $('#productTable').append(html);
          }

        }
    });
  }

  function addProduct(row_id)
  {
    var barcode = $('#barcode_'+row_id).val();
    // alert(barcode);
    // alert(row_id);

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
                                    
                          url: base_url + 'barcode/getAttrubuteDataByBarcode/',
                          type: 'post',
                          dataType: 'json',
                          data : {barcode:barcode},
                          success:function(response){

                          console.log(response);

                              if(response[0].item_status != 'available')
                              {
                                  alert('Data Not Available');
                              }
                              else
                              {
                                  // console.log(unitResponse);

                                            var mrp = parseFloat(response[0].wsp);
                                            
                                            var cgst = parseFloat(response[1].cgst);
                                            var sgst = parseFloat(response[1].sgst);
                                            var igst = parseFloat(response[1].igst);
                                            var totgst = cgst + sgst + igst;

                                            var mytot = (mrp * totgst);
                                            var tot = 100 + totgst;
                                            var gstvalue = mytot / tot;

                                            var gst = (gstvalue).toFixed(3); 

                                            var gprice = mrp - gst; 

                                            var html = '';
                                        
                                            html += '<tr id="row_'+row_id+'">';
                                                    
                                                    $('#quantity_'+row_id).val("1");
                                                    $('#conversionvalue_'+row_id).val("0");
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                                    
                                                    html += '<input type="hidden" name="pno[]" value="'+response[0].id+'" id="pno_'+row_id+'" required readonly>';

                                                    html += '<input type="text" name="pnoname[]" value="'+response[0].barcode+'" id="pno_'+row_id+'" required readonly>';
                                                html += '</td>';
                                                
                                                var read = mrp = '';
                                                if(response[0].unit_id == '18')
                                                {
                                                    read = 'readonly';
                                                }
                                                else
                                                {
                                                    read = '';
                                                }
                                                    
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" class="countQuantity" value="1" '+read+'>';
                                                html += '</td>';
                                                
                                                // html += '<td>';
                                                //   html+= '&nbsp';
                                                    // html += '<select name="conversion[]" id="conversion_'+row_id+'" onchange="getConversionData('+row_id+')" >';
                                                    //         html += '<option value="0">---Select One---</option>';
                                                                
                                                    //             $.each(unitResponse, function(index, value) {
                                                                    
                                                    //                html += '<option value="'+value.id+'">'+value.unit+'</option>';
                                                    //             });
                                                                    
                                                    // html += '</select>';
                                                // html += '</td>';
                                                
                                                // html += '<td>';
                                                //   html += '&nbsp;';
                                                    // html += '<input type="text" name="conversionvalue[]" id="conversionvalue_'+row_id+'" readonly>';
                                                // html += '</td>';

                                                html += '<td>';
                                                    var read = mrp = '';
                                                    if(response[0].unit_id == '18')
                                                    {
                                                        html += '<input type="text" name="oldbaseprice[]" value="'+response[0].wsp+'" onchange="mrpChange('+row_id+')" id="baseprice_'+row_id+'" >';
                                                    }
                                                    else
                                                    {
                                                        html += '<input type="text" name="oldbaseprice[]" value="'+response[0].wsp+'" onchange="mrpChange1('+row_id+')" id="baseprice_'+row_id+'" >';
                                                    }
                                                    
                                                html += '</td>';
                                                
                                                // html += '<td>';
                                                //     html += '<input type="text" name="baseprice[]" value="'+response[0].wsp+'" id="baseprice_'+row_id+'" class="bpclass">';
                                                // html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="disvalue[]" id="disvalue_'+row_id+'" value="0" class="discountClass">';
                                                    
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
                                                    
                                                    html += '<input type="hidden" name="hgrossprice1[]" id="hgrossprice1_'+row_id+'" value="'+gprice+'" readonly>';
                                                    
                                                    // for cal gst on discount
                                                    html += '<input type="hidden" name="baseprice[]" id="hiddenbaseprice_'+row_id+'" value="'+gprice+'" class="bpclass" readonly>';
                                                    html += '<input type="hidden" name="hiddenbaseprice1[]" id="hiddenbaseprice1_'+row_id+'" value="'+gprice+'" readonly>';
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
                                                    
                                                    html += '<input type="hidden" name="hgstamt1[]" id="hgstamt1_'+row_id+'" readonly value="'+gst+'">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="comm[]" id="comm_'+row_id+'" class="salescomm" value="0">';
                                                    html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" onkeyup="setSalesmanComm('+row_id+')" value="0">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" class="finalClass" value="'+response[0].mrp+'" readonly>';

                                                    html += '<input type="hidden" name="hfinalprice[]" id="hfinalprice_'+row_id+'" value="'+response[0].mrp+'" readonly>';

                                                    html += '<input type="hidden" name="hfinalprice1[]" id="hfinalprice1_'+row_id+'" value="'+response[0].mrp+'" readonly>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="sku[]" value="'+response[2].id+'" id="sku_'+row_id+'" readonly>';
                                                    html += '<input type="text" name="skuname[]" value="'+response[2].product_code+'" id="sku_'+row_id+'" readonly>';
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
                                      
                                      $('#gst_'+row_id).val(response[1].id);

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
    
    function setSalesmanComm(row_id)
    {
        var commPer = $('#salesmancomm_'+row_id).val();
        var price = $('#grossprice_'+row_id).val();
        // console.log(commPer); console.log(price);
        
        if(commPer > 2)
        {
            // alert("Commission Not more than 2%");
            alert("Commission should be 0-2% Range");
            
            $('#salesmancomm_'+row_id).val('');
            $('#comm_'+row_id).val(0);
        }
        else
        {
            var comm = (price * commPer /100);
            // console.log(comm);
            comm = (comm).toFixed(3);
            $('#comm_'+row_id).val(comm);
        }    

        loadCount();
    }

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
        
        qtyChange(row_id);
        // loadCount();
    }
    
    function getDiscount(row_id)
    {
        var discount = parseFloat($('#discoount_'+row_id).val());
        var grossprice = parseFloat($('#hiddenbaseprice1_'+row_id).val());
        
        var discount = (grossprice * discount) / 100;

        var discountValue = (discount).toFixed(3);
        
        $('#disvalue_'+row_id).val(discountValue);
        
        var newpricevalue =  grossprice - discountValue;

        var newprice = (newpricevalue).toFixed(3);
        
        $('#grossprice_'+row_id).val(newprice);

        var gst_id = $('#gst_'+row_id).val();


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

                // var mrp = parseFloat($('#baseprice_'+row_id).val());
                // var mytot = (newprice * totgst);
                // var tot = 100 + totgst;
                // var gstvalue = mytot / tot;

                var gstvalue = newprice * totgst / 100;
                // console.log(gst);
                var gst = (gstvalue).toFixed(3); 

                $('#gstamt_'+row_id).val(gst);
                $('#hgstamt_'+row_id).val(gst);

                var final = parseFloat(gst) + parseFloat(newprice);
                // console.log(final);
                $('#finalprice_'+row_id).val(final);
                $('#hfinalprice_'+row_id).val(final);

                loadCount();
            }
        });


        loadCount();


        // var discount = parseFloat($('#discoount_'+row_id).val());
        // var grossprice = parseFloat($('#hgrossprice_'+row_id).val());
        
        // var discountValue = (grossprice * discount) / 100;
        
        // $('#disvalue_'+row_id).val(discountValue);
        
        // var newpricevalue =  grossprice - discountValue;

        // var newprice = (newpricevalue).toFixed(3);
        
        // $('#grossprice_'+row_id).val(newprice);
        // // $('#finalprice_'+row_id).val(newprice);

        // var oldGst = parseFloat($('#hgstamt_'+row_id).val());
        
        // var newGst = (oldGst * discount) / 100;
        // var gstvalue = oldGst - newGst;

        // var gstamount = (gstvalue).toFixed(3);
        // // console.log(gstamount);
        // $('#gstamt_'+row_id).val(gstamount);

        // // var oldFprice = parseFloat($('#hfinalprice_'+row_id).val());
        // // var newFprice = (oldFprice * discount) /100;
        // // var fprice = oldFprice - newFprice;

        // // $('#finalprice_'+row_id).val(fprice);

        // var price = Number(gstamount) + Number(newprice);
        // var fprice = (price).toFixed(3);
        // $('#finalprice_'+row_id).val(fprice);
        
        // loadCount();
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
                $('#hgstamt_'+row_id).val(gst);
                
                // cal(row_id);
                $('#grossprice_'+row_id).val(gprice);
                $('#hgrossprice_'+row_id).val(gprice);

                $('#hiddenbaseprice_'+row_id).val(gprice);
                $('#hiddenbaseprice1_'+row_id).val(gprice);


                
                var grossprice = parseFloat($('#grossprice_'+row_id).val());
                var gstamt = parseFloat($('#hgstamt_'+row_id).val());
                
                var finalamt = gstamt + grossprice;
        
                $('#finalprice_'+row_id).val(finalamt);
                $('#hfinalprice_'+row_id).val(finalamt);

                getDiscount(row_id);

                loadCount();
            }
        });
        
        loadCount();
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
    
    function qtyChange(row_id) {
      
        var qty = $('#quantity_'+row_id).val();
        var gprice = $('#hgrossprice1_'+row_id).val();
        
        var gprice = qty * gprice;
        gprice = (gprice).toFixed(3);
        
        $('#grossprice_'+row_id).val(gprice);
        $('#hgrossprice_'+row_id).val(gprice);
        
        // for Discount
        $('#hiddenbaseprice_'+row_id).val(gprice);
        $('#hiddenbaseprice1_'+row_id).val(gprice);
        
        var gstValue = $('#hgstamt1_'+row_id).val();
        gstValue = qty * gstValue;
        
        gstValue = (gstValue).toFixed(3);
        
        $('#gstamt_'+row_id).val(gstValue);
        $('#hgstamt_'+row_id).val(gstValue);
        
        var fprice = $('#hfinalprice1_'+row_id).val();
        
        var fprice1 = qty * fprice;
        fprice1 = (fprice1).toFixed(3);
        
        $('#finalprice_'+row_id).val(fprice1);
        $('#hfinalprice_'+row_id).val(fprice1);
        
        loadCount();
    }
    
    function mrpChange1(row_id) {
      
        var baseprice = $('#baseprice_'+row_id).val();
        
        // $('#grossprice_'+row_id).val(baseprice);
        // $('#hgrossprice_'+row_id).val(baseprice);

        // getGstData(row_id);
        
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
                
                var qty = $('#quantity_'+row_id).val();
                
                var mrp = parseFloat($('#baseprice_'+row_id).val());
                
                var newmrp = mrp * qty;

                var mytot = (newmrp * totgst);
                var tot = 100 + totgst;
                var gstvalue = mytot / tot;

                var gst = (gstvalue).toFixed(3); 
                

                var gprice = newmrp - gst; 
                
                
                                // console.log("mrp "+newmrp+" gst"+gst+" gprice "+gprice);

                $('#gstamt_'+row_id).val(gst);
                $('#hgstamt_'+row_id).val(gst);
                
                // cal(row_id);
                gprice = (gprice).toFixed(3);
                $('#grossprice_'+row_id).val(gprice);
                $('#hgrossprice_'+row_id).val(gprice);


                $('#hiddenbaseprice_'+row_id).val(gprice);
                $('#hiddenbaseprice1_'+row_id).val(gprice);

                var grossprice = parseFloat($('#grossprice_'+row_id).val());
                var gstamt = parseFloat($('#hgstamt_'+row_id).val());
                
                var finalamt = gstamt + grossprice;
            
                finalamt = (finalamt).toFixed(3);
                $('#finalprice_'+row_id).val(finalamt);
                $('#hfinalprice_'+row_id).val(finalamt);

                getDiscount(row_id);

                loadCount();
            }
        });
    }
    
    function mrpChange(row_id) {
      
        // alert(row_id);
        var baseprice = $('#baseprice_'+row_id).val();
        console.log(baseprice);
        $('#grossprice_'+row_id).val(baseprice);
        $('#hgrossprice_'+row_id).val(baseprice);

        getGstData(row_id);
    }
</script>

<script>
    var sum = 1;
    var baseprice = 0;
    function loadCount()
    {
        var pno=0; var bprice=0; var discount=0; var gp=0; var tx=0; var amt=0;
        
        $('.countQuantity').each(function() {
            
            pno += parseFloat($('.countQuantity').val(), 10);
        });
        $('#no').val(pno);
        $('#cpno').val(pno);
        
        $('.bpclass').each(function() {
            
            bprice += parseFloat($('.bpclass').val(), 10);
        });
        $('#bp').val(bprice);
        
        $('.discountClass').each(function() {
            
            discount += parseFloat($('.discountClass').val(), 10);
        });
        $('#dis').val(discount);
        
        $('.gpClass').each(function() {
            
            gp += parseFloat($('.gpClass').val(), 10);
        });
        $('#gp').val(gp);
        

        $('.txClass').each(function() {
            
            tx += parseFloat($('.txClass').val(), 10);
        });
        $('#tx').val(tx);
        
        
        $('.finalClass').each(function() {
            
            amt += parseFloat($('.finalClass').val(), 10);
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




