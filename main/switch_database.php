<?php 
ob_start(); 
//Start session
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == '')) 
{

	header("location: login.php");
	exit();
}
else
{
?>
<!DOCTYPE html>
<html class="bg-black">
	<head>
		<meta charset="UTF-8">
		<title>Eta Mifad | Select Database</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- bootstrap 3.0.2 -->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- font Awesome -->
		<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="bg-black">

		<div class="form-box" id="login-box">
			<div class="header">Select Database</div>
			<form action="#" method="post">
				<div class="body bg-gray">
					<div class="footer">
						
						<div>
							<button class="btn bg-maroon btn-lg btn-flat margin btn-block" name="Connection" value="Eta Mifad">Eta Mifad</button>
						</div>
					</div>
				</div>
					<div class="footer">
					<a class="btn bg-black btn-lg btn-flat margin btn-block" href="./logout.php">
						<i class="fa fa-inbox"></i> Sign Out
					</a>
					</div>
				</div>


			</form>
		</div>     

	</body>
</html>
<?php 
} 

if (isset($_REQUEST['Connection']))
{
	$_SESSION['Connection']	= $_REQUEST['Connection'];
	$_SESSION['Alert'] 		= '1';
	header('Location: index.php');
}
?>