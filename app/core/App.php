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
                define('API_BASE_URL', $_ENV['API_BASE_URL']);
                define('BASE_URL', $_ENV['BASE_URL']);
                $this->router->route($this->db);
            } else {
                http_response_code(500);
                header('Content-Type: text/html');
                require_once BASE_PATH . '/app/Views/500.php';
                exit;
            }
        } catch (Throwable $error) {
            http_response_code(500);
            header('Content-Type: text/html');

            // ::_.-._.-._.-._.-._.-._._.-._-._.-._.-.-._.-.::___ERROR_ENDPOINT
            // TODO: add error API endpoint ???
            // header('Location: /error');
            // ::_.-._.-._.-._.-._.-._._.-._-._.-._.-.-._.-.::___END_COMMENT

            require_once BASE_PATH . '/app/Views/500.view.php';
            exit;
        }
    }
}
