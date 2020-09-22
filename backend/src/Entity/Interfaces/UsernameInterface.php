<?php

namespace App\Entity\Interfaces;

/**
 * Entity username
 */
interface UsernameInterface
{
    /**
     * Username of user.
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Set username of user.
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername(string $username): self;
}
