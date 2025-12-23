<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['start']);
header('Location: ../index.php');
?>
