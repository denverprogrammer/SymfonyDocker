<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agreement for a entity
 */
trait AgreementTrait
{
    /**
     * Agreement value of record
     *
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default": "0"})
     */
    private $agreement = false;

    /**
     * Get agreement value of record.
     *
     * @return boolean
     */
    public function getAgreement(): bool
    {
        return $this->agreement;
    }

    /**
     * Set agreement value of record.
     *
     * @param boolean $value Value of agreement.
     *
     * @return self
     */
    public function setAgreement(bool $agreement): self
    {
        $this->agreement = $agreement;

        return $this;
    }
}
