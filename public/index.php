<?php

error_reporting(E_ALL);

define("SITE", "Meow");
define("PUBLIC_PATH", dirname(dirname(__FILE__)) . "/");
define("APP_PATH", dirname(dirname(__FILE__)) . "/app/");

require_once APP_PATH . 'nancy.php';

run();

/* End of index.php */