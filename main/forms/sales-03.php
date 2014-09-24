						<?php 
							$Page		='';
							if (isset ($_REQUEST['Page'])) {$Page	= $_REQUEST["Page"];}
							/*Create a query by View filter*/
							if (isset($_REQUEST['View']))
							{
								if ($_REQUEST['View'] == 'Archived') 
								{ 
									$Query1 =  "SELECT * 
												FROM 
													sales_order 
												left join customers 
													on sales_order.Customer_NO=customers.Customer_NO 
												WHERE 
													Approve != 'Hidden'";
									/* Page Name *************************/
									echo 	'<script language="javascript">
												document.title = "Archived - Sales Order | Eta Mifad";
											</script>';
									/* Page Name *************************/
								}

								elseif ($_REQUEST['View'] == 'ATD') 
								{ 
									$Query1 =  "SELECT * FROM sales_order 
												LEFT JOIN sales_order_lines 
													on sales_order.LPO_NO = sales_order_lines.LPO_NO
												LEFT JOIN customers 
													on sales_order.Customer_NO = customers.Customer_NO
												WHERE 
													sales_order.Approve = 'Accepted' 
													AND sales_order_lines.Delivery_Available !=0 
													AND sales_order_lines.ATD !=1  
												GROUP BY  
													sales_order.LPO_NO";
									/* Page Name *************************/
									echo 	'<script language="javascript">
												document.title = "Available to Deliver - Sales Order | Eta Mifad";
											</script>';
									/* Page Name *************************/
								}
								elseif ($_REQUEST['View'] == 'Delivered') 
								{ 
									$Query1 =  "SELECT * 
												FROM 
													sales_order 
												LEFT JOIN sales_order_lines 
													on sales_order.LPO_NO = sales_order_lines.LPO_NO
												LEFT JOIN customers 
													on sales_order.Customer_NO = customers.Customer_NO
												WHERE 
													sales_order_lines.Delivered_Quantities !=0  
												GROUP BY  
												sales_order.LPO_NO";
								}
								/*Available for Deliver*/
								elseif ($_REQUEST['View'] == 'ATP') 
								{ 
									$Query1 =  "SELECT * 
												FROM 
												sales_order 
												LEFT JOIN sales_order_lines 
												on sales_order.LPO_NO = sales_order_lines.LPO_NO
												LEFT JOIN customers 
												on sales_order.Customer_NO = customers.Customer_NO
												WHERE 
												Approve = 'Accepted' 
												AND sales_order_lines.Delivery_Available + sales_order_lines.Delivered_Quantities < sales_order_lines.Quantity 
											GROUP BY  
												sales_order.LPO_NO";
									/* Page Name *************************/
									echo 	'<script language="javascript">
												document.title = "Available to Promise - Sales Order | Eta Mifad";
											</script>';
									/* Page Name *************************/
								}
							}
						?>

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
									<a class="btn btn-lg btn-flat" href="<?php echo $_SERVER['PHP_SELF'].'?Report=sales-03-raw&View='.$_REQUEST['View']; ?>" target="_self">
										<i class="glyphicon glyphicon-transfer"></i>&ensp;<small><strong> Raw</strong></small>
									</a>
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
												<th>Taxes Value</th>
												<th>Sales Order Total</th>
												<th>Approval</th>
												<th>Approval By</th>
												<th>Approval Date</th>
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
														/*add all table variables to URL for calling them later*/
														echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&View='.$_REQUEST['View'].'&Page='.$row['ID'].'&LPO_NO='.$row['LPO_NO'].'&Customer_Name='.$row['Customer_Name'].'&Address='.$row['Address'].'&LPO_Date='.$row['LPO_Date'].'&Approve='.$row['Approve'].'&Approved_By='.$row['Approved_By'].'&Approval_Date='.$row['Approval_Date'].'&Collapse">'.$row['LPO_NO'].'</a></td>';
														echo		'<td>'.$row['LPO_Date'].'</td>';
														echo		'<td>'.$row['Customer_NO'].'</td>';
														/*Detect Customer Data by ID*/
														echo		'<td>'.$row['Customer_Name'].'</td>';
														echo		'<td>'.$Currency_Symbol.$row['TR_Value'].'</td>';
														echo		'<td>'.$Currency_Symbol.$row['LPO_Total'].'</td>';
														/*check the color of approval*/
														if 		($row['Approve']=='Accepted') 
														{
															echo 		'<td><small class="badge bg-green">'.$row['Approve'].'</small></td>';
															echo		'<td><small class="badge bg-green">'.$row['Approved_By'].'</small></td>';
															echo		'<td><small class="badge bg-green">'.$row['Approval_Date'].'</small></td>';
														}
														elseif 	($row['Approve']=='Rejected') 
														{
															echo 		'<td><small class="badge bg-red">'.$row['Approve'].'</small></td>';
															echo		'<td><small class="badge bg-red">'.$row['Approved_By'].'</small></td>';
															echo		'<td><small class="badge bg-red">'.$row['Approval_Date'].'</small></td>';
														}
														elseif 	($row['Approve']=='Pending') 
														{
															echo 		'<td><small class="badge bg-purple">'.$row['Approve'].'</small></td>';
															echo		'<td><small class="badge bg-purple">'.$row['Approved_By'].'</small></td>';
															echo		'<td><small class="badge bg-purple">'.$row['Approval_Date'].'</small></td>';
														}
														elseif 	($row['Approve']=='')
														{
															echo 		'<td><small class="badge">'.'Waiting'.$row['Approve'].'</small></td>';
															echo		'<td><small class="badge">'.$row['Approved_By'].'</small></td>';
															echo		'<td><small class="badge">'.$row['Approval_Date'].'</small></td>';
														}
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
										<input type="hidden" class="form-control" name="ID" value="<?php echo $Page; ?>"/>

										<table id="SalesOrdersLines" class="table table-bordered">
											<thead>
												<tr>
													<th>Order ID</th>
													<th>Sales Order</th>
													<th>Item Code</th>
													<th>Item Name</th>
													<th>Quantity</th>
													<th>Delivered Quantities</th>
													<th>Delivery Available</th>
													<?php if ($_REQUEST['View'] == 'ATD') : ?>
													<th>Allow Delivery</th>
													<?php endif ?>
													<!-- <th>Enable</th> -->
												</tr>
											</thead>
											<tbody>						
											<?php 
											// Perform queries 
											if (isset($_REQUEST['LPO_NO']))					{$LPO_NO 	= $_REQUEST['LPO_NO'];}
											if (isset($_REQUEST['ATD']))					{$ATD 		= $_REQUEST['ATD'];}
																							
											if ($_REQUEST['View'] =='Archived') 
											{
												
												$Query2 =  "SELECT * 
															FROM
																sales_order 
															LEFT JOIN sales_order_lines 
																on sales_order.LPO_NO = sales_order_lines.LPO_NO
															LEFT JOIN items 
																on sales_order_lines.Item_Code = items.Item_Code
															WHERE 
																sales_order_lines.LPO_NO = $LPO_NO 
															GROUP BY  
																sales_order_lines.ID";
											}	
											if ($_REQUEST['View'] =='ATD') 
											{
												
												$Query2 =  "SELECT * 
															FROM 
																sales_order 
															LEFT JOIN sales_order_lines 
																on sales_order.LPO_NO = sales_order_lines.LPO_NO
															LEFT JOIN items 
																on sales_order_lines.Item_Code = items.Item_Code
															WHERE 
																sales_order_lines.Delivery_Available !=0 
																AND sales_order_lines.ATD !=1 
																AND sales_order_lines.LPO_NO = $LPO_NO 
															GROUP BY
																sales_order_lines.ID";
											}
											if ($_REQUEST['View'] =='Delivered') 
											{
												
												$Query2 =  "SELECT * 
															FROM 
																sales_order 
															LEFT JOIN sales_order_lines 
																on sales_order.LPO_NO = sales_order_lines.LPO_NO
															LEFT JOIN items 
																on sales_order_lines.Item_Code = items.Item_Code
															WHERE 
																sales_order_lines.Delivered_Quantities !=0 
																AND sales_order_lines.LPO_NO = $LPO_NO 
															GROUP BY
																sales_order_lines.ID";
											}
											/*Available to Promise*/
											if ($_REQUEST['View'] == 'ATP') 
											{ 
												$Query2 =  "SELECT * 
															FROM 
																sales_order 
															LEFT JOIN sales_order_lines 
																on sales_order.LPO_NO = sales_order_lines.LPO_NO
															LEFT JOIN items 
																on sales_order_lines.Item_Code = items.Item_Code
															WHERE 
																sales_order_lines.Delivery_Available + sales_order_lines.Delivered_Quantities < sales_order_lines.Quantity 
																AND sales_order_lines.LPO_NO = $LPO_NO 
															GROUP BY
																sales_order_lines.ID";
											}

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
													echo		'<td>'.$row['Quantity'].'</td>';
													echo 		'<td>'.$row['Delivered_Quantities'].'</td>';
													echo 		'<td>'.$row['Delivery_Available'].'</td>';
													if ($_REQUEST['View'] == 'ATD')
													{
														echo 	'<td>
																	<select name="ATD[]" class="form-control">
																	    <option value="0">Hold For Now</option>
																	    <option value="1">Schedule For Delivery</option>
																	</select>
																</td>';
													}
													echo 	'</tr>';

													$IDArray[]	=$row['ID'];
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
													$Update_Record = "UPDATE sales_order_lines SET ATD = '$ATD[$i]' WHERE LPO_NO = $LPO_NO and ID = $IDArray[$i]";						
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
													$Refresh = $_SERVER['PHP_SELF'].'?Report=sales-03&View=ATD';
													header("Refresh:0; url=$Refresh");
												}
											}
											?>
											</tbody>
										</table>
										<?php if ($_REQUEST['View'] == 'ATD') :?>
										<button type="Submit" class="btn btn-primary" name="Submit" id="Submit">Submit</button>
										<?php endif; ?>
									</form>		
								</div><!-- /.row -->				
							</section>
							<?php } 
							?>
						</div><!-- End Form 1 -->