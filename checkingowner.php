<?php
$inpX = $_GET['pixcrdX'];
$inpY = $_GET['pixcrdY'];
$fnameowner = $inpX.'-'.$inpY.'.txt';
require_once __DIR__ . '/bootstrap.php';
if (file_exists(DATA_DIR . '/pixelsDB/'.$fnameowner)) {
	$show_info = file(DATA_DIR . '/pixelsDB/'.$fnameowner);
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

