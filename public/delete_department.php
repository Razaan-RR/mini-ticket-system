<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo json_encode(['status' => 'fail', 'message' => 'POST only']);
    exit;
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    echo json_encode(['status' => 'fail', 'message' => 'Only admins can delete departments']);
    exit;
}

require_once __DIR__ . '/../controllers/DepartmentController.php';

$deptId = intval($_POST['id'] ?? 0);

if ($deptId <= 0) {
    echo json_encode(['status' => 'fail', 'message' => 'Valid department ID required']);
    exit;
}

$data = ['id' => $deptId];

$controller = new DepartmentController();
$result = $controller->delete($data);

echo json_encode($result);
