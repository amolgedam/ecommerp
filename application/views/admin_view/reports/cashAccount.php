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
        Cash Account Flow
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cash Account Flow</li>
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
                  
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Date From</label>
                      <input type="date" name="from" value="<?= set_value('from') ?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Date To</label>
                      <input type="date" name="to" value="<?= set_value('to') ?>" class="form-control" required>
                    </div>
                  </div>
                  
                  <div class="col-md-3 col-sm-3 col-xs-12">
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
                            <td rowspan="2" width="25%">
                                <center>
                                    <h5><b>Particular</b></h5>
                                </center>
                            </td>
                            <td colspan="3">
                                <center>
                                    <h5><b>PARAMOUNT TRADING VENTURES</b></h5>
                                    <h5>01/02/0001 To 31/01/0001</h5>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table border="1" width="100%">
                                    <tr>
                                        <td>
                                            <center>
                                                <h5><b>Cash Movement</b></h5>
                                            </center>
                                        </td>
                                        <td rowspan="2" style="width: 266px;">
                                            <center>
                                                <h5><b>Net Flow</b></h5>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%">
                                                <tr>
                                                    <td style="width: 266px;" class="topBorder">
                                                        <center>
                                                            <h5><b>In Flow</b></h5>
                                                        </center>
                                                    </td>
                                                    <td class="topBorder leftBorder">
                                                        <center>
                                                            <h5><b>Out Flow</b></h5>
                                                        </center>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">&nbsp; January</td>
                            <td width="25%">&nbsp; 0.00</td>
                            <td width="25%">&nbsp; 0.00</td>
                            <td width="25%">&nbsp; 0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp; Total</td>
                            <td>&nbsp; 0.00</td>
                            <td>&nbsp; 0.00</td>
                            <td>&nbsp; 0.00</td>
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

