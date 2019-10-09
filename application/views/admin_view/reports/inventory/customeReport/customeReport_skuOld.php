
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

        <!-- For Product Category Wise Search End -->

        <div class="box">
          <div class="box-body">
            <div class="table-responsive">        
              <table border="1" width="100%" class="printMyTable">
                <tr>
                  <td>
                    <table border="1" width="100%">
                      <tr>
                        <th style="width: 190px;" rowspan="3">
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
                            <center>Total Inwards : <span id="totInwards"></span></center>
                        </td>
                        <td>
                            <center>Total OutWards : <span id="totOutwards"></span></center>
                        </td>
                        <td>
                            <center>Closing Balance : <span id="totCl"></span></center>
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
              <?php

                  $countSku = count($skuIds);

                  for ($i=0; $i < $countSku; $i++) { 

                    $skuData = $this->model_sku->fecthSkuDataByID($skuIds[$i]);

                    $catData = $this->model_category->fecthCatDataByID($skuData['category_id']);
                    $subcatData = $this->model_category->fecthCatDataByID($skuData['subcategory_id']);

                    $fqty = $frate = $fvalue = $foqty = $forate = $fovalue = $fclvalue = 0;

                    $qty = $rate = $mrp = $outQty = $clQty = 0;

                    // inwards Data
                    $data = $this->model_globalsearch->fetchPurchaseInvoiceGroupByIDCR($skuData['id']);

                    if(!empty($data))
                    {
                        $qty = $data['quantity'];
                        $rate = $data['base_price'];
                        $mrp = $data['mrp_price'];
                    }
                    else if(empty($data))
                    {
                      $data = $this->model_globalsearch->fetchOStockGroupByIDCR($skuData['id']);

                      $qty = $data['quality'];
                      $rate = $data['base_price'];
                      $mrp = $data['mrp'];
                    }
                    else if(empty($data))
                    {
                      $data = $this->model_globalsearch->fetchExcessesGroupByIDCR($skuData['id']);

                      $qty = $data['quality'];
                      $rate = $data['base_price'];
                      $mrp = $data['mrp'];
                    }
                    else if(empty($data))
                    {
                      $data = $this->model_globalsearch->fetchSExchangeGroupByIDCR($skuData['id']);

                      $qty = $data['quantity'];
                      $rate = "-";
                      $mrp = "-";
                    }

                    $barcodeData1 = $this->model_globalsearch->fetchDataBySkuCode1($skuData['id']);

                    // echo "<pre>"; print_r($barcodeData1);
                    if(!empty($barcodeData1))
                    {
                        $newBal = $barcodeData1['sumQty'] - $barcodeData1['sumbalQty'];

                        if($newBal == 0)
                        {
                          $outQty = $barcodeData1['sumQty'];
                        }
                        else
                        {
                          $outQty = $barcodeData1['balQty'];
                        }  
                    }  

                    // echo "<br>".$outQty;
                    $ivalue = $qty * $rate;

                    $ovalue = $outQty * $rate;

                    $clQty = $qty - abs($outQty);

                    $fqty = $fqty + $qty;
                    $frate = $frate + $rate;
                    $fvalue = $fvalue + $ivalue;

                    $foqty = $foqty + $outQty;
                    $forate = $forate + $rate;
                    $fovalue = $fovalue + $ovalue;

                    $fclvalue = $fclvalue + $clQty;

                    $unitData = $this->model_unit->fecthUnitDataByID($barcodeData1['unit_id']);
              ?>
                    <tr style="width: 210px;">
                      <td>
                        <h4><b><u><center><?php echo $catData['catgory_name']; ?></center></u></b></h4>
                      </td>
                      <td colspan="8">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>
                        <h5><b><center><?php echo $subcatData['catgory_name']; ?></center></b></h5>
                      </td>
                      <td colspan="8">&nbsp;</td>
                    </tr>

                    <tr>
                        <td>
                            <center><?php echo $skuData['product_code']; ?></center>
                        </td>
                        <td>
                            <table border="1" width="100%">
                                <tr>
                                    <td style="width: 25%;">
                                        <center><?php echo abs($qty)." - <br>".$unitData['unit']; ?></center>
                                    </td>
                                    <td style="width: 2%%;">
                                        <center><?php echo number_format(abs($rate), 2);?></center>
                                    </td>
                                    <td style="width: 25%;">
                                        <center><?php echo number_format(abs($ivalue),2);?></center>
                                    </td>
                                    <td style="width: 25%;">
                                        <center><?php echo number_format(abs($mrp), 2);?></center>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table border="1" width="100%">
                                <tr>
                                    <td style="width: 25%;">
                                        <center><?php echo abs($outQty)." - <br>".$unitData['unit']; ?></center>
                                    </td>
                                    <td style="width: 25%;">
                                        <center><?php echo number_format(abs($rate), 2);?></center>
                                    </td>
                                    <td style="width: 25%;">
                                        <center><?php echo number_format(abs($ovalue), 2);?></center>
                                    </td>
                                    <td style="width: 25%;">
                                        <center><?php echo number_format(abs($mrp), 2);?></center>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table border="1" width="100%">
                                <tr>
                                  <td style="width: 25%;">
                                      <center><?php echo abs($clQty)." - <br>".$unitData['unit']; ?></center>
                                  </td>
                                  <td style="width: 25%;">
                                      <center><?php echo number_format(abs($rate), 2);?></center>
                                  </td>
                                  <td style="width: 25%;">
                                      <center><?php echo number_format(abs($clQty * $rate), 2);?></center>
                                  </td>
                                  <td style="width: 25%;">
                                      <center><?php echo number_format(abs($mrp), 2);?></center>
                                  </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                            <td>
                                <center><b>Total</b></center>
                            </td>
                            <td>
                                <table border="1" width="100%">
                                    <tr>
                                        <td style="width: 20%;">
                                            <center><b><?php echo $fqty;?></b></center>
                                        </td>
                                        <td style="width: 20%;">
                                            <center><b><?php echo $frate;?></b></center>
                                        </td>
                                        <td style="width: 20%;">
                                            <center><b>
                                              <span><?php echo number_format($fqty * $frate , 2);?></span></b></center>
                                        </td>
                                        <td style="width: 20%;">
                                            <center><b><?php echo "";?></b></center>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table border="1" width="100%">
                                    <tr>
                                        <td style="width: 20%;">
                                            <center><b><?php echo abs($foqty); ?></b></center>
                                        </td>
                                        <td style="width: 20%;">
                                            <center><b><?php echo $forate;?></b></center>
                                        </td>
                                        <td style="width: 20%;">
                                            <center><b><span class="outwardsValue"><?php echo number_format(abs($foqty * $forate), 2); ?></span></b></center>
                                        </td>
                                        <td style="width: 20%;">
                                            <center><b><?php echo "";?></b></center>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table border="1" width="100%">
                                    <tr>
                                        <td style="width: 20%;">
                                            <center><b><?php echo abs($fclvalue); ?></b></center>
                                        </td>
                                        <td style="width: 20%;">
                                            <center><b><?php echo abs($frate);?></b></center>
                                        </td>
                                        <td style="width: 20%;">
                                            <center><b><span class="clValue"><?php echo abs($fclvalue * $frate);?></span></b></center>
                                        </td>
                                        <td style="width: 20%;">
                                            <center><b><?php echo "";?></b></center>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                    </tr>

                    <?php 

                        $finalInwards = $finalInwards + $fqty * $frate;
                        $finalOutwards = $finalOutwards + $foqty * $forate;
                        $finalCl = $finalCl + $fclvalue * $frate;

                    ?>


              <?php

                  }
              ?>

                    <input type="hidden" name="inward" id="inwardsTot" value="<?php echo abs($finalInwards); ?>">
                <input type="hidden" name="outward" id="outTot" value="<?php echo abs($finalOutwards); ?>">
                <input type="hidden" name="cl" id="clTot" value="<?php echo abs($finalCl); ?>">


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
                            <center>Type</center>
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

                    <?php

                        $no=1;

                        $countSku = count($skuIds);

                        for ($i=0; $i < $countSku; $i++) { 

                          $skuData = $this->model_sku->fecthSkuDataByID($skuIds[$i]);

                            $barcodeData = $this->model_barcode->fetchDataBySkuCode($skuData['id']);

                            // echo "<pre>"; print_r($barcodeData);
                            foreach ($barcodeData as $key => $valueBarcode){

                              $link = $url = "-";

                              $brand = $this->model_brand->fetchDataByID($valueBarcode['brand_id']);
                              $attrData = $this->model_attribute->fetchBarcodeAttributeData($valueBarcode['attr_id']);

                              if($valueBarcode['purchase_type'] == 'pinvoice')
                              {
                                  $invoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($valueBarcode['purchase_id']);
                                
                                 $link = "<a href='".base_url()."purchase_invoice/update/".$invoiceData['id']."' target='_blank'>".$invoiceData['invoice_no']." </a>";
                              }
                              else if($valueBarcode['purchase_type'] == 'popeningstock')
                              {
                                  $invoiceData = $this->model_openingstock->fecthAllDataByID($valueBarcode['purchase_id']);

                                  $link = "<a href='".base_url()."opening_stock/update/".$invoiceData['id']."' target='_blank'>".$invoiceData['opening_no']." </a>"; 
                              }
                              else if($valueBarcode['purchase_type'] == 'production')
                              {
                                  $invoiceData = $this->model_production->fecthAllDatabyID($valueBarcode['purchase_id']);

                                  $link = "<a href='".base_url()."alternate/update/".$invoiceData['id']."' target='_blank'>".$invoiceData['jobsheet_no']." </a>"; 
                              }

                              $salesData = $this->model_barcode->outWardsDataByBarcode($valueBarcode['id']);

                              // echo "<pre>"; print_r($salesData);

                              if(!empty($salesData))
                              {
                                if($salesData1['salesexchange'])
                                {
                                  $invoiceData = $this->model_salesexchange->fecthAllDataByID($value['inventory_id']);
                                  $url = "<a href='".base_url()."sales_exchange/update/".$invoiceData['id']."' target='_blank'>".$invoiceData['inventory_no']." </a>";
                                }
                                else
                                {

                                  $invoiceData = $this->model_salesinvoice->fecthAllDataByID($salesData['inventory_id']);
                                  $url = "<a href='".base_url()."sales_invoice/update/".$invoiceData['id']."' target='_blank'>".$invoiceData['inventory_no']." </a>";
                                }
                              }
                              if(empty($salesData))
                              {
                                  $salesData1 = $this->model_barcode->outWardsDataByBarcode1($valueBarcode['id']);

                                  if($salesData1['inventory_type'] == 'wsp')
                                  {
                                    $invoiceData = $this->model_salesinvoice->fecthAllDataByID($salesData1['inventory_id']);

                                    $url = "<a href='".base_url()."wsp/update/".$invoiceData['id']."' target='_blank'>".$invoiceData['inventory_no']." </a>";

                                  }
                                  else if($salesData1['inventory_type'] == 'preturn')
                                  {
                                      $invoiceData = $this->model_purchasereturn->fecthAllDatabyID($salesData1['inventory_id']);

                                      $url = "<a href='".base_url()."purchase_return/update/".$invoiceData['id']."' target='_blank'>".$invoiceData['inventory_no']." </a>";
                                  }
                                  else if($salesData1['inventory_type'] == 'inventoty_consumption')
                                  {
                                      $invoiceData = $this->model_internalconsumption->fecthDataByID($salesData1['inventory_id']);

                                      $url = "<a href='".base_url()."internal_consumption/update/".$invoiceData['id']."' target='_blank'>".$invoiceData['inventory_no']." </a>";
                                  }
                                  else if($value['inventory_type'] == 'inventoty_shortage')
                                  {
                                      $invoiceData = $this->model_shortage->fecthAllDataByID($value['inventory_id']);

                                      $url = "<a href='".base_url()."shortage/update/".$invoiceData['id']."' target='_blank'>".$invoiceData['inventory_no']." </a>";
                                  }
                                  else if($value['production_type'] == 'production')
                                  {
                                      // echo $value['production_id'];
                                      $productData = $this->model_production->fecthAllDatabyID($value['production_id']);

                                      $url = "<a href='".base_url()."production/update/".$productData['id']."' target='_blank'>".$productData['jobsheet_no']." </a>";
                                  }
                              }

                    ?>

                        <tr>
                          <td>&nbsp;&nbsp;<?php echo $no; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $valueBarcode['barcode']."&nbsp"; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $attrData['color']; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $attrData['size']; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $attrData['pattern']; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $attrData['style1']; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $attrData['style2']; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $attrData['type']; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $brand['brand_name']; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $valueBarcode['balQty']; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $valueBarcode['mrp']; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $link; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $url; ?></td>
                          <td>&nbsp;&nbsp;<?php echo $valueBarcode['item_status']; ?></td>
                          
                      </tr>


                    <?php

                          $no++;
                          }
                        }
                    ?>

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

      lcount();

      function lcount() {
          
          var inwards = outwards = cl = 0;

          $('#inwardsTot').each(function() {

              inwards += parseFloat($(this).val());
          });
          inwards = (inwards).toFixed(2);
          $('#totInwards').text(inwards);

          $('#outTot').each(function() {

              outwards += parseFloat($(this).val());
          });
          outwards = (outwards).toFixed(2);
          $('#totOutwards').text(outwards);

          $('#clTot').each(function() {

              cl += parseFloat($(this).val());
          });
          cl = (cl).toFixed(2);
          $('#totCl').text(cl);

          console.log(inwards);
          console.log(outwards);
          console.log(cl);
      }
  });
</script>

