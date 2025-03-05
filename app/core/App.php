<?php

namespace App\Core;

use App\Core\Router;
use App\Core\Database;
use Throwable;

require_once BASE_PATH . '/vendor/autoload.php';

class App
{

    private Database $db;
    private Router $router;

    public function __construct()
    {

        $this->db = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_PORT']);
        $this->router = new Router();
    }

    public function run()
    {
        try {
            if ($this->db->getConnection()) {
                $this->router->route($this->db);
            } else {
                http_response_code(500);
                header('Content-Type: text/html');
                include BASE_PATH . '/app/Views/500.php';
                exit;
            }
        } catch (Throwable $error) {
            http_response_code(500);
            header('Content-Type: text/html');
            include BASE_PATH . '/app/Views/500.php';
            exit;
        }
    }
}
