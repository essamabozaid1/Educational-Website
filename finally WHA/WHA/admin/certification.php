<?php
session_start();
if(isset($_SESSION['Username'])){
	$pageTitle='Category Manage';
	$CSSFile="custom.css";
	include 'init.php';
	include $tpl . 'header.inc';

	$flag ='';
 		//to take the value of the flag get and if it don't have value put it by manage
 	if(isset($_GET['flag'])){
 		$flag=$_GET['flag'];
 	}else{
 		$flag='Manage';
 	} 

 	if($flag=='Manage'){ 

 		$stmt=$con->prepare("SELECT * FROM certification");
 		$stmt->execute();
 		$rows=$stmt->fetchAll();

 			?>
 				<h1 class="text-center">Manage Certification</h1>
		 		<div class="container">
		 			<div class="table-responsive">
		 				<table class="main-table table table-border">
		 					<tr class="text-center">
		 						<td>#ID</td>
		 						<td>Student Name</td>
		 						<td>Course Name</td>
		 						<td>Start</td>
		 						<td>End</td>
		 						<td>Hours</td>
		 						<td>Controls</td>
		 					</tr>
		 					<?php 
		 						foreach ($rows as $row) {
		 							echo "<tr class='text-center'>";
		 								echo "<td>" . $row['ID'] . "</td>";
		 								echo "<td>" . $row['studentName'] . "</td>";
		 								echo "<td>" . $row['courseName'] . "</td>";
		 								echo "<td>" . $row['startTime'] . "</td>";	
		 								echo "<td>" . $row['endTime'] . "</td>";
		 								echo "<td>" . $row['hours'] . "</td>";
		 								echo "<td>
		 										<a href='?flag=edit&certID=" . $row["ID"] ."' class='btn btn-success'>Edit</a>
		 	
		 										<a href='?flag=delete&certID=" . $row["ID"] ."' class='btn btn-danger'>Delete</a>

		 									 </td>";
		 							echo "</tr>";
		 						}
		 					?>
		 					<form method="POST" action="?flag=insert">
		 						<tr>
		 							<td><input class="form-control" name="ID"  placeholder="Certification ID" type="text" required></td>
		 							<td><input class="form-control" name="studentName"  placeholder="Student Name" type="text" required></td>
		 							<td><input class="form-control" name="courseName"  placeholder="Course Name" type="text" required></td>
		 							<td><input class="form-control" name="startTime"  placeholder="Start Time" type="date"></td>
		 							<td><input class="form-control" name="endTime"  placeholder="End Time" type="date" ></td>
		 							<td><input class="form-control" name="hours"  placeholder="Hours" type="text" ></td>
		 							<td><button type="submit" class="btn btn-primary">ADD Certification</button></td>


		 						</tr>	
		 					</form>
		 					
		 				</table>
		 			</div>
		 			
		 		</div>	


		 	<?php
 	}elseif ($flag=='insert') {
 		if($_SERVER['REQUEST_METHOD']=='POST'){
 			$ID				=$_POST['ID'];
 			$studentName	=$_POST['studentName'];
 			$courseName		=$_POST['courseName'];
 			$startTime		=$_POST['startTime'];
 			$endTime		=$_POST['endTime'];
 			$hours			=$_POST['hours'];
 			try{
				$stmt   =$con->prepare("INSERT INTO certification(ID , studentName, courseName,startTime,endTime,hours) VALUES(?,?,?,?,?,?)");
				$stmt->execute(array($ID,$studentName,$courseName,$startTime,$endTime,$hours));
				header('Location:certification.php');
				exit();
			}catch(PDOException $e){
				echo "<div class='container'>";
 					echo "<h1 class='text-center'>Adding New Certification</h1>";
				if($e->errorInfo[1]== 1062){
					echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t add using this ID:<b>'. $ID .  '</b> because it is already existed.</div>';	
						
				}else{
					echo '<div class="alert alert-danger"><strong>Error</strong>You can\'t add.</div>';
					echo $e;
				}
				echo '<a href="certification.php" class="btn btn-link btn-lg pull-right">Return to Manage certification</a>';
				echo "</div>";

			}
 		}
 		else{
			header('Location:certification.php');
			exit();
 		}
 	}elseif ($flag=='edit') {
 		$stmt =$con->prepare("SELECT * FROM certification where ID=?");
 		$stmt->execute(array($_GET['certID']));
 		$row=$stmt->fetch();
 		$rowCount=$stmt->rowCount();
 		if($rowCount==1){?>
 				<h1 class="text-center">Editing The Certification</h1>
		 		<div class="container">
		 			<form action="?flag=update" method="POST">
		 				<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Certification ID</label>
						    <div class="col-sm-10">
						    	<input class="form-control" value="<?php echo $row[0];?>" name="oldID" type="hidden">
						      	<input class="form-control" value="<?php echo $row[0];?>" name="ID" type="text">
						    </div>
					 	</div>
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Student Name</label>
						    <div class="col-sm-10">
						      	<input class="form-control" value="<?php echo $row[1];?>" name="studentName"  placeholder="Enter The student Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Course Name</label>
						    <div class="col-sm-10">
						      	<input type="text" value="<?php echo $row[2];?>" name="courseName" class="form-control" placeholder="Enter The Course" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Start Time</label>
						    <div class="col-sm-10">
						        <input type="date" value="<?php echo $row[3];?>" name="startTime" class="form-control" placeholder="Enter The start Time" >
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">End Time</label>
						    <div class="col-sm-10">
						        <input type="date" value="<?php echo $row[4];?>" name="endTime" class="form-control" placeholder="Enter The End Time" >
						    </div>
						</div>
						<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Hours Number</label>
						    <div class="col-sm-10">
						      	<input type="text" value="<?php echo $row[5];?>" name="hours" class="form-control" placeholder="Enter The Number of Hours">
						    </div>
					 	</div>
					 	

						<button type="submit" class="btn btn-primary pull-right btn-lg">Editing THE Cerification</button>
					</form>
					<a href="certification.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 
 			
 			<?php
 			}else{
 				header('Location:certification.php');
 			}
 	}elseif ($flag=='update') {
 		echo "<div class='container'>";
 			echo "<h1 class='text-center'>Editing Category</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){
 				$oldID			=$_POST['oldID'];
	 			$ID				=$_POST['ID'];
	 			$studentName	=$_POST['studentName'];
	 			$courseName		=$_POST['courseName'];
	 			$startTime		=$_POST['startTime'];
	 			$endTime		=$_POST['endTime'];
	 			$hours			=$_POST['hours'];

 				try{
 					$stmt   =$con->prepare("UPDATE certification SET ID=?, studentName=?  , courseName=? ,startTime=?,endTime=?,hours=? WHERE ID=?");
 					$stmt->execute(array($ID,$studentName,$courseName,$startTime,$endTime,$hours,$oldID));
 					if($stmt->rowCount()!=0){
 						echo '<div class="alert alert-success"><strong>SUCCESS </strong> The Certification informations are Updated.</div>'; 
 						
 					}else{
 						echo '<div class="alert alert-info"><strong> Warning</strong> The Certification informations are not changed.</div>';
 					}
 				}catch(PDOException $e){
 					if($e->errorInfo[1]== 1062){
 						echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t edit the certification using this ID:<b>'. $ID .  '</b> because it is already existed.</div>';		
 					}else{
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t Edit.</div>';
 					}
 				}
 				echo '<a href="certification.php" class="btn btn-link btn-lg pull-right">Return to Manage Certification</a>';
 				
 				
 			}else{
 				header('Location:certification.php');
 				exit();
 			}
 	}elseif ($flag=='delete') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting Certification</h1>";
 			if(isset($_GET['certID']) && is_numeric($_GET['certID'])){
 				$ID= intval($_GET['certID']);

	 			$stmt   =$con->prepare("DELETE FROM `certification` WHERE ID=?");
	 			$stmt->execute(array($ID));
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount==1){
	 					header('Location:certification.php');
	 					exit();
	 
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The Certification ID are not  exist.</div>';
	 			}
	 			echo '<a href="certification.php" class="btn btn-link btn-lg pull-right">Return to Manage Category</a>';
 			}else{
 				header('Location:certification.php');
 			}
 	}
 	else{
 		header('Location:certification.php');
 	}









}else{
	header('Location:index.php');
	exit();
}


?>





   <?php include $tpl . 'down.inc' ?>