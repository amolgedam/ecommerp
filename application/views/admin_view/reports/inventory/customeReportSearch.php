
  <style>
          .myBorder
        {
            border : 1px solid #000;
        }
        .topBorder
        {
            border-top : 1px solid #000;
        }
        .bottomBorder
        {
            border-bottom : 1px solid #000;
        }
        .leftBorder
        {
            border-left : 1px solid #000;
        }
        .rightBorder
        {
            border-right : 1px solid #000;
        }         
        
        .multiselect-container>li>a>label {
                
                padding: 4px 20px 3px 20px;
            }
  </style>
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory Custome Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory Custome Report</li>
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
            <form role="form" action="<?php echo base_url() ?>reports/customeReport" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        
                        <input type="hidden" name="customerreport" value="report">
                        
                        <div>
                            <label>Product Category</label>
                            <br>
                          
                            <select class="mymulselect form-control" name="pcat[]" multiple="multiple">
                                <?php foreach($productCat as $rows){ ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->catgory_name; ?></option>
                                <?php } ?>
                            </select>
                          <!--<select name="category" class="form-control" required>-->
                          <!--  <option value="0">---Select One---</option>-->
                          <!--</select>-->
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>Product Sub-Category</label>
                            <br>
                            <select class="mymulselect form-control" name="psubcat[]" multiple="multiple">
                                <?php foreach($productSubCat as $rows){ ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->subcategory_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>SKU</label>
                          <br>
                          <select class="mymulselect" name="sku[]" multiple="multiple">
                                <?php foreach($sku as $rows){ ?>
                                    <option value="<?php echo $rows['id']; ?>"><?php echo $rows['product_code']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Brand</label>
                          <br>
                          <select class="mymulselect form-control" name="brand[]" multiple="multiple">
                                <?php foreach($brand as $rows){ ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->brand_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>MRP From</label>
                          <input type="text" name="frommrp" name="mrpfrom" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>MRP To</label>
                          <input type="text" name="tomrp" name="mrpto" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Date From</label>
                          <input type="date" name="from" name="from" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Date To</label>
                          <input type="date" name="to" name="to" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>&nbsp;</label>
                          <br><br><br>
                        </div>
                    </div>
                    
                    <!--<div class="col-md-4 col-sm-4 col-xs-12">-->
                    <!--    <div>-->
                    <!--      <label>Location</label>-->
                    <!--      <select name="product" class="form-control" required>-->
                    <!--        <option>---Select One---</option>-->
                    <!--      </select>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <hr>
                    
                    
                    <?php
                        $color = explode(", ", $color['attr_values']);
                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Color</label>
                          <select name="color" class="form-control" required>
                            <option value="0">none</option>
                            <?php foreach($color as $rows){ ?>    
                                <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                    
                    <?php
                        $size = explode(", ", $size['attr_values']);
                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Size</label>
                          <select name="size" class="form-control" required>
                            <option value="0">none</option>
                            <?php foreach($size as $rows){ ?>    
                                <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                    
                    <?php
                        $pattern = explode(", ", $pattern['attr_values']);
                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Texture/Pattern</label>
                          <select name="pattern" class="form-control" required>
                            <option value="0">none</option>
                             <?php foreach($pattern as $rows){ ?>    
                                <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                    
                    <?php
                        $style1 = explode(", ", $style1['attr_values']);
                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Style 1</label>
                          <select name="style1" class="form-control" required>
                            <option value="0">none</option>
                             <?php foreach($style1 as $rows){ ?>    
                                <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                    
                    <?php
                        $style2 = explode(", ", $style2['attr_values']);
                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Style 2</label>
                          <select name="style2" class="form-control" required>
                            <option value="0">none</option>
                            <?php foreach($style2 as $rows){ ?>    
                                <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                    
                    <?php
                        $type = explode(", ", $type['attr_values']);
                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Type</label>
                          <select name="type" class="form-control" required>
                            <option value="0">none</option>
                            <?php foreach($type as $rows){ ?>    
                                <option value="<?php echo $rows; ?>"><?php echo $rows; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                    </div>
                  
                  <hr>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div>
                        <br>
                        <!--<a href="#" class=" btn btn-info">Search</a>-->
                        <input type="submit" name="search" value="Search" class="btn btn-success">
                        <!-- <input type="submit" name="print" value="Print" class="btn btn-info"> -->

                        <a href="javascript:void(0)" class="btn btn-info" id="printTable">Print</a>
                        <!-- <button class="btn btn-sm pull-right btn-default" >Print Item</button> -->
                    </div>
                  </div>
                              
              </div>
            </div>
          </div>

        </form>

         <!-- For Product Category Wise Search Start -->
        <?php
            if(!empty($pcatIds) && empty($psubcatIds) && empty($skuIds) && empty($BrandIds))
            {
              $pcatData = $pcatIds;
              $pcatCount = count($pcatData);
                          
              for($i = 0; $i < $pcatCount; $i++)
              {
                $pcategoryData = $this->model_category->fecthCatDataByID($pcatData[$i]);

                $skuDataNew = $this->model_sku->fecthSkuByCatID($pcategoryData['id']);
                  
                foreach($skuDataNew as $skurows){

                  if($frommrp == '' && $tomrp == '')
                  {
                      $data = array(
                                        'from' => $fromDate,
                                        'to' => $toDate,
                                        'sku' => $skurows->id,
                                    );
                      $inwardData = $this->model_barcode->inwardCustomerReport($data);

                      $outwardData = $this->model_barcode->outwardCustomerReport($data);
                  }
                  else
                  {
                      $data = array(
                                      'from' => $fromDate,
                                      'to' => $toDate,
                                      'sku' => $skurows->id
                                  );
                                  
                      $inwardData = $this->model_barcode->inwardCustomerReport1($data);
                      
                      $outwardData = $this->model_barcode->outwardCustomerReport1($data);
                  }

                  $inwardQty = $inwardData['qty'] != '' ? $inwardData['qty'] : "0";
                  $inwardAvgRate = $inwardData['pur_netprice'];
                  $inwardValue = $inwardQty * $inwardAvgRate;
                  $finwardValue = $finwardValue + $inwardValue;
                  $inwardMRP = $inwardData['mrp'];

                  $outwardQty = $outwardData['qty'] != '' ? $outwardData['balQty'] : "0";
                  $outwardAvgRate = $inwardData['pur_netprice'];
                  $outwardValue = $outwardQty * $outwardAvgRate;
                  $outwardMRP = $inwardData['mrp'];

                  $foutwardValue = $foutwardValue + $outwardValue;

                  $balQty = $inwardQty - $outwardQty;
                  $balAvgRate = $inwardAvgRate;
                  $balValue = $inwardValue + $outwardValue;
                  $balMrp = $inwardMRP;
                  
                  $fbalValue = $fbalValue + $balValue;
                }
              }
            }
        ?>
        <!-- For Product Category Wise Search End -->

        <div class="box">
          <div class="box-body">
            <div class="table-responsive">        
              <table border="1" width="100%" class="printMyTable">
                <tr>
                  <td>
                    <table border="1" width="100%">
                      <tr>
                        <th style="width: 210px;" rowspan="3">
                            <center>Particular</center>
                        </th>
                        <!--<th>-->
                        <!--    <center>Opening Balance</center>-->
                        <!--</th>-->
                        <th>
                            <center>InWards</center>
                        </th>
                        <th>
                            <center>OutWards</center>
                        </th>
                        <th>
                            <center>Closing Balance</center>
                        </th>
                      </tr>
                      <tr>
                        <td>
                            <center>Total Inwards : <?php echo number_format(abs($finwardValue), 3); ?></center>
                        </td>
                        <td>
                            <center>Total OutWards : <?php echo number_format(abs($foutwardValue - $balTotal), 3); ?></center>
                        </td>
                        <td>
                            <center>Total Balance : <?php echo number_format(abs($fbalValue), 3); ?></center>
                        </td>
                      </tr>
                      <tr>
                        <!--<td>-->
                        <!--    <table border="1" width="100%">-->
                        <!--        <tr>-->
                        <!--            <td style="width: 33%;">-->
                        <!--                <center>Quantity</center>-->
                        <!--            </td>-->
                        <!--            <td  style="width: 33%;">-->
                        <!--                <center>Average Rate</center>-->
                        <!--            </td>-->
                        <!--            <td  style="width: 33%;">-->
                        <!--                <center>Value</center>-->
                        <!--            </td>-->
                        <!--        </tr>-->
                        <!--    </table>-->
                        <!--</td>-->
                        <td>
                            <table border="1" width="100%">
                                <tr>
                                    <td style="width: 20%;">
                                        <center>Quantity</center>
                                    </td>
                                    <td  style="width: 20%;">
                                        <center>Average Rate</center>
                                    </td>
                                    <td  style="width: 20%;">
                                        <center>Value</center>
                                    </td>
                                    <td  style="width: 20%;">
                                        <center>MRP</center>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table border="1" width="100%">
                                <tr>
                                    <td style="width: 20%;">
                                        <center>Quantity</center>
                                    </td>
                                    <td  style="width: 20%;">
                                        <center>Average Rate</center>
                                    </td>
                                    <td  style="width: 20%;">
                                        <center>Value</center>
                                    </td>
                                    <td  style="width: 20%;">
                                        <center>MRP</center>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table border="1" width="100%">
                                <tr>
                                    <td style="width: 20%;">
                                        <center>Quantity</center>
                                    </td>
                                    <td  style="width: 20%;">
                                        <center>Average Rate</center>
                                    </td>
                                    <td  style="width: 20%;">
                                        <center>Value</center>
                                    </td>
                                    <td  style="width: 20%;">
                                        <center>MRP</center>
                                    </td>
                                </tr>
                            </table>
                        </td>

              <!-- ################################################################### -->

                <!-- for Product Category Start -->
                <?php
                    if(!empty($pcatIds) && empty($psubcatIds) && empty($skuIds) && empty($BrandIds))
                    {
                        $pcatCount = count($pcatData);

                        for($i = 0; $i < $pcatCount; $i++)
                        {
                            $pcategoryData = $this->model_category->fecthCatDataByID($pcatData[$i]);
                ?>
                            <tr style="width: 210px;">
                              <td>
                                  <h4><b><u><center><?php echo $pcategoryData['catgory_name']; ?></center></u></b></h4>
                              </td>
                              <td colspan="8">&nbsp;</td>
                            </tr>

                       <?php
                            $subcat = $this->model_category->fecthSubCatByCatID1($pcategoryData['id']);

                            foreach ($subcat as $key => $valueSubcat)
                            {
                        ?>   
                              <tr>
                                  <td>
                                    <h5><b><center><?php echo $valueSubcat['subcategory_name']; ?></center></b></h5>
                                  </td>
                                  <td colspan="8">&nbsp;</td>
                              </tr>
                              
                              <?php

                                  $skuDataNew = $this->model_sku->fecthSkuByCatID($pcategoryData['id']);

                                  foreach($skuDataNew as $skurows){

                                      if($frommrp == '' && $tomrp == '')
                                      {
                                          $data = array(
                                                      'from' => $fromDate,
                                                      'to' => $toDate,
                                                      'sku' => $skurows->id
                                                  );
                                          
                                          $inwardData = $this->model_barcode->inwardCustomerReport($data);
                                          
                                          $outwardData = $this->model_barcode->outwardCustomerReport($data);
                                      }
                                      else
                                      {
                                          $data = array(
                                                      'from' => $fromDate,
                                                      'to' => $toDate,
                                                      'sku' => $skurows->id
                                                  );
                                                  
                                          $inwardData = $this->model_barcode->inwardCustomerReport1($data);
                                          
                                          $outwardData = $this->model_barcode->outwardCustomerReport1($data);
                                      }


                                      $inwardQty = $inwardData['qty'] != '' ? $inwardData['qty'] : "0";
                                      $inwardAvgRate = $inwardData['pur_netprice'];
                                      $inwardValue = $inwardQty * $inwardAvgRate;
                                      $inwardMRP = $inwardData['mrp'];
                                      
                                      $inwardQtyTot = $inwardQtyTot + $inwardQty;
                                      $inwardAvgTot = $inwardAvgTot + $inwardAvgRate;
                                      $inwardValueTot = $inwardValueTot + $inwardValue;
                                      $inwardMrpTot = $inwardMrpTot + $inwardMRP;
                                      
                                      // ###########################################
                                      // ##             Outward Data              ##
                                      // ###########################################
                                      $outwardQty = $outwardData['qty'] != '' ? $outwardData['qty'] : "0";
                                      $outwardAvgRate = $inwardData['pur_netprice'];
                                      $outwardValue = $outwardQty * $outwardAvgRate;
                                      $outwardMRP = $inwardData['mrp'];
                                      
                                      $outwardQtyTot = $outwardQtyTot + $outwardQty;
                                      $outwardAvgTot = $outwardAvgTot + $outwardAvgRate;
                                      $outwardValueTot = $outwardValueTot + $outwardValue;
                                      $outwardMrpTot = $outwardMrpTot + $outwardMRP;
                                      
                                      // ###########################################
                                      // ##             Closing Data              ##
                                      // ###########################################
                                      $balQty = $inwardQty - $outwardQty;
                                      $balAvgRate = $inwardAvgRate;
                                      $balValue = $inwardValue + $outwardValue;
                                      $balMrp = $inwardMRP;
                                      
                                      $balQtyTot = $balQtyTot + $balQty;
                                      $balAvgTot = $balAvgTot + $balAvgRate;
                                      $balValueTot = $balValueTot + $balValue;
                                      $balMrpTot = $balMrpTot + $balMrp;

                                      $unit = $this->model_unit->fecthUnitDataByID($inwardData['unit_id']);

                                      // echo "<pre>"; print_r($unit);

                                  if($inwardData['sku_code'] != '')
                                  {
                              ?>
                                      <tr>
                                          <td>
                                              <?php 
                                                $skuData = $this->model_sku->fecthSkuDataByID($inwardData['sku_code']);
                                              ?>
                                              <center><?php echo $skuData['product_code']; ?></center>
                                          </td>
                                          <td>
                                              <table border="1" width="100%">
                                                  <tr>
                                                      <td style="width: 25%;">
                                                          <center><?php echo number_format(abs($inwardQty))." - ".$unit['unit']; ?></center>
                                                      </td>
                                                      <td style="width: 2%%;">
                                                          <center><?php echo number_format(abs($inwardAvgRate), 3);?></center>
                                                      </td>
                                                      <td style="width: 25%;">
                                                          <center><?php echo number_format(abs($inwardQty * $inwardAvgRate), 3);?></center>
                                                      </td>
                                                      <td style="width: 25%;">
                                                          <center><?php echo number_format(abs($inwardMRP), 3);?></center>
                                                      </td>
                                                  </tr>
                                              </table>
                                          </td>
                                          <td>
                                              <table border="1" width="100%">
                                                  <tr>
                                                      <td style="width: 25%;">
                                                          <center><?php echo number_format(abs($outwardQty))." - ".$unit['unit']; ?></center>
                                                      </td>
                                                      <td style="width: 25%;">
                                                          <center><?php echo number_format(abs($outwardAvgRate), 3);?></center>
                                                      </td>
                                                      <td style="width: 25%;">
                                                          <center><?php echo number_format(abs($outwardQty * $outwardAvgRate), 3);?></center>
                                                      </td>
                                                      <td style="width: 25%;">
                                                          <center><?php echo number_format(abs($outwardMRP), 3);?></center>
                                                      </td>
                                                  </tr>
                                              </table>
                                          </td>
                                          <td>
                                              <table border="1" width="100%">
                                                  <tr>
                                                    <td style="width: 25%;">
                                                        <center><?php echo number_format(abs($balQty))." - ".$unit['unit']; ?></center>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <center><?php echo number_format(abs($balAvgRate), 3);?></center>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <center><?php echo number_format(abs($balValue), 3);?></center>
                                                    </td>
                                                    <td style="width: 25%;">
                                                        <center><?php echo number_format(abs($balMrp), 3);?></center>
                                                    </td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>
                <?php
                                  }
                                }
                ?>

                                      <tr>
                                                    <td>
                                                        <center><b>Total</b></center>
                                                    </td>
                                                    <td>
                                                        <table border="1" width="100%">
                                                            <tr>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo abs($inwardQtyTot); ?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo abs($inwardAvgTot);?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo abs($inwardValueTot);?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo abs($inwardMrpTot);?></center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table border="1" width="100%">
                                                            <tr>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo abs($outwardQtyTot); ?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo abs($outwardAvgTot);?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo abs($outwardValueTot);?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo abs($outwardMrpTot);?></center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table border="1" width="100%">
                                                            <tr>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo number_format(abs($balQtyTot)); ?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo number_format(abs($balAvgTot), 3);?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo number_format(abs($balValueTot), 3);?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo number_format(abs($balMrpTot), 3);?></center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                            </tr>
                <?php
                            }
                        }
                    }
                ?>
              <!-- Product Category end -->
              <!-- ################################################################### -->







              <!-- ################################################################### -->
                <!-- for Brand Start -->
                  <?php
                    if(empty($pcat) && empty($psubcat) && empty($sku) && !empty($brand))
                    {

                        echo "HI Demo".$pcatCount = count($brandCatData);
                            
                        for($i = 0; $i < $pcatCount; $i++)
                        {
                          $pcategoryData = $this->model_category->fecthCatDataByID($brandCatData[$i]);

                  ?>
                          <tr style="width: 210px;">
                              <td>
                                  <h4><b><u><center><?php echo $pcategoryData['catgory_name']; ?></center></u></b></h4>
                              </td>
                              <td colspan="8">&nbsp;</td>
                          </tr> 


                  <?php
                        }
                    }
                  ?>

                <!-- for Brand End -->
              <!-- ################################################################### -->






























                          <table border="1" width="100%">
                            <tr>
                                <td>
                                    <center>Sr No</center>
                                </td>
                                <td>
                                    <center>Serial Number</center>
                                </td>
                                <td>
                                    <center>Color</center>
                                </td>
                                <td>
                                    <center>Size</center>
                                </td>
                                <td>
                                    <center>Texture/Pattern</center>
                                </td>
                                <td>
                                    <center>Style 1</center>
                                </td>
                                <td>
                                    <center>Style 2</center>
                                </td>
                                <td>
                                    <center>Brand</center>
                                </td>
                                <td>
                                    <center>Quantity</center>
                                </td>
                                <td>
                                    <center>MRP</center>
                                </td>
                                <td>
                                    <center>InWards</center>
                                </td>
                                <td>
                                    <center>OutWards</center>
                                </td>
                                <td>
                                    <center>Action</center>
                                </td>
                            </tr>
                        
                        <!-- ################################################################### -->
                          <!-- for Product Category Start -->
                          <?php
                            if(!empty($pcatIds) && empty($psubcatIds) && empty($skuIds) && empty($BrandIds))
                            {
                                $pcatCount = count($pcatData);
                                $no=1;

                                for($i = 0; $i < $pcatCount; $i++)
                                {
                                    $pcategoryData = $this->model_category->fecthCatDataByID($pcatData[$i]);

                                    $skuDataNew = $this->model_sku->fecthSkuByCatID($pcategoryData['id']);

                                    foreach($skuDataNew as $skurows)
                                    {

                                        if($frommrp == '' && $tomrp == '')
                                        {
                                            $data = array(
                                                        'from' => $from,
                                                        'to' => $to,
                                                        'sku' => $skurows->id
                                                    );
                                            
                                            $attrData = $this->model_barcode->getAttrData($data);
                                        }
                                        else
                                        {
                                            $data = array(
                                                        'from' => $from,
                                                        'to' => $to,
                                                        'sku' => $skurows->id
                                                    );
                                            
                                            $attrData = $this->model_barcode->getAttrData1($data);
                                        }

                                        $link = '';
                                        if($attrData != ''){
                                            
                                          foreach ($attrData as $key => $value) {

                                            if($value['purchase_type'] == 'pinvoice')
                                            {
                                                $pinvoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($value['purchase_id']);
                                                
                                                $link = '<a href="'.base_url().'purchase_invoiceitem/update/'.$value['product_id'].'/'.$value['purchase_id'].'"  >'.$pinvoiceData['invoice_no'].'</a>';
                                            }
                                            else
                                            {
                                                $opData = $this->model_openingstock->fecthAllDataByID($value['purchase_id']);
                                                
                                                $link = '<a href="'.base_url().'opening_stockitem/update/'.$value['product_id'].'/'.$value['purchase_id'].'" >'.$opData['opening_no'].'</a>';   
                                            }
                          ?>

                                              <tr>
                                                  <td>&nbsp;&nbsp;<?php echo $no; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['barcode']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['acolor']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['asize']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['apattern']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['astyle1']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['astyle2']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['atype']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['quantity']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['mrp']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $link; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['item_status']; ?></td>
                                                  <td>&nbsp;&nbsp;<?php echo $value['item_status']; ?></td>
                                                  
                                              </tr>


                        <?php   
                                            $no++;
                                          }
                                        }
                                    }
                                }
                            } 
                        ?>
                          <!-- for Product Category End -->
                        <!-- ################################################################### -->



                        </table>
                    </tr>
                    </table>
                  </td>
                </tr>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" rel="stylesheet"/>

<script>
    $(function() {
        $('.mymulselect').multiselect({
        
            includeSelectAllOption: true
        });
    });
</script>


<script type="text/javascript">
  $(document).ready(function(){

      $('#printTable').on('click', function(){

           var pageTitle = 'Custome Report',
            stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
            win = window.open('', 'Print', 'width=1000,height=500');
            win.document.write('<html><head><title>' + pageTitle + '</title>' +
                '<link rel="stylesheet" href="' + stylesheet + '">' +
                '</head><body>' + $('.printMyTable')[0].outerHTML + '</body></html>');
            win.document.close();
            win.print();
            win.close();
            return false;
      });
  });
</script>

