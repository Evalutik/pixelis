<?php
	session_start();
	require_once __DIR__ . '/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="maximum-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="favicon.png" type="image/png">
		<title>Pixelis - current field</title>
		<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="css/pc/general_pc.css">
		<link rel="stylesheet" type="text/css" href="css/pc/field_pc.css">
	</head>
	<script type="text/javascript">
		var flag_bgcnvs = true,
			flag_clone = false;
	</script>
	<body>
		<?php require_once 'cookie/isacceptcookie.php'; ?>

		<div class="menu_grid hiden">
			<div class="signin_place menu-main">
				<?php require_once 'vendor/choosesignmenubuttons.php'; ?>
			</div>
			<ul class="menu-main">
			  	<li><a href="index.php" class="rightest">Home</a></li>
			  	<li><a href="bigcnvs.php" class="current">Field</a></li>
			  	<li><a href="about.php">About</a></li>
			  	<li><a href="contact.php">Contact</a></li>
			  	<li><a href="bigcnvsm.php">Mobile</a></li>
			</ul>
		</div>

		<div class="pc_header" id="pc_header_id">
			<div class="change_menu"><li><a>Menu</a></li></div>
			<h3 class="zagolovok_bgcnvs" >About selected pixel</h3>
			
				<div>
					<label for="x_inp" class="inp_label">X:</label>
					<input type="text" name="x_inp" id="x_inp" placeholder="X" oninput="changeHandler2(this)" maxlength="3">
				</div>
				<div>
					<label for="x_inp" class="inp_label">Y:</label>
					<input type="text" name="y_inp" id="y_inp" placeholder="Y" oninput="changeHandler2(this)" maxlength="3">
				</div>
			
		    <div class="more_style" style="margin-top: calc(var(--padding-flex) - 5px);">
		    	Color:<br>
		    	<span class="moreColor">Undefined</span>
		    	<div id="expixelcolor"></div>
		    </div>

		    <div class="more_style">Owner:<br> 
		    	<div class="more_scroll" id="more_scroll_owner">
		    		<span class="moreOwner">Undefined</span>
		    	</div>
		    </div>

		    <div class="more_style">Status:<br> 
		    	<span class="moreStatus">Undefined</span>
		    </div>

		    <div class="more_style">Link:<br>
		    	<div class="more_scroll" id="more_scroll_link">
					<a href="" id="hrefafix" target="_blank">
						<span id="moreLink">
							Undefined
						</span>
					</a>
				</div>
			</div>
		    <div class="more_style more-style-bottom">Text:<br>
		    	<div class="more_scroll" id="more_scroll_text">  
			    	<span class="moreText">
			    		Undefined
			    	</span>
		    	</div>
		    </div>
		</div>
		<div class="change_width"><h4><</h4></div>

		<div class="more-block">
			<!--<span>Zoom:</span>
				<span id="rangeValue">1</span><br>
			-->
			<button class="plus-btn"><h4>+</h4></button><br>
			<div class="slider-wrapper">
				<input type="range" name="zoom_inp" id="zoom_inp" placeholder="zoom" oninput="changeHandler3(this)" min="1" max="50" value="1" class="styled_slider slider-progress">
			</div><br>
			<button class="minus-btn"><h4>-</h4></button>
			<div class="modeadd"> 
				<input type="checkbox" name="checkmode_tick" id="checkmode_tick" class="checkbox_input" onchange='changemode(this);' checked style="visibility: hidden;">
				<label for="checkmode_tick">
					<img id="nmimg" src="photo/black/n_mode_off_b.png">
				</label>
			</div>
		</div>

	    <div class="bigcnvshdn">
			<canvas class="block" id="artcanvas" width="1000" height="1000" style="width: 1px;"></canvas>
			<script src="scripts/scrcanvas.js"></script>
		</div>
		<canvas class="bigcnvs_class" id="bigcnvs_cnvs"></canvas>

		<button name="left-bt" id="left-bt"><h4><</h4></button>
		<button name="right-bt" id="right-bt"><h4>></h4></button>
		<button name="up-bt" id="up-bt"><h4><</h4></button>
		<button name="down-bt" id="down-bt"><h4>></h4></button>

		<script type="text/javascript">
			for (let e of document.querySelectorAll('#zoom_inp.slider-progress')) {
			  e.style.setProperty('--value', e.value);
			  e.style.setProperty('--min', e.min == '' ? '0' : e.min);
			  e.style.setProperty('--max', e.max == '' ? '100' : e.max);
			  e.addEventListener('input', () => e.style.setProperty('--value', e.value));
			}

			var isCordsFromInputFields = false;
			var div_flag = true;
			var wi = 0.8;
			var sx = 0;
			var sy = 0;
			var zoomi = 1;
			var oc = document.getElementById('artcanvas');
			var canvas = document.getElementById('bigcnvs_cnvs');
			var context = canvas.getContext("2d");

			(window.onload = function(){
				window.addEventListener('resize', resizeCanvas, false);
				resizeCanvas();
			})();

			function resizeCanvas() {
				if (wi != 1) { 			
					wi = (window.innerWidth - document.getElementById('pc_header_id').clientWidth ) / window.innerWidth;
					console.log(wi);	
				}
				canvas.setAttribute("width", window.innerWidth * wi);
				canvas.setAttribute('height', window.innerHeight);
				ReDraw();
			}

			function ReDraw(){
				context.imageSmoothingEnabled = false;
				context.mozImageSmoothingEnabled = false;
				context.msImageSmoothingEnabled = false;
				context.webkitImageSmoothingEnabled = false;
				if (zoomi > 50) (zoomi = 50);
				if (zoomi <= 0) { zoomi = 1; }
				zi = 1 / zoomi;

				sWidth = window.innerWidth * wi *zi;
				sHeight = window.innerHeight*zi;

				if (window.innerWidth * wi <= window.innerHeight) {
					if (sHeight+sy > 1000) {
						sHeight = 1000-sy;
						sWidth = (window.innerWidth * wi * sHeight) / window.innerHeight;
					}
				} else {
					if (sWidth+sx > 1000) {
						sWidth = 1000-sx;
						sHeight = (window.innerHeight * sWidth) / (window.innerWidth * wi);
					}
				}
				if (sx > 1000-sWidth) {sx = 1000-sWidth;}
				if (sx < 0) {sx = 0;}
				if (sy > 1000-sHeight) {sy = 1000-sHeight;}
				if (sy < 0) {sy = 0;}

				void context.drawImage(oc, sx, sy, sWidth, sHeight, 0, 0, window.innerWidth * wi, window.innerHeight);
			}

			const changeHandler3 = e => {
				const value = e.value;
				let ZmPoleVvoda = document.getElementById('zoom_inp').value;
				let old_sWidth = sWidth;
				let old_sHeight = sHeight;

				if ((ZmPoleVvoda >= 0) && (ZmPoleVvoda <= 50)){
					zoomi = ZmPoleVvoda;
					if (zoomi == 0) { zoomi = 1; }
					zi = 1 / zoomi;
					sWidth = window.innerWidth * wi *zi;
					sHeight = window.innerHeight*zi;
					if (div_flag) {
						sx = sx + ((old_sWidth - sWidth) / 2);
						sy = sy + ((old_sHeight - sHeight) / 2);
					} else {
						sx = sx + ((old_sWidth - sWidth) * (wx / (window.innerWidth * wi)));
						sy = sy + ((old_sHeight - sHeight) * (wy / window.innerHeight));
					}
					if (sx > 1000-sWidth) {sx = 1000-sWidth;}
					if (sx < 0) {sx = 0;}
					if (sy > 1000-sHeight) {sy = 1000-sHeight;}
					if (sy < 0) {sy = 0;}
					ReDraw();
				} else {
					alert('Error: The values in the zoom fields are numbers in the range from 0 to 50');
				}
				div_flag = true;
			}

			document.querySelector('.plus-btn').onclick = function(){plusBtnClick();}
			function plusBtnClick(){
				document.getElementById('zoom_inp').value = Number(document.getElementById('zoom_inp').value)+1;
				changeHandler3(this);
				let inp_range = document.getElementById('zoom_inp');
				inp_range.style.setProperty('--value', document.getElementById('zoom_inp').value);
			}
			document.querySelector('.minus-btn').onclick = function(){minusBtnClick();}
			function minusBtnClick(){
				document.getElementById('zoom_inp').value = Number(document.getElementById('zoom_inp').value)-1;
				changeHandler3(this);
				let inp_range = document.getElementById('zoom_inp');
				inp_range.style.setProperty('--value', document.getElementById('zoom_inp').value);
			}

			function ReCord(clx, cly) {
				let del = (window.innerWidth * wi) /sWidth;
				let partpix1x = sx - Math.trunc(sx);
				let partpix2x = 1 - partpix1x;
				let partpix1y = sy - Math.trunc(sy);
				let partpix2y = 1 - partpix1y;
				let resx = sx + partpix2x + Math.trunc(clx/del-partpix2x);
				let resy = sy + partpix2y + Math.trunc(cly/del-partpix2y);
				if ((clx <= partpix2x*del)) {resx = Math.trunc(sx);} 
				if ((cly <= partpix2y*del)) {resy = Math.trunc(sy);} 
				return [resx, resy];
			}
			
			var left_bt = document.getElementById('left-bt');
			var right_bt = document.getElementById('right-bt');
			var up_bt = document.getElementById('up-bt');
			var down_bt = document.getElementById('down-bt');

			left_bt.onclick = function(){
				sx=sx-50;
				zi = 1 / zoomi;
				if (sx < 0) {sx = 0;}
				if (sx > 1000-sWidth) {sx = 1000-sWidth;}
				if (sx < 0) {sx = 0;}
				ReDraw();
			}

			right_bt.onclick = function(){
				sx=sx+50;
				zi = 1 / zoomi;
				if (sx < 0) {sx = 0;}
				if (sx > 1000-sWidth) {sx = 1000-sWidth;}
				if (sx < 0) {sx = 0;}
				ReDraw();
			}
			up_bt.onclick = function(){
				sy=sy-50;
				zi = 1 / zoomi;
				if (sy < 0) {sy = 0;}
				if (sy > 1000-sHeight) {sy = 1000-sHeight;}
				if (sy < 0) {sy = 0;}
				ReDraw();
			}
			down_bt.onclick = function(){
				sy=sy+50;
				zi = 1 / zoomi;
				if (sy < 0) {sy = 0;}
				if (sy > 1000-sHeight) {sy = 1000-sHeight;}
				if (sy < 0) {sy = 0;}
				ReDraw();
			}
		</script>
		<script src="scripts/scrinputxubgcnvspc.js" type="text/javascript"></script>
		<script src="scripts/scrtouchpc.js" type="text/javascript"></script>
		<script>
			var flag = 'd';
			function changemode(e) {
				/*if($("#checkmode_tick").prop('checked')) {
					flag = 'd';
				  	document.getElementById("nmimg").src="photo/nmodeon.png";
				  	$("#x_inp").css('color', '#fff');
				  	$("#y_inp").css('color', '#fff');
				  	$(".close_more_container").css('background-image', 'url(../photo/crest.png)');
				  	$(".more_pixel_text").css('color', '#fff');
				  	$(".more_style").css('color', '#fff');	
				  	$("#hrefafix").removeClass("hreflight");
				} else {
					flag = 'l';
				  	document.getElementById("nmimg").src="photo/nmodeoff.png";
				  	$("#x_inp").css('color', '#000');
				  	$("#y_inp").css('color', '#000');
				  	$(".close_more_container").css('background-image', 'url(../photo/crestN.png)');
				  	$(".more_pixel_text").css('color', '#000');
				  	$(".more_style").css('color', '#000');
				  	$("#hrefafix").addClass("hreflight");
				}*/
			}
		</script>
		<script type="text/javascript">
			let change_width = document.querySelector('.change_width');

			change_width.onclick = function(){
				$(".change_width").addClass("animation");
				if (wi < 1) {
 					wi = 1; 
				    canvas.setAttribute("width", window.innerWidth * wi);
					ReDraw();
					$(".pc_header").addClass("hiden");	
					$(".change_width").addClass("hiden");
					$(".more-block").addClass("hiden");
					$(".menu_grid").addClass("hiden-left");

					$("#left-bt").addClass("hiden");
					setTimeout(function() {
					  	$("#right-bt").addClass("hiden");
					}, 100);
					setTimeout(function() {
					  	$("#up-bt").addClass("hiden");
					}, 200);
					setTimeout(function() {
					  	$("#down-bt").addClass("hiden");
					}, 300);

				} else {
					$(".pc_header").removeClass("hiden");
					$(".change_width").removeClass("hiden");
					$(".more-block").removeClass("hiden");
					$(".menu_grid").removeClass("hiden-left");

					$("#left-bt").removeClass("hiden");
					setTimeout(function() {
					  	$("#right-bt").removeClass("hiden");
					}, 100);
					setTimeout(function() {
					  	$("#up-bt").removeClass("hiden");
					}, 200);
					setTimeout(function() {
					  	$("#down-bt").removeClass("hiden");
					}, 300);

					wi = (window.innerWidth - document.getElementById('pc_header_id').clientWidth ) / window.innerWidth;	
					setTimeout(function() {
					  	canvas.setAttribute("width", window.innerWidth * wi);
						ReDraw();
					}, 100);
				}
				setTimeout(function() { 
					$(".change_width").removeClass("animation"); 
				}, 100);
			}

			let change_menu = document.querySelector('.change_menu');
			change_menu.onmouseover = function(){ 
				$(".menu_grid").removeClass("hiden");
				$(".change_menu").addClass("hiden"); 
			}	
			let menu_main = document.querySelector('.menu_grid');
			menu_main.onmouseleave = function(){ 
				$(".menu_grid").addClass("hiden"); 
				$(".change_menu").removeClass("hiden");
			}
			let bigcnvs_class = document.querySelector('.bigcnvs_class');
			bigcnvs_class.onmouseover = function(){ 
				$(".menu_grid").addClass("hiden"); 
				$(".change_menu").removeClass("hiden");
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
	</body>
</html>