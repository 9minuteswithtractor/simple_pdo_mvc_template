<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Users
{

    private PDO $conn;

    public function __construct(Database | PDO $db)
    {
        $this->conn = $db->getConnection();
    }

    private function getUser(string $id): array | false
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $data['hidden'] = (bool) $data['hidden'];
        return $data;
    }

    public function createUser(array $data): string
    {
        $sql = "INSERT INTO posts (name, hidden) VALUES (:name, :hidden)";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':name' => $data['name'],
            ':hidden' => $data['hidden']
        ]);

        return $this->conn->lastInsertId();
    }

    public function authenticateUser() {}
}
