
<?php 
	
	$pageTitle		='White House';
	$CSSFile		='main_styles.css';
	
	include 'init.php' ;
	
	?>
	<?php 
		include $tpl .'carousel.inc';
		include $tpl .'heroBoxes.inc';
		include $tpl .'popularCourse.inc';
		include $tpl .'Regist.inc';
		include $tpl .'services.inc';
		include $tpl .'ourClient.inc';
		include $tpl .'events.inc';



	?>

<?php include $tpl .'down.inc' ;

?>