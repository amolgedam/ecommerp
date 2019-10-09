<!-- < ?php echo "<pre>"; print_r($allData); exit; ?> -->
  <!-- Content Wrapper. Contains page content -->

<?php
  $skuData = $this->model_sku->fecthSkuDataByID($allData['sku']);

  // echo "<pre>"; print_r($skuData); exit();
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Invoice Item
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Invoice Item</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
                <form method="post" action="<?php echo base_url('opening_stockitem/update') ?>">
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12" style="display: none;">
                    <div>
                      <label>Store</label>
                      <select name="store" class="form-control" disabled>
                        <option value="0">---Select One---</option>
                        <?php foreach($store as $rows): ?>
                            <option value="<?php echo $rows['id']; ?>" <?php echo $allData['store_id'] == $rows['id'] ? "selected" : ""; ?> ><?php echo $rows['store_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                        <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" >
                        <input type="hidden" name="order_id" value="<?php echo $allData['order_id']; ?>" >
                        <input type="hidden" name="order_code" value="<?php echo $allData['order_code'] ?>" >
                        
                      <label>Product Category</label>
                      <select name="product_category" id="category" class="form-control">
                        <option value="0">---Select One---</option>

                        <?php foreach($category as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $skuData['category_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->catgory_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Product Sub-Category</label>
                      <select name="product_subcategory" id="sub_category" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($subcategory as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $skuData['subcategory_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->subcategory_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>  

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>SKU</label>
                      <div class="row">
                        <div class="col-md-10">
                            <select name="sku" id="sku" class="form-control">
                              <option value="0">---Select One---</option>
                                <?php foreach($sku as $rows): ?>
                                    <option value="<?php echo $rows->id; ?>"  <?php echo $allData['sku'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->product_code; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                         <div class="col-md-2">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSku" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Brand</label>
                      <div class="row">
                        <div class="col-md-10">
                          <select name="brand" id="brand" class="form-control">
                            <option value="0">---Select One---</option>
                            <?php foreach($brand as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['brand'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->brand_name; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addBrand" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Unit</label>
                      <div class="row">
                        <div class="col-md-12">
                            <!--<input type="hidden" name="unit" id="unitValue" class="form-control">-->
                          <select name="unit" id="unit" class="form-control">
                            <option value="0">---Select One---</option>
                            <?php foreach($unit as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['unit'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->unit; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <!--<div class="col-md-2">-->
                        <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addUnit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                      </div>
                    </div>
                  </div>
                  
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>HSN ID</label>
                      <div class="row">
                        <div class="col-md-10">
                          <select name="hsn" id="hsnData" class="form-control">
                            <option value="0">---Select One---</option>
                            <?php foreach($hsn as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['hsn'] == $rows->id ? "selected" : ""; ?>  ><?php echo $rows->hsn_code; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addHsn" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Quantity</label>
                        <input type="hidden" name="qualityOld" value="<?php echo $allData['quality'] ?>" class="form-control">
                      <input type="text" name="quality" id="quality" value="<?php echo $allData['quality'] ?>" class="form-control check">
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Base Price</label>
                        <input type="hidden" name="base_priceOld" value="<?php echo $allData['base_price'] ?>" class="form-control">
                      <input type="text" name="base_price" id="base_price" value="<?php echo $allData['base_price'] ?>" class="form-control check">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>GST</label>
                       <div class="row">
                        <div class="col-md-12">
                        <input type="hidden" name="gstOld" value="<?php echo $allData['gst'] ?>" class="form-control">

                          <select name="gst" id="gst" ng-model="gst" class="form-control">
                            <option value="10">---Select One---</option>
                            <?php foreach($gst as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['gst'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->gst_name; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                        <?php 
                          $gstData = $this->model_gst->fetchAllDataByID($allData['gst']);
                        ?>

                        <!--<div class="col-md-2">-->
                        <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addGst" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>SGST</label>
                      <input type="text" name="sgst" id="sgst" value="<?php echo $gstData['sgst'] ?>" class="form-control" readonly disabled>
                      
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>CGST</label>
                      <input type="text" name="cgst" id="cgst" value="<?php echo $gstData['cgst'] ?>" class="form-control" readonly disabled>
                      
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>IGST</label>
                      <input type="text" name="igst" id="igst" value="<?php echo $gstData['igst'] ?>" class="form-control" readonly disabled>
                      
                    </div>
                  </div> 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Net Price/Unit</label>
                      <input type="text" name="pur_price" id="pur_price" value="<?php echo $allData['base_price'] ?>" class="form-control" readonly disabled>
                    </div>
                  </div>


                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>WSP (%)</label>
                      <input type="text" name="wsp" id="wsp" value="<?php echo $allData['wsp'] ?>" class="form-control">
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>WSP Net Price Unit</label>
                      <input type="text" name="wspp" id="wspp" value="<?php echo $allData['wspp'] ?>" class="form-control" readonly>
                      <input type="hidden" name="oldwspp" value="<?php echo $allData['wspp'] ?>" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Location</label>
                      <select name="location" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($location as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $allData['location'] == $rows->id ? "selected" : ""; ?>><?php echo $rows->location_name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>MRP</label>
                      <input type="text" name="mrp" id="mrp" value="<?php echo $allData['mrp'] ;?>"  class="form-control check" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sales Discount Code</label>
                      <select name="discount_code" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($discount as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $allData['discount_code'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->discount; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Salesman Commision</label>
                      <input type="text" name="comm" value="<?php echo $allData['comm'] ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Remark</label>
                      <textarea name="remark" value="<?php echo $allData['remark'] ?>" class="form-control"></textarea>
                    </div>
                  </div>
              </div>

              <hr>
              <div align="right">
                <!--<a href="#" >Save and New</a>-->
                <!--<button type="submit" name="submitForm" class="btn btn-primary myBtn" value="formSave">Save and New</button>-->
                <input type="submit" name="save" value="Save" class="btn btn-success myBtn">
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
  $this->load->view('admin_view/templates/modals/addBrand');
  $this->load->view('admin_view/templates/modals/addUnit');
  $this->load->view('admin_view/templates/modals/addHSN');
  $this->load->view('admin_view/templates/modals/addGST');

  $this->load->view('admin_view/templates/modals/addColor');
  $this->load->view('admin_view/templates/modals/addSize');
  $this->load->view('admin_view/templates/modals/addTexture');
  $this->load->view('admin_view/templates/modals/addStyleOne');
  $this->load->view('admin_view/templates/modals/addStyleTwo');
  $this->load->view('admin_view/templates/modals/addType');
?>


<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url() ?>';
        
       
        
        $('.check').on('keyup', function(){
            
             btnEnable();
        });
        
        // $(".myBtn").attr("disabled", true);
        // $("#itemsave").attr("disabled", true);
        
        $('#itemQuantity').on('keyup', function(){
            
          var itemQuantity = $(this).val();
          var quality = $('#quality').val();
          
          $('#orderQuantity').val(quality);
           
        //   alert(itemQuantity); alert(quality);
           
        //   if(quality < itemQuantity)
        //   {
               
        //       alert('Quantity not Valid');
        //   }
        //   else
        //   {
        //       $("#itemsave").attr("disabled", false);
        //   }
        });
        
        $('#mrp').on('change', function(){
            
           var mrp = parseInt($(this).val());
           var base_price = parseInt($('#base_price').val());
           
          if(mrp < base_price)
          {
              alert("MRP Less than Base Price");
              $(this).val("");
          }
        //   else
        //   {
        //       alert(base_price + mrp)
        //   }
        });
        
        function btnEnable()
        {
            var quantity = $('#quality').val();
            var mrp = $('#mrp').val();
            var base_price = $('#base_price').val();
            
            if(mrp != '' && quantity != '')
            {
                $(".myBtn").attr("disabled", false);
            }
            
        }
        
        // alert(base_url);
        $('#category').on('change', function(){
            
            $('#sub_category').html('');
            
            var cat_id = $(this).val();
            // alert(accountcat_id);
            var html = '';
            
              $.ajax({
                    
                    url: base_url + 'product_category/fecthAllSubCatDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {cat_id:cat_id},
                    success:function(response){
                        
                        // console.log(response);
                        html += '<option>---Select One---</option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.subcategory_name+'</option>';             
                        });
                        
                        $('#sub_category').append(html);
                    }
              });
              
            //   $.ajax({
                    
            //         url: base_url + 'sku/fecthSkuByCatID/',
            //         type: 'post',
            //         dataType: 'json',
            //         data : {cat_id:cat_id},
            //         success:function(response){
                        
            //             // console.log(response);
            //             html += '<option>---Select One---</option>';
            //             $.each(response, function(index, value) {
            //               html += '<option value="'+value.id+'">'+value.product_code+'</option>';             
            //             });
                        
            //             $('#sub_category').append(html);
            //         }
            //   });
        });
        
        $('#sku').on('change', function(){
            
            var sku = $(this).val();
            // alert(sku);
            $.ajax({
                    
                    url: base_url + 'sku/getDataBySkuID/',
                    type: 'post',
                    dataType: 'json',
                    data : {sku:sku},
                    success:function(response){
                        
                        // console.log(response.unit_id);
                        $('#unitValue').val(response.unit_id);
                        $('#unit').val(response.unit_id);
                    }
              });
        });
        
        $('#gst').on('change', function(){
            
            var gst_id = $(this).val();
            // alert(gst_id);
            $.ajax({
                    
                    url: base_url + 'gst/fetchAllDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {gst_id:gst_id},
                    success:function(response){
                        
                        // console.log(response);
                        $('#sgst').val(response.sgst);
                        $('#cgst').val(response.cgst);
                        $('#igst').val(response.igst);
                        
                        // 
                        // $('#totalgst').val(totalgst);
                        totalgst()
                    }
              });
        });
        
        // totalgst();
        
        $('#wsp').on('keyup', function(){
            
            totalgst();
        });
        
        function totalgst()
        {
            var sgst = parseFloat($('input[name=sgst]').val());
            var cgst = parseFloat($('input[name=cgst]').val()); 
            var igst = parseFloat($('input[name=igst]').val());
            var base_price = parseFloat($('input[name=base_price]').val());
            
            
            var tax = (sgst + cgst + igst) * base_price / 100 ;
            var amtTax = tax + base_price;
            
            var wsp = $('#wsp').val();
            var amtWsp = amtTax * wsp;
            
            var perNetPrice = amtTax.toFixed(2);
            var wspPrice = amtWsp.toFixed(2);
            
            $('#pur_price').val(perNetPrice);
            $('#wspp').val(wspPrice);
            
            // alert(tax); alert(perNetPrice);
        }
        
        // setInterval(function(){
            
            color(); size(); pattern(); style1(); style2(); type();
        // }, 300);
        
        function color()
        {
            $('#color').html('');
            
            var color_id = '4';
            var html = '';
             
            $.ajax({
                    
                    url: base_url + 'attribute/fetchDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {id:color_id},
                    success:function(response){
                        
                        // var myJsonString = JSON.stringify(response);
                        
                        // console.log(myJsonString);
                        html += '<option value="0">---Select One---</option>';
                        
                        $.each(response, function(index, value) {
                          html += '<option value="'+value+'">'+value+'</option>';
                        //   no++;
                        });
                        
                        $('#color').append(html);
                    }
              });
        }
        
        function size()
        {
            $('#size').html('');
            
            var color_id = '5';
            var html = '';
             
            $.ajax({
                    
                    url: base_url + 'attribute/fetchDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {id:color_id},
                    success:function(response){
                        
                        // var myJsonString = JSON.stringify(response);
                        
                        // console.log(myJsonString);
                        html += '<option value="0">---Select One---</option>';
                        
                        $.each(response, function(index, value) {
                          html += '<option value="'+value+'">'+value+'</option>';
                        //   no++;
                        });
                        
                        $('#size').append(html);
                    }
              });
        }
        
        function pattern()
        {
            $('#pattern').html('');
            
            var color_id = '6';
            var html = '';
             
            $.ajax({
                    
                    url: base_url + 'attribute/fetchDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {id:color_id},
                    success:function(response){
                        
                        // var myJsonString = JSON.stringify(response);
                        
                        // console.log(myJsonString);
                        html += '<option value="0">---Select One---</option>';
                        
                        $.each(response, function(index, value) {
                          html += '<option value="'+value+'">'+value+'</option>';
                        //   no++;
                        });
                        
                        $('#pattern').append(html);
                    }
              });
        }
        
        function style1()
        {
            $('#style1').html('');
            
            var color_id = '7';
            var html = '';
             
            $.ajax({
                    
                    url: base_url + 'attribute/fetchDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {id:color_id},
                    success:function(response){
                        
                        // var myJsonString = JSON.stringify(response);
                        
                        // console.log(myJsonString);
                        html += '<option value="0">---Select One---</option>';
                        
                        $.each(response, function(index, value) {
                          html += '<option value="'+value+'">'+value+'</option>';
                        //   no++;
                        });
                        
                        $('#style1').append(html);
                    }
              });
        }
        
        function style2()
        {
            $('#style2').html('');
            
            var color_id = '8';
            var html = '';
             
            $.ajax({
                    
                    url: base_url + 'attribute/fetchDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {id:color_id},
                    success:function(response){
                        
                        // var myJsonString = JSON.stringify(response);
                        
                        // console.log(myJsonString);
                        html += '<option value="0">---Select One---</option>';
                        
                        $.each(response, function(index, value) {
                          html += '<option value="'+value+'">'+value+'</option>';
                        //   no++;
                        });
                        
                        $('#style2').append(html);
                    }
              });
        }
        
        function type()
        {
            $('#type').html('');
            
            var color_id = '9';
            var html = '';
             
            $.ajax({
                    
                    url: base_url + 'attribute/fetchDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {id:color_id},
                    success:function(response){
                        
                        // var myJsonString = JSON.stringify(response);
                        
                        // console.log(myJsonString);
                        html += '<option value="0">---Select One---</option>';
                        
                        $.each(response, function(index, value) {
                          html += '<option value="'+value+'">'+value+'</option>';
                        //   no++;
                        });
                        
                        $('#type').append(html);
                    }
              });
        }
    });
</script>