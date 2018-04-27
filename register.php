<?php
// Return message based on set rules on message presented if condition is fulfilled - error or success
if (isset($_GET['msg'])) {
	$msg = $_GET['msg'];

} else {
	$msg = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Create a form that allows registration of new accounts with the following variables: First Name, Last Name, Email Address, Password, and Confirm Password -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="cmsc-207 Project">

    <title>CMSC - 207</title>

    <!-- Bootstrap Core CSS -->
    <link href="admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    
    <div class="container container-table">
	<img src="../app/assets/images/upoulogo.png" width="200" height="200"/>
	<h3>Greetings, Earthlings!</h3>
	<div class="row vertical-center-row">
            <div class="col-md-4 col-md-offset-4">
              <p align="center"><?php echo $msg; ?></p>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register new account</h3>
                    </div>
                <div class="panel-body">
        <form action="registration.php" method="post" enctype="multipart/form-data" name="frmSaveStudent" id="frmSaveStudent">
          <div class="form-group">
                <label for="exampleInputName">First Name</label>
                <input class="form-control" id="txtFN" name="txtFN" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
          </div>
		  <div class="form-group">
                <label for="exampleInputName">Last Name</label>
                <input class="form-control" id="txtLN" name="txtLN" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
          </div>
		  
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
			<input class="form-control" id="txtEmail" name="txtEmail" type="email" aria-describedby="emailHelp" placeholder="Enter email" required>
          </div>
          <div class="form-group">

                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" id="password" name="password"  type="password" placeholder="Password" required>

			</div>
          <div class="form-group">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm password" required>

          </div>
          <!-- Call out validatePassword() to compare passwords if they match on clicking the Register button -->
		  <button type="submit" class="btn btn-lg btn-success btn-block" onClick="validatePassword();">Register</button>
        </form>
        <div class="panel-heading">
                <!--Enable password reset for forgotten password and link to login if existing user -->
              <p>Forgot your password? <a href="forgot_password.php">Click here</a></p>
              <p>Existing user? <a href="index.php">Login here</a></p>
            </div>
      </div>
    </div>
  </div>
</div>
</div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
 <script>
 
// Function written to validate password if they match
function validatePassword(){
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

</script>