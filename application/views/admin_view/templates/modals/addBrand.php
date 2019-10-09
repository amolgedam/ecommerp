  <form method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="Modal_addBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
                Brand
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                 
                  <div class="col-lg-12 col-md-12">
                      <div>
                        <label>Brand Category</label>
                      </div>
                      <div>
                        <input type="text" name="brand_name" id="brand_name1" class="form-control">
                      </div>
                  </div>
                  <br>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<input type="submit" name="save" value="Submit" class="btn btn-success">-->
                <button type="button" id="btn_savebrand" class="btn btn-primary">Save</button>
                
            </div>
          </div>
        </div>
      </div>
  </form>
  
  
  <script>
      $(document).ready(function(){
          
        var base_url = '<?php echo base_url() ?>';
        
        // alert("hi");
            //Save product
            $('#btn_savebrand').on('click',function(){
                
                var brand = $('#brand_name1').val();
                
                $.ajax({
                    type : "POST",
                    url  : base_url + "brand/saveBrand",
                    dataType : "JSON",
                    data : {brand:brand},
                    success: function(data){
                        
                        // alert(data);
                        
                        if(data == 0)
                        {
                            alert("Brand Name Available");
                        }
                        else
                        {
                            $('#brand_name1').val('');
                            
                            $('#Modal_addBrand').modal('hide');
                            
                            showBrand();
                        }
                    }
                });
                return false;
            });
          
            // showBrand();
            
            function showBrand()
            {
                $.ajax({
                    type : "POST",
                    url  : base_url + "brand/showBrand",
                    dataType : "JSON",
                    success: function(data){
                        
                        console.log(data);
                        
                        $('#brand').html('');
                        var html = '';
                        
                        html += '<option value="0">---Select Option---</option>';
                        
                        $.each(data, function(index, value) {
                                                                  
                            html += '<option value="'+value.id+'">'+value.brand_name+'</option>';
                        });
                        
                        $('#brand').append(html);
                    }
                });
            }
            
            
            
      });
  </script>
  
  
  
  
  
  
  
  
  
  
  
  
  