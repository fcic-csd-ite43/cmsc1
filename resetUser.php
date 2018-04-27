<?php
require_once 'library/config.php';

	$email	 = $_POST['txtEmail'];

	//echo $email;
	//exit;
	//get the stud_id
	$sql2 = "SELECT *
	        FROM id4782439_cmsc.tbl_user
			WHERE email = '$email'";		
	$result2 = dbQuery($sql2);

	if (dbNumRows($result2) == 0) {
		//echo 'Email does not Exist';
		?>
		<a href="forgot-password.php?userId=$userId">Email Address does not Exist:Cancel</a>
		<?php
		//header("Location: index.php?view=detail&amp;productId=$id");
		exit;
		}
	//extract($row2);
	//echo $email;
	//exit;
	
	$to = $email;
	//echo $to;
	//exit;
	$subject = "Change Password";
	$txt = "Please click on the link below:<br><br>
            <a href='http://zcbulawanjr.000webhostapp.com/resetPassword.php?email=$email'>Click Here</a> " ;
	$headers = "From:zcbulawan@up.edu.ph" . "\r\n" .
	"CC: jude17x3b@gmail.com";
	
	mail($to,$subject,$txt,$headers);
	
	$msg = "An email has been sent! Please verify your email!";
	
	header("Location: forgot-password.php?msg=$msg");	



?>
