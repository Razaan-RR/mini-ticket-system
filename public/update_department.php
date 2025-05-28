<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo json_encode(['status' => 'fail', 'message' => 'POST only']);
    exit;
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    echo json_encode(['status' => 'fail', 'message' => 'Only admins can update departments']);
    exit;
}

require_once __DIR__ . '/../controllers/DepartmentController.php';

$deptId = intval($_POST['id'] ?? 0);
$newName = trim($_POST['name'] ?? '');

if ($deptId <= 0 || $newName === '') {
    echo json_encode(['status' => 'fail', 'message' => 'Valid department ID and new name required']);
    exit;
}

$data = ['id' => $deptId, 'name' => $newName];

$controller = new DepartmentController();
$result = $controller->update($data);

echo json_encode($result);
