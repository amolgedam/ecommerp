<!--< ?php print_r($salesorderData); exit; ?>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
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
     
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <?php echo form_open('sales_order/addQty'); ?>
                <div class="row">
                  
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>SKU</label>
                      <div class="row">
                        <!--<div class="col-md-2">-->
                        <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSku" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                        <div class="col-md-12">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>" required>
                            
                            
                            <input list="sku"  class="form-control" placeholder="Enter SKU"  name="sku" required autocomplete="off">
                            <datalist id="sku">
                              <?php foreach($sku as $rows): ?>
                                <option value="<?php echo $rows['product_code']; ?>"><?php echo $rows['product_code']; ?></option>
                              <?php endforeach; ?>
                            </datalist>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <label>Quantity</label>
                      <input type="text" name="quality" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <label>Estimated Price</label>
                      <input type="text" name="estimate_price" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <label>Remark</label>
                      <input type="text" name="remark" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <br>
                      <!--<a href="#" class="btn btn-sm btn-info">Add</a>-->
                      <input type="submit" value="Add" class="btn btn-sm btn-info">
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <label>Search Product</label>
                      <input type="text" name="barcode" id="barcode" class="form-control">

                    </div>
                  </div>
                
              </div>
                <?php echo form_close(); ?>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
                <div class="row">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Sr No.</th>
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Estimated Price</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </tr>
                            <?php $no=1; foreach($allQty as $rows): ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $rows->sku; ?></td>
                                    <td><?php echo $rows->quantity; ?></td>
                                    <td>
                                      <?php echo $rows->price; ?>
                                      <!-- <input type="hidden" name="price" class="finalClass" value="< ?php echo $rows->price; ?>">     -->
                                    </td>
                                    <td><?php echo $rows->remark; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>sales_order/updateQty/<?php echo $rows->id; ?>" class="btn btn-sm btn-info">Edit</a>
                                        <a href="<?php echo base_url(); ?>sales_order/deleteQty/<?php echo $rows->id; ?>/<?php echo $rows->salesorder_id ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php $no++; endforeach; ?>
                        </table>
                    </div>  
                  
                </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <!-- <form method="post" action="< ?php echo base_url('sales_order/addOrderByBarcode'); ?>"> -->

              <?php echo form_open('sales_order/addOrderByBarcode'); ?>

              
                <div class="row">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>" required>
                    <input type="hidden" name="tot_invoice" id="invoice_value">

                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Conversion</th>
                                <th>Conversion</th>
                                <th>MRP</th>
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

                    <div class="row" align="right" style="padding-right: 30px">
                        <br><br><br>
                        <hr>
                        <a href="<?php echo base_url() ?>sales_order/salesOrderReport/<?php echo $id; ?>" class="btn btn-sm btn-info">Print Order</a>
                        
                        <?php if($salesorderData['paymentstatus'] == 'no'): ?>
                            <a href="<?php echo base_url() ?>sales_order/makepayment/<?php echo $id; ?>" class="btn btn-sm btn-info">Make Payment</a>
                        <?php endif; ?>
                        
                        <input type="submit" name="barcodesave" value="Save" class="btn btn-sm btn-success">
                        
                    </div>
                  
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

<!-- Modals -->
<?php
  $this->load->view('admin_view/templates/modals/addSKU');
  $this->load->view('admin_view/templates/modals/createLedger');
?>


