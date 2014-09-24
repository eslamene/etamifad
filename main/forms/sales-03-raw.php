						<?php 
							// Perform queries 
							if (isset($_REQUEST['Delivery_Available']))		{$Delivery_Available = $_REQUEST['Delivery_Available'];}
							if (isset($_REQUEST['Notes_Warehouse']))		{$Notes_Warehouse = $_REQUEST['Notes_Warehouse'];}	
							if ($_REQUEST['View'] == 'New') 
							{ 
								$Query2 =	"SELECT *
											FROM 
												sales_order 
											LEFT JOIN sales_order_lines 
												on sales_order.LPO_NO = sales_order_lines.LPO_NO 
											LEFT JOIN items 
												on sales_order_lines.Item_Code = items.Item_Code
											WHERE 
												sales_order_lines.Delivery_Available =0 
												AND sales_order_lines.Delivered_Quantities =0 
											Group By 
												sales_order_lines.ID";
								/* Page Name *************************/
								echo 	'<script language="javascript">
											document.title = "New - Sales Order | Eta Mifad";
										</script>';
								/* Page Name *************************/
							}
							elseif ($_REQUEST['View'] == 'ATP') 
							{ 
								$Query2 =	"SELECT *
											FROM 
												sales_order 
											LEFT JOIN sales_order_lines 
												on sales_order.LPO_NO = sales_order_lines.LPO_NO
											LEFT JOIN items 
												on sales_order_lines.Item_Code = items.Item_Code
											WHERE 
												sales_order_lines.Delivery_Available + sales_order_lines.Delivered_Quantities < sales_order_lines.Quantity 
											Group By 
												sales_order_lines.ID";
								/* Page Name *************************/
								echo 	'<script language="javascript">
											document.title = "Available to Promise - Sales Order | Eta Mifad";
										</script>';
								/* Page Name *************************/
							}
							elseif ($_REQUEST['View'] == 'ATD') 
							{ 
								$Query2 =	"SELECT *
											FROM 
												sales_order 
											LEFT JOIN sales_order_lines 
												on sales_order.LPO_NO = sales_order_lines.LPO_NO
											LEFT JOIN items 
												on sales_order_lines.Item_Code = items.Item_Code
											WHERE 
												sales_order_lines.Delivery_Available !=0 
											Group By 
												sales_order_lines.ID";
								/* Page Name *************************/
								echo 	'<script language="javascript">
											document.title = "Available to Deliver - Sales Order | Eta Mifad";
										</script>';
								/* Page Name *************************/
							}
							elseif ($_REQUEST['View'] =='Archived') 
							{
								$Query2 =  "SELECT *
											FROM 
												sales_order 
											LEFT JOIN sales_order_lines 
												on sales_order.LPO_NO = sales_order_lines.LPO_NO
											LEFT JOIN items 
												on sales_order_lines.Item_Code = items.Item_Code
											WHERE 
												sales_order.Approve != 'Hidden' 
											Group By 
												sales_order_lines.ID";
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
						?>
						<!-- Form 1 -->
						<div class="col-md-12">
							<!-- general form elements disabled -->
							<!-- Primary -->
							<div class="box box-solid box-primary" id="first_div">
								<!-- Box Tools -->
								<div class="box-header">
									<!-- tools box -->
									<div class="pull-left box-tools">
										<button class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
										<button class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
									</div><!-- /. tools -->
									<h3 class="box-title"><script type="text/javascript">document.write(document.title);</script></h3>
									<a class="btn btn-lg btn-flat" href="<?php echo $_SERVER['PHP_SELF'].'?Report=sales-03&View='.$_REQUEST['View']; ?>" target="_self">
										<i class="glyphicon glyphicon-transfer"></i>&ensp;<small><strong> Detailed</strong></small>
									</a>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
							<div class="box box-primary">
								<div class="box-header">
									
								</div><!-- /.box-header -->							 
								<div class="box-body">
									<!-- Show Sales Order Lines Table -->
									<form role="form" id="sales" method="post">
										<table id="SalesOrders" class="table table-bordered">
											<thead>
												<tr>
													<th>Order ID</th>
													<th>Sales Order</th>
													<th>Sales Date</th>
													<th>Item Code</th>
													<th>Item Name</th>
													<th>Quantity</th>
													<th>Delivered Quantities</th>
													<th>Delivery Available</th>
													<th>Notes</th>
												</tr>
											</thead>
											<tbody>						
												<?php 										
												if ($Result = mysqli_query($MySQLConnection,$Query2))
												{
												  // Fetch one and one row
												  while ($row = $Result->fetch_assoc())
													{
															echo 	'<tr>';
															echo 		'<td>'.$row['ID'].'</td>';
															echo 		'<td>'.$row['LPO_NO'].'</td>';
															echo 		'<td>'.$row['LPO_Date'].'</td>';
															echo		'<td>'.$row['Item_Code'].'</td>';
															echo		'<td>'.$row['Item_Name'].'</td>';
															echo		'<td>'.$row['Quantity'].'</td>';
															echo		'<td>'.$row['Delivered_Quantities'].'</td>';
															echo 		'<td>'.$row['Delivery_Available'].'</td>';
															echo 		'<td>'.$row['Notes_Warehouse'].'</td>';
															echo 	'</tr>';

															$LPO_NO[] = $row['LPO_NO'];
															$IDArray[]=$row['ID'];
													}
												  // Free Result set
												  mysqli_free_Result($Result);
												}
												?>
											</tbody>
										</table>
									</form>		
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</div><!-- End Form 1 -->