

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Shortage
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Shortage</li>
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

    <form method="post" action="<?php echo base_url() ?>shortage/create">
        
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
               <div class="row">
                
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Date</label>
                      <input type="hidden" name="inventory_no" value="<?php echo $opening_no; ?>" class="form-control" required>
                      <input type="date" name="date" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Account</label>
                      <select name="account" class="form-control">
                        <option value="0">---Selec One---</option>
                            <?php foreach($ledger as $rows): ?>
                                <option value="<?php echo $rows['id']; ?>"><?php echo $rows['ledger_name']; ?></option>
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
                      <label>Shipping Type</label>
                      <input type="text" name="shipping_type" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Number Of Products</label>
                          <input type="text" name="no_ofproduct" class="form-control" id="no" readonly>
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
                          <input type="text" name="adjustment" id="adj" class="form-control">
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

                <a href="<?php echo base_url() ?>ledger_master/create" class="btn btn-sm btn-info">Create Ledger</a>
                
                <!--<a href="#" class="btn btn-sm btn-info">Hold</a>-->
                <!--<a href="#" class="btn btn-sm btn-info">Save and Print</a>-->
                <input type="submit" name="save" value="Save" class="btn btn-success">
              </div>

            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


       <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding: 5px;">
            <div class="box-body">
                    
                   <div class="row">
                    
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Search Product</label>
                          <input type="text" name="searchproduct" id="searchproduct" class="form-control" placeholder="Enter Product Code">
                        </div>
                      </div>
                      
                      <!--<div class="col-md-4 col-sm-4 col-xs-12">-->
                      <!--  <div>-->
                      <!--      <br>-->
                      <!--    <input type="button" name="search" id="search" class="btn btn-sm btn-primary" value="Search">-->
                      <!--  </div>-->
                      <!--</div>-->
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <!-- <th>Conversion</th>
                                            <th>Conversion</th> -->
                                            <th>Base Price</th>
                                            <th>Discount</th>
                                            <th>Gross Price</th>
                                            <th>Gst</th>
                                            <th>GST Amount</th>
                                            <!-- <th>Salesman Commission(%)</th> -->
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
                            <div>
                                <div>
                                    Quantity :-
                                    <input type="text" name="cpno" id="cpno" readonly>
                                </div>
                            </div>
                        </div>
    
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
//   $this->load->view('admin_view/templates/modals/createLedger');
?>



