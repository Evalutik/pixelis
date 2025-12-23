<?php
	session_start();
	require_once 'vendor/checksessiontime.php';
	if ( (!$_SESSION['user']) || (!$_SESSION['user']['password']) ){
		header('Location: signin.php');
	}
?>
<!DOCTYPE html>
<html lang="EN">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="favicon.png" type="image/png">
	<title>Pixelis - my account</title>
	<link rel="stylesheet" type="text/css" href="css/pc/profile_pc.css">
	<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
</head>
<body>
	<?php require_once 'cookie/isacceptcookie.php'; ?>
	<div class="menu_grid">
		<div class="signin_place menu-main">
			<li><a href="vendor/signout.php" class="rightest">Sign Out</a></li>
		</div>
		<ul class="menu-main">
			<li><a href="index.php" class="rightest">Home</a></li>
			<li><a href="bigcnvs.php">Field</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li><a href="profilem.php">Mobile</a></li>
		</ul>
	</div>
	<div class="account-info">
		<h1 class="greetings">Welcome back!</h1> 
	</div>

	<div id="id-data" data-attr="<?=$_SESSION['user']['id']; ?>"></div>
	<div id="nick-data" data-attr="<?=$_SESSION['user']['nick']; ?>"></div>
	<div id="aboutme-data" data-attr="<?=htmlspecialchars($_SESSION['user']['aboutme']); ?>"></div>
	<script type="text/javascript">
		let id = document.getElementById('id-data').getAttribute('data-attr');
		let nick = document.getElementById('nick-data').getAttribute('data-attr');
		let aboutme = document.getElementById('aboutme-data').getAttribute('data-attr');

		function getRandomInt(max) {
		  return Math.floor(Math.random() * max);
		}

		function printGreetings(){
			let now = new Date();
			let hours = now.getHours();
			let greetings;
			let rand;
			if (hours < 5) {
				rand = getRandomInt(16);
				if ( rand == 0 ) { greetings = "Can't sleep?"; }
				if ( rand == 1 ) { greetings = "Goodnight, " + nick + "."; }
				if ( rand == 2 ) { greetings = "How do you like the stars?"; }
				if ( rand == 3 ) { greetings = "Tomorrow is a new day."; }
				if ( rand == 4 ) { greetings = "The night makes things more difficult."; }
				if ( rand == 5 ) { greetings = "The loudest cry is silence. The brightest light is night."; }
				if ( rand == 6 ) { greetings = "Time stands at night. Only clocks are running."; }
				if ( rand == 7 ) { greetings = "Nobody. Only night and freedom."; }
				if ( rand == 8 ) { greetings = "Dawn can only be reached by the path of night."; }
				if ( rand == 9 ) { greetings = "I thought you were sleeping?"; }
				if ( rand == 10 ) { greetings = "The night is beautiful, isn't it?"; }
				if ( rand == 11 ) { greetings = "I feel ideas in your head. Share them with the world!"; }
				if ( rand == 12 ) { greetings = "Smile, you are beautiful!"; }
				if ( rand == 13 ) { greetings = "Let's draw?"; }
				if ( rand == 14 ) { greetings = "My owl walks at night. Have you seen her?"; }
				if ( rand == 15 ) { greetings = "Great things await you!"; }

			} else if (hours < 8) {
				rand = getRandomInt(15);
				if ( rand == 0 ) { greetings = "Dawn always comes after sunset."; }
				if ( rand == 1 ) { greetings = "You are early today, " + nick + "."; }
				if ( rand == 2 ) { greetings = "With the first rays of the sun!"; }
				if ( rand == 3 ) { greetings = "How are you feeling, " + nick + "?"; }
				if ( rand == 4 ) { greetings = "You are amazing!"; }
				if ( rand == 5 ) { greetings = "Stop! Don't get out of bed!"; }
				if ( rand == 6 ) { greetings = "You are gorgeous!"; }
				if ( rand == 7 ) { greetings = "It is better to start the morning with a cup of invigorating tea."; }
				if ( rand == 8 ) { greetings = "Every morning is a time to start life again."; }
				if ( rand == 9 ) { greetings = "I feel ideas in your head. Share them with the world!"; }
				if ( rand == 10 ) { greetings = "Smile, you are beautiful!"; }
				if ( rand == 11 ) { greetings = "Let's draw?"; }
				if ( rand == 12 ) { greetings = "It's morning already?"; }
				if ( rand == 13 ) { greetings = "Great things await you!"; }
				if ( rand == 14 ) { greetings = "Good morning, " + nick + "!"; }


			} else if (hours < 12) {
				rand = getRandomInt(16);
				if ( rand == 0 ) { greetings = "How are you feeling, " + nick + "?"; }
				if ( rand == 1 ) { greetings = "You are amazing!"; }
				if ( rand == 2 ) { greetings = "You are gorgeous!"; }
				if ( rand == 3 ) { greetings = "It is better to start the morning with a cup of invigorating tea."; }
				if ( rand == 4 ) { greetings = "Every morning is a time to start life again."; }
				if ( rand == 5 ) { greetings = "I feel ideas in your head. Share them with the world!"; }
				if ( rand == 6 ) { greetings = "Smile, you are beautiful!"; }
				if ( rand == 7 ) { greetings = "Let's draw?"; }
				if ( rand == 8 ) { greetings = "It's morning already?"; }
				if ( rand == 9 ) { greetings = "Great things await you!"; }
				if ( rand == 10 ) { greetings = "Good morning, " + nick + "!"; }
				if ( rand == 11 ) { greetings = "Have a nice day, " + nick + "!"; }
				if ( rand == 12 ) { greetings = "Hi, " + nick + "!"; }
				if ( rand == 13 ) { greetings = "Hello, " + nick + "!"; }
				if ( rand == 14 ) { greetings = "Every day is unique!"; }
				if ( rand == 15 ) { greetings = "Look around! The world is wonderful!"; }

			} else if (hours < 17) {
				rand = getRandomInt(16);
				if ( rand == 0 ) { greetings = "How are you feeling, " + nick + "?"; }
				if ( rand == 1 ) { greetings = "You are amazing!"; }
				if ( rand == 2 ) { greetings = "You are gorgeous!"; }
				if ( rand == 3 ) { greetings = "I feel ideas in your head. Share them with the world!"; }
				if ( rand == 4 ) { greetings = "Smile, you are beautiful!"; }
				if ( rand == 5 ) { greetings = "Let's draw?"; }
				if ( rand == 6 ) { greetings = "Great things await you!"; }
				if ( rand == 7 ) { greetings = "Have a nice day, " + nick + "!"; }
				if ( rand == 8 ) { greetings = "Hey, " + nick + "! Do you love cats?"; }
				if ( rand == 9 ) { greetings = "Hi, " + nick + "!"; }
				if ( rand == 10 ) { greetings = "Hello, " + nick + "!"; }
				if ( rand == 11 ) { greetings = "Good afternoon, " + nick + "!"; }
				if ( rand == 12 ) { greetings = "Good day, " + nick + "!"; }
				if ( rand == 13 ) { greetings = "How do you like the weather?"; }
				if ( rand == 14 ) { greetings = "Every day is unique!"; }
				if ( rand == 15 ) { greetings = "Look around! The world is wonderful!"; }


			} else if (hours < 22) {
				rand = getRandomInt(14);
				if ( rand == 0 ) { greetings = "How are you feeling, " + nick + "?"; }
				if ( rand == 1 ) { greetings = "You are amazing!"; }
				if ( rand == 2 ) { greetings = "You are gorgeous!"; }
				if ( rand == 3 ) { greetings = "I feel ideas in your head. Share them with the world!"; }
				if ( rand == 4 ) { greetings = "Smile, you are beautiful!"; }
				if ( rand == 5 ) { greetings = "Let's draw?"; }
				if ( rand == 6 ) { greetings = "Great things await you!"; }
				if ( rand == 7 ) { greetings = "Hey, " + nick + "! Do you love cats?"; }
				if ( rand == 8 ) { greetings = "Hi, " + nick + "!"; }
				if ( rand == 9 ) { greetings = "Hello, " + nick + "!"; }
				if ( rand == 10 ) { greetings = "How do you like the weather?"; }
				if ( rand == 11 ) { greetings = "How was the day?"; }
				if ( rand == 12 ) { greetings = "Have a nice evening!"; }
				if ( rand == 13 ) { greetings = "Look around! The world is wonderful!"; }

			} else {
				rand = getRandomInt(12); 
				if ( rand == 0 ) { greetings = "I thought you were already asleep?"; }
				if ( rand == 1 ) { greetings = "Goodnight, " + nick + "."; }
				if ( rand == 2 ) { greetings = "How do you like the stars?"; }
				if ( rand == 3 ) { greetings = "Tomorrow is a new day."; }
				if ( rand == 4 ) { greetings = "The night makes things more difficult."; }
				if ( rand == 5 ) { greetings = "The loudest cry is silence. The brightest light is night."; }
				if ( rand == 6 ) { greetings = "Time stands at night. Only clocks are running."; }
				if ( rand == 7 ) { greetings = "The night is beautiful, isn't it?"; }
				if ( rand == 8 ) { greetings = "Smile, you are beautiful!"; }
				if ( rand == 9 ) { greetings = "My owl walks at night. Have you seen her?"; }
				if ( rand == 10 ) { greetings = "Great things await you!"; }
				if ( rand == 11 ) { greetings = "How was the day?"; }
			}
			document.querySelector('.greetings').innerHTML = greetings;
		}
		printGreetings(); 
	</script>
</body>
</html>