<?php

namespace HackbartPR\Controller;

use HackbartPR\Utils\Message;
use HackbartPR\Interfaces\Controller;
use HackbartPR\Repository\PDOVideoRepository;

class LoginController implements Controller
{
    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;    
    }

    public function processRequest(): void
    {
        require_once __DIR__ . '/../../view/login.php';
        $this->message->show();
    }
}