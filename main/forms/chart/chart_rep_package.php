<?php 
$Query3 =  "SELECT sales_forecast.ID
			, sales_forecast.Representative_NO
			, sales_forecast.Year
			, concat(members.First_Name, ' ', members.Second_Name) AS Representative_Name
			, sum(sales_forecast.M_01) 	AS SUM_M_01
			, sum(sales_forecast.M_02) 	AS SUM_M_02
			, sum(sales_forecast.M_03) 	AS SUM_M_03
			, sum(sales_forecast.M_04) 	AS SUM_M_04
			, sum(sales_forecast.M_05) 	AS SUM_M_05
			, sum(sales_forecast.M_06) 	AS SUM_M_06
			, sum(sales_forecast.M_07) 	AS SUM_M_07
			, sum(sales_forecast.M_08) 	AS SUM_M_08
			, sum(sales_forecast.M_09) 	AS SUM_M_09
			, sum(sales_forecast.M_10) 	AS SUM_M_10
			, sum(sales_forecast.M_11) 	AS SUM_M_11
			, sum(sales_forecast.M_12) 	AS SUM_M_12
			FROM
				sales_forecast
			INNER JOIN items
				ON sales_forecast.Item_Code = items.Item_Code
			INNER JOIN members
				ON sales_forecast.Representative_NO = members.ID
			$WHERE
			GROUP BY
				sales_forecast.Representative_NO";
// Perform queries 
if ($Result = mysqli_query($MySQLConnection,$Query3))
{
// Fetch one and one row
	echo "data: [";
	$row = $Result->fetch_assoc();
		echo "{y: '".$row['Year']."-01', a: ".$row['SUM_M_01']."},";
		echo "{y: '".$row['Year']."-02', a: ".$row['SUM_M_02']."},";
		echo "{y: '".$row['Year']."-03', a: ".$row['SUM_M_03']."},";
		echo "{y: '".$row['Year']."-04', a: ".$row['SUM_M_04']."},";
		echo "{y: '".$row['Year']."-05', a: ".$row['SUM_M_05']."},";
		echo "{y: '".$row['Year']."-06', a: ".$row['SUM_M_06']."},";
		echo "{y: '".$row['Year']."-07', a: ".$row['SUM_M_07']."},";
		echo "{y: '".$row['Year']."-08', a: ".$row['SUM_M_08']."},";
		echo "{y: '".$row['Year']."-09', a: ".$row['SUM_M_09']."},";
		echo "{y: '".$row['Year']."-10', a: ".$row['SUM_M_10']."},";
		echo "{y: '".$row['Year']."-11', a: ".$row['SUM_M_11']."},";
		echo "{y: '".$row['Year']."-12', a: ".$row['SUM_M_12']."},";
	echo "],";
	echo "xkey: 'y',";
	echo "ykeys: ['a'],";
	echo "labels: ['".$row['Representative_Name'].' '."'],";
	echo "lineColors: ['rgba(224, 24, 24, 0.8)'],";
	echo "hideHover: 'auto'";
	 // Free Result set
mysqli_free_Result($Result);
}
?>