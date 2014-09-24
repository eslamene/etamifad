<?php
header('Content-type: text/html; charset=windows-1256');
//connect to a DSN "myDSN" 
$conn = odbc_connect('SQL','sa','sa'); 

if ($conn) 
{ 

  $DB_Name = "New_Mifad_2014";

  //the SQL statement that will query the database 
  $query = "SELECT * FROM [$DB_Name].[dbo].[CUSTOMER_DATA]"; 
  //perform the query 
  $result=odbc_exec($conn, $query); 

  echo "<table border=\"1\"><tr>"; 

  //print field name 
  $colName = odbc_num_fields($result); 
  for ($j=1; $j<= $colName; $j++) 
  {  
    echo "<th>"; 
    echo odbc_field_name ($result, $j ); 
    echo "</th>"; 
  } 

  //fetch tha data from the database 
  while(odbc_fetch_row($result)) 
  { 
    echo "<tr>"; 
    for($i=1;$i<=odbc_num_fields($result);$i++) 
    { 
      echo "<td>"; 
      echo odbc_result($result,$i); 
      echo "</td>"; 
    } 
    echo "</tr>"; 
  } 

  echo "</td> </tr>"; 
  echo "</table >"; 

  //close the connection 
  odbc_close ($conn); 
} 
else echo "odbc not connected"; 
?>