<?php

namespace App\Entity\Interfaces;

/**
 * Display name of entity
 */
interface TitleInterface
{
    /**
     * Get title of entity.
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Set title of entity.
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self;
}
