
<?php
	
	$certification='';
	$flag ='';
	if(isset($_GET['flag'])){
		$flag=$_GET['flag'];
	}else{
		$flag='Manage';
	}
	if(isset($_GET['certification'])){
		$certification=$_GET['certification'];
	}else{
		$certification='Manage';
	}


	if($flag=='Manage'){ ?>
		<div class="register" id="cert">


			<div class="container-fluid">
				
				<div class="row row-eq-height">
					<div class="col-lg-6 nopadding">
						
						<!-- Register -->

						<div class="register_section d-flex flex-column align-items-center justify-content-center">
							<div class="register_content text-center">
								<?php 
								if($languages=='english'){
									$stmt=$con->prepare("SELECT `title`,`text`,`Link` FROM `advertise` WHERE ID=1 LIMIT 1"); 
					 				$stmt->execute();
					 				$row=$stmt->fetch();
					 			}elseif ($languages=='arabic') {
					 				$stmt=$con->prepare("SELECT `titleAr`,`textAr`,`Link` FROM `advertise` WHERE ID=1 LIMIT 1"); 
					 				$stmt->execute();
					 				$row=$stmt->fetch();
					 			}
								 ?>
								<h1 class="register_title"><?php echo $row[0] ; ?></h1>
								<p class="register_text"><?php echo $row[1] ; ?></p>
								<div class="button button_1 register_button mx-auto trans_200"><a href="<?php echo $row[2] ; ?>"><?php echo lang('REGISTER BTN'); ?></a></div>
							</div>
						</div> 

					</div>

					<div class="col-lg-6 nopadding">
						
						<!-- Search -->

						<div class="search_section d-flex flex-column align-items-center justify-content-center">
							<div class="search_background" style="background-image:url(layout/images/search_background.jpg);"></div>
							<div class="search_content text-center">
								<h1 class="search_title"><?php echo lang('SEARCH TITLE');?></h1>
								<?php
								if ($certification=='Manage') { ?>
									<form method="POST" action="?certification=search" class="search_form" >
										<input class="input_field search_form_name" name="ID" type="text" placeholder="<?php echo lang('SEARCH INPUTID');?>" data-error="certification ID is required.">
										<input class="input_field search_form_name" name="name" type="text" placeholder="<?php echo lang('SEARCH INPUTNAME');?>" data-error="Student Name is required.">
			
							
										<button id="search_submit_button" type="submit" class="search_submit_button trans_200" value="Submit"><?php echo lang('SEARCH BUTTON');?></button>
									</form>
						  <?php }elseif ($certification=='search') {
						  			if($_SERVER['REQUEST_METHOD']=='POST'){
						  				?>
						  				<script type="text/javascript">
						  					$(document).ready(function () {
    											$('html, body').animate({scrollTop: $('#cert').offset().top -180}, 'slow');
    										});
										</script>
										<?php
	 									$ID				=$_POST['ID'];
	 									$name 			=$_POST['name'];
	 									try{
					 						$stmt =$con->prepare("SELECT * FROM certification where ID=? OR studentName=? LIMIT 1");
								 			$stmt->execute(array($ID,$name));
								 			$row=$stmt->fetch();
								 			$rowCount=$stmt->rowCount();
						 					if($stmt->rowCount()!=0){ ?>
						 						<div class="form-group row">
											    	<label class="col-sm-3 col-form-label"><?php echo lang('SEARCH RESULT1');?></label>
												    <div class="col-sm-9">
												      	<input type="text" value="<?php echo $row[0];?>" class="form-control" disabled>
												    </div>
											 	</div>
											 	<div class="form-group row">
											    	<label class="col-sm-3 col-form-label"><?php echo lang('SEARCH RESULT2');?></label>
												    <div class="col-sm-9">
												      	<input type="text" value="<?php echo $row[1];?>" class="form-control" disabled>
												    </div>
											 	</div>
											 	<div class="form-group row">
											    	<label class="col-sm-3 col-form-label"><?php echo lang('SEARCH RESULT3');?></label>
												    <div class="col-sm-9">
												      	<input type="text" value="<?php echo $row[2];?>" class="form-control" disabled>
												    </div>
											 	</div>
											 	 <?php if ($row[3]!=0 || $row[4]!=0 ) { 	?>

											 	<div class="form-group row">
											    	<label class="col-sm-3 col-form-label"><?php echo lang('SEARCH RESULT4');?></label>
												    <div class="col-sm-4">
												      	<input type="text" value="<?php echo $row[3];?>" class="form-control" disabled>
												    </div>
												    <label class="col-sm-1 col-form-label"><?php echo lang('SEARCH TO');?></label>
												    <div class="col-sm-4">
												      	<input type="text" value="<?php echo $row[4];?>" class="form-control" disabled>
												    </div>
											 	</div>
											 	<?php } ?>
											 	 <?php if ($row[5]!=0) { ?>
											 	 <div class="form-group row">
											    	<label class="col-sm-3 col-form-label"><?php echo lang('SEARCH RESULT5');?></label>
												    <div class="col-sm-9">
												      	<input type="text" value="<?php echo $row[5];?>" class="form-control" disabled>
												    </div>
											 	</div>

											 	 <?php } ?>
											 	<a href='index.php' class='btn btn-success pull-right'><?php echo lang('SEARCH RESULTBTN');?></a>	
						 						
						 						<?php
						 					}else{
						 						 echo '<div class="alert alert-success">' . lang('SEARCH RESULTERROR1') . '</div>';
						 						 echo "<a href='index.php' class='btn btn-success'>".lang('SEARCH RESULTBTN')."</a>";
						 					}
						 				}catch(PDOException $e){
						 					
						 					echo '<div class="alert alert-success"><strong>' .lang('SEARCH RESULTSORRY') . '</strong>' . lang('SEARCH RESULTERROR2') .'</div>';
						 					echo '<div class="alert alert-success">'.lang('SEARCH RESULTCONTACT').'<a href="contact.php"></a> </div>';
						 					
						 				}
							 			
						 			}else{
						 				header('Location:index.php');
						 				exit();

						 			}
						  		}
						   ?>
							</div> 
						</div>

					</div>
				</div>
			</div>
		</div>		

	<?php 
	}
	
 ?>


