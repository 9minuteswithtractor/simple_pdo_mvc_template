<?php

// 0. strict type declaration and display errors
declare(strict_types=1);
ini_set("display_errors", "On");

// 1. First require autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Load environment variables before any application logic


if (getenv('APP_ENV') === 'development') {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../' . '.env.dev');
} else {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../' . '.env');
}
$dotenv->load();
// $dotenv->safeLoad(); // for production

$env = $_ENV['APP_ENV'] ?? 'development';
echo $env;
exit;


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


echo '<pre />';
echo $env;

$baseUri = getenv('API_BASE_URL');


// echo $baseUri;

exit;

// http://localhost/api/posts/1223
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', $path);

$method = $_SERVER['REQUEST_METHOD'];
$resource = $parts[3];      //posts
$id = $parts[4] ?? null;    //id



try {
    Router::router($method, $id, $resource);
} catch (Throwable) {
    http_response_code(500); //server error
}
