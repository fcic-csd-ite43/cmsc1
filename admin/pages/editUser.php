<?php
/*Dito kinokonek ang database para makapagquery ganern*/
require '../../connect.php';

/*Kunin natin ang data from register.php at ilagay sa variables*/
$fname   = $_POST['txtFN'];
$lname   = $_POST['txtLN'];
//$email	 = $_POST['txtEmail'];
$roles   = $_POST['txtRoles'];
$uname   = $_POST['txtUN'];
$userId   = $_POST['hiduserId'];

/*Update SQL statement*/
$sql   = "UPDATE user_register SET
			roles = '$roles'
			WHERE id='$userId'";

$result = mysqli_query($conn, $sql);


$message = 'Database updated.';


/*Sarado natin ang database*/
//mysqli_close($conn);

/*Redirect natin ang user sa register.php*/
//header("Location: edit_user.php?message=$message&userId=$userId");
header("Location: index.php");

?>
