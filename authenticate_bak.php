<?php

session_start();

require 'connect.php';  // Create a database connection

$email = $_POST['txtUsername'];
$password = md5($_POST['txtPassword']);

$sql = "SELECT *
        FROM user_register
        WHERE email = '$email'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if ($email == $user['email'] && $password == $user['password']) {
        if($user['email_status']=='not verified'){
            header('location: verify.php');
        } else {
            $_SESSION['login_user'] = $user['first_name'];
            header('location: home.php'); 
        }

	} else {
		$sqlAdmin = "SELECT *
				FROM admin_register
				WHERE email = '$email'";
		
		$resultAdmin = mysqli_query($conn, $sqlAdmin);
		
		if (mysqli_num_rows($resultAdmin) > 0) {
			$userAdmin = mysqli_fetch_assoc($resultAdmin);
		   
			} else if ($email == $userAdmin['email'] && $password == $userAdmin['password']) {
				if($userAdmin['email_status']=='not verified'){
					header('location: index.php');
				} else {
					$_SESSION['login_user'] = $user['id'];
					header('location: admin/pages/index.php'); 
				}   
   
   
    } else {
        header('location: index.php'); 
    }
} else {
    header('location: register.php?msg="Walang ganung email! Register ka muna!"');
}

mysqli_close($conn);
