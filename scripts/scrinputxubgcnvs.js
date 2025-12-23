const changeHandler2 = e => {
	const value = e.value;
	e.value = value.replace(/\D/g, '');
	let XPoleVvoda2 = document.getElementById('x_inp').value;
	let YPoleVvoda2 = document.getElementById('y_inp').value;
	if ((XPoleVvoda2 >= 0) && (XPoleVvoda2 <= 999) && (YPoleVvoda2 >= 0) && (YPoleVvoda2 <= 999)) 
	{
		asd2();
	} else {
		alert('Error: The values in the X and Y fields are whole numbers in the range from 0 to 999')
	}
}	


var c = document.getElementById("artcanvas");
var ctx = c.getContext("2d");
var servResponseStatus = document.querySelector('.moreStatus');
var servResponseOwner = document.querySelector('.moreOwner');
var servResponseURL = document.querySelector('#moreLink');
var servResponseText = document.querySelector('.moreText');

function asd2() {
	var pixDataSearch2;
    var hexcolorSearch2;
    var pixcrdXSearch2 = document.getElementById('x_inp').value;
    var pixcrdYSearch2 = document.getElementById('y_inp').value;
    event = event || window.event;
    document.querySelector('.moreX').innerHTML = pixcrdXSearch2;
    document.querySelector('.moreY').innerHTML = pixcrdYSearch2;
    if (pixcrdXSearch2 == '') {
      document.querySelector('.moreX').innerHTML = '0';
    }
    if (pixcrdYSearch2 == '') {
      document.querySelector('.moreY').innerHTML = '0';
    }
	pixDataSearch2 = ctx.getImageData(pixcrdXSearch2, pixcrdYSearch2, 1, 1);
    hexcolorSearch2 = "#" + ((1 << 24) + (pixDataSearch2.data[0] << 16) + (pixDataSearch2.data[1] << 8) + pixDataSearch2.data[2]).toString(16).slice(1);
    document.querySelector('.moreColor').innerHTML = hexcolorSearch2;
    document.querySelector('#moreexpixelcolor').style.backgroundColor = hexcolorSearch2;
    document.querySelector('#expixelcolor').style.backgroundColor = hexcolorSearch2;



    var userInputX2 = pixcrdXSearch2;
    var userInputY2 = pixcrdYSearch2;
    userInputX2 = encodeURIComponent(userInputX2);
    userInputY2 = encodeURIComponent(userInputY2);
    
    var xhr02 = new XMLHttpRequest();
    xhr02.open('GET', 'checkingstatus.php?' + 'pixcrdX=' + userInputX2 + '&pixcrdY=' + userInputY2);
    xhr02.onreadystatechange = function(){
        if(xhr02.readyState === 4 && xhr02.status === 200){
          servResponseStatus.innerHTML = xhr02.responseText;
        }
    }
    xhr02.send('pixcrdX=' + userInputX2 + '&pixcrdY=' + userInputY2);

    var xhr12 = new XMLHttpRequest();
    xhr12.open('GET', 'checkingowner.php?' + 'pixcrdX=' + userInputX2 + '&pixcrdY=' + userInputY2);
    xhr12.onreadystatechange = function(){
        if(xhr12.readyState === 4 && xhr12.status === 200){
          servResponseOwner.innerHTML = xhr12.responseText;
        }
    }
    xhr12.send('pixcrdX=' + userInputX2 + '&pixcrdY=' + userInputY2);

    var xhr22 = new XMLHttpRequest();
    xhr22.open('GET', 'checkingurl.php?' + 'pixcrdX=' + userInputX2 + '&pixcrdY=' + userInputY2);
    xhr22.onreadystatechange = function(){
        if(xhr22.readyState === 4 && xhr22.status === 200){
          servResponseURL.innerHTML = xhr22.responseText;
                      if(xhr22.responseText == 'Pixel not purchased'){
              document.querySelector('#hrefafix').href = '';
            } else {
              document.querySelector('#hrefafix').href = xhr22.responseText;
            }
        }
    }
    xhr22.send('pixcrdX=' + userInputX2 + '&pixcrdY=' + userInputY2);

    var xhr32 = new XMLHttpRequest();
    xhr32.open('GET', 'checkingtext.php?' + 'pixcrdX=' + userInputX2 + '&pixcrdY=' + userInputY2);
    xhr32.onreadystatechange = function(){
        if(xhr32.readyState === 4 && xhr32.status === 200){
          servResponseText.innerHTML = xhr32.responseText;
        }
    }
    xhr32.send('pixcrdX=' + userInputX2 + '&pixcrdY=' + userInputY2);

    if ((document.getElementById('x_inp').value =='') || (document.getElementById('y_inp').value =='')) {
    	if (flag == 'd') {
			$("#expixelcolor").css('background-color', 'rgba(200, 200, 200, 0.5)');
			$("#moreexpixelcolor").css('background-color', 'rgba(200, 200, 200, 0.5)');
    	}	else {
			$("#expixelcolor").css('background-color', 'rgba(70, 70, 70, 0.5)');
			$("#moreexpixelcolor").css('background-color', 'rgba(70, 70, 70, 0.5)');
    	}
    	document.querySelector('.moreX').innerHTML = 'Undefined';
    	document.querySelector('.moreY').innerHTML = 'Undefined';
    	document.querySelector('.moreColor').innerHTML = 'Undefined';
    	document.querySelector('.moreOwner').innerHTML = 'Undefined';
    	document.querySelector('.moreStatus').innerHTML = 'Undefined';
    	document.querySelector('#moreLink').innerHTML = 'Undefined';
    	document.querySelector('.moreText').innerHTML = 'Undefined';
    }
} 