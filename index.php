<?php

declare(strict_types=1);

session_start();

require_once("src/Controller/AbstractController.php");
require_once("src/Controller/AppController.php");
require_once("src/Request.php");
require_once("src/View.php");
require_once("src/Exception/AppException.php");
require_once("src/Exception/ConfigurationException.php");

use App\Controller\AbstractController;
use App\Controller\AppController;
use App\Request;
use App\Exception\AppException;
use App\Exception\ConfigurationException;

$configuration = require_once("config/config.php");
$request = new Request($_GET, $_POST, $_SERVER);

try{
	AbstractController::initConfiguration($configuration);
	(new AppController($request)) -> run();
} 

catch(AppException $e){
	echo "<h2>Application Error</h2><br>";
	echo "$e";
}

catch(ConfigurationException $e){
	echo "<h2>Application Error</h2><br>";
	echo "$e";
}

catch(StorageException $e){
	echo "<h2>Application Error</h2><br>";
	echo "$e";
}