<?php


namespace App\Controllers;

use App\Core\Database;
use App\Models\Users;

// session continue
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Auth
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    public  function login(string | int $user_name, string $user_password): bool
    {
        $user_model = new Users($this->db);
        $auth_success = $user_model->authenticateUser($user_name, $user_password);

        if ($auth_success) {
            // TODO :
            // unset SESSION
            // DELETE COOKIE and SET NEW 

            $_SESSION['user'] = $user_name;
            $_SESSION['logged_in'] = 1;

            echo PHP_EOL;
            echo 'USER: ' . $_SESSION['user'];
            echo  PHP_EOL . 'LOGGED IN: ' . $_SESSION['logged_in'];
            echo PHP_EOL;
            echo 'logged in';
        } else {
            $_SESSION['user'] = 'guest';
            $_SESSION['logged_in'] = 0;
        }


        return $auth_success;
        // TODO LOGIN !
        // if (!$user) {
        //     return false;
        // } else {
        //     $_SESSION['user_id'] = $user['id'];
        //     $_SESSION['logged_in'] = 1;
        // }
    }
}
