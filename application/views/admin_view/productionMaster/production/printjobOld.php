 <!--< ?php echo "<pre>"; print_r($info); exit(); ?> -->
 <?php 
   
    $ledgerData = $this->model_ledger->fecthDataByID($workerid);
    // echo "<pre>"; print_r($ledgerData); exit();
    
    $salesQty = $this->model_salesorder->fetchQtyDataByJobId($product['id']);
    $salesorder = $this->model_salesorder->fecthAllDatabyID($salesQty['salesorder_id']);
    
    
    $measurementData = $this->model_production->fecthAllMeasurementData($product['id']);
    $materialData = $this->model_production->fecthAllMaterialData($product['id']);
    
    
    // $skuData = $this->model_sku->fecthSkuDataByID($salesQty['sku']);
 
    // echo "<pre>"; print_r($info);
    // echo "<pre>"; print_r($product);
    // echo "<pre>"; print_r($salesQty);
    // echo "<pre>"; print_r($salesorder);
    // echo "<pre>"; print_r($skuData);
    // echo "<pre>"; print_r($measurementData);
    // echo "<pre>"; print_r($materialData);exit;
 ?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Main content -->
    <section class="content">
        <form action="<?php echo base_url(); ?>production/printjoboption" method="post">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                    
                    <h4>Print Options</h4>
                    <hr>
    
                    <div class="col-md-4">
                        <label>JobSheet Number</label>
                        <div>
                            <input type="hidden" name="productionid" value="<?php echo $productionid; ?>">
                            <input type="hidden" name="customerid" value="<?php echo $customerid; ?>">
                            <input type="hidden" name="ledgerid" value="<?php echo $ledgerData['id']; ?>">
                            
                            <select name="emplyee" class="form-control">
                                <option value="0" <?php echo $info['id'] == 0 ? "selected" : ''; ?> >Customer Copy</option>
                                <option value="<?php echo $ledgerData['id']; ?>"><?php echo $ledgerData['ledger_name']; ?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <br>
                        <input type="submit" name="search" value="Search Jobsheet" class="btn btn-info">
                    </div>
                    
                </div>
                <!-- /.box-body -->
              </div>
    
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->

        </form>
    </section>
    <!-- /.content -->
    
    <?php if($info != ''){ ?>
                            
        <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                
                                <h5><center>Job/Alteration Slip</center></h5>
                                
                                <?php if($info['ledgettype_id'] == 5){ ?>
                                    <div><h6><center>Customer Slip</center></h6></div>
                                <?php }else{ ?>
                                    <div><h6><center>Tailor Slip</center></h6></div>
                                <?php } ?>
                                
                                <br><br>
                                <div class="col-md-6">
                                    <table>
                                        <tr>
                                            <td><label>Name:- </label></td>
                                            <td><?php echo $info['ledger_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Contact Number:- </label></td>
                                            <td><?php echo $info['mobile']; ?>, <?php echo $info['phone']; ?> </td>
                                        </tr>
                                        <tr>
                                            <td><label>Address:- </label></td>
                                            <td><?php echo $info['address_1']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Order Number:- </label></td>
                                            <td><?php echo $salesorder['order_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Quantity:- </label></td>
                                            <td><?php echo $salesQty['quantity']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <div class="col-md-6">
                                    <table >
                                        <tr>
                                            <td><label>Jobsheet Number:- </label></td>
                                            <td><?php echo $product['jobsheet_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Job Date:- </label></td>
                                            <td><?php echo $product['jobsheetdate']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Delivery Date:- </label></td>
                                            <td><?php echo $product['delivery_date']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>SKU:- </label></td>
                                            <td><?php echo $salesQty['sku']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                
                                
                                <?php if(!empty($measurementData)){  ?>
                                    <br><br><br>
                                    <div class="col-md-12">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label style="padding-left: 5px;">कोट</label>
                                            <br><br>
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">शोल्डर</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="kshoulder" class="form-control">-->
                                                  <?php echo $measurementData['kshoulder']; ?>
                                                </div>
                                            </div>    
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">चेस्ट</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="kchest" class="form-control">-->
                                                    <?php echo $measurementData['kchest']; ?>
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">पैंट</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="kpants" class="form-control">-->
                                                  <?php echo $measurementData['kpants']; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">हाथ</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="khand" class="form-control">-->
                                                  <?php echo $measurementData['khand']; ?>
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">हिप</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="khip" class="form-control">-->
                                                  <?php echo $measurementData['khip']; ?>
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">लंबाई</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="klength" class="form-control">-->
                                                  <?php echo $measurementData['klength']; ?>
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">गला </span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="kthroat" class="form-control">-->
                                                  <?php echo $measurementData['kthroat']; ?>
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
                                                  <!--<input type="text" name="waist" class="form-control">-->
                                                  <?php echo $measurementData['waist']; ?>
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">सीट</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="seat" class="form-control">-->
                                                  <?php echo $measurementData['seat']; ?>
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">लटक</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="hanging" class="form-control">-->
                                                  <?php echo $measurementData['hanging']; ?>
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">जाँघ</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="thigh" class="form-control">-->
                                                  <?php echo $measurementData['thigh']; ?>
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">लंबाई</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="length" class="form-control">-->
                                                  <?php echo $measurementData['length']; ?>
                                                </div>
                                            </div>
                        
                                            <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">बॉटम</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="bottom" class="form-control">-->
                                                  <?php echo $measurementData['bottom']; ?>
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
                                                  <!--<input type="text" name="sshoulder" class="form-control">-->
                                                  <?php echo $measurementData['sshoulder']; ?>
                                                </div>
                                              </div>
                        
                                              <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">चेस्ट</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="schest" class="form-control">-->
                                                  <?php echo $measurementData['schest']; ?>
                                                </div>
                                              </div>
                        
                                              <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">पैंट</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="spants" class="form-control">-->
                                                  <?php echo $measurementData['spants']; ?>
                                                </div>
                                              </div>
                        
                                              <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">हाथ</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="shand" class="form-control">-->
                                                  <?php echo $measurementData['shand']; ?>
                                                </div>
                                              </div>
                        
                                              <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">हिप</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="ship" class="form-control">-->
                                                  <?php echo $measurementData['ship']; ?>
                                                </div>
                                              </div>
                        
                                              <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">लंबाई</span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="slength" class="form-control">-->
                                                  <?php echo $measurementData['slength']; ?>
                                                </div>
                                              </div>
                        
                                              <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <span style="padding-left: 5px;">गला </span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                  <!--<input type="text" name="sthroat" class="form-control">-->
                                                  <?php echo $measurementData['sthroat']; ?>
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                                
                                <?php if(!empty($materialData)){ ?>
                                    <br><br><br>
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <th>Quantity</th>
                                                <th>Serial Number</th>
                                                <th>SKU</th>
                                                <th>Color</th>
                                            </tr>
                                            
                                            <?php foreach($materialData as $rows){ ?>
                                            
                                                <?php
                                                    $skuData = $this->model_barcode->fetchAllDataByBarcode($rows['product_no']);
                                                    // echo "<pre"; print_r($skuData); 
                                                    $attr = $this->model_barcode->$skuData['attr_id'];
                                                ?>
                                            
                                                <tr>
                                                    <td><?php echo $rows['quantity']; ?></td>
                                                    <td><?php echo $rows['product_no']; ?></td>
                                                    <td><?php echo $skuData['sku_code']; ?></td>
                                                    <td><?php echo "demo"; ?></td>
                                                </tr>
                                            
                                            <?php } ?>
                                            
                                        </table>
                                    </div>
                                <?php } ?>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        
    <?php } ?>
    
  </div>
  
  <div class="control-sidebar-bg"></div>

</div>
