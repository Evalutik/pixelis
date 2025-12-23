<?php
$inpX = $_GET['pixcrdX'];
$inpY = $_GET['pixcrdY'];
$fname = $inpX.'-'.$inpY.'.txt';
require_once __DIR__ . '/bootstrap.php';
if (file_exists(DATA_DIR . '/pixelsDB/'.$fname)) {
	$status = 'Purchased';
} else if (file_exists(DATA_DIR . '/bronpix/'.$fname)) {
	$status = 'In a state of purchase';
} else {
	$status = 'Pixel not purchased';
}
echo $status; 
?>