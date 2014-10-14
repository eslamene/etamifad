<?php 
ob_start(); 
//Start session
session_start();
 
/*********************************/
/*import db_connection file*/
/*********************************/
include_once('db_connection.php');
/*********************************/
/*********************************/
/*Check session is present or not*/
/*********************************/
if(!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == ''))
{ 
	header("location: login.php");
	exit();
}
/*********************************/
/*Check Change Password***********/
/*********************************/
elseif($_SESSION['ChangePassword'] == 1)
{
	header("location: editprofile.php");
}
/*********************************/

if (isset($_REQUEST['Submit']))
{
	$UserName 		= $_SESSION['UserName'];
	$Password1 		= $_REQUEST['Password1'];
	$Password2 		= $_REQUEST['Password2'];
	$First_Name 	= $_REQUEST['First_Name'];
	$Second_Name 	= $_REQUEST['Second_Name'];
	$Designation	= $_REQUEST['Designation'];
	$Avatar			= $_REQUEST['Avatar'];
   
	if  (strlen($UserName) > 3 && $Password1 == $Password2 && strlen($Password1) > 6)
	{
		$Hash = hash('sha256', $Password1);
		 
		function createSalt()
		{
			$text = md5(uniqid(rand(), true));
			return substr($text, 0, 3);
		}
		 
		$Salt = createSalt();
		$Password = hash('sha256', $Salt . $Hash);
		 
		$Query 	= 	"UPDATE members SET First_Name = '$First_Name', Second_Name = '$Second_Name', Designation = '$Designation', Avatar = '$Avatar', Password = '$Password', Salt = '$Salt', ChangePassword = '0' WHERE UserName = '$UserName'";
		//added $conn variable in order to connect to our database.
		mysqli_query($MySQLConnection, $Query);
		 
		mysqli_close($MySQLConnection);
		header('Location: ./login.php');
	}

	else 
	{	
		echo 	'<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>Error: </b> Your Password is too Short, must be more than 6 chr
				</div>';
	}

}
?>
<!DOCTYPE html>
<html class="bg-black">
	<head>
		<meta charset="UTF-8">
		<title>Eta Mifad | Register New Membership</title>
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
		<style type="text/css">
			.asterisk_input:after {
			content:" *"; 
			color: #e32;
			position: absolute; 
			margin: 0px 0px 0px -20px; 
			font-size: xx-large; 
			padding: 0 5px 0 0; }
			label > input{ /* HIDE RADIO */
			  display:none;
			}
			label > input + img{ /* IMAGE STYLES */
			  cursor:pointer;
			  border:2px solid transparent;
			}
			label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
			  border:2px solid #f00;
			}
			.imgcontainer {
				width: 100px;
			}
		</style>
	</head>
	<body class="bg-black">

		<div class="form-box" id="login-box">
			<div class="header">Kindly Edit Your Profile</div>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<div class="body bg-gray">
					<div class="form-group">
						<span class="pull-right asterisk_input"></span>
						<input type="password" name="Password1" class="form-control" placeholder="Password"/>
					</div>
					<div class="form-group">
						<span class="pull-right asterisk_input"></span>
						<input type="password" name="Password2" class="form-control" placeholder="Confirm Password"/>
					</div>
					<div class="form-group">
						<input type="text" name="First_Name" class="form-control" placeholder="First Name" value="<?php echo $_SESSION['First_Name'];?>"/>
					</div> 
					<div class="form-group">
						<input type="text" name="Second_Name" class="form-control" placeholder="Second Name" value="<?php echo $_SESSION['Second_Name'];?>"/>
					</div> 
					<div class="form-group">
						<input type="text" name="Designation" class="form-control" placeholder="Designation" value="<?php echo $_SESSION['Designation'];?>"/>
					</div>
					<div class="form-group">
					<label>
						<input type="radio" name="Avatar" value="1" checked="checked"/>
						<img src="img/avatar/1.png" class="imgcontainer" alt="User Image">
					</label>
					<label>
						<input type="radio" name="Avatar" value="2" />
						<img src="img/avatar/2.png" class="imgcontainer" alt="User Image">
					</label>
					<label>
						<input type="radio" name="Avatar" value="3" />
						<img src="img/avatar/3.png" class="imgcontainer" alt="User Image">
					</label>
					<label>
						<input type="radio" name="Avatar" value="4" />
						<img src="img/avatar/4.png" class="imgcontainer" alt="User Image">
					</label>
					<label>
						<input type="radio" name="Avatar" value="5" />
						<img src="img/avatar/5.png" class="imgcontainer" alt="User Image">
					</label>
					</div>
				</div>
				<div class="footer">                                                               
					<button type="submit" name="Submit" class="btn bg-blue btn-flat btn-block">Confirm</button>  
				</div>
			</form>
		</div>


		<!-- jQuery 2.0.2 -->
		<script src="js/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="js/bootstrap.min.js" type="text/javascript"></script>        

	</body>
</html>