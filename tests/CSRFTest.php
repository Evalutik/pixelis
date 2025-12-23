<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/csrf.php';

class CSRFTest extends TestCase {
    protected function setUp(): void {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
        // Ensure a fresh session
        if (session_status() == PHP_SESSION_NONE) session_start();
    }

    public function testTokenIsGeneratedAndValidated() {
        $token = csrf_token();
        $this->assertIsString($token);
        $this->assertEquals(64, strlen($token)); // 32 bytes hex
        $this->assertTrue(csrf_validate($token));
    }

    public function testInvalidTokenFails() {
        $token = csrf_token();
        $this->assertFalse(csrf_validate($token . 'x'));
    }
}
