<?php 
ob_start(); 
//Start session
session_start();
 
//Check whether the session variable SESS_MEMBER_ID is present or not
if(!isset($_SESSION['ID']) || (trim($_SESSION['ID']) == '')) {

	header("location: login.php");
	exit();
}
$_SESSION['Connection']	= 'Eta'; /*Set Connection Session for members tbale*/
include_once('db_connection.php');

if (isset($_REQUEST['Submit']))
{
	$UserName 		= $_REQUEST['UserName'];
	$Password1 		= $_REQUEST['Password1'];
	$Password2 		= $_REQUEST['Password2'];
	$First_Name 	= $_REQUEST['First_Name'];
	$Second_Name 	= $_REQUEST['Second_Name'];
	$UserName 		= $_REQUEST['UserName'];
	$Company		= $_REQUEST['Company'];
	$Department 	= $_REQUEST['Department'];
	$Designation	= $_REQUEST['Designation'];
	$Title 			= $_REQUEST['Title'];
	$Avatar 		= $_REQUEST['Avatar'];
   
   
	if  (strlen($UserName) > 3 and $Password1 == $Password2 && strlen($Password1) > 6)
	{
		$Hash = hash('sha256', $Password1);
		 
		function createSalt()
		{
			$text = md5(uniqid(rand(), true));
			return substr($text, 0, 3);
		}
		 
		$Salt = createSalt();
		$Password = hash('sha256', $Salt . $Hash);
		 
		 
		$Query = "INSERT INTO members (First_Name, Second_Name, Company, Department, Designation, Title, Avatar, UserName, Password, Salt) VALUES ('$First_Name', '$Second_Name', '$Company', '$Department', '$Designation', '$Title', '$Avatar', '$UserName', '$Password', '$Salt')";
		 
		//added $conn variable in order to connect to our database.
		mysqli_query($MySQLConnection, $Query);
		 
		mysqli_close($MySQLConnection);
	}

	else if (strlen($UserName) <= 3)
	{	
		echo 	'<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>Error: </b> Your User Name is too Short, must be more than 3 chr
				</div>';
	}
	else if ( $Password1 != $Password2) 
	{
		echo 	'<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>Error: </b> Your password and confirm password do not match
				</div>';
	}
	else if (strlen($Password1) <= 6)
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
			<div class="header">Register New Membership</div>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<div class="body bg-gray">
					<div class="form-group">
						<span class="pull-right asterisk_input"></span>
						<input type="text" name="UserName" class="form-control asterisk_input" placeholder="User ID"/>
					</div>
					<div class="form-group">
						<span class="pull-right asterisk_input"></span>
						<input type="password" name="Password1" class="form-control" placeholder="Password"/>
					</div>
					<div class="form-group">
						<span class="pull-right asterisk_input"></span>
						<input type="password" name="Password2" class="form-control" placeholder="Confirm Password"/>
					</div>
					<div class="form-group">
						<input type="text" name="First_Name" class="form-control" placeholder="First Name"/>
					</div> 
					<div class="form-group">
						<input type="text" name="Second_Name" class="form-control" placeholder="Second Name"/>
					</div> 
					<div class="form-group">
						<input type="text" name="Department" class="form-control" placeholder="Department"/>
					</div> 
					<div class="form-group">
						<input type="text" name="Designation" class="form-control" placeholder="Designation"/>
					</div>

					<div class="form-group">
						<select class="form-control" name="Title">
							<option value="User">User</option>
							<option value="Supervisor">Supervisor</option>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" name="Company">
							<option value="Eta">Eta</option>
							<option value="Mifad">Mifad</option>
						</select>
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
					<button type="submit" name="Submit" class="btn bg-green btn-flat btn-block">Register Me</button>  
				</div>
			</form>
		</div>


		<!-- jQuery 2.0.2 -->
		<script src="js/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="js/bootstrap.min.js" type="text/javascript"></script>        

	</body>
</html>