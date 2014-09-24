						<!-- /*******/ Page Name /*******/ -->
						<script language="javascript">
							document.title = "Delivery - Sales Order | Eta Mifad";
						</script>
						<!-- /*******/ Page Name /*******/ -->

						<!-- Form 1 -->
						<div class="col-md-12">
							<!-- general form elements disabled -->
							<!-- warning -->
							<div class="box box-solid box-warning" id="first_div">
								<!-- Box Tools -->
								<div class="box-header">
									<!-- tools box -->
									<div class="pull-left box-tools">
										<button class="btn btn-warning btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
										<button class="btn btn-warning btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
									</div><!-- /. tools -->
									<h3 class="box-title"><script type="text/javascript">document.write(document.title);</script></h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<table id="SalesOrders" class="table table-bordered">
										<thead>
											<tr>
												<th>Sales Order</th>
												<th>Creation Date</th>
												<th>Customer NO</th>
												<th>Customer Name</th>
											</tr>
										</thead>
										<tbody>
									
											<?php 
												$Page		='';
												if (isset ($_REQUEST['Page'])) 				{$Page	= $_REQUEST["Page"];}
												/*Create a query by View filter*/
												if (isset($_REQUEST['View']))
												{
													if ($_REQUEST['View'] == 'New') 
													{ 
														$Query1 =  "SELECT * 
																	FROM 
																		sales_order 
																	LEFT JOIN sales_order_lines 
																		on sales_order.LPO_NO = sales_order_lines.LPO_NO
																	LEFT JOIN customers 
																		on sales_order.Customer_NO = customers.Customer_NO
																	WHERE 
																		sales_order_lines.ATD =1 
																		AND sales_order_lines.Delivery_Date_Start !='' 
																	GROUP BY 
																		sales_order.LPO_NO";	
													}
													if ($_REQUEST['View'] == 'Sent') 
													{ 
														$Query1 =  "SELECT * 
																	FROM 
																		sales_order 
																	LEFT JOIN sales_order_lines 
																		on sales_order.LPO_NO = sales_order_lines.LPO_NO
																	LEFT JOIN customers 
																		on sales_order.Customer_NO = customers.Customer_NO
																	WHERE 
																		sales_order_lines.ATD =1 
																		AND sales_order_lines.Delivery_Date_Start ='' 
																	GROUP BY 
																		sales_order.LPO_NO";	
													}
												}
												// Perform queries 
												if ($Result = mysqli_query($MySQLConnection,$Query1))
												{
												  // Fetch one and one row
												  while ($row = $Result->fetch_assoc())
													{
														echo 	'<tr>';
														/*add all table variables to URL for calling them later*/
														echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&View='.$_REQUEST['View'].'&Page='.$row['ID'].'&LPO_NO='.$row['LPO_NO'].'&Customer_Name='.$row['Customer_Name'].'&Address='.$row['Address'].'&LPO_Date='.$row['LPO_Date'].'&Approve='.$row['Approve'].'&Approved_By='.$row['Approved_By'].'&Approval_Date='.$row['Approval_Date'].'&Collapse">'.$row['LPO_NO'].'</a></td>';
														echo		'<td>'.$row['LPO_Date'].'</td>';
														echo		'<td>'.$row['Customer_NO'].'</td>';
														/*Detect Customer Data by ID*/
														echo		'<td>'.$row['Customer_Name'].'</td>';
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
							<?php if($Page !=''){ ?>
							<!-- general form elements disabled -->


							<section class="content invoice"> 
								<!-- title row -->
								<div class="row">
									<div class="col-xs-12">
										<h2 class="page-header">
											<i class="fa"></i><?php echo $_REQUEST["Customer_Name"]; ?>
											<small class="pull-right"><strong>Creation Date </strong><?php echo $_REQUEST["LPO_Date"]; ?></small>
										</h2>                            
									</div><!-- /.col -->
								</div>
								<div class="row invoice-info">
									<div class="col-sm-4 invoice-col">
										<address>
											<strong>Address </strong><?php echo $_REQUEST["Address"]; ?><br>
										</address>
									</div><!-- /.col -->
									<div class="col-sm-4 invoice-col">
										<address>
											<strong>Sales Order #</strong><?php echo $_REQUEST["LPO_NO"]; ?><br>
											<strong>Creation Date </strong><?php echo $_REQUEST["LPO_Date"]; ?><br>
										</address>
									</div><!-- /.col -->
									<div class="col-sm-4 invoice-col">
										<address>
											<strong>Approval Status </strong><?php echo $_REQUEST["Approve"]; ?><br>
											<strong><?php echo $_REQUEST["Approve"]; ?> By </strong>@<?php echo $_REQUEST["Approved_By"]; ?> on <?php echo $_REQUEST["Approval_Date"]; ?><br>
										</address>
									</div><!-- /.col -->
									<!-- Show Sales Order Lines Table -->
									<form role="form" action="<?php echo $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&View='.$_REQUEST['View'].'&Page='.$Page.'&LPO_NO='.$_REQUEST['LPO_NO'].'&Customer_Name='.$_REQUEST['Customer_Name'].'&Address='.$_REQUEST['Address'].'&LPO_Date='.$_REQUEST['LPO_Date'].'&Approve='.$_REQUEST['Approve']; ?>" id="sales" method="post">
										<div class="box-body">
											<input type="hidden" class="form-control" name="ID" value="<?php echo $Page; ?>"/>

											<table id="SalesOrdersLines" class="table table-bordered">
												<thead>
													<tr>
														<th>Order ID</th>
														<th>Sales Order</th>
														<th>Item Code</th>
														<th>Item Name</th>
														<th>Delivery Available</th>
														<?php if ($_REQUEST['View'] == 'New') : ?>
														<th>Delivery Start Date</th>
														<th>Delivery End Date</th>
														<?php endif ?>
													</tr>
												</thead>
												<tbody>						
												<?php 
												// Perform queries 
												if (isset($_REQUEST['LPO_NO']))					{$LPO_NO = $_REQUEST['LPO_NO'];}
												if (isset($_REQUEST['Delivery_Date_Start']))	{$Delivery_Date_Start = $_REQUEST['Delivery_Date_Start'];}
												if (isset($_REQUEST['Delivery_Date_End']))		{$Delivery_Date_End = $_REQUEST['Delivery_Date_End'];}
												$Query2 =  "SELECT * 
															FROM 
																sales_order 
															LEFT JOIN sales_order_lines 
																on sales_order.LPO_NO = sales_order_lines.LPO_NO
															LEFT JOIN items 
																on sales_order_lines.Item_Code = items.Item_Code
															WHERE 
																sales_order_lines.Delivery_Available !=0 
																AND sales_order_lines.ATD !=0 
																AND sales_order.LPO_NO = $LPO_NO 
															GROUP BY 
																sales_order_lines.ID";
												
												if ($Result = mysqli_query($MySQLConnection,$Query2))
												{
												  // Fetch one and one row
												  while ($row = $Result->fetch_assoc())
													{
														echo 	'<tr>';
														echo 		'<td>'.$row['ID'].'</td>';
														echo 		'<td>'.$row['LPO_NO'].'</td>';
														echo		'<td>'.$row['Item_Code'].'</td>';
														echo		'<td>'.$row['Item_Name'].'</td>';
														echo 		'<td>'.$row['Delivery_Available'].'</td>';
														if ($_REQUEST['View'] == 'New')
														{
														echo 		'<td>'.$row['Delivery_Date_Start'].'</td>';
														echo 		'<td>'.$row['Delivery_Date_End'].'</td>';
														}
														echo 	'</tr>';

														$IDArray[]=$row['ID'];
														/*$Delivered_Quantities[] =$row['Delivered_Quantities']+$row['Delivery_Available'];*/
													}
												  // Free Result set
												  mysqli_free_Result($Result);
												}
												if (isset($_REQUEST['Submit']))
												{
													for($i=0;$i<count($IDArray);$i++)
												
													{
														/*Update condtional Approval*/
														$Update_Record = "UPDATE sales_order_lines SET Delivery_Date_Start = '$Delivery_Date_Start[$i]', Delivery_Date_End = '$Delivery_Date_End[$i]' WHERE ID = $IDArray[$i]";						
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
												?>
												</tbody>
											</table>
										</div>
										<button type="Submit" class="btn btn-primary" name="Submit" id="Submit">Submit</button>
									</form>		
								</div><!-- /.row -->				
							</section>
							<?php } 
							?>
						</div><!-- End Form 1 -->