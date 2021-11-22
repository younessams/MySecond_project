<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
	session_start();

	if(!isset($_SESSION['num_times'])){
		$_SESSION['num_times'] = 0;
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$_SESSION['num_times'] += 1;
	}
	echo "<div>You have <span>". $_SESSION['num_times'] ."</span> clicked times</div>";
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method ='POST'>
	<input type="submit" value="click here">
</form>

</body>
</html>