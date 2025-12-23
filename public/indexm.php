<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="maximum-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="favicon.png" type="image/png">
		<title>Pixelis - million of limited pixels</title>
		<link rel="stylesheet" type="text/css" href="css/mobile/main_m.css">
		<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
	</head>

	<body>
		<?php
			require_once __DIR__ . '/../bootstrap.php';
			$fi = new FilesystemIterator(DATA_DIR . '/pixelsDB', FilesystemIterator::SKIP_DOTS);
			$countboughtpix = iterator_count($fi);
			if ($countboughtpix == 1000000) {
				$countboughtpix = '1 000 000';	
			} else if ($countboughtpix >= 1000) {
				$countboughtpix = intdiv($countboughtpix, 1000).' '.($countboughtpix % 1000);
			}
			require_once __DIR__ . '/../cookie/isacceptcookie.php';
			// csrf functions are autoloaded by bootstrap
			// CSRF already available via bootstrap/autoload
		?>
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
		            <li><a href="indexpc.php">Desktop</a></li>
		        </ul>
		    </div>
		</div>
		<div class="mobile_menu_overlay"></div>

		
		<div class="main">
				<div class="mobile_menu"></div>
				<img src="photo/bg1.png" class="bgimg">

				<div class = "text-main">
					<h1>
			    	    <div class="text-anim-main">
	  						Pixelis - 
	  					</div>
						<div class="text-anim-main1">
	  						million of
	  					</div>
	  					<div class="text-anim-main2">
	  						limited pixels.
			    	   	</div>
		    	   </h1>
		    	   	<div class="main_opis">
		    	   			<h5>Each pixel on this page sells for 1$<br>
					    	Painted <span><?php echo $countboughtpix; ?></span> out of 1 000 000 pixels</h5>
					</div>
					<script>
					var flag_bgcnvs = false,
						flag_clone = false;
					 $(document).ready(function(){
					    $("#yakmain").on("click", function (event) {
					        event.preventDefault();
					        var id  = $('#yakmainbtn').attr('href'),
					            top = $(id).offset().top;
					            top = top-30;
					        $('body,html').animate({scrollTop: top}, 1500);
					    });
					});
					</script> 
				    <button id="yakmain">
						<a href="#artcanvas" id="yakmainbtn">Let's see</a>
					</button>
				</div>
		</div>

		<div class="taxt-main-artcanvas-scr">
			<h1  class="taxt-main-artcanvas">Current field.</h1>
		</div>
		<div style="position: relative; top: -60vh;">
		<div class="artcanvas">
			<canvas class="block select-canvas" id="artcanvas" width="1000" height="1000"></canvas>
			<script async src="scripts/scrcanvas.js"></script>			
		</div>
		<div class="cord-poisk">
			<h3>
				Pixel <span class="pcolor">search</span><br>
				by coordinates
			</h3>
			<h5>
				<form action="">
					<div class="input_block">
							<label for="inputx">X:</label>
							<input type="text" placeholder="Enter X" name="inputx" id="inputx" maxlength="3" oninput="changeHandler(this)" autocomplete="off">
					</div>
					<div class="input_block" style="margin-left: 14vw;">
							<label for="inputy">Y:</label>
							<input type="text" placeholder="Enter Y" name="inputy" id="inputy" maxlength="3" oninput="changeHandler(this)" autocomplete="off">
					</div>
				</form>
			</h5>
		</div>
		<div class="fix">
			<h3>
				Information about <div class="pcolor">selected</div> pixel
			</h3>
			<h5>	
				<div class="fix_style fix_style_inline" style="margin-top: 14vw;">X: <span id="fixcordsX"></span></div>
				<div class="fix_style fix_style_inline">Y: <span id="fixcordsY"></span></div>
				<div class="fix_style">Color:<br>
				<span style="color: #7D7AED;" id="fixcolor"></span>
					<div id="expixelcolor"></div> 
				</div>
				<div class="fix_style">Owner:<br> <span style="color: #7D7AED;" id="fixowner"></span></div>
				<div class="fix_style">Status:<br> <span style="color: #7D7AED;" id="fixstatus"></span></div>
				<div class="fix_style">Link:<br> 
					<a href="" id="hrefafix" target="_blank">
						<span id="fixlink"></span>
					</a>
				</div>
				<div class="fix_style">Text:<br>
				 	<span style="color: #7D7AED;" id="fixtext"></span>
				</div>
			</h5>

			</div>

		<div class="buy">
				<h1>Buy pixel.</h1>
				<form action="oplata.php" method="POST">
					<div class="input_buy input_buy_inline" style="margin-top: calc(14vw + 10px);">
						<label for="buyinpx"><h5>X:</h5></label>
						<input type="text" placeholder="Enter X" name="buyinpx" id="buyinpx" maxlength="3" required autocomplete="off" oninput="changeHandler2(this)">
					</div>
					<div class="input_buy input_buy_inline" >
						<label for="buyinpy"><h5>Y:</h5></label>
						<input type="text" placeholder="Enter Y" name="buyinpy" id="buyinpy" maxlength="3" required autocomplete="off" oninput="changeHandler2(this)">	
					</div>
					<div class="input_buy input_buy_color">
						<label for="buyinpcolor"><h5>Color:</h5>
						<div class="pcolor">
							<h5><span class="buyinpcolorhex"></span></h5>
						</div>
						</label>
						<input type="color" placeholder="Enter Color" name="buyinpcolor" id="buyinpcolor" value="#ffffff" required >
						<script type="text/javascript">
							document.querySelector('#buyinpcolor').oninput = function(event) {
							var localcolor;
							localcolor = document.getElementById('buyinpcolor').value;
							document.querySelector('#buyinpcolor').style.backgroundColor = localcolor;
							document.querySelector('.buyinpcolorhex').innerHTML = localcolor;
						}

						onload = function(event) {
							var localcolor;
							localcolor = document.getElementById('buyinpcolor').value;
							document.querySelector('#buyinpcolor').style.backgroundColor = localcolor;
							document.querySelector('.buyinpcolorhex').innerHTML = localcolor;
						}

						</script>
					</div>
					<div class="input_buy">
						<label for="buyinpownname"><h5>Owner:</h5></label>
						<input type="text" placeholder="Enter Nickname" name="buyinpownname" id="buyinpownname" autocomplete="off" maxlength="15">
					</div>
					<div class="input_buy">
						<label for="buyinplink"><h5>Link:</h5></label>
						<input type="url" placeholder="Enter Link" name="buyinplink" id="buyinplink" autocomplete="off" maxlength="100">
					</div>
					<div class="input_buy">
						<label for="buyinptext"><h5>Text:</h5></label>
						<textarea rows="7" cols="66" type="text" placeholder="Enter Additional Text" name="buyinptext" id="buyinptext" maxlength="235" wrap="soft"></textarea>				<?php csrf_input(); ?>					</div>	
					<div class="input_buy input_buy_btn">
						<button id="buyinpbtn" name="buyinpbtnname" class="button-white-bg-black-text">	Сolorize!
						</button>
					</div>						
				</form>
		</div>

		<div class="min-info">
			<div class="pcolor"><h1>Info.</h1></div>
				<h5 class="someinfotext">
					Pixelis - the field of 1000 x 1000 pixels that site users can color as they like. <br><br>
					
					The location of all pixels on the field is set by the X and Y coordinate system. <br> 
					Point (0, 0) is the origin of coordinates, it is located in the upper left corner of the field. The X-axis is directed horizontally to the right, and the Y-axis vertically downward.<br>
					<button class="button-white-bg-purp-text">
						<a href="about.php">Read more</a>
					</button>
					
				</h5>
		</div>
		<?php include "footerm.html" ?>
		</div>
		<script>
		const changeHandler2 = e => {
		const value = e.value;
		e.value = value.replace(/\D/g, '');
		let XPoleVvoda2 = document.getElementById('buyinpx').value;
		let YPoleVvoda2 = document.getElementById('buyinpy').value;
		if ((XPoleVvoda2 >= 0) && (XPoleVvoda2 <= 999) && (YPoleVvoda2 >= 0) && (YPoleVvoda2 <= 999)) 
			{
				
			} else {
				alert('Error: The values in the X and Y fields are whole numbers in the range from 0 to 999')
			}
	

		}	
		</script>

		<script>
			let NFpixel = 'Undefined';
			document.querySelector('#fixcordsX').innerHTML = NFpixel;
			document.querySelector('#fixcordsY').innerHTML = NFpixel;
			document.querySelector('#fixcolor').innerHTML = NFpixel;
			document.querySelector('#fixstatus').innerHTML = NFpixel;
			document.querySelector('#fixowner').innerHTML = NFpixel;
			document.querySelector('#fixlink').innerHTML = NFpixel;
			document.querySelector('#fixtext').innerHTML = NFpixel;
			document.querySelector('.buyinpcolorhex').innerHTML = '#ffffff';
		</script>
		<script>
			var cOld = document.getElementById("artcanvas").getContext('2d');
			
			window.onload = function() {
				cOld.imageSmoothingEnabled = false;
				cOld.mozImageSmoothingEnabled = false;
				cOld.webkitImageSmoothingEnabled = false;
			}
			
		</script>
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
		<script async src="scripts/scrfixcord.js"></script>
		<script async src="scripts/scrinputxy.js"></script>
	</body>
</html>