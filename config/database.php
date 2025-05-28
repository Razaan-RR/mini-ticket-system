<?php
class Database {
    private $conn;

    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=mini_ticket_system';
        try {
            $this->conn = new PDO($dsn, 'root', '');
        } 
        catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
