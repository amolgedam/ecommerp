<!-- < ?php echo "<pre>"; print_r($itemData); exit;// echo "<pre>"; print_r($allData); exit; ?> -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Purchase Invoice
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Purchase Invoice</li>
      </ol>
    </section>
    
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
          <div class="box">
            <div class="box-body">
                <form method="post" action="<?php echo base_url(); ?>purchase_invoice/update">
                <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Invoice No</label>
                      <input type="hidden" name="id" class="form-control" value="<?php echo $allData['id']; ?>" required>
                    <input type="text" name="pinvoice_no" class="form-control" value="<?php echo $allData['invoice_no']; ?>" required>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Invoice Date</label>
                      <input type="date" name="invoice_date" class="form-control" value="<?php echo $allData['invoice_date']; ?>" required>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Entry Date</label>
                      <input type="date" name="entry_date" class="form-control" value="<?php echo $allData['entry_date']; ?>" required>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Order No.</label>
                      
                      <?php
                            $this->load->model('model_purchaseorder');
                            $orderDara = $this->model_purchaseorder->fecthAllDatabyID($allData['porder_no']);
                      ?>
                      
                      <input type="text" name="order_no" class="form-control" value="<?php echo $orderDara['order_no']; ?>" readonly>
                      <input type="hidden" name="porder_no" class="form-control" value="<?php echo $allData['porder_no']; ?>" >
                      <!-- <select name="porder_no" id="porder_no" class="form-control"> -->
                      <!--  <option value="0">---Select One---</option>-->
                      <!--  < ?php foreach($purchaseorderData as $rows): ?>-->
                      <!--      <option value="< ?php echo $rows['id']; ?>" < ?php echo $allData['porder_no'] == $rows['id'] ? "selected" : "" ; ?> >< ?php echo $rows['order_no'];  ?></option>-->
                      <!--  < ?php endforeach; ?>-->
                      <!--</select>-->
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Account</label>
                      <select name="paccount" id="paccount" class="form-control">
                        <option value="0">---Select One---</option>
                            <?php foreach($ledgerPurSalesAccount as $rows): ?>
                              
                              <?php if($this->session->userdata['wo_company'] == $rows->company_id){ ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $rows->id == $allData['paccount'] ? "selected" : "";  ?> > <?php echo $rows->ledger_name; ?></option>
                              <?php } ?>

                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Account</label>
                      <select name="account" id="account" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($ledgerAccount as $rows): ?>
                              <option value="<?php echo $rows->id; ?>"  <?php echo $allData['account'] == $rows->id ? "selected" : "" ; ?>><?php echo $rows->ledger_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Payment Type</label>
                      <select name="ptype" id="ptype" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($paytype as $rows): ?>
                          <option value="<?php echo $rows->id; ?>" <?php echo $allData['ptype'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->payment_name; ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Due Day</label>
                      <input type="text" name="due_day" id="dueDay" value="<?php echo $allData['dueDay']; ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Due Date</label>
                      <input type="text" name="due_date" id="dueDate" value="<?php echo $allData['dueDate']; ?>" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Shiping Type</label>
                      <input type="text" name="stype" value="<?php echo $allData['stype']; ?>" class="form-control">
                      <!--<div class="row">-->
                        <!--<div class="col-md-2">-->
                        <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addShipingType" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>-->
                        <!--</div>-->
                      <!--  <div class="col-md-12">-->
                      <!--      <select name="stype" id="stype" class="form-control">-->
                      <!--        <option value="0">---Select One---</option>-->
                      <!--        < ?php foreach($shiptype as $rows): ?>-->
                      <!--          <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['stype'] == $rows->id ? "selected" : "" ; ?> >< ?php echo $rows->shipping_name; ?></option>-->
                      <!--        < ?php endforeach; ?>-->
                      <!--      </select>-->
                      <!--  </div>-->
                      <!--</div>-->
                    </div>
                  </div>  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Shiping Tracking No.</label>
                      <input type="text" name="stracking_no" value="<?php echo $allData['stracking_no']; ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Division</label>
                      <select name="division" id="division" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($division as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['division'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->division_name; ?></option>
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
                              <option value="< ?php echo $rows->id; ?>" < ?php echo $allData['branch'] == $rows->id ? "selected" : "" ; ?> >< ?php echo $rows->branch_name; ?></option>
                          < ?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Location</label>
                      <select name="location" id="location" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($location as $rows): ?>
                              <option value="<?php echo $rows->id; ?>" <?php echo $allData['location'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->location_name; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Purchase Type</label>
                      <select name="purchase_type" id="purchase_type" class="form-control">
                        <option value="0">---Select One---</option>
                        <?php foreach($taxAndDuties as $rows): ?>
                                <option value="<?php echo $rows->id; ?>" <?php echo $allData['purchase_type'] == $rows->id ? "selected" : "" ; ?> ><?php echo $rows->ledger_name; ?></option>
                            <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Gross Amount</label>
                      <input type="text" name="gamt" id="gamt" class="form-control" value="<?php echo $allData['gamt']; ?>" readonly>
                      <input type="hidden" name="gamtOld" class="form-control" value="<?php echo $allData['gamt']; ?>" readonly>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Tax</label>
                      <input type="text" name="total_tax" class="form-control" value="<?php echo $allData['total_tax']; ?>" readonly>
                      <input type="hidden" name="total_taxOld" class="form-control" value="<?php echo $allData['total_tax']; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Adjustment(+/-)</label>
                      <input type="text" name="adjustment" id="adjustment" value="<?php echo $allData['adjustment']; ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div>
                      <label>Total Invoice</label>
                      <input type="text" name="total_invoice" id="total_invoice" value="<?php echo $allData['total_invoice']; ?>" class="form-control" readonly="">
                      
                      <input type="hidden" name="htotal_invoice" id="htotal_invoice" value="<?php echo $allData['total_invoice']; ?>" class="form-control" readonly="">
                    </div>
                  </div>             
              </div>

              <hr>
              <div align="right">
                <a href="<?php echo base_url() ?>purchase_invoice/create" class="btn btn-default">New Invoice</a>
                <a href="<?php echo base_url(); ?>ledger_master/create" class="btn btn-primary">Create Ledger</a>
                
                <!--<a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_createLedger" class="btn btn-primary">Create Ledger</a>-->
                
                <input type="submit" name="save" value="Save Invoice" class="btn btn-success">
                <!--<input type="submit" name="barcode" value="Save Invoice and Print Barcode" class="btn btn-success">-->
                
                <?php if($allData['product_status'] == 'not'){ ?>
                    <a href="<?php echo base_url() ?>barcode/purchase_invoice/<?php echo $allData['id']; ?>" class="btn btn-success" >Print Barcode</a>
                <?php } ?>
                <a href="#" class="btn btn-default">Email</a>
                <a href="#" class="btn btn-primary">SMS</a>
                
              </div>
                </form>
            <!-- /.box-body -->
          </div>


          <div class="box">
              <br>
              <div style="float:right">
                <a href="<?php echo base_url() ?>purchase_invoiceitem/create/<?php echo $invoice_id; ?>" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Item</a>
              </div>
              <br><br>
            <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped mydatatable">
                    <thead>
                      <tr>
                        <th>Sr. No</th>
                        <th>SKU</th>
                        <th>Quantity</th>
                        <th>Basic Rate</th>
                        <th>Purchase Net Price/Unit</th>
                        <th>MRP</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; $totQty = 0; foreach($itemData as $rows): ?>

                        <?php
                          $skuData = $this->model_sku->fecthSkuDataByID($rows['sku_id']);
                          
                          $totQty = $totQty + $rows['quantity'];
                        ?>
                          <tr>
                              <td><?php echo $no; ?></td>
                                  <td><?php echo $skuData['product_code']; ?></td>
                                  <td>
                                    <input type="hidden" class="qtycal" value="<?php echo $rows['quantity']; ?>">  
                                      <?php echo $rows['quantity']; ?>
                                    </td>
                                  <td><?php echo $rows['base_price']; ?></td>
                                  <td><?php echo $rows['pnetprice']; ?></td>
                                  <td><?php echo $rows['mrp_price']; ?></td>
                                  <td>
                                    <a href="<?php echo base_url(); ?>purchase_invoiceitem/update/<?php echo $rows['id']; ?>/<?php echo $invoice_id ?>" class="btn btn-info" >Edit</a>
                                    <a href="<?php echo base_url(); ?>purchase_invoiceitem/deleteItem/<?php echo $rows['id']; ?>" onclick="return confirm('you want to delete?')" class="btn btn-danger" >Delete</a>
                                    
                                    <a href="<?php echo base_url(); ?>purchase_invoiceitem/viewBarcode1/<?php echo $rows['id']; ?>" class="btn btn-success" >Details</a>
                                  </td>
                          </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                  </table>
                  
                  <div>Total Quantity:-  &nbsp;&nbsp; <?php echo $totQty; ?> </div>
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
  <!-- /.content-wrapper -->
 <!--  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer> -->

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>


<!-- FOR SHIPPING MODAL OPEN -->

<?php
  
  $this->load->view('admin_view/templates/modals/shippingType');
  $this->load->view('admin_view/templates/modals/createLedger');

?>

<script>
    $('#adjustment').on('keyup', function(){
        
       var adjustment = parseFloat($(this).val());
       var gamt = parseFloat($('#gamt').val());
       // var total_invoice = $('#total_invoice').val();
       var htotal_invoice = $('#htotal_invoice').val();
       
       var invoice = (htotal_invoice - adjustment);
       
       // if(invoice > 0)
       // {
           $('#total_invoice').val(invoice);
       // }
       // else
       // {
       //     alert("Invoice in Negative formate");
       //     $(this).val('');
       //     $('#total_invoice').val(total_invoice);
       // }
    });
    
  
    
</script>