$(function(){
	'use strict';

	$(".diverr").hide();
	$(".confirm").click(function(){
		return confirm('you want delete one membere, Are you sure ?');
	});
});

function incorrectData(){
	$(document).ready(function(){
		$('input:not([type^=submit])').css({"border":"solid #f45f5f 1px"});
		$(".diverr").show();
	});
}