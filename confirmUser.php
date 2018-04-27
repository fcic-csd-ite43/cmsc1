<?php
require_once 'library/config.php';
//echo 'test';
//exit;
if (isset($_GET['email'])) {
	$email = $_GET['email'];
//echo $email;
//exit;
	$sql2 = "SELECT *
	        FROM id4782439_cmsc.tbl_user
			WHERE email = '$email' AND isConfirm = 0";		
	$result2 = dbQuery($sql2);

	if (dbNumRows($result2) > 0) {
		$sql3 = "UPDATE id4782439_cmsc.tbl_user
		    SET isConfirm = 1
			WHERE email = '$email'";			
		$result3 = dbQuery($sql3);
		}
    }

	$msg = "Your email is confirmed. Please Login.";
	
	header("Location: index.php?msg=$msg");

?>
