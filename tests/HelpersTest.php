<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/helpers.php';

class HelpersTest extends TestCase {
    public function testEscape() {
        $input = '<script>alert(1)</script>';
        $this->assertEquals(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'), e($input));
    }
}
