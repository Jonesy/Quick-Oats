Quick Oats
==========

## A small PHP framework, rich in fibre ##

**Quick Oats** is a simple framework for websites that are too small to employ databases, large frameworks and blog software, but you still want some simple helpers and clean URL's;

> ie. No resorting to dozens of index.html files in directories and global find and replaces to change simple elements, like metatags and stylesheets.

**Quick Oats** is being developed by a novice PHP developer, and is incredibly beta, so proceed with caution.

=====

## How to Use ##

1. Enter your CSS, JavaScript, Metatags, and if applicable, your Google Analytics key  in app/config.php.

2. Build out your site structure (super beta, expect this to change) in app/config.php
	> **[pagename], [slug]**
		$config['site_map'] = array(
			array(
				'Hello', 'hello',
			),
			array(
				'World', 'world'
			)
		);

2. Create view files in app/views that's name corresponds with link in fore mentioned site structure.
	> eg. sitename.com/hello will load the hello.php view.
	> eg. sitename.com/hello/world will load the world.php view.
	
3. And customize as you see fit!