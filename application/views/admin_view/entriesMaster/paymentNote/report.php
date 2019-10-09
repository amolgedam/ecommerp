<?php
  $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
  $ledgerData = $this->model_ledger->fecthDataByID($allData['ledger_id']);

  // echo "<pre>"; print_r($allData); echo "<pre>"; print_r($ledgerData); exit;

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
    

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            
          <div class="box">
              <div class="box-body">
                  <div class="table-responsive">
                      
                      <table border="1" width="100%">
                          <tr>
                              <td>
                                  <center>
                                      <h4><b><?php echo strtoupper($companyDetails['company_name']); ?></b></h4>
                                      <h5>Nagpur-Main</h5>
                                      <h6><?php echo ucwords($companyDetails['address1'])." ".ucwords($cityData['city_name'])." ".ucwords($companyDetails['pincode'])." ".ucwords($companyDetails['mobile_no']); ?></h6>
                                      <h6>GST No : <?php echo ucwords($companyDetails['gst']); ?>  &  PAN No : <?php echo ucwords($companyDetails['pan']); ?></h6>
                                  </center>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <center>
                                      <h5><b>Payment Vouchers</b></h5>
                                  </center>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <table border="1" width="100%">
                                      <tr>
                                          <td colspan="2">&nbsp;Pay To :  <b><?php echo ucwords($ledgerData['ledger_name']); ?></b></td>
                                          <td colspan="2">&nbsp;Voucher To :  <b><?php echo $allData['voucherno']; ?></b></td>
                                      </tr>
                                      <tr>
                                          <th>&nbsp; Date</th>
                                          <th>&nbsp; Bank</th>
                                          <th>&nbsp; Check No.</th>
                                          <th>&nbsp; Payment Amount</th>
                                      </tr>
                                      <tr>
                                          <td>&nbsp; <?php echo  date("d-m-Y", strtotime($allData['date'])); ?></td>
                                          <td>&nbsp; <?php echo "<b>".$ledgerData['accountno']."</b> ".$ledgerData['bankaddress'] ?></td>
                                          <td>&nbsp; <?php echo $allData['referernceno'] ?></td>
                                          <td>&nbsp; <?php echo number_format($allData['amount'], 2); ?></td>
                                      </tr>
                                  </table>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <br>
                                  &nbsp;<b>THE SUM OF</b> :- <?php echo $this->number_to_word->convert_number($allData['amount']); ?>
                                  <br>
                                  &nbsp;<b>Description</b> :- <?php echo ucwords($allData['remark']); ?>
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

