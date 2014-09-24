<?php
$UserName   = "root";
$Password   = "";
$HostName   = "localhost"; 
$DBName     = "etamifad_eta";

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection = mysqli_connect($HostName, $UserName, $Password, $DBName);
if (!$connection->set_charset('utf8'))
    {
      die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }

// Select all the rows in the geomap table

$query = "SELECT * FROM geomap 
          LEFT JOIN customers on geomap.Customer_NO = customers.Customer_NO
          WHERE 1";

if ($Result = mysqli_query($connection,$query))

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = $Result->fetch_assoc()){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("Customer_Name",$row['Customer_Name']);
  $newnode->setAttribute("Address", $row['Address']);
  $newnode->setAttribute("Trade_Name", $row['Trade_Name']);
  $newnode->setAttribute("Lat", $row['Lat']);
  $newnode->setAttribute("Lng", $row['Lng']);
  $newnode->setAttribute("Type", $row['Type']);
}

echo $dom->saveXML();

?>