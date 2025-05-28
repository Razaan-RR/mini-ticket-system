<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    echo "Access denied. Only admins can see this page.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Departments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 30px auto;
        }
        input, button {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }
        hr {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h2>Welcome Admin!</h2>

    <h3>Create Department</h3>
    <form action="create_department.php" method="post">
        <input type="text" name="name" placeholder="Department Name" required>
        <button type="submit">Create</button>
    </form>

    <hr>

    <h3>Update Department</h3>
    <form action="update_department.php" method="post">
        <input type="number" name="id" placeholder="Department ID" required>
        <input type="text" name="name" placeholder="New Department Name" required>
        <button type="submit">Update</button>
    </form>

    <hr>

    <h3>Delete Department</h3>
    <form action="delete_department.php" method="post">
        <input type="number" name="id" placeholder="Department ID" required>
        <button type="submit">Delete</button>
    </form>

    <hr>

    <form action="logout_page.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
