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

function __autoload($classname)
{
	require APP_PATH . "/helpers/" . $classname . ".php";
}

class Quaker
{
	# Global view
	static $view;
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
		self::$view = end($uris);
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
		if (!self::$view)
		{
			$include = APP_PATH . "/views/index.php";
			$layout = include(APP_PATH . "/views/layout.php");
		}
		else
		{
			if (file_exists(APP_PATH . "/views/" . self::$view . ".php"))
			{
				$include = APP_PATH . "/views/" . self::$view . ".php";
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