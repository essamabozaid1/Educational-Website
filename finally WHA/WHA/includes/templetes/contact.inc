<?php
	$output='';
 	if($_SERVER['REQUEST_METHOD']=='POST'){
 		$name=$_POST['name'];
 		$email=$_POST['email'];
 		$message=$_POST['message'];
 		$stmt= $con->prepare("INSERT INTO `message`(`name`, `email`, `message`) VALUES (?,?,?)");
 		$stmt->execute(array($name,$email,$message));
 		
 		$count=$stmt->rowCount();

 		if($count==1){
 			if($languages=='english'){
 				$output="Thank You For Your Message";
 			}elseif($languages=='arabic'){
 				$output="شكرا علي رسالتك";
 			}
 			
 		}
 	}
?>

<div class="contact">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
					
					<!-- Contact Form -->
					<div class="contact_form">
						<div class="contact_title"><?php echo lang('GETINTOUCH');?></div>

						<div class="contact_form_container">
							<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
								<input name="name" class="input_field contact_form_name" type="text" placeholder="<?php echo lang('CONTACTNAME');?>" required="required">
								<input class="input_field contact_form_email" type="email" placeholder="<?php echo lang('CONTACTEMAILINPUT');?>" name="email" required="required">
								<textarea class="text_field contact_form_message" name="message" placeholder="<?php echo lang('CONTACTMESSAGE');?>" required="required"></textarea>
								<button id="contact_send_btn" type="Submit" class="contact_send_btn trans_200"><?php echo lang('CONTACTBTN');?></button>
								<p style="color:#4CAF50"><?php echo $output ?> </p>
							</form>
						</div>
					</div>
						
				</div>

				<div class="col-lg-5">
					<div class="about">
						<div class="about_title"><?php echo lang('JOIN COURSES');?></div>
						<p class="about_text"><?php echo lang('JOIN COURSES PARA');?></p>

						<div class="contact_info">
							<ul>
								<li class="contact_info_item">
									<div class="contact_info_icon">
										<img src="layout/images/placeholder.svg" alt="">
									</div>
									<?php echo lang('CONTACTADDRESS');?>
								</li>
								<li class="contact_info_item">
									<div class="contact_info_icon">
										<img src="layout/images/smartphone.svg" alt="">
									</div>
									+2 01024633360
								</li>
								<li class="contact_info_item">
									<div class="contact_info_icon">
										<img src="layout/images/smartphone.svg" alt="">
									</div>
									<?php echo lang('CONTACTNUMBER1');?> 
								</li>
								<li class="contact_info_item">
									<div class="contact_info_icon">
										<img src="layout/images/smartphone.svg" alt="">
									</div>
									<?php echo lang('CONTACTNUMBER2');?>
								</li>
								<li class="contact_info_item">
									<div class="contact_info_icon">
										<img src="layout/images/envelope.svg" alt="">
									</div><?php echo lang('CONTACTEMAIL');?>
								</li>
							</ul>
						</div>

					</div>
				</div>

			</div>

			<!-- Google Map -->

			<div class="row">
				<div class="col">
					<div id="google_map">
						<div class="map_container">
							<div style="width: 100%;height: 100%;background-color: white"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27418.80043927907!2d30.990708426126805!3d30.792816183372448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6b63f3e6b57d4d4e!2sWhite+House+Academy!5e0!3m2!1sen!2seg!4v1523661831193" width="1110" height="532" frameborder="0" style="border:0" allowfullscreen></iframe> </div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
