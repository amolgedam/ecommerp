<!--< ?php print_r($sku);exit; ?>-->
  
  <!-- Content Wrapper. Contains page content -->
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <form method="post" action="<?php echo base_url('purchase_invoiceitem/create') ?>">
                <div class="row">

                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Store</label>
                      <select name="store" class="form-control">
                        < ?php foreach($store as $rows): ?>
                            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->store_name; ?></option>
                        < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->


                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                        <input type="hidden" name="order_id" value="<?php echo $id ?>" >
                        <input type="hidden" name="order_code" value="<?php echo $randomCode ?>" >
                        
                      <label>Product Category</label>
                      <select name="product_category" id="category" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($category as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->catgory_name; ?></option>
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
                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->subcategory_name; ?></option>
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
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->product_code; ?></option>
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
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->brand_name; ?></option>
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
                            <input type="hidden" name="unit" id="unitValue" class="form-control">
                          <select name="unitid" id="unit" class="form-control">
                            <option value="0">---Select One---</option>
                            <?php foreach($unit as $rows): ?>
                                <!--<option value="< ?php echo $rows->id; ?>">< ?php echo $rows->unit_cat_name; ?></option>-->
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->unit; ?></option>
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
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->hsn_code; ?></option>
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
                      <input type="text" name="quality" id="quality" class="form-control check">
                        <input id="txtQty" name="quantitypieces" type="text" class="form-control check">
                    </div>
                    </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Base Price</label>
                      <input type="text" name="base_price" id="base_price" class="form-control check">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>GST</label>
                       <div class="row">
                        <div class="col-md-12">
                          <select name="gst" id="gst" ng-model="gst" class="form-control">
                            <option value="10">---Select One---</option>
                            <?php foreach($gst as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->gst_name; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <!--<div class="col-md-2">-->
                        <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addGst" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>SGST</label>
                      <input type="text" name="sgst" id="sgst" class="form-control" readonly disabled>
                      
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>CGST</label>
                      <input type="text" name="cgst" id="cgst" class="form-control" readonly disabled>
                      
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>IGST</label>
                      <input type="text" name="igst" id="igst" class="form-control" readonly disabled>
                      
                    </div>
                  </div> 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Net Price/Unit</label>
                      <input type="text" name="pur_price" id="pur_price" class="form-control" readonly>
                    </div>
                  </div>


                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>WSP (%)</label>
                      <input type="text" name="wsp" id="wsp" class="form-control">
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>WSP Net Price Unit</label>
                      <input type="text" name="wspp" id="wspp" class="form-control" readonly>
                    </div>
                  </div>
 
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
                      <label>MRP</label>
                      <input type="text" name="mrp" id="mrp" class="form-control check" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sales Discount Code</label>
                      <select name="discount_code" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($discount as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->discount; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Salesman Commision</label>
                      <input type="text" name="comm" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Remark</label>
                      <textarea name="remark" class="form-control"></textarea>
                    </div>
                  </div>
              </div>

              <hr>
              <div align="right">
                <!--<a href="#" >Save and New</a>-->
                <!--<button type="submit" name="submitForm" class="btn btn-primary myBtn" value="formSave">Save and New</button>-->
                <input type="submit" name="save" value="Save" class="btn btn-success">
              </div>
            </form>
            </div>
            <!-- /.box-body -->
          </div>

          <!--<div class="box" style="padding: 5px">-->
          <!--    <div class="row">-->
          <!--       <form method="post" action="< ?php echo base_url('purchase_item/createItem') ?>">-->
          <!--      <div class="col-md-2 col-sm-2 col-xs-12">-->
          <!--        <div>-->
          <!--          <label>Color</label>-->
          <!--          <div class="row">-->
                      <!--<div class="col-md-2">-->
                      <!--        <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addColor" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--    </div>-->
                <!--        <div class="col-md-12">-->
                <!--        <select name="color" id="color" class="form-control">-->
                <!--          <option value="0">---Select One---</option>-->
                <!--        </select>-->
                        
                <!--      </div>-->
                <!--  </div>-->
                <!--</div>-->
                <!--</div>-->

                <!--<div class="col-md-2 col-sm-2 col-xs-6">-->
                <!--  <div>-->
                <!--    <label>Size</label>-->
                <!--    <div class="row">-->
                      <!--<div class="col-md-2">-->
                      <!--        <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSize" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--    </div>-->
                <!--       <div class="col-md-12">-->
                <!--        <select name="size" id="size" class="form-control">-->
                <!--          <option value="0">---Select One---</option>-->
                <!--        </select>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->

                <!--<div class="col-md-2 col-sm-2 col-xs-6">-->
                <!--  <div>-->
                <!--    <label>Texture/Pattern</label>-->
                <!--     <div class="row">-->
                      <!--<div class="col-md-2">-->
                      <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addTexture" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--</div>-->
                <!--      <div class="col-md-12">-->
                <!--        <select name="pattern" id="pattern" class="form-control">-->
                <!--          <option value="0">---Select One---</option>-->
                <!--        </select>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->

                <!--<div class="col-md-2 col-sm-2 col-xs-6">-->
                <!--  <div>-->
                <!--    <label>Style 1</label>-->
                <!--    <div class="row">-->
                      <!--<div class="col-md-2">-->
                      <!--  <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addStyleOne" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--</div>-->
                <!--      <div class="col-md-12">-->
                <!--        <select name="style1" id="style1" class="form-control">-->
                <!--          <option value="0">---Select One---</option>-->
                <!--        </select>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
                <!--<div class="col-md-2 col-sm-2 col-xs-6">-->
                <!--  <div>-->
                <!--    <label>Style 2</label>-->
                <!--    <div class="row">-->
                      <!--<div class="col-md-2">-->
                      <!--  <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addStyleTwo" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--</div>-->
                <!--      <div class="col-md-12">-->
                <!--        <select name="style2" id="style2" class="form-control">-->
                <!--          <option value="0">---Select One---</option>-->
                <!--        </select>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->
                <!--<div class="col-md-2 col-sm-2 col-xs-6">-->
                <!--  <div>-->
                <!--    <label>Type</label>-->
                <!--     <div class="row">-->
                      <!--<div class="col-md-2">-->
                      <!--  <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addType" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--</div>-->
               <!--       <div class="col-md-12">-->
               <!--         <select name="type" id="type" class="form-control">-->
               <!--           <option value="0">---Select One---</option>-->
               <!--         </select>-->
               <!--       </div>-->
               <!--     </div>-->
               <!--   </div>-->
               <!-- </div>-->

               <!-- <div class="col-md-2 col-sm-2 col-xs-6">-->
               <!--   <div>-->
               <!--     <label>Quality</label>-->
               <!--     <input type="text" name="quality" id="itemQuantity" class="form-control">-->
               <!--     <input type="hidden" name="orderQuantity" id="orderQuantity" class="form-control">-->
               <!--   </div>-->
               <!-- </div>-->

               <!-- <div class="col-md-2 col-sm-2 col-xs-6">-->
               <!--   <div>-->
               <!--     <br>-->
               <!--     <input type="hidden" name="order_id" value="< ?php echo $id ?>" >-->
               <!--     <input type="hidden" name="order_code" value="< ?php echo $randomCode ?>" >-->
               <!--     <input type="submit" name="save" id="itemsave" value="Save" class="btn btn-success" />-->
               <!--   </div>-->
               <!-- </div>-->
               <!--</form>-->
          <!--  </div>-->
          <!--</div>-->

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
        
        $('#txtQty').hide();
       
        
        $('.check').on('keyup', function(){
            
             btnEnable();
        });
        
        $(".myBtn").attr("disabled", true);
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
           var base_price = parseInt($('#wspp').val());
           
          if(mrp <= base_price)
          {
              alert("MRP Less than WSP Net Price");
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
                        
                        console.log(response);
                        
                        $('#unitValue').val(response.unit_id);
                        $('#unit').val(response.unit_id);
                        
                        $('#category').val(response.category_id);
                        $('#sub_category').val(response.subcategory_id);
                        // $('#unitValue').val(response.unit_id);
                        // $('#unit').val(response.unit_id);
                        
                        $('#category, #sub_category').prop('disabled', true);
                        
                        if(response.unit_id == '18')
                        {
                            $('#txtQty').show();
                            $('#quality').hide();
                            $('#quality').val('');
                        }
                        else
                        {
                            $('#txtQty').hide();
                            $('#txtQty').val('');
                            $('#quality').show();
                        }
                        
                       
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
        
        totalgst();
        
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
            var amtWsp = (amtTax * wsp) / 100;
            // console.log(amtWsp);
            var perNetPrice = amtTax.toFixed(2);
            var wspPrice = amtWsp.toFixed(2);


            
            $('#pur_price').val(perNetPrice);

            var purnetprice = parseFloat($('#pur_price').val());

            var wsppAndpur = amtWsp + purnetprice;
            var newWsp = wsppAndpur.toFixed(2);

            $('#wspp').val(newWsp);
            
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
    
    
    $(function () {
        $("input[id*='txtQty']").keydown(function (event) {


            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });
    });
</script>