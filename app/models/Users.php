<?php

namespace App\Models;

use App\Core\Database;
use PDO;

// session continue
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class Users
{

    private PDO $conn;

    public function __construct(Database | PDO $db)
    {
        $this->conn = $db->getConnection();
    }

    private function getUser(string $username): array | false
    {
        $sql = "SELECT * FROM users WHERE user_name = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            return false; // Query failed
        }

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            if (isset($data['hidden'])) {
                $data['hidden'] = (bool) $data['hidden'];
            }
            return $data;
        }

        return false; // User not found
    }


    private function createUser(array $data): string
    {
        $sql = "INSERT INTO posts (name, hidden) VALUES (:name, :hidden)";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':name' => $data['name'],
            ':hidden' => $data['hidden']
        ]);

        return $this->conn->lastInsertId();
    }

    public function authenticateUser(string $username, string $password): bool
    {
        $user = $this->getUser($username);

        if ($user) {


            // Ensure the password column exists in the retrieved user data
            if (isset($user['password']) && password_verify($password, $user['password'])) {
                echo 'Authentication successful!';
                return true; // User authenticated
            } else {
                return false; // Incorrect password
            }
        }
        // echo 'User not found...';
        return false; // User does not exist
    }
}
