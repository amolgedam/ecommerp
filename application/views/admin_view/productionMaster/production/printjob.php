 <!--< ?php echo "<pre>"; print_r($info); exit(); ?> -->
 <?php 
    
    
    $ledgerData = $this->model_ledger->fecthDataByID($workerid);
    // echo "<pre>"; print_r($ledgerData); exit();
    
    $salesQty = $this->model_salesorder->fetchQtyDataByJobId($product['id']);
    $salesorder = $this->model_salesorder->fecthAllDatabyID($salesQty['salesorder_id']);
    
    
    $measurementData = $this->model_production->fecthAllMeasurementData($product['id']);
    $materialData = $this->model_production->fecthAllMaterialData($product['id']);
    
    $measurementQty = $this->model_production->fecthAllReadymadeMeasurementData($product['id']);
    
    $data = array(
                    'id' => $product['id'],
                    'type' => 'production'
                );
    
    $desc = $this->model_production->fecthDescription($data);
    
    // echo "<pre>"; print_r($desc); exit();
    
    $skuData = $this->model_sku->fecthSkuDataByID($product['sku']);
 
    // echo "<pre>"; print_r($skuData); exit();
    // echo "<pre>"; print_r($product);
    // echo "<pre>"; print_r($salesQty);
    // echo "<pre>"; print_r($salesorder);
    // echo "<pre>"; print_r($skuData);
    // echo "<pre>"; print_r($measurementData); exit();
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
                        <button class="btn btn-success">Print me</button>
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
                <div class="row" id="printData">
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
                                <div class="col-md-12">
                                    <table class="table" width="100%">
                                        <tr>
                                            <td><label>Name:- </label> <?php echo $info['ledger_name']; ?></td>
                                            <td><label>Jobsheet Number:- </label> <?php echo $product['jobsheet_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Contact Number:- </label> <?php echo $info['mobile']; ?></td>
                                            <td><label>Job Date:- </label> <?php echo $product['jobsheetdate']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Address:- </label> <?php echo $info['address_1']; ?></td>
                                            <td><label>Delivery Date:- </label> <?php echo $product['delivery_date']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Order Number:- </label> <?php echo $salesorder['order_no']; ?></td>
                                            <td><label>SKU:- </label> <?php echo $skuData['product_code']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Quantity:- </label> <?php echo $product['quantity']; ?></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>

                                <?php if(!empty($measurementData['kshoulder']) OR !empty($measurementData['kchest']) OR !empty($measurementData['kpants']) OR !empty($measurementData['khand']) OR !empty($measurementData['khip']) OR !empty($measurementData['klengtd']) OR !empty($measurementData['kthroat']) 
                                        OR !empty($measurementData['waist']) OR !empty($measurementData['seat']) OR !empty($measurementData['hanging']) OR !empty($measurementData['tdigh']) OR !empty($measurementData['lengtd']) OR !empty($measurementData['ktdroat']) 
                                        OR !empty($measurementData['sshoulder']) OR !empty($measurementData['schest']) OR !empty($measurementData['spants']) OR !empty($measurementData['shand']) OR !empty($measurementData['ship']) OR !empty($measurementData['slengtd']) OR !empty($measurementData['sthroat'])
                                ){  ?>
                                    <div class="col-md-12">
                                        <table class="table" width="100%">
                                            <tr>
                                                <th>
                                                    <label style="padding-left: 5px;">कोट</label>
                                                </th>
                                                <th>
                                                     <label style="padding-left: 5px;">पैंट</label>
                                                </th>
                                                <th>
                                                    <label style="padding-left: 5px;">शर्ट</label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label style="padding-left: 5px;">शोल्डर</label>

                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['kshoulder']; ?>
                                                </td>
                                                <td>
                                                     <label style="padding-left: 5px;">कमर</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['waist']; ?>

                                                </td>
                                                <td>
                                                    <label style="padding-left: 5px;">शोल्डर</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['sshoulder']; ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label style="padding-left: 5px;">चेस्ट</label>

                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['kchest']; ?>
                                                </td>
                                                <td>
                                                     <label style="padding-left: 5px;">सीट</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['seat']; ?>

                                                </td>
                                                <td>
                                                    <label style="padding-left: 5px;">चेस्ट</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['schest']; ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label style="padding-left: 5px;">पैंट</label>

                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['kpants']; ?>
                                                </td>
                                                <td>
                                                     <label style="padding-left: 5px;">लटक</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['hanging']; ?>

                                                </td>
                                                <td>
                                                    <label style="padding-left: 5px;">पैंट</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['spants']; ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label style="padding-left: 5px;">हाथ</label>

                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['khand']; ?>
                                                </td>
                                                <td>
                                                     <label style="padding-left: 5px;">जाँघ</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['thigh']; ?>

                                                </td>
                                                <td>
                                                    <label style="padding-left: 5px;">हाथ</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['shand']; ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label style="padding-left: 5px;">हिप</label>

                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['khip']; ?>
                                                </td>
                                                <td>
                                                     <label style="padding-left: 5px;">लंबाई</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['length']; ?>

                                                </td>
                                                <td>
                                                    <label style="padding-left: 5px;">हिप</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['ship']; ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label style="padding-left: 5px;">लंबाई</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['klength']; ?>
                                                </td>
                                                <td>
                                                     <label style="padding-left: 5px;">बॉटम</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['bottom']; ?>
                                                </td>
                                                <td>
                                                    <label style="padding-left: 5px;">लंबाई</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['slength']; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label style="padding-left: 5px;">गला</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['kthroat']; ?>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                                <td>
                                                    <label style="padding-left: 5px;">गला</label>
                                                    <?php echo  "&nbsp;&nbsp;".$measurementData['sthroat']; ?>
                                                </td>
                                            </tr>


                                        </table>
                                    </div>
                                <?php } ?>
                                
                                <?php if(!empty($materialData)){ ?>
                                    <br><br><br>
                                    <div class="col-md-12">
                                        <table class="table" width="100%">
                                            <tr>
                                                <th>Size</th>
                                                <th>Quantity</th>
                                            </tr>
                                            
                                            <?php foreach($measurementQty as $rows){ ?>
                                                
                                                <tr>
                                                    <th><?php echo $rows['size']; ?></th>
                                                    <th><?php echo $rows['quantity']; ?></th>
                                                </tr>
                                            
                                            <?php } ?>
                                        </table>
                                    </div>
                                <?php } ?>
                                
                                <?php if(!empty($materialData)){ ?>
                                    <br><br><br>
                                    <div class="col-md-12">
                                        <table class="table" width="100%">
                                            <tr>
                                                <th>Quantity</th>
                                                <th>Serial Number</th>
                                                <th>SKU</th>
                                                <th>Color</th>
                                            </tr>
                                            
                                            <?php foreach($materialData as $rows){ ?>
                                            
                                                <?php
                                                    $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($rows['product_no']);
                                                    $skuData = $this->model_sku->fecthSkuDataByID($barcodeData['sku_code']);
                                                    $attr = $this->model_attribute->fetchBarcodeAttributeData($barcodeData['attr_id']);

                                                    // echo "<pre>"; print_r($attr); 

                                                ?>
                                            
                                                <tr>
                                                    <td><?php echo $rows['quantity']; ?></td>
                                                    <td><?php echo $barcodeData['barcode']; ?></td>
                                                    <td><?php echo $skuData['product_code']; ?></td>
                                                    <td><?php echo $attr['color']; ?></td>
                                                </tr>
                                            
                                            <?php } ?>
                                            
                                        </table>
                                    </div>
                                <?php } ?>
                                
                                <br><br><br>
                                    <div class="col-md-12">
                                        Description:- <?php echo $desc['description']; ?>
                                        
                                    </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        
    <?php } ?>
    
  </div>
  
  <div class="control-sidebar-bg"></div>

</div>


<script type="text/javascript">
    
    function printData()
    {
       var divToPrint=document.getElementById("printData");
       newWin= window.open("");
       newWin.document.write(divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    }

    $('button').on('click',function(){
    printData();
    })

</script>

