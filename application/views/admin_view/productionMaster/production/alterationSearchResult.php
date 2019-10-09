<!--< ?php echo "<pre>"; print_r($salesinvoiceData); exit(); ?> -->

<?php
    
    $data = array(
					'inventory_id' => $salesinvoiceData['id'],
					'inventory_type' => $salesinvoiceData['invoice_type'] 
				);
    	    				
    if($salesinvoiceData['invoice_type'] != 'wsp')
    {
        $invoiceData = $this->model_salesinvoice->fecthItemDataByIdType($data);
    }
    else
    {
        $invoiceData = $this->model_wsp->fecthItemDataByIdType($data);
    }
    
// 	echo "<pre>"; print_r($invoiceData); exit();
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Production Alteration
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Manage Production</li>
      </ol>
    </section>

    <form method="post" action="<?php echo base_url() ?>alternate/create">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                
                <h4>Production</h4>
                <hr>

                <div class="row">
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>JobSheet Date</label>
                      <input type="hidden" name="jobno" id="jobno" class="form-control" required="" value="<?php echo $alternate_no; ?>">
                      <input type="date" name="jobsheet_date" class="form-control" required="">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Delivery Date</label>
                      <input type="date" name="delivery_date" class="form-control" required="">
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Status</label>
                      <select name="status" required class="form-control">
                        <option value="0">---Select One---</option>
                        <option value="Open" selected>Open</option>
                        <option value="Further Process">Further Process</option>
                        <option value="Complete">Complete</option>
                        <option value="Incomplete">Incomplete</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Production Cost</label>
                      <input type="text" name="production_cost" id="totcost" class="form-control" readonly>
                    </div>
                  </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Sales Invoice No</label>
                  <input type="hidden" name="salesinvoice_id" value="<?php echo $salesinvoiceData['id'] ?>" class="form-control" readonly>
                  <input type="text" name="sales_invoice_no" value="<?php echo $salesinvoiceData['inventory_no'] ?>" class="form-control" readonly>
                  <input type="hidden" name="invoice_type" value="<?php echo $salesinvoiceData['invoice_type']; ?>">
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Sales Order No</label>
                  <select name="sales_order_no" class="form-control">
                    <option value="0">---Select One---</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Sales Acccount</label>
                  <select name="saccount" id="saccount" class="form-control">
                    <option value="0">---Select One---</option>
                      <?php foreach($ledgerPurAccount as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $salesinvoiceData['sales_account'] == $rows->id ? "selected" : "" ?> ><?php echo $rows->ledger_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Acccount</label>
                  <select name="account" id="account" class="form-control">
                    <option value="0">---Select One---</option>
                    <?php foreach($ledgerAccount as $rows): ?>
                          <option value="<?php echo $rows->id; ?>" <?php echo $salesinvoiceData['account'] == $rows->id ? "selected" : "" ?> ><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Invoicing Date</label>
                  <input type="date" name="invoice_date" value="<?php echo $salesinvoiceData['date'] ?>" class="form-control">
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Salesman</label>
                  <select name="salesman" class="form-control">
                    <option value="0">---Select One---</option>
                    <?php foreach($ledgerSalesmanAccount as $rows): ?>
                          <option value="<?php echo $rows->id; ?>" <?php echo $salesinvoiceData['salesman'] == $rows->id ? "selected" : "" ?>><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Shipping Details</label>
                  <input type="text" name="shipping_details" value="<?php echo $salesinvoiceData['shipping_details'] ?>" class="form-control">
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Division</label>
                  <select name="division" id="division" class="form-control">
                    <option value="0">---Select One---</option>
                      <?php foreach($division as $rows): ?>
                       <option value="<?php echo $rows->id; ?>" <?php echo $salesinvoiceData['division'] == $rows->id ? "selected" : "" ?>><?php echo $rows->division_name; ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Branch</label>
                  <select name="branch" id="branch" class="form-control">
                    <option value="0">---Select One---</option>
                    < ?php foreach($branch as $rows): ?>
                      <option value="< ?php echo $rows->id; ?>" < ?php echo $salesinvoiceData['branch'] == $rows->id ? "selected" : "" ?>>< ?php echo $rows->branch_name; ?></option>
                    < ?php endforeach; ?>
                  </select>
                </div>
              </div> -->

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Location</label>
                  <select name="location" class="form-control">
                    <option value="0">---Select One---</option>
                      <?php foreach($location as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $salesinvoiceData['location'] == $rows->id ? "selected" : "" ?>><?php echo $rows->location_name; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Sales Memo</label>
                  <select name="salesmemo" class="form-control">
                    <option value="0">---Select One---</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Sales Type</label>
                  <select name="sales_type" class="form-control">
                    <option value="0">---select one---</option>
                      <?php foreach($ledgerPurType as $rows): ?>
                        <option value="<?php echo $rows->id; ?>" <?php echo $salesinvoiceData['sale_type'] == $rows->id ? "selected" : "" ?>><?php echo $rows->ledger_name; ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Shipping Type</label>
                  <input type="text" name="shipping_type" value="<?php echo $salesinvoiceData['shipping_type'] ?>" class="form-control">
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Total Invoice Value</label>
                  <input type="text" name="total_invoice_value" value="<?php echo $salesinvoiceData['total_invoice'] ?>" class="form-control" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mydatatable">
                        <thead>
                          <tr>
                            <th>Product No</th>
                            <th>Qty</th>
                            <!--<th>Conversion</th>-->
                            <!-- <th>Conversion Value</th> -->
                            <th>Base Price</th>
                            <th>Discount</th>
                            <th>Gross Price</th>
                            <!--<th>GST %</th>-->
                            <th>GST Amt</th>
                            <th>Salesman Comm.</th>
                            <th>Final Price</th>
                            <th>SKU</th>
                            <!--<th>Category</th>-->
                            <!--<th>Sub-Category</th>-->
                            <!--<th>Status</th>-->
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($invoiceData as $rows): ?>
                            
                                <?php 
                                    if($rows['inventory_type'] == 'wsp')
                                    { 
                                        $qty = $rows['qty'];
                                    }
                                    else
                                    {
                                        $qty = $rows['quantity'];
                                    }
                                ?>
                            
                              <tr id="row_<?php echo $no; ?>">
                                <td>
                                  <input type="hidden" name="invoiceDataId[]" value="<?php echo $rows['id']; ?>">
                                  <?php echo $rows['pno'] ?>
                                  <input type="hidden" name="pno[]" value="<?php echo $rows['pno']; ?>">
                                </td>
                                <td>
                                    <?php echo $qty ?>
                                    <input type="hidden" name="quantityMaterial[]" value="<?php echo $qty; ?>">    
                                </td>
                                <!--<td>< ?php echo $rows['conversion'] ?></td>-->
                                <!-- <td>< ?php echo $rows['conversionvalue'] ?></td> -->
                                <td>
                                    <?php echo $rows['baseprice'] ?>
                                    <input type="hidden" name="baseprice[]" value="<?php echo $rows['baseprice']; ?>">
                                </td>
                                <td>
                                    <?php echo $rows['disvalue'] ?>
                                    <input type="hidden" name="disvalue[]" value="<?php echo $rows['disvalue']; ?>">
                                </td>
                                <td><?php echo $rows['grossprice'] ?></td>
                                <!--<td>< ?php echo $rows['gst'] ?></td>-->
                                <td><?php echo $rows['gstamt'] ?></td>
                                <td><?php echo $rows['salesmancomm'] ?></td>
                                <td>
                                    <?php echo $rows['finalprice'] ?>
                                    <input type="hidden" name="subtotal[]" value="<?php echo $rows['finalprice']; ?>">
                                </td>
                                <td><?php echo $rows['sku'] ?></td>
                                <!--<td>Mens</td>-->
                                <!--<td>T-Shirt</td>-->
                                <!--<td>< ?php echo $rows['pno'] ?></td>-->
                                <td>
                                  <a href="javascript:void(0);" class="btn btn-danger btn-sm remove" >Remove</a>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                        </tbody>
                    
                    </table>
                </div>
                
            </div>
          </div>
        </div>
      </div>

<!--       <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <h4>Product</h4>
              <hr>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Search Product</label>
                  <input type="text" name="searchproduct" id="searchproduct" class="form-control" placeholder="Enter Product Code">
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <br>
                  <input type="button" name="search" id="search" class="btn btn-sm btn-primary" value="Search">
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="table table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Product Number</th>
                                  <th>Quantity</th>
                                  <th>Conversion</th>
                                  <th>Conversion</th>
                                  <th>Purchase Net Price/Unit</th>
                                  <th>Subtotal</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody id='consumptionData'> 
                              
                          </tbody>
                      </table>
                  </div>
                  <div>
                      <div class="pull-right">
                          Total :-
                          <input type="text" name="tot_material" id="tot_material" readonly>
                      </div>
                  </div>
                </div>                          
            </div>
          </div>
        </div>
      </div> -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <h4>Measurements</h4>
              <hr>
              <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="radio" name="measuremnt"  class="measuremnt" value="custom" checked> Custom
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="radio" name="measuremnt" class="measuremnt" value="readymade"> Readymade
                  </div>
              </div>
              <br>
              <div class="row">
                    <div style="display: none" id="readymade">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              
                                  <div style="padding-left: 5px;">Size</div>
                                  <input type="text" name="size" id="readymadesize" class="form-control">
                              
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              
                                  <div style="padding-left: 5px;">Quantity</div>
                                  <input type="text" name="mquantity" id="readymadequantity" class="form-control">
                                
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div>&nbsp;</div>
                            <input type="button" name="search" onclick="readymade();" class="btn btn-sm btn-primary" value="Add">
                            <!-- <button class="btn btn-sm btn-success">Add</button> -->
                        </div>

                        <div class="col-md-12">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <td>Measurement Size</td>
                                  <td>Quantity</td>
                                  <td>Action</td>
                                </tr>
                              </thead>
                              <tbody id="measurementData">
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    
                    <div id="custom">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                    <label style="padding-left: 5px;">कोट</label>
                      <br><br>
                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">शोल्डर</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kshoulder" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">चेस्ट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kchest" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">पैंट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kpants" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हाथ</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="khand" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हिप</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="khip" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लंबाई</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="klength" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">गला </span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="kthroat" class="form-control">
                        </div>
                      </div>
                  </div>


                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label style="padding-left: 5px;">पैंट</label>
                    <br><br>
                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">कमर</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="waist" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">सीट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="seat" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लटक</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="hanging" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">जाँघ</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="thigh" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लंबाई</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="length" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">बॉटम</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="bottom" class="form-control">
                        </div>
                      </div>
                  </div>


                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label style="padding-left: 5px;">शर्ट</label>
                    <br><br>
                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">शोल्डर</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="sshoulder" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">चेस्ट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="schest" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">पैंट</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="spants" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हाथ</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="shand" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">हिप</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="ship" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">लंबाई</span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="slength" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12" style="padding-left: 5px;">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <span style="padding-left: 5px;">गला </span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="sthroat" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <h4>Services</h4>
              <hr>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Service Type</label>
                  <select name="service_type" id="service_type" class="form-control">
                    <option value="0">---Select One---</option>
                        <?php foreach($servicetype as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo ucwords($rows->service_name); ?></option>
                        <?php endforeach; ?>
                  </select>

                  <input type="hidden" name="tot_service" id="tot_service">

                </div>
              </div>
               <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Assigned Worker </label>
                  <select name="assign_work" id="assign_work" class="form-control">
                    <option value="0">---Select One---</option>
                    <?php foreach($employee as $rows): ?>
                      <option value="<?php echo $rows->id ?>"><?php echo $rows->ledger_name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Quantity</label>
                  <input type="number" name="quality" id="quality" class="form-control">
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>Rate / Unit</label>
                  <input type="number" name="unit" id="unit" class="form-control">
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <label>GST Type</label>
                  <select name="gst_type" id="gst_type" class="form-control">
                    <option value="0">---Select One---</option>
                        <?php foreach($gst as $rows): ?>
                            <option value="<?php echo $rows->id; ?>"><?php echo ucwords($rows->gst_name); ?></option>
                        <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">
                <div>
                  <br>
                  <button type="button" name="save" id="addService" class="btn btn-primary">Save</button>
                  <!--<button name="add" id="addService" class="btn btn-sm btn-success">Add</button>-->
                  <!--<input type="button" id="addService" class="btn btn-sm btn-success" value="Add">-->
                </div>
              </div>
              

              <div class="col-md-12">
                  <br><br>
                  <table class="table">
                        <thead>
                              <tr>
                                  <th>Service Type</th>
                                  <th>Worker Name</th>
                                  <th>GST</th>
                                  <th>Quantity</th>
                                  <th>Rate / Unit</th>
                                  <th>Total Include GST</th>
                                  <th>Action</th>
                              </tr>
                        </thead>
                        <tbody id="show_services">
                            
                        </tbody>
                  </table>
              </div>
              
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

              <h4>Description</h4>
              <hr>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div>
                  <label>Description</label>
                  <textarea name="description" class="form-control"></textarea>
                </div>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <hr>
                <div align="right">
                  <input type="submit" name="save" value="Save" class="btn btn-sm btn-info">
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!--<div class="row">-->
      <!--  <div class="col-xs-12">-->
      <!--    <div class="box">-->
      <!--      <div class="box-body">-->

      <!--        <h4>Further Process List</h4>-->
      <!--        <hr>-->
              
      <!--        <div>No Item</div>-->

      <!--      </div>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->

    </section>
    </form>
    <!-- /.content -->
  </div>
  <div class="control-sidebar-bg"></div>

</div>




 <!--MODAL DELETE-->
         <form>
            <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to delete this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="id" id="id" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL DELETE-->


<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url(); ?>';
        
        // show_services();  //call function show all product
        
        function show_services()
        {
            var jobno = $('#jobno').val();
            
            $.ajax({
                
                url: base_url + 'alternate/fecthServicesByJobId/',
                type: 'post',
                dataType: 'json',
                data : {jobno:jobno},
                success:function(data){
                    
                    var html = '';
                var i;
                var tot = 0; var totunit = 0;
                var gst = '';
                var unit = '';
// <a href="'.base_url().'sales_order/delete/'.$value['id'].'" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>';
                for(i=0; i<data.length; i++){
                    html += '<tr>'+
                              '<td>'+data[i].service_name+'</td>'+
                                '<td>'+data[i].assign_work+'</td>'+
                                '<td>'+data[i].gst_name+'</td>'+
                                '<td>'+data[i].quantity+'</td>'+
                                '<td>'+data[i].rate+'</td>'+
                                '<td>'+data[i].gst_amount+'<input type="hidden" name="serviceTot" class="totservice" value="'+data[i].gst_amount+'">'+'</td>'+
                                '<td>'+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-id="'+data[i].id+'">Delete</a>'+
                                      // '<a href="'+base_url+'production/deleteServices/'+data[i].id+'" onclick="return confirm(\' you want to delete?\');">Remove</a>'
                                  //  '<a> href="'.base_url.'production/deleteService/'+data[i].id+'" onclick="return confirm(\' you want to delete?\');"> Delete</a>'+
                                  //  '<a href="javascript:void(0);" class="btn btn-danger btn-sm" data-id="'+data[i].id+'">Delete</a>'+
                                '</td>'+
                            '</tr>';
                      unit = parseInt(data[i].rate);
                      
                      gst = parseInt(data[i].gst_amount);
                      
                      tot = tot + gst;
                      totunit = totunit + unit;


                      $('#service_type').val('0');
                      $('#assign_work').val('0');
                      $('#unit').val('');
                      $('#quality').val('');
                      $('#gst_type').val('0');

                }
                $('#totcost').val(tot);
                $('#totunit').val(totunit);
                $('#show_services').html(html);
                    
                    loadCal();
                }
            });
        }
        
        $('#product_category').on('change', function(){
            
            $('#product_subcategory').html('');
            
           var cat_id = $(this).val();
        //   alert(company_id);
           var html = '';
          $.ajax({
                
                url: base_url + 'product_category/fecthAllSubCatDataByID/',
                type: 'post',
                dataType: 'json',
                data : {cat_id:cat_id},
                success:function(response){
                    
                    
                    // console.log(response);
                    html += '<option value="0">---Select Subcategory---</option>'; 
                    
                    $.each(response, function(index, value) {
                      html += '<option value="'+value.id+'">'+value.subcategory_name+'</option>';             
                    });
                    
                    $('#product_subcategory').append(html);
                }
          });
        });
        
        $('.measuremnt').on('change', function(){
            
            var measurement = $(this).val();
            // alert(measurement);
            if(measurement == "readymade")
            {
                $('#readymade').show();
                $('#custom').hide();
            }
            else
            {
                $('#readymade').hide();
                $('#custom').show();   
            }
        });
        
        $('#quality').on('change', function(){
            
            var quality = $('#quality').val();
            var quantity = $('#quantity').val();
            
            if(quantity < quality)
            {
                alert("Service Quantity more than Product Quantity");
                $('#quality').val("");
            }
        })
        
        
        $('#addService').on('click', function(){
           
            var service_type = $('#service_type').val();
            var assign_work = $('#assign_work').val();
            var unit = $('#unit').val();
            var quality = $('#quality').val();
            var gst_type = $('#gst_type').val();
            
            var jobno = $('#jobno').val();
            var quantity = $('#quantity').val();
            
            if(quantity < quality)
            {
                alert("Service Quantity more than Product Quantity");
                $('#quality').val("");
            }
            else
            {
                // console.log(service_type);
                $.ajax({
                    type : "POST",
                    url  : base_url + "gst/fetchAllDataByID",
                    dataType : "JSON",
                    data : {gst_id:gst_type},
                    success: function(gstData){
                        
                        var totGst = (Number(gstData.cgst) + Number(gstData.sgst) + Number(gstData.igst));
                        
                        // console.log(totGst);
                        var price = unit * quality;
                        // console.log(price);
                        var amt = (price * totGst) / 100;
                        console.log(amt);
                        var gstAmt = amt + price;
                        // console.log(gstAmt);
                        
                        $.ajax({
                            type : "POST",
                            url  : base_url + "service_master/fetchAllDataByID",
                            dataType : "JSON",
                            data : {service_id:service_type},
                            success: function(serviceData){
                        
                                // console.log(serviceData);
                                
                                
                                $.ajax({
                                    type : "POST",
                                    url  : base_url + "ledger_master/fecthLedgerDataByID",
                                    dataType : "JSON",
                                    data : {ledger_id:assign_work},
                                    success: function(workerData){
                                
                                        // console.log(workerData);
                                        
                                        var html = '';
                                        
                                        var table = $("#consumptionData");
                                        var count_table_tbody_tr = $("#show_services tr").length;
                                        var row_id = count_table_tbody_tr + 1;
                                        
                                        
                                        html += '<tr id="row_'+row_id+'">';
                                            html += '<td>';
                                                html += '<input type="hidden" name="service[]" value="'+serviceData.id+'" >';
                                                html += '&nbsp'+serviceData.service_name+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="assign_worker[]" value="'+workerData.id+'" >';
                                                html += '&nbsp'+workerData.ledger_name+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="gst[]" value="'+gstData.id+'" >';
                                                html += '&nbsp'+gstData.gst_name+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="quality[]" value="'+quality+'" >';
                                                html += '&nbsp'+quality+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="rate[]" value="'+unit+'" >';
                                                html += '&nbsp'+unit+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<input type="hidden" name="total[]" value="'+gstAmt+'" class="totservice">';
                                                html += '&nbsp'+gstAmt+'';
                                            html += '</td>';
                                            
                                            html += '<td>';
                                                html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
                                            html += '</td>';
                                        
                                        html += '<tr>';
                                        
                                        $('#service_type').val('0');
                                        $('#assign_work').val('0');
                                        $('#unit').val('');
                                        $('#quality').val('');
                                        $('#gst_type').val('0');
                    
                    		            $('#show_services').append(html);
                                        
                                        loadCal();
                                    }
                                });
                            }
                        });
                    }
                });
            }
        })
        
        
        
        $('#show_services').on('click','.item_delete',function(){
            var id = $(this).data('id');
            
            $('#Modal_Delete').modal('show');
            $('[name="id"]').val(id);
        });
        
         $('#btn_delete').on('click',function(){
            var id = $('#id').val();
            $.ajax({
                type : "POST",
                url  : base_url + "alternate/deleteServices",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $('[name="product_code_delete"]').val("");
                    $('#Modal_Delete').modal('hide');
                    
                    show_services();
                    loadCal();
                }
            });
            return false;
        });
        
    });
