<?php

namespace App\Controllers;

use App\Models\Posts;

class PostController extends Posts
{
    public function __construct() {}

    public function index(): array
    {
        $posts = $this->getAll();

        return $posts;
    }
}
