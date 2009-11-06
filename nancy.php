<?php

function uri_dispatch()
{
	$uri = $_SERVER['REQUEST_URI'];
	$slice = substr($uri, 1);
	$split = explode("/", $slice);
	return $split;
}

function run(){
	$files = uri_dispatch();
	
	foreach ($files as $k => $file)
	{
		echo "URI " . $k . ": " . $file . "<br>";
	}
}