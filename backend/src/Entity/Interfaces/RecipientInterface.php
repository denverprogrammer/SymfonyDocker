<?php

namespace App\Entity\Interfaces;

/**
 * Entity recipient
 */
interface RecipientInterface
{
    /**
     * Get recipient.
     *
     * @return string
     */
    public function getRecipient(): string;

    /**
     * Set recipient.
     *
     * @param string $recipient Value of entity.
     *
     * @return self
     */
    public function setRecipient(string $recipient): self;

    /**
     * Get recipient type.
     *
     * @return string
     */
    public function getRecipientType(): string;

    /**
     * Set recipient type.
     *
     * @param string $type Value of entity.
     *
     * @return self
     */
    public function setRecipientType(string $type): self;
}
