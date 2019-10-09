<?php
    
    if(isset($report)){
        // echo "<pre>"; print_r($from); echo "<pre>"; print_r($to); exit;    
    }
                                                                    
    
?>
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
        Inventory Custom Report
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
    <section class="content" style="min-height: 100000px;">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            <form role="form" action="<?php echo base_url() ?>reports/customeReport" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        
                        <input type="hidden" name="customerreport" value="report">
                        
                        <!--<div class="col-md-4 col-sm-4 col-xs-12">-->
                            <div>
                              <label>Division</label>
                              <br>
                              <select class="mymulselect form-control" name="division[]" id="sdivision" multiple="multiple">
                                    <?php foreach($division as $rows){ ?>
                                        
                                            <option value="<?php echo $rows->id; ?>"  ><?php echo $rows->division_name; ?></option>
                                        
                                    <?php } ?>
                                </select>
                            </div>
                        <!--</div>-->
                        
                    </div>
                        
                    <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>
                              <label>Location</label>
                              <br>
                              <select class="mymulselect form-control" name="location[]" id="slocation" multiple="multiple">
                                    <?php foreach($location as $rows){ ?>
                                        
                                            <option value="<?php echo $rows->id; ?>"  ><?php echo $rows->location_name; ?></option>
                                        
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <label>Product Category</label>
                            <br>
                            
                            <div style="display:none">
                                <select class="mymulselect form-control" id="spcat" name="pcat[]" multiple="multiple">
                                    <?php foreach($productCat as $rows){ ?> 
                                    
                                            <option value="<?php echo $rows->id; ?>"  ><?php echo $rows->catgory_name; ?></option>
                                        
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <!--<div style="display:none">-->
                                <select class="mymulselect form-control" id="spcat1" name="pcat1[]" multiple="multiple">
                                    <?php foreach($productCat as $rows){ ?> 
                                    
                                       
                                            <option value="<?php echo $rows->id; ?>"  ><?php echo $rows->catgory_name; ?></option>
                                        
            
                                    <?php } ?>
                                </select>
                            <!--</div>-->
                            
                          <!--<select name="category" class="form-control" required>-->
                          <!--  <option value="0">---Select One---</option>-->
                          <!--</select>-->
                        </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>Product Sub-Category</label>
                            <br>
                            <div style="display:none">
                                <select class="mymulselect form-control" id="spsubcat" name="psubcat[]" multiple="multiple">
                                    <?php foreach($productSubCat as $rows){ ?>
                                      
                                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->subcategory_name; ?></option>
                                        
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <!--<div style="display:none">-->
                                <select class="mymulselect form-control" id="spsubcat1" name="psubcat1[]" multiple="multiple">
                                    <?php foreach($productSubCat as $rows){ ?>
                                        
                                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->subcategory_name; ?></option>
                                       
                                          
                                    <?php } ?>
                                </select>
                            <!--</div>-->
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>SKU</label>
                          <br>
                            <div style="display:none">
                                <select class="mymulselect" name="sku[]" id="ssku" multiple="multiple">
                                    <?php foreach($sku as $rows){ ?>
                                    
                                        <option value="<?php echo $rows['id']; ?>"  ><?php echo $rows['product_code']; ?></option>
                                        
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <!--<div style="display:none">-->
                                <select class="mymulselect" name="sku1[]" id="ssku1" multiple="multiple">
                                    <?php foreach($sku as $rows){ ?>
                                    
                                        <option value="<?php echo $rows['id']; ?>"  ><?php echo $rows['product_code']; ?></option>
                                        
                                    <?php } ?>
                                </select>
                            <!--</div>-->
                            
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Brand</label>
                          <br>
                          <select class="mymulselect form-control" name="brand[]" id="sbrand" multiple="multiple">
                                <?php foreach($brand as $rows){ ?>
                                    
                                        <option value="<?php echo $rows->id; ?>"  ><?php echo $rows->brand_name; ?></option>
                                    
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
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
        
        <?php
            if(isset($report))
            {
        ?>

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
                                    <th>
                                        <center>Opening Balance/ InWards</center>
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
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="1" width="100%">
                                <?php
                                    if(isset($pcatIds1))
                                    {
                                        foreach($pcatIds1 as $cat)  
                                        {
                                            if(empty($division))
                                            {
                                                $catData = $this->model_category->fecthCatDataByID($cat);    
                                            }
                                            else
                                            {
                                                $catData = $this->model_category->fecthAllDataByCatDivId($cat, $div[0]);
                                            }
                                            
                                ?>
                                            <tr>
                                                <th style="width: 190px;">
                                                    <h4><b><u><center><?php echo $catData['catgory_name']; ?></center></u></b></h4>
                                                </th>
                                                <td>
                                                  <table width="100%">
                                                      <tr>
                                                          <td style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                          <td  style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                          <td  style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                          <td  style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                      </tr>
                                                  </table>
                                                </td>
                                                <td>
                                                  <table width="100%">
                                                      <tr>
                                                          <td style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                          <td  style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                          <td  style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                          <td  style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                      </tr>
                                                  </table>
                                                </td>
                                                <td>
                                                  <table width="100%">
                                                      <tr>
                                                          <td style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                          <td  style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                          <td  style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                          <td  style="width: 20%;">
                                                              <center><?php echo "&nbsp;"; ?></center>
                                                          </td>
                                                      </tr>
                                                  </table>
                                                </td>
                                            </tr>
                                            
                                            <?php
                                                
                                                $finalInwards = $finalOutwards = $finalCl = 0;
                                            
                                                foreach($psubcatIds1 as $subCat)
                                                {
                                                    $subcatData = $this->model_category->fecthSubCatByCatID2($cat, $subCat);
                                            ?>
                                                    <tr>
                                                        <td style="width: 190px;">
                                                            <h5><b><center><?php echo $subcatData['subcategory_name']; ?></center></b></h5>
                                                        </td>
                                                        <td>
                                                          <table width="100%">
                                                              <tr>
                                                                  <td style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                                  <td  style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                                  <td  style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                                  <td  style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                              </tr>
                                                          </table>
                                                        </td>
                                                        <td>
                                                          <table width="100%">
                                                              <tr>
                                                                  <td style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                                  <td  style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                                  <td  style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                                  <td  style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                              </tr>
                                                          </table>
                                                        </td>
                                                        <td>
                                                          <table width="100%">
                                                              <tr>
                                                                  <td style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                                  <td  style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                                  <td  style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                                  <td  style="width: 20%;">
                                                                      <center><?php echo "&nbsp;"; ?></center>
                                                                  </td>
                                                              </tr>
                                                          </table>
                                                        </td>
                                                    </tr>
                                                    
                                                    <?php
                                                        
                                                        
                                                        $totQty = $totValue = $totMrp = $totOutQty = $totOutValue = $totOutMrp = $totClQty = $totClValue = $valueCl = 0;
                                                        
                                                        foreach($skuIds1 as $sku)
                                                        {   
                                                            $skuData = $this->model_sku->fecthDataByIDCatidSubcatId($cat, $subCat, $sku);
                                                            
                                                            // echo "<pre>"; print_r($skuData);
                                                            
                                                            if($skuData)
                                                            {
                                                    ?>
                                                                <?php
                                                                    // Inwards Data
                                                                    $qty = $rate = $mrp = $value = $unit = $qtyOut = $valueOut = $clQty = '';
                                                                    
                                                                    if(empty($loc))
                                                                    {
                                                                        $data = $this->model_globalsearch->fetchPurchaseInvoiceGroupByID1($skuData['id']);

                                                                        $qty = $qty + $data['qty'];
                                                                        $rate = $rate + $data['base_price'];
                                                                        $mrp = $mrp + $data['mrp_price'];
                                                                        
                                                                        $unit = $data['unit_id'];
                                                                    }
                                                                    else if(!empty($loc) && empty($frommrp) && empty($tomrp) && empty($from) && empty($to))
                                                                    {
                                                                      foreach ($loc as $key => $valueLoc){

                                                                        $fieldData = array(
                                                                                            'sku' => $skuData['id'],
                                                                                            'loc' => $valueLoc
                                                                                        );
                                                                        
                                                                        $data = $this->model_globalsearch->fetchPurchaseInvoiceGroupByID2($fieldData);
                                                                        $qty = $qty + $data['qty'];
                                                                        $rate = $rate + $data['base_price'];
                                                                        $mrp = $mrp + $data['mrp_price'];
                                                                        
                                                                        $unit = $data['unit_id'];
                                                                      }
                                                                    }
                                                                    else if(!empty($frommrp) && !empty($tomrp) && empty($from) && empty($to))
                                                                    {
                                                                      foreach ($loc as $key => $valueLoc){

                                                                        $fieldData = array(
                                                                                            'sku' => $skuData['id'],
                                                                                            'loc' => $valueLoc,
                                                                                            'mrpfrom' => $frommrp,
                                                                                            'mrpto' => $tomrp
                                                                                          );
                                                                        
                                                                        $data = $this->model_globalsearch->fetchPurchaseInvoiceGroupByID3($fieldData);
                                                                        $qty = $qty + $data['qty'];
                                                                        $rate = $rate + $data['base_price'];
                                                                        $mrp = $mrp + $data['mrp_price'];
                                                                        
                                                                        $unit = $data['unit_id'];
                                                                      }
                                                                    }
                                                                    else if(empty($frommrp) && empty($tomrp) && !empty($from) && !empty($to))
                                                                    {
                                                                      foreach ($loc as $key => $valueLoc){

                                                                        $fieldData = array(
                                                                                            'sku' => $skuData['id'],
                                                                                            'loc' => $valueLoc,
                                                                                            'fromDate' => $from,
                                                                                            'toDate' => $to
                                                                                          );
                                                                        
                                                                        $data = $this->model_globalsearch->fetchPurchaseInvoiceGroupByID4($fieldData);

                                                                        $qty = $qty + $data['qty'];
                                                                        $rate = $rate + $data['base_price'];
                                                                        $mrp = $mrp + $data['mrp_price'];
                                                                        
                                                                        $unit = $data['unit_id'];
                                                                      }
                                                                    }
                                                                    else
                                                                    {
                                                                      foreach ($loc as $key => $valueLoc){

                                                                        $fieldData = array(
                                                                                            'sku' => $skuData['id'],
                                                                                            'loc' => $valueLoc,
                                                                                            'mrpfrom' => $frommrp,
                                                                                            'mrpto' => $tomrp,
                                                                                            'fromDate' => $from,
                                                                                            'toDate' => $to
                                                                                          );
                                                                        
                                                                        $data = $this->model_globalsearch->fetchPurchaseInvoiceGroupByID5($fieldData);

                                                                        $qty = $qty + $data['qty'];
                                                                        $rate = $rate + $data['base_price'];
                                                                        $mrp = $mrp + $data['mrp_price'];
                                                                        
                                                                        $unit = $data['unit_id'];
                                                                      }
                                                                    }


                                                                    // // OPENING STOCK
                                                                    // // else if(empty($data['id']))
                                                                    // // {
                                                                      if(empty($loc))
                                                                      {
                                                                        $ostock = $this->model_globalsearch->fetchOStockGroupByIDCR1($skuData['id']);
                                                                            $qty = $qty + $ostock['qty'];
                                                                          $rate = $rate + $ostock['base_price'];
                                                                          $mrp = $mrp + $ostock['mrp'];

                                                                          if(empty($unit))
                                                                          {
                                                                            $unit = $ostock['unit'];
                                                                          }
                                                                      }
                                                                      else if(!empty($loc) && empty($frommrp) && empty($tomrp) && empty($from) && empty($to))
                                                                      {
                                                                        foreach ($loc as $key => $valueLoc){

                                                                          $fieldData = array(
                                                                                              'sku' => $skuData['id'],
                                                                                              'loc' => $valueLoc
                                                                                          );
                                                                          $ostock = $this->model_globalsearch->fetchOStockGroupByIDCR2($fieldData);

                                                                          $qty = $qty + $ostock['qty'];
                                                                          $rate = $rate + $ostock['base_price'];
                                                                          $mrp = $mrp + $ostock['mrp'];
                                                                          
                                                                          if(empty($unit))
                                                                          {
                                                                            $unit = $ostock['unit'];
                                                                          }
                                                                        }
                                                                      }
                                                                      else if(!empty($frommrp) && !empty($tomrp) && empty($from) && empty($to))
                                                                      {
                                                                          foreach ($loc as $key => $valueLoc){

                                                                              $fieldData = array(
                                                                                                  'sku' => $skuData['id'],
                                                                                                  'loc' => $valueLoc,
                                                                                                  'mrpfrom' => $frommrp,
                                                                                                  'mrpto' => $tomrp
                                                                                              );
                                                                              $ostock = $this->model_globalsearch->fetchOStockGroupByIDCR3($fieldData);

                                                                              $qty = $qty + $ostock['qty'];
                                                                              $rate = $rate + $ostock['base_price'];
                                                                              $mrp = $mrp + $ostock['mrp'];
                                                                              
                                                                              if(empty($unit))
                                                                              {
                                                                                $unit = $ostock['unit'];
                                                                              }
                                                                          }
                                                                      }
                                                                      else if(empty($frommrp) && empty($tomrp) && !empty($from) && !empty($to))
                                                                      {
                                                                          foreach ($loc as $key => $valueLoc){

                                                                              $fieldData = array(
                                                                                                  'sku' => $skuData['id'],
                                                                                                  'loc' => $valueLoc,
                                                                                                  'fromDate' => $from,
                                                                                                  'toDate' => $to
                                                                                              );
                                                                              $ostock = $this->model_globalsearch->fetchOStockGroupByIDCR4($fieldData);

                                                                              $qty = $qty + $ostock['qty'];
                                                                              $rate = $rate + $ostock['base_price'];
                                                                              $mrp = $mrp + $ostock['mrp'];
                                                                              
                                                                              if(empty($unit))
                                                                              {
                                                                                $unit = $ostock['unit'];
                                                                              }
                                                                          }
                                                                      }
                                                                      else
                                                                      {
                                                                          foreach ($loc as $key => $valueLoc){

                                                                              $fieldData = array(
                                                                                                  'sku' => $skuData['id'],
                                                                                                  'loc' => $valueLoc,
                                                                                                  'mrpfrom' => $frommrp,
                                                                                                  'mrpto' => $tomrp,
                                                                                                  'fromDate' => $from,
                                                                                                  'toDate' => $to
                                                                                                );

                                                                              $ostock = $this->model_globalsearch->fetchOStockGroupByIDCR5($fieldData);

                                                                              $qty = $qty + $ostock['qty'];
                                                                              $rate = $rate + $ostock['base_price'];
                                                                              $mrp = $mrp + $ostock['mrp'];
                                                                              
                                                                              if(empty($unit))
                                                                              {
                                                                                $unit = $ostock['unit'];
                                                                              }
                                                                          }
                                                                      }


                                                                    // // else if(empty($ostock['id']))
                                                                    // // {
                                                                      if(empty($loc))
                                                                      {
                                                                        $excesses = $this->model_globalsearch->fetchExcessesGroupByID1($skuData['id']);

                                                                        if($excesses['qty1'] != '')
                                                                        {
                                                                          $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($excesses['pno']);

                                                                          $qty = $qty + $excesses['qty1'];
                                                                          $rate = $rate + $excesses['baseprice'];
                                                                          $mrp = $mrp + $excesses['finalprice'];
                                                                        
                                                                          if(empty($unit))
                                                                          {
                                                                            $unit = $barcodeData['unit_id'];
                                                                          }
                                                                        }
                                                                      }
                                                                      else if(!empty($loc))
                                                                      {
                                                                        $excesses = $this->model_globalsearch->fetchExcessesGroupByID1($skuData['id']);
                                                                        
                                                                        if($excesses['qty1'] != '')
                                                                        {
                                                                          $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($excesses['pno']);

                                                                          $qty = $qty + $excesses['qty1'];
                                                                          $rate = $rate + $excesses['baseprice'];
                                                                          $mrp = $mrp + $excesses['finalprice'];
                                                                        
                                                                          if(empty($unit))
                                                                          {
                                                                            $unit = $barcodeData['unit_id'];
                                                                          }
                                                                        }
                                                                      }
                                                                      else if(!empty($loc) && empty($frommrp) && empty($tomrp) && empty($from) && empty($to))
                                                                      {
                                                                        foreach ($loc as $key => $valueLoc){

                                                                          $excesses = $this->model_globalsearch->fetchExcessesGroupByID1($skuData['id']);

                                                                          if($excesses['qty1'] != '')
                                                                          {
                                                                            $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($excesses['pno']);

                                                                            $qty = $qty + $excesses['qty1'];
                                                                            $rate = $rate + $excesses['baseprice'];
                                                                            $mrp = $mrp + $excesses['finalprice'];
                                                                            
                                                                            if(empty($unit))
                                                                            {
                                                                              $unit = $barcodeData['unit_id'];
                                                                            }
                                                                          }
                                                                        }
                                                                      }
                                                                      else if(!empty($frommrp) && !empty($tomrp) && empty($from) && empty($to))
                                                                      {
                                                                        foreach ($loc as $key => $valueLoc){

                                                                          $fieldData = array(
                                                                                              'sku' => $skuData['id'],
                                                                                              'loc' => $valueLoc,
                                                                                              'mrpfrom' => $frommrp,
                                                                                              'mrpto' => $tomrp
                                                                                            );
                                                                              
                                                                          $excesses = $this->model_globalsearch->fetchExcessesGroupByID2($fieldData);

                                                                          if($excesses['qty1'] != '')
                                                                          {
                                                                            $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($excesses['pno']);

                                                                            $qty = $qty + $excesses['qty1'];
                                                                            $rate = $rate + $excesses['baseprice'];
                                                                            $mrp = $mrp + $excesses['finalprice'];
                                                                              
                                                                            if(empty($unit))
                                                                            {
                                                                              $unit = $barcodeData['unit_id'];
                                                                            }
                                                                          }
                                                                        }
                                                                      }
                                                                      else if(empty($frommrp) && empty($tomrp) && !empty($from) && !empty($to))
                                                                      {
                                                                        foreach ($loc as $key => $valueLoc){

                                                                          $fieldData = array(
                                                                                              'sku' => $skuData['id'],
                                                                                              'loc' => $valueLoc,
                                                                                              'fromDate' => $from,
                                                                                              'toDate' => $to
                                                                                            );
                                                                          
                                                                          $excesses = $this->model_globalsearch->fetchExcessesGroupByID3($fieldData);

                                                                          if($excesses['qty1'] != '')
                                                                          {   
                                                                            $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($excesses['pno']);

                                                                            $qty = $qty + $excesses['qty1'];
                                                                            $rate = $rate + $excesses['baseprice'];
                                                                            $mrp = $mrp + $excesses['finalprice'];
                                                                              
                                                                            if(empty($unit))
                                                                            {
                                                                              $unit = $barcodeData['unit_id'];
                                                                            }
                                                                          } 
                                                                        }
                                                                      }
                                                                      else
                                                                      {
                                                                        foreach ($loc as $key => $valueLoc){

                                                                          $fieldData = array(
                                                                                              'sku' => $skuData['id'],
                                                                                              'loc' => $valueLoc,
                                                                                              'mrpfrom' => $frommrp,
                                                                                              'mrpto' => $tomrp,
                                                                                              'fromDate' => $from,
                                                                                              'toDate' => $to
                                                                                            );
                                                                          
                                                                          $excesses = $this->model_globalsearch->fetchExcessesGroupByID4($fieldData);

                                                                          if($excesses['qty1'] != '')
                                                                          { 
                                                                            $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($excesses['pno']);

                                                                            $qty = $qty + $excesses['qty1'];
                                                                            $rate = $rate + $excesses['baseprice'];
                                                                            $mrp = $mrp + $excesses['finalprice'];
                                                                                
                                                                            if(empty($unit))
                                                                            {
                                                                              $unit = $barcodeData['unit_id'];
                                                                            }
                                                                          }
                                                                        }
                                                                      }



                                                                     
                                                                    // else if(empty($excesses['id']))
                                                                    // {
                                                                      if(empty($loc))
                                                                      {
                                                                        $exchange = $this->model_globalsearch->fetchSExchangeGroupByID1($skuData['id']);

                                                                          $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($exchange['pno']);

                                                                          $qty = $qty + $exchange['quantity'];
                                                                          $rate = $rate + $exchange['baseprice'];
                                                                          $mrp = $mrp + $exchange['finalprice'];
                                                                              
                                                                          if(empty($unit))
                                                                          {
                                                                            $unit = $barcodeData['unit_id'];
                                                                          }
                                                                      }
                                                                      else if(!empty($loc) && empty($frommrp) && empty($tomrp) && empty($from) && empty($to))
                                                                      {
                                                                        $exchange = $this->model_globalsearch->fetchSExchangeGroupByID1($skuData['id']);

                                                                          $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($exchange['pno']);

                                                                          $qty = $qty + $exchange['quantity'];
                                                                          $rate = $rate + $exchange['baseprice'];
                                                                          $mrp = $mrp + $exchange['finalprice'];
                                                                              
                                                                          if(empty($unit))
                                                                          {
                                                                            $unit = $barcodeData['unit_id'];
                                                                          }
                                                                      }
                                                                      else if(!empty($frommrp) && !empty($tomrp) && empty($from) && empty($to))
                                                                      {
                                                                          foreach ($loc as $key => $valueLoc){

                                                                            $fieldData = array(
                                                                                                  'sku' => $skuData['id'],
                                                                                                  'loc' => $valueLoc,
                                                                                                  'mrpfrom' => $frommrp,
                                                                                                  'mrpto' => $tomrp
                                                                                                );
                                                                                  
                                                                              $exchange = $this->model_globalsearch->fetchSExchangeGroupByID2($fieldData);

                                                                              $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($exchange['pno']);

                                                                              $qty = $qty + $exchange['quantity'];
                                                                              $rate = $rate + $exchange['baseprice'];
                                                                              $mrp = $mrp + $exchange['finalprice'];
                                                                                
                                                                              if(empty($unit))
                                                                              {
                                                                                $unit = $barcodeData['unit_id'];
                                                                              }
                                                                          }
                                                                      }
                                                                      else if(empty($frommrp) && empty($tomrp) && !empty($from) && !empty($to))
                                                                      {
                                                                        foreach ($loc as $key => $valueLoc){

                                                                          $fieldData = array(
                                                                                              'sku' => $skuData['id'],
                                                                                              'loc' => $valueLoc,
                                                                                              'fromDate' => $from,
                                                                                              'toDate' => $to
                                                                                            );
                                                                              
                                                                          $exchange = $this->model_globalsearch->fetchSExchangeGroupByID3($fieldData);

                                                                              $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($exchange['pno']);

                                                                              $qty = $qty + $exchange['quantity'];
                                                                              $rate = $rate + $exchange['baseprice'];
                                                                              $mrp = $mrp + $exchange['finalprice'];
                                                                                
                                                                              if(empty($unit))
                                                                              {
                                                                                $unit = $barcodeData['unit_id'];
                                                                              }
                                                                        }
                                                                      }
                                                                      else
                                                                      {
                                                                        foreach ($loc as $key => $valueLoc){

                                                                          $fieldData = array(
                                                                                              'sku' => $skuData['id'],
                                                                                              'loc' => $valueLoc,
                                                                                              'mrpfrom' => $frommrp,
                                                                                              'mrpto' => $tomrp,
                                                                                              'fromDate' => $from,
                                                                                              'toDate' => $to
                                                                                            );

                                                                          $exchange = $this->model_globalsearch->fetchSExchangeGroupByID4($fieldData);

                                                                              $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($exchange['pno']);

                                                                              $qty = $qty + $exchange['quantity'];
                                                                              $rate = $rate + $exchange['baseprice'];
                                                                              $mrp = $mrp + $exchange['finalprice'];
                                                                                
                                                                              if(empty($unit))
                                                                              {
                                                                                $unit = $barcodeData['unit_id'];
                                                                              }
                                                                        }
                                                                      }
                                                                  
                                                                    
                                                                    $value = $qty * $rate;
                                                                    
                                                                    // Calculate subcat total data 
                                                                    $totQty = $totQty + $qty;
                                                                    $totValue = $totValue + $value;
                                                                    
                                                                    $unitData = $this->model_unit->fecthUnitDataByID($unit);
                                                                    
                                                                    // Outwards Data
                                                                    
                                                                    // sales invoice, POS, exchange
                                                                    // if(empty($loc))
                                                                    // {
                                                                    //   $salesData = $this->model_globalsearch->outWardsDataBySKU2($skuData['id']);
                                                                    // }
                                                                    // else if(!empty($loc) && empty($frommrp) && empty($tomrp) && empty($from) && empty($to))
                                                                    // {
                                                                    //   foreach ($loc as $key => $valueLoc){

                                                                    //     $fieldData = array(
                                                                    //                         'sku' => $skuData['id'],
                                                                    //                         'loc' => $valueLoc
                                                                    //                       );

                                                                    //     $salesData = $this->model_globalsearch->outWardsDataBySKU3($fieldData);
                                                                    //   }
                                                                    // }
                                                                    // else if(!empty($frommrp) && !empty($tomrp) && empty($from) && empty($to))
                                                                    // {
                                                                    //   foreach ($loc as $key => $valueLoc){

                                                                    //       $fieldData = array(
                                                                    //                           'sku' => $skuData['id'],
                                                                    //                           'loc' => $valueLoc,
                                                                    //                           'mrpfrom' => $frommrp,
                                                                    //                           'mrpto' => $tomrp
                                                                    //                         );

                                                                    //       $salesData = $this->model_globalsearch->outWardsDataBySKU4($fieldData);
                                                                    //   }
                                                                    // }
                                                                    // else if(empty($frommrp) && empty($tomrp) && !empty($from) && !empty($to))
                                                                    // {
                                                                    //   foreach ($loc as $key => $valueLoc){

                                                                    //       $fieldData = array(
                                                                    //                           'sku' => $skuData['id'],
                                                                    //                           'loc' => $valueLoc,
                                                                    //                           'fromDate' => $from,
                                                                    //                           'toDate' => $to
                                                                    //                         );

                                                                    //       $salesData = $this->model_globalsearch->outWardsDataBySKU5($fieldData);
                                                                    //   }
                                                                    // }
                                                                    // else
                                                                    // {
                                                                    //   foreach ($loc as $key => $valueLoc){

                                                                    //     $fieldData = array(
                                                                    //                         'sku' => $skuData['id'],
                                                                    //                         'loc' => $valueLoc,
                                                                    //                         'mrpfrom' => $frommrp,
                                                                    //                         'mrpto' => $tomrp,
                                                                    //                         'fromDate' => $from,
                                                                    //                         'toDate' => $to
                                                                    //                       );
                                                                        
                                                                    //     $salesData = $this->model_globalsearch->outWardsDataBySKU6($fieldData);
                                                                    //   }
                                                                    // }



                                                                    // wsp, shortage, purchase return
                                                                    if(empty($loc))
                                                                    {
                                                                      $salesData1 = $this->model_globalsearch->outWardsDataBySKU1($skuData['id']);
                                                                    }
                                                                    else if(!empty($loc))
                                                                    {
                                                                      foreach ($loc as $key => $valueLoc){

                                                                        $fieldData = array(
                                                                                            'sku' => $skuData['id'],
                                                                                            'loc' => $valueLoc
                                                                                          );
                                                                        
                                                                        $salesData1 = $this->model_globalsearch->outWardsDataBySKU1($skuData['id']);
                                                                      }
                                                                    }

                                                                    // // production
                                                                    // $barcodeData = $this->model_barcode->fetchDataBySkuCode($skuData['id']);
                                                                    // $production = $this->model_globalsearch->fecthMaterial();
                                                                    
                                                                    // $materialData = $this->model_globalsearch->fecthAllMaterialDataBySku($skuData['id']);
                                                                    




                                                                    // echo "<br>SKU Code".$skuData['product_code'];
                                                                    
                                                                    // echo "<br>SAles invoice/ POS, exchange ".$salesData['qty'];
                                                                    // echo "<br>wsp, shortage, purchase return	".$salesData1['qty'];
                                                                    
                                                                    // echo "<br>production "; print_r($materialData['qty']);
                                                                    
                                                                    // $pQty = 0;
                                                                    
                                                                    // foreach ($production as $key => $pValue){
                                                                        
                                                                    //     foreach ($barcodeData as $key => $bValue) {
                                                                        
                                                                    //         if($bValue['id'] == $pValue['product_no'])
                                                                    //         {
                                                                    //             // $materialData = $this->model_globalsearch->fecthAllMaterialDataByBarcode($bValue['id']);
                                                                                
                                                                    //             // $productionData = $this->model_production->fecthAllDatabyID($pValue['id']);
                                                                    //             // $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($bValue['product_no']);
                                                                    //             // echo "<pre>"; print_r($materialData);
                                                                    //             // $pQty = $pQty + $pValue['quantity'];
                                                                    //             $pQty = $materialData['qty'];
                                                                    //             // echo "<pre>"; print_r($materialData);
                                                                    //             echo "SKU Code".$skuData['product_code'];
                                                                                
                                                                    //             // $productionResult[] = array(
                                                                    //             //                     'qty' => $pValue['quantity'],
                                                                    //             //                     'mrp' => $bValue['basic_rate'],
                                                                    //             //                     'finalprice' => $bValue['mrp'],
                                                                    //             //                     'invoice_no' => $productionData['jobsheet_no'],
                                                                    //             //                     'name' => 'Production',
                                                                    //             //                     'customer' => '-',
                                                                    //             //                     'url' => 'production/update/'.$pValue['id']
                                                        
                                                                    //             //             );
                                                        
                                                                    //             // echo "<pre>"; print_r($productionResult);
                                                                    //         }
                                                                    //     }
                                                                    // }
                                                                    
                                                                    // echo "<pre>"; print_r($salesData1);
                                                                    
                                                                    $qtyOut = $salesData['qty'] + $salesData1['qty2'] + $materialData['qty'];
                                                                    $valueOut = $qtyOut * $rate;
                                                                    
                                                                    $totOutQty = $totOutQty + $qtyOut;
                                                                    $totOutValue = $totOutValue + $valueOut;
                                                                    
                                                                    $clQty = $qty - $qtyOut;
                                                                    $valueCl = $clQty * $rate;
                                                                    
                                                                    $totClQty = $totClQty + $clQty;
                                                                    $totClValue = $totClValue + $valueCl;
                                                                ?>

                                                                <?php if($qty > 0){ ?>
                                                                  <tr>
                                                                      <td style="width: 190px;">
                                                                          <h5><b>
                                                                              <center>
                                                                                  <a href="#"><?php echo $skuData['product_code']; ?></a>
                                                                              </center>
                                                                          </b></h5>
                                                                      </td>
                                                                      <td>
                                                                          <table border="1" width="100%">
                                                                              <tr>
                                                                                  <td style="width: 20%;">
                                                                                      <center><?php echo number_format($qty, 2)." - <br>".$unitData['unit']; ?></center>
                                                                                  </td>
                                                                                  <td  style="width: 20%;">
                                                                                      <center><?php echo number_format($rate, 3); ?></center>
                                                                                  </td>
                                                                                  <td  style="width: 20%;">
                                                                                      <center><?php echo number_format($value, 3); ?></center>
                                                                                  </td>
                                                                                  <td  style="width: 20%;">
                                                                                      <center><?php echo number_format($mrp, 3); ?></center>
                                                                                  </td>
                                                                              </tr>
                                                                          </table>
                                                                      </td>
                                                                      <td>
                                                                          <table border="1" width="100%">
                                                                              <tr>
                                                                                  <td style="width: 20%;">
                                                                                      <center><?php echo number_format($qtyOut, 2)." - <br>".$unitData['unit'] ?></center>
                                                                                  </td>
                                                                                  <td  style="width: 20%;">
                                                                                      <center><?php echo number_format($rate, 3); ?></center>
                                                                                  </td>
                                                                                  <td  style="width: 20%;">
                                                                                      <center><?php echo number_format($valueOut, 3); ?></center>
                                                                                  </td>
                                                                                  <td  style="width: 20%;">
                                                                                      <center><?php echo number_format($mrp, 3); ?></center>
                                                                                  </td>
                                                                              </tr>
                                                                          </table>
                                                                      </td>
                                                                      <td>
                                                                          <table border="1" width="100%">
                                                                              <tr>
                                                                                  <td style="width: 20%;">
                                                                                      <center><?php echo number_format($clQty, 2)." - <br>".$unitData['unit'] ?></center>
                                                                                  </td>
                                                                                  <td  style="width: 20%;">
                                                                                      <center><?php echo number_format($rate, 3); ?></center>
                                                                                  </td>
                                                                                  <td  style="width: 20%;">
                                                                                      <center><?php echo number_format($valueCl, 3); ?></center>
                                                                                  </td>
                                                                                  <td  style="width: 20%;">
                                                                                      <center><?php echo number_format($mrp, 3); ?></center>
                                                                                  </td>
                                                                              </tr>
                                                                          </table>
                                                                      </td>
                                                          
                                                                  </tr>

                                                                <?php } ?>
                                                                
                                                                
                                                                
                                                    <?php
                                                            }
                                                        }    
                                                    ?>
                                                    
                                                    <?php if(!empty($totQty)){ ?>
                                                    
                                                         <tr>
                                                            <td style="width: 190px;">
                                                                <h5><b><center><?php echo 'Total'; ?></center></b></h5>
                                                            </td>
                                                            <td>
                                                                <table border="1" width="100%">
                                                                    <tr>
                                                                        <td style="width: 20%; padding: 7px">
                                                                            <center><?php echo $totQty; ?></center>
                                                                        </td>
                                                                        <td  style="width: 20%;">
                                                                            <center><?php echo number_format($totValue / $totQty, 3); ?></center>
                                                                        </td>
                                                                        <td  style="width: 20%;">
                                                                            <center><?php echo number_format($totValue, 3); ?></center>
                                                                        </td>
                                                                        <td  style="width: 20%;">
                                                                            <center><?php echo ""; ?></center>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <table border="1" width="100%">
                                                                    <tr>
                                                                        <td style="width: 20%; padding: 7px">
                                                                            <center><?php echo $totOutQty; ?></center>
                                                                        </td>
                                                                        <td  style="width: 20%;">
                                                                            <center><?php echo number_format($totOutValue / $totOutQty, 3); ?></center>
                                                                        </td>
                                                                        <td  style="width: 20%;">
                                                                            <center><?php echo number_format($totOutValue, 3); ?></center>
                                                                        </td>
                                                                        <td  style="width: 20%;">
                                                                            <center><?php echo ""; ?></center>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <table border="1" width="100%">
                                                                    <tr>
                                                                        <td style="width: 20%; padding: 7px">
                                                                            <center><?php echo $totClQty; ?></center>
                                                                        </td>
                                                                        <td  style="width: 20%;">
                                                                            <center><?php echo number_format($totClValue / $totClQty, 3); ?></center>
                                                                        </td>
                                                                        <td  style="width: 20%;">
                                                                            <center><?php echo number_format($totClValue, 3); ?></center>
                                                                        </td>
                                                                        <td  style="width: 20%;">
                                                                            <center><?php echo ""; ?></center>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    
                                                <?php
                                                   
                                                    $finalInwards = $finalInwards + $totValue;
                                                    $finalOutwards = $finalOutwards + $totOutValue;
                                                    $finalCl = $finalCl + $totClValue;
                                                ?>
                                    
                                            
                                            <?php
                                                }
                                            ?>
                                            
                                            <input type="hidden" name="inward" id="inwardsTot" value="<?php echo abs($finalInwards); ?>">
                                            <input type="hidden" name="outward" id="outTot" value="<?php echo abs($finalOutwards); ?>">
                                            <input type="hidden" name="cl" id="clTot" value="<?php echo abs($finalCl); ?>">
                                            
                                           
                                <?php
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
        
        <?php
            }
        ?>
          
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

        //   console.log(inwards);
        //   console.log(outwards);
        //   console.log(cl);
      }
  });
</script>

<script>

    var base_url = '<?php echo base_url(); ?>';
    // $('#sbrand').on('click', function(){
        
        // alert("hi");
        // var brand = $(this).val();
        // $('#sbrand').change(function() {
        //     var brand = $(this).val();
            
        // });
        
        $('#sbrand').on('change',function() {
            
            var spcat = $('#spcat').val();
            $.each(spcat, function(key, pcat){
                
                $('#spcat').multiselect('deselect', pcat);
            });
            
            var spcat1 = $('#spcat1').val();
            $.each(spcat1, function(key, pcat){
                
                $('#spcat1').multiselect('deselect', pcat);
            });
            
            
            
            var spsubcat = $('#spsubcat').val();
            $.each(spsubcat, function(key, spcat){
                
                $('#spsubcat').multiselect('deselect', spcat);
            });
            
            var spsubcat1 = $('#spsubcat1').val();
            $.each(spsubcat1, function(key, spcat){
                
                $('#spsubcat1').multiselect('deselect', spcat);
            });
            
            
            var ssku = $('#ssku').val();
            $.each(ssku, function(key, sku){
                
                $('#ssku').multiselect('deselect', sku);
            });
            
            var ssku1 = $('#ssku1').val();
            $.each(ssku1, function(key, sku){
                
                $('#ssku1').multiselect('deselect', sku);
            });
            
            
            var brands = $(this).val();
            
            $.each(brands, function(key, brand){
                
               $.ajax({
                   
                    method: 'POST',
                    url: base_url + 'brand/gerBarcodeByBrand',
                    data: {brand:brand},
                    dataType: 'JSON',
                    success: function(response){
                        
                        // console.log(response);
                        $.each(response, function(bkey, value){
                                
                            $('#ssku1').multiselect('select', value.sku_code);
                            $('#slocation').multiselect('select', value.loc);
                            
                            var sku_code = value.sku_code;
                            $.ajax({
                   
                                method: 'POST',
                                url: base_url + 'sku/getDataBySkuID',
                                data: {sku:sku_code},
                                dataType: 'JSON',
                                success: function(response){
                                    
                                    $('#spcat1').multiselect('select', response.category_id);
                                    $('#spsubcat1').multiselect('select', response.subcategory_id);
                                    
                                    $.ajax({
                   
                                        method: 'POST',
                                        url: base_url + 'product_category/fetchCatDataById',
                                        data: {id:response.category_id},
                                        dataType: 'JSON',
                                        success: function(responseCat){
                                            
                                            $('#sdivision').multiselect('select', responseCat.division_id); 
                                        }
                                    });
                                }
                            });
                            
                        });
                        
                    }
               });
               
            });
            
        });
        
    // });
    
</script>

