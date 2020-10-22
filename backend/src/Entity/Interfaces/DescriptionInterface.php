<?php

namespace App\Entity\Interfaces;

/**
 * Description of entity
 */
interface DescriptionInterface
{
    /**
     * Get description of entity.
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Set description of entity.
     *
     * @param string|null $description Value of entity.
     *
     * @return self
     */
    public function setDescription(?string $description = null): self;
}
