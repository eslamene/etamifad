						<!-- /*******/ Page Name /*******/ -->
						<script language="javascript">
							document.title = "Get New - Sales Order | Eta Mifad";
							document.characterSet = "Windows-1256";
						</script>
						<!-- /*******/ Page Name /*******/ -->
						
						<?php 
							#End of Page Name for sidebar
						    header ('Content-type: text/html; charset=Windows-1256');
						?>
						<!-- Form 1 -->
						<div class="col-md-12">
							<!-- general form elements disabled -->
							<!-- success -->
							<div class="box box-solid box-success" id="first_div">
								<!-- Box Tools -->
								<div class="box-header">
									<!-- tools box -->
									<div class="pull-left box-tools">
										<button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
										<button class="btn btn-success btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
									</div><!-- /. tools -->
									<h3 class="box-title"><script type="text/javascript">document.write(document.title);</script></h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
								 
									<form role="form" action="<?php echo $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&View='.$_REQUEST['View']; ?>" id="sales" method="post">
										<!-- text input -->
										<div class="form-group">
											<label>
												<input type="radio" name="DB_Name" class="flat-green" value="<?php echo $SQLDatabase; ?>" checked/>
												<p class="btn bg-green btn margin"><?php echo $SQLDatabaseAlias; ?></p>
											</label>                                    		
										</div>
										<div class="form-group">
											<label>Sales Order Number</label>
											<input type="text" class="form-control" name="SO_Number" placeholder="Enter sales order number..." autocomplete="off"/>
										</div>
										<div class="box-footer">
											<button type="Submit" class="btn btn-primary" name="Submit" id="Submit">Submit</button>
										</div>
									</form>
								</div>
							</div>

							<?php 
								/*$MSSQLConnection = odbc_connect("Driver={SQL Server};Server=$SQLServer;Database=$SQLDatabase;", $SQLUser, $SQLPassword);*/
								$MSSQLConnection = mssql_connect($SQLServer, $SQLUser, $SQLPassword);
								if ($MSSQLConnection != FALSE) 
								{ 	
									echo "connected";
									if (isset($_REQUEST['Submit']))
									{  
										$DB_Name 	= $_REQUEST['DB_Name'];
										$SO_Number 	= $_REQUEST['SO_Number'];
										//the SQL statement that will query the database 
										$Query = "SELECT * FROM [$DB_Name].[dbo].[AAR1472] WHERE LPO_NO = $SO_Number";
										//perform the query 
										$Result=odbc_exec($MSSQLConnection, $Query);
										while( $row = odbc_fetch_array($Result)) 
										{	
											
											$LPO_NO				= $row['LPO_NO'];
											$CUSTOMER_NO		= $row['CUSTOMER_NO'];
											$LPO_DATE			= $row['LPO_DATE'];
											$TR_VALUE			= $row['TR_VALUE'];
											$LPO_TOTAL			= $row['LPO_TOTAL'];
							
											/*add fetched data to MySql*/
											$New_Record = ("INSERT INTO sales_order 	(LPO_NO, DB_Name, CUSTOMER_NO, LPO_DATE, TR_VALUE, LPO_TOTAL) 
																						VALUES 
																						('$LPO_NO', '$DB_Name', '$CUSTOMER_NO', '$LPO_DATE', '$TR_VALUE', '$LPO_TOTAL')");
											if (!$stmt = $MySQLConnection->prepare($New_Record))
											{
												die('<div class="alert alert-danger alert-dismissable">
															<i class="fa fa-ban"></i>
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
															<b>Query failed: </b>'
															.$MySQLConnection->errno.$MySQLConnection->error.
															'</div>');
												exit();
											}
							
											if (!$stmt->execute())
											{
												die('<div class="alert alert-danger alert-dismissable">
														<i class="fa fa-ban"></i>
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<b>Insert Error: </b>'
														. $MySQLConnection->error.
													'</div>');
												exit();
											}
											/*Insert Sales Orders Item Lines*/
											  //the SQL statement that will query the database 

							?>
								<div class="alert alert-info alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h3 class="box-title">Successful Copied Recordes</h3>
									<hr>
									<!-- general form elements disabled -->
									<div class="box box-primary">
										<div class="box-body">						
											<div class="box-body">
												<table id="GetSalesOrders" class="table table-bordered">
													<thead>
														<tr>
															<th>Sales Order</th>
															<th>Sales Order Date</th>
															<th>Customer NO</th>
															<th>Item Code</th>
															<th>Quantity</th>
															<th>Price</th>
															<th>Cost</th>
														</tr>
													</thead>
													<tbody>
							<?php
													$Query1 = "SELECT * FROM [$DB_Name].[dbo].[AAR1472] WHERE LPO_NO = $SO_Number";
													/*ROM [ETALTD_2014].[dbo].[LPO]*/
													//perform the query 
													$Result1=odbc_exec($MSSQLConnection, $Query1);
													while( $row = odbc_fetch_array($Result1)) 
													{	
															
														$LPO_NO 			= $row['LPO_NO'];
														$LPO_Date			= $row['LPO_DATE'];
														$Customer_NO 		= $row['CUSTOMER_NO'];
														$Item_Code 			= $row['ITEM_CODE'];
														$Quantity 			= $row['QUANTITY'];
														$Price 				= $row['PRICE'];
														$Cost 				= $row['Cost'];
									
														/*add fetched data to MySql*/
														$New_Record = ("INSERT INTO sales_order_lines 	(LPO_NO, DB_Name, LPO_Date, Customer_NO, Item_Code, Quantity, Price, Cost) 
																										VALUES 
																										('$LPO_NO', '$DB_Name','$LPO_Date', '$Customer_NO', '$Item_Code', '$Quantity', '$Price', '$Cost')");
	
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
														
															echo 	'<tr>';
															/*add all table variables to URL for calling them later*/
															echo 		'<td>'.$LPO_NO.'</td>';
															echo 		'<td>'.date('Y/m/d', strtotime($LPO_Date)).'</td>';
															echo		'<td>'.$Customer_NO.'</td>';
															echo  		'<td>'.$Item_Code.'</td>';
															echo  		'<td>'.number_format($Quantity).'</td>';
															echo  		'<td>'.number_format($Price,2).'</td>';
															echo  		'<td>'.number_format($Cost,2).'</td>';
															echo 	'</tr>';
													}
							?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							<?php

											break;
										}
									} 
								} 

								else	echo "odbc not connected";
							?>
						</div><!-- End Form 1 -->