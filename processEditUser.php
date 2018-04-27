<?php
require_once 'library/config.php';
//require_once 'library/functions.php';

//checkUser();



function registerUser()
{
    //$catId       = $_POST['cboCategory'];
    //$id        = $_POST['txtID'];
	$fname        = $_POST['txtFN'];
	$lname        = $_POST['txtLN'];
	$type        = $_POST['selType'];
	//$cname        = $_POST['txtCName'];
	$email	 = $_POST['txtEmail'];
	$uname        = $_POST['txtEmail'];
	$pword        = $_POST['password'];
	//$gender      = $_POST['txtGender'];
	//$course      = $_POST['txtCourse'];
	//$level      = $_POST['txtLevel'];
	echo $pword;
	exit;
	//get the stud_id
	$sql2 = "SELECT *
	        FROM cmsc.tbl_user
			WHERE last_name= '$lname'
			AND first_name = '$fname'";
			
	$result2 = dbQuery($sql2);
	$row2    = dbFetchAssoc($result2);
	if ($row2 > 0) {
		//echo 'Student Id already Exist';
		?>
		<a href="user_add.php?userId=$userId">Id Exist:Cancel</a>
		<?php
		//header("Location: index.php?view=detail&amp;productId=$id");
		exit;
		}
	//extract($row2);
	//echo $stud_id;
	//exit;
		$sqlUser2 = "SELECT  cat_name as userType
		        FROM cmsc.tbl_category_user
				WHERE cat_id = '$type'";
		$resultUser2 = dbQuery($sqlUser2);
		$rowUser2 = dbFetchAssoc($resultUser2);
        extract($rowUser2);

	
	
	$sql   = "INSERT INTO cmsc.tbl_user (first_name, last_name, 
				email, user_name, password, cat_id, user_type)
	          VALUES ('$fname', '$lname', '$email', 
			   '$uname', '$pword', '$type', '$userType')";

	$result = dbQuery($sql);
	
	header("Location: register.php");	
}


?>
