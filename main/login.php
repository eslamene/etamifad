<?php
ob_start();
session_start();
/*********************************/
/*import db_connection file*******/
/*********************************/
include_once('db_connection.php');
/*********************************/
/*********************************/
/*Connection Session to Default***/
/*********************************/
$_SESSION['Connection']	= $DBConnection01;
/*********************************/

if (isset($_REQUEST['Connection']))
{
	$UserName				= $_REQUEST['UserName'];
	$Password				= $_REQUEST['Password'];
	$_SESSION['Connection']	= $_REQUEST['Connection'];
	$_SESSION['Alert'] 		= '1';

	$UserName = mysqli_real_escape_string($MySQLConnection, $UserName);
	$Query = "SELECT * FROM members WHERE UserName = '$UserName';";
	 
	$Result = mysqli_query($MySQLConnection, $Query);
	 
	if(mysqli_num_rows($Result) == 0) // User not found. So, redirect to login_form again.
	{ header('Location: login.php?user'); break;}
	 
	$UserData = mysqli_fetch_array($Result, MYSQL_ASSOC);
	$Hash = hash('sha256', $UserData['Salt'] . hash('sha256', $Password) );
	 
	if($Hash != $UserData['Password']) // Incorrect password. So, redirect to login_form again.
	{
		header('Location: login.php?password');
	}
	else
	{ // Redirect to home page after successful login.
		session_regenerate_id();
		$_SESSION['ID']             = $UserData['ID'];
		$_SESSION['First_Name']     = $UserData['First_Name'];
		$_SESSION['Second_Name']    = $UserData['Second_Name'];
		$_SESSION['UserName']       = $UserData['UserName'];
		$_SESSION['Company']        = $UserData['Company'];
		$_SESSION['Department']     = $UserData['Department'];
		$_SESSION['Designation']    = $UserData['Designation'];
		$_SESSION['Title']          = $UserData['Title'];
		$_SESSION['Avatar']         = $UserData['Avatar'];
		$_SESSION['ChangePassword'] = $UserData['ChangePassword'];
		$_SESSION['PageName'] 		= '';

		session_write_close();
		header('Location: ./index.php');
	}
/*Check Change Password***********/
/*********************************/
if($_SESSION['ChangePassword'] == 1)
{
	header("location: ./editprofile.php");
}
/*********************************/
}
?>
<!DOCTYPE html>
<html class="bg-black">
	<head>
		<meta charset="UTF-8">
		<title>Eta Mifad | Log in</title>
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
			<div class="header">Sign In</div>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<div class="body bg-gray">
					<div class="form-group">
						<input type="text" name="UserName" class="form-control" placeholder="User ID"/>
					</div>
					<div class="form-group">
						<input type="password" name="Password" class="form-control" placeholder="Password"/>
					</div>

				</div>
				<div class="footer">                                                               
					<div>
						<button class="btn bg-green btn-lg btn-flat margin btn-block" name="Connection" value="<?php echo $DBConnection01;?>">Login</button>
					</div>
					<!-- <p><a href="#">I forgot my password</a></p>
					<a href="register.html" class="text-center">Register a new membership</a> -->
				</div>
			</form>
		</div>


		<!-- jQuery 2.0.2 -->
		<script src="js/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="js/bootstrap.min.js" type="text/javascript"></script>        

	</body>
</html>