<!-- < ?php echo "<pre>"; print_r($ledgerEntries); exit(); print_r($ledger); exit();  ?> -->

<?php
  $cityData = $this->model_state->fecthCityByID($companyDetails['city']);  
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
        Ledger Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ledger Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">

          <form role="form" action="<?php echo base_url() ?>reports/ledgerReportSearch" enctype="multipart/form-data" method="post">
          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Search Ledger</label>
                      <input type="text" name="id" list="ledger" value="<?php echo $ledger['ledger_name'] ?>" class="form-control" required autocomplete="off">                      
                      <datalist id="ledger">
                        <?php foreach($ledgerList as $rows): ?>  
                          <option value="<?php echo $rows['ledger_name']; ?>"><?php echo $rows['ledger_name']; ?></option>
                        <?php endforeach; ?>
                      </datalist>
                    </div>
                  </div>
                 
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Date From</label>
                      <input type="date" name="from" class="form-control" value="<?= set_value('from') ?>">
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Date To</label>
                      <input type="date" name="to" class="form-control" value="<?= set_value('to') ?>">
                    </div>
                  </div>
                  
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                        <br>
                        <input type="submit" name="search" value="Search" class="btn btn-info">
                        <!-- <a href="#" class=" btn btn-info">Search</a> -->
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" name="print" value="Print" class="btn btn-info">
                        <!--<a href="#" class=" btn btn-success">Print</a>-->
                    </div>
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
                                    <h5><b> Ledger Report of <?php echo ucwords($ledger['ledger_name']); ?> </b></h5>
                                </center>
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <table width="95%" align="center" style="margin-top:20px;">
                                    <tr>
                                        <th class="myBorder">&nbsp; Date</th>
                                        <th class="myBorder">&nbsp; Particulars</th>
                                        <!-- <th class="myBorder">&nbsp; Invoice Number</th> -->
                                        <td class="myBorder">&nbsp; Debit</td>
                                        <th class="myBorder">&nbsp; Credit</th>
                                        <th class="myBorder">&nbsp; Balance</th>
                                    </tr>
                                    <tr>
                                      <td class="myBorder">&nbsp; <?php echo "01-04-2017"; ?></td>
                                      <td class="myBorder">&nbsp; <?php echo "Opening Balance"; ?></td>
                                      <td class="myBorder">&nbsp; <?php echo "-"; ?></td>
                                      <td class="myBorder">&nbsp; <?php echo "-"; ?></td>
                                      <td class="myBorder">&nbsp; <?php echo number_format(abs($ledgerEntries['0']['opening_bal']), 2); ?></td>
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
                            </td>
                        </tr>
                        
                    </table>
                    <br>
                    <div align="right">
                        <span>Opening Balance:- <b><?php echo number_format($ledgerEntries[0]['opening_bal'], 2); echo " ".$ledgerEntries[0]['dr_cr']; ?></b></span><br>
                        <span>Closing Balance:- <b><?php echo number_format(abs($clbal), 2); echo " ".$finalDrCr; ?></b></span><br>
                    </div>
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

