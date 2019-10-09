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
        Budget Report
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Budget Report</li>
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
            <form role="form" action="<?php echo base_url() ?>budget/report" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                
                <div class="row">
                    
                    <input type="hidden" name="report" value="budget">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        
                        <div>
                            <label>Monthly</label>
                            <br>
                          
                            <select class=" form-control" name="monthly">
                                    <option value="0">Select Option</option>
                                    <option value="01" <?php if(isset($month)){ echo $month == '01' ? "selected" : ""; } ?> >Jan</option>
                                    <option value="02" <?php if(isset($month)){ echo $month == '02' ? "selected" : ""; } ?> >Feb</option>
                                    <option value="03" <?php if(isset($month)){ echo $month == '03' ? "selected" : ""; } ?> >March</option>
                                    <option value="04" <?php if(isset($month)){ echo $month == '04' ? "selected" : ""; } ?> >April</option>
                                    <option value="05" <?php if(isset($month)){ echo $month == '05' ? "selected" : ""; } ?> >May</option>
                                    <option value="06" <?php if(isset($month)){ echo $month == '06' ? "selected" : ""; } ?> >June</option>
                                    <option value="07" <?php if(isset($month)){ echo $month == '07' ? "selected" : ""; } ?> >Jully</option>
                                    <option value="08" <?php if(isset($month)){ echo $month == '08' ? "selected" : ""; } ?> >Aug</option>
                                    <option value="09" <?php if(isset($month)){ echo $month == '09' ? "selected" : ""; } ?> >Sep</option>
                                    <option value="10" <?php if(isset($month)){ echo $month == '10' ? "selected" : ""; } ?> >Oct</option>
                                    <option value="11" <?php if(isset($month)){ echo $month == '11' ? "selected" : ""; } ?> >Nov</option>
                                    <option value="12" <?php if(isset($month)){ echo $month == '12' ? "selected" : ""; } ?> >Dec</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>Quarterly</label>
                            <br>
                            <select class="form-control" name="quater">
                                    <option value="0">Select Option</option>

                                    <option value="123" <?php if(isset($quater)){ echo $quater == '123' ? "selected" : ""; } ?> >Jan Feb March</option>
                                    <option value="456" <?php if(isset($quater)){ echo $quater == '456' ? "selected" : ""; } ?> >April May June</option>
                                    <option value="789" <?php if(isset($quater)){ echo $quater == '789' ? "selected" : ""; } ?> >Jully Aug Sep</option>
                                    <option value="101112" <?php if(isset($quater)){ echo $quater == '101112' ? "selected" : ""; } ?> >Oct Nov Dec</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>Yearly</label>
                            <br>
                            <?php
                              $pyear = date("Y",strtotime("-1 year"));
                              $cyear = date("Y");
                              $nyear = date("Y",strtotime("+1 year"));
                            ?>


                            <select class=" form-control" name="year">
                                    <option value="0">Select Option</option>
                                    <option value="<?php echo $pyear; ?>" <?php if(isset($year)){ echo $year == $pyear ? "selected" : ""; } ?> ><?php echo $pyear; ?></option>
                                    <option value="<?php echo $cyear; ?>" <?php if(isset($year)){ echo $year == $cyear ? "selected" : ""; } ?> ><?php echo $cyear; ?></option>
                                    <option value="<?php echo $nyear; ?>" <?php if(isset($year)){ echo $year == $nyear ? "selected" : ""; } ?> ><?php echo $nyear; ?></option>
                            </select>
                        </div>
                    </div>

                   <!--  <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>Projected Sales</label>
                            <br>
                            <select class="mymulselect form-control" name="monthly[]" multiple="multiple">
                                    <option value="0">Select Option</option>

                                    < ?php foreach ($allData as $key => $value) { ?>
                                      <option>< ?php $value[''] ?></option>
                                    < ?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div>
                            <label>Actual Sales</label>
                            <br>
                            <select class="mymulselect form-control" name="monthly[]" multiple="multiple">
                                    <option value="0">Select Option</option>
                            </select>
                        </div>
                    </div> -->
                    
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
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ledger</th>
                                <th>Actual Expences</th>
                                <th>Allocation</th>
                                <th>+/-</th>
                                <th>+/- (%)</th>
                            </tr>
                        </thead>

                        <tbody>

                          <!-- 
                              ##################################################
                              ##                  Month Wise                  ##
                              ##################################################
                           -->

                          <?php if(isset($budgetItem_month)){ ?>
                            
                            <?php 
                              foreach ($budgetItem_month as $key => $value) { ?>

                              <?php $ledgerData = $this->model_ledger->fecthDataByID($value['ledger_id']); ?>

                              <?php
                                  $data = array(
                                                  'ledger_id' => $ledgerData['id'],
                                                  'month' => $month
                                              );
                                  $ledgerExp = $this->model_globalsearch->getBudgetLedgerDataDr($data);
                              ?>

                              <?php 
                                $exp = 0;
                                foreach ($ledgerExp as $key => $expValue) {
                                  $amt = abs($expValue['amt']);
                                  $exp = $exp + $amt;
                                } 
                              ?>

                              <?php
                                $allocation = $value['monthly'] - $exp;

                                if($allocation > 0 )
                                {
                                    $label = '<label class="label label-success">'.$allocation.'</label>';
                                }
                                else
                                {
                                    $label = '<label class="label label-danger">'.$allocation.'</label>';
                                }

                                $per = $exp / $value['monthly'];
                              ?>
                              <tr>
                                <td><?php echo $ledgerData['ledger_name'] ?></td>
                                <td><?php echo $exp; ?></td>
                                <td><?php echo $value['monthly']; ?></td>
                                <td><?php echo $label; ?></td>
                                <td><?php echo number_format($per, 3); ?></td>
                              </tr>
                            <?php } ?>
                          <?php } ?>

                          <!-- 
                              ##################################################
                              ##               Quaterly Wise                  ##
                              ##################################################
                           -->
                          <?php if(isset($budgetItem_quater)){ ?>
                            <?php 

                              foreach ($budgetItem_quater as $key => $value) { ?>

                              <?php $ledgerData = $this->model_ledger->fecthDataByID($value['ledger_id']); ?>

                              <?php

                                  $from = $to = '';

                                  if($quater == '123')
                                  {
                                      $from = '01';
                                      $to = '03';
                                  }
                                  else if($quater == '456')
                                  {
                                      $from = '04';
                                      $to = '06';
                                  }
                                  else if($quater == '789')
                                  {
                                      $from = '07';
                                      $to = '09';
                                  }
                                  else if($quater == '101112')
                                  {
                                      $from = '10';
                                      $to = '12';
                                  }


                                  $data = array(
                                                  'ledger_id' => $ledgerData['id'],
                                                  'from' => $from,
                                                  'to' => $to
                                              );
                                  // echo "<pre>"; print_r($data);
                                  $ledgerExp = $this->model_globalsearch->getBudgetLedgerDataDrQuarterly($data);
                                  // echo "<pre>"; print_r($ledgerExp);
                              ?>

                              <?php 
                                $exp = 0;
                                foreach ($ledgerExp as $key => $expValue) {
                                  $amt = abs($expValue['amt']);
                                  $exp = $exp + $amt;
                                } 
                              ?>

                              <?php
                                $allocation = $value['quarterly'] - $exp;

                                if($allocation > 0 )
                                {
                                    $label = '<label class="label label-success">'.$allocation.'</label>';
                                }
                                else
                                {
                                    $label = '<label class="label label-danger">'.$allocation.'</label>';
                                }

                                $per = $exp / $value['quarterly'];
                              ?>
                              <tr>
                                <td><?php echo $ledgerData['ledger_name'] ?></td>
                                <td><?php echo $exp; ?></td>
                                <td><?php echo $value['quarterly']; ?></td>
                                <td><?php echo $label; ?></td>
                                <td><?php echo number_format($per, 3); ?></td>
                              </tr>
                            <?php } ?>
                          <?php } ?>



                          <!-- 
                              ##################################################
                              ##                  Yearly Wise                 ##
                              ##################################################
                           -->
                          <?php if(isset($budgetItem_year)){ ?>
                            <?php 

                              foreach ($budgetItem_year as $key => $value) { ?>

                              <?php $ledgerData = $this->model_ledger->fecthDataByID($value['ledger_id']); ?>

                              <?php

                                  $data = array(
                                                  'ledger_id' => $ledgerData['id'],
                                                  'year' => $year
                                              );
                                  // echo "<pre>"; print_r($data);
                                  $ledgerExp = $this->model_globalsearch->getBudgetLedgerDataDrYearly($data);
                                  // echo "<pre>"; print_r($ledgerExp);
                              ?>

                              <?php 
                                $exp = 0;
                                foreach ($ledgerExp as $key => $expValue) {
                                  $amt = abs($expValue['amt']);
                                  $exp = $exp + $amt;
                                } 
                              ?>

                              <?php
                                $allocation = $value['percentage'] - $exp;

                                if($allocation > 0 )
                                {
                                    $label = '<label class="label label-success">'.$allocation.'</label>';
                                }
                                else
                                {
                                    $label = '<label class="label label-danger">'.$allocation.'</label>';
                                }

                                $per = $exp / $value['percentage'];
                              ?>
                              <tr>
                                <td><?php echo $ledgerData['ledger_name'] ?></td>
                                <td><?php echo $exp; ?></td>
                                <td><?php echo $value['percentage']; ?></td>
                                <td><?php echo $label; ?></td>
                                <td><?php echo number_format($per, 3); ?></td>
                              </tr>
                            <?php } ?>
                          <?php } ?>

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



