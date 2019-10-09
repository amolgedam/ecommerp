<!-- Custom Report -->
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
                $count = count($_POST['pcat']);

                for ($i=0; $i < $count; $i++) { 
                        
                    $psubCat = $this->model_category->fecthSubCatByCatID1($_POST['pcat'][$i]);
                    $psubCatData[] = $psubCat; 
                }

                // echo "<pre>"; print_r($psubCatData);

                $countSubCat = count($psubCatData);

                $k=0;

                for ($j=0; $j < $countSubCat; $j++) { 

                  $countRow = count($psubCatData[$j]);

                  foreach ($psubCatData[$j] as $key => $value) {
                        
                      $skuDataResult[] = $this->model_sku->fecthSkuByCatSubcatID($_POST['pcat'][$k], $value['id']);
                    
                  }
                
                  $k++;
                }


                $countSkuResult = count($skuDataResult);

                foreach ($skuDataResult as $key => $value) {
                    
                    for ($i=0; $i < $countSkuResult; $i++) { 
                        
                        // echo "<pre>"; print_r($value[$i]->id);

                        if(empty($_POST['from']) && empty($_POST['to']))
                        {
                            $data = array(
                                            'sku_code' => $value[$i]->id
                                        );

                            $inwardBarcodeData[] = $this->model_barcode->inwardsCustomerReportData($data);
                            $outwardBarcodeData[] = $this->model_barcode->outwardsCustomerReportData($data);
                        }
                    }
                }
            }

            // echo "<pre>"; print_r($inwardBarcodeData);

            // exit();
                  
            $countIn = count($inwardBarcodeData);
            foreach ($inwardBarcodeData as $key => $value) {
                
                for ($i=0; $i < $countIn; $i++) { 

                  echo "<pre>"; print_r($value[$i]['id']);

                  // $qty = $value[$i]['purchase_id'];


                  // $rate = $value[$i]['basic_rate'] * $value[$i]['qty'];
                  // $inwardsTotol = $inwardsTotol + $rate;
                  // $inwardData[] = $value[$i];

                  // $inwardsTotol = $inwardsTotol + $value[$i]['basic_rate'];
                  $qtySum = $qtySum + $value[$i]['qtySum'];
                  $qtyRate = $qtyRate + $value[$i]['basic_rate'];
                  // echo "<pre>"; print_r($value[$i]);
                }
            }

            echo "SUM <br>".$qtySum;
            echo "RATE <br>".$qtyRate;

            echo "Value <br>".$qtySum * $qtyRate;
// qtySum 
            // echo "<pre>"; print_r($inwardData); 
            exit();

            foreach ($outwardBarcodeData as $key => $value) {
                
                // $rate = $value[$i]['basic_rate'] * $value[$i]['balQty'];

                // $balTotal = $outwardsTotol + $rate;
            }

            // echo "In ".$inwardsTotol;
            // echo "<br>Out ".$outwardsTotol;
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
                            <center>Total Inwards : <?php echo number_format($inwardsTotol, 3); ?></center>
                        </td>
                        <td>
                            <center>Total OutWards : <?php echo number_format($inwardsTotol - $balTotal, 3); ?></center>
                        </td>
                        <td>
                            <center>Total Balance : <?php echo number_format($balTotal, 3); ?></center>
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

