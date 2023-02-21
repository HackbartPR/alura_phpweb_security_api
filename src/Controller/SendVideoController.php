<?php

namespace HackbartPR\Controller;

use HackbartPR\Utils\Message;
use HackbartPR\Interfaces\Controller;
use HackbartPR\Repository\PDOVideoRepository;

class SendVideoController implements Controller
{
    private Message $message;
    private PDOVideoRepository $repository;

    public function __construct(PDOVideoRepository $repository, Message $message)
    {
        $this->repository = $repository;
        $this->message = $message;
    }

    public function processRequest(): void
    {
        [$id] = $this->validation();

        $video = null;
        if ($id) {
            $video = $this->repository->show($id);
        }
                
        require_once __DIR__ . '/../../view/sendVideo.php';

        $this->message->show();
    }

    private function validation(): array
    {
        $id = null;
        if (isset($_GET['id'])) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);            
        }

        return [$id];        
    }
}