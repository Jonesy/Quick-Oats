<?php

define("Version", "0.1");
define("Author", "Joshua Jones");

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

function layout()
{
	$title = "Hello";
	$include = APP_PATH . "views/about.php";
	$layout = include(APP_PATH . "views/layout.php");
	echo $layout;
}

function run(){
	layout();
	
	$files = uri_dispatch();
		
	foreach ($files as $k => $file)
	{
		if (strlen($file) > 0)
		{
			echo "URI " . $k . ": " . $file . "<br>";
		}
	}
	
	$temps = views();
	
	foreach ($temps as $file)
	{
		echo $file . '<br>';
	}
}