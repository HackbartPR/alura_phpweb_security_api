<?php

namespace HackbartPR\Controller;

use HackbartPR\Interfaces\Controller;
use HackbartPR\Repository\PDOVideoRepository;

class SendVideoController implements Controller
{
    private PDOVideoRepository $repository;

    public function __construct(PDOVideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function processRequest(): void
    {
        [$id] = $this->validation();

        $video = null;
        if ($id) {
            $video = $this->repository->show($id);
        }
                
        require_once __DIR__ . '/../../view/sendVideo.php';
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