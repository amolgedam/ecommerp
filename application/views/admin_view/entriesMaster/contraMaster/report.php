<?php
  $cityData = $this->model_state->fecthCityByID($companyDetails['city']);

  $from_paymenttype = $this->model_paymentmaster->fecthDataByID($allData['from_paymenttypeid']);
  $to_paymenttype = $this->model_paymentmaster->fecthDataByID($allData['to_paymenttypeid']);


  // echo "<pre>"; print_r($allData); echo "<pre>"; print_r($from_paymenttype); 
  // exit;

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
                                      <h5><b>Contra Entry</b></h5>
                                  </center>
                              </td>
                          </tr>
                          <tr>
                              <td>
                                  <table border="1" width="100%">
                                    <tr>
                                        <th>&nbsp; Date</th>
                                        <th>&nbsp; From</th>
                                        <th>&nbsp; To</th>
                                        <th>&nbsp; Particular</th>
                                        <th>&nbsp; Contra Entry Number</th>
                                        <th>&nbsp; Amount</th>
                                    </tr>

                                    <tr>
                                        <td>&nbsp; <?php echo date("d-m-Y", strtotime($allData['date'])); ?></td>
                                        <td>&nbsp;<?php echo $from_paymenttype['payment_name']; ?></td>
                                        <td>&nbsp;<?php echo $to_paymenttype['payment_name']; ?></td>
                                        <td>&nbsp;<?php echo "Contra Entry ".$allData['voucherno']; ?></td>
                                        <td>&nbsp;<?php echo $allData['voucherno']; ?></td>
                                        <td>&nbsp;<?php echo $allData['amount']; ?></td>
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

