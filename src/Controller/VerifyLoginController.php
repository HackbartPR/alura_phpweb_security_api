<?php

namespace HackbartPR\Controller;

use HackbartPR\Utils\Message;
use HackbartPR\Repository\PDOUserRepository;

class VerifyLoginController
{
    private Message $message;
    private PDOUserRepository $repository;

    public function __construct(PDOUserRepository $repository ,Message $message)
    {
        $this->repository = $repository;
        $this->message = $message;
    }
    
    public function processRequest(): void
    {
        [$email, $password] = $this->validation();
        $user = $this->repository->findByEmail($email);
        
        if (!$user) {
            $this->message::create($this->message::LOGIN_FAIL, '/login');
        }

        if (!password_verify($password, $user->password())) {
            $this->message::create($this->message::LOGIN_FAIL, '/login');            
        } 
        
        $this->message::create($this->message::LOGIN_SUCCESS);
    }
    
    private function validation(): array
    {
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            $this->message::create($this->message::FORM_FAIL, '/login');
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        
        if (!$email) {
            $this->message::create($this->message::EMAIL_INVALID, '/login');
        }

        return [$email, $password];
    }
}