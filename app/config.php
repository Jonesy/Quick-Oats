<?php 

/*
 * Site Name
 * -----------------------
 * Set your site name for the <title> tag.
 */
$config['site_name'] = "Demo Site";

/*
 * Staging URL
 * -----------------------
 */
$config['staging_url'] = "quaker.local";

/*
 * Production URL
 * -----------------------
 */
$config['live_url'] = "example.com";

/*
 * Site Map
 * -----------------------
 * Layout your navigation.
 */
# If you want the homepage included in the navigation,
# enter it here.
$config['home_in_nav'] = "Home Run";

# The rest of the navigation
$config['site_map'] = array(
	array(
		'Hello', 'hello',
	),
	array(
		'World', 'world'
	)
);

/*
 * Stylesheets
 * -----------------------
 * Set up your stylesheets, in order of how you'd like them to appear,
 * 
 * [filename], [type]
 */
$config['css'] = array(
	array('master', 'screen, projection'),
	array('print', 'print')
);

/*
 * Meta Tags
 * -----------------------
 * Set up your metatags.
 * [type], [content]
 */
$config['meta'] = array(
	'description' => 'Demo website',
	'keywords' => 'demo, website, php, oop',
	'author' => 'Joshua R. Jones',
	'copyright' => '2009',
	'robots' => 'index, nofollow'
);

/*
 * Google Analytics
 * -----------------------
 * If applicable, enter your Google Analytics code, and it will be inserted
 * right before the </body> tag.
 * 
 * [filename], [type]
 */
$config['google_analytics'] = "11-11111";