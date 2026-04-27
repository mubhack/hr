<?php

class AuthMiddleware
{
    public static function check()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }
    }

    public static function isAdmin()
    {
        self::check();
        if ($_SESSION['role'] !== 'hr') {
            header('Location: ' . BASE_URL . 'dashboard');
            exit;
        }
    }
}
