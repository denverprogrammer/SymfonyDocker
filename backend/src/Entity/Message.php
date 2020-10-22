<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\MessageInterface;

/**
 * Invitation class
 *
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message implements MessageInterface
{
    use Traits\IdentifierTrait;
    use Traits\CreatedTrait;
    use Traits\UpdatedTrait;
    use Traits\MessageBodyTrait;
    use Traits\MessageTypeTrait;
    use Traits\RecipientTrait;
    use Traits\TitleTrait;
    use Traits\TokenTrait;
}
