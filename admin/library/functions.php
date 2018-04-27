<?php
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
	// if we found an error save the error message in this variable
	//echo 'test';
	//exit;
/*
	if (isset($_SESSION['user_id'])) {
	$userid = $_SESSION['user_id'];
	echo $userid;
   exit;
}
//echo $username;
//exit;
//$idText = 0;
// check the database and see if the username and password combo do match
/*
		$sqlUser = "SELECT *
		        FROM cmsc.tbl_user
				WHERE user_id = '$userid'";
		$resultUser = dbQuery($sqlUser);
		$rowUser = dbFetchAssoc($resultUser);
        extract($rowUser);
*/		
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
		$sql = "SELECT *
		        FROM cmsc.tbl_user
				WHERE user_name = ('$userName') AND password = ('$password')";
		$result = dbQuery($sql);
	
		if (dbNumRows($result) == 1) {
			$row = dbFetchAssoc($result);
			
					if($row['user_type'] == "students"){ 
						$_SESSION['user_id'] = $row['user_id'];
						$userid = $_SESSION['user_id'];
						// log the time when the user last login
						$sql = "UPDATE cmsc.tbl_user 
								SET last_login = NOW() 
								WHERE user_id = '$userName'";
							
						dbQuery($sql);
						
						$sql2 = "INSERT INTO records.tbl_user_log 
								(user_id, last_login, isActive, log_page) 
								VALUES ('$userid', NOW(), 1, 'Login')";
							
						dbQuery($sql2);
		
						// now that the user is verified we move on to the next page

						header('Location: students/SAO/college/home.php');
						exit;
						
						
					} else if($row['user_type'] == "admin"){ 
						$_SESSION['user_id'] = $row['user_id'];
					
						// log the time when the user last login
						$sql = "UPDATE cmsc.tbl_user 
								SET last_login = NOW() 
								WHERE user_id = '$userName'";
							
						dbQuery($sql);
						
						$sql2 = "INSERT INTO records.tbl_user_log 
								(user_id, last_login, isActive, log_page) 
								VALUES ('$userid', NOW(), 1, 'Login')";
							
						dbQuery($sql2);
		
						// now that the user is verified we move on to the next page

						header('Location: http://192.168.10.201');
						exit;	
								//}
					} else {			
							$errorMessage = 'Wrong username or password';
					}		
			}
				return $errorMessage;
		}
	
}

function buildCategoryOptions($catId = 0)
{
	$sql = "SELECT cat_id, cat_parent_id, cat_name
			FROM records.tbl_category
			ORDER BY cat_id";
	$result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());
	
	$categories = array();
	while($row = dbFetchArray($result)) {
		list($id, $parentId, $name) = $row;
		
		if ($parentId == 0) {
			// we create a new array for each top level categories
			$categories[$id] = array('name' => $name, 'children' => array());
		} else {
			// the child categories are put int the parent category's array
			$categories[$parentId]['children'][] = array('id' => $id, 'name' => $name);	
		}
	}	
	
	// build combo box options
	$list = '';
	foreach ($categories as $key => $value) {
		$name     = $value['name'];
		$children = $value['children'];
		
		$list .= "<optgroup label=\"$name\">"; 
		
		foreach ($children as $child) {
			$list .= "<option value=\"{$child['id']}\"";
			if ($child['id'] == $catId) {
				$list.= " selected";
			}
			
			$list .= ">{$child['name']}</option>\r\n";
		}
		
		$list .= "</optgroup>";
	}
	
	return $list;
}

function buildCategoryOptionsUser($catId = 0)
{
	
	
	$sql = "SELECT cat_id, cat_parent_id, cat_name
			FROM cmsc.tbl_category_user
			ORDER BY cat_name";
	$result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());
	
	$categories = array();
	while($row = dbFetchArray($result)) {
		list($id, $parentId, $name) = $row;
		
		if ($parentId == 0) {
			// we create a new array for each top level categories
			$categories[$id] = array('name' => $name, 'children' => array());
		} else {
			// the child categories are put int the parent category's array
			$categories[$parentId]['children'][] = array('id' => $id, 'name' => $name);	
		}
	}	
	
	// build combo box options
	$list = '';
	foreach ($categories as $key => $value) {
		$name     = $value['name'];
		$children = $value['children'];
		
		$list .= "<optgroup label=\"$name\">"; 
		
		foreach ($children as $child) {
			$list .= "<option value=\"{$child['id']}\"";
			if ($child['id'] == $catId) {
				$list.= " selected";
			}
			
			$list .= ">{$child['name']}</option>\r\n";
		}
		
		$list .= "</optgroup>";
	}

	return $list;
}

?>