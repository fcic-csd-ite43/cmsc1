<?php
session_start();

require '../../connect.php';  // Create a database connection

if (isset($_SESSION['login_user'])) {
	$login_user = $_SESSION['login_user'];
}
$sql = "SELECT *
        FROM user_register
        WHERE id = '$login_user'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
		
		//echo $instr_firstname;
		//exit;
if (isset($_GET['userId'])) {
	$userId = $_GET['userId'];
	//$catId = $_GET['catId'];
}

if (isset($_GET['message'])) {
	$message = $_GET['message'];
	//echo $msg;
	//exit;
} else {
	$message = '';
	//echo $msg;
}
// User table
$sql = "SELECT *
        FROM user_register
        WHERE id = '$userId'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
//echo $user['last_name'];
//exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FCIC cmsc</title>
	<link href="../css/basic.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!--<div id="wrapper"> -->

<?php require '../include/top_nav_cmsc.php';?>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown-messages -->
                    <!-- /.dropdown-tasks -->
                    <!-- /.dropdown-alerts -->
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i><?php echo $user['last_name'] . ', ' . $user['first_name']; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                           <!--<div id="wrapper"> -->

						<?php require '../include/sidebar_nav_cmsc.php';?>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   <h1 class="h4">Edit User Info</h1>
					<!--<a href="index.php"> <button type="button" class="btn btn-primary">Basic</button></a> -->
                </div>
                <!-- /.col-lg-12 -->
				 <!-- /.navbar-header -->
            
            <!-- /.navbar-header -->
			<!-- /.navbar-header -->
            
            <!-- /.navbar-header -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!--<div class="panel-heading">
                          
                        </div>  -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--<form role="form"> -->
<form action="user_info_update.php" method="post" enctype="multipart/form-data" name="frmSaveStudent" id="frmSaveStudent">	
			<table>
				<tr><td width="550" valign="top">
				<table class="addStud" width="550" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				  <td class="list_header_sel" colspan=4 align="left"><strong>Edit User Basic Info </strong></td>
				  </tr>
				  <tr>
					<td class="td_gray2" align="right"><strong>Username: </strong></td>
					<td class="td_gray"><label><?php echo $user['username']; ?>
					  <input name="txtUN" type="hidden" id="txtUN" value="<?php echo $user['username']; ?>" size="30" maxlength="50"/> 
					  <input name="hiduserId" type="hidden" value="<?php echo $user['id']; ?>" />
					</label></td>
				  </tr>
				 
				  <tr>
					<td class="td_gray2" align="right"><strong>Last Name: </strong></td>
					<td class="td_gray"><label>
					<input name="txtLN" type="text" id="txtLN" value="<?php echo $user['last_name']; ?>" size="30" maxlength="50"/>
					</label></td>
				  </tr>
				  <tr>
					<td class="td_gray2" align="right"><strong>First Name: </strong></td>
					<td class="td_gray"><label>
					  <input name="txtFN" type="text" id="txtFN" value="<?php echo $user['first_name']; ?>" size="30" maxlength="50"/> 
					</label></td>
				  </tr>
				 
				  
				  <tr>
					<td class="td_gray2" align="right"><strong>User Status:</strong></td>
					<td class="td_gray"><label>
					<select name="txtStatus" id="txtStatus">
                      	<option value="<?php echo $user['active']; ?>"><?php echo $user['active']; ?></option>
                       <option value="active">active</option>
					   <option value="inactive">inactive</option>
                     </select>
					</label></td>
				  </tr>
				   <tr>
					<td class="td_gray2" align="right"><strong>User Role:</strong></td>
					<td class="td_gray"><label>
					<select name="txtRoles" id="txtRoles">
                      	<option value="<?php echo $user['roles']; ?>"><?php echo $user['roles']; ?></option>
                       <option value="admin">admin</option>
					   <option value="user">user</option>
                     </select>
					</label></td>
				  </tr>
				  <tr>
				  	<td colspan="2" align="right">
					<input name="btnBack" type="button" id="btnBack" value="Back" onClick="window.location.href='index.php';" />
					<input name="btnReset" type="button" id="btnReset" value="Reset" onClick="window.location.href='user_edit.php?userId=<?php echo $user['id']; ?>';" />
				  	<!--<input name="btnSave" type="submit"  id="btnSave" value="Save" onClick="checkSaveStudent();" /> -->
					<input name="btnSave" type="submit"  id="btnSave" value="Save" /></td>
				  </tr>
				  </form>
				  
				  <form action="user_pwd_update.php" method="post" enctype="multipart/form-data" name="frmSaveStudent" id="frmSaveStudent">
                  
				   <tr>
				  	<td class="list_header_sel" colspan=4 align="left"><strong>Edit Password </strong></td>
				  </tr>
				   <tr>
					<td class="td_gray2" align="right"><strong>Username: </strong></td>
					<td class="td_gray"><label><?php echo $user['username']; ?>
					  <input name="txtUN" type="hidden" id="txtUN" value="<?php echo $user['username']; ?>" size="30" maxlength="50"/> 
					  <input name="hiduserId" type="hidden" value="<?php echo $user['id']; ?>" />
					</label></td>
				  </tr>
				  
				
			  <tr>
					<td class="td_gray2" align="right"><strong>New Password: </strong></td>
					<td class="td_gray"><label>
					  <input name="password" type="text" id="password" placeholder="Password" required/>
					</label></td>
			  </tr>
			  <tr>
					<td class="td_gray2" align="right"><strong>Confirm new password: </strong></td>
					<td class="td_gray"><label>
					  <input name="confirm_password" type="text" id="confirm_password" placeholder="Confirm password" required/>
					</label></td>
			  </tr>
			  <tr>
				  	<td colspan="2" align="right">
					<input name="btnBack" type="button" id="btnBack" value="Back" onClick="window.location.href='index.php';" />
					<input name="btnReset" type="button" id="btnReset" value="Reset" onClick="window.location.href='user_edit.php?studId=<?php echo $user['id']; ?>" />
				  	<!--<input name="btnSave" type="submit"  id="btnSave" value="Save" onClick="checkSaveStudent();" /> -->
					<input name="btnSave" type="submit"  id="btnSave" value="Save" onClick="validatePassword();"/></td>
				  </tr>
			
			 </table>
		  <p><?php echo $message; ?></p>
			</form>
                                </div>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

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

// password.onchange = validatePassword;
// confirm_password.onkeyup = validatePassword;
</script>