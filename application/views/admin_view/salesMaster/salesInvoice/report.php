<?php 
  // echo "<pre>"; print_r($allData); 
  // echo "<pre>"; print_r($itemData); 

  $salestype = $this->model_ledger->fecthAllDatabyID($allData['sale_type']);
  $deliverymemo = $this->model_deliverymemo->fecthAllDataByID($allData['delivery_memo']);

  // $hsn = $this->model_hsn->fecthAllDataByID($allData['delivery_memo']);
  // echo "<pre>"; print_r($product); 

  // exit(); 
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
    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
            
        
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    
                    <table border="1" width="100%">
                        <tr>
                            <td>
                                <center>
                                    <h4><b>PARAMOUNT TRADING VENTURES</b></h4>
                                    <h5>Nagpur-Main</h5>
                                    <h6>657/A,CITY POST OFFICE ROAD OPP.WHOLESALE CLOTH MARKET,ITWARI 440002 , Mob : 8087070388</h6>
                                    <h6>GST No : 27AERPG3884M1ZP  &  PAN No :AERPG3884M</h6>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    <h5><b>TAX INVOICE</b></h5>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <div class="col-md-4">
                                  <div>
                                    <label><b>Bill No. :- </b></label>
                                    <?php echo $allData['inventory_no']; ?>
                                  </div>
                                  <div>
                                    <label><b>Bill Date. :- </b></label>
                                    <?php echo $allData['date']; ?>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div>
                                    <label><b>Sales Type :- </b></label>
                                    <?php echo $salestype['ledger_name']; ?>
                                  </div>
                                  <div>
                                    <label><b>Salesman Code :- </b></label>
                                    
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div>
                                    <label><b>Shipping Type :- </b></label>
                                    <?php echo $allData['shipping_type']; ?>
                                  </div>
                                  <div>
                                    <label><b>Couries No. :- </b></label>
                                    
                                  </div>
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>&nbsp;&nbsp; Name , Address & GSTIN of the Recipient </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <div class="col-md-6">
                                  <div>
                                    <label><b>Name :- </b></label>
                                    
                                  </div>
                                  <div>
                                    <label><b>Address :- </b></label>
                                    
                                  </div>
                                  <div>
                                    <label><b>GST No. :- </b></label>
                                    
                                  </div>
                                  <div>
                                    <label><b>Mobile No. :- </b></label>
                                    
                                  </div>
                                  <div>
                                    <label><b>Delivery Memo :- </b></label>
                                    <?php echo $deliverymemo['delivery_no'] ?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div>
                                    <label><b>Payment Type :- </b></label>
                                    
                                  </div>
                                  <div>
                                    <label><b>Payment Details :- </b></label>
                                   
                                  </div>
                                  <div>
                                    <label><b>Shipping Address :- </b></label>
                                    
                                  </div>
                                  <div>
                                    <label><b>Sales Order Number :- </b></label>
                                    
                                  </div>
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="1" width="100%">
                                    <tr>
                                        <th>&nbsp; Sr no.</th>
                                        <th>&nbsp; SKU</th>
                                        <th>&nbsp; HSN </th>
                                        <th>&nbsp; Qty</th>
                                        <th>&nbsp; MRP</th>
                                        <th>&nbsp; DISC. (%)</th>
                                        <th>&nbsp; SGST</th>
                                        <th>&nbsp; CGST</th>
                                        <th>&nbsp; IGST</th>
                                        <th>&nbsp; GST AMT</th>
                                        <th>&nbsp; GROSS AMOUNT</th>
                                    </tr>

                                    <?php $no=1; foreach($itemData as $rows): ?>

                                    <?php
                                      $sku = $rows['sku'];

                                      $product = $this->model_sku->fecthSkuDataBySKU($sku);

                                      $hsn = $this->model_hsn->fecthAllDataById($product['hsn_id']);

                                      $gst = $this->model_gst->fetchAllDataByID($rows['gst']);
                                    ?>
                                      <tr>
                                          <td>&nbsp; <?php echo $no; ?></td>
                                          <td>&nbsp; <?php echo $sku; ?></td>
                                          <td>&nbsp; <?php echo $hsn['hsn_name']; ?></td>
                                          <td>&nbsp; <?php echo $rows['quantity']; ?></td>
                                          <td>&nbsp; <?php echo $rows['baseprice']; ?></td>
                                          <td>&nbsp; <?php echo $rows['disvalue']; ?></td>
                                          <td>&nbsp; <?php echo $gst['sgst']; ?></td>
                                          <td>&nbsp; <?php echo $gst['cgst']; ?></td>
                                          <td>&nbsp; <?php echo $gst['igst']; ?></td>
                                          <td>&nbsp; <?php echo $rows['gstamt']; ?></td>
                                          <td>&nbsp; <?php echo $rows['finalprice']; ?></td>
                                      </tr>
                                    <?php $no++; endforeach; ?>

                                    <tr>
                                        <td colspan="3">&nbsp; </td>
                                        <td>&nbsp; Total:</td>
                                        <td>&nbsp; </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                          <div style="padding-left: 10px;">
                                              <div>
                                                <b><u>BANK DETAILS</u></b>
                                              </div>
                                              <div>
                                                <label>Name :-</label>
                                                &nbsp; ABC
                                              </div>
                                              <div>
                                                <label>Account Number :-</label>
                                                &nbsp; 123456
                                              </div>
                                              <div>
                                                <label>IFSC Number :-</label>
                                                &nbsp; 123456
                                              </div>
                                              <div>
                                                <label>Swift Number :-</label>
                                                &nbsp; 123456
                                              </div>
                                              <div>
                                                <label>Address :-</label>
                                                &nbsp; 123456
                                              </div>
                                          </div>
                                        </td>
                                        <td>
                                            <table border="1" width="100%" align="center">
                                                <tr>
                                                  <td><b>&nbsp;Sub Total</b></td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;Discount</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;SGST</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;CGST</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;IGST</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;Adjustment</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;Cash</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;Tender Change</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table border="1" width="100%" align="center">
                                                <tr>
                                                  <td><b>&nbsp;Sub Total</b></td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;Discount</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;SGST</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;CGST</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;IGST</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;Adjustment</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;Cash</td>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;Tender Change</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9">
                                          <b>&nbsp;IN WORDS : Eight Hundred </b>
                                        </td>
                                        <td>
                                          <b>GRAND TOTAL :-</b>
                                        </td>
                                        <td>
                                          <b>10235</b>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 15px;">
                              <span>
                            <b>
                              <u>Declaration :</u>
                            </b>
                            <p>Certified that the particulars given above are true & correct and the amount indicated represents the price actually charged and there is no flow of additional consideration directly or indirectly from the buyers. </p>
                          </span>

                          <div>
                            <b>
                              <u>Terms & Conditions :</u>
                            </b><br>
                            <span>1. Subject To Nagpur Jurisdiction </span> <br>
                            <span>2. No Cancellation/ Exchange or Return of Made to Ordered or Altered Items. </span> <br>
                            <span>3. All Applicable Taxes/GST/Levies if/any apart from mentioned above would be Charged Extra at the time of Billing. </span> <br>
                            <span>4. Payment to be made on or before due date mentioned here, in favour of M/s. PARAMOUNT TRADING VENTURES ,bank details are given here-in. </span> <br>
                            <span>5. Cash Payment Without Original Reciept would be invalid. </span> <br>
                            <span>6. Payment against Made to Order or to be Altered product is Non-Refundable. </span> <br>
                            <span>7. No Gurantee/Warranty on designs/patterns and color fastness. </span> <br>
                            <span>8. Any Manufacturing/Fitting Defect would be resolved by means of Alteration/Repairs. </span> <br>
                            <span>9. Committed Delivery date can change,depending upon the prevailing conditions and supplies. </span> <br>
                            <span>10. We reserve the right to demand settlement of this invoice bill at any time before due date. </span>
                          </div>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                &nbsp;
                                <span><b>* This is a Computer Generated Document hence no Signature is Required</b></span>
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

