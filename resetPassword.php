<?php

if (isset($_GET['email'])) {
	$email = $_GET['email'];
	//echo $msg;
	//exit;
} else {
	$email = 'No email';
	//echo $msg;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="cmsc-207 Project">
    <meta name="author" content="Zoilo C. Bulawan Jr">

    <title>cmsc - 207</title>

    <!-- Bootstrap Core CSS -->
    <link href="admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <!--<link href="admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <!--<link href="admin/dist/css/sb-admin-2.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
   <!-- <link href="admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    
	<div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Change Password</h3>
                    </div>
                <div class="panel-body">
        <form action="confirmChange.php" method="post" enctype="multipart/form-data" name="frmSaveStudent" id="frmSaveStudent">
            
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="txtEmail" name="txtEmail" type="email" aria-describedby="emailHelp" value=<?php echo $email;?> disabled />
          </div>
          
          <div class="form-group">
            <!--<div class="form-row"> -->
              <!--<div class="col-md-6"> -->
                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" id="password" name="password"  type="password" placeholder="Password" required>
              <!--</div> -->
              <!--<div class="col-md-6"> -->
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm password" required>
                <input type="hidden" id="email" name="email" value=<?php echo $email;?> />
              <!--</div> -->
            <!--</div> -->
          </div>
          <!--<a class="btn btn-lg btn-success btn-block" href="login.html">Register</a> -->
		  <!--<a class="btn btn-primary btn-block" href="login.html">Register</a> -->
		  <button type="submit" class="btn btn-lg btn-success btn-block" onClick="validatePassword();">Change Password</button>
          <button type="reset" class="btn btn-lg btn-success btn-block">Reset</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Login Page</a>
          <a class="d-block small"  href="register.php">Create an Account</a>
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

function validatePassword(){
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>