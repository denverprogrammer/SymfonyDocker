<?php

namespace App\Entity\Interfaces;

/**
 * Description of entity
 */
interface DescriptionInterface
{
    /**
     * Get title of entity.
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Set title of entity.
     *
     * @param string|null $description
     *
     * @return self
     */
    public function setDescription(?string $description = null): self;
}
