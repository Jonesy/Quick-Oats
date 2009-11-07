<?php if (!defined('SITE')) exit('No direct script access allowed');

/*
 *	CODENAME NANCY
 *	By Joshua R. Jones
 *
 *	2009 (c) Copyright The General Metrics Web Development Company
 *	License is do whatever you want.
*/


define("Version",			"0.1");
define("Author",			"Joshua Jones");
define("VIEWS_DIR",			"views");
define("DEFAULT_TEMPLATE",	"layout.php");


/*
 *	URI DISPATCH
 *	Interpert the incoming URI
*/
function uri_dispatch()
{
	$uri = $_SERVER['PATH_INFO'];
	$slice = substr($uri, 1);
	$split = explode("/", $slice);
	
	foreach ($split as $k => $v)
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
	if (count($files) == 0)
	{
		$title = "Hello";
		$include = APP_PATH . VIEWS_DIR . "/index.php";
	}
		else
	{
	
		if (file_exists(APP_PATH . VIEWS_DIR . "/" . $num_uri . ".php"))
		{
			$include = APP_PATH . VIEWS_DIR . "/" . $which . ".php";
		}
		   else
		{
			$include = APP_PATH . VIEWS_DIR . "/404.php";
		}
	}
	
	$layout = include(APP_PATH . VIEWS_DIR . "/" . DEFAULT_TEMPLATE);
}

/*
 *	HELPERS
 *
 */
function stylesheets($styles)
{
	if (is_array($styles))
	{
		$css = "";
		
		foreach ($styles as $style)
		{
			$mod = filemtime(APP_PATH . "public/stylesheets/" . $style[0] . ".css");
			
			$css .= '<link rel="stylesheet" href="/stylesheets/' . $style[0] . '.css';
			$css .= '?' . $mod . '" ';
			$css .= 'media="'. $style[1] . '" ';
			$css .= 'type="text/css"/>';
			$css .= "\r\t\t";
		}
	}
	
	else
	{
		$css .= "hi";
	}
	
	echo $css;
}

/*
 *	Google Analytics
 */
function google_analytics($gid)
{
	$ga  = '<script type="text/javascript">';
	$ga .= 'var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");';
	$ga .= 'document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));';
	$ga .= '</script><script type="text/javascript">';
	$ga .= 'try {var pageTracker = _gat._getTracker("' . $gid . '");pageTracker._trackPageview();} catch(err) {}';
	$ga .= '</script>';
	$ga .= "\r";
	echo $ga;
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
