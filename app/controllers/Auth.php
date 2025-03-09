<?php


namespace App\Controllers;

use App\Core\Database;

class Auth
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    public function login(): void
    {
        // $user = new User($this->db);
    }
}
