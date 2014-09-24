						<?php 
							// Perform queries 
							if (isset($_REQUEST['LPO_NO']))					{$LPO_NO = $_REQUEST['LPO_NO'];}
							if (isset($_REQUEST['Delivery_Date_Start']))	{$Delivery_Date_Start = $_REQUEST['Delivery_Date_Start'];}
							if (isset($_REQUEST['Delivery_Date_End']))		{$Delivery_Date_End = $_REQUEST['Delivery_Date_End'];}
							if ($_REQUEST['View'] == 'New') 
							{ 
								$Query2 =  "SELECT *
											FROM 
												sales_order 
											LEFT JOIN sales_order_lines 
												on sales_order.LPO_NO = sales_order_lines.LPO_NO 
											LEFT JOIN items 
												on sales_order_lines.Item_Code = items.Item_Code
											WHERE 
												sales_order_lines.ATD =1 
												AND sales_order_lines.Delivery_Date_Start =''
											GROUP BY 
												sales_order_lines.ID";
								/* Page Name *************************/
								echo 	'<script language="javascript">
											document.title = "New - Sales Order | Eta Mifad";
										</script>';
								/* Page Name *************************/
							}
							elseif ($_REQUEST['View'] == 'Planned') 
							{ 
								$Query2 =  "SELECT *
											FROM 
												sales_order 
											LEFT JOIN sales_order_lines 
												on sales_order.LPO_NO = sales_order_lines.LPO_NO
											LEFT JOIN items 
												on sales_order_lines.Item_Code = items.Item_Code
											WHERE 
												sales_order_lines.ATD =1 
												AND sales_order_lines.Delivery_Date_Start !='' 
											GROUP BY 
												sales_order_lines.ID";
								/* Page Name *************************/
								echo 	'<script language="javascript">
											document.title = "Planned - Sales Order | Eta Mifad";
										</script>';
								/* Page Name *************************/
							}
							else
							{
								$Query2 =  "die";
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
									<a class="btn btn-lg btn-flat" href="<?php echo $_SERVER['PHP_SELF'].'?Report=distribution-01&View=Planned'; ?>" target="_self">
										<i class="fa fa-tasks"></i>&ensp;<small><strong> Detailed</strong></small>
									</a>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<table id="SalesOrders" class="table table-bordered">
										<thead>
											<tr>
												<th>Order ID</th>
												<th>Sales Order</th>
												<th>Creation Date</th>
												<th>Item Code</th>
												<th>Item Name</th>
												<th>Delivery Available</th>
												<th>Delivery Start Date</th>
												<th>Delivery End Date</th>
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
												echo 		'<td>'.$row['Delivery_Available'].'</td>';
												echo 		'<td>'.$row['Delivery_Date_Start'].'</td>';
												echo 		'<td>'.$row['Delivery_Date_End'].'</td>';
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
						</div><!-- End Form 1 -->