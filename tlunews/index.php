<?php
require_once 'controllers/AdminController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri == '/admin/login') {
    $controller = new AdminController();
    $controller->login();
} elseif ($uri == '/admin/logout') {
    $controller = new AdminController();
    $controller->logout();
} else {
    echo "404 Not Found";
}
?>
