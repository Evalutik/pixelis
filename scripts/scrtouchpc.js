const logBlock = document.getElementById('bigcnvs_cnvs');


logBlock.addEventListener('mousedown', mouseStart, false);
logBlock.addEventListener('mousemove', mouseMove, false);
logBlock.addEventListener('mouseup', mouseEnd, false);
logBlock.addEventListener('mouseout', mouseEnd, false);
logBlock.addEventListener('wheel', mouseWheel, false);

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

let down;
let change_xy;

function distance(o1x, o1y, o2x, o2y) {
	return (Math.sqrt(Math.pow(( o1x - o2x ), 2) + Math.pow(( o1y - o2y ), 2)));
}

function mouseWheel(event) {
	div_flag = false;
	wx = event.offsetX;
	wy = event.offsetY;
	if (event.wheelDelta > 0) {
		document.getElementById('zoom_inp').value = Number(document.getElementById('zoom_inp').value)+1;
	} else {
		document.getElementById('zoom_inp').value = Number(document.getElementById('zoom_inp').value)-1;
	}
	changeHandler3(this);
	let inp_range = document.getElementById('zoom_inp');
	inp_range.style.setProperty('--value', document.getElementById('zoom_inp').value);
}

function mouseStart(event) {
	x1=event.offsetX;
	y1=event.offsetY;
	xs=x1;
	ys=y1;
	down=true;
	$("#bigcnvs_cnvs").css('cursor', 'all-scroll');
}

function mouseMove(event) {
	if (!x1 || !y1) {
		return false;
	}
	let x2 = event.offsetX;
	let y2 = event.offsetY;
	if (down) {
		let ziu = zi;
		if (ziu > 1) { ziu = 1;}
		let xDif = x2 - x1;
		let yDif = y2 - y1;
		if (zoomi >= 40) {
			change_xy = ((sWidth+sHeight))/ (2 * 60);
		} else if (zoomi >= 5){
			change_xy = ((sWidth+sHeight))/ (2 * 80);
		} else {
			change_xy = ((sWidth+sHeight))/ (2 * 120);
		}

		console.log(change_xy, ziu, zoomi, 0.4, 15*ziu, 0.003*zoomi);
		if (xDif < -0) {
			sx = sx+change_xy; //sx+0.1+4*ziu+0.003*zoomi
		} else if (xDif > 0) {
			sx = sx-change_xy;
		}
		if (yDif < -0) {
			sy = sy+change_xy;
		} else if (yDif > 0) {
			sy = sy-change_xy;
		}
		if (zoomi == 0) { zoomi = 1; }
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
}

function mouseEnd(event) {
	let x3 = event.offsetX;
	let y3 = event.offsetY;
	if ((xs == x3) && (ys == y3)) {
		zapheader(ReCord(x3, y3));

	}
	down=false;
	$("#bigcnvs_cnvs").css('cursor', 'default');
}

function zapheader(m){
	document.getElementById('x_inp').value = m[0];
	document.getElementById('y_inp').value = m[1];
	pixDataSearch = ctx.getImageData(m[0], m[1], 1, 1);
    hexcolorSearch = "#" + ((1 << 24) + (pixDataSearch.data[0] << 16) + (pixDataSearch.data[1] << 8) + pixDataSearch.data[2]).toString(16).slice(1);
    document.querySelector('#expixelcolor').style.backgroundColor = hexcolorSearch;
    isCordsFromInputFields = false;
    asd2();
}