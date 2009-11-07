<?php if (!defined('SITE')) exit('No direct script access allowed');

/*
 *	CODENAME NANCY
 *	By Joshua R. Jones
 *
 *	2009 (c) Copyright The General Metrics Web Development Company
 *	License is do whatever you want.
 *
 *	== TODO =====================================================
 *	=	* Google Sitemap builder
 *	=	* Navigation builder
 *	=============================================================
*/

define('Version',			'0.1');
define('Author',			'Joshua Jones');
define('VIEWS_DIR',			'views');
define('DEFAULT_TEMPLATE',	'layout.php');


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
 
/*
 *	STYLESHEETS
 *	-----------------------
 *	Load in 1 or more CSS files. Caching control is added in.
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
	echo $css;
}

/*
 *	JAVASCRIPTS
 *	-----------------------
 *	Load in 1 or more JavaScript files. Caching control is added in.
 */
function javascripts($js)
{
	if (is_array($js))
	{
		$scriptfile = "";
		
		foreach ($js as $scripts)
		{
			$mod = filemtime(APP_PATH . "public/javascripts/" . $scripts[0] . ".css");
			$scriptfile .= '<script type="text/javascript" src="/javascripts/' . $scripts[0] . '.js';
			$scriptfile .= '?' . $mod . '"';
			$scriptfile .= '"></script>';
			$scriptfile .= "\r\t\t";
		}
	}
	echo $scriptfile;
}

/*
 *	Google Analytics
 *	-------------------------
 *	A cleaner way to insert Google Analytics code (legacy) in your website.
 */
 
function google_analytics($gid)
{
	if ($gid)
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
}

/*	RUN!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */
function run(){layout();}

/* End of nancy.php */