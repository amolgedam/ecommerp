
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
        <form action="<?php echo base_url(); ?>production/updateAll" method="post">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                
                <h4>Production</h4>
                <hr>
<!-- 
                < ?php

                    $skuData = $this->model_sku->fecthSkuDataByID

                ?> -->

                <div class="row">

                  <div class="col-md-4 col-sm-4">
                        <label>Job Number</label>
                        <input type="text" name="jobno" id="jobno" readonly value="<?php echo $production['jobsheet_no']; ?>" class="form-control">
                        <input type="hidden" name="id" readonly value="<?php echo $production['id']; ?>" class="form-control">
                    </div>
                  <?php
                        $skuData = $this->model_sku->fecthSkuDataByID($production['sku']);
                        
                      ?>

                  <div class="col-md-4 col-sm-4 col-xs-12">

                    <div>
                        
                      <label>Product Category</label>
                      <!-- <select name="product_category" id="category product_category" required class="form-control"> -->
                      <select name="product_category" id="category" required class="form-control">
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
                      <!-- <select name="product_subcategory" required id="sub_category product_subcategory" class="form-control"> -->
                      <select name="product_subcategory" required id="sub_category" class="form-control">
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
                        <div class="col-md-10">
                          <select name="sku" id="sku" class="form-control" required>
                            <option value="0">---Select One---</option>
                              <?php foreach($sku as $rows): ?>
                                <option value="<?php echo $rows['id']; ?>" <?php echo $production['sku'] == $rows['id'] ? "selected" : "" ; ?> ><?php echo ucwords($rows['product_code']); ?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSku" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <?php
                        $date = date("m-d-Y");
                  ?>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>JobSheet Date</label>
                      <input type="date" name="jobsheet_date" id="jobsheet_date" value="<?php echo $production['jobsheetdate']; ?>"  required class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Delivery Date</label>
                      <input type="date" name="delivery_date" id="delivery_date" value="<?php echo $production['delivery_date']; ?>" required class="form-control">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Job Completion Date</label>
                      <input type="date" name="jobcompletion_date" value="<?php echo $production['completion_date']; ?>" id="jobcompletion_date" class="form-control">
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
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sale Orders</label>
                      
                      <select name="sales_order" id="sales_order" required class="form-control">
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
                      <input type="text" name="quantity"  value="<?php echo $production['quantity']; ?>"  id="quantity" required class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Production Cost</label>
                      <input type="text" name="production_cost" id="totproductioncost" required class="form-control" readonly>
                    </div>
                  </div>
                    <input type="hidden" name="totcost" id="totcost">
                    <input type="hidden" name="totunit" id="totunit">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Production Cost/ Unit</label>
                      <input type="text" name="production_unit"  id="productioncostunit" required class="form-control" readonly>
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
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Search Material</label>
                  <input type="text" name="searchproduct" id="searchproduct" class="form-control" placeholder="Enter Product Code">
                </div>
              </div>
              
              <!--<div class="col-md-4 col-sm-4 col-xs-12">-->
              <!--  <div>-->
              <!--    <br>-->
              <!--    <input type="button" name="search" id="search" class="btn btn-sm btn-primary" value="Search">-->
              <!--  </div>-->
              <!--</div>-->

              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="table table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Product Number</th>
                                  <th>Quantity</th>
                                  <!-- <th>Conversion</th> -->
                                  <!-- <th>Conversion Value</th> -->
                                  <th>Purchase Net Price/Unit</th>
                                  <th>Subtotal</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody id='consumptionData'> 
                              <?php $sum=0; $no=1; foreach($material as $rows): ?>
                            
                                <?php
                                    $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($rows['product_no']);
                                
                                ?>
                                
                              <tr id="row_<?php echo $no ?>" >
                                <td>
                                  <input type="hidden" name="pno[]" value="<?php echo $barcodeData['id'] ?>" id="pno_'<?php echo $no ?>" required readonly>

                                  <input type="text" name="pnoname[]" value="<?php echo $barcodeData['barcode']; ?>" id="pno_'+row_id+'" readonly>
                                </td>
                                <td>
                                  <input type="text" name="quantityMaterial[]" onchange="cal(<?php echo $no; ?>)" id="quantity_<?php echo $no; ?>" class="countQuantity" value="<?php echo $rows['quantity']; ?>">
                                  </td>
                                <!--<td>< ?php echo $rows['conversion']; ?></td>-->
                                <!-- <td>< ?php echo $rows['conversion_value']; ?></td> -->
                                <td>
                                  <input type="text" name="baseprice[]" value="<?php echo $rows['netprice'] ?>" id="baseprice_<?php echo $no ?>" class="bpclass" readonly>
                                </td>
                                <td>
                                  <input type="text" name="subtotal[]" value="<?php echo $rows['subtotal'] ?>" id="subtotal_<?php echo $no ?>" class="totmaterials" readonly>
                                <td>
                                  <a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>
                                </td>
                              </tr>
                            <?php $no++; endforeach; ?>
                          </tbody>
                      </table>
                  </div>
                  <div>
                      <div class="pull-right">
                        Total :-
                          <input type="text" name="tot_material" id="tot_material" readonly>
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
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              
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
                            <!-- <button class="btn btn-sm btn-success">Add</button> -->
                        </div>

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
                              <tbody id="measurementData">
                                  <tbody>
                                    <?php $no=1; foreach($readymadeMeasurement as $rows): ?>
                                      <tr id="row_<?php echo $no ?>">
                                        <td>
                                          <input type="text" name="readymadesizeList[]" value="<?php echo $rows['size']; ?>">
                                        </td>
                                        <td>
                                          <input type="text" name="readymadequantityList[]" value="<?php echo $rows['quantity']; ?>">
                                        </td>
                                        <td>
                                          <a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>
                                        </td>
                                      </tr>
                                    <?php $no++; endforeach; ?>
                                  </tbody>
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
                          <input type="text" name="kshoulder" class="form-control" value="<?php echo $measurement['kshoulder'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">चेस्ट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kchest" class="form-control"  value="<?php echo $measurement['kchest'] ?>">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">पैंट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kpants" class="form-control" value="<?php echo $measurement['kpants'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हाथ</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="khand" class="form-control" value="<?php echo $measurement['khand'] ?>">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हिप</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="khip" class="form-control" value="<?php echo $measurement['khip'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लंबाई</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="klength" class="form-control" value="<?php echo $measurement['klength'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">गला </span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kthroat" class="form-control" value="<?php echo $measurement['kthroat'] ?>" >
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
                          <input type="text" name="waist" class="form-control" value="<?php echo $measurement['waist'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">सीट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="seat" class="form-control" value="<?php echo $measurement['seat'] ?>">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लटक</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="hanging" class="form-control" value="<?php echo $measurement['hanging'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">जाँघ</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="thigh" class="form-control" value="<?php echo $measurement['thigh'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लंबाई</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="length" class="form-control" value="<?php echo $measurement['length'] ?>">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">बॉटम</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="bottom" class="form-control" value="<?php echo $measurement['bottom'] ?>">
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
                          <input type="text" name="sshoulder" class="form-control" value="<?php echo $measurement['sshoulder'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">चेस्ट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="schest" class="form-control" value="<?php echo $measurement['schest'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">पैंट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="spants" class="form-control"  value="<?php echo $measurement['spants'] ?>">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हाथ</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="shand" class="form-control" value="<?php echo $measurement['shand'] ?>">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हिप</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="ship" class="form-control" value="<?php echo $measurement['ship'] ?>" >
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लंबाई</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="slength" class="form-control" value="<?php echo $measurement['slength'] ?>">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">गला </span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="sthroat" class="form-control" value="<?php echo $measurement['sthroat'] ?>" >
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
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Service Type</label>
                  <select name="service_type" id="service_type" class="form-control">
                    <option value="0">---Select One---</option>
                        <?php foreach($servicetype as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo ucwords($rows->service_name); ?></option>
                        <?php endforeach; ?> 
                  </select>

                  <input type="hidden" name="tot_service" id="tot_service">

                </div>
              </div>
               <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Assigned Worker </label>
                  <select name="assign_work" id="assign_work" class="form-control">
                    <option value="0">---Select One---</option>
                    <?php foreach($employee as $rows): ?>
                      <option value="<?php echo $rows->id ?>"><?php echo $rows->ledger_name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Quantity</label>
                  <input type="number" name="quality" id="quality" min="0" class="form-control">
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Rate / Unit</label>
                  <input type="number" name="unit" id="unit" min="0" class="form-control">
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>GST Type</label>
                  <select name="gst_type" id="gst_type" class="form-control">
                    <option value="0">---Select One---</option>
                        <?php foreach($gst as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo ucwords($rows->gst_name); ?></option>
                        <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <br>
                  <button type="button" name="save" id="addService" class="btn btn-primary">Save</button>
                  <!--<button name="add" id="addService" class="btn btn-sm btn-success">Add</button>-->
                  <!--<input type="button" id="addService" class="btn btn-sm btn-success" value="Add">-->
                </div>
              </div>
              

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
                        <tbody id="show_services">
                            <?php $no=1; foreach($service as $rows): ?>

                              <?php
                                $service = $this->model_servicetype->fecthDataById($rows->service_type);
                                $worker = $this->model_ledger->fecthAllDatabyID($rows->assign_work);
                                $gst = $this->model_gst->fetchAllDataByID($rows->gst);
                                // $gst = $this->model_unit->fetchAllDataByID($rows->gst);
                                // echo "<pre>"; print_r($gst); exit();
                              ?>

                              <tr id="row_<?php echo $no ?>">
                                <td>
                                  <?php echo $service['service_name']; ?>
                                  <input type="hidden" name="service[]" id="name_<?php echo $no ?>" value="<?php echo $rows->service_type; ?>" />
                                </td>
                                <td>

                                  <?php echo $worker['ledger_name']; ?>
                                    <input type="hidden" name="assign_worker[]" id="worker_<?php echo $no ?>" value="<?php echo $rows->assign_work; ?>" />    
                                </td>
                                <td>
                                  <?php echo $gst['gst_name']; ?>
                                  <input type="hidden" name="gst[]" id="gst_<?php echo $no ?>" value="<?php echo $rows->gst; ?>" />  
                                </td>
                                <td>
                                  <?php echo $rows->quantity; ?>
                                  <input type="hidden" name="quality[]" id="sqty_<?php echo $no ?>" value="<?php echo $rows->quantity; ?>" />
                                </td>
                                <td>
                                  <?php echo $rows->rate; ?>
                                  <input type="hidden" name="rate[]" id="rate_<?php echo $no ?>" value="<?php echo $rows->rate; ?>" />
                                </td>
                                <td>
                                    <?php echo $rows->quantity * $rows->rate; ?>
                                    
                                    <input type="hidden" name="total[]" id="amt_<?php echo $no ?>" value="<?php echo $rows->gst_amount; ?>" class="totservice" />      
                                </td>
                                <td>
                                  <a href="javascript:void(0);" class="btn btn-primary btn-sm editService" data-row="<?php echo $no ?>" >Edit</a>
                                  <a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>
                                  <!-- < ?php echo $production['status']; ?>     -->
                                </td>
                              </tr>
                            <?php $no++; endforeach; ?>
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
                  <input type="submit" name="print" value="Save and Print" class="btn btn-sm btn-info">
                    <input type="submit" id="product" name="product" value="Save and Create Product" class="btn btn-sm btn-info">
                  <a href="<?php echo base_url() ?>production" class="btn btn-sm btn-info">Back</a>

                  <!--<a href="#" class="btn btn-sm btn-info">Save and Print</a>-->
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
              
              <div>No Item</div>

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

//   $this->load->view('admin_view/templates/modals/createLedger');
  
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
        
        // show_services();	//call function show all product
        
        function show_services()
        {
            var jobno = $('#jobno').val();
            
            $.ajax({
                
                url: base_url + 'production/fecthServicesByJobId/',
                type: 'post',
                dataType: 'json',
                data : {jobno:jobno},
                success:function(data){
                    
                    console.log(data);
                    
                    var html = '';
		            var i;
		            var tot = 0; var totunit = 0;
		            var gst = '';
		            var unit = '';
// <a href="'.base_url().'sales_order/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
		            for(i=0; i<data.length; i++){
		                html += '<tr>'+
    		                  		'<td>'+data[i].service_name+'</td>'+
    		                        '<td>'+data[i].ledger_name+'<input type="hidden" name="ledgerId[]" value="'+data[i].assign_work+'"> </td>'+
    		                        '<td>'+data[i].gst_name+'</td>'+
    		                        '<td>'+data[i].quantity+'</td>'+
    		                        '<td>'+data[i].rate+'</td>'+
    		                        '<td>'+data[i].gst_amount+'<input type="hidden" name="serviceTot[]" class="totservice" value="'+data[i].gst_amount+'">'+'</td>'+
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
                // console.log(service_type);
                $.ajax({
                    type : "POST",
                    url  : base_url + "gst/fetchAllDataByID",
                    dataType : "JSON",
                    data : {gst_id:gst_type},
                    success: function(gstData){
                        
                        var totGst = (Number(gstData.cgst) + Number(gstData.sgst) + Number(gstData.igst));
                        
                        // console.log(totGst);
                        var price = unit * quality;
                        // console.log(price);
                        var amt = (price * totGst) / 100;
                        // console.log(amt);
                        var gstAmt = amt + price;
                        // console.log(gstAmt);
                        
                        $.ajax({
                            type : "POST",
                            url  : base_url + "service_master/fetchAllDataByID",
                            dataType : "JSON",
                            data : {service_id:service_type},
                            success: function(serviceData){
                        
                                // console.log(serviceData);
                                
                                
                                $.ajax({
                                    type : "POST",
                                    url  : base_url + "ledger_master/fecthLedgerDataByID",
                                    dataType : "JSON",
                                    data : {ledger_id:assign_work},
                                    success: function(workerData){
                                
                                        // console.log(workerData);
                                        
                                        var html = '';
                                        
                                        var table = $("#consumptionData");
                                        var count_table_tbody_tr = $("#show_services tr").length;
                                        var row_id = count_table_tbody_tr + 1;
                                        
                                        
                                        html += '<tr id="row_'+row_id+'">';
                                            html += '<td>';
                                                html += '<input type="hidden" name="service[]" id="name_'+row_id+'" value="'+serviceData.id+'" >';
                                                html += '&nbsp'+serviceData.service_name+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="assign_worker[]" id="worker_'+row_id+'" value="'+workerData.id+'" >';
                                                html += '&nbsp'+workerData.ledger_name+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="gst[]" id="gst_'+row_id+'" value="'+gstData.id+'" >';
                                                html += '&nbsp'+gstData.gst_name+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="quality[]" id="sqty_'+row_id+'" value="'+quality+'" >';
                                                html += '&nbsp'+quality+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="rate[]" id="rate_'+row_id+'" value="'+unit+'" >';
                                                html += '&nbsp'+unit+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="total[]" id="amt_'+row_id+'" value="'+gstAmt+'" class="totservice">';
                                                html += '&nbsp'+gstAmt+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<a href="javascript:void(0);" class="btn btn-primary btn-sm editService" data-row="'+row_id+'" >Edit</a> &nbsp;';
                                                html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
                                            html += '</td>';
                                        
                                        html += '<tr>';
                                        
                                        $('#service_type').val('0');
                                        $('#assign_work').val('0');
                                        $('#unit').val('');
                                        $('#quality').val('');
                                        $('#gst_type').val('0');
                    
                    		            $('#show_services').append(html);
                                        
                                        loadCal();
                                    }
                                });
                            }
                        });
                    }
                });
            }
        })
        
        
        $('#show_services').on('click','.editService',function(){
            
            var row = $(this).data('row');
            
            var sid = $('#name_'+row).val();
            var wid = $('#worker_'+row).val();
            var gst = $('#gst_'+row).val();
            var qty = $('#sqty_'+row).val();
            var rate = $('#rate_'+row).val();
            var amt = $('#amt_'+row).val();
            
            // console.log("sid "+sid+" wid "+wid+" gst"+gst+" qty "+qty+" rate "+rate+" amt "+amt);
            
            $('#service_type').val(sid);
            $('#assign_work').val(wid);
            $('#quality').val(qty);
            $('#unit').val(rate);
            $('#gst_type').val(gst);

            $("#show_services tr#row_"+row).remove();
        });
        
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
                    
                    // show_services();
                    loadCal();
                }
            });
            return false;
        });
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
                        
                        
                        $('#category').val(response.category_id);
                        $('#sub_category').val(response.subcategory_id);
                        // $('#unitValue').val(response.unit_id);
                        // $('#unit').val(response.unit_id);
                        
                        $('#category, #sub_category').prop('disabled', true);
                        
                       
                    }
              });
        });
    
   
