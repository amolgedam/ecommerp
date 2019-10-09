
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Budget Setup Entry
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Budget Setup Entry</li>
      </ol>
    </section>


    <?php echo form_open('budget/create'); ?>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
              <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Start Date</label>
                    <input type="date" name="start_date" class="form-control">
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Last Date</label>
                    <input type="date" name="end_date" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Reporting Name</label>
                    <input type="text" name="reporting_name" class="form-control">
                  </div>
                </div> -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Projected Annual Sales</label>
                    <input type="text" name="annual_sale" id="annual_sale" class="form-control">
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Quarterly Sales</label>
                    <input type="text" name="quarterly_sale" id="quarterly_sale" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div>
                    <label>Monthly Sales</label>
                    <input type="text" name="monthly_sale" id="monthly_sale" class="form-control" readonly>
                  </div>
                </div>
              </div>

              <hr>
              <div align="right">
                <input type="submit" name="save" value="Save" class="btn btn-success">
              </div>

            </div>
            <!-- /.box-body -->
          </div>



          <div class="box" style="padding: 5px">
              <div class="row">
                <div class="col-md-12">
                    <center><h3>Allocations</h3></center>
                    <hr>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <div>
                    <label>Account</label>
                    <select name="account" id="account" class="form-control">
                      <option value="0">---Select One---</option>
                      <?php foreach ($ledger as $key => $value) { ?>
                        <option value="<?php echo $value['ledger_name']; ?>"><?php echo $value['ledger_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Percentage (%)</label>
                    <input type="text" name="annual" id="annualPer" class="form-control">
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Annual</label>
                    <input type="text" name="percentage" id="percentage" id="" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Quarterly</label>
                    <input type="text" name="quarterly" id="quarterly" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <label>Monthly</label>
                    <input type="text" name="monthly" id="monthly" class="form-control" readonly>
                  </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-6">
                  <div>
                    <br>
                    <a href="javascript:void(0);" id="saveData"  class="btn btn-sm btn-success">Save</a>
                  </div>
                </div>
               
            </div>
          </div>

          <div class="box" style="padding: 5px">
            <div class="row">
              <div class="col-md-12">
                <table class="table">
                  <thead>
                      <tr>
                        <th>Ledger Name</th>
                        <th>Percentage</th>
                        <th>Annual Budget</th>
                        <th>Quarterly Budget</th>
                        <th>Monthly Budget</th>
                      </tr>
                  </thead>
                  <tbody id="budgetData">
                    
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

    <?php echo form_close(); ?>
    <!-- /.content -->
  </div>
  
  <div class="control-sidebar-bg"></div>

</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('#annual_sale').on('change', function(){

            var annual_sale = parseFloat($(this).val());

            var quarterly = annual_sale / 4;
            var monthly = annual_sale / 12;

            quarterly = quarterly.toFixed(3);
            monthly = monthly.toFixed(3);

            $('#quarterly_sale').val(quarterly);
            $('#monthly_sale').val(monthly);

        });

        $('#annualPer').on('change', function(){

            var annual_sale = parseFloat($('#annual_sale').val());

            var annualPer = parseFloat($(this).val());

            var annualPer = annual_sale * annualPer / 100;
            var quarterly = annualPer / 4;
            var monthly = annualPer / 12;

            annualPer = annualPer.toFixed(3);
            quarterly = quarterly.toFixed(3);
            monthly = monthly.toFixed(3);

            $('#percentage').val(annualPer);
            $('#quarterly').val(quarterly);
            $('#monthly').val(monthly);

        });
    });


    $('#saveData').on('click', function(){

        setBudget();
    });

    function setBudget() {
        
        var ledger = $('#account').val();
        var annualPer = $('#annualPer').val();
        var percentage = $('#percentage').val();
        var quarterly = $('#quarterly').val();
        var monthly = $('#monthly').val();

        if(ledger == '0')
        {
           alert("Please Select Ledger Account");
        }
        else
        {
            var html = '';

            html += '<tr>';
              html += '<td>';
                html += '<input type="hidden" name="ledgerValue[]" value="'+ledger+'" />'; 
                html += ''+ledger+'';
              html += '</td>';
              html += '<td>';
                html += '<input type="hidden" name="annualPerValue[]" value="'+annualPer+'" />'; 
                html += ''+annualPer+'';
              html += '</td>';
              html += '<td>';
                html += '<input type="hidden" name="percentageValue[]" value="'+percentage+'" />'; 
                html += ''+percentage+'';
              html += '</td>';
              html += '<td>';
                html += '<input type="hidden" name="quarterlyValue[]" value="'+quarterly+'" />'; 
                html += ''+quarterly+'';
              html += '</td>';
              html += '<td>';
                html += '<input type="hidden" name="monthlyValue[]" value="'+monthly+'" />'; 
                html += ''+monthly+'';
              html += '</td>';
            html += '</tr>';

              $('#account').val('0');
              $('#annualPer').val('');
              $('#percentage').val('');
              $('#quarterly').val('');
              $('#monthly').val('');

            $('#budgetData').append(html);
        }
    }


</script>


