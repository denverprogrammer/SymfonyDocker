<?php

namespace App\Entity\Interfaces;

/**
 * Interface for Messages
 */
interface MessageInterface extends
    IdentifierInterface,
    CreatedInterface,
    UpdatedInterface,
    MessageBodyInterface,
    MessageTypeInterface,
    RecipientInterface,
    TitleInterface,
    TokenInterface
{
}
