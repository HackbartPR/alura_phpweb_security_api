<?php

namespace HackbartPR\Controller;

use HackbartPR\Entity\Video;
use HackbartPR\Utils\Message;
use HackbartPR\Interfaces\Controller;
use HackbartPR\Repository\PDOVideoRepository;

class UpdateVideoController implements Controller
{
    private Message $message;
    private PDOVideoRepository $repository;

    public function __construct(PDOVideoRepository $repository ,Message $message)
    {
        $this->repository = $repository;
        $this->message = $message;
    }

    public function processRequest(): void
    {
        [$id, $url, $title] = $this->validation();
        $resp = $this->repository->save(new Video($id, $title, $url));

        if ($resp) {
            Message::create(Message::UPDATE_SUCCESS);
        } else {
            Message::create(Message::UPDATE_FAIL);
        }
    }

    private function validation(): array
    {
        if (!isset($_POST) || !isset($_GET['id'])) {
            $this->message::create($this->message::FORM_FAIL);
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');
        
        if (!$url) {
            $this->message::create($this->message::URL_FAIL);
        }
        
        if (!$title) {
            $this->message::create($this->message::TITLE_FAIL);
        }

        return [$id, $url, $title];        
    }
}