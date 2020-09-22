<?php

namespace App\Entity\Interfaces;

/**
 * Entity email
 */
interface EmailInterface
{
    /**
     * Email of user.
     *
     * @return string|null
     */
    public function getEmail(): string;

    /**
     * Set email of user.
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self;
}
