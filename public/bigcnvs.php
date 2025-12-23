<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<title>Pixelis - current field</title>
	</head>
	<body>
		<?php

		function isMobile() { 

		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
		}

		if(isMobile()){
    		header('Location: bigcnvsm.php'); // мобильная
		}
		else { 
			header('Location: bigcnvspc.php'); //для пк
			 }

		?>
	</body>
</html>