 <!--< ?php echo "<pre>"; print_r($allData); exit(); ?> -->
 <?php 
    $serviceData = $this->model_alternate->fecthServicesByPId($allData['id']);
    // echo "<pre>"; print_r($serviceData); exit();
    
    $ledgerData = $this->model_ledger->fecthDataByID($serviceData['assign_work']);
    // echo "<pre>"; print_r($ledgerData); exit();
 
    // echo "<pre>"; print_r($info);
    // echo "<pre>"; print_r($product);exit;
 ?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Main content -->
    <section class="content">
        <form action="<?php echo base_url(); ?>alternate/printAlt" method="post">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                    
                    <h4>Print Options</h4>
                    <hr>
    
                    <div class="col-md-4">
                        <label>JobSheet Number</label>
                        <div>
                            <input type="hidden" name="productionid" value="<?php echo $allData['id']; ?>">
                            <!--<input type="hidden" name="customerid" value="< ?php echo $allData['customer']; ?>">-->
                            <input type="hidden" name="ledgerid" value="<?php echo $ledgerData['id']; ?>">
                            <select name="emplyee" class="form-control">
                                <!--<option value="0">Customer Copy</option>-->
                                <option value="<?php echo $ledgerData['id']; ?>" ><?php echo $ledgerData['ledger_name']; ?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <br>
                        <input type="submit" name="search" value="Search Jobsheet" class="btn btn-info">
                    </div>
                    
                </div>
                <!-- /.box-body -->
              </div>
    
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->

        </form>
    </section>
    
  </div>
  
  <div class="control-sidebar-bg"></div>

</div>
