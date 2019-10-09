

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SKU Master
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">SKU Master</li>
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
          <div class="box" style="padding: 5px;">
            <br>
            <div style="float:right">
                <a href="<?php echo base_url() ?>sku/create" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add SKU</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="data">
                  <thead>
                   <tr>
                      <th>Sr No.</th>
                      <th>SKU</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Sub-Category</th>
                      <!--<th>Description</th>-->
                      <th>GST % (Selling)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>-->
                    <!--  <td>19F-057-2049 </td>-->
                    <!--  <td>19F-057-2049 </td>-->
                    <!--  <td>19 Fellowz Jeans</td>-->
                    <!--  <td>Mens</td>-->
                    <!--  <td>Jeans</td>-->
                      <!--<td width="100px">Jeans Jeans Jeans </td>-->
                    <!--  <td>12</td>-->
                    <!--  <td width="170px">-->
                    <!--    <a href="< ?php echo base_url() ?>sku/update" class="btn btn-sm btn-info">-->
                    <!--      <i style="color: white" class="fa fa-edit"></i> Edit-->
                    <!--    </a>-->
                    <!--    <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_deleteSKU" class="btn btn-sm btn-danger">-->
                    <!--      <i style="color: white" class="fa fa-trash"></i> Delete-->
                    <!--    </a>-->
                    <!--  </td>-->
                    <!--</tr>-->
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

 <!-- add SKU Modal -->
    <form method="POST" enctype="multipart/form-data">
      <div class="modal fade" id="Modal_addSKU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  Add SKU
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="col-lg-12 col-md-12">
                    <div>
                        <div>
                          <label>Category</label>
                        </div>
                        <div>
                          <select name="category" class="form-control">
                            <option>--- Select Category ----</option>
                          </select>
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>Sub-Category</label>
                        </div>
                        <div>
                          <select name="category" class="form-control">
                            <option>--- Select Sub-Category ----</option>
                          </select>
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>SKU</label>
                        </div>
                        <div>
                          <input type="text" name="sku" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>Product Name</label>
                        </div>
                        <div>
                          <input type="text" name="product_name" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>GST % while Selling</label>
                        </div>
                        <div>
                          <input type="text" name="gst" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>Shortend Description</label>
                        </div>
                        <div>
                          <input type="text" name="description" class="form-control">
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" name="save" value="Submit" class="btn btn-success">
              </div>
            </div>
          </div>
        </div>
    </form>

    <!-- Edit SKU Modal -->
    <form method="POST" enctype="multipart/form-data">
      <div class="modal fade" id="Modal_editSKU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  Edit SKU
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="col-lg-12 col-md-12">
                    <div>
                        <div>
                          <label>Category</label>
                        </div>
                        <div>
                          <select name="category" class="form-control">
                            <option>--- Select Category ----</option>
                          </select>
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>Sub-Category</label>
                        </div>
                        <div>
                          <select name="category" class="form-control">
                            <option>--- Select Sub-Category ----</option>
                          </select>
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>SKU</label>
                        </div>
                        <div>
                          <input type="text" name="sku" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>Product Name</label>
                        </div>
                        <div>
                          <input type="text" name="product_name" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>GST % while Selling</label>
                        </div>
                        <div>
                          <input type="text" name="gst" class="form-control">
                        </div>
                    </div>
                    <div>
                        <div>
                          <label>Shortend Description</label>
                        </div>
                        <div>
                          <input type="text" name="description" class="form-control">
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" name="save" value="Submit" class="btn btn-success">
              </div>
            </div>
          </div>
        </div>
    </form>

<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url(); ?>';
        
        $('#data').DataTable({
            
            "ajax": {
                'processing':true,
                'serverSide':true,
                "searching": true,
                 url : base_url + "sku/fetchAllData",
                'order': []
            },
            
        });
         
    });
</script>