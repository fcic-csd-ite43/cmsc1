<?php
require_once 'library/config.php';
require_once 'library/functions.php';

error_reporting(1);

if (isset($_POST['txtUsername'])) {
	$result = doLogin();
	
	if ($result != '') {
		$errorMessage = $result;
	}
}

if (isset($_GET['msg'])) {
	$msg = $_GET['msg'];
	//echo $msg;
	//exit;
} else {
	$msg = '';
	//echo $msg;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CMSC217 Project">
    <meta name="author" content="Zoilo C. Bulawan Jr">

    <title>CMSC207</title>

    <!-- Bootstrap Core CSS -->
   <link href="admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <!--<link href="admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
   <link href="admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <!--<link href="admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<p align="center"><?php echo $msg; ?></p>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">CMSC217 LOGIN</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <!--<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus> -->
									<input class="form-control" type="text" name="txtUsername" placeholder="Email" required />
                                </div>
                                <div class="form-group">
                                    <!--<input class="form-control" placeholder="Password" name="password" type="password" value=""> -->
									<input class="form-control" type="password" name="txtPassword" placeholder="Password" required />
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                              <!-- <a href="admin/index.php" class="btn btn-lg btn-success btn-block">Login</a> -->
							  <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
							
                        </form>
                    </div>
					<div class="panel-heading">
								<p>Forgot your password? <a href="email-verification-master/index.php">click here</a></p>
								<p>New user? <a href="register.php">create new account</a></p>
							</div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin/dist/js/sb-admin-2.js"></script>

</body>

</html>
