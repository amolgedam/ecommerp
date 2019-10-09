<form method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="Modal_addHsn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
                HSN
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                 
                  <div class="col-lg-6 col-md-6">
                      <div>
                        <label>HSN Product Name</label>
                      </div>
                      <div>
                        <input type="text" name="product_name" id="hsn_name" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                       <div>
                        <label>HSN Product Code</label>
                      </div>
                      <div>
                        <input type="text" name="product_code" id="hsn_code" class="form-control">
                        
                      </div>
                  </div>

                  <br>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<input type="submit" name="save" value="Submit" class="btn btn-success">-->
                <button type="button" type="submit" id="btn_savehsn" class="btn btn-primary">Save</button>
                
            </div>
          </div>
        </div>
      </div>
  </form>
  
  
  <script>
      $(document).ready(function(){
          
        var base_url = '<?php echo base_url() ?>';
        
            // showHSN();
            
            // //Save product
            $('#btn_savehsn').on('click',function(){
                
                var name = $('#hsn_name').val();
                var code = $('#hsn_code').val();
                
                // alert(name);
                $.ajax({
                    type : "POST",
                    url  : base_url + "hsn/saveHSN",
                    dataType : "JSON",
                    data : {name:name , code:code},
                    success: function(data){
                       
                        if(data == 0)
                        {
                            alert("Data Available");
                        }
                        else
                        {
                            $('#hsn_name').val('');
                            $('#hsn_code').val('');
                            
                            $('#Modal_addHsn').modal('hide');
                            
                            showHSN();
                        }
                    }
                });
                return false;
            });
            
            
            function showHSN()
            {
                $.ajax({
                    type : "POST",
                    url  : base_url + "hsn/fecthAllData",
                    dataType : "JSON",
                    success: function(data){
                        
                        console.log(data);
                        
                        $('#hsnData').html('');
                        var html = '';
                        
                        html += '<option value="0">---Select Option---</option>';
                        $.each(data, function(index, value) {
                                                                  
                            html += '<option value="'+value.id+'">'+value.hsn_code+'</option>';
                        });
                        
                        $('#hsnData').append(html);
                    }
                });
            }
            
      });
  </script>
  
  
  
  
  