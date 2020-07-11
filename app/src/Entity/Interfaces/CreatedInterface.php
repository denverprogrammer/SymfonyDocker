<?php

namespace App\Entity\Interfaces;

use DateTime;

/**
 * Represents the when record was created.
 */
interface CreatedInterface
{
    /**
     * Date and time record was created
     *
     * @return DateTime
     */
    public function getCreated(): DateTime;

    /**
     * Sets Date and time record was created
     *
     * @param DateTime $value
     *
     * @return CreatedInterface
     */
    public function setCreated(DateTime $value): CreatedInterface;
}
