<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Confirmation for a entity.
 */
trait ConfirmedTrait
{
    /**
     * Confirmed value of record
     *
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default": "0"})
     */
    private $confirmed = false;

    /**
     * Get confirmed value of record.
     *
     * @return boolean
     */
    public function getConfirmed(): bool
    {
        return $this->confirmed;
    }

    /**
     * Set confirmed value of record.
     *
     * @param boolean $value Value of confirmation.
     *
     * @return self
     */
    public function setConfirmed(bool $value): self
    {
        $this->confirmed = $value;

        return $this;
    }
}
