<?php

namespace HackbartPR\Controller;

use HackbartPR\Entity\Video;
use HackbartPR\Utils\Message;
use HackbartPR\Interfaces\Controller;
use HackbartPR\Repository\PDOVideoRepository;

class NewVideoController implements Controller
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
        [$url, $title] = $this->validation();
        $resp = $this->repository->save(new Video(null, $title, $url));

        if ($resp) {
            $this->message::create($this->message::REGISTER_SUCCESS);
        } else {
            $this->message::create($this->message::REGISTER_FAIL);
        }
    }

    private function validation(): array
    {
        if (!isset($_POST)) {
            $this->message::create($this->message::FORM_FAIL);
        }

        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');

        if (!$url) {
            $this->message::create($this->message::URL_FAIL);
        }
        
        if (!$title) {
            $this->message::create($this->message::TITLE_FAIL);
        }

        return [$url, $title];        
    }
}