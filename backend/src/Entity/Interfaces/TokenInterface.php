<?php

namespace App\Entity\Interfaces;

/**
 * Interface for Token
 */
interface TokenInterface
{
    /**
     * Gets token for entity
     *
     * @return string|null
     */
    public function getToken(): ?string;

    /**
     * Sets token for entity
     *
     * @param string|null $token
     *
     * @return self
     */
    public function setToken(?string $token = null): self;
}
