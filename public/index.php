<?php

error_reporting(E_ALL);

define("PUBLIC_PATH", dirname(dirname(__FILE__)) . "/");
define("APP_PATH", dirname(dirname(__FILE__)) . "/app/");
define('Version',			'0.1');
define('Author',			'Joshua Jones');
define('VIEWS_DIR',			'views');
define('DEFAULT_TEMPLATE',	'layout.php');

require_once APP_PATH . 'nancy.php';

$oats = new Quaker();

/* End of index.php */