<?php

require "../connect.php";

if (isset($_GET['message'])) {
	$message = $_GET['message'];
} else {
	$message = '';
}


if(isset($_POST['code-verify']) && !empty($_POST['code-verify'])) {
	$code = $_POST['code-verify'];
	$query = "
		SELECT * FROM user_register 
		WHERE activation_code = '$code'
	";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		$message = "verified";

		$user = mysqli_fetch_assoc($result);
		if($code==$user['activation_code']) {
			if($user['email_status'] == 'not verified') {
				$update_query = "
				UPDATE user_register 
				SET email_status = 'verified' 
				WHERE id = '".$user['id']."'
				";
				$result = mysqli_query($conn, $update_query);
				$message = '<label class="text-success">Your Email Address Successfully Verified <br />You can login here - <a href="../index.php">Login</a></label>';
			} else {
				$message = '<label class="text-info">Your Email Address Already Verified!</label>';
			}
		} else
			{
				$message = '<label class="text-danger">Invalid Link</label>';
			}

	}

	 else {
		$message = "Error";
	}
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Email Verification</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			 html, body, .container-table {
			    height: 100%;
			}
			.container-table {
			    display: table;
			}
			.vertical-center-row {
			    display: table-cell;
			    vertical-align: middle;
			}
		</style>
	</head>
	<body>
		
		<div class="container container-table">
			<div class="row vertical-center-row">
			    <div class="col-md-4 col-md-offset-4">
			    	<div id="validation-message">
			    		<?php
			    			echo '<p>'.$message.'</p>';
			    		 ?>
			    	</div>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Email Verification</h3>
			  </div>
			  <div class="panel-body">
			<form name="frmForgot" id="frmForgot" method="POST">
				<fieldset>
					<div class="form-group">
					  	<p>Paste the activation code here</p>
					  	<div><input type="text" name="code-verify" id="code-verify" class="form-control"></div>
					  </div>
					  <input type="submit"  name="submit-code" id="submit-code" class="btn btn-lg btn-success btn-block" value="Submit">
			  </fieldset>
			</form>	
			  </div>
			</div>
			</div>
		</div>
		</div>
	
	</body>
	
</html>