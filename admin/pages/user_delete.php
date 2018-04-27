<?php
/*Dito kinokonek ang database para makapagquery ganern*/
require '../../connect.php';

$userId   = $_GET['userId'];

/*Update SQL statement*/
$sql   = "DELETE FROM user_register 
			WHERE id='$userId'";

$result = mysqli_query($conn, $sql);


//$message = 'Basic info updated.';


/*Sarado natin ang database*/
//mysqli_close($conn);

/*Redirect natin ang user sa register.php*/
//header("Location: user_edit.php?message=$message&userId=$userId");
header("Location: index.php");

?>
