				<!-- jQuery 2.0.2 -->
				<script src="js/jquery.min.js" type="text/javascript"></script>
				<!-- Bootstrap -->
				<script src="js/bootstrap.min.js" type="text/javascript"></script>
				<!-- InputMask -->
				<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
				<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
				<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
				<!-- bootstrap time picker -->
				<script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
				<!-- date-range-picker -->
				<script src="js/plugins/daterangepicker/bootstrap-datepicker.js" type="text/javascript"></script>
				<!-- DATA TABLES SCRIPT -->
				<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
				<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
				<script src="js/plugins/datatables/dataTables.colReorder.js" type="text/javascript"></script>
				<script src="js/plugins/datatables/dataTables.colVis.js" type="text/javascript"></script>
				<script src="js/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
				<!-- AdminLTE App -->
				<script src="js/AdminLTE/app.js" type="text/javascript"></script>
				<!-- Select Picker -->
				<script src="js/bootstrap-select/bootstrap-select.js" type="text/javascript"></script>
				<!-- Morris.js charts -->
				<script src="js/plugins/morris/raphael-min.js"></script>
				<script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>

				<!-- Page script -->

				<script type="text/javascript">
				/********************************************************/
				/* Activate the Current URL Path ************************/
				/********************************************************/
					var url = window.location.href;
					if (url.indexOf("&Page")>-1)
					{
						url = url.substr(0,url.indexOf("&Page"));
					}
					else if (url.indexOf("&Year")>-1)
					{
						url = url.substr(0,url.indexOf("&Year"));
					}

					// Will only work if string in href matches with location
					$('li a a[href="'+ url +'"]').parent().parent().parent().addClass('active');
					// Will also work for relative and absolute hrefs
					$('li a').filter(function() {
						return this.href == url;
					}).parent().addClass('active');
					// to activate the whole viewtree
					$('li a a[href="'+ url +'"]').parent().parent().parent().addClass('active');
					// to activate the whole viewtree for relative and absolute hrefs
					/*Level one*/
					$('li a').filter(function() {
						return this.href == url;
					}).parent().parent().parent().addClass('active');
					/*Level two*/
					$('li a').filter(function() {
						return this.href == url;
					}).parent().parent().parent().parent().parent().addClass('active');
					/*Level Three*/
					$('li a').filter(function() {
						return this.href == url;
					}).parent().parent().parent().parent().parent().parent().parent().addClass('active');
				</script>

				<script type="text/javascript">
				/********************************************************/
				/* Date picker ******************************************/
				/********************************************************/
					$(window).on('load', function () {
						$('.selectpicker').selectpicker('render');
						// $('.selectpicker').selectpicker('hide');
					});
				</script>

				<script type="text/javascript">
					$(function() 
					{
						/*Disable autocomplete*/
						$('input').attr('autocomplete','off');


						//Data Input Mask
						$("[data-mask]").inputmask();

						//Date range picker
						$('#sandbox-container input').datepicker({
						format: "yyyy-mm-dd",
						weekStart: 6,
						todayBtn: "linked",
						todayHighlight: true
						});
						//Date range picker New Sales Forecast
						$('#sandbox-container-NSF input').datepicker({
						format: "yyyy",
						startDate: "today",
						startView: 2,
						minViewMode: 2,
						todayBtn: "linked",
						});
						//Date range picker Review Sales Forecast
						$('#sandbox-container-RSF input').datepicker({
						format: "yyyy",
						startDate: "2010",
						startView: 2,
						minViewMode: 2,
						todayBtn: "linked",
						});




						/********************************************************/
						/*iCheck RadioBox Script*********************************/
						/********************************************************/
						$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
								checkboxClass: 'icheckbox_flat-red',
								radioClass: 'iradio_flat-red'
						});
						$('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
								checkboxClass: 'icheckbox_flat-green',
								radioClass: 'iradio_flat-green'
						});
						$('input[type="checkbox"].flat-purple, input[type="radio"].flat-purple').iCheck({
								checkboxClass: 'icheckbox_flat-purple',
								radioClass: 'iradio_flat-purple'
						});
						$('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
								checkboxClass: 'icheckbox_flat-blue',
								radioClass: 'iradio_flat-blue'
						});
						/********************************************************/
						/*Tables Script******************************************/
						/********************************************************/
						$('#SalesOrders,#SalesOrders1,#SalesForecastDetails,#SalesForecastSummary,#SalesForecastCustomer').dataTable({
							dom: 'RCT<"clear">lfr<"box-table"t>ip<"clear spacer">T',
							"bStateSave": true,
							"processing": true,
							"sScrollX": "100%",
							"scrollCollapse": true,
							"sScrollXInner": "100%",
							"bPaginate": true,
							"bLengthChange": true,
							"bFilter": true,
							"bSort": true,
							"bInfo": true,
							"bAutoWidth": true,
							"aaSorting": [[ 0, "desc" ]],
							colVis: 
							{
								restore: "Restore",
								showAll: "Select all"
							},
							"aLengthMenu": 
								[
									[10, 25, 50, 100, 200, -1],
									[10, 25, 50, 100, 200, "All"]
								], 
							"iDisplayLength" : 10,
							/*stateSave: true,*/
							tableTools: 
							{
								"sSwfPath": "./swf/copy_csv_xls_pdf.swf",
								"sRowSelect": "os",
								"aButtons": 
									[	"select_all", "select_none",
										{
											"sExtends": 	"collection",
											"sButtonText": 	"Save from Current",
											"aButtons": 	[ 
																{
																	"sExtends": "copy",
																	"bSelectedOnly": true,
																	"oSelectorOpts": {page: 'current'}
																}
																,
																{
																	"sExtends": "xls",
																	"bSelectedOnly": true,
																	"oSelectorOpts": {page: 'current'}
																}
																,
																{
																	"sExtends": "pdf",
																	"sPdfOrientation": "landscape",
																	"sPdfMessage": "Your custom message would go here."
																},
																{
																	"sExtends": "print",
																	"bShowAll": false,
																	"sInfo": "<h1>Print Preview</h1>Please Press Esc When You Done"
																}
																
															]
										},
										{
											"sExtends": 	"collection",
											"sButtonText": 	"Save from All*",
											"aButtons": 	[ 
																{
																	"sExtends": "copy",
																	"bSelectedOnly": true
																}
																,
																{
																	"sExtends": "xls",
																	"bSelectedOnly": true
																}
																,
																{
																	"sExtends": "pdf",
																	"sPdfOrientation": "landscape",
																	"sPdfMessage": "Your custom message would go here."
																},
																{
																	"sExtends": "print",
																	"bShowAll": true,
																	"sInfo": "<h1>Print Preview</h1>Please Press Esc When You Done"
																}
															]
										}
									]
							}
						});

						$('#GetSalesOrders,#SalesOrdersLines,#SalesOrdersLines1,#SalesOrdersLines2,#SalesOrdersLines3').dataTable({
								"sScrollX": "100%",
								"sScrollY": "100%",
								"sScrollXInner": "100%",
								"bPaginate": false,
								"bLengthChange": true,
								"bFilter": false,
								"bSort": false,
								"bInfo": false,
								"bAutoWidth": true
						});				
						/*******************************************************/
					});
				</script>


				<?php if (isset($_REQUEST['Item']) || isset($_REQUEST['Rep']) || isset($_REQUEST['CustomerNO'])) :?>
				<script type="text/javascript">
					/********************************************************/
					/*Chart's Script*****************************************/
					/********************************************************/
					// LINE CHART
					var line = new Morris.Area({
						element: 'Area-chart',
						resize: true,
						<?php include_once ($Chart); ?>
						});
				</script>
				<?php endif;?>

				<?php if (isset($_REQUEST['Collapse'])) :?>
				<script type="text/javascript">
					/********************************************************/
					/*Collapse First Div Script******************************/
					/********************************************************/
					$(window).on('load', function () {
						$("#first_div [data-widget='collapse']").click();
					});
				</script>
				<?php endif;?>
				<!-- page script -->
