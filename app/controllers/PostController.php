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

        // $posts = new Posts();

        echo '<pre />';
        echo json_encode(['message' => 'Hello from Home Page']);
        header('Content-Type: text/html');
        include BASE_PATH . '/app/Views/Home.php';
    }
}