</script>



<script>

    var base_url = '<?php echo base_url(); ?>'; 
    
    $('#search').on('click', function(){
        
        var searchproduct = $('#searchproduct').val();
        
        // alert(searchproduct);
        

                var table = $("#consumptionData");
                var count_table_tbody_tr = $("#consumptionData tr").length;
                var row_id = count_table_tbody_tr + 1;
                
                $.ajax({

                      url: base_url + 'internal_consumption/fetchDataByBarcodeId/',
                      type: 'post',
                      dataType: 'json',
                      data : {barcode_code:searchproduct},
                      success:function(response){
                          
                          // console.log(response);
                          
                          if(response.status != 'available')
                          {
                              alert('Data Not Available');
                          }
                          else
                          {
                              $.ajax({

                                  url: base_url + 'sku/getUnitBySku/',
                                  type: 'post',
                                  dataType: 'json',
                                  data : {sku:response.sku},
                                  success:function(unitResponse){

                                      // console.log(unitResponse);

                                      var html = '';
                                  
                                      html += '<tr id="row_'+row_id+'">';
                                              
                                              $('#quantity_'+row_id).val("1");
                                              $('#conversionvalue_'+row_id).val("0");
                                          
                                          html += '<td>';
                                              html += '<input type="hidden" name="countpno[]" value="1" id="countpno" class="countqty" required readonly>';
                                              html += '<input type="text" name="pno[]" value="'+response.pno+'" id="pno_'+row_id+'" required readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="quantityMaterial[]" onchange="cal('+row_id+')" id="quantity_'+row_id+'" class="countQuantity" value="1" readonly>';
                                          html += '</td>';

                                          html += '<td>';
                                              html += '<input type="text" name="conversion[]" id="conversion_'+row_id+'" value="'+unitResponse.unit+'">';
                                              // html += '<input type="text" name="conversion[]" id="conversion_'+row_id+'" value="'+unitResponse.conversion+'">';
                                          html += '</td>';
                                          
                                          // html += '<td>';
                                          //     html += '<select  onchange="getConversionData('+row_id+')" >';
                                          //             html += '<option value="0">---Select One---</option>';
                                                          
                                          //                 $.each(unitResponse, function(index, value) {
                                                              
                                          //                    html += '<option value="'+value.id+'">'+value.unit+'</option>';
                                          //                 });
                                                              
                                          //     html += '</select>';
                                          // html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="conversionvalue[]" id="conversionvalue_'+row_id+'" readonly value="'+unitResponse.conversion+'" >';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<input type="text" name="baseprice[]" value="'+response.baseprice+'" id="baseprice_'+row_id+'" class="bpclass" readonly>';
                                          html += '</td>';
                                         
                                          html += '<td>';
                                              html += '<input type="text" name="subtotal[]" value="'+response.baseprice+'" id="subtotal_'+row_id+'" class="totmaterials" readonly>';
                                          html += '</td>';
                                          
                                          html += '<td>';
                                              html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
                                          html += '</td>';
                                          
                                          
                                          html += '</tr>';
                                          
                                          $('#consumptionData').append(html);
                                          
                                          // $('#bp').val(response.baseprice);
                                          loadCal();
                                          
                                          // loadCount(); 
                                  }
                              });          
                          }
                          
                          $('#searchproduct').val("");
                          
                          // $('#cpno').val("0");
                          
                          // loadCount();                                
                      } 
                  });     
    });
    
    
    
    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
        
        loadCal();
    });
