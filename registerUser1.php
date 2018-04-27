<?php
require_once 'library/config.php';
//require_once 'library/functions.php';

//checkUser();




    //$catId       = $_POST['cboCategory'];
    //$id        = $_POST['txtID'];
	$fname        = $_POST['txtFN'];
	$lname        = $_POST['txtLN'];
	$type        = 3;
	//$type        = $_POST['selType'];
	//$cname        = $_POST['txtCName'];
	$email	 = $_POST['txtEmail'];
	$uname        = $_POST['txtEmail'];
	$pword        = $_POST['password'];
	//$gender      = $_POST['txtGender'];
	//$course      = $_POST['txtCourse'];
	//$level      = $_POST['txtLevel'];
	//echo $pword;
	//exit;
	//get the stud_id
	$sql2 = "SELECT *
	        FROM id4782439_cmsc.tbl_user
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
	//extract($row2);
	//echo $stud_id;
	//exit;
		$sqlUser2 = "SELECT  cat_name as userType
		        FROM id4782439_cmsc.tbl_category_user
				WHERE cat_id = '$type'";
		$resultUser2 = dbQuery($sqlUser2);
		$rowUser2 = dbFetchAssoc($resultUser2);
        extract($rowUser2);

	
	
	$sql   = "INSERT INTO id4782439_cmsc.tbl_user (first_name, last_name, 
				email, user_name, password, cat_id, user_type)
	          VALUES ('$fname', '$lname', '$email', 
			   '$uname', '$pword', '$type', '$userType')";

	$result = dbQuery($sql);
	
	$to = $email;
	//echo $to;
	//exit;
	$subject = "Email Verification";
	$txt = "Please click on the link below:<br><br>
            <a href='http://zcbulawanjr.000webhostapp.com/confirmUser.php?email=$email'>Click Here</a> " ;
	$headers = "From:zcbulawan@up.edu.ph" . "\r\n" .
	"CC: jude17x3b@gmail.com";
	
	mail($to,$subject,$txt,$headers);
	
	$msg = "You have been registered! Please verify your email!";
	
	header("Location: register.php?msg=$msg");	



?>
