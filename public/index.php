<?php

# Error Reporting
ini_set('display_errors', TRUE);
error_reporting(E_ALL & ~E_STRICT);

# Define some stuff
define('Version',	'0.1');
define("APP_PATH",	dirname(dirname(__FILE__)) . "/app");

include APP_PATH . '/models/config.php';

# Put the pot on
require_once APP_PATH . '/quaker.php';


#Bring to boil
Quaker::boil($config);

# End of index.php