<?php
	$output='';
 	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'])){
 		
 		
 		
 		try{
 			$email 	=$_POST['email'];
 			$stmt= $con->prepare("INSERT INTO `message`(`email`) VALUES (?)");
	 		$stmt->execute(array($email));
	 		
	 		$count=$stmt->rowCount();

	 		if($count==1){
	 			$output="Thank You.. You Will Recieve The New News";
	 			
 			}else{
 				$output="Sorry.. Your Message is not Send";

 			}
 			?>
			<script type="text/javascript">
				$(document).ready(function () {
					$('html, body').animate({scrollTop: $('#newsletter').offset().top -180}, 'slow');
				});
			</script>
			<?php
 		
 		}catch(PDOException $e){
 			
 		}
 	}
?>

<footer class="footer">
			<div class="container">
				
				<!-- Newsletter -->

				<div class="newsletter" id='newsletter'>
					<div class="row">
						<div class="col">
							<div class="section_title text-center">
								<h1><?php echo lang('SUBSCRIBETEXT');?></h1>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col text-center">
							<div class="newsletter_form_container mx-auto">
								<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
									<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-center">
										<input class="newsletter_email" type="email" name="email" placeholder="<?php echo lang('SUBSCRIBEINPUT');?>" required="required">
										
										<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit"><?php echo lang('SUBSCRIBEBTN');?></button>

									</div>
									<p style="color:#4CAF50"><?php echo $output ?> </p>
								</form>
							</div>
						</div>
					</div>

				</div>

				<!-- Footer Content -->

				<div class="footer_content">
					<div class="row">

						<!-- Footer Column - About -->
						<div class="col-lg-4 footer_col">

							<!-- Logo -->
							<div class="logo_container">
								<div class="logo">
									<img src="layout/images/logo.png" alt="">
									<span><?php echo lang('WHITE HOUSE');?></span>
								</div>
							</div>

							<p class="footer_about_text"><?php echo lang('FOOTER PARA');?></p>

						</div>

						<!-- Footer Column - Menu -->

						<div class="col-lg-2 footer_col">
							<div class="footer_column_title"><?php echo lang('MENU');?></div>
							<div class="footer_column_content">
								<ul>
									<li class="footer_list_item"><a href="index.php"><?php echo lang('HOME');?></a></li>
									<li class="footer_list_item"><a href="course.php"><?php echo lang('COURSES');?></a></li>
									<li class="footer_list_item"><a href="instructor.php"><?php echo lang('INSTRUCTOR');?></a></li>
									<li class="footer_list_item"><a href="news.php"><?php echo lang('NEWS');?></a></li>
									<li class="footer_list_item"><a href="contact.php"><?php echo lang('CONTACT');?></a></li>
								</ul>
							</div>
						</div>

						<!-- Footer Column - Usefull Links -->

						<div class="col-lg-2 footer_col">
							<div class="footer_column_title"><?php echo lang('SOCIAL LINKS');?></div>
							<div class="footer_column_content">
								<ul>
									<li class="footer_list_item"><a href="https://www.facebook.com/White.House.Academy/"><?php echo lang('FACEBOOK');?></a></li>
									<li class="footer_list_item"><a href="#"><?php echo lang('TWITTER');?></a></li>
									<li class="footer_list_item"><a href="#"><?php echo lang('YOUTUBE');?></a></li>
									<li class="footer_list_item"><a href="#"><?php echo lang('INSTAGRAM');?></a></li>
									
								</ul>
							</div>
						</div>

						<!-- Footer Column - Contact -->

						<div class="col-lg-4 footer_col">
							<div class="footer_column_title"><?php echo lang('CONTACT');?></div>
							<div class="footer_column_content">
								<ul>
									<li class="footer_contact_item">
										<div class="footer_contact_icon">
											<img src="layout/images/placeholder.svg" alt="">
										</div>
										<span><?php echo lang('CONTACTADDRESS');?> </span>
									</li>
									<li class="footer_contact_item">
										<div class="footer_contact_icon">
											<img src="layout/images/smartphone.svg" alt="">
										</div>
										<span class="phoneNumber"><?php echo lang('CONTACTNUMBER1');?></span>
										
									</li>
									<li class="footer_contact_item">
										<div class="footer_contact_icon">
											<img src="layout/images/smartphone.svg" alt="">
										</div>
										<span class="phoneNumber"><?php echo lang('CONTACTNUMBER2');?></span>
										
									</li>
									<li class="footer_contact_item">
										<div class="footer_contact_icon">
											<img src="layout/images/envelope.svg" alt="">
										</div>
										<span><?php echo lang('CONTACTEMAIL');?></span>
									</li>
								</ul>
							</div>
						</div>

					</div>
				</div>

				<!-- Footer Copyright -->

				<div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
					<div class="footer_copyright">
						<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							<?php echo lang('COPYRIGHT');?> 
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</span>
					</div>
					
				</div>

			</div>
		</footer>