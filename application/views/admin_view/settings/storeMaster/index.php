

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Store Details
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Store Detais</li>
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
            <br>
            <div style="float:right">
                 <a href="javascript:void(0);" data-toggle="modal" data-target="#Modal_addStore" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Store</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Name</th>
                    <th>Landline No.</th>
                    <th>Address</th>
                    <!--<th>State</th>-->
                    <!--<th>City</th>-->
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php $no=1; foreach($storeData as $rows): ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $rows->store_name; ?></td>
                          <td><?php echo $rows->landline_no; ?></td>
                          <td><?php echo $rows->address; ?></td>
                          <!--<td>< ?php echo $rows->country_name; ?></td>-->
                          <!--<td>< ?php echo $rows->city_name; ?></td>-->
                          <td><?php echo $rows->email; ?></td>
                          <td width="200px">
                                <a href="javascript:void(0);" class="btn btn-sm btn-info editData" data-company="<?php echo $rows->company_id; ?>" data-id="<?php echo $rows->id ?>" data-sid="<?php echo $rows->store_id ?>" data-name="<?php echo $rows->store_name ?>" data-no="<?php echo $rows->landline_no ?>" data-add="<?php echo $rows->address ?>" data-country="<?php echo $rows->country_id ?>" data-city="<?php echo $rows->city_id ?>" data-email="<?php echo $rows->email ?>"><i class="fa fa-pencil"></i>Edit</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger deleteData" data-id="<?php echo $rows->id ?>"><i class="fa fa-trash"></i>Delete</a>
                          </td>
                        </tr>
                    <?php endforeach; ?>
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

 <!-- Add Modal -->
      <form method="POST" action="<?php echo base_url('store/create') ?>"  enctype="multipart/form-data">
        <div class="modal fade" id="Modal_addStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    Add Store
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="col-lg-12 col-md-12">
                        <div>
                          <div>
                            <label>Company Name</label>
                          </div>
                          <div>
                            <select type="text" name="company" class="form-control">
                                <?php foreach($company as $rows){ ?>
                                    <option value="<?php echo $rows->id; ?>"><?php echo $rows->company_name; ?></option>
                                <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div>
                          <div>
                            <label>Store ID</label>
                          </div>
                          <div>
                            <input type="text" name="storeID" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Store Name</label>
                          </div>
                          <div>
                            <input type="text" name="storeName" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Landline Number</label>
                          </div>
                          <div>
                            <input type="text" name="landline_no" class="form-control">
                          </div>
                      </div>
                      <div>
                          <div>
                            <label>Address</label>
                          </div>
                          <div>
                            <input type="text" name="address" class="form-control">
                          </div>
                      </div>
                      <!--<div>-->
                      <!--    <div>-->
                      <!--      <label>State</label>-->
                      <!--    </div>-->
                      <!--    <div>-->
                      <!--      <select name="state" class="mystate form-control">-->
                      <!--          <option value="0">Select State</option>-->
                      <!--        < ?php foreach($state as $rows): ?>-->
                      <!--        <option value="< ?php echo $rows->id ?>">< ?php echo $rows->country_name ?></option>-->
                      <!--        < ?php endforeach; ?>-->
                      <!--      </select>-->
                      <!--    </div>-->
                      <!--</div>-->
                      <!--<div>-->
                      <!--    <div>-->
                      <!--      <label>City</label>-->
                      <!--    </div>-->
                      <!--    <div>-->
                      <!--      <select name="city" class="myCity form-control">-->
                      <!--      </select>-->
                      <!--    </div>-->
                      <!--</div>-->
                      <div>
                          <div>
                            <label>Email</label>
                          </div>
                          <div>
                            <input type="email" name="email" class="form-control">
                          </div>
                      </div>

                      <hr>
                      
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

      <!-- Edit Modal -->
      <form method="POST" action="<?php echo base_url('store/update') ?>"  enctype="multipart/form-data">
          <div class="modal fade" id="Modal_editStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit GST</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      
                      
                        <div class="col-lg-12 col-md-12">
                            <div>
                              <div>
                                    <label>Company Name</label>
                              </div>
                              <div>
                                    <select type="text" name="editcompany" class="form-control">
                                        <?php foreach($company as $rows){ ?>
                                            <option value="<?php echo $rows->id; ?>"><?php echo $rows->company_name; ?></option>
                                        <?php } ?>
                                    </select>
                              </div>
                          </div>
                      
                      <div class="col-lg-12 col-md-12">
                        <div>
                          <div>
                            <label>Store ID</label>
                          </div>
                          <div>
                            <input type="text" name="editstoreID" class="form-control">
                          </div>
                      </div>
                        <div>
                            <div>
                              <label>Store Name</label>
                            </div>
                            <div>
                                <input type="hidden" name="edit_id" class="form-control">
                              <input type="text" name="editstoreName" class="form-control">
                            </div>
                        </div>
                        <div>
                            <div>
                              <label>Landline Number</label>
                            </div>
                            <div>
                              <input type="text" name="editlandline_no" class="form-control">
                            </div>
                        </div>
                        <div>
                            <div>
                              <label>Address</label>
                            </div>
                            <div>
                              <input type="text" name="editaddress" class="form-control">
                            </div>
                        </div>
                        <!--<div>-->
                        <!--    <div>-->
                        <!--      <label>State</label>-->
                        <!--    </div>-->
                        <!--    <div>-->
                        <!--      <select name="editstate" class="mystate form-control">-->
                        <!--        <option value="0">Select State</option>-->
                        <!--          < ?php foreach($state as $rows): ?>-->
                        <!--          <option value="< ?php echo $rows->id ?>">< ?php echo $rows->country_name ?></option>-->
                        <!--          < ?php endforeach; ?>-->
                        <!--        </select>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div>-->
                        <!--    <div>-->
                        <!--      <label>City</label>-->
                        <!--    </div>-->
                        <!--    <div>-->
                        <!--      <select name="editcity" class="myCity form-control">-->
                        <!--        <option value="0">Select State</option>-->
                        <!--          < ?php foreach($city as $rows): ?>-->
                        <!--          < option value="< ?php echo $rows->id ?>">< ?php echo $rows->city_name ?></option>-->
                        <!--          < ?php endforeach; ?>-->
                        <!--        </select>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div>
                            <div>
                              <label>Email</label>
                            </div>
                            <div>
                              <input type="email" name="editemail" class="form-control">
                            </div>
                        </div>
                        <hr>    
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_adsUpdate" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
      </form>
      <!--END MODAL EDIT-->
      
      
      
<form role="form" action="<?php echo base_url('store/delete') ?>" method="post" id="deleteForm">
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
                var company = $(this).data('company');
                var id = $(this).data('id');
                var sid = $(this).data('sid');
                var name = $(this).data('name');
                var no = $(this).data('no');
                var add = $(this).data('add');
                var country = $(this).data('country');
                var city = $(this).data('city');
                var email = $(this).data('email');
                
                // alert(company);
                $('#Modal_editStore').modal('show');
                
                $('[name="editcompany"]').val(company);
                $('[name="edit_id"]').val(id);
                 $('[name="editstoreID"]').val(sid);
                $('[name="editstoreName"]').val(name);
                $('[name="editlandline_no"]').val(no);
                $('[name="editaddress"]').val(add);
                $('[name="editstate"]').val(country);
                $('[name="editcity"]').val(city);
                $('[name="editemail"]').val(email);
            });
        
            $('.deleteData').on('click', function(){
        
              var id = $(this).data('id');
              $('#deleteModal').modal('show');
              $('[name="id_edit"]').val(id);
            });
    </script>