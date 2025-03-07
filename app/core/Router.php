<?php

namespace App\Core;

// session continue
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Core\Helper;
use App\Core\Database;
use App\Controllers\PostController;


class Router
{

    public function __construct()
    {
        // echo 'Router created';
    }


    /**
     * Summary of route
     * Very simple router implementation
     * @param \App\Core\Database $db
     * @return void
     */
    public static function route(Database $db): void
    {

        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $parts = explode('/', $path); // url_arr

        $method = $_SERVER['REQUEST_METHOD'];
        $resource = $parts[2] ?? null;   //posts , null as index (home)
        $id = $parts[4] ?? null;  // id


        if ($path === '/' or $path === '/posts') {
            if ($method === 'GET') {
                // guest_mode session ...
                $mode = $_SESSION['user'] = 'guest';
                $logged_in = $_SESSION['logged_in'] = 0;
                echo $_SERVER['HTTP_HOST'];
                if (Helper::setSecureCookie()) {
                    echo json_encode($_COOKIE);
                };
                // ::_.-._.-._.-._.-._.-._._.-._-._.-._.-.-._.-.::___end_comment




                http_response_code(200);
                PostController::index($db);
                exit;
            } elseif ($method === 'POST') {
            }
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
