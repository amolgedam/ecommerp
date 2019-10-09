  <form method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="Modal_addTexture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
                Attributes
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-lg-10 col-md-10">
                      <div>
                        <label>Value</label>
                      </div>
                      <div>
                        <input type="text" name="textureData" id="textureData" class="form-control">
                        <span style="color:red">Enter values, with each value separated by a Quamma and space</span>
                        <input type="hidden" name="id" id="textureid" value="3" class="form-control">
                      </div>
                  </div>
                  <br>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<input type="submit" name="save" value="Submit" class="btn btn-success">-->
                <button type="button" type="submit" id="btn_savetxture" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>
  </form>
 
 
   <script>
      $(document).ready(function(){
          
        var base_url = '<?php echo base_url() ?>';
          
            // showColor();
            
            //Save product
            $('#btn_savetxture').on('click',function(){
                var id = $('#textureid').val();
                var name = $('#textureData').val();
                // alert(name);
                $.ajax({
                    type : "POST",
                    url  : base_url + "attribute/saveAttribute",
                    dataType : "JSON",
                    data : {id:id , name:name},
                    success: function(data){
                        
                        // alert(data);
                        if(data == 0)
                        {
                            alert("Data Available");
                        }
                        else
                        {
                            $('#textureData').val('');
                            $('#Modal_addTexture').modal('hide');
                            
                            showTexture();
                        }
                    }
                });
                return false;
            });
            
            
            function showTexture()
            {
                var id = $('#textureid').val();
                
                $.ajax({
                    type : "POST",
                    url  : base_url + "attribute/fetchDataByID",
                    dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                        
                        // console.log(data);
                        
                        $('#pattern').html('');
                        var html = '';
                        
                        html += '<option value="none">---Select Option---</option>';
                        
                        
                        $.each(data, function(index, value) {
                                                                  
                            html += '<option value="'+value+'">'+value+'</option>';
                        });
                        
                        $('#pattern').append(html);
                    }
                });
            }
            
      });
  </script>
  
  
  
  
  

