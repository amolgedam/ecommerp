<!-- < ?php echo "<pre>"; print_r($ledgerEntries); exit(); ?> -->
<!--< ?php echo "<pre>"; print_r($journal); exit; ?>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Search
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Search</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <div class="col-md-3">
                    <label>Search Type</label>
                    <select name="search" id="search" class="form-control">
                      <option value="0">---Select Option---</option>
                      <option value="product">Product</option>
                      <option value="ledger">Ledger</option>
                      <option value="entries">Entries</option>
                    </select>
                </div>
                <!-- search product start -->
                <div class="col-md-3 searchProduct">
                    <label>Search SKU</label>
                    <input name="productno" id="productno" list="browsers" class="form-control" onchange="getSKUData();">
                    <datalist id="browsers">
                      <?php foreach ($skuData as $key => $value) { ?>
                        <option value="<?php echo $value->product_code ?>"><?php echo $value->product_code ?></option>
                      <?php } ?>
                    </datalist>
                </div>
                <div class="col-md-3 searchProduct">
                    <label>Product Serial Number</label>
                     <input name="barcode" id="barcode" class="form-control">                    
                </div>

                <div class="col-md-3 searchProduct">
                    <br>
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="getProductDataByBarcode();">Search Product</a>
                </div>

                <!-- search product end -->
                <!-- search ledger start -->
                <?php echo form_open('globalsearch/ledgerSearch'); ?>
                  <div class="col-md-3 searchLedger">
                      <label>Search Ledger</label>
                      <!-- <input type="text" name="ledgername" class="form-control"> -->
                      <input name="ledger" id="ledgerid" list="ledger" class="form-control" autocomplete="off">
                      <datalist id="ledger">
                        <?php foreach ($ledgerData as $key => $value) { ?>
                          <option value="<?php echo $value['ledger_name'] ?>" ><?php echo $value['ledger_name'] ?></option>
                        <?php } ?>
                      </datalist>
                  </div>
                  <div class="col-md-3 searchLedger">
                      <label> From Date</label>
                      <input type="date" name="from" class="form-control">
                  </div>
                  <div class="col-md-3 searchLedger">
                      <label> To Date</label>
                      <input type="date" name="to" class="form-control">
                  </div>
                  <div class="col-md-3 searchLedger">
                      <br>
                      <input type="submit" name="ledgerSearch" value="Search" class="btn btn-sm btn-primary">
                      <!-- <a href="javascript:void(0);" class="btn btn-sm btn-primary">Search</a> -->
                  </div>
                <?php echo form_close(); ?>
                
                
                <?php echo form_open('globalsearch/entriesSearch'); ?>
                    <div class="col-md-3 searchEntries">
                        <label>Search Option</label>
                        <select name="entry" class="form-control">
                            <option value="0">Select One</option>
                            <option value="payment">Payment Note</option>
                            <option value="receipt">Receipt Note</option>
                            <option value="journal">Journal Entries</option>
                            <option value="contra">Contra Entry</option>
                        </select>
                    </div>
                    <div class="col-md-3 searchEntries">
                        <label> From Date</label>
                        <input type="date" name="from" class="form-control">
                    </div>
                    <div class="col-md-3 searchEntries">
                        <label> To Date</label>
                        <input type="date" name="to" class="form-control">
                    </div>
                    <div class="col-md-3 searchEntries">
                        <br>
                        <input type="submit" name="ledgerSearch" value="Search" class="btn btn-sm btn-primary">
                        <!-- <a href="javascript:void(0);" class="btn btn-sm btn-primary">Search</a> -->
                    </div>
                <?php echo form_close(); ?>
                
            </div>
          </div>


          <div class="box">
            <div class="box-body">
                
                <div id="showData">




                </div>

                <?php if(isset($ledgerEntries)){ //echo "<pre>"; print_r($ledgerEntries); //exit(); ?>
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                          <th class="myBorder">&nbsp; Date</th>
                          <th class="myBorder">&nbsp; Particulars</th>
                          <!-- <th class="myBorder">&nbsp; Invoice Number</th> -->
                          <td class="myBorder">&nbsp; Debit</td>
                          <th class="myBorder">&nbsp; Credit</th>
                          <th class="myBorder">&nbsp; Balance</th>
                      </tr>
                      <tr>
                        <td class="myBorder">&nbsp; <?php echo date('d-m-Y', strtotime($ledger['created_date'])); ?></td>
                        <td class="myBorder">&nbsp; <?php echo "Opening Balance"; ?></td>
                        <td class="myBorder">&nbsp; <?php echo "-"; ?></td>
                        <td class="myBorder">&nbsp; <?php echo "-"; ?></td>
                        <td class="myBorder">&nbsp; <?php echo number_format($ledgerEntries['0']['opening_bal'], 2); ?></td>
                      </tr>

                      <?php 

                                      $amtdr = $amtcr = $dr = $cr = $diff = $opbal = $clbal = $totdr = $totcr = 0; 
                                      $particular = $finalDrCr = $link = $no = $data = '';

                                      // echo "<pre>"; print_r($ledgerEntries); exit();
                                    foreach ($ledgerEntries as $key => $value) { 

                                        // echo "Bal".abs($value['amt'])."<br>";

                                        $dr = $value['dr_cr'] == 'DR' ? abs($value['amt']) : "-";
                                        $cr = $value['dr_cr'] == 'CR' ? abs($value['amt']) : "-";
                                        
                                        // $dr = abs($dr);
                                        // $dr = abs($dr);

                                        $totdr = $totdr + $dr;
                                        $totcr = $totcr + $cr;

                                        $opbal = $value['opening_bal'] != '-' ? $value['opening_bal'] : "-";
                                        $clbal = $value['closing_bal'] != '-' ? $value['closing_bal'] : "-";

                                        if($totdr < $totcr)
                                            $finalDrCr = "CR";
                                        else
                                            $finalDrCr = "DR";
                                    ?>
                                    <!-- 
                                        For Display Data in Particular
                                    -->
                                    <?php

                                        if($value['purchase_type'] == 'pinvoice')
                                        {
                                            // echo "purchase invoice";
                                            $data = $this->model_purchaseinvoice->fecthAllDatabyID($value['purchase_id']);

                                            $particular = "Purchase Invoice  ";
                                            $link = "purchase_invoice/update/".$data['id'];
                                            $no = $data['invoice_no'];

                                        }
                                        else if($value['purchase_type'] == 'purchase_voucher')
                                        {
                                            // echo "purchase voucher";
                                            $data = $this->model_purchasevoucher->fecthAllDatabyID($value['purchase_id']);

                                            $particular = "Purchase Voucher  ";
                                            $link = "purchase_voucher/update/".$data['id'];
                                            $no = $data['voucher_no'];
                                        }
                                        else if($value['purchase_type'] == 'purchase_return')
                                        {
                                            // echo "purchase return";
                                            $data = $this->model_purchasereturn->fecthAllDatabyID($value['purchase_id']);
                                            $particular = "Purchase Return  ";
                                            $link = "purchase_voucher/update/".$data['id'];
                                            $no = $data['order_no'];
                                        }
                                        else if($value['purchase_type'] == 'salesinvoice')
                                        {
                                            // echo "invoice, voucher, wsp";
                                            $data = $this->model_salesinvoice->fecthAllDatabyID($value['purchase_id']);
                                            // echo "<pre>"; print_r($data);

                                            if($data['invoice_type'] == 'invoice')
                                            {
                                                $particular = "Sales Invoice  ";

                                                $link = "sales_invoice/update/".$data['id'];
                                                $no = $data['inventory_no'];
                                            }
                                            else if($data['invoice_type'] == 'pos')
                                            {
                                                $particular = "Sales Invoice  ";

                                                $link = "sales_invoice/update/".$data['id'];
                                                $no = $data['inventory_no'];
                                            }
                                            else if($data['invoice_type'] == 'voucher')
                                            {
                                                $particular = "Sales Voucher  ";

                                                $link = "sales_voucher/update/".$data['id'];
                                                $no = $data['inventory_no'];
                                            }
                                            else if($data['invoice_type'] == 'wsp')
                                            {
                                                $particular = "WSP  ";

                                                $link = "wsp/update/".$data['id'];
                                                $no = $data['inventory_no'];
                                            }
                                        }
                                        else if($value['purchase_type'] == 'salesexchange')
                                        {
                                            // echo "salesexchange";
                                            $data = $this->model_salesexchange->fecthAllDatabyID($value['purchase_id']);

                                            $particular = "Sales Exchange  ";

                                            $link = "wsp/update/".$data['id'];
                                            $no = $data['exchange_no'];
                                        }
                                        else if($value['purchase_type'] == 'paymentnote')
                                        {
                                            // echo "paymentnote";
                                            $data = $this->model_paymentnote->fecthDataByID($value['purchase_id']);

                                            $particular = "Payment Note  ";
                                            $link = "paymentnote/update/".$data['id'];
                                            $no = $data['voucherno'];
                                        }
                                        else if($value['purchase_type'] == 'receiptnote')
                                        {
                                            // echo "receiptnote";
                                            $data = $this->model_receiptnotes->fecthDataByID($value['purchase_id']);

                                            $particular = "Receipt Note  ";
                                            $link = "receiptnote/update/".$data['id'];
                                            $no = $data['voucherno'];
                                        }
                                        else if($value['purchase_type'] == 'journalentry')
                                        {
                                            // echo "journalentry";
                                            $data = $this->model_journalentry->fecthDataByID($value['purchase_id']);

                                            $particular = "Journal Entry  ";
                                            $link = "journalentry/update/".$data['id'];
                                            $no = $data['voucherno'];
                                        }
                                        else if($value['purchase_type'] == 'contraentry')
                                        {
                                            // echo "contraentry";
                                            $data = $this->model_contraentry->fecthDataByID($value['purchase_id']);

                                            $particular = "Contra Entry  ";
                                            $link = "contraentry/update/".$data['id'];
                                            $no = $data['voucherno'];
                                        }
                                        else if($value['purchase_type'] == 'production')
                                        {
                                          $data = $this->model_production->fecthAllDatabyID($value['purchase_id']);

                                          $particular = "Job Sheet  ";
                                          $link = "production/update/".$data['id'];
                                          $no = $data['jobsheet_no']; 
                                        }
                                        else if($value['purchase_type'] == 'salesorder')
                                        {
                                          $data = $this->model_salesorder->fecthAllDatabyID($value['purchase_id']);

                                          $particular = "Sales Order  ";
                                          $link = "sales_order/addQty/".$data['id'];
                                          $no = $data['order_no']; 
                                        }  
                                        

                                    ?>

                                    <tr>
                                      <td class="myBorder">&nbsp; <?php echo date('d-m-Y', strtotime($value['entry_date'])); ?></td>
                                      <td class="myBorder">
                                        &nbsp; <?php echo $particular; ?>
                                        <a href="<?php echo base_url().$link; ?>"> <?php echo $no; ?> </a>
                                      </td>
                                      <!-- <td>
                                        <a href="< ?php echo base_url().$link.$entry['id']; ?>"> < ?php echo $entry['id'] ?> </a>
                                      </td> -->
                                      <td class="myBorder">&nbsp; <?php  echo number_format(abs($dr), 2); ?></td>
                                      <td class="myBorder">&nbsp; <?php echo number_format(abs($cr), 2) ?></td>
                                      <td class="myBorder">&nbsp; <?php echo number_format(abs($clbal), 2); ?></td>
                                    </tr>
                                  <?php } ?>

                                   <tr>
                                      <td class="myBorder">&nbsp; <b>Total</b></td>
                                      <td class="myBorder">&nbsp; </td>
                                      <!-- <td>&nbsp;</td> -->
                                      <td class="myBorder">&nbsp; <b><?php echo number_format($totdr, 2); ?></b> </td>
                                      <td class="myBorder">&nbsp; <b><?php echo number_format($totcr, 2); ?></b></td>
                                      <td class="myBorder">&nbsp; </td>
                                    </tr>
                    </table>

                    <div align="right">
                        <span>Opening Balance:- <b><?php echo number_format($ledgerEntries[0]['opening_bal'], 2); echo " ".$ledgerEntries[0]['dr_cr']; ?></b></span><br>
                        <span>Closing Balance:- <b><?php echo number_format(abs($clbal), 2); echo " ".abs($finalDrCr); ?></b></span><br>
                    </div>

                  </div>
                <?php } ?>
                
                
                
                <!--    for Payment note and peceit note    -->
                <?php if(isset($result)){ //echo "<pre>"; print_r($ledgerEntries); //exit(); ?>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Voucher No</th>
                                <th>Date</th>
                                <th>Payment Type</th>
                                <th>Ledger</th>
                                <th>Particular</th>
                                <th>Amount</th>
                            </tr>
                            <?php foreach($result as $rows){ ?>
                                <?php
                                    $ledgerData = $this->model_ledger->fecthDataByID($rows['ledger_id']);
                                    $paymenttype = $this->model_paymentmaster->fecthDataByID($rows['paymenttype_id']);
                                ?>
                                <tr>
                                    <td><a href="<?php echo base_url().$link.$rows['id']; ?>"><?php echo $rows['voucherno']; ?></a></td>
                                    <td><?php echo date('d-m-Y', strtotime($rows['date'])); ?></td>
                                    <td><?php echo $paymenttype['payment_name']; ?></td>
                                    <td><?php echo $ledgerData['ledger_name']; ?></td>
                                    <td><?php echo $rows['remark']; ?></td>
                                    <td><?php echo $rows['amount']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
                
                
                <!--    for Journal Entry    -->
                <?php if(isset($journal)){ ?>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Entry No</th>
                                <th>Date</th>
                                <th>From Ledger</th>
                                <th>To Ledger</th>
                                <th>Particular</th>
                                <th>Amount</th>
                            </tr>
                            <?php foreach($journal as $rows){ ?>
                                <?php
                                    $crledgerData = $this->model_ledger->fecthDataByID($rows['cr_ledgerid']);
                                    $drledgerData = $this->model_ledger->fecthDataByID($rows['dr_ledgerid']);
                                ?>
                                <tr>
                                    <td><a href="<?php echo base_url().$link.$rows['id']; ?>"><?php echo $rows['voucherno']; ?></a></td>
                                    <td><?php echo date('d-m-Y', strtotime($rows['date'])); ?></td>
                                    <td><?php echo $crledgerData['ledger_name']; ?></td>
                                    <td><?php echo $drledgerData['ledger_name']; ?></td>
                                    <td><?php echo $rows['remark']; ?></td>
                                    <td><?php echo $rows['amount']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
                
                
                <!--    for Journal Entry    -->
                <?php if(isset($contra)){ ?>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Entry No</th>
                                <th>Date</th>
                                <th>From Payment Type</th>
                                <th>To Payment Type</th>
                                <th>Particular</th>
                                <th>Amount</th>
                            </tr>
                            <?php foreach($contra as $rows){ ?>
                                <?php
                                    $from_paymenttype = $this->model_paymentmaster->fecthDataByID($rows['from_paymenttypeid']);
                                    $to_paymenttype = $this->model_paymentmaster->fecthDataByID($rows['to_paymenttypeid']);
                                ?>
                                <tr>
                                    <td><a href="<?php echo base_url().$link.$rows['id']; ?>"><?php echo $rows['voucherno']; ?></a></td>
                                    <td><?php echo date('d-m-Y', strtotime($rows['date'])); ?></td>
                                    <td><?php echo $from_paymenttype['payment_name']; ?></td>
                                    <td><?php echo $to_paymenttype['payment_name']; ?></td>
                                    <td><?php echo "Contra Entry ".$rows['voucherno']; ?></td>
                                    <td><?php echo $rows['amount']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
                
                
                
            </div>
          </div>

         <!--  < ?php if(isset($ledgerEntries)){ //echo "<pre>"; print_r($ledgerEntries); //exit(); ?>

            <div align="right">
                <span>Opening Balance:- <b>< ?php echo number_format($ledger['closing_balance'], 2); ?></b></span><br>
                <span>Current Balance:- <b>< ?php echo number_format($cl, 2); ?></b></span><br>
            </div>
          < ?php } ?> -->

        </div>
      </div>
    </section>

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
           
        </div>
      </div>
    </section>
    
  </div>
  <div class="control-sidebar-bg"></div>
</div>

<script type="text/javascript">

    $('.searchProduct').hide();
    $('.searchLedger').hide();
    $('#btnSearch').hide();
    $('.searchEntries').hide();

    $('#search').on('change', function(){

        var search = $(this).val();
        // alert(search);
        if(search == 'product')
        {
          $('.searchProduct').show();
          $('.searchLedger').hide();
          $('.searchEntries').hide();

          $('#btnSearch').show();
        }
        else if(search == 'ledger')
        {
          $('.searchProduct').hide();
          $('.searchLedger').show();
          $('.searchEntries').hide();

          $('#btnSearch').show();
        }
        else if(search == 'entries')
        {
          $('.searchProduct').hide();
          $('.searchLedger').hide();
          $('.searchEntries').show();
          
          $('#btnSearch').hide();
        }
        else if(search == '0')
        {
          $('.searchProduct').hide();
          $('.searchLedger').hide();
          $('#btnSearch').hide();
          $('.searchEntries').hide();
        }
    });
</script>

<script type="text/javascript">

    var base_url = "<?php echo base_url(); ?>";

    function getSKUData()
    {
        var sku = $('#productno').val();
        // alert(sku);
        getProductSKUInfo(sku);
    }

    function getProductSKUInfo(sku) {
        
          $.ajax({ 
 
              url : base_url + 'globalsearch/getGlobalSearchData/',
              method : "POST",
              data : {sku:sku},
              dataType: 'json',
              success:function(response){

                  // console.log(response);

                  var html = inOutHtml = inHtml = inHtml1 = outHtml = inWardsDataLink = outWardsDataLink = datastring = barcodeList = sku1 = cat = subcat = '';
                  var inwardQuantity = inwardRate = inwardValue = 0;

                  // $('#showData').text(response);

                  inHtml += '<div class="col-md-12">';
                  inHtml += '<div>';
                    inHtml += '<h3>SKU Summary </h3>';
                  inHtml += '</div>';
                    inHtml += '<div><b>SKU </b>: <span id="skuDatasku">'+response[0].sku+'</span> &nbsp;&nbsp; <b>Category </b>: '+response[0].cat+' &nbsp;&nbsp; <b>Sub-Category </b>:'+response[0].subcat+'</div>';
                  inHtml += '</div>';
                  inHtml += '<div class="col-md-6">';
                    inHtml += '<table class="table">';
                      inHtml += '<thead>';
                        inHtml += '<tr>';
                          inHtml += '<th colspan="6"><center>In-Wards</center></th>';
                        inHtml += '</tr>';
                          inHtml += '<tr>';
                          inHtml += '<th>Entry</th>';
                          inHtml += '<th>Supplier</th>';
                          inHtml += '<th>Quantity</th>';
                          inHtml += '<th>Rate</th>';
                          inHtml += '<th>Value</th>';
                          inHtml += '<th>MRP</th>';
                        inHtml += '</tr>';
                      inHtml += '</thead>';
                      inHtml += '<tbody>';

                        $.each(response, function(index, value) { 


                            sku1 = value.sku;

                            var value1 = value.qty * value.rate;
                            
                            var a = '<a href="'+base_url+value.url+'" target="_blank">'+value.invoice_no+'</a>';

                            inHtml += '<tr>';
                              inHtml += '<td>'+value.name+" "+a+'</td>';
                              inHtml += '<td>'+value.supplier+'</td>';
                              inHtml += '<td>'+value.qty+'</td>';
                              inHtml += '<td>'+value.rate+'</td>';
                              inHtml += '<td>'+value1+'</td>';
                              inHtml += '<td>'+value.mrp+'</td>';
                            inHtml += '</tr>';

                            inwardQuantity = parseFloat(inwardQuantity) + parseFloat(value.qty);
                            inwardRate = parseFloat(inwardRate) + parseFloat(value.rate);
                            inwardValue = parseFloat(inwardValue) + parseFloat(value1);

                        });

                        // console.log(sku1);


                      inHtml += '</tbody>';
                      inHtml += '<tfoot>';
                        inHtml += '<tr>';
                        inHtml += '<td> Total Inward :- </td>';
                        inHtml += '<td> &nbsp; </td>';
                        inHtml += '<td><span id="inwardResponceQty"></span></td>';
                        inHtml += '<td><span id="inwardResponceRate"></span></td>';
                        inHtml += '<td><span id="inwardResponceValue"></span></td>';
                        inHtml += '<td><span id="inwardResponceMRP"></span></td>';
                        inHtml += '<td> &nbsp; </td>';
                      inHtml += '</tr>';
                      inHtml += '</tfoot>';
                    inHtml += '</table>';
                  inHtml += '</div>';
                  inHtml += '<div class="col-md-6" id="skuOutWardData">';

                  inHtml += '</div>';
                  inHtml += '<div id="barcodeDataList">';
                  inHtml += '</div>';

                  $('#showData').html(inHtml);

                  countInwardsData(inwardQuantity, inwardRate, inwardValue);

                  var table = '';
                    
                    // table += '<div id="inwordOutwardData">';
                    // table += '</div>';

                    table += '<div class="col-md-12">';
                    table += '<h4>SKU Details</h4>';
                    table += '<div class="table-responsive col-md-12">';
                      table += '<table class="table" id="productDataTable">';
                        table += '<thead>';
                           table += '<tr>';
                            table += '<th>Product Number</th>';
                            table += '<th>Color</th>';
                            table += '<th>Size</th>';
                            table += '<th>Texture/Pattern</th>';
                            table += '<th>Style1</th>';
                            table += '<th>Style2</th>';
                            table += '<th>Type</th>';
                            table += '<th>Quantity</th>';
                            table += '<th>Inwards</th>';
                            table += '<th>Action</th>';
                          table += '</tr>';
                          table += '<tbody id="barcodeListData">';

                          table += '</tbody>';
                        table += '</thead>';
                      table += '</table>';
                    table += '</div>';

                    $('#barcodeDataList').html(table);


                    $.ajax({ 

                        url : base_url + 'globalsearch/getGlobalSearchData1/',
                        method : "POST",
                        data : {sku:sku},
                        dataType: 'json',
                        success:function(responseBarcode){

                            // console.log(responseBarcode);
                            $.each(responseBarcode, function(index, barcodeValue) { 

                                var a = '<a href="'+base_url+barcodeValue.url+'" target="_blank">'+barcodeValue.invoice_no+'</a>';

                                barcodeList += '<tr>';
                                  barcodeList += '<td>'+barcodeValue.barcode+'</td>';
                                  barcodeList += '<td>'+barcodeValue.color+'</td>';
                                  barcodeList += '<td>'+barcodeValue.size+'</td>';
                                  barcodeList += '<td>'+barcodeValue.pattern+'</td>';
                                  barcodeList += '<td>'+barcodeValue.style1+'</td>';
                                  barcodeList += '<td>'+barcodeValue.style2+'</td>';
                                  barcodeList += '<td>'+barcodeValue.type+'</td>';
                                  barcodeList += '<td>'+barcodeValue.qty+'</td>';
                                  barcodeList += '<td>'+barcodeValue.name+a+'</td>';
                                  barcodeList += '<td>'+barcodeValue.item_status+'</td>';
                                barcodeList += '</tr>';
                            });

                            $('#barcodeListData').html(barcodeList);                        }
                      });

                    // alert(barcodeList);

                  //   var row_id = 1;
                  //   var inwardQuantity = inwardRate = inwardValue = 0;
                    
                  //   var purchase_type = anchortag = orderitemaction = '';
                  //   var myorderitem_id = myorder_id = ptype = '';

                  // $.each(response, function(index, value) { 
                  //     // console.log(value.order_id); 

                  //     if(value.order_id != null || value.order_id != '')
                  //     {
                  //         $('#showData').html(table);

                  //         if(value.purchase_type == 'popeningstock')
                  //         {
                  //             anchortag = '<a href="'+base_url+'opening_stock/update/'+value.order_id+'">'+value.order_id+'</a>';
                  //             purchase_type = 'Opening Stock Number : '+anchortag;

                  //             orderitemaction = '<a href="'+base_url+'opening_stockitem/update/'+value.orderitem_id+'"> Edit </a>';

                  //             myorder_id = value.order_id;
                  //             myorderitem_id = value.orderitem_id;
                  //             ptype = value.purchase_type;
                  //         }
                  //         else
                  //         {
                  //             anchortag = '<a href="'+base_url+'purchase_invoice/update/'+value.order_id+'">'+value.order_id+'</a>';
                  //             purchase_type = 'Purchase Invoice Number : '+anchortag;

                  //             orderitemaction = '<a href="'+base_url+'purchase_invoiceitem/update/'+value.orderitem_id+'/'+value.order_id+'"> Edit </a>';
                  //             // purchase_invoiceitem/update/54/38

                  //             myorder_id = value.order_id;
                  //             myorderitem_id = value.orderitem_id;
                  //             ptype = value.purchase_type;
                  //         }

                  //         html += '<tr id="row_'+row_id+'">';
                  //           html += '<td>';
                  //             html += '<input type="hidden" value="'+value.barcode+'" id="barcode_'+row_id+'">'
                  //             html += '<span>'+value.barcode+'</span>';
                  //           html += '</td>';
                  //           html += '<td>';
                  //             html += '<span>'+value.color+'</span>';
                  //           html += '</td>';
                  //           html += '<td>';
                  //             html += '<span>'+value.size+'</span>';
                  //           html += '</td>';
                  //           html += '<td>';
                  //             html += '<span>'+value.pattern+'</span>';
                  //           html += '</td>';
                  //           html += '<td>';
                  //             html += '<span>'+value.style1+'"</span>';
                  //           html += '</td>';
                  //           html += '<td>';
                  //             html += '<span>'+value.style2+'</span>';
                  //           html += '</td>';
                  //           html += '<td>';
                  //             html += '<span>'+value.type+'</span>';
                  //           html += '</td>';
                  //           html += '<td>';
                  //             html += '<span>'+value.qty+'<span>';
                  //           html += '</td>';
                  //           html += '<td>';
                  //             html += '<span> '+purchase_type+'<span>';
                  //           html += '</td>';
                  //           html += '<td>';
                  //             html += '<span>'+value.item_status+'<span>';
                  //             // html += '<span>'+ orderitemaction +' '+value.item_status+'<span>';
                  //           html += '</td>';
                  //         html += '</tr>';

                  //         row_id++;


                  //     }
                  // });

                  // $.ajax({

                  //       url : base_url + 'sku/getGlobalSearchData/',
                  //       method : "POST",
                  //       data : {sku:sku},
                  //       dataType: 'json',
                  //       success:function(skuResponce){

                  //           // console.log(skuResponce);
                  //           inOutHtml += '<div class="col-md-12">';
                  //             inOutHtml += '<div><center><b><h4> SKU Summary<h4></b></center></div>';
                  //             inOutHtml += '<div><h5><b>SKU</b> :- '+sku+'  <b>Category</b> :- '+skuResponce.category+'  <b>Sub-Category</b> :- '+skuResponce.subcategory+'</h5></div>';
                  //             inOutHtml += '<div class="col-md-6">';
                  //               inOutHtml += '<div class="table-responsive" id="inWardsData">';
                                  
                  //               inOutHtml += '</div>'; 
                  //             inOutHtml += '</div>'; 
                  //             inOutHtml += '<div class="col-md-6">';
                  //               inOutHtml += '<div class="table-responsive" id="outWardsData">';
                                  
                  //               inOutHtml += '</div>'; 
                  //             inOutHtml += '</div>'; 
                  //           inOutHtml += '</div>';

                  //           $('#inwordOutwardData').append(inOutHtml);


                  //           inHtml += '<table class="table">';
                  //             inHtml += '<thead>';
                  //               inHtml += '<tr>';
                  //                 inHtml += '<th colspan="6"><center>In-Wards</center></th>';
                  //               inHtml += '</tr>';
                  //                 inHtml += '<tr>';
                  //                 inHtml += '<th>Entry</th>';
                  //                 inHtml += '<th>Supplier</th>';
                  //                 inHtml += '<th>Quantity</th>';
                  //                 inHtml += '<th>Rate</th>';
                  //                 inHtml += '<th>Value</th>';
                  //                 inHtml += '<th>MRP</th>';
                  //               inHtml += '</tr>';
                  //             inHtml += '</thead>';
                  //             inHtml += '<tbody id="inwardResponceBody">';

                  //             inHtml += '</tbody>';
                  //             inHtml += '<tfoot>';
                  //               inHtml += '<tr>';
                  //               inHtml += '<td> Total Inward :- </td>';
                  //               inHtml += '<td> &nbsp; </td>';
                  //               inHtml += '<td><span id="inwardResponceQty"></span></td>';
                  //               inHtml += '<td><span id="inwardResponceRate"></span></td>';
                  //               inHtml += '<td><span id="inwardResponceValue"></span></td>';
                  //               inHtml += '<td> &nbsp; </td>';
                  //             inHtml += '</tr>';
                  //             inHtml += '</tfoot>';
                  //           inHtml += '</table>';

                  //           $('#inWardsData').append(inHtml);

                  //           var i=0;
                  //           var arrInward = [];

                  //           $.each(response, function(index, value) {

                  //               arrInward[i++] = value; 
                  //           });
                              
                  //           // console.log(arrInward);
                             
                  //           var inwardNewResponce = removeDumplicateValue(arrInward);
                            

                  //           $.each(inwardNewResponce, function(index, value) {

                  //               if(value.purchase_type == 'popeningstock')
                  //               {
                  //                   myorder_id = value.order_id;
                  //                   myorderitem_id = value.orderitem_id;
                  //                   ptype = value.purchase_type;

                  //                   inWardsDataLink = 'globalsearch/openingStockInWardsData/';
                  //                   // outWardsDataLink = 'globalsearch/openingStockOutWardsData/';

                  //                   datastring = "purchase_id="+myorder_id+"&product_id="+myorderitem_id;
                  //               }
                  //               if(value.purchase_type == 'production')
                  //               {
                  //                   myorder_id = value.order_id;
                  //                   myorderitem_id = value.orderitem_id;
                  //                   ptype = value.purchase_type;

                  //                   inWardsDataLink = 'globalsearch/openingStockInWardsData/';
                  //                   // outWardsDataLink = 'globalsearch/openingStockOutWardsData/';

                  //                   datastring = "purchase_id="+myorder_id+"&product_id="+myorderitem_id;
                  //               }
                  //               else if(ptype == 'pinvoice')
                  //               {
                  //                   myorder_id = value.order_id;
                  //                   myorderitem_id = value.orderitem_id;
                  //                   ptype = value.purchase_type;

                  //                   inWardsDataLink = 'globalsearch/purchaseInvoiceInWardsData';
                  //                   // outWardsDataLink = 'globalsearch/purchaseInvoiceOutWardsData';

                  //                   datastring = "purchase_id="+myorder_id+"&product_id="+myorderitem_id;
                  //               }

                  //               $.ajax({

                  //                   url : base_url + inWardsDataLink,
                  //                   method : "POST",
                  //                   data : datastring,
                  //                   dataType: 'JSON',
                  //                   cache:false,
                  //                   success:function(inwardResponce){

                  //                     // $('#inwardResponceBody').html();

                  //                       var a = '<a href="'+base_url+value.url+'" target="_blank">'+value.invoice_no+'</a>';
                  //                       // console.log(inwardResponce)
                  //                       inHtml1 += '<tr>';
                  //                         inHtml1 += '<td>'+value.name+" "+a+'</td>';
                  //                         inHtml1 += '<td>'+inwardResponce.ledger_name+'</td>';
                  //                         inHtml1 += '<td>'+inwardResponce.qty+'</td>';
                  //                         inHtml1 += '<td>'+inwardResponce.baseprice+'</td>';
                  //                         inHtml1 += '<td>'+inwardResponce.netprice+'</td>';
                  //                         inHtml1 += '<td>'+inwardResponce.mrp+'</td>';
                  //                       inHtml1 += '</tr>';
                                        
                  //                       inwardQuantity = parseFloat(inwardQuantity) + parseFloat(inwardResponce.qty);
                  //                       inwardRate = parseFloat(inwardRate) + parseFloat(inwardResponce.baseprice);
                  //                       inwardValue = parseFloat(inwardValue) + parseFloat(inwardResponce.netprice);


                  //                       countInwardsData(inwardQuantity, inwardRate, inwardValue);

                  //                     $('#inwardResponceBody').html(inHtml1);
                  //                   }
                  //               });
                  //           });

                  //       }
                  //   });





// ###########################################################
// OutWards Data Calculation
// ###########################################################

                    

                    // Outwords Data
                    if(response.order_id != null || response.order_id != '')
                    {
                        // $('#showData').html(table);

                        // var html = inOutHtml = inHtml = outHtml = inWardsDataLink = outWardsDataLink = datastring = '';

                        // var row_id = 1;
                        // var purchase_type = anchortag = orderitemaction = '';
                        // var myorderitem_id = myorder_id = ptype = '';

                        // alert("hi");

                        

                      var outWardsDataLink = 'globalsearch/outWardsDataBySKU';
                      var outHtml1 = outwardQuantity = outwardRate = outwardValue = 0; 
                      $.ajax({

                          url : base_url + outWardsDataLink,
                          method : "POST",
                          data : {sku:sku},
                          dataType: 'JSON',
                          cache:false,
                          success:function(outwardResponce){

                              // console.log(outwardResponce);

                              outHtml += '<table class="table">';
                            // outHtml += '<thead>';
                              outHtml += '<tr>';
                                outHtml += '<th colspan="6"><center>Out-Wards</center></th>';
                              outHtml += '</tr>';
                              outHtml += '<tr>';
                                outHtml += '<th>Entry</th>';
                                outHtml += '<th>Customer</th>';
                                outHtml += '<th>Quantity</th>';
                                outHtml += '<th>Rate</th>';
                                outHtml += '<th>MRP</th>';
                              outHtml += '</tr>';
                            // outHtml += '</thead>';

                              $.each(outwardResponce, function(index, value) {

                                    var a = '<a href="'+base_url+value.url+'" target="_blank">'+value.invoice_no+'</a>';

                                    outHtml += '<tr>';
                                      outHtml += '<th>'+value.name+" "+a+'</th>';
                                      outHtml += '<th>'+value.customer+'</th>';
                                      outHtml += '<th>'+value.qty+'</th>';
                                      outHtml += '<th>'+value.mrp+'</th>';
                                      outHtml += '<th>'+value.finalprice+'</th>';
                                    outHtml += '</tr>';

                                    outwardQuantity = parseFloat(outwardQuantity) + parseFloat(value.qty);
                                    outwardRate = parseFloat(outwardRate) + parseFloat(value.mrp);
                                    outwardValue = parseFloat(outwardValue) + parseFloat(value.finalprice);


                                    // alert(outHtml1);
                                    // console.log(value.qty);
                                    // console.log(outwardQuantity);
                                    // console.log(outwardRate);
                                    // console.log(outwardValue);

                                });

                                // outHtml += '<tbody id="outwarddataResponse">';
                            // outHtml += '</tbody>';
                               outHtml += '<tr>';
                                outHtml += '<th>&nbsp; Total Outward: </th>';
                                outHtml += '<th>&nbsp;</th>';
                                outHtml += '<th>&nbsp; <span id="outwardQty"></span> </th>';
                                outHtml += '<th>&nbsp; <span id="outwardRate"></span></th>';
                                outHtml += '<th>&nbsp; <span id="outwardMRP"></span></th>';
                              outHtml += '</tr>';
                              outHtml += '<tr>';
                                outHtml += '<th>&nbsp;</th>';
                                outHtml += '<th>&nbsp;</th>';
                                outHtml += '<th colspan="2">Available Stock :- <span id="balSKUQty"></span></th>';
                                // outHtml += '<th colspan="2">Soldout Stock :- </th>';
                                outHtml += '<th></th>';
                              outHtml += '</tr>';
                            // outHtml += '</tfooter>';

                      outHtml += '</table>';

                       // alert(outHtml);
                      $('#skuOutWardData').append(outHtml);

                                    countOutWardsData(outwardQuantity, outwardRate, outwardValue);
                               

                                // $('#outwarddataResponse').html(outHtml1);


                              
                          }
                      });

                         




                            
                           
                    }

                    

                  // if(response.order_id != null || response.order_id != '')
                  // {
                      // $('#showData').html(table);

                      // var html = inOutHtml = inHtml = outHtml = inWardsDataLink = outWardsDataLink = datastring = '';

                      // // var obj = jQuery.parseJSON(response.data);
                      // var row_id = 1;
                      // var purchase_type = anchortag = orderitemaction = '';
                      // var myorderitem_id = myorder_id = ptype = '';

                      // $.each(response.data, function(key,value) {

                      //   if(value.purchase_type == 'popeningstock')
                      //   {
                      //       anchortag = '<a href="'+base_url+'opening_stock/update/'+value.order_id+'">'+value.order_id+'</a>';
                      //       purchase_type = 'Opening Stock Number : '+anchortag;

                      //       orderitemaction = '<a href="'+base_url+'opening_stockitem/update/'+value.orderitem_id+'"> Edit </a>';

                      //       myorder_id = value.order_id;
                      //       myorderitem_id = value.orderitem_id;
                      //       ptype = value.purchase_type;
                      //   }
                      //   else
                      //   {
                      //       anchortag = '<a href="'+base_url+'purchase_invoice/update/'+value.order_id+'">'+value.order_id+'</a>';
                      //       purchase_type = 'Purchase Invoice Number : '+anchortag;

                      //       orderitemaction = '<a href="'+base_url+'purchase_invoiceitem/update/'+value.orderitem_id+'/'+value.order_id+'"> Edit </a>';
                      //       // purchase_invoiceitem/update/54/38

                      //       myorder_id = value.order_id;
                      //       myorderitem_id = value.orderitem_id;
                      //       ptype = value.purchase_type;
                      //   }

                  //       // alert(value.barcode);
                  //       html += '<tr id="row_'+row_id+'">';
                  //         html += '<td>';
                  //           html += '<input type="hidden" value="'+value.barcode+'" id="barcode_'+row_id+'">'
                  //           html += '<span>'+value.barcode+'</span>';
                  //         html += '</td>';
                  //         html += '<td>';
                  //           html += '<span>'+value.color+'</span>';
                  //         html += '</td>';
                  //         html += '<td>';
                  //           html += '<span>'+value.size+'</span>';
                  //         html += '</td>';
                  //         html += '<td>';
                  //           html += '<span>'+value.pattern+'</span>';
                  //         html += '</td>';
                  //         html += '<td>';
                  //           html += '<span>'+value.style1+'"</span>';
                  //         html += '</td>';
                  //         html += '<td>';
                  //           html += '<span>'+value.style2+'</span>';
                  //         html += '</td>';
                  //         html += '<td>';
                  //           html += '<span>'+value.type+'</span>';
                  //         html += '</td>';
                  //         html += '<td>';
                  //           html += '<span>'+value.qty+'<span>';
                  //         html += '</td>';
                  //         html += '<td>';
                  //           html += '<span> '+purchase_type+'<span>';
                  //         html += '</td>';
                  //         html += '<td>';
                  //           html += '<span>'+ orderitemaction +' '+value.item_status+'<span>';
                  //         html += '</td>';
                  //       html += '</tr>';

                  //       row_id++;

                  //     });


                  //     $('#productTable').append(html);

                  //     $.ajax({

                  //       url : base_url + 'sku/getGlobalSearchData/',
                  //       method : "POST",
                  //       data : {sku:sku},
                  //       dataType: 'json',
                  //       success:function(skuResponce){

                  //             inOutHtml += '<div class="col-md-12">';
                  //               inOutHtml += '<div><center><b><h4> SKU Summary<h4></b></center></div>';
                  //               inOutHtml += '<div><h5><b>SKU</b> :- '+sku+'  <b>Category</b> :- '+skuResponce.category+'  <b>Sub-Category</b> :- '+skuResponce.subcategory+'</h5></div>';
                  //               inOutHtml += '<div class="col-md-6">';
                  //                 inOutHtml += '<div class="table-responsive" id="inWardsData">';
                                    
                  //                 inOutHtml += '</div>'; 
                  //               inOutHtml += '</div>'; 
                  //               inOutHtml += '<div class="col-md-6">';
                  //                 inOutHtml += '<div class="table-responsive" id="outWardsData">';
                                    
                  //                 inOutHtml += '</div>'; 
                  //               inOutHtml += '</div>'; 
                  //             inOutHtml += '</div>';

                  //             $('#inwordOutwardData').append(inOutHtml);

                  //             // Show Inwards Data
                  //             if(ptype == 'popeningstock')
                  //             {
                  //                 inWardsDataLink = 'globalsearch/openingStockInWardsData/';
                  //                 outWardsDataLink = 'globalsearch/openingStockOutWardsData/';

                  //                 datastring = "purchase_id="+myorder_id+"&product_id="+myorderitem_id;
                  //             }
                  //             else
                  //             {
                  //                 inWardsDataLink = 'globalsearch/purchaseInvoiceInWardsData';
                  //                 outWardsDataLink = 'globalsearch/purchaseInvoiceOutWardsData';

                  //                 datastring = "purchase_id="+myorder_id+"&product_id="+myorderitem_id;
                  //                 // purchase_invoiceitem/update/54/38
                  //             }
                  //             // alert(datastring);
                  //             // for Display Inwards Data
                  //             $.ajax({

                  //               url : base_url + inWardsDataLink,
                  //               method : "POST",
                  //               data : datastring,
                  //               dataType: 'JSON',
                  //               cache:false,
                  //               success:function(inwardResponce){

                  //                 // console.log(inwardResponce);
                  //                 inHtml += '<table class="table">';
                  //                   inHtml += '<tr>';
                  //                     inHtml += '<th colspan="6"><center>In-Wards</center></th>';
                  //                   inHtml += '</tr>';
                  //                   inHtml += '<tr>';
                  //                     inHtml += '<th>Entry</th>';
                  //                     inHtml += '<th>Supplier</th>';
                  //                     inHtml += '<th>Quantity</th>';
                  //                     inHtml += '<th>Rate</th>';
                  //                     inHtml += '<th>Value</th>';
                  //                     inHtml += '<th>MRP</th>';
                  //                   inHtml += '</tr>';

                  //                   inHtml += '<tr>';
                  //                     inHtml += '<td>'+purchase_type+'</td>';
                  //                     inHtml += '<td>'+inwardResponce.ledger_name+'</td>';
                  //                     inHtml += '<td>'+inwardResponce.qty+'</td>';
                  //                     inHtml += '<td>'+inwardResponce.baseprice+'</td>';
                  //                     inHtml += '<td>'+inwardResponce.netprice+'</td>';
                  //                     inHtml += '<td>'+inwardResponce.mrp+'</td>';
                  //                   inHtml += '</tr>';
                  //                   inHtml += '<tr>';
                  //                     inHtml += '<td> Total Inward :- </td>';
                  //                     inHtml += '<td> &nbsp; </td>';
                  //                     inHtml += '<td>'+inwardResponce.qty+'</td>';
                  //                     inHtml += '<td>'+inwardResponce.baseprice+'</td>';
                  //                     inHtml += '<td>'+inwardResponce.netprice+'</td>';
                  //                     inHtml += '<td> &nbsp; </td>';
                  //                   inHtml += '</tr>';

                  //                 inHtml += '</table>';
                  //                 $('#inWardsData').append(inHtml);

                  //               }
                  //             });

                  //             var soldCount = '';
                  //             $.ajax({

                  //               url : base_url + outWardsDataLink,
                  //               method : "POST",
                  //               data : datastring,
                  //               dataType: 'JSON',
                  //               cache:false,
                  //               success:function(outwardResponce){

                  //                   // console.log(outwardResponce);
                  //                   outHtml += '<table class="table">';
                  //                     outHtml += '<tr>';
                  //                       outHtml += '<th colspan="6"><center>Out-Wards</center></th>';
                  //                     outHtml += '</tr>';
                  //                     outHtml += '<tr>';
                  //                       outHtml += '<th>Entry</th>';
                  //                       outHtml += '<th>Customer</th>';
                  //                       outHtml += '<th>Quantity</th>';
                  //                       outHtml += '<th>Rate</th>';
                  //                       outHtml += '<th>Value</th>';
                  //                     outHtml += '</tr>';

                  //                     $.each(outwardResponce.data, function(key,value) {

                  //                         outHtml += '<tr>';
                  //                           outHtml += '<th>Sales Invoice Number:- <a href="'+base_url+'sales_invoice/update/'+value.salesinvoiceid+'" >'+value.salesinvoiceno+'<a></th>';
                  //                           outHtml += '<th>'+value.ledger_name+'</th>';
                  //                           outHtml += '<th>'+value.qty+'</th>';
                  //                           outHtml += '<th>'+value.mrp+'</th>';
                  //                           outHtml += '<th>'+value.finalprice+'</th>';
                  //                         outHtml += '</tr>';


                  //                         soldCount = value.count;
                  //                     });

                  //                         outHtml += '<tr>';
                  //                           outHtml += '<th>&nbsp;</th>';
                  //                           outHtml += '<th>&nbsp;</th>';
                  //                           outHtml += '<th colspan="2">Available Stock :- </th>';
                  //                           outHtml += '<th colspan="2">Soldout Stock :- </th>';
                  //                           outHtml += '<th>'+soldCount+'</th>';
                  //                         outHtml += '</tr>';
                  //                   outHtml += '</table>';
                  //                   $('#outWardsData').append(outHtml);

                  //               }
                  //             });
                  //         }
                  //       });
                  // }
              }
        }); 
    }
</script>

<script type="text/javascript">
    
    var base_url = "<?php echo base_url(); ?>";

    function getProductDataByBarcode() {
      
        var barcode = $('#barcode').val();
        // alert(barcode);
        var sku='';
        $.ajax({

            url : base_url + "globalsearch/getSKU",
            method : "POST",
            data : {barcode:barcode},
            dataType: 'JSON',
            cache:false,
            success:function(response){

                sku = response.sku;

               console.log(response);

                  var table = inHtml = '';

                  inHtml += '<div class="col-md-12">';
                  inHtml += '<div>';
                    inHtml += '<h3>SKU Summary </h3>';
                  inHtml += '</div>';
                    inHtml += '<p><b>SKU </b>: <span>'+response.sku+'</span> &nbsp;&nbsp; <b>Category </b>: '+response.cat+' &nbsp;&nbsp; <b>Sub-Category </b>: '+response.subcat+'</p>';
                  inHtml += '</div>';
                  inHtml += '<div class="col-md-6">';
                    inHtml += '<table class="table">';
                      inHtml += '<thead>';
                        inHtml += '<tr>';
                          inHtml += '<th colspan="6"><center>In-Wards</center></th>';
                        inHtml += '</tr>';
                          inHtml += '<tr>';
                          inHtml += '<th>Entry</th>';
                          inHtml += '<th>Supplier</th>';
                          inHtml += '<th>Quantity</th>';
                          inHtml += '<th>Rate</th>';
                          inHtml += '<th>Value</th>';
                          inHtml += '<th>MRP</th>';
                        inHtml += '</tr>';
                      inHtml += '</thead>';
                      inHtml += '<tbody>';
     
                            var a = '<a href="'+base_url+response.url+'" target="_blank">'+response.invoice_no+'</a>';

                            var value1 = response.qty * response.rate;
                            value1 = (value1).toFixed(3);

                            inHtml += '<tr>';
                              inHtml += '<td>'+response.name+" "+a+'</td>';
                              inHtml += '<td>'+response.supplier+'</td>';
                              inHtml += '<td>'+response.qty+'</td>';
                              inHtml += '<td>'+response.rate+'</td>';
                              inHtml += '<td>'+value1+'</td>';
                              inHtml += '<td>'+response.mrp+'</td>';
                            inHtml += '</tr>';

                      inHtml += '</tbody>';
                      inHtml += '<tfoot>';
                        inHtml += '<tr>';
                        inHtml += '<td> Total Inward :- </td>';
                        inHtml += '<td> &nbsp; </td>';
                        inHtml += '<td><span id="inwardQuantityBarcode">'+response.qty+'</span></td>';
                        inHtml += '<td><span>'+response.rate+'</span></td>';
                        inHtml += '<td><span>'+value1+'</span></td>';
                        inHtml += '<td><span></span></td>';
                        inHtml += '<td> &nbsp; </td>';
                      inHtml += '</tr>';
                      inHtml += '</tfoot>';
                    inHtml += '</table>';
                  inHtml += '</div>';
                  inHtml += '<div class="col-md-6" id="skuOutWardDataByBarcode">';

                  inHtml += '</div>';
                  inHtml += '<div class="col-md-12">';
                    inHtml += '<table class="table">';
                      inHtml += '<tr>';
                        inHtml += '<th>Serial Number</th>';
                        inHtml += '<th>Color</th>';
                        inHtml += '<th>Size</th>';
                        inHtml += '<th>Texture/Pattern</th>';
                        inHtml += '<th>Style1</th>';
                        inHtml += '<th>Style2</th>';
                        inHtml += '<th>Type</th>';
                        inHtml += '<th>Quantity</th>';
                        inHtml += '<th>Inwards</th>';
                        inHtml += '<th>Action</th>';
                      inHtml += '</tr>';
                      inHtml += '<tr>';
                        inHtml += '<td>';
                          inHtml += '<input type="hidden" value="'+response.barcode+'">'
                          inHtml += '<span>'+response.barcode+'</span>';
                        inHtml += '</td>';
                        inHtml += '<td>';
                          inHtml += '<span>'+response.color+'</span>';
                        inHtml += '</td>';
                        inHtml += '<td>';
                          inHtml += '<span>'+response.size+'</span>';
                        inHtml += '</td>';
                        inHtml += '<td>';
                          inHtml += '<span>'+response.pattern+'</span>';
                        inHtml += '</td>';
                        inHtml += '<td>';
                          inHtml += '<span>'+response.style1+'"</span>';
                        inHtml += '</td>';
                        inHtml += '<td>';
                          inHtml += '<span>'+response.style2+'</span>';
                        inHtml += '</td>';
                        inHtml += '<td>';
                          inHtml += '<span>'+response.type+'</span>';
                        inHtml += '</td>';
                        inHtml += '<td>';
                          inHtml += '<span>'+response.qty+'<span>';
                        inHtml += '</td>';
                        inHtml += '<td>';
                          inHtml += '<span> '+response.name+a+'<span>';
                        inHtml += '</td>';
                        inHtml += '<td>';
                          inHtml += '<span>'+response.item_status+'<span>';
                        inHtml += '</td>';
                      inHtml += '</tr>';
                    inHtml += '</table>';
                  inHtml += '</div>';

                  $('#showData').html(inHtml);



                  // countInwardsData(inwardQuantity, inwardRate, inwardValue);
                  
                  // table += '<div id="inwordOutwardData">';
                  // table += '</div>';
                  // table += '<br><br><br><br>';
                  // table += '<div class="table-responsive col-md-12">';
                  //   table += '<table class="table" id="productDataTable">';
                  //     table += '<thead>';
                  //        table += '<tr>';
                  //         table += '<th>Product Number</th>';
                  //         table += '<th>Color</th>';
                  //         table += '<th>Size</th>';
                  //         table += '<th>Texture/Pattern</th>';
                  //         table += '<th>Style1</th>';
                  //         table += '<th>Style2</th>';
                  //         table += '<th>Type</th>';
                  //         table += '<th>Quantity</th>';
                  //         table += '<th>Inwards</th>';
                  //         table += '<th>Action</th>';
                  //       table += '</tr>';
                  //       table += '<tbody id="productTable">';

                  //       table += '</tbody>';
                  //     table += '</thead>';
                  //   table += '</table>';
                  // table += '</div>';


                  // if(response != null || response != '')
                  // {
                  //     $('#showData').html(table);
                      
                  //     var html = inOutHtml = inHtml = outHtml = inWardsDataLink = outWardsDataLink = datastring = purchase_type = anchortag = orderitemaction = myorderitem_id = myorder_id = ptype = '';


                      // if(response.purchase_type == 'popeningstock')
                      // {
                      //     anchortag = '<a href="'+base_url+'opening_stock/update/'+response.order_id+'">'+response.order_id+'</a>';
                      //     purchase_type = 'Opening Stock Number : '+anchortag;

                      //     orderitemaction = '<a href="'+base_url+'opening_stockitem/update/'+response.orderitem_id+'"> Edit </a>';

                      //     myorder_id = response.order_id;
                      //     myorderitem_id = response.orderitem_id;
                      //     ptype = response.purchase_type;
                      // }
                      // else
                      // {
                      //     anchortag = '<a href="'+base_url+'purchase_invoice/update/'+response.order_id+'">'+response.order_id+'</a>';
                      //     purchase_type = 'Purchase Invoice Number : '+anchortag;

                      //     orderitemaction = '<a href="'+base_url+'purchase_invoiceitem/update/'+response.orderitem_id+'/'+response.order_id+'"> Edit </a>';
                      //     // purchase_invoiceitem/update/54/38

                      //     myorder_id = response.order_id;
                      //     myorderitem_id = response.orderitem_id;
                      //     ptype = response.purchase_type;
                      // }

                        // html += '<tr>';
                        //   html += '<td>';
                        //     html += '<input type="hidden" value="'+response.barcode+'">'
                        //     html += '<span>'+response.barcode+'</span>';
                        //   html += '</td>';
                        //   html += '<td>';
                        //     html += '<span>'+response.color+'</span>';
                        //   html += '</td>';
                        //   html += '<td>';
                        //     html += '<span>'+response.size+'</span>';
                        //   html += '</td>';
                        //   html += '<td>';
                        //     html += '<span>'+response.pattern+'</span>';
                        //   html += '</td>';
                        //   html += '<td>';
                        //     html += '<span>'+response.style1+'"</span>';
                        //   html += '</td>';
                        //   html += '<td>';
                        //     html += '<span>'+response.style2+'</span>';
                        //   html += '</td>';
                        //   html += '<td>';
                        //     html += '<span>'+response.type+'</span>';
                        //   html += '</td>';
                        //   html += '<td>';
                        //     html += '<span>'+response.qty+'<span>';
                        //   html += '</td>';
                        //   html += '<td>';
                        //     html += '<span> '+purchase_type+'<span>';
                        //   html += '</td>';
                        //   html += '<td>';
                        //     html += '<span>'+ orderitemaction +' '+response.item_status+'<span>';
                        //   html += '</td>';
                        // html += '</tr>';

                        // $('#productTable').append(html);

                        // alert(sku);
                        // $.ajax({
                        //   url : base_url + 'sku/getGlobalSearchData/',
                        //   method : "POST",
                        //   data : {sku:sku},
                        //   dataType: 'json',
                        //   success:function(skuResponce){

                        //         // console.log(skuResponce);
                        //         inOutHtml += '<div class="col-md-12">';
                        //           inOutHtml += '<div><b><h4> SKU Details<h4></b></div>';
                        //           inOutHtml += '<div><h5><b>SKU</b> :- '+sku+'  <b>Category</b> :- '+skuResponce.category+'  <b>Sub-Category</b> :- '+skuResponce.subcategory+'</h5></div>';
                        //           inOutHtml += '<div class="col-md-6">';
                        //             inOutHtml += '<div class="table-responsive" id="inWardsData">';
                                      
                        //             inOutHtml += '</div>'; 
                        //           inOutHtml += '</div>'; 
                        //           inOutHtml += '<div class="col-md-6">';
                        //             inOutHtml += '<div class="table-responsive" id="outWardsData">';
                                      
                        //             inOutHtml += '</div>'; 
                        //           inOutHtml += '</div>'; 
                        //         inOutHtml += '</div>';

                        //         $('#inwordOutwardData').append(inOutHtml);


                        //         if(ptype == 'popeningstock')
                        //         {
                        //             inWardsDataLink = 'globalsearch/openingStockInWardsData/';
                        //             outWardsDataLink = 'globalsearch/openingStockOutWardsDataByBarcode/';

                        //             datastring = "purchase_id="+myorder_id+"&product_id="+myorderitem_id+"&barcode="+response.barcode;
                        //         }
                        //         else
                        //         {
                        //             inWardsDataLink = 'globalsearch/purchaseInvoiceInWardsData';
                        //             outWardsDataLink = 'globalsearch/purchaseInvoiceOutWardsDataByBarcode';

                        //             datastring = "purchase_id="+myorder_id+"&product_id="+myorderitem_id+"&barcode="+response.barcode;
                        //             // purchase_invoiceitem/update/54/38
                        //         }

                        //       // alert(datastring);
                        //       // for Display Inwards Data
                        //       $.ajax({

                        //         url : base_url + inWardsDataLink,
                        //         method : "POST",
                        //         data : datastring,
                        //         dataType: 'JSON',
                        //         cache:false,
                        //         success:function(inwardResponce){

                        //           // console.log(inwardResponce);
                        //           inHtml += '<table class="table">';
                        //             inHtml += '<tr>';
                        //               inHtml += '<th colspan="6"><center>In-Wards</center></th>';
                        //             inHtml += '</tr>';
                        //             inHtml += '<tr>';
                        //               inHtml += '<th>Entry</th>';
                        //               inHtml += '<th>Supplier</th>';
                        //               inHtml += '<th>Quantity</th>';
                        //               inHtml += '<th>Rate</th>';
                        //               inHtml += '<th>Value</th>';
                        //               inHtml += '<th>MRP</th>';
                        //             inHtml += '</tr>';

                        //             inHtml += '<tr>';
                        //               inHtml += '<td>'+purchase_type+'</td>';
                        //               inHtml += '<td>'+inwardResponce.ledger_name+'</td>';
                        //               inHtml += '<td>'+inwardResponce.qty+'</td>';
                        //               inHtml += '<td>'+inwardResponce.baseprice+'</td>';
                        //               inHtml += '<td>'+inwardResponce.netprice+'</td>';
                        //               inHtml += '<td>'+inwardResponce.mrp+'</td>';
                        //             inHtml += '</tr>';
                        //             inHtml += '<tr>';
                        //               inHtml += '<td> Total Inward :- </td>';
                        //               inHtml += '<td> &nbsp; </td>';
                        //               inHtml += '<td>'+inwardResponce.qty+'</td>';
                        //               inHtml += '<td>'+inwardResponce.baseprice+'</td>';
                        //               inHtml += '<td>'+inwardResponce.netprice+'</td>';
                        //               inHtml += '<td> &nbsp; </td>';
                        //             inHtml += '</tr>';

                        //           inHtml += '</table>';


                        //           $('#inWardsData').append(inHtml);

                        //         }
                        //       });

                        //       var soldCount = '';
                        //       $.ajax({

                        //         url : base_url + outWardsDataLink,
                        //         method : "POST",
                        //         data : datastring,
                        //         dataType: 'JSON',
                        //         cache:false,
                        //         success:function(outwardResponce){

                        //             // console.log(outwardResponce);
                        //             outHtml += '<table class="table">';
                        //               outHtml += '<tr>';
                        //                 outHtml += '<th colspan="6"><center>Out-Wards</center></th>';
                        //               outHtml += '</tr>';
                        //               outHtml += '<tr>';
                        //                 outHtml += '<th>Entry</th>';
                        //                 outHtml += '<th>Customer</th>';
                        //                 outHtml += '<th>Quantity</th>';
                        //                 outHtml += '<th>Rate</th>';
                        //                 outHtml += '<th>Value</th>';
                        //               outHtml += '</tr>';

                        //                   outHtml += '<tr>';
                        //                     outHtml += '<th>Sales Invoice Number:- <a href="'+base_url+'sales_invoice/update/'+outwardResponce.salesinvoiceid+'" >'+outwardResponce.salesinvoiceno+'<a></th>';
                        //                     outHtml += '<th>'+outwardResponce.ledger_name+'</th>';
                        //                     outHtml += '<th>'+outwardResponce.qty+'</th>';
                        //                     outHtml += '<th>'+outwardResponce.mrp+'</th>';
                        //                     outHtml += '<th>'+outwardResponce.finalprice+'</th>';
                        //                   outHtml += '</tr>';

                        //                   // soldCount = outwardResponce.count;
                                      
                        //                   // outHtml += '<tr>';
                        //                   //   outHtml += '<th>&nbsp;</th>';
                        //                   //   outHtml += '<th>&nbsp;</th>';
                        //                   //   outHtml += '<th colspan="2">Soldout Stock :- </th>';
                        //                   //   outHtml += '<th>'+soldCount+'</th>';
                        //                   // outHtml += '</tr>';
                        //             outHtml += '</table>';
                        //             $('#outWardsData').append(outHtml);
                        //         }
                        //       });     
                        //   }
                        // });
                  // }
            }
        });
        
        $.ajax({

            url : base_url + "globalsearch/getBarcodeOutWards",
            method : "POST",
            data : {barcode:barcode},
            dataType: 'JSON',
            cache:false,
            success:function(response){

                var outHtml = '';
                var outwardQuantity = outwardRate = outwardMRP = outwardValue = 0;
                // console.log(response);

                outHtml += '<table class="table">';
                            // outHtml += '<thead>';
                              outHtml += '<tr>';
                                outHtml += '<th colspan="6"><center>Out-Wards</center></th>';
                              outHtml += '</tr>';
                              outHtml += '<tr>';
                                outHtml += '<th>Entry</th>';
                                outHtml += '<th>Customer</th>';
                                outHtml += '<th>Quantity</th>';
                                outHtml += '<th>Rate</th>';
                                outHtml += '<th>Value</th>';
                              outHtml += '</tr>';
                            // outHtml += '</thead>';

                              $.each(response, function(index, value) {

                                    var a = '<a href="'+base_url+value.url+'" target="_blank">'+value.invoice_no+'</a>';

                                    outHtml += '<tr>';
                                      outHtml += '<th>'+value.name+" "+a+'</th>';
                                      outHtml += '<th>'+value.customer+'</th>';
                                      outHtml += '<th>'+value.qty+'</th>';
                                      outHtml += '<th>'+value.mrp+'</th>';
                                      outHtml += '<th>'+value.finalprice+'</th>';
                                    outHtml += '</tr>';

                                    outwardQuantity = parseFloat(outwardQuantity) + parseFloat(value.qty);
                                    outwardRate = parseFloat(outwardRate) + parseFloat(value.mrp);
                                    outwardValue = parseFloat(outwardValue) + parseFloat(value.finalprice);

                                });

                                // outHtml += '<tbody id="outwarddataResponse">';
                            // outHtml += '</tbody>';
                               outHtml += '<tr>';
                                outHtml += '<th>&nbsp; Total Outward: </th>';
                                outHtml += '<th>&nbsp;</th>';
                                outHtml += '<th>&nbsp; <span id="outwardQtyBarcode"></span> </th>';
                                outHtml += '<th>&nbsp; <span id="outwardRateBarcode"></span></th>';
                                outHtml += '<th>&nbsp; <span id="outwardMRPBarcode"></span></th>';
                              outHtml += '</tr>';
                              outHtml += '<tr>';
                                outHtml += '<th>&nbsp;</th>';
                                outHtml += '<th>&nbsp;</th>';
                                outHtml += '<th colspan="2">Available Stock :- <span id="balBarcodeQty"></span></th>';
                                // outHtml += '<th colspan="2">Soldout Stock :- </th>';
                                outHtml += '<th></th>';
                              outHtml += '</tr>';
                            // outHtml += '</tfooter>';

                      outHtml += '</table>';

                       $('#skuOutWardDataByBarcode').append(outHtml);

                      countOutWardsDataBarcode(outwardQuantity, outwardRate, outwardValue);
                               
            }
        });
    }

    function removeDumplicateValue(myArray)
    {
      var newArray = [];
      
      $.each(myArray, function(key, value) {

        var exists = false;

        $.each(newArray, function(k, val2) {

          if(value.order_id == val2.order_id){ exists = true }; 

        });

        if(exists == false && value.id != "") { newArray.push(value); }

      });

      return newArray;
    }

    function countInwardsData(inwardQuantity, inwardRate, inwardValue){
    
        $('#inwardResponceQty').text(inwardQuantity);
        $('#inwardResponceRate').text(inwardRate);
        $('#inwardResponceValue').text(inwardValue);

        count();
    }


    function countOutWardsData(outwardQuantity, outwardRate, outwardValue){
        
        // console.log(outwardQuantity);
        // console.log(outwardRate);
        // console.log(outwardValue);

        var qty = outwardQuantity;
        qty = (qty).toFixed(2);

        var rate = outwardRate;
        rate = (rate).toFixed(3);

        var value = outwardValue;
        value = (value).toFixed(3);

        $('#outwardQty').text(qty);
        $('#outwardRate').text(rate);
        $('#outwardMRP').text(value);

        count();
    }

    function countOutWardsDataBarcode(outwardQuantity, outwardRate, outwardValue){
        
        var qty = outwardQuantity;
        qty = (qty).toFixed(2);

        var rate = outwardRate;
        rate = (rate).toFixed(2);

        var value = outwardValue;
        value = (value).toFixed(2);

        $('#outwardQtyBarcode').text(qty);
        $('#outwardRateBarcode').text(rate);
        $('#outwardMRPBarcode').text(value);

        count1();
    }

    function count() {

        var qtyInwards = parseFloat($('#inwardResponceQty').text());
        var qtyOutwards = parseFloat($('#outwardQty').text());

        // console.log(qtyInwards);
        // console.log(qtyOutwards);

        var bal = qtyInwards - qtyOutwards;
        // console.log(bal);

        bal = (bal).toFixed(2);
        $('#balSKUQty').text(bal);

    }

    function count1() {

        var qtyInwards = parseFloat($('#inwardQuantityBarcode').text());
        var qtyOutwards = parseFloat($('#outwardQtyBarcode').text());

        var bal = qtyInwards - qtyOutwards;
        bal = (bal).toFixed(2);
        $('#balBarcodeQty').text(bal);
    }

</script>


