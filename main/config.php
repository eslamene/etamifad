<?php 
$DBConnection01 	= "Eta Mifad"; 		/*Main Connection*/
/********************************//********************************/
/********************************//********************************/
$Themes				=	"skin-black";		/*Themes Color skin-black or skin-blue*/
$Layout				=	"fixed";			/*Fixed or non-Fixed Layout*/
$Currency			=	"EGP";
$Currency_Symbol	=	"<span class=\"text-light-blue\">(£) </span>";
/********************************//********************************/
/*Permission*/
/********************************//********************************/
$Permission_SV = array("Supervisor");
$Permission_User = array("User");
$Permission_Admin = array("Admin");
$Permission_Admin_SV = array("Admin", "Supervisor");
/*Create Sales Forecast Query to Limit Users View by Sessions*/
/********************************//********************************/
$Permission_SFCUserView = array("Sales", "Supply Chain", "Operation", "CEO", "IT");
/********************************//********************************/
/********************************//********************************/
/*sum function*/
function fnAdd3($num1, $num2, $num3)
{
	$sum = $num1 + $num2 + $num3;
	return $sum;
}
function fnAdd4($n1 ,$n2 ,$n3 ,$n4)
{
	$sum =  $n1 + $n2 + $n3 + $n4;
	return $sum;
}
function fnMulti1by1($num1, $num2)
{
	$sum = $num1*$num2;
	return $sum;
}function fnAdd2Multi1($num1, $num2, $num3)
{
	$sum = ($num1 + $num2)*$num3;
	return $sum;
}
function fnAdd3Multi1($num1, $num2, $num3, $num4)
{
	$sum = ($num1 + $num2 + $num3)*$num4;
	return $sum;
}
function fnAdd4Multi1($n1 ,$n2 ,$n3 ,$n4 ,$n5)
{
	$sum =  ($n1 + $n2 + $n3 + $n4)*$n5;
	return $sum;
}
/*end of sum function*/
?>