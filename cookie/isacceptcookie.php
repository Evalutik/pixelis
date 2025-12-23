<?php
if ( !isset($_COOKIE['accept_cookie']) ) {
	function isMobile() { 
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}
	if(isMobile()){ // мобильная
    	echo '
		<link rel="stylesheet" type="text/css" href="css/mobile/stylecookiem.css">
		'; 
	} else { //для пк
		echo '
		<link rel="stylesheet" type="text/css" href="css/pc/stylecookiepc.css">
		';
	}
	echo '
	<div class="accept-cookie">
		<p>We use cookies to improve the site for you! By using our site you consent to the use of these cookies.</p>
		<button class="push" onClick="addAcceptCookie()">Accept</button>
		<button onClick=\'location.href="cookie/aboutcookies.php"\' >More</button>
		<script type="text/javascript">
			function addAcceptCookie(){
				document.cookie = "accept_cookie=; max-age=2592000";
				document.querySelector(".accept-cookie").classList.add("hide");
			}
		</script>
	</div>
	';
}
