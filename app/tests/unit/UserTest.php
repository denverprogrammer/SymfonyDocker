<?php

// tests/Util/CalculatorTest.php
namespace App\Tests\Unit;

use App\Entity\User;
use App\Tests\TestConstants as CONSTANTS;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testFirstName()
    {
        $user = new User();
        $result = $user
            ->setFirstName(CONSTANTS::FIRST_NAME)
            ->getFirstName();
        $this->assertEquals(CONSTANTS::FIRST_NAME, $result);
    }

    public function testLastName()
    {
        $user = new User();
        $result = $user
            ->setLastName(CONSTANTS::LAST_NAME)
            ->getLastName();
        $this->assertEquals(CONSTANTS::LAST_NAME, $result);
    }

    public function testEmail()
    {
        $user = new User();
        $result = $user
            ->setEmail(CONSTANTS::TEST_EMAIL)
            ->getEmail();

        $this->assertEquals(CONSTANTS::TEST_EMAIL, $result);
        $this->assertEquals($user->getEmail(), $user->getUsername());
    }

    public function testRoles()
    {
        $user = new User();
        $result = $user
            ->setRoles(Constants::TEST_ROLES)
            ->getRoles();

        $this->assertEquals(Constants::TEST_ROLES, $result);
    }

    public function testPassword()
    {
        $user = new User();
        $result = $user
            ->setPassword(CONSTANTS::TEST_PASSWORD)
            ->getPassword();

        $this->assertEquals(CONSTANTS::TEST_PASSWORD, $result);

        $user->eraseCredentials();

        $this->assertEquals(CONSTANTS::TEST_PASSWORD, $result);
    }
}
