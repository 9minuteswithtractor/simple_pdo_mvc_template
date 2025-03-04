<?php

namespace App\Core;



use PDO;

class Database
{
    private ?PDO $conn = null;

    public function __construct(
        private string $host,
        private string $name,
        private string $user,
        private string $password,
        private string $port
    ) {}

    public function getConnection(): PDO
    {
        if ($this->conn === null) {
            // $dsn = "mysql:host=$this->host;dbname=$this->name;charset=utf8";
            // $dsn = "mysql:host=localhost;dbname=$this->name;charset=utf8";
            // $dsn = "mysql:host=127.0.0.1;dbname=$this->name;charset=utf8";
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->name};charset=utf8";




            $this->conn = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false
            ]);
        }

        return $this->conn;
    }
}
