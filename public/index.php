<?php
session_start();

declare(strict_types=1); //for type declaration
ini_set("display_errors", "On"); //Off

// http://localhost/api/posts/1223
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', $path);

$method = $_SERVER['REQUEST_METHOD'];
$resource = $parts[3];      //posts
$id = $parts[4] ?? null;    //id

header("Content-type: application/json; charset=UTF-8");

try {
    router($method, $id, $resource);
} catch (Throwable) {   //Exception/Error
    http_response_code(500); //server error
}
