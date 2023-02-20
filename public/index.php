<?php

require_once __DIR__ . '/../vendor/autoload.php';

use HackbartPR\Utils\Message;
use HackbartPR\Config\ConnectionCreator;
use HackbartPR\Repository\PDOUserRepository;
use HackbartPR\Repository\PDOVideoRepository;
use HackbartPR\Controller\NewVideoController;
use HackbartPR\Controller\SendVideoController;
use HackbartPR\Controller\ShowVideoController;
use HackbartPR\Controller\Response404Controller;
use HackbartPR\Controller\RemoveVideoController;
use HackbartPR\Controller\UpdateVideoController;

session_start();

$path = $_SERVER['PATH_INFO'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

$message = new Message();
$conn = ConnectionCreator::createConnection();

$repository = null;
if ($path === '/login') {
    $repository = new PDOUserRepository($conn);
} else {
    $repository = new PDOVideoRepository($conn);
}

$router = require_once __DIR__ . '/../routes/router.php';
$routerClass = $router["$method|$path"];

if (array_key_exists("$method|$path", $router)) {
    if ($path === '/login' && $method === 'GET') {
        $controller = new $routerClass($message);    
    }else {
        $controller = new $routerClass($repository, $message);
    }    
} else {    
    $controller = new Response404Controller();
}

$controller->processRequest();