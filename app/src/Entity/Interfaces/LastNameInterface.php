<?php

namespace App\Entity\Interfaces;

/**
 * Represents the last name.
 */
interface LastNameInterface
{
    /**
     * Last name of user.
     *
     * @return string
     */
    public function getLastName(): string;
    /**
     * Set last name of user.
     *
     * @param string $name User's last name.
     *
     * @return LastNameInterface
     */
    public function setLastName(string $name): LastNameInterface;
}
