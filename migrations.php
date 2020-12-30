<?php

use app\core\Application;
use app\core\Router;
use app\controllers\SiteController;
use app\controllers\AuthController;

$rootPath = (__DIR__);

require_once $rootPath. "/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();



$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
    ],

];



$app = new Application($rootPath, $config);

$app->db->applyMigrations();