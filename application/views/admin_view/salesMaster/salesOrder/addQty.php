<!--< ?php print_r($salesorderData); exit; ?>-->
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
    
    <form action="<?php echo base_url() ?>sales_order/addOrderByBarcode" method="post">
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <!--< ?php echo form_open('sales_order/create'); ?>-->
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Sales Order No</label>
                      <input type="hidden" name="id" value="<?php echo $allData['id']; ?>" class="form-control" required>
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
                              <option value="<?php echo $rows->id; ?>"  <?php echo $allData['sales_account_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->ledger_name; ?></option>
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
                              <option value="<?php echo $rows['id']; ?>" <?php echo $allData['account_id'] == $rows['id'] ? "selected" : ""; ?> ><?php echo $rows['ledger_name']; ?></option>
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
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['division_id'] == $rows->id ? "selected" : ""; ?> ><?php echo $rows->division_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Branch</label>
                      <select name="branch" class="form-control">
                            < ?php foreach($branch as $rows): ?>
                              <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->branch_name; ?></option>
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
                  <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->location_name; ?></option>-->
                  <!--        < ?php endforeach; ?>-->
                  <!--    </select>-->
                  <!--  </div>-->
                  <!--</div>-->

<!--                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Packet By</label>
                      <input type="text" name="packet_by" class="form-control">
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Order Status</label>
                        <select name="status" class="form-control">
                        <option value="0" <?php echo $allData['order_status'] == '0' ? 'selected' : ""; ?> >---select one---</option>
                        <option value="Open" <?php echo $allData['order_status'] == 'Open' ? 'selected' : ""; ?> >Open</option>
                        <option value="ForceClose" <?php echo $allData['order_status'] == 'ForceClose' ? 'selected' : ""; ?> >Force Close</option>
                        <option value="Delivered" <?php echo $allData['order_status'] == 'Delivered' ? 'selected' : ""; ?> >Delivered</option>
                        <option value="InProcess" <?php echo $allData['order_status'] == 'InProcess' ? 'selected' : ""; ?> >In Process</option>
                        <option value="PartialyProcess" <?php echo $allData['order_status'] == 'PartialyProcess' ? 'selected' : ""; ?> >Partialy Process</option>
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
                      <input type="text" name="estimate_total" value="<?php echo $allData['estimated_total']; ?>" id="invoice_value" class="form-control" required readonly>
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

                  <div class="col-md-4 col-sm-4 col-xs-12" id="purchase_orderCheck">
                    <div>
                      <label>Purchase Order</label>
                      <select name="purchase_order" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($purchaseorder as $rows): ?>
                            <option value="<?php echo $rows['id'] ?>" <?php echo $allData['purchaseorder_id'] == $rows['id'] ? $rows['id'] : "selected"; ?> ><?php echo $rows['order_no'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

              </div>

              <hr>
              <div align="right">
        
                <a href="<?php echo base_url(); ?>ledger_master/create" class="btn btn-sm btn-info">Create Ledger</a>
                <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_createLedger" class="btn btn-sm btn-info">Create Ledger</a>-->

                <!--<a href="#" class="btn btn-sm btn-info">Save and Print Order</a>-->
                <!--<button type="submit" name="print"  class="btn btn-sm btn-info">Save and Print Order</button>-->
                
                <!--<a href="#" class="btn btn-sm btn-info">Save and Make Payment</a>-->
                <!--<button type="submit" name="payment" class="btn btn-sm btn-info">Save and Make Payment</button>-->
                
                <!--<input type="submit" name="save" value="Save Order" class="btn btn-success">-->
                
                <!-- <input type="submit" name="jobsheet"  class="btn btn-sm btn-success" id="purchase_orderMTO" value="Save and Create Jobsheet"> -->
                
                <!--<input type="submit" name="save"  class="btn btn-sm btn-success" value="Create Order">-->
                
                <?php if($salesorderData['paymentstatus'] == 'no'): ?>
                    <a href="<?php echo base_url() ?>sales_order/makepayment/<?php echo $id; ?>" class="btn btn-sm btn-info">Make Payment</a>
                <?php endif; ?>
                
                <input type="submit" name="barcodesave" value="Save" class="btn btn-sm btn-success">
                
                <a href="<?php echo base_url() ?>sales_order/salesOrderReport/<?php echo $id; ?>" class="btn btn-sm btn-info">Print Order</a>
                        
                <!--<button type="submit" name="jobsheet"  class="btn btn-sm btn-success" id="purchase_orderMTO">Save and Create Jobsheet</button>-->
                
                <!--<button type="submit" name="save"  class="btn btn-sm btn-success">Create Order</button>-->
                
                
              </div>
                <!--< ?php echo form_close(); ?>-->
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <!-- <form method="post" action="< ?php echo base_url('sales_order/addOrderByBarcode'); ?>"> -->

              <!--< ?php echo form_open('sales_order/addOrderByBarcode'); ?>-->

              
                <div class="row">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>" required>
                    <input type="hidden" name="tot_invoice" id="invoice_value">
                    
                    <div class="col-md-12">
                        <div class="col-md-3">
                          <label>Search Product</label>
                          <input type="text" name="barcode" id="barcode" class="form-control">
    
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                   <!--  <th>Conversion</th>
                                    <th>Conversion</th> -->
                                    <th>MRP</th>
                                    <th>Discount</th>
                                    <th>Gross Price</th>
                                    <th>Gst</th>
                                    <th>GST Amount</th>
                                    <th>Salesman Commission(%)</th>
                                    <th>Final Price</th>
                                    <th>SKU</th>
                                    <!--<th>Category</th>-->
                                    <!--<th>Subcategory</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id='consumptionData'>
                                
                                <?php if($barcodeData){ ?>
                                    <?php $rowsno=1; foreach($barcodeData as $rows){ ?>
                                        
                                        <tr id="row_<?php echo $rowsno ?>">

                                            <?php 
                                              $barcodeData = $this->model_barcode->fetchAllDataByBarcodeid($rows['pno']);
                                            ?>

                                            <td>
                                                <input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>
                                                <input type="text" name="pno[]" value="<?php echo $barcodeData['barcode']; ?>" id="pno_<?php echo $rowsno; ?>" required readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="quantity[]" onchange="getConversionData(<?php echo $rowsno; ?>)" id="quantity_<?php echo $rowsno; ?>" class="countQuantity" value="<?php echo $rows['quantity']; ?>" readonly>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <input type="text" name="oldbaseprice[]" value="<?php echo $rows['baseprice']; ?>" onchange="mrpChange(<?php echo $rowsno ?>)" id="baseprice_<?php echo $rowsno ?>" >
                                            </td>
                                            <td>
                                                <input type="hidden" name="disvalue[]" id="disvalue_<?php echo $rowsno; ?>" value="<?php echo $rows['disvalue']; ?>" class="discountClass">
                                                
                                                
                                                <input type="hidden" name="discount[]" id="disvalue_<?php echo $rowsno; ?>" value="<?php echo $rows['discount']; ?>">
                                                
                                                <select name="discountSelect[]" id="disvalue_'<?php echo $rowsno; ?>" onchange="getDiscount(<?php echo $rowsno; ?>)" disabled >
                                                    <option value="0">---Select One---</option>
                                                    <?php foreach($discount as $drows){ ?>
                                                        <option value="<?php echo $drows->id ?>" <?php echo $rows['discount'] == $drows->id ? $rows['discount'] : ""; ?> ><?php echo $drows->discount ?></option>
                                                    
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            
                                            
                                            
                                            <td>
                                                <input type="text" name="grossprice[]" id="grossprice_<?php echo $rowsno; ?>" value="<?php echo $rows['grossprice']; ?>" readonly class="gpClass">
                                                <input type="hidden" name="hgrossprice[]" id="hgrossprice_<?php echo $rowsno; ?>" value="<?php echo $rows['grossprice']; ?>" readonly>

                                                <input type="hidden" name="baseprice[]" id="hiddenbaseprice_<?php echo $rowsno; ?>" value="<?php echo $rows['grossprice']; ?>"  class="bpclass" readonly>
                                                <input type="hidden" name="hiddenbaseprice1[]" id="hiddenbaseprice1_<?php echo $rowsno; ?>" value="<?php echo $rows['grossprice']; ?>"  readonly>
                                            </td>
                                          
                                          
                                            <td>
                                                <input type="hidden" name="gst[]" id="gst<?php echo $rowsno; ?>" value="<?php echo $rows['gst']; ?>">
                                                
                                                <select name="gstSelect[]" id="gst_<?php echo $rowsno; ?>" onchange="getGstData(<?php echo $rowsno; ?>)" disabled>
                                                    <option value="0">---Select One---</option>
                                                    <?php foreach($gst as $drows){ ?>
                                                        <option value="<?php echo $drows->id ?>" <?php echo $rows['gst'] == $drows->id ? $rows['gst'] : ""; ?> ><?php echo $drows->gst_name ?></option>
                                                    
                                                    <?php } ?>
                                                </select>
                                            </td>
                                          
                                            <td>
                                                <input type="text" name="gstamt[]" id="gstamt_<?php echo $rowsno; ?>" value="<?php echo $rows['gstamt']; ?>" readonly class="txClass" onblur="loadCount()" value="">
                                                <input type="hidden" name="hgstamt[]" id="hgstamt_<?php echo $rowsno; ?>" value="<?php echo $rows['gstamt']; ?>" readonly value="">
                                            </td>
                                          
                                            <td>
                                                <input type="text" name="salesmancomm[]" id="salesmancomm_<?php echo $rowsno; ?>"  value="<?php echo $rows['salesmancomm']; ?>" value="0">
                                            </td>
                                          
                                            <td>
                                                <input type="text" name="finalprice[]" id="finalprice_<?php echo $rowsno; ?>" class="finalClass" readonly value="<?php echo $rows['finalprice']; ?>">
                                                <input type="hidden" name="hfinalprice[]" id="hfinalprice_<?php echo $rowsno; ?>" value="<?php echo $rows['finalprice']; ?>" readonly>
                                            </td>
                                          
                                            <!-- <td>
                                                <input type="text" name="sku[]" value="< ?php echo $rows['sku']; ?>" id="sku_< ?php echo $rowsno; ?>" readonly>
                                            </td> -->
                                            <!--<td>-->
                                            <!--    html += response.cat;-->
                                            <!--</td>-->
                                            <!--<td>-->
                                            <!--    html += response.subcat;-->
                                            <!--</td>-->
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>
                                            </td>
                                           
                                        </tr>
                                        
                                    <?php $rowsno++; } ?>                                
                                <?php } ?>
                                
                            </tbody>
                            </table>
                        </div>
                    </div>

                    <!--<div class="row" align="right" style="padding-right: 30px">-->
                    <!--    <br><br><br>-->
                    <!--    <hr>-->
                        <!--<a href="< ?php echo base_url() ?>sales_order/salesOrderReport/< ?php echo $id; ?>" class="btn btn-sm btn-info">Print Order</a>-->
                        
                        <!--< ?php if($salesorderData['paymentstatus'] == 'no'): ?>-->
                        <!--    <a href="< ?php echo base_url() ?>sales_order/makepayment/< ?php echo $id; ?>" class="btn btn-sm btn-info">Make Payment</a>-->
                        <!--< ?php endif; ?>-->
                        
                        <!--<input type="submit" name="barcodesave" value="Save" class="btn btn-sm btn-success">-->
                        
                    <!--</div>-->
                  
                </div>

              <!--</form>-->

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- /.row -->
    </section>
    </form>
    <!-- Main content -->
    <!--<section class="content">-->

      
    <!--</section>-->
    
    <!--< ?php echo form_close(); ?>-->
      
     
    <section class="content"> 
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                <div class="row">
                  
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <div> 
                      <label>SKU</label>
                      <div class="row">
                        <div class="col-md-2">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSku" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="col-md-10">
                            <input type="hidden" class="form-control" name="id" id="skuOrderid" value="<?php echo $id; ?>" required>

                            <input list="sku"  class="form-control" placeholder="Enter SKU" id="skuOrder_code"  name="sku" required autocomplete="off">
                            <datalist id="sku">
                              <?php foreach($sku as $rows): ?>
                                <option value="<?php echo $rows['product_code']; ?>"><?php echo $rows['product_code']; ?></option>
                              <?php endforeach; ?>
                            </datalist>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <label>Quantity</label>
                      <input type="text" name="quality" id="skuOrder_qty" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <label>Estimated Price</label>
                      <input type="text" name="estimate_price" id="skuOrder_price" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <label>Remark</label>
                      <input type="text" name="remark" id="skuOrder_remark" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-2 col-sm-4 col-xs-12">
                    <div>
                      <br>
                      <!--<a href="#" class="btn btn-sm btn-info">Add</a>-->
                      <!-- <input type="button" value="Add" id="addOrderSku" class="btn btn-sm btn-info"> -->

                      <a href="javascript:void(0);" id="addOrderSku" class="btn btn-success"> Add </a>

                    </div>
                  </div>

              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              
                <div class="row">
                <?php echo form_open_multipart('sales_order/addQty'); ?>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                                <!-- <th>Sr No.</th> -->
                                <th>SKU</th>
                                <th>Quantity</th>
                                <th>Estimated Price</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody id="itemBody">


                          </tbody>

                           <!-- < ?php $no=1; foreach($allQty as $rows): ?> -->
                            
                                <<!-- ?php
                                    $productionData = $this->model_production->fecthAllDatabyID($rows->jobsheet_id);
                                    // echo "<pre>"; print_r($productionData); exit;
                                ? -->>
                                <!-- 
                                <tr>
                                    <td>< ?php echo $no; ?></td>
                                    <td>< ?php echo $rows->sku; ?></td>
                                    <td>< ?php echo $rows->quantity; ?></td>
                                    <td>
                                      < ?php echo $rows->price; ?>
                                       <input type="hidden" name="price" class="finalClass" value="< ?php echo $rows->price; ?>">     
                                    </td>
                                    <td>< ?php echo $rows->remark; ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-info editQtyData" data-id="< ?php echo $rows->id ?>" data-orderid="< ?php echo $id ?>" data-sku="< ?php echo $rows->sku; ?>" data-qty="< ?php echo $rows->quantity; ?>" data-price="< ?php echo $rows->price; ?>" data-remark="< ?php echo $rows->remark; ?>"    >Edit</a>
                                        <a href="< ?php echo base_url(); ?>sales_order/deleteQty/< ?php echo $rows->id; ?>/< ?php echo $rows->salesorder_id ?>" class="btn btn-sm btn-danger">Delete</a>
                                        < ?php if($rows->jobsheet_status == 'not'){ ?> 
                                            <a href="< ?php echo base_url(); ?>production/create/salesorder/< ?php echo $rows->salesorder_id ?>/< ?php echo $rows->id ?>" class="btn btn-sm btn-primary">Create Job</a>
                                        < ?php }else{  ?>
                                            <a target="_blank" href="< ?php echo base_url(); ?>production/update/< ?php echo $rows->jobsheet_id ?>">< ?php echo $productionData['jobsheet_no']; ?></a>
                                        < ?php } ?>
                                    </td>
                                </tr>
                            < ?php $no++; endforeach; ?> -->
                        </table>
                    </div>  
                  <?php echo form_close(); ?>
                </div>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      
      
      <!--  Modal QTY  -->
      <form method="POST" action="<?php echo base_url('sales_order/updateModalQty') ?>">
        <div class="modal fade" id="Modal_editUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  Edit 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                      
                        <div class="col-md-12">
                                
                            <div class="col-md-2">
                                <input type="hidden" class="form-control" name="editorderid" id="editorderid" required>
                                
                                <input type="hidden" class="form-control" name="editid" id="editid" required>
                                
                                
                                
                                <label>SKU</label>
                                <input list="sku"  class="form-control" placeholder="Enter SKU"  name="sku" id="editsku" required autocomplete="off">
                                <datalist id="sku">
                                  <?php foreach($sku as $rows): ?>
                                    <option value="<?php echo $rows['product_code']; ?>"><?php echo $rows['product_code']; ?></option>
                                  <?php endforeach; ?>
                                </datalist>
                            </div>
                        
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div>
                                  <label>Quantity</label>
                                  <input type="text" name="editqty" id="editqty" class="form-control" required>
                                </div>
                              </div>
            
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                <div>
                                  <label>Estimated Price</label>
                                  <input type="text" name="editprice" id="editprice" class="form-control" required>
                                </div>
                              </div>
            
                              <div class="col-md-2 col-sm-4 col-xs-12">
                                <div>
                                  <label>Remark</label>
                                  <input type="text" name="editremark" id="editremark" class="form-control">
                                </div>
                              </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" name="save" value="Update" class="btn btn-success">
              </div>
            </div>
          </div>
        </div>
    </form>
      
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

    $(document).on('click', '.remove', function(){
        
        $(this).closest('tr').remove();
        // count();

    });
    var base_url = '<?php echo base_url(); ?>';

    $('#addOrderSku').on('click', function(){

        var table = $("#itemBody");
        var count_table_tbody_tr = $("#itemBody tr").length;
        var row_id = count_table_tbody_tr + 1;

        var id = $('#skuOrderid').val();
        var skucode = $('#skuOrder_code').val();
        var sku_qty = $('#skuOrder_qty').val();
        var sku_price = $('#skuOrder_price').val();
        var sku_remark = $('#skuOrder_remark').val();

        if(sku_qty == '')
        {
          alert("Enter Quantity");
        }
        else
        {

            var formData = new FormData();
      
            formData.append('id', id);
            formData.append('skucode', skucode);
            formData.append('sku_qty', sku_qty);
            formData.append('sku_price', sku_price);
            formData.append('sku_remark', sku_remark);

            $.ajax({

                method: 'post',
                url: base_url + 'sales_order/addSalesOrderSKU',
                data: formData,
                dataType: 'JSON',
                contentType: false, 
                processData: false,
                success: function(response){

                  // console.log(response);

                  if(response.code == "error")
                  {
                      alert(response.msg);
                  }
                  else
                  {
                      $('#skuOrder_code').val('');
                      $('#skuOrder_qty').val('');
                      $('#skuOrder_price').val('');
                      $('#skuOrder_remark').val('');

                      var orderid = $('#skuOrderid').val();

                      showSKU(orderid);

                  }
                }
            });
  

            $('#skuOrder_code').val('');
            $('#skuOrder_qty').val('');
            $('#skuOrder_price').val('');
            $('#skuOrder_remark').val('');
        }
    });

    var orderid = $('#skuOrderid').val();

    showSKU(orderid);

    function showSKU(orderid) {
        
        var formData = new FormData();

        formData.append('orderid', orderid);

         $.ajax({

              method: 'post',
              url: base_url + 'sales_order/showSalesorderSkuData',
              data: formData,
              dataType: 'JSON',
              contentType: false, 
              processData: false,
              success: function(response){

                    // console.log(response);

                    var table = $("#itemBody");
                    var count_table_tbody_tr = $("#itemBody tr").length;
                    var row_id = count_table_tbody_tr + 1;

                    var jobsheet = html = '';

                    

                    $.each(response, function(index, value) { 

                        $('#itemBody').html('');

                        if(value.jobsheet_id == 0)
                        {
                            jobsheet = '<a target="_blank" href="'+base_url+'/production/create/salesorder/'+value.salesorder_id+'/'+value.id+'" class="btn btn-sm btn-primary"> Create Job</a>';

                             // <a href="production/create/salesorder/< ?php echo $rows->salesorder_id ?>/< ?php echo $rows->id ?>">Create Job</a>
                        }
                        else
                        {
                            jobsheet = '<a target="_blank" href="'+base_url+'/production/update/'+value.jobsheet_id+'" >'+value.jobsheet_id+'</a>';
                        }

                        html += '<tr id="row_'+row_id+'">';
                            html += '<th>';
                              html += '<span>'+value.product_code+'</span>';
                              html += '<input type="hidden" name="skuCode" value="'+value.sku+'">';
                              html += '<input type="hidden" name="id" id="jobsheetID_'+row_id+'" value="'+value.id+'">';
                            html += '</th>';
                            html += '<th>';
                              html += '<span>'+value.quantity+'</span>';
                              html += '<input type="hidden" name="skuQty" value="'+value.quantity+'">';
                            html += '</th>';
                            html += '<th>';
                              html += '<span>'+value.price+'</span>';
                              html += '<input type="hidden" name="skuPrice" class="finalClass" value="'+value.price+'">';
                            html += '</th>';
                            html += '<th>';
                              html += '<span>'+value.remark+'</span>';
                              html += '<input type="hidden" name="skuRemark" value="'+value.remark+'">';
                            html += '</th>';
                            html += '<th>';
                              // html += '<a href="javascript:void(0);" class="editQtyData" data-sku="'+skucode+'" data-qty="'+sku_qty+'" data-price="'+sku_price+'" data-remark="'+sku_remark+'" >Edit</a> | ';
                              html += '<a href="javascript:void(0);" onClick="removeJobsheet('+row_id+')">Remove</a> | ';
                              html += jobsheet;                             
                            html += '</th>';
                        html += '</tr>';

                        $('#itemBody').append(html);
                    })

                    var orderid = $('#skuOrderid').val();

                        showSKU(orderid); 

                        loadCount();

              }
         });
    }

    function removeJobsheet(row_id) {
      // alert(row_id);
      var id = $('#jobsheetID_'+row_id).val();

        $.ajax({  
                                        
            url: base_url + 'sales_order/deleteSalesOrderSku/',
            type: 'post',
            dataType: 'JSON',
            data : {id:id},
            success:function(response){

              var orderid = $('#skuOrderid').val();
              // alert(orderid);

              // window.location.replace(base_url+'sales_order/addQty/'+orderid);
              showSKU(orderid);
            }
          });
    }

    $('.editQtyData').on('click', function(){

        // var id = $(this).data('id');
        // var orderid = $(this).data('orderid');
        var sku = $(this).data('sku');
        var qty = $(this).data('qty');
        var price = $(this).data('price');
        var remark = $(this).data('remark');
        // alert(sku + qty + price + remark);
        $('#Modal_editUnit').modal('show');
        
        // $('[name="editid"]').val(id);
        // $('#editorderid').val(orderid);
        $('#editsku').val(sku);
        
        $('[name="editqty"]').val(qty);
        $('[name="editprice"]').val(price);
        $('[name="editremark"]').val(remark);
    });
    
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';


  $('#barcode').on('keyup', function(){

      var barcode = $(this).val().length;

      // barcode.length;
      // $.trim(barcode);
      if(barcode > 9)
      {
        var barcode_code = $(this).val(); 
        // console.log(barcode_code);
        //  data fetch
        $.ajax({
            url: base_url + 'unit/fecthAllData/',
            type: 'post',
            dataType: 'json',
            success:function(unitResponse){

                $.ajax({
                  url: base_url + 'gst/fecthAllData/',
                  type: 'post',
                  dataType: 'json',
                  success:function(gstResponse){

                      $.ajax({
                          url: base_url + 'discount/fecthAllData/',
                          type: 'post',
                          dataType: 'json',
                          success:function(discountResponse){

                            var table = $("#consumptionData");
                            var count_table_tbody_tr = $("#consumptionData tr").length;
                            var row_id = count_table_tbody_tr + 1;

                            $.ajax({  
                                        
                              url: base_url + 'barcode/getAttrubuteDataByBarcode/',
                              type: 'post',
                              dataType: 'json',
                              data : {barcode:barcode_code},
                              success:function(response){

                              // console.log(response);

                              // console.log(barcode_code);


                                  if(response[0].item_status == 'soldout')
                                  {
                                      alert('Product not Available or Soldout');
                                  }
                                  else
                                  {
                                        var mrp = parseFloat(response[0].mrp);
                                        
                                        var cgst = parseFloat(response[1].cgst);
                                        var sgst = parseFloat(response[1].sgst);
                                        var igst = parseFloat(response[1].igst);
                                        var totgst = cgst + sgst + igst;

                                        var mytot = (mrp * totgst);
                                        var tot = 100 + totgst;
                                        var gstvalue = mytot / tot;

                                        var gst = (gstvalue).toFixed(3); 

                                        var gprice = mrp - gst;


                                      var html = '';
                                            
                                      html += '<tr id="row_'+row_id+'">';
                                              
                                              $('#quantity_'+row_id).val("1");
                                              $('#conversionvalue_'+row_id).val("0");
                                          
                                          html += '<td>';
                                              html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                              html += '<input type="hidden" name="pno[]" value="'+response[0].id+'" id="pno_'+row_id+'" required readonly>';

                                              html += '<input type="text" name="pnoName[]" value="'+response[0].barcode+'" id="pno_'+row_id+'" required readonly>';

                                          html += '</td>';
                                          
                                          var read = mrp = '';
                                            if(response[0].unit_id == '18')
                                            {
                                                read = 'readonly';
                                            }
                                            else
                                            {
                                                read = '';
                                            }
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="quantity[]" onchange="getConversionData('+row_id+')" id="quantity_'+row_id+'" class="countQuantity" value="1" '+read+'>';
                                          html += '</td>';
                                          
                                          // html += '<td>';
                                          //     html += '&nbsp;';
                                          // html += '</td>';
                                          
                                          // html += '<td>';
                                          //     html += '&nbsp;';
                                          // html += '</td>';
                                          html += '<td>';
                                            var read = mrp = '';
                                            if(response[0].unit_id == '18')
                                            {
                                                  
                                                html += '<input type="text" name="oldbaseprice[]" value="'+response[0].mrp+'" onchange="mrpChange('+row_id+')" id="baseprice_'+row_id+'" >';
                                                  
                                            }
                                            else
                                            {
                                                html += '<input type="text" name="oldbaseprice[]" value="'+response[0].mrp+'" onchange="mrpChange1('+row_id+')" id="baseprice_'+row_id+'" >';
                                            }
                                            
                                            html += '</td>';
                                          // html += '<td>';
                                          //     html += '<input type="text" name="baseprice[]" value="'+response[0].mrp+'" id="baseprice_'+row_id+'" class="bpclass">';
                                          // html += '</td>';

                                          html += '<td>';
                                                    html += '<input type="hidden" name="disvalue[]" id="disvalue_'+row_id+'" class="discountClass">';
                                                    
                                                    html += '<select name="discount[]" id="discoount_'+row_id+'" onchange="getDiscount('+row_id+')">';
                                                            html += '<option value="0">---Select One---</option>';
                                                                
                                                                $.each(discountResponse, function(index, value) {
                                                                    
                                                                   html += '<option value="'+value.discount+'">'+value.discount+'</option>';
                                                                });
                                                                
                                                    html += '</select>';
                                                html += '</td>';

                                          
                                          html += '<td>';
                                              html += '<input type="text" name="grossprice[]" id="grossprice_'+row_id+'" value="'+gprice+'" readonly class="gpClass">';
                                              html += '<input type="hidden" name="hgrossprice[]" id="hgrossprice_'+row_id+'" value="'+gprice+'" readonly>';
                                              
                                              html += '<input type="hidden" name="hgrossprice1[]" id="hgrossprice1_'+row_id+'" value="'+gprice+'" readonly>';

                                              // for cal gst on discount
                                              html += '<input type="hidden" name="baseprice[]" id="hiddenbaseprice_'+row_id+'" value="'+gprice+'"  class="bpclass" readonly>';
                                              html += '<input type="hidden" name="hiddenbaseprice1[]" id="hiddenbaseprice1_'+row_id+'" value="'+gprice+'"  readonly>';
                                          html += '</td>';
                                          
                                          
                                          html += '<td>';
                                              html += '<select name="gst[]" id="gst_'+row_id+'"  onchange="getGstData('+row_id+')">';
                                                          html += '<option value="0">---Select One---</option>';
                                                              
                                                              $.each(gstResponse, function(index, value) {
                                                                  
                                                                 html += '<option value="'+value.id+'">'+value.gst_name+'</option>';
                                                              });
                                              html += '</select>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="gstamt[]" id="gstamt_'+row_id+'" readonly class="txClass" onblur="'+loadCount()+'" value="'+gst+'">';
                                              
                                              html += '<input type="hidden" name="hgstamt[]" id="hgstamt_'+row_id+'" readonly value="'+gst+'">';
                                              
                                               html += '<input type="hidden" name="hgstamt1[]" id="hgstamt1_'+row_id+'" readonly value="'+gst+'">';

                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="salesmancomm[]" id="salesmancomm_'+row_id+'" value="0">';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="finalprice[]" id="finalprice_'+row_id+'" class="finalClass" readonly value="'+response[0].mrp+'">';
                                              html += '<input type="hidden" name="hfinalprice[]" id="hfinalprice_'+row_id+'" value="'+response[0].mrp+'" readonly>';
                                               html += '<input type="hidden" name="hfinalprice1[]" id="hfinalprice1_'+row_id+'" value="'+response[0].mrp+'" readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="hidden" name="sku[]" value="'+response[0].sku_code+'" id="sku_'+row_id+'" readonly>';
                                              html += '<input type="text" name="skuName[]" value="'+response[2].product_code+'" id="sku_'+row_id+'" readonly>';
                                          html += '</td>';
                                          
                                          // html += '<td>';
                                          //     html += response.cat;
                                          // html += '</td>';
                                          
                                          // html += '<td>';
                                          //     html += response.subcat;
                                          // html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
                                          html += '</td>';
                                          
                                          
                                          html += '</tr>';
                                          
                                          $('#consumptionData').append(html);
                                          
                                          // $('#bp').val(response.baseprice);
                                          
                                          $('#gst_'+row_id).val(response[1].id);
                                          // $('#discoount_'+row_id).val(8);

                                          
                                          loadCount();

                                          $('#barcode').val('');
                                  }
                              }
                            });
                        }
                      });
                  }
                });
            }
        });
      }
  });

  $(document).on('click', '.removeJobSheet', function(){
    $(this).closest('tr').remove();
      
      loadCount();
  });

  $(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
      
      loadCount();
  });


  function loadCount()
  {
      var pno=0; var bprice=0; var discount=0; var gp=0; var tx=0; var amt=0;
        
        // $('.countQuantity').each(function() {
            
        //     pno += parseFloat($('.countQuantity').val(), 10);
        // });
        // $('#no').val(pno);
        // $('#cpno').val(pno);
        
    
        
        // $('.bpclass').each(function() {
            
        //     bprice += parseFloat($('.bpclass').val(), 10);
        // });
        // $('#bp').val(bprice);
        
        // $('.discountClass').each(function() {
            
        //     discount += parseFloat($('.discountClass').val(), 10);
        // });
        // $('#dis').val(discount);
        
        // $('.gpClass').each(function() {
            
        //     gp += parseFloat($('.gpClass').val(), 10);
        // });
        // $('#gp').val(gp);
        

        // $('.txClass').each(function() {
            
        //     tx += parseFloat($('.txClass').val(), 10);
        // });
        // $('#tx').val(tx);
        
        
        $('.finalClass').each(function() {
            
            amt += parseFloat($(this).val());
            // console.log(amt);
        });
        $('#amt').val(amt);
        $('#invoice_value').val(amt);
        // console.log(amt);
  }

  loadCount();

</script>



<script>
    var base_url = "<?php echo base_url(); ?>";

    function getConversionData(row_id)
    {  
        var qty = $('#quantity_'+row_id).val();
        var con = $('#conversion_'+row_id).val();
        
        // alert(qty); alert(conversion);
        
        $.ajax({
                    
            url: base_url + 'unit/fecthUnitDataByID/',
            type: 'post',
            dataType: 'json',
            data : {unit_id:con},
            success:function(response){
            
                result = parseFloat(qty, 10) / parseFloat(response.conversion, 10);
                
                $('#conversionvalue_'+row_id).val(result);
                
                cal(row_id);
            }
        });
        
        qtyChange(row_id);
        
        // loadCount();
    }
    
    function getDiscount(row_id)
    {
        var discount = parseFloat($('#discoount_'+row_id).val());
        var grossprice = parseFloat($('#hiddenbaseprice1_'+row_id).val());
        // console.log(discount);
        // console.log(grossprice);
        var discount = (grossprice * discount) / 100;

        var discountValue = (discount).toFixed(3);
        
        $('#disvalue_'+row_id).val(discountValue);
        
        var newpricevalue =  grossprice - discountValue;

        var newprice = (newpricevalue).toFixed(3);
        
        // console.log(newprice);
        $('#grossprice_'+row_id).val(newprice);


        var gst_id = $('#gst_'+row_id).val();

        $.ajax({
                    
            url: base_url + 'gst/fetchAllDataByID/',
            type: 'post',
            dataType: 'json',
            data : {gst_id:gst_id},
            success:function(response){
            
                // console.log(response);
                var sgst = parseInt(response.sgst);
                var cgst = parseInt(response.cgst);
                var igst = parseInt(response.igst);
                var totgst = sgst + cgst + igst;
                // console.log(totgst);

                // var mrp = parseFloat($('#baseprice_'+row_id).val());
                // var mytot = (newprice * totgst);
                // var tot = 100 + totgst;
                // var gstvalue = mytot / tot;

                var gstvalue = newprice * totgst / 100;
                // console.log(gst);
                var gst = (gstvalue).toFixed(3); 

                $('#gstamt_'+row_id).val(gst);
                $('#hgstamt_'+row_id).val(gst);

                var final = parseFloat(gst) + parseFloat(newprice);
                // console.log(final);
                $('#finalprice_'+row_id).val(final);
                $('#hfinalprice_'+row_id).val(final);

                loadCount();
            }
        });


        loadCount();
        // var discount = parseFloat($('#discoount_'+row_id).val());
        // var baseprice = parseFloat($('#baseprice_'+row_id).val());
        
        // var discountValue = (baseprice * discount) / 100;
        
        // $('#disvalue_'+row_id).val(discountValue);
        
        // var newprice = baseprice - discountValue;
        
        // $('#grossprice_'+row_id).val(newprice);
        // $('#finalprice_'+row_id).val(newprice);
        
        // cal(row_id);
                
        // var grossprice = parseFloat($('#grossprice_'+row_id).val());
        // var gstamt = parseFloat($('#gstamt_'+row_id).val());
        
        // var finalamt = gstamt + grossprice;
    
        // $('#finalprice_'+row_id).val(finalamt);
    
        
        // loadCount();
    }
    
    function getGstData(row_id)
    {
        var gst_id = $('#gst_'+row_id).val();
        // alert(gst_id);
        
        $.ajax({
                    
            url: base_url + 'gst/fetchAllDataByID/',
            type: 'post',
            dataType: 'json',
            data : {gst_id:gst_id},
            success:function(response){
            
                // console.log(response);
                
                var sgst = parseInt(response.sgst);
                var cgst = parseInt(response.cgst);
                var igst = parseInt(response.igst);
                var totgst = sgst + cgst + igst;
                // console.log(totgst);

                var mrp = parseFloat($('#baseprice_'+row_id).val());

                var mytot = (mrp * totgst);
                var tot = 100 + totgst;
                var gstvalue = mytot / tot;

                var gst = (gstvalue).toFixed(3); 

                var gprice = mrp - gst; 
                // console.log(gst);

                $('#gstamt_'+row_id).val(gst);
                $('#hgstamt_'+row_id).val(gst);

                $('#grossprice_'+row_id).val(gprice);
                $('#hgrossprice_'+row_id).val(gprice);

                $('#hiddenbaseprice_'+row_id).val(gprice);
                $('#hiddenbaseprice1_'+row_id).val(gprice);

                var grossprice = parseFloat($('#grossprice_'+row_id).val());
                var gstamt = parseFloat($('#hgstamt_'+row_id).val());
                
                var finalamt = gstamt + grossprice;
        
                $('#finalprice_'+row_id).val(finalamt);
                $('#hfinalprice_'+row_id).val(finalamt);

                getDiscount(row_id);

                loadCount();


                // var price = Number(gstamount) + Number(newprice);
                // var fprice = (price).toFixed(3);
                // $('#finalprice_'+row_id).val(fprice);
                
                  
                // var gstamt = (grossprice * totgst) / 100;
                // // console.log(gstamt);
                // $('#gstamt_'+row_id).val(gstamt);
                
                // // cal(row_id);
                
                // var grossprice = parseFloat($('#grossprice_'+row_id).val());
                // var gstamt = parseFloat($('#gstamt_'+row_id).val());
                
                // var finalamt = gstamt + grossprice;
        
                // $('#finalprice_'+row_id).val(finalamt);
            }
        });
        
        loadCount();
    }
    
    function cal(row_id)
    {
        var result = $('#conversionvalue_'+row_id).val();
        
        var baseprice = $('#baseprice_'+row_id).val();
        
        var grossprice = (result * baseprice);
        
        $('#grossprice_'+row_id).val(grossprice);
        
        var gstamt = $('#gstamt_'+row_id).val();
        
        var finalamt = gstamt + grossprice;
        
        $('#finalprice_'+row_id).val(finalamt);
        
        loadCount();
        // console.log(result); console.log(baseprice);
    }
    
    function qtyChange(row_id) {
      
        var qty = $('#quantity_'+row_id).val();
        var gprice = $('#hgrossprice1_'+row_id).val();
        
        var gprice = qty * gprice;
        gprice = (gprice).toFixed(3);
        
        $('#grossprice_'+row_id).val(gprice);
        $('#hgrossprice_'+row_id).val(gprice);
        
        // for Discount
        $('#hiddenbaseprice_'+row_id).val(gprice);
        $('#hiddenbaseprice1_'+row_id).val(gprice);
        
        var gstValue = $('#hgstamt1_'+row_id).val();
        gstValue = qty * gstValue;
        
        gstValue = (gstValue).toFixed(3);
        
        $('#gstamt_'+row_id).val(gstValue);
        $('#hgstamt_'+row_id).val(gstValue);
        
        var fprice = $('#hfinalprice1_'+row_id).val();
        
        var fprice1 = qty * fprice;
        fprice1 = (fprice1).toFixed(3);
        
        $('#finalprice_'+row_id).val(fprice1);
        $('#hfinalprice_'+row_id).val(fprice1);
        
        loadCount();
    }

    function mrpChange(row_id) {
      
        var baseprice = $('#baseprice_'+row_id).val();
        $('#grossprice_'+row_id).val(baseprice);
        $('#hgrossprice_'+row_id).val(baseprice);

        getGstData(row_id);
    }
    
    function mrpChange1(row_id) {
      
        var baseprice = $('#baseprice_'+row_id).val();
        
        // $('#grossprice_'+row_id).val(baseprice);
        // $('#hgrossprice_'+row_id).val(baseprice);

        // getGstData(row_id);
        
        var gst_id = $('#gst_'+row_id).val();
        // alert(gst_id);
        
        $.ajax({
                    
            url: base_url + 'gst/fetchAllDataByID/',
            type: 'post',
            dataType: 'json',
            data : {gst_id:gst_id},
            success:function(response){
            
                // console.log(response);
                var sgst = parseFloat(response.sgst);
                var cgst = parseFloat(response.cgst);
                var igst = parseFloat(response.igst);
                var totgst = sgst + cgst + igst;
                // console.log(totgst);
                
                var qty = $('#quantity_'+row_id).val();
                
                var mrp = parseFloat($('#baseprice_'+row_id).val());
                
                var newmrp = mrp * qty;

                var mytot = (newmrp * totgst);
                var tot = 100 + totgst;
                var gstvalue = mytot / tot;

                var gst = (gstvalue).toFixed(3); 
                

                var gprice = newmrp - gst; 
                
                
                                // console.log("mrp "+newmrp+" gst"+gst+" gprice "+gprice);

                $('#gstamt_'+row_id).val(gst);
                $('#hgstamt_'+row_id).val(gst);
                
                // cal(row_id);
                gprice = (gprice).toFixed(3);
                $('#grossprice_'+row_id).val(gprice);
                $('#hgrossprice_'+row_id).val(gprice);


                $('#hiddenbaseprice_'+row_id).val(gprice);
                $('#hiddenbaseprice1_'+row_id).val(gprice);

                var grossprice = parseFloat($('#grossprice_'+row_id).val());
                var gstamt = parseFloat($('#hgstamt_'+row_id).val());
                
                var finalamt = gstamt + grossprice;
            
                finalamt = (finalamt).toFixed(3);
                $('#finalprice_'+row_id).val(finalamt);
                $('#hfinalprice_'+row_id).val(finalamt);

                getDiscount(row_id);

                loadCount();
            }
        });
    }
</script>


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



