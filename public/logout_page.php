<?php
session_start();

if (isset($_SESSION['user_token'])) {
    $token = $_SESSION['user_token'];
    $file = __DIR__ . '/../storage/tokens.json';

    if (file_exists($file)) {
        $tokens = json_decode(file_get_contents($file), true);

        if (isset($tokens[$token])) {
            unset($tokens[$token]);
            file_put_contents($file, json_encode($tokens, JSON_PRETTY_PRINT));
        }
    }
}

session_unset();
session_destroy();

header("Location: login_page.html"); 
exit;
