<?php

namespace App\Models;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Traits;

/**
 * DTO to confirm a new user
 */
class ConfirmPasswordModel
{
    use Traits\PasswordTrait;
}
