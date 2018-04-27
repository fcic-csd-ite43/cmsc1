<?php
require_once 'library/config.php';
//require_once 'library/functions.php';

//checkUser();

$searchEmail = $_POST['txtEmail'];
//echo $searchEmail;
//exit;
	$sql2 = "SELECT *
	        FROM id4782439_cmsc.tbl_user
			WHERE email = '$searchEmail'";
			
	$result2 = dbQuery($sql2);
	$row2    = dbFetchAssoc($result2);
	
//echo $email;
//exit; 	
	if ($row2 == 0) {
		//echo 'Student Id already Exist';
		?>
		<a href="forgot-password.php?userId=$userId">Email does not Exist:Cancel</a>
		<?php
		//header("Location: index.php?view=detail&amp;productId=$id");
		exit;
		}
	extract($row2);

	$to = $email;
	//echo $to;
	//exit;
	$subject = "My subject";
	$txt = "Hello world!";
	$headers = "From: webmaster@example.com" . "\r\n" .
	"CC: somebodyelse@example.com";
	
	mail($to,$subject,$txt,$headers);
	
	header("Location: forgot-password.php");

?>
