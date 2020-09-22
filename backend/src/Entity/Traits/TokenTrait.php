<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\TokenInterface;

/**
 * Token of entity
 */
trait TokenTrait
{
    /**
     * Token  of entity
     *
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected ?string $token = null;

    /**
     * {inheritdoc}
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * {inheritdoc}
     */
    public function setToken(?string $token = null): self
    {
        $this->token = $token;

        return $this;
    }
}
