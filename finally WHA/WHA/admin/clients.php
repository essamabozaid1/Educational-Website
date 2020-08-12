<?php
  /*
	==========================
	==Manage Clients Page
	==Add/update/delete Clients from here
	==========================
  */
	session_start();
	if(isset($_SESSION['Username'])){
		$pageTitle='Clients Manage';
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
 			$stmt=$con->prepare("SELECT * FROM client");
 			$stmt->execute();
 			$rows=$stmt->fetchAll();

 			?>
 				<h1 class="text-center">Manage Client Account</h1>
		 		<div class="container">
		 			<div class="table-responsive">
		 				<table class="main-table table table-border">
		 					<tr class="text-center">
		 						<td>#ID</td>
		 						<td>Username</td>
		 						<td>Student Code</td>
		 						<td>Full Name</td>
		 						<td>Email</td>
		 						<td>Phone</td>
		 						<td>Control</td>
		 					</tr>
		 					<?php 
		 						foreach ($rows as $row) {
		 							echo "<tr class='text-center'>";
		 								echo "<td>" . $row['clientID'] . "</td>";
		 								echo "<td>" . $row['userName'] . "</td>";
		 								echo "<td>" . $row['studentCode'] . "</td>";
		 								echo "<td>" . $row['fullName'] . "</td>";	
		 								echo "<td>" . $row['email'] . "</td>";
		 								echo "<td>" . $row['phone'] . "</td>";
		 								echo "<td>
		 										<a href='?flag=edit&clientID=" . $row["clientID"] ."' class='btn btn-success'>Edit</a>
		 										<a href='#' class='btn btn-warning'>Upload files</a>
		 										<a href='?flag=delete&clientID=" . $row["clientID"] ."' class='btn btn-danger'>Delete</a>

		 									 </td>";
		 							echo "</tr>";
		 						}
		 					?>
		 				</table>
		 			</div>
		 			<a href='?flag=add' class="btn btn-primary"><i class="fa fa-plus"> </i> click here to add</a>

		 		</div>	


 			<?php
 
 		}elseif ($flag=='add') {
 			?>
 				<h1 class="text-center">Adding Client Account</h1>
		 		<div class="container">
		 			<form action="?flag=insert" method="POST">
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">User Name</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="username"  placeholder="Enter The Student User Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Student Code</label>
						    <div class="col-sm-10">
						      	<input type="text" name="studentCode" class="form-control" id="inputPassword" placeholder="Enter The Student Code" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Full Name</label>
						    <div class="col-sm-10">
						        <input type="text" name="fullName" class="form-control" id="inputEmail3" placeholder="Enter The Full Name of Student" >
						    </div>
						</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Email</label>
						    <div class="col-sm-10">
						      	<input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Enter The Email of The Student">
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Phone Number</label>
						    <div class="col-sm-10">
						        <input type="text" name="phone" class="form-control"  placeholder="Enter The Phone Number of The Student" >
						    </div>
						</div>
						

						<button type="submit" class="btn btn-primary pull-right btn-lg">ADD THE CLIENT</button>
					</form>
					<a href="clients.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 

 			
 		
 			<?php
 		
 		}elseif($flag=='insert'){
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Adding Client Account</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){ // to make sure that this page don't browes directly
 				//the variable of form 
 				$username		=$_POST['username'];
 				$studentCode 	=$_POST['studentCode'];
 				$fullName 		=$_POST['fullName'];
 				$email  		=$_POST['email'];
 				$phone 			=$_POST['phone'];

 				$stmt=$con->prepare("SELECT MAX( clientID ) FROM client");
 				$stmt->execute();
 				$row=$stmt->fetch();
 				if($row[0]!=0){
 				$stmt=$con->prepare("ALTER TABLE client AUTO_INCREMENT = $row[0]");
 				$stmt->execute();
 				}else{
 					$stmt=$con->prepare("ALTER TABLE client AUTO_INCREMENT = 1");
 					$stmt->execute();
 				}

 				try{
 					$stmt   =$con->prepare("INSERT INTO client(userName , studentCode, fullName,email,phone) VALUES(?,?,?,?,?)");
 					$stmt->execute(array($username,$studentCode,$fullName,$email,$phone));
 					echo '<div class="alert alert-success"><strong>SUCCESS</strong> the client is added.</div>';
 				}catch(PDOException $e){
 					if($e->errorInfo[1]== 1062){
 						echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t add using this username:<b>'. $username .  '</b> because it is already existed.</div>';		
 					}else{
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t add.</div>';
 					}

 				}
 				echo '<a href="clients.php" class="btn btn-link btn-lg pull-right">Return to Manage Client</a>';
 							
 			}else{
 				header('Location:clients.php?flag=add');
 			}
 			echo "</div>";
 			
 		}elseif ($flag=='edit') {

 			$stmt =$con->prepare("SELECT * FROM client where clientID=?");
 			$stmt->execute(array($_GET['clientID']));
 			$row=$stmt->fetch();
 			$rowCount=$stmt->rowCount();
 			if($rowCount==1){?>
 				<h1 class="text-center">Editing Client Account</h1>
		 		<div class="container">
		 			<form action="?flag=update" method="POST">
		 				<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Client ID</label>
						    <div class="col-sm-10">
						    	<input name="clientID" value="<?php echo$row[0]?>"  type="hidden">
						      	<input class="form-control" name="ID" value="<?php echo$row[0]?>"  type="text" disabled>
						    </div>
					 	</div>
					  	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">User Name</label>
						    <div class="col-sm-10">
						      	<input class="form-control" name="userName" value="<?php echo$row[1]?>"  placeholder="Enter The Student User Name" type="text" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Student Code</label>
						    <div class="col-sm-10">
						      	<input type="text" name="studentCode" value="<?php echo$row[2]?>"  class="form-control" id="inputPassword" placeholder="Enter The Student Code" required>
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Full Name</label>
						    <div class="col-sm-10">
						        <input type="text" name="fullName" value="<?php echo$row[3]?>"  class="form-control" id="inputEmail3" placeholder="Enter The Full Name of Student" >
						    </div>
						</div>
					 	<div class="form-group row">
					    	<label class="col-sm-2 col-form-label">Email</label>
						    <div class="col-sm-10">
						      	<input type="email" name="email" value="<?php echo$row[4]?>"  class="form-control" id="inputEmail3" placeholder="Enter The Email of The Student">
						    </div>
					 	</div>
					 	<div class="form-group row">
						    <label class="col-sm-2 col-form-label">Phone Number</label>
						    <div class="col-sm-10">
						        <input type="text" name="phone" value="<?php echo$row[5]?>"  class="form-control"  placeholder="Enter The Phone Number of The Student" >
						    </div>
						</div>
						

						<button type="submit" class="btn btn-primary pull-right btn-lg">SAVE THE EDITING</button>
					</form>
					<a href="clients.php" class="btn btn-primary btn-lg pull-right" style="color: #fff;margin-right: 10px;">Cancel</a>
				</div> 
 			
 			<?php
 			}else{
 				header('Location:clients.php');
 			}
 						
 	   	}elseif ($flag=='update') {
 	   		echo "<div class='container'>";
 			echo "<h1 class='text-center'>Editing Admin Info</h1>";
 			if($_SERVER['REQUEST_METHOD']=='POST'){
 				$clientID=$_POST['clientID']; // hkml  
 				$userName=$_POST['userName'];
 				$studentCode=$_POST['studentCode'];
 				$fullName=$_POST['fullName'];
 				$email=$_POST['email'];
 				$phone=$_POST['phone'];

 				try{
 					$stmt   =$con->prepare("UPDATE client SET userName=?, studentCode=?  , fullName=? ,email=? , phone=? where clientID=?");
 					$stmt->execute(array($userName,$studentCode,$fullName,$email,$phone,$clientID));
 					if($stmt->rowCount()>0){
 						echo '<div class="alert alert-success"><strong>SUCCESS </strong> The Client informations are Updated.</div>'; 	
 					}else{
 						echo '<div class="alert alert-info"><strong> Warning</strong> The Client informations are not  changed.</div>';
 					}
 				}catch(PDOException $e){
 					if($e->errorInfo[1]== 1062){
 						echo '<div class="alert alert-warning"><strong>Error!</strong> You Can\'t edit the Client using this username:<b>'. $userName .  '</b> because it is already existed.</div>';		
 					}else{
 						echo '<div class="alert alert-danger"><strong>Error!</strong> You Can\'t add.</div>';
 					}
 				}
 				echo '<a href="clients.php" class="btn btn-link btn-lg pull-right">Return to Manage Client</a>';
 				
 				
 			}else{
 				header('Location:clients.php');
 			}
 				
 		}elseif($flag=='delete'){
 			echo "<div class='container'>";
 			echo "<h1 class='text-center'>Deleting Client</h1>";
 			if(isset($_GET['clientID']) && is_numeric($_GET['clientID'])){
 				$client= intval($_GET['clientID']);

	 			$stmt   =$con->prepare("DELETE FROM `client` WHERE clientID=?");
	 			$stmt->execute(array($client));
	 			$rowCount=$stmt->rowCount();
	 			if($rowCount==1){
	 				echo '<div class="alert alert-success"><strong>SUCCESS </strong> The Client are Deleted.</div>'; 	
	 
	 			}else{
	 				echo '<div class="alert alert-info"><strong> Warning</strong> The Client ID are not  exist.</div>';
	 			}
	 			echo '<a href="clients.php" class="btn btn-link btn-lg pull-right">Return to Manage Client</a>';
 			}else{
 				header('Location:clients.php');
 			}

 		}else{
 			header('Location:clients.php');
 		}
 		echo "</div>";







	}else{
		header('Location:index.php');
		exit();
	}


?>





   <?php include $tpl . 'down.inc' ?>