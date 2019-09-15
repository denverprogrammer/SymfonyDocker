<?php

namespace App\Entity\Interfaces;

use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

/**
 * Interface for class/table.
 */
interface UserInterface extends
    IdentifierInterface,
    CreatedInterface,
    UpdatedInterface,
    SymfonyUserInterface
{
}
