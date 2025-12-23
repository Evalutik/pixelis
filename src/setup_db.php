<?php
// Simple DB setup script. Run with: php src/setup_db.php [--seed=nick:password]
// It reads DB_HOST, DB_USER, DB_PASS, DB_NAME from .env or environment variables.

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

$seed = null;
foreach ($argv as $arg) {
    if (str_starts_with($arg, '--seed=')) {
        $seed = substr($arg, 7);
    }
}

$mysqli = mysqli_connect($db_host, $db_user, $db_pass);
if (!$mysqli) {
    echo "Could not connect to MySQL server: " . mysqli_connect_error() . PHP_EOL;
    exit(1);
}
echo "Connected to MySQL server at {$db_host}\n";

if (!mysqli_query($mysqli, "CREATE DATABASE IF NOT EXISTS `{$db_name}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
    echo "Failed to create database: " . mysqli_error($mysqli) . PHP_EOL;
    exit(1);
}

echo "Database `{$db_name}` ensured.\n";

$mysqli->select_db($db_name);

$createUserTable = <<<SQL
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nick` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `aboutme` TEXT
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;

if (!mysqli_query($mysqli, $createUserTable)) {
    echo "Failed to create `user` table: " . mysqli_error($mysqli) . PHP_EOL;
    exit(1);
}

echo "Table `user` ensured.\n";

if ($seed) {
    [$sNick, $sPass] = explode(':', $seed) + [1 => 'password'];
    $sNick = substr($sNick, 0, 50);
    $hash = password_hash($sPass, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($mysqli, "INSERT INTO `user` (`nick`, `password`, `aboutme`) VALUES (?, ?, NULL)");
    mysqli_stmt_bind_param($stmt, 'ss', $sNick, $hash);
    if (mysqli_stmt_execute($stmt)) {
        echo "Seed user '{$sNick}' created (password: provided).\n";
    } else {
        echo "Seed user not created (may already exist).\n";
    }
}

echo "Setup complete.\n";
