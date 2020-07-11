<?php

namespace App\Entity\Interfaces;

/**
 * Represents the first name.
 */
interface FirstNameInterface
{
    /**
     * First name of user.
     *
     * @return string
     */
    public function getFirstName(): string;

    /**
     * Set first name of user.
     *
     * @param string $name User's first name.
     *
     * @return FirstNameInterface
     */
    public function setFirstName(string $name): FirstNameInterface;
}
