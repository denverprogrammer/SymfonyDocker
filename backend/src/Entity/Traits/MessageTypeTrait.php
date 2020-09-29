<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Message type of entity.
 */
trait MessageTypeTrait
{
    /**
     * Message type of entity;
     *
     * @var string
     *
     * @ORM\Column(type="string", length=16)
     * @Assert\NotBlank()
     */
    protected string $messageType;

    /**
     * Get message type
     *
     * @return string
     */
    public function getMessageType(): string
    {
        return $this->messageType;
    }

    /**
     * Set message type
     *
     * @param string $messageType Value of entity.
     *
     * @return self
     */
    public function setMessageType(string $messageType): self
    {
        $this->messageType = $messageType;

        return $this;
    }
}
