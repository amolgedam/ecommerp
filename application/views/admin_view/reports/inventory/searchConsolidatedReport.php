<!--< ?php echo $from." ".$to; echo "<pre>"; print_r($productCat); exit; ?>-->

<?php
  $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
  
    $topTotInwards = $topTotOutwards = $topTotBal = 0;
    
    foreach($productCat as $rows){
    
        $skuData = $this->model_sku->fecthSkuByCatID($rows->id);
        
        
        $qtytot = $mrptot = $valuetot = $outqtytot = $outmrptot = $outvaluetot = $balqtytot = $balmrptot = $balvaluetot = 0; 
        
    
        foreach($skuData as $skurows){  
            
            $pinvoiceData = $this->model_purchaseitem->fetchOrderDataBySKUid($skurows->id);
            // echo "<pre>"; print_r($pinvoiceData);
            
            $data = array(
                            'sku' => $skurows->id,
                            'from' => $from,
                            'to' => $to
                        );
            
            $barcodeInwardData = $this->model_barcode->fetchInwardItemQtyBySkuBetweenDate($data);
            // echo "<pre>"; print_r($barcodeInwardData);
            
            if($pinvoiceData == '')
            {
                $opData = $this->model_openingitem->fecthDataBySKUid($skurows->id);
                $mrp = $opData['mrp'];
                $value = $barcodeInwardData['qty'] * $mrp;
                // echo "<pre>"; print_r($opData);    
            }
            else
            {
                $mrp = $pinvoiceData['mrp_price'];
                $value = $barcodeInwardData['qty'] * $mrp;
            }
            
            $qtytot = $qtytot + $barcodeInwardData['qty'];
            $mrptot = $mrptot + $mrp;
            $valuetot = $valuetot + $value;
            
            $topTotInwards = $topTotInwards + $valuetot;
            
            // ###########################################
            // ##             Outward Data              ##
            // ###########################################
            
            $barcodeData = $this->model_barcode->fetchSoldItemQtyBySkuBetweenDate($data);
            
            $outQty = $barcodeData['qty'] != '' ? $barcodeData['qty'] : "0";
            
            $outvalue = $mrp * $outQty;
            
            $outqtytot = $outqtytot + $barcodeData['qty'];
            $outmrptot = $outmrptot + $mrp;
            $outvaluetot = $outvaluetot + $outvalue;
            
            $topTotOutwards = $topTotOutwards + $outvaluetot;
            
            // ###########################################
            // ##             Closing Balance           ##
            // ###########################################
            
            $balQty = $barcodeInwardData['qty'] - $barcodeData['qty'];
            
            if($balQty != '')
            {
                $balQty = $balQty;
            }
            else
            {
                $balQty = 0;
            }
            
            $balvalue = $balQty * $mrp;
            
            $balqtytot = $balqtytot + $balQty;
            $balmrptot = $balmrptot + $mrp;
            $balvaluetot = $balvaluetot + $balvalue;
            
            $topTotBal = $topTotBal + $balvaluetot;   
        }
    }
   
