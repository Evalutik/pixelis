<?php
 $x = $_GET['x'];
 $y = $_GET['y'];
 $HEXColor = $_GET['color']; //Получаем цвет в HEX, с решёткой
 $RGBColor = sscanf($HEXColor, "%02x%02x%02x"); // Преобразуем в РГБ. На выходу - массив в ргб.
 $fieldPath = __DIR__.'./field.png';
 $field = imagecreatefrompng($fieldPath);
 $drawColor = imagecolorallocate($field, $RGBColor[0], $RGBColor[1], $RGBColor[2]);
 imagesetpixel($field, $x, $y, $drawColor);
 imagepng($field, __DIR__.'./field.png');
 imagedestroy($field);
?>