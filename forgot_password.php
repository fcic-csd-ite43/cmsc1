<?php
$message = "";
    // If the forgot password field is filled-up, then connect to the database and assign values to the variable $email
	if(!empty($_POST["forgot-password"])){
	require "connect.php";
	
	$email = $_POST["user-email"];
    
    // Create SQL statement to select email from the table user_register
	$sql = "SELECT *
	        FROM user_register
	        WHERE email = '$email'";
    
    // Run query and assign value to variable $result
	$result = mysqli_query($conn, $sql);

    // If the value of variable $result if more than 0, return the values in the table and get user details
	if (mysqli_num_rows($result) > 0) {
		$user = mysqli_fetch_assoc($result);
		extract($user);
    
    // Else, return message that the email is not verified and load the verify.php page to enable verification.
	if($email_status != "verified") {
			$message = "Email not verified";
			header("Location: ../verify.php");
		}
    
    //Generate PHPMailer codes
	if(!class_exists('PHPMailer')) {
	    require('phpmailer/class.phpmailer.php');
		require('phpmailer/class.smtp.php');
	}

    // Call out mail_configuration.php for mail settings
	require_once("mail_configuration.php");

	/*Setup PHPMailer*/
	$mail = new PHPMailer();

	/*Create template for the email to be sent to the users together with their token*/
	$emailBody = '<div><p>Hi '.$first_name . ',</p><p>Here is your activation code: ' .$token.'</p><br><p>Best regards,</p><p>Team C of CMSC 207</p></div>';

	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = TRUE;
	$mail->SMTPSecure = "tls";
	$mail->Port     = PORT;  
	$mail->Username = MAIL_USERNAME;
	$mail->Password = MAIL_PASSWORD;
	$mail->Host     = MAIL_HOST;
	$mail->Mailer   = MAILER;

	$mail->SetFrom(SERDER_EMAIL, SENDER_NAME);
	$mail->AddReplyTo(SERDER_EMAIL, SENDER_NAME);
	$mail->ReturnPath=SERDER_EMAIL;	
	$mail->AddAddress($email);
	$mail->Subject = "Password Recovery Email";		
	$mail->MsgHTML($emailBody);
	$mail->IsHTML(true);

	/*Conditional statement if email is sent successfully*/
	if(!$mail->Send()) {
		$message = 'Problem in Sending Email. Please do the transaction later.';
	} else {
		$message = 'Please check your email for password recovery.';
	}

	/*Close the database*/
	mysqli_close($conn);
	header("Location: activation/forgot_password_verification.php?message=$message");
	
	} else {
		$message = 'Thre is no such email in our database! Please <a href="register.php">register here</a>';
	}

	}

?>

<!DOCTYPE html>
<html>
	<head>
	    <!-- Create form for the Forgot password that enables inputting the email address -->
		<title>Home</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			 html, body, .container-table {
			    height: 100%;
			}
			.container-table {
			    display: table;
			}
			.vertical-center-row {
			    display: table-cell;
			    vertical-align: middle;
			}
		</style>
		<script>
		
		// Create function validate_forgot() to check whether email address field has a valid user email
		function validate_forgot() {
			if(document.getElementById("user-email").value == "") {
				alert('Please input valid email address!');
				return false;
			}
			return true;
		}
		</script>
	</head>
	<body>
    <div class="container container-table">
	<div style="float:left; width:20%;">
	<img src="../app/assets/images/upoulogo.png" width="200" height="200"/>
    <h1>Greetings, Earthlings!</h1>
	</div>
		
		<?php if(!empty($success_message)) { ?>
		<div class="success_message"><?php echo $success_message; ?></div>
		<?php } ?>

		<div class="col-md-4 col-md-offset-4">
			<h3 class="panel-title">CMSC-207 TEAM ALPHA</h3>
                <div id="validation-message">
                    <?php
                        echo '<p>'.$message.'</p>';
                     ?>
                </div>
			  <div class="login-panel panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Forgot Password?</h3>
			  </div>
			  <div class="panel-body">
			<form name="frmForgot" id="frmForgot" method="POST" onSubmit="return validate_forgot();">
				<fieldset>
					<div class="form-group">
					  	<p>Please input your email address</p>
					  	<div><input type="email" name="user-email" id="user-email" class="form-control"></div>
					  </div>
					  <input type="submit"  name="forgot-password" id="forgot-password" class="btn btn-lg btn-success btn-block" value="Submit">
			  </fieldset>
			</form>	
			  </div>
					<div class="panel-heading">
					    <!-- Create link to allow users to sign in if they remembered their password -->
						<p>Remembered your password? <a href="../index.php">Sign In</a></p>
					</div>
			</div>
			</div>
		</div>
		</div>
		
	</body>
	
</html>