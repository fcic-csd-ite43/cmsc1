<?php
require_once '../library/config.php';
require_once '../library/functions.php';
require_once '../include/header.php';
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

// User table
$sqlUser2 = "SELECT *
		        FROM basic.tbl_user u, basic.tbl_category_user c
				WHERE user_id = '$userId'
				AND u.cat_id = c.cat_id";
		$resultUser2 = dbQuery($sqlUser2);
		$rowUser2 = dbFetchAssoc($resultUser2);
        extract($rowUser2);	
//echo $cat_description;
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

<?php require '../include/top_nav.php';?>
    
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
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
                    <h1 class="h4">Detail User Information</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php
							if ($stud_thumbnail != '') {
							?>
							
							<img src="<?php echo '/registration/students/SAO/seniorhigh/images/basic/'  . $stud_image; ?>">
							<?php
							} else {
							?>
							
							<img src="<?php echo '/registration/students/SAO/seniorhigh/images/basic/no-image-small.png'?>">
							<?php
							}
							?> 
                        </div> 
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--<form role="form"> -->
<table>
<tr>
<td width="400" valign="top">
	<table class="addStud" width="400" border="1" cellspacing="0" cellpadding="1">
				
                  <tr>
				  <td class="list_header_sel" colspan=2 align="left"><strong>User Information: </strong></td>
				  </tr>
				
                 <tr>
					<td width="128"  class="td_gray2"><strong>ID No: </strong></td>
					<td width="257" class="td_gray"><label><?php echo $user_id;?></label></td>
					<input name="hidID" type="hidden" value="<?php echo $id; ?>" />
					  <input name="hidStudId" type="hidden" value="<?php echo $user_id; ?>" />
					  <!--<input name="txtLN" type="hidden" value="<?php echo $user_lastname; ?>" />
					  <input name="txtFN" type="hidden" value="<?php echo $user_firstname; ?>" /> -->
					  <input name="txtID" type="hidden" value="<?php echo $user_id; ?>" />
					  <input name="hidcatId" type="hidden" value="<?php echo $catId; ?>" />
				  </tr>
                 
				  <tr>
					<td class="td_gray2" ><strong>Last Name: </strong></td>
					<td class="td_gray"><?php echo $last_name; ?></td>
				  </tr>
				  
                  <tr>
					<td class="td_gray2" ><strong>First Name: </strong></td>
					<td class="td_gray"><?php echo $first_name; ?></td>
				  </tr>
				  
                  <tr>
					<td class="td_gray2" ><strong>Middle Initial: </strong></td>
					<td class="td_gray"><?php echo $user_mi; ?></td>
				  </tr>
				  
                  <tr>
					<td class="td_gray2" ><strong>User Type: </strong></td>
					<td class="td_gray"><?php echo $cat_name; ?></td>
				  </tr>
                  
                  <tr>
					<td class="td_gray2" ><strong>Description: </strong></td>
					 <td class="td_gray"><?php echo $cat_description; ?></td>
				  </tr>
				  
                  <tr>
					<td class="td_gray2" ><strong>Sex:</strong></td>
					<td class="td_gray"><?php echo $user_sex ?></td>
				  </tr>
                  
                  <tr>
					<td class="td_gray2" ><strong>Citizenship: </strong></td>
					<td class="td_gray"><?php echo $stud_citizenship; ?></td>
			      </tr>
				
			      <tr>
					<td class="td_gray2" ><strong>Street: </strong></td>
					<td class="td_gray"><?php echo $stud_address_street; ?></td>
			      </tr>
			      <tr>
					<td class="td_gray2" ><strong>Town/City: </strong></td>
					<td class="td_gray"><?php echo $stud_address_town; ?></td>
			      </tr>
			      <tr>
					<td class="td_gray2" ><strong>Province: </strong></td>
					<td class="td_gray"><?php echo $stud_address_prov; ?></td>
			      </tr>
                  <tr>

			</table>
</td>
  
