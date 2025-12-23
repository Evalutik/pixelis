<?php
$fnamecolor = 'D:\OpenServer\domains\localhost\pixelsCL\colors.txt';
$f = fopen($fnamecolor, 'r');
$i = 0;
while (!feof($f)) {
	$color =  substr(fgets($f), 0, 6);
	if (($color == 'FFFFFF') || ($color == 'ffffff') || ($color === "\r\n") || ($color === '') ) {
		//nothing
	} else {
		$i = $i+1;
		if ($i > 300001) { break; }
	}
}
fclose($f);
//if (file_exists('pixelsCL/'.$fnamecolor)) {
//	$show_info = file('pixelsCL/'.$fnamecolor);
//		$color = $show_info[0];
//} else {
//	$color = '';
//}
echo $i; 
?>