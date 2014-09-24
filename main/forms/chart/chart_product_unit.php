<?php 
$Query3 =  "SELECT sales_forecast.ID
			, sales_forecast.Item_Code
			, items.Item_Name
			, items.Unit_Value
			, items.Unit
			, sales_forecast.Year
			, sum(sales_forecast.M_01 * items.Unit_Value) 	AS SUM_M_01
			, sum(sales_forecast.M_02 * items.Unit_Value) 	AS SUM_M_02
			, sum(sales_forecast.M_03 * items.Unit_Value) 	AS SUM_M_03
			, sum(sales_forecast.M_04 * items.Unit_Value) 	AS SUM_M_04
			, sum(sales_forecast.M_05 * items.Unit_Value) 	AS SUM_M_05
			, sum(sales_forecast.M_06 * items.Unit_Value) 	AS SUM_M_06
			, sum(sales_forecast.M_07 * items.Unit_Value) 	AS SUM_M_07
			, sum(sales_forecast.M_08 * items.Unit_Value) 	AS SUM_M_08
			, sum(sales_forecast.M_09 * items.Unit_Value) 	AS SUM_M_09
			, sum(sales_forecast.M_10 * items.Unit_Value) 	AS SUM_M_10
			, sum(sales_forecast.M_11 * items.Unit_Value) 	AS SUM_M_11
			, sum(sales_forecast.M_12 * items.Unit_Value) 	AS SUM_M_12
			FROM
				sales_forecast
			INNER JOIN items
			ON sales_forecast.Item_Code = items.Item_Code
			$WHERE
			GROUP BY
				sales_forecast.Item_Code";
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
	echo "labels: ['".$row['Unit'].' '."'],";
	echo "lineColors: ['#00A60D'],";
	echo "hideHover: 'auto'";
	 // Free Result set
mysqli_free_Result($Result);
}
?>