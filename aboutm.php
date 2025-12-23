<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="maximum-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="favicon.png" type="image/png">
		<title>Pixelis - what is this?</title>
		<link rel="stylesheet" type="text/css" href="css/mobile/general_m.css">
		<link rel="stylesheet" type="text/css" href="css/mobile/about_m.css">
		<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
	</head>

	<body style="max-height: none;">
		<?php require_once 'cookie/isacceptcookie.php'; ?>
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
		            <li><a href="aboutpc.php">Desktop</a></li>
		        </ul>
		    </div>
		</div>
		<div class="mobile_menu_overlay"></div>

		<div class="informationmain">
			<div class="mobile_menu"></div>
			<h1><div class="text-anim-main2">What is it?</div></h1>
		</div>
		<div class="informatiotext">
				<h5 style="position: relative; margin-top: 200px; width: 86vw; margin-left: 7vw; padding-bottom: 200px; font-size: 1.8vh;">
					Pixelis is the field of 1000 x 1000 pixels which you can color as you like. <br> 
					<br>
					The location of all pixels on the field is set by the X and Y coordinates. <br> 
					Point (0; 0) is the origin of coordinates, it is located in the upper left corner of the field. The X-axis is directed horizontally to the right, and the Y-axis vertically downward.<br><br>

					When you filling each pixel, you can specify the following parameters: <br><br>

					<div class="pcolor"> 
					The coordinates of the pixel you want to paint.<br>
					</div>
					These are the X and Y values that help you pinpoint the position of the pixel on the field. Coordinates can't be negative, but can be zero. Thus, the X and Y values are integers from 0 to 999, inclusive.<br><br>

					<div class="pcolor"> 
					Color.<br>
					</div> 
					The color you want to paint over the pixel. It can be any RGB color from sixteen million shades of your choice.
					<br><br>

					<div class="pcolor"> 
					Owner's Nickname.<br>
					</div>
 					You can enter your nickname, your company name or something else. This is what can make your pixel recognizable.<br><br>

 					<div class="pcolor">
 					Link.<br>
 					</div>
 					A link is a great opportunity to advertise something. You can also indicate link to your site or page in social networks.<br><br>

 					<div class="pcolor">
 					Text.<br>
 					</div>
					You also have the option to place additional text. Here you can briefly tell about yourself, your company in order to interest other visiters. However, this has many uses. It's up to you to decide!<br><br>

					From this list, only coordinates are required. But remember that the default pixel color is white.<br><br>

					If you bought a pixel, you can be sure about it. Other users will not be able to recolor it, but you will also couldn't recolor already purchased pixels. For this reason, pixels are limited. This site guarantees its work at least until 2027, so all information posted by you will always be available.<br>
					Each pixel costs exactly $ 1 to purchase. It is clear that the more pixels you have, the more noticeable your presence will be in the entire field. For greater recognition, post your logo and emblem from pixels, so it will be easier for users to find your site.<br><br>

					When filling in the characteristics of the pixel, limiters and various hints are set, which simply won't let you make a mistake, but <div class="pcolor">you should also consider that:</div><br>

					The length of the line with your nickname must not exceed 15 characters.<br><br>

					The length of the line with your link must not exceed 100 characters.<br><br>

					Additional text must not exceed 235 characters and 5 lines. The sixth and following lines will be automatically cut off.<br><br>
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