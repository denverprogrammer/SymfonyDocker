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
     * @param boolean $value Value of agreement.
     *
     * @return self
     */
    public function setAgreement(bool $agreement): self;
}
