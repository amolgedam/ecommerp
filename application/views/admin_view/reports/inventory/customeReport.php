
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
    <section class="content" style="min-height: 10000px; max-height: 20000px">
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
                            <label>Product Category1</label>
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
        
        <?php 
            
            $finwardValue = $foutwardValue = $fbalValue = 0;
            
            if(isset($report)){ 
        ?>
        
                <?php
                                
                    $skuData = '';
                    $pcatData = $psubcatData = array();
                    
                    if(!empty($skuIds))
                    {
                        // echo "<pre>"; print_r($skuIds);
                        // exit;
                        $skuCount = count($skuIds);
                    
                        // $skuIdArray = explode(""); 
                        
                        for($i = 0; $i < $skuCount; $i++)
                        {
                            // echo "<pre>"; print_r($skuIds[$i]);
                            $skuData = $this->model_sku->fecthSkuDataByID($skuIds[$i]);
                            
                            $skuArray[] = $skuData;
                            
                            // echo "<pre>"; print_r($skuData);
                            $pcatData[] = $this->model_category->fecthCatDataByID($skuData['category_id']);
                            $psubcatData[] = $this->model_category->fecthSubCatDataByID($skuData['subcategory_id']);
                            
                            $uniquePCat = array_unique($pcatData, SORT_REGULAR);
                            
                            foreach($skuArray as $skurows){
                                
                                if($frommrp == '' && $tomrp == '')
                                {
                                    $data = array(
                                                'from' => $from,
                                                'to' => $to,
                                                // 'frommrp' => $frommrp,
                                                // 'tomrp' => $tomrp,
                                                'sku' => $skurows['id'],
                                                'attrcolor' => $attrcolor,
                                                'attrsize' => $attrsize,
                                                'attrpattern' => $attrpattern,
                                                'attrstyle1' => $attrstyle1,
                                                'attrstyle2' => $attrstyle2,
                                                'attrtype' => $attrtype
                                            );
                                    
                                    $inwardData = $this->model_barcode->fetchInwardItemQtyBySkuCustomerReport($data);
                                    $outwardData = $this->model_barcode->fetchOutwardItemQtyBySkuCustomerReport($data);
                                }
                                else
                                {
                                    $data = array(
                                                'from' => $from,
                                                'to' => $to,
                                                'frommrp' => $frommrp,
                                                'tomrp' => $tomrp,
                                                'sku' => $skurows['id'],
                                                'attrcolor' => $attrcolor,
                                                'attrsize' => $attrsize,
                                                'attrpattern' => $attrpattern,
                                                'attrstyle1' => $attrstyle1,
                                                'attrstyle2' => $attrstyle2,
                                                'attrtype' => $attrtype
                                            );
                                            
                                    $inwardData = $this->model_barcode->fetchInwardItemQtyBySkuCustomerReport1($data);
                                    $outwardData = $this->model_barcode->fetchOutwardItemQtyBySkuCustomerReport1($data);
                                }
                                
                                $inwardQty = $inwardData['qty'] != '' ? $inwardData['qty'] : "0";
                                $inwardAvgRate = $inwardData['pur_netprice'];
                                $inwardValue = $inwardQty * $inwardAvgRate;
                                $finwardValue = $finwardValue + $inwardValue;
                                
                                
                                $outwardQty = $outwardData['qty'] != '' ? $outwardData['qty'] : "0";
                                $outwardAvgRate = $inwardData['pur_netprice'];
                                $outwardValue = $outwardQty * $outwardAvgRate;
                                $foutwardValue = $foutwardValue + $outwardValue;
                                
                                
                                $balQty = $inwardQty - $outwardQty;
                                $balAvgRate = $inwardAvgRate;
                                $balValue = $inwardValue + $outwardValue;
                                $fbalValue = $fbalValue + $balValue;
                            }
                        }
                        
                        // code for attrubute wise data
                        // with product cat
                        
                        // echo "<pre>"; print_r($pcatData);
                        // echo "<pre>"; print_r($psubcatData);
                    }
                    else if(!empty($pcatIds))
                    {
                        $pcatData = $pcatIds;
                        
                        
                        
                        if(!empty($pcatData) and empty($skuData))
                        {
                            $pcatCount = count($pcatData);
            
                            for($i = 0; $i < $pcatCount; $i++)
                            {
                                $pcategoryData = $this->model_category->fecthCatDataByID($pcatData[$i]);
                                
                                $skuDataNew = $this->model_sku->fecthSkuByCatID($pcategoryData['id']);
                                
                                $qtytot = $mrptot = $valuetot = $outqtytot = $outmrptot = $outvaluetot = $balqtytot = $balmrptot = $balvaluetot = 0; 
                                
                                $inwardData = '';
                                $inwardQtyTot = $inwardAvgTot = $inwardValueTot = $inwardMrpTot = $outwardQtyTot = $outwardAvgTot = $outwardValueTot = $outwardMrpTot = $balQtyTot = $balAvgTot = $balValueTot = $balMrpTot = 0;
                                
                                foreach($skuDataNew as $skurows){
                        
                                    if($frommrp == '' && $tomrp == '')
                                    {
                                        $data = array(
                                                    'from' => $from,
                                                    'to' => $to,
                                                    // 'frommrp' => $frommrp,
                                                    // 'tomrp' => $tomrp,
                                                    'sku' => $skurows->id,
                                                    'attrcolor' => $attrcolor,
                                                    'attrsize' => $attrsize,
                                                    'attrpattern' => $attrpattern,
                                                    'attrstyle1' => $attrstyle1,
                                                    'attrstyle2' => $attrstyle2,
                                                    'attrtype' => $attrtype
                                                );
                                        
                                        $inwardData = $this->model_barcode->fetchInwardItemQtyBySkuCustomerReport($data);
                                        // $attrData = $this->model_barcode->fetchInwardAttrDataBySkuCustomerReport($data);
                                        
                                        $outwardData = $this->model_barcode->fetchOutwardItemQtyBySkuCustomerReport($data);
                                    }
                                    else
                                    {
                                        $data = array(
                                                    'from' => $from,
                                                    'to' => $to,
                                                    'frommrp' => $frommrp,
                                                    'tomrp' => $tomrp,
                                                    'sku' => $skurows->id,
                                                    'attrcolor' => $attrcolor,
                                                    'attrsize' => $attrsize,
                                                    'attrpattern' => $attrpattern,
                                                    'attrstyle1' => $attrstyle1,
                                                    'attrstyle2' => $attrstyle2,
                                                    'attrtype' => $attrtype
                                                );
                                                
                                        $inwardData = $this->model_barcode->fetchInwardItemQtyBySkuCustomerReport1($data);
                                        // $attrData = $this->model_barcode->fetchInwardAttrDataBySkuCustomerReport1($data);
                                        
                                        $outwardData = $this->model_barcode->fetchOutwardItemQtyBySkuCustomerReport1($data);
                                    }
                                    
                                    
                                    $inwardQty = $inwardData['qty'] != '' ? $inwardData['qty'] : "0";
                                    $inwardAvgRate = $inwardData['pur_netprice'];
                                    $inwardValue = $inwardQty * $inwardAvgRate;
                                    $finwardValue = $finwardValue + $inwardValue;
                                    $inwardMRP = $inwardData['mrp'];
                                
                                    
                                    $outwardQty = $outwardData['qty'] != '' ? $outwardData['qty'] : "0";
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
                    }
                    // else
                    // {
                    //     echo "All Data Selected";
                    // }
                    
                    // exit;
                ?>
                
        
        
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
                                        <!--<td>-->
                                        <!--    <center>Total Opening : 5999757.14</center>-->
                                        <!--</td>-->
                                        <td>
                                            <center>Total Inwards : <?php echo $finwardValue; ?></center>
                                        </td>
                                        <td>
                                            <center>Total OutWards : <?php echo $foutwardValue; ?></center>
                                        </td>
                                        <td>
                                            <center>Total Balance : <?php echo $fbalValue; ?></center>
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
                                    </tr>
                                    
                                    <!--
                                    
                                    // ###################################################################################
                                    // ##                            show SKU WISE DATA                                 ##
                                    // ###################################################################################
                                    
                                    -->
                                    
                                    
                                    <?php
                                        if(!empty($skuData))
                                        {
                                            // echo "<pre>"; print_r($pcatData);
                                            $uniquePCat = array_unique($pcatData, SORT_REGULAR);
                                            
                                            // echo "<pre>"; print_r($uniquePCat);
                                            
                                            
                                            foreach($uniquePCat as $rows)
                                            {
                                                $pcategoryData = $this->model_category->fecthCatDataByID($rows['id']);
                                    ?>
                                                <tr style="width: 210px;">
                                                    <td>
                                                        <h4><b><u><center><?php echo $pcategoryData['catgory_name']; ?></center></u></b></h4>
                                                    </td>
                                                    <td colspan="8">&nbsp;</td>
                                                </tr>
                                                <?php
                                                    $subcat = $this->model_category->fecthSubCatByCatID($pcategoryData['id']);
                                                ?>
                                                 <tr>
                                                    <td><h5><b><center><?php echo $subcat['subcategory_name']; ?></center></b></h5></td>
                                                    <td colspan="8">&nbsp;</td>
                                                </tr>
                                                
                                                <?php
                                                    $qtytot = $mrptot = $valuetot = $outqtytot = $outmrptot = $outvaluetot = $balqtytot = $balmrptot = $balvaluetot = 0; 
                                                    
                                                    $inwardData = '';
                                                    $inwardQtyTot = $inwardAvgTot = $inwardValueTot = $inwardMrpTot = $outwardQtyTot = $outwardAvgTot = $outwardValueTot = $outwardMrpTot = $balQtyTot = $balAvgTot = $balValueTot = $balMrpTot = 0;
                                                    
                                                    foreach($skuArray as $skurows){
                                                        
                                                        $unit = $this->model_unit->fecthUnitDataByID($skurows['unit_id']);
                                                        
                                                        if($frommrp == '' && $tomrp == '')
                                                        {
                                                            $data = array(
                                                                        'from' => $from,
                                                                        'to' => $to,
                                                                        // 'frommrp' => $frommrp,
                                                                        // 'tomrp' => $tomrp,
                                                                        'sku' => $skurows['id'],
                                                                        'attrcolor' => $attrcolor,
                                                                        'attrsize' => $attrsize,
                                                                        'attrpattern' => $attrpattern,
                                                                        'attrstyle1' => $attrstyle1,
                                                                        'attrstyle2' => $attrstyle2,
                                                                        'attrtype' => $attrtype
                                                                    );
                                                            
                                                            $inwardData = $this->model_barcode->fetchInwardItemQtyBySkuCustomerReport($data);
                                                            // $attrData = $this->model_barcode->fetchInwardAttrDataBySkuCustomerReport($data);
                                                            
                                                            $outwardData = $this->model_barcode->fetchOutwardItemQtyBySkuCustomerReport($data);
                                                        }
                                                        else
                                                        {
                                                            $data = array(
                                                                        'from' => $from,
                                                                        'to' => $to,
                                                                        'frommrp' => $frommrp,
                                                                        'tomrp' => $tomrp,
                                                                        'sku' => $skurows['id'],
                                                                        'attrcolor' => $attrcolor,
                                                                        'attrsize' => $attrsize,
                                                                        'attrpattern' => $attrpattern,
                                                                        'attrstyle1' => $attrstyle1,
                                                                        'attrstyle2' => $attrstyle2,
                                                                        'attrtype' => $attrtype
                                                                    );
                                                                    
                                                            $inwardData = $this->model_barcode->fetchInwardItemQtyBySkuCustomerReport1($data);
                                                            // $attrData = $this->model_barcode->fetchInwardAttrDataBySkuCustomerReport1($data);
                                                            
                                                            $outwardData = $this->model_barcode->fetchOutwardItemQtyBySkuCustomerReport1($data);
                                                        }
                                                        
                                                        
                                                        // echo "<pre>"; print_r($inwardData);
                                                        // echo "<pre>"; print_r($attrData);
                                                        // echo "<pre>"; print_r($outwardData);
                                                        
                                                        // ###########################################
                                                        // ##             Inward Data               ##
                                                        // ###########################################
                                                        
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
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $inwardQty." - ".$unit['unit']; ?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $inwardAvgRate;?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo ($inwardQty * $inwardAvgRate);?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $inwardMRP;?></center>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <table border="1" width="100%">
                                                                    <tr>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $outwardQty." - ".$unit['unit']; ?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $outwardAvgRate;?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo ($outwardQty * $outwardAvgRate);?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $outwardMRP;?></center>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <table border="1" width="100%">
                                                                    <tr>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $balQty; ?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $balAvgRate;?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $balValue;?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $balMrp;?></center>
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
                                                                    <center><?php echo $inwardQtyTot; ?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $inwardAvgTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $inwardValueTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $inwardMrpTot;?></center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table border="1" width="100%">
                                                            <tr>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $outwardQtyTot; ?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $outwardAvgTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $outwardValueTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $outwardMrpTot;?></center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table border="1" width="100%">
                                                            <tr>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $balQtyTot; ?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $balAvgTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $balValueTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $balMrpTot;?></center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                            </tr>
                                                     
                                                     
                                                      
                                    <?php          
                                            }
                                        }
                                    ?>
                                    
                                    
                                    
                                    
                                    <?php
                                        // ###################################################################################
                                        // ##          IF SKU DATA IS EMPTY THEN SHOW PRODUCT CATEGORY WISE RECORDS         ##
                                        // ###################################################################################
                                        
                                        if(!empty($pcatData) and empty($skuData))
                                        {
                                            $pcatCount = count($pcatData);
                            
                                            for($i = 0; $i < $pcatCount; $i++)
                                            {
                                                $pcategoryData = $this->model_category->fecthCatDataByID($pcatData[$i]);
                                                // echo "<pre>"; print_r($pcategoryData);
                                        ?>
                                                <tr style="width: 210px;">
                                                    <td>
                                                        <h4><b><u><center><?php echo $pcategoryData['catgory_name']; ?></center></u></b></h4>
                                                    </td>
                                                    <td colspan="8">&nbsp;</td>
                                                </tr>  
                                                
                                                <?php
                                                    
                                                    $subcat = $this->model_category->fecthSubCatByCatID($pcategoryData['id']);
                                                    
                                                    // echo "<pre>"; print_r($subcat);
                                                ?>
                                                <tr>
                                                    <td><h5><b><center><?php echo $subcat['subcategory_name']; ?></center></b></h5></td>
                                                    <td colspan="8">&nbsp;</td>
                                                </tr>
                                                
                                                <?php
                                                    
                                                    
                                                    $skuDataNew = $this->model_sku->fecthSkuByCatID($pcategoryData['id']);
                                                    
                                                    // echo "<pre>"; print_r($skuDataNew);
                                                    
                                                    $qtytot = $mrptot = $valuetot = $outqtytot = $outmrptot = $outvaluetot = $balqtytot = $balmrptot = $balvaluetot = 0; 
                                                    
                                                    $inwardData = '';
                                                    $inwardQtyTot = $inwardAvgTot = $inwardValueTot = $inwardMrpTot = $outwardQtyTot = $outwardAvgTot = $outwardValueTot = $outwardMrpTot = $balQtyTot = $balAvgTot = $balValueTot = $balMrpTot = 0;
                                                    
                                                    foreach($skuDataNew as $skurows){
                                                        
                                                        // echo $skurows->id."<br>".$skurows->product_code."<br>";
                                                        $unit = $this->model_unit->fecthUnitDataByID($skurows->unit_id);
                                                        
                                                        if($frommrp == '' && $tomrp == '')
                                                        {
                                                            $data = array(
                                                                        'from' => $from,
                                                                        'to' => $to,
                                                                        // 'frommrp' => $frommrp,
                                                                        // 'tomrp' => $tomrp,
                                                                        'sku' => $skurows->id,
                                                                        'attrcolor' => $attrcolor,
                                                                        'attrsize' => $attrsize,
                                                                        'attrpattern' => $attrpattern,
                                                                        'attrstyle1' => $attrstyle1,
                                                                        'attrstyle2' => $attrstyle2,
                                                                        'attrtype' => $attrtype
                                                                    );
                                                            
                                                            $inwardData = $this->model_barcode->fetchInwardItemQtyBySkuCustomerReport($data);
                                                            // $attrData = $this->model_barcode->fetchInwardAttrDataBySkuCustomerReport($data);
                                                            
                                                            $outwardData = $this->model_barcode->fetchOutwardItemQtyBySkuCustomerReport($data);
                                                        }
                                                        else
                                                        {
                                                            $data = array(
                                                                        'from' => $from,
                                                                        'to' => $to,
                                                                        'frommrp' => $frommrp,
                                                                        'tomrp' => $tomrp,
                                                                        'sku' => $skurows->id,
                                                                        'attrcolor' => $attrcolor,
                                                                        'attrsize' => $attrsize,
                                                                        'attrpattern' => $attrpattern,
                                                                        'attrstyle1' => $attrstyle1,
                                                                        'attrstyle2' => $attrstyle2,
                                                                        'attrtype' => $attrtype
                                                                    );
                                                                    
                                                            $inwardData = $this->model_barcode->fetchInwardItemQtyBySkuCustomerReport1($data);
                                                            // $attrData = $this->model_barcode->fetchInwardAttrDataBySkuCustomerReport1($data);
                                                            
                                                            $outwardData = $this->model_barcode->fetchOutwardItemQtyBySkuCustomerReport1($data);
                                                        }
                                                        
                                                        
                                                        // echo "<pre>"; print_r($inwardData);
                                                        // echo "<pre>"; print_r($attrData);
                                                        // echo "<pre>"; print_r($outwardData);
                                                        
                                                        // ###########################################
                                                        // ##             Inward Data               ##
                                                        // ###########################################
                                                        
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
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $inwardQty." - ".$unit['unit']; ?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $inwardAvgRate;?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo ($inwardQty * $inwardAvgRate);?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $inwardMRP;?></center>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <table border="1" width="100%">
                                                                    <tr>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $outwardQty." - ".$unit['unit']; ?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $outwardAvgRate;?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo ($outwardQty * $outwardAvgRate);?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $outwardMRP;?></center>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <table border="1" width="100%">
                                                                    <tr>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $balQty; ?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $balAvgRate;?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $balValue;?></center>
                                                                        </td>
                                                                        <td style="width: 20%;">
                                                                            <center><?php echo $balMrp;?></center>
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
                                                                    <center><?php echo $inwardQtyTot; ?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $inwardAvgTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $inwardValueTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $inwardMrpTot;?></center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table border="1" width="100%">
                                                            <tr>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $outwardQtyTot; ?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $outwardAvgTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $outwardValueTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $outwardMrpTot;?></center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table border="1" width="100%">
                                                            <tr>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $balQtyTot; ?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $balAvgTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $balValueTot;?></center>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <center><?php echo $balMrpTot;?></center>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                            </tr>
                                    <?php          
                                            }
                                        }
                                        
                                    ?>
                                    
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                                <?php
                                    if(!empty($skuData))
                                    {   
                                ?>
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
                                            <!--<td>-->
                                            <!--    <center>Type</center>-->
                                            <!--</td>-->
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
                                        
                                        $uniquePCat = array_unique($pcatData, SORT_REGULAR);
                                            
                                        // echo "<pre>"; print_r($uniquePCat);
                                        
                                        foreach($uniquePCat as $rows)
                                        {
                                            $pcategoryData = $this->model_category->fecthCatDataByID($rows['id']);
                                            // echo "<pre>"; print_r($pcategoryData); 
                                            $no=1;
                                            foreach($skuArray as $skurows){
                                    
                                                if($frommrp == '' && $tomrp == '')
                                                {
                                                    $data = array(
                                                                'from' => $from,
                                                                'to' => $to,
                                                                // 'frommrp' => $frommrp,
                                                                // 'tomrp' => $tomrp,
                                                                'sku' => $skurows['id'],
                                                                'attrcolor' => $attrcolor,
                                                                'attrsize' => $attrsize,
                                                                'attrpattern' => $attrpattern,
                                                                'attrstyle1' => $attrstyle1,
                                                                'attrstyle2' => $attrstyle2,
                                                                'attrtype' => $attrtype
                                                            );
                                                    
                                                    // echo "<pre>"; print_r($data); //exit();
                                                    $attrData = $this->model_barcode->getAttrData($data);
                                                }
                                                else
                                                {
                                                    $data = array(
                                                                'from' => $from,
                                                                'to' => $to,
                                                                'frommrp' => $frommrp,
                                                                'tomrp' => $tomrp,
                                                                'sku' => $skurows['id'],
                                                                'attrcolor' => $attrcolor,
                                                                'attrsize' => $attrsize,
                                                                'attrpattern' => $attrpattern,
                                                                'attrstyle1' => $attrstyle1,
                                                                'attrstyle2' => $attrstyle2,
                                                                'attrtype' => $attrtype
                                                            );
                                                    
                                                    $attrData = $this->model_barcode->getAttrData1($data);
                                                }
                                                
                                                // echo "<pre>"; print_r($attrData); //exit();
                                                
                                                $link = '';
                                                if($attrData != ''){

                                                  foreach ($attrData as $key => $value) {
                                                    
                                                    if($value['purchase_type'] == 'pinvoice')
                                                    {
                                                        $pinvoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($value['purchase_id']);
                                                        
                                                        $link = '<a href="'.base_url().'purchase_invoiceitem/update/'.$value['product_id'].'/'.$value['purchase_id'].'"  >'.$pinvoiceData['invoice_no'].'</a>';
                                                    }
                                                    else if($value['purchase_type'] == 'popeningstock')
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
                                ?>      
                                    </table>
                                <?php 
                                    }
                                ?>
                                                    
                                                    
                                                    
                                                    
                                                    
                                            
                                
                                <?php
                                    if(!empty($pcatData) and empty($skuData))
                                    {
                                        
                                ?>
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
                                            <!--<td>-->
                                            <!--    <center>Type</center>-->
                                            <!--</td>-->
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
                                        $pcatCount = count($pcatData);
                                        $no=1;
                                        for($i = 0; $i < $pcatCount; $i++)
                                        {
                                            $pcategoryData = $this->model_category->fecthCatDataByID($pcatData[$i]);
                                           
                                            $skuDataNew = $this->model_sku->fecthSkuByCatID($pcategoryData['id']);
                                                    
                                            foreach($skuDataNew as $skurows){
                                                       
                                                if($frommrp == '' && $tomrp == '')
                                                {
                                                    $data = array(
                                                                'from' => $from,
                                                                'to' => $to,
                                                                // 'frommrp' => $frommrp,
                                                                // 'tomrp' => $tomrp,
                                                                'sku' => $skurows->id,
                                                                'attrcolor' => $attrcolor,
                                                                'attrsize' => $attrsize,
                                                                'attrpattern' => $attrpattern,
                                                                'attrstyle1' => $attrstyle1,
                                                                'attrstyle2' => $attrstyle2,
                                                                'attrtype' => $attrtype
                                                            );
                                                    
                                                    $attrData = $this->model_barcode->getAttrData($data);
                                                }
                                                else
                                                {
                                                    $data = array(
                                                                'from' => $from,
                                                                'to' => $to,
                                                                'frommrp' => $frommrp,
                                                                'tomrp' => $tomrp,
                                                                'sku' => $skurows->id,
                                                                'attrcolor' => $attrcolor,
                                                                'attrsize' => $attrsize,
                                                                'attrpattern' => $attrpattern,
                                                                'attrstyle1' => $attrstyle1,
                                                                'attrstyle2' => $attrstyle2,
                                                                'attrtype' => $attrtype
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
                                ?>      
                                    </table>
                                <?php 
                                    }
                                ?>
                                
                            </td>
                        </tr>
                        
                    </table>
                    
                </div>
            </div>
        </div>
        <?php } ?>
          
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <div class="control-sidebar-bg"></div>

</div>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" rel="stylesheet"/>

<script>
    $(function() {

        $('.mymulselect').multiselect({
        
            includeSelectAllOption: true
        
        });
        
        // $('#btnget').click(function() {
        
        //     alert($('#chkveg').val());
        
        // })
        
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

