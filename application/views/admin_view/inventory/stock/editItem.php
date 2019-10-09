<!-- < ?php echo "<pre>"; print_r($itemData); //exit; ?> -->

<?php 
  $colorvalue = array();
  $colorvalue = explode(', ', $color['attr_values']);
  // echo "<pre>"; print_r($colorvalue);

  $sizevalue = array();
  $sizevalue = explode(', ', $size['attr_values']);
  // echo "<pre>"; print_r($sizevalue);

  $patternvalue = array();
  $patternvalue = explode(', ', $pattern['attr_values']);
  // echo "<pre>"; print_r($patternvalue);

  $style1value = array();
  $style1value = explode(', ', $style1['attr_values']);
  // echo "<pre>"; print_r($style1value);

  $style2value = array();
  $style2value = explode(', ', $style2['attr_values']);
  // echo "<pre>"; print_r($style2value);

  $typevalue = array();
  $typevalue = explode(', ', $type['attr_values']);
  // echo "<pre>"; print_r($typevalue);
  // exit();
?>
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
          
          <form method="post" action="<?php echo base_url('opening_stockitem/updateItem') ?>">
          <div class="box" style="padding: 5px">
              <div class="row">
                    
                    <div class="col-md-2">

                      <input type="hidden" name="order_id" value="<?php echo $order_id ?>" >
                      <input type="hidden" name="order_code" value="<?php echo $order_code ?>" >
                        <label>Selected Quantity</label>
                        <input type="text" name="orderQuantity" id="orderQuantity" value="<?php echo $quantity; ?>" readonly class="form-control">
                        <input type="hidden" name="matchQty" id="matchQty" value="<?php echo $quantity; ?>" readonly class="form-control">
                    </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <div>
                    <label>Color</label>
                    <div class="row">
                      <!--<div class="col-md-2">-->
                      <!--        <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addColor" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--    </div>-->
                        <div class="col-md-12">
                        <select name="color" id="color" class="form-control">
                          <option value="0">---Select One---</option>
                        </select>
                        
                      </div>
                  </div>
                </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Size</label>
                    <div class="row">
                      <!--<div class="col-md-2">-->
                      <!--        <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSize" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--    </div>-->
                       <div class="col-md-12">
                        <select name="size" id="size" class="form-control">
                          <option value="0">---Select One---</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Texture/Pattern</label>
                     <div class="row">
                      <!--<div class="col-md-2">-->
                      <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addTexture" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--</div>-->
                      <div class="col-md-12">
                        <select name="pattern" id="pattern" class="form-control">
                          <option value="0">---Select One---</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Style 1</label>
                    <div class="row">
                      <!--<div class="col-md-2">-->
                      <!--  <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addStyleOne" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--</div>-->
                      <div class="col-md-12">
                        <select name="style1" id="style1" class="form-control">
                          <option value="0">---Select One---</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Style 2</label>
                    <div class="row">
                      <!--<div class="col-md-2">-->
                      <!--  <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addStyleTwo" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--</div>-->
                      <div class="col-md-12">
                        <select name="style2" id="style2" class="form-control">
                          <option value="0">---Select One---</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Type</label>
                     <div class="row">
                      <!--<div class="col-md-2">-->
                      <!--  <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addType" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                      <!--</div>-->
                      <div class="col-md-12">
                        <select name="type" id="type" class="form-control">
                          <option value="0">---Select One---</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Quality</label>
                    <input type="text" name="quality" id="itemQuantity" class="form-control">
                    <input type="hidden" name="totQty" id="totQty">

                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <br>
                    <a href="javascript:void(0);" id="add" class="btn btn-primary">Add</a>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>  
                        <tr>
                          <td>Color</td>
                          <td>Size</td>
                          <td>Texture/Pattern</td>
                          <td>Style1</td>
                          <td>Style2</td>
                          <td>Type</td>
                          <td>Quantity</td>
                          <td>Action</td>
                        </tr>
                      </thead>
                      <tbody id="itemBody">
                          
                        <?php 
                          $no=1; 
                          foreach ($itemData as $key => $value) {
                        ?>
                        
                          <tr id="row_'<?php echo $no ?>">
                            <td>
                              <select name="colorList[]">
                                <option value="0">---Select One---</option>
                                <?php foreach($colorvalue as $rows): ?>
                                  <option value="<?php echo $rows ?>" <?php echo $rows == $rows ? "selected" : ""; ?> ><?php echo $rows ?></option>
                                <?php endforeach; ?>
                              </select>
                              <!-- <input type="text" name="colorList[]" value="< ?php echo $value['color'] ?>" > -->
                            </td>
                            <td>
                              <select name="sizeList[]">
                                <option value="0">---Select One---</option>
                                <?php foreach($sizevalue as $rows): ?>
                                  <option value="<?php echo $rows ?>" <?php echo $rows == $rows ? "selected" : ""; ?> ><?php echo $rows ?></option>
                                <?php endforeach; ?>
                              </select>
                            </th>
                            <td>
                              <select name="patternList[]">
                                <option value="0">---Select One---</option>
                                <?php foreach($patternvalue as $rows): ?>
                                  <option value="<?php echo $rows ?>" <?php echo $rows == $rows ? "selected" : ""; ?> ><?php echo $rows ?></option>
                                <?php endforeach; ?>
                              </select>
                            </td>
                            <td>
                              <select name="style1List[]">
                                <option value="0">---Select One---</option>
                                <?php foreach($style1value as $rows): ?>
                                  <option value="<?php echo $rows ?>" <?php echo $rows == $rows ? "selected" : ""; ?> ><?php echo $rows ?></option>
                                <?php endforeach; ?>
                              </select>
                              <!-- <input type="text" name="style1List[]" value=""> -->
                            </td>
                            <td>
                              <select name="style2List[]">
                                <option value="0">---Select One---</option>
                                <?php foreach($style2value as $rows): ?>
                                  <option value="<?php echo $rows ?>" <?php echo $rows == $rows ? "selected" : ""; ?> ><?php echo $rows ?></option>
                                <?php endforeach; ?>
                              </select>
                              <!-- <input type="text" name="style2List[]" value=""> -->
                            </td>
                            <td>
                              <select name="typeList[]">
                                <option value="0">---Select One---</option>
                                <?php foreach($typevalue as $rows): ?>
                                  <option value="<?php echo $rows ?>" <?php echo $rows == $rows ? "selected" : ""; ?> ><?php echo $rows ?></option>
                                <?php endforeach; ?>
                              </select>
                              <!-- <input type="text" name="typeList[]" value=""> -->
                            </td>
                            <td>
                              <input type="text" name="qtyList[]" class="countQty" value="<?php echo $value['quantity']; ?>">
                            </td>
                            <td>
                              <a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col-md-12">
                  <div align="right">
                    <input type="submit" name="save" id="itemsave" value="Save" class="btn btn-success" />
                  </div>
                </div>
               
            </div>
          </div>
          </form>

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
       
        
        $(".myBtn").attr("disabled", true);
        
        
        $('#itemQuantity').on('change', function(){
            
           var itemQuantity = parseInt($(this).val());
           var orderQuantity = parseInt($('#orderQuantity').val());
           
          if(itemQuantity > orderQuantity)
          {
              alert("Quantity more than Selected Quantity");
              $(this).val("");
          }
          else
          {
              $(".myBtn").attr("disabled", false);
          }
        });
        
        
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


<script type="text/javascript">

  $('#add').on('click', function(){

    var table = $("#itemBody");
    var count_table_tbody_tr = $("#itemBody tr").length;
    var row_id = count_table_tbody_tr + 1;

    var qty = $('#orderQuantity').val();
    var color = $('#color').val();
    var size = $('#size').val();
    var pattern = $('#pattern').val();
    var style1 = $('#style1').val();
    var style2 = $('#style2').val();
    var type = $('#type').val();
    var newqty = $('#itemQuantity').val();

      var html = '';

      html += '<tr id="row_'+row_id+'">';
        
        html += '<th>';
          html += '<input type="text" name="colorList[]" value="'+color+'">';
        html += '</th>';
        html += '<th>';
          html += '<input type="text" name="sizeList[]" value="'+size+'">';
        html += '</th>';
        html += '<th>';
          html += '<input type="text" name="patternList[]" value="'+pattern+'">';
        html += '</th>';
        html += '<th>';
          html += '<input type="text" name="style1List[]" value="'+style1+'">';
        html += '</th>';
        html += '<th>';
          html += '<input type="text" name="style2List[]" value="'+style2+'">';
        html += '</th>';
        html += '<th>';
          html += '<input type="text" name="typeList[]" value="'+type+'">';
        html += '</th>';
        html += '<th>';
          html += '<input type="text" name="qtyList[]" class="countQty" value="'+newqty+'">';
        html += '</th>';
        html += '<th>';
          html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
        html += '</th>';
      html += '</tr>';

      $('#itemBody').append(html);  
    // itemBody

    // count();
  });

  $(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
    // count();
  });

  // function count()
  // {     
  //   var qty = parseFloat($('#orderQuantity').val());
  //   var newqty = $('#itemQuantity').val();
  //   var matchQty = $('#matchQty').val();

  //   var totQty=0;

  //   $('.countQty').each(function() {
              
  //       totQty += parseFloat($(this).val());
  //       // console.log(totQty);
  //   });
  //   $('#totQty').val(totQty);

  //   $('#orderQuantity').val(totQty - newqty);

  // }

</script>