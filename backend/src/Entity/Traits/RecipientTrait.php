<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Constants\Enums\RecipientType;

/**
 * Entity recipient
 */
trait RecipientTrait
{
    /**
     * Recipient type of entity
     *
     * @var string
     *
     * @ORM\Column(type="string", length=180, options={"default" : RecipientType::EMAIL})
     * @Assert\NotBlank()
     */
    protected string $recipientType = RecipientType::EMAIL;

    /**
     * Recipient of entity
     *
     * @var string
     *
     * @ORM\Column(type="string", length=180)
     * @Assert\NotBlank()
     */
    protected string $recipient;

    /**
     * {inheritdoc}
     */
    public function getRecipient(): string
    {
        return $this->recipient;
    }

    /**
     * {inheritdoc}
     */
    public function setRecipient(string $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * {inheritdoc}
     */
    public function getRecipientType(): string
    {
        return $this->recipientType;
    }

    /**
     * {inheritdoc}
     */
    public function setRecipientType(string $type): self
    {
        $this->recipientType = $type;

        return $this;
    }
}