</script>

<script type="text/javascript">
  
  var base_url = '<?php echo base_url(); ?>';

  function cal(row_id)
  {
    var quantity = parseFloat($('#quantity_'+row_id).val());
    var conversionvalue = parseFloat($('#conversionvalue_'+row_id).val());
    
    var subtotal = quantity * conversionvalue;

    $('#subtotal_'+row_id).val(subtotal);

    loadCal();
  }
</script>

<script type="text/javascript">

  function readymade()
  {
      var table = $("#measurementData");
      var count_table_tbody_tr = $("#measurementData tr").length;
      var row_id = count_table_tbody_tr + 1;

      var size = $('#readymadesize').val();
      var qty = $('#readymadequantity').val();

      var html = '';
                                  
      html += '<tr id="row_'+row_id+'">';
         
          html += '<td>';
            html += '<input type="text" name="readymadesizeList[]" value="'+size+'">';
          html += '</td>';

          html += '<td>';
            html += '<input type="text" name="readymadequantityList[]" value="'+qty+'">';
          html += '</td>';

          html += '<td>';
            html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm remove">Remove</a>';
          html += '</td>';

      html += '</tr>';
          
      $('#measurementData').append(html);

      $('#readymadesize').val('');
      $('#readymadequantity').val('');
  }


  // measurementData
</script>

<script type="text/javascript">
  
  function loadCal()
  {
      
    var serviceTot = 0;

    $('.totservice').each(function() {

        serviceTot += parseFloat($(this).val(), 10);
        // console.log(serviceTot);
    });
    $('#tot_service').val(serviceTot);

    var service = parseFloat($('#tot_service').val());
    
    $('#totcost').val(service);

    // productioncostunit
    // totproductioncost
  }
</script>



