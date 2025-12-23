<?php
require_once __DIR__ . '/../bootstrap.php';
if (session_status() == PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html> <!--//лупа связана с полосой прокрутке на мазиле она не меняется-->
<html lang="EN">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="favicon.png" type="image/png">
		<title>Pixelis - million of limited pixels</title>
		<link rel="stylesheet" type="text/css" href="css/pc/general_pc.css">
		<link rel="stylesheet" type="text/css" href="css/pc/main_pc.css">
		<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
	</head>
	<body>
		<script async src="scripts/scraddpixel.js"></script>
		<?php
			$fi = new FilesystemIterator(DATA_DIR . '/pixelsDB', FilesystemIterator::SKIP_DOTS);
			$countboughtpix = iterator_count($fi);
			if ($countboughtpix == 1000000) {
				$countboughtpix = '1 000 000';
			} else if ($countboughtpix >= 1000) {
				$countboughtpix = intdiv($countboughtpix, 1000).' '.($countboughtpix % 1000);
			}
			require_once 'cookie/isacceptcookie.php';
		?>
		<div class="menu_grid">
			<div class="signin_place menu-main">
				<?php require_once 'vendor/choosesignmenubuttons.php'; ?>
			</div>
			<ul class="menu-main">
			  	<li><a href="index.php" class="current rightest">Home</a></li>
			  	<li><a href="bigcnvs.php">Field</a></li>
			  	<li><a href="about.php">About</a></li>
			  	<li><a href="contact.php">Contact</a></li>
			  	<li><a href="indexm.php">Mobile</a></li>
			</ul>
		</div>
		<div class="main">
				<div class = "text-main">
			    	<h1 class="text-anim-main">
	  					Pixel4u - 
	  				</h1>
					<h1 class="text-anim-main1">
	  					million of
	  				</h1>
	  				<h1 class="text-anim-main2">
	  					limited pixels.
			    	</h1>
		    	   	<p class="main-opis">
		    	   			Each pixel on this page sells for 1$<br>
					    	Painted <span><?php echo $countboughtpix; ?></span> out of 1 000 000 pixels
					</p>
				    <!--<div id="yakmain">
						<a href="#artcanvas" id="yakmainbtn">Let's see</a>
					</div>-->
					<script>
						var flag_bgcnvs = false,
							flag_clone = true;

						$(document).ready(function(){
						    $("#yakmain").on("click", function (event) {
						        event.preventDefault();
						        var id  = $("#yakmainbtn").attr('href'),
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

		<div class="artcanvas">
			<h1  class="taxt_main_artcanvas show">Current field.</h1>
			<div class="loopa">
				<div class="canvas_realetive">
					<div class="cords">
						<div class="current_cords show cord-box">
							<h3>
								<span class="light-text">Cursor </span>coordinates
							</h3>
							<h4> 
								<div class="fix_style">X: <br>
									<span class="cordsX"></span>
								</div>
								<div class="fix_style">Y: <br>
									<span class="cordsY"></span>
								</div>
							</h4>
							<div class="checkloop">
								<script>
									document.querySelector('.cordsX').innerHTML = 'Cursor not on field';
									document.querySelector('.cordsY').innerHTML = 'Cursor not on field';
								</script>
								<div class="fix_style size_target">
									<input type="checkbox" name="checkloop_tick" id="checkloop_tick" class="checkbox_input">
									<label for="checkloop_tick" class="check_label">Magnifier</label>
								</div>
								<script>
									function changeangle() {
										if($("#checkangle_tick").prop('checked')) {
											$("#artcanvas").css('border-radius', '0px');
											$("#artcanvasclone").css('border-radius', '0px');
										} else {
											$("#artcanvas").css('border-radius', 'var(--padding-flex)');
											$("#artcanvasclone").css('border-radius', 'var(--padding-flex)');
										}
									}
								</script>
								<div class="fix_style">
									<input type="checkbox" name="checkangle_tick" id="checkangle_tick" class="checkbox_input" onchange='changeangle(this);'>
									<label for="checkangle_tick" class="check_label">No angles</label>	
								</div>
							</div>
							<p class="fix_style">Too shallow?</p>
							<button  class="wcolor" onclick="document.location='bigcnvs.php'">
								<h4>Full screen</h4>
							</button>
						</div>	

						<div class="cord_poisk show cord-box">
							<h3>
								Pixel <span class="light-text">search</span>
							</h3>
								<div class="fix_style">
									<label for="inputx">X:</label><br>
									<input type="text" placeholder="0 .. 999" name="inputx" id="inputx" maxlength="3" oninput="changeHandler(this)">
								</div>
								<div class="fix_style">
									<label for="inputy">Y:</label><br>
									<input type="text" placeholder="0 .. 999" name="inputy" id="inputy" maxlength="3" oninput="changeHandler(this)">
								</div>
						</div>
					</div>
					
					<canvas class="block select-canvas" id="artcanvas" width="1000" height="1000"></canvas>
				</div>
				<canvas class="blockclone" id="artcanvasclone" width="10000" height="10000"></canvas>
				<script async src="scripts/scrcanvas.js"></script>
				<div class="big"></div>

				<div class="fix_cords show cord-box">
					<h3>
						About <span class="light-text">selected</span> pixel
					</h3>
					<h4>
						<div class="fix_style">
							X: <br>
								<span id="fixcordsX"></span>
						</div>
						<div class="fix_style">
							Y: <br>
								<span id="fixcordsY"></span>
						</div>
						<div class="fix_style" style="position: relative;">
							Color: <br>
								<span id="fixcolor"></span>
							<div id="expixelcolor"></div>
						</div>
						<div class="fix_style">
							Owner: <br>
								<span id="fixowner"></span>
						</div>
						<div class="fix_style">
							Status: <br>
								<span id="fixstatus"></span>
						</div>
						<div class="fix_style">
							Link:  <br>
								<a href="" id="hrefafix" target="_blank" ><span id="fixlink"></span></a>
						</div>
						<div class="fix_style">
							Text: <br>
								<span id="fixtext"></span>
						</div>
					</h4>
				</div>
			</div>
		</div>

		<div class="buy show">
				<h1>Buy pixel.</h1>
				<form action="oplata.php" method="POST" style="margin-top: 5vw;">
					<div class="input_buy fix_style input_cords" >
						<label for="buyinpx"><h4>X:</h4></label>
						<input type="text" placeholder="Enter X" name="buyinpx" id="buyinpx" maxlength="3" required autocomplete="off" oninput="changeHandler2(this)">
					</div>
					<div class="input_buy fix_style input_cords" >
						<label for="buyinpy"><h4>Y:</h4></label>
						<input type="text" placeholder="Hm.. Y?" name="buyinpy" id="buyinpy" maxlength="3" required autocomplete="off" oninput="changeHandler2(this)">	
					</div>
					<div class="input_buy input_buy_color fix_style">
						<label for="buyinpcolor"><h4>Color:</h4>
						<div class="pcolor">
							<h4><span class="buyinpcolorhex"></span></h4>
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
					<div class="input_buy fix_style dif_shedow">
						<label for="buyinpownname"><h4>Owner:</h4></label>
						<input type="text" placeholder="For your nickname ( Сompany )" name="buyinpownname" id="buyinpownname" autocomplete="off" maxlength="15">
					</div>
					<div class="input_buy fix_style dif_shedow">
						<label for="buyinplink"><h4>Link:</h4></label>
						<input type="url" placeholder="It can help advertise your site" name="buyinplink" id="buyinplink" autocomplete="off" maxlength="100">
					</div>
					<div class="input_buy fix_style">
						<label for="buyinptext"><h4>Text:</h4></label>
						<textarea rows="7" cols="66" type="text" placeholder="What is this field for? Right! - For optional text" name="buyinptext" id="buyinptext" maxlength="235" wrap="soft"></textarea>
				<?php csrf_input(); ?>
					</div>	
					<div class="input_buy">
						<button id="buyinpbtn" name="buyinpbtnname" class="button-white-bg-black-text">	Сolorize!
						</button>
					</div>						
				</form>
		</div>

		<div class="info-min">
			<div class="info-card cord-box info-header">
				<h1>Info.</h1>
				<p>We have tried to collect all the most important information and divide it into sections in order to explain it to you simply and clearly. Take a look!</p>
				<div class="info-card-hover">
				</div>
			</div>
			<div class="info-card cord-box info-card-1">
				<h3>What's this?</h3>
				<p>Pixel4u.org - site for creativity and self-expression. Users can fill in free pixels, enter information into them and create incredible drawings on a 1000 x 1000 field! </p>
				<div class="info-card-hover">
				</div>
			</div>
			<div class="info-card cord-box info-card-2">
				<h3>Interface</h3>
				<p>Word word word word word word word word word word word word word word word word word 2</p>
				<div class="info-card-hover">
				</div>
			</div>
			<div class="info-card cord-box info-card-3">
				<h3>How to color a pixel?</h3>
				<p>Word word word word word word word word word word word word word word word word word 3</p>
				<div class="info-card-hover">
				</div>
			</div>
			<div class="info-card cord-box info-card-4">
				<h3>Account</h3>
				<p>Word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word 4</p>
				<div class="info-card-hover"> 
				</div>
			</div>

			<div class="info-card cord-box info-card-5">
				<h3>Tops</h3>
				<p>Word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word word 5</p>
				<div class="info-card-hover">
				</div>
			</div>
			<div class="info-card cord-box info-card-6">
				<h3>Ideas</h3>
				<p>Word word word word word word word word word word word word word word word word word 6</p>
				<div class="info-card-hover">
				</div>
			</div>
			<!--<div class="pcolor"><h1>Info.</h1></div>
			<div class="someinfotext">
				<h4>
					Pixelis - the field of 1000 x 1000 pixels that site users can color as they like. <br> 
					<br>
					The location of all pixels on the field is set by the X and Y coordinate system. <br> 
					Point (0, 0) is the origin of coordinates, it is located in the upper left corner of the field. The X-axis is directed horizontally to the right, and the Y-axis vertically downward.<br><br>
					When you filling each pixel, you can specify the following parameters: <br>
					<br>
					<div class="pcolor"> The coordinates of the pixel you want to paint. </div>
					These are the X and Y values that help you pinpoint the position of the pixel on the field. Coordinates can't be negative, but can be zero. Thus, the X and Y values are integers from 0 to 999, inclusive...
				</h4>
				<button class="button-white-bg-purp-text">
					<a href="about.php">Read more</a>
				</button>
			</div>-->
		</div>
		<?php include "footerpc.html" ?>

		
		<script>
			function CloneCnv(){
			var clone_c = document.getElementById("artcanvasclone"),
    		clone_context = clone_c.getContext("2d"),
    		original_canvas = document.getElementById('artcanvas');
			clone_context.imageSmoothingEnabled = false;
			clone_context.mozImageSmoothingEnabled = false;
			clone_context.msImageSmoothingEnabled = false;
			clone_context.webkitImageSmoothingEnabled = false;

			void clone_context.drawImage(original_canvas, 0, 0, 1000, 1000, 0, 0, 10000, 10000);
					}
			$(function() {
				var big = $('.big'),
				small = $('.block'),
				current = null,
				clone = $('.blockclone');

				big.html(clone);
				$(document).on('mousemove', function(e) {
					var $$ = $(this),
					mouse = {
						x: e.pageX,
						y: e.pageY
					},
					percents = {};

					if (current) {
						percents.x = mouse.x / current.outerWidth();
						percents.y = mouse.y / current.outerHeight();
							      
						if ( window.innerWidth - mouse.x > 200) {
							var sdvig = (window.innerWidth * 0.05 ) - 105;
						} else {
							var sdvig = (window.innerWidth * 0.05 ) + 105;
						}
							      
						big.css({
							top: mouse.y - window.innerHeight - 800 - 78 - 68 - 52, 
							left: mouse.x - (big.outerWidth() / 2) - sdvig // расположение лупы относительно курсора
						});
							      
						clone.css({
							position: 'relative', // все величины при просчёте *10, т.к зум *10
							top: -clone.outerHeight() * percents.y + window.innerHeight * 10 + 9500, 
							left: -clone.outerWidth() * percents.x + (window.innerWidth * 10 ) + 20 - 1000 * 10 - (window.innerWidth * 10 * 0.05 )// расположение увеличиной копии на скрытом слое
						});
					}
				});

				small.on('mouseenter', function() {
					if($("#checkloop_tick").prop('checked')) {
						big.show();
					}
					current = $(this);
				});
				small.on('mouseout', function() {
					big.hide();
				});

			});		
		</script>
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

		function onEntry(entry) {
		  entry.forEach(change => {
		    if (change.isIntersecting) {
		     change.target.classList.add('show');
		    }
		  });
		}

		let options = {
		  threshold: [0.5] };
		let observer = new IntersectionObserver(onEntry, options);

		let elements = document.querySelectorAll('.taxt_main_artcanvas');
		for (let elm of elements) {
		  observer.observe(elm);
		}	
		elements = document.querySelectorAll('.current_cords');
		for (let elm of elements) {
		  observer.observe(elm);
		}	
		elements = document.querySelectorAll('.cord_poisk');
		for (let elm of elements) {
		  observer.observe(elm);
		}	
		elements = document.querySelectorAll('.fix_cords');
		for (let elm of elements) {
		  observer.observe(elm);
		}			
		elements = document.querySelectorAll('.buy');
		for (let elm of elements) {
		  observer.observe(elm);
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
			var cCln = document.getElementById("artcanvasclone").getContext('2d');
			
			window.onload = function() {
				cOld.imageSmoothingEnabled = false;
				cOld.mozImageSmoothingEnabled = false;
				cOld.webkitImageSmoothingEnabled = false;
				cOld.msImageSmoothingEnabled = false;
				cCln.imageSmoothingEnabled = false;
				cCln.mozImageSmoothingEnabled = false;
				cCln.webkitImageSmoothingEnabled = false;
				cCln.msImageSmoothingEnabled = false;
				
			}

			let small = $('.block');
			small.on('mouseout', function() {
				document.querySelector('.cordsX').innerHTML = 'Cursor not on field';
				document.querySelector('.cordsY').innerHTML = 'Cursor not on field';	
				});
			
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
		<script async src="scripts/scrcord.js"></script>
		<script async src="scripts/scrfixcord.js"></script>
		<script async src="scripts/scrinputxy.js"></script>
	</body>
</html>