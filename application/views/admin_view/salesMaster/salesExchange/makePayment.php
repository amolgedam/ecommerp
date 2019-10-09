<!--< ?php echo "<pre>"; print_r($allData); exit; ?>-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
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
     
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <?php echo form_open('sales_exchange/makePayment'); ?>
                <div class="row">
                  
                  

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <label>Estimated Total</label>
                      <input type="text" name="totvalue" id="estimated" class="form-control" value="<?php echo $allData['total_invoicevalue']; ?>" readonly>
                      <input type="hidden" name="id" class="form-control" value="<?php echo $allData['id']; ?>" readonly>
                    </div>
                    
                  </div>
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <div>
                          <label>Amount Paid</label>
                          <input type="text" name="paid" id="paid" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <div>
                          <label>Amount Remaining</label>
                          <input type="text" name="remainingpaid" id="remainingpaid" class="form-control" readonly>
                        </div>
                    </div>
                     <div class="col-md-2 col-sm-4 col-xs-12">
                        <div>
                          <label>Entry Date</label>
                          <input type="date" name="entrydate" value="<?php echo $allData['date']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <div>
                          <label>Check Number</label>
                          <input type="text" name="number" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <div>
                          <label>Payment Type</label>
                          <select class="form-control" name="payment_type" required>
                              <?php foreach($paytype as $rows): ?>
                                <option value="<?php echo $rows->id; ?>"><?php echo $rows->payment_name; ?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                    </div>
                  
                  <div class="row" align="right" style="padding-right: 30px">
                      <br><br><br>
                    <hr>
                    <input type="submit" name="print" value="Make Payment and Print" class="btn btn-sm btn-info">
                    
                    <input type="submit" name="payment" value="Make Payment" class="btn btn-sm btn-info">
                    
                    <!--<a href="< ?php echo base_url() ?>sales_order/makepayment/< ?php echo $id; ?>" class="btn btn-sm btn-info">Make Payment</a>-->
                    
                </div>

              </div>
                <?php echo form_close(); ?>
            </div>
            <!-- /.box-body -->
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

<!-- Modals -->
<?php
  $this->load->view('admin_view/templates/modals/addSKU');
  $this->load->view('admin_view/templates/modals/createLedger');
?>

<script>

    $('#paid').on('keyup', function(){
        
        var estimated = parseInt($('#estimated').val());
        var paid = parseInt($(this).val());
        
        // if(estimated < paid)
        // {
        //     alert('Paid Amount more than Estimate Amount');
        //     $(this).val("");
        //     $('#remainingpaid').val("");
        // }
        // else
        // {
          var value = estimated - paid

          console.log(value);
          if(estimated < 0)
          {
             value  = Math.abs(value);
          }


            $('#remainingpaid').val(value);
        // }
    });
    
</script>