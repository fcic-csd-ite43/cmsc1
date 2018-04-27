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
			if($user['role'] == 'user'){
            	header('location: home.php'); 
			} else if($user['role'] == 'admin'){
			header('location: admin/pages/index.php.php');
			}
        }

    } else {
        header('location: index.php'); 
    }

} else {
    header('location: register.php?msg="Walang ganung email! Register ka muna!"');
}

mysqli_close($conn);
