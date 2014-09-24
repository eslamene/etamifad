						<li class="dropdown notifications-menu">
							<?php
							/*Products Notifications*/
							$Items_Query		=	"SELECT 
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
							$Items_Result 		= mysqli_query($MySQLConnection,$Items_Query);
							/*End of Products Notifications*/

							/*Customers Notifications*/
							$Customers_Query	=	"SELECT 
														sales_order.Customer_NO
													FROM 
														sales_order
													LEFT JOIN sales_order_lines
														ON sales_order.LPO_NO = sales_order_lines.LPO_NO
													LEFT JOIN customers
														ON sales_order.Customer_NO = customers.Customer_NO
													WHERE 
														customers.Customer_NO IS NULL 
													GROUP BY 
														sales_order.Customer_NO";
							$Customers_Result 	= mysqli_query($MySQLConnection,$Customers_Query);
							/*End of Customers Notifications*/
							?>

							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-warning"></i>
								<?php  
									echo '<span class="label label-warning">'.((mysqli_num_rows($Items_Result))+(mysqli_num_rows($Customers_Result))).'</span>';
								?>
							</a>
							<ul class="dropdown-menu">
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<?php if (mysqli_num_rows($Customers_Result)>=1) : ?>
										<li>
											<a href="#">
												<i class="ion ion-ios7-people warning"></i> <?php echo mysqli_num_rows($Customers_Result); ?> Unregistered Customers 
											</a>
										</li>
										<?php endif; ?>
										<?php if (mysqli_num_rows($Items_Result)>=1) : ?>
										<li>
											<a href="#">
												<i class="ion ion-ios7-cart danger"></i> <?php echo mysqli_num_rows($Items_Result); ?> Unregistered Customers
											</a>
										</li>
										<?php endif; ?>
									</ul>
								</li>
								<!-- <li class="footer"><a href="#">View all</a></li> -->
							</ul>
						</li>