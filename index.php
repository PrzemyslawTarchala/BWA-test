<?php

declare(strict_types=1);

session_start();

require_once("src/Controller/AppController.php");

(new AppController()) -> run();

//before changes