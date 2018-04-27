<?php
/*Dito kinokonek ang database para makapagquery ganern*/
require '../../connect.php';

/*Kunin natin ang data from register.php at ilagay sa variables*/
$fname   = $_POST['txtFN'];
$lname   = $_POST['txtLN'];
$status	 = $_POST['txtStatus'];
$roles   = $_POST['txtRoles'];
$uname   = $_POST['txtUN'];
$userId   = $_POST['hiduserId'];

/*Update SQL statement*/
$sql   = "UPDATE user_register SET
			first_name = '$fname',
			last_name = '$lname',
			active = '$status',
			roles = '$roles'
			WHERE id='$userId'";

$result = mysqli_query($conn, $sql);


$message = 'Basic info updated.';


/*Sarado natin ang database*/
//mysqli_close($conn);

/*Redirect natin ang user sa register.php*/
header("Location: user_edit.php?message=$message&userId=$userId");
//header("Location: index.php");

?>
