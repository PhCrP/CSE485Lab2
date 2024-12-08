<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\controllers\NewsController;

$adminController = new NewsController();
$adminController->index();
