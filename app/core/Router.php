<?php

namespace App\Core;

// session continue
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

        if ($path === '/') {
            switch ($method) {
                case 'GET':
                    // Default_Mode :
                    // ::_.-._.-._.-._.-._.-._._.-._-._.-._.-.-._.-.::___GUEST_MODE
                    $mode = $_SESSION['user'] = 'guest';
                    $logged_in = $_SESSION['logged_in'] = 0;
                    $db_storage = $_SESSION['db_storage'] =  $_ENV['STORAGE_TYPE'];
                    // ::_.-._.-._.-._.-._.-._._.-._-._.-._.-.-.::___GUEST_MODE_END

                    // TODO could be refactored into helper-function if time ...
                    if (!isset($_COOKIE['guest_session_token'])) {
                        echo PHP_EOL;
                        echo $_SESSION['user'] . ' has been logged out ...';


                        $api_key = bin2hex(random_bytes(32));

                        setcookie('guest_session_token', $api_key, [
                            'expires' => time() + 3600, // 1 hour
                            'path' => '/',
                            'domain' => '',
                            // 'secure' => true, ??
                            'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
                            'httponly' => true,
                            'samesite' => 'Strict'
                        ]);
                        echo PHP_EOL;
                        echo "New API Key Set: " . $api_key;
                    } else {
                        PostController::index($db);
                    }
                    break;
                default:
                    http_response_code(405);
                    header("Allow: GET");
            }
        } elseif ($resource === "posts") {
            switch ($method) {
                case 'GET':
                    header('Location: /');
                    break;
                case 'POST':
                    echo json_encode(['msg' => "Creating new post"]);
                    // TODO authenticate first ...

                    break;
                default:
                    http_response_code(405);
                    header("Allow: GET, POST");
                    header('Content-Type: text/html');
                    require_once BASE_PATH . '/app/Views/405.view.php';
            }
        } elseif ($resource ===  'clear_session' && $method === 'POST') {
            setcookie('guest_session_token', '', time() - 3600, '/');
            header('Location: /');
        } else {
            http_response_code(404);
            header('Allow: POST');
            header('Content-Type: text/html');
            require_once BASE_PATH . '/app/Views/405.view.php';
        }
    }
}
