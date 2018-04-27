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
$catId = 0;

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

    <title>FCIC BEMIS</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

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

   <!-- <div id="wrapper"> -->
<?php require '../include/top_nav.php';?>

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $first_name.' '.$last_name; ?><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../index.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                    <h4 class="h4">All Basic Education Users</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!--<div class="panel-heading">
                            DataTables Advanced Tables
                        </div> -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">


							<table width="100%" class="table table-striped table-bordered table-hover">
							
							<tr>
												
							
							<td colspan="4" align="left"><?php require_once '../include/search_user.php'; //echo $sy; echo $sem; exit; ?></td> 
							</tr>
							</table>
<?php

//$idText=0;
//$searchText='a';
$rowsPerPage = 10;
if ($idText == 0 ) {
$sql = "SELECT *
        FROM basic.tbl_user u, basic.tbl_category_user c
		WHERE last_name like ('$searchText%')
		AND u.cat_id = c.cat_id  $sql2
		ORDER BY last_name";
}else{
$sql = "SELECT *
        FROM basic.tbl_user u, basic.tbl_category_user 	
		WHERE emp_id = '$searchText'
		AND u.cat_id = c.cat_id  $sql2";
}$results  = dbQuery(getPagingQuery($sql, $rowsPerPage));
$numPost = dbNumRows($results);
		

$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);
?>


                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User ID</th>
										<th>Type</th>
										<th>Department</th>
                                        <th>Description</th>
                                        <th>Last Login</th>
										<th>Action</th>
                                        
                                    </tr>
                                </thead>
								<?php while($row = dbFetchAssoc($results)) {
										extract($row);
										
								$lastname = utf8_encode($last_name);
								$firstname = utf8_encode($first_name);
								//echo $instr_firstname;
								//exit;
								?>
                                <tbody>
                                
                                    <tr class="gradeA">
                                        <td>
					   
					<a href="user_detail.php?userId=<?php echo $user_id; ?>" title="Click to View Details">
					<?php
							if ($stud_thumbnail != '') {
						?>
							
							<img src="<?php echo '/registration/students/SAO/seniorhigh/images/basic/'  . $stud_thumbnail; ?>">
							<?php
							} else {
							?>
							
							<img src="<?php echo '/registration/students/SAO/seniorhigh/images/basic/no-image-thumb.png'?>">
							<?php
							}
						?> 
					<?php echo $last_name . ', ' . $first_name; ?></a></td>
                                        <td><?php echo $user_id; ?></td>
                                        <td><?php echo $user_type; ?></td>
										<td><?php echo $cat_name; ?></td>
										<td><?php echo $cat_description; ?></td>
                                        <td class="center"><?php echo $last_login; ?></td>
                                        <td align="center"><a class="edit" href="user_edit.php?userId=<?php echo $user_id; ?>">EDIT</a></td>
                                    </tr>
									
									
                                </tbody>
								 <?php } ?> 
                            </table>
                            		<div id="paging">

<p align="right">
  <?php 
				if($pagingLink) {
				echo $pagingLink;
				} else { ?>
  <img src="images/btn_prev2.gif" alt="prev" width="40" height="20" /> [ 1 ] <img src="images/btn_next2.gif" alt="next" width="40" height="20" />
				<?php } ?>
				<input name="btnAdd" type="button" id="btnAdd" value="Add User" onClick="window.location.href='user_add.php';"/>
	</p>
		  </div> 

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
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

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
<!--    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
 -->

</body>

</html>
 <script>
 function viewProduct()
{
	with (window.document.frmSearch) {
		if (cboCategory.selectedIndex == 0) {
			window.location.href = 'user.php';
		} else {
			window.location.href = 'user.php?catId=' + cboCategory.options[cboCategory.selectedIndex].value;
		}
	}
}
</script>