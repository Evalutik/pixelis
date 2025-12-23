var c = document.getElementById("artcanvas"),
    ctx = c.getContext("2d");
/*ctx.fillStyle="rgba(255,255,255,1)";
ctx.fillRect(0, 0, 1000, 1000);
ctx.moveTo(0, 0);
ctx.fillStyle = "#f0f0f0";
ctx.fillRect(0, 0, 100, 100);
ctx.fillStyle = "#000fff";
ctx.fillRect(0, 100, 100, 100);*/
ctx.imageSmoothingEnabled = false;
ctx.mozImageSmoothingEnabled = false;
ctx.msImageSmoothingEnabled = false;
ctx.webkitImageSmoothingEnabled = false;

ctx.fillStyle = "#7D7AED";
ctx.font = "5rem Inter Bold";
ctx.fillText("Oops...", 120, 450);
ctx.fillText("Refresh the page!", 120, 540);
ctx.font = "1.2rem TTPro";
ctx.fillText("Looks like there was an error loading the field. Reload the page and it will work :)", 120, 590);

function loadField(){
   // Создаем объект изображения
   var field_img = new Image();

   // Привязываем функцию к событию onload
   // Это указывает браузеру, что делать, когда изображение загружено
   field_img.onload = function() {
      void ctx.drawImage(field_img, 0, 0, 1000, 1000, 0, 0, 1000, 1000);
      if (flag_bgcnvs) {ReDraw();}
      if (flag_clone) {CloneCnv();}
   };

   // Если ошибка перезапускаем функцию
   field_img.onerror = function() {
      loadField();
   }

   // Загружаем файл изображения
   field_img.src = "field.png";
}
loadField();

//var field_img = document.getElementById("photo_for_field");
/*var cordnow;
var countpix;
var pixelcolor;
var fillcolor;
var k = 0;
var inow = 0;
var jnow = 0;

var xhrCk = new XMLHttpRequest();
xhrCk.open('GET', 'checkcountpix.php?');
xhrCk.onreadystatechange = function(){
   if(xhrCk.readyState === 4 && xhrCk.status === 200){
      countpix = xhrCk.responseText;
      console.log(countpix);
      if (countpix < 300000) {
         var xhrM = new XMLHttpRequest();
         xhrM.open('GET', 'checkcolorsmin.php?');
         xhrM.onreadystatechange = function(){
            if(xhrM.readyState === 4 && xhrM.status === 200){
               pixelcolor = xhrM.responseText;
               pixelcolor = JSON.parse(pixelcolor);
               for (var i = 0; i < pixelcolor.length / 2; i++) {
                  fillcolor = "#"+pixelcolor[k];
                  cordnow = pixelcolor[k+1];
                  jnow = cordnow % 1000;
                  inow = (cordnow - jnow) / 1000;
                  ctx.fillStyle = fillcolor;
                  ctx.fillRect(jnow, inow, 1, 1);
                  k = k + 2;             
               }
               if (flag_bgcnvs) {ReDraw();}
               if (flag_clone) {CloneCnv();}
            }
         }
         xhrM.send();          
      } else {
         var xhrC = new XMLHttpRequest();
         xhrC.open('GET', 'checkcolors.php?');
         xhrC.onreadystatechange = function(){
            if(xhrC.readyState === 4 && xhrC.status === 200){
               pixelcolor = xhrC.responseText;
               pixelcolor = JSON.parse(pixelcolor);
               for (var i = 0; i < 1000; i++) {
                  for (var j = 0; j < 1000; j++) {
                     if (pixelcolor[k] != '') {
                        fillcolor = "#"+pixelcolor[k];
                        ctx.fillStyle = fillcolor;
                        ctx.fillRect(j, i, 1, 1);
                     }
                     k = k + 1;            
                  }   
               }
               if (flag_bgcnvs) {ReDraw();}
               if (flag_clone) {CloneCnv();}
            }
         }
         xhrC.send();         
      }
   }
}
xhrCk.send();*/