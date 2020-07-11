<?php

namespace App\Entity\DTO;

use App\Entity\Interfaces;
use App\Entity\Traits;

/**
 * DTO for register user.
 */
class ConfirmAccount implements Interfaces\IdentifierInterface
{
    use Traits\IdentifierTrait;
}
