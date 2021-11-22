<?php
	// Title of pages :
	// Version 1.0
	function getTitle(){
		global $pageTitle;
		if(isset($pageTitle)){
			echo $pageTitle;
		}else{
			echo "Default";
		}
	}

	// testing inputs is secure :
	// Version 1.0
	function test_input($data){
		$secarr = array("/","<",">","(",")");

		$data = trim($data);
		$data = str_replace($secarr,"",$data);
		$data = htmlspecialchars($data);

		return $data;
	}

	// function for connect to database :
	// Version 1.0
	function connectDB($user='root',$pass='',$dbname='ecommerce'){
		global $con;
		try{
			$con = new PDO('mysql:host=localhost;dbname='.$dbname,$user,$pass);
			$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			// echo "connection succesfully";
		}catch(PDOException $e){
			global $temp;
			include $temp."footer.php";
			exit("<div class='errs'><div class='alert alert-danger text-center'><strong>Error! : </strong>".$e->getMessage()."</div></div>");
		}
	}

	// Data return :
	// Version 1.0
	function getData($rows,$table,$condition){
		global $stmt;
		global $con;
		$stmt = $con->prepare('SELECT '. $rows .' FROM '. $table . '
								WHERE '. $condition);
	}

	// Danger error Message :
	// Version 2.0
	function errMessage($Message='Error! :',$exit = 'true'){
		global $temp;
		include $temp."footer.php";
		$tag = "<div class='errs'><div class='alert alert-danger text-center'><strong>Error! : </strong>".$Message."</div></div>";
		if($exit == 'true'){
			include $temp.'footer.php';
			exit($tag);
		}elseif($exit == 'false'){
			echo $tag;
		}
	}

	// Succesfully Message :
	// Version 1.0
	function sucMessage($Message='succesfully! :'){
		global $temp;
		include $temp."footer.php";
		echo "<div class='errs'><div class='alert alert-success text-center'><strong>succesfully : </strong>".$Message."</div></div>";
	}

	// Warning Message :
	// Version 1.0
	function warMessage($Message='Warning! :',$exit = 'false'){
		global $temp;
		$tagexit = "<div class='errs'><div class='alert alert-success text-center'><strong>succesfully : </strong>".$Message."</div></div>";
		if($exit == 'true'){
			include $temp.'footer.php';
			exit($tagexit);
		}elseif($exit == 'false'){
			echo $tagexit;
		}
	}
?>