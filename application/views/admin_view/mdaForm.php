<!-- < ?php echo "<pre>"; print_r($_SESSION['wo_company']); exit(); ?> -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin_assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin_assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin_assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin_assets/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>home"><b>ERP</b>-Ecommerce</a>
  </div>
  
  <?php echo validation_errors(); ?>  

          <?php if(!empty($errors)) {
            echo $errors;
          } ?>
          
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Select</p>

    <form action="<?php echo base_url() ?>mdi_form" method="post">
        
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
    
    <?php 
    //   $company = array();
    //   $company = explode(', ', $_SESSION['wo_company']);
      // print_r($company); exit();

    ?>
      <div class="form-group has-feedback">
        <label>Company Name:</label>
        <select name="company_name" id="company_name" class="form-control">
          <option value="0">Select Option</option>  
          <!-- < ?php foreach($companyDetails as $rows): ?> -->

            <!--< ?php foreach ($company as $key => $value) { ?>-->
            <?php foreach ($companyDetails as $key => $value) { ?>
                  <option value="<?php echo $value->id ?>" ><?php echo ucwords($value->company_name); ?></option>
                  <!--< ?php $company = $this->model_company->fecthDataByID($value); ?>-->
                  <!--<option value="< ?php echo $company['id'] ?>" >< ?php echo ucwords($company['company_name']); ?></option>-->
          <?php } ?>

          <!-- < ?php endforeach; ?> -->
        </select>
      </div>
      
        
      
        <!-- < ?php 
            if($_SESSION['wo_role'] == 'user'){ 
        ?> -->
            <div class="form-group has-feedback">
                <label>Store:</label>
                <select name="store" id="store" class="form-control">
                    <option value="0">Select Option</option>
                    <?php foreach($store as $rows): ?>
                        <option value="<?php echo $rows['id'] ?>" ><?php echo $rows['store_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <!-- < ?php 
            }
            else
            {
        ?>
                <input type="hidden" name="adminStore" >
        < ?php
        
            }
        ?> -->
      
      
      <!-- <div class="form-group has-feedback">
        <label>Department:</label>
        <select name="department" id="department" class="form-control">
            <option value="0">Select Option</option>
            < ?php foreach($department as $rows): ?>
                <option value="< ?php echo $rows->id ?>" >< ?php echo $rows->division_name; ?></option>
            < ?php endforeach; ?>
        </select>
      </div>
      <div class="form-group has-feedback">
        <label>Location Name:</label>
            <select name="location" id="location" class="form-control">
              <option value="0">Select Option</option>
                < ?php foreach($location as $rows): ?>
                <option value="< ?php echo $rows->id ?>" >< ?php echo $rows->location_name; ?></option>
            < ?php endforeach; ?>
        </select>
      </div> -->
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <a href="#">I forgot my password</a><br> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>assets/admin_assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>

<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url(); ?>'; 
        
        $('#company_name').on('change', function(){
            
            $('#store').html('');
            
           var company_id = $(this).val();
           // alert(company_id);
           var html = '';
          $.ajax({
                
                url: base_url + 'store/fetchStoreByCompanyID/',
                type: 'post',
                dataType: 'json',
                data : {company_id:company_id},
                success:function(response){
                    
                    // console.log(response);
                    
                    html += '<option value="0">Select Option</option>';
                    $.each(response, function(index, value) {

                      html += '<option value="'+value.id+'">'+value.store_name+'</option>';            
                    });
                    
                    $('#store').append(html);
                }
          });
        });
        
        $('#department').on('change', function(){
            
            $('#location').html('');
            
            var company_id = $('#company_name').val();
            var department = $(this).val();
            var html = '';
            $.ajax({
                  
                  url: base_url + 'location/fetchLocationByDivision/',
                  type: 'post',
                  dataType: 'json',
                  data : {company_id:company_id, department_id:department},
                  success:function(response){
                      
                      $.each(response, function(index, value) {
                        
                        html += '<option value="'+value.id+'">'+value.location_name+'</option>';
                      });
                      
                      $('#location').append(html);
                  }
            });
        });
    });
</script>
