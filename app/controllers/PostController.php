<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\Posts;



class PostController
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    public static function index(Database $db)
    {

        $postModel = new Posts($db);

        $info = [
            'env' => $_ENV,
            'session' => $_SESSION,
            'cookie' => $_COOKIE,
        ];

        $user = $_SESSION['user'];

        $posts = $postModel->getAll();


        header('Content-Type: text/html');
        include BASE_PATH . '/app/Views/Home.php';
    }
}
