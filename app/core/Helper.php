<?php


namespace App\Core;

class Helper
{

    private static function generateSessionToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    public static function setSecureCookie(): bool
    {
        $session_token = self::generateSessionToken();
        return setcookie('session_token', $session_token, [
            'expires' => time() + 3600, // 1h
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'], // sets to all pages 
            'secure' => true,
            'httponly' => true
        ]);
    }
}
