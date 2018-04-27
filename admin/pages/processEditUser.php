<?php
require_once '../library/config.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'modifySettings' :
		modifySettings();
		break;
		
	case 'modifyUser' :
		modifyUser();
		break;

	case 'modifyPassword' :
		modifyPassword();
		break;
		
	case 'addUser' :
		addUser();
		break;

	case 'registerUser' :
		registerUser();
		break;
					
	case 'deleteUser' :
		deleteUser();
		break;
		
	case 'deleteUserLog' :
		deleteUserLog();
		break;		

	default :
	    // if action is not defined or unknown
		// move to main user page
		header('Location: user.php');
}


function addUser()
{
    //$catId       = $_POST['cboCategory'];
    //$id        = $_POST['txtID'];
	$fname        = $_POST['txtFN'];
	$lname        = $_POST['txtLN'];
	$type        = $_POST['selType'];
	//$cname        = $_POST['txtCName'];
	$eaddress	 = $_POST['txtEAddress'];
	$uname        = $_POST['txtUN'];
	$pword        = $_POST['txtPW'];
	//$gender      = $_POST['txtGender'];
	//$course      = $_POST['txtCourse'];
	//$level      = $_POST['txtLevel'];
	
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
	          VALUES ('$fname', '$lname', '$eaddress', 
			   '$uname', '$pword', '$type', '$userType')";

	$result = dbQuery($sql);
	
	header("Location: user.php");	
}

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

function modifyUser()
{
    $userid = $_POST['hiduserId'];
	$firstname = $_POST['txtFN'];
	$lastname = $_POST['txtLN'];
	$username = $_POST['txtUN'];
	$catId = $_POST['selType'];
//echo $catId;
//exit;
// User table

		$sqlUser2 = "SELECT  cat_name as userType
		        FROM cmsc.tbl_category_user
				WHERE cat_id = '$catId'";
		$resultUser2 = dbQuery($sqlUser2);
		$rowUser2 = dbFetchAssoc($resultUser2);
        extract($rowUser2);

//echo $userType;
//exit;			
				$sql = "UPDATE cmsc.tbl_user
                		SET first_name = '$firstname',
						last_name = '$lastname',
						user_name = '$username',
						user_type = '$userType',
						cat_id = '$catId'
						WHERE user_id = '$userid'";
				
	    		$result = dbQuery($sql);

$errorMessage = 'User Info changed successful.';

	header("Location: user_edit.php?userId=$userid&error=$errorMessage");
}

function modifyPassword()
{
    $userid = $_POST['hiduserId'];
	//$firstname = $_POST['hidFN'];
	//$lastname = $_POST['hidLN'];
	$username = $_POST['txtUN'];
	$oldpassword = $_POST['txtOP'];
	$newpassword = $_POST['txtNP'];
	$duppassword = $_POST['txtRP'];
//echo  $userid;
//echo $duppassword;
//exit;	

$errorMessage = '';
// first, make sure the username & password are not empty
	if ($oldpassword == '') {
		$errorMessage = 'You must enter your old password';
	} else if ($newpassword == '') {
		$errorMessage = 'You must enter your new password';
	} else if ($duppassword == '') {
		$errorMessage = 'You must re-enter your new password';
	} else if ($newpassword <> $duppassword) {
		$errorMessage = 'New password does not match';
	} else {
	
	//echo $username;
	//echo $userid;
	//echo $oldpassword;
	//echo $newpassword;
	//echo $duppassword;
	//echo 'test';
	//exit;
		// check the database and see if the username and password combo do match
		$sql = "SELECT *
		        FROM cmsc.tbl_user
				WHERE user_name = ('$username') AND password = ('$oldpassword')";
		$result = dbQuery($sql);
	
				if (dbNumRows($result) > 0) {
					$row = dbFetchAssoc($result);
		//echo 'test';
		//exit;
	
				$sql = "UPDATE cmsc.tbl_user
                		SET password = '$newpassword'
						WHERE user_id = $userid";
				
	    		$result = dbQuery($sql);
				
				$errorMessage = 'Password change successful.';

				} else {			
							$errorMessage = 'Wrong username or password';
						
						}
				}
	
	header("Location: user_edit.php?userId=$userid&error=$errorMessage");
}

function deleteUser()
{
	if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
		//$sy = $_GET['sy'];
		//$sem = $_GET['sem'];
		//$subj = $_GET['subj'];
    } else {
        header('Location: user.php');
    }
	//echo $userId;
	//echo $sy;
	//echo $sem;
	//exit;
    
	$delStudReg = "DELETE FROM cmsc.tbl_user
						WHERE user_id = '$userId'";
	dbQuery($delStudReg);
/*	
	$delStudList = "DELETE FROM registration.tbl_subject_list_col
						WHERE reg_studid = '$studId' 
						AND reg_sy = '$sy' AND reg_sem = '$sem'";
	dbQuery($delStudList);
*/	
	
    header('Location: user.php');
}
/*
function deleteUserLog()
{

	$logid = $_POST['txtLogid'];
	$txtlock = $_POST['txtLock'];
	$num    = count($txtlock);
	
	for ($i = 0; $i < $num; $i++) {
		//echo $MidtermQuizAvg[$i];
		//exit;
		$txtlock2  = $txtlock[$i];
		$logid2 = $logid[$i];
	//echo $logidd;
	//echo $sy;
	//echo $sem;
	//exit;
    
	$delStudReg = "DELETE FROM registration.tbl_user
						WHERE user_id = '$userId'";

	
    header('Location: user.php');
}
*/
?>
