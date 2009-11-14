<?php
/*
 *	HELPERS
 *
 */
class Farmhand
{
	function __construct()
	{

	}
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
				$mod = filemtime(PUBLIC_PATH . "public/stylesheets/" . $style[0] . ".css");
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
				$mod = filemtime(PUBLIC_PATH . "public/javascripts/" . $scripts[0] . ".css");
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
	
	function site_nav()
	{
		//require_once APP_PATH . 'models/nav_model.php';

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
	
	function title($sep)
	{
		$title = SITE_NAME . ' ' . $sep . ' Welcome';
		return $title;
	}

}