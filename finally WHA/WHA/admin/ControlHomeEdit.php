<?php 
	session_start();
	if(isset($_SESSION['Username'])){
		$pageTitle='Admin Home';
		$CSSFile='custom.css';
		include 'init.php';
 		include $tpl . 'header.inc';


 		$outputevent='';
 		$outputadv='';

 		$flag ='';
 		$flagSlide='';
 		$advertise='';
 		$event='';
 		$upcomingEvent='';
 		//to take the value of the flag get and if it don't have value put it by manage
 		if(isset($_GET['flag'])){
 			$flag=$_GET['flag'];
 		}else{
 			$flag='Manage';
 		} 
 		if(isset($_GET['upcomingEvent'])){ // to edit or delete
 			$upcomingEvent=$_GET['upcomingEvent'];
 		}
 		if(isset($_GET['flagSlide'])){
 			$flagSlide=$_GET['flagSlide'];
 		}
 		if(isset($_GET['advertise'])){
 			$advertise=$_GET['advertise'];
 		}if(isset($_GET['event'])){ // to add event 
 			$event=$_GET['event'];
 		}

 		
 		


 		

 		// to splite to more one page
 		if ($flag=='Manage' && empty($flagSlide) && empty($upcomingEvent) ){ 
 			if($advertise=='add'){
 				if($_SERVER['REQUEST_METHOD']=='POST'){

	 				$title		=$_POST['title'];
	 				$text 	 	=$_POST['text'];
	 				$titleAr	=$_POST['titleAr'];
	 				$textAr 	=$_POST['textAr'];
	 				$link 	 	=$_POST['link'];
	 				try{
	 					$stmt=$con->prepare("UPDATE `advertise` SET `title`=?,`text`=?,`titleAr`=?,`textAr`=? ,link=? WHERE `ID`=1");
	 					$stmt->execute(array($title,$text,$titleAr,$textAr,$link));
	 				}catch(PDOException $e){
	 					$outputadv=$e->getMessage ();
	 				}
	 				
	 			}else{
	 				header('Location:ControlHomeEdit.php');
					exit();
	 			}	
 			}
 			if($event=='add'){
 				if($_SERVER['REQUEST_METHOD']=='POST'){ // to make sure that this page don't browes directly
 				//the variable of form 
	 				$date				=$_POST['date'];
	 				$eventName 		 	=$_POST['eventName'];
	 				$location 	 		=$_POST['location'];
	 				$eventPara 		 	=$_POST['eventPara'];
	 				$eventNameAr 	 	=$_POST['eventNameAr'];
	 				$locationAr 	 	=$_POST['locationAr'];
	 				$eventParaAr 	 	=$_POST['eventParaAr'];
	 				
	 				//image111
	 				$image 			=$_FILES['image'];
	 				$imageTemp 		=$_FILES['image']['tmp_name'];
	 				 
	 				$imageAllowedExtension 	= array('jpeg','png','jpg','gif');
	 				$imageExtension 	   	=strtolower(end(explode('.',$image['name'])));

	 				if(!empty($image['name']) && ! in_array($imageExtension,$imageAllowedExtension)){
	 					echo '<div class="alert alert-warning"><strong>Error!</strong>This Extention Not Allowed</div>';
	 				}
	 				if($image['size']> 4194304){
	 					echo '<div class="alert alert-warning">The Image Can\'t be Larger Than <strong>4MB</strong></div>';
	 				}

	 				//end image

	 				//adjust ID

	 				$stmt=$con->prepare("SELECT MAX( ID ) FROM event");
	 				$stmt->execute();
	 				$row=$stmt->fetch();
	 				if($row[0]!=0){
	 					$stmt=$con->prepare("ALTER TABLE event AUTO_INCREMENT = $row[0]");
	 					$stmt->execute();
	 				}else{
	 					$stmt=$con->prepare("ALTER TABLE event AUTO_INCREMENT = 1");
	 					$stmt->execute();
	 				}
	 				$image='event_'.($row[0]+1).'.png';
	 				move_uploaded_file($imageTemp, "upload\images\\".$image);
	 				//end adjust ID
	 				try{
						$stmt=$con->prepare("INSERT INTO 
							event(eventDate, eventName,eventLocation,eventPara,eventNameAr,eventLocationAr,eventParaAr,mainImage)VALUES(?,?,?,?,?,?,?,?)");
						$stmt->execute(array($date,$eventName,$location,$eventPara,$eventNameAr,$locationAr,$eventParaAr,$image));
						$outputevent='The Event is added Successfully';
					}catch(PDOException $e){
						$outputevent=$e->getMessage ();
					}
				}else{
					header('Location:ControlHomeEdit.php');
					exit();
				}	
 			}

 			//------------------------------------------start to display
 			$stmt=$con->prepare("SELECT * FROM `carousel`"); 
 			$stmt->execute();
 			$rows=$stmt->fetchAll();
 			?>
 			<div class="container">


 				<h3 class="text-center">STATISTIC INFORMATION</h3>
 				<div class="row  text-center ">
 					<div class="col-md-3">
 						<div class="stat" style="background-color: #3498db">
 							OUR CLIENTS
 							<span><a href="clients.php"><?php echo getCount('clientID','client') ?></a></span>
 						</div>
 					</div>
 					<div class="col-md-3">
 						<div class="stat" style="background-color: #e74c3c">
 							NEW MESSAGES
 							<span><a href="contact.php"><?php echo getCountNewMessages() ?></a></span>
 						</div>
 					</div>
 					<div class="col-md-3">
 						<div class="stat" style="background-color: #e67e22">
 							OUR COURSES
 							<span><a href="courses.php"><?php echo getCount('courseID','course') ?></a></span>
 						</div>
 					</div>
 					<div class="col-md-3">
 						<div class="stat" style="background-color: #8e44ad">
 							OUR APPLICANT
 							<span><a href="career.php"><?php echo getCount('ID','career') ?></a></span>
 						</div>
 					</div>
 				</div>


 			</div>
 			<div class='container-fluid'>
 				<h3 class="text-center">Slide</h3>
 				


 				<p class="text-center"><code>if you want to mark some words , put the words between &lt;span&gt;  &lt;/span&gt; </code></p>
			 	<div class="table-responsive container-fluid">
	 				<table id='SlideTable' class="main-table manage_images table table-border">
	 					<tr class="text-center">
	 						<td>#ID</td>
	 						<td>Slide Header</td>
	 						<td>Slide Paragraph</td>
	 						<td>Slide Header Arabic</td>
	 						<td>Slide Paragraph Arabic</td>
	 						<td>Slide Image</td>
	 						<td>Control</td>
	 					</tr>
	 					<?php 
	 						foreach ($rows as $row) {
	 							echo "<tr class='text-center'>";
	 								echo "<td>" . $row['SlideID'] . "</td>";
	 								echo "<td>" . $row['SlideHeader'] . "</td>";
	 								echo "<td>" . $row['SlidePara'] . "</td>";
	 								echo "<td>" . $row['SlideHeaderAr'] . "</td>";
	 								echo "<td>" . $row['SlideParaAr'] . "</td>";

	 								echo "<td><img src='upload/images/" . $row['SlideImage'] . "' /></td>";
	 								echo "<td>
	 								<a href='?flagSlide=edit&SlideID=" . $row["SlideID"] ."' class='btn btn-success'>Edit</a>
	 								<a href='?flagSlide=delete&SlideID=" . $row["SlideID"] ."' class='btn btn-danger'>Delete</a>

	 									 </td>";
	 							echo "</tr>";
	 						}
	 					?>
	 					
	 				</table>
	 				<a href='?flagSlide=add' class="btn btn-primary"><i class="fa fa-plus"> </i> click here to add</a>
	 			</div>

	 			<hr style="border-top: 1px solid #337ab7;">

	 		<div class="container">

	 			<h3 class="text-center">Popular Courses</h3>
	 			<p class="text-center"><code> you must select only 3 Courses in Popular Couses Section </code> </p>
	 			<div>
					<?php
						$stmt=$con->prepare("SELECT courseName ,catName FROM `course` join category ON  category.categoryID = course.catID
							WHERE popular=1 AND active=0"); 
 						$stmt->execute();
 						$rows=$stmt->fetchAll();

 						foreach ($rows as $row) {
 							echo "<p class='text-center alert alert-info'> ".$row['courseName'] ." - ".$row['catName']." </p>";

 						}


					?>
					<a href='courses.php' class="btn btn-primary"><i class="fa fa-plus"> </i> Edit Courses in Popular </a>				 				
	 			</div>



	 			<hr style="border-top: 1px solid #337ab7;">



	 			<h3 class="text-center">Advertise</h3>
	 			<p class="text-center" style="color: #4CAF50;"><?php echo $outputadv ;?></p>
	 			<p class="text-center"><code>if you want to mark some words , put the words between &lt;span&gt;  &lt;/span&gt; </code> <br><code>&lt;span&gt;some words&lt;/span&gt;</code>
	 			</p>
	 			<div>
	 				 <form method="POST" action="?advertise=add">
	 				 <div class="row">
	 				 	<div class="col-md-6">
		 				 	<div class="form-group row">
							    <label class="col-sm-2 col-form-label">Title</label>
							    <div class="col-sm-10">
							      	<input class="form-control" name="title"  placeholder="Enter The  Title of Advertise" type="text" required>
							    </div>
						 	</div>
						 	<div class="form-group row">
							    <label class="col-sm-2 col-form-label">Text</label>
							    <div class="col-sm-10">
							      	<textarea class="form-control" name="text"  placeholder="Enter The  Text of Advertise" required="required"></textarea>
							    </div>
						 	</div>
						</div>
		 				<div class="col-md-6">
		 					<div class="form-group row">
							    <label class="col-sm-2 col-form-label">Title Arabic</label>
							    <div class="col-sm-10">
							      	<input class="form-control" name="titleAr"  placeholder="Enter The arabic Title of Advertise" type="text" required>
							    </div>
						 	</div>

						 	<div class="form-group row">
							    <label class="col-sm-2 col-form-label">Text Arabic</label>
							    <div class="col-sm-10">
							      	<textarea class="form-control" name="textAr"  placeholder="Enter The arabic Text of Advertise" required="required"></textarea>
							    </div>
						 	</div>
		 				</div>
		 			</div>
		 			<div class="row">
		 				<div class="col-md-12">
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Link</label>
						    <div class="col-sm-10">
						      	<input type="text" class="form-control" name="link"  placeholder="Enter The  Link of Advertise" required="required">
						    </div>
					 	</div>
					 	</div>
					 </div>
	 				 	<button type="submit" class="btn btn-primary pull-right btn-lg">ADD New Advertise</button>		 	  <div class="clearfix"></div>
		 				

		 				
	 				 </form>

	 			</div>



	 			<hr style="border-top: 1px solid #337ab7;">



	 			<h3 class="text-center">Our Students say</h3>
	 			<div>
	 				<?php
						$stmt=$con->prepare("SELECT * FROM `message` WHERE appear=1"); 
 						$stmt->execute();
 						$rows=$stmt->fetchAll();

 						foreach ($rows as $row) {
 							echo "<label class='text-center'> ".$row['name'] ." </label>";
 							echo "<p class='alert alert-info'>".$row['message']." </p>";

 						}


					?>
					<a href='contact.php' class="btn btn-primary"><i class="fa fa-plus"> </i> To Change The Appeared Messages</a>				 				

	 			</div>


	 		</div>
	 		<div class="container-fluid">
	 			<hr style="border-top: 1px solid #337ab7;">



	 			<h3 class="text-center">Events</h3>
	 			<p class="text-center" style="color: #4CAF50;"><?php echo $outputevent ;?></p>
	 			<div class="table-responsive">

	 				<table id='SlideTable' class="main-table manage_images table table-border">
	 					<tr class="text-center">
	 				 	 	
	 						<td>Date</td>
	 						<td>Event Name</td>
	 						<td>Location</td>
	 						<td>Comment</td>
	 						<td>Event Name(AR)</td>
	 						<td>Location(AR)</td>
	 						<td>Comment(AR)</td>
	 						<td>Image</td>
	 						<td>Control</td>
	 					</tr>
	 					<?php 
	 						$stmt=$con->prepare("SELECT * FROM event");
 							$stmt->execute();
 							$rows=$stmt->fetchAll();
	 						foreach ($rows as $row) {
	 							echo "<tr class='text-center'>";
	 								//echo "<td>" . $row['ID'] . "</td>";
	 								echo "<td>" . $row['eventDate'] . "</td>";
	 								echo "<td>" . $row['eventName'] . "</td>";
	 								echo "<td>" . $row['eventLocation'] . "</td>";
	 								echo "<td>" . $row['eventPara'] . "</td>";
	 								echo "<td>" . $row['eventNameAr'] . "</td>";
	 								echo "<td>" . $row['eventLocationAr'] . "</td>";
	 								echo "<td>" . $row['eventParaAr'] . "</td>";
	 		
	 								echo "<td><img src='upload/images/" . $row['mainImage'] . "' /></td>";
	 								echo "<td>
	 								<a href='?upcomingEvent=edit&eventID=" . $row["ID"] ."' class='btn btn-success'>Edit</a>
	 								<a href='?upcomingEvent=delete&eventID=" . $row["ID"] ."' class='btn btn-danger'>Delete</a>

	 									 </td>";
	 							echo "</tr>";
	 						}
	 					?>
	 						<form method="POST" action="?event=add" enctype="multipart/form-data">
		 						<tr>
		 							<td><input class="form-control" name="date"  placeholder="Event Date" type="date" required></td>
		 							<td><input class="form-control" name="eventName"  placeholder="Event Name" type="text" required></td>
		 							<td><input class="form-control" name="location"  placeholder="Event Location" type="text"></td>
		 							<td><textarea class="form-control" name='eventPara' placeholder="Comment"></textarea></td>
		 							<td><input class="form-control" name="eventNameAr"  placeholder="Event Name" type="text" required></td>
		 							<td><input class="form-control" name="locationAr"  placeholder="Event Location" type="text"></td>
		 							<td><textarea class="form-control" name='eventParaAr' placeholder="Comment"></textarea></td>
		 								
		 							<td><input class="form-control" name="image"  placeholder="image" type="file" ></td>
		 							<td><button type="submit" class="btn btn-primary">ADD Event</button></td>


		 						</tr>	
		 					</form>
	 					
	 				</table>
	 			</div>


			</div>	
 		</div>
 		<?php
 		}elseif($flagSlide=='add' && $flag=='Manage'){ ?>
 			<h1 class="text-center">Adding Slide</h1>
 			<p class="text-center">to take Enter write <code>&lt;br/&gt;</code></p>
 			<p class="text-center">if you want to mark some words , put the words between <code>&lt;span&gt;  &lt;/span&gt; </code></p>
		 		<div class="container">
		 			<form action="?flagSlide=insert" method="POST" enctype="multipart/form-data">
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Slide Header</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="slideHead"  placeholder="Enter The  Slide Head" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Slide Paragraph</label>
						    <div class="col-sm-10">
						    	<textarea name="slidePara" class="form-control" placeholder="Enter The Paragraph"></textarea>
						      	
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Slide Header Arabic</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="slideHeadAr"  placeholder="Enter The  Slide Arabic Head " type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Slide Paragraph</label>
						    <div class="col-sm-10">
						    	<textarea name="slideParaAr" class="form-control" placeholder="Enter The Arabic Paragraph"></textarea>
						      	
						    </div>
					 	</div>
					 	
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Image</label>
						    <div class="col-sm-10">
						        <input type="file" name="upload" class="form-control">
						    </div>
						</div>
						

						<button type="submit" class="btn btn-primary pull-right btn-lg">ADD New Slide</button>
					</form>
					<a href="ControlHomeEdit.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 

				<?php
		}elseif($flagSlide=='insert' && $flag=='Manage'){
			if($_SERVER['REQUEST_METHOD']=='POST'){ // to make sure that this page don't browes directly
 				//the variable of form 
 				$slideHead			=$_POST['slideHead'];
 				$slidePara 	 		=$_POST['slidePara'];
 				$slideHeadAr		=$_POST['slideHeadAr'];
 				$slideParaAr 	 	=$_POST['slideParaAr'];
 				
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
 				$stmt=$con->prepare("SELECT MAX( SlideID ) FROM carousel");
 				$stmt->execute();
 				$row=$stmt->fetch();
 				if($row[0]!=0){
	 				$stmt=$con->prepare("ALTER TABLE carousel AUTO_INCREMENT = $row[0]");
	 				$stmt->execute();
 				}else{
 					$stmt=$con->prepare("ALTER TABLE carousel AUTO_INCREMENT = 1");
 					$stmt->execute();
 				}
 				$image='Slide_'.($row[0]+1).'.png';
 				move_uploaded_file($imageTemp, "upload\images\\".$image);
 				/* end image upload */
 				

 				try{
 					$stmt=$con->prepare("INSERT INTO carousel(SlideImage , SlideHeader, SlidePara, SlideHeaderAr, SlideParaAr) VALUES(?,?,?,?,?)");
 					$stmt->execute(array($image,$slideHead,$slidePara,$slideHeadAr,$slideParaAr));
 					
 					header('Location:ControlHomeEdit.php');
 					exit();
 				}catch(PDOException $e){
 					echo '<div class="alert alert-danger"><strong>Error</strong>You can\'t add.</div>';
 				}
 				echo '<a href="ControlHomeEdit.php" class="btn btn-link btn-lg pull-right">Return to Manage Home</a>';
 							
 			}else{
 				header('Location:ControlHomeEdit.php');
 			}
 			echo "</div>";
 		}elseif($flagSlide=='edit' && $flag=='Manage'){ 
 			$stmt =$con->prepare("SELECT * FROM carousel where SlideID=?");
 			$stmt->execute(array($_GET['SlideID']));
 			$row=$stmt->fetch();
 			$rowCount=$stmt->rowCount();
 			if($rowCount==1){ ?>
 			<h1 class="text-center">Adding Slide</h1>
		 		<div class="container">
		 			<form action="?flagSlide=update" method="POST" enctype="multipart/form-data">
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Slide Header</label>
						    <div class="col-sm-10">
						    	<input value="<?php echo $row[0]?>" name="slideID" type="hidden">
						      	<input class="form-control" value="<?php echo $row[2]?>" name="slideHead"  placeholder="Enter The  Slide Head" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Slide Paragraph</label>
						    <div class="col-sm-10">
						      	<textarea name="slidePara" value="<?php echo $row[3]?>" class="form-control" placeholder="Enter The Paragraph"><?php echo $row[3]?></textarea> 
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Slide Header Arabic</label>
						    <div class="col-sm-10">
						      	<input class="form-control" value="<?php echo $row[4]?>" name="slideHeadAr"  placeholder="Enter The  Slide Arabic Head" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Slide Paragraph Arabic</label>
						    <div class="col-sm-10">
						      	<textarea name="slideParaAr" value="<?php echo $row[5]?>" class="form-control" placeholder="Enter The Arabic Paragraph"><?php echo $row[5]?></textarea> 
						    </div>
					 	</div>
					 	
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Image</label>
						    <div class="col-sm-10">
						    	<input type="hidden" name="uploadHidden" value="<?php echo $row[1]?>">
						        <input type="file" name="upload" value="<?php echo $row[1]?>" class="form-control">
						    </div>
						</div>
						

						<button type="submit" class="btn btn-primary pull-right btn-lg">Edit Slide</button>
					</form>
					<a href="ControlHomeEdit.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 

				<?php }

 		}elseif($flagSlide=='update' && $flag=='Manage'){

 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Editing Course Info</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){
 				//the variable of form 
 				$slideID 			=$_POST['slideID'];
 				$slideHead			=$_POST['slideHead'];
 				$slidePara 	 		=$_POST['slidePara'];
 				$slideHeadAr		=$_POST['slideHeadAr'];
 				$slideParaAr 	 	=$_POST['slideParaAr'];

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

 				if(empty($image)){
 					$image=$imageHidden;
 				}else{
 					$image='Slide_'.$slideID.'.png';

 					move_uploaded_file($imageTemp, "upload\images\\".$image);

 				}
 				/* end image upload */

 				try{
 					$stmt=$con->prepare("UPDATE carousel SET SlideHeader=?, SlidePara=?  ,SlideHeaderAr=?, SlideParaAr=?  , SlideImage=? WHERE SlideID=?");
 					$stmt->execute(array($slideHead,$slidePara,$slideHeadAr,$slideParaAr,$image,$slideID));
 					
 						header('Location:ControlHomeEdit.php');
 					
 				}catch(PDOException $e){
 					
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t add.</div>';
 					
 						
 				}
 				echo '<a href="ControlHomeEdit.php" class="btn btn-link btn-lg pull-right">Return to Manage Home</a>';
 				
 				
 			}else{
 				header('Location:ControlHomeEdit.php');
 			}

 		}elseif ($flagSlide=='delete' && $flag=='Manage') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting Slide</h1>";
 			if(isset($_GET['SlideID']) && is_numeric($_GET['SlideID'])){
 				$Slide= intval($_GET['SlideID']);

 				$stmt   =$con->prepare("SELECT 	SlideImage FROM carousel WHERE SlideID=?");
	 			$stmt->execute(array($Slide));
	 			$Image=$stmt->fetch();
	 			$rowCount=$stmt->rowCount();

	 			if($rowCount>0){
	 					$fileName	='upload/images/'.$Image[0];
		 				$stmt  		=$con->prepare("DELETE FROM `carousel` WHERE SlideID=?");
		 				$stmt->execute(array($Slide));
		 				
		 				if(file_exists($fileName) && is_writable($fileName)){
							unlink($fileName);
							header('Location:ControlHomeEdit.php');
							exit();
						}else{		
							echo '<div class="alert alert-info"><strong>Warning</strong> The Image is not exist and the Slide is deleted.</div>';			
						}
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The Slide ID are not  exist.</div>';
	 			}
	 			echo '<a href="ControlHomeEdit.php" class="btn btn-link btn-lg pull-right">Return to Manage Home</a>';
 			}else{
 				header('Location:ControlHomeEdit.php');
 				exit(); 	
	 		}

 		}elseif ($upcomingEvent=='edit' && $flag=='Manage') {
 			$stmt =$con->prepare("SELECT * FROM event where ID=?");
	 		$stmt->execute(array($_GET['eventID']));
	 		$row=$stmt->fetch();
	 		$rowCount=$stmt->rowCount();
	 		if($rowCount==1){?>
 				<h1 class="text-center">Editing The Event</h1>
		 		<div class="container">
		 			<form action="?upcomingEvent=update" method="POST" enctype="multipart/form-data">
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Date</label>
						    <div class="col-sm-10">
						    	<input class="form-control" value="<?php echo $row[0];?>" name="ID" type="hidden">
						      	<input class="form-control" value="<?php echo $row[1];?>" name="date"  placeholder="Enter The Date of Event" type="date" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Event Name</label>
						    <div class="col-sm-10">
						      	<input type="text" value="<?php echo $row[2];?>" name="eventName" class="form-control" placeholder="Enter The Event Name" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Location</label>
						    <div class="col-sm-10">
						        <input type="text" value="<?php echo $row[3];?>" name="location" class="form-control" placeholder="Enter The location" >
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Comment</label>
						    <div class="col-sm-10">
						    	<textarea class="form-control" name='eventPara' placeholder="Comment"><?php echo $row[4];?></textarea>
						    </div>
						</div>
						<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Event Name(AR)</label>
						    <div class="col-sm-10">
						      	<input type="text" value="<?php echo $row[5];?>" name="eventNameAr" class="form-control" placeholder="Enter The Event Name" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Location(AR)</label>
						    <div class="col-sm-10">
						        <input type="text" value="<?php echo $row[6];?>" name="locationAr" class="form-control" placeholder="Enter The location" >
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Comment(AR)</label>
						    <div class="col-sm-10">
						    	<textarea class="form-control" name='eventParaAr' placeholder="Comment"><?php echo $row[7];?></textarea>
						    </div>
						</div>
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Image</label>
						    <div class="col-sm-8">
						        <input type="file" name="image" class="form-control">
						        <input type="hidden" name="imageHidden" class="form-control" value="<?php echo $row[8]?>">

						    </div>
						    <div class="col-sm-2 manage_images">
						    	<img src='<?php echo "upload/images/".$row[8]?>' />
						    </div>
						</div>
						
					 	

						<button type="submit" class="btn btn-primary pull-right btn-lg">Editing THE Event</button>
					</form>
					<a href="ControlHomeEdit.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 
	 			
 			<?php
 			}else{
 				header('Location:ControlHomeEdit.php');
 			}
 		



 		}elseif ($upcomingEvent=='update' && $flag=='Manage') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Editing The Event</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){
 				$ID						=$_POST['ID'];   
 				$date					=$_POST['date'];
 				$eventName 				=$_POST['eventName'];
 				$location 				=$_POST['location'];
 				$eventPara 				=$_POST['eventPara'];
 				$eventNameAr 			=$_POST['eventNameAr'];
 				$locationAr 			=$_POST['locationAr'];
 				$eventParaAr 			=$_POST['eventParaAr'];

 				$image 					=$_FILES['image'];
 				$imageTemp 				=$_FILES['image']['tmp_name'];
 				 
 				$imageAllowedExtension 	= array('jpeg','png','jpg','gif');
 				$imageExtension 	   	=strtolower(end(explode('.',$image['name'])));

 				if(!empty($image['name']) && ! in_array($imageExtension,$imageAllowedExtension)){
 					echo '<div class="alert alert-warning"><strong>Error!</strong>This Extention Not Allowed</div>';
 				}
 				if($image['size']> 4194304){
 					echo '<div class="alert alert-warning">The Image Can\'t be Larger Than <strong>4MB</strong></div>';
 				}
 				if(!empty($image)){
 					$image='event_'.$ID.'.png';
 					move_uploaded_file($imageTemp, "upload\images\\".$image);				
 				}
 				try{
 					$stmt=$con->prepare("UPDATE event SET eventDate=?, eventName=?  , eventLocation=? ,eventPara=?,eventNameAr=?  , eventLocationAr=? ,eventParaAr=?,mainImage=? WHERE ID=?");
 					$stmt->execute(array($date,$eventName,$location,$eventPara,$eventNameAr,$locationAr,$eventParaAr,$image,$ID));
 					if($stmt->rowCount()>0){
 						echo '<div class="alert alert-success"><strong>SUCCESS </strong> The Event informations are Updated.</div>'; 	
 					}else{
 						echo '<div class="alert alert-info"><strong> Warning</strong> The Event informations are not  changed.</div>';
 					}
 				}catch(PDOException $e){
 						
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t Edit.</div>';		
 				}
 				echo '<a href="ControlHomeEdit.php" class="btn btn-link btn-lg pull-right">Return to Manage Event</a>';
 			}else{
 				header('Location:ControlHomeEdit.php');
 				exit();
 			}

 			
 		}elseif ($upcomingEvent=='delete' && $flag=='Manage') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting Event</h1>";
 			if(isset($_GET['eventID']) && is_numeric($_GET['eventID'])){
 				$ID= intval($_GET['eventID']);

	 			$stmt   =$con->prepare("SELECT mainImage FROM event WHERE ID=?");
	 			$stmt->execute(array($ID));
	 			$image=$stmt->fetch();
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount>0){
	 					$fileName	='upload/images/'.$image[0];
		 				$stmt  		=$con->prepare("DELETE FROM `event` WHERE ID=?");
		 				$stmt->execute(array($ID));
		 				
		 				if(file_exists($fileName)){
							unlink($fileName);
							header('Location:ControlHomeEdit.php');
							exit();
						}else{		
							echo '<div class="alert alert-info"><strong>Warning</strong> The event is deleted but image still exist.</div>';			
						}
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The Event ID are not  exist.</div>';
	 			}
	 			echo '<a href="ControlHomeEdit.php" class="btn btn-link btn-lg pull-right">Return to Manage Home</a>';
 			}else{
 				header('Location:ControlHomeEdit.php');
 				exit(); 	
	 		}
 		



 		
 		}elseif($flag=='edit'){// edit page (change password and email)
 			$stmt =$con->prepare("SELECT * FROM admin where Username=?");
 			$stmt->execute(array($_SESSION['Username']));
 			$row=$stmt->fetch();
 			$rowCount=$stmt->rowCount();
 			
 			if($rowCount==1){?>
			
		 		<h1 class="text-center">Edit Admin Info</h1>
		 		<div class="container">
		 			<form action="?flag=update" method="POST">
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Username</label>
						    <div class="col-sm-10">
						      	<input class="form-control" id="disabledInput" type="text" value="<?php echo $row['Username'] ?>" disabled>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Old Password</label>
						    <div class="col-sm-10">

						      	<input type="hidden" name="oldTruePass" value="<?php echo $row['Password'] ?>">
						      	<input type="password" name="oldPass" class="form-control" id="inputPassword" placeholder="Old Password" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Password</label>
						    <div class="col-sm-10">
						      	<input type="password" name="newPass" class="form-control" id="inputPassword" placeholder="Password">
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Email</label>
						    <div class="col-sm-10">
						        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="<?php echo $row['Email']?>" required>
						    </div>
						</div>

						<button type="submit" class="btn btn-primary pull-right btn-lg">SAVE THE EDITING</button>
					</form>
				</div> 


 				<?php
 			}else{
 				echo 'none';
 			}		
 		}elseif ($flag=='update') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Edit Admin Info</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){ // to make sure that this page don't browes directly
 				//the variable of form 
 				$user 			=$_SESSION['Username'];
 				$oldTruePass 	=$_POST['oldTruePass'];// encreption password
 				$oldPass 		=$_POST['oldPass'];
 				$oldPassEnc		=sha1($oldPass);
 				$newPass		=$_POST['newPass'];
 				$email 			=$_POST['email'];

 				if(empty($newPass)){
 					$newPass=$oldPass;
 				}
 				if($oldTruePass==$oldPassEnc){
 					$stmt   =$con->prepare("UPDATE admin SET Password=?, Email=?  where Username=?");
 					$stmt->execute(array(sha1($newPass),$email,$user));
 					if($stmt->rowCount()>0){
 						echo '<div class="alert alert-success"><strong>HI '. $user .'</strong> Your informations are Updated.</div>'; 	
 					}else{
 						echo '<div class="alert alert-info"><strong>HI '. $user .'</strong> You don\'t change any information.</div>';
 					}
 				}else{
					echo '<div class="alert alert-warning"><strong>Warning!</strong> Your Password is Incorrect.!
					</div>';
 				}
							
 			}else{
 				echo '<div class="alert alert-danger"><strong>Danger!</strong> You Can\'t Reach Here Directly.</div>';
 			}
 			echo "</div>";

 		}else{
 			// manage too
 		}

	}else{
		header('Location:index.php');
		exit();
	}
   ?>


<?php include $tpl . 'down.inc'; ?>
   


