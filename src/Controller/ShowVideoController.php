<?php

namespace HackbartPR\Controller;

use HackbartPR\Utils\Message;
use HackbartPR\Interfaces\Controller;
use HackbartPR\Repository\PDOVideoRepository;

class ShowVideoController implements Controller
{   
    private Message $message;
    private PDOVideoRepository $repository;

    public function __construct(PDOVideoRepository $repository, Message $message)
    {
        $this->message = $message; 
        $this->repository = $repository;
    }

    public function processRequest(): void
    {
        $videoList = $this->repository->all();        
                
        require_once __DIR__ . '/../../view/showVideo.php';

        $this->message->show();
    }        
}