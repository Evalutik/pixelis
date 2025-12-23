<?php
// Project-wide bootstrap: autoload, constants, and helper setup
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Data directory (pixels, reservations)
define('DATA_DIR', __DIR__ . '/data');
if (!is_dir(DATA_DIR)) {
    mkdir(DATA_DIR, 0775, true);
}

// Ensure subdirectories exist
foreach (['pixelsDB', 'bronpix', 'activezki'] as $d) {
    $path = DATA_DIR . '/' . $d;
    if (!is_dir($path)) mkdir($path, 0775, true);
}

// Common helper: path to a pixel file
function pixel_file_path(int $x, int $y): string {
    return DATA_DIR . "/pixelsDB/{$x}-{$y}.txt";
}

?>