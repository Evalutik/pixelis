<?php
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

require_once __DIR__ . '/../bootstrap.php';

class IntegrationTest extends TestCase {
    protected static $baseUrl = 'http://localhost:8080/';

    public static function setUpBeforeClass(): void {
        // Ensure directories exist and are empty
        $dirs = [DATA_DIR . '/activezki', DATA_DIR . '/bronpix', DATA_DIR . '/pixelsDB'];
        foreach ($dirs as $d) {
            if (!file_exists($d)) mkdir($d);
            $files = glob($d . '/*');
            foreach ($files as $f) unlink($f);
        }
        // Try running db setup if available
        @passthru('php src/setup_db.php --seed=itest:itest');
    }

    public function test_register_and_login_and_buy_flow(): void {
        $jar = new CookieJar();
        $client = new Client(['base_uri' => self::$baseUrl, 'cookies' => $jar, 'allow_redirects' => true]);

        // 1) Register: fetch signup page to get CSRF token
        $res = $client->get('signuppc.php');
        $body = (string)$res->getBody();
        $csrf = $this->extractCsrf($body);
        $this->assertNotEmpty($csrf, 'CSRF token found on signup page');

        $nick = 'itest'.random_int(1000,9999);
        $password = 'P@ssw0rd123!';
        $form = [
            'nick' => $nick,
            'password' => $password,
            'password_confirm' => $password,
            'checkbox_1' => 'on',
            '_csrf' => $csrf
        ];
        $res = $client->post('actions/registration.php', ['form_params' => $form]);
        // After registration, message is displayed on signin page (we follow redirects)
        $this->assertStringContainsString('Congratulations', (string)$res->getBody());

        // 2) Login
        $res = $client->get('signinpc.php');
        $csrf = $this->extractCsrf((string)$res->getBody());
        $res = $client->post('actions/authorization.php', ['form_params' => ['nick' => $nick, 'password' => $password, '_csrf' => $csrf]]);
        // Should end up on profile page
        $profile = $client->get('profile.php');
        $this->assertStringContainsString($nick, (string)$profile->getBody());

        // 3) Buy flow: get CSRF from index page and post buy
        $res = $client->get('indexpc.php');
        $csrf = $this->extractCsrf((string)$res->getBody());
        $px = rand(0,50);
        $py = rand(0,50);
        $form = [
            'buyinpx' => str_pad($px, 3, '0', STR_PAD_LEFT),
            'buyinpy' => str_pad($py, 3, '0', STR_PAD_LEFT),
            'buyinpcolor' => '#ff0000',
            'buyinpownname' => $nick,
            'buyinplink' => 'https://example.test/',
            'buyinptext' => 'Integration test',
            'buyinpbtnname' => 'Colorize',
            '_csrf' => $csrf
        ];
        $res = $client->post('oplata.php', ['form_params' => $form]);
        $body = (string)$res->getBody();
        $this->assertStringContainsString('Создана оплата', $body);

        // Check that bronpix file exists
        $bron = sprintf(DATA_DIR . '/bronpix/%d-%d.txt', $px, $py);
        $this->assertFileExists($bron);

        // And an activezki file exists
        $actives = glob(DATA_DIR . '/activezki/*.txt');
        $this->assertNotEmpty($actives);
    }

    private function extractCsrf(string $html): string {
        if (preg_match('/name="_csrf" value="([a-f0-9]+)"/i', $html, $m)) return $m[1];
        return '';
    }
}
