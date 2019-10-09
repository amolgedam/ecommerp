<!-- < ?php echo "<pre>"; print_r($result); exit; ?> -->
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
        Sales Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            <form role="form" action="<?php echo base_url('reports/salesReport'); ?>" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                  
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Type</label>
                      <select name="invoice" class="form-control">
                          <option value="0">Select All Invoice</option>
                          <option value="1" <?php if(isset($_POST['invoice'])){ echo $_POST['invoice'] == '1' ? "selected" : "";} ?> >Sales Invoice/POS/Vouchers</option>
                          <option value="3" <?php if(isset($_POST['invoice'])){ echo $_POST['invoice'] == '3' ? "selected" : "";} ?>>Sales WSP</option>
                          <option value="2" <?php if(isset($_POST['invoice'])){ echo $_POST['invoice'] == '2' ? "selected" : "";} ?>>Sales Exchange/Return</option>
                      </select>
                    </div>
                  </div>
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
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                        <br>
                        <input type="submit" name="search" value="Search" class="btn btn-info">
                        <!--<a href="#" class=" btn btn-info">Search</a>-->
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <!-- <input type="submit" name="print" value="Print" class="btn btn-success"> -->
                        <a href="javascript:void(0)" class="btn btn-success" id="printTable">Print</a>

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
                    
                    <table class="table printMyTable" width="100%" border="1" width="100%">
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
                                    <h5><b>Sales Report</b></h5>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="1" width="100%">
                                    <tr>
                                        <th>&nbsp; Date</th>
                                        <th>&nbsp; Invoice Number</th>
                                        <th>&nbsp; Type</th>
                                        <th>&nbsp; Ledger Account</th>
                                        <th>&nbsp; Gross Amount</th>
                                        <th>&nbsp; GST Amount</th>
                                        <th>&nbsp; Total Amount</th>
                                        <th>&nbsp; Due Date</th>
                                        <th>&nbsp; Balance</th>
                                    </tr>
                                    
                                    <?php 

                                      $gamt = $tax = $adj = $tot = 0; $link=''; $no=1;
                                      $account = $grossAmt = $balance = 0; 

                                      // echo "<pre>"; print_r($result); exit();
                                      foreach($result as $rows): ?>
                                    
                                        <?php
                                            
                                            if(isset($rows['invoice_type']))
                                            {
                                               if($rows['invoice_type'] == 'invoice')
                                                {
                                                    $invoiceno = $rows['inventory_no'];
                                                    $noproduct = $rows['no_ofproducts'];
                                                    $total = $rows['total_invoice'];
                                                    $type = $rows['invoice_type'];

                                                    $grossAmt = $rows['gross_total'];

                                                    $account = $rows['account'];
                                                    
                                                    $tot = $tot + $rows['total_invoice'];
                                                    $link = 'sales_invoice/update/';
                                                }
                                                else if($rows['invoice_type'] == 'pos')
                                                {
                                                    $invoiceno = $rows['inventory_no'];
                                                    $noproduct = $rows['no_ofproducts'];
                                                    $total = $rows['total_invoice'];
                                                    $type = $rows['invoice_type'];

                                                    $grossAmt = $rows['gross_total'];

                                                    $account = $rows['account'];

                                                    
                                                    $tot = $tot + $rows['total_invoice'];
                                                    $link = 'sales_invoice/update/';
                                                }
                                                else if($rows['invoice_type'] == 'voucher')
                                                {
                                                    $invoiceno = $rows['inventory_no'];
                                                    $noproduct = $rows['no_ofproducts'];
                                                    $total = $rows['total_invoice'];
                                                    $type = $rows['invoice_type'];

                                                    $account = $rows['account'];

                                                    $grossAmt = $rows['base_total'];

                                                    $tot = $tot + $rows['total_invoice'];
                                                    $link = 'sales_voucher/update/';
                                                }
                                                else if($rows['invoice_type'] == 'wsp')
                                                {
                                                    $invoiceno = $rows['inventory_no'];
                                                    $noproduct = $rows['no_ofproducts'];
                                                    $total = $rows['total_invoice'];
                                                    $type = $rows['invoice_type'];

                                                    $account = $rows['account'];

                                                    $grossAmt = $rows['base_total'];

                                                    $tot = $tot + $rows['total_invoice'];
                                                    $link = 'wsp/update/';
                                            
                                                }
                                            }
                                            else if(isset($rows['invcentory_type']))
                                            {

                                                $invoiceno = $rows['exchange_no'];
                                                $noproduct = 1;
                                                $total = $rows['total_invoicevalue'];
                                                $type = $rows['invcentory_type'];

                                                $grossAmt = $rows['gross_total'];

                                                $account = $rows['account_id'];

                                                $tot = $tot + $rows['total_invoicevalue'];
                                                $link = 'sales_exchange/update/';
                                            }
                                            // echo "Ledger Account<pre>"; print_r($account); echo "<br>";
                                            $account = $this->model_ledger->fecthAllDatabyID($account);
                                            
                                            $gamt = $gamt + $grossAmt;
                                            $tax = $tax + $rows['total_tax'];
                                            $adj = $adj + $rows['adjustment'];

                                            $balance = $balance + $total;
                                            
                                        ?>
                                        <tr>
                                            <td>&nbsp; <?php echo date('d-m-Y', strtotime($rows['date'])); ?></td>

                                            <td>&nbsp; <a href="<?php echo base_url().$link.$rows['id'] ?>"><?php echo $invoiceno; ?></a></td>
                                            <td>&nbsp; <?php echo $type; ?></td>
                                            <td>&nbsp; <?php echo $account['ledger_name']; ?></td>
                                            <td>&nbsp; <?php echo number_format($grossAmt, 3); ?></td>
                                            <td>&nbsp; <?php echo number_format($rows['total_tax'], 3); ?></td>
                                            <td>&nbsp; <?php echo number_format($total, 3); ?></td>
                                            <td>&nbsp; <?php echo $rows['duedate'] != '' ? $rows['duedate'] : "-"; ?></td>
                                            <td>&nbsp; <?php echo number_format($balance, 3); ?> </td>
                                        </tr>
                                    <?php $no++; endforeach; ?>
                                    
                                    <tr>
                                        <td colspan="3">&nbsp; </td>
                                        <td>&nbsp; Total:</td>
                                        <td>&nbsp; <b><?php echo number_format($gamt, 3); ?></b> </td>
                                        <td>&nbsp; <b><?php echo number_format($tax, 3); ?></b> </td>
                                        <td>&nbsp; </td>
                                        <td>&nbsp; <b>Closing Balance:- </b></td>
                                        <td>&nbsp; <b><?php echo number_format($tot, 3); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                            <br>
                                            &nbsp;
                                            <span><b>* This is a Computer Generated Document hence no Signature is Required</b></span>
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

