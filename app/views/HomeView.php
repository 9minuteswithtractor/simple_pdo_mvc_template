<?php


echo "connect to db \n";


/**
 * TODO  HomeView.php
 */


try {
    $db = new Database("localhost", "api_response", "root", "");
    $posts = new Posts($db);
    print_r($posts->getAll());
} catch (Throwable) {
    http_response_code(500);
}

// ###########################################################################

class Database
{
    public function __construct(
        private string $host,
        private string $name,
        private string $user,
        private string $password
    ) {}

    public function getConnection(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";

        return new PDO($dsn, $this->user, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}

class Posts
{
    private PDO $conn;

    public function __construct(Database $db)
    {
        $this->conn = $db->getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM posts";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
