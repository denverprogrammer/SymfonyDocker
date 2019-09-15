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
}
