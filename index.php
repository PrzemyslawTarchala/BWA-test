<?php

declare(strict_types=1);

// namespace App;

session_start();

require_once("src/Controller/AbstractController.php");
require_once("src/Controller/AppController.php");
require_once("src/Request.php");
require_once("src/Utils/debug.php");
// include_once("../Model/UserModel.php");

require_once("src/View.php");
// require_once("src/Auxiliary/Auxiliary.php");

use App\Controller\AbstractController;
use App\Controller\AppController;
use App\Request;

$configuration = require_once("config/config.php");
$request = new Request($_GET, $_POST, $_SERVER);

AbstractController::initConfiguration($configuration);
(new AppController($request)) -> run();
