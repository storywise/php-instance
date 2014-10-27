<?php

// Set default timezone in PHP 5.
if (function_exists('date_default_timezone_set'))
        date_default_timezone_set('Europe/Amsterdam');

define('ROOT', '');
define('FOLDER_FRAMEWORK', 'php/framework/');

require_once ROOT . FOLDER_FRAMEWORK . "autoload/Autoload.php";

// Register
Autoload::register();

?>