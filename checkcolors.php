<?php
$colors = array();
$fnamecolor = 'D:\OpenServer\domains\localhost\pixelsCL\colors.txt';
$f = fopen($fnamecolor, 'r');
$i = 0;
while (!feof($f)) {
	$color =  substr(fgets($f), 0, 6);
	if (($color == 'FFFFFF') || ($color == 'ffffff') || ($color === "\r\n") || ($color === '') ) {
		$colors[] = '';
	} else {
		$colors[] =	$color;
	}
	$i = $i+1;
}
fclose($f);
echo json_encode($colors); 
?>