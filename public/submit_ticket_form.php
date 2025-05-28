<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login_page.php');
    exit;
}

require_once __DIR__ . '/../models/DepartmentModel.php';
$deptModel = new DepartmentModel();
$departments = $deptModel->get_all_departments();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Submit Ticket</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 40px auto; }
        input, select, textarea, button { width: 100%; padding: 10px; margin: 8px 0; }
        button { cursor: pointer; }
    </style>
</head>
<body>
    <h2>Submit a Support Ticket</h2>
    <form action="submit_ticket.php" method="post">
        <input type="text" name="title" placeholder="Ticket Title" required />
        
        <textarea name="description" placeholder="Describe your issue..." rows="5" required></textarea>
        
        <select name="department_id" required>
            <option value="">Select Department</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= htmlspecialchars($dept['id']) ?>"><?= htmlspecialchars($dept['name']) ?></option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Submit Ticket</button>
    </form>
    <form action="logout_page.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
