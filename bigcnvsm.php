<!DOCTYPE html>
<html lang="EN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="maximum-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="favicon.png" type="image/png">
		<title>Pixel4u - field</title>
		<script src="scripts/jquery-3.0.0.min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="css/mobile/field_m.css">
	</head>
	<body>
		<?php require_once 'cookie/isacceptcookie.php'; ?>
	    <script type="text/javascript">
		    var flag_bgcnvs = true,
				flag_clone = false;
		</script>
	    <div class="bigcnvshdn">
			<canvas class="block" id="artcanvas" width="1000" height="1000" style="width: 1px;"></canvas>
			<script src="scripts/scrcanvas.js"></script>
		</div>
		<canvas class="bigcnvs_class" id="bigcnvs_cnvs"></canvas>
	    <div class="more_container hiden" id="target_more">
	    	<div class="close_more_container white"></div>
	    	<div class="more_pixel_text">About selected pixel</div>
	    	<div class="more_scroll" id="more_scroll_id">
		    	<div class="more_style more_style_inline" style="margin-top: 0;" id="moreX_div">X: <span style="color: #7D7AED;" class="moreX">Undefined</span></div>
		    	<div class="more_style more_style_inline">Y: <span style="color: #7D7AED;" class="moreY">Undefined</span></div>
		    	<div class="more_style">Color:<br> <span style="color: #7D7AED;" class="moreColor">Undefined</span>
		    		<div id="moreexpixelcolor"></div>
		    	</div>
		    	<div class="more_style">Owner:<br> <span style="color: #7D7AED;" class="moreOwner">Undefined</span></div>
		    	<div class="more_style">Status:<br> <span style="color: #7D7AED;" class="moreStatus">Undefined</span></div>

		    	<div class="more_style">Link:<br>
						<a href="" id="hrefafix" target="_blank">
							<span id="moreLink">
								Undefined
							</span>
						</a>
				</div>
		    	<div class="more_style">Text:<br> 
		    		<span style="color: #7D7AED;" class="moreText">
		    			Undefined
		    		</span>
		    	</div>
	    	</div>
		</div>
	    <div class="mobile_menu_container">
		    <div class="mobile_menu_content">
		        <ul>
		            <li><a href="index.php" class="white">Home</a></li>
		            <li><a href="bigcnvs.php" class="white">Field</a></li>
		            <li><a href="about.php" class="white">About</a></li>
		            <li><a href="contact.php" class="white">Contact</a></li>
		            <li><a href="bigcnvspc.php" class="white">Desktop</a></li>
		        </ul>
		    </div>
		</div>
		<div class="mobile_menu_overlay"></div>
		<div class="mobile_menu"></div>
		<div class="header loaded" id="header_id">
			<form action="" style="height: 100%">
				<div class="pos_block" id="form_id" style="height: 100%">
						<input type="text" name="x_inp" id="x_inp" placeholder="X" oninput="changeHandler2(this)" maxlength="3">
						<input type="text" name="y_inp" id="y_inp" placeholder="Y" oninput="changeHandler2(this)" maxlength="3">
						<div id="expixelcolor"></div>

						<div id="also_checked">
							<img id="moreimg" class="white" src="photo/white/more_btn_w.png">
						</div>

						<input type="range" name="zoom_inp" id="zoom_inp" placeholder="zoom" oninput="changeHandler3(this)" min="0" max="50" value="1" class="styled-slider slider-progress">
						<h4 id="rangeValue">1</h4>

						<div style="width: 0" class="modeadd"> 
							<input type="checkbox" name="checkmode_tick" id="checkmode_tick" class="checkbox_input" onchange='changemode(this);' checked style="visibility: hidden;">
							<label for="checkmode_tick">
								<img id="nmimg" class="white" src="photo/white/n_mode_on_w.png">
							</label>

						</div>
				</div>
			</form>
		</div>
		<input type="button" name="left_bt" id="left_bt" value="←">
		<input type="button" name="right_bt" id="right_bt" value="→">
		<input type="button" name="up_bt" id="up_bt" value="↑">
		<input type="button" name="down_bt" id="down_bt" value="↓">
		<script type="text/javascript">
			for (let e of document.querySelectorAll('#zoom_inp.slider-progress')) {
			  e.style.setProperty('--value', e.value);
			  e.style.setProperty('--min', e.min == '' ? '0' : e.min);
			  e.style.setProperty('--max', e.max == '' ? '100' : e.max);
			  e.addEventListener('input', () => e.style.setProperty('--value', e.value));
			}
		</script>
		<script>
			sx = 0;
			sy = 0;
			zoomi = 1;
			(window.onload = function(){
				var oc = document.getElementById('artcanvas');
				var canvas = document.getElementById('bigcnvs_cnvs');
				var context = canvas.getContext("2d");
				window.addEventListener('resize', resizeCanvas, false);
				function resizeCanvas() {
					canvas.setAttribute("width", window.innerWidth);
					canvas.setAttribute('height', window.innerHeight);
					drawStuff();
				}
				resizeCanvas();
				function drawStuff(){
				context.imageSmoothingEnabled = false;
				context.mozImageSmoothingEnabled = false;
				context.msImageSmoothingEnabled = false;
				context.webkitImageSmoothingEnabled = false;
				if (zoomi > 50) (zoomi = 50);
				if (zoomi <= 0) { zoomi = 0.001; }
				zi = 1 / zoomi;
				if (zoomi > 0.1) {
					document.getElementById('rangeValue').innerHTML = zoomi;
				} else {
					document.getElementById('rangeValue').innerHTML = 'min';
				}
					sWidth = window.innerWidth*zi;
					sHeight = window.innerHeight*zi;

					if (window.innerWidth <= window.innerHeight) {
						if (sHeight+sy > 1000) {
							sHeight = 1000-sy;
							sWidth = (window.innerWidth * sHeight) / window.innerHeight;
						}
					} else {
						if (sWidth+sx > 1000) {
							sWidth = 1000-sx;
							sHeight = (window.innerHeight * sWidth) / window.innerWidth;
						}
					}

					if (sx < 0) {sx = 0;}
					if (sx > 1000-sWidth) {sx = 1000-sWidth;}
					if (sx < 0) {sx = 0;}
					if (sy < 0) {sy = 0;}
					if (sy > 1000-sHeight) {sy = 1000-sHeight;}
					if (sy < 0) {sy = 0;}
					void context.drawImage(oc, sx, sy, sWidth, sHeight, 0, 0, window.innerWidth, window.innerHeight);
				}

			})();
		</script>
		<script>
				var oc = document.getElementById('artcanvas');
				var canvas = document.getElementById('bigcnvs_cnvs');
				var context = canvas.getContext("2d");
				var left_bt = document.getElementById('left_bt');
				var right_bt = document.getElementById('right_bt');
				var up_bt = document.getElementById('up_bt');
				var down_bt = document.getElementById('down_bt');

				left_bt.onclick = function(){
					sx=sx-50;
					if (zoomi == 0) { zoomi = 0.001; }
					zi = 1 / zoomi;
					if (sx < 0) {sx = 0;}
					if (sx > 1000-sWidth) {sx = 1000-sWidth;}
					if (sx < 0) {sx = 0;}
					ReDraw();
				}

				right_bt.onclick = function(){
					sx=sx+50;
					if (zoomi == 0) { zoomi = 0.001; }
					zi = 1 / zoomi;
					if (sx < 0) {sx = 0;}
					if (sx > 1000-sWidth) {sx = 1000-sWidth;}
					if (sx < 0) {sx = 0;}
					ReDraw();
				}
				up_bt.onclick = function(){
					sy=sy-50;
					if (zoomi == 0) { zoomi = 0.001; }
					zi = 1 / zoomi;
					if (sy < 0) {sy = 0;}
					if (sy > 1000-sHeight) {sy = 1000-sHeight;}
					if (sy < 0) {sy = 0;}
					ReDraw();
				}
				down_bt.onclick = function(){
					sy=sy+50;
					if (zoomi == 0) { zoomi = 0.001; }
					zi = 1 / zoomi;
					if (sy < 0) {sy = 0;}
					if (sy > 1000-sHeight) {sy = 1000-sHeight;}
					if (sy < 0) {sy = 0;}
					ReDraw();
				}

				function ReDraw(){
				context.imageSmoothingEnabled = false;
				context.mozImageSmoothingEnabled = false;
				context.msImageSmoothingEnabled = false;
				context.webkitImageSmoothingEnabled = false;
				if (zoomi > 50) (zoomi = 50);
				if (zoomi <= 0) { zoomi = 0.001; }
				zi = 1 / zoomi;
				if (zoomi > 0.1) {
					document.getElementById('rangeValue').innerHTML = zoomi;
				} else {
					document.getElementById('rangeValue').innerHTML = 'min';
				}
					sWidth = window.innerWidth*zi;
					sHeight = window.innerHeight*zi;

					if (window.innerWidth <= window.innerHeight) {
						if (sHeight+sy > 1000) {
							sHeight = 1000-sy;
							sWidth = (window.innerWidth * sHeight) / window.innerHeight;
						}
					} else {
						if (sWidth+sx > 1000) {
							sWidth = 1000-sx;
							sHeight = (window.innerHeight * sWidth) / window.innerWidth;
						}
					}

					if (sx < 0) {sx = 0;}
					if (sx > 1000-sWidth) {sx = 1000-sWidth;}
					if (sx < 0) {sx = 0;}
					if (sy < 0) {sy = 0;}
					if (sy > 1000-sHeight) {sy = 1000-sHeight;}
					if (sy < 0) {sy = 0;}
					void context.drawImage(oc, sx, sy, sWidth, sHeight, 0, 0, window.innerWidth, window.innerHeight);
				}
		</script>
		<script>
			const changeHandler3 = e => {
			const value = e.value;
			e.value = value.replace(/[^.\d]+/g, '').replace( /^([^\.]*\.)|\./g, '$1');
			let ZmPoleVvoda = document.getElementById('zoom_inp').value;
			let old_sWidth = sWidth;
			let old_sHeight = sHeight;
			if ((ZmPoleVvoda >= 0) && (ZmPoleVvoda <= 50)) 
				{
					zoomi = ZmPoleVvoda;
					if (zoomi == 0) { zoomi = 0.001; }
					zi = 1 / zoomi;
					sWidth = window.innerWidth*zi;
					sHeight = window.innerHeight*zi;
					sx = sx + ((old_sWidth - sWidth) / 2);
					sy = sy + ((old_sHeight - sHeight) / 2);
					if (sx < 0) {sx = 0;}
					if (sx > 1000-sWidth) {sx = 1000-sWidth;}
					if (sx < 0) {sx = 0;}
					if (sy < 0) {sy = 0;}
					if (sy > 1000-sHeight) {sy = 1000-sHeight;}
					if (sy < 0) {sy = 0;}
					ReDraw();
 				} else {
					alert('Error: The values in the zoom fields are numbers in the range from 0 to 50')
				}
			}	
		</script>
		<script type="text/javascript">
			function ReCord(clx, cly) {
				let del = window.innerWidth/sWidth;
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
		</script>
		<script src="scripts/scrinputxubgcnvs.js" type="text/javascript"></script>
		<script src="scripts/scrtouch.js" type="text/javascript"></script>
		<script async>
	    		document.getElementById("moreimg").addEventListener('click', 
				function(e){
					if (document.querySelector(".more_container").classList.contains("hiden") )
					    	{
							    e.preventDefault();	      
							    $(".header").removeClass("loaded");
							    $(".header").addClass("hiden");
							    $(".mobile_menu").removeClass("loaded");
							    $(".mobile_menu").addClass("hiden"); 
							    $(".more_container").removeClass("hiden");
							    $(".more_container").addClass("loaded");      
					    	} else if (document.querySelector(".more_container").classList.contains("loaded") )
					    	{
					     		e.preventDefault();
					     		$(".more_container").removeClass("loaded");
							    $(".more_container").addClass("hiden"); 
							    $(".header").removeClass("hiden");
							    $(".header").addClass("loaded");
							    $(".mobile_menu").removeClass("hiden");
							    $(".mobile_menu").addClass("loaded");   
					    	}
					
				}, false);
				document.querySelector(".close_more_container").addEventListener('click', 
				function(e){
					if (document.querySelector(".more_container").classList.contains("loaded") )
					{
					    e.preventDefault();
					    $(".more_container").removeClass("loaded");
						$(".more_container").addClass("hiden"); 
						$(".header").removeClass("hiden");
						$(".header").addClass("loaded");
						$(".mobile_menu").removeClass("hiden");
						$(".mobile_menu").addClass("loaded"); 
						if (flag == 'd') {
							$(".more_container").css('background-color', 'rgba(0, 0, 0, 0.3)');
						}  else {
							$(".more_container").css('background-color', 'rgba(0, 0, 0, 0)');
						}
					}
				}, false);
		</script>
	    <script async>
			var tapped=false
			$("#header_id").on("touchstart", function(e){
				if (!tapped){
					tapped=setTimeout(function(){
						tapped=null
					}, 300);
				} else {
					clearTimeout(tapped);
					tapped = null
						console.log('dc');
					    if (document.getElementById("header_id").classList.contains("hiden") )
					    	{
							        e.preventDefault();
							        $(".header").removeClass("hiden");
							        $(".header").addClass("loaded");
							        $(".mobile_menu").removeClass("hiden");
							        $(".mobile_menu").addClass("loaded");       
					    	} else if (document.getElementById("header_id").classList.contains("loaded") )
					    	{
					     		e.preventDefault();
					        	$(".header").removeClass("loaded");
					        	$(".header").addClass("hiden");
							    $(".mobile_menu").removeClass("loaded");
							    $(".mobile_menu").addClass("hiden"); 
					    	}
				}		
				});
			document.getElementById("header_id").addEventListener("dblclick", function(e){
				console.log('dc');
				if (document.getElementById("header_id").classList.contains("hiden") )
				{
					e.preventDefault();
					$(".header").removeClass("hiden");
					$(".header").addClass("loaded");
					$(".mobile_menu").removeClass("hiden");
					$(".mobile_menu").addClass("loaded");       
				} else if (document.getElementById("header_id").classList.contains("loaded") )
					{
					e.preventDefault();
					$(".header").removeClass("loaded");
					$(".header").addClass("hiden");
					$(".mobile_menu").removeClass("loaded");
					$(".mobile_menu").addClass("hiden"); 
				}				
			})
		</script>
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
					    $(".header").removeClass("loaded");
					    $(".header").addClass("hiden");

				    });
				    $(document).on("click", ".mobile_menu_overlay", function(e) {
				        $(".mobile_menu_container").removeClass("loaded");
				        $(".header").removeClass("hiden");
						$(".header").addClass("loaded");
				        $(this).fadeOut(function() {
				            $(".mobile_menu_container .loaded").removeClass("loaded");
				            $(".mobile_menu_container .activity").removeClass("activity");
				            $(".header").removeClass("hiden");
							$(".header").addClass("loaded");
				        });
				    });
				})
		</script>
		<script>
			var flag = 'd';
			function changestyle() {
				var cssn = '.mobile_menu_container ul li a:hover{ background-color: #fff }';
				var cssd = '.mobile_menu_container ul li a:hover{ background-color: #000 }';
				var style = document.createElement('styleAdd');
				if (styleAdd.styleSheet) {
					styleAdd.styleSheet.cssText = cssd;
				} else {
					styleAdd.appendChild(document.createTextNode(cssd));
				}
				document.getElementByTagName('head')[0].appendChild(styleAdd);
			}

			function changemode(e) {
				if($("#checkmode_tick").prop('checked')) {
					flag = 'd';
				  	$("#header_id").css('background-color', 'rgba(0, 0, 0, 0.3)');
				  	$(".mobile_menu_container").css('background-color', 'rgba(0, 0, 0, 0.3)');
				  	$(".mobile_menu").css('background-color', 'rgba(0, 0, 0, 0.3)');
				  	$("#header_id").css('color', '#fff');
				  	document.getElementById("nmimg").src="photo/white/n_mode_on_w.png";
				  	$("#nmimg").addClass("white");
				  	$(".mobile_menu_container ul li a").css('color', '#fff');
				  	$(".mobile_menu_container ul li a.parent").css('background-color', '#000');
				  	$(".mobile_menu_container ul li a.parent:hover").css('background-color', '#000');
				  	$(".mobile_menu_container ul li a.back").css('background-color', '#000');
				  	$(".mobile_menu_container ul li a.back:hover").css('background-color', '#000');
				  	$(".mobile_menu_container ul li a").removeClass("black");
				  	$(".mobile_menu_container ul li a").addClass("white");
				  	$(".mobile_menu").css('background-image', 'url(../photo/white/menu_btn_w.svg)');
				  	$("#x_inp").css('color', '#fff');
				  	$("#y_inp").css('color', '#fff');
				  	$("#x_inp").removeClass("place-black");
				  	$("#y_inp").removeClass("place-black");
				  	if ((document.getElementById('x_inp').value == '' ) || (document.getElementById('y_inp').value == '' )) {
				  		$("#expixelcolor").css('background-color', 'rgba(200, 200, 200, 0.5)');
				  		$("#moreexpixelcolor").css('background-color', 'rgba(200, 200, 200, 0.5)');
				  	}
				  	$("#zoom_inp").removeClass("range-black");
				  	$(".pos_block h4").css('color', 'rgba(70, 70, 70, 0.75)');
				  	document.getElementById("moreimg").src="photo/white/more_btn_w.png";
				  	$(".more_container").css('background-color', 'rgba(0, 0, 0, 0.3)');
				  	$(".close_more_container").css('background-image', 'url(../photo/white/crest_w.svg)');
				  	$(".more_pixel_text").css('color', '#fff');
				  	$(".more_style").css('color', '#fff');	
				  	$("#hrefafix").removeClass("hreflight");
				  	$("#moreimg").addClass("white");
				  	$(".close_more_container").addClass("white");

				} else {
					flag = 'l';
			  		$("#header_id").css('background-color', 'rgba(0, 0, 0, 0)');
				  	$(".mobile_menu_container").css('background-color', 'rgba(0, 0, 0, 0)');
				  	$(".mobile_menu").css('background-color', 'rgba(0, 0, 0, 0)');
				  	$("#header_id").css('color', '#000');
				  	document.getElementById("nmimg").src="photo/black/n_mode_off_b.png";
				  	$("#nmimg").removeClass("white");
				  	$(".mobile_menu_container ul li a").css('color', '#000');
				  	$(".mobile_menu_container ul li a.parent").css('background-color', '#fff');
				  	$(".mobile_menu_container ul li a.parent:hover").css('background-color', '#fff');
				  	$(".mobile_menu_container ul li a.back").css('background-color', '#fff');
				  	$(".mobile_menu_container ul li a.back:hover").css('background-color', '#fff');
				  	$(".mobile_menu_container ul li a").removeClass("white");
				  	$(".mobile_menu_container ul li a").addClass("black");
				  	$(".mobile_menu").css('background-image', 'url(../photo/black/menu_btn_b.svg)');
				  	$("#x_inp").css('color', '#000');
				  	$("#y_inp").css('color', '#000');
				  	$("#x_inp").addClass("place-black");
				  	$("#y_inp").addClass("place-black");
				  	if ((document.getElementById('x_inp').value == '' ) || (document.getElementById('y_inp').value == '' )){
				  		$("#expixelcolor").css('background-color', 'rgba(70, 70, 70, 0.5)');
				  		$("#moreexpixelcolor").css('background-color', 'rgba(70, 70, 70, 0.5)');
				  	}
				  	$("#zoom_inp").addClass("range-black");
				  	$(".pos_block h4").css('color', 'rgba(135, 135, 135, 1.0)');
				  	document.getElementById("moreimg").src="photo/black/more_btn_b.png";
				  	$(".more_container").css('background-color', 'rgba(0, 0, 0, 0)');
				  	$(".close_more_container").css('background-image', 'url(../photo/black/crest_b.svg)');
				  	$(".more_pixel_text").css('color', '#000');
				  	$(".more_style").css('color', '#000');
				  	$("#hrefafix").addClass("hreflight");
				  	$("#moreimg").removeClass("white");
				  	$(".close_more_container").removeClass("white");
				}
			}
		</script>
		<script type="text/javascript">
			window.addEventListener('resize', changePositionHandleMore, false);
			function changePositionHandleMore(event){
				if (innerWidth > 0.7 * innerHeight) {
					$(".more_pixel_text").css('text-align', 'center');
					$(".more_pixel_text").css('margin-left', '25%');
					$(".more_scroll").css('margin-left', '7vw');
					$(".more_scroll").css('margin-right', '7vw');
					$(".more_style").css('margin-top', '3vh');
					$(".more_style_inline span").css('position', 'relative');
					$("#moreexpixelcolor").css('right', 'unset');
					$("#moreexpixelcolor").css('left', '14vh');
					$(".more_style_inline span").css('right', '0px');

				} else {
					$("#moreexpixelcolor").css('right', '12px');
					$("#moreexpixelcolor").css('left', 'unset');
					$(".more_scroll").css('margin-right', '25%');
					$(".more_scroll").css('margin-left', '25%');
					$(".more_style").css('margin-top', '7vw');
					$("#moreX_div").css('margin-top', '0');
					$(".more_style_inline span").css('position', 'absolute');
					$(".more_style_inline span").css('right', '12px');
					document.querySelector(".more_pixel_text").removeAttribute("style");
					if (flag == 'd') {
						$(".more_pixel_text").css('color', '#fff');
					} else {
						$(".more_pixel_text").css('color', '#000');
					}
				}
			}
			changePositionHandleMore();
		</script>
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