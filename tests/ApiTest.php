<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

require_once __DIR__ . '/../bootstrap.php';

class ApiTest extends TestCase {
    public function test_pixel_api_not_found(): void {
        $client = new Client(['base_uri' => 'http://localhost:8080/']);
        $res = $client->get('api/pixel.php?x=9999&y=9999', ['http_errors' => false]);
        $this->assertEquals(404, $res->getStatusCode());
    }

    public function test_pixel_api_success(): void {
        // create a sample pixel file
        $x = 5; $y = 6;
        $fname = DATA_DIR . "/pixelsDB/{$x}-{$y}.txt";
        file_put_contents($fname, "#ff0000\nowner\nhttps://example.test/\nHello\n");
        $client = new Client(['base_uri' => 'http://localhost:8080/']);
        $res = $client->get('api/pixel.php?x=' . $x . '&y=' . $y);
        $this->assertEquals(200, $res->getStatusCode());
        $data = json_decode((string)$res->getBody(), true);
        $this->assertEquals('#ff0000', $data['color']);
        unlink($fname);
    }
}
