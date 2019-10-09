
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
        Ledger Group
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ledger Group</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            <form role="form" action="<?php echo base_url() ?>reports/ledgerGroupReport" enctype="multipart/form-data" method="post">

          <div class="box" style="padding: 5px;">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Account Category</label>
                      <select name="category" id="category" class="form-control">
                        <option value="0">Select Category</option>
                        <?php foreach ($accountCat as $key => $value) { ?>
                          <option value="<?php echo $value->id ?>" <?php echo $value->id == $postData['acate_id'] ? "selected" : "" ?> ><?php echo $value->acategories_name; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <label>Account Sub-category</label>
                      <select name="subcategory" id="subcategory" class="form-control">
                        <option value="0">Select Sub-Category</option>
                        <?php foreach ($accountSubCat as $key => $value) { ?>
                          <option value="<?php echo $value->id ?>" <?php echo $value->id == $postData['asubcate_id'] ? "selected" : "" ?> ><?php echo $value->asubcat_name; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Date From</label>
                      <input type="date" name="from" value="<?= set_value('from') ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                      <label>Date To</label>
                      <input type="date" name="to" value="<?= set_value('to') ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div>
                        <br>
                        <input type="submit" name="search" class="btn btn-sm btn-info" value="Search">
                    </div>
                  </div>      
              </div>
            </div>
          </div>
        </form>
        
        <?php if($ledgerData !=''){ ?>
          <div class="box">
              <div class="box-body">
                  <div class="table-responsive">
                      <table class="table" width="100%">
                          <tr>
                              <th>Sr No.</th>
                              <th>Details</th>
                              <th>Ledger Name</th>
                              <th>Starting Balance</th>
                              <th>Current Balance</th>
                          </tr>
                          <?php
                            $no = 1;
                            $amtdr = $amtcr = $dr = $cr = $op = $cl = $tot = 0;
                            $entry = array();
                            $particular = $link = $ledgerEntries = '';
                            foreach ($ledgerData as $key => $value) { 
                          ?>

                            <?php 
                              
                              $data = array(
                                              'ledger_id' => $value['id'],
                                              'from' => $postData['from'],
                                              'to' => $postData['to']
                                          );
                              // echo "<pre>"; print_r($data); 

                              if((empty($_POST['from'])) && (empty($_POST['to'])))
                              {
                                  $ledgerEntries = $this->model_globalsearch->getLastDataByLedgerID($data);
                              }
                              else
                              {
                                 $ledgerEntries = $this->model_globalsearch->getLastDataByLedgerIDBetweenDate($data);
                              }

                              $tot = $tot + $ledgerEntries['closing_bal'];
                            ?>

                            <?php if($value['closing_balance'] !=''){ ?>
                              <tr>
                                  <td><?php echo $no; ?></td>
                                  <td>
                                      <a href="<?php echo base_url(); ?>reports/ledgerGroupReportSearch/<?php echo $value['id']; ?>"><i class="fa fa-desktop"></i></a>
                                  </td>
                                  <td><?php echo $value['ledger_name'] ?></td>
                                  <td><?php echo $ledgerEntries['opening_bal'] != 0 ? $ledgerEntries['opening_bal']." DR" : "0"; ?></td>
                                  <td><?php echo $ledgerEntries['closing_bal'] != 0 ? $ledgerEntries['closing_bal']." CR" : "0";  ?></td>
                              </tr>
                            <?php } ?>

                          <?php 
                            $no++;
                            } 
                          ?>
                      </table>
                  </div>
                  <div align="right">
                      <span><b>Current Balance:-</b><?php echo number_format($tot, 2); ?> CR</span>
                  </div>
              </div>
          </div>
        <?php } ?>
          
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

      var base_url = '<?php echo base_url(); ?>'; 

      $('#category').on('change', function(){
            
          $('#subcategory').html('');
          
         var categoryid = $(this).val();
         // alert(company_id);
         var html = '';
            $.ajax({
                  
                  url: base_url + 'account_category/fetchSubcatBycateID/',
                  type: 'post',
                  dataType: 'json',
                  data : {accountcat_id:categoryid},
                  success:function(response){

                      html += '<option value="0">Select Sub-Category</option>';            

                      $.each(response, function(index, value) {

                        html += '<option value="'+value.id+'">'+value.asubcat_name+'</option>';            
                      });
                      
                      $('#subcategory').append(html);
                  }
            });
      });
  });
</script>