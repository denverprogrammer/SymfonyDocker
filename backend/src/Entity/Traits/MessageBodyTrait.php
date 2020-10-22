<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\MessageInterface;

/**
 * Message of entity.
 */
trait MessageBodyTrait
{
    /**
     * Message of entity;
     *
     * @var string|null
     *
     * @ORM\Column(type="string", length=4000, nullable=true)
     */
    protected ?string $messageBody = null;

    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessageBody(): ?string
    {
        return $this->messageBody;
    }

    /**
     * Set message
     *
     * @param string|null $messageBody Content of entity.
     *
     * @return self
     */
    public function setMessageBody(?string $messageBody = null): self
    {
        $this->messageBody = $messageBody;

        return $this;
    }
}
