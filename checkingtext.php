<?php
$inpX = $_GET['pixcrdX'];
$inpY = $_GET['pixcrdY'];
$fnametext = $inpX.'-'.$inpY.'.txt';
if (file_exists('pixelsDB/'.$fnametext)) {
	$show_info = file('pixelsDB/'.$fnametext);
	if ((trim($show_info[2], " ") != '') || (trim($show_info[3], " ") != '') || (trim($show_info[4], " ") != '') || (trim($show_info[5], " ") != '') || (trim($show_info[6], " ") != '')){
		$text = array_diff(array_slice($show_info, 2, 5), array("\r\n", "\r", "\n", " ", ' '));
		echo implode('<br>', $text);
	} else {
		$text = 'Not specified';
		echo $text;
	}

} else {
	$text = 'Pixel not purchased';
	echo $text;
}


?>