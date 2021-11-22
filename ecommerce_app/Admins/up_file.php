<?php $noNavbar = ""; include 'inc.php';?>
<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$file = $_FILES['myfile'];
		echo "<pre>";
		print_r($file);
		echo "</pre>";
		if($file['error'] == 0){
			$avatar = "design/Images/".$file['name'];
			if(!file_exists($avatar)){
				copy($file['tmp_name'], $avatar);
				sucMessage("file upload!");
			}
	?>
			<figure class="figure" style="width: 175px; height: 475px; ">
			  <img src="<?php echo $avatar ?>" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
			  <figcaption class="figure-caption text-right">My profile image.</figcaption>
			</figure>
<?php
		$stmt = $con->prepare('INSERT INTO users')
	}
		}?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
	<input type="file" name="myfile" />
	<input type="submit" value="save" />
</form>
	
<?php include $temp.'footer.php';?>