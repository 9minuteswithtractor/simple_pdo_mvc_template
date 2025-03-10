<?php

namespace App\Core;

// session continue
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Core\Database;
use App\Controllers\Auth;
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
                    if (!empty($_SESSION['user']) && $_SESSION['logged_in'] === 1) {

                        PostController::index($db);
                    } else {
                        echo "You are browsing as a guest.";
                        $_SESSION['user'] = 'guest';
                        $_SESSION['logged_in'] = 0;
                        $_SESSION['db_storage'] = $_ENV['STORAGE_TYPE'];

                        if (!isset($_COOKIE['guest_session_token'])) {
                            echo PHP_EOL;
                            echo $_SESSION['user'] . ' has been logged out ...';

                            $api_key = bin2hex(random_bytes(32));

                            setcookie('guest_session_token', $api_key, [
                                'expires' => time() + 3600, // 1 hour
                                'path' => '/',
                                'domain' => '',
                                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
                                'httponly' => true,
                                'samesite' => 'Strict'
                            ]);
                            echo PHP_EOL;
                            echo "New API Key Set: " . $api_key;
                        }
                    }

                    PostController::index($db);
                    break;

                default:
                    http_response_code(405);
                    header("Allow: GET");
                    require_once BASE_PATH . '/app/Views/405.view.php';
            }
        } elseif ($resource === "posts") {
            switch ($method) {
                case 'GET':
                    header('Location: /');
                    break;
                case 'POST':
                    // TODO authenticate first ...
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === 1) {
                        // TODO check if user is logged in
                        // clear session
                        // generate API-TOKEN again ??
                        echo json_encode([
                            "message" => "submitting a post...",
                            "user" => $_SESSION['user'],
                            'logged_in' => $_SESSION['logged_in'],
                        ]);
                    } else {
                        echo json_encode([
                            "message" => "You are not logged in"
                        ]);
                    }
                    break;
                default:
                    http_response_code(405);
                    header("Allow: GET, POST");
                    header('Content-Type: text/html');
                    require_once BASE_PATH . '/app/Views/405.view.php';
            }
        } elseif ($resource === 'login') {
            switch ($method) {
                case 'GET':
                    header('Content-Type: text/html');
                    require_once BASE_PATH . '/app/Views/Login.view.php';
                    break;
                case 'POST':
                    // Handle login
                    if (!empty($_POST['username']) && !empty($_POST['password'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        $auth_controller = new Auth($db);
                        $login_success = $auth_controller->login($username, $password);

                        if ($login_success) {

                            // ::_.-._.-._.-._.-._.-._._.-::__CLEAR_GUEST_COOKIE
                            setcookie('guest_session_token', '', time() - 3600, '/');
                            setcookie("session_token", "", time() - 3600, "/");
                            setcookie("session_token", "", time() - 3600, "/", domain: "", secure: false, httponly: true);
                            // ::_.-._.-._.-._.-._.-.-::__CLEAR_GUEST_COOKIE_END

                            // ::_.-._.-._.-._.-._.-._._.-._-._.-.::___USER_MODE

                            // setting cookies ::
                            setcookie('session_token', bin2hex(random_bytes(32)), [
                                'expires' => time() + 3600, // 1 hour
                                'path' => '/',
                                'domain' => '',
                                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
                                'httponly' => true,
                                'samesite' => 'Strict'
                            ]);

                            // setting session
                            $_SESSION['user'] = $username;
                            $_SESSION['logged_in'] = 1;
                            $_SESSION['db_storage'] =  $_ENV['STORAGE_TYPE'];
                            // ::_.-._.-._.-._.-._.-._._.-._-.::___USER_MODE_END
                            header('Location: /');
                            echo json_encode([
                                "message" => "Login successful",
                                "user" => $_SESSION['user'],
                                "logged_in" => $_SESSION['logged_in']
                            ]);

                            // exit;
                        } else {
                            echo "Invalid username or password.";
                            header('Content-Type: text/html');
                            require_once BASE_PATH . '/app/Views/Login.view.php';
                            exit;
                        }

                        if ($username === 'admin' && $password === 'password') { // Replace with real auth check
                            $_SESSION['user'] = $username;
                            $_SESSION['logged_in'] = 1;

                            // Set session token for authentication
                            $api_key = bin2hex(random_bytes(32));
                            setcookie('session_token', $api_key, [
                                'expires' => time() + 3600, // 1 hour
                                'path' => '/',
                                'domain' => '',
                                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
                                'httponly' => true,
                                'samesite' => 'Strict'
                            ]);

                            echo json_encode([
                                "message" => "Login successful",
                                "user" => $_SESSION['user'],
                                "logged_in" => $_SESSION['logged_in']
                            ]);
                        } else {
                            echo json_encode(["error" => "Invalid credentials"]);
                        }
                    } else {
                        $error = "Please fill in both username and password.";
                        require_once BASE_PATH . '/app/Views/Login.view.php';
                    }
                    break;
                default:
                    http_response_code(405);
                    header("Allow: GET, POST");
                    header('Content-Type: text/html');
                    require_once BASE_PATH . '/app/Views/405.view.php';
            }
        } elseif ($resource === 'register') {
            switch ($method) {
                case 'GET':
                    header('Content-Type: text/html');
                    require_once BASE_PATH . '/app/Views/Register.view.php';
                    break;
                case 'POST':
                    // Handle register
                    if (!empty($_POST['username']) && !empty($_POST['password'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $email = $_POST['email'];

                        // Example: Authenticate user (replace with actual authentication logic)
                        // 1. fetch-all-users
                        // 2. if not in list -> add-user

                        if ($username === 'admin' && $password === 'password') { // Replace with real auth check
                            $_SESSION['user'] = $username;
                            $_SESSION['logged_in'] = 1;

                            // Set session token for authentication
                            $api_key = bin2hex(random_bytes(32));
                            setcookie('session_token', $api_key, [
                                'expires' => time() + 3600, // 1 hour
                                'path' => '/',
                                'domain' => '',
                                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
                                'httponly' => true,
                                'samesite' => 'Strict'
                            ]);

                            echo json_encode([
                                "message" => "Login successful",
                                "user" => $_SESSION['user'],
                                "logged_in" => $_SESSION['logged_in']
                            ]);
                        } else {
                            echo json_encode(["error" => "Invalid credentials"]);
                        }
                    } else {
                        echo json_encode(["error" => "Username and password are required"]);
                    }
                    break;
                default:
                    http_response_code(405);
                    header("Allow: GET, POST");
                    header('Content-Type: text/html');
                    require_once BASE_PATH . '/app/Views/405.view.php';
            }
        } elseif ($resource ===  'clear_session') {
            switch ($method) {
                case 'POST':
                    setcookie('guest_session_token', '', time() - 3600, '/');
                    setcookie("session_token", "", time() - 3600, "/");
                    setcookie("session_token", "", time() - 3600, "/", domain: "", secure: false, httponly: true);
                    header('Location: /');
                    break;
                default:
                    http_response_code(405);
                    header("Allow: POST");
                    header('Content-Type: text/html');
                    require_once BASE_PATH . '/app/Views/405.view.php';
            }
        } else {
            http_response_code(404);
            header('Allow: POST');
            header('Content-Type: text/html');
            require_once BASE_PATH . '/app/Views/405.view.php';
        }
    }
}
