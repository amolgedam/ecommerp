

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Category
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Category</li>
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

        <?php if(isset($errorName)){ echo $errorName; } ?>  

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
        <div class="col-md-5 col-sm-5 col-xs-12">
          <div class="box" style="padding: 5px;">
            <br>
            <div style="float:right">
                 <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addCategory" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Category</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Category</th>
                      <!--<th>Status</th>-->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no=1; foreach($category as $rows): ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo ucwords($rows->catgory_name); ?></td>
                          <td width="170px">
                                <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-id="<?php echo $rows->id ?>" data-catid="<?php echo $rows->catgory_id ?>" data-name="<?php echo $rows->catgory_name ?>"  data-sid="<?php echo $rows->store_id ?>" data-did="<?php echo $rows->division_id ?>" data-status="<?php echo $rows->status ?>" data-cid="<?php echo $rows->country_id ?>" data-city_id="<?php echo $rows->city_id ?>" ><i class="fa fa-pencil"></i>Edit</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteData" data-id="<?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>
                          </td>
                        </tr>
                        <?php $no++; endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-7 col-sm-7 col-xs-12">
          <div class="box" style="padding: 5px;">
            <br>
            <div style="float:right">
                 <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addSubCategory" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Sub-Category</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                      <th>Sub-Category Name</th></th>
                      <th>Category Name</th>
                      <!--<th>Status</th>-->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach($subcategory as $rows): ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo ucwords($rows->subcategory_name); ?></td>
                              <td><?php echo ucwords($rows->catgory_name); ?></td>
                              <td width="170px">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-info editSubData" data-id="<?php echo $rows->id ?>" data-catid="<?php echo $rows->category_id ?>" data-scatid="<?php echo $rows->subcatgory_id ?>" data-name="<?php echo $rows->subcategory_name ?>" data-status="<?php echo $rows->status ?>" data-sid="<?php echo $rows->store_id ?>" data-cid="<?php echo $rows->country_id ?>" data-city_id="<?php echo $rows->city_id ?>" ><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteSubData" data-id="<?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>
                              </td>
                            </tr>
                        <?php $no++; endforeach; ?>
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
   <div class="control-sidebar-bg"></div>

</div>

