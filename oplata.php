<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="favicon.png" type="image/png">
		<title>Pixelis - payment</title>
		<link rel="stylesheet" type="text/css" href="css/gradbg.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>	
		<?php 
			if (file_exists('activezki')) 
			{ 
				$DelTime = 240;
				foreach (new DirectoryIterator('activezki') as $fileInfo) 
				{
				 if ($fileInfo->isDot()) { continue; } 
				 	if ( ($fileInfo->isFile() ) && ( time() - $fileInfo->getMTime() >= $DelTime) ) { 
				 	unlink($fileInfo->getRealPath()); 
				 	} 
				} 
			}
			if (file_exists('bronpix')) 
			{ 
				$DelTime = 240;
				foreach (new DirectoryIterator('bronpix') as $fileInfo2) 
				{
				 if ($fileInfo2->isDot()) { continue; } 
				 	if ( ($fileInfo2->isFile() ) && ( time() - ($fileInfo2->getMTime() ) >= $DelTime) ) { 
				 	unlink($fileInfo2->getRealPath()); 
				 	} 
				} 
			} 
		?>

		<?php
			date_default_timezone_set('Europe/Moscow');
			session_start();
			$flag = 0;
			$countFiles = scandir('activezki');
			$countnmbr = count($countFiles) - 2;
			// Only process POST requests below and validate CSRF token
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				require_once 'vendor/csrf.php';
				if (!csrf_validate($_POST['_csrf'] ?? '')) {
					if (session_status() == PHP_SESSION_NONE) session_start();
					$_SESSION['message'] = 'Invalid request.';
					header('Location: index.php');
					exit;
				}
				$checkX1 = (int) substr_replace($_POST['buyinpx'], '', 3);
				$checkY1 = (int) substr_replace($_POST['buyinpy'], '', 3);
				$checkX1 = 0 + $checkX1;
				$checkY1 = 0 + $checkY1;

				if ( (isset( $_POST['buyinpbtnname'] )) && ( $countnmbr < 5) && (!( file_exists('pixelsDB/'.$checkX1.'-'.$checkY1.'.txt')) )  &&! (( file_exists('bronpix/'.$checkX1.'-'.$checkY1.'.txt')) ) && ( $flag == 0) && (ctype_digit($_POST['buyinpx'])) && (ctype_digit($_POST['buyinpy'])) && ($checkX1 >= 0 ) && ( $checkY1 >= 0 ) && ($checkX1 <=999 ) && ( $checkY1 <=999 )): 
				?> 
				
				<h1>Создана оплата</h1> //форма оплаты

				<?php
					// при нажатии на кнопку делать
					date_default_timezone_set('Europe/Moscow');
					$codenmb = date('Ymd-h-i-s', time()).'-'.random_int(100, 999); 			
					$fb = fopen('bronpix/'.$checkX1.'-'.$checkY1.'.txt', 'w');
					fclose($fb); 			
					$fname = 'activezki/'.$codenmb.'.txt';
					$fw = fopen($fname, 'w');
					fwrite($fw, $checkX1."\r\n");
					fwrite($fw, $checkY1."\r\n");
					fwrite($fw, trim(str_replace("\\", ' ', str_replace("<", ' ', str_replace(">", ' ', str_replace('"', ' ', str_replace("'", ' ', str_replace('/', ' ', substr_replace($_POST['buyinpcolor'], '', 7 ) )))))), " " )."\r\n");
					fwrite($fw, trim(str_replace("\\", ' ', str_replace("<", ' ', str_replace(">", ' ', str_replace('"', ' ', str_replace("'", ' ', str_replace('/', ' ', substr_replace($_POST['buyinpownname'], '', 15 ) )))))), " " )."\r\n");
					fwrite($fw, trim(str_replace("\\", ' ', str_replace("<", ' ', str_replace(">", ' ', str_replace('"', ' ', str_replace("'", ' ', substr_replace($_POST['buyinplink'], '', 100 ) ))))), " ")."\r\n");
					fwrite($fw, trim(str_replace("\\", ' ', str_replace("<", ' ',str_replace(">", ' ', str_replace('"', ' ', str_replace("'", ' ', str_replace('/', ' ', substr_replace($_POST['buyinptext'], '', 235 ) )))))), " ")."\r\n");
					fclose($fw);
					$flag = 1;
				endif; // оплата

				if ( (isset( $_POST['buyinpbtnname'] )) && ( $countnmbr < 5) && (!( file_exists('pixelsDB/'.$checkX1.'-'.$checkY1.'.txt')) ) && ( file_exists('bronpix/'.$checkX1.'-'.$checkY1.'.txt')) && ( $flag == 0)  ) : 
				?> 
				<div class="bropl">
					<div class="opl-er-main-text">
					<h1>Oops. <br> 
						It looks like someone <br> 
						is buying this pixel now</h1>
					</div>
				</div>
				<div class="fulloplwh">
				<div class="fulloplftr">
				<h4>The pixel you selected has not yet been purchased, <br>but someone has already started placing an order for it. <br>If pixel won't be purchased, <br>you can do it in five minutes.</h4>
				</div>
					<a href="index.php" class="btnback">Back</a>
				</div>
				<?php
				$flag = 1;
				endif; // в броне

				if ( (isset( $_POST['buyinpbtnname'] )) && ( $countnmbr < 5) && ( file_exists('pixelsDB/'.$checkX1.'-'.$checkY1.'.txt')) && ( $flag == 0) ) : 
				?> 
				<div class="btopl">
					<div class="opl-er-main-text">
					<h1>This pixel <br>has already been <br>purchased</h1>
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="fulloplftr">
				<h4>It looks like this pixel has already been bought by someone before you.<br> You cannot recolor this pixel.</h4>
				</div>
					<a href="index.php" class="btnback">Back</a>
				<?php
				$flag = 1; 
				endif; // куплен

				
				if ( (isset( $_POST['buyinpbtnname'] )) && ($countnmbr >= 5 ) && ( $flag == 0) ): 
				?> 
				<div class="fullopl">
					<div class="opl-er-main-text">
					<h1>The payment queue <br> is full</h1>
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="fulloplftr">
				<h4>The flow of payments is too large. <br> To insure your purchase please try in a few minutes.</h4>
				</div>
					<a href="index.php" class="btnback">Back</a>
				<?php
				$flag = 1; 
				endif; 
			}

			//Чекнуть чтобы не создавало файлы с номерами типа 031-0022 вместо 31-22
		?>

		<?php
			if ( (isset( $_POST['buyinpbtnname'] )) && ( $countnmbr < 5) && (!( file_exists('pixelsDB/'.$checkX1.'-'.$checkY1.'.txt')) ) && ( file_exists('bronpix/'.$checkX1.'-'.$checkY1.'.txt')) && ( $flag == 0)  ) : 
		?> 
			<div class="bropl">
				<div class="opl-er-main-text">
				<h1>Oops. <br> 
					It looks like someone <br> 
					is buying this pixel now</h1>
				</div>
			</div>
			<div class="fulloplwh">
			<div class="fulloplftr">
			<h4>The pixel you selected has not yet been purchased, <br>but someone has already started placing an order for it. <br>If pixel won't be purchased, <br>you can do it in five minutes.</h4>
			</div>
				<a href="index.php" class="btnback">Back</a>
			</div>

		<?php 
			$flag = 1;
			endif; // в броне
		?>


		<?php
			if ( (isset( $_POST['buyinpbtnname'] )) && ( $countnmbr < 5) && ( file_exists('pixelsDB/'.$checkX1.'-'.$checkY1.'.txt')) && ( $flag == 0) ) : 
		?> 
			<div class="btopl">
				<div class="opl-er-main-text">
				<h1>This pixel <br>has already been <br>purchased</h1>
				</div>
			</div>
			<br>
			<br>
			<br>
			<div class="fulloplftr">
			<h4>It looks like this pixel has already been bought by someone before you.<br> You cannot recolor this pixel.</h4>
			</div>
				<a href="index.php" class="btnback">Back</a>
		<?php
			$flag = 1; 
			endif; // куплен
		?> 



		<?php
			if ( (isset( $_POST['buyinpbtnname'] )) && ($countnmbr >= 5 ) && ( $flag == 0) ): 
		?>
			<div class="fullopl">
				<div class="opl-er-main-text">
				<h1>The payment queue <br> is full</h1>
				</div>
			</div>
			<br>
			<br>
			<br>
			<div class="fulloplftr">
			<h4>The flow of payments is too large. <br> To insure your purchase please try in a few minutes.</h4>
			</div>
				<a href="index.php" class="btnback">Back</a>
		<?php
			$flag = 1; 
			endif; 
		?>


	</body>
</html>