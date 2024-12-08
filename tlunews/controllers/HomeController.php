<?php

namespace App\controllers;

use App\servers\newsServer;

class HomeController
{

    public function index()
    {
        include APP_ROOT . "/views/home/index.php";
    }
}
