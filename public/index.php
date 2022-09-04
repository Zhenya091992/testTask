<?php

use App\Router;
use App\Config;

require __DIR__.'/../vendor/autoload.php';

$config = Config::instance();

$router = new Router($config->routs);
$router->routing($_SERVER['REQUEST_URI']);
