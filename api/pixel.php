<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../bootstrap.php';

$x = isset($_GET['x']) ? (int)$_GET['x'] : null;
$y = isset($_GET['y']) ? (int)$_GET['y'] : null;
if ($x === null || $y === null) {
    http_response_code(400);
    echo json_encode(['error' => 'x and y required']);
    exit;
}

$path = DATA_DIR . "/pixelsDB/{$x}-{$y}.txt";
if (!file_exists($path)) {
    http_response_code(404);
    echo json_encode(['error' => 'pixel not found']);
    exit;
}
$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
// Format: color, owner, link, text (per write order)
$result = [
    'x' => $x,
    'y' => $y,
    'color' => $lines[0] ?? null,
    'owner' => $lines[1] ?? null,
    'link' => $lines[2] ?? null,
    'text' => $lines[3] ?? null,
];

echo json_encode($result, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
