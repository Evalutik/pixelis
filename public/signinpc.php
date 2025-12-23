<?php
	session_start();
	require_once __DIR__ . '/src/csrf.php';
	if ( ($_SESSION['user']) && ($_SESSION['user']['password']) ){
		header('Location: profile.php');
	}
?>
<!DOCTYPE html>
<html lang="EN">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="favicon.png" type="image/png">
	<title>Pixelis - sign in</title>
	<link rel="stylesheet" type="text/css" href="css/pc/sign_pc.css">
	<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
</head>
<body>
	<?php require_once 'cookie/isacceptcookie.php'; ?>
	<div class="main_form">
		<h2>Welcome back!</h2>
			<form action="actions/authorization.php" method="POST">
			<?php
				if ($_SESSION['message']) {
					echo '<p class="msg">' . $_SESSION['message'] .'</p>';
				}
			 	unset($_SESSION['message']);				csrf_input();			?>
			<label>Login</label>
			<input type="login" maxlength="20" name="nick" placeholder="Your ID or nick">
			<label>Password</label>
			<div class="for-eye">
				<input type="password" maxlength="20" name="password" placeholder="Shhh... Hush!" class="password-input">
				<img src="photo/eye.svg" class="eye" onClick="changePassword()">
			</div>
			<button type="submit">Here goes!</button>
		</form>
		<div class="afterform">
			<button onClick='location.href="index.php"'>Home</button>
			<button onClick='location.href="signup.php"'>Sign Up</button>
		</div>
	</div>
	<script type="text/javascript">
		let eye = document.querySelector('.eye');
		function changePassword(){
			if ( !(eye.classList.contains('active')) ) {
				$('.eye').addClass('active');
				$('.password-input').attr('type', 'login');
			} else {
				$('.eye').removeClass('active');
				$('.password-input').attr('type', 'password');
			}
		}
	</script>
</body>
</html>