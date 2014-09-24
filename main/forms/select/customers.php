<?php
/*include_once('../../db_connection.php');*/

$CustomerQuery = 'SELECT * FROM customers ORDER BY Customer_NO ASC';
 
/*  if(isset($_POST['query'])){
		// Add validation and sanitization on $_POST['query'] here
 
		// Now set the WHERE clause with LIKE query
		$query .= ' WHERE Customer_Name LIKE "%'.$_POST['query'].'%"';
	}*/
 

if ($Customer = mysqli_query($MySQLConnection,$CustomerQuery))
{
	// Fetch one and one row
	while ($row = $Customer->fetch_assoc())
	{
		echo  '<option data-subtext="#'.$row["Customer_NO"].'&emsp;'.$row["Company"].'" value="'.$row["Customer_NO"].'">'.$row["Customer_Name"].'</option>';
	}
	// Free Result set
	mysqli_free_Result($Customer);
}