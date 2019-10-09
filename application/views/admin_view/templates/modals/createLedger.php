

  <form method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="Modal_createLedger" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
                Create Ledger
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                 
                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>Category Name</label>
                      </div>
                      <div>
                        <input type="text" name="category_name" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>Sub-Category Name</label>
                      </div>
                      <div>
                        <input type="text" name="subcategory_name" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>Ledger Name</label>
                      </div>
                      <div>
                        <input type="text" name="ledger_name" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>Opening Balance</label>
                      </div>
                      <div>
                        <input type="number" name="opening_balance" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>Balance Type</label>
                      </div>
                      <div>
                        <select name="balance_type" class="form-control">
                          <option>---select one---</option>
                        </select>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>Ledger Type</label>
                      </div>
                      <div>
                        <select name="ledger_type" class="form-control">
                          <option>---select one---</option>
                        </select>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>Email ID</label>
                      </div>
                      <div>
                        <input type="email" name="email_id" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>Contact Number</label>
                      </div>
                      <div>
                        <input type="text" name="contact_no" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>GST Number</label>
                      </div>
                      <div>
                        <input type="text" name="gst_no" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>PAN Number</label>
                      </div>
                      <div>
                        <input type="text" name="pan_no" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>City</label>
                      </div>
                      <div>
                        <input type="text" name="city" class="form-control">
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-4">
                      <div>
                        <label>Address</label>
                      </div>
                      <div>
                        <input type="text" name="address" class="form-control">
                      </div>
                  </div>

                  <br>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="javascript:void(0);" class="btn btn-success"> Submit</a>
                <!-- <input type="submit" name="save" value="Submit" class="btn btn-success"> -->
            </div>
          </div>
        </div>
      </div>
  </form>


  <script type="text/javascript">
    // alert($(location).attr("href"));
  </script>