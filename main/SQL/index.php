<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"/>
        <title></title>
    </head>
    <body>
    <?php
$Out = "";
$SQLUser= 'sa';
$SQLPassword = 'sa';
$SQLServer = 'SRV-MIF-0002\ETAMIFADSQL';
$SQLDatabase = 'NEW_MIFAD_2014';
$SQLDatabaseAlias = 'MIFAD 2014'; //Database alias
$SQLDatabaseCompany= 'Mifad';
//MSSQL connection string details.
$MSSQLConnection = odbc_connect("Driver={SQL Server};Server=$SQLServer;Database=$SQLDatabase;", $SQLUser, $SQLPassword);

//the SQL statement that will query the database 
$Query = "SELECT * FROM [$SQLDatabase].[dbo].[CUSTOMER_DATA]";
//perform the query 
$Result=odbc_exec($MSSQLConnection, $Query);
while( $Row = odbc_fetch_array($Result)) 
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
odbc_free_result($Result);
odbc_close($MSSQLConnection);
echo $Out;
// Output to bRowser with the CSV mime type
header("Content-type: text/x-csv");
header("Content-DisPOSition: attachment; filename=table_dump.csv");
?>
    </body>
</html>