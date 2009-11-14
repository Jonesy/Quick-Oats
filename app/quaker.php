<?php if (!defined('APP_PATH')) exit('No direct script access allowed');

/*
 *	QUAKER OATS
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
	function __construct()
	{
		date_default_timezone_set('Vancouver/Pacific');
		$fibre = new Harvest();
		$fibre->layout();
	}
}

class Harvest
{
	var $uri_array;
	var $globs;
	function __construct()
	{
		require_once APP_PATH . 'models/config.php';
		$this->glob = $styles;
	}

	/*
	 *	Router
	 *	-----------------------
	 *	Interpert the incoming URI
	 *
	 *	@return array
	 */
	function router()
	{
		$uri = $_SERVER['PATH_INFO'];
		$slice = substr($uri, 1);
		$this->uri_array = explode("/", $slice);
		
		foreach ($this->uri_array as $k => $v)
		{
		  if (empty($v))
		  {
		  	unset($this->uri_array[$k]);
		  }
		}
		return $this->uri_array;
	}
	
	/*
	 *	LAYOUT
	 *	-----------------------
	 *	Load the default layout field
	 *
	 *	@return string
	 */
	function layout()
	{
		
	  // Load config file, helpers
	  // Set up vars
	  $files = $this->router();
	  $template_file = end($files);
	  
	  foreach ($files as $k => $file)
	  {
	  	if (strlen($file) > 0)
	  	{
	  		$which = $file;
	  	}
	  }
	
	  //If the template exists, load it, otherwise 404 it
	  if (count($files) == 0)
	  {
	  	$include = APP_PATH . "views/index.php";
	  	$layout = include(APP_PATH . "views/layout.php");
	  }
	    else
	  {
	  	if (file_exists(APP_PATH . "views/" . $template_file . ".php"))
	  	{
	  		$include = APP_PATH . "views/" . $which . ".php";
	  		$layout = include(APP_PATH . "views/layout.php");
	  	}
	  	   else
	  	{
	  		header("HTTP/1.0 404 Not Found");
	  		$layout = include(APP_PATH . "views/404.php");
	  	}
	  }
	}
}


/* End of quaker.php */