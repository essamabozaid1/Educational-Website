<?php
session_start();
if(isset($_SESSION['Username'])){
		$pageTitle='Courses Manage';
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
 			$stmt=$con->prepare("SELECT course.* , category.catName FROM `course` 
								LEFT JOIN category ON  category.categoryID = course.catID");
 			$stmt->execute();
 			$rows=$stmt->fetchAll();

 			?>
 				<h1 class="text-center">Manage Courses</h1>
 				<p class="text-center"><code>IF the Course is Marked by Gray Color Then The Course is INACTIVE , it will not display to users</code></p>
 				<p class="text-center"><code>if the Popular Column is 0 --> it wonot display to user in Popular Courses Section</code></p>
 				<p class="text-center"><code>if the Popular Column is 1 --> it will display to user in Popular Courses Section</code></p>
		 		<div class="container-fluid">
		 			<div class="table-responsive">
		 				<table class="main-table manage_images table table-border">
		 					<tr class="text-center">
		 						
		 						<td>Course Name</td>
		 						<td>Description</td>
		 						<td>Course Name(AR)</td>
		 						<td>Description(AR)</td>
		 						<td>Price</td>
		 						<td>Category Name</td>
		 						<td>Popular</td>
		 						<td>Image</td>
		 						<td>Control</td>
		 					</tr>
		 					<?php 
		 						foreach ($rows as $row) { ?>
		 							<tr class='text-center' <?php if($row['active']=='1'){echo "style='background-color:#777777;'";} ?>>
		 								<?php
		 								//echo "<td>" . $row['courseID'] . "</td>";
		 								echo "<td>" . $row['courseName'] . "</td>";
		 								echo "<td>" . $row['description'] . "</td>";
		 								echo "<td>" . $row['courseNameAr'] . "</td>";
		 								echo "<td>" . $row['descriptionAr'] . "</td>";
		 								echo "<td>" . $row['price'] . "</td>";	
		 								echo "<td>" . $row['catName'] . "</td>";
		 								
		 								echo "<td>" . $row['popular'] . "</td>";
		 								echo "<td><img src='upload/images/" . $row['image'] . "' /></td>";
		 								echo "<td>
		 										<a href='?flag=edit&courseID=" . $row["courseID"] ."' class='btn btn-success'>Edit</a>
		 										<a href='?flag=delete&courseID=" . $row["courseID"] ."' class='btn btn-danger'>Delete</a>

		 									 </td>";
		 							echo "</tr>";
		 						}
		 					?>
		 				</table>
		 			</div>
		 			<a href='?flag=add' class="btn btn-primary"><i class="fa fa-plus"> </i> click here to add</a>

		 		</div>	


 			<?php


 		}elseif($flag=='add'){
 			?>
 				<h1 class="text-center">Adding Course</h1>
		 		<div class="container">
		 			<form action="?flag=insert" method="POST" enctype="multipart/form-data">
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Course Name</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="courseName"  placeholder="Enter The  Course Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Description</label>
						    <div class="col-sm-10">
						      	<input type="text" name="description" class="form-control" id="inputPassword" placeholder="Enter The Description" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Course Name (Arabic)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="courseNameAr"  placeholder="Enter The  Course Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Description (Arabic)</label>
						    <div class="col-sm-10">
						      	<input type="text" name="descriptionAr" class="form-control" placeholder="Enter The Description" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Price</label>
						    <div class="col-sm-10">
						        <input type="text" name="price" class="form-control" id="inputEmail3" placeholder="Enter The Price of The Course" required="">
						    </div>
						</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Active</label>
						    <div class="col-sm-10">
						        <label class="radio-inline">
								      <input type="radio" name="active" value="0" checked>Yes
								</label>
							    <label class="radio-inline">
							     	  <input type="radio" name="active" value="1">NO
							    </label>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Popular Section</label>
						    <div class="col-sm-10">
						        <label class="radio-inline">
								      <input type="radio" name="popular" value="0" checked>No
								</label>
							    <label class="radio-inline">
							     	  <input type="radio" name="popular" value="1">Yes
							    </label>
						    </div>
					 	</div>
					 	
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Category</label>
						    <div class="col-sm-8">
						        <select name='cat' class="form-control">
						        	<option value="0">...</option>
						        	<?php 
						        		$stmt=$con->prepare('SELECT categoryID , catName FROM category');
						        		$stmt->execute();	
						        		$rows=$stmt->fetchAll();
						        		foreach ($rows as  $row) {
						        			echo "<option value='". $row['categoryID'] ."'> " .$row['catName'] . "</option>";
						        		 } 
						        	?>
						        </select>
						       
						    </div>
						     <div class="col-sm-2">
						        	<a href="category.php?flag=add" class="form-control btn btn-warning" style="color: #fff;">Add New Category</a>
						        </div>
					 	</div>	
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Image</label>
						    <div class="col-sm-10">
						        <input type="file" name="upload" class="form-control">
						    </div>
						</div>
						

						<button type="submit" class="btn btn-primary pull-right btn-lg">ADD THE Course</button>
						<a href="Courses.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
					</form>
					
				</div> 

 			
 		
 			<?php
 		}elseif($flag=='insert'){
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Adding New Course</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){ // to make sure that this page don't browes directly
 				//the variable of form 
 				$courseName			=$_POST['courseName'];
 				$description 		=$_POST['description'];
 				$courseNameAr		=$_POST['courseNameAr'];
 				$descriptionAr	 	=$_POST['descriptionAr'];
 				$price 				=$_POST['price'];
 				$active  			=$_POST['active'];
 				$popular  			=$_POST['popular'];
 				$catID 				=$_POST['cat'];
 				/* for image uplpad */
 				$image 				=$_FILES['upload'];
 				$imageTemp 			=$_FILES['upload']['tmp_name'];
 				 
 				$imageAllowedExtension 	= array('jpeg','png','jpg','gif');
 				$imageExtension 	   	=strtolower(end(explode('.',$image['name'])));

 				if(!empty($image['name']) && ! in_array($imageExtension,$imageAllowedExtension)){
 					echo '<div class="alert alert-warning"><strong>Error!</strong>This Extention Not Allowed</div>';
 				}
 				if($image['size']> 4194304){
 					echo '<div class="alert alert-warning">The Image Can\'t be Larger Than <strong>4MB</strong></div>';
 				}

 				$image='course_'.$courseName.'.png';
 				move_uploaded_file($imageTemp, "upload\images\\".$image);
 				/* end image upload */
 				$stmt=$con->prepare("SELECT MAX( courseID ) FROM course");
 				$stmt->execute();
 				$row=$stmt->fetch();
 				if($row[0]!=0){
	 				$stmt=$con->prepare("ALTER TABLE course AUTO_INCREMENT = $row[0]");
	 				$stmt->execute();
 				}else{
 					$stmt=$con->prepare("ALTER TABLE course AUTO_INCREMENT = 1");
 					$stmt->execute();
 				}

 				try{
 					$stmt=$con->prepare("INSERT INTO course(courseName , description ,courseNameAr , descriptionAr ,price,active,popular,image,catID) VALUES(?,?,?,?,?,?,?,?,?)");
 					$stmt->execute(array($courseName,$description,$courseNameAr,$descriptionAr,$price,$active,$popular,$image,$catID));
 					echo '<div class="alert alert-success"><strong>SUCCESS</strong> the Course is added.</div>';
 				}catch(PDOException $e){
 					if($e->errorInfo[1]== 1062){
 						echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t add using this Course:<b>'. $courseName .  '</b> because it is already existed.</div>';		
 					
 					}elseif ($e->errorInfo[1]== 1452) {
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You must Select Category for this course</div>'; 									
 					}else{
 						print_r($e);
 						echo '<div class="alert alert-danger"><strong>Error</strong>You can\'t add.</div>';
 					}

 				}
 				echo '<a href="courses.php" class="btn btn-link btn-lg pull-right">Return to Manage Course</a>';
 							
 			}else{
 				header('Location:Courses.php');
 			}
 			echo "</div>";
 			

 		}elseif($flag=='edit'){
 			$stmt =$con->prepare("SELECT * FROM course where courseID=?");
 			$stmt->execute(array($_GET['courseID']));
 			$row=$stmt->fetch();
 			$rowCount=$stmt->rowCount();
 			if($rowCount==1){?>
 				<h1 class="text-center">Editing Course</h1>
		 		<div class="container">
		 			<form action="?flag=update" method="POST" enctype="multipart/form-data">
		 				<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Course ID</label>
						    <div class="col-sm-10">
						    	<input name="courseID" value="<?php echo $row[0]?>"  type="hidden">
						      	<input class="form-control" name="ID" value="<?php echo $row[0]?>"  type="text" disabled>
						    </div>
					 	</div>
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Course Name</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="courseName" value="<?php echo $row[1]?>"  placeholder="Enter The Course Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Description</label>
						    <div class="col-sm-10">
						      	<input type="text" name="description" value="<?php echo $row[2]?>"  class="form-control" placeholder="Enter The Description" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Course Name(Arabic)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="courseNameAr" value="<?php echo $row[3]?>"  placeholder="Enter The Course Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Description(Arabic</label>
						    <div class="col-sm-10">
						      	<input type="text" name="descriptionAr" value="<?php echo $row[4]?>"  class="form-control" placeholder="Enter The Description" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Course Price</label>
						    <div class="col-sm-10">
						        <input type="text" name="price" value="<?php echo$row[5]?>"  class="form-control" id="inputEmail3" placeholder="Enter The price of Course" required>
						    </div>
						</div>
					 	<div class="form-group row">
					    	
					    	<label class="col-sm-2 col-form-label">Active</label>
						    <div class="col-sm-10">
						        <label class="radio-inline">
								      <input type="radio" name="active" value="0" <?php if($row[6]==0){echo 'checked';}?>>Yes
								</label>
							    <label class="radio-inline">
							     	  <input type="radio" name="active" value="1" <?php if($row[6]==1){echo 'checked';}?> >NO
							    </label>
						    </div>
					 	
					 	</div>
					 	<div class="form-group row">
					    	
					    	<label class="col-sm-2 col-form-label">Popular Section</label>
						    <div class="col-sm-10">
						        <label class="radio-inline">
								      <input type="radio" name="popular" value="0" <?php if($row[9]==0){echo 'checked';}?>>NO
								</label>
							    <label class="radio-inline">
							     	  <input type="radio" name="popular" value="1" <?php if($row[9]==1){echo 'checked';}?> >YES
							    </label>
						    </div>
					 	
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Image</label>
						    <div class="col-sm-8">
						        <input type="file" name="upload" class="form-control">
						        <input type="hidden" name="uploadHidden" class="form-control" value="<?php echo $row[7]?>">

						    </div>
						    <div class="col-sm-2 manage_images" >
						    	<img src='<?php echo "upload/images/".$row[7]?>' />
						    </div>
						</div>
			
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Category</label>
						    <div class="col-sm-8">
						        <select name='cat' class="form-control">
						        	<?php 
						        		$alreadySelected=$row[8];
						        		$stmt=$con->prepare('SELECT categoryID , catName FROM category');
						        		$stmt->execute();
						        		$rows=$stmt->fetchAll();
						        		foreach ($rows as  $row) {
						        			echo "<option value='". $row['categoryID'] ."'";
						        			if($alreadySelected==$row['categoryID']){echo 'selected';}
						        			echo">"   .$row['catName'] . "</option>";
						        		 } 
						        	?>
						        </select>
						       
						    </div>
						</div>
						

						<button type="submit" class="btn btn-primary pull-right btn-lg">SAVE THE EDITING</button>
					</form>
					<a href="courses.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 
 			
 			<?php
 			}else{
 				header('Location:courses.php');
 			}
 		}elseif ($flag=='update') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Editing Course Info</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){
 				$courseID			=$_POST['courseID']; // hkml  
 				$courseName			=$_POST['courseName'];
 				$description 		=$_POST['description'];
 				$courseNameAr		=$_POST['courseNameAr'];
 				$descriptionAr 		=$_POST['descriptionAr'];
 				$price 				=$_POST['price'];
 				$active  			=$_POST['active'];
 				$popular  			=$_POST['popular'];

 				$catID 				=$_POST['cat'];
 				/* for image uplpad */
 				
 				
 				
				$image 				=$_FILES['upload'];
 				$imageTemp 			=$_FILES['upload']['tmp_name'];
 				 
 				$imageAllowedExtension 	= array('jpeg','png','jpg','gif');
 				$imageExtension 	   	=strtolower(end(explode('.',$image['name'])));

 				if(!empty($image['name']) && ! in_array($imageExtension,$imageAllowedExtension)){
 					echo '<div class="alert alert-warning"><strong>Error!</strong>This Extention Not Allowed</div>';
 				}
 				if($image['size']> 4194304){
 					echo '<div class="alert alert-warning">The Image Can\'t be Larger Than <strong>4MB</strong></div>';
 				}

 				if(empty($image)){
 					$image=$imageHidden;
 				}else{
 					$image='course_'.$courseName.'.png';

 					move_uploaded_file($imageTemp, "upload\images\\".$image);

 				}
		

 				/* end image upload */

 				try{
 					$stmt=$con->prepare("UPDATE course SET courseName=?, description=?  ,courseNameAr=?, descriptionAr=?, price=? ,active=?,popular=? ,image=? ,catID=? WHERE courseID=?");
 					$stmt->execute(array($courseName,$description,$courseNameAr,$descriptionAr,$price,$active,$popular,$image,$catID,$courseID));
 					if($stmt->rowCount()>0){
 						echo '<div class="alert alert-success"><strong>SUCCESS </strong> The course informations are Updated.</div>'; 	
 					}else{
 						echo '<div class="alert alert-info"><strong> Warning</strong> The Course informations are not  changed.</div>';
 					}
 				}catch(PDOException $e){
 					if($e->errorInfo[1]== 1062){
 						echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t edit the course using this Course Name:<b>'. $courseName .  '</b> because it is already existed.</div>';
 					}elseif ($e->errorInfo[1]== 1452) {
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You must Select Category for this course</div>'; 									
 					}else{
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t add.</div>';
 					}
 						
 				}
 				echo '<a href="courses.php" class="btn btn-link btn-lg pull-right">Return to Manage courses</a>';
 				
 				
 			}else{
 				header('Location:courses.php');
 				exit();
 			}
 				
 		}elseif($flag=='delete'){
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting Course</h1>";
 			if(isset($_GET['courseID']) && is_numeric($_GET['courseID'])){
 				$ID= intval($_GET['courseID']);

 				$stmt   =$con->prepare("SELECT image FROM course WHERE courseID=?");
	 			$stmt->execute(array($ID));
	 			$image=$stmt->fetch();
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount>0){
	 					$fileName	='upload/images/'.$image[0];
		 				$stmt  		=$con->prepare("DELETE FROM `course` WHERE courseID=?");
		 				$stmt->execute(array($ID));
		 				
		 				if(file_exists($fileName) && is_writable($fileName)){
							unlink($fileName);
							header('Location:courses.php');
							exit();
						}else{		
							echo '<div class="alert alert-info"><strong>Warning</strong> The course Image is not exist and the course is deleted.</div>';			
						}
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The Course ID are not  exist.</div>';
	 			}
	 			echo '<a href="courses.php" class="btn btn-link btn-lg pull-right">Return to Manage Course</a>';
 			}else{
 				header('Location:courses.php');
 				exit(); 			
 			}
		}else{
 			header('Location:courses.php?flag=Manage');
 			exit();
 		}




}else{
	header('Location:index.php');
	exit();

} 
?>

   <?php include $tpl . 'down.inc' ?>