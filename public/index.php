<?php

use app\core\Application;
use app\core\Router;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\models\User;

$rootPath = dirname(__DIR__);

require_once $rootPath. "/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();



$config = [
    'userClass' => User::class,

    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
    ],

];



$app = new Application($rootPath, $config);

//HOME
$app->router->get('/', [SiteController::class,"home"]);
$app->router->get('/home', [SiteController::class,"home"]);

//CONTACT
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handelContact']);

//FORM
$app->router->get('/form',  [SiteController::class, "form"]);
$app->router->post('/form',  [SiteController::class, "handleForm"]);

//LOGIN
$app->router->get('/login',  [AuthController::class, "login"]);
$app->router->post('/login',  [AuthController::class, "login"]);

//REGISTER
$app->router->get('/register',  [AuthController::class, "register"]);
$app->router->post('/register',  [AuthController::class, "register"]);

//LOGOUT
$app->router->get('/logout', [AuthController::class, "logout"]);

//PROFILE
$app->router->get('/profile', [AuthController::class, 'profile']);


$app->run();
