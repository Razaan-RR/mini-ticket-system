<?php
function check_token($given_token) {
    $file = __DIR__ . '/../storage/tokens.json';

    if (!file_exists($file)) {
        return false;
    }

    $all_tokens = json_decode(file_get_contents($file), true);

    if (isset($all_tokens[$given_token])) {
        return $all_tokens[$given_token]['user_id'];
    }

    return false;
}
