
<?php 

	$pageTitle		='White House';
	$CSSFile		='courses_styles.css';
	include 'init.php' ;
	
	?>


	<?php 
	$HeadImg='courses_background.jpg';
	$head='COURSEHEAD';
	include $tpl . 'head_course.inc';
	
	include $tpl . 'Course.inc';
	?>


<?php include $tpl .'down.inc' ?>