<?php
header('Content-Type: text/html; charset="windows-1252"');

$myServer = "SRV-MIF-0002\ETAMIFADSQL";
$myUser = "sa";
$myPass = "sa";
$DB_Name = "New_Mifad_2014"; 

$conn = new COM ("ADODB.Connection")
or die("Cannot start ADO");

$connStr = "PROVIDER=SQLOLEDB;SERVER=".$myServer.";UID=".$myUser.";PWD=".$myPass.";DATABASE=".$DB_Name; 
$conn->open($connStr); //Open the connection to the database

$query = "SELECT * FROM [$DB_Name].[dbo].[CUSTOMER_DATA]";

$rs = $conn->execute($query);

$num_columns = $rs->Fields->Count();
echo $num_columns . "<br>"; 

for ($i=0; $i < $num_columns; $i++) {
$fld[$i] = $rs->Fields($i);
}

echo "<table>"; while (!$rs->EOF) 
{
echo "<tr>";
for ($i=0; $i < $num_columns; $i++) {
echo "<td>" . $fld[$i]->value . "</td>";
}
echo "</tr>";
$rs->MoveNext(); //move on to the next record
}


echo "</table>";

//close the connection and recordset objects freeing up resources 
$rs->Close();
$conn->Close();

$rs = null;
$conn = null;
?> 
