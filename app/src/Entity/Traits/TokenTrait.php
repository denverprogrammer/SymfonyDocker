<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Interfaces;

/**
 * Tokens are randomized strings that are used to confirm a action.
 */
trait TokenTrait
{
    /**
     * Confirmation token.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $token;

    /**
     * Confirmation token.
     *
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * {inheritdoc}
     */
    public function setToken(string $token): Interfaces\TokenInterface
    {
        $this->token = $token;

        return $this;
    }
}
