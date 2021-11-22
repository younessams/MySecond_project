<?php $noNavbar = ''; include 'inc.php'; ?>

<div class='errs'>
	<div class="alert alert-light">
		<ul><h5>Do You have problem in login ?</h5>
		<li>Advice 1</li> 
		<li>Advice 2</li> 
		<li>Advice 3</li>
		</ul>
	<div class='alert alert-warning text-center'>contact Us in facebook page :
		<a href=https://web.facebook.com/ali.amasri.395><h6 class="btn">Facebook Page</h6><a>
	</div>
	</div>
</div>


<?php
session_start();
echo $_SESSION['i'];
$_SESSION['i'] = 0;
$alpha = 'abcABCxyzXYZhHjiIJefgEFG';
echo $alpha[random_int(0, 23)].$alpha[random_int(0, 23)].$alpha[random_int(0, 23)].$alpha[random_int(0, 23)];
$_SESSION['noback'];
$_SESSION['noback']='';
include $temp."footer.php"; ?>