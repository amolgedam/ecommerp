<!--< ?php echo "<pre>"; print_r($ledgerAccount); exit; ?>-->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Sales Invoice
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Sales Invoice</li>
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
    
    <form method="post" action="<?php echo base_url() ?>sales_invoice/create">
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
                        <input type="text" name="inventory_no" value="<?php echo $opening_no; ?>" class="form-control" readonly>
                      </div>
                    </div>
                
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div>
                        <label>Invoice Date</label>
                        <input type="hidden" name="salesinvoicetype" value="<?php echo $salesinvoicetype ?>" >
                        <!--<input type="date" name="date" required class="form-control" id="datetimepicker1">-->
                        <input type="text" name="date" class="form-control" required id="mydate" />
                      </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div>
                        <label>Sales Account</label>
                        <select name="saccount" id="saccount" class="form-control">
                          <option value="0">---Select One---</option>
                            <?php foreach($ledgerPurSalesAccount as $rows): ?>
                              <?php if($this->session->userdata['wo_company'] == $rows->company_id){ ?>

                              <option value="<?php echo $rows->id; ?>" <?php echo $lastData['sales_account'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
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
                            
                                <option value="<?php echo $rows['id']; ?>" <?php echo $lastData['account'] == $rows['id'] ? "selected" : ""; ?>><?php echo $rows['ledger_name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div>
                        <label>Salesman</label>
                        <input type="hidden" name="salesmanComm" id="salesmancomm"> 
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
                        <label>Shiping Details</label>
                        <input type="text" name="shiping_details" class="form-control">
                      </div>
                    </div>  
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div>
                        <label>Shiping Type</label>
                        <input type="text" name="shiping_type" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div>
                        <label>Division</label>
                        <select name="division" id="division" class="form-control">
                            <option value="0">---Select One---</option>
                            <?php foreach($division as $rows): ?>
                             <option value="<?php echo $rows->id; ?>" <?php echo $lastData['division'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->division_name; ?></option>
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
                        <label>Sales Type</label>
                        <select name="sales_type" class="form-control">
                            <option value="0">---select one---</option>
                          <?php foreach($taxAndDuties as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $lastData['sale_type'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div>
                        <label>No. of Product</label>
                        <input type="text" name="no_ofproduct" class="form-control" id="no" readonly>
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
                        <label>Total Invoice</label>
                        <input type="text" name="total_invoice" id="invoice_value" class="form-control" readonly="">
                      </div>
                    </div>             
                </div>

                <hr>
                <div align="right">
                    <a href="<?php echo base_url() ?>sales_invoice/create" class="btn btn-info">New Invoice</a>
        
                    <a href="<?php echo base_url() ?>ledger_master/create" class="btn btn-info">Create Ledger</a>
                      
                    <input type="submit" name="save" value="Hold" class="btn btn-success">
                    <!--<a href="< ?php echo base_url() ?>" class="btn btn-info">Hold</a>-->
                    
                    <input type="submit" name="save" value="Make Payment" class="btn btn-success">
                    <!--<a href="< ?php echo base_url() ?>" class="btn btn-info">Make Payment</a>-->
                      
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
                
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="col-md-4">
                            <div>
                              <label>Search Product</label>
                              <input type="text" name="searchproduct" id="searchproduct" class="form-control" placeholder="Enter Product Code">
                            </div>
                        </div>
                        <!--<div class="col-md-4">-->
                        <!--    <div>-->
                        <!--      <br>-->
                        <!--      <input type="button" name="search" id="search" class="btn btn-sm btn-primary" value="Search">-->
                        <!--    </div>-->
                        <!--</div>-->
                      </div>
                        
                        
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="col-md-8">
                                <label>Sales Order No.</label>
                                <select name="sorder" id="sorder" class="form-control">
                                  <option value="0">---Select one---</option>
                                  <?php foreach($sorder as $rows): ?>
                                        <option value="<?php echo $rows['id']; ?>"><?php echo $rows['order_no']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                              </div>
                              
                              <input type="hidden" name="orderno" id="orderno">
                              
                              <div class="col-md-4">
                                <br>
                                <a href="#" class="btn btn-sm btn-info" id="addOrder">Add</a>
                              </div>
                        </div>
                </div>
                
                <br><br>

                 <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                               <!--  <th>Conversion</th>
                                <th>Conversion</th> -->
                                <th>MRP</th>
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

<link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

 
<script>
    
     $("#mydate").datepicker().datepicker("setDate", new Date());
     
    var base_url = '<?php echo base_url(); ?>'; 
    
    // $(function () {
    //     $('#datetimepicker1').datetimepicker();
    //  });
    
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
                                                
                                                var read = mrp = '';
                                                if(response[0].unit_id == '18')
                                                {
                                                    read = 'readonly';
                                                    mrp = '<input type="text" name="oldbaseprice[]" value="'+response[0].mrp+'" onchange="mrpChange('+row_id+')" id="baseprice_'+row_id+'" >';
                                                }
                                                else
                                                {
                                                    read = '';
                                                    mrp = '<input type="text" name="oldbaseprice[]" value="'+response[0].mrp+'" onchange="mrpChange1('+row_id+')" id="baseprice_'+row_id+'" >';
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
                                                    html += mrp;
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
        // $('#finalprice_'+row_id).val(newprice);

        // var oldGst = parseFloat($('#hgstamt_'+row_id).val());
        
        // var newGst = (oldGst * discount) / 100;
        // var gstvalue = oldGst - newGst;

        // var gstamount = (gstvalue).toFixed(3);

        // console.log(newprice);
        // $('#gstamt_'+row_id).val(gstamount);

        // var oldFprice = parseFloat($('#hfinalprice_'+row_id).val());
        // var newFprice = (oldFprice * discount) /100;
        // var fprice = oldFprice - newFprice;

        // $('#finalprice_'+row_id).val(fprice);
        // $('#hfinalprice_'+row_id).val(fprice);

        var gst_id = $('#gst_'+row_id).val();

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

                // var mrp = parseFloat($('#baseprice_'+row_id).val());
                // var mytot = (newprice * totgst);
                // var tot = 100 + totgst;
                // var gstvalue = mytot / tot;
                
                
                var gstvalue = newprice * totgst / 100;
                // console.log(gst);
                var gst = (gstvalue).toFixed(3); 
                
                // console.log("gprice"+ newprice+" gst "+totgst+"= "+gst);


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

                var mrp = parseFloat($('#baseprice_'+row_id).val());

                var mytot = (mrp * totgst);
                var tot = 100 + totgst;
                var gstvalue = mytot / tot;

                var gst = (gstvalue).toFixed(3); 

                var gprice = mrp - gst; 

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

    function mrpChange(row_id) {
      
        var baseprice = $('#baseprice_'+row_id).val();
        
        $('#grossprice_'+row_id).val(baseprice);
        $('#hgrossprice_'+row_id).val(baseprice);

        getGstData(row_id);
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
</script>

<script>
    var sum = 1;
    var baseprice = 0;
    function loadCount()
    {
        var pno=0; var bprice=0; var discount=0; var gp=0; var tx=0; var comm=0; var amt=0;
        
        $('.countQuantity').each(function() {
            
            pno += parseFloat($('.countQuantity').val(), 10);
        });
        $('#no').val(pno);
        $('#cpno').val(pno);
        
    
        
        $('.bpclass').each(function() {
            
            bprice += parseFloat($(this).val(), 10);
        });
        bprice = (bprice).toFixed(3);
        $('#bp').val(bprice);
        
        $('.discountClass').each(function() {
            
            discount += parseFloat($('.discountClass').val(), 10);
        });
        discount = (discount).toFixed(3);
        
        $('#dis').val(discount);
        
        $('.gpClass').each(function() {
            
            gp += parseFloat($(this).val(), 10);
        });
        gp = (gp).toFixed(3);
        $('#gp').val(gp);
        

        $('.txClass').each(function() {
            
            tx += parseFloat($(this).val(), 10);
        });
        tx = (tx).toFixed(3);
        $('#tx').val(tx);
        
        
        
        $('.salescomm').each(function(){
            
            comm += parseFloat($(this).val(), 10);
        });
        comm = (comm).toFixed(3);
        $('#salesmancomm').val(comm);
        
        
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

<script>
    
     var base_url = "<?php echo base_url(); ?>";
     
    $('#addOrder').on('click', function(){
        
          var orderno = $('#sorder').val();
        //   alert(orderno);
        
        var order = $('#orderno').val();
        
        if(order == '')
        {
            $('#orderno').val(orderno);
            
            $.ajax({
                
               url: base_url + 'sales_invoice/getOrderDataByID/',
                type: 'post',
                dataType: 'json',
                data : {orderno:orderno},
                success:function(response){
                    
                    // console.log(response);
                    $('#saccount').val(response.sales_account_id);
                    $('#account').val(response.account_id);
                } 
            });
            
        }
        else
        {
            alert("Order Already Added");
        }
    })
</script>

