<?php
require_once '../vendor/autoload.php';

$configDir = __DIR__.'/../config/';
$config = new App\Core\Config\Config($configDir);

$router = new App\Core\Router\Router($config);
$router->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
