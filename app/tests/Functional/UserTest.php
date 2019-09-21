<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use App\Tests\Constants\UserConstants;
use App\Tests\Helpers\UserHelpers;
use App\Tests\Helpers\SecurityHelpers;

class UserTest extends ApiTestCase
{
    use ReloadDatabaseTrait;
    use UserHelpers;
    use SecurityHelpers;

    private $client = null;

    const AUTH_URL = '/authentication_token';

    const HEADERS = ['Content-Type' => 'application/json'];

    const URL = '/api/users';

    public function authorizedHeaders() {
        $headers = self::HEADERS;
        $headers['Authorization'] = 'Bearer ' . $this->token;

        return $headers;
    }

    protected function setUp()
    {
        parent::setup();
        $this->client = self::createClient();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
        $this->token = null;
    }

    public function testListUsers()
    {
        // Make sure this page is protected
        $this->client->request('GET', self::URL, [
            'headers' => self::HEADERS
        ]);
        $this->assertResponseStatusCodeSame(401);

        [$user, $response, $this->token] = $this->login();

        // Get a list users
        $this->client->request('GET', self::URL, [
            'headers' => $this->authorizedHeaders()
        ]);
        $this->assertResponseStatusCodeSame(200);
    }

    // public function testCreateUser()
    // {
    //     $user = $this->login();

    //     // Empty payload error
    //     $this->client->request('POST', self::URL, [
    //         'headers' => self::HEADERS,
    //         'json'    => []
    //     ]);
    //     $this->assertResponseStatusCodeSame(400);

    //     // Create user happy path
    //     $this->client->request('POST', self::URL, [
    //         'headers' => self::HEADERS,
    //         'json'    => UserConstants::TEST_USER
    //     ]);
    //     $this->assertResponseStatusCodeSame(201);
    // }
}

