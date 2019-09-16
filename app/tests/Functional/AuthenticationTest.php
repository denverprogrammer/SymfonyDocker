<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use App\Tests\Constants\UserConstants;

class AuthenticationTest extends ApiTestCase
{
    use ReloadDatabaseTrait;

    public function testAuthentication()
    {
        $client = self::createClient();

        // Create user happy path
        $client->request('POST', '/api/users', [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => UserConstants::TEST_USER
        ]);
        $this->assertResponseStatusCodeSame(201);

        // Empty payload error
        $client->request('POST', '/authentication_token', [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => []
        ]);
        $this->assertResponseStatusCodeSame(400);

        // Create user happy path
        $client->request('POST', '/authentication_token', [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => [
                'email'    => '',
                'password' => ''
            ]
        ]);
        $this->assertResponseStatusCodeSame(401);

        // Bad password
        $client->request('POST', '/authentication_token', [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => [
                'email'    => UserConstants::TEST_EMAIL,
                'password' => UserConstants::TEST_BAD_PWD
            ]
        ]);
        $this->assertResponseStatusCodeSame(401);

        // Bad email
        $client->request('POST', '/authentication_token', [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => [
                'email'    => UserConstants::TEST_BAD_EMAIL,
                'password' => ''
            ]
        ]);
        $this->assertResponseStatusCodeSame(401);

        // Create user happy path
        $client->request('POST', '/authentication_token', [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => [
                'email'    => UserConstants::TEST_EMAIL,
                'password' => UserConstants::TEST_PLAIN_PWD
            ]
        ]);
        $this->assertResponseStatusCodeSame(200);
    }
}

