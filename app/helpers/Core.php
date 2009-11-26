<?php

/*
 * Core
 * Extends the Oats class to install some out-of-the-box
 * features, such as:
 *   * Navigation builder
 *   * Page titles
 *   * Stylesheets files
 *   * Javascript files
 *   * Meta Tags
 *   * Google Analytics
 */

class Core extends Oats
{
	/*
	 *	Navigation
	 *	-----------------------
	 *	Load in 1 or more CSS files. Caching control is added in.
	 *	Assigned in config.php
	 *
	 *	@return string
	 */
	function navigation()
	{
		$sitemap = self::$config['site_map'];
		$home_name = self::$config['home_in_nav'];
		$nav = '<ul>';
		
		# If on the home page
		if ($home_name == "")
		{
			
		}
		else
		{
			if (!self::$uri )
			{
				$nav .= '<li class="active"><a href="/">' . $home_name . '</a></li>';
			}
			else
			{
				$nav .= '<li><a href="/">' . $home_name . '</a></li>';
			}
		}
		# Build out rest of the navigation
		foreach ($sitemap as $navitem)
		{
			if ($navitem[1] == self::$uri)
			{
				$nav .= '<li class="active">';
			}
			else
			{
				$nav .= '<li>';
			}
			$nav .= '<a href="/' . $navitem[1] . '">' . $navitem[0] . '</a></li>';
		}
		$nav .= '</ul>';
		$nav .= "\r";
		
		return $nav;
	}
	
	/*
	 *	Page title
	 *	-----------------------
	 *	Load the site name (defined in config.php) and the page title.
	 *
	 *	@return string
	 */
	function title()
	{
		if (!self::$uri)
		{
			$title = "Home";
		}
		else
		{
			$title = strtoupper(self::$uri[0]) . substr(self::$uri, 1);
		}
		$title  = self::$config['site_name'] . " | " . $title;
		return $title;
	}
	
	/*
	 *	Stylesheets
	 *	-----------------------
	 *	Load in 1 or more CSS files. Caching control is included.
	 *	Assigned in config.php
	 *
	 *	@return string
	 */
	function stylesheets()
	{
		if (isset(self::$config['css']))
		{
			$styles = self::$config['css'];
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
	}
	
	/*
	 *	Javascripts
	 *	-----------------------
	 *	Load in 1 or more JavaScript files. Caching control is included.
	 *	Assigned in config.php
	 *
	 *	@return string
	 */
	function javascripts()
	{
		if (isset(self::$config['js']))
		{
			$js = self::$config['js'];
			
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
	}
	
	/*
	 *	Meta
	 *	-----------------------
	 *	Build out meta tags as defined in config.php
	 *
	 *	@return string
	 */
	function meta()
	{
		if (isset(self::$config['meta']))
		{
			$meta = self::$config['meta'];
			$metatag = "";
			
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
	}
	
	/*
	 * Google Analytics
	 * -------------------------
	 * A cleaner way to insert Google Analytics code (legacy) in 
	 * your website. Requires code to be entered in config.php and
	 * checks to make sure that it is only rendered on the live server.
	 *
	 * @return string
	 */
	function google_analytics()
	{
		if (isset(self::$config['staging_url']))
		{
			if (self::$config['live_url'] == $_SERVER['SERVER_NAME'])
			{
				$gid = self::$config['google_analytics'];
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
		}
	}
}

# End of Core.php