<?php

namespace App\Entity\Interfaces;

use DateTime;

/**
 * Represents the last time the record was changed.
 */
interface UpdatedInterface
{
    /**
     * Date and time record was changed
     *
     * @return DateTime
     */
    public function getUpdated(): DateTime;

    /**
     * Sets Date and time record was updated
     *
     * @param DateTime $value
     *
     * @return UpdatedInterface
     */
    public function setUpdated(DateTime $value): UpdatedInterface;
}
