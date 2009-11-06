<?php

define("Version", "0.17");
define("Author", "Joshua Jones");
define("VIEWS_DIR", "views");
define("DEFAULT_TEMPLATE", "layout.php");

function uri_dispatch()
{
	$uri = $_SERVER['REQUEST_URI'];
	$slice = substr($uri, 1);
	$split = explode("/", $slice);
	return $split;
}

function views()
{
	$dir = APP_PATH . "views/";
	$view_folder = opendir($dir);
	
	$filelist = array();
	
	while ($templates = readdir($view_folder))
	{
		if ($templates != ".." && $templates != '.' && $templates != "layout.php")
		{
			if (!is_dir($view_folder))
			{
				$filelist[] = $templates;
			}
		}
	}
	
	closedir($dir);
	
	return $filelist;
}

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
	
	$temps = views();
	
	foreach ($temps as $file)
	{
		$include = APP_PATH . VIEWS_DIR . "/" . $which . '.php';
	}
	$title = "Hello";
	//$include = APP_PATH . "views/about.php";

	$layout = include(APP_PATH . VIEWS_DIR . "/" . DEFAULT_TEMPLATE);
}

function run(){
	layout();
}