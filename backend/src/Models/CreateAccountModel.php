<?php

namespace App\Models;

use App\Entity\Traits;

/**
 * DTO to create a new user
 */
class CreateAccountModel
{
    use Traits\EmailTrait;
    use Traits\UsernameTrait;
}

