						<?php 
							/*Create a query by View filter*/
							if (isset($_REQUEST['View']))
							{
								if 		($_REQUEST['View'] == 'New') 		
								{ 
									$Query1 = "SELECT * FROM sales_order left join customers on sales_order.Customer_NO=customers.Customer_NO WHERE Approve != 'Hidden' AND Approve = ''";
									/* Page Name *************************/
									echo 	'<script language="javascript">
												document.title = "New - Sales Order | Eta Mifad";
											</script>';
									/* Page Name *************************/
								}
								elseif ($_REQUEST['View'] == 'Rejected') 	
								{ 
									$Query1 = "SELECT * FROM sales_order left join customers on sales_order.Customer_NO=customers.Customer_NO WHERE Approve = 'Rejected' OR Approve = 'Pending'";
									/* Page Name *************************/
									echo 	'<script language="javascript">
												document.title = "Rejected - Sales Order | Eta Mifad";
											</script>';
									/* Page Name *************************/
								}
								elseif ($_REQUEST['View'] == 'Archived') 	
								{ 
									$Query1 = "SELECT * FROM sales_order left join customers on sales_order.Customer_NO=customers.Customer_NO WHERE Approve != 'Hidden'";
									/* Page Name *************************/
									echo 	'<script language="javascript">
												document.title = "Archived - Sales Order | Eta Mifad";
											</script>';
									/* Page Name *************************/
								}
								else
								{
									$Query1 =  "die";
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

											$Page		='';
											$Approve	='';
											if (isset($_REQUEST['Page'])) 				{$Page		= $_REQUEST["Page"];}
											if (isset($_REQUEST['ID']))					{$ID 		= $_REQUEST['ID'];}
											if (isset($_REQUEST['Approve']))			{$Approve 	= $_REQUEST['Approve'];}
											if (isset($_REQUEST['Reason']))				{$Reason 	= $_REQUEST['Reason'];}
											if (isset($_SESSION['UserName']))			{$UserName 	= $_SESSION['UserName'];}
											if (isset($_REQUEST['Submit']))
											{
												/*checking for requirements before submition*/
												if ($Approve =='') 
												{
													echo 
														'<br>
														<div class="alert alert-danger alert-dismissable">
															<i class="fa fa-ban"></i>
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
															<b>Alert!</b> you have to submit approval option.
														</div>';
												}														
												/*Submit Button after checking requirements*/
												elseif ($Approve !='') 
												{
													/*Update condtional Approval*/
													$Update_Record = "UPDATE sales_order SET Approve = '$Approve', Reason = '$Reason', Approved_By = '$UserName', Approval_Date = NOW() WHERE ID = '$ID' and Approve !='Accepted'";
											
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
			
														header('Location: '. $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&View='.$_REQUEST['View']);
												}
											}
										?>

										</tbody>
									</table>
								</div><!-- /.box-body -->
							</div><!-- /.box -->


							<!-- if page has been selected show following -->
							<?php if($Page !='' and $_REQUEST['Approve'] !='Accepted'){ ?>
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
									<table id="SalesOrdersLines" class="table table-bordered">
										<thead>
											<tr>
												<th>Sales Order</th>
												<th>Item Code</th>
												<th>Item Name</th>
												<th>Quantity</th>
												<th>Item Price</th>
												<th>Total Price</th>
												<th>DB Name</th>
											</tr>
										</thead>
										<tbody>						
										<?php 
										$LPO_NO 	= $_REQUEST['LPO_NO'];
										// Perform queries 
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
										
										if ($Result = mysqli_query($MySQLConnection,$Query2))
										{
										  // Fetch one and one row
										  while ($row = $Result->fetch_assoc())
											{
												echo 	'<tr>';
												echo 		'<td>'.$row['LPO_NO'].'</td>';
												echo		'<td>'.$row['Item_Code'].'</td>';
												echo		'<td>'.$row['Item_Name'].'</td>';
												echo		'<td>'.$row['Quantity'].'</td>';
												echo 		'<td>'.$Currency_Symbol.$row['Price'].'</td>';
												echo 		'<td>'.$Currency_Symbol.$row['Cost'].'</td>';
												echo 		'<td>'.$row['DB_Name'].'</td>';
												echo 	'</tr>';
											}
										  // Free Result set
										  mysqli_free_Result($Result);
							
										}		
										?>
										</tbody>
									</table>
								</div><!-- /.row -->




								<form role="form" action="<?php echo $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&View='.$_REQUEST['View']; ?>" id="sales" method="post">
									<!-- text input -->
									<div class="">
										<input type="hidden" class="form-control" name="ID" value="<?php echo $Page; ?>"/>
									</div>

									<div class="form-group">
										<label>
											<input type="radio" name="Approve" class="flat-green" value="Accepted"/>
											<p class="btn bg-green btn margin">Accepted</p>
										</label>
										<label>
											<input type="radio" name="Approve" class="flat-red" value="Rejected"/>
											<p class="btn bg-red btn margin">Rejected</p>
										</label>
										<label>
											<input type="radio" name="Approve" class="flat-purple" value="Pending"/>
											<p class="btn bg-purple btn margin">Pending</p>
										</label>                                        		
									</div>

									<div class="form-group">
										<label>Comment</label>
										<textarea class="form-control" name="Reason" rows="3" placeholder="write your comments ..."></textarea>
									</div>

									<div class="box-footer">
										<button type="Submit" class="btn btn-primary" name="Submit" id="Submit">Submit</button>
									</div>
				
								</form>		
							</section>

							<?php } 
								if (isset($_REQUEST['Approve'])) 
								{
							
									if ($_REQUEST['Approve'] == 'Accepted') 
										{
											echo 	'<div class="alert alert-danger alert-dismissable">
														<i class="fa fa-ban"></i>
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<b>Error: </b> You Can not edit accepted request
													</div>';
										}
								}
							?>

							</div>

				
						</div><!-- End Form 1 -->