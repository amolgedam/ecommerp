<?php

error_reporting(0);
?>
<!--< ?php echo "<pre>"; print_r($barcodedetails); exit; ?>-->
  <!-- Content Wrapper. Contains page content -->
  <style>
img.barcode {
    border: 1px solid #ccc;
    padding: 20px 10px;
    border-radius: 5px;
}
@media print {
img {
    -webkit-print-color-adjust: exact;
}

}
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product</li>
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
              //echo'<pre>';
              //print_r($barcodedetails);
          //echo'</pre>';
          ?>
    </div>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <br>
             <form method="POST" action="" name="theForm">
            <div style="float:right">
                <select name="width">
                    <option value="170">Select Width</option>
                   <option value="160">160</option>
                    <option value="165">165</option>
                    <option value="170">170</option>
                    <option value="175">175</option>
                    <option value="180">180</option>
                    <option value="185">185</option>
                    <option value="190">190</option>
                    <option value="195">195</option>
                </select>
                <select name="height">
                    <option value="200">Select Height</option>
                    <option value="160">160</option>
                    <option value="165">165</option>
                    <option value="170">170</option>
                    <option value="175">175</option>
                    <option value="180">180</option>
                    <option value="185">185</option>
                    <option value="190">190</option>
                    <option value="195">195</option>
                </select>
                 <select name="frontheight">
                    <option value="4">Select Font Size</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
              <input type="submit" class="btn btn-sm btn-danger" name="generateBarcode"  value="GENERATE BARCODE">
            </div>
           
            <br><br>
            <div class="box-body">
                   
                   <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                    <tr>
                        <th><p>Select <a href="javascript:selectToggle(true, 'theForm');">All</a> | <a href="javascript:selectToggle(false, 'theForm');">None</a><p></th>
                      <th>Barcode Code.</th>
                      <th>SKU Product Details</th>
                      <th>Product Type</th>
                      <th>Product color</th>
                      <th>MRP</th>
                      <th>Product size</th>
                      <th>Gst</th>
                       <th>Product Status</th>
                    </tr>
                  </thead>
                
               
         
                 
                 <?php
                 foreach($barcodedetails as $data){
                     foreach($data as $value){
                     
                 ?>
                   <tbody>

                <th>
                 <input type="checkbox"   value="<?php echo $value[0]  ?>" name="barcodeno[]">
                </th>
                <th><?php echo $value[0]  ?></th> 
                <th> <input type="hidden" value="<?php echo $value[1]  ?>" name="sku[]"><?php echo $value[1]  ?></th> 
                <th><input type="hidden" value="<?php echo $value[8]  ?>" name="style1[]"><input type="hidden" value="<?php echo $value[9]  ?>" name="style2[]"><?php echo $value[8].", ".$value[9];  ?></th> 
                <th><input type="hidden" value="<?php echo $value[6]  ?>" name="color[]"><?php echo $value[6]  ?></th> 
                <th><input type="hidden" value="<?php echo $value[4]  ?>" name="mrp[]"><?php echo $value[4]  ?></th> 
                <th><input type="hidden" value="<?php echo $value[7]  ?>" name="clothsize[]"><?php echo $value[7]  ?></th>
                <th><input type="hidden" value="<?php echo $value[10]  ?>" name="gst[]"><?php echo $value[10]." %";  ?></th> 
                <th><?php echo $value[11]  ?></th> 
                </tbody>
                 <?php
                 }
                 }
                 ?>
            
              </table>
              </div>
              <input type="hidden" name="barcodeSize" id="barcodeSize" value="50">
						<input type="hidden" name="printText" id="printText" value="true">
               </form>  
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
      <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-body"  id="yourdiv">
                  	
                   <?php
                
			if(isset($_POST['generateBarcode'])) {
			    
			    
			   	if( $_POST['barcodeno']) { 
			    
			    $filepath='';
				$barcodeText = $_POST['barcodeno'];
				$barcodeType='code128';
				$barcodeDisplay='horizontal';
				$barcodeSize=$_POST['barcodeSize'];
				$printText=$_POST['printText'];
			$sizefactor=1;
			$sku=$_POST['sku'];
		    	$style1=$_POST['style1'];
		    		$style2=$_POST['style2'];
		    			$color=$_POST['color'];
		    				$mrp=$_POST['mrp'];
		    					$gst=$_POST['gst'];
		    					$clothsize=$_POST['clothsize'];
		    						$width=$_POST['width'];
		    					$height=$_POST['height'];
		    					$frontheight=$_POST['frontheight'];
				if($barcodeText != '') {
					
				
					
					for($t=0;$t<count($barcodeText);$t++){
			
					
	            echo' <img class="barcode" alt="'. $barcodeText[$t] .'" src="'.base_url().'barcodegeneration.php?text='.$barcodeText[$t].'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&sku='.$sku[$t].'&style1='.$style1[$t].'&style2='.$style2[$t].'&clothsize='.$clothsize[$t].'&color='.$color[$t].'&mrp='.$mrp[$t].'&gst='.$gst[$t].'&width='.$width.'&height='.$height.'&frontheight='.$frontheight.'&print='.$printText.'"/>';
			
					}
				} else {
					echo '<div class="alert alert-danger"Select barcode row  to generate barcode!</div>';
				}
			   	} else {
					echo '<div class="alert alert-danger">Select barcode row  to generate barcode!</div>';
				}
				?>
				  
				<?php
			}
		?>
              </div>      
          <br>
					<br>
						<hr>
				 <input type="button" value="Print" class="btn btn-lg btn-danger"  onclick="PrintElem('#yourdiv')" /> 
          </div>      
        </div>
    </div>
    </secrtion>
    
  </div>
  <!-- /.content-wrapper -->

  <div class="control-sidebar-bg"></div>

</div>

<script>
function selectToggle(toggle, form) {
     var myForm = document.forms[form];
     for( var i=0; i < myForm.length; i++ ) { 
          if(toggle) {
               myForm.elements[i].checked = "checked";
          } 
          else {
               myForm.elements[i].checked = "";
          }
     }
}

</script>
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script>  

<script type="text/javascript">
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'new div');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
      var is_chrome = Boolean(mywindow.chrome);
    mywindow.document.write(data);

    if (is_chrome) {
        setTimeout(function () { // wait until all resources loaded 
                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10
                mywindow.print();  // change window to winPrint
                mywindow.close();// change window to winPrint
        }, 250);
    };
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        return true;
    }
</script>
