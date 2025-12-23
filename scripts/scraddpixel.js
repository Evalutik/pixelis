var XForDraw = 0, // для добавления нового пикселя
	YForDraw = 0, // для добавления нового пикселя
	ColorForDraw = '#000fff'; // для добавления нового пикселя

	if (ColorForDraw.slice(0, 1) == '#') { // если есть решетка спереди - убираем
	ColorForDraw = ColorForDraw.slice(1, ColorForDraw.length);
	}

var xhrDr = new XMLHttpRequest();
xhrDr.open('GET', 'addpixel.php?' + 'x=' + XForDraw + '&y=' + YForDraw + '&color=' + ColorForDraw);
xhrDr.send();

