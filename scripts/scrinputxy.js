var c = document.getElementById("artcanvas");
var ctx = c.getContext("2d");
var servResponseStatus = document.querySelector('#fixstatus');
var servResponseOwner = document.querySelector('#fixowner');
var servResponseURL = document.querySelector('#fixlink');
var servResponseText = document.querySelector('#fixtext');

const changeHandler = e => {
	const value = e.value;
	e.value = value.replace(/\D/g, '');
	let XPoleVvoda = document.getElementById('inputx').value;
	let YPoleVvoda = document.getElementById('inputy').value;
	if ((XPoleVvoda >= 0) && (XPoleVvoda <= 999) && (YPoleVvoda >= 0) && (YPoleVvoda <= 999)) {
		asd();
	} else {
	alert('Error: The values in the X and Y fields are whole numbers in the range from 0 to 999')
	}
	

}

function asd() {
	var pixDataSearch;
    var hexcolorSearch;
    var pixcrdXSearch = document.getElementById('inputx').value;
    var pixcrdYSearch = document.getElementById('inputy').value;
    event = event || window.event; // кроссбраузерность
    document.querySelector('#fixcordsX').innerHTML = pixcrdXSearch;
    document.querySelector('#fixcordsY').innerHTML = pixcrdYSearch;
    if (pixcrdXSearch == '') {
      document.querySelector('#fixcordsX').innerHTML = '0';
    }
    if (pixcrdYSearch == '') {
      document.querySelector('#fixcordsY').innerHTML = '0';
    }
	  pixDataSearch = ctx.getImageData(pixcrdXSearch, pixcrdYSearch, 1, 1);
    hexcolorSearch = "#" + ((1 << 24) + (pixDataSearch.data[0] << 16) + (pixDataSearch.data[1] << 8) + pixDataSearch.data[2]).toString(16).slice(1);
    document.querySelector('#fixcolor').innerHTML = hexcolorSearch;
    document.querySelector('#expixelcolor').style.backgroundColor = hexcolorSearch;



    var userInputX = pixcrdXSearch;
    var userInputY = pixcrdYSearch;
    userInputX = encodeURIComponent(userInputX);
    userInputY = encodeURIComponent(userInputY);
    
    var xhr0 = new XMLHttpRequest();
    xhr0.open('GET', 'checkingstatus.php?' + 'pixcrdX=' + userInputX + '&pixcrdY=' + userInputY);
    xhr0.onreadystatechange = function(){
        if(xhr0.readyState === 4 && xhr0.status === 200){
          servResponseStatus.innerHTML = xhr0.responseText;
        }
    }
    xhr0.send('pixcrdX=' + userInputX + '&pixcrdY=' + userInputY);

    var xhr1 = new XMLHttpRequest();
    xhr1.open('GET', 'checkingowner.php?' + 'pixcrdX=' + userInputX + '&pixcrdY=' + userInputY);
    xhr1.onreadystatechange = function(){
        if(xhr1.readyState === 4 && xhr1.status === 200){
          servResponseOwner.innerHTML = xhr1.responseText;
        }
    }
    xhr1.send('pixcrdX=' + userInputX + '&pixcrdY=' + userInputY);

    var xhr2 = new XMLHttpRequest();
    xhr2.open('GET', 'checkingurl.php?' + 'pixcrdX=' + userInputX + '&pixcrdY=' + userInputY);
    xhr2.onreadystatechange = function(){
        if(xhr2.readyState === 4 && xhr2.status === 200){
          servResponseURL.innerHTML = xhr2.responseText;
                      if(xhr2.responseText == 'Pixel not purchased'){
              document.querySelector('#hrefafix').href = '';
            } else {
              document.querySelector('#hrefafix').href = xhr2.responseText;
            }
        }
    }
    xhr2.send('pixcrdX=' + userInputX + '&pixcrdY=' + userInputY);

    var xhr3 = new XMLHttpRequest();
    xhr3.open('GET', 'checkingtext.php?' + 'pixcrdX=' + userInputX + '&pixcrdY=' + userInputY);
    xhr3.onreadystatechange = function(){
        if(xhr3.readyState === 4 && xhr3.status === 200){
          servResponseText.innerHTML = xhr3.responseText;
        }
    }
    xhr3.send('pixcrdX=' + userInputX + '&pixcrdY=' + userInputY);
} 