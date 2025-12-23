const logBlock = document.getElementById('bigcnvs_cnvs');


logBlock.addEventListener('touchstart', handleTouchStart, false);
logBlock.addEventListener('touchmove', handleTouchMove, false);
logBlock.addEventListener('touchend', handleTouchEnd, false);

let x1 = null;
let y1 = null;
let xs = null;
let ys = null;

let x01 = null;
let y01 = null;
let x11 = null;
let y11 = null;
let dist1 = null;
let dists = null;

function distance(o1x, o1y, o2x, o2y) {
	return (Math.sqrt(Math.pow(( o1x - o2x ), 2) + Math.pow(( o1y - o2y ), 2)));
}

function handleTouchStart(event) {
	const firstTouch = event.touches[0];
	x1=firstTouch.clientX;
	y1=firstTouch.clientY;
	xs=x1;
	ys=y1;


	//зум пальцами
	if (event.touches.length >= 2) {
		x01=event.touches[0].clientX;
		y01=event.touches[0].clientY;
		x11=event.touches[1].clientX;
		y11=event.touches[1].clientY;
		dist1 = distance(x01, y01, x11, y11);
		dists = dist1;
	}
	//конец зума пальцами


}

function handleTouchMove(event) {
	if (!x1 || !y1) {
		return false;
	}

	//зум пальцами
	if (event.touches.length >= 2) {
		let x02=event.touches[0].clientX;
		let y02=event.touches[0].clientY;
		let x12=event.touches[1].clientX;
		let y12=event.touches[1].clientY;
		let dist2 = distance(x02, y02, x12, y12);
		let distDif = dist2 - dist1;
		if (distDif > 0) { //увеличиваем зум
			zoomi=zoomi+0.1;
		} else if (distDif < 0) { //уменьшаем зум
			zoomi=zoomi-0.1;
		}
		dist1=dist2;
	}
	if (zoomi > 50) (zoomi = 50);
	if (zoomi <= 0) { zoomi = 0.001; }
	zi = 1 / zoomi;
	//конец зума пальцами


	let x2 = event.touches[0].clientX;
	let y2 = event.touches[0].clientY;
	let ziu = zi;
	if (ziu > 1) { ziu = 1;}
	let xDif = x2 - x1;
	let yDif = y2 - y1;
	if (xDif < -0) {
		sx = sx+0.1+4*ziu+0.003*zoomi;
	} else if (xDif > 0) {
		sx = sx-0.1-4*ziu-0.003*zoomi;
	}
	if (yDif < -0) {
		sy = sy+0.1+4*ziu+0.003*zoomi;
	} else if (yDif > 0) {
		sy = sy-0.1-4*ziu-0.003*zoomi;
	}
	if (zoomi == 0) { zoomi = 0.001; }
	zi = 1 / zoomi;
	if (sx < 0) {sx = 0;}
	if (sx > 1000-sWidth) {sx = 1000-sWidth;}
	if (sx < 0) {sx = 0;}
	if (sy < 0) {sy = 0;}
	if (sy > 1000-sHeight) {sy = 1000-sHeight;}
	if (sy < 0) {sy = 0;}
	x1=x2;
	y1=y2;	
	ReDraw();
}

function handleTouchEnd(event) {
	let x3 = event.changedTouches[0].clientX;
	let y3 = event.changedTouches[0].clientY;
	if ((xs == x3) && (ys == y3)) {
		zapheader(ReCord(x3, y3));

	}
}

function zapheader(m){
	document.getElementById('x_inp').value = m[0];
	document.getElementById('y_inp').value = m[1];
	pixDataSearch = ctx.getImageData(m[0], m[1], 1, 1);
    hexcolorSearch = "#" + ((1 << 24) + (pixDataSearch.data[0] << 16) + (pixDataSearch.data[1] << 8) + pixDataSearch.data[2]).toString(16).slice(1);
    document.querySelector('#expixelcolor').style.backgroundColor = hexcolorSearch;
    asd2();
}

