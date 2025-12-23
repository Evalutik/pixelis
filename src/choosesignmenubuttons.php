<?php
if ($_SESSION['user']) {
	echo 
	'<li>
		<a href="actions/signout.php" class="rightest">Sign Out</a>
	</li>
	<li>
		<a href="profile.php">Account</a>
	</li>';
} else {
	echo 
	'<li>
		<a href="signin.php" class="rightest">Sign In</a>
	</li>';
}