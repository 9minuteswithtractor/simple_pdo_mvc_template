<?php

namespace App\Core;

use App\Controllers\PostController;


class Router
{

    public function __construct(private Database $db)
    {
        $this->db->getConnection();
    }

    public static function router(string $method, ?string $resource, ?string $id,): void
    {
        // TODO if resource === null => home view

        if ($resource === "posts") {
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
