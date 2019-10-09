<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Barcode extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('user_agent');

		$this->not_logged_in();
		
		// error_reporting(0);

        ini_set('max_execution_time', 600);
        
		$this->data['page_title'] = 'Purchase Order';
		
		$this->load->model('model_purchaseinvoice');
		$this->load->model('model_purchaseitem');
		
		$this->load->model('model_openingstock');
		$this->load->model('model_openingitem');
		
		$this->load->model('model_barcode');

        $this->load->model('Model_purchaseitem');
        $this->load->model('model_purchasereturn');
        
        $this->load->model('Model_openingitem');

        $this->load->model('model_sku');
        $this->load->model('model_unit');
        $this->load->model('model_gst');

        $this->load->model('model_internaltransfer');
        $this->load->model('model_internalconsumption');

        
        $this->load->model('model_attribute');
        $this->load->model('model_company');
        $this->load->model('model_category');
        
        $this->load->model('model_brand');
        $this->load->model('model_hsn');
        $this->load->model('model_location');
        $this->load->model('model_discount');
	}
public 	function barcodeprint2( $filepath="", $text="0", $size="20", $orientation="horizontal", $code_type="code128", $print=false, $SizeFactor=1 ) {
    
    
    
	$code_string = "";
	// Translate the $text into barcode the correct $code_type
	if ( in_array(strtolower($code_type), array("code128", "code128b")) ) {
		$chksum = 104;
		// Must not change order of array elements as the checksum depends on the array's key to validate final code
		$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
		$code_keys = array_keys($code_array);
		$code_values = array_flip($code_keys);
		for ( $X = 1; $X <= strlen($text); $X++ ) {
			$activeKey = substr( $text, ($X-1), 1);
			$code_string .= $code_array[$activeKey];
			$chksum=($chksum + ($code_values[$activeKey] * $X));
		}
		$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

		$code_string = "211214" . $code_string . "2331112";
	} elseif ( strtolower($code_type) == "code128a" ) {
		$chksum = 103;
		$text = strtoupper($text); // Code 128A doesn't support lower case
		// Must not change order of array elements as the checksum depends on the array's key to validate final code
		$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","NUL"=>"111422","SOH"=>"121124","STX"=>"121421","ETX"=>"141122","EOT"=>"141221","ENQ"=>"112214","ACK"=>"112412","BEL"=>"122114","BS"=>"122411","HT"=>"142112","LF"=>"142211","VT"=>"241211","FF"=>"221114","CR"=>"413111","SO"=>"241112","SI"=>"134111","DLE"=>"111242","DC1"=>"121142","DC2"=>"121241","DC3"=>"114212","DC4"=>"124112","NAK"=>"124211","SYN"=>"411212","ETB"=>"421112","CAN"=>"421211","EM"=>"212141","SUB"=>"214121","ESC"=>"412121","FS"=>"111143","GS"=>"111341","RS"=>"131141","US"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","CODE B"=>"114131","FNC 4"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
		$code_keys = array_keys($code_array);
		$code_values = array_flip($code_keys);
		for ( $X = 1; $X <= strlen($text); $X++ ) {
			$activeKey = substr( $text, ($X-1), 1);
			$code_string .= $code_array[$activeKey];
			$chksum=($chksum + ($code_values[$activeKey] * $X));
		}
		$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

		$code_string = "211412" . $code_string . "2331112";
	} elseif ( strtolower($code_type) == "code39" ) {
		$code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");

		// Convert to uppercase
		$upper_text = strtoupper($text);

		for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			$code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
		}

		$code_string = "1211212111" . $code_string . "121121211";
	} elseif ( strtolower($code_type) == "code25" ) {
		$code_array1 = array("1","2","3","4","5","6","7","8","9","0");
		$code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");

		for ( $X = 1; $X <= strlen($text); $X++ ) {
			for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
				if ( substr($text, ($X-1), 1) == $code_array1[$Y] )
					$temp[$X] = $code_array2[$Y];
			}
		}

		for ( $X=1; $X<=strlen($text); $X+=2 ) {
			if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
				$temp1 = explode( "-", $temp[$X] );
				$temp2 = explode( "-", $temp[($X + 1)] );
				for ( $Y = 0; $Y < count($temp1); $Y++ )
					$code_string .= $temp1[$Y] . $temp2[$Y];
			}
		}

		$code_string = "1111" . $code_string . "311";
	} elseif ( strtolower($code_type) == "codabar" ) {
		$code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
		$code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");

		// Convert to uppercase
		$upper_text = strtoupper($text);

		for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
				if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
					$code_string .= $code_array2[$Y] . "1";
			}
		}
		$code_string = "11221211" . $code_string . "1122121";
	}

	// Pad the edges of the barcode
	$code_length = 20;
	if ($print) {
		$text_height = 30;
	} else {
		$text_height = 0;
	}
	
	for ( $i=1; $i <= strlen($code_string); $i++ ){
		$code_length = $code_length + (integer)(substr($code_string,($i-1),1));
        }

	if ( strtolower($orientation) == "horizontal" ) {
		$img_width = $code_length*$SizeFactor;
		$img_height = $size;
	} else {
		$img_width = $size;
		$img_height = $code_length*$SizeFactor;
	}

	$image = imagecreate($img_width, $img_height + $text_height);
	$black = imagecolorallocate ($image, 0, 0, 0);
	$white = imagecolorallocate ($image, 255, 255, 255);

	imagefill( $image, 0, 0, $white );
	if ( $print ) {
		imagestring($image, 5, 31, $img_height, $text, $black );
	}

	$location = 10;
	for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
		$cur_size = $location + ( substr($code_string, ($position-1), 1) );
		if ( strtolower($orientation) == "horizontal" )
			imagefilledrectangle( $image, $location*$SizeFactor, 0, $cur_size*$SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black) );
		else
			imagefilledrectangle( $image, 0, $location*$SizeFactor, $img_width, $cur_size*$SizeFactor, ($position % 2 == 0 ? $white : $black) );
		$location = $cur_size;
	}
	
	// Draw barcode to the screen or save in a file
	if ( $filepath=="" ) {
		header ('Content-type: image/png');
		imagepng($image);
		imagedestroy($image);
	} else {
		imagepng($image,$filepath);
		imagedestroy($image);		
	}
}

    public function getAttrubuteDataByBarcode()
    {
        $barcode = $_POST['barcode'];
        // $barcode = '0000009286'; 
        $data = array();
        $barcodeData = $this->model_barcode->fetchAllDataByBarcode($barcode);
        $data1 = $this->model_barcode->fetchAllDataByBarcode($barcode);

        $data2 = $this->model_sku->fecthSkuDataByID($barcodeData['sku_code']);


        // echo "<pre>"; print_r($data2); exit();
        // echo "<pre>"; print_r($barcodeData); exit();
        // echo "<pre>"; print_r($data1); exit();
        $data[] = $data1;

        $data[] = $this->model_gst->fetchAllDataByID($barcodeData['gst_id']);            
        $data[] = $data2;

        
        // if($data1['purchase_type'] == 'production')
        // {   
        //     $data = array(
        //                     'order_id' => $barcodeData['purchase_id'],
        //                     'ordertype' => $barcodeData['purchase_type']
        //                 );

        //     $productData = $this->model_openingitem->fecthOrderDataByIdType($data);
        //     $data[] = $this->model_gst->fetchAllDataByID($productData['gst']);            
        // }
        // if($data1['purchase_type'] == 'internaltransfer')
        // {   
        //     // echo "<pre>"; print_r($data);
        //     $productData = $this->model_internalconsumption->fecthDataByID($barcodeData['product_id']); 
        //     // echo "internaltransfer<pre>"; print_r($productData);
            
        //     // echo "GST ID<pre>"; echo $productData['gst'];

        //     $data[] = $this->model_gst->fetchAllDataByID($productData['gst']);            
        // }
        // else if($data1['purchase_type'] != 'popeningstock')
        // {
        //     // echo "popeningstock";

        //     $productData = $this->Model_purchaseitem->fecthAllDataByID($barcodeData['product_id']);
        //     $data[] = $this->model_gst->fetchAllDataByID($productData['gst_id']);            
        // }
        // else
        // {
        //     // echo "pinvoice";

        //     $productData = $this->Model_openingitem->fecthAllDataByOrderID($data1['purchase_id']);
        //     $data[] = $this->model_gst->fetchAllDataByID($productData['gst']);       
        // }


        echo json_encode($data);
        // echo "<pre>"; print_r($data);
        // echo "<pre>"; print_r($productData);
    }

    public function getWspBySKU($value='')
    {
        // $productName = $_POST['product'];
        $productSku = $_POST['sku'];
        // $productName = 'product1';
        // $productSku = '0001';

        $data = $this->model_barcode->getProductData($productSku);
        // echo "<pre>"; print_r($data); exit();

        // $data = $this->model_barcode->fetchDataBySkuCode($productSku);
        // echo "<pre>"; print_r($data); //exit();
        foreach ($data as $key => $value) {
            
            $productData = $this->model_purchasereturn->purchaseReturnData($value['invoice_id']);
            // echo "<pre>"; print_r($productData);
            $purchaseOrderData = $this->Model_purchaseitem->fecthAllDataByID($value['product_id']);


            $result['data'][$key] = array(
                                        'barcode' => $value['barcode'],
                                        'sku' => $value['sku_code'],
                                        'mrp' => $purchaseOrderData['wsp_price'],
                                        'color' => $productData['color'],
                                        'size' => $productData['size'],
                                        'pattern' => $productData['pattern'],
                                        'style1' => $productData['style1'],
                                        'style2' => $productData['style2'],
                                        'type' => $productData['type']
                                   );                      
        }

        // exit();
        echo "<pre>"; print_r($result);
        // echo json_encode($result);
    }

    public function getBarcodesBySKU()
    {
        // $sku = '0002';
        // $from_location = '2';

        $sku = $_POST['sku'];
        $from_location = $_POST['from_location'];

        if($from_location == 0)
        {
            $data = $this->model_barcode->fetchItemBySkuCode($sku);
        }
        else
        {
            $data = $this->model_barcode->fetchItemBySkuCodeLocation($sku, $from_location);
        }
        // echo "<pre>"; print_r($data);
        echo json_encode($data);
    }

    public function fetchAllData()
    {
        $sku = $this->model_barcode->fetchSKUGroupData();
        // echo "<pre>"; print_r($sku); exit;

        if(empty($sku))
        {
            $result['data'] = '';
        }
        else
        {
            $no=1;
            // $pqty = 0;
            // $aqty = 0;

            foreach ($sku as $key => $value) {

                $buttons = '';
                
                $buttons .= '&nbsp; <a href="'.base_url().'barcode/details/'.$value['sku_code'].'" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Details</a>';
                
                $buttons .= '&nbsp; <a href="'.base_url().'barcode/barcodeprint/'.$value['sku_code'].'" class="btn btn-sm btn-danger"><i class="fa fa-barcode"></i>Print-barcode</a>';

                $skuData = $this->model_sku->fecthDataBySKUID($value['sku_code']);
                // echo "<pre>"; print_r($skuData);

                $pqty = $this->model_barcode->sum_purchaseQty($skuData['id']);
                // echo "<pre>"; print_r($pqty);
 
                $aqty = $this->model_barcode->sum_availableQty($skuData['id']);
                // echo "<pre>"; print_r($aqty);
                // $skuData = $this->model_sku->fecthSkuDataBySKU($value['sku_code']);
                // // echo "<pre>"; print_r($skuData);

                // $unit = $this->model_unit->fecthUnitDataByID($skuData['unit_id']);
                // // echo "<pre>"; print_r($unit); //exit();

                // $barcodeData = $this->model_barcode->findQty($value['sku_code']);

                $result['data'][$key] = array(
                                                $no,
                                                $skuData['product_code'],
                                                // $pqty['qty'],
                                                count($pqty),
                                                // $aqty['qty'],
                                                count($aqty),
                                                $buttons
                                            );
                $no++;
            }
        }

        // echo "<pre>"; print_r($result); exit();
        echo json_encode($result);
        exit();
    }

    public function index()
    {
        $this->render_template('admin_view/productMaster/product/index', $this->data);
    }

    public function details()
    {
        // $id = $this->uri->segment(3);
        // echo $id; exit();
        $this->data['sku_code'] = $this->uri->segment(3);

        $this->render_template('admin_view/productMaster/product/details', $this->data);
    }
     public function barcodeprint()
    {
        // $id = $this->uri->segment(3);
        // echo $id; exit();
        $dataargument= $this->uri->segment(3);
        $data['barcodedetails']=$this->fetchProductDetails2($dataargument);
        $this->render_template('admin_view/productMaster/product/barcodeprint',$data);
    }
     public function fetchProductDetails2($data)
    {
        $sku_code = $data;
        // $sku_code = '0001';

        // $sku_code = $this->uri->segment(3);

        $itemData = $this->model_barcode->fetchDataBySkuCode($sku_code);
        
        // echo "<pre>"; print_r($itemData);exit();
        $no=1;
        foreach ($itemData as $key => $value)
        {
            if($value['purchase_type'] == 'popeningstock')
            {
                // echo "opening_stock <br>";
                $orderData = $this->model_openingitem->fecthAllDataByID($value['product_id']);
                $gst = $orderData['gst'];
                 
                $barcodeData = $this->model_barcode->fetchAllDataByBarcode($value['barcode']);
                
                // $data = array(
                //                 'order_id' => $orderData['order_id'],
                //                 'order_code' => $orderData['order_code'],
                //                 'inventory_type' => $orderData['inventory_type'],
                                
                //             );
                            
                $attributes = $this->model_attribute->fetchBarcodeAttributeData($barcodeData['attr_id']);
                
                $invoiceData = $this->model_openingstock->fecthAllDataByID($orderData['order_id']);
                $base_price = $orderData['base_price'];
                $wsp_price = $orderData['wspp'];

                $invoiceno = $invoiceData['opening_no'];
            }
            else if($value['purchase_type'] == 'pinvoice')
            {
                // echo "invoice <br>";

                $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                $gst = $orderData['gst_id'];
                
                $barcodeData = $this->model_barcode->fetchAllDataByBarcode($value['barcode']);
                
                // $data = array(
                //                 'order_id' => $orderData['order_id'],
                //                 'order_code' => $orderData['order_code'],
                //                 'inventory_type' => $orderData['ordertype'],
                //             );
                            
                $attributes = $this->model_attribute->fetchBarcodeAttributeData($barcodeData['attr_id']);
                            
                $invoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($orderData['order_id']);
                $base_price = $orderData['base_price'];
                $wsp_price = $orderData['wsp_price'];

                $invoiceno = $invoiceData['invoice_no'];
            }
            
            
            
            // exit;
            $result['data'][$key] = array(
                                            $value['barcode'],
                                            $value['sku_code'],
                                            $invoiceno,
                                            $base_price,
                                            $value['mrp'],
                                            $value['qty'],
                                            $attributes['color'],
                                            $attributes['size'],
                                            $attributes['style1'],
                                            $attributes['style2'],
                                            $gst,
                                            $value['item_status']
                                        );                     
            $no++; 
            
            // echo "<pre>"; print_r($attributes);
        }
            // exit;
         return $result;
    }
    public function fetchProductDetails()
    {
        $sku_code = $_POST['sku_code'];
        // $sku_code = '5996';

        // $skuData = $this->model_sku->fecthSkuDataBySKU($sku_code);
        // echo "<pre>"; print_r($skuData); exit();
        // $sku_code = $this->uri->segment(3);

        $itemData = $this->model_barcode->fetchBarcodeDataBySkuCode($sku_code);
        
        // echo "<pre>"; print_r($itemData);exit();
        $no=1;
        foreach ($itemData as $key => $value)
        {
            if($value['purchase_type'] == 'opening_stock')
            {
                // echo "opening_stock <br>";
                $orderData = $this->model_openingitem->fecthAllDataByID($value['product_id']);
                $invoiceData = $this->model_openingstock->fecthAllDataByID($orderData['order_id']);
                $base_price = $orderData['base_price'];
                $wsp_price = $orderData['wspp'];

                $invoiceno = $invoiceData['opening_no'];
            }
            else if($value['purchase_type'] == 'pinvoice')
            {
                // echo "invoice <br>";

                $orderData = $this->model_purchaseitem->fecthAllDataByID($value['product_id']);
                $invoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($orderData['order_id']);
                $base_price = $orderData['base_price'];
                $wsp_price = $orderData['wsp_price'];

                $invoiceno = $invoiceData['invoice_no'];
            }
            else if($value['purchase_type'] == 'internaltransfer')
            {
                $orderData = $this->model_internaltransfer->fecthAllDataByID($value['purchase_id']); 

                // echo "<pre>"; print_r($orderData);  
                $invoiceno = $orderData['inventory_no'];
            }

            $skuData = $this->model_sku->fecthDataBySKUID($value['sku_code']);

            $result['data'][$key] = array(
                                            $value['barcode'],
                                            $skuData['product_code'],
                                            $invoiceno,
                                            $value['pur_netprice'],
                                            $value['mrp'],
                                            $value['qty'],
                                            $value['item_status']
                                        );                     
            $no++; 
        }

        // echo "<pre>"; print_r($result);
        echo json_encode($result);
        // exit();
    }
	
	public function purchase_invoice()
	{
	    $id = $this->uri->segment(3);
	    // echo $id; exit(); //    purchase order id
	    $itemData = $this->model_purchaseitem->fecthAllDataByInvoiceID($id);

        $data = array(
                        'order_id' => $id,
                        'order_name' => 'pinvoice'
                    );
        // echo "<pre>"; print_r($data); exit();

        $itemData = $this->model_purchaseitem->fetchItemByOrderIdName($data);
        // echo "<pre>"; print_r($itemData); exit();
 
        $sumQty = 0;
        foreach ($itemData as $key => $value) {

            $sumQty = $sumQty + $value['quantity'];
        }
        // echo $sumQty; exit();

        $dataForOrder = array(
                                'order_id' => $id,
                                'ordertype' => 'pinvoice'
                        );

        $orderData = $this->model_purchaseitem->fecthOrderByInvoiceIDType($dataForOrder);
        // echo "<pre>"; print_r($orderData); exit();

        foreach ($orderData as $key => $value) {
            
            $skuData = $this->model_sku->fecthSkuDataByID($value['sku_id']);
            // echo "<pre>"; print_r($skuData);

            $data = array(
                        'purchase_id' => $value['order_id'],  // opening stock id
                        'sku_code' => $skuData['product_code'],
                        'purchase_type' => 'pinvoice',
                        'purchase_qty' => $value['quantity'],
                        'available_qty' => $value['quantity'],
                        'company_id' => $this->session->userdata('wo_company'),
                        // 'city_id' => $this->session->userdata('wo_city'),
                        'store_id' => $value['store_id'],
                        'created_by' => $this->session->userdata('wo_id')
                    );
            // echo "<pre>"; print_r($data); //exit();
            $created_id = 1;
            // $created_id = $this->model_barcode->createStock($data);
        }

        // exit();
        if($created_id)
        {
            foreach ($itemData as $key => $rows) {

                // echo "<pre>"; print_r($rows);
                // echo "not Pieces <br>";
                $barcode = $this->model_barcode->lastrecord();

                if($barcode == '')
                {
                    $barcode  = '0000000001';
                   // $code = '0000001';
                }
                else
                {
                    $np = $barcode['barcode'];
                    $code = substr($np, 1); 
                    
                    $code = $code + 1;
                    $barcode = sprintf('%010d',$code);
                    
                    // $this->data['barcode'] = $code;
                }

                $data = array(
                    'order_id' => $id,
                    'ordertype' => 'pinvoice',
                    'order_code' => $rows['order_code']
                );

                // echo "<pre>"; print_r($data);
                $orderData = $this->model_purchaseitem->fetchStckoItemDataByOrderIdTypeCode($data);
                // echo "<pre>"; print_r($orderData); //exit();

                $skuData = $this->model_sku->fecthSkuDataByID($orderData['sku_id']);
                // echo "<pre>"; print_r($skuData); //exit();

                $barcodeData = $this->model_barcode->fetchDataByPurchase_id($orderData['order_id']);
                // echo "<pre>"; print_r($barcodeData); //exit();

                $unit = $this->model_unit->fetchByUnitCatID($orderData['unit_id']);
                // echo "<pre>"; print_r($unit);
                
                $data = array(
                                'itemstock_id' => $created_id,
                                'attr_id' => $rows['id'],
                                'sku_code' => $rows['sku'],
                                'barcode' => $barcode,
                                'purchase_id' => $orderData['order_id'],
                                'product_id' => $orderData['id'],
                                'basic_rate' => $orderData['base_price'],
                                'pur_netprice' => $orderData['pnetprice'],
                                'mrp' => $orderData['mrp_price'],
                                'wsp' => $orderData['wsp_price'],
                                'qty' => $rows['quantity'],
                                'balQty' => $rows['quantity'],
                                'purchase_type' => 'pinvoice',
                                'item_status' => 'available',
                                'company_id' => $this->session->userdata('wo_company'),
                                // 'city_id' => $this->session->userdata('wo_city'),
                                'store_id' => $value['store_id'],
                                'created_by' => $this->session->userdata('wo_id'),
                                'gst_id' => $rows['gst_id'],
                                'unit_id' => $rows['unit_id'],
                                'hsn' => $rows['hsn'],
                                'salesmancomm' => $rows['salesmancomm'],
                                'discountcode' => $rows['discountcode'],
                                'brand_id' => $orderData['brand_id'],
                            );

                $created = $this->model_barcode->create($data);
                // echo "<pre>"; print_r($data);
            }
        }
        // exit();

        if($created)
        {
            $updateInvoiceData = array(
                                    'id' => $id,
                                    'product_status' => 'create'
                                );

            $this->model_purchaseinvoice->update($updateInvoiceData);

            $this->session->set_flashdata('feedback','Record Update Successfully');
            $this->session->set_flashdata('feedback_class','alert alert-success');
            
            return redirect('purchase_invoice');
        }
        else
        {
            $this->session->set_flashdata('feedback','Unable to Update Record');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            return redirect('purchase_invoice/update'.$order_id);
        }
	}
	
	public function opening_stock()
	{
	    $id = $this->uri->segment(3);        
        // echo $id; exit(); //    openign stock id

        $data = array(
                        'order_id' => $id,
                        'order_name' => 'opening_stock'
                    );
        // echo "<pre>"; print_r($data); exit();

        $itemData = $this->model_purchaseitem->fetchItemByOrderIdName($data);
        // echo "<pre>"; print_r($itemData); exit();

        $sumQty = 0;
        foreach ($itemData as $key => $value) {

            $sumQty = $sumQty + $value['quantity'];
        }
        // echo $sumQty; exit();

        $orderData = $this->model_openingstock->fetchStckoItemByOrderIdType($data);
        // echo "<pre>"; print_r($orderData); exit();

        foreach ($orderData as $key => $value) {
            
            $skuData = $this->model_sku->fecthSkuDataByID($value['sku']);
            // echo "<pre>"; print_r($skuData);

            $data = array(
                        'purchase_id' => $value['order_id'],  // opening stock id
                        'sku_code' => $skuData['product_code'],
                        'purchase_type' => 'popeningstock',
                        'purchase_qty' => $value['quality'],
                        'available_qty' => $value['quality'],
                        'company_id' => $this->session->userdata('wo_company'),
                        // 'city_id' => $this->session->userdata('wo_city'),
                        'store_id' => $value['store_id'],
                        'created_by' => $this->session->userdata('wo_id')
                    );
            
            // echo "<pre>"; print_r($data); //exit();
            // $created_id = 1;
            $created_id = $this->model_barcode->createStock($data);
        }
        // exit();

        if($created_id)
        {
            // echo "<pre>"; print_r($itemData); exit();
            foreach ($itemData as $key => $rows) {

                // echo "not Pieces <br>";
                $barcode = $this->model_barcode->lastrecord();

                if($barcode == '')
                {
                    $barcode  = '0000000001';
                   // $code = '0000001';
                }
                else
                {
                    $np = $barcode['barcode'];
                    $code = substr($np, 1); 
                    
                    $code = $code + 1;
                    $barcode = sprintf('%010d',$code);
                    
                    // $this->data['barcode'] = $code;
                }

                $data = array(
                    'order_id' => $id,
                    'order_name' => 'opening_stock',
                    'order_code' => $rows['order_code']
                );

                $orderData = $this->model_openingstock->fetchStckoItemDataByOrderIdTypeCode($data);
                // echo "<pre>"; print_r($orderData); exit();

                $skuData = $this->model_sku->fecthSkuDataByID($orderData['sku']);
                // echo "<pre>"; print_r($skuData); //exit();

                $barcodeData = $this->model_barcode->fetchDataByPurchase_id($orderData['order_id']);
                // echo "<pre>"; print_r($barcodeData); //exit();

                $unit = $this->model_unit->fecthUnitDataByID($orderData['unit']);
                // echo "<pre>"; print_r($unit);
                
                $data = array(
                                    'itemstock_id' => $created_id,
                                    'attr_id' => $rows['id'],
                                    'sku_code' => $rows['sku'],
                                    'barcode' => $barcode,
                                    'purchase_id' => $orderData['order_id'],
                                    'product_id' => $orderData['id'],
                                    'basic_rate' => $orderData['base_price'],
                                    'pur_netprice' => $orderData['pnetprice'],
                                    'mrp' => $orderData['mrp'],
                                    'wsp' => $orderData['wspp'],
                                    'qty' => $rows['quantity'],
                                    'balQty' => $rows['quantity'],
                                    'purchase_type' => 'popeningstock',
                                    'item_status' => 'available',
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $value['store_id'],
                                    'created_by' => $this->session->userdata('wo_id'),
                                    'gst_id' => $rows['gst_id'],
                                    'unit_id' => $rows['unit_id'],
                                    'hsn' => $rows['hsn'],
                                    'salesmancomm' => $rows['salesmancomm'],
                                    'discountcode' => $rows['discountcode'],
                                    'brand_id' => $orderData['brand'],
                            );
                
                // echo "<pre>"; print_r($data);
                $created = $this->model_barcode->create($data);

            }
        }

        // exit();

        if($created)
        {
            $updateOpeningStockData = array(
                                'id' => $id,
                                'product_status' => 'create'
                            );

            $this->model_openingstock->update($updateOpeningStockData);
            // echo "<pre>"; print_r($updateOpeningStockData); exit();

            $this->session->set_flashdata('feedback','Record Update Successfully');
            $this->session->set_flashdata('feedback_class','alert alert-success');
            
            return redirect('opening_stock');
        }
        else
        {
            $this->session->set_flashdata('feedback','Unable to Update Record');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            return redirect('opening_stock/update'.$order_id);
        }
	}


    public function production()
    {
        $id = $this->uri->segment(3);        
        // echo $id; exit(); //    Production id

        $data = array(
                        'order_id' => $id,
                        'order_name' => 'production'
                    );
        // echo "<pre>"; print_r($data); exit();

        $itemData = $this->model_purchaseitem->fetchItemByOrderIdName($data);
        // echo "<pre>"; print_r($itemData); //exit();

        $sumQty = 0;
        foreach ($itemData as $key => $value) {

            $sumQty = $sumQty + $value['quantity'];
        }
        // echo $sumQty; exit();

        $orderData = $this->model_openingstock->fetchStckoItemByOrderIdType($data);
        // echo "<pre>"; print_r($orderData); exit();

        foreach ($orderData as $key => $value) {
            
            $skuData = $this->model_sku->fecthSkuDataByID($value['sku']);
            // echo "<pre>"; print_r($skuData);

            $data = array(
                        'purchase_id' => $value['order_id'],  // opening stock id
                        'sku_code' => $skuData['product_code'],
                        'purchase_type' => 'production',
                        'purchase_qty' => $value['quality'],
                        'available_qty' => $value['quality'],
                        'company_id' => $this->session->userdata('wo_company'),
                        // 'city_id' => $this->session->userdata('wo_city'),
                        'store_id' => $value['store_id'],
                        'created_by' => $this->session->userdata('wo_id')
                    );
            
            $created_id = $this->model_barcode->createStock($data);
        }
        // exit();

        if($created_id)
        {
            // echo "<pre>"; print_r($itemData); exit();
            foreach ($itemData as $key => $rows) {

                // echo "not Pieces <br>";
                $barcode = $this->model_barcode->lastrecord();

                if($barcode == '')
                {
                    $barcode  = '0000000001';
                   // $code = '0000001';
                }
                else
                {
                    $np = $barcode['barcode'];
                    $code = substr($np, 1); 
                    
                    $code = $code + 1;
                    $barcode = sprintf('%010d',$code);
                    
                    // $this->data['barcode'] = $code;
                }

                $data = array(
                    'order_id' => $id,
                    'order_name' => 'production',
                );

                $orderData = $this->model_openingstock->fetchStckoItemDataByOrderIdType($data);
                // echo "<pre>"; print_r($orderData); //exit();

                $skuData = $this->model_sku->fecthSkuDataByID($orderData['sku']);
                // echo "<pre>"; print_r($skuData); //exit();

                $barcodeData = $this->model_barcode->fetchDataByPurchase_id($orderData['order_id']);
                // echo "<pre>"; print_r($barcodeData); //exit();

                $unit = $this->model_unit->fecthUnitDataByID($orderData['unit']);
                // echo "<pre>"; print_r($unit);
                
                $data = array(
                                    'itemstock_id' => $created_id,
                                    'attr_id' => $rows['id'],
                                    'sku_code' => $rows['sku'],
                                    
                                    'barcode' => $barcode,
                                    'purchase_id' => $orderData['order_id'],
                                    'product_id' => $orderData['id'],
                                    'pur_netprice' => $orderData['pnetprice'],
                                    'basic_rate' => $orderData['base_price'],
                                    'mrp' => $orderData['mrp'],
                                    'wsp' => $orderData['wspp'],
                                    'qty' => $rows['quantity'],
                                    'balQty' => $rows['quantity'],
                                    'purchase_type' => 'production',
                                    'item_status' => 'available',
                                    'company_id' => $this->session->userdata('wo_company'),
                                    // 'city_id' => $this->session->userdata('wo_city'),
                                    'store_id' => $value['store_id'],
                                    'created_by' => $this->session->userdata('wo_id'),
                                    'gst_id' => $rows['gst_id'],
                                    'unit_id' => $rows['unit_id'],
                                    'hsn' => $rows['hsn'],
                                    'salesmancomm' => $rows['salesmancomm'],
                                    'discountcode' => $rows['discountcode'],
                                    'brand_id' => $orderData['brand'],
                            );
                
                // echo "<pre>"; print_r($data);
                $created = $this->model_barcode->create($data);

            }
        }

        if($created)
        {

            $this->session->set_flashdata('feedback','Record Update Successfully');
            $this->session->set_flashdata('feedback_class','alert alert-success');
            
            return redirect('production');
        }
        else
        {
            $this->session->set_flashdata('feedback','Unable to Update Record');
            $this->session->set_flashdata('feedback_class','alert alert-danger');
            return redirect('production');
        }
    }
    
    
    // edit price and all data
    public function updatedata()
    {
        $id = $this->uri->segment(3);
        
        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');
	    
	    if ($this->form_validation->run() == TRUE) {
	        
            // echo "<pre>"; print_r($_POST); // exit;
            $data = array(
                            'id' => $this->input->post('id'),
                            'sku_code' => $this->input->post('sku'),
                            'brand_id' => $this->input->post('brand'),
                            'unit_id' => $this->input->post('unitid'),
                            'hsn' => $this->input->post('hsn'),
                            'qty' => $this->input->post('quality'),
                            'basic_rate' => $this->input->post('base_price'),
                            'gst_id' => $this->input->post('gst'),
                            'pur_netprice' => $this->input->post('pur_price'),
                            'wsp' => $this->input->post('wspp'),
                            'mrp' => $this->input->post('mrp'),
                            'discountcode' => $this->input->post('discount_code'),
                            'salesmancomm' => $this->input->post('comm'),
                        );
            
            
            // echo "<pre>"; print_r($data); 
            // exit;
            $update = $this->model_barcode->update($data);
            
            if($update)
            {
    //             $this->session->set_flashdata('feedback','Unable to Update Record');
				// $this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect($this->input->post('url'));
            }
            else
            {
                $this->session->set_flashdata('feedback','Unable to Update Record');
				$this->session->set_flashdata('feedback_class','alert alert-danger');
				
				return redirect('production');
            }
	    }
	    else
	    {
	        $this->data['category'] = $this->model_category->fecthAllData();
            $this->data['subcategory'] = $this->model_category->fecthAllSubCatData();
        	$this->data['sku'] = $this->model_sku->fecthAllData();
            $this->data['brand'] = $this->model_brand->fecthAllData();
	        $this->data['unit'] = $this->model_unit->fecthAllData();
    		$this->data['hsn'] = $this->model_hsn->fecthAllData();
    		$this->data['gst'] = $this->model_gst->fecthAllData();
    		$this->data['locations'] = $this->model_location->fecthAllData();
    		$this->data['discount'] = $this->model_discount->fecthAllData();
    		
	        $this->data['allData'] = $this->model_barcode->fetchAllDataByBarcodeid($id);
            // echo "<pre>"; print_r($allData); exit;
        
	        $this->render_template('admin_view/productMaster/product/editBarcode', $this->data);    
	    }
    }
    
    
    
    
}