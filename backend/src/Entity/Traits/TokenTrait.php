<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces\TokenInterface;

/**
 * Token of entity.
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
     * Gets token for entity
     *
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Sets token for entity
     *
     * @param string|null $token Value of entity.
     *
     * @return self
     */
    public function setToken(?string $token = null): self
    {
        $this->token = $token;

        return $this;
    }
}
