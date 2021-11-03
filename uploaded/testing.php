<?php
	if($_SERVER['REQUEST_METHOD'] =='POST'){
		$myfiles = $_FILES['my_work'];
		$files_name = $myfiles['name'];
		$files_tmp = $myfiles['tmp_name'];
		$files_type = $myfiles['type'];
		$files_error = $myfiles['error'];
		$files_size = $myfiles['size'];

		//array Uploaded files to temp errors.
		$uploadErrors = array(
    		'Uploaded file succesfully',
    		'The uploaded file exceeds the upload max filesize allowed.',
    		'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    		'The uploaded file was only partially uploaded',
    		'No file was uploaded',
    		'Missing a temporary folder'
		);
		$extentions = array('jpg','jpeg','gif','png');
		$count = count($myfiles['name']);
		for($i=0;$i<$count;$i++){
			$errors = array();
			$tmp = explode('.', $files_name[$i]); // for nothing error in extentoin.
			$ext = strtolower(end($tmp));

			if($files_error[$i] == 0){
				if(!in_array($ext, $extentions)):
					$errors[] = "sorry! you cant upload this file extention";
				endif;
				if($files_size[$i] >= 500000){
					$errors[] = 'Sorry! you cant upload file his size more than 500 kb';
				}
				// Uploade file if no has error.
				if(empty($errors)){
					$rand_name = 'youness_'.rand(0, 10000000000000). '.' .$ext;
					move_uploaded_file($files_tmp[$i], $_SERVER['DOCUMENT_ROOT']."/ecommerce_app/images/".$rand_name);
					echo 'file number '. ($i+1) . ' : ' . $uploadErrors[0]."<br />";
				}else{
					foreach ($errors as $error):
						echo "<div class='alert alert-danger'>";
						echo $error."<br />";
						echo "</div>";
					endforeach;
				}
			}else{
				$numerr = $files_error[$i];
				echo $uploadErrors[$numerr];
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Uploaded files</title>
</head>
<body>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="my_work[]" multiple="multiple">
		<input type="submit" value="Upload">
	</form>	
</body>
</html>