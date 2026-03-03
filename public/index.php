<?php

use Core\Database;

require_once '../vendor/autoload.php';

session_start();

new Database(); // inicializa conexão

$router = new \Core\Router();
$router->run();