const moreBlock = document.querySelector('.more_container');


moreBlock.addEventListener('touchstart', moreTouchStart, false);
moreBlock.addEventListener('touchmove', moreTouchMove, false);
moreBlock.addEventListener('touchend', moreTouchEnd, false);

let x1m = null;
let y1m = null;
let xsm = null;
let ysm = null;

let x01m = null;
let y01m = null;
let x11m = null;
let y11m = null;
let dist1m = null;
let distsm = null;
var chtr = -15;

function moreTouchStart(event) {
	if (( event.target.id == 'target_more') || ( event.target.id == 'more_scroll_id')) {
		chtr = -15;
		const firstTouchM = event.touches[0];
		x1m=firstTouchM.clientX;
		y1m=firstTouchM.clientY;
		xsm=x1m;
		ysm=y1m;
		if (!(document.querySelector(".more_container").classList.contains("unstate") )) {	
			$(".more_container").addClass("unstate"); 

		}
	}
}

function moreTouchMove(event) {
	if (( event.target.id == 'target_more') || ( event.target.id == 'more_scroll_id')) {
		if (!x1m || !y1m) {
			return false;
		}
		let x2m = event.touches[0].clientX;
		let y2m = event.touches[0].clientY;
		let xDifm = x2m - x1m;
		let yDifm = y2m - y1m;
		if (yDifm < 0) {
			if (document.querySelector(".more_container").classList.contains("unstate") ) {
			 	if (chtr > -1 * window.innerHeight - 180) {
			 		chtr = chtr - 10;
			 		$(".unstate").css('-webkit-transform', 'translateY(calc('+String(chtr)+'px))');
			 		$(".unstate").css('transform', 'translateY(calc('+String(chtr)+'px))');
			 	}
			} 
		} else if (chtr < -10) {
			chtr = chtr + 10;
			$(".unstate").css('-webkit-transform', 'translateY(calc('+String(chtr)+'px))');
			$(".unstate").css('transform', 'translateY(calc('+String(chtr)+'px))');		 	
		}
		x1m=x2m;
		y1m=y2m;	
	}
}

function moreTouchEnd(event) {
	if (( event.target.id == 'target_more') || ( event.target.id == 'more_scroll_id')) {
		let x3m = event.changedTouches[0].clientX;
		let y3m = event.changedTouches[0].clientY;
		if (ysm - y3m > window.innerHeight / 5) {
			if (document.querySelector(".more_container").classList.contains("unstate") ) {	
				$(".more_container").removeClass("unstate");
			}
			if (document.querySelector(".more_container").classList.contains("loaded") ) {	
				$(".more_container").removeClass("loaded");
			}
			if (!(document.querySelector(".more_container").classList.contains("hiden") )) {	
				$(".more_container").addClass("hiden"); 	
			}

			$(".header").removeClass("hiden");
			$(".header").addClass("loaded");
			$(".mobile_menu").removeClass("hiden");
			$(".mobile_menu").addClass("loaded"); 				

			document.querySelector(".more_container").removeAttribute("style");	
			if (flag == 'd') {
				$(".more_container").css('background-color', 'rgba(0, 0, 0, 0.3)');
			} else {
				$(".more_container").css('background-color', 'rgba(0, 0, 0, 0)');
			}
		} else {
			if (document.querySelector(".more_container").classList.contains("unstate") ) {	
				$(".more_container").removeClass("unstate");
			}
			if (document.querySelector(".more_container").classList.contains("hiden") ) {	
				$(".more_container").removeClass("hiden");
			}
			if (!(document.querySelector(".more_container").classList.contains("loaded") )) {	
				$(".more_container").addClass("loaded"); 
			}
			document.querySelector(".more_container").removeAttribute("style");
			if (flag == 'd') {
				$(".more_container").css('background-color', 'rgba(0, 0, 0, 0.3)');
			} else {
				$(".more_container").css('background-color', 'rgba(0, 0, 0, 0)');
			}

		}
	}
}