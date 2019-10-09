<!-- < ?php echo "<pre>"; print_r($ledgerData); exit(); print_r($journalData); exit();  ?> -->

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
            
                      <input type="text" name="id" list="ledger" class="form-control" required autocomplete="off">                      
                      
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
          
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
  <div class="control-sidebar-bg"></div>

</div>

