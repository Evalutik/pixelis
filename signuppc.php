<?php
	session_start();
	require_once 'vendor/csrf.php';
	if ( ($_SESSION['user']) && ($_SESSION['user']['password']) ){
		header('Location: profile.php');
	}
?>
<!DOCTYPE html>
<html lang="EN">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="favicon.png" type="image/png">
	<title>Pixelis - сreate an account</title>
	<link rel="stylesheet" type="text/css" href="css/pc/sign_pc.css">
	<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
</head>
<body>
	<?php require_once 'cookie/isacceptcookie.php'; ?>
	<div class="main_form">
		<h2>Hello, Friend!</h2>
		<form action="vendor/registration.php" method="POST">
			<?php
				if ($_SESSION['message']) {
					echo '<p class="msg">' . $_SESSION['message'] .'</p>';
				}
			 	unset($_SESSION['message']);
				csrf_input();
			?>
			<label>Login</label>
			<input type="login" maxlength="20" name="nick" placeholder="Something unique" onInput="isNickOk()" onClick="isNickOk()" id="check-nick">
			<p class="wrong-char-nick">A nick can only contain lowercase letters, numbers, a dot, and the "_" sign.</p>
			<p class="check-nick">This is the maximum nick length.</p>
			<p class="good-nick">Amazing!</p>
			<p class="wrong-nick">Someone has already taken this nickname. Try something else.</p>
			<label>Password</label>
			<div class="for-eye">
				<input type="password" maxlength="20" name="password" placeholder="Just come up with" class="password-input" id="password" onInput="isPasOk()">
				<img src="photo/eye.svg" class="eye" onClick="changePassword()">
			</div>
			<label>Repeat Password</label>
			<input type="password" maxlength="20" onCopy="noPaste()" onDrag="noPaste()" onDrop="noPaste()" onPaste="noPaste()" onInput="isPasOk()" name="password_confirm" placeholder="Enter once again" class="password-input" id="repeat-password">
			<p class="to-small">Minimum password length is 8 characters.</p>
			<div class="to-easy">
				<p>Your password must contain at least:</p>
				<p>One digit</p>
				<p>One small and capital letter</p>
				<p>One special character (@, #, %, etc).</p>
			</div>
			<p class="not-match">Passwords don't match</p>
			<p class="no-paste">You should repeat the password manually.</p>
			<p class="to-long">This is the maximum password length.</p>
			<div class="check_line">
				<input type="checkbox" name="checkbox_1" id="checkbox_1" onInput="isPasOk()">
				<label for="checkbox_1">I have read and agree to the site rules</label>
			</div>
			<p class="no-checked">You must check all boxes</p>
			<button disabled id="ready" type="submit">Create an account</button>
		</form>
		<div class="afterform">
			<button onClick='location.href="index.php"'>Home</button>
			<button onClick='location.href="signin.php"'>Sign In</button>
		</div>
	</div>
	<script type="text/javascript">
		let charForNick = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM_.1234567890";
		let specialSymbols = "-_+=!?&@#$%;:.,~`^*()/|<>№";
		let digits = "1234567890";
		let smallLetters = "qwertyuiopasdfghjklzxcvbnm";
		let capitalLetters = "QWERTYUIOPASDFGHJKLZXCVBNM";
		let countRepeat = 0;
		let pasOk = false;
		let nickOk = false;
		let timerId;
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
		function noPaste(){
			event.preventDefault();
			$('.wrong-nick').removeClass('shadow');
			$('.to-small').removeClass('active');
			$('.to-easy').removeClass('active');
			$('.not-match').removeClass('active');
			$('.no-paste').removeClass('active');
			$('.to-long').removeClass('active');
			$('.no-paste').addClass('active');
			$('.no-checked').removeClass('active');
			countRepeat += 1;
			if (countRepeat >= 2) {
				$('.no-paste').addClass('shadow');
			}
		}
		function isEasy(password){
			let oneSmall = 0;
			let oneCapital = 0;
			let oneDigit = 0;
			let oneSymbol = 0;
			for (let i = 0; i < smallLetters.length; i++) {
				if (password.includes(smallLetters.slice(i, i+1))) {
					oneSmall = 1;
					break;
				}
			}
			for (let i = 0; i < capitalLetters.length; i++) {
				if (password.includes(capitalLetters.slice(i, i+1))) {
					oneCapital = 1;
					break;
				}
			}
			for (let i = 0; i < digits.length; i++) {
				if (password.includes(digits.slice(i, i+1))) {
					oneDigit = 1;
					break;
				}
			}
			for (let i = 0; i < specialSymbols.length; i++) {
				if (password.includes(specialSymbols.slice(i, i+1))) {
					oneSymbol = 1;
					break;
				}
			}
			if (oneSmall + oneCapital + oneDigit + oneSymbol != 4) {
				return true;
			} else {
				return false;
			}
		}
		function isNotMatch() {
			if ( !(document.getElementById('password').value === document.getElementById('repeat-password').value) ){
				return true;
			} else {
				return false;
			}

		}
		function useWrongChar(){
			let notAllowed = false;
			for (let j = 0; j < document.getElementById('check-nick').value.length; j++) {
				let cur_nick = document.getElementById('check-nick').value;
				if ( !(charForNick.includes(cur_nick.slice(j, j+1))) ) {
					notAllowed = true;
					break;
				}
			}
			return notAllowed;
		}
		function checkPasOkNickOk(){
			if (pasOk && nickOk) {
				document.getElementById('ready').removeAttribute('disabled');
			}
		}
		function isFreeNow(){
			let xhr = new XMLHttpRequest();
		    xhr.open('GET', 'vendor/isnickwrong.php?' + 'user_to_check=' + document.getElementById('check-nick').value);
		    xhr.onreadystatechange = function(){
		        if(xhr.readyState === 4 && xhr.status === 200){
		            let answ = xhr.responseText;
		            if (answ == "wrong") {
		             	$('.good-nick').removeClass('active');
		        		$('.wrong-nick').addClass('active');
		        		nickOk = false;
		            } else {
		            	$('.good-nick').addClass('active');
		        		$('.wrong-nick').removeClass('active');
						nickOk = true;
						checkPasOkNickOk()
		            }
		        }
		    }
		    xhr.send(); 	
		}

		function isNickOk(){
			nickOk = false;
			$('.wrong-char-nick').removeClass('active');
			document.getElementById('ready').setAttribute('disabled', '');
			if  (document.getElementById('check-nick').value == "") {
				clearTimeout(timerId);
				$('.good-nick').removeClass('active');
		        $('.wrong-nick').removeClass('active');
			} else if (useWrongChar()) {
				clearTimeout(timerId);
				$('.good-nick').removeClass('active');
		        $('.wrong-nick').removeClass('active');
				$('.wrong-char-nick').addClass('active');
			} else { //save
				clearTimeout(timerId);
				timerId = setTimeout(isFreeNow, 800);
			}

		    if ( document.getElementById('check-nick').value.length >= 20 ) {
				$('.check-nick').addClass('active');
			} else {
				$('.check-nick').removeClass('active');
			}
		}

		function isPasOk(){
			pasOk = false;
			countRepeat = 0;
			$('.to-small').removeClass('active');
			$('.to-easy').removeClass('active');
			$('.not-match').removeClass('active');
			$('.no-paste').removeClass('active');
			$('.no-paste').removeClass('shadow');
			$('.no-checked').removeClass('active');
			document.getElementById('ready').setAttribute('disabled', '');
			if ( document.getElementById('password').value.length < 8 ) {
				$('.to-small').addClass('active');
			} else if (isEasy(document.getElementById('password').value)) {
				$('.to-easy').addClass('active');
			} else if ( isNotMatch() ) {
				$('.not-match').addClass('active');
			} else if (!(document.getElementById('checkbox_1').checked)) {
				$('.no-checked').addClass('active');
			} else {
				pasOk = true;
		        checkPasOkNickOk();
			}

			//if слишеом лёгкий пароль / пароли не совпадают
			if (document.getElementById('password').value.length >= 20) {
				$('.to-long').addClass('active');
			} else {
				$('.to-long').removeClass('active');
			}
		}
	</script>
</body>
</html>