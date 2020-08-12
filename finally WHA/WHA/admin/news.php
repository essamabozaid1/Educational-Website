<?php
  
session_start();
	if(isset($_SESSION['Username'])){
		$pageTitle='News Manage';
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

 		if ($flag=='Manage'){
 			$stmt=$con->prepare("SELECT * FROM news");
 			$stmt->execute();
 			$rows=$stmt->fetchAll();
 		?>
 			<h1 class="text-center">Manage News</h1>
 			<a href='?flag=add' class="btn btn-primary" style="display: block;margin:auto;width: 40%;"><i class="fa fa-plus"> </i> click here to add news</a>
 			<div class="container-fluid"> 
 				
 				<?php
 					foreach ($rows as $row) { ?>
		 				<div class="events">

			 				<img src="upload/images/<?php echo $row['mainImage'];?>">

			 				<div class="events-body col-md-5">
							    <h3 class="header"><?php echo $row['Header'];?> </h3>
							    <h4 class="subPara"><?php echo $row['SubPara'];?></h4>
							    <p class="fullPara"><?php echo $row['FullPara']; ?> </p>
							</div>
							<div class="events-body col-md-5">

							    <h3 class="header"><?php echo $row['HeaderAr'];?> </h3>
							    <h4 class="subPara"><?php echo $row['SubParaAr'];?></h4>
							    <p class="fullPara"><?php echo $row['FullParaAr']; ?> </p>
							</div>
							<div class="clearfix"></div>

							<a href='?flag=delete&newsID=<?php echo $row['ID'];?>' class='btn btn-danger pull-right'>Delete</a>
							<a href='?flag=edit&newsID=<?php echo $row['ID'];?>' class='btn btn-success pull-right'>Edit</a>
							<a href='?flag=images&newsID=<?php echo $row['ID'];?>' class='btn btn-warning pull-right'>Images</a>
							<span class="date"><?php echo $row['NewsDate'];?> </span>
			 				<div class="clearfix"></div>
						</div>

		 				
						<hr style="border-top: 1px solid #337ab7;">
 					<?php } ?>

 				



 			</div>

		<?php
 		}elseif ($flag=='add') { ?>
 			<h1 class="text-center">Adding New News</h1>
 			<p class="text-center"><code>if you want to mark some words , put the words btween &lt;span&gt;  &lt;/span&gt; </code> <br><code>&lt;span&gt;some words&lt;/span&gt;</code>
 				<br><code>&lt;br&gt; to Take new line</code>
	 			</p>
		 		<div class="container">
		 			<form action="?flag=insert" method="POST" enctype="multipart/form-data">
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Name (Header)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="newsName"  placeholder="Enter The Header of Script" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Date</label>
						    <div class="col-sm-10">
						      	<input type="date" name="newsdate" class="form-control" placeholder="Enter The Date of news" required>
						    </div>
					 	</div>
					 	
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Sub Paragraph</label>
						    <div class="col-sm-10">
						      	<textarea class="form-control" name="SubPara" placeholder="Enter The small Paragraph" required="required"></textarea>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Full Paragraph</label>
						    <div class="col-sm-10">
						      	<textarea class="form-control" name="FullPara" placeholder="Enter The Full Paragraph" required="required"></textarea>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Name (Arabic Header)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="newsNameAr"  placeholder="Enter The Header of Script" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Sub Paragraph(Arabic)</label>
						    <div class="col-sm-10">
						      	<textarea class="form-control" name="SubParaAr" placeholder="Enter The small Paragraph" required="required"></textarea>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Full Paragraph(Arabic)</label>
						    <div class="col-sm-10">
						      	<textarea class="form-control" name="FullParaAr" placeholder="Enter The Full Paragraph" required="required"></textarea>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Main Image</label>
						    <div class="col-sm-10">
						        <input type="file" name="upload" class="form-control">
						    </div>
						</div>
						
					

						<button type="submit" class="btn btn-primary pull-right btn-lg">ADD THE NEWS</button>
					</form>
					<a href="news.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 
 			
 		
 		<?php
 		}elseif ($flag=='insert') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Adding News</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){ // to make sure that this page don't browes directly
 				//the variable of form 
 				$newsName			=$_POST['newsName'];
 				$newsdate 			=$_POST['newsdate'];
 				$FullPara 			=$_POST['FullPara'];
 				$SubPara 			=$_POST['SubPara'];

 				$newsNameAr			=$_POST['newsNameAr'];
 				$FullParaAr			=$_POST['FullParaAr'];
 				$SubParaAr 			=$_POST['SubParaAr'];

 				
 				$MainImage 			=$_FILES['upload'];
 				$imageTemp 			=$_FILES['upload']['tmp_name'];

 				$imageAllowedExtension 	= array('jpeg','png','jpg','gif');
 				$imageExtension 	   	=strtolower(end(explode('.',$MainImage['name'])));

 				if(!empty($MainImage['name']) && ! in_array($imageExtension,$imageAllowedExtension)){
 					echo '<div class="alert alert-warning"><strong>Error!</strong>This Extention Not Allowed</div>';
 				}
 				if($MainImage['size']> 4194304){
 					echo '<div class="alert alert-warning">The Image Can\'t be Larger Than <strong>4MB</strong></div>';
 				}
 				


 				$stmt=$con->prepare("SELECT MAX( ID ) FROM news");
 				$stmt->execute();
 				$row=$stmt->fetch();
 				if($row[0]!=0){
 				$stmt=$con->prepare("ALTER TABLE news AUTO_INCREMENT = $row[0]");
 				$stmt->execute();
 				}else{
 					$stmt=$con->prepare("ALTER TABLE news AUTO_INCREMENT = 1");
 					$stmt->execute();
 				}

 				$MainImage='news_'.($row[0]+1).'.png';
 				move_uploaded_file($imageTemp, "upload\images\\".$MainImage);


 				try{
 					$stmt  =$con->prepare("INSERT INTO news(Header,SubPara,FullPara,HeaderAr,SubParaAr,FullParaAr,NewsDate,MainImage) VALUES(?,?,?,?,?,?,?,?)");
 					$stmt->execute(array($newsName,$SubPara,$FullPara,$newsNameAr,$SubParaAr,$FullParaAr,$newsdate,$MainImage));
 					echo '<div class="alert alert-success"><strong>SUCCESS</strong> the News is added.</div>';
 				}catch(PDOException $e){
 				
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t add.</div>';
 				}
 				echo '<a href="news.php" class="btn btn-link btn-lg pull-right">Return to Manage News</a>';
 							
 			}else{
 				header('Location:news.php?flag=add');
 			}
 			echo "</div>";

 		}elseif ($flag=='edit') {
			$stmt =$con->prepare("SELECT * FROM news where ID=?");
 			$stmt->execute(array($_GET['newsID']));
 			$row=$stmt->fetch();
 			$rowCount=$stmt->rowCount();
 			if($rowCount==1){?>
 				<h1 class="text-center">Editing News</h1>
		 		<div class="container">
		 			<form action="?flag=update" method="POST" enctype="multipart/form-data">
		 				<div class="form-group row">
						    <label class="col-sm-2 col-form-label">News ID</label>
						    <div class="col-sm-10">
						    	<input name="ID" value="<?php echo$row[0]?>"  type="hidden">
						      	<input class="form-control" name="IDdis" value="<?php echo$row[0]?>"  type="text" disabled>
						    </div>
					 	</div>
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Name (Header)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" value="<?php echo$row[1]?>" name="newsName"  placeholder="Enter The Header of Script" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Date</label>
						    <div class="col-sm-10">
						      	<input type="date" name="newsdate" value="<?php echo$row[7]?>" class="form-control" placeholder="Enter The Date of news" required>
						    </div>
					 	</div>
					 	
						<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Sub Paragraph</label>
						    <div class="col-sm-10">
						      	<textarea class="form-control" name="SubPara" placeholder="Enter The small Paragraph" required="required"><?php echo$row[2]?></textarea>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Full Paragraph</label>
						    <div class="col-sm-10">
						      	<textarea class="form-control"  name="FullPara" placeholder="Enter The Full Paragraph" required="required"><?php echo$row[3]?></textarea>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Name (Arabic Header)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" value="<?php echo$row[4]?>" name="newsNameAr"  placeholder="Enter The Header of Script" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Sub Paragraph(Arabic)</label>
						    <div class="col-sm-10">
						      	<textarea class="form-control" name="SubParaAr" placeholder="Enter The small Paragraph" required="required"><?php echo$row[5]?></textarea>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Full Paragraph(Arabic)</label>
						    <div class="col-sm-10">
						      	<textarea class="form-control"  name="FullParaAr" placeholder="Enter The Full Paragraph" required="required"><?php echo$row[6]?></textarea>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Image</label>
						    <div class="col-sm-8">
						        <input type="file" name="upload" class="form-control">
						        <input type="hidden" name="uploadHidden" class="form-control" value="<?php echo $row[8]?>">

						    </div>
						    <div class="col-sm-2 manage_images" >
						    	<img src='<?php echo "upload/images/".$row[8]?>' />
						    </div>
						</div>

						
					

						<button type="submit" class="btn btn-primary pull-right btn-lg">Edit THE NEWS</button>
					</form>
					<a href="news.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 
 			



		 <?php
		 		}else{
 					header('Location:news.php');
 				}

 		}elseif ($flag=='update') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Editing News</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){
 				$ID 				=$_POST['ID'];
 				$newsName			=$_POST['newsName'];
 				$newsdate 			=$_POST['newsdate'];
 				$FullPara 			=$_POST['FullPara'];
 				$SubPara 			=$_POST['SubPara'];

 				$newsNameAr			=$_POST['newsNameAr'];
 				$FullParaAr 		=$_POST['FullParaAr'];
 				$SubParaAr 			=$_POST['SubParaAr'];

 				

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
 					
 					$image='news_'.$ID.'.png';
 					move_uploaded_file($imageTemp, "upload\images\\".$image);
 				}
				try{
 					$stmt=$con->prepare("UPDATE news SET Header=?,SubPara=?,FullPara=?,HeaderAr=?,SubParaAr=?,FullParaAr=?,NewsDate=?,MainImage=? WHERE ID=?");
 					$stmt->execute(array($newsName,$SubPara,$FullPara,$newsNameAr,$SubParaAr,$FullParaAr,$newsdate,$image,$ID));
 					if($stmt->rowCount()>0){
 						echo '<div class="alert alert-success"><strong>SUCCESS </strong> The news informations are Updated.</div>'; 	
 					}else{
 						echo '<div class="alert alert-info"><strong> Warning</strong> The news informations are not  changed OR The Image only is updated.</div>';
 					}
	 			}catch(PDOException $e){
 					
 					echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t Edit.</div>';
 					
 				}
 				echo '<a href="news.php" class="btn btn-link btn-lg pull-right">Return to Manage news</a>';
	 				
	 				
 			}else{
 				header('Location:news.php');
 			}

 		}elseif ($flag=='delete') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting News</h1>";
 			if(isset($_GET['newsID']) && is_numeric($_GET['newsID'])){
 				$ID= intval($_GET['newsID']);

 				$stmt   =$con->prepare("SELECT imageName ,ID FROM newsimages WHERE newsID=?");
	 			$stmt->execute(array($ID));
	 			$images=$stmt->fetchAll();
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount>0){
	 				foreach ($images as $image) {
	 					$fileName	='upload/images/'.$image['imageName'];
		 				$stmt  		=$con->prepare("DELETE FROM `newsimages` WHERE ID=?");
		 				$stmt->execute(array($image['ID']));

		 				if(file_exists($fileName) && is_writable($fileName)){
							unlink($fileName);
							
						}else{		
							echo '<div class="alert alert-info"><strong>Warning</strong> The image is not exist.</div>';			
						}
	 				}	
	 			}
	 			
	 			$stmt   =$con->prepare("SELECT mainImage FROM news WHERE ID=?");
	 			$stmt->execute(array($ID));
	 			$MainImage=$stmt->fetch();
	 			$rowCount=$stmt->rowCount();


	 			if($rowCount==1){
	 				$fileName	='upload/images/'.$MainImage[0];
	 				$stmt  		=$con->prepare("DELETE FROM `news` WHERE ID=?");
	 				$stmt->execute(array($ID));
	 				
	 				if(file_exists($fileName) && is_writable($fileName)){
						unlink($fileName);
						header('Location:news.php');
						exit();
					}else{		
						echo '<div class="alert alert-info"><strong>Warning</strong> The MainImage is not exist and the News is deleted.</div>';			
					}	
	 
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The News ID is not  exist.</div>';
	 			}
	 			echo '<a href="news.php" class="btn btn-link btn-lg pull-right">Return to Manage News</a>';
 			}else{
 				header('Location:news.php');
 			}

 		}elseif ($flag=='images') { ?>
 			<h1 class="text-center">Adding Images News</h1>
 			
		 		<div class="container">
		 			<form action="?flag=upload" method="POST" enctype="multipart/form-data">
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Images</label>
						    <div class="col-sm-10">
						    	<input type="hidden" name="newsID" value="<?php echo $_GET['newsID']; ?>">
						        <input type="file" name="upload[]" class="form-control" multiple="multiple">
						    </div>
						</div>
						
					
						
						<button type="submit" class="btn btn-primary pull-right btn-lg">Add News's Images.</button>
					</form>

					<a href="news.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
					<div class="clearfix"></div>
					<div class="row" style="margin-top: 30px">
					<?php
						if(isset($_GET['imgID']) && is_numeric($_GET['imgID'])){
							$ID= intval($_GET['imgID']);
	 						$stmt   =$con->prepare("SELECT imageName FROM newsimages WHERE ID=?");
				 			$stmt->execute(array($ID));
				 			$image=$stmt->fetch();
				 			$rowCount=$stmt->rowCount();
				 			if($rowCount>0){
				 					$fileName	='upload/images/'.$image[0];
					 				$stmt  		=$con->prepare("DELETE FROM `newsimages` WHERE ID=?");
					 				$stmt->execute(array($ID));
					 				
					 				if(file_exists($fileName) && is_writable($fileName)){
										unlink($fileName);
										$text='Location:?flag=images&newsID='.$_GET['newsID'];
										header($text);
										exit();
									}else{		
										echo '<div class="alert alert-info"><strong>Warning</strong> The CV is not exist and the Job is deleted.</div>';			
									}
				 			}
	 						
						}
						$stmt   	=$con->prepare("SELECT ID ,imageName FROM newsimages WHERE newsID=?");
	 					$stmt->execute(array($_GET['newsID']));
	 					$rows		=$stmt->fetchAll();
	 					$rowCount	=$stmt->rowCount();
	 					
	 					foreach ($rows as $row ) { ?>
	 						<div class="col-md-2" style="margin-bottom: 20px;">
	 						<img style=" width: 100%;height: 150px;" src="upload/images/<?php echo $row['imageName'];?>">
	 						<a href="<?php echo basename($_SERVER['REQUEST_URI']).'&imgID='.$row['ID']; ?>" class='btn btn-danger btn-block'>Delete</a>
	 						</div>
	 					<?php }

					 ?>
					</div>
				</div> 

 		<?php
 		}elseif ($flag=='upload') {
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Adding Images</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){
 				$stmt=$con->prepare("SELECT MAX( ID ) FROM newsimages");
 				$stmt->execute();
 				$row=$stmt->fetch();
 				if($row[0]!=0){
	 				$stmt=$con->prepare("ALTER TABLE newsimages AUTO_INCREMENT = $row[0]");
	 				$stmt->execute();
 				}else{
 					$stmt=$con->prepare("ALTER TABLE newsimages AUTO_INCREMENT = 1");
 					$stmt->execute();
 				}
 				$newsID=$_POST['newsID'];
 				//print_r($_FILES['upload']) ;
 				for ($i=0; $i <count($_FILES['upload']['name']) ; $i++) { 
 					$image 					=$_FILES['upload'];
 					$imageTemp 				=$_FILES['upload']['tmp_name'][$i];

 					$imageAllowedExtension 	= array('jpeg','png','jpg','gif');
 					$imageExtension 	   	=strtolower(end(explode('.',$image['name'][$i])));

 					if(!empty($image['name'][$i]) && ! in_array($imageExtension,$imageAllowedExtension)){
 						echo '<div class="alert alert-warning"><strong>Error!</strong>This Extention Not Allowed</div>';
 					}
 					if($image['size'][$i]> 4194304){
 						echo '<div class="alert alert-warning">The Image Can\'t be Larger Than <strong>4MB</strong></div>';
 					}
 					$image='imageNews_'.uniqid().'.png';
 					move_uploaded_file($imageTemp, "upload\images\\".$image);	


 					try{
	 					$stmt  =$con->prepare("INSERT INTO newsimages(imageName,newsID) VALUES(?,?)");
	 					$stmt->execute(array($image,$newsID));
	 					echo '<div class="alert alert-success"><strong>SUCCESS</strong> the News Images are uploaded.</div>';
 					}catch(PDOException $e){
 				
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t upload.</div>';
 					}

 					
 				}
 			echo '<a href="news.php" class="btn btn-link btn-lg pull-right">Return to Manage News</a>';
 							
 			}else{
 				header('Location:news.php?flag=images');
 			}
 			echo "</div>";
  		}else{

 		}
 		

	}else{
		header('Location:index.php');
		exit();
	}


?>





   <?php include $tpl . 'down.inc' ?>