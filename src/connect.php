<?php
// DB connection: prefer environment vars to avoid committing credentials.
// You can create a .env file in the project root with DB_HOST, DB_USER, DB_PASS, DB_NAME.
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue;
        if (strpos($line, '=') === false) continue;
        list($k, $v) = explode('=', $line, 2);
        $k = trim($k); $v = trim($v);
        if (!getenv($k)) putenv($k . "={$v}");
    }
}

$db_host = getenv('DB_HOST') ?: '127.0.0.1';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'main';

$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$connect) {
    die('Error connect to DataBase');
}

?>
