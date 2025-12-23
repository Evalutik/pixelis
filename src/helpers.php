<?php
// Small helpers for views
if (session_status() == PHP_SESSION_NONE) session_start();

function e($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function get_env($k, $default = null) {
    $v = getenv($k);
    return ($v === false) ? $default : $v;
}
