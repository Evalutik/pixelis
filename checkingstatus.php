<?php
$inpX = $_GET['pixcrdX'];
$inpY = $_GET['pixcrdY'];
$fname = $inpX.'-'.$inpY.'.txt';
if (file_exists('pixelsDB/'.$fname)) {
	$status = 'Purchased';
} else if (file_exists('bronpix/'.$fname)) {
	$status = 'In a state of purchase';
} else {
	$status = 'Pixel not purchased';
}
echo $status; 
?>