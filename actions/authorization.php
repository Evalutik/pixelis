<?php
session_start();
require_once 'connect.php';
require_once __DIR__ . '/csrf.php';
$nick = isset($_POST['nick']) ? trim($_POST['nick']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
if (!csrf_validate($_POST['_csrf'] ?? '')) {
    $_SESSION['message'] = "Invalid request.";
    header('Location: ../signin.php');
    exit;
}
if ($nick === '' || $password === '') {
    $_SESSION['message'] = "Wrong login or password.";
    header('Location: ../signin.php');
    exit;
}
$stmt = mysqli_prepare($connect, "SELECT `id`, `nick`, `password`, `aboutme` FROM `user` WHERE `nick` = ?");
mysqli_stmt_bind_param($stmt, "s", $nick);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (!$result || mysqli_num_rows($result) != 1) {
    $_SESSION['message'] = "Wrong login or password.";
    header('Location: ../signin.php');
    exit;
}
$user = mysqli_fetch_assoc($result);
if (!password_verify($password, $user['password'])) {
    $_SESSION['message'] = "Wrong login or password.";
    header('Location: ../signin.php');
    exit;
}
$_SESSION['user'] = [
    "id" => $user['id'],
    "nick" => $user['nick'],
    "password" => $user['password'],
    "aboutme" => $user['aboutme']
];
$_SESSION['start'] = time();
header('Location: ../profile.php');
exit;
?>