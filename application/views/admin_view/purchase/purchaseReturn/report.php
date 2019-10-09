<!-- < ?php echo "<pre>"; print_r($invoiceData); exit(); // print_r($itemData);  //  print_r($companyDetails); exit(); ?> -->
<?php
  $cityData = $this->model_state->fecthCityByID($companyDetails['city']);
  $salesType = $this->model_ledger->fecthDataByID($invoiceData['salestype_id']);
  $accountData = $this->model_ledger->fecthDataByID($invoiceData['account_id']);
  // echo "<pre>"; print_r($accountData); exit();
?>
	<style>
        .pl15
        {
          padding-left: 15px;
        }
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
  <div class="content-wrapper" id="printDiv">
   
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
                                    <h4><b><?php echo strtoupper($companyDetails['company_name']); ?></b></h4>
                                    <h5>Nagpur-Main</h5>
                                    <h6><?php echo ucwords($companyDetails['address1']); ?><?php echo ucwords($cityData['city_name']); ?>, <?php echo ucwords($companyDetails['pincode']); ?>, Mob : <?php echo ucwords($companyDetails['mobile_no']); ?></h6>
                                    <h6>GST No : <?php echo ucwords($companyDetails['gst']); ?>  &  PAN No : <?php echo ucwords($companyDetails['pan']); ?></h6>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    <h5><b> Purchase Return Invoice </b></h5>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col-md-6">
                                    <table width="100%">
                                      <tr>
                                        <td width="100px">
                                          <b>Bill No :-</b>
                                        </td>
                                        <td><?php echo $invoiceData['order_no']; ?></td>
                                      </tr>
                                      <tr>
                                        <td><b>Bill Date :-</b></td>
                                        <td><?php echo date("d-m-Y", strtotime($invoiceData['date'])); ?></td>
                                      </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table width="100%">
                                      <tr>
                                        <td><b>Sales Type :-</b></td>
                                        <td><?php echo $salesType['ledger_name']; ?></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <b>Salesman Code :-</b>
                                        </td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <b>Shipping Type :-</b>
                                        </td>
                                        <td><?php echo $invoiceData['shipping_type']; ?></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <b>Courier No :-</b>
                                        </td>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <td>
                            <span class="pl15">Name , Address & GSTIN of the Recipient</span>
                          </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col-md-6">
                                    <table width="100%">
                                      <tr>
                                        <td width="100px">
                                          <b>Name :-</b>
                                        </td>
                                        <td><?php echo $accountData['ledger_name']; ?></td>
                                      </tr>
                                      <tr>
                                        <td><b>Address :-</b></td>
                                        <td><?php echo $accountData['address_1']; ?></td>
                                      </tr>
                                      <tr>
                                        <td width="100px">
                                          <b>GST No :-</b>
                                        </td>
                                        <td><?php echo $accountData['gst']; ?></td>
                                      </tr>
                                      <tr>
                                        <td><b>Sale Memo :-</b></td>
                                        <td></td>
                                      </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table width="100%">
                                      <tr>
                                        <td><b>Payment Type :-</b></td>
                                        <td>Creadit</td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <b>Payment Details :-</b>
                                        </td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <b>Shipping Address :-</b>
                                        </td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <b>Sale Order No :-</b>
                                        </td>
                                        <td></td>
                                      </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" align="center">
                                    <tr>
                                        <th class="myBorder">&nbsp; Sr No.</th>
                                        <th class="myBorder">&nbsp; SKU</th>
                                        <th class="myBorder">&nbsp; HSN</th>
                                        <td class="myBorder">&nbsp; QTY</td>
                                        <th class="myBorder">&nbsp; Base Price</th>
                                        <th class="myBorder">&nbsp; DISC.(%)</th>
                                        <th class="myBorder">&nbsp; SGST</th>
                                        <th class="myBorder">&nbsp; CGST</th>
                                        <th class="myBorder">&nbsp; IGST</th>
                                        <th class="myBorder">&nbsp; GST Amt.</th>
                                        <th class="myBorder">&nbsp; Gross Amt.</th>
                                    </tr>
                                    <?php $qty=$subtotal=$discount=$tsgst=$tcgst=$tigst=0; $no=1; foreach($itemData as $rows): ?>

                                      <?php
                                        $productData = $this->model_sku->fecthSkuDataBySKU($rows['sku']);
                                        $hsnData = $this->model_hsn->fecthAllDataById($productData['hsn_id']);
                                        $discountData = $this->model_discount->fecthDataByID($rows['discount']);
                                        $gstData = $this->model_gst->fetchAllDataByID($rows['gst']);

                                        $sgst = ($rows['grossprice'] * $gstData['sgst']) / 100;
                                        $cgst = ($rows['grossprice'] * $gstData['cgst']) / 100;
                                        $igst = ($rows['grossprice'] * $gstData['igst']) / 100;
                                      ?>
                                      <tr>
                                          <td class="myBorder">&nbsp; <?php echo $no; ?></td>

                                          <td class="myBorder">&nbsp; <?php echo $rows['sku']; ?></td>
                                          
                                          <td class="myBorder">&nbsp; <?php echo $hsnData['hsn_name']; ?></td>
                                          
                                          <td class="myBorder">&nbsp; <?php echo $rows['qty']; ?></td>
                                          
                                          <td class="myBorder">&nbsp; <?php echo $rows['grossprice']; ?></td>
                                          
                                          <td class="myBorder">&nbsp; <?php echo $rows['disvalue'] != '' ? $rows['disvalue']." ".($discountData['discount']) :   '0'; ?></td>
                                          
                                          <td class="myBorder">&nbsp; <?php echo $rows['gst'] != '' ? $sgst." ".($gstData['sgst']) : '0'; ?></td>
                                          
                                          <td class="myBorder">&nbsp; <?php echo $rows['gst'] != '' ? $cgst." ".($gstData['cgst']) : '0'; ?></td>
                                          
                                          <td class="myBorder">&nbsp; <?php echo $rows['gst'] != '' ? $igst." ".($gstData['igst']) : '0'; ?></td>
                                          
                                          <td class="myBorder">&nbsp; <?php echo $rows['gstamt']; ?></td>
                                          
                                          <td class="myBorder">&nbsp; <?php echo $rows['grossprice']; ?></td>

                                          <?php
                                            $qty = $qty + $rows['qty'];
                                            $subtotal = $subtotal + $rows['baseprice'];
                                            $discount = $discount + $rows['disvalue'];
                                            $tsgst = $tsgst + $sgst;
                                            $tcgst = $tcgst + $cgst;
                                            $tigst = $tigst + $igst;
                                          ?>

                                      </tr>
                                    <?php $no++; endforeach; ?>
                                    <tr>
                                        <td class="myBorder" colspan="2">&nbsp;</td>
                                        <td class="myBorder">&nbsp; Total</td>
                                        <td class="myBorder">&nbsp; <?php echo $qty; ?></td>
                                        <td class="myBorder" colspan="5">&nbsp;</td>
                                        <td class="myBorder"><b>&nbsp; Subtotal:-</b></td>
                                        <td class="myBorder"><b>&nbsp; <?php echo $subtotal; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="myBorder" colspan="9">
                                          <table width="100%">
                                              <tr>
                                                <td>
                                                  <div class="pl15">
                                                      <h5>
                                                        <b><u>Bank Details</u> :-</b>
                                                      </h5>
                                                      <p>
                                                        <span><b>Name :- </b></span> Bank of Maharashtra AC No 60263398967 <br>
                                                        <span><b>IFSC :- </b></span>MAHB000061 <br>
                                                        <span><b>Swift Code :- </b></span> 000000 <br>
                                                        <span><b>Address :- </b></span> Shreeji Krupa,Central Avenue,Gandhibagh
                                                      </p>
                                                  </div>
                                                </td>
                                              </tr>
                                          </table>
                                        </td>
                                        <td class="myBorder" width="100px">
                                            <table width="100%" border="1">
                                              <tr>
                                                  <td>Discount</td>
                                              </tr>
                                              <tr>
                                                  <td>SGST</td>
                                              </tr>
                                              <tr>
                                                  <td>CGST</td>
                                              </tr>
                                              <tr>
                                                  <td>IGST</td>
                                              </tr>
                                              <tr>
                                                  <td>Adjustment</td>
                                              </tr>
                                              <tr>
                                                  <td>Cash</td>
                                              </tr>
                                              <tr>
                                                  <td>Tender Change</td>
                                              </tr>
                                            </table>
                                        </td>
                                        <td class="myBorder" width="100px">
                                            <table width="100%" border="1">
                                              <tr>
                                                  <td style="text-align: right; padding-right: 5px"><?php echo $discount; ?></td>
                                              </tr>
                                              <tr>
                                                  <td style="text-align: right; padding-right: 5px"><?php echo $tsgst; ?></td>
                                              </tr>
                                              <tr>
                                                  <td style="text-align: right; padding-right: 5px"><?php echo $tcgst; ?></td>
                                              </tr>
                                              <tr>
                                                  <td style="text-align: right; padding-right: 5px"><?php echo $tigst; ?></td>
                                              </tr>
                                              <tr>
                                                  <td style="text-align: right; padding-right: 5px"><?php echo $invoiceData['adjustment']; ?></td>
                                              </tr>
                                              <tr>
                                                  <td style="text-align: right; padding-right: 5px"><?php echo $discount; ?></td>
                                              </tr>
                                              <tr>
                                                  <td style="text-align: right; padding-right: 5px">0</td>
                                              </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                      <td class="myBorder" colspan="9">
                                        <div class="pl15">
                                          <p><b>IN WORDS : <?php
                                            echo $this->number_to_word->convert_number($invoiceData['total_invoicevalue']);
                                            ;
                                          ?></b></p>
                                        </div>
                                      </td>
                                      <td class="myBorder">
                                        <div class="pl15"><b>Grand Total</b></div>
                                      </td>
                                      <td class="myBorder" style="text-align: right; padding-right: 5px"><?php echo $invoiceData['total_invoicevalue']; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="border:none;">
                            <td>
                                <div class="pl15">
                                    <h5>
                                      <b><u>Declaration</u></b>
                                    </h5>
                                    <p>Certified that the particulars given above are true & correct and the amount indicated represents the price actually charged and there is no flow of additional consideration directly or indirectly from the buyers. </p>

                                    <h5>
                                      <b><u>Term And Condition</u></b>
                                    </h5>
                                    <p>1. Subject To Nagpur Jurisdiction</p>
                                    <p>2. No Cancellation/ Exchange or Return of Made to Ordered or Altered Items.</p>
                                    <p>3. All Applicable Taxes/GST/Levies if/any apart from mentioned above would be Charged Extra at the time of Billing.</p>
                                    <p>4. Payment to be made on or before due date mentioned here, in favour of M/s. PARAMOUNT TRADING VENTURES ,bank details are given here-in.</p>
                                    <p>5. Cash Payment Without Original Reciept would be invalid.</p>
                                    <p>6. Payment against Made to Order or to be Altered product is Non-Refundable.</p>
                                    <p>7. No Gurantee/Warranty on designs/patterns and color fastness.</p>
                                    <p>8. Any Manufacturing/Fitting Defect would be resolved by means of Alteration/Repairs.</p>
                                    <p>9. Committed Delivery date can change,depending upon the prevailing conditions and supplies.</p>
                                    <p>10. We reserve the right to demand settlement of this invoice bill at any time before due date.</p>
                                </div>
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


<script type="text/javascript">
  $(document).ready(function(){

      // alert('Print Div');
      var printDiv = document.getElementById("printDiv");
      // alert(printDiv);
      newWin= window.open("");
      newWin.document.write(printDiv.outerHTML);
      newWin.print();
      newWin.close();
  });
</script>