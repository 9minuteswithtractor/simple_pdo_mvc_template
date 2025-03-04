<?php

namespace App\Controllers;

use App\Core\Database;



class PostController
{

    public function __construct(Database $db)
    {
        $db->getConnection();
        // echo 'PostController created';
    }


    public static function index()
    {

        // echo '<pre>';
        $info = [
            'env' => $_ENV,
            'session' => $_SESSION,
            'cookie' => $_COOKIE
        ];

        header('Content-Type: text/html');
        include BASE_PATH . '/app/Views/Home.php';
    }
}
