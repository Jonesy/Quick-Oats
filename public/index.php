<?php

error_reporting(E_ALL);

define('Version',			'0.1');
define('SITE_NAME',			'Demo Site');
define("PUBLIC_PATH",		dirname(dirname(__FILE__)) . "/");
define("APP_PATH",			dirname(dirname(__FILE__)) . "/app/");

require_once APP_PATH . 'quaker.php';

$oats = new Quaker();


/* End of index.php */