<?php

namespace App\Core;

use App\Models\Posts;

// session continue
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\PostController;
use App\Core\Database;
use PDO;

class Router
{

    public function __construct(private Database $db)
    {
        $db->getConnection();
    }

    public static function router(string $path, string $method, ?string $resource, ?string $id,): void
    {
        echo 'request_method: ' . $path;
        echo 'formatted_path: ' . $path;
        echo PHP_EOL;
        echo 'Uri: ' . $_SERVER['REQUEST_URI'];
        echo PHP_EOL;
        echo 'base_url: ' . $_ENV['BASE_URL'];
        echo PHP_EOL;
        echo 'base_api_url:' . $_ENV['API_BASE_URL'];
        echo PHP_EOL;
        echo '##########################################';
        echo PHP_EOL;
        echo PHP_EOL;

        // TODO if resource === null => home view
        if ($path == '/') {
            $mode = $_SESSION['user'] = 'guest';
            echo json_encode([
                'status' => 'success',
                'user' => $mode
            ]);
            $posts = new Posts();

            http_response_code(200);
            exit;

            // } elseif ($resource === null) {
            //     http_response_code(200);
            //     $mode = $_SESSION['user'] = 'guest';
            //     echo json_encode([
            //         'status' => 'success',
            //         'user' => $mode
            //     ]);
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
