<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD']!='POST') {
    echo json_encode(['status'=>'fail', 'message'=>'Invalid request']);
    exit;
}

$user_input=$_POST;

$user_handler=new UserController();
$response=$user_handler->register($user_input);

echo json_encode($response);

?>