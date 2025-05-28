<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo json_encode(['status' => 'fail', 'message' => 'Error']);
    exit;
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    echo json_encode(['status' => 'fail', 'message' => 'Only admins can create departments']);
    exit;
}

require_once __DIR__ . '/../controllers/DepartmentController.php';

$deptName = trim($_POST['name'] ?? '');

if ($deptName === '') {
    echo json_encode(['status' => 'fail', 'message' => 'Department name is required']);
    exit;
}

$data = ['name' => $deptName];

$controller = new DepartmentController();
$result = $controller->create($data);

echo json_encode($result);
