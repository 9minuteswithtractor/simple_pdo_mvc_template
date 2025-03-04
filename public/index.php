<?php

// 0. strict type declaration and display errors
declare(strict_types=1);
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);


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
    die('No .env file found ...');
}

// 3. Set headers (Must come BEFORE any echo, print, or HTML output)
header("Content-type: application/json; charset=UTF-8");

// 4. Start session
session_start();

// 5. Load App
use App\Core\App;


// Quick method validation
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header($_SERVER["SERVER_PROTOCOL"] . "405 Method Not Allowed");
    header('Allow: GET');
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
