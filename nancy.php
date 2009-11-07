<?php
/*	UNNAMED PHP FRAMEWORK
 *	By Joshua R. Jones for The General Metrics Web Development Company
 *
 *	License is do whatever you want.
*/

define("Version", "0.17");
define("Author", "Joshua Jones");
define("VIEWS_DIR", "views");
define("DEFAULT_TEMPLATE", "layout.php");


/*
 *	URI DISPATCH
 *	Interpert the incoming URI
*/
function uri_dispatch()
{
	$uri = $_SERVER['PATH_INFO'];
	$slice = substr($uri, 1);
	$split = explode("/", $slice);
	
	foreach($split as $k => $v)
	{
		if (empty($v))
		{
			unset($split[$k]);
		}
	}
	
	return $split;
}


/*
 *	LAYOUT
 *	Load the default layout field
 */
function layout($template)
{
	$files = uri_dispatch();
	$num_uri = end(uri_dispatch());
	
	foreach ($files as $k => $file)
	{
		if (strlen($file) > 0)
		{
			$which = $file;
		}
	}
	
	// If the template exists, load it, otherwise 404 it
	if (file_exists(APP_PATH . VIEWS_DIR . "/" . $num_uri . ".php"))
	{
		$title = "Hello";
		$include = APP_PATH . VIEWS_DIR . "/" . $which . ".php";
	}
	   else
	{
		$title = "404";
		$include = APP_PATH . VIEWS_DIR . "/404.php";
	}
	
	$layout = include(APP_PATH . VIEWS_DIR . "/" . DEFAULT_TEMPLATE);
}

/*
 *	RUN!!!!!!
 */
function run()
{
	layout();
}

/*
 *	/end of nancy.php
 */
