<?php

namespace App\Models;

use App\Entity\Interfaces;
use App\Entity\Traits;

/**
 * DTO to confirm a new user
 */
class SendMessageModel
{
    use Traits\MessageBodyTrait;
    use Traits\MessageTypeTrait;
    use Traits\RecipientTrait;
    use Traits\TitleTrait;
    use Traits\TokenTrait;
}
