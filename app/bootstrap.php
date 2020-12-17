<?php 
// Load Config
require_once 'config/config.php';

// load Helpers
require_once "helpers/url_helper.php";
require_once "helpers/session_helper.php";

// Load Libraries Manually

// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';
// require_once 'libraries/Database.php';

// Autoload Core Libraries
spl_autoload_register(function($className){ // the class name should match the filename
    require_once 'libraries/'. $className . ".php";
});