<script>

    var base_url = '<?php echo base_url(); ?>'; 
    
    $('#searchproduct').on('keyup', function(){
        
        var barcode = $(this).val().length;
        
        if(barcode > 9)
        {
            var searchproduct = $('#searchproduct').val();

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
                                    data : {barcode:searchproduct},
                                    success:function(response){
                                        
                                        // console.log(response);
                                        
                                        // conversion();
                                        // discount();
                                        // gst();
                                        
                                        if(response[0].item_status == 'soldout')
                                        {
                                            alert('Product not Available or Soldout');
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
                                                    html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                                    
                                                    html += '<input type="hidden" name="pno[]" value="'+response[0].id+'" required readonly>';

                                                    html += '<input type="text" name="pnoname[]" value="'+response[0].barcode+'" id="pno_'+row_id+'" required readonly>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" class="countQuantity" value="1" readonly>';
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
                                                    html += '<input type="text" name="oldbaseprice[]" value="'+response[0].mrp+'" onchange="mrpChange('+row_id+')" id="baseprice_'+row_id+'" >';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="disvalue[]" id="disvalue_'+row_id+'" class="discountClass" value="0">';
                                                    
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

                                                html += '</td>';
                                                
                                                // html += '<td>';
                                                //     html += '<input type="hidden" name="comm[]" id="comm_'+row_id+'" class="salescomm" value="0">';
                                                //     html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" onkeyup="setSalesmanComm('+row_id+')" value="0">';
                                                // html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" class="finalClass" value="'+response[0].mrp+'" readonly>';
                                                    html += '<input type="hidden" name="hfinalprice[]" id="hfinalprice_'+row_id+'" value="'+response[0].mrp+'" readonly>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="sku[]" value="'+response[0].sku_code+'" id="sku_'+row_id+'" readonly>';

                                                    html += '<input type="text" name="sku_code[]" value="'+response[2].product_code+'" id="sku_'+row_id+'" readonly>';
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
                                                
                                                $('#gst_'+row_id).val(response[1].id);
                                                
                                                loadCount();              
                                        }
                                        
                                        $('#searchproduct').val("");
                                        
                                        // $('#cpno').val("0");
                                        
                                        // loadCount();                                
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
    // $('#searchproduct').on('keyup', function(){
        
        
    //     var barcode = $(this).val().length;
        
    //     if(barcode > 9)
    //     {
        
    //         var searchproduct = $('#searchproduct').val();
        
        
    //             $.ajax({
                
    //                 url: base_url + 'unit/fecthAllData/',
    //                 type: 'post',
    //                 dataType: 'json',
    //                 success:function(unitResponse){
                
                
                
    //                 $.ajax({
                
    //                     url: base_url + 'gst/fecthAllData/',
    //                     type: 'post',
    //                     dataType: 'json',
    //                     success:function(gstResponse){
                        
                        
                        
    //                         $.ajax({
                
    //                             url: base_url + 'discount/fecthAllData/',
    //                             type: 'post',
    //                             dataType: 'json',
    //                             success:function(discountResponse){
                                    
    //                                 var table = $("#consumptionData");
    //                                 var count_table_tbody_tr = $("#consumptionData tr").length;
    //                                 var row_id = count_table_tbody_tr + 1;
                
                
    //                                 $.ajax({
                                        
    //                                     url: base_url + 'internal_consumption/fetchDataByBarcodeId/',
    //                                     type: 'post',
    //                                     dataType: 'json',
    //                                     data : {barcode_code:searchproduct},
    //                                     success:function(response){
                                            
    //                                         // console.log(response);
                                            
    //                                         // conversion();
    //                                         // discount();
    //                                         // gst();

    //                                         if(response.status != 'available')
    //                                         {
    //                                             alert('Data Not Available');
    //                                         }
    //                                         else
    //                                         {
    //                                             // console.log(unitResponse);
                                                
                                                
                                                
                                                
    //                                             var html = '';
                                            
    //                                             html += '<tr id="row_'+row_id+'">';
                                                        
    //                                                 $('#quantity_'+row_id).val("1");
    //                                                 $('#conversionvalue_'+row_id).val("0");
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
    //                                                 html += '<input type="text" name="pno[]" value="'+response.pno+'" id="pno_'+row_id+'" required readonly>';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" class="countQuantity">';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<select name="conversion[]" id="conversion_'+row_id+'" onchange="getConversionData('+row_id+')" >';
    //                                                         html += '<option value="0">---Select One---</option>';
                                                                
    //                                                             $.each(unitResponse, function(index, value) {
                                                                    
    //                                                                html += '<option value="'+value.id+'">'+value.unit+'</option>';
    //                                                             });
                                                                    
    //                                                 html += '</select>';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="text" name="conversionvalue[]" id="conversionvalue_'+row_id+'" readonly>';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="text" name="baseprice[]" value="'+response.baseprice+'" id="baseprice_'+row_id+'" class="bpclass">';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="hidden" name="disvalue[]" id="disvalue_'+row_id+'" class="discountClass">';
                                                    
    //                                                 html += '<select name="discount[]" id="discoount_'+row_id+'" onchange="getDiscount('+row_id+')">';
    //                                                         html += '<option value="0">---Select One---</option>';
                                                                
    //                                                             $.each(discountResponse, function(index, value) {
                                                                    
    //                                                                html += '<option value="'+value.discount+'">'+value.discount+'</option>';
    //                                                             });
                                                                
    //                                                 html += '</select>';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="text" name="grossprice[]" id="grossprice_'+row_id+'" value="'+response.grossprice+'" readonly class="gpClass">';
    //                                             html += '</td>';
                                                
                                                
    //                                             html += '<td>';
    //                                                 html += '<select name="gst[]" id="gst_'+row_id+'"  onchange="getGstData('+row_id+')">';
    //                                                             html += '<option value="0">---Select One---</option>';
                                                                    
    //                                                                 $.each(gstResponse, function(index, value) {
                                                                        
    //                                                                    html += '<option value="'+value.id+'">'+value.gst_name+'</option>';
    //                                                                 });
    //                                                 html += '</select>';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="text" name="gstamt[]" id="gstamt_'+row_id+'" readonly class="txClass">';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" value="0">';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" class="finalClass" readonly>';
    //                                             html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<input type="text" name="sku[]" value="'+response.sku+'" id="sku_'+row_id+'" readonly>';
    //                                             html += '</td>';
                                                
    //                                             // html += '<td>';
    //                                             //     html += response.cat;
    //                                             // html += '</td>';
                                                
    //                                             // html += '<td>';
    //                                             //     html += response.subcat;
    //                                             // html += '</td>';
                                                
    //                                             html += '<td>';
    //                                                 html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
    //                                             html += '</td>';
                                                
                                                
    //                                             html += '</tr>';
                                                
    //                                             $('#consumptionData').append(html);
                                                
    //                                             // $('#bp').val(response.baseprice);
                                                
                                                
    //                                             loadCount();              
    //                                         }
                                        
    //                                         $('#searchproduct').val("");
                                        
    //                                         // $('#cpno').val("0");
                                        
    //                                         // loadCount();                                
    //                                     } 
    //                                 });
                        
        
    //                             }
    //                         });
                
                
    //                     }
    //                 });
            
                
    //             }
            
                
    //         });
            
    //     }          
    // });
    
    
    
    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
        
        loadCount();
    });
     
    // function conversion()
    // {
        
    //      return true;
    // }
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
                
                var sgst = parseInt(response.sgst);
                var cgst = parseInt(response.cgst);
                var igst = parseInt(response.igst);
                var totgst = sgst + cgst + igst;
                // console.log(totgst);
                
                var grossprice = parseFloat($('#grossprice_'+row_id).val());
                
                var gstamt = (grossprice * totgst) / 100;
                // console.log(gstamt);
                $('#gstamt_'+row_id).val(gstamt);
                
                // cal(row_id);
                
                var grossprice = parseFloat($('#grossprice_'+row_id).val());
                var gstamt = parseFloat($('#gstamt_'+row_id).val());
                
                var finalamt = gstamt + grossprice;
        
                $('#finalprice_'+row_id).val(finalamt);
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









