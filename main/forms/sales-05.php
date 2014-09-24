						<!-- /*******/ Page Name /*******/ -->
						<script language="javascript">
							document.title = "New - Sales Forecast | Eta Mifad";
						</script>
						<!-- /*******/ Page Name /*******/ -->

						<!-- Form 1 -->
						<div class="col-md-12">

							<?php 
							/*******************************/
							/*Begin to select foreacst year*/
							/*******************************/
							if (empty($_REQUEST['Year']))
							{
							?>
							<div class="box box-success">
								<form name="Select_Year" action="<?php echo $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report']; ?>" method="post">
									<div id="sandbox-container-NSF" class="box-body">
										<!-- Date range -->
										<div class="form-group">
											<label>Year:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" name="Goto_Year" class="form-control pull-right" id="reservation" readonly="" onChange="document.forms['Select_Year'].submit()">
											</div><!-- /.input group -->
										</div><!-- /.form group -->
									</div>
								</form>
							</div>
							<?php 
							if (isset($_REQUEST['Goto_Year']))
								{
									header('Location: '. $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&Year='.$_REQUEST['Goto_Year']);
								}
							}
							/********************************/
							/*end of forecast year selection*/
							/********************************/

							/*if year has been selected show following*/
							if (isset($_REQUEST['Year'])) 
							{
								/*check if selected year not less than current year*/
								if ($_REQUEST['Year'] >= date("Y"))
								{
								?>
								<!-- general form elements disabled -->
								<div class="box box-solid box-success" id="first_div">
									<!-- Box Tools -->
									<div class="box-header">
										<!-- tools box -->
										<div class="pull-left box-tools">
											<button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
											<button class="btn btn-success btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
										</div><!-- /. tools -->
										<h3 class="box-title">Add New Sales Forecast</h3>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										
										<form role="form" action="<?php echo $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&Year='.$_REQUEST['Year']; ?>" name="salesforecast" id="salesforecast" method="post">
											<!-- text input -->
											<!-- Show Sales Order Lines Table -->
											<div class="box-body">
											<?php			
											$CurYear 	= $_REQUEST['Year'];
											$LastYear 	= $CurYear - 1;
											include('./forms/more/calc.php');
											?>

												<!-- title row -->
												<div class="row">
													<div class="col-sm-4 invoice-col">
														<address>
															<strong>Select Representative</strong>
															<select id="select_representative" name="Representative_NO"  class="selectpicker form-control" data-container="body" data-live-search="true">
																 <?php include_once('select/members.php'); ?>
															</select>
														</address>
													</div><!-- /.col -->
													<div class="col-sm-4 invoice-col">

														<address>
															<strong>Select Customer</strong>
															<select id="select_costumer" name="Customer_NO"  class="selectpicker form-control" data-container="body" data-live-search="true">
																 <?php include_once('select/customers.php'); ?>
															</select>
														</address>
													</div><!-- /.col -->
													<div class="col-sm-4 invoice-col">
														<address>
															<strong>Select Item</strong>
															<select id="select_item" name="Item_Code"  class="selectpicker form-control" data-container="body" data-live-search="true">
																 <?php include_once('select/items.php'); ?>
															</select>
														</address>
													</div><!-- /.col -->
			
													<!-- First Quarter -->
													<table id="SalesOrdersLines" class="table table-bordered">
														<thead>
															<tr>
																<th>Jan</th>
																<th>Feb</th>
																<th>Mar</th>
																<th>Q1 Price</th>
															</tr>
														</thead>
														<tbody>
															<tr>
															<?php
															/*Quarter Closing Date*/
															if(strtotime($LastYear."-09-28") < time())
															{ $ReadOnly_Q1 = "readonly";}
															else {$ReadOnly_Q1 = "";}
															?>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_01" id="M_01" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q1; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_02" id="M_02" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q1; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_03" id="M_03" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q1; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span><input type="number" name="Q_V_01" id="Q_V_01" onchange="calculate();" class="form-control" min="0" step="0.01" value="" <?php echo $ReadOnly_Q1; ?>><span class="input-group-addon">.00</span></div></td>
															</tr>
														</tbody>
													</table>
													<!-- End of First Quarter -->
			
													<!-- Second Quarter -->
													<table id="SalesOrdersLines1" class="table table-bordered">
														<thead>
															<tr>
																<th>Apr</th>
																<th>May</th>
																<th>Jun</th>
																<th>Q2 Price</th>
															</tr>
														</thead>
														<tbody>
															<tr>
															<?php
															/*Quarter Closing Date*/
															if(strtotime($CurYear."-01-15") < time())
															{ $ReadOnly_Q2 = "readonly";}
															else {$ReadOnly_Q2 = "";}
															?>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_04" id="M_04" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q2; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_05" id="M_05" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q2; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_06" id="M_06" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q2; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span><input type="number" name="Q_V_02" id="Q_V_02" onchange="calculate();" class="form-control" min="0" step="0.01" value="" <?php echo $ReadOnly_Q2; ?>><span class="input-group-addon">.00</span></div></td>
															</tr>
														</tbody>
													</table>
													<!-- End of Second Quarter -->
			
													<!-- Third Quarter -->
													<table id="SalesOrdersLines2" class="table table-bordered">
														<thead>
															<tr>
																<th>Jul</th>
																<th>Aug</th>
																<th>Sep</th>
																<th>Q3 Price</th>
															</tr>
														</thead>
														<tbody>
															<tr>
															<?php
															/*Quarter Closing Date*/
															if (strtotime($CurYear."-04-15") < time())
															{ $ReadOnly_Q3 = "readonly";}
															else {$ReadOnly_Q3 = "";}
															?>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_07" id="M_07" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q3; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_08" id="M_08" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q3; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_09" id="M_09" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q3; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span><input type="number" name="Q_V_03" id="Q_V_03" onchange="calculate();" class="form-control" min="0" step="0.01" value="" <?php echo $ReadOnly_Q3; ?>><span class="input-group-addon">.00</span></div></td>
															</tr>
														</tbody>
													</table>
													<!-- End of Third Quarter -->
			
													<!-- Fourth Quarter -->
													<table id="SalesOrdersLines3" class="table table-bordered">
														<thead>
															<tr>
																<th>Oct</th>
																<th>Nov</th>
																<th>Dec</th>
																<th>Q4 Price</th>
															</tr>
														</thead>
														<tbody>
															<tr>
															<?php
															/*Quarter Closing Date*/
															if (strtotime($CurYear."-07-15") < time())
															{ $ReadOnly_Q4 = "readonly";}
															else {$ReadOnly_Q4 = "";}
															?>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_10" id="M_10" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q4; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_11" id="M_11" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q4; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_12" id="M_12" onchange="calculate();" class="form-control" min="0" value="" <?php echo $ReadOnly_Q4; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span><input type="number" name="Q_V_04" id="Q_V_04" onchange="calculate();" class="form-control" min="0" step="0.01" value="" <?php echo $ReadOnly_Q4; ?>><span class="input-group-addon">.00</span></div></td>
															</tr>
														</tbody>
													</table>
													<!-- End of Fourth Quarter -->	
												</div>

												<div class="box-footer">
													<!-- Calculate Totals -->
													<div class="col-sm-offset-9">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-leaf"></i>
															</span>
															<input type="text" class="form-control" name="form[SalesForecast]" id="TotalQty" readonly="readonly" placeholder="Calc ...">
														</div><!-- /input-group -->
													</div><!-- /.Calc QTY -->
													<div class="col-sm-offset-9">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-money"></i>
															</span>
															<input type="text" class="form-control" name="form[SalesForecast]" id="TotalValue" readonly="readonly" placeholder="Calc ...">
														</div><!-- /input-group -->
													</div><!-- /.Qalc Value -->
													<!-- End of Calculate Totals -->

													<button type="Submit" class="btn btn-danger" name="Submit" id="Submit">Submit</button>
												</div>
											</div>
										</form>		
									</div>
									<?php
									/*Request forecasted year*/
									if (isset($_REQUEST['Year'])) 				{ $Year = $_REQUEST['Year'];}
									if (isset($_REQUEST['Customer_NO'])) 		{ $Customer_NO = $_REQUEST['Customer_NO'];}
									if (isset($_REQUEST['Item_Code'])) 			{ $Item_Code = $_REQUEST['Item_Code'];}
									if (isset($_REQUEST['Representative_NO'])) 	{ $Representative_NO = $_REQUEST['Representative_NO'];}
									if (isset($_REQUEST['M_01'])) 				{ $M_01 = $_REQUEST['M_01'];}
									if (isset($_REQUEST['M_02'])) 				{ $M_02 = $_REQUEST['M_02'];}
									if (isset($_REQUEST['M_03'])) 				{ $M_03 = $_REQUEST['M_03'];}
									if (isset($_REQUEST['M_04'])) 				{ $M_04 = $_REQUEST['M_04'];}
									if (isset($_REQUEST['M_05'])) 				{ $M_05 = $_REQUEST['M_05'];}
									if (isset($_REQUEST['M_06'])) 				{ $M_06 = $_REQUEST['M_06'];}
									if (isset($_REQUEST['M_07'])) 				{ $M_07 = $_REQUEST['M_07'];}
									if (isset($_REQUEST['M_08'])) 				{ $M_08 = $_REQUEST['M_08'];}
									if (isset($_REQUEST['M_09'])) 				{ $M_09 = $_REQUEST['M_09'];}
									if (isset($_REQUEST['M_10'])) 				{ $M_10 = $_REQUEST['M_10'];}
									if (isset($_REQUEST['M_11'])) 				{ $M_11 = $_REQUEST['M_11'];}
									if (isset($_REQUEST['M_12'])) 				{ $M_12 = $_REQUEST['M_12'];}
									if (isset($_REQUEST['Q_V_01'])) 			{ $Q_V_01 = $_REQUEST['Q_V_01'];}
									if (isset($_REQUEST['Q_V_02'])) 			{ $Q_V_02 = $_REQUEST['Q_V_02'];}
									if (isset($_REQUEST['Q_V_03'])) 			{ $Q_V_03 = $_REQUEST['Q_V_03'];}
									if (isset($_REQUEST['Q_V_04'])) 			{ $Q_V_04 = $_REQUEST['Q_V_04'];}
									if (isset($_REQUEST['Submit']))
									{

										/*Update condtional Approval*/
										$New_Record = ("INSERT INTO sales_forecast 	(Customer_NO, Item_Code, Year, Representative_NO, M_01, M_02, M_03, M_04, M_05, M_06, M_07, M_08, M_09, M_10, M_11, M_12, Q_V_01, Q_V_02, Q_V_03, Q_V_04) 
																					VALUES 
																					('$Customer_NO', '$Item_Code', '$Year', '$Representative_NO', '$M_01', '$M_02', '$M_03', '$M_04', '$M_05', '$M_06', '$M_07', '$M_08', '$M_09', '$M_10', '$M_11', '$M_12', '$Q_V_01', '$Q_V_02', '$Q_V_03', '$Q_V_04')");
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
															.$MySQLConnection->error.
														'</div>');
										header("Refresh:0");
									}
								}
							}
							?>	
							</div>
						</div><!-- End Form 1 -->
