<?php if (!defined('APP_PATH')) exit('No direct script access allowed');

/*
 *	INSTANT OATS
 *	By Joshua R. Jones
 *
 *	2009 (c) Copyright The General Metrics Web Development Company
 *	License is do whatever you want.
 *
 *	== TODO =====================================================
 *	=	* Google Sitemap builder
 *	=	* Navigation builder
 *	=	* Mailer
 *	=	* Form builder
 *	=	* Environments
 *	=============================================================
*/

class Quaker
{
	static $uri_array;
	
	function __construct()
	{
		date_default_timezone_set('America/Vancouver');
	}

	/*
	 *	Router
	 *	-----------------------
	 *	Interpert the incoming URI
	 *
	 *	@return array
	 */
	public static function router()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$slice = substr($uri, 1);
		$uris = explode("/", $slice);
		
		foreach ($uris as $k => $v)
		{
		  if (empty($v))
		  {
		  	unset($uris[$k]);
		  }
		}
		# Grab the last uri segment
		self::$uri_array = end($uris);
	}
	
	/*
	 *	LAYOUT
	 *	-----------------------
	 *	Load the default layout field
	 *
	 *	@return string
	 */
	public static function layout()
	{
		//If the template exists, load it, otherwise 404 it
		if (!self::$uri_array)
		{
			$include = APP_PATH . "/views/index.php";
			$layout = include(APP_PATH . "/views/layout.php");
		}
		else
		{
			if (file_exists(APP_PATH . "/views/layout.php"))
			{
				$include = APP_PATH . "/views/" . self::$uri_array . ".php";
				$layout = include(APP_PATH . "/views/layout.php");
			}
			else
			{
				header("HTTP/1.0 404 Not Found");
				$layout = include(APP_PATH . "/views/404.php");
			}
		}
	}
	
	/*	******************************************
	 *	HELPERS
	 *	------------------------------------------
	 */
	
	/*
	 *	STYLESHEETS
	 *	-----------------------
	 *	Load in 1 or more CSS files. Caching control is added in.
	 *	Assigned in models/config.php
	 *
	 *	@return string
	 */
	function stylesheets($styles)
	{
		if (is_array($styles))
		{
			$css = "";
			
			foreach ($styles as $style)
			{
				$mod = filemtime(dirname(APP_PATH) . "/public/stylesheets/" . $style[0] . ".css");
				$css .= '<link rel="stylesheet" href="/stylesheets/' . $style[0] . '.css';
				$css .= '?' . $mod . '" ';
				$css .= 'media="'. $style[1] . '" ';
				$css .= 'type="text/css" />';
				$css .= "\r\t\t";
			}
		}
		return $css;
	}
	
	/*
	 *	JAVASCRIPTS
	 *	-----------------------
	 *	Load in 1 or more JavaScript files. Caching control is added in.
	 *	Assigned in models/config.php
	 *
	 *	@return string
	 */
	function javascripts($js)
	{
		if (is_array($js))
		{
			$scriptfile = "";
			
			foreach ($js as $scripts)
			{
				$mod = filemtime(dirname(APP_PATH) . "/public/javascripts/" . $scripts[0] . ".css");
				$scriptfile .= '<script type="text/javascript" src="/javascripts/' . $scripts[0] . '.js';
				$scriptfile .= '?' . $mod . '"';
				$scriptfile .= '"></script>';
				$scriptfile .= "\r";
			}
		}
		return $scriptfile;
	}
	
	/*
	 *	META TAGS
	 *	-----------------------
	 *	Build out meta tags as defined in models/config.php
	 *
	 *	@return string
	 */
	function meta($meta)
	{
		$metatag;
		
		if (is_array($meta))
		{
			foreach ($meta as $k => $m)
			{
				if ($k == "author")
				{
					$metatag .= '<meta name="author" ';
					$metatag .= 'content="' . $m . '" />';
					$metatag .= "\r\t\t";
				}
				
				if ($k == "keywords")
				{
					$metatag .= '<meta name="keywords" ';
					$metatag .= 'content="' . $m . '" />';
					$metatag .= "\r\t\t";
				}
				
				if ($k == "description")
				{
					$metatag .= '<meta name="description" ';
					$metatag .= 'content="' . $m . '" />';
					$metatag .= "\r\t\t";
				}
				
				if ($k == "copyright")
				{
					$metatag .= '<meta name="copyright" ';
					$metatag .= 'content="' . $m . '" />';
					$metatag .= "\r\t\t";
				}
				
				if ($k == "robots")
				{
					$metatag .= '<meta name="robots" ';
					$metatag .= 'content="' . $m . '" />';
					$metatag .= "\r\t\t";
				}
			}
		}
		
		return $metatag;
	}
	
	/*
	 *	Google Analytics
	 *	-------------------------
	 *	A cleaner way to insert Google Analytics code (legacy) in your website.
	 *
	 *	@return string
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
			return $ga;
		}
	}
	
	/*
	 *	BOIL!
	 *	-----------------------
	 *	And bring to a boil
	 */
	public static function boil()
	{
		# Get the URI
		self::router();
		
		#Render the view
		self::layout();
		#print_r(self::$uri_array);
	}
}


# End of quaker.php