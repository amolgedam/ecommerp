

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Account
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Account</li>
      </ol>
    </section>
    
    <div style="padding: 10px;">
        <?php
                if($feedback = $this->session->flashdata('feedback'))
                {
                    $feedback_class = $this->session->flashdata('feedback_class');
            ?>
                    <div class="form-group col-12">
                        <div class="">
                            <div class="alert <?= $feedback_class?>">
                                <?= $feedback ?>
                            </div>
                        </div>
                    </div>
            <?php }?>
    </div>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding: 5px;">
            <br>
            <div style="float:right">
                  <a href="<?php echo base_url() ?>account_category" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus-square"></i>&nbsp;New Category
                  </a>
                  <a href="<?php echo base_url() ?>account_category" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus-square"></i>&nbsp;New Sub-Category
                  </a>
                  <a href="<?php echo base_url() ?>ledger_master/create" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus-square"></i>&nbsp;New Account
                  </a> 
            </div>

            <div style="float:left">
                
                <!--<form action="< ?php echo base_url('ledger_master/fetchLedgerDataByLedgertype') ?>" method="post">-->

                <!--    <label for=""><b>Select Type</b></label>-->
                <!--    <select name="legertype" id="legertype" class="form-control" id="exampleSelect1">-->
                <!--      <option value="0">All</option>-->
                <!--      < ?php foreach($ledgertype as $rows): ?>-->
                <!--        <option value="< ?php echo $rows->id ?>">< ?php echo $rows->ledgertype_name ?></option>-->
                <!--      < ?php endforeach; ?>-->
                <!--    </select>-->
                    
                <!--    <input type="submit" value="search" name="search" class="btn btn-success"/>-->
                
                <!--</form>-->
            </div>
            <br><br><br>
            <div class="box-body">
              <div class="table-responsive">
                  
                  
                  
                  
                  
                <div id="loadData">
                    <table class="table table-bordered table-striped" id="data">
                      <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>Name</th>
                        <th>Account Category</th>
                        <th>Account Subcategory</th>
                        <th>Ledger Type</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody id="ledgerData">
                        <!--<tr>-->
                        <!--  <td>A R Traders</td>-->
                        <!--  <td>Current Liablitiest</td>-->
                        <!--  <td>Sundry Creditors</td>-->
                        <!--  <td width="200px">-->
                              <!-- <a href="#" class="btn btn-info">Details</a> -->
                        <!--      <a href="< ?php echo base_url() ?>ledger_master/update" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>&nbsp;Edit</a>-->
                        <!--      <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</a>-->
                        <!--      <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-primary"></i>&nbsp;Report</a>-->
                        <!--  </td>-->
                        <!--</tr>-->
                      </tbody>
                    </table>
                </div>
                
                <!--<div id="loadData" style="display: none;">-->
                <!--    <table class="table table-bordered table-striped myDatatable">-->
                <!--      <thead>-->
                <!--      <tr>-->
                <!--        <th>Sr No.</th>-->
                <!--        <th>Name</th>-->
                <!--        <th>Account Category</th>-->
                <!--        <th>Account Subcategory</th>-->
                <!--        <th>Action</th>-->
                <!--      </tr>-->
                <!--      </thead>-->
                <!--      <tbody id="ledgerData">-->
                <!--      </tbody>-->
                <!--    </table>-->
                <!--</div>-->
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

 
<form role="form" action="<?php echo base_url('service_master/delete') ?>" method="post" id="deleteForm">
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


<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url(); ?>';
        var legerType;
        
        // var legertype = $(this).val();
        
        // alert(legertype);
        load_data();
        
       function load_data()
       {
            legerType = $('#data').DataTable({
                "ajax": {
                    'processing':true,
                    'serverSide':true,
                    "searching": true,
                    url : base_url + "ledger_master/fetchLedgerData",
                    'order': []
                },
                
            });
       }
       
    //   $(document).on('change', '#legertype', function(){
           
    //       legertype_id = $(this).val();
    //         // alert(legertype_id);
            
    //         // $('#data').DataTable().destroy();
            
    //         if(legertype_id != 0)
    //         {
    //             ledgertype_data(legertype_id);
    //         }
    //         else
    //         {
    //             load_data();
    //         }
    //   });
       
    //   function ledgertype_data(legertype_id)
    //   {
    //     //   $('#data').DataTable().destroy();
    //       $('#loadData').hide();
    //     //   alert(legertype_id);
           
    //       $.ajax({
               
    //              url : base_url + "ledger_master/fetchLedgerDataByLedgertype",
    //              type: "POST",
    //              data: {'legertype_id':legertype_id},
    //              dataType: 'json',
    //              success:function(response) {
                    
    //                 console.log(response);
    //                 // legerType.ajax.reload(null, false);
    //                 // var html = '';
    //                 // var no=1;
    //                 // var i; var no=1;
    //                 // var html = '';
    //                 //   var i;
    //                 //   for(i = 0; i<response[0].length; i++)
    //                 //   {
    //                 //     //   console.log(no);
    //                 //       html += '<tr>'+
    //                 //                     '<td>'+ no +'</td>'+
    //                 //                     '<td>'+ no +'</td>'+
    //                 //                     '<td>'+ no +'</td>'+
    //                 //                     '<td>'+ no +'</td>'+
    //                 //                     '<td>'+ no +'</td>'+
    //                 //                 '</tr>';
    //                 //         no++;
    //                 //   }
                    
    //                 // var obj = jQuery.parseJSON(response);
                    
    //                 // $.each(obj, function(key,value) {
                        
                      
    //                 // });
                    
    //                 // $('#ledgerData').html(html);
                    
    //                 $('#loadData').show();
    //              }
    //       });
    //   }
        
        // $('#legertype').on('change', function(){
            
        //     var legertype = $(this).val();
        //     alert(legertype);
        //     if(legertype == '' || legertype == '0')
        //     {
        //         $('#data').DataTable().ajax.reload();
        //     }
        //     else
        //     {
        //         $('#data').DataTable({
        //             "ajax": {
        //                 url : base_url + "ledger_master/fetchLedgerData",
        //                 type: 'POST',
        //                 data: {}
        //             },
        //         });
        //     }
        // });
        
        
        // function showUser(str) {
            
        //     // alert(str);
        //     if (str == "") {
        //         document.getElementById("txtHint").innerHTML = "";
        //         return;
        //     } else {
        //         if (window.XMLHttpRequest) {
        //             // code for IE7+, Firefox, Chrome, Opera, Safari
        //             xmlhttp = new XMLHttpRequest();
        //         } else {
        //             // code for IE6, IE5
        //             xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        //         }
        //         xmlhttp.onreadystatechange = function() {
        //             if (this.readyState == 4 && this.status == 200) {
        //                 document.getElementById("txtHint").innerHTML = this.responseText;
        //             }
        //         };
        //         xmlhttp.open("GET", base_url + "ledger_master/fetchLedgerDataByLedgertype/"+str,true);
        //         alert(xmlhttp.open("GET", base_url + "ledger_master/fetchLedgerDataByLedgertype/"+str,true));
        //         xmlhttp.send();
        //     }
        // }
        
        
    });
</script>

