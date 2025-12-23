<?php
$inpX = $_GET['pixcrdX'];
$inpY = $_GET['pixcrdY'];
$fnameurl = $inpX.'-'.$inpY.'.txt';
if (file_exists('pixelsDB/'.$fnameurl)) {
	$show_info = file('pixelsDB/'.$fnameurl);
	if ($show_info[1] != ''){
		$url = $show_info[1];
	} else {
		$url = 'Not specified';
	}
} else {
	$url = 'Pixel not purchased';
}
echo $url; 
?>