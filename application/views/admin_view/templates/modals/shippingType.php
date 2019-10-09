
<!-- Modal -->
 <form method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="Modal_addShipingType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
                Shiping
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="col-lg-12 col-md-12">
                 
                  <div>
                      <div>
                        <label>Shipping Type</label>
                      </div>
                      <div>
                        <input type="text" name="shiping_type" id="shiping_type" class="form-control">
                      </div>
                  </div>
                  <br>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="javascript:void(0)" class="btn btn-success" id="addShipingType">Save</a>
                <!-- <input type="submit" name="save" value="Submit" class="btn btn-success"> -->
            </div>
          </div>
        </div>
      </div>
  </form>


<script type="text/javascript">
    
    $('#addShipingType').on('click', function(){

      var shiping_type = $('#shiping_type').val();

      $.ajax({
            url: base_url + 'shipping_master/saveModalData/',
            type: 'post',
            dataType: 'text',
            data : {shippingName:shiping_type},
            success:function(response){

              shippingType();

              $('#Modal_addShipingType').modal('hide');
            }
      });
  });

</script>