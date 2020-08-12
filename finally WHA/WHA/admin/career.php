<?php
  /*
	==========================
	==Manage  Page
	==Add/update/delete Clients from here
	==========================
  */
	session_start();
	if(isset($_SESSION['Username'])){
		$pageTitle='career Manage';
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
 			$stmt=$con->prepare("SELECT * FROM career");
 			$stmt->execute();
 			$rows=$stmt->fetchAll();

 			?>
 				<h1 class="text-center">Manage The Jobs</h1>
		 		<div class="container">
		 			<div class="table-responsive">
		 				<table class="main-table table table-border">
		 					<tr class="text-center">
		 						<td>#ID</td>
		 						<td>Name</td>
		 						<td>Email</td>
		 						<td>Phone</td>
		 						<td>Birth Date</td>
		 						<td>Letter</td>
		 						<td>Position</td>
		 						<td>Controls</td>
		 					</tr>
		 					<?php 
		 						foreach ($rows as $row) {
		 							echo "<tr class='text-center'>";
		 								echo "<td>" . $row['ID'] . "</td>";
		 								echo "<td>" . $row['name'] . "</td>";
		 								echo "<td>" . $row['email'] . "</td>";
		 								echo "<td>" . $row['phone'] . "</td>";	
		 								echo "<td>" . $row['birthDate'] . "</td>";
		 								echo "<td>" . $row['letter'] . "</td>";		
		 								echo "<td>" . $row['position'] . "</td>";
		 								echo "<td>
		 										<a href='?flag=download&careerID=" . $row["ID"] ."' class='btn btn-warning'>Download CV</a>		 	
		 										<a href='?flag=delete&careerID=" . $row["ID"] ."' class='btn btn-danger'>Delete</a>

		 									 </td>";
		 							echo "</tr>";
		 						}
		 					?>
		 				</table>
		 			</div>
		 		</div>	
 			<?php 						
 	   	}elseif ($flag=='download') {
 	   		echo "<div class='container'>";
 			echo "<h1 class='text-center'>Download Jobs</h1>";
 			if(isset($_GET['careerID']) && is_numeric($_GET['careerID'])){
 	   			$ID=intval($_GET['careerID']);
 	   			$stmt   =$con->prepare("SELECT CV FROM career WHERE ID=?");
	 			$stmt->execute(array($ID));
	 			$CVname=$stmt->fetch();
	 			$fileName	='upload/CV/'.$CVname[0];
	 			if(file_exists($fileName)){
	 				header('Location:'.$fileName);
	 				exit();
	 			}else{
	 				echo '<div class="alert alert-danger"><strong>Warning</strong> The CV is not exist</div>';
	 				echo '<a href="career.php" class="btn btn-link btn-lg pull-right">Return to Manage Jobs</a>';
	 			}

 	   			

 	   		}else{
 				header('Location:career.php');
 				exit();
 			}

 	   		
 		}elseif($flag=='delete'){
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting Jobs</h1>";
 			if(isset($_GET['careerID']) && is_numeric($_GET['careerID'])){
 				$ID= intval($_GET['careerID']);
	 			$stmt   =$con->prepare("SELECT CV FROM career WHERE ID=?");
	 			$stmt->execute(array($ID));
	 			$CVname=$stmt->fetch();
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount>0){
	 					$fileName	='upload/CV/'.$CVname[0];
		 				$stmt  		=$con->prepare("DELETE FROM `career` WHERE ID=?");
		 				$stmt->execute(array($ID));
		 				
		 				if(file_exists($fileName) && is_writable($fileName)){
							unlink($fileName);
							header('Location:career.php');
							exit();
						}else{		
							echo '<div class="alert alert-info"><strong>Warning</strong> The CV is not exist and the Job is deleted.</div>';			
						}
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The Job ID is not exist.</div>';
	 			}
	 			echo '<a href="career.php" class="btn btn-link btn-lg pull-right">Return to Manage Jobs</a>';
 			}else{
 				header('Location:career.php');
 				exit();
 			}
 		}else{
 			header('Location:career.php');
 			exit();
 		}
 		echo "</div>";


	}else{
		header('Location:index.php');
		exit();
	}


?>





   <?php include $tpl . 'down.inc' ?>