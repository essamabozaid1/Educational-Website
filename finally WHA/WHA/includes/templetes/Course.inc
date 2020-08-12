<?php
//azbat el fr2 feh home 3n el courses mn yamet el url 3shan yzbot limit 3
	if(isset($_GET['catID'])){
		$catID=$_GET['catID'];
		if($languages=='english'){
			$stmt=$con->prepare("SELECT `courseName`,`description`,`price`,`image` FROM course WHERE active=0 AND catID= $catID");
		 	$stmt->execute();
		 	$rows=$stmt->fetchAll();
	 	}elseif ($languages=='arabic') {
	 		$stmt=$con->prepare("SELECT `courseNameAr`,`descriptionAr`,`price`,`image` FROM course WHERE active=0 AND catID= $catID");
		 	$stmt->execute();
		 	$rows=$stmt->fetchAll();
	 	}



	}else{
		if($languages=='english'){
			$stmt=$con->prepare("SELECT `courseName`,`description`,`price`,`image` FROM course WHERE active=0");
	 		$stmt->execute();
	 		$rows=$stmt->fetchAll();
	 	}elseif ($languages=='arabic') {
	 		$stmt=$con->prepare("SELECT `courseNameAr`,`descriptionAr`,`price`,`image` FROM course WHERE active=0");
	 		$stmt->execute();
	 		$rows=$stmt->fetchAll();
	 	}
	}
		if($languages=='english'){
			$stmt=$con->prepare("SELECT `categoryID`,`catName` FROM category");
	 		$stmt->execute();
	 		$cats=$stmt->fetchAll();
	 	}elseif ($languages=='arabic') {
	 		$stmt=$con->prepare("SELECT `categoryID`,`catNameAr` FROM category");
	 		$stmt->execute();
	 		$cats=$stmt->fetchAll();
	 	}
		
	

?>

<div class="popular page_section">
			
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section_title text-center">
							<h1><?php echo lang('COURSEHEAD');?></h1>
						</div>
					</div>
				</div>
				<div class="sidenav">
					<?php foreach ($cats as $cat) {  ?>

						<a href="?catID=<?php echo $cat[0] ?>"><?php echo $cat[1]; ?></a>	
					
					 <?php } ?>
				</div>
				

				<div class="row course_boxes">
					

					<!-- Popular Course Item -->
					<?php foreach ($rows as $row) { ?>
					
					<div class="col-lg-4 course_box">
						<div class="card">
							<div class="course_price d-flex flex-column align-items-center justify-content-center"><span><?php echo $row[2];  ?></span></div>
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