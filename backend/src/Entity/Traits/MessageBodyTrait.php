<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\MessageInterface;

/**
 * Message of entity
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
     * {inheritdoc}
     */
    public function getMessageBody(): ?string
    {
        return $this->messageBody;
    }

    /**
     * {inheritdoc}
     */
    public function setMessageBody(?string $messageBody = null): self
    {
        $this->messageBody = $messageBody;

        return $this;
    }
}
