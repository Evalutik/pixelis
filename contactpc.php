<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="favicon.png" type="image/png">
		<title>Pixelis - contact</title>
		<link rel="stylesheet" type="text/css" href="css/pc/contact_pc.css">
		<link rel="stylesheet" type="text/css" href="css/pc/general_pc.css">
		<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
	</head>

	<body>
		<?php require_once 'cookie/isacceptcookie.php'; ?>
		<div class="menu_grid">
			<div class="signin_place menu-main">
				<?php require_once 'vendor/choosesignmenubuttons.php'; ?>
			</div>
			<ul class="menu-main">
			  	<li><a href="index.php" class="rightest">Home</a></li>
			  	<li><a href="bigcnvs.php">Field</a></li>
			  	<li><a href="about.php">About</a></li>
			  	<li><a href="contact.php" class="current">Contact</a></li>
			  	<li><a href="contactm.php">Mobile</a></li>
			</ul>
		</div>
		<div class="informationmain">
			<h1><div class="text-anim-main2">Contact us</div></h1>
		</div>
		<div class="informatiotext">
				<h4>
					<a class="sendmail" href="mailto:pixelis@gmail.com?subject=Question about Pixelis site">Почта</a>
				</h4>
		</div>
		<?php include "footerpc.html" ?>
		<?php 
			if (file_exists('activezki')) 
			{ 
				$DelTime = 240;
				foreach (new DirectoryIterator('activezki') as $fileInfo) 
				{
				 if ($fileInfo->isDot()) { continue; } 
				 	if ( ($fileInfo->isFile() ) && ( time() - $fileInfo->getMTime() >= $DelTime) ) { 
				 	unlink($fileInfo->getRealPath()); 
				 	} 
				} 
			}
			if (file_exists('bronpix')) 
			{ 
				$DelTime = 240;
				foreach (new DirectoryIterator('bronpix') as $fileInfo2) 
				{
				 if ($fileInfo2->isDot()) { continue; } 
				 	if ( ($fileInfo2->isFile() ) && ( time() - ($fileInfo2->getMTime() ) >= $DelTime) ) { 
				 	unlink($fileInfo2->getRealPath()); 
				 	} 
				} 
			} 
		?>
	</body>
</html>