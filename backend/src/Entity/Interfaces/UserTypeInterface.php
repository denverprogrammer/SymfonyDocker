<?php

namespace App\Entity\Interfaces;

/**
 * UserType of entity
 */
interface UserTypeInterface
{
    /**
     * Get UserType of entity.
     *
     * @return string
     */
    public function getUserType(): string;

    /**
     * Set UserType of entity.
     *
     * @param string $type Value of entity.
     *
     * @return self
     */
    public function setUserType(string $type): self;
}
