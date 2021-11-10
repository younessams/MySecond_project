<?php
	if($_SERVER['REQUEST_METHOD'] =='POST'){
		$myfiles = $_FILES['my_work'];
		$files_name = $myfiles['name'];
		$files_tmp = $myfiles['tmp_name'];
		$files_type = $myfiles['type'];
		$files_error = $myfiles['error'];
		$files_size = $myfiles['size'];

		//Uploaded array files to temp errors.
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
		if($count > 10){
			errMessage($uploadErrors[1],'false');
		}else{
			for($i=0;$i<$count;$i++){
				$errors = array();
				//$temp = explode('.', $files_name[$i]); // fro no error in ext
				$ext = @strtolower(end(explode('.', $files_name[$i])));
				$numfile = 'file number '. ($i+1) . ' : ';
				if($files_error[$i] == 0){
					if(!in_array($ext, $extentions)):
						$errors[] = "sorry! you can't upload this file";
					endif;
					if($files_size[$i] >= 2000000){
						$errors[] = $numfile . 'Sorry! you cant upload file his size more than 2mb';
					}
					// Upload file if no errors.
					if(empty($errors)){
						$rand_name = 'youness_'.rand(0, 999999999999). '.' .$ext;
						move_uploaded_file($files_tmp[$i], getcwd()."/images/".$rand_name);
						sucMessage($numfile . $uploadErrors[0]);
					}else{
						echo "<div class='alert alert-danger'>";
						foreach ($errors as $error):
							echo $error."<br />";
						endforeach;
						echo "</div>";
					}
				}else{
					errMessage($uploadErrors[$files_error[$i]],'false');
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>uploaded files</title>
</head>
<body>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="my_work[]" multiple="multiple">
		<input type="submit" value="Upload">
	</form>

</body>
</html>