<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';


  $('#barcode').on('keyup', function(){

      var barcode = $(this).val().length;

      // barcode.length;
      // $.trim(barcode);
      if(barcode > 9)
      {
        var barcode_code = $(this).val(); 
        // console.log(barcode_code);
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
                              data : {barcode:barcode_code},
                              success:function(response){

                              // console.log(response);

                              // console.log(barcode_code);


                                  if(response[0].item_status == 'soldout')
                                  {
                                      alert('Product not Available or Soldout');
                                  }
                                  else
                                  {
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


                                      var html = '';
                                            
                                      html += '<tr id="row_'+row_id+'">';
                                              
                                              $('#quantity_'+row_id).val("1");
                                              $('#conversionvalue_'+row_id).val("0");
                                          
                                          html += '<td>';
                                              html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                              html += '<input type="text" name="pno[]" value="'+response[0].barcode+'" id="pno_'+row_id+'" required readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" class="countQuantity" value="1" readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '&nbsp;';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '&nbsp;';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="baseprice[]" value="'+response[0].mrp+'" id="baseprice_'+row_id+'" class="bpclass">';
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
                                              html += '<input type="text" name="gstamt[]" id="gstamt_'+row_id+'" readonly class="txClass" onblur="'+loadCount()+'" value="'+gst+'">';
                                              
                                              html += '<input type="hidden" name="hgstamt[]" id="hgstamt_'+row_id+'" readonly value="'+gst+'">';

                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" value="0">';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" class="finalClass" readonly value="'+response[0].mrp+'">';
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
                                          
                                          $('#consumptionData').append(html);
                                          
                                          // $('#bp').val(response.baseprice);
                                          
                                          $('#gst_'+row_id).val(response[1].id);

                                          
                                          loadCount();

                                          $('#barcode').val('');
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

  $(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
      
      loadCount();
  });

  function loadCount()
  {
      var pno=0; var bprice=0; var discount=0; var gp=0; var tx=0; var amt=0;
        
        // $('.countQuantity').each(function() {
            
        //     pno += parseFloat($('.countQuantity').val(), 10);
        // });
        // $('#no').val(pno);
        // $('#cpno').val(pno);
        
    
        
        // $('.bpclass').each(function() {
            
        //     bprice += parseFloat($('.bpclass').val(), 10);
        // });
        // $('#bp').val(bprice);
        
        // $('.discountClass').each(function() {
            
        //     discount += parseFloat($('.discountClass').val(), 10);
        // });
        // $('#dis').val(discount);
        
        // $('.gpClass').each(function() {
            
        //     gp += parseFloat($('.gpClass').val(), 10);
        // });
        // $('#gp').val(gp);
        

        // $('.txClass').each(function() {
            
        //     tx += parseFloat($('.txClass').val(), 10);
        // });
        // $('#tx').val(tx);
        
        
        $('.finalClass').each(function() {
            
            amt += parseFloat($(this).val(), 10);
        });
        $('#amt').val(amt);
        $('#invoice_value').val(amt);
        // console.log(amt);
  }

  loadCount();

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

                var mrp = parseFloat($('#baseprice_'+row_id).val());

                var mytot = (mrp * totgst);
                var tot = 100 + totgst;
                var gstvalue = mytot / tot;

                var gst = (gstvalue).toFixed(3); 

                var gprice = mrp - gst; 

                $('#gstamt_'+row_id).val(gst);
                $('#hgstamt_'+row_id).val(gst);

                $('#grossprice_'+row_id).val(gprice);
                $('#hgrossprice_'+row_id).val(gprice);

                var grossprice = parseFloat($('#grossprice_'+row_id).val());
                var gstamt = parseFloat($('#hgstamt_'+row_id).val());
                
                var amt = Number(gstamt) + Number(grossprice);
                var finalamt = (amt).toFixed(3);
        
                $('#finalprice_'+row_id).val(finalamt);
                $('#hfinalprice_'+row_id).val(finalamt);


                // var price = Number(gstamount) + Number(newprice);
                // var fprice = (price).toFixed(3);
                // $('#finalprice_'+row_id).val(fprice);
                
                  
                // var gstamt = (grossprice * totgst) / 100;
                // // console.log(gstamt);
                // $('#gstamt_'+row_id).val(gstamt);
                
                // // cal(row_id);
                
                // var grossprice = parseFloat($('#grossprice_'+row_id).val());
                // var gstamt = parseFloat($('#gstamt_'+row_id).val());
                
                // var finalamt = gstamt + grossprice;
        
                // $('#finalprice_'+row_id).val(finalamt);
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


