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
          

          <div class="box" style="padding: 5px">
              <div class="row">
                 <!-- <form method="post" action="< ?php echo base_url('purchase_invoiceitem/createItem') ?>"> -->

        <?php echo form_open_multipart('opening_stockitem/createItemUploadFile'); ?>

                    
                    <div class="col-md-2">
                        <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id ?>" >
                        <input type="hidden" name="order_code" id="order_code" value="<?php echo $order_code ?>">

                        <input type="hidden" name="editAttrID" id="editAttrID"/>

                        <label>Selected Quantity</label>
                        <input type="text" name="orderQuantity" id="orderQuantity" value="<?php echo $quantity; ?>" readonly class="form-control">
                        <input type="hidden" name="matchQty" id="matchQty" value="<?php echo $quantity; ?>" readonly class="form-control">

                    </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <div>
                    <label>Color</label>
                    <div class="row">
                      <div class="col-md-2">
                              <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addColor" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                          </div>
                        <div class="col-md-10">
                        <select name="color" id="color" class="form-control">
                          <option value="none">none</option>
                        </select>
                        
                      </div>
                  </div>
                </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Size</label>
                    <div class="row">
                      <div class="col-md-2">
                              <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSize" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                          </div>
                       <div class="col-md-10">
                        <select name="size" id="size" class="form-control">
                          <option value="none">none</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Texture/Pattern</label>
                     <div class="row">
                      <div class="col-md-2">
                          <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addTexture" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                      </div>
                      <div class="col-md-10">
                        <select name="pattern" id="pattern" class="form-control">
                          <option value="none">none</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Style 1</label>
                    <div class="row">
                      <div class="col-md-2">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addStyleOne" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                      </div>
                      <div class="col-md-10">
                        <select name="style1" id="style1" class="form-control">
                          <option value="none">none</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Style 2</label>
                    <div class="row">
                      <div class="col-md-2">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addStyleTwo" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                      </div>
                      <div class="col-md-10">
                        <select name="style2" id="style2" class="form-control">
                          <option value="none">none</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Type</label>
                     <div class="row">
                      <div class="col-md-2">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addType" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                      </div>
                      <div class="col-md-10">
                        <select name="type" id="type" class="form-control">
                          <option value="none">none</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Quantity</label>
                    <input type="text" name="quality" id="itemQuantity" class="form-control">
                    <input type="hidden" name="totQty" id="totQty">

                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Images</label>
                     <div class="row">
                      <div class="col-md-12">
                        <input type="file" id="multiFiles" name="files[]" multiple="multiple"/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <br>

                    <a href="javascript:void(0);" id="editData" class="btn btn-success">Edit</a>                    

                    <!-- <a href="javascript:void(0);" id="add" class="btn btn-primary">Add</a> -->
                    <a href="javascript:void(0);" id="saveData" class="btn btn-success">Save</a>                    

                  </div>
                </div>
                <!-- <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <br>
                    <input type="submit" name="save" id="itemsave" value="Save" class="btn btn-success myBtn" />
                  </div>
                </div> -->

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
                        
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- <div class="col-md-12">
                  <div align="right">
                    <input type="submit" name="save" id="itemsave" value="Save" class="btn btn-success" />
                  </div>
                </div> -->
                <div class="col-md-12">
                  <div align="right">
                    <a href="<?php echo base_url() ?>purchase_invoice/update/<?php echo $order_id; ?>"  class="btn btn-danger"><< Back</a>
                  </div>
                </div>

               </form>
            </div>
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
            
            var color_id = '1';
            var html = '';
             
            $.ajax({
                    
                    url: base_url + 'attribute/fetchDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {id:color_id},
                    success:function(response){
                        
                        // var myJsonString = JSON.stringify(response);
                        
                        // console.log(myJsonString);
                        html += '<option value="none">none</option>';
                        
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
            
            var color_id = '2';
            var html = '';
             
            $.ajax({
                    
                    url: base_url + 'attribute/fetchDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {id:color_id},
                    success:function(response){
                        
                        // var myJsonString = JSON.stringify(response);
                        
                        // console.log(myJsonString);
                        html += '<option value="none">none</option>';
                        
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
            
            var color_id = '3';
            var html = '';
             
            $.ajax({
                    
                    url: base_url + 'attribute/fetchDataByID/',
                    type: 'post',
                    dataType: 'json',
                    data : {id:color_id},
                    success:function(response){
                        
                        // var myJsonString = JSON.stringify(response);
                        
                        // console.log(myJsonString);
                        html += '<option value="none">none</option>';
                        
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
                        html += '<option value="none">none</option>';
                        
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
                        html += '<option value="none">none</option>';
                        
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
                        html += '<option value="none">none</option>';
                        
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

  var base_url = '<?php echo base_url() ?>';


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
        
        if(qty >= newqty)
        {
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
                  html += '<input type="text" name="qtyList[]" id="rowQty_'+row_id+'"  class="countQty" value="'+newqty+'">';
                html += '</th>';
                html += '<th>';
                  html += '<a href="javascript:void(0);" onclick="addQty('+row_id+')" class="btn btn-danger btn-sm remove">Remove</a>';
                html += '</th>';
            html += '</tr>';

            $('#itemBody').append(html);  
            count();
        }
        else
        {
            alert("Quantity more than available Quantity");
        }
  });

    $('#editData').hide();


   function editQty(row_id) {


    // add quantity to quantity
    var orderQuantity = $('#orderQuantity').val();
    var removeQty = $('#qtyData_'+row_id).val();

    var newQty = parseFloat(orderQuantity) + parseFloat(removeQty);
    $('#orderQuantity').val(newQty);

    // edit attr data
    
    var id = $('#attrid_'+row_id).val();
    var color = $('#editColor_'+row_id).val();
    var size = $('#editSize_'+row_id).val();
    var pattern = $('#editPattern_'+row_id).val();
    var style1 = $('#editStyle1_'+row_id).val();
    var style2 = $('#editStyle2_'+row_id).val();
    var type = $('#editType_'+row_id).val();
    var qty = $('#qtyData_'+row_id).val();

    // console.log("ID "+id+" Color "+color+" Size "+size+" Pattern "+pattern+" Style1 "+style1+" Style2 "+style2+" Type "+type+" Qty "+qty);

    $('#editAttrID').val(id);
    $('#color').val(color);
    $('#size').val(size);
    $('#pattern').val(pattern);
    $('#style1').val(style1);
    $('#style2').val(style2);
    $('#type').val(type);
    $('#itemQuantity').val(qty);

    $('#editData').show();
    $('#saveData').hide();
    count();
  
  }
  
  function addQty(row_id)
  {
    //    var qty = parseFloat($('#orderQuantity').val());
    //    var listQty = parseFloat($('#rowQty_'+row_id).val());
       
    // //   console.log(qty);
    // //   console.log(listQty);
       
    //    var newQty = qty + listQty;
    // //   console.log(newQty);
    //    $('#orderQuantity').val(newQty);



       // to remove data from database

       var id = $('#attrid_'+row_id).val();
       // console.log(id);
       var formData = new FormData();

        formData.append('id', id);
       // console.log(id);

       var orderQuantity = $('#orderQuantity').val();
      var removeQty = $('#qtyData_'+row_id).val();

       $.ajax({
                method: 'post',
                url: base_url + 'opening_stockitem/deleteAttrDataByID',
                data: formData,
                dataType: 'text',
                contentType: false, 
                processData: false,
                success: function(response){
                    
                    // if(response == 'Record Deleted')
                    // {
                        // $('#row_'+row_id).remove();
                        alert(response);

                        

                        var newQty = parseFloat(orderQuantity) + parseFloat(removeQty);
                        // console.log(orderQuantity);
                        // console.log(removeQty);
                        // console.log(newQty);
                        $('#orderQuantity').val(newQty);
                    // }
                    // else
                    // {
                    //     alert(response);
                    // }
                }
            });
       
  }

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

  //   $('#orderQuantity').val(qty - newqty);

  // }

  function count()
  {     
    // var qty = parseFloat($('#orderQuantity').val());
    // var newqty = $('#itemQuantity').val();
    var matchQty = $('#matchQty').val();

// alert("hi");
    var totQty=0;

    // $('.countQty').each(function() {
              
    //     totQty += parseFloat($(this).val());
    //     // console.log(totQty);
    // });
    // $('#totQty').val(totQty);
    
    // var newQty = (qty - newqty);
    // var newQty1 = (newQty).toFixed(3);

    // $('#orderQuantity').val(newQty1);


    $('.countQtyAll').each(function() {
              
        totQty += parseFloat($(this).val());
        console.log(totQty);
    });

    var qty = matchQty - totQty;

    $('#orderQuantity').val(qty);

  }

</script>



<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url() ?>';

        var orderid = $('#order_id').val();
        var order_code = $('#order_code').val();

        getData(orderid, order_code);
        
        $('#saveData').on('click', function(){
            

            var form_data = new FormData();
           
            var ins = document.getElementById('multiFiles').files.length;
            
            // if(ins > 0)
            // {
                var qty = $('#itemQuantity').val();
                
                if(qty > 0)
                {   
                    var orderid = $('#order_id').val();
                    var order_code = $('#order_code').val();
                    var ordertype = 'pinvoice';
                    
                    var color = $('#color').val();
                    var size = $('#size').val();
                    var pattern = $('#pattern').val();
                    var style1 = $('#style1').val();
                    var style2 = $('#style2').val();
                    var type = $('#type').val();
                    // var show = $('#show').val();
                    
                    var fileInput = $('#multiFiles')[0];
                    
                    var formData = new FormData();
                    
                    $.each(fileInput.files, function(k,file){
                        formData.append('files[]', file);
                    });
                    
                    formData.append('orderid', orderid);
                    formData.append('order_code', order_code);
                    formData.append('ordertype', ordertype);
                    
                    formData.append('color', color);
                    formData.append('size', size);
                    formData.append('pattern', pattern);
                    formData.append('style1', style1);
                    formData.append('style2', style2);
                    formData.append('type', type);
                    formData.append('qty', qty);
                    // formData.append('show', show);
                    
                    // console.log(orderid+' '+order_code+' '+ordertype+' '+color+' '+size+' '+pattern+' '+style1+' '+style2+' '+type+' '+qty);

                    $.ajax({
                        method: 'post',
                        url: base_url + 'purchase_invoiceitem/uploadImagesData',
                        data: formData,
                        dataType: 'JSON',
                        contentType: false, 
                        processData: false,
                        success: function(response){
                            
                            // console.log(response);
                            // alert(response);
                            count();

                            if(response.code == "error")
                            {
                              alert(response.msg);
                               var orderQuantity = $('#orderQuantity').val();
                              var newQty = parseFloat(orderQuantity) + parseFloat(qty);
                              // alert(newQty);
                              $('#orderQuantity').val(newQty);
                            }
                            else
                            {
                              alert(response.msg);
                            }

                            $('#itemQuantity').val('');
                            $('#multiFiles').val('');

                            $('#color').val('none');
                            $('#size').val('none');
                            $('#pattern').val('none');
                            $('#style1').val('none');
                            $('#style2').val('none');
                            $('#type').val('none');
                            // $('#color').val('');

                            getData(orderid, order_code);
                        }
                    });
                    
                    // console.log(form_data);
                }
                else
                {
                    alert("Select Product Quantity");
                }
            // }
            // else
            // {
            //     alert("Select Product Images");
            // }
        });


        function getData(orderid, order_code) {
            
            // console.log(orderid+' '+order_code);

            var formData = new FormData();

            formData.append('orderid', orderid);
            formData.append('order_code', order_code);

            $.ajax({
                        method: 'post',
                        url: base_url + 'opening_stockitem/getAttrData',
                        data: formData,
                        dataType: 'JSON',
                        contentType: false, 
                        processData: false,
                        success: function(response){
                            
                            // console.log(response);
                            // alert(response);


                            var table = $("#itemBody");
                            var count_table_tbody_tr = $("#itemBody tr").length;
                            var row_id = count_table_tbody_tr + 1;
                            
                            var html = '';

                            $.each(response, function(index, value) { 

                                html += '<tr id="row_'+row_id+'">';
                                  html += '<th>';
                                    html += '<input type="hidden" name="attrid" id="attrid_'+row_id+'" value="'+value.id+'" />';
                                    html += '<input type="hidden" name="editColor" id="editColor_'+row_id+'" value="'+value.color+'" />';
                                    html += ''+value.color+'';
                                  html += '</th>';
                                  html += '<th>';
                                    html += '<input type="hidden" name="editSize" id="editSize_'+row_id+'" value="'+value.size+'" />';
                                    html += ''+value.size+'';
                                  html += '</th>';
                                  html += '<th>';
                                    html += '<input type="hidden" name="editPattern" id="editPattern_'+row_id+'" value="'+value.pattern+'" />';
                                    html += ''+value.pattern+'';
                                  html += '</th>';
                                  html += '<th>';
                                    html += '<input type="hidden" name="editStyle1" id="editStyle1_'+row_id+'" value="'+value.style1+'" />';
                                    html += ''+value.style1+'';
                                  html += '</th>';
                                  html += '<th>';
                                    html += '<input type="hidden" name="editStyle2" id="editStyle2_'+row_id+'" value="'+value.style2+'" />';
                                    html += ''+value.style2+'';
                                  html += '</th>';
                                  html += '<th>';
                                    html += '<input type="hidden" name="editType" id="editType_'+row_id+'" value="'+value.type+'" />';
                                    html += ''+value.type+'';
                                  html += '</th>';
                                  html += '<th>';
                                    html += '<input type="hidden" name="qtyData" id="qtyData_'+row_id+'" value="'+value.quantity+'" class="countQtyAll" />'+value.quantity+'';
                                  html += '</th>';
                                  html += '<th>';
                                    html += '<a href="javascript:void(0);" onclick="editQty('+row_id+')" class="btn btn-info btn-sm editAttr">Edit</a> &nbsp;';
                                    html += '<a href="javascript:void(0);" onclick="addQty('+row_id+')" class="btn btn-danger btn-sm remove">Remove</a>';
                                  html += '</th>';
                                html += '</tr>';

                                row_id++;
                          
                                $('#itemBody').html(html);

                                count();

                            });
                        }
                    });
        }

        $('#editData').on('click', function(){
            
            var form_data = new FormData();
           
            var ins = document.getElementById('multiFiles').files.length;


            var qty = $('#itemQuantity').val();
                
            if(qty > 0)
            {   
                var orderid = $('#order_id').val();
                var order_code = $('#order_code').val();
                var ordertype = 'pinvoice';
                
                var id = $('#editAttrID').val();
                var color = $('#color').val();
                var size = $('#size').val();
                var pattern = $('#pattern').val();
                var style1 = $('#style1').val();
                var style2 = $('#style2').val();
                var type = $('#type').val();
                // var show = $('#show').val();

                // console.log("orderid "+orderid+" order_code "+order_code+" ordertype "+ordertype+" id "+id+" color "+color+" size "+size+" pattern "+style1+" style2 "+style2+" type "+type);
                
                var fileInput = $('#multiFiles')[0];
                
                var formData = new FormData();
                
                $.each(fileInput.files, function(k,file){
                    formData.append('files[]', file);
                });
                
                formData.append('orderid', orderid);
                formData.append('order_code', order_code);
                formData.append('ordertype', ordertype);
                
                formData.append('id', id);
                formData.append('color', color);
                formData.append('size', size);
                formData.append('pattern', pattern);
                formData.append('style1', style1);
                formData.append('style2', style2);
                formData.append('type', type);
                formData.append('qty', qty);
                // formData.append('show', show);
                
                $.ajax({
                    method: 'post',
                    url: base_url + 'purchase_invoiceitem/uploadImagesDataUpdate',
                    data: formData,
                    dataType: 'JSON',
                    contentType: false, 
                    processData: false,
                    success: function(response){
                        
                        // console.log(response);
                        // count();

                        if(response.code == "error")
                        {
                          alert(response.msg);
                           var orderQuantity = $('#orderQuantity').val();
                          var newQty = parseFloat(orderQuantity) + parseFloat(qty);
                          // alert(newQty);
                          $('#orderQuantity').val(newQty);
                        }
                        else
                        {
                          alert(response.msg);

                          $('#itemQuantity').val('');
                          $('#multiFiles').val('');

                          $('#editAttrID').val('');

                          $('#color').val('none');
                          $('#size').val('none');
                          $('#pattern').val('none');
                          $('#style1').val('none');
                          $('#style2').val('none');
                          $('#type').val('none');

                          $('#editData').hide();
                          $('#saveData').show();

                        }

                        
                        // $('#color').val('');

                        getData(orderid, order_code);
                    }
                });
                
                // console.log(form_data);
            }
            else
            {
                alert("Select Product Quantity");
            }
        });


    });
</script>

