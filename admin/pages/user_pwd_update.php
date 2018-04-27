<?php
/*Dito kinokonek ang database para makapagquery ganern*/
require '../../connect.php';

/*Kunin natin ang data from register.php at ilagay sa variables*/
//$fname   = $_POST['txtFN'];
///$lname   = $_POST['txtLN'];
//$email	 = $_POST['txtEmail'];
$pword   = $_POST['password'];
$uname   = $_POST['txtUN'];
$userId   = $_POST['hiduserId'];


/*Encrypt password*/
$pword = md5($pword);

/*Update SQL statement*/
$sql   = "UPDATE user_register SET
			password = '$pword'
			WHERE id='$userId'";

$result = mysqli_query($conn, $sql);


$message = 'Password updated.';


/*Sarado natin ang database*/
//mysqli_close($conn);

/*Redirect natin ang user sa register.php*/
header("Location: user_edit.php?message=$message&userId=$userId");
//header("Location: index.php");

?>
