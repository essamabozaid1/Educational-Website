<?php
	if(isset($_GET['newsID'])){
		if ($languages=='english') {
			$stmt=$con->prepare("SELECT `NewsDate`,`Header`,`FullPara` FROM news WHERE ID=?");
			$stmt->execute(array($_GET['newsID']));
			$row=$stmt->fetch();
		}elseif ($languages=='arabic') {
			$stmt=$con->prepare("SELECT `NewsDate`,`HeaderAr`,`FullParaAr` FROM news WHERE ID=?");
			$stmt->execute(array($_GET['newsID']));
			$row=$stmt->fetch();
		}
		

		$stmt=$con->prepare("SELECT * FROM newsimages WHERE newsID=?");
		$stmt->execute(array($_GET['newsID']));
		$imgs=$stmt->fetchAll();

		$orderdate = explode('-', $row[0]);
							 
		$day   = $orderdate[2];
		$year  = $orderdate[0];
		$monthNum  = $orderdate[1];;
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$month = $dateObj->format('F');
		?>
		<div class="news">
		<div class="container">
			<div class="row">
				
				<!-- News Post Column -->

				<div class="col-lg-8">
					
					<div class="news_post_container">
						<!-- News Post -->
						<div class="news_post">
							<div class="flex-sm-row ">
								
							<div class="slideshow-container">
									<?php
										$count=0;
										$imgCount= $stmt->rowCount();
										foreach ($imgs as $img) {
											$count++;
										 ?>

											<div class="mySlides">
											  <div class="numbertext"><?php echo $count; ?> / <?php echo $imgCount; ?></div>
											  <img src="admin/upload/images/<?php echo $img['imageName'] ?>" style="width:100%">
											</div>
										<?php } ?>
									
									<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
									<a class="next" onclick="plusSlides(1)">&#10095;</a>
									</div>
									<br>
									<div style="text-align:center">
										<?php 
										$count=0;
										foreach ($imgs as $img) { 
											$count++;
											?>

											<span class="dot" onclick="currentSlide(<?php echo $count; ?>)"></span> 
										<?php } ?>
									  
									</div>

								</div>		


							<div class="news_post_top d-flex flex-column flex-sm-row">
								<div class="news_post_date_container">
									<div class="news_post_date d-flex flex-column align-items-center justify-content-center">
										<div><?php echo $day; ?></div>
										<div><?php echo $month; ?></div>
										<div><?php echo $year; ?></div>
									</div>
								</div>
								<div class="news_post_title_container">
									<div class="news_post_title">
										<a href=""><?php echo $row[1]; ?></a>
									</div>
									
								</div>
							</div>
							<div class="news_post_text">

								<p><?php echo $row[2]; ?> </p>
							</div>

							

							
						</div>

					</div>
					
					

				</div>

				

			</div>
		</div>
	</div>

		




		<?php
	}else{
		header('Location:news.php');
 		exit();
	}
	
 ?>


	<script type="text/javascript" src="<?php echo $js.'newsimages.js'; ?> "></script>