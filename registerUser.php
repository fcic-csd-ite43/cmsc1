<?php
require_once 'library/config.php';
//require_once 'library/functions.php';

//checkUser();





	$fname        = $_POST['txtFN'];
	$lname        = $_POST['txtLN'];
	//$type        = 3;

	$email	 = $_POST['txtEmail'];
	$uname        = $_POST['txtEmail'];
	$pword        = $_POST['password'];

	$sql2 = "SELECT *
	        FROM id4947395_login.user_register
			WHERE email = '$uname'";
			
	$result2 = dbQuery($sql2);
	$row2    = dbFetchAssoc($result2);
	if ($row2 > 0) {
		//echo 'Student Id already Exist';
		?>
		<a href="register.php?userId=$userId">Email Address Exist:Cancel</a>
		<?php
		//header("Location: index.php?view=detail&amp;productId=$id");
		exit;
		}
	$pword = md5($pword);
	
	
	$sql   = "INSERT INTO id4947395_login.user_register (first_name, last_name,
				email, username, password)
	          VALUES ('$fname', '$lname', '$email', 
			   '$uname', '$pword')";

	$result = dbQuery($sql);
	
//send email here
	$to = $email;
	//echo $to;
	//exit;
	$subject = "Email Verification";
	$txt = "Please click on the link below:<br><br>
            <a href='http://zcbulawanjr.000webhostapp.com/confirmUser.php?email=$email'>Click Here</a> " ;
	$headers = "From:cmsc207.teamc@gmail.com" . "\r\n" .
	"CC: zcbulawan@up.edu.ph";
	
	mail($to,$subject,$txt,$headers);
	
	$msg = "You have been registered! Please verify your email!";
	
	header("Location: register.php?msg=$msg");	



?>
