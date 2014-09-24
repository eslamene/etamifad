<!-- /*******/ Page Name /*******/ -->
<script language="javascript">
	document.title = "General Customers Map | Eta Mifad";
</script>
<!-- /*******/ Page Name /*******/ -->
<?php 
ob_start(); 
//Start session
session_start();
/*********************************/
/*import db_connection file*/
/*********************************/
include_once('db_connection.php');
/*********************************/
/*********************************/
/*Check session is present or not*/
/********************************/
if(!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == ''))
{ 
	header("location: login.php");
	exit();
}
/*********************************/
?>
<!DOCTYPE html>
<html>
	<head>
		<?php 
			$root = './root';
			set_include_path(get_include_path() . PATH_SEPARATOR . $root);
			include_once('head.php'); 
		?>
		<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
		<script type="text/javascript">
			//<![CDATA[
			/*http://stackoverflow.com/questions/17746740/google-map-icons-with-visualrefresh*/
			var customIcons = {
				on: {
					icon: 'http://mt.google.com/vt/icon?psize=30&font=fonts/arialuni_t.ttf&color=ff304C13&name=icons/spotlight/spotlight-waypoint-a.png&ax=43&ay=48&text=%E2%80%A2',
					shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
				},
				off: {
					icon: 'http://mt.googleapis.com/vt/icon/name=icons/spotlight/spotlight-poi.png&scale=1',
					shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
				}
			};

			function load() {
				<?php 
					if (isset($_REQUEST['Lat']) && isset($_REQUEST['Lng']))
					{
						echo 
						'var map = new google.maps.Map(document.getElementById("map"), 
						{
							center: new google.maps.LatLng('.$_REQUEST['Lat'].','.$_REQUEST['Lng'].'),
							zoom: '.$_REQUEST['Z'].',
							mapTypeId: "roadmap"
						});';
					}
					elseif (empty($_REQUEST['Lat']) && empty($_REQUEST['Lng']))
					{
						echo 
						'var map = new google.maps.Map(document.getElementById("map"), 
						{
							center: new google.maps.LatLng(27.724158,32.7272836),
							zoom: 6,
							mapTypeId: "roadmap"
						});';
					}
				?>

				var infoWindow = new google.maps.InfoWindow;

				// Change this depending on the name of your PHP file
				downloadUrl("geomap/phpsqlajax_genxml.php", function(data) {
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var Customer_Name 	= markers[i].getAttribute("Customer_Name");
						var Lat 			= markers[i].getAttribute("Lat");
						var Lng 			= markers[i].getAttribute("Lng");
						var Address 		= markers[i].getAttribute("Address");
						var Trade_Name 		= markers[i].getAttribute("Trade_Name");
						var Type 			= markers[i].getAttribute("Type");
						var point 			= new google.maps.LatLng(
								parseFloat(markers[i].getAttribute("Lat")),
								parseFloat(markers[i].getAttribute("Lng")));
						var html = "<b>" + Customer_Name + "</b> <br/>" + Address +  "<br/>" + Trade_Name + "<br/><a href='http://www.google.com/maps/dir/" + Lat + ',' + Lng + "/30.133227, 31.743915' target='_blank'>Directions</a>";
						var icon = customIcons[Type] || {};
						var marker = new google.maps.Marker({
							map: map,
							position: point,
							icon: icon.icon,
							shadow: icon.shadow
						});
						bindInfoWindow(marker, map, infoWindow, html);
					}
				});
			}

			function bindInfoWindow(marker, map, infoWindow, html) {
				google.maps.event.addListener(marker, 'click', function() {
					infoWindow.setContent(html);
					infoWindow.open(map, marker);
				});
			}

			function downloadUrl(url, callback) {
				var request = window.ActiveXObject ?
						new ActiveXObject('Microsoft.XMLHTTP') :
						new XMLHttpRequest;

				request.onreadystatechange = function() {
					if (request.readyState == 4) {
						request.onreadystatechange = doNothing;
						callback(request, request.status);
					}
				};

				request.open('GET', url, true);
				request.send(null);
			}

			function doNothing() {}

			//]]>
		</script>
	</head>

		<body class="<?php echo $Themes.' '.$Layout; ?>" onload="load()">
				<!-- header logo: style can be found in header.less -->
				<?php 
				include_once('header.php'); 
				?>
				<div class="wrapper row-offcanvas row-offcanvas-left">
					<!-- Left side column. contains the logo and sidebar -->
					<aside class="left-side sidebar-offcanvas">
							<!-- sidebar: style can be found in sidebar.less -->
							<?php 
							include_once('sidebar.php'); 
							?>
							<!-- /.sidebar -->
					</aside>

					<!-- Right side column. Contains the navbar and content of the page -->
					<aside class="right-side">
						<!-- Main content -->
						<section class="content">
							<div class="row">
							<!-- Display Map -->
								<div class="col-md-12">
									<!-- general form elements disabled -->
									<!-- Primary -->
									<div class="box box-solid box-primary">
										<!-- Box Tools -->
										<div class="box-header">
											<!-- tools box -->
											<div class="pull-left box-tools">
												<button class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
												<button class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
											</div><!-- /. tools -->
											<h3 class="box-title"><script type="text/javascript">document.write(document.title);</script></h3>
										</div>
										<!-- /.box-header -->
										<div class="box-body">	
											<div id="map" class="box-body" style="height: 75vh"></div>
										</div><!-- /.box-body -->
									</div>
	
									<!-- Add Customer Location form -->	
									<!-- Danger -->
									<div class="box box-solid box-danger">
										<!-- Box Tools -->
										<div class="box-header">
											<!-- tools box -->
											<div class="pull-left box-tools">
												<button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
												<button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
											</div><!-- /. tools -->
											<h3 class="box-title">Add New Customer Geo-Location</h3>
										</div>			
										<!-- /.box-header -->
										<div class="box-body">
											<div class="row">
												<form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" id="map" method="post">
													<div class="form-group col-lg-6">
														<label>Select Customer</label>
														<select id="select_costumer" name="Customer_NO"  class="selectpicker form-control"  data-live-search="true">
															 <?php include_once('forms/select/customers.php'); ?>
														</select>
													</div><!-- /.col -->
													<div class="form-group col-lg-6">
														<label>Latitude</label>
														<input type="text" class="form-control" name="Lat" placeholder="Enter Latitude..." data-inputmask='"mask": "99.999999"' data-mask/>
													</div>
													<div class="form-group col-lg-6">
														<label>Longitude</label>
														<input type="text" class="form-control" name="Lng" placeholder="Enter Longitude..." data-inputmask='"mask": "99.999999"' data-mask/>
													</div>
													<div class="form-group col-lg-6">
														<label>Status</label>
														<br>
														<label>
															<input type="radio" class="form-control flat-green" name="Type" value="on" checked/>
															<p class="btn bg-green btn margin">Active</p>
														</label>
														<label>
															<input type="radio" class="form-control flat-red" name="Type" value="off"/>
															<p class="btn bg-red btn margin">Inactive</p>
														</label>
													</div>
													<div class="form-group col-lg-6">
														<label>Customer Address</label>
														<input type="text" class="form-control" name="Address" placeholder="Enter Customer Address..."/>
													</div>


													<div class="box-footer">
														<button type="Submit" class="btn pull-right btn-primary btn-lg btn-block" name="Submit" id="Submit">Submit</button>
													</div>

												</form>
											</div>
										</div><!-- /.box-body -->
									</div>

									<?php
										if (isset($_REQUEST['Customer_NO'])) 				{$Customer_NO		= $_REQUEST["Customer_NO"];}
										if (isset($_REQUEST['Lat'])) 						{$Lat				= $_REQUEST["Lat"];}
										if (isset($_REQUEST['Lng'])) 						{$Lng				= $_REQUEST["Lng"];}
										if (isset($_REQUEST['Type'])) 						{$Type				= $_REQUEST["Type"];}
										if (isset($_REQUEST['Address'])) 					{$Address			= $_REQUEST["Address"];}
										if (isset($_REQUEST['Submit']))
										{
											/*checking for requirements before submition*/
											if ($Customer_NO =='' || $Lat =='' || $Lng =='') 
											{
												echo 
													'<br>
													<div class="alert alert-danger alert-dismissable">
														<i class="fa fa-ban"></i>
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<b>Alert!</b> Please Check your input requirements.
													</div>';
											}
											elseif ($Customer_NO !='' || $Lat !='' || $Lng !='') 
											{
											/*Update condtional Approval*/
												$New_Record = ("INSERT INTO geomap 	(Customer_NO, Lat, Lng, Type, Address) 
																VALUES 
																('$Customer_NO', '$Lat', '$Lng', '$Type', '$Address')");
										
												if (!$stmt = $MySQLConnection->prepare($New_Record))
															die('<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
																	<b>Query failed: </b>'
																	.$MySQLConnection->errno.$MySQLConnection->error.
																'</div>');
				
													if (!$stmt->execute())
															die('<div class="alert alert-danger alert-dismissable">
																	<i class="fa fa-ban"></i>
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
																	<b>Insert Error: </b>'
																	. $MySQLConnection->error.
																'</div>');
				
													header('Location: '. $_SERVER['PHP_SELF'].'?Lat='.$_REQUEST['Lat'].'&Lng='.$_REQUEST['Lng'].'&Z='.'13');
											}
										}
									?>
								</div>
							</div>
						<!-- Content Header (Page header) -->
						</section><!-- /.content -->
					</aside><!-- /.right-side -->
				</div><!-- ./wrapper -->


				<!-- jQuery 2.0.2 -->
				<script src="js/jquery.min.js"></script>
				<!-- Bootstrap -->
				<script src="js/bootstrap.min.js" type="text/javascript"></script>
				<!-- InputMask -->
				<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
				<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
				<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
				<!-- date-range-picker -->
				<script src="js/plugins/daterangepicker/bootstrap-datepicker.js" type="text/javascript"></script>
				<!-- DATA TABES SCRIPT -->
				<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
				<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
				<!-- bootstrap time picker -->
				<script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
				<!-- AdminLTE App -->
				<script src="js/AdminLTE/app.js" type="text/javascript"></script>
				<!-- Select Picker -->
				<script src="js/bootstrap-select/bootstrap-select.js" type="text/javascript"></script>


<!-- Page script -->
		<script type="text/javascript">
			$(function() 
				{
					/*Disable autocomplete*/
					$('input').attr('autocomplete','off');
					/*iCheck RadioBox Script*/
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

					//Data Input Mask
					$("[data-mask]").inputmask();
				});
		</script>
		<script type="text/javascript">
		$(window).on('load', function () {

			$('.selectpicker').selectpicker('render');

			// $('.selectpicker').selectpicker('hide');
		});
		</script>
	</body>
</html>