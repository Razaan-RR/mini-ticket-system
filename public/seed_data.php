<?php
require_once __DIR__ . '/../config/database.php';

// Create DB connection
$db = new Database();
$conn = $db->getConnection();

// Sample Users
$users = [
    ['Alice Agent', 'alice@example.com', password_hash('password123', PASSWORD_DEFAULT), 'agent'],
    ['Bob Admin', 'bob@example.com', password_hash('adminpass', PASSWORD_DEFAULT), 'admin']
];

// Insert Users
echo "Adding users...<br>";
foreach ($users as $user) {
    $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)");
    $stmt->execute($user);
}
echo "Users added!<br><br>";

// Get user IDs (name => id)
$userStmt = $conn->query("SELECT id, name FROM users");
$userData = $userStmt->fetchAll(PDO::FETCH_KEY_PAIR);

// Sample Tickets
$tickets = [
    [$userData['Alice Agent'], 'Cannot log in', 'I am getting an error when trying to log in.'],
    [$userData['Alice Agent'], 'Email not sending', 'Support emails are not going through.'],
    [$userData['Bob Admin'], 'System settings broken', 'I can’t update system settings.']
];

// Insert Tickets
echo "Adding tickets...<br>";
foreach ($tickets as $ticket) {
    $stmt = $conn->prepare("INSERT INTO ticket (user_id, title, description) VALUES (?, ?, ?)");
    $stmt->execute($ticket);
}
echo "Tickets added!<br><br>";

// Sample Departments
$departments = [
    ['Technical Support'],
    ['Customer Service'],
    ['Human Resources']
];

// Insert Departments
echo "Adding departments...<br>";
foreach ($departments as $dept) {
    $stmt = $conn->prepare("INSERT INTO department (name) VALUES (?)");
    $stmt->execute($dept);
}
echo "Departments added!<br><br>";
?>
