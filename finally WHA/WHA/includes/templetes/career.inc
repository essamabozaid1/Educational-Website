<?php 
	$flag='';
	$output='';
	if(isset($_GET['flag'])){
		$flag=$_GET['flag'];
	}

	if($flag=='Submit'){
		//data base add 
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$size = (int) $_SERVER['CONTENT_LENGTH'];
			if($size <= 8388608 ){
				$name		=$_POST['name'];
				$email		=$_POST['email'];
				$phone		=$_POST['phone'];
				$date		=$_POST['date'];
				$position	=$_POST['position'];
				$letter		=$_POST['letter'];
				// file upload
				$file 			=$_FILES['upload'];
	 			$fileTemp 		=$_FILES['upload']['tmp_name'];
	 			
	 			$fileAllowedExtension 	= array('jpeg','png','jpg','gif','pdf','docx','doc');
	 			$fileExtension 	   	=strtolower(end(explode('.',$file['name'])));

	 			if(!empty($file['name']) && ! in_array($fileExtension,$fileAllowedExtension)){
	 				$output='This Extention Not Allowed';
				}
				elseif($file['size']> 4194304){
					$output='The File Can\'t be Larger Than <strong>4MB</strong>';
				}else{

					$stmt=$con->prepare("SELECT MAX( ID ) FROM career");
			 		$stmt->execute();
					$row=$stmt->fetch();
					if($row[0]!=0){
						
						$stmt=$con->prepare("ALTER TABLE career AUTO_INCREMENT = $row[0]");
						$stmt->execute();
					}else{
						
						$stmt=$con->prepare("ALTER TABLE career AUTO_INCREMENT = 1");
						$stmt->execute();
					}
					
					$CV='CV_'.($row[0]+1).'.'.$fileExtension;
		 			move_uploaded_file($fileTemp, "admin\upload\CV\\".$CV);

					try{
						$stmt   =$con->prepare("INSERT INTO career(name,email,phone,birthDate,letter,CV,Position) VALUES(?,?,?,?,?,?,?)");
						$stmt->execute(array($name,$email,$phone,$date,$letter,$CV,$position));
						$output='Thank you .. We will Contact With You';
					}catch(PDOException $e){
						$output='Sorry.. there\'s something wrong ';

					}

				}
	 				 

				//end file upload

				
			}else{
				$output='Sorry.. Your CV is Too large';
			}
 		}else{
 			header('Location:career.php');
 			exit();
 		}		

		
	}
 	
	
?>
<div class="contact">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					
					<!-- Contact Form -->
					<div class="contact_form">
						<div class="contact_title">Join US
							<p style="color:#4CAF50;font-size: 20px"><?php echo $output;  ?></p>
						</div>
						

						<div class="contact_form_container">
							
							<form action="?flag=Submit" method="POST" enctype="multipart/form-data">
								
								<div class="row">
								<div class="col-lg-6">
									<input  name="name" class="input_field contact_form_name" type="text" placeholder="Name" required="required">
									<input class="input_field contact_form_email" type="email" placeholder="E-mail" name="email" required="required">
									<input class="input_field contact_form_email" type="text" placeholder="Phone" name="phone" required="required" >
									<input class="input_field contact_form_email" type="text" onfocus="(this.type='date')" placeholder="Birth Date" onblur="(this.type='text')" name="date">
								</div>
								<div class="col-lg-6" >
									<input class="input_field contact_form_email" type="text" placeholder="Position" name="position" required="required" >
									<label class="col-lg-2 col-form-label">Resume</label>
									 
									<input class="col-lg-10 input_field form-control" style="color:#4CAF50;" type="file" placeholder="Resume" name="upload">
									

									<textarea class="text_field contact_form_message" name="letter" placeholder="Cover Letter"></textarea>
								</div>
								</div>
								
								<button type="Submit" class="contact_send_btn trans_200">Apply</button>
								
							</form>
						</div>
					</div>
						
				</div>

				

			</div>

	

			
		</div>
	</div>