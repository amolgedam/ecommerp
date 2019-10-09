<?php
  // echo "<pre>"; print_r($budgetItem_quater); exit();
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
        GST Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">GST Report</li>
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
            <form role="form" action="<?php echo base_url() ?>reports/gstReport" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                    
                    <input type="hidden" name="report" value="budget">

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>Date From</label>
                            <input type="date" name="from" value="<?php echo set_value('from', $postData['from']); ?>" class="form-control" required="">
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>Date To</label>
                            <input type="date" name="to" value="<?php echo set_value('to', $postData['to']); ?>" class="form-control" required="">
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>GST Type</label>
                            <br>
                            <select class="mymulselect form-control" name="gst[]" multiple="multiple">
                                <?php foreach($taxAndDuties as $rows){ ?>
                                    <option value="<?php echo $rows->id; ?>" <?php echo $postData['gst'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>GST Slabs</label>
                            <br>
                            <select class="mymulselect form-control" name="gstslab[]" multiple="multiple">
                                <?php foreach($gst as $rows){ ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->gst_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>


                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div>
                        <br>
                        <!--<a href="#" class=" btn btn-info">Search</a>-->
                        <input type="submit" name="search" value="Search" class="btn btn-success">
                        <!-- <input type="submit" name="print" value="Print" class="btn btn-info"> -->
                    </div>
                  </div>
                              
              </div>
            </div>
          </div>

        </form>
       
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    
                    <table class="table" >
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Particular</th>
                                <th>Debits</th>
                                <th>Credit</th>
                                <th>GST Slab</th>
                                <th>
                                    <!-- GST Bifurcation -->
                                    <!-- <table>
                                      <tr><td colspan="3"><center>GST Bifurcation</center></td></tr>
                                      <tr>
                                          <td style="width: 33%">CGST</td>
                                          <td style="width: 33%">SGST</td>
                                          <td style="width: 33%">IGST</td>
                                      </tr>
                                    </table> -->
                                    <div><center>GST Bifurcation</center></div>
                                    <div class="col-md-4">CGST</div>
                                    <div class="col-md-4">SGST</div>
                                    <div class="col-md-4">IGST</div>
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                              if(isset($postData)){

                                // echo "<pre>"; print_r($postData);

                                if(!empty($postData['gst']))
                                {

                                  $countGST = count($postData['gst']);

                                    $dr = $cr = $totcr = $totdr = 0;
                                  
                                  for ($i=0; $i < $countGST; $i++)
                                  {
                                    $data = array(
                                                    'ledger_id' => $postData['gst'][$i]
                                                );

                                    $data = $this->model_globalsearch->fetchLedgerEntries($data);

                                    // echo "<pre>"; print_r($data);

                                    $date = $part = $drcr = $gstslab = $cgst = $sgst = $igst = '';
                                    foreach ($data as $key => $value) {
                                      
                                        if($value['purchase_type'] == 'pinvoice')
                                        {
                                            $invoiceData = $this->model_purchaseinvoice->fecthAllDatabyID($value['purchase_id']);

                                            $data = array(
                                                            'order_id' => $value['purchase_id'],
                                                            'ordertype' => $value['purchase_type']
                                                        );

                                            $purchaseData = $this->model_purchaseitem->fecthOrderByInvoiceIDType($data);

                                            foreach ($purchaseData as $key => $purchasrValue) {
                                                
                                                $gstData = $this->model_gst->fetchAllDataByID($purchasrValue['gst_id']);
                                            }

                                            $date = $value['invoice_date'];
                                            $part = "Purchase Invoice ".$invoiceData['invoice_no'];
                                            $gstslab = $gstData['gst_name'];
                                            $drcr = $value['dr_cr'];
                                            $amt = $value['amt'];

                                            $cgst = ($amt * $gstData['cgst']) / 100;
                                            $sgst = ($amt * $gstData['sgst']) / 100;
                                            $igst = ($amt * $gstData['igst']) / 100;

                                            $dr = $drcr == 'dr' ? $amt : "-" ;
                                            $cr = $drcr == 'cr' ? $amt : "-" ;

                                            $totdr = $totdr + $dr;
                                            $totcr = $totcr + $cr;
                                        }
                                        else if($value['purchase_type'] == 'purchase_voucher')
                                        {
                                            $invoiceData = $this->model_purchasevoucher->fecthAllDatabyID($value['purchase_id']);

                                            $data = array(
                                                            'pvoucher_id' => $value['purchase_id'],
                                                            'inventory_type' => $value['purchase_type']
                                                        );

                                            $purchaseData = $this->model_purchasevoucher->fetchItemByVoucherID($data);

                                            foreach ($purchaseData as $key => $purchasrValue) {
                                                
                                                $gstData = $this->model_gst->fetchAllDataByID($purchasrValue['gst_id']);
                                            }

                                            $date = $value['invoice_date'];
                                            $part = "Purchase Voucher ".$invoiceData['voucher_no'];

                                            $gstslab = $gstData['gst_name'];
                                            $drcr = $value['dr_cr'];
                                            $amt = $value['amt'];

                                            $cgst = ($amt * $gstData['cgst']) / 100;
                                            $sgst = ($amt * $gstData['sgst']) / 100;
                                            $igst = ($amt * $gstData['igst']) / 100;


                                             $dr = $drcr == 'dr' ? $amt : "-" ;
                                            $cr = $drcr == 'cr' ? $amt : "-" ;

                                            $totdr = $totdr + $dr;
                                            $totcr = $totcr + $cr;

                                        }
                                        else if($value['purchase_type'] == 'purchase_return')
                                        {
                                            $invoiceData = $this->model_purchasereturn->fecthAllDatabyID($value['purchase_id']);

                                            $data = array(
                                                            'inventory_id' => $value['purchase_id'],
                                                            'inventory_type' => $value['purchase_type']
                                                        );

                                            $purchaseData = $this->model_internalconsumption->fecthItemDataByInventoryID($data);

                                            foreach ($purchaseData as $key => $purchasrValue) {
                                                
                                                $gstData = $this->model_gst->fetchAllDataByID($purchasrValue['gst']);
                                            }


                                            $date = $value['invoice_date'];
                                            $part = "Purchase Return ".$invoiceData['order_no'];


                                            $gstslab = $gstData['gst_name'];
                                            $drcr = $value['dr_cr'];
                                            $amt = $value['amt'];

                                            $cgst = ($amt * $gstData['cgst']) / 100;
                                            $sgst = ($amt * $gstData['sgst']) / 100;
                                            $igst = ($amt * $gstData['igst']) / 100;


                                             $dr = $drcr == 'dr' ? $amt : "0" ;
                                            $cr = $drcr == 'cr' ? $amt : "0" ;

                                            $totdr = $totdr + $dr;
                                            $totcr = $totcr + $cr;
                                        }

                                        else if($value['purchase_type'] == 'salesinvoice')
                                        {
                                            $invoiceData = $this->model_salesinvoice->fecthAllDataByID($value['purchase_id']);

                                            $data = array(
                                                            'inventory_id' => $value['purchase_id'],
                                                            'inventory_type' => $value['purchase_type']
                                                        );

                                            $purchaseData = $this->model_salesinvoice->fecthItemDataByIdType($data);

                                            foreach ($purchaseData as $key => $purchasrValue) {
                                                
                                                $gstData = $this->model_gst->fetchAllDataByID($purchasrValue['gst']);
                                            }

                                            $date = $value['invoice_date'];
                                            $part = "Sales Invoice ".$invoiceData['inventory_no'];
                                            $gstslab = $gstData['gst_name'];
                                            $drcr = $value['dr_cr'];
                                            $amt = $value['amt'];

                                            $cgst = ($amt * $gstData['cgst']) / 100;
                                            $sgst = ($amt * $gstData['sgst']) / 100;
                                            $igst = ($amt * $gstData['igst']) / 100;


                                             $dr = $drcr == 'dr' ? $amt : "-" ;
                                            $cr = $drcr == 'cr' ? $amt : "-" ;

                                            $totdr = $totdr + $dr;
                                            $totcr = $totcr + $cr;
                                        }
                                        else if($value['purchase_type'] == 'voucher')
                                        {
                                            $invoiceData = $this->model_salesinvoice->fecthAllDataByID($value['purchase_id']);
                                            // echo "<pre>"; print_r($invoiceData);

                                            $data = array(
                                                          'voucher_id' => $value['purchase_id'],
                                                          'voucher_type' => $value['purchase_type']
                                                        );

                                            $purchaseData = $this->model_vouchers->fecthAllDatabyVoucherID($data);
                                            // echo "<pre>"; print_r($purchaseData);

                                            foreach ($purchaseData as $key => $purchasrValue) {
                                                
                                                $gstData = $this->model_gst->fetchAllDataByID($purchasrValue['gst_id']);
                                            }

                                            $date = $value['invoice_date'];
                                            $part = "Sales Voucher ".$invoiceData['inventory_no'];
                                            $gstslab = $gstData['gst_name'];
                                            $drcr = $value['dr_cr'];
                                            $amt = $value['amt'];

                                            $cgst = ($amt * $gstData['cgst']) / 100;
                                            $sgst = ($amt * $gstData['sgst']) / 100;
                                            $igst = ($amt * $gstData['igst']) / 100;


                                             $dr = $drcr == 'dr' ? $amt : "-" ;
                                            $cr = $drcr == 'cr' ? $amt : "-" ;;

                                            $totdr = $totdr + $dr;
                                            $totcr = $totcr + $cr;
                                        }
                                        else if($value['purchase_type'] == 'wsp')
                                        {
                                            $invoiceData = $this->model_salesinvoice->fecthAllDataByID($value['purchase_id']);
                                            // echo "<pre>"; print_r($invoiceData);

                                            $data = array(
                                                          'id' => $value['purchase_id'],
                                                          'inventory_type' => $value['purchase_type']
                                                        );
                                            $purchaseData = $this->model_internalconsumption->fecthItemDataByInventoryID($data);

                                            foreach ($purchaseData as $key => $purchasrValue) {
                                                
                                                $gstData = $this->model_gst->fetchAllDataByID($purchasrValue['gst']);
                                            }

                                            $date = $value['invoice_date'];
                                            $part = "Sales WSP ".$invoiceData['inventory_no'];
                                            $gstslab = $gstData['gst_name'];
                                            $drcr = $value['dr_cr'];
                                            $amt = $value['amt'];

                                            $cgst = ($amt * $gstData['cgst']) / 100;
                                            $sgst = ($amt * $gstData['sgst']) / 100;
                                            $igst = ($amt * $gstData['igst']) / 100;


                                             $dr = $drcr == 'dr' ? $amt : "-" ;
                                            $cr = $drcr == 'cr' ? $amt : "-" ;

                                            $totdr = $totdr + $dr;
                                            $totcr = $totcr + $cr;
                                        }
                                        else if($value['purchase_type'] == 'salesexchange')
                                        {
                                            $invoiceData = $this->model_salesexchange->fecthAllDataByID($value['purchase_id']);

                                            $data = array(
                                                            'inventory_id' => $invoiceData['invoice_id'],
                                                            'inventory_type' => $value['purchase_type']
                                                          );

                                            $purchaseData = $this->model_salesexchange->fecthAllItemData($data);

                                            foreach ($purchaseData as $key => $purchasrValue) {
                                                
                                                $gstData = $this->model_gst->fetchAllDataByID($purchasrValue['gst']);
                                            }

                                            $date = $value['invoice_date'];
                                            $part = "Sales Exchange ".$invoiceData['exchange_no'];
                                            $gstslab = $gstData['gst_name'];
                                            $drcr = $value['dr_cr'];
                                            $amt = $value['amt'];

                                            $cgst = ($amt * $gstData['cgst']) / 100;
                                            $sgst = ($amt * $gstData['sgst']) / 100;
                                            $igst = ($amt * $gstData['igst']) / 100;


                                             $dr = $drcr == 'dr' ? $amt : "-" ;
                                            $cr = $drcr == 'cr' ? $amt : "-" ;

                                            $totdr = $totdr + $dr;
                                            $totcr = $totcr + $cr;
                                        }
                                  ?>

                                    <tr>
                                      <td><?php echo $date; ?></td>
                                      <td><?php echo $part; ?></td>
                                      <td><?php echo $drcr == 'dr' ? $amt : "-" ; ?></td>
                                      <td><?php echo $drcr == 'cr' ? $amt : "-" ; ?></td>
                                      <td><?php echo $gstslab; ?></td>
                                      <td>
                                          <div class="col-md-4"><?php echo $cgst; ?></div>
                                          <div class="col-md-4"><?php echo $sgst; ?></div>
                                          <div class="col-md-4"><?php echo $igst; ?></div>
                                        <!-- < ?php echo "CGST ".$cgst.",  SGST ".$sgst.",  IGST ".$igst; ?> -->
                                      </td>
                                    </tr>
                                  <?php

                                    }
                                  }
                                }
                                else
                                {
                                    echo "<script>alert('Select GST Type')</script>";
                                }
                              } 
                            ?>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp; Total:- </td>
                                <td><b><?php echo $totdr != '' ? $totdr : "-" ; ?></b></td>
                                <td><b><?php echo $totcr != '' ? $totcr : "-" ; ?></b>  </td>
                                <td>Balance:- <b><?php echo $totdr - $totcr; ?></b></td>
                                <td>&nbsp;</td>
                              </tr>

                        </tbody>
                        
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



