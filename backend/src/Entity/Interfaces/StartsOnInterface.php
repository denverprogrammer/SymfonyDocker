<?php

namespace App\Entity\Interfaces;

use DateTime;

/**
 * Start date of entity
 */
interface StartsOnInterface
{
    /**
     * Gets the date and time the subscription was started
     *
     * @return DateTime|null
     */
    public function getStartsOn(): ?DateTime;

    /**
     * Sets the date and time the subscription was started
     *
     * @param DateTime|null $startsOn Value of entity.
     *
     * @return self
     */
    public function setStartsOn(?DateTime $startsOn = null): self;
}
