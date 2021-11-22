<?php
	session_start();
	$pageTitle = "Dashbord";
	if(!empty($_SESSION) && isset($_SESSION['username']) && $_SESSION['username'] !== ""){
		include "inc.php"; ?>
		
			<div class="alert alert-warning text-center">dashboard body :)</div>

		<?php include $temp."footer.php";
	}else{
		header("location: index.php");
		exit();
	}
?>