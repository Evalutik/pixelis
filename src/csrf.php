<?php
// Simple CSRF helpers. Include this file in pages that render forms and in form handlers.
if (session_status() == PHP_SESSION_NONE) session_start();

function csrf_token() {
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

function csrf_input() {
    $t = htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8');
    echo "<input type=\"hidden\" name=\"_csrf\" value=\"$t\">";
}

function csrf_validate($token) {
    if (empty($_SESSION['_csrf_token']) || empty($token)) return false;
    return hash_equals($_SESSION['_csrf_token'], $token);
}

?>