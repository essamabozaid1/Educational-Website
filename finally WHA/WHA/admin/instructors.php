<?php
  /*
	==========================
	==Manage Istractor Page
	==Add/update/delete istractor from here
	==========================
  */
	session_start();
	if(isset($_SESSION['Username'])){
		$pageTitle='Instructor Manage';
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
 			$stmt=$con->prepare("SELECT * FROM instructor");
 			$stmt->execute();
 			$rows=$stmt->fetchAll();

 			?>
 				<h1 class="text-center">Manage Instructor</h1>
		 		<div class="container">
		 			<div class="table-responsive">
		 				<table class="main-table manage_images table table-border">
		 					<tr class="text-center">
		 						
		 						<td>Instructor Name</td>
		 						<td>Instructor Nameِ(AR)</td>
		 						<td>Email</td>
		 						<td>Phone</td>
		 						<td>ID Number</td>
		 						<td>Birth Date</td>
		 						<td>Degrees</td>
		 						<td>Degrees(AR)</td>
		 						<td>Image</td>
		 						<td>Control</td>
		 					</tr>
		 					<?php 
		 					
		 						foreach ($rows as $row) {
		 							echo "<tr class='text-center'>";
		 								
		 								echo "<td>" . $row['instructorName'] . "</td>";
		 								echo "<td>" . $row['instructorNameAr'] . "</td>";
		 								echo "<td>" . $row['email'] . "</td>";
		 								echo "<td>" . $row['phone'] . "</td>";
		 								echo "<td>" . $row['IDNumber'] . "</td>";
		 								echo "<td>" . $row['birthDate'] . "</td>";
		 								echo "<td>" . $row['degrees'] . "</td>";
		 								echo "<td>" . $row['degreesAr'] . "</td>";
		 								echo "<td><img src='upload/images/" . $row['image'] . "' /></td>";		
		 								echo "<td>
		 										<a href='?flag=edit&instructorID=" . $row["instructorID"] ."' class='btn btn-success'>Edit</a>
		 										<a href='?flag=delete&instructorID=" . $row["instructorID"] ."' class='btn btn-danger'>Delete</a>

		 									 </td>";
		 							echo "</tr>";
		 						}
		 						
		 					?>
		 				</table>
		 			</div>
		 			<a href='?flag=add' class="btn btn-primary"><i class="fa fa-plus"> </i> click here to add</a>

		 		</div>	
		 	<?php
 		}elseif ($flag=='add') {?>
 				<h1 class="text-center">Adding Instructor</h1>
		 		<div class="container">
		 			<form action="?flag=insert" method="POST"  enctype="multipart/form-data">
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Instructor Name</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="instructorName"  placeholder="Enter The instructor Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Instructor Name(ARABIC)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="instructorNameAr"  placeholder="Enter The instructor Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Email</label>
						    <div class="col-sm-10">
						      	<input type="email" name="email" class="form-control" placeholder="Enter The Email of The Instructor">
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Phone Number</label>
						    <div class="col-sm-10">
						        <input type="text" name="phone" class="form-control"  placeholder="Enter The Phone Number of The Instructor" >
						    </div>
						</div>
						<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">ID Number</label>
						    <div class="col-sm-10">
						      	<input type="text" name="IDNumber" class="form-control" placeholder="Enter The Instructor ID Number">
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Birth Date</label>
						    <div class="col-sm-10">
						        <input type="Date" name="Birth" class="form-control" placeholder="Enter The Birth Date of Instructor" >
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Degrees</label>
						    <div class="col-sm-10">
						        <input type="text" name="degrees" class="form-control" placeholder="Enter The Degrees of Instructor" required="required">
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Degrees(Arabic)</label>
						    <div class="col-sm-10">
						        <input type="text" name="degreesAr" class="form-control" placeholder="Enter The Degrees of Instructor" required="required">
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Image</label>
						    <div class="col-sm-10">
						        <input type="file" name="upload" class="form-control">
						    </div>
						</div>
						

						<button type="submit" class="btn btn-primary pull-right btn-lg">ADD THE INSTRUCTOR</button>
					</form>
					<a href="instructors.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 

 			<?php
 		}elseif($flag=='insert'){
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Adding Instructor</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){ // to make sure that this page don't browes directly
 				//the variable of form 
 				$instructorName	=$_POST['instructorName'];
 				$instructorNameAr	=$_POST['instructorNameAr'];
 				$email  		=$_POST['email'];
 				$phone 			=$_POST['phone'];
 				$IDNumber	 	=$_POST['IDNumber'];
 				$birthDate 		=$_POST['Birth'];
 				$degrees 	 	=$_POST['degrees'];
 				$degreesAr 	 	=$_POST['degreesAr'];


 				/* for image uplpad */
 				$image 			=$_FILES['upload'];
 				$imageTemp 		=$_FILES['upload']['tmp_name'];
 				 
 				$imageAllowedExtension 	= array('jpeg','png','jpg','gif');
 				$imageExtension 	   	=strtolower(end(explode('.',$image['name'])));

 				if(!empty($image['name']) && ! in_array($imageExtension,$imageAllowedExtension)){
 					echo '<div class="alert alert-warning"><strong>Error!</strong>This Extention Not Allowed</div>';
 				}
 				if($image['size']> 4194304){
 					echo '<div class="alert alert-warning">The Image Can\'t be Larger Than <strong>4MB</strong></div>';
 				}

 				
 				/* end image upload */

 				$stmt=$con->prepare("SELECT MAX( instructorID ) FROM instructor");
 				$stmt->execute();
 				$row=$stmt->fetch();
 				if($row[0]!=0){
	 				$stmt=$con->prepare("ALTER TABLE instructor AUTO_INCREMENT = $row[0]");
	 				$stmt->execute();
 				}else{
 					$stmt=$con->prepare("ALTER TABLE instructor AUTO_INCREMENT = 1");
 					$stmt->execute();
 				}

 				$image='instrutor_'.($row[0]+1).'.png';
 				move_uploaded_file($imageTemp, "upload\images\\".$image);
 				try{
 					$stmt   =$con->prepare("INSERT INTO instructor(instructorName,instructorNameAr, email, phone, IDNumber, birthDate, degrees,degreesAr,image) VALUES(?,?,?,?,?,?,?,?,?)");
 					$stmt->execute(array($instructorName,$instructorNameAr,$email,$phone,$IDNumber,$birthDate,$degrees,$degreesAr,$image));
 					echo '<div class="alert alert-success"><strong>SUCCESS</strong> the Instructor is added.</div>';
 				}catch(PDOException $e){
 					if($e->errorInfo[1]== 1062){
 						echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t add using this Instructor Name:<b>'. $instructorName .  '</b> because it is already existed.</div>';		
 					}else{
 						echo $e;
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t add.</div>';
 					}

 				}
 				echo '<a href="instructors.php" class="btn btn-link btn-lg pull-right">Return to Manage Instructor</a>';
 							
 			}else{
 				header('Location:instructors.php?flag=add');
 			}
 			echo "</div>";
 		}elseif($flag=='edit'){
 			$stmt =$con->prepare("SELECT * FROM instructor where instructorID=?");
 			$stmt->execute(array($_GET['instructorID']));
 			$row=$stmt->fetch();
 			$rowCount=$stmt->rowCount();
 			if($rowCount==1){?>
 				<h1 class="text-center">Editing Instructor</h1>
		 		<div class="container">
		 			<form action="?flag=update" method="POST"  enctype="multipart/form-data">
		 				<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Instructor ID</label>
						    <div class="col-sm-10">
						    	<input name="instructorID" value="<?php echo$row[0]?>"  type="hidden">
						      	<input class="form-control" name="ID" value="<?php echo$row[0]?>"  type="text" disabled>
						    </div>
					 	</div>
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Instructor Name</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="instructorName" value="<?php echo$row[1]?>"  placeholder="Enter The instructor Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Instructor Name(ARABIC)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="instructorNameAr" value="<?php echo$row[2]?>"  placeholder="Enter The instructor Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Email</label>
						    <div class="col-sm-10">
						      	<input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo$row[3]?>" placeholder="Enter The Email of The Instructor">
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Phone Number</label>
						    <div class="col-sm-10">
						        <input type="text" name="phone" value="<?php echo$row[4]?>" class="form-control"  placeholder="Enter The Phone Number of The Instructor" >
						    </div>
						</div>
						<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">ID Number</label>
						    <div class="col-sm-10">
						      	<input type="text" name="IDNumber" value="<?php echo$row[5]?>" class="form-control" id="inputPassword" placeholder="Enter The Instructor ID Number">
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Birth Date</label>
						    <div class="col-sm-10">
						        <input type="Date" name="Birth" value="<?php echo$row[6]?>" class="form-control" id="inputEmail3" placeholder="Enter The Birth Date of Instructor" >
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Degrees</label>
						    <div class="col-sm-10">
						        <input type="text" name="degrees" value="<?php echo$row[7]?>" class="form-control" id="inputEmail3" placeholder="Enter The Degrees of Instructor" >
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Degrees(Arabic)</label>
						    <div class="col-sm-10">
						        <input type="text" name="degreesAr" value="<?php echo$row[8]?>" class="form-control" id="inputEmail3" placeholder="Enter The Degrees of Instructor" >
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Image</label>
						    <div class="col-sm-8">
						        <input type="file" name="upload" class="form-control">
						        <input type="hidden" name="uploadHidden" class="form-control" value="<?php echo $row[9]?>">

						    </div>
						    <div class="col-sm-2 manage_images" >
						    	<img src='<?php echo "upload/images/".$row[9]?>' />
						    </div>
						</div>

						<button type="submit" class="btn btn-primary pull-right btn-lg">SAVE THE EDITING</button>
					</form>
					<a href="instructors.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 
 			
 			<?php
 			}else{
 				header('Location:instructors.php');
 			}

 		}elseif ($flag=='update') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Editing Instructor Info</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){
 				$instructorID		=$_POST['instructorID'];
 				$instructorName		=$_POST['instructorName'];
 				$instructorNameAr	=$_POST['instructorNameAr'];
 				$email  			=$_POST['email'];
 				$phone 				=$_POST['phone'];
 				$IDNumber	 		=$_POST['IDNumber'];
 				$birthDate 			=$_POST['Birth'];
 				$degrees 	 		=$_POST['degrees'];
 				$degreesAr 	 		=$_POST['degreesAr'];

 				/* for image uplpad */
 						
				$image 			=$_FILES['upload'];
 				$imageTemp 		=$_FILES['upload']['tmp_name'];
 				$imageAllowedExtension 	= array('jpeg','png','jpg','gif');
 				$imageExtension 	   	=strtolower(end(explode('.',$image['name'])));

 				if(!empty($image['name']) && ! in_array($imageExtension,$imageAllowedExtension)){
 					echo '<div class="alert alert-warning"><strong>Error!</strong>This Extention Not Allowed</div>';
 				}
 				if($image['size']> 4194304){
 					echo '<div class="alert alert-warning">The Image Can\'t be Larger Than <strong>4MB</strong></div>';
 				}
 				if(!empty($image)){
 					$image='instructor_'.$instructorID.'.png';
 					move_uploaded_file($imageTemp, "upload\images\\".$image);
 				}
		

 				/* end image upload */


 				try{
 					$stmt=$con->prepare("UPDATE instructor SET instructorName=?,instructorNameAr=?,email=?,phone=?,IDNumber=?,birthDate=?,degrees=? ,degreesAr=? ,image=? WHERE instructorID=?");
 					$stmt->execute(array($instructorName,$instructorNameAr,$email,$phone,$IDNumber,$birthDate,$degrees,$degreesAr,$image,$instructorID));
 					if($stmt->rowCount()>0){
 						echo '<div class="alert alert-success"><strong>SUCCESS </strong> The Instructor informations are Updated.</div>'; 	
 					}else{
 						echo '<div class="alert alert-info"><strong> Warning</strong> The Instructor informations are not  changed.</div>';
 					}
 				}catch(PDOException $e){
 					if($e->errorInfo[1]== 1062){
 						echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t edit the Instructor to this Instructor Name:<b>'. $instructorName .  '</b> because it is already existed.</div>';		
 					}else{
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t Edit.</div>';
 					}
 				}
 				echo '<a href="instructors.php" class="btn btn-link btn-lg pull-right">Return to Manage Instructor</a>';
 				
 				
 			}else{
 				header('Location:instructors.php');
 			}
 				
 		}elseif ($flag=='delete') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting Istructor</h1>";
 			if(isset($_GET['instructorID']) && is_numeric($_GET['instructorID'])){
 				$ID= intval($_GET['instructorID']);

 				$stmt   =$con->prepare("SELECT image FROM instructor WHERE instructorID=?");
	 			$stmt->execute(array($ID));
	 			$image=$stmt->fetch();
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount>0){
	 					$fileName	='upload/images/'.$image[0];
		 				$stmt  		=$con->prepare("DELETE FROM `instructor` WHERE instructorID=?");
		 				$stmt->execute(array($ID));
		 				
		 				if(file_exists($fileName) && is_writable($fileName)){
							unlink($fileName);
							header('Location:instructors.php');
							exit();
						}else{		
							echo '<div class="alert alert-info"><strong>Warning</strong> The instructor Imagee is not exist and the instructor is deleted.</div>';			
						}
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The Instructor ID are not  exist.</div>';
	 			}
	 			echo '<a href="instructors.php" class="btn btn-link btn-lg pull-right">Return to Manage Instructor</a>';
 			}else{
 				header('Location:instructors.php');
 			}

 		}else{
 			header('Location:instructors.php');
 		}







	}else{
		header('Location:index.php');
		exit();
	}


?>





   <?php include $tpl . 'down.inc' ?>