<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php getTitle(); ?></title>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="WHA Project">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		
		
		<link rel="stylesheet" type="text/css" href="<?php echo $css;?>bootstrap.min.css">


		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  		<link rel="stylesheet" type="text/css" href="<?php echo $css;?><?php echo $CSSFile; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo $css;?>responsive.css">
		<?php 
			if($languages=='arabic'){ ?>

				<link rel="stylesheet" type="text/css" href="<?php echo $css;?>RTL.css">
			<?php } ?>
			
  		

  	</head>
  	<body>
  		
  	
