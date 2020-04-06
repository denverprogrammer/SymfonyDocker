<?php

// tests/Util/CalculatorTest.php
namespace App\Tests\Unit;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testFirstName()
    {
        $user = new User();
        $result = $user
            ->setFirstName('Jon')
            ->getFirstName();

        // assert that your calculator added the numbers correctly!
        $this->assertEquals('Jon', $result);
    }
}
