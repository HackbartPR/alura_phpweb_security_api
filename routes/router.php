<?php

return [
    'GET|/' => \HackbartPR\Controller\ShowVideoController::class,
    'GET|/novo' => \HackbartPR\Controller\SendVideoController::class,
    'POST|/novo' => \HackbartPR\Controller\NewVideoController::class,
    'GET|/editar' => \HackbartPR\Controller\SendVideoController::class,
    'POST|/editar' => \HackbartPR\Controller\UpdateVideoController::class,
    'GET|/remover' => \HackbartPR\Controller\RemoveVideoController::class,
];