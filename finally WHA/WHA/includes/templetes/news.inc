<?php 
	if($languages=='arabic'){
		$stmt=$con->prepare("SELECT `ID`,`HeaderAr`,`SubParaAr`,`NewsDate`,`mainImage` FROM news");
		$stmt->execute();
		$rows=$stmt->fetchAll();
	}elseif ($languages=='english') {
		$stmt=$con->prepare("SELECT `ID`,`Header`,`SubPara`,`NewsDate`,`mainImage` FROM news");
		$stmt->execute();
		$rows=$stmt->fetchAll();
	}
	
?>

<div class="news">
			<div class="container">
				<div class="row">
					
					<!-- News Column -->

					<div class="col-lg-8">
						
						<div class="news_posts">


							<?php 
							foreach ($rows as $row) { 
								$orderdate = explode('-', $row[3]);
							 
								$day   = $orderdate[2];
								$year  = $orderdate[0];
								$monthNum  = $orderdate[1];;
								$dateObj   = DateTime::createFromFormat('!m', $monthNum);
								$month = $dateObj->format('F'); // March
							?>

							
							<div class="news_post">
								<div class="news_post_image">
									<img src="<?php echo 'admin/upload/images/'. $row[4] ; ?>" alt="news_Image" >
								</div>
								<div class="news_post_top d-flex flex-column flex-sm-row">
									<div class="news_post_date_container">
										<div class="news_post_date d-flex flex-column align-items-center justify-content-center">
											<div><?php echo $day ;?></div>
											<div><?php echo $month ;?></div>
											<div><?php echo $year ;?></div>
										</div>
									</div>
									<div class="news_post_title_container">
										<div class="news_post_title">
											<a href="post.php?newsID=<?php echo $row[0]; ?>"><?php echo $row[1] ;?></a>
										</div>
										
									</div>
								</div>
								<div class="news_post_text">
									<p><?php echo $row[2]; ?></p>
								</div>
								<div class="news_post_button text-center trans_200">
									<a href="post.php?newsID=<?php echo $row[0]; ?>"><?php echo lang('VIEW MORE');?></a>
								</div>
							</div>
							<?php } ?>
							<!-- News Post -->						

						</div>

						<!-- Page Nav -->
						<div class="news_page_nav">
							<ul>
								<li class="active text-center trans_200" onclick="paging(this)">1</li>
								
							</ul>
						</div>
					</div>

					<!-- Sidebar Column -->

		
				</div>
			</div>
		</div>



<script type="text/javascript" src="<?php echo $js .'NewsPaging.js' ; ?>"></script>
