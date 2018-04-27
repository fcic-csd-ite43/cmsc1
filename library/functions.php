<?php
//echo 'test';
//exit;
function checkUser()
{
	// if the session id is not set, redirect to login page
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
		exit;
	}
	
	// the user want to logout
	if (isset($_GET['logout'])) {
		doLogout();
	}
}

function doLogin()
{

	$errorMessage = '';
	
	$userName = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	
	// first, make sure the username & password are not empty
	if ($userName == '') {
		$errorMessage = 'You must enter your username';
	} else if ($password == '') {
		$errorMessage = 'You must enter your password';
	} else {
		// check the database and see if the username and password combo do match
		$password = md5($password);
		$sql = "SELECT *
		        FROM id4947395_login.user_register
				WHERE user_name = ('$userName') AND password = ('$password')";
		$result = dbQuery($sql);
	
		if (dbNumRows($result) == 1) {
			$row = dbFetchAssoc($result);
echo 'test';
exit;			
					
						$_SESSION['user_id'] = $row['id'];
						$userid = $_SESSION['user_id'];
						// log the time when the user last login
						
						
						// now that the user is verified we move on to the next page

						header('Location: admin/pages/index.php');
						exit;
						
					
					} else {			
							$errorMessage = 'Wrong username or password';
					}		
			}
				return $errorMessage;
		}
	
}
?>