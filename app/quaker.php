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

/*
 *	Autoload the helpers. Core is supplied with a bevy of features. 
 */
function __autoload($classname)
{
	require APP_PATH . "/helpers/" . $classname . ".php";
}

class Quaker
{
	# Global view
	static $uri;
	# Global vars
	static $config;
	
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
		# Check to make sure there's a URL
		if (empty($_SERVER['PATH_INFO']))
		{
			$path = "";
		}
		else
		{
			$path = $_SERVER['PATH_INFO'];
		}
		
		$slice = substr($path, 1);
		$uri_str = explode("/", $slice);
		
		foreach ($uri_str as $k => $v)
		{
		  if (empty($v))
		  {
		  	unset($uri_str[$k]);
		  }
		}
		# Grab the last uri segment
		self::$uri = end($uri_str);
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
		# If the template exists, load it, otherwise 404 it
		if (!self::$uri)
		{
			$include = APP_PATH . "/views/index.php";
			$layout = include(APP_PATH . "/views/layout.php");
		}
		else
		{
			if (file_exists(APP_PATH . "/views/" . self::$uri . ".php"))
			{
				$include = APP_PATH . "/views/" . self::$uri . ".php";
				$layout = include(APP_PATH . "/views/layout.php");
			}
			else
			{
				header("HTTP/1.0 404 Not Found");
				$layout = include(APP_PATH . "/views/404.php");
			}
		}
	}
	
	/*
	 *	BOIL!
	 *	-----------------------
	 *	And bring to a boil for 2 minutes, and enjoy!
	 */
	public static function boil($config)
	{
		# Assign the global config array
		self::$config = $config;
		
		# Get the URI
		self::router();
		
		#Render the view
		self::layout();
	}
}


# End of quaker.php