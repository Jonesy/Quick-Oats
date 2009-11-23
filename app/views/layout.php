<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo Core::title(); ?></title>
		<?php echo Core::meta(); ?>
			
		<?php echo Core::stylesheets(); ?>
		
		<?php echo Core::javascripts(); ?>
		
	</head>
	<body>
		<div id="nav">
			<?php echo Core::navigation(); ?>
		</div>
		<?php include($include); ?>
		
		<?php echo Core::google_analytics(); ?>
	</body>
</html>