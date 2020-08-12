<?php
session_start();
if(isset($_SESSION['Username'])){
		$pageTitle='Contact Manage';
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

 		if($flag=='Manage'){
 			$stmt=$con->prepare("SELECT * FROM `message` ");
 			$stmt->execute();
 			$rows=$stmt->fetchAll();

 			?>
 				<h1 class="text-center">Manage Message</h1>
		 		<div class="container">
		 			<div class="table-responsive">
		 				<table class="main-table manage_images table table-border">
		 					<tr class="text-center">
		 						<td>#ID</td>
		 						<td>Client Name</td>
		 						<td>Email</td>
		 						<td>Message</td>
		 						<td>Read</td>
		 						<td>Appear</td>
		 						<td>Control</td>
		 					</tr>
		 					<?php 
		 					
		 						foreach ($rows as $row) { ?>
		 							
		 							<tr class='text-center' <?php if($row['read']==0){echo 'style=background-color:#7ed6df;' ;} ?>>
		 								<?php
		 								echo "<td>" . $row['ID'] . "</td>";
		 								echo "<td>" . $row['name'] . "</td>";
		 								echo "<td>" . $row['email'] . "</td>";
		 								echo "<td>" . $row['message'] . "</td>";	
		 								echo "<td><a href='?flag=read&msgID=" . $row["ID"] ."' class='btn btn-warning'>Readed</a></td>";
		 								?>
		 								<td><a href="?flag=appear&msgID=<?php echo $row['ID']; ?>" class='btn btn-success'><?php if($row['appear']==0){echo 'Unappear';}else{echo 'appear';} ?></a></td>
		 								<?php
		 								echo "<td>
		 										
		 										
		 										<a href='?flag=delete&msgID=" . $row["ID"] ."' class='btn btn-danger'>Delete</a>
		 									 </td>";
		 							echo "</tr>";
		 						}
		 					?>
		 				</table>
		 				
		 			</div>
		 			

		 		</div>	


 			<?php


 		}elseif($flag=='appear'){

 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Appearing Message</h1>";
 			if(isset($_GET['msgID']) && is_numeric($_GET['msgID'])){
 				$msg= intval($_GET['msgID']);
 				$stmt   =$con->prepare("SELECT appear FROM message WHERE ID=?");
	 			$stmt->execute(array($msg));
	 			$appearArr=$stmt->fetch();
	 			$appear=$appearArr[0];	
 				if($appear==0){
 					$appear=1;
 				}elseif ($appear==1) {
 					$appear=0;
 				}
 				
 				$stmt   =$con->prepare("UPDATE `message` SET `appear` = ? WHERE `ID` = ?");
	 			$stmt->execute(array($appear,$msg));
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount==1){
	 				header('Location:contact.php');
 					exit(); 			
		 		}else{
		 			echo '<div class="alert alert-info"><strong> Warning</strong> The Message ID are not  exist.</div>';
		 		}
		 		echo '<a href="contact.php" class="btn btn-link btn-lg pull-right">Return to Manage Contact</a>';
	 		}else{
 				header('Location:contact.php');
 				exit(); 			
 			}
 			

 		}elseif ($flag=='read') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Reading Message</h1>";
 			if(isset($_GET['msgID']) && is_numeric($_GET['msgID'])){
 				$msg= intval($_GET['msgID']);
 				$stmt   =$con->prepare("UPDATE `message` SET `read` = '1' WHERE `ID` = ?");
	 			$stmt->execute(array($msg));
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount==1){
	 				header('Location:contact.php');
 					exit(); 			
		 		}else{
		 			echo '<div class="alert alert-info"><strong> Warning</strong> The Message ID are not  exist.</div>';
		 		}
		 		echo '<a href="contact.php" class="btn btn-link btn-lg pull-right">Return to Manage Contact</a>';
	 		}else{
 				header('Location:contact.php');
 				exit(); 			
 			}
 			
 			
 							
 			
 			

 		
 		}elseif($flag=='delete'){
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting Message</h1>";
 			if(isset($_GET['msgID']) && is_numeric($_GET['msgID'])){
 				$msg= intval($_GET['msgID']);
 				echo $msg;

	 			$stmt   =$con->prepare("DELETE FROM `message` WHERE ID=?");
	 			$stmt->execute(array($msg));
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount==1){
	 				header('Location:contact.php');
 					exit(); 			
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The Message ID are not  exist.</div>';
	 			}
	 			echo '<a href="contact.php" class="btn btn-link btn-lg pull-right">Return to Manage Contact</a>';
 			}else{
 				header('Location:contact.php');
 				exit(); 			
 			}
 			
		}else{
 			header('Location:contact.php?flag=Manage');
 			exit();
 		}




}else{
	header('Location:index.php');
	exit();

} 
?>

   <?php include $tpl . 'down.inc' ?>