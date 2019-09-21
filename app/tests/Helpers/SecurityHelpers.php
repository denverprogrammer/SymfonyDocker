<?php

namespace App\Tests\Helpers;

use App\Tests\Constants\UserConstants;
use App\Entity\User;

trait SecurityHelpers
{
    public function login(
        string $userName = UserConstants::TEST_EMAIL,
        string $password = UserConstants::TEST_PLAIN_PWD,
        int $expected = 200,
        string $redirect = null
    ): array {
        $user = $this->createApiUser($userName, $password);
        $response = $this->client->request('POST', self::AUTH_URL, [
            'headers' => ['Content-Type' => 'application/json'],
            'json'    => [
                'email'    => $userName,
                'password' => $password
            ]
        ]);

        $this->assertResponseStatusCodeSame($expected);
        $data = json_decode($response->getContent(), true);
        $token = $data['token'];

        return [$user, $response, $token];
    }
}