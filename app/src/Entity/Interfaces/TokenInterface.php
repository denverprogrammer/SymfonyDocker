<?php

namespace App\Entity\Interfaces;

/**
 * Tokens are randomized strings that are used to confirm a action.
 */
interface TokenInterface
{
    /**
     * Confirmation token.
     *
     * @return string|null
     */
    public function getToken(): ?string;
    /**
     * Set confirmation token.
     *
     * @param string|null $token Set confirmation token.
     *
     * @return TokenInterface
     */
    public function setToken(string $token): TokenInterface;
}
