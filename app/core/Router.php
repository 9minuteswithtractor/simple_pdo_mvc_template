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


    public static function route(): void
    {
        // TODO can these values be passed as private default values in Database class
        $db = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_PORT']);

        if ($conn = $db->getConnection()) {
            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $parts = explode('/', $path); // url_arr

            $method = $_SERVER['REQUEST_METHOD'];
            $resource = $parts[2] ?? null;      //posts
            $id = $parts[4] ?? null;    // id
        }


        // echo 'request_method: ' . $path;
        // echo 'formatted_path: ' . $path;
        // echo PHP_EOL;
        // echo 'Uri: ' . $_SERVER['REQUEST_URI'];
        // echo PHP_EOL;
        // echo 'base_url: ' . $_ENV['BASE_URL'];
        // echo PHP_EOL;
        // echo 'base_api_url:' . $_ENV['API_BASE_URL'];
        // echo PHP_EOL;
        // echo '##########################################';
        // echo PHP_EOL;
        // echo PHP_EOL;


        // TODO if resource === null => home view
        if ($path == '/') {
            $mode = $_SESSION['user'] = 'guest';
            echo json_encode([
                'status' => 'success',
                'user' => $mode
            ]);

            PostController::index();
            http_response_code(200);
            exit;
        } elseif ($resource === "posts") {
            if ($id === null) {
                if ($method == "GET") {
                    echo 'get all posts ...';
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
