<?php

namespace App\Entity\Interfaces;

use DateTime;

/**
 * Start date of entity
 */
interface EndsOnInterface
{
    /**
     * Gets the date and time the subscription was expired
     *
     * @return DateTime|null
     */
    public function getEndsOn(): ?DateTime;

    /**
     * Sets the date and time the subscription was expired
     *
     * @param DateTime|null $endsOn When entity expires.
     *
     * @return self
     */
    public function setEndsOn(?DateTime $endsOn = null): self;
}
