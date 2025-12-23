var c = document.getElementById("artcanvas");
var ctx = c.getContext("2d");
var servResponseStatus = document.querySelector('#fixstatus');
var servResponseOwner = document.querySelector('#fixowner');
var servResponseURL = document.querySelector('#fixlink');
var servResponseText = document.querySelector('#fixtext');

 document.querySelector('.block').onclick = function(event) {
    var pixcrdX; 
    var pixcrdY;
    var pixData;
    var hexcolor;
    var k = 1000 / document.querySelector('.select-canvas').clientWidth;
    event = event || window.event;
    pixcrdX = Math.round(event.offsetX * k); 
    pixcrdY = Math.round(event.offsetY * k);
    if (pixcrdX < 0) { pixcrdX = 0; } else if (pixcrdX > 999) { pixcrdX = 999; }
    if (pixcrdY < 0) { pixcrdY = 0; } else if (pixcrdY > 999) { pixcrdY = 999; }
    document.querySelector('#fixcordsX').innerHTML = pixcrdX;
    document.querySelector('#fixcordsY').innerHTML = pixcrdY;

    pixData = ctx.getImageData(pixcrdX, pixcrdY, 1, 1);
    hexcolor = "#" + ((1 << 24) + (pixData.data[0] << 16) + (pixData.data[1] << 8) + pixData.data[2]).toString(16).slice(1);
    document.querySelector('#fixcolor').innerHTML = hexcolor;
    document.querySelector('#expixelcolor').style.backgroundColor = hexcolor;
    document.getElementById('inputx').value = "";
    document.getElementById('inputy').value = "";

    // Начало обработки данных
    var userInputX = pixcrdX;
    var userInputY = pixcrdY;
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