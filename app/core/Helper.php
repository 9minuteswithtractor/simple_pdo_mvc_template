<?php


namespace App\Core;

// session continue
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Helper
{

    public static function setSecureCookie(): bool
    {
        $token = bin2hex(random_bytes(32));
        return setcookie('session_token', $token, [
            'expires' => time() + 3600, // 1h
            'path' => '/',
            'domain' =>  '/', //  . '/', // sets to all pages 
            'secure' => true,
            // isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
            'httponly' => true,
        ]);
    }

    public static function destroySession(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();

        // Unset cookie properly
        setcookie("session_token", "", time() - 3600, "/");
        setcookie("session_token", "", time() - 3600, "/", "", false, true);

        // Debug output
        print_r(headers_list());
        return true;
    }
}
