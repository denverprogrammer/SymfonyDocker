<?php

namespace App\Entity\Interfaces;

/**
 * Determines the visibility of a entity
 */
interface ViewStateInterface
{
    /**
     * Get viewState of a entity
     *
     * @return string
     */
    public function getViewState(): string;

    /**
     * Set viewState
     *
     * @param string $viewState
     *
     * @return self
     */
    public function setViewState(string $viewState): self;
}
