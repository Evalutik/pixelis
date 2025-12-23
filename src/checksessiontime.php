<?php
session_start();
$now = time();
$time_limit = 7200;// в секундах
if ( isset($_SESSION['start']) AND $now > $_SESSION['start'] + $time_limit){
	unset($_SESSION['user']);
	unset($_SESSION['start']);
	$_SESSION['message'] = "Session timed out, please re-login.";
} else {
	$_SESSION['start'] = $now;
}