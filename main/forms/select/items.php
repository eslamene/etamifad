<?php
/*include_once('../../db_connection.php');*/

$CustomerQuery = 'SELECT * FROM items ORDER BY Item_Code ASC';
 
if ($Customer = mysqli_query($MySQLConnection,$CustomerQuery))
{
	// Fetch one and one row
	while ($row = $Customer->fetch_assoc())
	{
		echo  '<option data-subtext="#'.$row["Unit_Value"].' '.$row["Unit"].'&emsp;'.$row["Item_Code"].'&emsp;'.$row["Company"].'" value="'.$row["Item_Code"].'">'.$row["Item_Name"].'</option>';
	}
	// Free Result set
	mysqli_free_Result($Customer);
}