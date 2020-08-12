<?php
  /*
	==========================
	==Manage Clients Page
	==Add/update/delete Clients from here
	==========================
  */
	session_start();
	if(isset($_SESSION['Username'])){
		$pageTitle='Category Manage';
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
 			/*
 			$sort='ASC';
 			$sort_array = array('ASC','DESC');
 			if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){
 				$sort=$_GET['sort'];
 			}
 			*/
 			//$stmt=$con->prepare("SELECT * FROM category ORDER BY ordering $sort");

 			$stmt=$con->prepare("SELECT * FROM category");
 			$stmt->execute();
 			$rows=$stmt->fetchAll();

 			?>
 				<h1 class="text-center">Manage Categories</h1>
		 		<div class="container">
		 			<div class="table-responsive">
		 				<table class="main-table table table-border">
		 					<tr class="text-center">
		 						<td>Category Name</td>
		 						<td>Category Name(AR)</td>
		 						<td>Description</td>
		 						<td>Visibility</td>
		 						<td>Controls</td>
		 					</tr>
		 					<?php 
		 						foreach ($rows as $row) {
		 							echo "<tr class='text-center'>";
		 								
		 								echo "<td>" . $row['catName'] . "</td>";
		 								echo "<td>" . $row['catNameAr'] . "</td>";
		 								echo "<td>" . $row['description'] . "</td>";
		 									
		 								echo "<td>" . $row['visibility'] . "</td>";
		 								echo "<td>
		 										<a href='?flag=edit&catID=" . $row["categoryID"] ."' class='btn btn-success'>Edit</a>
		 	
		 										<a href='?flag=delete&catID=" . $row["categoryID"] ."' class='btn btn-danger'>Delete</a>

		 									 </td>";
		 							echo "</tr>";
		 						}
		 					?>
		 				</table>
		 			</div>
		 			<a href='?flag=add' class="btn btn-primary"><i class="fa fa-plus"> </i> click here to add</a>
		 			<!--
		 			<div class='ordering pull-right'>
		 				
		 				Ordering:
		 				<a class="<?php if($sort=='ASC'){echo 'active'; } ?>" href="?sort=ASC">ASC</a>
		 				
		 				<a class="<?php if($sort=='DESC'){echo 'active'; } ?>" href="?sort=DESC">DESC</a>
		 				
		 			</div>
					 -->
		 		</div>	


 			<?php
 
 		}elseif ($flag=='add') {
 			?>
 				<h1 class="text-center">Adding New Category</h1>
		 		<div class="container">
		 			<form action="?flag=insert" method="POST">
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Category Name</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="catname"  placeholder="Enter The Category Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Category Name(AR)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="catNameAr"  placeholder="Enter The Category Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Description</label>
						    <div class="col-sm-10">
						      	<input type="text" name="description" class="form-control" id="inputPassword" placeholder="Enter The Description">
						    </div>
					 	</div>
					 	<!--
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Ordering</label>
						    <div class="col-sm-10">
						        <input type="number" name="ordering" class="form-control" id="inputEmail3" placeholder="Enter The order of Category" >
						    </div>
						</div>
						-->
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Visible</label>
						    <div class="col-sm-10">
						        <label class="radio-inline">
								      <input type="radio" name="visibility" value="0" checked>Yes
								</label>
							    <label class="radio-inline">
							     	  <input type="radio" name="visibility" value="1">NO
							    </label>
						    </div>
					 	</div>
						

						<button type="submit" class="btn btn-primary pull-right btn-lg">ADD THE CATEGORY</button>
					</form>
					<a href="category.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 

 			
 		
 			<?php
 		
 		}elseif($flag=='insert'){
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Adding New Category</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){ // to make sure that this page don't browes directly
 				//the variable of form 
 				$catName		=$_POST['catname'];
 				$catNameAr		=$_POST['catNameAr'];

 				$description 	=$_POST['description'];
 				//$ordering 		=$_POST['ordering'];
 				$visibility  		=$_POST['visibility'];

 				$stmt=$con->prepare("SELECT MAX( categoryID ) FROM category");
 				$stmt->execute();
 				$row=$stmt->fetch();
 				if($row[0]!=0){
	 				$stmt=$con->prepare("ALTER TABLE category AUTO_INCREMENT = $row[0]");
	 				$stmt->execute();
 				}else{
 					$stmt=$con->prepare("ALTER TABLE category AUTO_INCREMENT = 1");
 					$stmt->execute();
 				}

 				try{
 					$stmt  =$con->prepare("INSERT INTO category(catName,catNameAr,description,visibility) VALUES(?,?,?)");
 					$stmt->execute(array($catName,$catNameAr,$description,$visibility));
 					echo '<div class="alert alert-success"><strong>SUCCESS</strong> the Category is added.</div>';
 				}catch(PDOException $e){
 					if($e->errorInfo[1]== 1062){
 						echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t add using this Category:<b>'. $catName .  '</b> because it is already existed.</div>';		
 					}else{
 						echo '<div class="alert alert-danger"><strong>Error</strong>You can\'t add.</div>';
 					}

 				}
 				echo '<a href="category.php" class="btn btn-link btn-lg pull-right">Return to Manage Category</a>';
 							
 			}else{
 				header('Location:category.php');
 				exit();
 			}
 			
 			
 		}elseif ($flag=='edit') {

 			$stmt =$con->prepare("SELECT * FROM category where categoryID=?");
 			$stmt->execute(array($_GET['catID']));
 			$row=$stmt->fetch();
 			$rowCount=$stmt->rowCount();
 			if($rowCount==1){?>
 				<h1 class="text-center">Editing The Category</h1>
		 		<div class="container">
		 			<form action="?flag=update" method="POST">
		 				<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Category ID</label>
						    <div class="col-sm-10">
						    	<input value="<?php echo$row[0]?>" name="catID" type="hidden">
						      	<input class="form-control" value="<?php echo$row[0]?>" name="CatID" type="text" disabled>
						    </div>
					 	</div>
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Category Name</label>
						    <div class="col-sm-10">
						      	<input class="form-control" value="<?php echo$row[1]?>" name="catname"  placeholder="Enter The Category Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Category Name (AR)</label>
						    <div class="col-sm-10">
						      	<input class="form-control" value="<?php echo$row[2]?>" name="catNameAr"  placeholder="Enter The Category Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Description</label>
						    <div class="col-sm-10">
						      	<input type="text" value="<?php echo$row[3]?>" name="description" class="form-control" id="inputPassword" placeholder="Enter The Description">
						    </div>
					 	</div>
					 	<!--
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Ordering</label>
						    <div class="col-sm-10">
						        <input type="number" value="<?php echo$row[4]?>" name="ordering" class="form-control" id="inputEmail3" placeholder="Enter The order of Category" >
						    </div>
						</div>
						-->
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-lab1el">Visible</label>
						    <div class="col-sm-10">
						        <label class="radio-inline">
								      <input type="radio" name="visibility" value="0" checked>Yes
								</label>
							    <label class="radio-inline">
							     	  <input type="radio" name="visibility" value="1">NO
							    </label>
						    </div>
					 	</div>
						

						<button type="submit" class="btn btn-primary pull-right btn-lg">Editing THE CATEGORY</button>
					</form>
					<a href="category.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 
 			
 			<?php
 			}else{
 				header('Location:category.php');
 			}
 						
 	   	}elseif ($flag=='update') {
 	   		echo "<div class='container'>";
 			echo "<h1 class='text-center'>Editing Category</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){
 				$catID 			=$_POST['catID'];
 				$catName		=$_POST['catname'];
 				$catNameAr		=$_POST['catNameAr'];
 				$description 	=$_POST['description'];
 				//$ordering 		=$_POST['ordering'];
 				$visibility  	=$_POST['visibility'];

 				try{
 					$stmt   =$con->prepare("UPDATE category SET catName=?,catNameAr=?,description=?,visibility=? WHERE categoryID=?");
 					$stmt->execute(array($catName,$catNameAr,$description,$visibility,$catID));
 					if($stmt->rowCount()!=0){
 						echo '<div class="alert alert-success"><strong>SUCCESS </strong> The Category informations are Updated.</div>'; 
 						echo $stmt->rowCount();	
 					}else{
 						echo '<div class="alert alert-info"><strong> Warning</strong> The Category informations are not  changed.</div>';
 					}
 				}catch(PDOException $e){
 					if($e->errorInfo[1]== 1062){
 						echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t edit the Category using this username:<b>'. $catName .  '</b> because it is already existed.</div>';		
 					}else{
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t Edit.</div>';
 					}
 				}
 				echo '<a href="category.php" class="btn btn-link btn-lg pull-right">Return to Manage Category</a>';
 				
 				
 			}else{
 				header('Location:category.php');
 			}
 				
 		}elseif($flag=='delete'){
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting Category</h1>";
 			if(isset($_GET['catID']) && is_numeric($_GET['catID'])){
 				$cat= intval($_GET['catID']);

	 			$stmt   =$con->prepare("DELETE FROM `category` WHERE categoryID=?");
	 			$stmt->execute(array($cat));
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount==1){
	 				echo '<div class="alert alert-success"><strong>SUCCESS </strong> The Category is Deleted.</div>'; 	
	 
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The Category ID is not  exist.</div>';
	 			}
	 			echo '<a href="category.php" class="btn btn-link btn-lg pull-right">Return to Manage Category</a>';
 			}else{
 				header('Location:category.php');
 			}
		
 		}else{
 			header('Location:category.php');
 		}
 		echo "</div>";






 
	}else{
		header('Location:index.php');
		exit();
	}


?>





   <?php include $tpl . 'down.inc' ?>