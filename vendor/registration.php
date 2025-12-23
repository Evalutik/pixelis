<?php
	session_start();
	require_once 'connect.php';
	require_once __DIR__ . '/csrf.php';
	if (!csrf_validate($_POST['_csrf'] ?? '')) {
		$_SESSION['message'] = 'Invalid request.';
		header('Location: ../signup.php');
		exit;
	}
	$nick = isset($_POST['nick']) ? $_POST['nick'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';
	$checkbox_1 = isset($_POST['checkbox_1']) ? $_POST['checkbox_1'] : '';

	$nick = mb_substr($nick, 0, 20);
	$password = mb_substr($password, 0, 20);
	$nick = mb_strtolower($nick);
	$allowed_characters = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM_.1234567890";
	$isLoginWrong = false;
	for ($i = 0; $i < strlen($nick); $i++) {
		$pos = strpos($allowed_characters,  mb_substr($nick, $i, 1) );
		if ($pos === false) {
		    $isLoginWrong = true;
		    break;
		}
	}
	if (strlen($nick) == 0) { $isLoginWrong = true; }
	if ($isLoginWrong) {
		$_SESSION['message'] = 'Invalid nick format! Login can contain only lowercase letters, as well as numbers, dot and "_" sign.';
		header('Location: ../signup.php');
	} else {
		// Check uniqueness safely using prepared statement
		$stmt = mysqli_prepare($connect, "SELECT `id` FROM `user` WHERE `nick` = ?");
		mysqli_stmt_bind_param($stmt, "s", $nick);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		if (mysqli_stmt_num_rows($stmt) != 0){
			$_SESSION['message'] = "This nickname is already taken, think of something else.";
			header('Location: ../signup.php');
			exit;
		} else if ( strlen($password) < 8 ){
			$_SESSION['message'] = "Password not defined or too short. Try again.";
			header('Location: ../signup.php');
	} else if ( $password !== $password_confirm ){
		$_SESSION['message'] = "Passwords didn't match! Make sure you enter the same passwords.";
		header('Location: ../signup.php');
	} else if ($checkbox_1 != 'on') { // подставить все галочки
		$_SESSION['message'] = "It looks like you didn't check all the boxes. Please, confirm your agreement with all points.";
		header('Location: ../signup.php');
	} else {
		//продолжаем регистрацию
		//$password = md5($password);
		$password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
		$stmt = mysqli_prepare($connect, "INSERT INTO `user` (`nick`, `password`, `aboutme`) VALUES (?, ?, NULL)");
		mysqli_stmt_bind_param($stmt, "ss", $nick, $password);
		mysqli_stmt_execute($stmt);
		$_SESSION['message'] = "Congratulations! Account created successfully.";
		header('Location: ../signin.php');
	}

?>