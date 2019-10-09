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
        Profilt and Loss Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profit and Loss Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            <form role="form" action="#" enctype="multipart/form-data" method="post">

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
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                        <br>
                        <a href="#" class=" btn btn-info">Search</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class=" btn btn-success">Print</a>
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
                                    <h5><b>Profit and Loss Report</b></h5>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="1" width="100%">
                                    <tr>
                                        <th>&nbsp; Invoicing Date</th>
                                        <th>&nbsp; Invoicing Number</th>
                                        <th>&nbsp; Total Sale Amount</th>
                                        <th>&nbsp; Total Purchase Amount</th>
                                        <th>&nbsp; Gross Profit/Loss</th>
                                    </tr>
                                    <tr>
                                        <td>&nbsp; 01-02-2019</td>
                                        <td>&nbsp; 0001</td>
                                        <td>&nbsp; 1000.00</td>
                                        <td>&nbsp; 100.00</td>
                                        <td>&nbsp; 900.00</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp; </td>
                                        <td>&nbsp; Total:</td>
                                        <td>&nbsp; 1000.00</td>
                                        <td>&nbsp; 100.00</td>
                                        <td>&nbsp; 900.00</td>
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

