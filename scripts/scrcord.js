  document.querySelector('.block').onmousemove = function(event) {
    event = event || window.event; // кроссбраузерность
    var mouseX = Math.round(event.offsetX);
    var mouseY = Math.round(event.offsetY);
    if (mouseX < 0) { mouseX = 0; } else if (mouseX > 999) { mouseX = 999; }
    if (mouseY < 0) { mouseY = 0; } else if (mouseY > 999) { mouseY = 999; }
    document.querySelector('.cordsX').innerHTML = mouseX;
    document.querySelector('.cordsY').innerHTML = mouseY;
} 