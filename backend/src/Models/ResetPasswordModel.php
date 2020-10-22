<?php

namespace App\Models;

use App\Entity\Traits;

/**
 * DTO to reset a password by email
 */
class ResetPasswordModel
{
    use Traits\EmailTrait;
}
