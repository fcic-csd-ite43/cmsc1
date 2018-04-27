<?php
/*Call out connect.php to connect database for use*/
require 'connect.php';

/*Assign value to defined variables taken from register.php*/
$fname   = $_POST['txtFN'];
$lname   = $_POST['txtLN'];
$email	 = $_POST['txtEmail'];
$uname   = $_POST['txtEmail'];
$pword   = $_POST['password'];

/*Query statement if email exists in the database*/
$validation = "SELECT *
        FROM user_register
		WHERE email = '$uname'";

/*Execute query in database*/
$email_val = mysqli_query($conn, $validation);

/*If variable $email_val is more than 0, return message that the email is aldready registered*/
if (mysqli_num_rows($email_val) > 0) {
$msg = "The email address has already taken!";

/*Return to register.php if error is encountered*/
header("Location: register.php?msg=$msg");
} else {
/*If user does not exist in existing database, proceed with registration of values to the database*/  

/*Encrypt password using md5*/
$pword = md5($pword);
/*Generate random code and encrypt using md5 then assign to variable $activation_code!*/
$activation_code = md5(rand());
/*Encrypt variable $activation_code using md5 and assign to variable $token*/
$token = md5($activation_code);


/* Create SQL statement to enable inserting values to table fields*/
$sql   = "INSERT INTO user_register (id, first_name, last_name,
			email, username, password, activation_code, token)
          VALUES (null, '$fname', '$lname', '$email', 
		   '$uname', '$pword', '$activation_code', '$token')";

/*Execute query in database and assign value in variable $result*/
$result = mysqli_query($conn, $sql);

/*Create email for newly registered users to receive activation code*/

/*Required files for PHPMailer*/
if(!class_exists('PHPMailer')) {
    require('phpmailer/class.phpmailer.php');
	require('phpmailer/class.smtp.php');
}

/*Call mail_configuration.php to execute email credential codes for the group*/
require_once("mail_configuration.php");

/*Setup PHPMailer*/
$mail = new PHPMailer();

/*Create email template for use when sending activation codes to the new registered users*/
$emailBody = '<div><p>Hi '.$fname . ',</p><br><br><p>Here is your activation code: ' .$activation_code.'</p><p>Best regards,</p><br><p>Team C of CMSC 207</p></div>';

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
$mail->Subject = "Activation Email";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

/*Conditional statement whether email is successfully sent*/
if(!$mail->Send()) {
	$message = 'Problem in Sending Activation Email';
} else {
	$message = 'Please check your email to verify your account.';
}

/*Close database*/
mysqli_close($conn);

/*Redirect to activate_email.php to allow email activation after email has been sent*/
header("Location: activation/activate_email.php?message=$message");
}