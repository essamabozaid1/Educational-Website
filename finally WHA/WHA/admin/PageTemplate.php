<?php
  /*
	==========================
	==Manage  Page
	==Add/update/delete Clients from here
	==========================
  */
	session_start();
	if(isset($_SESSION['Username'])){
		$pageTitle='Category Manage';
		$CSSFile="custom.css";
		include 'init.php';
 		include $tpl . 'header.inc';
 		//to display the content of add or edit or delete
 		
 		$flag ='';
 		//to take the value of the flag get and if it don't have value put it by manage
 		if(isset($_GET['flag'])){
 			$flag=$_GET['flag'];
 		}else{
 			$flag='Manage';
 		} 

 		// to splite to more one page
 		if ($flag=='Manage'){
 		
 
 		}elseif ($flag=='add') {
 			
 		
 		}elseif($flag=='insert'){
 			
 			
 			
 		}elseif ($flag=='edit') {

 			
 						
 	   	}elseif ($flag=='update') {
 	   		
 		}elseif($flag=='delete'){
 			
		
 		}else{
 			//header('Location:SamePage.php'); return to manange
 		}
 		//echo "</div>";







	}else{
		header('Location:index.php');
		exit();
	}


?>





   <?php include $tpl . 'down.inc' ?>