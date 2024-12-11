<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once "./config/config.php";

use App\controllers\NewsController;

$adminController = new NewsController();
$adminController->index();
