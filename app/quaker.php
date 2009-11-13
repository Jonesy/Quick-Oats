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
		$sow = new Harvest();
		$sow->layout();
	}
}
/*
 *	LAYOUT
 *	-----------------------
 *	Load the default layout field
 *
 *	@return string
 */
class Harvest
{
	var $uri_array;

	/*
	 *	URI DISPATCH
	 *	-----------------------
	 *	Interpert the incoming URI
	 *
	 *	@return array
	 */
	function uri_dispatch()
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
	

	function layout()
	{
		// Load config file, helpers
		require_once APP_PATH . 'models/config.php';
		$helper = new Farmhand();
		
		// Set up vars
		$files = $this->uri_dispatch();
		$num_uri = end($files);
		
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
			if (file_exists(APP_PATH . "views/" . $num_uri . ".php"))
			{
				$include = APP_PATH . "views/" . $which . ".php";
				$layout = include(APP_PATH . "views/layout.php");
			}
			   else
			{
				$layout = include(APP_PATH . "views/404.php");
			}
		}
	}
}

/*
 *	HELPERS
 *
 */
class Farmhand
{
	/*
	 *	STYLESHEETS
	 *	-----------------------
	 *	Load in 1 or more CSS files. Caching control is added in.
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
				$mod = filemtime(PUBLIC_PATH . "public/stylesheets/" . $style[0] . ".css");
				$css .= '<link rel="stylesheet" href="/stylesheets/' . $style[0] . '.css';
				$css .= '?' . $mod . '" ';
				$css .= 'media="'. $style[1] . '" ';
				$css .= 'type="text/css"/>';
				$css .= "\r\t\t";
			}
		}
		return $css;
	}
	
	/*
	 *	JAVASCRIPTS
	 *	-----------------------
	 *	Load in 1 or more JavaScript files. Caching control is added in.
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
				$mod = filemtime(PUBLIC_PATH . "public/javascripts/" . $scripts[0] . ".css");
				$scriptfile .= '<script type="text/javascript" src="/javascripts/' . $scripts[0] . '.js';
				$scriptfile .= '?' . $mod . '"';
				$scriptfile .= '"></script>';
				$scriptfile .= "\r\t\t";
			}
		}
		return $scriptfile;
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
	
	function build_nav()
	{
		require_once APP_PATH . 'models/nav_model.php';
		$url = $this->uri_dispatch();
		
		$li = '<li><a href="/">Home</a></li>';
		foreach ($nav as $navitem)
		{
			if ($url[0] == strtolower($navitem))
			{
				$li .= '<li class="active">';
			}
			else
			{
				$li .= '<li>';
			}
			
			$li .= '<a href="' . strtolower($navitem) . '">' . $navitem . '</a>';
			$li .= '</li>';
		}
		
		return $li;
	}

}

/* End of nancy.php */