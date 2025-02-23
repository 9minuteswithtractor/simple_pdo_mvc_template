<?php 
// Database.php

// PDO::ATTR_EMULATE_PREPARES => false,
// default is true - PDO creates prepared statements by itself, rather than relying on the database server to do so.
// PDO::ATTR_STRINGIFY_FETCHES => false,
// true - all numeric data retrieved from the database is returned as strings

// Post.php - in json hidden parram show as boolean (false, true), instead of int (0, 1)
// $data = [];
// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     $row['hidden'] = (bool) $row['hidden'];
//     $data[] = $row;
// }
// return $data;

// avoid multiple connections
//---------------------------------------------------------------
// private ?PDO $conn = null;
// if ($this->conn === null) {
// $this->conn = new PDO($dsn, $this->user, $this->password, [
// return $this->conn;

class Database 
{
    private ?PDO $conn = null;

    public function __construct(
        private string $host,
        private string $name,
        private string $user,
        private string $password)
    {
    }

    public function getConnection(): PDO
    {
        if ($this->conn === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";

            $this->conn = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false
            ]);
        }
        
        return $this->conn;
    }
}