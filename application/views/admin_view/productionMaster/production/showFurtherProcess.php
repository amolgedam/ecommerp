<?php 
      // echo "<pre>"; print_r($furtherprocess); exit();
      // echo "<pre>"; print_r($material); exit();
    //   echo "<pre>"; print_r($service); exit();
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Production 
        <small>Further Process</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Further Process</li>
      </ol>
    </section>
 
    <!-- Main content -->
    <section class="content">
      <form action="<?php echo base_url(); ?>furtherprocess/update" method="post">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                
                <h4>Production</h4>
                <hr>

                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>

                      <input type="hidden" name="id" value="<?php echo $furtherprocess['id'] ?>">
                        
                      <label>Product Category</label>
                      <select name="product_category" id="product_category" required class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($category as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"  <?php echo $furtherprocess['p_category'] == $rows->id ? "selected" : ""; ?> ><?php echo ucwords($rows->catgory_name); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Product Sub-Category</label>
                      <select name="product_subcategory" required id="product_subcategory" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($subcategory as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $furtherprocess['p_scate'] == $rows->id ? "selected" : ""; ?> ><?php echo ucwords($rows->subcategory_name); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>SKU</label>
                      <div class="row">
                        <div class="col-md-12">
                          <select name="sku" class="form-control" required>
                            <option value="0">---Select One---</option>
                              <?php foreach($sku as $rows): ?>
                                <option value="<?php echo $rows['id']; ?>" <?php echo $furtherprocess['sku'] == $rows['id'] ? "selected" : ""; ?> ><?php echo ucwords($rows['product_code']); ?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Status</label>
                      <select name="status" required class="form-control">
                        <option value="0">---Select One---</option>
                        <option value="Open" <?php echo $furtherprocess['status'] == "Open" ? "selected" : ""; ?> >Open</option>
                        <option value="Further Process" <?php echo $furtherprocess['status'] == "Further Process" ? "selected" : ""; ?>>Further Process</option>
                        <option value="Complete" <?php echo $furtherprocess['status'] == "Complete" ? "selected" : ""; ?>>Complete</option>
                        <option value="Incomplete" <?php echo $furtherprocess['status'] == "Incomplete" ? "selected" : ""; ?>>Incomplete</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>JobSheet Date</label>
                      <input type="date" name="jobsheet_date" value="<?php echo $furtherprocess['jobsheetdate'] ?>" required class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Delivery Date</label>
                      <input type="date" name="delivery_date" value="<?php echo $furtherprocess['delivery_date'] ?>" required class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Quantity</label>
                      <input type="text" name="quantity" id="quantity" value="<?php echo $furtherprocess['quantity'] ?>" required class="form-control">
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Cost</label>
                      <input type="text" name="production_unit" value="<?php echo $furtherprocess['total_cost'] ?>" required class="form-control" readonly>
                    </div>
                  </div>
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

              <h4>Material List</h4>
              <hr>
              <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Search Material</label>
                  <input type="text" name="searchproduct" id="searchproduct" class="form-control" placeholder="Enter Product Code">
                </div>
              </div> -->
              
              <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <br>
                  <input type="button" name="search" id="search" class="btn btn-sm btn-primary" value="Search">
                </div>
              </div> -->

              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="table table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Product Number</th>
                                  <th>Quantity</th>
                                  <th>Conversion</th>
                                  <th>Conversion</th>
                                  <th>Purchase Net Price/Unit</th>
                                  <th>Subtotal</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody> 
                              <?php $sum=0; foreach($material as $rows): ?>
                                <tr>
                                  <td><?php echo $rows['product_no']; ?></td>
                                  <td><?php echo $rows['quantity']; ?></td>
                                  <td><?php echo $rows['conversion']; ?></td>
                                  <td><?php echo $rows['conversion_value']; ?></td>
                                  <td><?php echo $rows['netprice']; ?></td>
                                  <td><?php echo $rows['subtotal']; ?></td>
                                </tr>
                              <?php $sum = $sum + $rows['subtotal']; endforeach; ?>
                          </tbody>
                      </table>
                  </div>
                      <div class="pull-right">
                        <label>Total :- <?php echo $sum; ?></label>
                      </div>
                </div>                          
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <h4>Measurements</h4>
              <hr>
              <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="radio" name="measuremnt"  class="measuremnt" value="custom" checked> Custom
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="radio" name="measuremnt" class="measuremnt" value="readymade"> Readymade
                  </div>
              </div>
              <br>
              <div class="row">
                    <div style="display: none" id="readymade">
<!--                         <div class="col-md-4 col-sm-4 col-xs-12">
                              
                                  <div style="padding-left: 5px;">Size</div>
                                  <input type="text" name="size" id="readymadesize" class="form-control">
                              
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              
                                  <div style="padding-left: 5px;">Quantity</div>
                                  <input type="text" name="mquantity" id="readymadequantity" class="form-control">
                                
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>&nbsp;</div>
                            <input type="button" name="search" onclick="readymade();" class="btn btn-sm btn-primary" value="Add">
                        </div> -->

                        <div class="col-md-12">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <td>Measurement Size</td>
                                  <td>Quantity</td>
                                  <td>Action</td>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($readymadeMeasurement as $rows): ?>
                                  <tr>
                                    <td><?php echo $rows['size']; ?></td>
                                    <td><?php echo $rows['quantity']; ?></td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    
                    



                    <div id="custom">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                    <label style="padding-left: 5px;">कोट</label>
                      <br><br>
                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">शोल्डर</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kshoulder" value="<?php echo $measurement['kshoulder'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">चेस्ट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kchest" value="<?php echo $measurement['kchest'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">पैंट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kpants" value="<?php echo $measurement['kpants'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हाथ</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="khand" value="<?php echo $measurement['khand'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हिप</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="khip" value="<?php echo $measurement['khip'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लंबाई</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="klength" value="<?php echo $measurement['klength'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">गला </span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kthroat" value="<?php echo $measurement['kthroat'] ?>" class="form-control">
                        </div>
                      </div>
                  </div>


                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label style="padding-left: 5px;">पैंट</label>
                    <br><br>
                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">कमर</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="waist" value="<?php echo $measurement['waist'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">सीट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="seat" value="<?php echo $measurement['seat'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लटक</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="hanging" value="<?php echo $measurement['hanging'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">जाँघ</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="thigh" value="<?php echo $measurement['thigh'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लंबाई</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="length" value="<?php echo $measurement['length'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">बॉटम</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="bottom" value="<?php echo $measurement['bottom'] ?>" class="form-control">
                        </div>
                      </div>
                  </div>


                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label style="padding-left: 5px;">शर्ट</label>
                    <br><br>
                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">शोल्डर</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="sshoulder" value="<?php echo $measurement['sshoulder'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">चेस्ट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="schest" value="<?php echo $measurement['schest'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">पैंट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="spants" value="<?php echo $measurement['spants'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हाथ</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="shand" value="<?php echo $measurement['shand'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हिप</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="ship" value="<?php echo $measurement['ship'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लंबाई</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="slength" value="<?php echo $measurement['slength'] ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">गला </span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="sthroat" value="<?php echo $measurement['sthroat'] ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>

              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <h4>Services</h4>
              <hr>
              
              <div class="col-md-12">
                  <table class="table">
                        <thead>
                            <tr>
                                <th>Service Type</th>
                                <th>Worker Name</th>
                                <th>GST</th>
                                <th>Quantity</th>
                                <!-- <th>Rate / Unit</th> -->
                                <th>Total Include GST</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($service as $rows): ?>

                              <?php
                                $service = $this->model_servicetype->fecthDataById($rows->service_type);
                                $worker = $this->model_ledger->fecthAllDatabyID($rows->assign_work);
                                $gst = $this->model_gst->fetchAllDataByID($rows->gst);
                                // $gst = $this->model_unit->fetchAllDataByID($rows->gst);
                                // echo "<pre>"; print_r($gst); exit();
                              ?>

                              <tr>
                                <td>
                                    <?php echo $service['service_name']; ?>
                                    <input type="hidden" name="service[]" value="<?php echo $rows->service_type; ?>" />
                                </td>
                                <td>
                                    <?php echo $worker['ledger_name']; ?>
                                    <input type="hidden" name="assign_worker[]" value="<?php echo $rows->assign_work; ?>" />
                                </td>
                                <td>
                                    <?php echo $gst['gst_name']; ?>
                                    <input type="hidden" name="gst[]" value="<?php echo $rows->gst; ?>" />    
                                </td>
                                <td>
                                    <?php echo $rows->quantity; ?>
                                    <input type="hidden" name="quality[]" value="<?php echo $rows->quantity; ?>" /> 
                                </td>
                                <td>
                                    <?php echo $rows->gst_amount; ?>
                                    <input type="hidden" name="rate[]" value="<?php echo $rows->rate; ?>" />
                                    <input type="hidden" name="total[]" value="<?php echo $rows->gst_amount; ?>" />
                                </td>
                                <!-- <td>< ?php echo $production['status']; ?></td> -->
                              </tr>
                            <?php endforeach; ?>
                        </tbody>
                  </table>
              </div>
              
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <h4>Description</h4>
              <hr>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div>
                  <label>Description</label>
                  <textarea name="description" class="form-control"><?php echo $description['description']; ?></textarea>
                </div>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <hr>
                <div align="right">
                   <input type="submit" name="save" value="Update" class="btn btn-sm btn-info"> 
                  <a href="<?php echo base_url() ?>production/update/<?php echo $furtherprocess['production_id'] ?>" class="btn btn-sm btn-danger">Back</a>

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      </form>
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

 <!--MODAL DELETE-->
         <form>
            <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to delete this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="id" id="id" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL DELETE-->


<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url(); ?>';
        
        show_services();  //call function show all product
        
        function show_services()
        {
            var jobno = $('#jobno').val();
            // alert(jobno);
            $.ajax({
                
                url: base_url + 'furtherprocess/fecthServicesByJobId/',
                type: 'post',
                dataType: 'json',
                data : {jobno:jobno},
                success:function(data){
                    
                    var html = '';
                var i;
                var tot = 0; var totunit = 0;
                var gst = '';
                var unit = '';
// <a href="'.base_url().'sales_order/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                for(i=0; i<data.length; i++){
                    html += '<tr>'+
                              '<td>'+data[i].service_name+'</td>'+
                                '<td>'+data[i].assign_work+'</td>'+
                                '<td>'+data[i].gst_name+'</td>'+
                                '<td>'+data[i].quantity+'</td>'+
                                '<td>'+data[i].rate+'</td>'+
                                '<td>'+data[i].gst_amount+'<input type="hidden" name="serviceTot" class="totservice" value="'+data[i].gst_amount+'">'+'</td>'+
                                '<td>'+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-id="'+data[i].id+'">Delete</a>'+
                                      // '<a href="'+base_url+'production/deleteServices/'+data[i].id+'" onclick="return confirm(\' you want to delete?\');">Remove</a>'
                                  //  '<a> href="'.base_url.'production/deleteService/'+data[i].id+'" onclick="return confirm(\' you want to delete?\');"> Delete</a>'+
                                  //  '<a href="javascript:void(0);" class="btn btn-danger btn-sm" data-id="'+data[i].id+'">Delete</a>'+
                                '</td>'+
                            '</tr>';
                      unit = parseInt(data[i].rate);
                      
                      gst = parseInt(data[i].gst_amount);
                      
                      tot = tot + gst;
                      totunit = totunit + unit;


                      $('#service_type').val('0');
                      $('#assign_work').val('0');
                      $('#unit').val('');
                      $('#quality').val('');
                      $('#gst_type').val('0');


                }
                $('#totcost').val(tot);
                $('#totunit').val(totunit);
                $('#show_services').html(html);
                    
                    loadCal();
                }
            });
        }
        
        $('#product_category').on('change', function(){
            
            $('#product_subcategory').html('');
            
           var cat_id = $(this).val();
        //   alert(company_id);
           var html = '';
          $.ajax({
                
                url: base_url + 'product_category/fecthAllSubCatDataByID/',
                type: 'post',
                dataType: 'json',
                data : {cat_id:cat_id},
                success:function(response){
                    
                    
                    // console.log(response);
                    html += '<option value="0">---Select Subcategory---</option>'; 
                    
                    $.each(response, function(index, value) {
                      html += '<option value="'+value.id+'">'+value.subcategory_name+'</option>';             
                    });
                    
                    $('#product_subcategory').append(html);
                }
          });
        });
        
        $('.measuremnt').on('change', function(){
            
            var measurement = $(this).val();
            // alert(measurement);
            if(measurement == "readymade")
            {
                $('#readymade').show();
                $('#custom').hide();
            }
            else
            {
                $('#readymade').hide();
                $('#custom').show();   
            }
        });
        
        $('#quality').on('change', function(){
            
            var quality = $('#quality').val();
            var quantity = $('#quantity').val();
            
            if(quantity < quality)
            {
                alert("Service Quantity more than Product Quantity");
                $('#quality').val("");
            }
        })
        
        $('#addService').on('click', function(){
           
            var service_type = $('#service_type').val();
            var assign_work = $('#assign_work').val();
            var unit = $('#unit').val();
            var quality = $('#quality').val();
            var gst_type = $('#gst_type').val();
            
            var jobno = $('#jobno').val();
            var quantity = $('#quantity').val();
            
            if(quantity < quality)
            {
                alert("Service Quantity more than Product Quantity");
                $('#quality').val("");
            }
            else
            {
                $.ajax({
                    type : "POST",
                    url  : base_url + "furtherprocess/insertServices",
                    dataType : "JSON",
                    data : {service_type:service_type , assign_work:assign_work, unit:unit, quality:quality, gst_type:gst_type, jobno:jobno},
                    success: function(data){
                        
                        // alert('befor Hi');

                        show_services();
                        // alert('after Hi');
                        // console.log(data);
                    }
                });
                return false;
            }
        //   alert(service_type+" "+assign_work+ " " +unit+ " " +quality+ " " +gst_type);
        
        })
        
        $('#show_services').on('click','.item_delete',function(){
            var id = $(this).data('id');
            
            $('#Modal_Delete').modal('show');
            $('[name="id"]').val(id);
        });
        
         $('#btn_delete').on('click',function(){
            var id = $('#id').val();
            // alert(id);
            $.ajax({
                type : "POST",
                url  : base_url + "furtherprocess/deleteServices",
                dataType : "json",
                data : {id:id},
                success: function(data){
                    $('[name="product_code_delete"]').val("");
                    $('#Modal_Delete').modal('hide');
                    
                    // alert(data);
                    show_services();
                    loadCal();
                }
            });
            return false;
        });
        
    });
</script>



<script>

    var base_url = '<?php echo base_url(); ?>'; 
    
    $('#search').on('click', function(){
        
        var searchproduct = $('#searchproduct').val();
        
        // alert(searchproduct);
        

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
                          
                          if(response.status != 'available')
                          {
                              alert('Data Not Available');
                          }
                          else
                          {
                              $.ajax({

                                  url: base_url + 'sku/getUnitBySku/',
                                  type: 'post',
                                  dataType: 'json',
                                  data : {sku:response.sku},
                                  success:function(unitResponse){

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
                                              html += '<input type="text" name="quantityMaterial[]" onchange="cal('+row_id+')" id="quantity_'+row_id+'" class="countQuantity">';
                                          html += '</td>';

                                          html += '<td>';
                                              html += '<input type="text" name="conversion[]" id="conversion_'+row_id+'" value="'+unitResponse.unit+'">';
                                              // html += '<input type="text" name="conversion[]" id="conversion_'+row_id+'" value="'+unitResponse.conversion+'">';
                                          html += '</td>';
                                          
                                          // html += '<td>';
                                          //     html += '<select  onchange="getConversionData('+row_id+')" >';
                                          //             html += '<option value="0">---Select One---</option>';
                                                          
                                          //                 $.each(unitResponse, function(index, value) {
                                                              
                                          //                    html += '<option value="'+value.id+'">'+value.unit+'</option>';
                                          //                 });
                                                              
                                          //     html += '</select>';
                                          // html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="conversionvalue[]" id="conversionvalue_'+row_id+'" readonly value="'+unitResponse.conversion+'" >';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="baseprice[]" value="'+response.baseprice+'" id="baseprice_'+row_id+'" class="bpclass" readonly>';
                                          html += '</td>';
                                         
                                          html += '<td>';
                                              html += '<input type="text" name="subtotal[]" value="'+response.baseprice+'" id="subtotal_'+row_id+'" class="totmaterials" readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
                                          html += '</td>';
                                          
                                          
                                          html += '</tr>';
                                          
                                          $('#consumptionData').append(html);
                                          
                                          // $('#bp').val(response.baseprice);
                                          
                                          
                                          // loadCount(); 
                                  }
                              });          
                          }
                          
                          $('#searchproduct').val("");
                          
                          // $('#cpno').val("0");
                          
                          // loadCount();                                
                      } 
                  });     
    });
    
    
    
    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
        
        loadCal();
    });
</script>

<script type="text/javascript">
  
  var base_url = '<?php echo base_url(); ?>';

  function cal(row_id)
  {
    var quantity = parseFloat($('#quantity_'+row_id).val());
    var conversionvalue = parseFloat($('#conversionvalue_'+row_id).val());
    
    var subtotal = quantity * conversionvalue;

    $('#subtotal_'+row_id).val(subtotal);

    loadCal();
  }
</script>

<script type="text/javascript">

  function readymade()
  {
      var table = $("#measurementData");
      var count_table_tbody_tr = $("#measurementData tr").length;
      var row_id = count_table_tbody_tr + 1;

      var size = $('#readymadesize').val();
      var qty = $('#readymadequantity').val();

      var html = '';
                                  
      html += '<tr id="row_'+row_id+'">';
         
          html += '<td>';
            html += '<input type="text" name="readymadesizeList[]" value="'+size+'">';
          html += '</td>';

          html += '<td>';
            html += '<input type="text" name="readymadequantityList[]" value="'+qty+'">';
          html += '</td>';

          html += '<td>';
            html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
          html += '</td>';

      html += '</tr>';
          
      $('#measurementData').append(html);

      $('#readymadesize').val('');
      $('#readymadequantity').val('');
 
  }


  // measurementData
</script>


<script type="text/javascript">
  
  function loadCal()
  {
    var materialTot = 0; var serviceTot = 0;

    $('.totmaterials').each(function() {
        
        materialTot += parseInt($(this).val(), 10);
        // console.log(materialTot);
        // alert(materialTot);
    });
    $('#tot_material').val(materialTot);


    $('.totservice').each(function() {

        serviceTot += parseFloat($(this).val(), 10);
        // console.log(serviceTot);
        // alert(serviceTot);
    });
    $('#tot_service').val(serviceTot);

    var material = parseFloat($('#tot_material').val());
    var service = parseFloat($('#tot_service').val());
    var finalamt = material + service;

    $('#totproductioncost').val(finalamt);
    $('#productioncostunit').val(finalamt);

    
    // productioncostunit
    // totproductioncost

  }
</script>