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
?>
<!DOCTYPE html>
<html>
	<?php 
	$root = './root';
	set_include_path(get_include_path() . PATH_SEPARATOR . $root);
	include('head.php'); 
	?>
	<body class="<?php echo $Themes.' '.$Layout; ?>">
		<!-- header logo: style can be found in header.less -->
		<?php 
		include('header.php'); 
		?>
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="left-side sidebar-offcanvas">
				<!-- sidebar: style can be found in sidebar.less -->
				<?php 
				include('sidebar.php'); 
				?>
				<!-- /.sidebar -->
			</aside>

			<!-- Right side column. Contains the navbar and content of the page -->
			<aside class="right-side">                
				<!-- Content Header (Page header) -->
				<!-- <section class="content-header">
					<h1>
						Data Tables
						<small>advanced tables</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Data tables</li>
					</ol>
				</section> -->

 				<!-- Alert of Database Connection -->
 				<?php if ($_SESSION['Alert']=='1') : ?>
				<section>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<b>Success!</b> Connection to <b><?php echo $_SESSION['Connection']; ?></b> Database.
					</div>
				</section>
 				<?php $_SESSION['Alert'] = '0'; endif; ?>

				<!-- Main content -->
				<section class="content">

						<!-- right column -->

						<!-- Include Requested Form -->
						
						<?php 
						if (isset($_REQUEST['Report']))
						{
							include 'forms/'.$_REQUEST['Report'].'.php'; 
						}
						else if (isset($_REQUEST['Notify']))
						{
							include 'notify/'.$_REQUEST['Notify'].'.php'; 
						}
						else if (isset($_REQUEST['Signature']))
						{
							include 'signature/index.php'; 
						}
						?>

						<!--/.col (right) -->


				<!-- Content Header (Page header) -->
				</section><!-- /.content -->
			</aside><!-- /.right-side -->
		</div><!-- ./wrapper -->

		<!-- include java scripts -->
		<?php include('js.php') ?>

	</body>
</html>