<!-- < ?php echo "<pre>"; print_r($sum); exit; ?> -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <?php echo form_open('sales_order/update'); ?>
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sales Order No</label>
                      <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control" required readonly>
                      <input type="text" name="order_no" value="<?php echo $allData['order_no']; ?>" class="form-control" required readonly>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Order Date</label>
                      <input type="date" name="order_date" value="<?php echo $allData['order_date']; ?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sales Account</label>
                      <select name="sales_account" class="form-control" required>
                        <option value="0">Select Option</option>

                          <?php foreach($ledgerPurAccount as $rows): ?>
                              <option value="<?php echo $rows->id; ?>"  <?php echo $allData['sales_account_id'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->ledger_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Account</label>
                      <select name="account" class="form-control"  required>
                        <option value="0">Select Option</option>

                          <?php foreach($ledgerAccount as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['account_id'] == $rows->id ? "selected" : "" ; ?>><?php echo $rows->ledger_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div> 
                 
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Division</label>
                      <select name="division" class="form-control">
                        <option value="0">Select Option</option>
                        <?php foreach($division as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['division_id'] == $rows->id ? "selected" : "" ; ?>><?php echo $rows->division_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Branch</label>
                      <select name="branch" class="form-control">
                            < ?php foreach($branch as $rows): ?>
                              <option value="< ?php echo $rows->id; ?>"  < ?php echo $allData['branch_id'] == $rows->id ? "selected" : "" ; ?>>< ?php echo $rows->branch_name; ?></option>
                          < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <!--<div class="col-md-4 col-sm-4 col-xs-12">-->
                  <!--  <div>-->
                  <!--    <label>Location</label>-->
                  <!--    <select name="location" class="form-control">-->
                  <!--      <option value="0">Select Option</option>-->
                        
                  <!--           < ?php foreach($location as $rows): ?>-->
                  <!--            <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['location_id'] == $rows->id ? "selected" : "" ; ?>>< ?php echo $rows->location_name; ?></option>-->
                  <!--        < ?php endforeach; ?>-->
                  <!--    </select>-->
                  <!--  </div>-->
                  <!--</div>-->

                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Packet By</label>
                      <input type="text" name="packet_by" value="< ?php echo $allData['packet_by']; ?>" class="form-control">
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Order Status</label>
                        <select name="status" class="form-control">
                        <option value="0">---select one---</option>
                        <option <?php echo $allData['order_status'] == "Open" ? "selected" : "" ; ?> >Open</option>
                        <option <?php echo $allData['order_status'] == "Force Close" ? "selected" : "" ; ?> >Force Close</option>
                        <option <?php echo $allData['order_status'] == "Delivered" ? "selected" : "" ; ?> >Delivered</option>
                        <option <?php echo $allData['order_status'] == "In Process" ? "selected" : "" ; ?> >In Process</option>
                        <option <?php echo $allData['order_status'] == "Partialy Process" ? "selected" : "" ; ?> >Partialy Process</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Expected Completion Date</label>
                      <input type="date" name="completion_date" value="<?php echo $allData['expected_date']; ?>" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Commited Date</label>
                      <input type="date" name="commited_date" value="<?php echo $allData['completed_date']; ?>" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Estimated Total</label>
                      <input type="text" name="estimate_total" value="<?php echo $sum; ?>" class="form-control" required readonly>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <br>
                      <input type="radio" name="order_type" value="mto" <?php echo $allData['order_type'] == "mto" ? "checked" : "" ; ?> class="show_purchase_orderCheck"> MTO
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <br>
                      <input type="radio" name="order_type" value="tp" <?php echo $allData['order_type'] == "tp" ? "checked" : "" ; ?> class="show_purchase_orderCheck"> Traded Product
                    </div>
                  </div>

                <!--< ?php if($allData['order_type'] == 'tp'): ?>-->
                  <div class="col-md-4 col-sm-4 col-xs-12" id="porder">
                    <div>
                      <label>Purchase Order</label>
                      <select name="purchase_order" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($purchaseorder as $rows): ?>
                            <option value="<?php echo $rows['id'] ?>" <?php echo $allData['purchaseorder_id'] == $rows['id'] ? "selected" : "" ; ?>><?php echo $rows['order_no'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                <!--< ?php endif; ?>-->

              </div>

              <hr>
              <div align="right">
        
                
                <a href="<?php echo base_url() ?>sales_order/salesOrderReport/<?php echo $allData['id']; ?>" class="btn btn-sm btn-warning" >Print Invoice</a>
                
                
                <!--<input type="submit" name="jobsheet"  class="btn btn-sm btn-success" id="purchase_orderMTO" value="Save and Create Jobsheet">-->
                
                <input type="submit" name="save"  class="btn btn-sm btn-success" value="Update Order">
                
                
                <!--<button type="submit" name="save"  class="btn btn-sm btn-success">Update Order</button>-->
                
                
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

<script>
        var radioValue = $("input[name='order_type']:checked").val();

            if(radioValue == 'tp'){

                $('#porder').show();
                 $('#purchase_orderMTO').hide();
            }
            else
            {
                $('#porder').hide();
                $('#purchase_orderMTO').show();
            }
        
        $("input[name='order_type']").click(function(){

            var radioValue = $("input[name='order_type']:checked").val();

            if(radioValue == 'tp'){

                $('#porder').show();
               
            }
            else
            {
                $('#porder').hide();
                
            }

        });
</script>
