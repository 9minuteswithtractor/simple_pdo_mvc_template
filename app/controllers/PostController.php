<?php

namespace App\Controllers;

use App\Models\Posts;


class PostController
{
    public function __construct(private Posts $posts) {}
}
