<?php
require_once("./config/config.php");
// require_once APP_ROOT."/views/home/index.php";
require_once APP_ROOT."/libs/DBConnection.php";

$a = new DBConnection();

$a->getCon();

?>