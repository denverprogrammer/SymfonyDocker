<?php

namespace App\Tests\Helpers;

use App\Tests\Constants\UserConstants;
use App\Entity\User;

trait UserHelpers
{
    public function createApiUser(
        string $userName = UserConstants::TEST_EMAIL,
        string $password = UserConstants::TEST_PLAIN_PWD
    ): User {
        $user = new User();
        $user
            ->setFirstName('Howard')
            ->setLastName('Duck')
            ->setRoles(['ROLE_USER'])
            ->setEmail($userName)
            ->setPassword(UserConstants::TEST_ENCODED_PWD);

        $em = self::$container->get('doctrine')->getManager();
        $em->persist($user);
        $em->flush();

        return $user;
    }
}