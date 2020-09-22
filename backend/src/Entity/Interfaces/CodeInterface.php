<?php

namespace App\Entity\Interfaces;

interface CodeInterface
{
    /**
     * Get code of entity.
     *
     * @return string
     */
    public function getCode(): string;
    /**
     * Set code of entity.
     *
     * @param string $code
     *
     * @return self
     */
    public function setCode(string $code): self;
}
