						<!-- /*******/ Page Name /*******/ -->
						<script language="javascript">
							document.title = "Report - Sales Forecast - Unit | Eta Mifad";
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
							<div class="box box-solid box-primary">
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
											, sales_forecast.Item_Code
											, sales_forecast.Representative_NO
											, sales_forecast.Year
											, items.Item_Name
											, items.Unit_Value
											, items.Unit
											, items.Company
											, sum(sales_forecast.M_01 * items.Unit_Value) 		AS SUM_M_01
											, sum(sales_forecast.M_02 * items.Unit_Value) 		AS SUM_M_02
											, sum(sales_forecast.M_03 * items.Unit_Value) 		AS SUM_M_03
											, sum(sales_forecast.M_04 * items.Unit_Value) 		AS SUM_M_04
											, sum(sales_forecast.M_05 * items.Unit_Value) 		AS SUM_M_05
											, sum(sales_forecast.M_06 * items.Unit_Value) 		AS SUM_M_06
											, sum(sales_forecast.M_07 * items.Unit_Value) 		AS SUM_M_07
											, sum(sales_forecast.M_08 * items.Unit_Value) 		AS SUM_M_08
											, sum(sales_forecast.M_09 * items.Unit_Value) 		AS SUM_M_09
											, sum(sales_forecast.M_10 * items.Unit_Value) 		AS SUM_M_10
											, sum(sales_forecast.M_11 * items.Unit_Value) 		AS SUM_M_11
											, sum(sales_forecast.M_12 * items.Unit_Value) 		AS SUM_M_12
											, sum(sales_forecast.M_01 * sales_forecast.Q_V_01)	AS SUM_M_V_01
											, sum(sales_forecast.M_02 * sales_forecast.Q_V_01)	AS SUM_M_V_02
											, sum(sales_forecast.M_03 * sales_forecast.Q_V_01)	AS SUM_M_V_03
											, sum(sales_forecast.M_04 * sales_forecast.Q_V_02)	AS SUM_M_V_04
											, sum(sales_forecast.M_05 * sales_forecast.Q_V_02)	AS SUM_M_V_05
											, sum(sales_forecast.M_06 * sales_forecast.Q_V_02)	AS SUM_M_V_06
											, sum(sales_forecast.M_07 * sales_forecast.Q_V_03)	AS SUM_M_V_07
											, sum(sales_forecast.M_08 * sales_forecast.Q_V_03)	AS SUM_M_V_08
											, sum(sales_forecast.M_09 * sales_forecast.Q_V_03)	AS SUM_M_V_09
											, sum(sales_forecast.M_10 * sales_forecast.Q_V_04)	AS SUM_M_V_10
											, sum(sales_forecast.M_11 * sales_forecast.Q_V_04)	AS SUM_M_V_11
											, sum(sales_forecast.M_12 * sales_forecast.Q_V_04)	AS SUM_M_V_12
											, sum((sales_forecast.M_01 + sales_forecast.M_02 + sales_forecast.M_03) * items.Unit_Value) AS SUM_Q_01
											, sum((sales_forecast.M_04 + sales_forecast.M_05 + sales_forecast.M_06) * items.Unit_Value) AS SUM_Q_02
											, sum((sales_forecast.M_07 + sales_forecast.M_08 + sales_forecast.M_09) * items.Unit_Value) AS SUM_Q_03
											, sum((sales_forecast.M_10 + sales_forecast.M_11 + sales_forecast.M_12) * items.Unit_Value) AS SUM_Q_04
											, sum((sales_forecast.M_01 + sales_forecast.M_02 + sales_forecast.M_03) * sales_forecast.Q_V_01) AS SUM_Q_V_01
											, sum((sales_forecast.M_04 + sales_forecast.M_05 + sales_forecast.M_06) * sales_forecast.Q_V_02) AS SUM_Q_V_02
											, sum((sales_forecast.M_07 + sales_forecast.M_08 + sales_forecast.M_09) * sales_forecast.Q_V_03) AS SUM_Q_V_03
											, sum((sales_forecast.M_10 + sales_forecast.M_11 + sales_forecast.M_12) * sales_forecast.Q_V_04) AS SUM_Q_V_04
											, sum((sales_forecast.M_01 + sales_forecast.M_02 + sales_forecast.M_03 + sales_forecast.M_04 + sales_forecast.M_05 + sales_forecast.M_06 + sales_forecast.M_07 + sales_forecast.M_08 + sales_forecast.M_09 + sales_forecast.M_10 + sales_forecast.M_11 + sales_forecast.M_12) * items.Unit_Value) AS Total_Year_Qty
											FROM
												sales_forecast
											INNER JOIN items
												ON sales_forecast.Item_Code = items.Item_Code
											$WHERE
											GROUP BY
												sales_forecast.Item_Code";
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
									<h3 class="box-title">Sales Forecast Year <?php echo $_REQUEST['Year']; ?> - Product/Unit</h3>
									<a class="btn btn-lg btn-flat" href="<?php echo str_replace("unit","package",$_SERVER['REQUEST_URI']); ?>" target="_self">
										<i class="glyphicon glyphicon-transfer"></i>&ensp;<small><strong> to Package</strong></small>
									</a>
								</div>
								<!-- Custom Tabs (Pulled to the right) -->
								<div class="nav-tabs-custom">
									<ul class="nav nav-tabs pull-right">
										<li class="active"><a href="#tab_summary" data-toggle="tab">Summary</a></li>
										<li><a href="#tab_details" data-toggle="tab">Details</a></li>
									</ul>
									<div class="tab-content">

										<!-- Summary Tab -->
										<div class="tab-pane active" id="tab_summary">
											<div class="box-body">
												<table id="SalesForecastSummary" class="table table-bordered">
													<thead>
														<tr>
															<th>Item Code</th>
															<th>Item Name</th>
															<th>Unit</th>
															<th>Company</th>
															<th>&Sigma; Qty Q1</th>
															<th>&Sigma; Value Q1</th>
															<th>&Sigma; Qty Q2</th>
															<th>&Sigma; Value Q2</th>
															<th>&Sigma; Qty Q3</th>
															<th>&Sigma; Value Q3</th>
															<th>&Sigma; Qty Q4</th>
															<th>&Sigma; Value Q4</th>
															<th>&Sigma; Total Qty / Year</th>
															<th>&Sigma; Total Value / Year</th>
														</tr>
													</thead>
													<tbody>
														<?php 
															// Perform queries 
															if ($Result = mysqli_query($MySQLConnection,$Query1))
															{
															  // Fetch one and one row
															  while ($row = $Result->fetch_assoc())
																{
																	echo 	'<tr>';
																	echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&Year='.$_REQUEST['Year'].'&Item='.$row['Item_Code'].'&Item_Name='.$row['Item_Name'].'&Unit_Value='.$row['Unit_Value'].'&Unit='.$row['Unit'].'&Company='.$row['Company'].'&Collapse">'.$row['Item_Code'].'</a></td>';
																	echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&Year='.$_REQUEST['Year'].'&Item='.$row['Item_Code'].'&Item_Name='.$row['Item_Name'].'&Unit_Value='.$row['Unit_Value'].'&Unit='.$row['Unit'].'&Company='.$row['Company'].'&Collapse">'.$row['Item_Name'].'</a></td>';
																	echo 		'<td>'.$row['Unit_Value'].' '.$row['Unit'].'</td>';
																	echo		'<td>'.$row['Company'].'</td>';
																	echo 		'<td class="text-purple">'.number_format($row['SUM_Q_01'],2).'</td>';
																	echo 		'<td class="text-green">'.$Currency_Symbol.number_format($row['SUM_Q_V_01'],2).'</td>';
																	echo 		'<td class="text-purple">'.number_format($row['SUM_Q_02'],2).'</td>';
																	echo 		'<td class="text-green">'.$Currency_Symbol.number_format($row['SUM_Q_V_02'],2).'</td>';
																	echo 		'<td class="text-purple">'.number_format($row['SUM_Q_03'],2).'</td>';
																	echo 		'<td class="text-green">'.$Currency_Symbol.number_format($row['SUM_Q_V_03'],2).'</td>';
																	echo 		'<td class="text-purple">'.number_format($row['SUM_Q_04'],2).'</td>';
																	echo 		'<td class="text-green">'.$Currency_Symbol.number_format($row['SUM_Q_V_04'],2).'</td>';
																	echo 		'<td class="text-red">'.number_format($row['Total_Year_Qty']).'</td>';
																	echo 		'<td class="text-red">'.$Currency_Symbol.number_format(fnAdd4($row['SUM_Q_V_01'], $row['SUM_Q_V_02'], $row['SUM_Q_V_03'], $row['SUM_Q_V_04']),2).'</td>';
																	echo 	'</tr>';
																}
															  // Free Result set
															  mysqli_free_Result($Result);
															}
														?>
													</tbody>
												</table>
											</div>
										</div><!-- /.tab-pane -->

										<!-- Details Tab -->
										<div class="tab-pane" id="tab_details">
											<div class="box-body">
												<table id="SalesForecastDetails" class="table table-bordered">
													<thead>
														<tr>
															<th>Item Code</th>
															<th>Item Name</th>
															<th>Unit</th>
															<th>Company</th>
															<th>Jan Qty</th>
															<th>Jan Value</th>
															<th>Feb Qty</th>
															<th>Feb Value</th>
															<th>Mar Qty</th>
															<th>Mar Value</th>
															<th>Apr Qty</th>
															<th>Apr Value</th>
															<th>May Qty</th>
															<th>May Value</th>
															<th>Jun Qty</th>
															<th>Jun Value</th>
															<th>Jul Qty</th>
															<th>Jul Value</th>
															<th>Aug Qty</th>
															<th>Aug Value</th>
															<th>Sep Qty</th>
															<th>Sep Value</th>
															<th>Oct Qty</th>
															<th>Oct Value</th>
															<th>Nov Qty</th>
															<th>Nov Value</th>
															<th>Dec Qty</th>
															<th>Dec Value</th>
															<th>&Sigma; Total Qty / Year</th>
															<th>&Sigma; Total Value / Year</th>
														</tr>
													</thead>
													<tbody>
														<?php 
															// Perform queries 
															if ($Result = mysqli_query($MySQLConnection,$Query1))
															{
															  // Fetch one and one row
															  while ($row = $Result->fetch_assoc())
																{
																	echo 	'<tr>';
																	echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&Year='.$_REQUEST['Year'].'&Item='.$row['Item_Code'].'&Item_Name='.$row['Item_Name'].'&Unit_Value='.$row['Unit_Value'].'&Unit='.$row['Unit'].'&Company='.$row['Company'].'&Collapse">'.$row['Item_Code'].'</a></td>';
																	echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&Year='.$_REQUEST['Year'].'&Item='.$row['Item_Code'].'&Item_Name='.$row['Item_Name'].'&Unit_Value='.$row['Unit_Value'].'&Unit='.$row['Unit'].'&Company='.$row['Company'].'&Collapse">'.$row['Item_Name'].'</a></td>';
																	echo 		'<td>'.$row['Unit_Value'].' '.$row['Unit'].'</td>';
																	echo		'<td>'.$row['Company'].'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_01'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_01'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_02'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_02'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_03'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_03'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_04'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_04'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_05'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_05'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_06'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_06'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_07'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_07'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_08'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_08'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_09'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_09'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_10'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_10'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_11'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_11'],2).'</td>';
																	echo 		'<td>'.number_format($row['SUM_M_12'],2).'</td>';
																	echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_12'],2).'</td>';
																	echo 		'<td class="text-red">'.number_format($row['Total_Year_Qty']).'</td>';
																	echo 		'<td class="text-red">'.$Currency_Symbol.number_format(fnAdd4($row['SUM_Q_V_01'], $row['SUM_Q_V_02'], $row['SUM_Q_V_03'], $row['SUM_Q_V_04']),2).'</td>';
																	echo 	'</tr>';
																}
															  // Free Result set
															  mysqli_free_Result($Result);
															}
														?>
													</tbody>
												</table>
											</div>
										</div><!-- /.tab-pane -->
									</div><!-- /.tab-content -->
								</div><!-- nav-tabs-custom -->
							</div>
							<!-- if page has been selected show following -->
							<?php if(isset($_REQUEST['Item']))
							{ 
								/********************************//********************************/
								/*Create a Query to Limit Users View by Sessions*/
								/********************************//********************************/
								if ((in_array($_SESSION['Department'], $Permission_SFCUserView)) && (in_array($_SESSION['Title'], $Permission_Admin_SV)))
								{
									$WHERE="WHERE sales_forecast.Year = ".$_REQUEST['Year']." AND sales_forecast.Item_Code = ".$_REQUEST["Item"];
								}
								else
								{
									$WHERE="WHERE sales_forecast.Representative_NO = ".$_SESSION['ID']." AND sales_forecast.Year = ".$_REQUEST['Year']." AND sales_forecast.Item_Code = ".$_REQUEST["Item"];
								}
								/********************************//********************************/
								// Perform queries 
								$Query2 =  "SELECT sales_forecast.ID
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
											, sum(sales_forecast.M_01 * items.Unit_Value) 		AS SUM_M_01
											, sum(sales_forecast.M_02 * items.Unit_Value)		AS SUM_M_02
											, sum(sales_forecast.M_03 * items.Unit_Value)		AS SUM_M_03
											, sum(sales_forecast.M_04 * items.Unit_Value)		AS SUM_M_04
											, sum(sales_forecast.M_05 * items.Unit_Value)		AS SUM_M_05
											, sum(sales_forecast.M_06 * items.Unit_Value)		AS SUM_M_06
											, sum(sales_forecast.M_07 * items.Unit_Value)		AS SUM_M_07
											, sum(sales_forecast.M_08 * items.Unit_Value)		AS SUM_M_08
											, sum(sales_forecast.M_09 * items.Unit_Value)		AS SUM_M_09
											, sum(sales_forecast.M_10 * items.Unit_Value)		AS SUM_M_10
											, sum(sales_forecast.M_11 * items.Unit_Value)		AS SUM_M_11
											, sum(sales_forecast.M_12 * items.Unit_Value)		AS SUM_M_12
											, sum(sales_forecast.M_01 * sales_forecast.Q_V_01)	AS SUM_M_V_01
											, sum(sales_forecast.M_02 * sales_forecast.Q_V_01)	AS SUM_M_V_02
											, sum(sales_forecast.M_03 * sales_forecast.Q_V_01)	AS SUM_M_V_03
											, sum(sales_forecast.M_04 * sales_forecast.Q_V_02)	AS SUM_M_V_04
											, sum(sales_forecast.M_05 * sales_forecast.Q_V_02)	AS SUM_M_V_05
											, sum(sales_forecast.M_06 * sales_forecast.Q_V_02)	AS SUM_M_V_06
											, sum(sales_forecast.M_07 * sales_forecast.Q_V_03)	AS SUM_M_V_07
											, sum(sales_forecast.M_08 * sales_forecast.Q_V_03)	AS SUM_M_V_08
											, sum(sales_forecast.M_09 * sales_forecast.Q_V_03)	AS SUM_M_V_09
											, sum(sales_forecast.M_10 * sales_forecast.Q_V_04)	AS SUM_M_V_10
											, sum(sales_forecast.M_11 * sales_forecast.Q_V_04)	AS SUM_M_V_11
											, sum(sales_forecast.M_12 * sales_forecast.Q_V_04)	AS SUM_M_V_12
											, sum((sales_forecast.M_01 + sales_forecast.M_02 + sales_forecast.M_03) * items.Unit_Value) AS SUM_Q_01
											, sum((sales_forecast.M_04 + sales_forecast.M_05 + sales_forecast.M_06) * items.Unit_Value) AS SUM_Q_02
											, sum((sales_forecast.M_07 + sales_forecast.M_08 + sales_forecast.M_09) * items.Unit_Value) AS SUM_Q_03
											, sum((sales_forecast.M_10 + sales_forecast.M_11 + sales_forecast.M_12) * items.Unit_Value) AS SUM_Q_04
											, sum((sales_forecast.M_01 + sales_forecast.M_02 + sales_forecast.M_03) * sales_forecast.Q_V_01) AS SUM_Q_V_01
											, sum((sales_forecast.M_04 + sales_forecast.M_05 + sales_forecast.M_06) * sales_forecast.Q_V_02) AS SUM_Q_V_02
											, sum((sales_forecast.M_07 + sales_forecast.M_08 + sales_forecast.M_09) * sales_forecast.Q_V_03) AS SUM_Q_V_03
											, sum((sales_forecast.M_10 + sales_forecast.M_11 + sales_forecast.M_12) * sales_forecast.Q_V_04) AS SUM_Q_V_04
											, sum((sales_forecast.M_01 + sales_forecast.M_02 + sales_forecast.M_03 + sales_forecast.M_04 + sales_forecast.M_05 + sales_forecast.M_06 + sales_forecast.M_07 + sales_forecast.M_08 + sales_forecast.M_09 + sales_forecast.M_10 + sales_forecast.M_11 + sales_forecast.M_12) * items.Unit_Value) AS Total_Year_Qty
											FROM
												sales_forecast
											INNER JOIN items
												ON sales_forecast.Item_Code = items.Item_Code
											INNER JOIN customers
												ON sales_forecast.Customer_NO = customers.Customer_NO
											INNER JOIN members
												ON sales_forecast.Representative_NO = members.ID
											$WHERE
											GROUP BY
												sales_forecast.ID";
							?>
							<!-- title row -->
							<!-- general form elements disabled -->
							<div class="box box-solid box-warning">
								<!-- Box Tools -->
								<div class="box-header">
									<!-- tools box -->
									<div class="pull-left box-tools">
										<button class="btn btn-warning btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
										<button class="btn btn-warning btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
									</div><!-- /. tools -->
									<h3 class="box-title">Forecasted in Details - Product/Unit</h3>
									<a class="btn btn-lg btn-flat" href="<?php echo str_replace("unit","package",$_SERVER['REQUEST_URI']); ?>" target="_self">
										<i class="glyphicon glyphicon-transfer"></i>&ensp;<small><strong> to Package</strong></small>
									</a>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div class="callout">
											<dl class="dl-horizontal">
											<dt>#</dt>
											<dd><?php echo $_REQUEST["Item"]; ?></dd>
											<dt>Customer Name</dt>
											<dd><?php echo $_REQUEST["Item_Name"]; ?></dd>
											<dt>Unit</dt>
											<dd><?php echo $_REQUEST["Unit_Value"].' '.$_REQUEST["Unit"]; ?></dd>
											<dt>Company</dt>
											<dd><?php echo $_REQUEST["Company"]; ?></dd>
										</dl>
									</div>
									<table id="SalesForecastCustomer" class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Customer Name</th>
												<th>Representative Name</th>
												<th>Jan Qty</th>
												<th>Jan Value</th>
												<th>Feb Qty</th>
												<th>Feb Value</th>
												<th>Mar Qty</th>
												<th>Mar Value</th>
												<th>&Sigma; Qty Q1</th>
												<th>&Sigma; Value Q1</th>
												<th>AprQty</th>
												<th>Apr Value</th>
												<th>MayQty</th>
												<th>May Value</th>
												<th>JunQty</th>
												<th>Jun Value</th>
												<th>&Sigma; Qty Q2</th>
												<th>&Sigma; Value Q2</th>
												<th>Jul Qty</th>
												<th>Jul Value</th>
												<th>Aug Qty</th>
												<th>Aug Value</th>
												<th>Sep Qty</th>
												<th>Sep Value</th>
												<th>&Sigma; Qty Q3</th>
												<th>&Sigma; Value Q3</th>
												<th>Oct Qty</th>
												<th>Oct Value</th>
												<th>Nov Qty</th>
												<th>Nov Value</th>
												<th>Dec Qty</th>
												<th>Dec Value</th>
												<th>&Sigma; Qty Q4</th>
												<th>&Sigma; Value Q4</th>
												<th>&Sigma; Total Qty / Year</th>
												<th>&Sigma; Total Value / Year</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												// Perform queries 
												if ($Result = mysqli_query($MySQLConnection,$Query2))
												{
												  // Fetch one and one row
												  while ($row = $Result->fetch_assoc())
													{
														echo 	'<tr>';
														echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.str_replace("-07","-09",$_REQUEST['Report']).'&Year='.$_REQUEST['Year'].'&CustomerNO='.$row['Customer_NO'].'&CustomerName='.$row['Customer_Name'].'&Company='.$row['Company'].'">'.$row['Customer_NO'].'</a></td>';
														echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.str_replace("-07","-09",$_REQUEST['Report']).'&Year='.$_REQUEST['Year'].'&CustomerNO='.$row['Customer_NO'].'&CustomerName='.$row['Customer_Name'].'&Company='.$row['Company'].'">'.$row['Customer_Name'].'</a></td>';
														echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.str_replace("-07","-08",$_REQUEST['Report']).'&Year='.$_REQUEST['Year'].'&Rep='.$row['Representative_NO'].'&RepName='.$row['Representative_Name'].'&Company='.$row['Company'].'">'.$row['Representative_Name'].'</a></td>';
														echo		'<td>'.number_format($row['SUM_M_01'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_01'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_02'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_02'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_03'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_03'],2).'</td>';
														echo 		'<td class="text-purple">'.number_format($row['SUM_Q_01'],2).'</td>';
														echo 		'<td class="text-green">'.$Currency_Symbol.number_format($row['SUM_Q_V_01'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_04'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_04'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_05'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_05'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_06'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_06'],2).'</td>';
														echo 		'<td class="text-purple">'.number_format($row['SUM_Q_02'],2).'</td>';
														echo 		'<td class="text-green">'.$Currency_Symbol.number_format($row['SUM_Q_V_02'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_07'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_07'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_08'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_08'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_09'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_09'],2).'</td>';
														echo 		'<td class="text-purple">'.number_format($row['SUM_Q_03'],2).'</td>';
														echo 		'<td class="text-green">'.$Currency_Symbol.number_format($row['SUM_Q_V_03'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_10'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_10'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_11'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_11'],2).'</td>';
														echo 		'<td>'.number_format($row['SUM_M_12'],2).'</td>';
														echo 		'<td class="text-yellow">'.$Currency_Symbol.number_format($row['SUM_M_V_12'],2).'</td>';
														echo 		'<td class="text-purple">'.number_format($row['SUM_Q_04'],2).'</td>';
														echo 		'<td class="text-green">'.$Currency_Symbol.number_format($row['SUM_Q_V_04'],2).'</td>';
														echo 		'<td class="text-red">'.number_format($row['Total_Year_Qty'],2).'</td>';
														echo 		'<td class="text-red">'.$Currency_Symbol.number_format(fnAdd4($row['SUM_Q_V_01'], $row['SUM_Q_V_02'], $row['SUM_Q_V_03'], $row['SUM_Q_V_04']),2).'</td>';
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

							<!-- *************************************** -->
							<!-- Chart ********************************* -->
							<!-- *************************************** -->
							<!-- AREA CHART -->
							<div class="box box-solid box-success">
								<!-- Box Tools -->
								<div class="box-header">
									<!-- tools box -->
									<div class="pull-left box-tools">
										<button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
										<button class="btn btn-success btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
									</div><!-- /. tools -->
									<h3 class="box-title">Product Forecast Year - Product/Unit</h3>
								</div>
								<div class="box-body chart-responsive">
									<?php $Chart = "./forms/chart/chart_product_unit.php"; ?>
									<div class="chart" id="Area-chart" style="height: 300px;"></div>
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						<?php 
							}
						}
						?>
						</div><!-- End Form 1 -->