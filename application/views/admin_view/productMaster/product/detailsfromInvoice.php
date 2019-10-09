<?php 
    // echo "<pre>"; print_r($allData); exit;
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
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
            
            <div>
                <a href="#"  class="btn btn-primary">Delete</a>
                &nbsp;
                <a href="#"  class="btn btn-primary">Add to Barcode Queque</a>
                &nbsp;
                <a href="#"  class="btn btn-primary">Print Barcode</a>
                <br><br>
            </div>
                  
                  
          <div class="box">
            <br>
           
            
            <div class="box-body">
              <div class="table-responsive">
                  
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                    <tr>
                      <th>
                          <input type="checkbox" name="print[]" />
                          Select All
                        </th>
                    <th>Barcode Number</th>
                      <th>SKU Product Name</th>
                      <th>Purchase Net Price</th>
                      <th>MRP</th>
                      <th>Quantity</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        foreach($allData as $rows){
                            
                            $skuData = $this->model_sku->fecthSkuDataByID($rows['sku_code']);
                      ?>
                      <tr>
                        <td>
                            <input type="checkbox" name="print[]" />    
                            
                        </td>
                        <td><?php echo $rows['barcode']; ?></td>
                        <td><?php echo $skuData['product_code']; ?></td>
                        <td><?php echo $rows['pur_netprice']; ?></td>
                        <td><?php echo $rows['mrp']; ?></td>
                        <td><?php echo $rows['qty']; ?></td>
                        <td>
                            <?php if($rows['item_status'] == 'available'){ ?>
                                
                                <a href="<?php echo base_url(); ?>barcode/updatedata/<?php echo  $rows['id']; ?>" >Edit </a> &nbsp;
                                <!--<a href="< ?php echo base_url(); ?>" >Edit Attributes</a>-->
                                
                            <?php
                                }
                                else
                                {
                            ?>
                                <?php echo $rows['item_status']; ?>
                            <?php } ?>
                        </td>
                      </tr>
                        <?php } ?>
                  </tbody>
                </table>
              </div>
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
  <!-- /.content-wrapper -->

  <div class="control-sidebar-bg"></div>

</div>
