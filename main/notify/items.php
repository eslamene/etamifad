						<!-- /*******/ Page Name /*******/ -->
						<script language="javascript">
							document.title = "Confirm - Distribution | Eta Mifad";
						</script>
						<!-- /*******/ Page Name /*******/ -->
						<?php 
						$Items_Query	=	"SELECT 
												sales_order_lines.Item_Code
											FROM 
												sales_order
											LEFT JOIN sales_order_lines 
												ON sales_order.LPO_NO = sales_order_lines.LPO_NO
											LEFT JOIN items 
												ON sales_order_lines.Item_Code = items.Item_Code
											WHERE 
												items.Item_Code IS NULL 
											GROUP BY 
												sales_order_lines.Item_Code";
						$Items_Result 	= mysqli_query($MySQLConnection,$Items_Query);
						/*End of Products Notifications*/
						if ($Result = mysqli_query($MySQLConnection,$Items_Query))
						{
							$i=0;
							$Items_Missed = array();
							while ($row = $Items_Result->fetch_assoc())
							{
								$Items_Missed[] = $row['Item_Code'];
								$i++;
							}
							
							$Items_Missed = "ITEM_CODE = '".implode("' OR ITEM_CODE = '", $Items_Missed)."'";

							$MSSQLConnection = odbc_connect("Driver={SQL Server};Server=$SQLServer;Database=$SQLDatabase;", $SQLUser, $SQLPassword);
							if ($MSSQLConnection) 
							{	

								//the SQL statement that will query the database 
								$MSQuery =	"SELECT 
												ITEM_CODE
						    					,ITEM_NAME
						    				FROM 
						    					[$SQLDatabase].[dbo].[MAIN_ITEM] 
						    				WHERE 
						    					$Items_Missed;"; 
								//perform the query 
								$MSResult=odbc_exec($MSSQLConnection, $MSQuery);

								
								/*if (odbc_num_rows($MSResult)==0)//check if there's a new results
								{
									echo "Empty";
								}*/
								?>
								<!-- Form 1 -->
								<div class="col-md-12">
									<!-- general form elements disabled -->
									<div class="box box-primary">
										<div class="box-header">
											<h3 class="box-title">General Elements</h3>
										</div><!-- /.box-header -->
										<div class="box-body">
											<!-- Show Sales Order Lines Table -->
											<form role="form" action="<?php echo $_SERVER['PHP_SELF'].'?Notify='.$_REQUEST['Notify']; ?>" id="sales" method="post">
												<input type="hidden" class="form-control" name="ID" value="<?php echo $Page; ?>"/>
												<table id="SalesOrdersLines" class="table table-bordered">
													<thead>
														<tr>
															<th>Item Code</th>
															<th>Item Name</th>
															<th>Unit</th>
															<th>Unit Value</th>
														</tr>
													</thead>
													<tbody>
													<?php
													while( $row = odbc_fetch_array($MSResult)) 
													{
														$Item_Code		= $row['ITEM_CODE'];
														$Item_Name		= iconv("windows-1256", "utf-8//TRANSLIT//IGNORE", $row['ITEM_NAME']);//arabic
														echo 	'<tr>';
														echo 		'<td>'.$Item_Code.'</td>';
														echo		'<td>'.$Item_Name.'</td>';
														echo 		'<td><input type="text" name="Unit[]" class="form-control" Required></td>';
														echo 		'<td><input type="number" name="Unit_Value[]" class="form-control" min="0" Required></td>';
														echo 	'</tr>';


														if (isset($_REQUEST['Submit']))
														{
															for($n = 0; $n <count($MSResult); $n++)
															{
																/*add fetched data to MySql*/
																$New_Record = ("INSERT INTO items 	(Item_Code, Item_Name, Unit_Value, Unit, Company) 
																									VALUES 
																									('$Item_Code', '$Item_Name', '".$_REQUEST['Unit_Value[]'][$n]."','".$_REQUEST['Unit[]'][$n]."', '$SQLDatabaseCompany')");
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
															/*header("Refresh:0");*/
															}
														}
													}
													?>
													</tbody>
													</table>
													<button type="Submit" class="btn btn-primary" name="Submit" id="Submit">Submit</button>
												</form>		
											</div><!-- /.box-body -->
										</div><!-- /.box -->
									</div><!-- End Form 1 -->
								<?php

							}
						}
						?>
