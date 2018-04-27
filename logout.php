<?php
//echo 'test';
//exit;
// *** Logout the current user.
$logoutGoTo = "index.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['user_id'] = NULL;
unset($_SESSION['user_id']);
//session_unregister('mogmarket_user_id');
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>