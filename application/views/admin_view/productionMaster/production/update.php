 <!--< ?php echo "<pre>"; print_r($material); exit(); ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Production Manage
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Manage Production</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="<?php echo base_url(); ?>production/update" method="post">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                
                <h4>Production</h4>
                <hr>

                <div class="row">
                    
                    <div class="col-md-4 col-sm-4">
                        <label>Job Number</label>
                        <input type="text" name="jobno" id="jobno" readonly value="<?php echo $production['jobsheet_no']; ?>" class="form-control">
                        <input type="hidden" name="id" readonly value="<?php echo $production['id']; ?>" class="form-control">
                    </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                      
                      <?php
                        $skuData = $this->model_sku->fecthSkuDataByID($production['sku']);
                        
                      ?>
                    <div>
                      <label>Product Category</label>
                      <select name="product_category" id="product_category" required class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($category as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"  <?php echo $skuData['category_id'] == $rows->id ? "selected" : "" ; ?> ><?php echo ucwords($rows->catgory_name); ?></option>
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
                            <option value="<?php echo $rows->id; ?>" <?php echo $skuData['subcategory_id'] == $rows->id ? "selected" : "" ; ?>><?php echo ucwords($rows->subcategory_name); ?></option>
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
                                    <option value="<?php echo $rows['id']; ?>" <?php echo $production['sku'] == $rows['id'] ? "selected" : "" ; ?> ><?php echo ucwords($rows['product_code']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <div class="col-md-2">-->
                        <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSku" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>JobSheet Date</label>
                      <input type="date" name="jobsheet_date" value="<?php echo $production['jobsheetdate']; ?>" required class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Delivery Date</label>
                      <input type="date" name="delivery_date" value="<?php echo $production['delivery_date']; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Job Completion Date</label>
                      <input type="date" name="jobcompletion_date" value="<?php echo $production['completion_date']; ?>"  class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Customer List</label>
                      <div class="row">
                        <div class="col-md-12">
                          <select name="customer_list" id="customer_list" required class="form-control">
                            <option value="0">---Select One---</option>
                            <?php foreach($ledgerAccount as $rows): ?>
                              <option value="<?php echo $rows['id']; ?>" <?php echo $production['customer'] == $rows['id'] ? "selected" : "" ; ?> ><?php echo $rows['ledger_name']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <!--<div class="col-md-2">-->
                        <!--  <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_createLedger" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sale Orders</label>
                      <select name="sales_order"  required class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($sales_order as $rows): ?>
                            <option value="<?php echo $rows->id; ?>" <?php echo $production['salesorder_id'] == $rows->id ? "selected" : "" ; ?>><?php echo ucwords($rows->order_no); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <div>
                        <label>Status</label>
                        <?php if($production['status'] != "Complete"){ ?>
                        <select name="status" id="status" required class="form-control">
                          <option value="0" <?php echo $production['status'] == "0" ? "selected" : "" ; ?>>---Select One---</option>
                          <option value="Open" <?php echo $production['status'] == "Open" ? "selected" : "" ; ?>>Open</option>
                          <option value="Further Process" <?php echo $production['status'] == "Further Process" ? "selected" : "" ; ?>>Further Process</option>
                          <option value="Complete" <?php echo $production['status'] == "Complete" ? "selected" : "" ; ?>>Complete</option>
                          <option value="Incomplete" <?php echo $production['status'] == "Incomplete" ? "selected" : "" ; ?>>Incomplete</option>
                        </select>
                        <?php
                          }
                          else
                          {
                        ?>
                          <select name="status" id="status" required class="form-control">
                            <option value="Complete" <?php echo $production['status'] == "Complete" ? "selected" : "" ; ?>>Complete</option>
                          </select>
                        <?php } ?>
                      </div>
                    </div>
                  

                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Quantity</label>
                      <input type="text" name="quantity" value="<?php echo $production['quantity']; ?>" id="quantity" required class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Production Cost</label>
                      <input type="text" name="production_cost" value="<?php echo $production['total_pcost']; ?>" required class="form-control" readonly>
                    </div>
                  </div>
                    <input type="hidden" name="totcost" id="totcost">
                    <input type="hidden" name="totunit" id="totunit">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Production Cost/ Unit</label>
                      <input type="text" name="production_unit" value="<?php echo number_format($production['total_pcost'] / $production['quantity'], 3); ?>" required class="form-control" readonly>
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
              <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Product Number</th>
                          <th>Quantity</th>
                          <!--<th>Conversion</th>-->
                          <th>Conversion Value</th>
                          <th>Purchase Net Price/Unit</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $sum=0; foreach($material as $rows): ?>
                            
                            <?php
                                $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($rows['product_no']);
                            
                            ?>
                            
                          <tr>
                            <td><?php echo $barcodeData['barcode']; ?></td>
                            <td><?php echo $rows['quantity']; ?></td>
                            <!--<td>< ?php echo $rows['conversion']; ?></td>-->
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
                        <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                              
                                  <div style="padding-left: 5px;">Size</div>
                                  <input type="text" name="size" value="< ?php echo $measurement['size'] ?>" class="form-control">
                              
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              
                                  <div style="padding-left: 5px;">Quantity</div>
                                  <input type="text" name="mquantity" value="< ?php echo $measurement['quantity'] ?>" class="form-control">
                                
                        </div> -->
                        <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>&nbsp;</div>
                            <button class="btn btn-sm btn-success">Add</button>
                        </div> -->

                        <div class="col-md-12">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <td>Measurement Size</td>
                                  <td>Quantity</td>
                                  <!-- <td>Action</td> -->
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
                  <br><br>
                  <table class="table">
                        <thead>
                              <tr>
                                  <th>Service Type</th>
                                  <th>Worker Name</th>
                                  <th>GST</th>
                                  <th>Quantity</th>
                                   <th>Rate / Unit</th> 
                                  <th>Total Include GST</th>
                                  <th>Action</th>
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
                                  <?php echo $rows->rate; ?>
                                  <input type="hidden" name="rate[]" value="<?php echo $rows->rate; ?>" />
                                  <!-- <input type="hidden" name="quality[]" value="< ?php echo $rows->quantity; ?>" /> -->
                                </td>
                                <td>
                                    <?php echo $rows->quantity * $rows->rate; ?>
                                    
                                    <input type="hidden" name="total[]" value="<?php echo $rows->gst_amount; ?>" />      
                                </td>
                                <td><?php echo $production['status']; ?></td>
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
                  <input type="submit" name="save" value="Save" class="btn btn-sm btn-info">
                    <input type="submit" name="print" value="Print" class="btn btn-sm btn-info">
                    <input type="submit" id="product" name="product" value="Save and Create Product" class="btn btn-sm btn-info">
                  <a href="<?php echo base_url() ?>production" class="btn btn-sm btn-info">Back</a>
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

              <h4>Further Process List</h4>
              <hr>              
              <!--< ?php if($production['status'] == 'Further Process'){ ?>-->
              
                  <?php
                    $furtherprocessData = $this->model_furtherprocess->fecthAllDatabyProductionID($production['id']);
                    //   echo "<pre>"; print_r($furtherprocessData); exit();
                  ?>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Further Process No</th>
                        <th>Job Sheet Date</th>
                        <th>Delivery Date</th>
                        <th>Quantity</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        <?php if($furtherprocessData != 0){ ?>
                            <?php foreach($furtherprocessData as $rows){ ?>
                              <tr>
                                <td><?php echo $rows['process_no']; ?></td>
                                <td><?php echo $rows['jobsheetdate']; ?></td>
                                <td><?php echo $rows['delivery_date']; ?></td>
                                <td><?php echo $rows['quantity']; ?></td>
                                <td><a href="<?php echo base_url() ?>furtherprocess/update/<?php echo $rows['id']; ?>">more details...</a></td>
                              </tr>
                            <?php } ?>
                        <?php
                            }
                            else
                            {
                        ?>
                            <tr><td colspan="5">No Item</td></tr>
                        <?php } ?>
                    </tbody>
                  </table>
              <!--< ?php }else{ ?>-->
                <!--<div>No Item</div>-->
              <!--< ?php } ?>-->
             
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
                    url  : base_url + "production/insertServices",
                    dataType : "JSON",
                    data : {service_type:service_type , assign_work:assign_work, unit:unit, quality:quality, gst_type:gst_type, jobno:jobno},
                    success: function(data){
                        
                        show_services();
                        // alert('Hi');
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
            $.ajax({
                type : "POST",
                url  : base_url + "production/deleteServices",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $('[name="product_code_delete"]').val("");
                    $('#Modal_Delete').modal('hide');
                    
                    show_services();
                }
            });
            return false;
        });
        
    });
</script>


<script>
    $(document).ready(function(){
        
        $('#product').hide();
        
       $('#status').on('change', function(){
           
           var status = $(this).val();
        //   alert(status);
           
           if(status == 'Complete')
           {
                $('#product').show();
           }
       }) ;
       
       completeProduction();
       
       function completeProduction()
       {
            var status = $(this).val();
           
            if(status == 'Complete')
            {
                $('#product').show();
            }
       }
    });
</script>





