<?php
require_once __DIR__ . '/../bootstrap.php';
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
if(isMobile()){
    header('Location: public/indexm.php'); // mobile
} else {
    header('Location: public/indexpc.php'); // desktop
}