</script>

<script>

    var base_url = '<?php echo base_url(); ?>'; 
    
    $('#searchproduct').on('keyup', function(){
        
        var barcode = $(this).val().length;
        
        if(barcode > 9)
        {
            
            var searchproduct = $('#searchproduct').val();
        
            // alert(searchproduct);
        

                var table = $("#consumptionData");
                var count_table_tbody_tr = $("#consumptionData tr").length;
                var row_id = count_table_tbody_tr + 1;
                
                $.ajax({
            
                url: base_url + 'unit/fecthAllData/',
                type: 'post',
                dataType: 'json',
                success:function(unitResponse){
                    
                    
                    //   console.log(unitResponse);
                
                    $.ajax({

                      url: base_url + 'internal_consumption/fetchDataByBarcodeId/',
                      type: 'post',
                      dataType: 'json',
                      data : {barcode_code:searchproduct},
                      success:function(response){
                          
                           console.log(response);
                          
                          if(response.status != 'available')
                          {
                              alert('Data Not Available');
                          }
                          else
                          {
                              $.ajax({

                                  url: base_url + 'sku/getDataBySkuID/',
                                  type: 'post',
                                  dataType: 'json',
                                  data : {sku:response.skuid},
                                  success:function(skuResponse){

                                    //   console.log(skuResponse);

                                        var html = conversion = conversionvalue = '';
                                        
                                        
                                        if(skuResponse.unit == 'Pieces')
                                        {
                                            conversion = '';
                                            conversionvalue = '';
                                        }
                                        else
                                        {
                                            conversion += '<select name="conversion[]" id="unitConversion_'+row_id+'" onchange="getConversionData('+row_id+')" >';
                                                     
                                                                $.each(unitResponse, function(index, value) {
                                                                  
                                                                    conversion += '<option value="'+value.id+'">'+value.unit+'</option>';
                                                                });
                                                              
                                              conversion += '</select>';
                                              
                                            
                                            conversionvalue += '<input type="text" name="conversionvalue[]" id="conversionvalue_'+row_id+'" readonly value="1" >';
                                        }
                                      
                                      
                                      html += '<tr id="row_'+row_id+'">';
                                              
                                              $('#quantity_'+row_id).val("1");
                                              $('#conversionvalue_'+row_id).val("0");
                                          
                                          html += '<td>';
                                              html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                              html += '<input type="hidden" name="pno[]" value="'+response.pnoid+'" id="pno_'+row_id+'" required readonly>';
                                              html += '<input type="text" name="pnoname[]" value="'+response.pno+'" id="pno_'+row_id+'" required readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="quantityMaterial[]" onchange="cal('+row_id+')" id="quantity_'+row_id+'" class="countQuantity" value="1">';
                                          html += '</td>';

                                          // html += '<td>';
                                          //       html += conversion;
                                            //   html += '<input type="text" name="conversion[]" id="conversion_'+row_id+'" value="'+unitResponse.unit+'">';
                                            //   html += '<input type="text" name="conversion[]" id="conversion_'+row_id+'" value="'+unitResponse.conversion+'">';
                                          // html += '</td>';
                                          
                                           // html += '<td>';
                                           //      html += conversionvalue;
                                            //   html += '<select  onchange="getConversionData('+row_id+')" >';
                                            //           html += '<option value="0">---Select One---</option>';
                                                          
                                            //               $.each(unitResponse, function(index, value) {
                                                              
                                            //                   html += '<option value="'+value.id+'">'+value.unit+'</option>';
                                            //               });
                                                              
                                            //   html += '</select>';
                                           // html += '</td>';
                                          
                                        //   html += '<td>';
                                        //       html += '<input type="text" name="conversionvalue[]" id="conversionvalue_'+row_id+'" readonly value="'+unitResponse.conversion+'" >';
                                        //   html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="baseprice[]" value="'+response.netprice+'" id="baseprice_'+row_id+'" class="bpclass" readonly>';
                                          html += '</td>';
                                         
                                          html += '<td>';
                                              html += '<input type="text" name="subtotal[]" value="'+response.netprice+'" id="subtotal_'+row_id+'" class="totmaterials" readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
                                          html += '</td>';
                                          
                                          html += '</tr>';
                                          
                                          $('#consumptionData').append(html);
                                          
                                          // $('#bp').val(response.baseprice);
                                          
                                           loadCal(); 
                                  }
                              });          
                          }
                          
                          $('#searchproduct').val("");
                          
                          // $('#cpno').val("0");
                          
                          // loadCount();                                
                      } 
                  });
            
                
                }
            });
            
        }
    });
    
    
    
    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
        
        loadCal();
    });
    
    
    function getConversionData(row_id)
    {  
        var qty = $('#quantity_'+row_id).val();
        var con = $('#unitConversion_'+row_id).val();
        // var con = $('#conversion_'+row_id).val();
        
        // alert(qty); alert(con);
        
        $.ajax({
                    
            url: base_url + 'unit/fecthUnitDataByID/',
            type: 'post',
            dataType: 'json',
            data : {unit_id:con},
            success:function(response){
                
                // console.log(response);
            
                result = parseFloat(qty, 10) / parseFloat(response.conversion, 10);
                
                $('#conversionvalue_'+row_id).val(result);
                
                cal(row_id);
            }
        });

        loadCal();
    }
