<?php	
	if($languages=='english'){
		$stmt=$con->prepare("SELECT `SlideHeader`,`SlidePara`,`SlideImage` FROM carousel");
	 	$stmt->execute();
	 	$rows=$stmt->fetchAll();
 	}elseif ($languages=='arabic') {
 		$stmt=$con->prepare("SELECT `SlideHeaderAr`,`SlideParaAr`,`SlideImage` FROM carousel");
	 	$stmt->execute();
	 	$rows=$stmt->fetchAll();
 	}
 ?>
 <div id="topCarousel">
	<div id="demo" class="carousel slide" data-ride="carousel">
	  
		  <div class="carousel-inner">
			    <?php 
			    $count=0;
			    foreach ($rows as $row) { 
			    	$count++;
			    	
			     ?>
			    <div class="carousel-item <?php if($count==1){echo 'active';}?>">
			      <img src="<?php echo 'admin/upload/images/' . $row[2]; ?>" alt="Los Angeles" style="width:100%;">

			      <?php if($row[0]!='' && $row[1]!=''){ ?>
			      <div class="carousel-caption">
				        		
				        <h1><?php echo  $row[0];  ?> </h3>	          	
					          	
				        <p><?php echo  $row[1] ; ?> </p>
				        		
				  </div> 
				  <?php } ?> 
			    </div>
			    <?php } ?>
		  </div>
		  <a class="carousel-control-prev" href="#demo" data-slide="prev">
		    <span class="carousel-control-prev-icon"></span>
		  </a>
		  <a class="carousel-control-next" href="#demo" data-slide="next">
		    <span class="carousel-control-next-icon"></span>
		  </a>
	</div>
</div>

<?php include $js .'carouselResizing.js' ?>