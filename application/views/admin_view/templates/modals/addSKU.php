<form method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="Modal_addSku" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
                Add SKU
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                 
                  <div class="col-lg-4 col-md-4">
                      <div>
                        <label>Product Category</label>
                      </div>
                      <div>
                        <!--<input type="text" name="product_category" class="form-control">-->
                        <select name="product_category" id="product_category" class="form-control">
                            
                        </select>
                      </div>
                  </div>

                   <div class="col-lg-4 col-md-4">
                      <div>
                        <label>Product Sub-Category</label>
                      </div>
                      <div>
                        <!--<input type="text" name="product_subcategory" class="form-control">-->
                        <select name="product_subcategory" id="product_subcategory" class="form-control">
                            
                        </select>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4">
                      <div>
                        <label>SKU</label>
                      </div>
                      <div>
                        <input type="text" name="sku" id="skuData" class="form-control">
                      </div>
                  </div>

                   <div class="col-lg-4 col-md-4">
                      <div>
                        <label>Product Name</label>
                      </div>
                      <div>
                        <input type="text" name="product_name" id="product_name" class="form-control" autocomplete="on">
                      </div>
                  </div>

                   <div class="col-lg-4 col-md-4">
                      <div>
                        <label>GST % while Selling</label>
                      </div>
                      <div>
                        <!--<input type="text" name="gst" class="form-control">-->
                        <select name="gst" id="gstData" class="form-control">
                            
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-lg-4 col-md-4">
                      <div>
                        <label>Unit</label>
                      </div>
                      <div>
                        <!--<input type="text" name="gst" class="form-control">-->
                        <select name="unit" id="unitData" class="form-control">
                            
                        </select>
                      </div>
                  </div>

                  <div class="col-md-4 col-sm-4">
                    <div>
                        <label>Show to Website</label>
                        <br>
                        <input type="radio" name="website" value="no" checked=""> No
                        <input type="radio" name="website" value="yes"> Yes
                    </div>
                  </div>
                  
                  <div class="col-lg-4 col-md-4">
                      <div>
                        <label>Description</label>
                      </div>
                      <div>
                        <input type="text" name="desc" id="desc" class="form-control">
                      </div>
                  </div>

                  <br>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<input type="submit" name="save" value="Submit" class="btn btn-success">-->
                <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
                 <!--<a href="javascript:void(0);" class="btn btn-success"> Submit</a>-->
            </div>
          </div>
        </div>
      </div>
  </form>
  
  <script>
      $(document).ready(function(){
          
        var base_url = '<?php echo base_url() ?>';
          
            showCat();
            showSubCat();
            showGst();
            showUnit();
            
            $('#product_category').on('change', function(){
            
                $('#product_subcategory').html('');
                
                var cat_id = $(this).val();
                // alert(accountcat_id);
                 var html = '';
                  $.ajax({
                        
                        url: base_url + 'product_category/fecthAllSubCatDataByID/',
                        type: 'post',
                        dataType: 'json',
                        data : {cat_id:cat_id},
                        success:function(response){
                            
                            html += '<option>---Select One---</option>';
                            $.each(response, function(index, value) {
                              html += '<option value="'+value.id+'">'+value.subcategory_name+'</option>';             
                            });
                            
                            $('#product_subcategory').append(html);
                        }
                  });
            });
            
            function showCat()
            {
                $.ajax({
                    type : "POST",
                    url  : base_url + "product_category/fetchCatData",
                    dataType : "JSON",
                    success: function(data){
                        
                        // console.log(data);
                        
                        var html = '';
                        $.each(data, function(index, value) {
                                                                  
                            html += '<option value="'+value.id+'">'+value.catgory_name+'</option>';
                        });
                        
                        $('#product_category').append(html);
                    }
                });
            }
            
            function showSubCat()
            {
                $.ajax({
                    type : "POST",
                    url  : base_url + "product_category/fetchSubCatData",
                    dataType : "JSON",
                    success: function(data){
                        
                        // console.log(data);
                        var html = '';
                        
                        $.each(data, function(index, value) {
                                                                  
                            html += '<option value="'+value.id+'">'+value.subcategory_name+'</option>';
                        });
                        $('#product_subcategory').append(html);
                    }
                });
            }
            
            function showGst()
            {
                $.ajax({
                    type : "POST",
                    url  : base_url + "gst/fecthAllData",
                    dataType : "JSON",
                    success: function(gstData){
                        
                        // console.log(gstData);
                        
                        var html = '';
                        
                        $.each(gstData, function(index, value) {
                                                                  
                            html += '<option value="'+value.id+'">'+value.gst_name+'</option>';
                        });
                        
                        $('#gstData').append(html);
                    }
                });
            }
            
            function showUnit()
            {
                $.ajax({
                    type : "POST",
                    url  : base_url + "unit/fecthAllData",
                    dataType : "JSON",
                    success: function(unitData){
                        
                        // console.log(unitData);
                        
                        var html = '';
                        
                        $.each(unitData, function(index, value) {
                                                                  
                            html += '<option value="'+value.id+'">'+value.unit+'</option>';
                        });
                        
                        $('#unitData').append(html);
                    }
                });
            }
            
            
            //Save product
            $('#btn_save').on('click',function(){
                var pcat = $('#product_category').val();
                var psubcat = $('#product_subcategory').val();
                var sku = $('#skuData').val();
                var product_name = $('#product_name').val();
                var gstData = $('#gstData').val();
                var unitData = $('#unitData').val();

                var website = $("input[name='website']:checked").val();

                var desc = $('#desc').val();
                
                // console.log(pcat+" "+psubcat+" "+sku+" "+product_name+" "+gstData+" "+desc);
                
                $.ajax({
                    type : "POST",
                    url  : base_url + "sku/saveSKU",
                    dataType : "JSON",
                    data : {pcat:pcat , psubcat:psubcat, sku:sku, product_name:product_name, gstData:gstData, unitData: unitData, website:website, desc:desc},
                    success: function(data){
                        // $('[name="product_code"]').val("");
                        // $('[name="product_name"]').val("");
                        // $('[name="price"]').val("");
                        // $('#Modal_Add').modal('hide');  
                        // show_product();
                        if(data == 0)
                        {
                            alert("sku Available");
                        }
                        else
                        {
                            $('#product_category').val(0);
                            $('#product_subcategory').val(0);
                            $('#skuData').val('');
                            $('#product_name').val('');
                            $('#gstData').val(0);
                            $('#unitData').val('');
                            $('#desc').val('');
                            
                            $('#Modal_addSku').modal('hide');
                            
                            showSKU();
                        }
                    }
                });
                return false;
            });
                            // showSKU();
            
            
            function showSKU()
            {
                $.ajax({
                    type : "POST",
                    url  : base_url + "sku/fetchAllSkuData1",
                    dataType : "JSON",
                    success: function(data){
                        
                        // console.log(data);
                        
                        $('#sku').html('');
                        var html = '';
                        
                        $.each(data, function(index, value) {
                                                                  
                            html += '<option value="'+value.id+'">'+value.product_code+'</option>';
                        });
                        
                        $('#category').val(data[0].cid);
                        $('#sub_category').val(data[0].sid);
                        $('#unitValue').val(data[0].unit_id);
                        $('#unit').val(data[0].unit_id);
                        
                        $('#category, #sub_category').prop('disabled', true);
                        
                        $('#sku').append(html);
                    }
                });
            }
            
      });
  </script>
  
  
  
  
  