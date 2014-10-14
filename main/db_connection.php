<?php 
/*********************************/
/*********************************/
/*import config file*/
/*********************************/
include 'config.php';
/*********************************/
if (isset($_SESSION['Connection']))
{
	if ($_SESSION['Connection']==$DBConnection01) 
	{
		//connect to a MySQL
		$UserName 	= "webadmin";
		$Password 	= "ET@itSpp0rt";
		$HostName 	= "localhost"; 
		$DBName		= "etamifad_forecast";
	
		$MySQLConnection 	=	mysqli_connect($HostName, $UserName, $Password, $DBName);
		if (!$MySQLConnection)
		{
			die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		}
	}
/*	else if ($_SESSION['Connection']==$DBConnection03) 
	{
		//connect to a MySQL
		$UserName 	= "root";
		$Password 	= "";
		$HostName 	= "localhost"; 
		$DBName		= "etamifad_mifad";
	
		$MySQLConnection 	=	mysqli_connect($HostName, $UserName, $Password, $DBName);
		if (!$MySQLConnection->set_charset('utf8'))
		{
			die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		}
		//connect to a MSSQL 
		$SQLUser= 'sa';
		$SQLPassword = 'sa';
		$SQLServer = 'SRV-MIF-0002\ETAMIFADSQL';
		$SQLDatabase = 'NEW_MIFAD_2014';
		$SQLDatabaseAlias = 'MIFAD 2014'; //Database alias
		$SQLDatabaseCompany= 'Mifad';
	}*/
}
?>
