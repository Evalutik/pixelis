<?php
$inpX = $_GET['pixcrdX'];
$inpY = $_GET['pixcrdY'];
$fnameowner = $inpX.'-'.$inpY.'.txt';
if (file_exists('pixelsDB/'.$fnameowner)) {
	$show_info = file('pixelsDB/'.$fnameowner);
	if ($show_info[0] != ''){
		$owner = $show_info[0];
	} else {
		$owner = 'Not specified';
	}
} else {
	$owner = 'Pixel not purchased';
}
echo $owner; 
?>

