<?php 
	
	session_start();
	$pageTitle='LOGIN';
	if(isset($_SESSION['Username'])){
		header('Location:controlHomeEdit.php');
	}


	$CSSFile= 'custom.css';
	include "init.php";
 	




 	if($_SERVER['REQUEST_METHOD']=='POST'){
 		$username=$_POST['uname'];
 		$password=$_POST['psw'];
 		$hashedPass=sha1($password);
 		$stmt= $con->prepare("SELECT Username, Password from admin where Username=? AND Password=?");
 		$stmt->execute(array($username,$hashedPass));
 		
 		$count=$stmt->rowCount();

 		if($count==1){
 			$_SESSION['Username']=$username;
 			header('Location: controlHomeEdit.php');
 			exit();
 		}
 	}


?>


 
		
	<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

			<div class="container-fluid">
		  
			  	<h2 class="text-center">Login Form</h2>

			    <input type="text" placeholder="Enter Username" name="uname" autocomplete="off" required>

			    <input type="password" placeholder="Enter Password" name="psw" autocomplete="new-password" required>
			        
			    <button type="submit">Login</button>
		   
		 	</div>

		 
	</form>



<?php include $tpl . 'down.inc';?>