//   exit;
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
	</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            <form role="form" action="<?php echo base_url('reports/consolidatedReport'); ?>" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                  
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Date From</label>
                      <input type="date" name="from" value="<?= set_value('from') ?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Date To</label>
                      <input type="date" name="to" value="<?= set_value('to') ?>" class="form-control" required>
                    </div>
                  </div>
                  
                    <!--<div class="col-md-2 col-sm-2 col-xs-12">-->
                    <!--    <div>-->
                    <!--        <label>Location</label>-->
                    <!--        <select name="location" class="form-control">-->
                    <!--            <option value="0">Select Location</option>-->
                    <!--            < ?php foreach($location as $rows){ ?>-->
                    <!--                <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->location_name; ?></option>-->
                    <!--            < ?php } ?>-->
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--</div>-->
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                        <br>
                        <!--<a href="#" class=" btn btn-info">Search</a>-->
                        <input type="submit" name="search" value="Search" class="btn btn-info">
                        &nbsp;&nbsp;
                        <input type="submit" name="print" value="Print" class="btn btn-info">
                    </div>
                    <!--<div>-->
                    <!--    <br>-->
                    <!--    <a href="#" class=" btn btn-info">Print</a>-->
                    <!--</div>-->
                  </div>
                              
              </div>
            </div>
          </div>

        </form>
        
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    
                    <table border="1" width="100%">
                        <tr>
                            <td>
                                <center>
                                    <h4><b><?php echo strtoupper($companyDetails['company_name']); ?></b></h4>
                                    <!-- <h5>Nagpur-Main</h5> -->
                                    <h6><?php echo ucwords($companyDetails['address1']).' '.ucwords($cityData['city_name']).' '.ucwords($companyDetails['pincode']).' '.ucwords($companyDetails['mobile_no']); ?></h6>
                                    <h6>GST No : <?php echo ucwords($companyDetails['gst']); ?>  &  PAN No : <?php echo ucwords($companyDetails['pan']); ?></h6>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    <h5><b>Inventory Report</b></h5>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="1" width="100%">
                                    <tr>
                                        <th style="width: 210px;" rowspan="3">
                                            <center>Particular</center>
                                        </th>
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
                                            <center>Total Inwards : <?php echo $topTotInwards; ?></center>
                                        </td>
                                        <td>
                                            <center>Total OutWards : <?php echo $topTotOutwards; ?></center>
                                        </td>
                                        <td>
                                            <center>Total Balance : <?php echo $topTotBal; ?></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table border="1" width="100%">
                                                <tr>
                                                    <td style="width: 55px;">
                                                        <center>Quantity</center>
                                                    </td>
                                                    <td  style="width: 55px;">
                                                        <center>Average Rate</center>
                                                    </td>
                                                    <td  style="width: 55px;">
                                                        <center>Value</center>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table border="1" width="100%">
                                                <tr>
                                                    <td style="width: 55px;">
                                                        <center>Quantity</center>
                                                    </td>
                                                    <td style="width: 55px;">
                                                        <center>Average Rate</center>
                                                    </td>
                                                    <td style="width: 55px;">
                                                        <center>Value</center>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table border="1" width="100%">
                                                <tr>
                                                    <td style="width: 55px;">
                                                        <center>Quantity</center>
                                                    </td>
                                                    <td style="width: 55px;">
                                                        <center>Average Rate</center>
                                                    </td>
                                                    <td style="width: 55px;">
                                                        <center>Value</center>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <?php foreach($productCat as $rows){ ?>
                                        <tr style="width: 210px;">
                                            <td>
                                                <h4><b><u><center><?php echo $rows->catgory_name; ?></center></u></b></h4>
                                            </td>
                                            <td colspan="8">&nbsp;</td>
                                        </tr>
                                        <?php
                                            $subcat = $this->model_category->fecthSubCatByCatID($rows->id);
                                            // echo "<pre>"; print_r($subcat);
                                        ?>
                                        <tr>
                                            <td><h5><b><center><?php echo $subcat['subcategory_name']; ?></center></b></h5></td>
                                            <td colspan="8">&nbsp;</td>
                                        </tr>
                                        
                                        <?php
                                            $skuData = $this->model_sku->fecthSkuByCatID($rows->id);
                                            // echo "<pre>"; print_r($skuData);
                                        ?>

                                        <?php $qtytot = $mrptot = $valuetot = $outqtytot = $outmrptot = $outvaluetot = $balqtytot = $balmrptot = $balvaluetot = 0; 
                                            
                                            foreach($skuData as $skurows){  
                                        ?>
                                            
                                            <?php
                                                $unit = $this->model_unit->fecthUnitDataByID($skurows->unit_id);
                                                // echo "<pre>"; print_r($unit);
                                                
                                                // ###########################################
                                                // ##             Inward Data               ##
                                                // ###########################################                                               
                                                $pinvoiceData = $this->model_purchaseitem->fetchOrderDataBySKUid($skurows->id);
                                                // echo "<pre>"; print_r($pinvoiceData);
                                                
                                                $data = array(
                                                                'sku' => $skurows->id,
                                                                'from' => $from,
                                                                'to' => $to
                                                            );
                                                
                                                $barcodeInwardData = $this->model_barcode->fetchInwardItemQtyBySkuBetweenDate($data);
                                                // echo "<pre>"; print_r($barcodeInwardData);
                                                
                                                if($pinvoiceData == '')
                                                {
                                                    $opData = $this->model_openingitem->fecthDataBySKUid($skurows->id);
                                                    $mrp = $opData['mrp'];
                                                    $value = $barcodeInwardData['qty'] * $mrp;
                                                    // echo "<pre>"; print_r($opData);    
                                                }
                                                else
                                                {
                                                    $mrp = $pinvoiceData['mrp_price'];
                                                    $value = $barcodeInwardData['qty'] * $mrp;
                                                }
                                                
                                                $qtytot = $qtytot + $barcodeInwardData['qty'];
                                                $mrptot = $mrptot + $mrp;
                                                $valuetot = $valuetot + $value;
                                                
                                                // ###########################################
                                                // ##             Outward Data              ##
                                                // ###########################################
                                                
                                                
                                                
                                                $barcodeData = $this->model_barcode->fetchSoldItemQtyBySkuBetweenDate($data);
                                                
                                                $outQty = $barcodeData['qty'] != '' ? $barcodeData['qty'] : "0";
                                                
                                                $outvalue = $mrp * $outQty;
                                                
                                                $outqtytot = $outqtytot + $barcodeData['qty'];
                                                $outmrptot = $outmrptot + $mrp;
                                                $outvaluetot = $outvaluetot + $outvalue;
                                                // echo "<pre>"; print_r($barcodeData['qty']);
                                                
                                                
                                                // ###########################################
                                                // ##             Closing Balance           ##
                                                // ###########################################
                                                
                                                
                                                $balQty = $barcodeInwardData['qty'] - $barcodeData['qty'];
                                                
                                                if($balQty != '')
                                                {
                                                    $balQty = $balQty;
                                                }
                                                else
                                                {
                                                    $balQty = 0;
                                                }
                                                
                                                $balvalue = $balQty * $mrp;
                                                
                                                $balqtytot = $balqtytot + $balQty;
                                                $balmrptot = $balmrptot + $mrp;
                                                $balvaluetot = $balvaluetot + $balvalue;
                                            ?>
                                        
                                            <tr>
                                                <td>
                                                    <center><?php echo $skurows->product_code; ?></center>
                                                </td>
                                                <td>
                                                    <table border="1" width="100%">
                                                        <tr>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $barcodeInwardData['qty'] != '' ? $barcodeInwardData['qty']." - ".$unit['unit'] : "-"; ?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $mrp != '' ? $mrp : "0"; ?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $value != '' ? $value : "0";?></center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table border="1" width="100%">
                                                        <tr>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $outQty != '0' ? $outQty." - ".$unit['unit'] : "-"; ?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $mrp != '' ? $mrp : "0"; ?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $outvalue != '0' ? $outvalue : "0"; ?></center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table border="1" width="100%">
                                                        <tr>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $balQty; ?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $mrp;?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $balvalue;?></center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            
                                            <tr>
                                                <td>
                                                    <center><b>Total</b></center>
                                                </td>
                                                <td>
                                                    <table border="1" width="100%">
                                                        <tr>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $qtytot; ?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $mrptot;?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $valuetot;?></center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table border="1" width="100%">
                                                        <tr>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $outqtytot; ?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $outmrptot;?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $outvaluetot;?></center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table border="1" width="100%">
                                                        <tr>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $balqtytot; ?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $balmrptot;?></center>
                                                            </td>
                                                            <td style="width: 33%;">
                                                                <center><?php echo $balvaluetot;?></center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            
                                    <?php } ?>
                                    
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
  <!-- /.content-wrapper -->
 <!--  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer> -->

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
