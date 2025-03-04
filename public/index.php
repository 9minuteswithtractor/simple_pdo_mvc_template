<?php

// 0. strict type declaration and display errors
declare(strict_types=1);

use App\Core\Database;


ini_set("display_errors", "On");
error_reporting(E_ALL);

// 1. First require autoloader
require_once __DIR__ . '/../vendor/autoload.php';

define('BASE_PATH', dirname(__DIR__));
define('DEV_ENV_PATH', BASE_PATH . '/.enx');


// 2. Load environment variables before any application logic
if (file_exists(DEV_ENV_PATH)) {
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    // $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH, '.env');
    $dotenv->load();
} else {
    http_response_code(500);
    die('No .env file found ...');
}

// 3. Set headers (Must come BEFORE any echo, print, or HTML output)
header("Content-type: application/json; charset=UTF-8");

// 4. Start session
session_start();

// 5. Load Router




// Quick method validation
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
    header('Allow: GET');
    exit;
}

// ENDPOINTS :
// http://localhost/ => Home                            | GET
// http://localhost/api/posts/ => All posts             | GET | POST
// http://localhost/api/posts/1223 => Specific post     | GET | PATCH | DELETE
// http://localhost/api/login/ => login                 | POST
// http://localhost/api/register/ => register           | POST


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', $path);

$method = $_SERVER['REQUEST_METHOD'];
$resource = $parts[2] ?? null;      //posts
$id = $parts[3] ?? null;    //id


// Front controller 
try {
    print_r($parts);

    $db = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);

    if ($conn = $db->getConnection()) {
        echo "connection success..";
        exit;
    }
    echo 'something went wrong ...';
} catch (Throwable $e) {
    http_response_code(500); // server error
    echo $e; // print out the error information
    exit;
}
