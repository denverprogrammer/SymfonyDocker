<?php

namespace App\Entity\Interfaces;

use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

/**
 * Interface for class/table.
 */
interface AppUserInterface extends
    IdentifierInterface,
    FirstNameInterface,
    LastNameInterface,
    EmailInterface,
    CreatedInterface,
    UpdatedInterface,
    TokenInterface,
    SymfonyUserInterface
{
}
