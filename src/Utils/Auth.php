<?php

namespace HackbartPR\Utils;

class Auth
{
    public static function isLogged(): bool
    {
        if (!$_SESSION['logged']) {            
            return false;
        }

        return true;
    }

    public static function login(): void
    {
        $_SESSION['logged'] = true;
    }

    public static function logout(): void
    {
        $_SESSION['logged'] = false;
    }    
}