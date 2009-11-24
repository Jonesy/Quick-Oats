<?php

# Put on the apron
ini_set('display_errors', TRUE);
error_reporting(E_ALL & ~E_STRICT);

# Measure out the ingredients
define('Version',	'0.1');
define("APP_PATH",	dirname(dirname(__FILE__)) . "/app");

# Fill pot with 1 cup of water
include APP_PATH . '/config.php';

# Add Quick Oats
require_once APP_PATH . '/Oats.php';

# Bring to boil
Oats::boil($config);

# End of index.php