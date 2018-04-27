<?php
/*Dito kinokonek ang database para makapagquery ganern*/
require '../../connect.php';

/*Kunin natin ang data from register.php at ilagay sa variables*/
$fname   = $_POST['txtFN'];
$lname   = $_POST['txtLN'];
$email	 = $_POST['txtEmail'];
$uname   = $_POST['txtEmail'];
$pword   = $_POST['password'];

/*Query statement kung may mag-eexist bang email*/
$validation = "SELECT *
        FROM user_register
		WHERE email = '$uname'";

/*Execute natin ang query sa database*/
$email_val = mysqli_query($conn, $validation);

/*Kung successfull ang execution ng query, may nakaregister na ng email*/
if (mysqli_num_rows($email_val) > 0) {
$msg = "The email address has already taken!";

/*Babalik ulit sa register.php na may error message*/
header("Location: register.php?msg=$msg");
} else {
/*Kung wala pang nakaregister, iregister natin sa database*/  

/*Encrypt natin ang password sa md5*/
$pword = md5($pword);
/*Generate tayo ng random code, sana walang collission!*/
$activation_code = md5(rand());
/*Gamitin natin ito for forgot password*/
$token = md5($activation_code);

//echo 'test';
//exit;
/*Gawa ulit ng SQL statement*/
$sql   = "INSERT INTO user_register (id, first_name, last_name,
			email, username, password, activation_code, token)
          VALUES (null, '$fname', '$lname', '$email', 
		   '$uname', '$pword', '$activation_code', '$token')";

/*Iexecute ang query sa database*/
$result = mysqli_query($conn, $sql);


/*Sarado natin ang database*/
mysqli_close($conn);

/*Redirect natin ang user sa register.php*/
header("Location: index.php");
}
