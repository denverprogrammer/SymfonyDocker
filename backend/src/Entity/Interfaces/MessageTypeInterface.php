<?php

namespace App\Entity\Interfaces;

/**
 * Message of entity
 */
interface MessageTypeInterface
{
    /**
     * Get message type
     *
     * @return string
     */
    public function getMessageType(): string;

    /**
     * Set message type
     *
     * @param string $messageType Value of entity.
     *
     * @return self
     */
    public function setMessageType(string $messageType): self;
}
