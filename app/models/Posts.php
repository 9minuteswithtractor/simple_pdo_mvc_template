<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Posts
{
    private PDO $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM posts";


        $stmt = $this->conn->query($sql);
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);

        //08
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['hidden'] = (bool) $row['hidden'];
            $data[] = $row;
        }

        return $data;
    }

    public function get(string $id): array | false
    {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $data['hidden'] = (bool) $data['hidden'];
        return $data;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO posts (name, hidden) VALUES (:name, :hidden)";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':name' => $data['name'],
            ':hidden' => $data['hidden']
        ]);

        return $this->conn->lastInsertId();
    }

    public function update(string $id, array $data): int
    {
        $sql = "UPDATE posts
        SET name = :name, hidden = :hidden
        WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":name", $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(":hidden", $data['hidden'], PDO::PARAM_BOOL);

        $stmt->execute();

        return $stmt->rowCount();
    }
}
