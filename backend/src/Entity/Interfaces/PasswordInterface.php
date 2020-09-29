<?php

namespace App\Entity\Interfaces;

/**
 * Interface for class/table.
 */
interface PasswordInterface
{
    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Sets password
     *
     * @param string $password Value of entity.
     *
     * @return self
     */
    public function setPassword(string $password): self;
}
