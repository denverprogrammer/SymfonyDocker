<?php

namespace App\Entity\Interfaces;

/**
 * Represents a email.
 */
interface EmailInterface
{
    /**
     * Email of user.
     *
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * Set email of user.
     *
     * @param string $email User's email.
     *
     * @return EmailInterface
     */
    public function setEmail(string $email): EmailInterface;
}
