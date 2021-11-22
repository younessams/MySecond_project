<?php
	// directories :
$temp	= "include\\templates\\"; // templetes directory.
$lang	= "include\\languages\\";
$funcs	= "include\\functions\\";
$css	= "design\\css\\"; 		// css director 
$js		= "design\\js\\";		// js directory

	// important includes :

include $lang."english.php";	// language of page
include $funcs."functions.php";	// all functions.
include $temp . "header.php";	// header file.
if(!isset($noNavbar)){include $temp . "navbar.php";}	// navBar file.
connectDB('root','','ecommerce');

?>