<?php

require_once __DIR__ . '/../vendor/autoload.php';

use HackbartPR\Utils\Message;
use HackbartPR\Config\ConnectionCreator;
use HackbartPR\Repository\PDOVideoRepository;
use HackbartPR\Controller\NewVideoController;
use HackbartPR\Controller\SendVideoController;
use HackbartPR\Controller\ShowVideoController;
use HackbartPR\Controller\Response404Controller;
use HackbartPR\Controller\RemoveVideoController;
use HackbartPR\Controller\UpdateVideoController;

session_start();

$conn = ConnectionCreator::createConnection();
$repository = new PDOVideoRepository($conn);
$message = new Message();

$path = $_SERVER['PATH_INFO'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

$router = require_once __DIR__ . '/../routes/router.php';
$routerClass = $router["$method|$path"];

if (array_key_exists("$method|$path", $router)) {
    $controller = new $routerClass($repository, $message);
} else {    
    $controller = new Response404Controller();
}

$controller->processRequest();