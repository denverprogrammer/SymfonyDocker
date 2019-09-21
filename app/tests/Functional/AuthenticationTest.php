<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use App\Tests\Constants\UserConstants;
use App\Entity\User;
use App\Tests\Helpers\UserHelpers;

class AuthenticationTest extends ApiTestCase
{
    use ReloadDatabaseTrait;
    use UserHelpers;

    const HEADERS = ['Content-Type' => 'application/json'];

    const URL = '/authentication_token';

    private $client = null;

    protected function setUp()
    {
        parent::setup();
        $this->client = self::createClient();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }

    public function testAuthentication()
    {
        $user = $this->createApiUser();

        // Empty payload error
        $this->client->request('POST', self::URL, [
            'headers' => self::HEADERS,
            'json'    => []
        ]);
        $this->assertResponseStatusCodeSame(400);

        // Invalid credentials
        $this->client->request('POST', self::URL, [
            'headers' => self::HEADERS,
            'json'    => [
                'email'    => '',
                'password' => ''
            ]
        ]);
        $this->assertResponseStatusCodeSame(401);

        // Bad password
        $this->client->request('POST', self::URL, [
            'headers' => self::HEADERS,
            'json'    => [
                'email'    => UserConstants::TEST_EMAIL,
                'password' => UserConstants::TEST_BAD_PWD
            ]
        ]);
        $this->assertResponseStatusCodeSame(401);

        // Bad email
        $this->client->request('POST', self::URL, [
            'headers' => self::HEADERS,
            'json'    => [
                'email'    => UserConstants::TEST_BAD_EMAIL,
                'password' => ''
            ]
        ]);
        $this->assertResponseStatusCodeSame(401);

        // Create user happy path
        $this->client->request('POST', self::URL, [
            'headers' => self::HEADERS,
            'json'    => [
                'email'    => UserConstants::TEST_EMAIL,
                'password' => UserConstants::TEST_PLAIN_PWD
            ]
        ]);
        $this->assertResponseStatusCodeSame(200);
    }
}

