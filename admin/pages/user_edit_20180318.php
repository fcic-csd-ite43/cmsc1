<?php
require_once '../library/config.php';
require_once '../library/functions.php';

error_reporting(1);

if (isset($_GET['userId'])) {
	$userId = $_GET['userId'];
	//$catId = $_GET['catId'];
}

if (isset($_SESSION['user_id'])) {
	$userid = $_SESSION['user_id'];
}
		$sqlUser = "SELECT first_name as firstname, last_name as lastname
		        FROM basic.tbl_user
				WHERE user_id = '$userid'";
		$resultUser = dbQuery($sqlUser);
		$rowUser = dbFetchAssoc($resultUser);
        extract($rowUser);
		
		//echo $instr_firstname;
		//exit;
$searchText = '';
$idText = 0;

if (isset($_GET['error'])) {
	$error = $_GET['error'];
	//echo $error;
	//xit;
} else {
	$error = '';
}
/*
// subject list
$sqlLevel = "SELECT *
      		FROM students.tbl_category_basic
			WHERE cat_parent_id = 94
			ORDER BY cat_parent_id, cat_id";
		
$categoryListResult = dbQuery($sqlLevel);
*/
//$categoryList = buildCategoryOptionsFaculty($catId);
//$categoryList = buildCategoryOptionsUser($catId);		

// User table
$sqlUser2 = "SELECT *
		        FROM cmsc.tbl_user u, cmsc.tbl_category_user c
				WHERE user_id = '$userId'
				AND u.cat_id = c.cat_id";
		$resultUser2 = dbQuery($sqlUser2);
		$rowUser2 = dbFetchAssoc($resultUser2);
        extract($rowUser2);	

// User table Parent
$sqlUser3 = "SELECT cat_name as userType
		        FROM cmsc.tbl_category_user
				WHERE cat_id = '$cat_id'";
		$resultUser3 = dbQuery($sqlUser3);
		$rowUser3 = dbFetchAssoc($resultUser3);
        extract($rowUser3);	
//echo $userType;
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
                        <i class="fa fa-user fa-fw"></i><?php echo $firstname.' '.$lastname; ?> <i class="fa fa-caret-down"></i>
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
<form action="processEditUser.php?action=modifyUser" method="post" enctype="multipart/form-data" name="frmSaveStudent" id="frmSaveStudent">	
			<table>
				<tr><td width="550" valign="top">
				<table class="addStud" width="550" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				  <td class="list_header_sel" colspan=4 align="left"><strong>Edit User Basic Info </strong></td>
				  </tr>
				 <tr>
					<td width="220" align="right" class="td_gray2"><strong>ID No: </strong></td>
					<td width="249" class="td_gray"><label><?php echo $user_id;?></label></td>
					
					  <input name="hiduserId" type="hidden" value="<?php echo $user_id; ?>" />
					  <!--<input name="txtLN" type="hidden" value="<?php echo $stud_lastname; ?>" />
					  <input name="txtFN" type="hidden" value="<?php echo $stud_firstname; ?>" /> -->
					  <!--<input name="txtID" type="hidden" value="<?php echo $stud_id; ?>" />
					  <input name="hidcatId" type="hidden" value="<?php echo $catId; ?>" /> -->
				  </tr>
                 
				  <tr>
					<td class="td_gray2" align="right"><strong>Last Name: </strong></td>
					<td class="td_gray"><label>
					<input name="txtLN" type="text" id="txtLN" value="<?php echo $last_name; ?>" size="30" maxlength="50"/>
					</label></td>
				  </tr>
				  <tr>
					<td class="td_gray2" align="right"><strong>First Name: </strong></td>
					<td class="td_gray"><label>
					  <input name="txtFN" type="text" id="txtFN" value="<?php echo $first_name; ?>" size="30" maxlength="50"/> 
					</label></td>
				  </tr>
				 <tr>
					<td class="td_gray2" align="right"><strong>Username: </strong></td>
					<td class="td_gray"><label>
					  <input name="txtUN" type="text" id="txtUN" value="<?php echo $user_name; ?>" size="30" maxlength="50"/> 
					</label></td>
				  </tr>
				  <tr>
					<td class="td_gray2" align="right"><strong>User Type: </strong></td>
					<td class="td_gray"><label>
					  <input name="txtType" type="text" id="txtType" value="<?php echo $user_type; ?>" size="30" maxlength="50" disabled="disabled"/> 
					</label></td>
				  </tr>
				  <tr>
					<td class="td_gray2" align="right"><strong>User Type:</strong></td>
					<td class="td_gray"><label>
					<select name="selType" id="selType">
                      	<option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                       <option value="1">Admin</option>
					   <option value="3">User</option>
                     </select>
					</label></td>
				  </tr>
				  <tr>
				  	<td colspan="2" align="right">
					<input name="btnBack" type="button" id="btnBack" value="Back" onClick="window.location.href='user.php';" />
					<input name="btnReset" type="button" id="btnReset" value="Reset" onClick="window.location.href='user_edit.php?userId=<?php echo $user_id; ?>';" />
				  	<!--<input name="btnSave" type="submit"  id="btnSave" value="Save" onClick="checkSaveStudent();" /> -->
					<input name="btnSave" type="submit"  id="btnSave" value="Save" /></td>
				  </tr>
				  </form>
				  
				  <form action="processEditUser.php?action=modifyPassword" method="post" enctype="multipart/form-data" name="frmSaveStudent" id="frmSaveStudent">
                  
				   <tr>
				  	<td class="list_header_sel" colspan=4 align="left"><strong>Edit Password </strong></td>
				  </tr>
				   <tr>
					<td class="td_gray2" align="right"><strong>Username: </strong></td>
					<td class="td_gray"><label><?php echo $user_name; ?>
					  <input name="txtUN" type="hidden" id="txtUN" value="<?php echo $user_name; ?>" size="30" maxlength="50"/> 
					  <input name="hiduserId" type="hidden" value="<?php echo $user_id; ?>" />
					</label></td>
				  </tr>
				  <tr>
					<td class="td_gray2" align="right"><strong>Old Password: </strong></td>
					<td class="td_gray"><label>
					  <input name="txtOP" type="password" id="txtOP" value="" size="30" maxlength="30" />
					</label></td>
			  </tr>
				
			  <tr>
					<td class="td_gray2" align="right"><strong>New Password: </strong></td>
					<td class="td_gray"><label>
					  <input name="txtNP" type="text" id="txtNP" value="" size="30" maxlength="25" />
					</label></td>
			  </tr>
			  <tr>
					<td class="td_gray2" align="right"><strong>Retype Password: </strong></td>
					<td class="td_gray"><label>
					  <input name="txtRP" type="text" id="txtRP" value="" size="30" maxlength="25" />
					</label></td>
			  </tr>
			  <tr>
				  	<td colspan="2" align="right">
					<input name="btnBack" type="button" id="btnBack" value="Back" onClick="window.location.href='user.php';" />
					<input name="btnReset" type="button" id="btnReset" value="Reset" onClick="window.location.href='user_edit.php?studId=<?php echo $stud_id; ?>';" />
				  	<!--<input name="btnSave" type="submit"  id="btnSave" value="Save" onClick="checkSaveStudent();" /> -->
					<input name="btnSave" type="submit"  id="btnSave" value="Save" /></td>
				  </tr>
			
			 </table>
		  <p class="error"><?php echo $error; ?></p>
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
