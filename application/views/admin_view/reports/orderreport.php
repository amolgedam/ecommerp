<!-- < ?php echo "<pre>"; print_r($production); exit; ?> -->
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
        Order Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Order Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            <form role="form" action="<?php echo base_url('reports/orderReport'); ?>" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                 
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Date From</label>
                      <input type="date" name="from" value="<?= set_value('from') ?>" class="form-control" required >
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Date To</label>
                      <input type="date" name="to" value="<?= set_value('to') ?>" class="form-control" required >
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Customer</label>
                      <select name="customer" class="form-control">
                          <option value="0">Select Option</option>
                          <?php foreach($customer as $rows){ ?>
                            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['ledger_name']; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Status</label>
                      <select name="status" class="form-control">
                          <option value="0">Select Option</option>
                          <option value="Open">Open</option>
                          <option value="Further Process">Further Process</option>
                          <option value="Complete">Complete</option>
                          <option value="Incomplete">Incomplete</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                        <br>
                        <input type="submit" name="search" value="Search" class="btn btn-info">
                        <!--<a href="#" class=" btn btn-info">Search</a>-->
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" name="print" value="Print" class="btn btn-success">
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
                                    <h5><b>Order Report</b></h5>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="1" width="100%">
                                    <tr>
                                        <th>&nbsp; Order Date</th>
                                        <th>&nbsp; Order Number</th>
                                        <th>&nbsp; Exp. Completion Date</th>
                                        <th>&nbsp; Commited Date</th>
                                        <th>&nbsp; Customer Name</th>
                                        <th>&nbsp; Amount</th>
                                        <th>&nbsp; Status</th>
                                        <th>&nbsp; Action</th>
                                    </tr>

                                    <?php
                                      if(isset($salesOrder))
                                      {
                                          foreach ($salesOrder as $key => $value) { 
                                    ?>
                                          <?php
                                            $customer = $this->model_ledger->fecthAllDatabyID($value['account_id']);
                                          ?>

                                              <tr>
                                                  <td>&nbsp; <?php echo date('d-m-Y', strtotime($value['created_date'])); ?></td>
                                                  <td>&nbsp; <?php echo $value['order_no']; ?></td>
                                                  <td>&nbsp; <?php echo date('d-m-Y', strtotime($value['expected_date'])); ?></td>
                                                  <td>&nbsp; <?php echo date('d-m-Y', strtotime($value['completed_date'])); ?></td>
                                                  <td>&nbsp; <?php echo $customer['ledger_name']; ?></td>
                                                  <td>&nbsp; <?php echo $value['estimated_total']; ?></td>
                                                  <td>&nbsp; <?php echo $value['order_status']; ?></td>
                                                  <td>&nbsp; 
                                                      <a href="<?php echo base_url(); ?>sales_order/addQty/<?php echo $value['id'] ?>"><i class="fa fa-edit"></i>Edit</a>
                                                      <a href="<?php echo base_url(); ?>sales_order/delete/<?php echo $value['id'] ?>" onclick="return confirm(\' you want to delete?\');"><i class="fa fa-trash"></i>Delete</a>
                                                      <a href="<?php echo base_url(); ?>sales_order/salesOrderReport/<?php echo $value['id'] ?>"><i class="fa fa-eye"></i>Print</a>
                                                  </td>
                                              </tr>

                                    <?php
                                          }
                                      }

                                    ?>

                                    
                                   
                                    <tr>
                                        <td colspan="10">
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

