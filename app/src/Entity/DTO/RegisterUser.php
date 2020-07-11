<?php

namespace App\Entity\DTO;

use App\Entity\Interfaces;
use App\Entity\Traits;

/**
 * DTO for register user.
 */
class RegisterUser implements Interfaces\FirstNameInterface, Interfaces\LastNameInterface, Interfaces\EmailInterface
{
    use Traits\FirstNameTrait;
    use Traits\LastNameTrait;
    use Traits\EmailTrait;
}
