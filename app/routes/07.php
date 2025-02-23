<?php 
// refactoring (05.php, 06.php)

// MVC
// M - Model (DB, File, Cloud)
// V - View (JSON, HTML)
// C - Controllers (PHP)

// create src
// create src/Database.php (from 06.php)
// create src/Models/Posts.php (from 06.php)
// create src/Controllers/PostController.php (from 05.php router fn)
// copy header from 05.php


declare(strict_types=1); //for type declaration
ini_set("display_errors", "On"); //Off

include_once '../src/Database.php';
include_once '../src/Models/Posts.php';
include_once '../src/Controllers/PostController.php';


// http://localhost/api/posts/1223
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', $path);

$method = $_SERVER['REQUEST_METHOD'];
$resource = $parts[3];      //posts
$id = $parts[4] ?? null;    //id

header("Content-type: application/json; charset=UTF-8");

try {
    $db = new Database("localhost", "api_response", "root", "");
    $posts = new Posts($db);
    //print_r($posts->getAll());
    $controller = new PostController($posts);
    $controller->router($method, $id, $resource);
} catch (Throwable) {
    http_response_code(500);
}