<?php
  // echo "<pre>"; print_r($allData); exit();
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Budgeting 
        <!-- <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Budgeting </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <br>
            <div style="float:right">
              <!-- <a href="< ?php echo base_url() ?>budget/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;Budget Entry</a> -->
              <a href="<?php echo base_url() ?>budget/report" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;Budget Report</a>
            </div>
            <br><br>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped mydatatable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Annual Sales</th>
                      <th>Quality Sales</th>
                      <th>Monthly Sales</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($allData as $key => $value){ ?>

                      <?php
                        $budgerItem = $this->model_budget->fecthDatayBudgerID($value['id']);
                        // echo "<pre>"; print_r($budgerItem);
                        $ledgerData = $this->model_ledger->fecthDataByID($budgerItem['ledger_id']);
                        // echo "<pre>"; print_r($ledgerData);

                      ?>

                      <tr>
                        <td><?php echo $ledgerData['ledger_name']; ?></td>
                        <td><?php echo $value['annualsales']; ?></td>
                        <td><?php echo $value['quarterlysales']; ?></td>
                        <td><?php echo $value['monthlysales']; ?></td>
                        <td width="170px">
                          <a href="<?php echo base_url() ?>budget/update/<?php echo $value['id']; ?>" class="btn btn-sm btn-info">
                            <i style="color: white" class="fa fa-edit"></i> Edit
                          </a>
                          <!-- <a href="javascript:void(0);" class="btn btn-sm btn-danger">
                            <i style="color: white" class="fa fa-trash"></i> Delete
                          </a> -->

                          <a href="<?php echo base_url() ?>budget/delete/<?php echo $value['id']; ?>" onclick="return confirm(\' you want to delete?\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>


                        </td>
                      </tr>
                    <?php } ?>

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

