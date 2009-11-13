<?php 

$styles = array(
	array('master', 'screen, projection'),
	array('print', 'print')
);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Demo</title>
		
		<?php echo $helper->stylesheets($styles); ?>
		
	</head>
	<body>
		<?php echo $helper->build_nav(); ?>
		
		<?php include($include); ?>
		
		<?php echo $helper->google_analytics("asdf"); ?>
		
	</body>
</html>