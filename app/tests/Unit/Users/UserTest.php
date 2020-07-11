<?php

// tests/Util/CalculatorTest.php
namespace App\Tests\Unit;

use DateTime;
use App\Entity\User;
use App\Tests\Unit\Constants as CONSTANTS;
use PHPUnit\Framework\TestCase;

/**
 * Common User test
 */
class UserTest extends TestCase
{
    /**
     * Test Id
     */
    public function testId(): void
    {
        $user = new User();
        $result = $user
            ->getId();

        $this->assertNull($result);

        $result = $user
            ->setId(1)
            ->getId();

        $this->assertEquals(1, $result);
    }

    /**
     * Test first name
     */
    public function testFirstName(): void
    {
        $user = new User();
        $result = $user
            ->setFirstName(CONSTANTS::FIRST_NAME)
            ->getFirstName();

        $this->assertEquals(CONSTANTS::FIRST_NAME, $result);
    }

    /**
     * Test last name
     */
    public function testLastName(): void
    {
        $user = new User();
        $result = $user
            ->setLastName(CONSTANTS::LAST_NAME)
            ->getLastName();

        $this->assertEquals(CONSTANTS::LAST_NAME, $result);
    }

    /**
     * Test email
     */
    public function testEmail(): void
    {
        $user = new User();
        $result = $user
            ->setEmail(CONSTANTS::TEST_EMAIL)
            ->getEmail();

        $this->assertEquals(CONSTANTS::TEST_EMAIL, $result);
        $this->assertEquals($user->getEmail(), $user->getUsername());
    }

    /**
     * Test authorization roles
     */
    public function testRoles(): void
    {
        $user = new User();
        $result = $user
            ->setRoles(Constants::TEST_ROLES)
            ->getRoles();

        $this->assertEquals(Constants::TEST_ROLES, $result);
    }

    /**
     * Test password
     */
    public function testPassword(): void
    {
        $user = new User();
        $result = $user
            ->setPassword(CONSTANTS::TEST_PASSWORD)
            ->getPassword();

        $this->assertEquals(CONSTANTS::TEST_PASSWORD, $result);
        $user->eraseCredentials();
        $this->assertEquals(CONSTANTS::TEST_PASSWORD, $result);
    }

    /**
     * Test confirmed
     */
    public function testConfirmed(): void
    {
        $user = new User();
        $result = $user->getConfirmed();
        $this->assertEquals(false, $result);

        $user->setConfirmed(true);
        $result = $user->getConfirmed();
        $this->assertEquals(true, $result);
    }

    /**
     * Test token
     */
    public function testToken(): void
    {
        $user = new User();
        $result = $user->getToken();
        $this->assertNull($result);

        $user->setToken(CONSTANTS::TEST_TOKEN);
        $result = $user->getToken();
        $this->assertEquals(CONSTANTS::TEST_TOKEN, $result);
    }

    /**
     * Test isEqualTo
     */
    public function testIsEqualTo(): void
    {
        $user1 = new User();
        $user2 = new User();

        $result = $user1
            ->setEmail(CONSTANTS::TEST_EMAIL);
        $result = $user2
            ->setEmail(CONSTANTS::ALTERNATE_EMAIL);
        $this->assertFalse($user1->isEqualTo($user2));

        $result = $user2
            ->setEmail(CONSTANTS::TEST_EMAIL);
        $this->assertTrue($user1->isEqualTo($user2));
    }

    /**
     * Test getSalt
     */
    public function testGetSalt(): void
    {
        $user = new User();
        $result = $user
            ->getSalt();
        $this->assertNull($result);
    }

    /**
     * Test created
     */
    public function testCreated(): void
    {
        $user = new User();
        $current = new DateTime('now');

        $user->setCreated($current);
        $result = $user->getCreated();
        $this->assertEquals($current, $result);
    }

    /**
     * Test updated
     */
    public function testUpdated(): void
    {
        $user = new User();
        $current = new DateTime('now');

        $user->setUpdated($current);
        $result = $user->getUpdated();
        $this->assertEquals($current, $result);
    }
}
