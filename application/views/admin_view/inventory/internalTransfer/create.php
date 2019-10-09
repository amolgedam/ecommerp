<?php 
  // echo "<pre>"; print_r($store); exit();
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Internal Transfer
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Internal Transfer</li>
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

    <form method="post" action="<?php echo base_url() ?>internal_transfer/create">
        

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
                      <label>Transfer Date</label>
                      <input type="hidden" name="inventory_no" value="<?php echo $opening_no; ?>" class="form-control" required>
                      <input type="date" name="date" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>From Division</label>
                      <select name="from_division" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($division as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->division_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>From Branch</label>
                      <select name="from_branch" class="form-control">
                        <option value="0">---Select One---</option>
                            < ?php foreach($branch as $rows): ?>
                                <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->branch_name; ?></option>
                            < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>From Location</label>
                      <select name="from_location" id="from_location" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($location as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->location_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>From Store</label>
                      <select name="from_store" id="from_store" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($store as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->store_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>To Division</label>
                      <select name="to_division" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($division as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->division_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

<!--                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>To Branch</label>
                      <select name="to_branch" class="form-control">
                        <option value="0">---Select One---</option>
                            < ?php foreach($branch as $rows): ?>
                                <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->branch_name; ?></option>
                            < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>To Location</label>
                      <select name="to_location" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($location as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->location_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>To Store</label>
                      <select name="to_store" id="to_store" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($store as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->store_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sub Total</label>
                      <input type="text" name="sub_total" class="form-control" id="bp" readonly>
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
                      <label>Total Discount</label>
                      <input type="text" name="total_discount" class="form-control" id="dis" readonly>
                    </div>
                  </div>

                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Grand Total</label>
                      <input type="text" name="grand_total" class="form-control" id="amt" readonly>
                    </div>
                  </div>
        
              </div>

              <hr>
              <div align="right">
                <!-- <a href="#" class="btn btn-sm btn-info">Save and Print</a> -->
                <input type="submit" name="save" value="Save" class="btn btn-sm btn-success">
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
                          <label>Enter SKU</label>
                          <input type="text" name="searchsku" id="searchsku" class="form-control" placeholder="Enter Product Code" autocomplete="off" >
                          <!-- <input type="text" name="searchproduct" id="searchproduct" class="form-control" placeholder="Enter Product Code"> -->
                          <div style="color: white; background-color: red; padding-left: 15px; display: none;" id="skuStatus">Data Not Available!</div>
                        </div>
                      </div>

                      <div class="col-md-12">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <td>Sr No.</td>
                                  <td>Barcode</td>
                                  <td>Action</td>
                                </tr>
                              </thead>
                              <tbody id="showBarcodes">
                                
                              </tbody>
                            </table>
                          </div>
                      </div>

                      <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <br>
                          <input type="button" name="search" id="search" class="btn btn-sm btn-primary" value="Search">
                        </div>
                      </div>
                         -->
                        <div class="col-md-12 col-sm-12 col-xs-12" id="productData" >
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
                                            <th>Salesman Commission(%)</th>
                                            <th>Final Price</th>
                                            <th>SKU</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id='consumptionData'> 
                                        
                                    </tbody>
                                    
                                </table>
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

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    
    $('#searchsku').on('keyup', function(){

      var searchsku = $('#searchsku').val();
      var from_store = $('#from_store').val();
      var to_store = $('#to_store').val();

      if((from_store != 0) && (to_store != 0))
      {
          var searchsku = $('#searchsku').val();

          if(from_store == to_store)
          {
            alert('Select Different Store');
            $(this).val('');

          }
          else
          {
              $.ajax({
                  url: base_url + 'internal_transfer/getBarcodesBySKUStore/',
                  type: 'post',
                  dataType: 'json',
                  data: {sku:searchsku, from_store:from_store},
                  success:function(response){

                    // console.log(response);

                    if(response == '')
                    {
                      // alert('data not fount');
                      $('#skuStatus').show();
                      $('#showBarcodes').html('');

                    }
                    else
                    {
                        $('#skuStatus').hide();
                        // console.log(response);
                        var table = $("#showBarcodes");
                        var row_id = 1;

                        $.each(response, function(index, value) {
                        
                          table += '<tr>';
                            table += '<td>';
                              table += '<span>'+row_id+'</span>';
                            table += '</td>';
                            table += '<td>';
                              table += '<span>'+value.barcode+'</span>';
                              // table += '   <span>'+value.id+'</span>';
                            table += '</td>';
                            table += '<td>';
                              table += '<a href="javascript:void(0);" onclick="addBarcode('+value.id+')" class="btn btn-info"> Add </a>';
                            table += '</td>';
                          table += '</tr>';

                          row_id ++;
                        });

                          table += '</tbody>';
                        table += '</table>';

                        $('#showBarcodes').html(table);
                    }
                  }
              });
          }
      }
      else
      {
          alert('Select From Store and To Store');
          $(this).val('');
      }
    });

</script>




<!-- ############################################# -->

<script type="text/javascript">

    var base_url = '<?php echo base_url() ?>';

    // $('#searchsku').on('keyup', function(){

    //   var searchsku = $('#searchsku').val();

    //   var from_location = $('#from_location').val();
    //   // alert(from_location);

    //     $.ajax({

    //         url: base_url + 'barcode/getBarcodesBySKU/',
    //         type: 'post',
    //         dataType: 'json',
    //         data: {sku:searchsku, from_location:from_location},
    //         success:function(response){

    //             // console.log(response);

    //             if(response == '')
    //             {
    //               // alert('data not fount');
    //               $('#skuStatus').show();
    //               $('#showBarcodes').html('');

    //             }
    //             else
    //             {
    //               $('#skuStatus').hide();

              
    //                 var table = $("#showBarcodes");

    //                 // var count_table_tbody_tr = $("#showBarcodes tr").length;
    //                 var row_id = 1;

    //                   $.each(response, function(index, value) {
                        
    //                     table += '<tr>';
    //                       table += '<td>';
    //                         table += '<span>'+row_id+'</span>';
    //                       table += '</td>';
    //                       table += '<td>';
    //                         table += '<span>'+value.barcode+'</span>';
    //                         // table += '   <span>'+value.id+'</span>';
    //                       table += '</td>';
    //                       table += '<td>';
    //                         table += '<a href="javascript:void(0);" onclick="addBarcode('+value.id+')" class="btn btn-info"> Add </a>';
    //                       table += '</td>';
    //                     table += '</tr>';

    //                     row_id ++;
    //                   });
                    
    //                 table += '</tbody>';
    //               table += '</table>';

    //               $('#showBarcodes').html(table);

    //               // $('#productData').show();
    //               // alert(row_id);
    //             }
    //         }
    //     });
    // });

    function addBarcode(barcode_id)
    {
      // alert(barcode_id);
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

                              // alert(row_id);

                              $.ajax({
                                
                                url: base_url + 'internal_transfer/getBarcodeData/',
                                type: 'post',
                                dataType: 'JSON',
                                data : {barcode_id:barcode_id},
                                success:function(response){

                                  // alert(row_id);
                                  // alert(row_id);
                                  console.log(response);
                                      
                                      if(response.status != 'available')
                                      {
                                        alert("Barcode Not Available");
                                      }
                                      else
                                      {
                                            var html = '';
                                        
                                            html += '<tr id="row_'+row_id+'">';
                                                    
                                                    $('#quantity_'+row_id).val("1");
                                                    $('#conversionvalue_'+row_id).val("0");
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                                    
                                                    html += '<input type="hidden" name="pno[]" value="'+response.barcode_id+'" id="pno_'+row_id+'" required readonly>';

                                                    html += '<input type="text" name="pnoname[]" value="'+response.pno+'" id="pno_'+row_id+'" required readonly>';

                                                    html += '<input type="hidden" name="barcode_id[]" value="'+response.barcode_id+'" required readonly>';

                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" class="countQuantity" value="1" readonly>';
                                                html += '</td>';
                                                
                                                // html += '<td>';
                                                //     html += '<select name="conversion[]" id="conversion_'+row_id+'" onchange="getConversionData('+row_id+')" >';
                                                //             html += '<option value="0">---Select One---</option>';
                                                                
                                                //                 $.each(unitResponse, function(index, value) {
                                                                    
                                                //                    html += '<option value="'+value.id+'">'+value.unit+'</option>';
                                                //                 });
                                                                    
                                                //     html += '</select>';
                                                // html += '</td>';
                                                
                                                // html += '<td>';
                                                //     html += '<input type="text" name="conversionvalue[]" id="conversionvalue_'+row_id+'" readonly>';
                                                // html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="baseprice[]" value="'+response.baseprice+'" id="baseprice_'+row_id+'" class="bpclass">';
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
                                                    html += '<input type="text" name="grossprice[]" id="grossprice_'+row_id+'" value="'+response.grossprice+'" readonly class="gpClass">';
                                                html += '</td>';
                                                
                                                
                                                html += '<td>';
                                                    html += '<select name="gst[]" id="gst_'+row_id+'"  onchange="getGstData('+row_id+')">';
                                                                html += '<option value="">---Select One---</option>';
                                                                    
                                                                    $.each(gstResponse, function(index, value) {
                                                                        
                                                                       html += '<option value="'+value.id+'">'+value.gst_name+'</option>';
                                                                    });
                                                    html += '</select>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="gstamt[]" id="gstamt_'+row_id+'" readonly class="txClass">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" value="0">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" class="finalClass" readonly>';
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
                                                
                                                $('#gst_'+row_id).val(response.gst_id);
                                                $('#gstamt_'+row_id).val('0');
                                                $('#finalprice_'+row_id).val(response.baseprice);
                                                  
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

<!-- 
<script>

    var base_url = '< ?php echo base_url(); ?>'; 
    
    $('#search').on('click', function(){
        
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
                                    
                                    url: base_url + 'internal_consumption/fetchDataByBarcodeId/',
                                    type: 'post',
                                    dataType: 'json',
                                    data : {barcode_code:searchproduct},
                                    success:function(response){
                                        
                                        // console.log(response);
                                        
                                        // conversion();
                                        // discount();
                                        // gst();
                                        
                                        if(response.status != 'available')
                                        {
                                            alert('Data Not Available');
                                        }
                                        else
                                        {
                                            // console.log(unitResponse);
                                            
                                            
                                            
                                            
                                            var html = '';
                                        
                                            html += '<tr id="row_'+row_id+'">';
                                                    
                                                    $('#quantity_'+row_id).val("1");
                                                    $('#conversionvalue_'+row_id).val("0");
                                                
                                                html += '<td>';
                                                    html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                                    html += '<input type="text" name="pno[]" value="'+response.pno+'" id="pno_'+row_id+'" required readonly>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" class="countQuantity">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<select name="conversion[]" id="conversion_'+row_id+'" onchange="getConversionData('+row_id+')" >';
                                                            html += '<option value="0">---Select One---</option>';
                                                                
                                                                $.each(unitResponse, function(index, value) {
                                                                    
                                                                   html += '<option value="'+value.id+'">'+value.unit+'</option>';
                                                                });
                                                                    
                                                    html += '</select>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="conversionvalue[]" id="conversionvalue_'+row_id+'" readonly>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="baseprice[]" value="'+response.baseprice+'" id="baseprice_'+row_id+'" class="bpclass">';
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
                                                    html += '<input type="text" name="grossprice[]" id="grossprice_'+row_id+'" value="'+response.grossprice+'" readonly class="gpClass">';
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
                                                    html += '<input type="text" name="gstamt[]" id="gstamt_'+row_id+'" readonly class="txClass">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" value="0">';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" class="finalClass" readonly>';
                                                html += '</td>';
                                                
                                                html += '<td>';
                                                    html += '<input type="text" name="sku[]" value="'+response.sku+'" id="sku_'+row_id+'" readonly>';
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
    });
    
</script> -->

<script>

    
     
    // function conversion()
    // {
        
    //      return true;
    // }

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
        // alert("hi");
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
            
            tx += parseFloat($(this).val(), 10);
        });
        $('#tx').val(tx);
        console.log(tx);
        
        
        $('.finalClass').each(function() {
            
            amt += parseFloat($('.finalClass').val(), 10);
        });
        $('#amt').val(amt);
        $('#invoice_value').val(amt);
    }
    
</script>










