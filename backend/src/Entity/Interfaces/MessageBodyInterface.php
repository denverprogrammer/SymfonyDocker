<?php

namespace App\Entity\Interfaces;

/**
 * Message of entity
 */
interface MessageBodyInterface
{
    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessageBody(): ?string;

    /**
     * Set message
     *
     * @param string|null $messageBody Content of entity.
     *
     * @return self
     */
    public function setMessageBody(?string $messageBody = null): self;
}
