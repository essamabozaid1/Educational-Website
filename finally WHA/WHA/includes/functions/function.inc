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