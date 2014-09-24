<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"/>
        <title></title>
    </head>
    <body>

<?php 
$HostName = "SRV-MIF-0002\ETAMIFADSQL";
$UserName= "sa";
$Pass = "sa";
$DB_Name = "New_Mifad_2014";


//MSSQL connection string details.
$MSSQLConnection = new PDO("sqlsrv:server=$HostName;Database=$DB_Name", "$UserName", "$Pass");

//the SQL statement that will query the database 
$Query = "SELECT * FROM [$DB_Name].[dbo].[CUSTOMER_DATA]";
//perform the query 
$Result  = $MSSQLConnection->prepare($Query);
$Result->execute();
while( $Row = $Result->fetch()) 
{
    foreach($Row AS $Key => $value){
        //If the character " exists, then escape it, otherwise the csv file will be invalid.
        $POS = strPOS($value, '"');
        if ($POS !== false) {
            $value = str_replace('"', '\"', $value);
        }
        $Out .= '"'.$value.'",';
    }
    $Out .= "\n";
}

//Generate CSV file - Set as MSSQL_ASSOC as you don't need the numeric values.
Unset($Result);
Unset($MSSQLConnection);
echo $Out;
// Output to bRowser with the CSV mime type
header("Content-type: text/x-csv");
header("Content-DisPOSition: attachment; filename=table_dump.csv");
?>
    </body>
</html>