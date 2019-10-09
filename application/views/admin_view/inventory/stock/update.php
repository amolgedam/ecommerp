<!-- < ?php echo "<pre>"; print_r($itemData); exit; ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Opening Stock
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Opening Stock</li>
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
            
            <form method="post" action="<?php echo base_url() ?>opening_stock/update">
          <div class="box">
            <div class="box-body">
                
                <div class="row">
                
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Opening Stock No.</label>
                      <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control">
                      <input type="text" name="opening_stock" value="<?php echo $allData['opening_no']; ?>" readonly class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Invoice Date</label>
                      <input type="date" name="invoice_date" value="<?php echo $allData['invoice_date']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Entry Date</label>
                      <input type="date" name="entry_date" value="<?php echo $allData['entry_date']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Shiping Type</label>
                      <!-- <div class="row"> -->
                        <input type="text" name="stype" value="<?php echo $allData['shipping_type']; ?>" required class="form-control">

                        <!--<div class="col-md-2">-->
                        <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addShipingType" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                        <!-- <div class="col-md-12">
                            <select name="stype" id="stype" class="form-control">
                              <option value="0">---Select One---</option>
                              < ?php foreach($shiptype as $rows): ?>
                                <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['shipping_type'] == $rows->id ? "selected" : "" ; ?>>< ?php echo $rows->shipping_name; ?></option>
                              < ?php endforeach; ?>
                            </select>
                        </div> -->
                      <!-- </div> -->
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Shipping Tracking No.</label>
                      <input type="text" name="stracking_no" value="<?php echo $allData['tracking_no']; ?>" class="form-control">
                    </div>
                  </div> 
                 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Division</label>
                      <select name="division" id="division" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($division as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['division'] == $rows->id ? "selected" : "" ; ?>><?php echo $rows->division_name; ?></option>
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
                              <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['branch'] == $rows->id ? "selected" : "" ; ?>>< ?php echo $rows->branch_name; ?></option>
                          < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Location</label>
                      <select name="location" id="location" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($location as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['location'] == $rows->id ? "selected" : "" ; ?>><?php echo $rows->location_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Adjustment(+/-)</label>
                      <input type="text" name="adjustment" id="adjustment" value="<?php echo $allData['adjustment']; ?>" onkeyup="getadjustment();" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Invoice Value</label>
                      <input type="text" name="total_invoice" id="total_invoice" value="<?php echo $allData['tot_invoicevalue']; ?>" class="form-control" readonly="">

                      <input type="hidden" name="demotot" id="demotot" value="<?php echo $allData['tot_invoicevalue']; ?>" class="form-control" readonly="">

                    </div>
                  </div>             
              </div>

              <hr>
              <div align="right">
                <input type="submit" name="save" value="Save and Opening Stock" class="btn btn-success">
                <!--<a href="#" class="btn btn-success">Save and Print Barcode</a>-->
                
                <?php if($allData['product_status'] == 'not'){ ?>
                    <a href="<?php echo base_url() ?>barcode/opening_stock/<?php echo $allData['id']; ?>" class="btn btn-success" >Print Barcode</a>
                <?php } ?>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          
          </form>


          <div class="box">
              <br>
              <div style="float:right">
                <a href="<?php echo base_url() ?>opening_stockitem/create/<?php echo $allData['id'] ?>" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Item</a>
              </div>
              <br><br>
            <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped mydatatable">
                    <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>SKU</th>
                        <th>Quantity</th>
                        <th>Basic Rate</th>
                        <!--<th>GST Applicable</th>-->
                        <th>Purchase Net Price/Unit</th>
                        <th>MRP</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($itemData as $rows): ?>
                        <?php
                          $skuData = $this->model_sku->fecthSkuDataByID($rows->sku);
                          // echo "<pre>"; print_r($skuData);exit();
                        ?>

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $skuData['product_code']; ?></td>
                            <td><?php echo $rows->quality; ?></td>
                            <td><?php echo $rows->base_price; ?></td>
                            <td><?php echo $rows->pnetprice; ?></td>
                            <td><?php echo $rows->mrp; ?></td>
                            <td width="170px">
                              <a href="<?php echo base_url() ?>opening_stockitem/update/<?php echo $rows->id; ?>" class="btn btn-sm btn-info">
                                <i style="color: white" class="fa fa-edit"></i> Edit
                              </a>
                              <a href="<?php echo base_url(); ?>opening_stockitem/deleteItem/<?php echo $rows->id; ?>" onclick="return confirm('you want to delete?')" class="btn btn-sm btn-danger">
                                <i style="color: white" class="fa fa-trash"></i> Delete
                              </a>
                              
                              <a href="<?php echo base_url(); ?>opening_stockitem/viewBarcode1/<?php echo $rows->id; ?>" class="btn btn-sm btn-success">
                                <i style="color: white" class="fa fa-eye"></i> Details
                              </a>
                            </td>
                          </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                  </table>
                </div>
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


<!-- FOR SHIPPING MODAL OPEN -->
<?php
  $this->load->view('admin_view/templates/modals/shippingType');
  // $this->load->view('admin_view/templates/modals/createLedger');
?>


<script type="text/javascript">
  
  function getadjustment()
  {
      var demotot = parseFloat($('#demotot').val());
      var adjustment = parseFloat($('#adjustment').val());

      $('#total_invoice').val(demotot - adjustment);
  }


</script>