<?php 
	
	include 'admin/connect.php';

	//routes
	$tpl 		='includes/templetes/';
	$lang 		='includes/languages/';
	$func 		='includes/functions/';
	$libraries	='include/libraries/';

	$css 		='layout/css/';
	$js 		='layout/js/';
	$images 	='layout/images/';
	


	session_start();
	if(isset($_GET['lang']) && $_GET['lang']=='arabic'){
		$_SESSION['LANG']='arabic';
	}
	if(isset($_GET['lang']) && $_GET['lang']=='english'){
		$_SESSION['LANG']='english';
	}

	
	$languages ='english';
	if(isset($_SESSION['LANG']) && $_SESSION['LANG']=='arabic'){
		$languages='arabic';
	}

	
	
		//to take the value of the flag get and if it don't have value put it by manage
	
	/*
	if((isset($_GET['lang']) && $_GET['lang']=='arabic')||$){
		$_SESSION['LANG']=$_GET['lang'];
	}*/

	include $func . 'function.inc';
	
	include $lang . $languages.'.php';
	

	include $tpl  . 'top.inc';
	include $tpl  . 'header.inc';


	?>