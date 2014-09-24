				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
					<div class="user-panel">
						<div class="pull-left image">
							<img src="<?php echo 'img/avatar/'.$_SESSION['Avatar'].'.png'; ?>" class="img-circle" alt="User Image" />
						</div>
						<div class="pull-left info">
							<p>Hello, <?php echo $_SESSION["First_Name"] ?></p>
							<p><?php echo $_SESSION["Department"] ?></p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div>
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						<?php 

							function Notification_Count($ID)
							{

								global $MySQLConnection;
								$Query	="SELECT COUNT FROM (
								SELECT @ID:=1 AS ID, COUNT(*) AS COUNT, @Note:='Sales / Finance - Sales Order - Rejected' AS Note 
								FROM sales_order 
								WHERE Approve = 'Rejected' or Approve = 'Pending'

								UNION ALL

								SELECT @ID:=2 AS ID, COUNT(*) AS COUNT, @Note:='Sales - Sales Order - Archived' AS Note 
								FROM sales_order 
								WHERE Approve != 'Hidden'

								UNION ALL

								SELECT @ID:=3 AS ID, COUNT(*) AS COUNT, @Note:='Finance - Sales Order - New Request' AS Note 
								FROM sales_order 
								WHERE Approve = ''

								UNION ALL

								SELECT @ID:=4 AS ID, COUNT(DISTINCT(sales_order.LPO_NO)) AS COUNT, @Note:='Sales / Distribution - Sales Order - Sent / Received' AS Note 
								FROM sales_order
								LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO 
								LEFT JOIN customers ON sales_order.Customer_NO = customers.Customer_NO 
								WHERE sales_order_lines.ATD =1 AND sales_order_lines.Delivery_Date_Start =''

								UNION ALL

								SELECT @ID:=5 AS ID, COUNT(DISTINCT(sales_order.LPO_NO)) AS COUNT, @Note:='Sales - Sales Order - Available to Delivery' AS Note 
								FROM sales_order 
								LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO
								WHERE sales_order.Approve = 'Accepted' AND sales_order_lines.Delivery_Available !=0 AND sales_order_lines.ATD !=1
								
								UNION ALL

								SELECT @ID:=6 AS ID, COUNT(DISTINCT(sales_order.LPO_NO)) AS COUNT, @Note:='Sales / Distribution - Sales Order - Delivery - Planned' AS Note 
								FROM sales_order 
								LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO 
								LEFT JOIN customers ON sales_order.Customer_NO = customers.Customer_NO 
								WHERE sales_order_lines.ATD =1 AND sales_order_lines.Delivery_Date_Start !=''

								UNION ALL

								SELECT @ID:=7 AS ID, COUNT(DISTINCT(sales_order.LPO_NO)) AS COUNT, @Note:='Warehouse - Sales Order - New' AS Note 
								FROM sales_order 
								LEFT JOIN sales_order_lines on sales_order.LPO_NO = sales_order_lines.LPO_NO
								WHERE sales_order.Approve = 'Accepted' AND sales_order_lines.Delivery_Available =0 AND sales_order_lines.Delivered_Quantities =0  AND sales_order_lines.Notes_Warehouse =''

								UNION ALL

								SELECT @ID:=8 AS ID, COUNT(DISTINCT(sales_order.LPO_NO)) AS COUNT, @Note:='Warehouse - Sales Order - Available to Promise' AS Note 
								FROM sales_order 
								LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO
								WHERE sales_order.Approve = 'Accepted' AND sales_order_lines.Delivery_Available + sales_order_lines.Delivered_Quantities < sales_order_lines.Quantity

								UNION ALL

								SELECT @ID:=9 AS ID, COUNT(DISTINCT(sales_order.LPO_NO)) AS COUNT, @Note:='Warehouse- Sales Order - Available to Delivery' AS Note 
								FROM sales_order 
								LEFT JOIN sales_order_lines ON sales_order.LPO_NO = sales_order_lines.LPO_NO
								WHERE sales_order.Approve = 'Accepted' AND sales_order_lines.Delivery_Available !=0
								
								UNION ALL

								SELECT @ID:=10 AS ID, COUNT(DISTINCT(sales_order.LPO_NO)) AS COUNT, @Note:='Distribution - Sales Order - Delivery - New' AS Note 
								FROM sales_order
								LEFT JOIN sales_order_lines on sales_order.LPO_NO = sales_order_lines.LPO_NO 
								LEFT JOIN customers on sales_order.Customer_NO = customers.Customer_NO 
								WHERE sales_order_lines.ATD =1 and sales_order_lines.Delivery_Date_Start =''
								) AS COUNT WHERE ID=".$ID;
								$Result = mysqli_query($MySQLConnection,$Query);
								while ($row = $Result->fetch_assoc())
								if ($row['COUNT'] > 0)
								{
									Return $row['COUNT'];
								}

							}
							function display_children($Parent, $Level) 
							{
								global $MySQLConnection;
								$Query2 = "SELECT a.ID, a.Label, a.Link , a.Icon, a.Notification, a.Permission, Deriv1.Count FROM `menu` a  LEFT OUTER JOIN (SELECT Parent, COUNT(*) AS Count FROM `menu` GROUP BY Parent) Deriv1 ON a.ID = Deriv1.Parent WHERE a.Enable=1 AND a.Parent=".$Parent;
								$Result = mysqli_query($MySQLConnection,$Query2);
								while ($row = $Result->fetch_assoc()) 
								{
									if ($row['Count'] > 0) 
									{
										$Permission= explode(",",$row['Permission']);
										if (in_array($_SESSION['Department'], $Permission))
										{
											echo "<li class='treeview'>";
											echo "<a href='".$row['Link']."'>"."<i class=\"".$row['Icon']."\"></i><i class=\"fa fa-plus pull-right\"></i>"."<small class=\"badge pull-right bg-green\">".Notification_Count($row['Notification'])."</small>".$row['Label']."</a>";
											echo "<ul class=\"treeview-menu\">";
											display_children($row['ID'], $Level + 1);
											echo "</ul>";
											echo "</li>";
										}
									} 
									elseif ($row['Count']==0) 
									{
										$Permission= explode(",",$row['Permission']);
										if (in_array($_SESSION['Department'], $Permission))
										{
											echo "<li class='treeview'>";
											echo "<li><a href='".$row['Link']."'>"."<i class=\"".$row['Icon']."\"></i><small class=\"badge pull-right bg-green\">".Notification_Count($row['Notification'])."</small>".$row['Label']."</a></li>";
											echo "</li>";
										}
									} 
									else;
								}
							}
						display_children(0, 1);
						?>
				</section>
				<!-- /.sidebar -->