<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'fail', 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'fail', 'message' => 'Only POST method allowed']);
    exit;
}

require_once __DIR__ . '/../config/database.php';

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$department_id = $_POST['department_id'] ?? '';
$user_id = $_SESSION['user_id'];

if (!$title || !$description || !$department_id) {
    echo json_encode(['status' => 'fail', 'message' => 'All fields are required']);
    exit;
}

try {
    $db = (new Database())->getConnection();

    $stmt = $db->prepare("INSERT INTO ticket (title, description, user_id, department_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $description, $user_id, $department_id]);

    echo json_encode(['status' => 'success', 'message' => 'Ticket submitted successfully']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'fail', 'message' => 'Database error: ' . $e->getMessage()]);
}
