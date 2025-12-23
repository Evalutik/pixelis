<?php
$colors = array();
$fnamecolor = 'D:\OpenServer\domains\localhost\pixelsCL\colors.txt';
$f = fopen($fnamecolor, 'r');
$n = 0;
$i = 0;
while (!feof($f)) {
	$color =  substr(fgets($f), 0, 6);
	if (($color == 'FFFFFF') || ($color == 'ffffff') || ($color === "\r\n") || ($color === '')) {
		//nothing
	} else {
		$colors[$n] =	$color;
		$colors[$n+1] = $i;
		$n = $n + 2;
	}
	$i = $i+1;
}
fclose($f);
echo json_encode($colors); 
?>