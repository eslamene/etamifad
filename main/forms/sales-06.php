						<!-- /*******/ Page Name /*******/ -->
						<script language="javascript">
							document.title = "Modify- Sales Forecast | Eta Mifad";
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
							<div class="box box-primary">
								<form name="Select_Year" action="<?php echo $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report']; ?>" method="post">
									<div id="sandbox-container-RSF" class="box-body">
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
							?>
								<!-- general form elements disabled -->
								<div class="box box-solid box-primary" id="first_div">
									<!-- Box Tools -->
									<div class="box-header">
										<!-- tools box -->
										<div class="pull-left box-tools">
											<button class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
											<button class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
										</div><!-- /. tools -->
										<h3 class="box-title"><?php echo $_REQUEST['Year']; ?> Sales Forecast</h3>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<table id="SalesOrders" class="table table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>#</th>
													<th>Customer Name</th>	
													<th>Item Code</th>
													<th>Item Name</th>
													<th>Representative Name</th>
													<th>Company</th>
													<th>Year</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													/*Create a query by View filter*/
													if (isset($_REQUEST['Year']))
													{
														/********************************//********************************/
														/*Create a Query to Limit Users View by Sessions*/
														/********************************//********************************/
														if ((in_array($_SESSION['Department'], $Permission_SFCUserView)) && (in_array($_SESSION['Title'], $Permission_Admin_SV)))
														{
															$WHERE="WHERE sales_forecast.Year = ".$_REQUEST['Year'];
														}
														else
														{
															$WHERE="WHERE sales_forecast.Representative_NO = ".$_SESSION['ID']." AND sales_forecast.Year = ".$_REQUEST['Year'];
														}
														/********************************//********************************/
														$Query1 =  "SELECT sales_forecast.ID
																	, sales_forecast.Customer_NO
																	, sales_forecast.Item_Code
																	, sales_forecast.Representative_NO
																	, sales_forecast.Year
																	, customers.Customer_Name
																	, items.Item_Name
																	, items.Unit_Value
																	, items.Unit
																	, items.Company
																	, concat(members.First_Name, ' ', members.Second_Name) AS Representative_Name
																	FROM
																		sales_forecast
																	LEFT JOIN customers 
																		on sales_forecast.Customer_NO = customers.Customer_NO
																	LEFT JOIN members 
																		on sales_forecast.Representative_NO = members.ID
																	LEFT JOIN items 
																		on sales_forecast.Item_Code = items.Item_Code
																	$WHERE
																	GROUP BY
																		sales_forecast.ID";
														
													}
													// Perform queries 
													if ($Result = mysqli_query($MySQLConnection,$Query1))
													{
													  // Fetch one and one row
													  while ($row = $Result->fetch_assoc())
														{
															echo 	'<tr>';
															echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&Year='.$_REQUEST['Year'].'&ID='.$row['ID'].'&Collapse">'.$row['ID'].'</a></td>';
															echo		'<td>'.$row['Customer_NO'].'</td>';
															echo		'<td>'.$row['Customer_Name'].'</td>';
															echo		'<td>'.$row['Item_Code'].'</td>';
															echo		'<td>'.$row['Item_Name'].'</td>';
															echo		'<td>'.$row['Representative_Name'].'</td>';
															echo		'<td>'.$row['Company'].'</td>';
															echo		'<td>'.$row['Year'].'</td>';
															echo 	'</tr>';
														}
													  // Free Result set
													  mysqli_free_Result($Result);
													}
												?>
											</tbody>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->


								<!-- if page has been selected show following -->
								<?php if(isset($_REQUEST['ID']))
								{ 
									/********************************//********************************/
									/*Create a Query to Limit Users View by Sessions*/
									/********************************//********************************/
									if (in_array($_SESSION['Department'], $Permission_SFCUserView))
									{
										$WHERE="WHERE sales_forecast.Year = ".$_REQUEST['Year']." AND sales_forecast.ID = ".$_REQUEST["ID"];
									}
									else
									{
										$WHERE="WHERE sales_forecast.Representative_NO = ".$_SESSION['ID']." AND sales_forecast.Year = ".$_REQUEST['Year']." AND sales_forecast.ID = ".$_REQUEST["ID"];
									}
									/********************************//********************************/
									// Perform queries 
									$Query2 =  "SELECT items.*, customers.*, sales_forecast.* FROM sales_forecast
												LEFT JOIN customers on sales_forecast.Customer_NO = customers.Customer_NO
												LEFT JOIN items on sales_forecast.Item_Code = items.Item_Code
												$WHERE";
									
									if ($Result = mysqli_query($MySQLConnection,$Query2))
									{
									  // Fetch one and one row
									  $row = $Result->fetch_assoc();	
								?>
								<!-- general form elements disabled -->
								<div class="box box-solid box-danger">
									<!-- Box Tools -->
									<div class="box-header">
										<!-- tools box -->
										<div class="pull-left box-tools">
											<button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
											<button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
										</div><!-- /. tools -->
										<h3 class="box-title">Edit Sales Forecast</h3>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
									<!-- title row -->

										<div class="row">
											<div class="col-xs-12">
												<h2 class="page-header">
													<i class="fa"></i><?php echo $row["Customer_Name"]; ?>
												</h2>                            
											</div><!-- /.col -->
										</div>
										<div class="col-sm-4 invoice-col">
											<address>
												<strong>Address </strong><?php echo $row["Address"]; ?><br>
											</address>
										</div><!-- /.col -->
										<div class="col-sm-4 invoice-col">
											<address>
												<strong>Item Code #</strong><?php echo $row["Item_Code"]; ?><br>
												<strong>Item Name </strong><?php echo $row["Item_Name"]; ?><br>
											</address>
										</div><!-- /.col -->
										
										<form role="form" action="<?php echo $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&Year='.$_REQUEST['Year'].'&ID='.$_REQUEST['ID']; ?>" name="salesforecast" id="salesforecast" method="post">
											<!-- text input -->
											<!-- Show Sales Order Lines Table -->
											<div class="box-body">
											<?php			
											$CurYear 	= $row['Year'];
											$LastYear 	= $CurYear - 1;
											include('./forms/more/calc.php');
											?>
		
												<!-- title row -->
												<div class="row">
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
															if(strtotime($LastYear."-11-01") < time())
															{ $ReadOnly_Q1 = "readonly";}
															else {$ReadOnly_Q1 = "";}
															?>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_01" id="M_01" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_01']; ?>" <?php echo $ReadOnly_Q1; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_02" id="M_02" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_02']; ?>" <?php echo $ReadOnly_Q1; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_03" id="M_03" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_03']; ?>" <?php echo $ReadOnly_Q1; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span><input type="number" name="Q_V_01" id="Q_V_01" onchange="calculate();" class="form-control" min="0" step="0.01" value="<?php echo $row['Q_V_01']; ?>" <?php echo $ReadOnly_Q1; ?>><span class="input-group-addon">.00</span></div></td>

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
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_04" id="M_04" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_04']; ?>" <?php echo $ReadOnly_Q2; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_05" id="M_05" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_05']; ?>" <?php echo $ReadOnly_Q2; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_06" id="M_06" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_06']; ?>" <?php echo $ReadOnly_Q2; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span><input type="number" name="Q_V_02" id="Q_V_02" onchange="calculate();" class="form-control" min="0" step="0.01" value="<?php echo $row['Q_V_02']; ?>" <?php echo $ReadOnly_Q2; ?>><span class="input-group-addon">.00</span></div></td>
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
															if (strtotime($CurYear."-4-15") < time())
															{ $ReadOnly_Q3 = "readonly";}
															else {$ReadOnly_Q3 = "";}
															?>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_07" id="M_07" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_07']; ?>" <?php echo $ReadOnly_Q3; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_08" id="M_08" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_08']; ?>" <?php echo $ReadOnly_Q3; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_09" id="M_09" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_09']; ?>" <?php echo $ReadOnly_Q3; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span><input type="number" name="Q_V_03" id="Q_V_03" onchange="calculate();" class="form-control" min="0" step="0.01" value="<?php echo $row['Q_V_03']; ?>" <?php echo $ReadOnly_Q3; ?>><span class="input-group-addon">.00</span></div></td>
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
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_10" id="M_10" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_10']; ?>" <?php echo $ReadOnly_Q4; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_11" id="M_11" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_11']; ?>" <?php echo $ReadOnly_Q4; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-leaf"></i></span><input type="number" name="M_12" id="M_12" onchange="calculate();" class="form-control" min="0" value="<?php echo $row['M_12']; ?>" <?php echo $ReadOnly_Q4; ?>></div></td>
																<td><div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span><input type="number" name="Q_V_04" id="Q_V_04" onchange="calculate();" class="form-control" min="0" step="0.01" value="<?php echo $row['Q_V_04']; ?>" <?php echo $ReadOnly_Q4; ?>><span class="input-group-addon">.00</span></div></td>
															</tr>
														</tbody>
													</table>
												</div>
											<!-- End of Fourth Quarter -->	
		
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
									  // Free Result set
									  mysqli_free_Result($Result);
									}

									if (isset($_REQUEST['M_01'])) { $M_01 = $_REQUEST['M_01'];}
									if (isset($_REQUEST['M_02'])) { $M_02 = $_REQUEST['M_02'];}
									if (isset($_REQUEST['M_03'])) { $M_03 = $_REQUEST['M_03'];}
									if (isset($_REQUEST['M_04'])) { $M_04 = $_REQUEST['M_04'];}
									if (isset($_REQUEST['M_05'])) { $M_05 = $_REQUEST['M_05'];}
									if (isset($_REQUEST['M_06'])) { $M_06 = $_REQUEST['M_06'];}
									if (isset($_REQUEST['M_07'])) { $M_07 = $_REQUEST['M_07'];}
									if (isset($_REQUEST['M_08'])) { $M_08 = $_REQUEST['M_08'];}
									if (isset($_REQUEST['M_09'])) { $M_09 = $_REQUEST['M_09'];}
									if (isset($_REQUEST['M_10'])) { $M_10 = $_REQUEST['M_10'];}
									if (isset($_REQUEST['M_11'])) { $M_11 = $_REQUEST['M_11'];}
									if (isset($_REQUEST['M_12'])) { $M_12 = $_REQUEST['M_12'];}
									if (isset($_REQUEST['Q_V_01'])) { $Q_V_01 = $_REQUEST['Q_V_01'];}
									if (isset($_REQUEST['Q_V_02'])) { $Q_V_02 = $_REQUEST['Q_V_02'];}
									if (isset($_REQUEST['Q_V_03'])) { $Q_V_03 = $_REQUEST['Q_V_03'];}
									if (isset($_REQUEST['Q_V_04'])) { $Q_V_04 = $_REQUEST['Q_V_04'];}

									if (isset($_REQUEST['Submit']))
									{

										/*Update condtional Approval*/
										$Update_Record = "UPDATE sales_forecast SET M_01 = $M_01, M_02 = $M_02, M_03 = $M_03, M_04 = $M_04, M_05 = $M_05, M_06 = $M_06, M_07 = $M_07, M_08 = $M_08, M_09 = $M_09, M_10 = $M_10, M_11 = $M_11, M_12 = $M_12, Q_V_01 = $Q_V_01, Q_V_02 = $Q_V_02, Q_V_03 = $Q_V_03, Q_V_04 = $Q_V_04 WHERE ID =".$_REQUEST['ID'];						
										if (!$stmt = $MySQLConnection->prepare($Update_Record))
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
										header("Refresh:0");
									}
								}
							}
							?>	
							</div>
						</div><!-- End Form 1 -->