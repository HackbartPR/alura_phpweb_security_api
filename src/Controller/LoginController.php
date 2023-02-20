<?php

namespace HackbartPR\Controller;

use HackbartPR\Utils\Auth;
use HackbartPR\Utils\Message;
use HackbartPR\Interfaces\Controller;

class LoginController implements Controller
{
    private Auth $auth;
    private Message $message;

    public function __construct(Message $message, Auth $auth)
    {
        $this->message = $message;
        $this->auth = $auth;
    }

    public function processRequest(): void
    {
        if ($this->auth->isLogged()) {
            header('Location: /');
            exit();
        }

        require_once __DIR__ . '/../../view/login.php';
        $this->message->show();
    }
}