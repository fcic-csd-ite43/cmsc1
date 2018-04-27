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
		//echo $instr_firstname;
		//exit;

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="0;url=pages/index.html">
<title>SB Admin 2</title>
<script language="javascript">
    window.location.href = "pages/index.html"
</script>
</head>
<body>
Go to <a href="pages/index.html">/pages/index.html</a>
</body>
</html>
