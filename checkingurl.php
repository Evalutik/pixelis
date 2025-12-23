<?php
$inpX = $_GET['pixcrdX'];
$inpY = $_GET['pixcrdY'];
$fnameurl = $inpX.'-'.$inpY.'.txt';
require_once __DIR__ . '/bootstrap.php';
if (file_exists(DATA_DIR . '/pixelsDB/'.$fnameurl)) {
	$show_info = file(DATA_DIR . '/pixelsDB/'.$fnameurl);
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