<!--  Modals -->
 <!-- add Category Modal -->
      <form method="POST" action="<?php echo base_url('product_category/create') ?>"  enctype="multipart/form-data">
        <div class="modal fade" id="Modal_addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Add Category
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12 col-md-12">
                          <div>
                            <label>Division</label>
                          </div>
                          <div>
                            <select name="division" class="form-control">
                              <option value="0">Select Division</option>
                              <?php foreach ($division as $key => $value) { ?>
                                  <option value="<?php echo $value->id; ?>"><?php echo $value->division_name; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <!--<div class="col-lg-12 col-md-12">-->
                        <!--  <div>-->
                        <!--    <label>Category ID</label>-->
                        <!--  </div>-->
                        <!--  <div>-->
                        <!--    <input type="text" name="categoryid" class="form-control">-->
                        <!--  </div>-->
                        <!--</div>-->
                        <div class="col-lg-12 col-md-12">
                          <div>
                            <label>Category Name</label>
                          </div>
                          <div>
                            <input type="text" name="category" class="form-control">
                          </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                          <div>
                            <label>Status</label>
                          </div>
                          <div>
                            <select name="status" class="form-control">
                              <option value="on">Active</option>
                              <option value="off">Inactive</option>
                              <
                            </select>
                          </div>
                        </div>
                        <!--<div class="col-lg-12 col-md-12">-->
                        <!--  <div>-->
                        <!--    <label>State</label>-->
                        <!--  </div>-->
                        <!--  <div>-->
                        <!--    <select name="country" class="mystate form-control">-->
                        <!--        < ?php foreach($state as $rows): ?>-->
                        <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->country_name; ?></option>-->
                        <!--        < ?php endforeach; ?>-->
                        <!--    </select>-->
                        <!--  </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-12 col-md-12">-->
                        <!--  <div>-->
                        <!--    <label>City</label>-->
                        <!--  </div>-->
                        <!--  <div>-->
                        <!--    <select name="city" class="myCity form-control">-->
                        <!--    </select>-->
                        <!--  </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-12 col-md-12">-->
                        <!--  <div>-->
                        <!--    <label>Store</label>-->
                        <!--  </div>-->
                        <!--  <div>-->
                        <!--    <select name="store" class="form-control">-->
                        <!--        < ?php foreach($store as $rows): ?>-->
                        <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->store_name; ?></option>-->
                        <!--        < ?php endforeach; ?>-->
                        <!--    </select>-->
                        <!--  </div>-->
                        <!--</div>-->
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
        
        
         
<form role="form" action="<?php echo base_url('product_category/delete') ?>" method="post" id="deleteForm">
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Unit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
                <input type="hidden" id="id_edit" name="id_edit" >
                <strong>Are you sure to delete this record?</strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Delete</button>
              </div>
          </div>
        </div>
      </div>
  </form>
      <!-- Edit Category Modal -->
      <form method="POST" action="<?php echo base_url('product_category/update') ?>" enctype="multipart/form-data">
        <div class="modal fade" id="Modal_editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Edit Category
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <!--<div class="col-lg-12 col-md-12">-->
                      <div class="row">
                            <div class="col-lg-12 col-md-12">
                              <div>
                                <label>Division</label>
                              </div>
                              <div>
                                <select name="editdivision" class="form-control">
                                  <option value="0">Select Division</option>
                                  <?php foreach ($division as $key => $value) { ?>
                                      <option value="<?php echo $value->id; ?>"><?php echo $value->division_name; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>Category ID</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--      -->
                            <!--    <input type="text" name="editcategoryid" class="form-control">-->
                            <!--  </div>-->
                            <!--</div>-->
                            <div class="col-lg-12 col-md-12">
                              <div>
                                <label>Category Name</label>
                              </div>
                              <div>
                                  <input type="hidden" name="edit_id" class="form-control">
                                <input type="text" name="editcategory" class="form-control">
                              </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                              <div>
                                <label>Status</label>
                              </div>
                              <div>
                                <select name="editcatstatus" class="form-control">
                                  <option value="on">Active</option>
                                  <option value="off">Inactive</option>
                                  <
                                </select>
                              </div>
                            </div>

                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>State</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <select name="editcountry" class="mystate form-control">-->
                            <!--        < ?php foreach($state as $rows): ?>-->
                            <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->country_name; ?></option>-->
                            <!--        < ?php endforeach; ?>-->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>City</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <select name="editcity" class="myCity form-control">-->
                            <!--    <option value="0">Select State</option>-->
                            <!--      < ?php foreach($city as $rows): ?>-->
                            <!--      <option value="< ?php echo $rows->id ?>">< ?php echo $rows->city_name ?></option>-->
                            <!--      < ?php endforeach; ?>-->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>Store</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <select name="editstore" class="form-control">-->
                            <!--        < ?php foreach($store as $rows): ?>-->
                            <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->store_name; ?></option>-->
                            <!--        < ?php endforeach; ?>-->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
                        </div> 
                  <!--</div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="save" value="Submit" class="btn btn-success">
                </div>
              </div>
            </div>
          </div>
      </form>

      <!-- edit Sub Category Modal -->
      <form method="POST" action="<?php echo base_url('product_category/createSubCat') ?>" enctype="multipart/form-data">
        <div class="modal fade" id="Modal_addSubCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Add Sub Category
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                              <div>
                                <label>Category Name</label>
                              </div>
                              <div>
                                  
                                    <select name="category" class="form-control">
                                        <?php foreach($category as $rows): ?>
                                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->catgory_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                              </div>
                            </div>
                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>Sub-Category ID</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <input type="text" name="subcategoryid" class="form-control">-->
                            <!--  </div>-->
                            <!--</div>-->
                            <div class="col-lg-12 col-md-12">
                              <div>
                                <label>Sub-Category Name</label>
                              </div>
                              <div>
                                <input type="text" name="subcategory" class="form-control">
                              </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                              <div>
                                <label>Status</label>
                              </div>
                              <div>
                                <select name="status" class="form-control">
                                  <option value="on">Active</option>
                                  <option value="off">Inactive</option>
                                  <
                                </select>
                              </div>
                            </div>

                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>State</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <select name="country" class="mystate form-control">-->
                            <!--        < ?php foreach($state as $rows): ?>-->
                            <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->country_name; ?></option>-->
                            <!--        < ?php endforeach; ?>-->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>City</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <select name="city" class="myCity form-control">-->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>Store</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <select name="store" class="form-control">-->
                            <!--        < ?php foreach($store as $rows): ?>-->
                            <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->store_name; ?></option>-->
                            <!--        < ?php endforeach; ?>-->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
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


      <!-- edit Sub Category Modal -->
      <form method="POST" action="<?php echo base_url('product_category/updateSubCat') ?>" enctype="multipart/form-data">
        <div class="modal fade" id="Modal_editSubategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Edit Sub Category
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                              <div>
                                <label>Category Name</label>
                              </div>
                              <div>
                                  <input type="hidden" name="editsubcat_id" class="form-control">
                                    <select name="edit_category" class="form-control">
                                        <?php foreach($category as $rows): ?>
                                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->catgory_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                              </div>
                            </div>
                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>Sub-Category ID</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--       -->
                            <!--    <input type="text" name="editsubcategoryid" class="form-control">-->
                            <!--  </div>-->
                            <!--</div>-->
                            <div class="col-lg-12 col-md-12">
                              <div>
                                <label>Sub-Category Name</label>
                              </div>
                              <div>
                                <input type="text" name="editsubcategory" class="form-control">
                              </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                              <div>
                                <label>Status</label>
                              </div>
                              <div>
                                <select name="editscatstatus" class="form-control">
                                  <option value="on">Active</option>
                                  <option value="off">Inactive</option>
                                  <
                                </select>
                              </div>
                            </div>

                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>State</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <select name="edit_country" class="mystate form-control">-->
                            <!--        < ?php foreach($state as $rows): ?>-->
                            <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->country_name; ?></option>-->
                            <!--        < ?php endforeach; ?>-->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>City</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <select name="edit_city" class="myCity form-control">-->
                            <!--    <option value="0">Select State</option>-->
                            <!--      < ?php foreach($city as $rows): ?>-->
                            <!--      <option value="< ?php echo $rows->id ?>">< ?php echo $rows->city_name ?></option>-->
                            <!--      < ?php endforeach; ?>-->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
                            <!--<div class="col-lg-12 col-md-12">-->
                            <!--  <div>-->
                            <!--    <label>Store</label>-->
                            <!--  </div>-->
                            <!--  <div>-->
                            <!--    <select name="edit_store" class="form-control">-->
                            <!--        < ?php foreach($store as $rows): ?>-->
                            <!--            <option value="< ?php echo $rows->id; ?>">< ?php echo $rows->store_name; ?></option>-->
                            <!--        < ?php endforeach; ?>-->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
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
      
       
         
<form role="form" action="<?php echo base_url('product_category/deleteSubCat') ?>" method="post" id="deleteForm">
      <div class="modal fade" id="deleteSubCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Unit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
                <input type="hidden" id="editsubcat_id" name="editsubcat_id">
                <strong>Are you sure to delete this record?</strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Delete</button>
              </div>
          </div>
        </div>
      </div>
  </form>
      
      
      
     <script type="text/javascript">
          var base_url = "<?php echo base_url(); ?>";

            $('.mystate').on('change', function(){
                
               var state = $(this).val();
            //   alert(state);
               if(state == 0)
               {
                   alert("Select State");
               }
               else
               {
                   $.ajax({
                       
                        type: "POST",
                        url  : base_url + "state/fetchStateByID",
                        dataType : "JSON",
                        data : {state_id:state},
                        success: function(data){
                            
                            // console.log(data);
                            $.each(data, function(i, data) {
                                $('.myCity').append("<option value='" + data.id + "'>" + data.city_name + "</option>");
                            });
                            // $('.myCity')
                        }
                   });
               }
            });
            
            $('.editData').on('click', function(){

                // alert('hi');
                var id = $(this).data('id');
                var catid = $(this).data('catid');
                var name = $(this).data('name');
                var div = $(this).data('did');
                var status = $(this).data('status');
                var sid = $(this).data('sid');
                var country = $(this).data('cid');
                var city = $(this).data('city_id');
                
                
                // alert(country);
                $('#Modal_editCategory').modal('show');
                $('[name="edit_id"]').val(id);
                 $('[name="editcategoryid"]').val(catid);
                $('[name="editcategory"]').val(name);
                $('[name="editdivision"]').val(div);
                $('[name="editcatstatus"]').val(status);
                $('[name="editstore"]').val(sid);
                $('[name="editcountry"]').val(country);
                $('[name="editcity"]').val(city);
            });
        
            $('.deleteData').on('click', function(){
        
              var id = $(this).data('id');
              $('#deleteModal').modal('show');
              $('[name="id_edit"]').val(id);
            });
            
            $('.editSubData').on('click', function(){

                // alert('hi');
                var id = $(this).data('id');
                var catid = $(this).data('catid');
                var scatid = $(this).data('scatid');
                var name = $(this).data('name');
                var status = $(this).data('status');

                var sid = $(this).data('sid');
                var country = $(this).data('cid');
                var city = $(this).data('city_id');
                
                // alert(country);
                $('#Modal_editSubategory').modal('show');
                
                $('[name="editsubcat_id"]').val(id);
                $('[name="edit_category"]').val(catid);
                $('[name="editsubcategoryid"]').val(scatid);
                $('[name="editsubcategory"]').val(name);
                $('[name="editscatstatus"]').val(status);

                $('[name="edit_store"]').val(sid);
                $('[name="edit_country"]').val(country);
                $('[name="edit_city"]').val(city);
            });
            
            $('.deleteSubData').on('click', function(){
        
              var id = $(this).data('id');
              $('#deleteSubCatModal').modal('show');
              $('[name="editsubcat_id"]').val(id);
            });
    </script>
