<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'fail', 'message' => 'Only POST allowed']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'fail', 'message' => 'Authentication required']);
    exit;
}

require_once __DIR__ . '/../models/TicketModel.php';

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$department_id = intval($_POST['department_id'] ?? 0);

if (!$title || !$description || !$department_id) {
    echo json_encode(['status' => 'fail', 'message' => 'Title, description, and department_id are required']);
    exit;
}

$user_id = $_SESSION['user_id'];

$ticketModel = new TicketModel();
$created = $ticketModel->create_ticket($title, $description, $user_id, $department_id);

if ($created) {
    echo json_encode(['status' => 'success', 'message' => 'Ticket submitted']);
} else {
    echo json_encode(['status' => 'fail', 'message' => 'Failed to submit ticket']);
}
