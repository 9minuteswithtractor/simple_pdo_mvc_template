<?php

// 0. strict type declaration and display errors
declare(strict_types=1);
ini_set("display_errors", "On");

// 1. First require autoloader
require_once __DIR__ . '/../vendor/autoload.php';

define('BASE_PATH', dirname(__DIR__));
define('DEV_ENV_PATH', BASE_PATH . '/.env');



// 2. Load environment variables before any application logic
if (file_exists(DEV_ENV_PATH)) {
    echo 'dev environment file exists ...';
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH, '.env');
    $dotenv->load();
} else {
    echo 'no .env file ..';
}



// 3. Set headers (Must come BEFORE any echo, print, or HTML output)
header("Content-type: application/json; charset=UTF-8");

// 4. Start session
session_start();

// 5. Load Router
use App\Core\Router;


// Quick method validation
if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])) {
    header('HTTP/1.1 405 Method Not Allowed');
    exit(json_encode(['error' => 'Method Not Allowed']));
}


// http://localhost/api/posts/1223
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', $path);

$method = $_SERVER['REQUEST_METHOD'];
$resource = $parts[2];      //posts
$id = $parts[3] ?? null;    //id

// echo '<pre />';
// print_r($parts);

try {
    Router::router($method, $id, $resource);
} catch (Throwable) {
    http_response_code(500); //server error
}
