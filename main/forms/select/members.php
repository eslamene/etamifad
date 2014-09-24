<?php
/*include_once('../../db_connection.php');*/

$MemberQuery = 'SELECT * FROM members ORDER BY First_Name ASC';
 
/*  if(isset($_POST['query'])){
		// Add validation and sanitization on $_POST['query'] here
 
		// Now set the WHERE clause with LIKE query
		$query .= ' WHERE Customer_Name LIKE "%'.$_POST['query'].'%"';
	}*/
 

if ($Member = mysqli_query($MySQLConnection,$MemberQuery))
{
	// Fetch one and one row
	while ($row = $Member->fetch_assoc())
	{

		if ($_SESSION['ID'] == $row['ID'])
			{
				echo  '<option Selected data-subtext="'.$row["Department"].' | '.$row["Designation"].'" value="'.$row["ID"].'">'.$row["First_Name"].' '.$row['Second_Name'].'</option>';
			}
		elseif ($_SESSION['Title'] == 'Admin') 
			{
				echo  '<option data-subtext="'.$row["Department"].' | '.$row["Designation"].'" value="'.$row["ID"].'">'.$row["First_Name"].' '.$row['Second_Name'].'</option>';
			}
	}
	// Free Result set
	mysqli_free_Result($Member);
}