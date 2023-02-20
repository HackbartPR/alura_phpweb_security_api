<?php

namespace HackbartPR\Controller;

use HackbartPR\Interfaces\Controller;
use HackbartPR\Repository\PDOVideoRepository;

class ShowVideoController implements Controller
{
    private PDOVideoRepository $repository;

    public function __construct(PDOVideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function processRequest(): void
    {
        $videoList = $this->repository->all();        
                
        require_once __DIR__ . '/../../view/showVideo.php';

        $this->showMessages();
    }
    
    private function showMessages(): void
    {
        if (isset($_SESSION['save'])) {
            if ($_SESSION['save']['status']) { ?>
                <div class='message success'>
                    <?= $_SESSION['save']['message']; ?>
                </div> <?php            
            } else { ?>
                <div class='message error'>
                    <?= $_SESSION['save']['message']; ?>
                </div> <?php
            }
            session_destroy();
        }
    }
}