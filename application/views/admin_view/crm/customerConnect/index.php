<!--< ?php echo "<pre>"; print_r($for); exit; ?>-->



  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Compose Email And Sms
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Compose Email And Sms</li>
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
        <div class="col-xs-7">
          <div class="box">
              
            <form action="<?php echo base_url(); ?>customerconnect/sendEmail" method="post">  
            
            <div class="box-body">
                <!--<div>-->
                <!--    <div>-->
                <!--      <label>SMS For</label>-->
                <!--    </div>-->
                <!--    <div>-->
                <!--      <select name="for" id="for" class="form-control">-->
                <!--          <option value="0">All</option>-->
                <!--          < ?php foreach($for as $rows){ ?>-->
                <!--            <option value="< ?php echo $rows['id']; ?>">< ?php echo $rows['ledgertype_name']; ?></option>-->
                <!--          < ?php } ?>-->
                <!--      </select>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<br>-->
                
                <div>
                    <div>
                      <label>To</label>
                    </div>
                    <div>
                      <!--<input type="text" class="form-control" id="tokenfield" value="amol, sagar"/>-->
                      <select multiple="multiple" name="emailAdd[]" id="to" data-placeholder="Begin typing a name to filter..." required class="chosen-select form-control" >
                          <option value="0">All</option>
                          <?php foreach($to as $rows){ ?>
                            <option value="<?php echo $rows->email; ?>"><?php echo $rows->ledger_name; ?></option>
                          <?php } ?>
                      </select>
                        
                       
                    </div>
                </div>
                <br>
                
                <div>
                    <div>
                      <label>Subject</label>
                    </div>
                    <div>
                        
                        <input type="text" name="subject" class="form-control">
                       
                    </div>
                </div>
                
                <br>
                <div>
                    <div>
                      <label>Message</label>
                    </div>
                    <div>
                      <textarea name="message" class="form-control"></textarea>
                    </div>
                </div>
                <hr>
                <div align="right">
                    <!--<a href="#" class="btn btn-sm btn-primary">Send SMS</a>-->
                    <!--<a href="#" class="btn btn-sm btn-primary">Send Email</a>-->
                    <input type="submit" name="sendemail" value="Send Email" class="btn btn-sm btn-primary">
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

<script>
    $(".chosen-select").chosen({
      no_results_text: "Oops, nothing found!"
    })
</script>

<script>
    $(document).ready(function(){
        
        var base_url = '<?php echo base_url(); ?>';
        $('#for').on('blur', function(){
            
            fetchLedgerData();
        });
        
        function fetchLedgerData()
        {
            var ledgertypeid = $('#for').val();
            var html = '';
            
            $.ajax({
                  
                  url: base_url + 'ledger_master/fecthLedgerDataByLedgerType/',
                  type: 'post',
                  dataType: 'json',
                  data : {ledgertypeid:ledgertypeid},
                  success:function(data){
                      
                    //   console.log(data);
                    
                        $('#to').html('');
                      
                      $.each(data, function(index, value) {
                        
                        html += '<option value="'+value.email+'">'+value.ledger_name+'</option>';
                      });
                      
                      $('#to').append(html);
                  }
            });
        }
    });
</script>

