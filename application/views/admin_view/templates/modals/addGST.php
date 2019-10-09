<form method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="Modal_addGst" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
                GST
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                 
                  <div class="col-lg-6 col-md-6">
                      <div>
                        <label> Name</label>
                      </div>
                      <div>
                        <input type="text" name="name" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                       <div>
                        <label>CGST</label>
                      </div>
                      <div>
                        <input type="text" name="cgst" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                       <div>
                        <label>SGST</label>
                      </div>
                      <div>
                        <input type="text" name="sgst" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                       <div>
                        <label>IGST</label>
                      </div>
                      <div>
                        <input type="text" name="igst" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                       <div>
                        <label>Other Taxes</label>
                      </div>
                      <div>
                        <input type="text" name="other" class="form-control">
                      </div>
                  </div>

                  <br>
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