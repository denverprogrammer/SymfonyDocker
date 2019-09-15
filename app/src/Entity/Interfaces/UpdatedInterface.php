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
}
