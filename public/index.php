<?php

// 0. strict type declaration and display errors
declare(strict_types=1);
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);

// shorter version for method validation ( don't gives feedback tho)
// header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE');


// 1. First require autoloader
require_once __DIR__ . '/../vendor/autoload.php';

define('BASE_PATH', dirname(__DIR__));
define('DEV_ENV_PATH', BASE_PATH . '/.env');



// 2. Load environment variables before any application logic
if (file_exists(DEV_ENV_PATH)) {
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    // $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH, '.env');
    $dotenv->load();
} else {
    http_response_code(500);
    require_once BASE_PATH . '/app/Views/500.view.php';
    die('No .env file found ...');
}

// 3. Set headers (Must come BEFORE any echo, print, or HTML output)
header("Content-type: application/json; charset=UTF-8");

// 4. Start session
session_start();

// 5. Load App
use App\Core\App;


// simple method pre-check
$allowed_methods = ['GET', 'POST', 'PATCH', 'DELETE', 'OPTIONS'];
if (!in_array($_SERVER['REQUEST_METHOD'], $allowed_methods)) {
    http_response_code(405);

    header('Allow: GET, POST, PATCH, DELETE, OPTIONS');
    // require_once BASE_PATH . '/app/Views/405.php';
    header('Content-Type: text/html');
    require_once BASE_PATH . '/app/Views/405.php';
    exit;
}

// App entry point 
try {
    $app = new App();
    $app->run();
} catch (Throwable $e) {
    http_response_code(500); // server error
    echo $e; // print out the error information
    exit;
}
