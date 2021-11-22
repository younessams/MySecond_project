<?php $noNavbar = ''; $pageTitle = "Login"; include "inc.php";
session_start();

if(isset($_SESSION['username'])){
	header("Location: dashboard.php");
}

if(isset($_SESSION['noback']) && $_SESSION['noback']=='toconf'){
	errMessage('Please Confirm Your identity !<form action="confirm.php"><button class="btn" style="color:blue; font-size:20px;" action="confirm.php">Confirm</button></form>');
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(!isset($_SESSION['i'])){
		$_SESSION['i'] = 0;
	}
	if(isset($_POST['user']) && isset($_POST['pass'])){
		$_SESSION['i'] += 1;
		if($_SESSION['i']>10){
			$_SESSION['noback']='toconf';
			header('location: confirm.php');
			exit();
		}
		// echo test_input($_POST['user']) . test_input($_POST['pass']);
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$hashpass = sha1($pass);
		getData('`id`,`username`,`password`,`Email`,`FullName`','`users`','`username` = ? AND `password` = ? AND `groupID` = 1 LIMIT 1');
		$stmt->execute(array($user, $hashpass));
		$count = $stmt->rowCount();
		if($count > 0){
			$_SESSION['username']=$user;
			$row = $stmt->fetch();
			$_SESSION['userID'] = $row['id'];
			$_SESSION['i'] = 0;
			header('Location: dashboard.php');
			exit();
		}else{
			errMessage('information incorrect !','false');
				?>
				<script type="text/javascript">
					incorrectData();
				</script>
				<?php
		}
	}
}
?>
		<!-- login form -->
		
	<div class="login">
		<form class="form-signin text-center" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
		    <i class="fas fa-user-circle"></i><h1 class="h3 mb-3 fw-normal">ADMIN</h1>
		    <i class="fa fa-user" ></i>
		    <input type="text" name="user" class="form-control" placeholder="Name" required autofocus autocomplete="off">
		    <div style="color:red;" class="diverr">error</div>
		    <i class="fa fa-lock" ></i>
		    <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required autocomplete="new-password">
		    <span class="border border-top-0"></span>
		    <button class="w-100 btn btn-lg btn-primary" type="submit">
		    	<i class="fas fa-sign-in-alt"></i> Login
		    </button>
		</form>
	</div>

<?php include $temp."footer.php";?>