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
        Inventory Aging Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory Aging Report</li>
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
            <form role="form" action="<?php echo base_url() ?>reports/agingReport" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                    
                    <input type="hidden" name="agingreport" value="report">
                        
                        
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>Product Category</label>
                            <br>
                            <select class="mymulselect form-control" name="pcat[]" multiple="multiple">
                                <?php foreach($productCat as $rows){ ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->catgory_name; ?></option>
                                <?php } ?>
                            </select>
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
                    
                    <div class="col-md-4 col-sm-4 col-xs-12" style="display: none">
                        <div>
                          <label>Location</label>
                          <br>
                          <select class="mymulselect form-control" name="location[]" multiple="multiple">
                                <?php foreach($location as $rows){ ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->location_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>MRP From</label>
                          <input type="text" name="frommrp" value="<?php echo set_value('frommrp', '0') ?>" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>MRP To</label>
                          <input type="text" name="tomrp" value="<?php echo set_value('tomrp', '0') ?>" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Day From</label>
                          <input type="number" min="0" name="from" value="<?php echo set_value('from', '0') ?>" required class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                          <label>Day To</label>
                          <input type="number" min="0" name="to" value="<?php echo set_value('to', '30') ?>" required class="form-control"/>
                        </div>
                    </div>
                    
                    <!-- <div class="col-md-4 col-sm-4 col-xs-12">-->
                    <!--    <div>-->
                    <!--      <label>&nbsp;</label>-->
                    <!--      <br><br><br>-->
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
                             <!--<option value="1">Select any Option</option>-->
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
                              <!--<option value="1">Select any Option</option>-->
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
                              <!--<option value="1">Select any Option</option>-->
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
                              <!--<option value="1">Select any Option</option>-->
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
                              <!--<option value="1">Select any Option</option>-->
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
                              <!--<option value="1">Select any Option</option>-->
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

                        </div>
                    </div>
                              
              </div>
            </div>
          </div>

        </form>
        
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    
                   
                                <table class="table printMyTable" width="100%" >
                                    <tr>
                                        <th>
                                            <center>Barcode Number</center>
                                        </th>
                                        <th>
                                            <center>SKU</center>
                                        </th>
                                        <th>
                                            <center>Color</center>
                                        </th>
                                        <th>
                                            <center>Size</center>
                                        </th>
                                        <th>
                                            <center>Texture/Pattern</center>
                                        </th>
                                        <th>
                                            <center>Style 1</center>
                                        </th>
                                        <th>
                                            <center>Style 2</center>
                                        </th>
                                        <th>
                                            <center>Type</center>
                                        </th>
                                        <!--<th>-->
                                        <!--    <center>Brand</center>-->
                                        <!--</th>-->
                                        <th>
                                            <center>Quantity</center>
                                        </th>
                                        <th>
                                            <center>MRP</center>
                                        </th>
                                        <th>
                                            <center>Aging</center>
                                        </th>
                                        <!--<th>-->
                                        <!--    <center>Action</center>-->
                                        <!--</th>-->
                                    </tr>
                                    
                                    <!--
                                        for Prooduct Category wise
                                    -->
                                    <?php
                                        if(isset($newcountPcat))
                                        {
                                            // $aging = 0;

                                            // echo "<pre>"; print_r($newPcat); //exit();
                                            
                                            for($i=0; $i<$newcountPcat; $i++)
                                            {
                                                $skuData = $this->model_sku->fecthSkuDataByCatID($newPcat[$i]);
                                                // echo "<pre>"; print_r($skuData); //exit();
                                                foreach($skuData as $rows){
                                                    
                                                    if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                    {
                                                        $data = array(
                                    	                                'sku' => $rows->id,
                                    	                               // 'frommrp' => $newfrommrp,
                                    	                               // 'tommrp' => $newtomrp,
                                    	                                'fromDay' => $newfromDay,
                                    	                                'toDay' => $newtoDay,
                                    	                                'color' => $newcolor,
                                    	                                'size' => $newsize,
                                    	                                'pattern' => $newpattern,
                                    	                                'style1' => $newstype1,
                                    	                                'style2' => $newstyle2,
                                    	                                'type' => $newtype
                                    	                            );
                                    	                $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                    }
                                                    else
                                                    {
                                                        $data = array(
                                    	                                'sku' => $rows->id,
                                    	                                'frommrp' => $newfrommrp,
                                    	                                'tommrp' => $newtomrp,
                                    	                                'fromDay' => $newfromDay,
                                    	                                'toDay' => $newtoDay,
                                    	                                'color' => $newcolor,
                                    	                                'size' => $newsize,
                                    	                                'pattern' => $newpattern,
                                    	                                'style1' => $newstype1,
                                    	                                'style2' => $newstyle2,
                                    	                                'type' => $newtype
                                    	                            );

                                    	                $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                    }
                                                
                                        
                                    ?>     
                                        <?php $no = 1; foreach($barcodeData as $rows){ ?>
                                        
                                            <?php
                                                
                                                $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                
                                                $date1 = date_create($createddate);
                                                $date2 = date_create($newfromDay);
                                                
                                                $diff = date_diff($date1,$date2);

                                                //count days
                                                $aging = $diff->format("%a");
                                                
                                                // echo $date = date('Y-m-d', strtotime($rows['created_date']));
                                                // $date2 = strtotime($newtoDay);
                                                
                                                // $datediff = $date - $date2;

                                                // echo $aging = round($datediff / (60 * 60 * 24));
                                                
                                                /*echo "<br>".$newtoDay;
                                                // $aging = $date - $newtoDay;
                                                $aging = date_diff($date,$newtoDay);
                                                // $aging = date("Y-m-d", strtotime("$date -$newtoDay day"));
                                                
                                                $datediff = (strtotime($date) - strtotime($newtoDay));
                                                echo $aging = floor($datediff / (60 * 60 * 24));
                                                */
                                                $skuData = $this->model_sku->fecthSkuDataByID($rows['sku_code']);
                                                $attrData = $this->model_attribute->fetchBarcodeAttributeData($rows['attr_id']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $rows['barcode']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $skuData['product_code']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['color']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['size']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['pattern']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['style1']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['style2']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['type']; ?></center>
                                                </td>
                                                <!--<th>-->
                                                <!--    <center>Brand</center>-->
                                                <!--</th>-->
                                                <td>
                                                    <center><?php echo $attrData['quantity']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $rows['mrp']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $aging; ?></center>
                                                </td>
                                                <!--<td>-->
                                                <!--    <center>Action</center>-->
                                                <!--</td>-->
                                            </tr>
                                        <?php $no++ ;} ?>
                                    <?php
                                                    // echo "<pre>"; print_r($barcodeData);
                                                }
                                            }
                                        }
                                        // exit();
                                    ?>

                                    <!--
                                        for Prooduct Sub-Category wise
                                    -->
                                    <?php
                                        if(isset($newcountPScat))
                                        {
                                            // $aging = 0;

                                            // echo "<pre>"; print_r($newPcat); //exit();
                                            
                                            for($i=0; $i<$newcountPScat; $i++)
                                            {
                                                $skuData = $this->model_sku->fecthSkuDataBySubCatID($newPScat[$i]);
                                                // echo "<pre>"; print_r($skuData); //exit();
                                                foreach($skuData as $rows){
                                                    
                                                    if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                    {
                                                        $data = array(
                                                                      'sku' => $rows->id,
                                                                     // 'frommrp' => $newfrommrp,
                                                                     // 'tommrp' => $newtomrp,
                                                                      'fromDay' => $newfromDay,
                                                                      'toDay' => $newtoDay,
                                                                      'color' => $newcolor,
                                                                      'size' => $newsize,
                                                                      'pattern' => $newpattern,
                                                                      'style1' => $newstype1,
                                                                      'style2' => $newstyle2,
                                                                      'type' => $newtype
                                                                  );

                                                      $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                    }
                                                    else
                                                    {
                                                        $data = array(
                                                                      'sku' => $rows->id,
                                                                      'frommrp' => $newfrommrp,
                                                                      'tommrp' => $newtomrp,
                                                                      'fromDay' => $newfromDay,
                                                                      'toDay' => $newtoDay,
                                                                      'color' => $newcolor,
                                                                      'size' => $newsize,
                                                                      'pattern' => $newpattern,
                                                                      'style1' => $newstype1,
                                                                      'style2' => $newstyle2,
                                                                      'type' => $newtype
                                                                  );

                                                      $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                    }
                                                
                                        
                                    ?>     
                                        <?php $no = 1; foreach($barcodeData as $rows){ ?>
                                        
                                            <?php
                                                
                                                $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                
                                                $date1 = date_create($createddate);
                                                $date2 = date_create($newfromDay);
                                                
                                                $diff = date_diff($date1,$date2);

                                                //count days
                                                $aging = $diff->format("%a");
                                                
                                                // echo $date = date('Y-m-d', strtotime($rows['created_date']));
                                                // $date2 = strtotime($newtoDay);
                                                
                                                // $datediff = $date - $date2;

                                                // echo $aging = round($datediff / (60 * 60 * 24));
                                                
                                                /*echo "<br>".$newtoDay;
                                                // $aging = $date - $newtoDay;
                                                $aging = date_diff($date,$newtoDay);
                                                // $aging = date("Y-m-d", strtotime("$date -$newtoDay day"));
                                                
                                                $datediff = (strtotime($date) - strtotime($newtoDay));
                                                echo $aging = floor($datediff / (60 * 60 * 24));
                                                */

                                                $skuData = $this->model_sku->fecthSkuDataByID($rows['sku_code']);
                                                $attrData = $this->model_attribute->fetchBarcodeAttributeData($rows['attr_id']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $rows['barcode']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $skuData['product_code']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['color']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['size']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['pattern']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['style1']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['style2']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['type']; ?></center>
                                                </td>
                                                <!--<th>-->
                                                <!--    <center>Brand</center>-->
                                                <!--</th>-->
                                                <td>
                                                    <center><?php echo $attrData['quantity']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $rows['mrp']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $aging; ?></center>
                                                </td>
                                                <!--<td>-->
                                                <!--    <center>Action</center>-->
                                                <!--</td>-->
                                            </tr>
                                        <?php $no++ ;} ?>
                                    <?php
                                                    // echo "<pre>"; print_r($barcodeData);
                                                }
                                            }
                                        }
                                        // exit();
                                    ?>



                                    <!--
                                        for Prooduct Category And Sub Category wise
                                    -->
                                    <?php
                                        if(isset($newcountPandScat))
                                        {
                                            // $aging = 0;

                                            // echo "<pre>"; print_r($newPcat); //exit();
                                            
                                            for($i=0; $i<$newcountPandScat; $i++)
                                            {

                                                $subCatData = $this->model_category->fecthSubCatByCatID($newPandScat[$i]);

                                                $skuData = $this->model_sku->fecthSkuDataBySubCatID($subCatData['id']);


                                                foreach($skuData as $rows){
                                                    
                                                    if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                    {
                                                        $data = array(
                                                                      'sku' => $rows->id,
                                                                     // 'frommrp' => $newfrommrp,
                                                                     // 'tommrp' => $newtomrp,
                                                                      'fromDay' => $newfromDay,
                                                                      'toDay' => $newtoDay,
                                                                      'color' => $newcolor,
                                                                      'size' => $newsize,
                                                                      'pattern' => $newpattern,
                                                                      'style1' => $newstype1,
                                                                      'style2' => $newstyle2,
                                                                      'type' => $newtype
                                                                  );

                                                      $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                    }
                                                    else
                                                    {
                                                        $data = array(
                                                                      'sku' => $rows->id,
                                                                      'frommrp' => $newfrommrp,
                                                                      'tommrp' => $newtomrp,
                                                                      'fromDay' => $newfromDay,
                                                                      'toDay' => $newtoDay,
                                                                      'color' => $newcolor,
                                                                      'size' => $newsize,
                                                                      'pattern' => $newpattern,
                                                                      'style1' => $newstype1,
                                                                      'style2' => $newstyle2,
                                                                      'type' => $newtype
                                                                  );

                                                      $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                    }
                                                
                                        
                                    ?>     
                                        <?php $no = 1; foreach($barcodeData as $rows){ ?>
                                        
                                            <?php
                                                
                                                $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                
                                                $date1 = date_create($createddate);
                                                $date2 = date_create($newfromDay);
                                                
                                                $diff = date_diff($date1,$date2);

                                                //count days
                                                $aging = $diff->format("%a");
                                                
                                                // echo $date = date('Y-m-d', strtotime($rows['created_date']));
                                                // $date2 = strtotime($newtoDay);
                                                
                                                // $datediff = $date - $date2;

                                                // echo $aging = round($datediff / (60 * 60 * 24));
                                                
                                                /*echo "<br>".$newtoDay;
                                                // $aging = $date - $newtoDay;
                                                $aging = date_diff($date,$newtoDay);
                                                // $aging = date("Y-m-d", strtotime("$date -$newtoDay day"));
                                                
                                                $datediff = (strtotime($date) - strtotime($newtoDay));
                                                echo $aging = floor($datediff / (60 * 60 * 24));
                                                */

                                                $skuData = $this->model_sku->fecthSkuDataByID($rows['sku_code']);
                                                $attrData = $this->model_attribute->fetchBarcodeAttributeData($rows['attr_id']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $rows['barcode']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $skuData['product_code']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['color']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['size']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['pattern']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['style1']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['style2']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $attrData['type']; ?></center>
                                                </td>
                                                <!--<th>-->
                                                <!--    <center>Brand</center>-->
                                                <!--</th>-->
                                                <td>
                                                    <center><?php echo $attrData['quantity']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $rows['mrp']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?php echo $aging; ?></center>
                                                </td>
                                                <!--<td>-->
                                                <!--    <center>Action</center>-->
                                                <!--</td>-->
                                            </tr>
                                        <?php $no++ ;} ?>
                                    <?php
                                                    // echo "<pre>"; print_r($barcodeData);
                                                }
                                            }
                                        }
                                        // exit();
                                    ?>







                                    
                                    <!--
                                        for SKU wise
                                    -->
                                    
                                    <?php
                                    
                                        if(isset($countSKU))
                                        {
                                                
                                            for($i=0; $i<$countSKU; $i++)
                                            {
                                                $skuData = $this->model_sku->fecthSkuDataByID($newsku[$i]);
                                                
                                                if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                {
                                                    $data = array(
                                	                                'sku' => $skuData['id'],
                                	                               // 'frommrp' => $newfrommrp,
                                	                               // 'tommrp' => $newtomrp,
                                	                                'fromDay' => $newfromDay,
                                	                                'toDay' => $newtoDay,
                                	                                'color' => $newcolor,
                                	                                'size' => $newsize,
                                	                                'pattern' => $newpattern,
                                	                                'style1' => $newstype1,
                                	                                'style2' => $newstyle2,
                                	                                'type' => $newtype
                                	                            );
                                        	                         
                                                        // echo "<pre>"; print_r($data);

                                        	        $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                }
                                                else
                                                {
                                                    $data = array(
                                	                                'sku' => $skuData['id'],
                                	                                'frommrp' => $newfrommrp,
                                	                                'tommrp' => $newtomrp,
                                	                                'fromDay' => $newfromDay,
                                	                                'toDay' => $newtoDay,
                                	                                'color' => $newcolor,
                                	                                'size' => $newsize,
                                	                                'pattern' => $newpattern,
                                	                                'style1' => $newstype1,
                                	                                'style2' => $newstyle2,
                                	                                'type' => $newtype
                                	                            );
                                        	       
                                        	        $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                }
                                        ?>
                                                <?php $no = 1; foreach($barcodeData as $rows){ ?>
                                            
                                                <?php
                                                    
                                                    $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                    
                                                    $date1 = date_create($createddate);
                                                    $date2 = date_create($newfromDay);
                                                    
                                                    $diff = date_diff($date1,$date2);
    
                                                    //count days
                                                    $aging = $diff->format("%a");
                                                    
                                                    // echo $date = date('Y-m-d', strtotime($rows['created_date']));
                                                    // $date2 = strtotime($newtoDay);
                                                    
                                                    // $datediff = $date - $date2;
    
                                                    // echo $aging = round($datediff / (60 * 60 * 24));
                                                    
                                                    /*echo "<br>".$newtoDay;
                                                    // $aging = $date - $newtoDay;
                                                    $aging = date_diff($date,$newtoDay);
                                                    // $aging = date("Y-m-d", strtotime("$date -$newtoDay day"));
                                                    
                                                    $datediff = (strtotime($date) - strtotime($newtoDay));
                                                    echo $aging = floor($datediff / (60 * 60 * 24));
                                                    */

                                                    // echo $rows['sku_code'];

                                                    $skuData = $this->model_sku->fecthSkuDataByID($rows['sku_code']);

                                                    // echo "<pre>"; print_r($skuData);

                                                    $attrData = $this->model_attribute->fetchBarcodeAttributeData($rows['attr_id']);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $rows['barcode']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $skuData['product_code']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['color']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['size']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['pattern']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['style1']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['style2']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['type']; ?></center>
                                                    </td>
                                                    <!--<th>-->
                                                    <!--    <center>Brand</center>-->
                                                    <!--</th>-->
                                                    <td>
                                                        <center><?php echo $attrData['quantity']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $rows['mrp']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $aging; ?></center>
                                                    </td>
                                                    <!--<td>-->
                                                    <!--    <center>Action</center>-->
                                                    <!--</td>-->
                                                </tr>
                                            <?php $no++ ;} ?>
                                                
                                    <?php
                                            }    
                                        }
                                    ?>
                                    
                                     <!--
                                        for Brand wise
                                    -->
                                    <?php
                                        
                                        if(isset($countBrand))
                                        {
                                            // echo "<pre>"; print_r($newbrand); exit();
                                            for($i=0; $i<$countBrand; $i++)
                                            {
                                                $skuData = $this->model_sku->fecthSkuDataByBrandID($newbrand[$i]);
                                                
                                                foreach($skuData as $rows){
                                                
                                                    if($_POST['frommrp'] == '' AND $_POST['tomrp'] == '')
                                                    {
                                                        $data = array(
                                	                                'sku' => $rows->id,
                                	                               // 'frommrp' => $newfrommrp,
                                	                               // 'tommrp' => $newtomrp,
                                	                                'fromDay' => $newfromDay,
                                	                                'toDay' => $newtoDay,
                                	                                'color' => $newcolor,
                                	                                'size' => $newsize,
                                	                                'pattern' => $newpattern,
                                	                                'style1' => $newstype1,
                                	                                'style2' => $newstyle2,
                                	                                'type' => $newtype
                                	                            );
                                        	                            
                                        	            $barcodeData = $this->model_barcode->fetchItemDataBySkuCode($data);
                                                        
                                                    }
                                                    else
                                                    {
                                                        $data = array(
                                	                                'sku' => $rows->id,
                                	                                'frommrp' => $newfrommrp,
                                	                                'tommrp' => $newtomrp,
                                	                                'fromDay' => $newfromDay,
                                	                                'toDay' => $newtoDay,
                                	                                'color' => $newcolor,
                                	                                'size' => $newsize,
                                	                                'pattern' => $newpattern,
                                	                                'style1' => $newstype1,
                                	                                'style2' => $newstyle2,
                                	                                'type' => $newtype
                                	                            );
                                        	       
                                            	        $barcodeData = $this->model_barcode->fetchItemDataBySkuCode1($data);
                                                    }
                                    ?>
                                                    <?php $no = 1; foreach($barcodeData as $rows){ ?>
                                            
                                                <?php
                                                    
                                                    $createddate = date('Y-m-d', strtotime($rows['created_date']));
                                                    
                                                    $date1 = date_create($createddate);
                                                    $date2 = date_create($newfromDay);
                                                    
                                                    $diff = date_diff($date1,$date2);
    
                                                    //count days
                                                    $aging = $diff->format("%a");
                                                    
                                                    // echo $date = date('Y-m-d', strtotime($rows['created_date']));
                                                    // $date2 = strtotime($newtoDay);
                                                    
                                                    // $datediff = $date - $date2;
    
                                                    // echo $aging = round($datediff / (60 * 60 * 24));
                                                    
                                                    /*echo "<br>".$newtoDay;
                                                    // $aging = $date - $newtoDay;
                                                    $aging = date_diff($date,$newtoDay);
                                                    // $aging = date("Y-m-d", strtotime("$date -$newtoDay day"));
                                                    
                                                    $datediff = (strtotime($date) - strtotime($newtoDay));
                                                    echo $aging = floor($datediff / (60 * 60 * 24));
                                                    */

                                                    $skuData = $this->model_sku->fecthSkuDataByID($rows['sku_code']);

                                                    // echo "<pre>"; print_r($skuData);

                                                    $attrData = $this->model_attribute->fetchBarcodeAttributeData($rows['attr_id']);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $rows['barcode']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $skuData['product_code']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['color']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['size']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['pattern']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['style1']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['style2']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $attrData['type']; ?></center>
                                                    </td>
                                                    <!--<th>-->
                                                    <!--    <center>Brand</center>-->
                                                    <!--</th>-->
                                                    <td>
                                                        <center><?php echo $attrData['quantity']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $rows['mrp']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?php echo $aging; ?></center>
                                                    </td>
                                                    <!--<td>-->
                                                    <!--    <center>Action</center>-->
                                                    <!--</td>-->
                                                </tr>
                                            <?php $no++ ;} ?>
                                                    
                                                    
                                                    
                                    
                                    <?php
                                                    // echo "<pre>"; print_r($barcodeData);
                                                }
                                            }
                                        }
                                    ?>
                                    
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" rel="stylesheet"/>

</div>


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





