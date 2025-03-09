<?php


namespace App\Controllers;

use App\Core\Database;
use App\Models\Users;


class Auth
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    public static function login(): void
    {
        $user = new Users(self::$db);
    }
}
