<?php

namespace App\Tests\Constants;

class UserConstants
{
    const TEST_EMAIL = 'test@test.com';

    const TEST_BAD_EMAIL = 'bad.email@test.com';

    const TEST_FULL_NAME = [
        'first' => 'Jane',
        'last'  => 'Doe'
    ];

    const TEST_USER_ROLE = [
        'ROLE_USER'
    ];

    const TEST_PLAIN_PWD = 'drowssap';

    const TEST_ENCODED_PWD = '$argon2id$v=19$m=65536,t=4,p=1$OOD4VRsjtN1eiuAv9PFaGA$IY/ap401cDyU5sF4Src7n3E1mxKeRdGgVWZRN54Icn8';

    const TEST_BAD_PWD = 'dlskfjadlfd';

    const TEST_USER = [
        'firstName' => self::TEST_FULL_NAME['first'],
        'lastName'  => self::TEST_FULL_NAME['last'],
        'email'     => self::TEST_EMAIL,
        'roles'     => self::TEST_USER_ROLE,
        'password'  => self::TEST_ENCODED_PWD
    ];

    const TEST_LOGIN = [
        'email'    => self::TEST_EMAIL,
        'password' => self::TEST_USER_PWD
    ];
}