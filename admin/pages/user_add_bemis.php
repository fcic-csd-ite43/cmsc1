<?php
require_once '../library/config.php';
require_once '../library/functions.php';

error_reporting(1);

if (isset($_SESSION['user_id'])) {
	$userid = $_SESSION['user_id'];
}
		$sqlUser = "SELECT *
		        FROM basic.tbl_user
				WHERE user_id = '$userid'";
		$resultUser = dbQuery($sqlUser);
		$rowUser = dbFetchAssoc($resultUser);
        extract($rowUser);
		
		//echo $instr_firstname;
		//exit;
$searchText = '';
$idText = 0;

if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
	$sql2 = " AND c.cat_id = $catId";
	$queryString = "catId=$catId";
	$searchText = $_GET['txtSearch'];
	$idText = $_GET['idSearch'];

} else {
	$catId = 0;
	$sql2  = '';
	$searchText = $_GET[''];
	$dateText = $_GET[''];

}

// subject list
/*
$sqlLevel = "SELECT *
      		FROM students.tbl_category
			WHERE cat_parent_id = 94
			ORDER BY cat_parent_id, cat_id";
		
$categoryListResult = dbQuery($sqlLevel);
*/
//$categoryList = buildCategoryOptionsFaculty($catId);		
$categoryList = buildCategoryOptionsUser($catId);		
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
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i><?php echo $first_name.' '.$last_name; ?> <i class="fa fa-caret-down"></i>
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
                        
                        <?php require '../include/sidebar_nav.php';?>
						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="h4">Add User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!--<div class="panel-heading">
                            Basic Form Elements
                        </div> -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--<form role="form"> -->
									<form action="processEditUser.php?action=addUser" method="post" enctype="multipart/form-data" name="frmSaveStudent" id="frmSaveStudent">
										
                                        
                                        <div class="form-group">
                                            <!--<label>Text Input with Placeholder</label> -->
                                            <input class="form-control" placeholder="Last Name" name="txtLN" type="text" id="txtLN" value="">
                                        </div>
										<div class="form-group">
                                            <!--<label>Text Input with Placeholder</label> -->
                                            <input class="form-control" placeholder="First Name" name="txtFN" type="text" id="txtFN" value="">
                                        </div>
										
										<div class="form-group">
                                            <!--<label>Gender</label> -->
                                            <select class="form-control" name="selType" id="selType">
                                                <option value="" selected>--Select User Type --</option>
                                                 <?php echo $categoryList;?>
                       							<option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                       							
                                            </select>
                                        </div>
										
										<div class="form-group">
                                            <!--<label>Text Input with Placeholder</label> -->
                                            <input class="form-control" placeholder="Email Address" name="txtEmail" type="text" id="txtEmail"  value="">
                                        </div>
										<div class="form-group">
                                            <!--<label>Text Input with Placeholder</label> -->
                                            <input class="form-control" placeholder="Username" name="txtUN" type="text" id="txtUN"  value="">
                                        </div>
										<div class="form-group">
                                            <!--<label>Text Input with Placeholder</label> -->
                                            <input class="form-control" placeholder="Password" name="txtPW" type="password" id="txtPW"  value="">
                                        </div>
										
										
                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
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
