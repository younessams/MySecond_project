<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$file = $_FILES['myfile'];
		echo "<pre>";
		print_r($file);
		echo "</pre>";
	}