<!--< ?php echo "<pre>"; print_r($allData); exit; ?>-->

<style type="text/css">
    img {
      border: 1px solid #ddd; /* Gray border */
      border-radius: 4px;  /* Rounded border */
      padding: 5px; 
      width: 75px;
      height: 75px;
      float: left;
      /* Some padding */
      /*width: 150px;  Set a small width */
    }

    /* Add a hover effect (blue shadow) */
    img:hover {
      box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }

</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Product
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product</li>
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
          <div class="box" style="padding: 5px;">
            <form role="form" action="<?php echo base_url('sku/update'); ?>" method="post" enctype="multipart/form-data">

            <div class="box-body">
              
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Product Code</label>
                      <input type="text" name="product_code" value="<?= set_value('product_code', $allData['product_code']) ?>" class="form-control">
                      <input type="hidden" name="id" value="<?= set_value('id',  $allData['id']) ?>" class="form-control">
                  </div>
                  
                </div>
                
                <div class="col-md-6 col-sm-6">
                    <div>
                      <label>Product Name</label>
                      <input type="text" name="product_name" value="<?= set_value('product_name',  $allData['product_name']) ?>" class="form-control">
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Purchase Price</label>
                      <input type="text" name="purchase_price" value="<?= set_value('purchase_price',  $allData['purchase_price']) ?>" class="form-control">
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-6">
                   <div>
                      <label>Sales Price</label>
                      <input type="text" name="sales_price" value="<?= set_value('sales_price',  $allData['sales_price']) ?>" class="form-control">
                  </div>
                </div>
                
                
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Weight</label>
                      <select name="weight" class="form-control">
                          <option value="0">Select Weight</option>
                        <?php foreach($weight as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['weight'] == $rows->id ? "selected" : "";  ?> ><?php echo $rows->weight_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                
                
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Quantity</label>
                      <input type="numbet" name="quantity" value="<?= set_value('quantity', $allData['quantity']) ?>" class="form-control">
                  </div>
                </div>
                
                
                
                
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>GST (%)</label>
                      <select name="gst" class="form-control">
                          <option value="0">Select GST</option>
                        <?php foreach($gst as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['gst'] == $rows->id ? "selected" : "";  ?> ><?php echo $rows->gst_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                  </div>
                </div>
    
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Division</label>
                      <select name="division" id="division" class="form-control">
                          <option value="0">Select Division</option>
                            <?php foreach($division as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['division_id'] == $rows->id ? "selected" : "";  ?> ><?php echo $rows->division_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                  </div>
                </div>  
    
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Category</label>
                      <select name="category" id="category" class="form-control">
                          <option value="0">Select Category</option>
                            <?php foreach($category as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['category_id'] == $rows->id ? "selected" : "";  ?> ><?php echo $rows->catgory_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                  
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Sub-category</label>
                      <select name="subcategory" id="subcategory" class="form-control">
                          <option value="0">Select Sub-category</option>
                            <?php foreach($subcategory as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['subcategory_id'] == $rows->id ? "selected" : "";  ?> ><?php echo $rows->subcategory_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Unit</label>
                      <select name="unit" class="form-control">
                        <option>---select one---</option>
                        <?php foreach($unit as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['unit_id'] == $rows->id ? "selected" : "";  ?> ><?php echo $rows->unit; ?></option>
                            <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                
                
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Hsn Code</label>
                      <select name="hsn" class="form-control">
                        <option value="0">---select one---</option>
                        <?php foreach($hsn as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['hsn_id'] == $rows->id ? "selected" : "";  ?> ><?php echo $rows->hsn_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                  </div>
                </div>
        
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Attribute</label>
                      <select name="attribute" class="form-control">
                        <option>---select one---</option>
                        <?php foreach($attr as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['attr_id'] == $rows->id ? "selected" : "";  ?> ><?php echo $rows->attr_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                  </div>
                </div>


                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Brand</label>
                      <select name="brand" class="form-control">
                        <option>---select one---</option>
                        <?php foreach($brand as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['brand_id'] == $rows->id ? "selected" : "";  ?> ><?php echo $rows->brand_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                
                <!--<div class="col-md-6 col-sm-6">-->
                <!--  <div>-->
                <!--      <label>Product Images</label>-->
                <!--      <input type="file" name="userfile[]"  class="form-control" multiple>-->
                <!--      <input type="hidden" name="oldimg" value="< ?php echo $allData['img']; ?>">-->
                <!--  </div>-->
                <!--</div>-->

                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Show to Website</label>
                      <br>
                      <input type="radio" name="website" value="no" <?php echo set_value('website', $allData['websitestatus']) == 'no' ? "checked" : ""; ?> > No
                      <input type="radio" name="website" value="yes" <?php echo set_value('website', $allData['websitestatus']) == 'yes' ? "checked" : ""; ?> > Yes
                  </div>
                </div>

                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Status</label>
                      <br>
                      <select name="status" class="form-control">
                          <option value="active" <?php echo $allData['brand_id'] == 'active' ? "selected" : "";  ?> >Active</option>
                          <option value="inactive" <?php echo $allData['brand_id'] == 'inactive' ? "selected" : "";  ?> >Inactive</option>
                      </select>
                  </div>
                </div>
    
                <div class="col-md-6 col-sm-6">
                  <div>
                      <label>Description</label>
                      <textarea name="descirption" class="form-control"><?= set_value('descirption', $allData['description'])?></textarea>
                  </div>
                </div>
                
                
                <!--</div>-->

                
            </div>
            <div align="right">
              <hr>
              <input type="reset" name="reset" value="Reset" class="btn btn-sm btn-danger">
              <input type="submit" name="save" value="Save" class="btn btn-sm btn-primary">
            </div>
            <!-- /.box-body -->
            </div>
          </div>
            </form>

             <div class="col-md-12">
                  <?php foreach ($imgData as $key => $value) { ?>

                    <?php $img = array(); $img = explode(", ", $value['img']); ?>

                    <?php foreach ($img as $rows) { ?>
                      
                      <div>
                          <a target="_blank" href="<?php echo base_url().$value['img_path'].$rows ?>">
                              <img src="<?php echo base_url().$value['img_path'].$rows ?>" alt="<?php echo $rows ?>">
                          </a>
                      </div>
                    <?php } ?>

                  <?php } ?>
            </div>

        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->



    </section>

    

      <!-- < ?php echo "<pre>"; print_r($imgData); exit(); ?> -->

    <!-- /.content -->
  </div>
 
  <div class="control-sidebar-bg"></div>

</div>
<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url(); ?>';
        
        $('#division').on('blur', function(){
            
            var division = $(this).val(); 
            // alert(division);
            
            var html = '';
            $.ajax({
                
                url: base_url + 'division/fetchProductCatByDivision',
                type: 'post',
                dataType: 'json',
                data : {division:division},
                success:function(response){
                    
                    // console.log(response);
                    $('#category').html('');
                    
                    html += '<option value="0">Select Category</option>'; 
                    $.each(response, function(index, value) {
                      html += '<option value="'+value.id+'">'+value.catgory_name+'</option>';             
                    });
                    
                    $('#category').append(html);
                }
            });
        });
    })
</script>


