<?php
	$stmt=$con->prepare("SELECT * FROM message WHERE appear=1");
 	$stmt->execute();
 	$rows=$stmt->fetchAll();

								 	
?>
<div class="testimonials page_section" style="padding-top: 50px;padding-bottom: 50px;">
	<!-- <div class="testimonials_background" style="background-image:url(images/testimonials_background.jpg)"></div> -->
	<div class="testimonials_background_container">
		<div class="testimonials_background" style="background-image: url(layout/images/testimonials_background.jpg);"></div>
	</div>
	<div class="container">

		<div class="row">
			<div class="col">
				<div class="section_title text-center">
					<h1><?php echo lang('OUR CLIENTS');?></h1>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-10 offset-lg-1">

				
						
					
				<div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 400px;">
				    <!-- Indicators -->
				     <ol class="carousel-indicators">
				     		<?php 
					$count=-1;
					foreach ($rows as $row ) { 
						$count++;
						?>
				     	<li data-target='#myCarousel' data-slide-to='<?php echo $count; ?>' <?php if($count==1){echo 'active';}?> ></li>
				      	
				      	<?php } ?>
				    </ol>

				    <!-- Wrapper for slides -->
				    <div class="carousel-inner" style="text-align: center;">
				    	<?php 
					$count=0;
					foreach ($rows as $row ) { 
						$count++
						?>
					      <div class="carousel-item <?php if($count==1){echo 'active';}?>" >
						        <div class="quote">“</div>
								<p class="testimonials_text"><?php echo $row['message'] ;?></p>
								<div class="testimonial_user">
									<div class="testimonial_image mx-auto">
										<img src="layout/images/testimonials_user.jpg" alt="" style="height: 98px;">
									</div>
									<div class="testimonial_name"><?php echo $row['name'] ;?></div>
									<div class="testimonial_title"><?php echo lang('GRADUATE STUDENT');?></div>
								</div>
					      </div>
					      <?php } ?>
				    </div>
				   

				</div>
			</div>
		</div>

	</div>
</div>