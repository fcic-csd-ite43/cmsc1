<?php
require_once 'library/config.php';
//echo 'test';
//exit;

	$email = $_POST['email'];
	$password = $_POST['password'];
//echo $email;	
//echo $password;
//exit;
	$sql2 = "SELECT *
	        FROM id4782439_cmsc.tbl_user
			WHERE email = '$email'";		
	$result2 = dbQuery($sql2);

	if (dbNumRows($result2) > 0) {
		$sql3 = "UPDATE id4782439_cmsc.tbl_user
		    SET password = '$password'
			WHERE email = '$email'";			
		$result3 = dbQuery($sql3);
		}


	$msg = "Your password  is changed. Please Login.";
	
	header("Location: forgot-password.php?msg=$msg");

?>
