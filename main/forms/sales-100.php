						<!-- /*******/ Page Name /*******/ -->
						<script language="javascript">
							document.title = "???????? - Sales Forecast | Eta Mifad";
						</script>
						<!-- /*******/ Page Name /*******/ -->

						<!-- Form 1 -->
						<div class="col-md-12">

							<?php 
							/*******************************/
							/*Begin to select foreacst year*/
							/*******************************/
							if (empty($_REQUEST['View']))
							{
							?>
							<div class="box box-primary">
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
									header('Location: '. $_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&View='.$_REQUEST['Goto_Year']);
								}
							}
							/********************************/
							/*end of forecast year selection*/
							/********************************/

							/*if year has been selected show following*/
							if (isset($_REQUEST['View'])) 
							{
							?>
                            <!-- AREA CHART -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Line Chart</h3>
                                </div>
                                <div class="box-body chart-responsive">
                                    <div class="chart" id="line-chart" style="height: 300px;"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
							<?php
							}
							?>	
							</div>
						</div><!-- End Form 1 -->





<?php 
/*$View = $_REQUEST['View'];
$Query1 =  "SELECT items.*, customers.*, members.*, sales_forecast.*,
SUM(M_01) AS SUM_M_01,
SUM(M_02) AS SUM_M_02,
SUM(M_03) AS SUM_M_03,
SUM(Q_01) AS SUM_Q_01,
SUM(M_04) AS SUM_M_04,
SUM(M_05) AS SUM_M_05,
SUM(M_06) AS SUM_M_06,
SUM(Q_02) AS SUM_Q_02,
SUM(M_07) AS SUM_M_07,
SUM(M_08) AS SUM_M_08,
SUM(M_09) AS SUM_M_09,
SUM(Q_03) AS SUM_Q_03,
SUM(M_10) AS SUM_M_10,
SUM(M_11) AS SUM_M_11,
SUM(M_12) AS SUM_M_12,
SUM(Q_04) AS SUM_Q_04,
items.Company AS I_Company 
FROM sales_forecast
LEFT JOIN customers on sales_forecast.Customer_NO = customers.Customer_NO
LEFT JOIN members on sales_forecast.Representative_NO = members.ID
LEFT JOIN items on sales_forecast.Item_Code = items.Item_Code
WHERE sales_forecast.Year = $View
GROUP BY sales_forecast.Item_Code";

// Perform queries 
if ($Result = mysqli_query($MySQLConnection,$Query1))
{
  // Fetch one and one row
  while ($row = $Result->fetch_assoc())
	{
		echo 	'<tr>';
		echo 		'<td>'.'<a href="'.$_SERVER['PHP_SELF'].'?Report='.$_REQUEST['Report'].'&View='.$_REQUEST['View'].'&Item='.$row['Item_Code'].'">'.$row['Item_Code'].'</a></td>';
		echo		'<td>'.$row['Item_Name'].'</td>';
		echo		'<td>'.$row['I_Company'].'</td>';
		echo		'<td><b>'.$row['Year'].'</b></td>';
		echo 		'<td>'.$row['SUM_M_01'].'</td>';
		echo 		'<td>'.$row['SUM_M_02'].'</td>';
		echo 		'<td>'.$row['SUM_M_03'].'</td>';
		echo 		'<td><b>'.$row['SUM_Q_01'].'</b></td>';
		echo 		'<td>'.$row['SUM_M_04'].'</td>';
		echo 		'<td>'.$row['SUM_M_05'].'</td>';
		echo 		'<td>'.$row['SUM_M_06'].'</td>';
		echo 		'<td><b>'.$row['SUM_Q_02'].'</b></td>';
		echo 		'<td>'.$row['SUM_M_07'].'</td>';
		echo 		'<td>'.$row['SUM_M_08'].'</td>';
		echo 		'<td>'.$row['SUM_M_09'].'</td>';
		echo 		'<td><b>'.$row['SUM_Q_03'].'</b></td>';
		echo 		'<td>'.$row['SUM_M_10'].'</td>';
		echo 		'<td>'.$row['SUM_M_11'].'</td>';
		echo 		'<td>'.$row['SUM_M_12'].'</td>';
		echo 		'<td><b>'.$row['SUM_Q_04'].'</b></td>';
		echo 	'</tr>';
	}
  // Free Result set
  mysqli_free_Result($Result);
}*/
 ?>



				<!-- jQuery 2.0.2 -->
				<script src="js/jquery.min.js" type="text/javascript"></script>
				<!-- Bootstrap -->
				<script src="js/bootstrap.min.js" type="text/javascript"></script>
       <!-- Morris.js charts -->
        <script src="js/plugins/morris/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>


                <!-- page script -->
        <script type="text/javascript">
            $(function() {
                "use strict";

                // LINE CHART
                var line = new Morris.Line({
                    element: 'line-chart',
                    resize: true,
                    data: [
                        {y: '2014-01', a: 2666, b: 1213},
                        {y: '2014-02', a: 2778, b: 1713},
                        {y: '2014-03', a: 4912, b: 8213},
                        {y: '2014-04', a: 3767, b: 1213},
                        {y: '2014-05', a: 6810, b: 1213},
                        {y: '2014-06', a: 5670, b: 1213},
                        {y: '2014-07', a: 4820, b: 5213},
                        {y: '2014-08', a: 15073, b: 1213},
                        {y: '2014-09', a: 10687, b: 1213},
                        {y: '2014-10', a: 8432, b: 1713},
                        {y: '2014-11', a: 8432, b: 5213},
                        {y: '2014-12', a: 8432, b: 1713}
                    ],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Series A', 'Series B'],
                    lineColors: ['#3c8dbc', '#888888'],
                    hideHover: 'auto'
                });


            });
        </script>