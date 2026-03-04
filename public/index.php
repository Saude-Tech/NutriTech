<?php

use Core\Database;
use Core\Router;
use Core\Auth;

require_once '../vendor/autoload.php';

session_start();

new Database();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/nutritech' || $uri === '/nutritech/') {

    if (Auth::check()) {
        header('Location: /nutritech/index');
    } else {
        header('Location: /nutritech/auth');
    }

    exit;
}

$router = new Router();
$router->run();