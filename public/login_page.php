<?php
session_start();
require_once __DIR__ . '/../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'fail', 'message' => 'Only POST allowed']);
    exit;
}

$input = $_POST;
$userCtrl = new UserController();
$loginResult = $userCtrl->login($input);

if ($loginResult['status'] === 'success') {
    $userToken = $loginResult['token'];
    $_SESSION['user_token'] = $userToken;

    $tokensFile = __DIR__ . '/../storage/tokens.json';
    if (!file_exists($tokensFile)) {
        echo json_encode(['status' => 'fail', 'message' => 'Token file missing']);
        exit;
    }

    $tokens = json_decode(file_get_contents($tokensFile), true);
    $userId = $tokens[$userToken]['user_id'] ?? null;

    if ($userId) {
        require_once __DIR__ . '/../config/database.php';
        $dbConn = (new Database())->getConnection();

        $stmt = $dbConn->prepare("SELECT role FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_role'] = $userData['role'];

            if ($userData['role'] === 'admin') {
                header("Location: admin_page.php");
                exit;
            }

            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Login Successful</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        max-width: 400px;
                        margin: 30px auto;
                        padding: 10px;
                    }
                    pre {
                        background: #f4f4f4;
                        padding: 10px;
                        border: 1px solid #ccc;
                    }
                    button {
                        width: 100%;
                        padding: 10px;
                        margin-top: 10px;
                    }
                    .btn-group {
                        display: flex;
                        flex-direction: column;
                        gap: 10px;
                    }
                </style>
            </head>
            <body>
                <h3>Login successful (agent)</h3>
                <pre><?= json_encode([
                    'status' => 'success',
                    'token' => $userToken,
                    'message' => 'Login successful (agent)'
                ], JSON_PRETTY_PRINT); ?></pre>

                <div class="btn-group">
                    <form action="submit_ticket_form.php" method="get">
                        <button type="submit">Submit Ticket</button>
                    </form>
                </div>
            </body>
            </html>
            <?php
            exit;
        }
    }

    echo json_encode([
        'status' => 'fail',
        'message' => 'User not found or role missing'
    ]);
    exit;
} else {
    echo json_encode($loginResult);
    exit;
}
