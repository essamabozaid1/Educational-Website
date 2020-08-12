<?php
  
	function logOut() {
	    session_unset();
	    session_destroy();
	    header('Location:index.php');
		exit();
	}

	function getTitle(){
		global $pageTitle;

		if(isset($pageTitle)){
			echo $pageTitle;
		}else{
			echo lang('DEFAULT_TITLE');
		}
	}
	function getCount($item,$table){
		global $con;
		$stmt2=$con->prepare("SELECT COUNT($item) FROM $table ");
		$stmt2->execute();
		echo $stmt2->fetchColumn();
	}
	function getCountNewMessages(){
		global $con;
		$stmt3=$con->prepare("SELECT COUNT(ID) FROM message WHERE `read`=0 ");
		$stmt3->execute();
		echo $stmt3->fetchColumn();
	}


