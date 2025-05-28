<?php
class TicketModel {
    private $db;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->db = (new Database())->getConnection();
    }

    public function create_ticket($title, $description, $user_id, $department_id) {
        $sql = "INSERT INTO ticket (title, description, user_id, department_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$title, $description, $user_id, $department_id]);
    }
}
