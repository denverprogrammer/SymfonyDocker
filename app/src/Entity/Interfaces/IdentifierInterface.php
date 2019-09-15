<?php

namespace App\Entity\Interfaces;

/**
 * Represents the unique id of the record.
 */
interface IdentifierInterface
{
    /**
     * Unique id of record
     *
     * @return int|null
     */
    public function getId(): ?int;
}
