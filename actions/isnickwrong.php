<?php
require_once 'connect.php';
$user_to_check = isset($_GET['user_to_check']) ? $_GET['user_to_check'] : '';
if ($user_to_check === '') {
    echo "wrong";
    exit;
}
$stmt = mysqli_prepare($connect, "SELECT `id` FROM `user` WHERE `nick` = ?");
mysqli_stmt_bind_param($stmt, "s", $user_to_check);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
if (mysqli_stmt_num_rows($stmt) != 0){
    $answ = "wrong";
} else {
    $answ = "good";
}
	echo $answ;

?>