<?php

		if($languages=='english'){
			$stmt=$con->prepare("SELECT `eventDate`,`eventName`,`eventLocation`,`eventPara`,`mainImage` FROM event");
	 		$stmt->execute();
	 		$rows=$stmt->fetchAll();
		}elseif ($languages=='arabic') {
			$stmt=$con->prepare("SELECT `eventDate`,`eventNameAr`,`eventLocationAr`,`eventParaAr`,`mainImage` FROM event");
	 		$stmt->execute();
	 		$rows=$stmt->fetchAll();
		}
		
	
	
	

?>
<div class="events page_section">
	<div class="container">
		
		<div class="row">
			<div class="col">
				<div class="section_title text-center">
					<h1><?php echo lang('UPCOMING EVENTS');?></h1>
				</div>
			</div>
		</div>
		
		<div class="event_items">

			<!-- Event Item -->

			<?php foreach ($rows as $row) { 
				$orderdate = explode('-', $row[0]);
							 
				$day   = $orderdate[2];
				$year  = $orderdate[0];
				$monthNum  = $orderdate[1];;
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				$month = $dateObj->format('F'); // March
			?>
				
					<div class="row event_item">
						<div class="col">
							
							<div class="row d-flex flex-row align-items-end">

								<div class="col-lg-2 order-lg-1 order-2">
									<div class="event_date d-flex flex-column align-items-center justify-content-center">
										<div class="event_day"><?php echo $day; ?></div>
										<div class="event_month"><?php echo $month; ?></div>
										<div class="event_year"><?php echo $year; ?></div>
									</div>
								</div>

								<div class="col-lg-7 order-lg-2 order-3">
									<div class="event_content">
										<div class="event_name"><?php echo $row[1]; ?></div>
										<div class="event_location"><?php echo $row[2]; ?></div>
										<p><?php echo $row[3]; ?></p>
									</div>
								</div>

								<div class="col-lg-3 order-lg-3 order-1">
									<div class="event_image">
										<img src="admin/upload/images/<?php echo $row[4]; ?>" alt="event_image">
									</div>
								</div>

							</div>	
						</div>
					</div>	



					<?php	} ?>
			

			
		</div>
			
	</div>
</div>