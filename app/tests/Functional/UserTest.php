<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use App\Tests\Constants\UserConstants;

class UserTest extends ApiTestCase
{
    use ReloadDatabaseTrait;

    public function testListUsers()
    {
        $client = self::createClient();
        $client->request('GET', '/api/users');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testCreateUser()
    {
        $client = self::createClient();

        // Empty payload error
        $client->request('POST', '/api/users', [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => []
        ]);
        $this->assertResponseStatusCodeSame(400);

        // Create user happy path
        $client->request('POST', '/api/users', [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => UserConstants::TEST_USER
        ]);
        $this->assertResponseStatusCodeSame(201);
    }
}

