<?php
if(isset($_GET['do'])){ // important for pages get.
	$do = $_GET['do'];
}else{
	$do = 'Manage';
}

$pageTitle = $do . " Member" ; include "inc.php"; session_start();
if($do == 'Manage'){
	
		echo "MANAGE PAGE";

}elseif($do == 'Edit'){
	$uid = isset($_GET['userid']) && is_numeric($_GET['userid'])?intval($_GET['userid']):0;
		getData("*","`users`", "id= ?");
		$stmt->execute(array($uid));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if($count > 0 && $_GET['userid']==$_SESSION['userID']){ ?>
			<h1 class="text-center">Edit Member</h1>
			<div  class="container">
			<div class="frmEdit">
				<form class="row g-2" action="?do=Update" method="POST">
					<div class="form-group">
						<label class="form-label">Username :</label>
						<input type="hidden" name="Userid" value="<?php echo $row['id'] ?>">
						<input type="hidden" name="pass" value="<?php echo $row['password'] ?>">
						<input type="username" name="User" class="form-control" placeholder="Username" required autocomplete="off" value="<?php echo $row['Username'] ?>">
					</div>
					<div class="form-group">
						<label class="form-label">Old Password :</label>
						<input type="password" name="OldPass" class="form-control" placeholder="old Password" required>
					</div>
					<div class="form-group">
						<label class="form-label">New Password :</label>
						<input type="password" name="NewPass" class="form-control" placeholder="New Password" required>
					</div>
					<div class="form-group">
						<label class="form-label">Confirm Password :</label>
						<input type="password" name="ConPass" class="form-control" placeholder="Confirm New Password" required>
					</div>
					<div class="form-group">
						<label class="form-label">Email :</label>
						<input type="email" name="Email" class="form-control" placeholder="Email" required value="<?php echo $row['Email']; ?>">
					</div>
					<div class="form-group">
						<label class="form-label">Full Name :</label>
							<input type="text" name="Full" class="form-control" placeholder="Full Name" required value="<?php echo $row['FullName']; ?>">
					</div>
					<div class="col-12">
						<button class="btn btn-primary" type="submit">Save</button>
					</div>
				</form>
			</div>
			</div>
<?php 
	}else{
			echo "<div class='errs'><div class='alert alert-danger text-center'><strong>Error! : </strong>This id incorrect!</div></div>";
	}
}elseif ($do == 'Update') {
	echo "<h1 class='text-center'>Add Member</h1>";
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$id 		= test_input($_POST['Userid']); $user 		= test_input($_POST['User']);
		$OldPass 	= test_input($_POST['OldPass']); $NewPass 	= test_input($_POST['NewPass']);
		$ConPass 	= test_input($_POST['ConPass']); $Email 	= test_input($_POST['Email']);
		$Full 		= test_input($_POST['Full']);
		$data = array($user, sha1($NewPass), $Email, $Full, $id);
		getData("*","`users`", "id= ?");
		$stmt->execute(array($id));
		$row = $stmt->fetch();
		if($NewPass === $ConPass && sha1($OldPass) === $row['password'] && strlen($NewPass)>=6){
			$stmt = $con->prepare('UPDATE `users` SET
								username= ?, password= ?, Email= ?, FullName=? WHERE id= ?' );
			$stmt->execute($data);
			sucMessage('1 row is changed !');
		}else{
			errMessage('Password incorrect!');
		}
	}else{
		errMessage('Password incorrect!');
	}

}elseif ($do == 'Insert') {
	echo "<h1 class='text-center'>Add Member</h1>";
	$uid = isset($_GET['userid']) && is_numeric($_GET['userid'])?intval($_GET['userid']):0; 

	if($_SERVER['REQUEST_METHOD']=='POST'){

		// Data returned.
		$data = array('Name' => $_POST['User'],
			'Password' => $_POST['myPass'],
			'Confirm password' => $_POST['ConfPass'],
			'Email' => $_POST['Email'],
			'Full Name' => $_POST['Full']);
		//array errors, for Data is correct or incorrect.
		$errors = array();

		// Check if this Data is more than 3 Letters.
		foreach ($data as $key => $value) {
			if($key == 'Password' && strlen($value)<6){
				array_push($errors, $key.' less than 6 letters.');
				continue ;
			}
			if(strlen($value) < 3){
				if($key == 'Confirm password'){continue ;}
				array_push($errors, $key.' less than 3 letters.');
			}
		}

		//Check if passwords is identical.
		if($data['Password'] !== $data['Confirm password']){
			array_push($errors, 'passsword not identical.');
		}

		// Check this Emal is correct
		$CE = strstr($data['Email'],"@");
		if(!$CE && !strstr($CE,".")){
			array_push($errors, 'Email not correct.');
		}

		// check Email is found in DB
		getData("Email","`users`","Email = ?");
		$stmt->execute(array($data['Email']));
		$rcount = $stmt->rowCount();
		if($rcount == 1){
			array_push($errors, 'This Email "'. $data['Email'] .'" is found.');
		}

		//Check if not Name equal FullName
		if($data['Name'] == $data['Full Name']){
			array_push($errors, 'sorry, Full Name and Name is identical.');
		}

		// insert Data if nothing errors.
		if(empty($errors)){
			$IData = array(':username'=>$data['Name'],
				':password'=>SHA1($data['Password']),
				":Email"=>$data['Email'],
				":FullName"=>$data['Full Name']);
			$statment = $con->prepare('INSERT INTO `users`
									(`username`,`password`,`Email`,`FullName`)
									VALUES(:username,:password,:Email,:FullName)');
			$statment->execute($IData);
			sucMessage('Users is inserted.');
		}else{
			echo "<div class='errs'><div class='alert alert-warning'>";
			if(count($errors)<2){
				echo "<h5 class='text-center'>Sorry, You Have an error, Please Check this Manuals :</h5> <br />";
			}else{
				echo "<h5 class='text-center'>Sorry, You Have " . count($errors) . " errors, Please Check this Manuals :</h5> <br />";
			}
			foreach ($errors as $key => $value) {
				$check = ($key+1);
				echo "<strong> Error ". $check .": </strong> ".$value."<br />";
			}
			echo "</div></div>";
		}
	}

	?>

			<div  class="container">
			<div class="frmEdit">
				<form class="row g-2" action="?do=Insert" method="POST">
					<div class="form-group">
						<label class="form-label">name :</label>
						<i class="fa fa-user" edit="fa-user"></i>
						<input type="username" name="User" class="form-control" placeholder="Type your name" required autocomplete="off" />
					</div>
					<div class="form-group">
						<label class="form-label">Password :</label>
						<i class="fa fa-lock" edit="fa-pass"></i>
						<input type="password" name="myPass" class="form-control" placeholder="Type Password" required>
					</div>
					<div class="form-group">
						<label class="form-label">Confirm Password :</label>
						<i class="fa fa-check" edit="fa-conPass"></i>
						<input type="password" name="ConfPass" class="form-control" placeholder="Confirm Password" required>
					</div>
					<div class="form-group">
						<i class="fas fa-envelope" edit="fa-email"></i>
						<label class="form-label">Email :</label>
						<input type="email" name="Email" class="form-control" placeholder="Type your Email" required />
					</div>
					<div class="form-group">
						<i class="fas fa-user" edit="fa-full"></i>
						<label class="form-label">Full Name :</label>
						<input type="text" name="Full" class="form-control" placeholder="Type Full Name" required />
					</div>
					<div class="col-12">
						<button class="btn btn-primary"><i class="fa fa-save" edit="fa-submit"></i>Save</button>
					</div>
				</form>
			</div>
			</div>


<?php

}elseif ($do == 'Delete') {
	//echo $_SERVER[ 'QUERY_STRING' ]; //for get "GET" Query to string;

	if(isset($_GET['pdf']) && $_GET['pdf']=='download'){
		//echo 'download pdf is not found';
		
	}
	if(isset($_GET['dmem'])){
		$stmt = $con->prepare('DELETE FROM users WHERE id = ?');
		$stmt->execute(array($_GET['dmem']));
		sucMessage('Member is deleted');
	}
	echo "<h1 class='text-center'>Users</h1>";
	$stmt = $con->prepare('SELECT `id`,`Username`,`Email`,`FullName`
							FROM users WHERE groupID=?');
	$stmt->execute(array(0));
	$row = $stmt->fetchAll(); ?>
	<div class="frm form-control"><table class='table table-striped text-center'>
		<thead>
			<tr>
				<th>#ID</th>
				<th>Username</th>
				<th>Email</th>
				<th>FullName</th>
				<th>Delete</th>
			</tr>
		</thead>
			<tbody>
				<?php 
				for($i=0;$i<count($row);$i++){
					echo '<tr>';
					for($t=0;$t<4;$t++){
						echo '<td>'.$row[$i][$t].'</td>';
					}
					echo '<td>';
						echo '<form action="'.$_SERVER['PHP_SELF'].'">';
							echo '<button class="btn btn-danger confirm"><i class="fas fa-user-minus"></i> Remove</button>';
							echo '<input type="hidden" name="dmem" value="'.$row[$i]['id'].'"></input>';
							echo '<input type="hidden" name="do" value="Delete"></input>';
					echo '</form></td></tr>';
				}?>
			</tbody>
		</table>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<input type="hidden" name="do" value="Delete"></input>
			<input type="hidden" name="pdf" value="download"></input>
			<button class="btn btn-dark"><i class="fas fa-download"></i> Download PDF</button>
	</form>
	</div>

<?php }else{
	header('location: dashboard.php');
}

// !!!End body pages
include $temp."footer.php"; ?>