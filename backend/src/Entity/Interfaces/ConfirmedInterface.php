<?php

namespace App\Entity\Interfaces;

use Doctrine\ORM\Mapping as ORM;

/**
 * Confirmation for a entity
 */
interface ConfirmedInterface
{
    /**
     * Get confirmed value of record.
     *
     * @return boolean
     */
    public function getConfirmed(): bool;

    /**
     * Set confirmed value of record.
     *
     * @param boolean $value Value of confirmation.
     *
     * @return self
     */
    public function setConfirmed(bool $value): self;
}
