
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url() ?>assets/admin_assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>assets/admin_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/admin_assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/admin_assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() ?>assets/admin_assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/admin_assets/dist/js/demo.js"></script>


<!--    Export to Excelsheet    -->
<script src="<?php echo base_url() ?>assets/admin_assets/dist/js/jquery.tableToExcel.js"></script>


<script type="text/javascript">
	
	$('.mydatatable').DataTable();

	$('#purchase_orderCheck').hide();

	$('.show_purchase_orderCheck').on('click', function(){

	    var order_type = $('input[name=order_type]:checked').val();
	    // alert(order_type);

	    if (order_type == 'tp')
	    {
	        $('#purchase_orderCheck').show();
	        $('#purchase_orderMTO').hide();
	    }
	    else
	    {
	        $('#purchase_orderCheck').hide();
	        $('#purchase_orderMTO').show();
	    }
	});

	$('#createLedger').change( function(){

		if (!this.checked) 
        	$('#createLedgerDetails').fadeOut('slow');
        else 
    		$('#createLedgerDetails').fadeIn('slow');

	});

	// $('#tokenfield').tokenfield({
	//   autocomplete: {
	//     source: ['red','blue','green','yellow','violet','brown','purple','black','white'],
	//     delay: 100
	//   },
	//   showAutocompleteOnFocus: true
	// })

</script>
</body>
</html>