<td width="470">
             <table class="addStud" width="399" border="1" cellspacing="0" cellpadding="1">
				  <tr>
				  <td class="list_header_sel" colspan=2 align="left"><strong>Student  Other Information: </strong></td>
				  </tr>

				  <tr>
					<td width="128" class="td_gray2" ><strong>Date of Birth: </strong></td>
					<td width="257" class="td_gray"><?php echo $stud_dob; ?></td>
				  </tr>
                  
				  <tr>
					<td class="td_gray2" ><strong>Place of Birth: </strong></td>
					<td class="td_gray"><?php echo $stud_pob; ?></td>
				  </tr>
                  
                  <tr>
					<td class="td_gray2" ><strong>Age: </strong></td>
					<td class="td_gray"><?php echo $stud_age; ?></td>
				  </tr>
                  
                  <tr>
					<td class="td_gray2" ><strong>Religion: </strong></td>
					<td class="td_gray"><?php echo $stud_religion; ?></td>
                  </tr>
                    
                  <tr> 
					<td class="td_gray2" ><strong>Civil Status: </strong></td>
					<td class="td_gray"><?php echo $stud_status; ?></td>
				  </tr>
                  
                  <tr>
					<td class="td_gray2" ><strong>Town Address: </strong></td>
					<td class="td_gray"><?php echo $stud_town; ?></td>
				  </tr>
                  
                  <tr>
					<td class="td_gray2" ><strong>Province </strong></td>
					<td class="td_gray"><?php echo $stud_town; ?></td>
				  </tr>
                  
                 <tr>
					<td class="td_gray2" ><strong>Parent/Guardian/Spouse: </strong></td>
					<td class="td_gray"><?php echo $stud_pgs; ?></td>
				  </tr>
                  
                  <tr>
					<td class="td_gray2" rowspan="2"><strong>Annual Income of Parent/Guardian/Spouse:</strong></td>
					<!--<td class="td_gray" >&nbsp; </td> -->
				  </tr>
                  
                  <tr>
					<!--td class="td_gray2" ><strong>&nbsp; </strong></td> -->
					<td class="td_gray"<?php echo $stud_pgs_income; ?></td>
				  </tr>
                  
                  <tr>
					<td class="td_gray2" ><strong>&nbsp; </strong></td>
					<td class="td_gray">&nbsp;</td>
				  </tr>
 			 </table>              
</td>
</tr>			    
</table>
<table class="addStud" width="800" border="1" cellspacing="0" cellpadding="1">
				  <tr>
				  <td class="list_header_sel" colspan=4 align="left"><strong>Last School Attended: </strong></td>
				  </tr>
				 
                  <tr>
                  <td class="td_gray2">&nbsp;</td>
                  <td class="td_gray2" align="center">Name of School</td>
                  <td class="td_gray2" align="center">Address</td>
                  <td class="td_gray2" align="center">School Year</td>
                  </tr>
				  <tr>
					<td class="td_gray2" ><strong>Primary: </strong></td>
					<td class="td_gray"><?php echo $stud_primary; ?></td>
                    <td class="td_gray"><?php echo $stud_primary_address; ?></td>
                    <td class="td_gray"><?php echo $stud_primary_sy; ?></td>
				  </tr>
				  <tr>
					<td class="td_gray2" ><strong>Intermediate: </strong></td>
					<td class="td_gray"><?php echo $stud_intermediate; ?></td>
                    <td class="td_gray"><?php echo $stud_intermediate_address; ?></td>
                    <td class="td_gray"><?php echo $stud_intermediate_sy; ?></td>
				  </tr>
                  <tr>
					<td class="td_gray2" ><strong>First Year High School: </strong></td>
					<td class="td_gray"><?php echo $stud_hs_first; ?></td>
                    <td class="td_gray"><?php echo $stud_hs_first_address; ?></td>
                    <td class="td_gray"><?php echo $stud_hs_first_sy; ?></td>
				  </tr>
                  <tr>
					<td class="td_gray2" ><strong>Second Year High School: </strong></td>
					<td class="td_gray"><?php echo $stud_hs_second; ?></td>
                    <td class="td_gray"><?php echo $stud_hs_second_address; ?></td>
                    <td class="td_gray"> <?php echo $stud_hs_second_sy; ?></td>
                    <tr>
					<td class="td_gray2" ><strong>Third Year High School: </strong></td>
					<td class="td_gray"><?php echo $stud_hs_third; ?></td>
                    <td class="td_gray"><?php echo $stud_hs_third_address; ?></td>
                    <td class="td_gray"><?php echo $stud_hs_third_sy; ?></td>
				  </tr>
                  <tr>
					<td class="td_gray2" ><strong>Fourth Year High School: </strong></td>
					<td class="td_gray"><?php echo $stud_hs_fourth; ?></td>
                    <td class="td_gray"><?php echo $stud_hs_fourth_address; ?></td>
                    <td class="td_gray"><?php echo $stud_hs_fourth_sy; ?></td>
				  </tr>
				  </tr>
				  
                  <tr>
					<td class="td_gray2" ><strong>College: </strong></td>
					<td class="td_gray"><?php echo $stud_col_last; ?></td>
                    <td class="td_gray2" ><strong>Course/Year: </strong></td>
                    <td class="td_gray"><?php echo $stud_col_last_course; ?></td>
				  </tr>
                  
				    
			 </table>

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
