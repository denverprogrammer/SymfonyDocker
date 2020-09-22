<?php

namespace App\Models;

use App\Entity\Traits;

/**
 * DTO to confirm a new user
 */
class ConfirmAccountModel
{
    use Traits\PasswordTrait;
    use Traits\AgreementTrait;
    use Traits\NotificationsTrait;
}
