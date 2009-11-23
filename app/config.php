<?php 

$config['site_name'] = "Demo Site";

$config['site_map'] = array(
	array(
		'Hello', 'hello',
	),
	array(
		'World', 'world'
	)
);

/*
 *	STYLESHEETS
 *	-----------------------
 */
$config['css'] = array(
	array('master', 'screen, projection'),
	array('print', 'print')
);

/*
 *	META TAGS
 *	-----------------------
 */
$config['meta'] = array(
	'description' => 'Demo website',
	'keywords' => 'demo, website, php, oop',
	'author' => 'Joshua R. Jones',
	'copyright' => '2009',
	'robots' => 'index, nofollow'
);

$config['google_analytics'] = "11-11111";