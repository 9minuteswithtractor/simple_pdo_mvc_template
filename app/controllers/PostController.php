<?php

namespace App\Controllers;

use App\Models\Posts;

class PostController
{
    public function __construct(private Posts $posts) {}

    public function router(string $method, ?string $id, string $resource): void
    {
        if ($resource == "posts") {
            if ($id === null) {
                if ($method == "GET") {
                    //echo "Get all posts\n";
                    echo json_encode($this->posts->getAll());
                } elseif ($method == "POST") {
                    // echo "Create post\n";
                    $data = json_decode(file_get_contents("php://input"), true);
                    //var_dump($data);
                    if (!empty($data['name'])) {
                        $id = $this->posts->create($data);
                        http_response_code(201); //created
                        echo json_encode(["message" => "Task created", "id" => $id]);
                    } else {
                        http_response_code(422); //Unprocessable Entity
                        echo json_encode(["errors" => "name is required"]);
                    }
                } else {
                    http_response_code(405); //Method Not Allowed
                    header("Allow: GET, POST");
                }
            } else {

                $post = $this->posts->get($id);

                if ($post === false) {
                    http_response_code(404);
                    echo json_encode(["message" => "Post with ID $id not found!"]);
                    exit;
                }

                switch ($method) {
                    case 'GET':
                        //echo "Get post id: $id";
                        echo json_encode($post);
                        break;
                    case 'PATCH':
                        echo "Update post id: $id";
                        $data = json_decode(file_get_contents("php://input"), true);
                        $this->posts->update($id, $data);
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