</script>

<script type="text/javascript">
  
  var base_url = '<?php echo base_url(); ?>';

  function cal(row_id)
  {
    var price = parseFloat($('#baseprice_'+row_id).val());
    var conversionvalue = parseFloat($('#conversionvalue_'+row_id).val());
    
    var qty = parseFloat($('#quantity_'+row_id).val());
    
    
    // console.log(quantity);console.log(conversionvalue);
    
    var subtotal = price * qty;
    subtotal = (subtotal).toFixed(3);
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
  
  loadCal();

  function loadCal()
  {
    var materialTot = 0; var serviceTot = 0;

    $('.totmaterials').each(function() {
        
        materialTot += parseFloat($(this).val(), 10);
    });
        // console.log(materialTot);
    $('#tot_material').val(materialTot);

    $('.totservice').each(function() {

        serviceTot += parseFloat($(this).val(), 10);
        // console.log(serviceTot);
    });
    $('#tot_service').val(serviceTot);

    var material = parseFloat($('#tot_material').val());
    var service = parseFloat($('#tot_service').val());
    var finalamt = material + service;

    finalamt = (finalamt).toFixed(3);
    $('#totproductioncost').val(finalamt);
    
    var qty = parseFloat($('#quantity').val());
    
    var amt = finalamt / qty;
    amt = (amt).toFixed(3);
    $('#productioncostunit').val(amt);
    // console.log(amt);
    // productioncostunit
    // totproductioncost
  }
</script>

<script>
    $(document).ready(function(){
        
        getSalesOrder();
        
        $('#sales_order').on('change', function(){
            
            getSalesOrder();
        });
        
        function getSalesOrder()
        {
            var sorder_id = $('#sales_order').val();
            // alert(sorder_id);
            
            $.ajax({
                
                url: base_url + 'sales_order/getSalesOrderDataByID/',
                type: 'post',
                dataType: 'json',
                data : {sorder_id:sorder_id},
                success:function(response){
                    
                    
                    if(response != null)
                    {
                        // console.log(response);
                        $('#customer_list').val(response.account_id);
                        
                    }
                }
            });
        }
        
        getSalesQtyData();
        
        function getSalesQtyData()
        {
            var sorderQty_id = $('#orderjob').val();
            // alert(sorderQty_id);
            
            $.ajax({
                
                url: base_url + 'sales_order/getSalesOrderQtyDataByID/',
                type: 'post',
                dataType: 'json',
                data : {sorderQty_id:sorderQty_id},
                success:function(response){
                
                    // console.log(response);
                      
                    if(response['0'] != null)
                    {
                        
                        $('#quantity').val(response[0].quantity);
                      
                        $('#category').val(response[1].category_id);
                        $('#sub_category').val(response[1].subcategory_id);
                        $('#sku').val(response[1].id);
                        
                    }
                }
            });
        }
        
        
        
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
    });
</script>






