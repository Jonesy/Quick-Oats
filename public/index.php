<?php

# Error Reporting
ini_set('display_errors', TRUE);
error_reporting(E_ALL & ~E_STRICT);

# Define some stuff
define('Version',	'0.1');
define("APP_PATH",	dirname(dirname(__FILE__)) . "/app/");

# Put the pot on
require APP_PATH . '/lib/helpers.php';
require APP_PATH . 'quaker.php';


#Bring to boil
Quaker::boil();

# End of index.php