<?php

namespace App\Core;

// session continue
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\PostController;
use App\Core\Database;
use PhpMyAdmin\VersionInformation;

class Router
{

    public function __construct()
    {
        // echo 'Router created';
    }


    public static function route(Database $db): void
    {

        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $parts = explode('/', $path); // url_arr

        $method = $_SERVER['REQUEST_METHOD'];
        $resource = $parts[2] ?? null;      //posts , null as index (home)
        $id = $parts[4] ?? null;    // id


        if ($path === '/' or $path === '/posts') {
            $mode = $_SESSION['user'] = 'guest';
            $logged_in = $_SESSION['logged_in'] = 0;
            http_response_code(200);
            PostController::index($db);
            exit;
        } elseif ($resource === "posts") {
            if ($id === null) {
                if ($method == "GET") {
                } elseif ($method == "POST") {
                    echo "Create post";
                    // TODO create an controller for create
                } else {
                    http_response_code(405); //Method Not Allowed
                    header("Allow: GET, POST");
                }
            } else {
                switch ($method) {
                    case 'GET':
                        // echo "Get post id: $id";
                        break;
                    case 'PATCH':
                        echo "Update post id: $id";
                        break;
                    case 'DELETE':
                        echo "Delete post id: $id";
                        break;
                    default:
                        http_response_code(405);
                        header("Allow: GET, PATCH, DELETE");
                }
            }
        } else {
            http_response_code(404);
            exit;
        }
    }
}
