<?php

namespace App\Entity\Interfaces;

/**
 * Agreement for a entity
 */
interface AgreementInterface
{
    /**
     * Get agreement value of record.
     *
     * @return boolean
     */
    public function getAgreement(): bool;

    /**
     * Set agreement value of record.
     *
     * @param boolean $agreement Value of entity.
     *
     * @return self
     */
    public function setAgreement(bool $agreement): self;
}
