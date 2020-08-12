<?php

	if ($languages=='english') {
		$stmt=$con->prepare("SELECT `courseName`,`description`,`price`,`image` FROM course WHERE popular=1 AND active=0 limit 3");
	 	$stmt->execute();
	 	$rows=$stmt->fetchAll();
	}elseif ($languages=='arabic') {
		$stmt=$con->prepare("SELECT `courseNameAr`,`descriptionAr`,`price`,`image` FROM course WHERE popular=1 AND active=0 limit 3");
	 	$stmt->execute();
	 	$rows=$stmt->fetchAll();
	}
		
	
	
	

?>

<div class="popular page_section">
			
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section_title text-center">
							<h1><?php echo lang('POPULAR COURSES');?></h1>
						</div>
					</div>
				</div>
				
				

				<div class="row course_boxes">
					

					<!-- Popular Course Item -->
					<?php foreach ($rows as $row) { ?>
					
					<div class="col-lg-4 course_box">
						<div class="card">
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span><?php echo $row[2] .'$' ;  ?></span></div>
							<img class="card-img-top" src="<?php echo 'admin/upload/images/'. $row[3] ?>" alt="">
							<div class="card-body text-center">
								<div class="card-title"><a href=""><?php echo strtoupper($row[0]);  ?></a></div>
								<div class="card-text"><?php echo $row[1]; ?></div>
							</div>
							
						</div>
					</div>
					<?php } ?>

				</div>
			</div>		
		</div>