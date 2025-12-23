<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="maximum-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="favicon.png" type="image/png">
		<title>Pixelis - contact</title>
		<link rel="stylesheet" type="text/css" href="css/mobile/general_m.css">
		<link rel="stylesheet" type="text/css" href="css/mobile/contact_m.css">
		<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
	</head>

	<body>
		<?php require_once __DIR__ . '/../bootstrap.php'; require_once __DIR__ . '/../cookie/isacceptcookie.php'; ?>
		<script async>
			$(function() {
		    $(document).on("click", ".mobile_menu_container .parent", function(e) {
			        e.preventDefault();
			        $(".mobile_menu_container .activity").removeClass("activity");
			        $(this).siblings("ul").addClass("loaded").addClass("activity");
			    });
			    $(document).on("click", ".mobile_menu_container .back", function(e) {
			        e.preventDefault();
			        $(".mobile_menu_container .activity").removeClass("activity");
			        $(this).parent().parent().removeClass("loaded");
			        $(this).parent().parent().parent().parent().addClass("activity");
			    });
			    $(document).on("click", ".mobile_menu", function(e) {
			        e.preventDefault();
			        $(".mobile_menu_container").addClass("loaded");
			        $(".mobile_menu_overlay").fadeIn();
			    });
			    $(document).on("click", ".mobile_menu_overlay", function(e) {
			        $(".mobile_menu_container").removeClass("loaded");
			        $(this).fadeOut(function() {
			            $(".mobile_menu_container .loaded").removeClass("loaded");
			            $(".mobile_menu_container .activity").removeClass("activity");
			        });
			    });
			})
		</script>
		<div class="mobile_menu_container">
		    <div class="mobile_menu_content">
		        <ul>
		            <li><a href="index.php">Home</a></li>
		            <li><a href="bigcnvs.php">Field</a></li>
		            <li><a href="about.php">About</a></li>
		            <li><a href="contact.php">Contact</a></li>
		            <li><a href="contactpc.php">Desktop</a></li>
		        </ul>
		    </div>
		</div>
		<div class="mobile_menu_overlay"></div>

		<div class="informationmain" style="background-image: none;">
			<div class="mobile_menu"></div>
			<h1><div class="text-anim-main2" style="margin-left: auto;">Contact us</div></h1>
		</div>
		<div class="informatiotext" style="min-height: 1000px; background-image: none;">
			<h5>
				<a class="sendmail" href="mailto:pixelis@gmail.com?subject=Question about Pixelis site">Почта</a>
			</h5>
		</div>
		<?php include "footerm.html" ?>
		<?php 
			if (file_exists(DATA_DIR . '/activezki')) 
			{ 
				$DelTime = 240;
				foreach (new DirectoryIterator(DATA_DIR . '/activezki') as $fileInfo) 
				{
				 if ($fileInfo->isDot()) { continue; } 
				 	if ( ($fileInfo->isFile() ) && ( time() - $fileInfo->getMTime() >= $DelTime) ) { 
				 	unlink($fileInfo->getRealPath()); 
				 	} 
				} 
			}
			if (file_exists(DATA_DIR . '/bronpix')) 
			{ 
				$DelTime = 240;
				foreach (new DirectoryIterator(DATA_DIR . '/bronpix') as $fileInfo2) 
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